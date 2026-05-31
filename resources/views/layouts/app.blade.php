<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LaraBlog')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400;1,600&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @stack('styles')
    <style>
        :root {
            --cream: #faf6f1;
            --warm-off: #f3ebe0;
            --terracotta: #c0623a;
            --terra-dark: #9e4b28;
            --ink: #2a2018;
            --muted: #7a6a58;
            --border: #e2d8cc;
            --serif: 'Cormorant Garamond', Georgia, serif;
            --sans: 'Jost', sans-serif;
            --content-width: 1290px;
            --edge-padding: 3rem;
            --section-gap-xl: 5rem;
            --section-gap-lg: 4rem;
            --section-gap-md: 3rem;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body { background: var(--cream); color: var(--ink); font-family: var(--sans); font-weight: 300; line-height: 1.7; }
        a { text-decoration: none; color: inherit; }
        img { display: block; width: 100%; object-fit: cover; }
        .container { max-width: var(--content-width); margin: 0 auto; padding: 0 var(--edge-padding); }

        /* ── HEADER ── */
        header {
            position: sticky; top: 0; z-index: 100;
            background: var(--cream);
            border-bottom: 1px solid var(--border);
            box-shadow: 0 2px 12px rgba(42,32,24,.06);
        }
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
            padding: 18px 0;
            flex-wrap: wrap;
        }
        
        /* Logo styles */
        .logo {
            display: inline-block;
            text-decoration: none;
            line-height: 1;
            flex-shrink: 0;
        }
        .logo svg {
            max-width: 220px;
            height: auto;
            display: block;
        }
        
        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }
        .nav-links a {
            font-size: .78rem;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--muted);
            transition: color .2s;
            text-decoration: none;
        }
        .nav-links a:hover, .nav-links a.active { color: var(--terracotta); }

        /* Avatar dropdown */
        .avatar-dropdown { position: relative; display: inline-block; }
        .avatar-trigger {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            gap: 2px;
        }
        .avatar-trigger img, .avatar-initials {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 2px solid var(--terracotta);
            object-fit: cover;
        }
        .avatar-initials {
            background: var(--terracotta);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 500;
            font-size: 13px;
        }
        .avatar-trigger span { font-size: 10px; color: var(--muted); letter-spacing: .05em; }
        #avatarDropdown {
            display: none;
            position: absolute;
            right: 0;
            top: calc(100% + 8px);
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 32px rgba(42,32,24,.12);
            min-width: 150px;
            z-index: 999;
            overflow: hidden;
        }
        #avatarDropdown a {
            display: block;
            padding: 12px 16px;
            font-size: .8rem;
            color: var(--ink);
            border-bottom: 1px solid var(--border);
            text-decoration: none;
        }
        #avatarDropdown a:hover { background: var(--warm-off); }
        #avatarDropdown form button {
            width: 100%;
            text-align: left;
            padding: 12px 16px;
            font-size: .8rem;
            color: #c0392b;
            background: none;
            border: none;
            cursor: pointer;
            font-family: var(--sans);
        }
        #avatarDropdown form button:hover { background: #fff5f5; }

        /* Notifications */
        #notifWrap { position: relative; display: inline-block; }
        .notif-btn {
            background: none;
            border: none;
            cursor: pointer;
            position: relative;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted);
            border-radius: 8px;
            transition: background .2s;
        }
        .notif-btn:hover { background: var(--warm-off); }
        .notif-badge {
            position: absolute;
            top: 4px;
            right: 4px;
            background: #ef4444;
            color: #fff;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            font-size: 9px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--cream);
        }
        #notifDropdown {
            display: none;
            position: absolute;
            right: 0;
            top: calc(100% + 10px);
            width: 300px;
            background: #fff;
            border-radius: 12px;
            border: 1px solid var(--border);
            box-shadow: 0 12px 32px rgba(42,32,24,.12);
            z-index: 999;
            overflow: hidden;
        }
        .notif-header {
            padding: 12px 16px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .notif-header-title { font-family: var(--serif); font-size: 14px; font-weight: 600; color: var(--ink); }
        .notif-mark-all { font-size: 11px; color: var(--terracotta); text-decoration: none; }
        .notif-item {
            display: block;
            padding: 12px 16px;
            font-size: 13px;
            text-decoration: none;
            color: var(--ink);
            border-bottom: 1px solid #f9f9f9;
        }
        .notif-item.unread { background: #f0f9ff; }
        .notif-time { display: block; font-size: 11px; color: #aaa; margin-top: 3px; }
        .notif-empty { padding: 24px; text-align: center; color: #aaa; font-size: 13px; }

        /* FOOTER */
        footer {
            background: var(--ink);
            color: rgba(255,255,255,.55);
            padding: 64px 0 32px;
            margin-top: 48px;
        }
        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 48px;
            margin-bottom: 48px;
        }
        .footer-column h3 {
            font-family: var(--serif);
            font-size: 1.1rem;
            font-weight: 400;
            color: #fff;
            margin-bottom: 16px;
        }
        .footer-column p { font-size: .83rem; line-height: 1.8; }
        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 10px; }
        .footer-links a { font-size: .83rem; transition: color .2s; text-decoration: none; color: rgba(255,255,255,.55); }
        .footer-links a:hover { color: var(--terracotta); }
        .social-links {
            display: flex;
            gap: 14px;
            margin-top: 20px;
        }
        .social-links a {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
            color: rgba(255,255,255,.55);
            transition: background .2s, color .2s, border-color .2s;
            text-decoration: none;
        }
        .social-links a:hover { background: var(--terracotta); color: #fff; border-color: var(--terracotta); }
        .copyright {
            border-top: 1px solid rgba(255,255,255,.1);
            padding-top: 24px;
            font-size: .75rem;
            letter-spacing: .06em;
            text-align: center;
        }
        .footer-cats {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            list-style: none;
        }
        .footer-cat-tag {
            padding: 6px 14px;
            border: 1px solid rgba(255,255,255,.2);
            border-radius: 100px;
            font-size: .72rem;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: rgba(255,255,255,.55);
            transition: all .2s;
            text-decoration: none;
            display: inline-block;
        }
        .footer-cat-tag:hover { background: var(--terracotta); color: #fff; border-color: var(--terracotta); }

        @media (max-width: 1024px) {
            .navbar { flex-direction: column; align-items: stretch; }
            .nav-links { justify-content: center; flex-wrap: wrap; }
        }
        @media (max-width: 768px) {
            .footer-content { grid-template-columns: 1fr; }
            :root { --edge-padding: 1.5rem; }
            .logo svg { max-width: 160px; }
        }
    </style>
</head>
<body>

<!-- HEADER -->
<header>
    <div class="container">
        <nav class="navbar">
            <x-logo />
            <div class="nav-links">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('blog') }}" class="{{ request()->routeIs('blog') ? 'active' : '' }}">Blog</a>
                <a href="{{ route('authors.all') }}" class="{{ request()->routeIs('authors.all') ? 'active' : '' }}">Auteurs</a>
                <a href="{{ route('categories.all') }}" class="{{ request()->routeIs('categories.all') ? 'active' : '' }}">Catégories</a>
                @auth
                    <a href="{{ route('favorites.index') }}" class="{{ request()->routeIs('favorites.index') ? 'active' : '' }}">Mes favoris</a>
                @endauth
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>

                @if (Route::has('login'))
                    @auth
                        @if(Auth::user()->usertype == 'admin')
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        @elseif(Auth::user()->usertype == 'auteur')
                            <a href="{{ route('auteur.dashboard') }}">Dashboard</a>
                        @endif

                        @if(Auth::user()->usertype == 'user')
                        <div id="notifWrap">
                            <button onclick="toggleNotifs()" type="button" class="notif-btn">
                                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <span class="notif-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                                @endif
                            </button>
                            <div id="notifDropdown">
                                <div class="notif-header">
                                    <span class="notif-header-title">Notifications</span>
                                    @if(auth()->user()->unreadNotifications->count() > 0)
                                        <a href="{{ route('notifications.readAll') }}" class="notif-mark-all">Tout marquer lu</a>
                                    @endif
                                </div>
                                @forelse(auth()->user()->notifications->take(8) as $notif)
                                    @if(isset($notif->data['author_name']))
                                        <a href="{{ route('fullpost', $notif->data['post_id']) }}" onclick="markRead('{{ $notif->id }}')" class="notif-item {{ !$notif->read_at ? 'unread' : '' }}">
                                            📝 <strong>{{ $notif->data['author_name'] }}</strong> a publié <em>{{ $notif->data['post_title'] }}</em>
                                            <span class="notif-time">{{ $notif->created_at->diffForHumans() }}</span>
                                        </a>
                                    @elseif(isset($notif->data['commenter']))
                                        <a href="{{ route('fullpost', $notif->data['post_id']) }}" onclick="markRead('{{ $notif->id }}')" class="notif-item {{ !$notif->read_at ? 'unread' : '' }}">
                                            💬 <strong>{{ $notif->data['commenter'] }}</strong> a commenté <em>{{ $notif->data['post_title'] }}</em>
                                            <span class="notif-time">{{ $notif->created_at->diffForHumans() }}</span>
                                        </a>
                                    @endif
                                @empty
                                    <div class="notif-empty">Aucune notification</div>
                                @endforelse
                            </div>
                        </div>
                        @endif

                        <!-- Avatar -->
                        <div class="avatar-dropdown">
                            <div class="avatar-trigger" onclick="toggleDropdown()">
                                @if(Auth::user()->avatar)
                                    <img src="{{ asset('img/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                                @else
                                    <div class="avatar-initials">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                                @endif
                                <span>{{ Auth::user()->name }}</span>
                            </div>
                            <div id="avatarDropdown">
                                @if(Auth::user()->usertype == 'auteur')
                                    <a href="{{ route('auteur.profile', auth()->id()) }}">Mon profil</a>
                                @else
                                    <a href="{{ route('profile.show') }}">Mon profil</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit">Déconnexion</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}">Connexion</a>
                    @endauth
                @endif
            </div>
        </nav>
    </div>
</header>

<main>
    @yield('content')
</main>

<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="footer-content">
            <div class="footer-column">
                <h3>À propos de LaraBlog</h3>
                <p>Nous sommes une communauté d'auteurs indépendants réunis autour d'un objectif commun : partager des idées claires, des analyses profondes et des récits qui comptent.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-github"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Liens rapides</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Accueil</a></li>
                    <li><a href="{{ route('blog') }}">Blog</a></li>
                    <li><a href="{{ route('about') }}">À propos</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Catégories</h3>
                <ul class="footer-cats">
                    @foreach(\App\Models\Categorie::take(10)->get() as $category)
                    <li>
                        <a href="/category/{{ $category->slug }}" class="footer-cat-tag">
                            {{ $category->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; {{ date('Y') }} LaraBlog. Tous droits réservés. Propulsé par Laravel.</p>
        </div>
    </div>
</footer>

<script>
    function toggleDropdown() {
        const d = document.getElementById('avatarDropdown');
        if(d) d.style.display = d.style.display === 'none' ? 'block' : 'none';
    }
    function toggleNotifs() {
        const d = document.getElementById('notifDropdown');
        const a = document.getElementById('avatarDropdown');
        if (a) a.style.display = 'none';
        if(d) d.style.display = d.style.display === 'none' ? 'block' : 'none';
    }
    function markRead(id) {
        fetch(`/notifications/${id}/read`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
        });
    }
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.avatar-dropdown')) {
            const d = document.getElementById('avatarDropdown');
            if(d) d.style.display = 'none';
        }
        if (!e.target.closest('#notifWrap')) {
            const d = document.getElementById('notifDropdown');
            if(d) d.style.display = 'none';
        }
    });
</script>

@stack('scripts')
</body>
</html>