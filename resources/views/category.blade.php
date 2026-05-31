@extends('layouts.app')

@section('title', $categorie->name . ' — LaraBlog')

@push('styles')
<style>
    .cat-hero {
        position: relative;
        min-height: 560px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        overflow: hidden;
    }
    .cat-hero-bg {
        position: absolute;
        inset: 0;
        z-index: 0;
    }
    .cat-hero-bg img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        animation: slowZoom 20s ease-in-out infinite;
    }
    @keyframes slowZoom {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    .cat-hero-bg::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(30,20,12,0.72) 0%, rgba(30,20,12,0.80) 60%, rgba(30,20,12,0.90) 100%);
    }
    .cat-hero-bg-fallback {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--ink) 0%, #3a2518 100%);
    }
    .cat-hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        padding: 80px 32px 40px;
    }
    .cat-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(192,98,58,0.25);
        border: 1px solid rgba(192,98,58,0.5);
        color: #f0a080;
        font-size: .7rem;
        letter-spacing: .2em;
        text-transform: uppercase;
        padding: 6px 16px;
        border-radius: 100px;
        margin-bottom: 28px;
    }
    .cat-hero-badge::before {
        content: '';
        width: 6px; height: 6px;
        border-radius: 50%;
        background: var(--terracotta);
        display: inline-block;
    }
    .cat-hero-title {
        font-family: var(--serif);
        font-size: clamp(3rem, 7vw, 5.5rem);
        font-weight: 400;
        line-height: 1.05;
        color: #fff;
        margin-bottom: 20px;
    }
    .cat-hero-title em {
        color: var(--terracotta);
        font-style: italic;
    }
    .cat-hero-desc {
        font-size: .95rem;
        color: rgba(255,255,255,.65);
        max-width: 520px;
        margin: 0 auto 40px;
        line-height: 1.8;
    }
    .cat-hero-btns {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
        flex-wrap: wrap;
    }
    .btn-hero-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 13px 36px;
        background: var(--terracotta);
        color: #fff;
        font-size: .75rem;
        letter-spacing: .16em;
        text-transform: uppercase;
        border-radius: 2px;
        transition: background .2s, transform .2s;
        font-family: var(--sans);
    }
    .btn-hero-primary:hover { background: var(--terra-dark); transform: translateY(-2px); }
    .btn-hero-secondary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 13px 36px;
        background: rgba(255,255,255,.08);
        color: #fff;
        font-size: .75rem;
        letter-spacing: .16em;
        text-transform: uppercase;
        border-radius: 2px;
        border: 1px solid rgba(255,255,255,.25);
        transition: background .2s;
        font-family: var(--sans);
        backdrop-filter: blur(4px);
    }
    .btn-hero-secondary:hover { background: rgba(255,255,255,.15); }
    .cat-stats-bar {
        position: relative;
        z-index: 2;
        border-top: 1px solid rgba(255,255,255,.1);
        padding: 32px 0;
        display: flex;
        justify-content: center;
        gap: 0;
        flex-wrap: wrap;
    }
    .stat-item {
        flex: 1;
        max-width: 220px;
        text-align: center;
        padding: 0 32px;
        border-right: 1px solid rgba(255,255,255,.12);
    }
    .stat-item:last-child { border-right: none; }
    .stat-number {
        font-family: var(--serif);
        font-size: 2.8rem;
        font-weight: 600;
        color: var(--terracotta);
        line-height: 1;
        margin-bottom: 6px;
    }
    .stat-label {
        font-size: .72rem;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: rgba(255,255,255,.45);
    }
    .cat-hero-bar { height: 3px; background: var(--terracotta); }
    .section-header { display: flex; align-items: baseline; gap: 20px; margin: 48px 0 40px; }
    .section-title { font-family: var(--serif); font-size: 2rem; font-weight: 400; color: var(--ink); }
    .section-line { flex: 1; height: 1px; background: var(--border); margin-bottom: 4px; }
    .posts-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 36px; margin-bottom: 80px; }
    .post-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 4px;
        overflow: hidden;
        transition: box-shadow .25s, transform .25s;
    }
    .post-card:hover {
        box-shadow: 0 12px 40px rgba(42,32,24,.10);
        transform: translateY(-4px);
    }
    .post-image {
        height: 220px;
        overflow: hidden;
        position: relative;
    }
    .post-image img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    .post-card:hover .post-image img { transform: scale(1.08); }
    .post-content { padding: 28px 28px 32px; }
    .post-meta {
        font-size: .72rem;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 10px;
    }
    .post-title {
        font-family: var(--serif);
        font-size: 1.35rem;
        font-weight: 400;
        line-height: 1.35;
        margin-bottom: 12px;
        color: var(--ink);
        transition: color .2s;
    }
    .post-card:hover .post-title { color: var(--terracotta); }
    .post-excerpt {
        font-size: .85rem;
        color: var(--muted);
        line-height: 1.75;
        margin-bottom: 20px;
    }
    .read-more {
        font-size: .72rem;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: var(--terracotta);
        border-bottom: 1px solid var(--terracotta);
        padding-bottom: 2px;
        transition: color .2s;
    }
    .read-more:hover { color: var(--terra-dark); border-color: var(--terra-dark); }
    .empty-state { text-align: center; padding: 80px 20px; }
    .empty-state i { font-size: 3rem; color: var(--border); margin-bottom: 1rem; display: block; }
    .empty-state h3 { font-family: var(--serif); font-size: 1.6rem; font-weight: 400; margin-bottom: 10px; }
    .empty-state p { font-size: .85rem; color: var(--muted); }
    .categories-strip { padding: 0 0 60px; }
    .categories-strip h3 { font-family: var(--serif); font-size: 1.5rem; font-weight: 400; color: var(--ink); margin-bottom: 1rem; }
    .cat-tags { display: flex; flex-wrap: wrap; gap: 10px; }
    .cat-tag {
        padding: 7px 18px;
        border: 1px solid var(--border);
        border-radius: 100px;
        font-size: .72rem;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--muted);
        transition: background .2s, color .2s, border-color .2s;
    }
    .cat-tag:hover, .cat-tag.active { background: var(--terracotta); color: #fff; border-color: var(--terracotta); }
    @media (max-width: 960px) {
        .posts-grid { grid-template-columns: repeat(2, 1fr); }
        .cat-stats-bar { flex-wrap: wrap; }
        .stat-item { flex: 0 0 50%; max-width: 50%; border-right: none; border-bottom: 1px solid rgba(255,255,255,.12); padding: 16px; }
        .stat-item:nth-child(odd) { border-right: 1px solid rgba(255,255,255,.12); }
    }
    @media (max-width: 640px) {
        .container { padding: 0 20px; }
        .posts-grid { grid-template-columns: 1fr; }
        .cat-hero { min-height: 420px; }
        .cat-hero-title { font-size: 2.8rem; }
        .stat-item { flex: 0 0 100%; border-right: none; }
    }
</style>
@endpush

@section('content')
<section class="cat-hero">
    <div class="cat-hero-bg">
        @if($categorie->image)
            <img src="{{ asset('img/' . $categorie->image) }}" alt="{{ $categorie->name }}">
        @else
            <div class="cat-hero-bg-fallback"></div>
        @endif
    </div>
    <div class="cat-hero-content">
        <div class="cat-hero-badge">Browse by category</div>
        <h1 class="cat-hero-title">
            Explore <em>{{ $categorie->name }}</em>
        </h1>
        <p class="cat-hero-desc">
            {{ $categorie->description ?: 'Découvrez tous les articles de cette catégorie — des idées claires, des analyses profondes et des récits qui comptent.' }}
        </p>
        <div class="cat-hero-btns">
            <a href="{{ route('blog') }}" class="btn-hero-primary">
                Tous les articles <i class="fas fa-arrow-right"></i>
            </a>
            <a href="{{ route('home') }}" class="btn-hero-secondary">
                Accueil
            </a>
        </div>
    </div>
    <div class="cat-stats-bar">
        <div class="stat-item">
            <div class="stat-number">{{ $posts->count() }}</div>
            <div class="stat-label">Article{{ $posts->count() > 1 ? 's' : '' }}</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $posts->sum('vues') }}</div>
            <div class="stat-label">Lectures</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $posts->pluck('user_id')->unique()->count() }}</div>
            <div class="stat-label">Auteur{{ $posts->pluck('user_id')->unique()->count() > 1 ? 's' : '' }}</div>
        </div>
        @if(isset($allCategories))
        <div class="stat-item">
            <div class="stat-number">{{ $allCategories->count() }}</div>
            <div class="stat-label">Catégories</div>
        </div>
        @endif
    </div>
</section>
<div class="cat-hero-bar"></div>

<div class="container">
    @if($posts->isEmpty())
        <div class="empty-state">
            <i class="far fa-newspaper"></i>
            <h3>No articles yet</h3>
            <p>Aucun article dans cette catégorie pour l'instant.</p>
        </div>
    @else
        <div class="section-header">
            <h2 class="section-title">{{ $posts->count() }} article{{ $posts->count() > 1 ? 's' : '' }}</h2>
            <div class="section-line"></div>
        </div>
        <div class="posts-grid">
            @foreach($posts as $post)
            <div class="post-card">
                <div class="post-image">
                    <img src="{{ asset('img/' . $post->image) }}" alt="{{ $post->title }}">
                </div>
                <div class="post-content">
                    <div class="post-meta">{{ $post->created_at->format('d M Y') }}</div>
                    <h3 class="post-title">{{ $post->title }}</h3>
                    <p class="post-excerpt">{{ Str::limit($post->description, 100) }}</p>
                    <a href="{{ route('fullpost', $post->id) }}" class="read-more">Read More →</a>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    @if(isset($allCategories) && $allCategories->count())
    <div class="categories-strip">
        <h3>Browse other categories</h3>
        <div class="cat-tags">
            @foreach($allCategories as $cat)
                <a href="/category/{{ $cat->slug }}"
                   class="cat-tag {{ $cat->id === $categorie->id ? 'active' : '' }}">
                    {{ $cat->name }}
                    <span style="opacity:.6;font-size:.68rem;">({{ $cat->posts_count }})</span>
                </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    function toggleNotifs() {
        const d = document.getElementById('notifDropdown');
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
        if (!e.target.closest('#notifWrap') && !e.target.closest('#notifDropdown')) {
            const d = document.getElementById('notifDropdown');
            if (d) d.style.display = 'none';
        }
        const dropdown = document.querySelector('.avatar-dropdown');
        if (dropdown && !dropdown.contains(e.target)) {
            const d = document.getElementById('avatarDropdown');
            if (d) d.style.display = 'none';
        }
    });
</script>
@endpush