@extends('layouts.app')

@section('title', 'Toutes les catégories – LaraBlog')

@push('styles')
<style>
    .hero-categories {
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
    .categories-section {
        padding: 4rem 0;
    }
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 32px;
        margin-bottom: 48px;
    }
    .category-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        text-decoration: none;
        display: block;
        color: inherit;
    }
    .category-card:hover { 
        box-shadow: 0 15px 40px rgba(42,32,24,0.12); 
        transform: translateY(-5px);
    }
    .category-img {
        position: relative;
        height: 200px;
        overflow: hidden;
    }
    .category-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }
    .category-card:hover .category-img img {
        transform: scale(1.06);
    }
    .category-fallback {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--warm-off), #ede0cc);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--terracotta);
        font-size: 3rem;
    }
    .category-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(42,32,24,0.6) 0%, transparent 50%);
    }
    .category-body {
        padding: 20px;
        text-align: center;
    }
    .category-name {
        font-family: var(--serif);
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--ink);
        margin-bottom: 8px;
    }
    .category-count {
        font-size: 0.8rem;
        color: var(--terracotta);
        font-weight: 500;
    }
    .no-results {
        text-align: center;
        padding: 4rem;
        color: var(--muted);
    }
    .no-results i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
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
    .pagination {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin: 48px 0 64px;
    }
    .pagination a, .pagination span {
        padding: 10px 16px;
        border: 1px solid var(--border);
        border-radius: 6px;
        text-decoration: none;
        color: var(--muted);
        transition: all 0.2s;
    }
    .pagination a:hover {
        background: var(--terracotta);
        color: #fff;
        border-color: var(--terracotta);
    }
    .pagination .active span {
        background: var(--terracotta);
        color: #fff;
        border-color: var(--terracotta);
    }
    @media (max-width: 768px) {
        .categories-grid { grid-template-columns: 1fr; }
        .hero-categories { min-height: 35vh; }
    }
</style>
@endpush

@section('content')
<section class="hero-categories">
    <div class="hero-bg">
        <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=1600&q=80" alt="Catégories">
    </div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Toutes nos catégories</h1>
        <p>Explorez tous les univers éditoriaux de LaraBlog</p>
        <div class="search-container">
            <form method="GET" action="{{ route('categories.all') }}" class="search-bar">
                <input type="text" name="search" placeholder="Rechercher une catégorie..." value="{{ request('search') }}">
                <button type="submit">
                    <i class="fas fa-search"></i> Chercher
                </button>
            </form>
        </div>
    </div>
</section>

<div class="categories-section">
    <div class="container">
        @if($categories->count() > 0)
            <div class="categories-grid">
                @foreach($categories as $category)
                <a href="/category/{{ $category->slug }}" class="category-card">
                    <div class="category-img">
                        @if($category->image)
                            <img src="{{ asset('img/' . $category->image) }}" alt="{{ $category->name }}">
                        @else
                            <div class="category-fallback">
                                <i class="fas fa-layer-group"></i>
                            </div>
                        @endif
                        <div class="category-overlay"></div>
                    </div>
                    <div class="category-body">
                        <h3 class="category-name">{{ $category->name }}</h3>
                        <p class="category-count">{{ $category->posts_count }} article{{ $category->posts_count > 1 ? 's' : '' }}</p>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="pagination">
                {{ $categories->appends(['search' => request('search')])->links() }}
            </div>
        @else
            <div class="no-results">
                <i class="fas fa-folder-open"></i>
                <h3>Aucune catégorie trouvée</h3>
                <p>Essayez une autre recherche ou revenez plus tard.</p>
                <a href="{{ route('categories.all') }}" class="btn" style="margin-top: 1rem;">
                    Réinitialiser la recherche
                </a>
            </div>
        @endif
    </div>
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