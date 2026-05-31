@extends('layouts.app')

@section('title', 'LaraBlog — Pensées & Créativité')

@push('styles')
<style>
    .hero-carousel {
        position: relative;
        width: 100%;
        height: 70vh;
        min-height: 460px;
        overflow: hidden;
        background: #2c241e;
    }
    .carousel-slides { position: relative; width: 100%; height: 100%; }
    .carousel-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 1.2s ease-in-out;
        background-size: cover;
        background-position: center 30%;
        background-repeat: no-repeat;
        display: flex;
        align-items: flex-end;
        justify-content: flex-start;
    }
    .carousel-slide.active { opacity: 1; z-index: 2; }
    .slide-overlay {
        background: linear-gradient(to top, rgba(0,0,0,0.65) 0%, rgba(0,0,0,0.2) 100%);
        width: 100%;
        padding: 2rem 0 3rem 0;
    }
    .slide-caption {
        max-width: 700px;
        margin-left: 8%;
        padding: 1rem 2rem;
        border-left: 4px solid var(--terracotta);
    }
    .slide-caption h2 {
        font-family: var(--serif);
        font-size: clamp(1.6rem, 5vw, 2.6rem);
        font-weight: 400;
        color: #fff;
        text-shadow: 0 2px 8px rgba(0,0,0,0.2);
        letter-spacing: -0.3px;
        margin-bottom: 0.4rem;
    }
    .slide-caption p {
        font-size: 1rem;
        color: rgba(255,255,250,0.9);
        font-weight: 300;
    }
    .carousel-indicators {
        position: absolute;
        bottom: 24px;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        gap: 12px;
        z-index: 10;
    }
    .indicator {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: rgba(255,255,240,0.5);
        cursor: pointer;
        transition: all 0.2s;
        border: none;
        padding: 0;
    }
    .indicator.active {
        background: var(--terracotta);
        width: 28px;
        border-radius: 20px;
    }
    .page-banner {
        background: var(--warm-off);
        border-bottom: 1px solid var(--border);
        padding: 56px 0 48px;
        text-align: center;
    }
    .page-banner .eyebrow {
        font-size: .7rem;
        letter-spacing: .2em;
        text-transform: uppercase;
        color: var(--terracotta);
        margin-bottom: 12px;
        font-weight: 400;
    }
    .page-banner h1 {
        font-family: var(--serif);
        font-size: clamp(2.8rem, 5vw, 4rem);
        font-weight: 400;
        color: var(--ink);
        margin-bottom: 12px;
    }
    .page-banner h1 em { color: var(--terracotta); font-style: italic; }
    .page-banner p {
        font-size: .9rem;
        color: var(--muted);
        max-width: 560px;
        margin: 0 auto 28px;
    }
    .search-wrap { display: flex; justify-content: center; }
    .search-form {
        display: flex;
        width: 100%;
        max-width: 480px;
        border: 1px solid var(--border);
        border-radius: 40px;
        background: #fff;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.02);
    }
    .search-form input {
        flex: 1;
        padding: 12px 20px;
        font-family: var(--sans);
        font-size: .85rem;
        border: none;
        outline: none;
        background: transparent;
    }
    .search-form button {
        padding: 12px 20px;
        background: var(--terracotta);
        color: #fff;
        border: none;
        cursor: pointer;
        transition: .2s;
    }
    .search-form button:hover { background: var(--terra-dark); }
    .toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        padding: 36px 0 28px;
        border-bottom: 1px solid var(--border);
        margin-bottom: 48px;
    }
    .filter-tabs { display: flex; flex-wrap: wrap; gap: 10px; }
    .filter-tab {
        padding: 6px 18px;
        border: 1px solid var(--border);
        border-radius: 100px;
        font-size: .7rem;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--muted);
        cursor: pointer;
        transition: all 0.2s;
        background: transparent;
    }
    .filter-tab:hover, .filter-tab.active {
        background: var(--terracotta);
        color: #fff;
        border-color: var(--terracotta);
    }
    .post-count { font-size: .78rem; color: var(--muted); }
    .post-count span { color: var(--terracotta); font-weight: 500; }
    .sort-select {
        padding: 7px 14px;
        border: 1px solid var(--border);
        border-radius: 30px;
        background: #fff;
        font-family: var(--sans);
        font-size: .75rem;
        color: var(--muted);
        cursor: pointer;
    }
    .blog-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 36px;
        margin-bottom: 64px;
    }
    .post-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 20px;
        overflow: hidden;
        transition: all .3s cubic-bezier(0.2,0,0,1);
        display: flex;
        flex-direction: column;
    }
    .post-card:hover {
        box-shadow: 0 20px 35px -12px rgba(42,32,24,0.12);
        transform: translateY(-5px);
    }
    .post-image { height: 210px; overflow: hidden; background: #e5dbd0; }
    .post-image img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        transition: transform .5s;
    }
    .post-card:hover .post-image img { transform: scale(1.05); }
    .post-content { padding: 24px 26px 30px; display: flex; flex-direction: column; flex: 1; }
    .post-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: .68rem;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 10px;
    }
    .cat-badge {
        background: var(--warm-off);
        color: var(--terracotta);
        padding: 3px 12px;
        border-radius: 30px;
        font-size: .65rem;
        font-weight: 500;
    }
    .post-title {
        font-family: var(--serif);
        font-size: 1.3rem;
        font-weight: 500;
        line-height: 1.35;
        margin-bottom: 12px;
        color: var(--ink);
    }
    .post-excerpt {
        font-size: .8rem;
        color: var(--muted);
        line-height: 1.7;
        margin-bottom: 20px;
        flex: 1;
    }
    .post-footer {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        margin-top: auto;
    }
    .read-more {
        font-size: .7rem;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: var(--terracotta);
        border-bottom: 1px solid var(--terracotta);
        padding-bottom: 3px;
        font-weight: 500;
    }
    .read-more:hover { color: var(--terra-dark); border-color: var(--terra-dark); }
    .author-chip {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 14px;
    }
    .author-avatar {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: var(--warm-off);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 500;
        color: var(--terracotta);
        font-size: 12px;
    }
    .author-name {
        font-size: .7rem;
        font-weight: 400;
        color: var(--muted);
        letter-spacing: 0;
    }
    .pagination-wrap {
        display: flex;
        justify-content: center;
        gap: 8px;
        padding: 24px 0 80px;
    }
    .page-link {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--border);
        border-radius: 50%;
        font-size: .8rem;
        color: var(--muted);
        transition: .2s;
        background: #fff;
    }
    .page-link:hover, .page-link.active {
        background: var(--terracotta);
        color: #fff;
        border-color: var(--terracotta);
    }
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: var(--warm-off);
        border-radius: 32px;
        margin: 40px 0;
    }
    @media (max-width: 960px) { .blog-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 680px) { .blog-grid { grid-template-columns: 1fr; } .hero-carousel { height: 55vh; } .slide-caption { margin-left: 5%; } }
</style>
@endpush

@section('content')
<div class="hero-carousel">
    <div class="carousel-slides" id="carouselSlides">
        <div class="carousel-slide active" style="background-image: url('https://www.nichepursuits.com/wp-content/uploads/2022/05/website-pics-1270-%C3%97-720px-1-1200x750.png');">
            <div class="slide-overlay"><div class="slide-caption"><h2>L'art d'écrire au quotidien</h2><p>Développer une routine créative pour publier régulièrement.</p></div></div>
        </div>
        <div class="carousel-slide" style="background-image: url('https://picsum.photos/id/1005/1600/900');">
            <div class="slide-overlay"><div class="slide-caption"><h2>Philosophie & Minimalisme</h2><p>Créer un blog qui vous ressemble, sans superflu.</p></div></div>
        </div>
        <div class="carousel-slide" style="background-image: url('https://picsum.photos/id/1047/1600/900');">
            <div class="slide-overlay"><div class="slide-caption"><h2>Good Design is Memorable</h2><p>Grand design rime avec authenticité et élégance.</p></div></div>
        </div>
        <div class="carousel-slide" style="background-image: url('https://img.freepik.com/premium-photo/different-ethnicities-girls-holding-hands_1086464-213.jpg?w=2000');">
            <div class="slide-overlay"><div class="slide-caption"><h2>Communauté d'auteurs</h2><p>Rejoignez LaraBlog et partagez votre voix unique.</p></div></div>
        </div>
    </div>
    <div class="carousel-indicators" id="carouselIndicators"></div>
</div>

<div class="page-banner">
    <p class="eyebrow">✦ PHILOSOPHIE ⋅ DESIGN ⋅ CRÉATIVITÉ</p>
    <h1>Ce que votre style d'écriture <em>révèle de vous</em></h1>
    <p>Good design is making something incredible and memorable. Great design is making you stand out — comme chaque article que vous écrivez.</p>
    <div class="search-wrap">
        <form class="search-form" method="GET" action="{{ route('blog') }}">
            <input type="text" name="search" placeholder="Rechercher un article..." value="{{ request('search') }}">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
</div>

<div class="container">
    <div class="toolbar">
        <div class="filter-tabs">
            <a href="{{ route('blog') }}" class="filter-tab {{ !request('category') ? 'active' : '' }}">All</a>
            @foreach($categories as $category)
                <a href="{{ route('blog', ['category' => $category->slug]) }}"
   class="filter-tab {{ request('category') == $category->slug ? 'active' : '' }}">
    {{ $category->name }}
    <span style="font-size:.6rem;opacity:.7;">({{ $category->posts_count }})</span>
</a>
            @endforeach
        </div>
        <div style="display:flex; align-items:center; gap:16px;">
<p class="post-count">
    <span>{{ $posts->total() }}</span>
    article{{ $posts->total() != 1 ? 's' : '' }} trouvé(s)
    @if(request('category'))
        dans <strong style="color:var(--ink);">
            {{ $categories->firstWhere('slug', request('category'))?->name }}
        </strong>
    @endif
</p>            <form method="GET" action="{{ route('blog') }}">
                @if(request('search'))<input type="hidden" name="search" value="{{ request('search') }}">@endif
                @if(request('category'))<input type="hidden" name="category" value="{{ request('category') }}">@endif
                <select name="sort" class="sort-select" onchange="this.form.submit()">
                    <option value="latest" {{ request('sort','latest') == 'latest' ? 'selected' : '' }}>Plus récents</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Plus anciens</option>
                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Les plus lus</option>
                </select>
            </form>
        </div>
    </div>

    @if($posts->count())
    <div class="blog-grid">
        @foreach($posts as $post)
        <div class="post-card">
            <div class="post-image">
                <img src="{{ $post->image ? asset('img/' . $post->image) : asset('img/default.jpg') }}" alt="{{ $post->title }}">
            </div>
            <div class="post-content">
                <div class="post-meta">
                    @if($post->categorie)
                        <span class="cat-badge">{{ $post->categorie->name }}</span>
                    @endif
                    <span>{{ $post->created_at->format('d M Y') }}</span>
                </div>
                @if($post->user)
                <div class="author-chip">
                    <div class="author-avatar">
                        @if($post->user->avatar)
                            <img src="{{ asset('img/' . $post->user->avatar) }}" style="width:100%;height:100%;border-radius:50%;object-fit:cover;">
                        @else
                            {{ strtoupper(substr($post->user->name, 0, 1)) }}
                        @endif
                    </div>
                    <span class="author-name">{{ $post->user->name }}</span>
                </div>
                @endif
                <h3 class="post-title">{{ $post->title }}</h3>
                <p class="post-excerpt">{{ Str::limit($post->description, 110) }}</p>
                <div class="post-footer">
                    <a href="{{ route('fullpost', $post->id) }}" class="read-more">Lire la suite →</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="pagination-wrap">
        {{ $posts->links('vendor.pagination.custom') }}
    </div>
    @else
    <div class="empty-state">
        <div class="empty-icon"><i class="far fa-newspaper"></i></div>
        <h3>Aucun article trouvé</h3>
        <p>Essayez un autre terme de recherche ou parcourez les catégories.</p>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    const slides = document.querySelectorAll('.carousel-slide');
    const indicatorsContainer = document.getElementById('carouselIndicators');
    let currentIndex = 0;
    let interval;
    
    function initIndicators() {
        if(!indicatorsContainer) return;
        indicatorsContainer.innerHTML = '';
        slides.forEach((_, idx) => {
            const dot = document.createElement('button');
            dot.classList.add('indicator');
            if(idx === currentIndex) dot.classList.add('active');
            dot.addEventListener('click', () => goToSlide(idx));
            indicatorsContainer.appendChild(dot);
        });
    }
    
    function updateIndicators() {
        const dots = document.querySelectorAll('.indicator');
        dots.forEach((dot, i) => {
            if(i === currentIndex) dot.classList.add('active');
            else dot.classList.remove('active');
        });
    }
    
    function goToSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });
        currentIndex = index;
        updateIndicators();
        resetInterval();
    }
    
    function nextSlide() {
        let next = (currentIndex + 1) % slides.length;
        goToSlide(next);
    }
    
    function resetInterval() {
        if(interval) clearInterval(interval);
        interval = setInterval(() => nextSlide(), 4000);
    }
    
    if(slides.length) {
        initIndicators();
        resetInterval();
    }
</script>
@endpush