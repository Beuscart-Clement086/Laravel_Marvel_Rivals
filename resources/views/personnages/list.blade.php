<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    @if ($personnages->count() > 0)
            <div class="row">
                @foreach ($personnages as $personnage)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="card-title">{{ $personnage->nom }}</h5>
                                <p class="card-text small text-muted">
                                    Espèce : {{ $personnage->role ?? 'N/A' }}
                                </p>
                                <p class="card-text">
                                    Classe : <span>{{ $personnage->classe->nom ?? 'N/A' }}</span>
                                    <br>
                                    Description : {{ Str::limit($personnage->description_courte, 100) }}
                                </p>

                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-warning text-center" role="alert">
                Aucun personnage trouvé dans la base de données.
            </div>
        @endif
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>