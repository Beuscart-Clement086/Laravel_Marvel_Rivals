<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une description pour {{ $personnage->nom }}</title>
    <style>
        body {
            background-color: #b2b2b2ff;
            color: white;
            margin: 0;
            padding: 20px;
        }

        .accueil-button {
            background-color: #343345;
            display: inline-block;
            color: #f4d12b;
            border: none;
            border-radius: 5px;
            padding: 4px;
            margin-top: 10px;
            text-decoration: none;
            cursor: pointer;
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
            min-height: 150px;
        }

    </style>
</head>
<body>
    <h1>Ajouter une description pour {{ $personnage->nom }}</h1>

    <form method="POST" action="{{ route('description.store', $personnage->id) }}">
        @csrf
        <textarea name="description" rows="10" placeholder="Ajoutez une description pour ce personnage."></textarea><br>
        <button type="submit">Enregistrer</button>
    </form>

    <a class="accueil-button" href="{{ route('personnage.show', $personnage->id) }}">Retour au personnage</a>
</body>
</html>