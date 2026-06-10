<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier la description de {{ $personnage->nom }}</title>
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
    <h1>Modifier l'histoire de {{ $personnage->nom }}</h1>

    <form method="POST" action="{{ route('description.update', $personnage->id) }}">
        @csrf
        @method('PUT')
        <textarea name="description" rows="10" placeholder="Modifiez la description...">{{ old('description', $personnage->description) }}</textarea><br>
        <button type="submit">Enregistrer</button>
    </form>

    <a class="accueil-button" href="{{ route('personnage.show', $personnage->id) }}">Retour au personnage</a>
</body>
</html>
