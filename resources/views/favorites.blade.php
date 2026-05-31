@extends('layouts.app')

@section('title', 'Mes favoris – LaraBlog')

@push('styles')
<style>
    .hero-favorites {
        position: relative;
        width: 100%;
        min-height: 45vh;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        border-right: 1em solid var(--cream);
        border-left: 1em solid var(--cream);
    }
    .hero-bg {
        position: absolute;
        inset: 0;
        z-index: 0;
    }
    .hero-bg img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(42,32,24,0.75) 0%, rgba(26,22,18,0.65) 100%);
        z-index: 1;
    }
    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        max-width: 800px;
        padding: 4rem var(--edge-padding);
    }
    .hero-content h1 {
        font-family: var(--serif);
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 400;
        color: #fff;
        margin-bottom: 1rem;
        letter-spacing: -0.5px;
    }
    .hero-content p {
        font-size: 1rem;
        color: rgba(255,255,255,0.85);
        margin-bottom: 2rem;
    }
    .search-container {
        max-width: 500px;
        margin: 0 auto;
    }
    .search-bar {
        display: flex;
        background: #fff;
        border-radius: 60px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        border: 1px solid var(--border);
    }
    .search-bar input {
        flex: 1;
        padding: 14px 24px;
        border: none;
        font-family: var(--sans);
        font-size: 0.9rem;
        outline: none;
        color: var(--ink);
    }
    .search-bar input::placeholder {
        color: #aaa;
        font-style: italic;
    }
    .search-bar button {
        padding: 14px 28px;
        background: var(--terracotta);
        border: none;
        color: #fff;
        cursor: pointer;
        transition: background 0.2s;
        font-family: var(--sans);
        font-size: 0.85rem;
    }
    .search-bar button:hover {
        background: var(--terra-dark);
    }
    .favorites-section {
        padding: 4rem 0;
    }
    .favorites-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        margin-bottom: 48px;
    }
    .favorite-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .favorite-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(42,32,24,0.12);
    }
    .favorite-img {
        height: 220px;
        overflow: hidden;
        position: relative;
    }
    .favorite-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .favorite-card:hover .favorite-img img {
        transform: scale(1.06);
    }
    .favorite-category {
        position: absolute;
        top: 15px;
        left: 15px;
        background: var(--terracotta);
        color: #fff;
        font-size: 0.7rem;
        padding: 4px 12px;
        border-radius: 20px;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        z-index: 2;
    }
    .favorite-body {
        padding: 1.5rem;
    }
    .favorite-title {
        font-family: var(--serif);
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--ink);
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }
    .favorite-title a:hover {
        color: var(--terracotta);
    }
    .favorite-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        font-size: 0.75rem;
        color: var(--muted);
        margin-bottom: 0.75rem;
    }
    .favorite-excerpt {
        font-size: 0.85rem;
        color: var(--muted);
        line-height: 1.6;
        margin-bottom: 1.25rem;
    }
    .favorite-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 0.5rem;
    }
    .read-more-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 20px;
        background: var(--terracotta);
        color: #fff;
        border: none;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 500;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        text-decoration: none;
        transition: all 0.2s ease;
        cursor: pointer;
    }
    .read-more-btn:hover {
        background: var(--terra-dark);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(192, 98, 58, 0.3);
    }
    .remove-favorite {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: none;
        border: 1px solid var(--border);
        padding: 7px 16px;
        border-radius: 30px;
        cursor: pointer;
        font-size: 0.75rem;
        color: var(--muted);
        transition: all 0.2s;
    }
    .remove-favorite:hover {
        background: #c0392b;
        color: #fff;
        border-color: #c0392b;
    }
    .no-results {
        text-align: center;
        padding: 4rem;
        color: var(--muted);
    }
    .no-results i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
    .btn {
        display: inline-block;
        padding: 11px 26px;
        border: 1px solid var(--terracotta);
        color: var(--terracotta);
        font-size: .73rem;
        text-transform: uppercase;
        border-radius: 2px;
        transition: all .2s;
        text-decoration: none;
    }
    .btn:hover {
        background: var(--terracotta);
        color: #fff;
    }
    .pagination {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin: 48px 0;
    }
    .pagination a, .pagination span {
        padding: 8px 14px;
        border: 1px solid var(--border);
        border-radius: 4px;
        text-decoration: none;
        color: var(--muted);
    }
    .pagination a:hover {
        background: var(--terracotta);
        color: #fff;
    }
    @media (max-width: 1024px) {
        .favorites-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .favorites-grid { grid-template-columns: 1fr; }
        .hero-favorites { min-height: 35vh; }
        .favorite-actions {
            flex-direction: column;
            gap: 0.75rem;
        }
        .read-more-btn, .remove-favorite {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<section class="hero-favorites">
    <div class="hero-bg">
        <img src="https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?w=1600&q=80" alt="Mes favoris">
    </div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Mes favoris</h1>
        <p>Retrouvez tous les articles que vous avez sauvegardés</p>
        <div class="search-container">
            <form method="GET" action="{{ route('favorites.index') }}" class="search-bar">
                <input type="text" name="search" placeholder="Rechercher dans mes favoris..." value="{{ request('search') }}">
                <button type="submit">
                    <i class="fas fa-search"></i> Chercher
                </button>
            </form>
        </div>
    </div>
</section>

<section class="favorites-section">
    <div class="container">
        @if($favorites->count() > 0)
            <div class="favorites-grid">
                @foreach($favorites as $post)
                <div class="favorite-card">
                    <a href="{{ route('fullpost', $post->id) }}">
                        <div class="favorite-img">
                            @if($post->image)
                                <img src="{{ asset('img/' . $post->image) }}" alt="{{ $post->title }}">
                            @else
                                <div style="width:100%;height:100%;background:var(--warm-off);display:flex;align-items:center;justify-content:center;">
                                    <i class="far fa-image" style="font-size:2rem;color:var(--border);"></i>
                                </div>
                            @endif
                            @if($post->categorie)
                                <span class="favorite-category">{{ $post->categorie->name }}</span>
                            @endif
                        </div>
                    </a>
                    <div class="favorite-body">
                        <h3 class="favorite-title">
                            <a href="{{ route('fullpost', $post->id) }}">{{ $post->title }}</a>
                        </h3>
                        <div class="favorite-meta">
                            <span><i class="far fa-calendar"></i> {{ $post->created_at->format('d M Y') }}</span>
                            <span><i class="far fa-eye"></i> {{ $post->vues }} vues</span>
                        </div>
                        <p class="favorite-excerpt">{{ Str::limit(strip_tags($post->description ?? $post->title), 120) }}</p>
                        <div class="favorite-actions">
                            <a href="{{ route('fullpost', $post->id) }}" class="read-more-btn">
                                <i class="fas fa-book-open"></i> Lire la suite
                            </a>
                            <form action="{{ route('favorite.toggle', $post->id) }}" method="POST" class="remove-form">
                                @csrf
                                <button type="submit" class="remove-favorite">
                                    <i class="fas fa-trash-alt"></i> Retirer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="pagination">
                {{ $favorites->appends(['search' => request('search')])->links() }}
            </div>
        @else
            <div class="no-results">
                <i class="far fa-bookmark"></i>
                <h3>Aucun article dans vos favoris</h3>
                <p>Commencez à sauvegarder vos articles préférés</p>
                <a href="{{ route('blog') }}" class="btn" style="margin-top: 1rem;">Explorer les articles</a>
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.remove-form').forEach(form => {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({})
            });
            if (response.ok) {
                const card = form.closest('.favorite-card');
                card.style.opacity = '0.5';
                setTimeout(() => card.remove(), 300);
                if (document.querySelectorAll('.favorite-card').length === 0) {
                    location.reload();
                }
            }
        });
    });
</script>
@endpush