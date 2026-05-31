<nav x-data="{ open: false }">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet"/>

<style>
.topnav {
    background: #2a2018;
    border-bottom: 1px solid rgba(255,255,255,.07);
    font-family: 'Jost', sans-serif;
    position: sticky;
    top: 0;
    z-index: 100;
}
.nav-inner {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 32px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 60px;
}
.nav-left { display: flex; align-items: center; }
.nav-logo {
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-size: 1.4rem;
    font-weight: 600;
    color: #f0d4c4;
    text-decoration: none;
    letter-spacing: -.3px;
}
.nav-logo em { font-style: italic; color: #c0623a; }
.nav-right { display: flex; align-items: center; gap: 6px; }
.nav-home {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 400;
    color: rgba(255,255,255,.55);
    text-decoration: none;
    transition: all .18s;
    letter-spacing: .02em;
}
.nav-home:hover { background: rgba(255,255,255,.07); color: rgba(255,255,255,.9); }
.nav-home svg { width: 15px; height: 15px; }
.notif-wrap { position: relative; }
.notif-btn {
    background: none;
    border: none;
    cursor: pointer;
    position: relative;
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgba(255,255,255,.5);
    transition: all .18s;
}
.notif-btn:hover { background: rgba(255,255,255,.07); color: rgba(255,255,255,.9); }
.notif-btn svg { width: 18px; height: 18px; }
.notif-badge {
    position: absolute;
    top: 4px; right: 4px;
    background: #c0623a;
    color: #fff;
    border-radius: 50%;
    width: 16px; height: 16px;
    font-size: 9px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1;
    border: 2px solid #2a2018;
}
.notif-dropdown {
    display: none;
    position: absolute;
    right: 0;
    top: calc(100% + 10px);
    width: 320px;
    background: #fff;
    border-radius: 14px;
    border: 1px solid #e2d8cc;
    box-shadow: 0 12px 32px rgba(0,0,0,.2);
    z-index: 999;
    overflow: hidden;
}
.notif-header {
    padding: 14px 18px;
    border-bottom: 1px solid #f0ebe3;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #f3ebe0;
}
.notif-header-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1rem;
    font-weight: 600;
    color: #2a2018;
}
.notif-mark-all {
    font-size: 11px;
    color: #c0623a;
    font-weight: 500;
    text-decoration: none;
    padding: 4px 10px;
    border-radius: 20px;
    transition: background .2s;
    font-family: 'Jost', sans-serif;
    letter-spacing: .04em;
}
.notif-mark-all:hover { background: #f0d4c4; }
.notif-item {
    display: block;
    padding: 13px 18px;
    font-size: 13px;
    text-decoration: none;
    color: #2a2018;
    border-bottom: 1px solid #f7f3ee;
    transition: background .15s;
    line-height: 1.4;
    font-family: 'Jost', sans-serif;
    font-weight: 300;
}
.notif-item:hover { background: #faf6f1; }
.notif-item.unread { background: #fdf6e3; }
.notif-item.unread:hover { background: #fbefd0; }
.notif-item.unread-blue { background: #f3ebe0; }
.notif-item.unread-blue:hover { background: #ede0cc; }
.notif-time {
    font-size: 11px;
    color: #7a6a58;
    margin-top: 4px;
    display: block;
}
.notif-empty {
    padding: 24px;
    text-align: center;
    color: #7a6a58;
    font-size: 13px;
    font-family: 'Jost', sans-serif;
    font-weight: 300;
}
.profile-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 5px 12px 5px 6px;
    border-radius: 9px;
    border: 1px solid rgba(255,255,255,.1);
    background: rgba(255,255,255,.05);
    cursor: pointer;
    font-size: 13px;
    font-weight: 400;
    color: rgba(255,255,255,.75);
    transition: all .18s;
    position: relative;
    font-family: 'Jost', sans-serif;
    letter-spacing: .02em;
}
.profile-btn:hover { background: rgba(255,255,255,.1); border-color: rgba(255,255,255,.18); color: #fff; }
.profile-avatar {
    width: 28px; height: 28px;
    border-radius: 7px;
    object-fit: cover;
}
.profile-avatar-placeholder {
    width: 28px; height: 28px;
    border-radius: 7px;
    background: #c0623a;
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Jost', sans-serif;
}
.profile-dropdown {
    display: none;
    position: absolute;
    right: 0;
    top: calc(100% + 8px);
    width: 180px;
    background: #fff;
    border-radius: 12px;
    border: 1px solid #e2d8cc;
    box-shadow: 0 8px 24px rgba(42,32,24,.2);
    z-index: 999;
    overflow: hidden;
    padding: 6px;
}
.profile-drop-link {
    display: block;
    padding: 8px 12px;
    font-size: 13px;
    color: #2a2018;
    text-decoration: none;
    border-radius: 7px;
    transition: background .15s;
    font-family: 'Jost', sans-serif;
    font-weight: 400;
}
.profile-drop-link:hover { background: #f3ebe0; color: #2a2018; }
.profile-drop-link.danger { color: #b83a3a; }
.profile-drop-link.danger:hover { background: #fdf0f0; }
.nav-sep {
    width: 1px;
    height: 20px;
    background: rgba(255,255,255,.1);
    margin: 0 4px;
}
.hamburger {
    display: none;
    background: none;
    border: none;
    cursor: pointer;
    color: rgba(255,255,255,.6);
    padding: 6px;
    border-radius: 7px;
    transition: background .2s;
}
.hamburger:hover { background: rgba(255,255,255,.07); }
.mobile-menu {
    border-top: 1px solid rgba(255,255,255,.07);
    padding: 12px 20px 16px;
    background: #2a2018;
}
.mobile-link {
    display: block;
    padding: 8px 12px;
    font-size: 13px;
    color: rgba(255,255,255,.55);
    text-decoration: none;
    border-radius: 7px;
    transition: background .15s;
    margin-bottom: 2px;
    font-family: 'Jost', sans-serif;
    font-weight: 400;
    letter-spacing: .02em;
}
.mobile-link:hover { background: rgba(255,255,255,.07); color: rgba(255,255,255,.9); }
.mobile-user {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px;
    margin-top: 8px;
    border-top: 1px solid rgba(255,255,255,.07);
}
@media (max-width: 640px) {
    .nav-right { display: none; }
    .hamburger { display: flex; align-items: center; justify-content: center; }
}
</style>

<div class="topnav">
<div class="nav-inner">

    <div class="nav-left">
        @if(Auth::check() && Auth::user()->usertype=='admin')
            <a href="{{ route('admin.dashboard') }}" class="nav-logo">Lara<em>Blog</em></a>
        @elseif(Auth::check() && Auth::user()->usertype=='auteur')
            <a href="{{ route('auteur.dashboard') }}" class="nav-logo">Lara<em>Blog</em></a>
        @else
            <a href="{{ route('home') }}" class="nav-logo">Lara<em>Blog</em></a>
        @endif
    </div>

    @auth
    <div class="nav-right">

        @if(Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'auteur')

            <!-- Cloche admin/auteur -->
            <div class="notif-wrap">
                <button class="notif-btn" onclick="toggleNotifs()" type="button">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <span class="notif-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                    @endif
                </button>
                <div class="notif-dropdown" id="notifDropdown">
                    <div class="notif-header">
                        <span class="notif-header-title">Notifications</span>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <a href="{{ route('notifications.readAll') }}" class="notif-mark-all">Tout marquer lu</a>
                        @endif
                    </div>
                    @forelse(auth()->user()->notifications->take(8) as $notif)
                        @if(isset($notif->data['reactor_name']))
                            <a href="{{ route('fullpost', $notif->data['post_id']) }}"
                               onclick="markRead('{{ $notif->id }}')"
                               class="notif-item {{ $notif->read_at ? '' : 'unread-blue' }}">
                                {{ $notif->data['emoji'] }}
                                <strong>{{ $notif->data['reactor_name'] }}</strong>
                                a réagi à <em>{{ $notif->data['post_title'] }}</em>
                                <span class="notif-time">{{ $notif->created_at->diffForHumans() }}</span>
                            </a>
                        @elseif(isset($notif->data['commenter']))
                            <a href="{{ route('fullpost', $notif->data['post_id']) }}"
                               onclick="markRead('{{ $notif->id }}')"
                               class="notif-item {{ $notif->read_at ? '' : 'unread-blue' }}">
                                💬 <strong>{{ $notif->data['commenter'] }}</strong>
                                a commenté <em>{{ $notif->data['post_title'] }}</em>
                                <span class="notif-time">{{ $notif->created_at->diffForHumans() }}</span>
                            </a>
                        @elseif(isset($notif->data['author_name']))
                            <a href="{{ route('fullpost', $notif->data['post_id']) }}"
                               onclick="markRead('{{ $notif->id }}')"
                               class="notif-item {{ $notif->read_at ? '' : 'unread-blue' }}">
                                📝 <strong>{{ $notif->data['author_name'] }}</strong>
                                a publié <em>{{ $notif->data['post_title'] }}</em>
                                <span class="notif-time">{{ $notif->created_at->diffForHumans() }}</span>
                            </a>
                        @elseif(isset($notif->data['message']))
                            <a href="{{ $notif->data['url'] ?? '#' }}"
                               onclick="markRead('{{ $notif->id }}')"
                               class="notif-item {{ $notif->read_at ? '' : 'unread' }}">
                                🔔 {{ $notif->data['message'] }}
                                <span class="notif-time">{{ $notif->created_at->diffForHumans() }}</span>
                            </a>
                        @endif
                    @empty
                        <div class="notif-empty">Aucune notification</div>
                    @endforelse
                </div>
            </div>

            <!-- Avatar + nom (admin/auteur — sans dropdown) -->
            <div style="display:inline-flex;align-items:center;gap:8px;padding:5px 12px 5px 6px;
                        border-radius:9px;border:1px solid rgba(255,255,255,.1);
                        background:rgba(255,255,255,.05);">
                @if(Auth::user()->avatar)
                    <img src="{{ asset('img/' . Auth::user()->avatar) }}" class="profile-avatar" alt="avatar">
                @else
                    <div class="profile-avatar-placeholder">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                @endif
                <span style="font-size:13px;font-weight:400;color:rgba(255,255,255,.75);
                             font-family:'Jost',sans-serif;letter-spacing:.02em;">
                    {{ Auth::user()->name }}
                </span>
            </div>

        @else

            <!-- Accueil (utilisateur simple) -->
            <a href="{{ route('home') }}" class="nav-home">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Accueil
            </a>

            <div class="nav-sep"></div>

            <!-- Cloche utilisateur simple -->
            <div class="notif-wrap">
                <button class="notif-btn" onclick="toggleNotifs()" type="button">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <span class="notif-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                    @endif
                </button>
                <div class="notif-dropdown" id="notifDropdown">
                    <div class="notif-header">
                        <span class="notif-header-title">Notifications</span>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <a href="{{ route('notifications.readAll') }}" class="notif-mark-all">Tout marquer lu</a>
                        @endif
                    </div>
                    @forelse(auth()->user()->notifications->take(8) as $notif)
                        @if(isset($notif->data['reactor_name']))
                            <a href="{{ route('fullpost', $notif->data['post_id']) }}"
                               onclick="markRead('{{ $notif->id }}')"
                               class="notif-item {{ $notif->read_at ? '' : 'unread-blue' }}">
                                {{ $notif->data['emoji'] }}
                                <strong>{{ $notif->data['reactor_name'] }}</strong>
                                a réagi à <em>{{ $notif->data['post_title'] }}</em>
                                <span class="notif-time">{{ $notif->created_at->diffForHumans() }}</span>
                            </a>
                        @elseif(isset($notif->data['commenter']))
                            <a href="{{ route('fullpost', $notif->data['post_id']) }}"
                               onclick="markRead('{{ $notif->id }}')"
                               class="notif-item {{ $notif->read_at ? '' : 'unread-blue' }}">
                                💬 <strong>{{ $notif->data['commenter'] }}</strong>
                                a commenté <em>{{ $notif->data['post_title'] }}</em>
                                <span class="notif-time">{{ $notif->created_at->diffForHumans() }}</span>
                            </a>
                        @elseif(isset($notif->data['author_name']))
                            <a href="{{ route('fullpost', $notif->data['post_id']) }}"
                               onclick="markRead('{{ $notif->id }}')"
                               class="notif-item {{ $notif->read_at ? '' : 'unread-blue' }}">
                                📝 <strong>{{ $notif->data['author_name'] }}</strong>
                                a publié <em>{{ $notif->data['post_title'] }}</em>
                                <span class="notif-time">{{ $notif->created_at->diffForHumans() }}</span>
                            </a>
                        @elseif(isset($notif->data['message']))
                            <a href="{{ $notif->data['url'] ?? '#' }}"
                               onclick="markRead('{{ $notif->id }}')"
                               class="notif-item {{ $notif->read_at ? '' : 'unread' }}">
                                🔔 {{ $notif->data['message'] }}
                                <span class="notif-time">{{ $notif->created_at->diffForHumans() }}</span>
                            </a>
                        @endif
                    @empty
                        <div class="notif-empty">Aucune notification</div>
                    @endforelse
                </div>
            </div>

            <!-- Profil avec dropdown (utilisateur simple) -->
            <div class="notif-wrap">
                <button class="profile-btn" onclick="toggleProfile()" type="button">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('img/' . Auth::user()->avatar) }}" alt="avatar" class="profile-avatar">
                    @else
                        <div class="profile-avatar-placeholder">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    @endif
                    {{ Auth::user()->name }}
                    <svg style="width:12px;height:12px;color:rgba(255,255,255,.3);margin-left:2px;"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="profile-dropdown" id="profileDropdown">
                    <a href="{{ route('profile.show') }}" class="profile-drop-link">👤 Profil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="profile-drop-link danger"
                                style="width:100%;text-align:left;border:none;background:none;
                                       cursor:pointer;font-family:'Jost',sans-serif;">
                            🚪 Déconnexion
                        </button>
                    </form>
                </div>
            </div>

        @endif

    </div>
    @endauth

    <!-- Hamburger mobile -->
    <button class="hamburger" @click="open = !open" type="button">
        <svg style="width:20px;height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"/>
            <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

</div>
</div>

<!-- Mobile menu -->
<div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden mobile-menu">
    @if(Auth::check() && Auth::user()->usertype=='admin')
        <a href="{{ route('admin.dashboard') }}" class="mobile-link">Dashboard</a>
        <a href="{{ route('home') }}" class="mobile-link">Accueil</a>
    @elseif(Auth::check() && Auth::user()->usertype=='auteur')
        <a href="{{ route('auteur.dashboard') }}" class="mobile-link">Dashboard</a>
        <a href="{{ route('auteur.addpost') }}" class="mobile-link">Ajouter un article</a>
        <a href="{{ route('home') }}" class="mobile-link">Accueil</a>
    @endif

    @auth
    <div class="mobile-user">
        @if(Auth::user()->avatar)
            <img src="{{ asset('img/' . Auth::user()->avatar) }}"
                 style="width:36px;height:36px;border-radius:8px;object-fit:cover;" alt="avatar">
        @else
            <div style="width:36px;height:36px;border-radius:8px;background:#c0623a;color:#fff;
                        display:flex;align-items:center;justify-content:center;
                        font-size:13px;font-weight:700;font-family:'Jost',sans-serif;">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        @endif
        <div>
            <div style="font-size:13px;font-weight:500;color:rgba(255,255,255,.85);font-family:'Jost',sans-serif;">
                {{ Auth::user()->name }}
            </div>
            <div style="font-size:11px;color:rgba(255,255,255,.35);font-family:'Jost',sans-serif;">
                {{ Auth::user()->email }}
            </div>
        </div>
    </div>

    @if(Auth::user()->usertype != 'admin' && Auth::user()->usertype != 'auteur')
        <a href="{{ route('profile.show') }}" class="mobile-link">👤 Profil</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="mobile-link"
                    style="width:100%;text-align:left;border:none;background:none;
                           cursor:pointer;color:#c0623a;font-family:'Jost',sans-serif;font-size:13px;">
                🚪 Déconnexion
            </button>
        </form>
    @endif
    @endauth
</div>

<script>
function toggleNotifs() {
    const d = document.getElementById('notifDropdown');
    const p = document.getElementById('profileDropdown');
    if (p) p.style.display = 'none';
    if (d) d.style.display = d.style.display === 'none' ? 'block' : 'none';
}
function toggleProfile() {
    const p = document.getElementById('profileDropdown');
    const d = document.getElementById('notifDropdown');
    if (d) d.style.display = 'none';
    if (p) p.style.display = p.style.display === 'none' ? 'block' : 'none';
}
function markRead(id) {
    fetch(`/notifications/${id}/read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    });
}
document.addEventListener('click', function(e) {
    const notifDrop = document.getElementById('notifDropdown');
    const profileDrop = document.getElementById('profileDropdown');
    if (notifDrop && !e.target.closest('.notif-wrap')) notifDrop.style.display = 'none';
    if (profileDrop && !e.target.closest('.notif-wrap')) profileDrop.style.display = 'none';
});
</script>
</nav>