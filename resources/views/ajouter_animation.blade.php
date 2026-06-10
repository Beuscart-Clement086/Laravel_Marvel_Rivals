<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une animation pour {{ $personnage->nom }}</title>
    <style>
        body {
            background-color: #b2b2b2ff;
            color: white;
            margin: 0;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        
        .button {
            background-color: #343345;
            color: #f4d12b;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        textarea {
            background-color: #343345;
            color: white;
            border: 1px solid #f4d12b;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            width: 100%;
            max-width: 600px;
            max-height: 15px;
        }

    </style>
</head>
<body>
    <a href="{{ route('personnage.show', $personnage->id) }}" class="button">Retour au personnage</a>
    <h1>Ajouter une animation pour {{ $personnage->nom }}</h1>

    <form action="{{ route('animation.enregistrer', $personnage->id) }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nom">Nom de l'animation :</label>
            <textarea name="nom" rows="10" placeholder="Ajoutez un nom pour cette animation."></textarea><br>
        </div>

        <div class="form-group">
            <label for="rarete">Rareté :</label>
            <select name="rarete" id="rarete" required>
                <option value="Défaut" selected>Défaut</option>
                <option value="Rare" selected>Rare</option>
                <option value="Épique" selected>Épique</option>
                <option value="Légendaire" selected>Légendaire</option>
                <option value="" selected>-- Choisir une rareté --</option>
            </select>
        </div>

        <div class="form-group">
            <label for="image">Image de l'animation :</label>
            <input type="file" name="image" id="image" accept="image/*" required>
        </div>

        <div class="form-group">
            <label for="video">Vidéo de l'animation (optionnel) :</label>
            <input type="file" name="video" id="video" accept="video/*">
        </div>

        <button type="submit" class="button">Enregistrer</button>
    </form>

    
</body>
</html>
