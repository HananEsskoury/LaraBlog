@extends('layouts.app')

@section('title', 'À propos – LaraBlog')

@push('styles')
<style>
    .hero {
        position: relative;
        width: 100%;
        height: 60vh;
        min-height: 420px;
        overflow: hidden;
        background: #2c241e;
    }
    .hero-slides { position: relative; width: 100%; height: 100%; }
    .hero-slide {
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 1.2s ease-in-out;
        background-size: cover;
        background-position: center 30%;
        display: flex;
        align-items: flex-end;
    }
    .hero-slide.active { opacity: 1; z-index: 2; }
    .slide-overlay {
        background: linear-gradient(to top, rgba(0,0,0,.65) 0%, rgba(0,0,0,.18) 100%);
        width: 100%;
        padding: 2rem 0 3rem;
    }
    .slide-caption {
        max-width: 600px;
        margin-left: 8%;
        padding: 1rem 1.5rem;
        border-left: 4px solid var(--terracotta);
    }
    .slide-caption h2 {
        font-family: var(--serif);
        font-size: clamp(1.5rem, 4vw, 2.4rem);
        font-weight: 400;
        color: #fff;
        margin-bottom: .4rem;
    }
    .slide-caption p { font-size: .9rem; color: rgba(255,252,240,.9); font-weight: 300; }
    .hero-dots {
        position: absolute;
        bottom: 20px;
        left: 0; right: 0;
        display: flex;
        justify-content: center;
        gap: 10px;
        z-index: 10;
    }
    .dot {
        width: 9px; height: 9px;
        border-radius: 50%;
        background: rgba(255,255,240,.45);
        border: none;
        cursor: pointer;
        transition: all .2s;
        padding: 0;
    }
    .dot.active { background: var(--terracotta); width: 26px; border-radius: 20px; }
    .banner {
        background: var(--warm-off);
        border-bottom: 1px solid var(--border);
        padding: 48px 0 40px;
        text-align: center;
    }
    .eyebrow {
        font-size: .68rem;
        letter-spacing: .2em;
        text-transform: uppercase;
        color: var(--terracotta);
        margin-bottom: 12px;
    }
    .banner h1 {
        font-family: var(--serif);
        font-size: clamp(2.4rem, 5vw, 3.6rem);
        font-weight: 400;
        color: var(--ink);
        margin-bottom: 12px;
    }
    .banner h1 em { color: var(--terracotta); font-style: italic; }
    .banner p { font-size: .88rem; color: var(--muted); max-width: 540px; margin: 0 auto; }
    .three-cols {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        border-top: 3px solid var(--terracotta);
        background: #fff;
    }
    .col-item {
        padding: 2.4rem 2rem;
        border-right: 1px solid var(--border);
        transition: background .2s;
    }
    .col-item:last-child { border-right: none; }
    .col-item:hover { background: var(--warm-off); }
    .col-icon {
        width: 40px; height: 40px;
        border-radius: 10px;
        background: var(--terracotta);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }
    .col-icon svg { width: 18px; height: 18px; stroke: #fff; fill: none; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }
    .col-title { font-family: var(--serif); font-size: 1.4rem; font-weight: 600; color: var(--ink); margin: 0 0 8px; }
    .col-desc { font-size: .8rem; color: var(--muted); line-height: 1.75; }
    .body-wrap { max-width: 1100px; margin: 0 auto; padding: 3.5rem 32px 5rem; }
    .stats-row { display: flex; gap: 2.5rem; margin-bottom: 3.5rem; flex-wrap: wrap; }
    .stat-num { font-family: var(--serif); font-size: 2.6rem; font-weight: 600; color: var(--terracotta); line-height: 1; }
    .stat-label { font-size: .7rem; color: var(--muted); margin-top: 4px; letter-spacing: .1em; text-transform: uppercase; }
    .divider { height: 1px; background: var(--border); margin: 0 0 2.5rem; }
    .sec-header { display: flex; align-items: baseline; gap: 16px; margin: 0 0 1.8rem; }
    .sec-title { font-family: var(--serif); font-size: 1.9rem; font-weight: 400; color: var(--ink); }
    .sec-line { flex: 1; height: 1px; background: var(--border); margin-bottom: 4px; }
    .mission {
        background: var(--warm-off);
        border: 1px solid var(--border);
        border-radius: 4px;
        padding: 2.2rem 2.8rem;
        margin-bottom: 3.5rem;
        position: relative;
        overflow: hidden;
    }
    .mission::before {
        content: '"';
        font-family: var(--serif);
        font-size: 90px;
        color: var(--border);
        position: absolute;
        top: -14px; left: 24px;
        line-height: 1;
    }
    .mission-text {
        font-family: var(--serif);
        font-size: 1.3rem;
        font-style: italic;
        line-height: 1.7;
        color: var(--ink);
        padding-left: .8rem;
    }
    .story-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        margin-bottom: 3.5rem;
        align-items: start;
    }
    .story-img-stack { position: relative; height: 380px; }
    .img-card-back {
        position: absolute;
        width: 55%; right: 0; top: 0;
        aspect-ratio: 3/4;
        border: 1px solid var(--border);
        overflow: hidden;
        border-radius: 4px;
        transform: rotate(4deg);
    }
    .img-card-back img { width: 100%; height: 100%; object-fit: cover; }
    .img-card-front {
        position: absolute;
        width: 60%; left: 0; top: 10%;
        aspect-ratio: 3/4;
        border: 1px solid var(--border);
        overflow: hidden;
        border-radius: 4px;
        box-shadow: 0 8px 24px rgba(42,32,24,.12);
    }
    .img-card-front img { width: 100%; height: 100%; object-fit: cover; }
    .story-text h2 { font-family: var(--serif); font-size: 2rem; font-weight: 400; color: var(--ink); margin-bottom: .5rem; }
    .story-text h3 { font-size: 1.1rem; color: var(--muted); margin-bottom: 1.5rem; font-weight: 300; }
    .story-text p { font-size: .85rem; color: var(--muted); line-height: 1.8; margin-bottom: 1rem; }
    .authors { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 20px; margin-bottom: 3.5rem; }
    .author-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 4px;
        padding: 1.4rem;
        transition: all .25s;
        cursor: pointer;
        text-decoration: none;
        display: block;
        color: inherit;
    }
    .author-card:hover { box-shadow: 0 10px 32px rgba(42,32,24,.1); transform: translateY(-3px); }
    .author-avatar {
        width: 44px; height: 44px;
        border-radius: 50%;
        background: var(--terracotta);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        font-weight: 500;
        margin-bottom: 12px;
        border: 2px solid var(--terracotta);
        overflow: hidden;
    }
    .author-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .author-name { font-family: var(--serif); font-size: 1.1rem; font-weight: 600; color: var(--ink); margin: 0 0 4px; }
    .author-bio { font-size: .78rem; color: var(--muted); margin: 0 0 10px; line-height: 1.5; }
    .author-meta { display: flex; gap: 12px; font-size: .7rem; color: var(--muted); }
    .values { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1.8rem; margin-bottom: 3.5rem; }
    .value { border-left: 3px solid var(--terracotta); padding-left: 16px; }
    .value-title { font-family: var(--serif); font-size: 1.05rem; font-weight: 600; color: var(--ink); margin-bottom: 6px; }
    .value-desc { font-size: .8rem; color: var(--muted); line-height: 1.7; }
    .btn {
        font-size: .73rem;
        font-weight: 500;
        letter-spacing: .1em;
        text-transform: uppercase;
        padding: 11px 26px;
        border-radius: 2px;
        border: 1px solid var(--border);
        cursor: pointer;
        font-family: var(--sans);
        background: transparent;
        color: var(--muted);
        transition: all .2s;
        display: inline-block;
        text-decoration: none;
    }
    .btn:hover { background: var(--warm-off); color: var(--ink); border-color: var(--ink); }
    .btn-primary { background: var(--terracotta); color: #fff; border-color: var(--terracotta); }
    .btn-primary:hover { background: var(--terra-dark); border-color: var(--terra-dark); color: #fff; }
    @media (max-width: 900px) {
        .story-grid { grid-template-columns: 1fr; }
        .story-img-stack { height: 300px; }
    }
    @media (max-width: 700px) {
        .three-cols { grid-template-columns: 1fr; }
        .col-item { border-right: none; border-bottom: 1px solid var(--border); }
        .col-item:last-child { border-bottom: none; }
        .body-wrap { padding: 2rem 16px 3rem; }
        .hero { height: 52vh; }
        .slide-caption { margin-left: 5%; }
    }
</style>
@endpush

@section('content')
<div class="hero">
    <div class="hero-slides" id="slides">
        <div class="hero-slide active" style="background-image:url('https://picsum.photos/id/7/1600/900')">
            <div class="slide-overlay"><div class="slide-caption">
                <h2>Une communauté d'auteurs</h2>
                <p>Des voix indépendantes pour des histoires authentiques.</p>
            </div></div>
        </div>
        <div class="hero-slide" style="background-image:url('https://picsum.photos/id/20/1600/900')">
            <div class="slide-overlay"><div class="slide-caption">
                <h2>L'art d'écrire librement</h2>
                <p>Partagez vos idées sans contrainte, inspirez le monde.</p>
            </div></div>
        </div>
        <div class="hero-slide" style="background-image:url('https://picsum.photos/id/5/1600/900')">
            <div class="slide-overlay"><div class="slide-caption">
                <h2>Good Design is Memorable</h2>
                <p>Une expérience de lecture épurée et élégante.</p>
            </div></div>
        </div>
        <div class="hero-slide" style="background-image:url('https://picsum.photos/id/42/1600/900')">
            <div class="slide-overlay"><div class="slide-caption">
                <h2>Philosophie &amp; Créativité</h2>
                <p>Osez penser différemment, écrivez avec passion.</p>
            </div></div>
        </div>
    </div>
    <div class="hero-dots" id="dots"></div>
</div>

<div class="banner">
    <p class="eyebrow">✦ Philosophie · Design · Créativité</p>
    <h1>About <em>Us</em></h1>
    <p>Good design is making something incredible and memorable — comme chaque auteur qui nous rejoint.</p>
</div>

<div class="three-cols">
    <div class="col-item">
        <div class="col-icon"><svg viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg></div>
        <h3 class="col-title">Professionnel</h3>
        <p class="col-desc">Un processus éditorial rigoureux garantit la qualité de chaque article.</p>
    </div>
    <div class="col-item">
        <div class="col-icon"><svg viewBox="0 0 24 24"><path d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg></div>
        <h3 class="col-title">Créatif</h3>
        <p class="col-desc">Des auteurs aux voix uniques qui osent explorer de nouvelles perspectives.</p>
    </div>
    <div class="col-item">
        <div class="col-icon"><svg viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg></div>
        <h3 class="col-title">Talentueux</h3>
        <p class="col-desc">Une communauté de {{ $stats['auteurs'] }} auteurs passionnés.</p>
    </div>
</div>

<div class="body-wrap">
    <div class="stats-row">
        <div><div class="stat-num">{{ $stats['auteurs'] }}+</div><div class="stat-label">Auteurs actifs</div></div>
        <div><div class="stat-num">{{ $stats['articles'] }}</div><div class="stat-label">Articles publiés</div></div>
        <div><div class="stat-num">{{ $stats['lecteurs'] }}+</div><div class="stat-label">Lecteurs inscrits</div></div>
    </div>
    <div class="divider"></div>
    <div class="mission">
        <p class="mission-text">Nous croyons que chaque perspective mérite d'être entendue. Notre plateforme donne aux auteurs les outils pour publier librement, et aux lecteurs une diversité de points de vue authentiques.</p>
    </div>
    <div class="story-grid">
        <div class="story-img-stack">
            <div class="img-card-back"><img src="https://picsum.photos/id/65/600/800" alt=""></div>
            <div class="img-card-front"><img src="https://picsum.photos/id/64/600/800" alt=""></div>
        </div>
        <div class="story-text">
            <h2>Notre Histoire</h2>
            <h3>Comment LaraBlog est né.</h3>
            <p>Tout a commencé avec une idée simple : créer un espace où les écrivains indépendants peuvent partager leurs idées sans intermédiaire. Un lieu où la qualité prime sur la quantité, et où chaque voix compte.</p>
            <p>Depuis 2021, nous avons accueilli des centaines d'auteurs venus de tous horizons — journalistes, essayistes, poètes, chercheurs. Leur diversité fait notre richesse.</p>
            <p>Notre voyage continue. Avec vous.</p>
            <div style="margin-top:1.5rem; display:flex; gap:10px; flex-wrap:wrap;">
                <a href="{{ route('blog') }}" class="btn btn-primary">Lire les articles</a>
                @guest
                    <a href="{{ route('register') }}" class="btn">Rejoindre la communauté</a>
                @endguest
            </div>
        </div>
    </div>
    <div class="divider"></div>

    @php use App\Models\User; @endphp
    @if($auteurs->count() > 0)
    <div class="sec-header">
        <h2 class="sec-title">Nos auteurs</h2>
        <div class="sec-line"></div>
    </div>
    <div class="authors">
        @foreach($auteurs as $auteur)
        <a href="{{ route('auteur.profile', $auteur->id) }}" class="author-card">
            <div class="author-avatar">
                @if($auteur->avatar)
                    <img src="{{ asset('img/' . $auteur->avatar) }}" alt="{{ $auteur->name }}">
                @else
                    {{ strtoupper(substr($auteur->name, 0, 2)) }}
                @endif
            </div>
            <p class="author-name">{{ $auteur->name }}</p>
            <p class="author-bio">{{ \Illuminate\Support\Str::limit($auteur->bio ?? 'Auteur sur LaraBlog', 80) }}</p>
            <div class="author-meta">
                <span>📄 {{ $auteur->posts_count }} article{{ $auteur->posts_count > 1 ? 's' : '' }}</span>
                <span>👥 {{ $auteur->followers_count }} abonné{{ $auteur->followers_count > 1 ? 's' : '' }}</span>
            </div>
        </a>
        @endforeach
    </div>
    <div style="text-align: center; margin-top: 2rem;">
        <a href="{{ route('authors.all') }}" class="btn btn-primary" style="min-width: 200px;">
            Voir tous nos auteurs ({{ $totalAuteurs }})
            <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
        </a>
    </div>
    @endif

    <div class="divider"></div>
    <div class="sec-header">
        <h2 class="sec-title">Ce qui nous guide</h2>
        <div class="sec-line"></div>
    </div>
    <div class="values">
        <div class="value">
            <div class="value-title">Indépendance éditoriale</div>
            <div class="value-desc">Chaque auteur publie librement, sans censure ni pression commerciale.</div>
        </div>
        <div class="value">
            <div class="value-title">Qualité avant quantité</div>
            <div class="value-desc">Un processus de révision rigoureux pour des articles qui durent.</div>
        </div>
        <div class="value">
            <div class="value-title">Diversité des voix</div>
            <div class="value-desc">Des auteurs de tous horizons, disciplines et cultures.</div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const slides = document.querySelectorAll('.hero-slide');
    const dotsWrap = document.getElementById('dots');
    let cur = 0, iv;
    slides.forEach((_, i) => {
        const d = document.createElement('button');
        d.className = 'dot' + (i === 0 ? ' active' : '');
        d.onclick = () => go(i);
        dotsWrap.appendChild(d);
    });
    function go(n) {
        slides[cur].classList.remove('active');
        dotsWrap.children[cur].classList.remove('active');
        cur = n;
        slides[cur].classList.add('active');
        dotsWrap.children[cur].classList.add('active');
        reset();
    }
    function next() { go((cur + 1) % slides.length); }
    function reset() { clearInterval(iv); iv = setInterval(next, 4000); }
    reset();
    function toggleNotifs() {
        const d = document.getElementById('notifDropdown');
        const a = document.getElementById('avatarDropdown');
        if (a) a.style.display = 'none';
        if(d) d.style.display = d.style.display === 'none' ? 'block' : 'none';
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
        if (!e.target.closest('#notifWrap')) {
            const d = document.getElementById('notifDropdown');
            if (d) d.style.display = 'none';
        }
    });
</script>
@endpush