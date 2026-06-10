<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marvel Rivals</title>
    <style>
        body {
            background-color: #b2b2b2ff;
            color: white;
            margin: 0;
            padding: 0;
        }

        .page-content {
            padding: 20px;
        }

        .grid-personnages {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
            max-width: 1100px;
            margin: 30px auto;
        }

        .card-personnage {
            background: #343345;
            border: 4px solid #f4d12b;
            color: white;
            border-radius: 5px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .card-personnage:hover {
            transform: translateY(-5px);
        }

        .photo-personnage {
            object-fit: cover;
            width: 100%;
            border-bottom: 3px solid #f4d12b;
        }

        .classe {
            margin: 2px 0;
            font-weight: bold;
        }

        .logo-classe {
            object-fit: cover;
            width: 25px;
            height: auto;
            vertical-align: middle;
        }

        .add-button {
            background-color: #343345;
            display: inline-block;
            color: #f4d12b;
            border: none;
            text-decoration: none;
            padding: 4px 6px;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .delete-button {
            border: none;
            background-color: #ff4d4d;
            color: white;
            padding: 4px 6px;
            border-radius: 5px;
            text-decoration: none;
            margin-right: 5px;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .view-button {
            background-color: #f4d12b;
            color: #1a1a2e;
            padding: 4px 6px;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            font-weight: bold;
        }

        .groupes-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            justify-content: center;
            margin: 8px 6px;
        }

        .groupe-badge {
            background: #1a1a2e;
            color: #f4d12b;
            border: 1px solid #f4d12b;
            border-radius: 20px;
            padding: 2px 9px;
            font-size: 12px;
            font-weight: bold;
        }

        .header {
            text-align: center;
        }

        .sort-section {
            display: flex;
            justify-content: flex-end;
        }

        .sort-style {
            display: inline-block;
            margin-right: 10px;
            padding: 8px 12px;
            font-size: 16px;
            font-weight: bold;
            border: 4px solid #f4d12b;
            border-radius: 8px;
            background: #33334b;
            color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>

    @include('partials.navbar')

    <div class="page-content">
        <div class="header">
            <h1>Bienvenue sur le wiki de Marvel Rivals !</h1>
            <img src="/images/Logo_Marvel_Rivals.png" alt="Logo Marvel Rivals" width="300">
            <p>Le jeu de tir PVP en équipe de super-héros.</p>
            <p>Il y a actuellement {{ $nbPersonnages }} personnages disponibles.</p>

            @auth
                <a class="add-button" href="{{ url('/personnage') }}">+ Ajouter un personnage</a>
            @endauth
        </div>

        @if(session('success'))
            <p style="color:#7dff7d; text-align:center;">{{ session('success') }}</p>
        @endif

        <div class="sort-section">
            <form class="sort-style" method="GET" action="{{ url('/') }}">
                <label for="sort">Trier par :</label>
                <select name="sort" id="sort" onchange="this.form.submit()">
                    <option value="nom" {{ request()->query('sort') == 'nom' ? 'selected' : '' }}>Nom</option>
                    <option value="classe" {{ request()->query('sort') == 'classe' ? 'selected' : '' }}>Classe</option>
                </select>
            </form>
        </div>

        <div class="grid-personnages">
            @forelse($personnages as $personnage)
                @php
                    // Compatible schéma "classe" (string) ou "classe_id" (relation)
                    $classeNom = is_object($personnage->classe ?? null)
                        ? ($personnage->classe->nom ?? '')
                        : ($personnage->classe ?? '');

                    $logoClasse = match($classeNom) {
                        'Avant-Garde' => 'Avant-Garde.webp',
                        'Duelliste'   => 'Duelliste.webp',
                        'Stratège'    => 'Stratège.webp',
                        default       => 'default.png'
                    };
                @endphp

                <div class="card-personnage">
                    <img class="photo-personnage"
                         src="{{ asset('images/' . Str::slug($personnage->nom, '_') . '/' . $personnage->photo) }}"
                         width="120">
                    <br>
                    <strong>{{ $personnage->nom }}</strong><br>

                    <div class="classe">
                        Classe :
                        <img class="logo-classe"
                             src="{{ asset('/images/classes/' . $logoClasse) }}"
                             alt="{{ $classeNom }}">
                        {{ $classeNom }}
                    </div>

                    Vie : {{ $personnage->vie }}

                    <br>

                    {{-- Groupes du personnage (relation N..N) --}}
                    @if($personnage->groupes->count())
                        <div class="groupes-badges">
                            @foreach($personnage->groupes as $groupe)
                                <span class="groupe-badge">{{ $groupe->nom }}</span>
                            @endforeach
                        </div>
                    @endif

                    @auth
                        <form action="{{ route('personnage.delete', $personnage->id) }}"
                              method="POST"
                              onsubmit="return confirm('Supprimer ce personnage ?');"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button">Supprimer</button>
                        </form>
                    @endauth

                    <a href="{{ route('personnage.show', $personnage->id) }}" class="view-button">
                        Voir
                    </a>

                    <br><br>
                </div>
            @empty
                <p>Aucun personnage enregistré.</p>
            @endforelse
        </div>
    </div>

</body>
</html>