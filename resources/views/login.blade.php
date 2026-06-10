<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin – Marvel Rivals</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
 
        body {
            background-color: #1a1a2e;
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-family: sans-serif;
        }
 
        .login-card {
            background: #33334b;
            border: 3px solid #f4d12b;
            border-radius: 8px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
        }
 
        .login-logo {
            text-align: center;
            margin-bottom: 24px;
        }
 
        .login-logo img {
            width: 160px;
        }
 
        h1 {
            text-align: center;
            color: #f4d12b;
            font-size: 22px;
            margin-bottom: 28px;
        }
 
        label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            color: #ccc;
        }
 
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px 14px;
            background: #1a1a2e;
            border: 2px solid #f4d12b;
            border-radius: 5px;
            color: white;
            font-size: 15px;
            margin-bottom: 18px;
            outline: none;
            transition: border-color 0.2s;
        }
 
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #fff;
        }
 
        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 22px;
            font-size: 14px;
            color: #ccc;
        }
 
        .btn-login {
            width: 100%;
            background-color: #f4d12b;
            color: #1a1a2e;
            border: none;
            padding: 12px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s;
        }
 
        .btn-login:hover {
            background-color: #e0be1a;
        }
 
        .error-msg {
            background: rgba(255, 77, 77, 0.15);
            border: 1px solid #ff4d4d;
            border-radius: 5px;
            padding: 10px 14px;
            margin-bottom: 18px;
            font-size: 14px;
            color: #ff8080;
        }
 
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #f4d12b;
            text-decoration: none;
            font-size: 14px;
        }
 
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
 
<div class="login-card">
    <div class="login-logo">
        <img src="/images/Logo_Marvel_Rivals.png" alt="Marvel Rivals">
    </div>
 
    <h1>Espace Administrateur</h1>
 
    @if ($errors->any())
        <div class="error-msg">
            {{ $errors->first() }}
        </div>
    @endif
 
    @if (session('success'))
        <div style="color: #7dff7d; margin-bottom: 14px; font-size:14px;">
            {{ session('success') }}
        </div>
    @endif
 
    <form method="POST" action="{{ route('login.post') }}">
        @csrf
 
        <label for="name">Identifiant</label>
        <input type="text" id="name" name="name"
               value="{{ old('name') }}"
               placeholder="Identifiant"
               autocomplete="username" required>
 
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password"
               placeholder="••••••••"
               autocomplete="current-password" required>
 
        <button type="submit" class="btn-login">Se connecter</button>
    </form>
 
    <a href="{{ url('/') }}" class="back-link">← Retour au wiki</a>
</div>
 
</body>
</html>