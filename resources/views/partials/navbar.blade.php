<nav style="
    background: #1a1a2e;
    border-bottom: 3px solid #f4d12b;
    padding: 10px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 0;
    z-index: 100;
    font-family: sans-serif;
">
    {{-- Logo / lien accueil --}}
    <a href="{{ url('/') }}" style="display:flex; align-items:center; gap:10px; text-decoration:none;">
        <img src="/images/Logo_Marvel_Rivals.png" alt="Marvel Rivals" style="height:36px;">
        <span style="color:#f4d12b; font-weight:bold; font-size:18px;">Marvel Rivals Wiki</span>
    </a>

    {{-- Droite de la navbar --}}
    <div style="display:flex; align-items:center; gap:14px;">

        @auth
            {{-- Badge admin --}}
            <span style="
                background:#f4d12b;
                color:#1a1a2e;
                font-weight:bold;
                font-size:13px;
                padding:3px 10px;
                border-radius:20px;
            ">Admin : {{ Auth::user()->name }}</span>

            {{-- Ajouter un personnage --}}
            <a href="{{ url('/personnage') }}" style="
                color:#f4d12b;
                text-decoration:none;
                font-size:14px;
                border:2px solid #f4d12b;
                padding:5px 12px;
                border-radius:5px;
                transition:background 0.2s;
            " onmouseover="this.style.background='#f4d12b';this.style.color='#1a1a2e'"
               onmouseout="this.style.background='transparent';this.style.color='#f4d12b'">
                + Personnage
            </a>

            {{-- Déconnexion --}}
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" style="
                    background:transparent;
                    border:2px solid #ff4d4d;
                    color:#ff4d4d;
                    padding:5px 12px;
                    border-radius:5px;
                    cursor:pointer;
                    font-size:14px;
                    transition:background 0.2s;
                " onmouseover="this.style.background='#ff4d4d';this.style.color='white'"
                   onmouseout="this.style.background='transparent';this.style.color='#ff4d4d'">
                    Déconnexion
                </button>
            </form>
        @else
            {{-- Connexion admin --}}
            <a href="{{ route('login') }}" style="
                color:#f4d12b;
                text-decoration:none;
                font-size:14px;
                border:2px solid #f4d12b;
                padding:5px 14px;
                border-radius:5px;
                transition:background 0.2s;
            " onmouseover="this.style.background='#f4d12b';this.style.color='#1a1a2e'"
               onmouseout="this.style.background='transparent';this.style.color='#f4d12b'">
                Connexion Admin
            </a>
        @endauth

    </div>
</nav>
