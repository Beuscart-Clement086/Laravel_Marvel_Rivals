<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une capacité pour {{ $personnage->nom }}</title>
    <style>
        body {
            background-color: #b2b2b2ff;
            color: white;
            margin: 0;
            padding: 20px;
        }
        .container {
            display: flex;
            gap: 20px;
        }
        .form-section {
            flex: 1;
            background-color: #343345;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #f4d12b;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, select, textarea {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #f4d12b;
            background-color: #343345;
            color: white;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #f4d12b;
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
    </style>
</head>
<body>
    <a href="{{ route('personnage.show', $personnage->id) }}" class="button">Retour au personnage</a>
    <h1>Ajouter une capacité pour {{ $personnage->nom }}</h1>

    <form action="{{ route('capacite.enregistrer', $personnage->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="form-section">
                <div class="form-group">
                    <label for="image">Image de la capacité (optionnel) :</label>
                    <input type="file" name="image" id="image" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="nom">Nom de la capacité :</label>
                    <input type="text" name="nom" id="nom" required>
                </div>
                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea name="description" id="description" rows="5"></textarea>
                </div>
            </div>
            <div class="form-section">
                <h3>Caractéristiques</h3>
                <table>
                    <tr>
                        <th>Touche</th>
                        <td>
                            <select name="touche">
                                <option value="">-- Sélectionner --</option>
                                <option value="Clic gauche">Clic gauche</option>
                                <option value="Clic droit">Clic droit</option>
                                <option value="E">E</option>
                                <option value="Maj">Maj</option>
                                <option value="F">F</option>
                                <option value="Q">Q</option>
                                <option value="Espace">Espace</option>
                                <option value="Passif">Passif</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td>
                            <select name="type">
                                <option value="">-- Sélectionner --</option>
                                <option value="Attaque normale">Attaque normale</option>
                                <option value="Attaque spéciale">Attaque spéciale</option>
                                <option value="Capacité">Capacité</option>
                                <option value="Ultime">Ultime</option>
                                <option value="Passif">Passif</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Dégâts</th>
                        <td><input type="number" name="degats" min="0"></td>
                    </tr>
                    <tr>
                        <th>Rechargement (secondes)</th>
                        <td><input type="number" name="rechargement" min="0"></td>
                    </tr>
                </table>
            </div>
        </div>
        <button type="submit" class="button">Enregistrer</button>
    </form>
</body>
</html>
