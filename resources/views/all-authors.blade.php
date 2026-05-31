@extends('layouts.app')

@section('title', 'Tous nos auteurs – LaraBlog')

@push('styles')
<style>
    .hero-author {
        position: relative;
        width: 100%;
        min-height: 50vh;
        background: linear-gradient(135deg, #2a241e 0%, #1a1612 100%);
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .hero-author-bg {
        position: absolute;
        inset: 0;
        z-index: 0;
    }
    .hero-author-bg img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.6;
    }
    .hero-author-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(42,32,24,0.85) 0%, rgba(26,22,18,0.75) 100%);
        z-index: 1;
    }
    .hero-author-content {
        position: relative;
        z-index: 2;
        text-align: center;
        max-width: 800px;
        padding: 4rem var(--edge-padding);
    }
    .hero-author-content h1 {
        font-family: var(--serif);
        font-size: clamp(2.5rem, 6vw, 4rem);
        font-weight: 400;
        color: #fff;
        margin-bottom: 1rem;
        letter-spacing: -0.5px;
    }
    .hero-author-content p {
        font-size: 1rem;
        color: rgba(255,255,255,0.8);
        margin-bottom: 2rem;
    }
    .search-container {
        max-width: 600px;
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
    .authors-section {
        padding: 4rem 0;
    }
    .authors-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 32px;
        margin-bottom: 48px;
    }
    .author-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 2rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: block;
        color: inherit;
        position: relative;
    }
    .author-card:hover { 
        box-shadow: 0 15px 40px rgba(42,32,24,0.12); 
        transform: translateY(-5px);
    }
    .author-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 16px;
    }
    .author-avatar {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: var(--terracotta);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        font-weight: 500;
        border: 3px solid var(--terracotta);
        overflow: hidden;
        flex-shrink: 0;
    }
    .author-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .author-info { flex: 1; }
    .author-name { 
        font-family: var(--serif); 
        font-size: 1.3rem; 
        font-weight: 600; 
        color: var(--ink); 
        margin: 0 0 4px;
    }
    .author-role {
        font-size: 0.75rem;
        color: var(--terracotta);
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }
    .author-bio { 
        font-size: 0.85rem; 
        color: var(--muted); 
        margin: 0 0 16px; 
        line-height: 1.6;
    }
    .author-stats {
        display: flex;
        justify-content: space-around;
        padding: 12px 0;
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
        margin-bottom: 16px;
    }
    .stat-item { text-align: center; }
    .stat-number {
        font-family: var(--serif);
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--terracotta);
    }
    .stat-label {
        font-size: 0.7rem;
        color: var(--muted);
        text-transform: uppercase;
    }
    .follow-btn {
        width: 100%;
        padding: 10px;
        border: 1.5px solid var(--terracotta);
        background: transparent;
        color: var(--terracotta);
        border-radius: 60px;
        cursor: pointer;
        font-family: var(--sans);
        font-size: 0.75rem;
        font-weight: 500;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        transition: all 0.2s;
    }
    .follow-btn:hover {
        background: var(--terracotta);
        color: #fff;
    }
    .follow-btn.following {
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
    @media (max-width: 768px) {
        .authors-grid { grid-template-columns: 1fr; }
        .hero-author { min-height: 35vh; }
    }
</style>
@endpush

@section('content')
<section class="hero-author">
    <div class="hero-author-bg">
        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1600&q=80" alt="Nos auteurs">
    </div>
    <div class="hero-author-overlay"></div>
    <div class="hero-author-content">
        <h1>Nos Auteurs</h1>
        <p>Découvrez la communauté d'écrivains passionnés qui font vivre LaraBlog</p>
        <div class="search-container">
            <form method="GET" action="{{ route('authors.all') }}" class="search-bar">
                <input type="text" name="search" placeholder="Rechercher un auteur par nom..." value="{{ request('search') }}">
                <button type="submit">
                    <i class="fas fa-search"></i> Rechercher
                </button>
            </form>
        </div>
    </div>
</section>

<div class="page">
    <div class="container">
        <div class="authors-section">
            @if($auteurs->count() > 0)
                <div class="authors-grid">
                    @foreach($auteurs as $auteur)
                    <div class="author-card">
                        <div class="author-header">
                            <div class="author-avatar">
                                @if($auteur->avatar)
                                    <img src="{{ asset('img/' . $auteur->avatar) }}" alt="{{ $auteur->name }}">
                                @else
                                    {{ strtoupper(substr($auteur->name, 0, 2)) }}
                                @endif
                            </div>
                            <div class="author-info">
                                <h3 class="author-name">{{ $auteur->name }}</h3>
                                <div class="author-role">Auteur</div>
                            </div>
                        </div>
                        <p class="author-bio">{{ \Illuminate\Support\Str::limit($auteur->bio ?? 'Passionné par l\'écriture et le partage de connaissances.', 100) }}</p>
                        <div class="author-stats">
                            <div class="stat-item">
                                <div class="stat-number">{{ $auteur->posts_count ?? 0 }}</div>
                                <div class="stat-label">Articles</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">{{ $auteur->followers_count ?? 0 }}</div>
                                <div class="stat-label">Abonnés</div>
                            </div>
                        </div>
                        @auth
                            @if(Auth::user()->id != $auteur->id)
                            <form action="{{ route('follow.toggle', $auteur->id) }}" method="POST" class="follow-form">
                                @csrf
                                <button type="submit" class="follow-btn {{ Auth::user()->following->contains($auteur->id) ? 'following' : '' }}">
                                    {{ Auth::user()->following->contains($auteur->id) ? '✓ Following' : '+ Follow' }}
                                </button>
                            </form>
                            @else
                            <button class="follow-btn" disabled style="opacity:0.5; cursor:not-allowed;">Vous-même</button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="follow-btn" style="display: block; text-align: center; text-decoration: none;">
                                Se connecter pour suivre
                            </a>
                        @endauth
                        <a href="{{ route('auteur.profile', $auteur->id) }}" style="display: block; text-align: center; margin-top: 12px; font-size: 0.75rem; color: var(--terracotta); text-decoration: none;">
                            Voir le profil →
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="pagination">
                    {{ $auteurs->appends(['search' => request('search')])->links() }}
                </div>
            @else
                <div class="no-results">
                    <i class="fas fa-user-slash"></i>
                    <h3>Aucun auteur trouvé</h3>
                    <p>Essayez une autre recherche ou revenez plus tard.</p>
                    <a href="{{ route('authors.all') }}" class="follow-btn" style="display: inline-block; margin-top: 1rem; padding: 10px 24px; text-decoration: none;">
                        Réinitialiser la recherche
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
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