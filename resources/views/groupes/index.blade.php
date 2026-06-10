<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des groupes – Marvel Rivals</title>
    <style>
        body { background-color: #b2b2b2ff; color: white; margin: 0; padding: 0; font-family: sans-serif; }
        .page-content { max-width: 800px; margin: 0 auto; padding: 20px; }
        .titre-container {
            margin: 10px 0;
            display: inline-block;
            padding: 5px 14px;
            background: #f4d12b;
            clip-path: polygon(5% 0, 100% 0, 95% 100%, 0 100%);
        }
        .titre { color: black; font-size: 24px; font-weight: bold; }
        .card {
            background: #33334b;
            border: 4px solid #f4d12b;
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 10px 14px;
            background: #1a1a2e;
            border: 2px solid #f4d12b;
            border-radius: 5px;
            color: white;
            font-size: 15px;
            outline: none;
        }
        .btn {
            background-color: #f4d12b;
            color: #1a1a2e;
            border: none;
            padding: 10px 16px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #f4d12b; }
        th { color: #f4d12b; }
        .badge-count {
            background: #f4d12b; color: #1a1a2e; font-weight: bold;
            padding: 2px 10px; border-radius: 20px; font-size: 13px;
        }
        .delete-button {
            border: none; background-color: #ff4d4d; color: white;
            padding: 6px 12px; border-radius: 5px; cursor: pointer;
        }
        .accueil-button {
            background-color: #343345; display: inline-block; color: #f4d12b;
            border: none; text-decoration: none; padding: 6px 12px; border-radius: 5px;
        }
        .success { color: #7dff7d; margin-bottom: 14px; }
        .error { color: #ff8080; margin-bottom: 14px; }
    </style>
</head>
<body>

    @include('partials.navbar')

    <div class="page-content">

        <p><a class="accueil-button" href="{{ url('/') }}">← Retour à l'accueil</a></p>

        <div class="titre-container"><span class="titre">Gestion des groupes</span></div>

        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif
        @if($errors->any())
            <p class="error">{{ $errors->first() }}</p>
        @endif

        {{-- Ajouter un groupe --}}
        <div class="card">
            <h3 style="margin-top:0; color:#f4d12b;">Ajouter un groupe</h3>
            <form method="POST" action="{{ route('groupes.store') }}" style="display:flex; gap:10px;">
                @csrf
                <input type="text" name="nom" placeholder="Ex : Avengers, X-Men..." value="{{ old('nom') }}" required>
                <button type="submit" class="btn">+ Ajouter</button>
            </form>
        </div>

        {{-- Liste des groupes --}}
        <div class="card">
            <h3 style="margin-top:0; color:#f4d12b;">Groupes existants</h3>
            <table>
                <thead>
                    <tr><th>Nom</th><th>Personnages</th><th style="text-align:right;">Action</th></tr>
                </thead>
                <tbody>
                    @forelse($groupes as $groupe)
                        <tr>
                            <td>{{ $groupe->nom }}</td>
                            <td><span class="badge-count">{{ $groupe->personnages_count }}</span></td>
                            <td style="text-align:right;">
                                <form method="POST" action="{{ route('groupes.destroy', $groupe->id) }}"
                                      onsubmit="return confirm('Supprimer ce groupe ?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3">Aucun groupe enregistré.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
