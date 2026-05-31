@extends('layouts.app')

@section('title', $auteur->name . ' — LaraBlog')

@push('styles')
<style>
    .auteur-hero {
        position: relative;
        background: var(--warm-off);
        border-bottom: 1px solid var(--border);
        padding: 80px 0 60px;
        overflow: hidden;
    }
    .auteur-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
        opacity: .5;
        pointer-events: none;
    }
    .auteur-hero::after {
        content: '"';
        position: absolute;
        right: 6%;
        top: -30px;
        font-family: var(--serif);
        font-size: 22rem;
        font-weight: 600;
        color: var(--border);
        opacity: .35;
        line-height: 1;
        pointer-events: none;
        user-select: none;
    }
    .auteur-hero-inner {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 3rem;
        align-items: start;
        position: relative;
        z-index: 1;
    }
    .auteur-left {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 16px;
    }
    .auteur-avatar-wrap { position: relative; }
    .auteur-avatar-wrap::before {
        content: '';
        position: absolute;
        inset: -6px;
        border-radius: 50%;
        border: 2px dashed var(--terracotta);
        opacity: .3;
        animation: spin 20s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
    .auteur-avatar-lg {
        width: 120px; height: 120px;
        border-radius: 50%;
        background: var(--terracotta);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--serif);
        font-size: 3.2rem;
        font-weight: 600;
        overflow: hidden;
        border: 4px solid #fff;
        box-shadow: 0 12px 32px rgba(192,98,58,.25);
        position: relative;
    }
    .auteur-avatar-lg img { width: 100%; height: 100%; object-fit: cover; }
    .follow-btn {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: 10px 24px;
        border-radius: 2px;
        font-family: var(--sans);
        font-size: .73rem;
        font-weight: 500;
        letter-spacing: .1em;
        text-transform: uppercase;
        cursor: pointer;
        transition: all .2s;
        border: 1px solid transparent;
        white-space: nowrap;
    }
    .follow-btn.not-following { background: var(--terracotta); color: #fff; border-color: var(--terracotta); }
    .follow-btn.not-following:hover { background: var(--terra-dark); border-color: var(--terra-dark); }
    .follow-btn.following { background: transparent; color: var(--terracotta); border-color: var(--border); }
    .follow-btn.following:hover { background: #fff5f5; color: #c0392b; border-color: #c0392b; }
    .follow-btn.following .btn-label { display: none; }
    .follow-btn.following:hover .btn-label { display: inline; }
    .follow-btn.following .btn-label-default { display: inline; }
    .follow-btn.following:hover .btn-label-default { display: none; }
    .auteur-info { padding-top: .5rem; }
    .auteur-eyebrow {
        font-size: .65rem;
        letter-spacing: .22em;
        text-transform: uppercase;
        color: var(--terracotta);
        margin-bottom: .6rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .auteur-eyebrow::after {
        content: '';
        display: inline-block;
        width: 32px;
        height: 1px;
        background: var(--terracotta);
        opacity: .5;
    }
    .auteur-info h1 {
        font-family: var(--serif);
        font-size: clamp(2.4rem, 5vw, 3.4rem);
        font-weight: 400;
        color: var(--ink);
        line-height: 1.05;
        letter-spacing: -.5px;
    }
    .auteur-bio {
        font-size: .88rem;
        color: var(--muted);
        margin-top: .9rem;
        line-height: 1.85;
        max-width: 520px;
        border-left: 3px solid var(--terracotta);
        padding-left: 14px;
    }
    .auteur-stats {
        display: flex;
        gap: 0;
        margin-top: 2rem;
        border: 1px solid var(--border);
        border-radius: 4px;
        background: #fff;
        overflow: hidden;
        width: fit-content;
    }
    .auteur-stat {
        text-align: center;
        padding: 16px 32px;
        border-right: 1px solid var(--border);
        transition: background .2s;
    }
    .auteur-stat:last-child { border-right: none; }
    .auteur-stat:hover { background: var(--warm-off); }
    .auteur-stat .num {
        font-family: var(--serif);
        font-size: 2rem;
        font-weight: 600;
        color: var(--terracotta);
        line-height: 1;
    }
    .auteur-stat .lbl {
        font-size: .62rem;
        color: var(--muted);
        letter-spacing: .14em;
        text-transform: uppercase;
        margin-top: 4px;
    }
    .auteur-topics {
        display: flex;
        flex-wrap: wrap;
        gap: .45rem;
        margin-top: 1.6rem;
    }
    .topic-pill {
        font-size: .7rem;
        font-weight: 500;
        color: var(--muted);
        background: #fff;
        border: 1px solid var(--border);
        padding: .3rem .9rem;
        border-radius: 100px;
        transition: all .2s;
        letter-spacing: .04em;
    }
    .topic-pill:hover { background: var(--warm-off); color: var(--ink); border-color: var(--ink); }
    .topic-pill.active { background: var(--terracotta); color: #fff; border-color: var(--terracotta); }
    .auteur-posts { padding: 5rem 0 7rem; }
    .section-header {
        display: flex;
        align-items: baseline;
        gap: 20px;
        margin: 0 0 3rem;
    }
    .section-title {
        font-family: var(--serif);
        font-size: 2.1rem;
        font-weight: 400;
        color: var(--ink);
        white-space: nowrap;
    }
    .section-title em { font-style: italic; color: var(--terracotta); }
    .section-line { flex: 1; height: 1px; background: var(--border); margin-bottom: 4px; }
    .posts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 28px;
    }
    .post-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 4px;
        overflow: hidden;
        transition: box-shadow .3s, transform .3s;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        position: relative;
    }
    .post-card::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0;
        width: 0; height: 3px;
        background: var(--terracotta);
        transition: width .35s ease;
    }
    .post-card:hover::after { width: 100%; }
    .post-card:hover {
        box-shadow: 0 16px 48px rgba(42,32,24,.12);
        transform: translateY(-5px);
    }
    .post-image { height: 210px; overflow: hidden; position: relative; }
    .post-image img { height: 100%; transition: transform .5s ease; }
    .post-card:hover .post-image img { transform: scale(1.06); }
    .post-image-badge {
        position: absolute;
        top: 12px; left: 12px;
        background: var(--terracotta);
        color: #fff;
        font-size: .6rem;
        letter-spacing: .12em;
        text-transform: uppercase;
        padding: 4px 10px;
        border-radius: 2px;
        z-index: 2;
    }
    .post-no-img {
        height: 210px;
        background: linear-gradient(135deg, var(--warm-off), #ede0cc);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .post-no-img i { font-size: 2.5rem; color: var(--border); }
    .post-content { padding: 22px 22px 26px; flex: 1; display: flex; flex-direction: column; }
    .post-title {
        font-family: var(--serif);
        font-size: 1.2rem;
        font-weight: 400;
        line-height: 1.4;
        margin-bottom: 10px;
        color: var(--ink);
        transition: color .2s;
    }
    .post-card:hover .post-title { color: var(--terracotta); }
    .post-date {
        font-size: .7rem;
        color: var(--muted);
        margin-top: auto;
        padding-top: .75rem;
        display: flex;
        align-items: center;
        gap: 6px;
        border-top: 1px solid var(--border);
    }
    .post-read-more {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: .68rem;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--terracotta);
        margin-top: .8rem;
        opacity: 0;
        transform: translateX(-6px);
        transition: opacity .25s, transform .25s;
    }
    .post-card:hover .post-read-more {
        opacity: 1;
        transform: translateX(0);
    }
    .empty-state {
        text-align: center;
        padding: 100px 20px;
        background: #fff;
        border: 1px dashed var(--border);
        border-radius: 4px;
    }
    .empty-state i { font-size: 3rem; color: var(--border); display: block; margin-bottom: 1.2rem; }
    .empty-state p { font-size: .88rem; color: var(--muted); }
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .auteur-hero-inner { animation: fadeUp .6s ease both; }
    .auteur-posts .section-header { animation: fadeUp .6s ease .1s both; }
    .posts-grid { animation: fadeUp .6s ease .2s both; }
    @media(max-width: 768px) {
        .auteur-hero-inner { grid-template-columns: 1fr; justify-items: center; text-align: center; }
        .auteur-bio { text-align: left; }
        .auteur-stats { justify-content: center; }
        .auteur-topics { justify-content: center; }
        .auteur-hero::after { display: none; }
        .container { padding: 0 20px; }
    }
    
.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.5);
    backdrop-filter: blur(4px);
    z-index: 1000;
    align-items: center;
    justify-content: center;
    animation: fadeIn .2s;
}
.modal-overlay.active { display: flex; }
.modal {
    background: #fff;
    border-radius: 16px;
    width: 90%;
    max-width: 420px;
    box-shadow: 0 20px 60px rgba(0,0,0,.3);
    overflow: hidden;
    animation: slideUp .25s cubic-bezier(.16,1,.3,1);
}
.modal-header {
    background: var(--warm-off);
    padding: 16px 24px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: .15em;
    color: var(--terracotta);
    text-transform: uppercase;
}
.modal-body { padding: 28px 24px; }
.modal-body h2 {
    font-family: var(--serif);
    font-size: 1.6rem;
    font-weight: 400;
    color: var(--ink);
    margin-bottom: 12px;
}
.modal-body p {
    font-size: 13px;
    color: var(--muted);
    line-height: 1.6;
    margin-bottom: 24px;
}
.modal-actions { display: flex; gap: 12px; justify-content: flex-end; }
.btn-cancel {
    padding: 10px 20px;
    background: transparent;
    border: 1px solid var(--border);
    border-radius: 8px;
    font-size: 12px;
    font-weight: 500;
    color: var(--muted);
    cursor: pointer;
    transition: all .18s;
    font-family: var(--sans);
}
.btn-cancel:hover { background: var(--warm-off); }
.btn-confirm {
    padding: 10px 24px;
    background: var(--terracotta);
    border: none;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: .08em;
    color: #fff;
    cursor: pointer;
    transition: background .18s;
    font-family: var(--sans);
}
.btn-confirm:hover { background: var(--terra-dark); }
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes slideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
@media(max-width: 768px) {
    .profile-danger-zone { text-align: left; }
}
</style>
@endpush

@section('content')
<div class="auteur-hero">
    <div class="container">
        <div class="auteur-hero-inner">
            <div class="auteur-left">
                <div class="auteur-avatar-wrap">
                    <div class="auteur-avatar-lg">
                        @if($auteur->avatar)
                            <img src="{{ asset('img/' . $auteur->avatar) }}" alt="{{ $auteur->name }}">
                        @else
                            {{ strtoupper(substr($auteur->name, 0, 1)) }}
                        @endif
                    </div>
                </div>
                @auth
                    @if(auth()->id() !== $auteur->id)
                        <form method="POST" action="{{ route('follow.toggle', $auteur->id) }}" id="followForm">
                            @csrf
                            <button type="submit" id="followBtn" class="follow-btn {{ $isFollowing ? 'following' : 'not-following' }}">
                                @if($isFollowing)
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                    <span class="btn-label-default">Following</span>
                                    <span class="btn-label">Unfollow</span>
                                @else
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                    Follow
                                @endif
                            </button>
                        </form>
                   @else
    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
        <a href="{{ route('profile.edit') }}" class="follow-btn not-following">
            <i class="fas fa-pen" style="font-size:.65rem"></i> Modifier
        </a>
        
        <button type="button" class="follow-btn not-following" onclick="openDeleteModal()">
            <i class="fas fa-trash" style="font-size:.65rem"></i> Supprimer
        </button>
    </div>
@endif
                @endauth
            </div>
            <div class="auteur-info">
                <div class="auteur-eyebrow">Writer &amp; Creator</div>
                <h1>{{ $auteur->name }}</h1>
                @if($auteur->bio)
                    <div class="auteur-bio">{{ $auteur->bio }}</div>
                @endif
                <div class="auteur-stats">
                    <div class="auteur-stat">
                        <div class="num">{{ $posts->count() }}</div>
                        <div class="lbl">Articles</div>
                    </div>
                    <div class="auteur-stat">
                        <div class="num">{{ $categories->count() }}</div>
                        <div class="lbl">Topics</div>
                    </div>
                    <div class="auteur-stat" id="followers-stat">
                        <div class="num" id="followers-count">{{ $auteur->followers()->count() }}</div>
                        <div class="lbl">Followers</div>
                    </div>
                </div>
                @if($categories->count())
                    <div class="auteur-topics">
                        <a href="{{ route('auteur.profile', $auteur->id) }}" class="topic-pill {{ !isset($categorie) ? 'active' : '' }}">All</a>
                        @foreach($categories as $cat)
                            <a href="{{ route('auteur.category', [$auteur->id, $cat->slug]) }}" class="topic-pill {{ isset($categorie) && $categorie->id === $cat->id ? 'active' : '' }}">
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="auteur-posts">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title"><em>Articles</em> by {{ $auteur->name }}</h2>
            <div class="section-line"></div>
        </div>
        @if($posts->count())
            <div class="posts-grid">
                @foreach($posts as $post)
                    <a href="{{ route('fullpost', $post->id) }}" class="post-card">
                        @if($post->image)
                            <div class="post-image">
                                @if($post->categorie)
                                    <span class="post-image-badge">{{ $post->categorie->name }}</span>
                                @endif
                                <img src="{{ asset('img/' . $post->image) }}" alt="{{ $post->title }}">
                            </div>
                        @else
                            <div class="post-no-img"><i class="far fa-file-alt"></i></div>
                        @endif
                        <div class="post-content">
                            <div class="post-title">{{ $post->title }}</div>
                            <div class="post-read-more">
                                Lire l'article <i class="fas fa-arrow-right" style="font-size:.6rem"></i>
                            </div>
                            <div class="post-date">
                                <i class="far fa-calendar"></i>
                                {{ $post->created_at->format('F j, Y') }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="far fa-file-alt"></i>
                <p>Aucun article publié pour le moment.</p>
            </div>
        @endif
    </div>
    

{{-- MODALE SUPPRESSION COMPTE --}}
<div class="modal-overlay" id="deleteModal" onclick="closeDeleteModal()">
    <div class="modal" onclick="event.stopPropagation()">
        <div class="modal-header">
            <i class="fas fa-lock modal-icon"></i>
            <span>SUPPRESSION DU COMPTE</span>
        </div>
        
        <div class="modal-body">
            <h2>Supprimer {{ $auteur->name }} ?</h2>
            <p>Cette action est irréversible. Toutes vos données, publications et commentaires seront supprimés définitivement.</p>
            
            <form method="POST" action="{{ route('profile.destroy') }}" id="deleteForm">
                @csrf
                @method('DELETE')
                
                <div style="margin-bottom: 16px;">
                    <label style="display:block; font-size:12px; color:var(--muted); margin-bottom:6px;">
                        Mot de passe pour confirmer
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        required 
                        placeholder="Votre mot de passe"
                        style="width:100%; padding:10px 12px; border:1px solid var(--border); border-radius:8px; font-family:var(--sans); font-size:13px;"
                    >
                    @error('password', 'userDeletion')
                        <p style="color:var(--red); font-size:12px; margin-top:6px;">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeDeleteModal()">Annuler</button>
                    <button type="submit" class="btn-confirm">SUPPRIMER</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection

@push('scripts')
<script>
    @if($errors->userDeletion->isNotEmpty())
document.addEventListener('DOMContentLoaded', function() {
    openDeleteModal();
});
@endif

function openDeleteModal() {
    document.getElementById('deleteModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('active');
    document.body.style.overflow = '';
    document.querySelector('#deleteForm input[name="password"]').value = '';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDeleteModal();
    }
});
    const form = document.getElementById('followForm');
    if (form) {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            const btn = document.getElementById('followBtn');
            const res = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            const data = await res.json();
            document.getElementById('followers-count').textContent = data.followers_count;
            if (data.following) {
                btn.className = 'follow-btn following';
                btn.innerHTML = `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg><span class="btn-label-default">Following</span><span class="btn-label">Unfollow</span>`;
            } else {
                btn.className = 'follow-btn not-following';
                btn.innerHTML = `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>Follow`;
            }
        });
    }
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
        if (!e.target.closest('.avatar-dropdown')) {
            const d = document.getElementById('avatarDropdown');
            if (d) d.style.display = 'none';
        }
        if (!e.target.closest('#notifWrap')) {
            const d = document.getElementById('notifDropdown');
            if (d) d.style.display = 'none';
        }
    });
</script>
@endpush