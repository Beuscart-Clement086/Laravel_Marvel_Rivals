<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Personnage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Models\Costume;
use App\Models\Animation;
use App\Models\Capacite;


class PersonnageController extends Controller
{
    public function home_index()
    {
        $sort = request()->query('sort', 'nom');

        // La colonne de classe peut s'appeler "classe" (string) ou "classe_id" (FK)
        $classeColonne = \Illuminate\Support\Facades\Schema::hasColumn('personnages', 'classe_id')
            ? 'classe_id'
            : 'classe';

        if ($sort == 'classe') {
            $personnages = Personnage::with('groupes')->orderBy($classeColonne, 'asc')->get();
        } else {
        $personnages = Personnage::with('groupes')->orderBy('nom', 'asc')->get();
        }
        return view('welcome', [
            'personnages'   => $personnages,
            'nbPersonnages' => $personnages->count(),
            'sort' => $sort
        ]);
    }

public function personnage_index()
{
    // Chemin du dossier des images de profil
    $imagesPath = public_path('images/img_personnages');

    // Vérifier si le dossier existe, sinon le créer
    if (!File::exists($imagesPath)) {
        File::makeDirectory($imagesPath, 0777, true);
        $images = [];
    } else {
        // Récupérer les fichiers dans le dossier
        $files = File::files($imagesPath);

        // Extraire les noms de fichiers
        $images = array_map(function ($file) {
            return $file->getFilename();
        }, $files);
    }

    // Tous les groupes disponibles pour les cases à cocher du formulaire
    $groupes = \App\Models\Groupe::orderBy('nom')->get();

    return view('personnage', [
        'images'  => $images,
        'groupes' => $groupes,
    ]);
}



    public function personnage_new_post(Request $request)
{
    $validator = Validator::make($request->all(), [
        'nom' => 'required|string',
        'classe' => 'required|in:Avant-Garde,Duelliste,Stratège',
        'vie' => 'required|integer|min:1',
        'photo' => 'nullable|string',
        'custom_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    $data = $request->only(['nom', 'classe', 'vie']);

    // Créer le dossier du personnage (avec underscores)
    $personnageSlug = Str::slug($request->nom, '_');
    $personnageDossier = public_path('images/' . $personnageSlug);

    // Créer le dossier s'il n'existe pas
    if (!File::exists($personnageDossier)) {
        File::makeDirectory($personnageDossier, 0777, true);
    }

    // Gestion de la photo de profil
    if ($request->hasFile('custom_photo')) {
        $file = $request->file('custom_photo');
        $filename = 'imgprofil_' . $personnageSlug . '.' . $file->getClientOriginalExtension();
        $file->move($personnageDossier, $filename);
        $data['photo'] = $filename; // Enregistrer le nom du fichier dans la base de données
    } else {
        // Si une image existante est choisie, copier cette image dans le dossier du personnage
        $selectedImage = $request->input('photo');
        if ($selectedImage) {
            $sourcePath = public_path('images/img_personnages/' . $selectedImage);
            $destinationPath = $personnageDossier . '/imgprofil_' . $personnageSlug . '.' . pathinfo($selectedImage, PATHINFO_EXTENSION);
            File::copy($sourcePath, $destinationPath);
            $data['photo'] = 'imgprofil_' . $personnageSlug . '.' . pathinfo($selectedImage, PATHINFO_EXTENSION);
        }
    }

    // Créer le personnage
    $personnage = Personnage::create($data);

    // Associer les groupes cochés (relation N..N)
    $personnage->groupes()->sync($request->input('groupes', []));

    return redirect('/')->with('success', 'Personnage enregistré avec succès !');
}




    public function personnage_delete($id)
{
    $personnage = Personnage::findOrFail($id);

    // Supprimer le dossier du personnage s'il existe
    $personnageDossier = public_path('images/' . Str::slug($personnage->nom, '_'));
    if (File::exists($personnageDossier)) {
        File::deleteDirectory($personnageDossier);
    }

    // Supprimer le personnage
    $personnage->delete();

    return redirect('/')
        ->with('success', 'Personnage supprimé avec succès !');
}

  public function personnage_show($id)
{
    $personnage = Personnage::with(['costumes' => function($query) {
        $query->orderByRaw("FIELD(rarete, 'Défaut', 'Rare', 'Épique', 'Légendaire')");
    }, 'groupes', 'cosmetiques'])->findOrFail($id);

    // Tous les groupes disponibles (pour le formulaire d'attribution admin)
    $tousLesGroupes = \App\Models\Groupe::orderBy('nom')->get();

    return view('personnage_show', compact('personnage', 'tousLesGroupes'));
}

    public function personnage_description(Request $request, $id)
    {
        $personnage = Personnage::findOrFail($id);

        $validator = $request->validate([
            'description' => 'required|string',
        ]);

        $personnage->description = $validator['description'];
        $personnage->save();

        return redirect()->route('personnage.show', $id)
            ->with('success', 'Description ajoutée avec succès !');
}

    public function description_show($id)
    {
        $personnage = Personnage::findOrFail($id);

        return view('ajouter_description', compact('personnage'));
    }

    public function description_store(Request $request, $id)
    {
        $validator = $request->validate([
            'description' => 'required|string',
        ]);

        $personnage = Personnage::findOrFail($id);
        $personnage->description = $validator['description'];
        $personnage->save();

        return redirect()->route('personnage.show', $personnage->id)
            ->with('success', 'Description ajoutée avec succès !');
}




public function edit_description($id)
{
    $personnage = Personnage::findOrFail($id);
    return view('edit_description', compact('personnage'));
}

public function update_description(Request $request, $id)
{
    $personnage = Personnage::findOrFail($id);

    $validator = $request->validate([
        'description' => 'required|string',
    ]);

    $personnage->description = $validator['description'];
    $personnage->save();

    return redirect()->route('personnage.show', $personnage->id)
        ->with('success', 'Description modifiée avec succès !');
}

public function modifier_description($id)
{
    $personnage = Personnage::findOrFail($id);
    return view('modifier_description', compact('personnage'));
}




















public function capacite_ajouter($id)
{
    $personnage = Personnage::findOrFail($id);
    return view('ajouter_capacite', compact('personnage'));
}

public function capacite_enregistrer(Request $request, $id)
{
    $personnage = Personnage::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'nom' => 'required|string|max:255',
        'touche' => 'nullable|string',
        'description' => 'nullable|string',
        'type' => 'nullable|string',
        'degats' => 'nullable|integer',
        'rechargement' => 'nullable|integer',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $data = $request->except('image');

    $personnageDir = public_path('images/' . Str::slug($personnage->nom, '_'));

    // Créer le dossier s'il n'existe pas
    if (!File::exists($personnageDir)) {
        File::makeDirectory($personnageDir, 0777, true);
    }

    // Enregistrer l'image avec le préfixe "capacite_"
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = 'capacite_' . Str::slug($request->nom, '_') . '.' . $image->getClientOriginalExtension();
        $image->move($personnageDir, $imageName);
        $data['image'] = $imageName;
    }

    $personnage->capacites()->create($data);

    return redirect()->route('personnage.show', $personnage->id)
        ->with('success', 'Capacité ajoutée avec succès !');
}

public function capacite_supprimer($personnage_id, $capacite_id)
{
    $capacite = Capacite::findOrFail($capacite_id);

    // Supprimer l'image si elle existe
    if ($capacite->image) {
        $personnage = $capacite->personnage;
        $personnageDir = public_path('images/' . Str::slug($personnage->nom, '_'));
        $imagePath = $personnageDir . '/' . $capacite->image;

        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
    }

    $capacite->delete();

    return redirect()->route('personnage.show', $personnage_id)
        ->with('success', 'Capacité supprimée avec succès !');
}










































































public function costume_ajouter($id)
{
    $personnage = Personnage::findOrFail($id);
    return view('ajouter_costume', compact('personnage'));
}




public function costume_enregistrer(Request $request, $id)
{
    $personnage = Personnage::findOrFail($id);

    // Validation des données
    $validator = Validator::make($request->all(), [
        'nom' => 'required|string|max:255',
        'rarete' => 'required|string|in:Défaut,Rare,Épique,Légendaire',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'video' => 'nullable|mimes:mp4,mov,ogg|max:20000', // Ajout de la validation pour la vidéo
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Chemin du dossier du personnage (avec underscores)
    $personnageDir = public_path('images/' . Str::slug($personnage->nom, '_'));

    // Créer le dossier s'il n'existe pas
    if (!File::exists($personnageDir)) {
        File::makeDirectory($personnageDir, 0777, true);
    }

    // Enregistrer l'image avec le préfixe "costume_"
    $imageName = null;
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = 'costume_' . Str::slug($request->nom, '_') . '.' . $image->getClientOriginalExtension();
        $image->move($personnageDir, $imageName);
    }

    // Enregistrer la vidéo avec le préfixe "costume_video_"
    $videoName = null;
    if ($request->hasFile('video')) {
        $video = $request->file('video');
        $videoName = 'costume_video_' . Str::slug($request->nom, '_') . '.' . $video->getClientOriginalExtension();
        $video->move($personnageDir, $videoName);
    }

    // Créer le costume dans la base de données
    $costume = $personnage->costumes()->create([
        'nom' => $request->nom,
        'rarete' => $request->rarete,
        'image' => $imageName,
        'video' => $videoName,
    ]);

    return redirect()->route('personnage.show', $personnage->id)
        ->with('success', 'Costume ajouté avec succès !');
}

















public function costume_supprimer($personnage_id, $costume_id)
{
    $costume = Costume::findOrFail($costume_id);

    // Récupère le nom du personnage
    $personnageNom = $costume->personnage->nom;
    Log::info("Nom du personnage dans la base de données : " . $personnageNom);

    // Génère le slug du nom du personnage
    $personnageSlug = Str::slug($personnageNom, '_');
    Log::info("Slug du nom du personnage : " . $personnageSlug);

    // Chemin du dossier du personnage
    $personnageDossier = public_path('images/' . $personnageSlug);
    Log::info("Chemin du dossier du personnage : " . $personnageDossier);

    // Vérifie si le dossier existe
    if (!File::exists($personnageDossier)) {
        Log::error("Le dossier n'existe pas : " . $personnageDossier);
    } else {
        Log::info("Le dossier existe.");
    }

    // Suppression de l'image
    if (!empty($costume->image)) {
        $imagePath = $personnageDossier . '/' . $costume->image;
        Log::info("Chemin du fichier image à supprimer : " . $imagePath);

        if (File::exists($imagePath)) {
            File::delete($imagePath);
            Log::info("Fichier image supprimé avec succès.");
        } else {
            Log::error("Le fichier image n'existe pas : " . $imagePath);
        }
    } else {
        Log::warning("Aucun nom de fichier image défini dans la base de données.");
    }

    // Suppression du costume de la base de données
    $costume->delete();
    Log::info("Costume supprimé de la base de données.");

    return redirect()->route('personnage.show', $personnage_id)
        ->with('success', 'Costume supprimé avec succès !');
}



























public function animation_ajouter($id)
{
    $personnage = Personnage::findOrFail($id);
    return view('ajouter_animation', compact('personnage'));

}




public function animation_enregistrer(Request $request, $id)
{
    $personnage = Personnage::findOrFail($id);

    // Validation des données
    $validator = Validator::make($request->all(), [
        'nom' => 'required|string|max:255',
        'rarete' => 'required|string|in:Défaut,Rare,Épique,Légendaire',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'video' => 'nullable|mimes:mp4,mov,ogg|max:20000', // Validation pour la vidéo
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Chemin du dossier du personnage (avec underscores)
    $personnageDir = public_path('images/' . Str::slug($personnage->nom, '_'));

    // Créer le dossier s'il n'existe pas
    if (!File::exists($personnageDir)) {
        File::makeDirectory($personnageDir, 0777, true);
    }

    // Enregistrer l'image avec le préfixe "animation_"
    $imageName = null;
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = 'animation_' . Str::slug($request->nom, '_') . '.' . $image->getClientOriginalExtension();
        $image->move($personnageDir, $imageName);
    }

    // Enregistrer la vidéo avec le préfixe "animation_video_"
    $videoName = null;
    if ($request->hasFile('video')) {
        $video = $request->file('video');
        $videoName = 'animation_video_' . Str::slug($request->nom, '_') . '.' . $video->getClientOriginalExtension();
        $video->move($personnageDir, $videoName);
    }

    // Créer l'animation dans la base de données
    $animation = $personnage->animations()->create([
        'nom' => $request->nom,
        'rarete' => $request->rarete,
        'image' => $imageName,
        'video' => $videoName,
    ]);

    return redirect()->route('personnage.show', $personnage->id)
        ->with('success', 'Animation ajoutée avec succès !');
}





public function animation_supprimer($personnage_id, $animation_id)
{
    $animation = Animation::findOrFail($animation_id);

    // Récupère le nom du personnage
    $personnageNom = $animation->personnage->nom;
    Log::info("Nom du personnage dans la base de données : " . $personnageNom);

    // Génère le slug du nom du personnage
    $personnageSlug = Str::slug($personnageNom, '_');
    Log::info("Slug du nom du personnage : " . $personnageSlug);

    // Chemin du dossier du personnage
    $personnageDossier = public_path('images/' . $personnageSlug);
    Log::info("Chemin du dossier du personnage : " . $personnageDossier);

    // Vérifie si le dossier existe
    if (!File::exists($personnageDossier)) {
        Log::error("Le dossier n'existe pas : " . $personnageDossier);
    } else {
        Log::info("Le dossier existe.");
    }

    // Suppression de l'image
    if (!empty($animation->image)) {
        $imagePath = $personnageDossier . '/' . $animation->image;
        Log::info("Chemin du fichier image à supprimer : " . $imagePath);

        if (File::exists($imagePath)) {
            File::delete($imagePath);
            Log::info("Fichier image supprimé avec succès.");
        } else {
            Log::error("Le fichier image n'existe pas : " . $imagePath);
        }
    } else {
        Log::warning("Aucun nom de fichier image défini dans la base de données.");
    }

    // Suppression du animation de la base de données
    $animation->delete();
    Log::info("Animation supprimée de la base de données.");

    return redirect()->route('personnage.show', $personnage_id)
        ->with('success', 'Animation supprimée avec succès !');
}












































}