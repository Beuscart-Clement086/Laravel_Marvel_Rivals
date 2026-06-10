<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Groupe;
use App\Models\Personnage;

class GroupeController extends Controller
{
    /**
     * Page d'administration des groupes : liste + formulaire d'ajout.
     */
    public function index()
    {
        $groupes = Groupe::withCount('personnages')->orderBy('nom')->get();

        return view('groupes.index', compact('groupes'));
    }

    /**
     * Création d'un nouveau groupe.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:groupes,nom',
        ]);

        Groupe::create(['nom' => $request->nom]);

        return redirect()->route('groupes.index')
            ->with('success', 'Groupe ajouté avec succès !');
    }

    /**
     * Suppression d'un groupe (détache automatiquement les personnages).
     */
    public function destroy($id)
    {
        $groupe = Groupe::findOrFail($id);
        $groupe->personnages()->detach();
        $groupe->delete();

        return redirect()->route('groupes.index')
            ->with('success', 'Groupe supprimé avec succès !');
    }

    /**
     * Met à jour les groupes d'un personnage depuis la page du personnage.
     */
    public function syncPersonnage(Request $request, $personnage_id)
    {
        $personnage = Personnage::findOrFail($personnage_id);

        // $request->groupes = tableau d'ids de groupes cochés (peut être vide)
        $personnage->groupes()->sync($request->input('groupes', []));

        return redirect()->route('personnage.show', $personnage->id)
            ->with('success', 'Groupes du personnage mis à jour !');
    }
}
