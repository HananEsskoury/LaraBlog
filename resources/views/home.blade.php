@extends('layouts.app')

@section('title', 'LaraBlog - Accueil')

@push('styles')
<style>
    /* Vos styles spécifiques à la page d'accueil uniquement */
    
    .hero-full {
        position: relative;
        width: 100%;
        min-height: 89vh;
        overflow: hidden;
        display: flex;
        align-items: flex-end;
        border-right: 1em solid var(--cream);
        border-left: 1em solid var(--cream);
    }
    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(0deg, rgba(16,20,25,.55) 0%, rgba(16,20,25,0) 40%);
        z-index: 1;
    }
    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 900px;
        margin: 0 auto;
        width: 100%;
        padding: 5rem var(--edge-padding) 4rem;
        text-align: center;
    }
    .hero-content h1 {
        font-family: var(--serif);
        font-size: clamp(2.4rem, 6vw, 4.5rem);
        font-weight: 400;
        color: #fff;
        line-height: 1.1;
        letter-spacing: -0.5px;
        text-shadow: 1px 1px 2px rgba(0,0,0,.35);
        margin-bottom: 2rem;
    }
    .hero-cta {
        display: inline-block;
        padding: 14px 44px;
        background: var(--terracotta);
        color: #fff;
        font-size: .78rem;
        letter-spacing: .18em;
        text-transform: uppercase;
        border-radius: 2px;
        font-family: var(--sans);
        transition: background .2s;
    }
    .hero-cta:hover { background: var(--terra-dark); }

    .hero-slides { position: absolute; inset: 0; z-index: 0; }
    .hero-slide { position: absolute; inset: 0; opacity: 0; transition: opacity 1.2s ease-in-out; }
    .hero-slide.active { opacity: 1; }
    .hero-slide img { width: 100%; height: 100%; object-fit: cover; }
    .hero-dots {
        position: absolute; bottom: 2rem; left: 50%;
        transform: translateX(-50%);
        display: flex; gap: 10px; z-index: 3;
    }
    .hero-dot {
        width: 8px; height: 8px; border-radius: 50%;
        background: rgba(255,255,255,.4); border: none;
        cursor: pointer; padding: 0;
        transition: background .3s, transform .3s;
    }
    .hero-dot.active { background: #fff; transform: scale(1.3); }
    .hero-progress {
        position: absolute; bottom: 0; left: 0;
        height: 3px; background: var(--terracotta);
        z-index: 3; width: 0%;
    }

    .about-section {
        background: linear-gradient(180deg, var(--cream) 0%, rgba(232,132,90,.15) 100%);
        padding: var(--section-gap-xl) 0;
    }
    .about-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
    }
    .about-text h2 {
        font-family: var(--serif);
        font-size: clamp(2rem, 4vw, 3.2rem);
        font-weight: 400;
        color: var(--ink);
        line-height: 1.15;
        margin-bottom: .8rem;
    }
    .about-text h3 {
        font-family: var(--serif);
        font-size: clamp(1.1rem, 2vw, 1.4rem);
        font-weight: 400;
        font-style: italic;
        color: var(--muted);
        margin-bottom: 1.4rem;
    }
    .about-text p { font-size: .95rem; color: var(--muted); margin-bottom: 2rem; }
    .btn-outline {
        display: inline-block;
        padding: 12px 36px;
        border: 1.5px solid var(--terracotta);
        color: var(--terracotta);
        font-size: .75rem;
        letter-spacing: .16em;
        text-transform: uppercase;
        border-radius: 2px;
        font-family: var(--sans);
        transition: all .2s;
    }
    .btn-outline:hover {
        background: var(--terracotta); color: #fff;
    }

    .about-photos {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 420px;
    }
    .about-photo-wrap {
        max-width: 50%;
        box-shadow: rgba(0,0,0,.2) 0px 0px 14px 0px;
        background: #fff;
        padding: .4rem .4rem 0;
    }
    .about-photo-wrap img { height: 280px; object-fit: cover; }
    .about-photo-caption {
        font-family: 'Caveat', var(--serif);
        font-size: .88rem;
        text-align: center;
        padding: .6rem .4rem;
        color: var(--muted);
    }
    .about-photo-left {
        transform: rotate(-5deg);
        margin-right: -30px;
        margin-top: 30px;
        z-index: 2;
        position: relative;
    }
    .about-photo-right {
        transform: rotate(5deg);
        z-index: 1;
        position: relative;
    }

    .lead-magnet-section {
        background: var(--warm-off);
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
        padding: var(--section-gap-lg) 0;
    }
    .lead-magnet-grid {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 4rem;
        align-items: center;
    }
    .lead-magnet-image img {
        max-width: 400px;
        margin: 0 auto;
        border-radius: 4px;
        box-shadow: 0 20px 60px rgba(42,32,24,.15);
    }
    .lead-magnet-text h2 {
        font-family: var(--serif);
        font-size: clamp(1.8rem, 3.5vw, 2.8rem);
        font-weight: 400;
        color: var(--ink);
        margin-bottom: .6rem;
        line-height: 1.15;
    }
    .lead-magnet-text h3 {
        font-family: var(--serif);
        font-size: 1.2rem;
        font-weight: 400;
        font-style: italic;
        color: var(--muted);
        margin-bottom: 1.2rem;
    }
    .checklist { list-style: none; margin-bottom: 1.5rem; }
    .checklist li {
        display: flex; align-items: flex-start; gap: 10px;
        font-size: .9rem; color: var(--muted);
        padding: .35rem 0;
    }
    .checklist li i { color: var(--terracotta); margin-top: 3px; flex-shrink: 0; }

    .destinations-section {
        padding: var(--section-gap-xl) 0 0;
    }
    .section-intro {
        padding: 0 var(--edge-padding);
        margin-bottom: 2.5rem;
    }
    .section-intro h2 {
        font-family: var(--serif);
        font-size: clamp(1.8rem, 3.5vw, 2.6rem);
        font-weight: 400;
        margin-bottom: .8rem;
    }
    .dest-panels {
        display: flex;
        height: 500px;
        gap: 1em;
        padding: 0 1em;
    }
    .dest-panel {
        position: relative;
        flex: 1;
        overflow: hidden;
        cursor: pointer;
        transition: flex .55s cubic-bezier(.45,1.6,.4,1);
        border-radius: 2px;
    }
    .dest-panel:hover { flex: 3; }
    .dest-panel img {
        position: absolute;
        inset: 0;
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform .5s ease;
    }
    .dest-panel:hover img { transform: scale(1.04); }
    .dest-panel-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(16,20,25,.75) 0%, transparent 50%);
    }
    .dest-panel-label {
        position: absolute;
        left: 0; bottom: 0;
        writing-mode: vertical-lr;
        text-orientation: sideways;
        font-family: var(--serif);
        font-size: .85rem;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: #fff;
        padding: 1rem .5rem;
        opacity: 1;
        transition: opacity .3s;
    }

    .featured-full-section {
        padding: var(--section-gap-xl) 0;
        background: linear-gradient(180deg, rgba(232,132,90,.12) 0%, var(--cream) 100%);
    }
    .featured-full-card {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        min-height: 400px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(42,32,24,.1);
    }
    .featured-full-image { position: relative; overflow: hidden; }
    .featured-full-image img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform .5s ease;
    }
    .featured-full-card:hover .featured-full-image img { transform: scale(1.03); }
    .featured-full-body {
        background: #fff;
        padding: 3rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .featured-full-body .post-meta { font-size: .7rem; letter-spacing: .12em; text-transform: uppercase; color: var(--terracotta); margin-bottom: .8rem; }
    .featured-full-body h2 {
        font-family: var(--serif); font-size: clamp(1.5rem, 2.5vw, 2rem);
        font-weight: 400; line-height: 1.25; margin-bottom: 1rem; color: var(--ink);
    }
    .read-more-btn {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: .72rem; letter-spacing: .12em; text-transform: uppercase;
        color: var(--terracotta);
        border-bottom: 1px solid var(--terracotta);
        padding-bottom: 2px;
        transition: color .2s, border-color .2s;
        align-self: flex-start;
    }

    .itineraires-section {
        padding: var(--section-gap-xl) 0;
        background: var(--warm-off);
    }
    .itineraires-header {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 3rem;
        align-items: center;
        margin-bottom: 2.5rem;
    }
    .itineraires-header h2 {
        font-family: var(--serif);
        font-size: clamp(1.6rem, 3vw, 2.4rem);
        font-weight: 400;
        line-height: 1.2;
        color: var(--ink);
    }
    .carousel-track {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }
    .carousel-card {
        position: relative;
        overflow: hidden;
        border-radius: 2px;
        aspect-ratio: 3/4;
        cursor: pointer;
    }
    .carousel-card img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform .5s ease;
    }
    .carousel-card:hover img { transform: scale(1.05); }
    .carousel-card-body {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        padding: 1.5rem 1.2rem .8rem;
        background: linear-gradient(to top, rgba(16,20,25,.8) 0%, transparent 100%);
    }
    .carousel-card-body h3 {
        font-family: var(--serif);
        font-size: 1rem;
        font-weight: 400;
        color: #fff;
        line-height: 1.3;
    }

    .blog-planning-section {
        padding: var(--section-gap-xl) 0;
    }
    .blog-planning-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
    }
    .blog-col h2, .planning-col h2 {
        font-family: var(--serif);
        font-size: clamp(1.4rem, 2.5vw, 1.9rem);
        font-weight: 400;
        margin-bottom: .5rem;
        color: var(--ink);
    }
    .blog-list { display: flex; flex-direction: column; gap: 0; }
    .blog-list-item {
        display: grid;
        grid-template-columns: 120px 1fr;
        border-bottom: 1px solid var(--border);
        transition: background .2s;
    }
    .blog-list-item:hover { background: var(--warm-off); }
    .blog-list-img { height: 90px; overflow: hidden; }
    .blog-list-img img { height: 100%; transition: transform .4s; }
    .blog-list-item:hover .blog-list-img img { transform: scale(1.06); }
    .blog-list-body { padding: .9rem 1rem; }
    .blog-list-title { font-family: var(--serif); font-size: 1rem; font-weight: 400; color: var(--ink); line-height: 1.3; }

    .planning-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: .8rem;
    }
    .planning-card {
        position: relative;
        overflow: hidden;
        aspect-ratio: 3/2;
        border-radius: 2px;
    }
    .planning-card img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform .4s;
    }
    .planning-card:hover img { transform: scale(1.06); }
    .planning-card-body {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        padding: 1rem .8rem .6rem;
        background: linear-gradient(to top, rgba(16,20,25,.75) 0%, transparent 100%);
    }
    .planning-card-body h3 {
        font-family: var(--serif);
        font-size: .9rem;
        font-weight: 400;
        color: #fff;
        line-height: 1.3;
    }

    .categories-section {
        padding: var(--section-gap-md) 0 var(--section-gap-xl);
        background: linear-gradient(180deg, var(--cream) 0%, rgba(232,132,90,.1) 100%);
    }
    .section-header {
        display: flex; align-items: baseline; gap: 20px;
        margin-bottom: 2.5rem;
    }
    .section-title {
        font-family: var(--serif); font-size: 2rem; font-weight: 400;
        color: var(--ink); white-space: nowrap;
    }
    .section-line { flex: 1; height: 1px; background: var(--border); margin-bottom: 4px; }
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
    }
    .category-card {
        position: relative; border-radius: 6px; overflow: hidden;
        border: 1px solid var(--border);
        transition: transform .25s, box-shadow .25s;
        display: block;
    }
    .category-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(42,32,24,.15);
    }
    .category-card-img { position: relative; height: 140px; overflow: hidden; }
    .category-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s; }
    .category-card:hover .category-card-img img { transform: scale(1.06); }
    .category-card-fallback {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, var(--warm-off), #ede0cc);
        display: flex; align-items: center; justify-content: center;
        color: var(--terracotta); font-size: 2rem;
    }
    .category-card-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to bottom, transparent 40%, rgba(42,32,24,0.55) 100%);
    }
    .category-card-body {
        padding: 14px 18px; background: #fff;
        display: flex; align-items: center; justify-content: space-between;
        border-top: 1px solid var(--border);
    }
    .category-card-name {
        font-family: var(--serif); font-size: 1.05rem; font-weight: 600;
        color: var(--ink); font-style: italic;
    }
    .category-card-count {
        font-size: .7rem; letter-spacing: .1em; text-transform: uppercase;
        color: var(--terracotta); background: #fde8dc;
        padding: 3px 10px; border-radius: 100px;
    }

    .newsletter-mini { display: flex; gap: 0; flex: 1; max-width: 420px; }
    .newsletter-mini input {
        flex: 1; padding: 12px 18px;
        border: 1px solid var(--border); border-right: none;
        border-radius: 2px 0 0 2px;
        background: #fff; font-family: var(--sans); font-size: .85rem;
        color: var(--ink); outline: none;
    }
    .newsletter-mini input::placeholder { color: #bbb; }
    .newsletter-mini button {
        padding: 12px 24px;
        background: var(--terracotta); color: #fff;
        font-family: var(--sans); font-size: .72rem;
        letter-spacing: .12em; text-transform: uppercase;
        border: none; border-radius: 0 2px 2px 0; cursor: pointer;
        transition: background .2s;
    }
    .newsletter-mini button:hover { background: var(--terra-dark); }
    .subscribed-msg { background: #f0fdf4; color: #16a34a; padding: 12px 18px; border-radius: 4px; font-size: .85rem; }
    .field-error { color: #c0392b; font-size: .75rem; margin-top: 4px; }

    .view-more-wrap { text-align: center; margin: 3rem 0 2rem; }
    .view-more-btn {
        display: inline-block;
        padding: 14px 48px;
        border: 1px solid var(--terracotta);
        color: var(--terracotta);
        font-size: .78rem; letter-spacing: .18em; text-transform: uppercase;
        border-radius: 2px; font-family: var(--sans);
        transition: background .2s, color .2s;
    }
    .view-more-btn:hover { background: var(--terracotta); color: #fff; }

    @media (max-width: 1024px) {
        .about-grid, .lead-magnet-grid, .featured-full-card { grid-template-columns: 1fr; }
        .featured-full-image { height: 300px; }
        .itineraires-header { grid-template-columns: 1fr; }
        .carousel-track { grid-template-columns: repeat(2, 1fr); }
        .blog-planning-grid { grid-template-columns: 1fr; }
        .dest-panels { height: 380px; }
    }
    @media (max-width: 767px) {
        .hero-full { min-height: 65vh; border-left: .5em solid var(--cream); border-right: .5em solid var(--cream); }
        .dest-panels { flex-direction: column; height: auto; gap: .5em; }
        .dest-panel { height: 200px; flex: none !important; }
        .dest-panel:hover { flex: none !important; }
        .carousel-track { grid-template-columns: repeat(2, 1fr); }
        .about-photos { flex-direction: column; }
        .about-photo-left { transform: rotate(-2deg); margin-right: 0; margin-bottom: -20px; }
        .about-photo-right { transform: rotate(2deg); }
        .categories-grid { grid-template-columns: repeat(2, 1fr); }
        .planning-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<!-- HERO FULL HEIGHT -->
<section class="hero-full">
    <div class="hero-slides">
        <div class="hero-slide active">
            <img src="https://images.unsplash.com/photo-1455390582262-044cdead277a?w=1400&q=80" alt="LaraBlog">
        </div>
        <div class="hero-slide">
            <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=1400&q=80" alt="LaraBlog">
        </div>
        <div class="hero-slide">
            <img src="https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e?w=1400&q=80" alt="LaraBlog">
        </div>
        <div class="hero-slide">
            <img src="https://images.unsplash.com/photo-1506880018603-83d5b814b5a6?w=1400&q=80" alt="LaraBlog">
        </div>
    </div>
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content">
            <h1 id="heroTitle">Découvrez des histoires qui valent la peine d'être lues</h1>
            <a href="{{ route('blog') }}" class="hero-cta">Commencer à lire</a>
        </div>
    </div>
    <div class="hero-dots">
        <button class="hero-dot active" onclick="goTo(0)"></button>
        <button class="hero-dot" onclick="goTo(1)"></button>
        <button class="hero-dot" onclick="goTo(2)"></button>
        <button class="hero-dot" onclick="goTo(3)"></button>
    </div>
    <div class="hero-progress" id="heroProgress"></div>
</section>

<!-- ABOUT SECTION -->
<section class="about-section">
    <div class="container">
        <div class="about-grid">
            <div class="about-text">
                <h2>Bienvenue sur LaraBlog !</h2>
                <h3>Des histoires sincères, des perspectives nouvelles.</h3>
                <p>LaraBlog réunit une communauté d'auteurs indépendants passionnés qui partagent des analyses profondes et des récits qui comptent. De la technologie à la culture, des sciences à l'art — nous couvrons les sujets qui vous inspirent.</p>
                <a href="{{ route('about') }}" class="btn-outline">Notre histoire</a>
            </div>
            <div class="about-photos">
                <div class="about-photo-wrap about-photo-left">
                    <img src="{{ asset('covers/ecriture.jpg') }}" alt="Notre communauté">
                    <p class="about-photo-caption">Auteurs passionnés</p>
                </div>
                <div class="about-photo-wrap about-photo-right">
                    <img src="{{ asset('covers/image2.jpeg') }}" alt="LaraBlog">
                    <p class="about-photo-caption">Idées partagées</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- LEAD MAGNET -->
<section class="lead-magnet-section" id="newsletter">
    <div class="container">
        <div class="lead-magnet-grid">
            <div class="lead-magnet-image">
                <img src="{{ asset('covers/image3.jpg') }}" alt="Newsletter LaraBlog">
            </div>
            <div class="lead-magnet-text">
                <h2>Restez inspiré, chaque semaine</h2>
                <h3>Recevez les meilleurs articles dans votre boîte mail</h3>
                <ul class="checklist">
                    <li><i class="fas fa-check-circle"></i> Sélection éditoriale des meilleurs articles</li>
                    <li><i class="fas fa-check-circle"></i> Alertes publications de vos auteurs favoris</li>
                    <li><i class="fas fa-check-circle"></i> Contenus exclusifs abonnés</li>
                    <li><i class="fas fa-check-circle"></i> Sans spam — désabonnement à tout moment</li>
                </ul>
                @if(session('subscribed'))
                    <div class="subscribed-msg">{{ session('subscribed') }}</div>
                @else
                    <form method="POST" action="{{ route('subscribe') }}">
                        @csrf
                        <div class="newsletter-mini">
                            <input type="email" name="email" placeholder="votre@email.com" required>
                            <button type="submit">S'abonner</button>
                        </div>
                        @error('email')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </form>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- DESTINATIONS / CATÉGORIES PANELS -->
<section class="destinations-section">
    <div class="container">
        <div class="section-intro">
            <h2>Explorer les catégories</h2>
            <p>Technologie, culture, science, art et bien plus — trouvez les sujets qui vous passionnent et plongez dans nos univers éditoriaux.</p>
        </div>
    </div>
    <div class="dest-panels">
        @foreach($categories->take(5) as $category)
        <a href="/category/{{ $category->slug }}" class="dest-panel">
            @if($category->image)
                <img src="{{ asset('img/' . $category->image) }}" alt="{{ $category->name }}">
            @else
                <img src="{{ asset('covers/image1.jpg') }}" alt="{{ $category->name }}">
            @endif
            <div class="dest-panel-overlay"></div>
            <div class="dest-panel-label">{{ $category->name }}</div>
        </a>
        @endforeach
    </div>
</section>

<!-- ARTICLE FEATURED -->
@if($posts->count() > 0)
@php $featuredPost = $posts->first(); @endphp
<section class="featured-full-section">
    <div class="container">
        <div class="section-header" style="margin-bottom: 1.5rem;">
            <h2 class="section-title">Article à la une</h2>
            <div class="section-line"></div>
        </div>
        <div class="featured-full-card">
            <div class="featured-full-image">
                <img src="img/{{ $featuredPost->image }}" alt="{{ $featuredPost->title }}">
            </div>
            <div class="featured-full-body">
                <div class="post-meta">{{ $featuredPost->created_at->format('d M Y') }}</div>
                <h2>{{ $featuredPost->title }}</h2>
                <p>{{ Str::limit($featuredPost->description, 200) }}…</p>
                <a href="{{ route('fullpost', $featuredPost->id) }}" class="read-more-btn">
                    Lire l'article <i class="fas fa-arrow-right" style="font-size:.65rem;"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@endif

<!-- ARTICLES RÉCENTS -->
<section class="itineraires-section">
    <div class="container">
        <div class="itineraires-header">
            <h2>Articles récents</h2>
            <p>Des analyses approfondies, des récits captivants et des perspectives nouvelles — curatés pour vous chaque semaine par nos auteurs.</p>
        </div>
        <div class="carousel-track">
            @foreach($posts->skip(1)->take(3) as $post)
            <a href="{{ route('fullpost', $post->id) }}" class="carousel-card">
                <img src="img/{{ $post->image }}" alt="{{ $post->title }}">
                <div class="carousel-card-body">
                    <h3>{{ $post->title }}</h3>
                </div>
            </a>
            @endforeach
        </div>
        <div class="view-more-wrap">
            <a href="{{ route('blog') }}" class="view-more-btn">Voir tous les articles →</a>
        </div>
    </div>
</section>

<!-- BLOG LIST + PLANNING GRID -->
<section class="blog-planning-section">
    <div class="container">
        <div class="blog-planning-grid">
            <div class="blog-col">
                <h2>Derniers articles</h2>
                <p>Planifiez, explorez, apprenez — notre sélection éditoriale du moment.</p>
                <div class="blog-list">
                    @foreach($posts->skip(4)->take(4) as $post)
                    <a href="{{ route('fullpost', $post->id) }}" class="blog-list-item">
                        <div class="blog-list-img">
                            <img src="img/{{ $post->image }}" alt="{{ $post->title }}">
                        </div>
                        <div class="blog-list-body">
                            <div class="blog-list-cat">{{ $post->created_at->format('d M Y') }}</div>
                            <h3 class="blog-list-title">{{ $post->title }}</h3>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            <div class="planning-col">
                <h2>Explorer par catégorie</h2>
                <p>Choisissez un univers et plongez dans les sujets qui vous passionnent.</p>
                <div class="planning-grid">
                    @foreach($categories->take(4) as $category)
                    <a href="/category/{{ $category->slug }}" class="planning-card">
                        @if($category->image)
                            <img src="{{ asset('img/' . $category->image) }}" alt="{{ $category->name }}">
                        @else
                            <img src="{{ asset('covers/image1.jpg') }}" alt="{{ $category->name }}">
                        @endif
                        <div class="planning-card-body">
                            <h3>{{ $category->name }}</h3>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CATÉGORIES -->
<section class="categories-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Nos catégories</h2>
            <div class="section-line"></div>
        </div>
        <div class="categories-grid">
            @foreach($categories as $category)
            <a href="/category/{{ $category->slug }}" class="category-card">
                <div class="category-card-img">
                    @if($category->image)
                        <img src="{{ asset('img/' . $category->image) }}" alt="{{ $category->name }}">
                    @else
                        <div class="category-card-fallback">
                            <i class="fas fa-layer-group"></i>
                        </div>
                    @endif
                    <div class="category-card-overlay"></div>
                </div>
                <div class="category-card-body">
                    <h3 class="category-card-name">{{ $category->name }}</h3>
                    <span class="category-card-count">{{ $category->posts_count }} article{{ $category->posts_count > 1 ? 's' : '' }}</span>
                </div>
            </a>
            @endforeach
        </div>
        <div class="view-more-wrap">
            <a href="{{ route('categories.all') }}" class="view-more-btn">
                Découvrir toutes nos catégories ({{ $totalCategories }})
                <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    function toggleDropdown() {
        const d = document.getElementById('avatarDropdown');
        if(d) d.style.display = d.style.display === 'none' ? 'block' : 'none';
    }
    document.addEventListener('click', function(e) {
        const dropdown = document.querySelector('.avatar-dropdown');
        if (dropdown && !dropdown.contains(e.target)) {
            const d = document.getElementById('avatarDropdown');
            if (d) d.style.display = 'none';
        }
    });

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

    const heroTitles = [
        "Découvrez des histoires qui valent la peine d'être lues",
        "Des plumes indépendantes, des idées qui font réfléchir",
        "La culture, la tech, l'art — racontés autrement",
        "Rejoignez une communauté de lecteurs curieux et auteurs passionnés"
    ];
    
    let heroIndex = 0;
    const heroSlides = document.querySelectorAll('.hero-slide');
    const heroDots = document.querySelectorAll('.hero-dot');
    const heroBar = document.getElementById('heroProgress');
    const heroTitle = document.getElementById('heroTitle');
    let heroTimer;

    function goTo(n) {
        heroSlides[heroIndex].classList.remove('active');
        heroDots[heroIndex].classList.remove('active');
        heroIndex = n;
        heroSlides[heroIndex].classList.add('active');
        heroDots[heroIndex].classList.add('active');

        heroTitle.style.opacity = '0';
        heroTitle.style.transform = 'translateY(10px)';
        setTimeout(() => {
            heroTitle.textContent = heroTitles[heroIndex];
            heroTitle.style.opacity = '1';
            heroTitle.style.transform = 'translateY(0)';
        }, 300);

        heroBar.style.transition = 'none';
        heroBar.style.width = '0%';
        requestAnimationFrame(() => requestAnimationFrame(() => {
            heroBar.style.transition = 'width 4s linear';
            heroBar.style.width = '100%';
        }));
        clearInterval(heroTimer);
        heroTimer = setInterval(() => goTo((heroIndex + 1) % heroSlides.length), 4000);
    }

    heroTitle.style.transition = 'opacity .3s ease, transform .3s ease';
    requestAnimationFrame(() => requestAnimationFrame(() => {
        heroBar.style.transition = 'width 4s linear';
        heroBar.style.width = '100%';
    }));
    heroTimer = setInterval(() => goTo((heroIndex + 1) % heroSlides.length), 4000);
</script>
@endpush