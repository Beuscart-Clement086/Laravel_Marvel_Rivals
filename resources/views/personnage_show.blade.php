<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $personnage->nom }}</title>
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

        .container {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        .bloc_gauche {
            flex: 80%;
            border: 4px solid #f4d12b;
            background: #33334b;
            padding: 10px;
        }

        .bloc_droite {
            flex: 0 0 20%;
            border: 4px solid #f4d12b;
            background: #33334b;
            padding: 10px;
        }

        .add-button {
            background-color: #343345;
            display: inline-block;
            color: #f4d12b;
            border: none;
            text-decoration: none;
            cursor: pointer;
        }

        .accueil-button {
            background-color: #343345;
            display: inline-block;
            color: #f4d12b;
            border: none;
            text-decoration: none;
            padding: 4px 6px;
            border-radius: 5px;
            cursor: pointer;
        }

        .logo-classe {
            width: 25px;
            height: auto;
            vertical-align: middle;
        }

        .titre-container {
            margin: 10px;
            margin-left: 0;
            display: inline-block;
            padding: 5px 10px;
            background: #f4d12b;
            box-shadow: 2px 2px 5px rgba(255,255,255,0.7);
            clip-path: polygon(5% 0, 100% 0, 95% 100%, 0 100%);
            overflow: hidden;
            width: max-content;
        }

        .titre {
            color: black;
            font-size: 26px;
            font-weight: bold;
            text-align: left;
            margin-left: 5px;
            margin-right: 5px;
        }

        .sous-titre {
            color: white;
            font-size: 20px;
            font-weight: bold;
            text-decoration: underline 3px #f4d12b;
        }

        .histoire {
            font-size: 18px;
            padding-bottom: 30px;
        }

        .grille-costumes {
            gap: 10px;
            display: grid;
            justify-content: center;
            grid-template-columns: repeat(4, 1fr);
            margin-top: 20px;
        }

        .grille-animations {
            gap: 10px;
            display: grid;
            justify-content: center;
            grid-template-columns: repeat(3, 1fr);
            margin-top: 20px;
        }

        .carte-costume {
            background: #343345;
            border: 2px solid #f4d12b;
            color: white;
            border-radius: 5px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .carte-costume img { max-width: 100%; height: auto; }

        .nom-costume { font-weight: bold; margin: 5px 0; }

        .rarete-costume {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f4d12b;
        }

        .delete-button {
            border: none;
            margin-bottom: 10px;
            border-radius: 5px;
            background-color: #ff4d4d;
            display: inline-block;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .logo-rarete {
            width: 20px;
            height: 20px;
            margin-right: 5px;
        }

        .histoire .sous-titre { float: right; }

        .carte-animation {
            background: #343345;
            border: 2px solid #f4d12b;
            color: white;
            border-radius: 5px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .carte-animation img {
            border-radius: 5px 5px 0 0;
            max-width: 100%;
            height: auto;
        }

        .nom-animation { font-weight: bold; margin: 5px 0; }

        .rarete-animation {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f4d12b;
        }

        .photo-costume {
            object-fit: cover;
            width: 100%;
            border-bottom: 2px solid #f4d12b;
        }

        .capacite-container {
            position: relative;
            display: flex;
            border: 1px solid #f4d12b;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #343345;
        }

        .delete-button-capacite {
            position: absolute;
            top: 10px;
            right: 10px;
            border: none;
            border-radius: 5px;
            background-color: #ff4d4d;
            color: white;
            padding: 5px 10px;
            cursor: pointer;
        }

        .capacite-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .capacite-image-header {
            background-color: #f4d12b;
            width: 50px;
            height: 50px;
            margin-right: 10px;
            border-radius: 5px;
            object-fit: cover;
        }

        .capacite-title {
            color: white;
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }

        .capacite-description { flex: 1.5; padding-right: 10px; }
        .capacite-table { flex: 1; }

        .capacite-table table { width: 100%; border-collapse: collapse; }

        .capacite-table th,
        .capacite-table td {
            padding: 5px;
            text-align: left;
            border-bottom: 1px solid #f4d12b;
        }

        .groupes-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin: 8px 0;
        }

        .groupe-badge {
            background: #1a1a2e;
            color: #f4d12b;
            border: 1px solid #f4d12b;
            border-radius: 20px;
            padding: 3px 11px;
            font-size: 13px;
            font-weight: bold;
        }

        .groupes-form {
            margin-top: 10px;
            border-top: 1px solid #f4d12b;
            padding-top: 10px;
        }

        .groupes-form label {
            display: block;
            font-size: 14px;
            margin: 3px 0;
            cursor: pointer;
        }

        .btn-sync {
            margin-top: 8px;
            background-color: #f4d12b;
            color: #1a1a2e;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>
<body>

    @include('partials.navbar')

    <div class="page-content">

        <p>
            <a class="accueil-button" href="{{ url('/') }}">← Retour à l'accueil</a>
        </p>

        <div class="container">

            {{-- ── BLOC GAUCHE ── --}}
            <div class="bloc_gauche">

                {{-- Histoire --}}
                <div class="titre-container">
                    <div class="titre">L'Histoire du Personnage</div>
                </div><br>

                <div class="histoire">
                    @auth
                        <div class="sous-titre">
                            <a class="add-button" href="{{ route('description.modifier', $personnage->id) }}">
                                + Modifier l'histoire
                            </a>
                        </div>
                    @endauth

                    @if($personnage->description)
                        {!! nl2br(e($personnage->description)) !!}<br>
                    @else
                        @auth
                            <a class="add-button" href="{{ route('description.ajouter_description', $personnage->id) }}">
                                Ajouter une description
                            </a>
                        @else
                            <em style="color:#aaa;">Aucune description disponible.</em>
                        @endauth
                    @endif
                </div>

                {{-- Capacités --}}
                <div class="titre-container">
                    <div class="titre">Capacités du Personnage</div>
                </div><br>

                <div class="sous-titre">Points Forts :
                    @auth
                        <a class="add-button" href="{{ route('capacite.ajouter', $personnage->id) }}" style="float:right;">
                            + Ajouter une capacité
                        </a>
                    @endauth
                </div><br>

                @forelse($personnage->capacites as $capacite)
                    <div class="capacite-container">
                        @auth
                            <form action="{{ route('capacite.supprimer', [$personnage->id, $capacite->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button-capacite"
                                        onclick="return confirm('Supprimer cette capacité ?')">Supprimer</button>
                            </form>
                        @endauth

                        <div class="capacite-description">
                            <div class="capacite-header">
                                @if($capacite->image)
                                    <img src="{{ Str::startsWith($capacite->image, 'http') ? $capacite->image : asset('images/' . Str::slug($personnage->nom, '_') . '/' . $capacite->image) }}"
                                         alt="{{ $capacite->nom }}" class="capacite-image-header">
                                @endif
                                <h3 class="capacite-title">{{ $capacite->nom }}</h3>
                            </div>
                            <p>{!! nl2br(e($capacite->description)) !!}</p>
                        </div>

                        <div class="capacite-table">
                            <table>
                                @if($capacite->touche)
                                    <tr><th>Touche</th><td>{{ $capacite->touche }}</td></tr>
                                @endif
                                @if($capacite->type)
                                    <tr><th>Type</th><td>{{ $capacite->type }}</td></tr>
                                @endif
                                @if($capacite->degats)
                                    <tr><th>Dégâts</th><td>{{ $capacite->degats }}</td></tr>
                                @endif
                                @if($capacite->rechargement)
                                    <tr><th>Rechargement</th><td>{{ $capacite->rechargement }} secondes</td></tr>
                                @endif
                            </table>
                        </div>
                    </div>
                @empty
                    <p>Aucune capacité enregistrée pour ce personnage.</p>
                @endforelse

                {{-- Cosmétiques --}}
                <div class="titre-container">
                    <div class="titre">Cosmétiques du Personnage</div>
                </div><br>

                <div class="sous-titre">Costumes :
                    @auth
                        <a class="add-button" href="{{ route('costume.ajouter', $personnage->id) }}" style="float:right;">
                            + Ajouter un costume
                        </a>
                    @endauth
                </div>

                <div class="grille-costumes">
                    @forelse($personnage->costumes as $costume)
                        <div class="carte-costume">
                            @if($costume->image)
                                <img class="photo-costume"
                                     src="{{ Str::startsWith($costume->image, 'http') ? $costume->image : asset('images/' . Str::slug($personnage->nom, '_') . '/' . $costume->image) }}"
                                     @if($costume->video) onclick="playVideo('{{ $costume->video }}', '{{ url('images/' . Str::slug($personnage->nom, '_')) }}')" @endif>
                            @endif
                            <p class="nom-costume">{{ $costume->nom }}</p>
                            <p class="rarete-costume">
                                @php
                                    $logoRarete = match($costume->rarete) {
                                        'Légendaire' => 'Légendaire.png',
                                        'Épique'     => 'Épique.png',
                                        'Rare'       => 'Rare.png',
                                        default      => 'Défaut.png',
                                    };
                                @endphp
                                <img class="logo-rarete" src="{{ asset('images/raretes/' . $logoRarete) }}" alt="{{ $costume->rarete }}">
                                {{ $costume->rarete }}
                            </p>
                            @if($costume->video)
                                <button class="add-button" onclick="playVideo('{{ $costume->video }}', '{{ url('images/' . Str::slug($personnage->nom, '_')) }}')">
                                    ▶ Lire la vidéo
                                </button>
                            @endif
                            @auth
                                <form action="{{ route('costume.supprimer', [$personnage->id, $costume->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button">Supprimer</button>
                                </form>
                            @endauth
                        </div>
                    @empty
                        <div style="width:100%; text-align:center; padding:20px;">
                            <p>Aucun costume enregistré pour ce personnage.</p>
                        </div>
                    @endforelse
                </div>

                <br><br>

                {{-- Animations --}}
                <div class="sous-titre">Animations MVP :
                    @auth
                        <a class="add-button" href="{{ route('animation.ajouter', $personnage->id) }}" style="float:right;">
                            + Ajouter une animation
                        </a>
                    @endauth
                </div>

                <div class="grille-animations">
                    @forelse($personnage->animations as $animation)
                        <div class="carte-animation">
                            @if($animation->image)
                                <img class="photo-costume"
                                     src="{{ Str::startsWith($animation->image, 'http') ? $animation->image : asset('images/' . Str::slug($personnage->nom, '_') . '/' . $animation->image) }}"
                                     onclick="playVideo('{{ $animation->video }}', '{{ asset('images/' . Str::slug($personnage->nom, '_') . '/') }}')">
                            @endif
                            <p class="nom-animation">{{ $animation->nom }}</p>
                            <p class="rarete-animation">
                                @php
                                    $logoRarete = match($animation->rarete) {
                                        'Légendaire' => 'Légendaire.png',
                                        'Épique'     => 'Épique.png',
                                        'Rare'       => 'Rare.png',
                                        default      => 'Défaut.png',
                                    };
                                @endphp
                                <img class="logo-rarete" src="{{ asset('images/raretes/' . $logoRarete) }}" alt="{{ $animation->rarete }}">
                                {{ $animation->rarete }}
                            </p>
                            @if($animation->video)
                                <button class="add-button" onclick="playVideo('{{ $animation->video }}', '{{ asset('images/' . Str::slug($personnage->nom, '_') . '/') }}')">
                                    ▶ Lire la vidéo
                                </button>
                            @endif
                            @auth
                                <form action="{{ route('animation.supprimer', [$personnage->id, $animation->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button">Supprimer</button>
                                </form>
                            @endauth
                        </div>
                    @empty
                        <div style="width:100%; text-align:center; padding:20px;">
                            <p>Aucune animation enregistrée pour ce personnage.</p>
                        </div>
                    @endforelse
                </div>

                {{-- ── Emotes / Sprays / Nameplates ── --}}
                @php
                    $sections = [
                        'emote'     => 'Emotes',
                        'spray'     => 'Sprays',
                        'nameplate' => 'Nameplates',
                    ];
                @endphp

                @foreach($sections as $type => $titre)
                    @php $items = $personnage->cosmetiques->where('type', $type); @endphp
                    @if($items->count())
                        <br><br>
                        <div class="sous-titre">{{ $titre }} :</div>

                        <div class="grille-animations">
                            @foreach($items as $item)
                                <div class="carte-animation">
                                    @if($item->image)
                                        <img class="photo-costume"
                                             src="{{ Str::startsWith($item->image, 'http') ? $item->image : asset('images/' . Str::slug($personnage->nom, '_') . '/' . $item->image) }}"
                                             alt="{{ $item->nom }}">
                                    @endif
                                    <p class="nom-animation">{{ $item->nom }}</p>
                                    @if($item->rarete)
                                        <p class="rarete-animation">
                                            @php
                                                $logoRarete = match($item->rarete) {
                                                    'Légendaire' => 'Légendaire.png',
                                                    'Épique'     => 'Épique.png',
                                                    'Rare'       => 'Rare.png',
                                                    default      => 'Défaut.png',
                                                };
                                            @endphp
                                            <img class="logo-rarete" src="{{ asset('images/raretes/' . $logoRarete) }}" alt="{{ $item->rarete }}">
                                            {{ $item->rarete }}
                                        </p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endforeach

            </div>{{-- fin bloc_gauche --}}

            {{-- ── BLOC DROITE ── --}}
            <div class="bloc_droite">
                <h1>{{ $personnage->nom }}</h1>
                <p>
                    <img src="{{ asset('images/' . Str::slug($personnage->nom, '_') . '/' . $personnage->photo) }}" width="200">
                </p>
                <p>
                    <strong>Classe :</strong>
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
                    <img class="logo-classe" src="{{ asset('/images/classes/' . $logoClasse) }}" alt="{{ $classeNom }}">
                    {{ $classeNom }}
                </p>
                <p><strong>Vie :</strong> {{ $personnage->vie }}</p>

                {{-- Groupes du personnage (relation N..N) --}}
                <p style="margin-bottom:4px;"><strong>Groupes :</strong></p>
                @if($personnage->groupes->count())
                    <div class="groupes-badges">
                        @foreach($personnage->groupes as $groupe)
                            <span class="groupe-badge">{{ $groupe->nom }}</span>
                        @endforeach
                    </div>
                @else
                    <em style="color:#ccc;">Aucun groupe.</em>
                @endif

                {{-- Attribution des groupes (admin uniquement) --}}
                @auth
                    <form class="groupes-form" method="POST" action="{{ route('personnage.groupes.sync', $personnage->id) }}">
                        @csrf
                        @method('PUT')
                        <strong style="font-size:14px;">Modifier les groupes :</strong>
                        @foreach($tousLesGroupes as $groupe)
                            <label>
                                <input type="checkbox" name="groupes[]" value="{{ $groupe->id }}"
                                    {{ $personnage->groupes->contains($groupe->id) ? 'checked' : '' }}>
                                {{ $groupe->nom }}
                            </label>
                        @endforeach
                        <button type="submit" class="btn-sync">Enregistrer les groupes</button>
                    </form>
                @endauth
            </div>

        </div>{{-- fin container --}}

    </div>{{-- fin page-content --}}

    {{-- Modale vidéo --}}
    <div id="videoModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
         z-index:1000; justify-content:center; align-items:center; background:rgba(0,0,0,0.8);">
        <div style="position:relative; max-width:80%; max-height:80%;">
            <video id="modalVideo" controls autoplay style="max-width:90%; max-height:90%"></video>
            <button onclick="closeModal()" style="position:absolute; top:-40px; right:0;
                background:red; color:white; border:none; padding:5px 10px; cursor:pointer;">
                Fermer
            </button>
        </div>
    </div>

    <script>
        function playVideo(videoName, basePath) {
            if (!videoName) { alert("Aucune vidéo associée."); return; }
            // Si la vidéo est une URL externe (http...), on l'utilise directement
            const videoUrl = videoName.startsWith('http')
                ? videoName
                : basePath + '/' + encodeURI(videoName);
            const modal = document.getElementById('videoModal');
            const videoPlayer = document.getElementById('modalVideo');
            videoPlayer.src = videoUrl;
            modal.style.display = 'flex';
            videoPlayer.onloadeddata = function () {
                videoPlayer.play().catch(e => {
                    console.error(e);
                    alert("Impossible de lire la vidéo.");
                });
            };
        }

        function closeModal() {
            const modal = document.getElementById('videoModal');
            const videoPlayer = document.getElementById('modalVideo');
            videoPlayer.pause();
            videoPlayer.src = '';
            modal.style.display = 'none';
        }
    </script>

</body>
</html>