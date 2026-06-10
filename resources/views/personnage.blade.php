<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personnage</title>
    <style>
        body {
            background-color: #b2b2b2ff;
            color: white;
            margin: 0;
            padding: 20px;
        }

        .button {
        background-color: #343345;
        display: inline-block;
        color: #f4d12b;
        border: none;
        text-decoration: none;
        padding: 4px 6px;
        border-radius: 5px;
        cursor: pointer;
    }

    #custom-photo-upload {
        display: none;
    }

    .groupes-choice {
        display: flex;
        flex-wrap: wrap;
        gap: 8px 18px;
        margin-top: 6px;
        max-width: 500px;
    }

    .groupe-checkbox {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #343345;
        padding: 4px 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    </style>
</head>
<body>
    <a class="button" href="{{ url('/') }}">Retour à l’accueil</a>
    <h1>Enregistrer un personnage</h1>


    <form action="{{ url('/personnage') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="photo-choice">
        <label>
            <input type="radio" name="photo_choice" value="existing" checked>
            Choisir une image existante
        </label>
        <label>
            <input type="radio" name="photo_choice" value="custom">
            Importer une nouvelle image
        </label>
    </div>

    <div id="existing-photo-select">
        <label for="photo">Photo du personnage :</label>
        <select name="photo" id="photo">
            <option value="">-- Choisir une image --</option>
            @foreach($images as $image)
                <option value="{{ $image }}">
                    {{ $image }}
                </option>
            @endforeach
        </select>
    </div>

    <div id="custom-photo-upload" style="display: none;">
        <label for="custom_photo">Importer une photo :</label>
        <input type="file" name="custom_photo" id="custom_photo" accept="image/*">
    </div>

    <br>
    <label for="nom">Nom du personnage :</label>
    <input type="text" name="nom" placeholder="Nom du personnage" required>
    <br><br>
    
    <label for="classe">Classe du personnage :</label>
    <select name="classe" id="classe" required>
        <option value="">-- Choisir une classe --</option>
        <option value="Avant-Garde">Avant-Garde</option>
        <option value="Duelliste">Duelliste</option>
        <option value="Stratège">Stratège</option>
    </select>
<br>
    @error('classe')
        <div style="color:red">{{ $message }}</div>
    @enderror
    <br>

    <label for="vie">Points de vie :</label>
    <input type="number" name="vie" placeholder="Points de vie" required>
    <br><br>

    <label>Groupes du personnage :</label>
    <div class="groupes-choice">
        @forelse($groupes as $groupe)
            <label class="groupe-checkbox">
                <input type="checkbox" name="groupes[]" value="{{ $groupe->id }}"
                    {{ in_array($groupe->id, old('groupes', [])) ? 'checked' : '' }}>
                {{ $groupe->nom }}
            </label>
        @empty
            <em style="color:#ddd;">Aucun groupe disponible (ajoutez-en via le seeder).</em>
        @endforelse
    </div>
    <br>

    <button class="button" type="submit">Enregistrer</button>
</form>

<script>
    // Gestion de l'affichage des champs selon le choix de l'utilisateur
    document.querySelectorAll('input[name="photo_choice"]').forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'existing') {
                document.getElementById('existing-photo-select').style.display = 'block';
                document.getElementById('custom-photo-upload').style.display = 'none';
            } else {
                document.getElementById('existing-photo-select').style.display = 'none';
                document.getElementById('custom-photo-upload').style.display = 'block';
            }
        });
    });

    // Affichage par défaut
    document.getElementById('existing-photo-select').style.display = 'block';
</script>

</body>
</html>