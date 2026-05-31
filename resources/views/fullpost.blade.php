@extends('layouts.app')

@section('title', $post->title . ' — LaraBlog')

@push('styles')
<style>
    /* ─── HERO : style Kyoto — parallax plein écran, titre en bas ─── */
    .post-hero {
        position: relative;
        overflow: hidden;
        border-left: 1em solid var(--cream);
        border-right: 1em solid var(--cream);
        min-height: 89vh;
        background-size: cover;
        background-position: 50% 10%;
        background-attachment: fixed;
        background-repeat: no-repeat;
        display: flex;
        align-items: flex-end;
    }

    .post-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: inherit;
        background-attachment: inherit;
        background-size: inherit;
        background-position: inherit;
        transition: transform 8s ease;
        z-index: 0;
    }
    .post-hero:hover::before { transform: scale(1.03); }

    .post-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(0deg, rgba(42,32,24,0.72) 0%, rgba(42,32,24,0) 40%);
        z-index: 1;
    }

    .post-hero-content {
        position: relative;
        z-index: 2;
        max-width: 900px;
        margin: 0 auto;
        padding: 3rem 2.5rem 4rem;
        width: 100%;
    }

    @media (max-width: 1024px) {
        .post-hero {
            background-attachment: scroll !important;
            min-height: 40vh;
        }
        .post-hero::before { background-attachment: scroll !important; }
    }
    @media (max-width: 767px) {
        .post-hero { min-height: 65vh; }
    }

    .post-hero-fallback {
        background: var(--warm-off);
        border-bottom: 1px solid var(--border);
        border-left: 1em solid var(--cream);
        border-right: 1em solid var(--cream);
    }
    .post-hero-fallback .post-hero-content {
        position: static;
        max-width: 900px;
        margin: 0 auto;
        padding: 4rem 2.5rem 3.5rem;
    }

    .breadcrumb { display: flex; align-items: center; gap: .5rem; font-size: .72rem; font-weight: 500; letter-spacing: .1em; text-transform: uppercase; margin-bottom: 1.25rem; }
    .post-hero .breadcrumb { color: rgba(255,255,255,.7); }
    .post-hero-fallback .breadcrumb { color: var(--muted); }
    .breadcrumb a { color: inherit; }
    .breadcrumb a:hover { text-decoration: underline; }
    .breadcrumb i { font-size: .55rem; }

    .post-tags { display: flex; align-items: center; gap: .85rem; margin-bottom: 1rem; flex-wrap: wrap; }
    .post-cat { font-size: .68rem; font-weight: 600; letter-spacing: .12em; text-transform: uppercase; color: #fff; background: var(--terracotta); padding: .3rem .9rem; border-radius: 20px; }
    .post-date-hero { font-size: .78rem; display: flex; align-items: center; gap: .3rem; }
    .post-hero .post-date-hero { color: rgba(255,255,255,.75); }
    .post-hero-fallback .post-date-hero { color: var(--muted); }
    .post-hero .post-title { font-family: var(--serif); font-size: clamp(2.2rem, 5vw, 3.5rem); font-weight: 400; line-height: 1.1; color: #fff; text-shadow: 1px 1px 1px rgba(0,0,0,.4); }
    .post-hero-fallback .post-title { font-family: var(--serif); font-size: clamp(2.2rem, 5vw, 3.5rem); font-weight: 400; line-height: 1.1; color: var(--ink); }

    .post-layout { max-width: 1290px; margin: 0 auto; padding: 5rem 3rem 6rem; display: grid; grid-template-columns: 1fr 300px; gap: 5rem; align-items: start; }
    .post-body { min-width: 0; }
    .post-divider { width: 60px; height: 3px; background: var(--terracotta); border-radius: 2px; margin-bottom: 2.5rem; }

    .post-meta-bar { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2.5rem; padding-bottom: 1.25rem; border-bottom: 1px solid var(--border); font-size: .82rem; color: var(--muted); }
    .post-meta-bar span { display: flex; align-items: center; gap: .35rem; }

    .post-content { font-size: 1.05rem; line-height: 1.9; color: var(--ink); margin-bottom: 3.5rem; }
    .post-content p { margin-bottom: 1.5rem; }
    .post-content h2 { font-family: var(--serif); font-size: 1.8rem; font-weight: 600; color: var(--ink); margin: 2.5rem 0 1rem; }
    .post-content h3 { font-family: var(--serif); font-size: 1.4rem; font-weight: 600; color: var(--ink); margin: 2rem 0 .75rem; }
    .post-content blockquote { border-left: 3px solid var(--terracotta); padding: 1rem 1.5rem; margin: 2rem 0; background: var(--warm-off); border-radius: 0 6px 6px 0; font-family: var(--serif); font-size: 1.2rem; font-style: italic; color: var(--muted); }
    .post-content img { max-width: 100%; border-radius: 4px; margin: 1.5rem 0; }

    .post-footer-bar { border-top: 1px solid var(--border); padding-top: 2rem; margin-bottom: 3.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
    .back-link { display: inline-flex; align-items: center; gap: .5rem; font-size: .78rem; font-weight: 500; letter-spacing: .08em; text-transform: uppercase; color: var(--muted); transition: color .2s; }
    .back-link:hover { color: var(--terracotta); }
    .share-label { font-size: .75rem; font-weight: 600; letter-spacing: .1em; text-transform: uppercase; color: var(--muted); margin-right: .5rem; }
    .share-btns { display: flex; gap: .5rem; align-items: center; }
    .share-btn { width: 36px; height: 36px; border-radius: 50%; border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; color: var(--muted); font-size: .82rem; transition: all .2s; }
    .share-btn:hover { border-color: var(--terracotta); color: var(--terracotta); background: var(--warm-off); }

    .reactions-wrap { margin-bottom: 2rem; padding: 1.25rem 0; border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); }
    .reactions-bar { position: relative; display: inline-flex; align-items: center; gap: .5rem; }
    .reaction-main-btn { display: inline-flex; align-items: center; gap: .4rem; padding: .5rem 1.2rem; border: 1px solid var(--border); border-radius: 30px; cursor: pointer; font-size: .88rem; font-weight: 500; color: var(--muted); background: #fff; transition: all .2s; user-select: none; }
    .reaction-main-btn:hover { border-color: var(--terracotta); color: var(--terracotta); background: var(--warm-off); }
    .reaction-picker { display: none; position: absolute; bottom: 130%; left: 0; background: white; border-radius: 50px; box-shadow: 0 8px 30px rgba(0,0,0,.15); padding: .5rem .75rem; gap: .25rem; z-index: 100; border: 1px solid var(--border); }
    .reaction-picker.show { display: flex; animation: popUp .2s ease; }
    @keyframes popUp { from { opacity:0; transform: scale(0.8) translateY(8px); } to { opacity:1; transform: scale(1) translateY(0); } }
    .reaction-btn { background: none; border: none; cursor: pointer; font-size: 1.6rem; padding: .2rem .3rem; border-radius: 50%; transition: transform .15s; line-height: 1; }
    .reaction-btn:hover { transform: scale(1.4); }
    .reaction-btn.active { transform: scale(1.2); filter: drop-shadow(0 0 4px rgba(192,98,58,.6)); }
    .reaction-counts { display: flex; align-items: center; gap: .75rem; margin-top: .75rem; flex-wrap: wrap; }
    .reaction-count-item { font-size: .85rem; color: var(--muted); }
    .reaction-total { font-size: .78rem; color: var(--muted); margin-left: .5rem; }

    .comments-wrap { border-top: 1px solid var(--border); padding-top: 2.5rem; }
    .comments-heading { font-family: var(--serif); font-size: 1.9rem; font-weight: 400; margin-bottom: 1.5rem; display: flex; align-items: baseline; gap: .75rem; }
    .comments-heading em { font-style: italic; color: var(--terracotta); }
    .comments-count { font-family: var(--sans); font-size: .78rem; font-weight: 500; color: var(--muted); background: var(--warm-off); padding: .2rem .7rem; border-radius: 20px; }
    .comment-card { display: flex; gap: 1rem; padding: 1.5rem 0; border-bottom: 1px solid var(--border); animation: fadeUp .3s ease both; }
    @keyframes fadeUp { from { opacity:0; transform: translateY(10px); } to { opacity:1; transform: translateY(0); } }
    .comment-avatar { width: 42px; height: 42px; border-radius: 50%; background: var(--terracotta); color: #fff; display: flex; align-items: center; justify-content: center; font-family: var(--serif); font-size: 1.1rem; font-weight: 600; flex-shrink: 0; overflow: hidden; }
    .comment-body { flex: 1; }
    .comment-author { font-size: .9rem; font-weight: 600; color: var(--ink); margin-bottom: .1rem; }
    .comment-time { font-size: .75rem; color: var(--muted); margin-bottom: .5rem; }
    .comment-text { font-size: .95rem; line-height: 1.7; color: var(--ink); }
    .comment-empty { text-align: center; padding: 3rem; background: var(--warm-off); border-radius: 4px; margin: 1rem 0; }
    .comment-empty i { font-size: 1.8rem; color: var(--border); display: block; margin-bottom: .75rem; }
    .comment-empty p { font-size: .9rem; color: var(--muted); }
    .comment-form-wrap { margin-top: 2rem; background: #fff; border: 1px solid var(--border); border-radius: 4px; padding: 2rem; }
    .comment-form-title { font-family: var(--serif); font-size: 1.3rem; font-weight: 600; margin-bottom: 1rem; color: var(--ink); }
    .comment-input { width: 100%; padding: .9rem 1.1rem; border: 1px solid var(--border); border-radius: 2px; font-family: var(--sans); font-size: .9rem; font-weight: 300; background: var(--cream); color: var(--ink); resize: vertical; min-height: 100px; outline: none; transition: border-color .2s; }
    .comment-input:focus { border-color: var(--terracotta); }
    .comment-submit { margin-top: 1rem; background: var(--terracotta); color: #fff; border: none; padding: .8rem 2rem; border-radius: 2px; font-family: var(--sans); font-size: .78rem; font-weight: 500; letter-spacing: .08em; text-transform: uppercase; cursor: pointer; transition: background .2s, transform .15s; }
    .comment-submit:hover { background: var(--terra-dark); transform: translateY(-1px); }
    .comment-error { color: #c0392b; font-size: .82rem; margin-top: .5rem; }
    .login-prompt { margin-top: 2rem; text-align: center; padding: 1.75rem; background: var(--warm-off); border-radius: 4px; font-size: .9rem; color: var(--muted); }
    .login-prompt a { color: var(--terracotta); font-weight: 600; }

    .post-sidebar { position: sticky; top: 88px; }
    .sidebar-card { background: #fff; border: 1px solid var(--border); border-radius: 4px; padding: 1.75rem; margin-bottom: 1.5rem; }
    .sidebar-title { font-size: .68rem; font-weight: 600; letter-spacing: .15em; text-transform: uppercase; color: var(--terracotta); margin-bottom: 1.25rem; }
    .author-box { display: flex; align-items: center; gap: 1rem; }
    .author-avatar-sm { width: 52px; height: 52px; border-radius: 50%; background: var(--warm-off); border: 2px solid var(--terracotta); display: flex; align-items: center; justify-content: center; font-family: var(--serif); font-size: 1.4rem; font-weight: 600; color: var(--terracotta); flex-shrink: 0; overflow: hidden; }
    .author-name { font-family: var(--serif); font-size: 1.1rem; font-weight: 600; color: var(--ink); }
    .author-role { font-size: .78rem; color: var(--muted); margin-top: .1rem; }
    .tags-list { display: flex; flex-wrap: wrap; gap: .5rem; }
    .tag-pill { font-size: .75rem; font-weight: 500; color: var(--muted); background: var(--warm-off); border: 1px solid var(--border); padding: .3rem .85rem; border-radius: 20px; transition: all .2s; }
    .tag-pill:hover { background: var(--terracotta); border-color: var(--terracotta); color: #fff; }
    .newsletter-mini input { width: 100%; padding: .7rem 1rem; border: 1px solid var(--border); border-radius: 2px; font-family: var(--sans); font-size: .85rem; background: var(--cream); margin-bottom: .6rem; outline: none; transition: border-color .2s; }
    .newsletter-mini input:focus { border-color: var(--terracotta); }
    .newsletter-mini button { width: 100%; padding: .7rem; background: var(--terracotta); color: #fff; border: none; border-radius: 2px; font-family: var(--sans); font-size: .78rem; font-weight: 500; letter-spacing: .06em; text-transform: uppercase; cursor: pointer; transition: background .2s; }
    .newsletter-mini button:hover { background: var(--terra-dark); }

    .favorite-btn { transition: all 0.2s ease; }
    .favorite-btn:hover { transform: scale(1.1); }
    .favorite-btn i { font-size: 1.1rem; }

    /* ─── CAROUSEL ONE-BY-ONE ─── */
    .related-section {
        background: var(--warm-off);
        border-top: 1px solid var(--border);
        padding: 4rem 0;
    }
    .related-inner {
        max-width: 1290px;
        margin: 0 auto;
        padding: 0 3rem;
    }
    .related-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
    }
    .related-title {
        font-family: var(--serif);
        font-size: 1.7rem;
        font-weight: 400;
        color: var(--ink);
    }
    .train-nav { display: flex; gap: 8px; }
    .train-btn {
        width: 40px; height: 40px;
        border-radius: 50%;
        border: 1.5px solid var(--border);
        background: #fff;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        color: var(--muted);
        transition: all .2s;
    }
    .train-btn:hover { background: var(--terracotta); border-color: var(--terracotta); color: #fff; }
    .train-btn:disabled { opacity: .3; pointer-events: none; }

    .train-viewport {
        overflow: hidden;
        cursor: grab;
        user-select: none;
        -webkit-user-select: none;
    }
    .train-viewport:active { cursor: grabbing; }

    .train-track {
        display: flex;
        gap: 20px;
        transition: transform .5s cubic-bezier(.4,0,.2,1);
    }

    .train-card {
        flex: 0 0 270px;
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        border: 1px solid var(--border);
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        transition: transform .3s, box-shadow .3s;
    }
    .train-card:hover { transform: translateY(-5px); box-shadow: 0 14px 36px rgba(42,32,24,.11); }

    .train-card-img {
        position: relative;
        height: 175px;
        overflow: hidden;
        background: var(--warm-off);
        flex-shrink: 0;
    }
    .train-card-img img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform .5s; }
    .train-card:hover .train-card-img img { transform: scale(1.06); }
    .train-no-img { width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:var(--border);font-size:2rem; }

    .train-cat {
        position: absolute; top: 10px; left: 10px;
        background: var(--terracotta); color: #fff;
        font-size: .58rem; font-weight: 600; letter-spacing: .1em; text-transform: uppercase;
        padding: 3px 10px; border-radius: 20px; z-index: 2;
    }

    .train-card-body { padding: 16px 18px 20px; flex:1; display:flex; flex-direction:column; gap:10px; }
    .train-card-title {
        font-family: var(--serif); font-size: 1.05rem; font-weight: 400;
        line-height: 1.35; color: var(--ink); transition: color .2s;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }
    .train-card:hover .train-card-title { color: var(--terracotta); }
    .train-card-meta { display:flex; gap:12px; font-size:.7rem; color:var(--muted); margin-top:auto; }

    .train-progress-wrap { margin-top: 20px; height: 3px; background: var(--border); border-radius: 10px; overflow: hidden; }
    .train-progress-bar { height:100%; background:var(--terracotta); border-radius:10px; width:0%; transition: width .4s ease; }

    @media (max-width: 1024px) {
        .post-layout { grid-template-columns: 1fr; gap: 2.5rem; }
        .post-sidebar { position: static; }
    }
    @media (max-width: 767px) {
        .post-layout { padding: 3rem 1.5rem 4rem; }
        .related-inner { padding: 0 1.5rem; }
        .train-card { flex: 0 0 220px; }
    }
</style>
@endpush

@section('content')
<!-- HERO -->
@if($post->image)
    <div class="post-hero" style="background-image: url('{{ asset('img/' . $post->image) }}');">
        <div class="post-hero-overlay"></div>
        <div class="post-hero-content">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <i class="fas fa-chevron-right"></i>
                <a href="{{ route('blog') }}">Articles</a>
                <i class="fas fa-chevron-right"></i>
                <span>{{ Str::limit($post->title, 35) }}</span>
            </div>
            <div class="post-tags">
                <span class="post-cat">Article</span>
                <span class="post-date-hero"><i class="far fa-calendar"></i> {{ $post->created_at->format('F j, Y') }}</span>
                <span class="post-date-hero"><i class="far fa-eye"></i> {{ $post->vues }} vue{{ $post->vues > 1 ? 's' : '' }}</span>
            </div>
            <h1 class="post-title">{{ $post->title }}</h1>
        </div>
    </div>
@else
    <div class="post-hero-fallback">
        <div class="post-hero-content">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <i class="fas fa-chevron-right"></i>
                <a href="{{ route('blog') }}">Articles</a>
                <i class="fas fa-chevron-right"></i>
                <span>{{ Str::limit($post->title, 35) }}</span>
            </div>
            <div class="post-tags">
                <span class="post-cat">Article</span>
                <span class="post-date-hero" style="color:var(--muted);"><i class="far fa-calendar"></i> {{ $post->created_at->format('F j, Y') }}</span>
            </div>
            <h1 class="post-title">{{ $post->title }}</h1>
        </div>
    </div>
@endif

<!-- CONTENU -->
<div class="post-layout">
    <main class="post-body">
        <div class="post-divider"></div>

        <div class="post-meta-bar">
            @auth
                <span>
                    <form action="{{ route('favorite.toggle', $post->id) }}" method="POST" class="favorite-form" style="display: inline;">
                        @csrf
                        <button type="submit" class="favorite-btn" style="background: none; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 5px; color: {{ auth()->user()->hasFavorite($post->id) ? 'var(--terracotta)' : 'var(--muted)' }};">
                            <i class="{{ auth()->user()->hasFavorite($post->id) ? 'fas' : 'far' }} fa-bookmark"></i>
                            <span>{{ $post->favoritedBy()->count() }}</span>
                        </button>
                    </form>
                </span>
            @else
                <span>
                    <a href="{{ route('login') }}" style="color: var(--muted); display: inline-flex; align-items: center; gap: 5px;">
                        <i class="far fa-bookmark"></i>
                        <span>{{ $post->favoritedBy()->count() }}</span>
                    </a>
                </span>
            @endauth
            <span><i class="far fa-calendar"></i> {{ $post->created_at->format('F j, Y') }}</span>
            <span><i class="far fa-eye"></i> {{ $post->vues }} vue{{ $post->vues > 1 ? 's' : '' }}</span>
            <span><i class="far fa-comment"></i> {{ $post->comments->count() }} commentaire{{ $post->comments->count() > 1 ? 's' : '' }}</span>
        </div>

        <div class="post-content">{!! $post->description !!}</div>

        <div class="post-footer-bar">
            <a href="{{ route('home') }}" class="back-link"><i class="fas fa-arrow-left"></i> All articles</a>
            <div style="display:flex;align-items:center;">
                <span class="share-label">Share</span>
                <div class="share-btns">
                    <a href="#" class="share-btn"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="share-btn"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="share-btn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="share-btn"><i class="fas fa-link"></i></a>
                </div>
            </div>
        </div>

        <!-- REACTIONS -->
        <div class="reactions-wrap" id="reactionsWrap">
            @php
                $reactionTypes = ['like'=>['emoji'=>'👍','label'=>'Like'],'love'=>['emoji'=>'❤️','label'=>'Love'],'haha'=>['emoji'=>'😂','label'=>'Haha'],'wow'=>['emoji'=>'😮','label'=>'Wow'],'sad'=>['emoji'=>'😢','label'=>'Sad'],'angry'=>['emoji'=>'😡','label'=>'Angry']];
                $userReaction = auth()->check() ? $post->reactions()->where('user_id', auth()->id())->value('type') : null;
                $counts = $post->reactions()->selectRaw('type, count(*) as total')->groupBy('type')->pluck('total','type');
                $total = $post->reactions()->count();
            @endphp
            <div class="reactions-bar">
                <div class="reaction-main-btn" id="reactionMainBtn">
                    @if($userReaction)
                        <span>{{ $reactionTypes[$userReaction]['emoji'] }}</span>
                        <span style="color:var(--terracotta)">{{ $reactionTypes[$userReaction]['label'] }}</span>
                    @else
                        <span>👍</span><span>Like</span>
                    @endif
                </div>
                <div class="reaction-picker" id="reactionPicker">
                    @foreach($reactionTypes as $type => $data)
                        <button class="reaction-btn {{ $userReaction === $type ? 'active' : '' }}" data-type="{{ $type }}" data-post="{{ $post->id }}" title="{{ $data['label'] }}">{{ $data['emoji'] }}</button>
                    @endforeach
                </div>
            </div>
            <div class="reaction-counts" id="reactionCounts">
                @foreach($reactionTypes as $type => $data)
                    <span class="reaction-count-item" id="count-wrap-{{ $type }}" style="{{ isset($counts[$type]) && $counts[$type] > 0 ? 'display:inline' : 'display:none' }}">
                        {{ $data['emoji'] }} <span id="count-{{ $type }}">{{ $counts[$type] ?? 0 }}</span>
                    </span>
                @endforeach
                <span class="reaction-total" id="reactionTotal" style="{{ $total > 0 ? 'display:inline' : 'display:none' }}">
                    {{ $total }} reaction{{ $total > 1 ? 's' : '' }}
                </span>
            </div>
        </div>

        <!-- COMMENTS -->
        <div class="comments-wrap">
            <div class="comments-heading">
                <em>Comments</em>
                <span class="comments-count">{{ $post->comments->count() }}</span>
            </div>
            @forelse($post->comments()->with('user')->latest()->get() as $comment)
                <div class="comment-card">
                    <div class="comment-avatar">
                        @if($comment->user->avatar)
                            <img src="{{ asset('img/' . $comment->user->avatar) }}" alt="{{ $comment->user->name }}" style="width:100%;height:100%;object-fit:cover;">
                        @else
                            {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                        @endif
                    </div>
                    <div class="comment-body">
                        <div class="comment-author">{{ $comment->user->name }}</div>
                        <div class="comment-time">{{ $comment->created_at->diffForHumans() }}</div>
                        <div class="comment-text">{{ $comment->content }}</div>
                    </div>
                </div>
            @empty
                <div class="comment-empty">
                    <i class="far fa-comment"></i>
                    <p>No comments yet. Be the first!</p>
                </div>
            @endforelse

            @auth
                @if(session('success'))
                    <div style="background:#fef3c7;color:#92400e;padding:12px 16px;border-radius:4px;margin-top:1rem;font-size:.85rem;">{{ session('success') }}</div>
                @endif
                <div class="comment-form-wrap">
                    <div class="comment-form-title">Leave a comment</div>
                    <form method="POST" action="{{ route('comments.store', $post->id) }}">
                        @csrf
                        <textarea class="comment-input" name="content" placeholder="Share your thoughts…">{{ old('content') }}</textarea>
                        @error('content')<div class="comment-error">{{ $message }}</div>@enderror
                        <button class="comment-submit" type="submit">Post Comment</button>
                    </form>
                </div>
            @else
                <div class="login-prompt"><a href="{{ route('login') }}">Login</a> to leave a comment.</div>
            @endauth
        </div>
    </main>

    <!-- SIDEBAR -->
    <aside class="post-sidebar">
        <div class="sidebar-card">
            <p class="sidebar-title">✦ About the author</p>
            <div class="author-box">
                <a href="{{ route('auteur.profile', $post->user->id) }}" style="text-decoration:none;flex-shrink:0;">
                    <div class="author-avatar-sm">
                        @if($post->user->avatar)
                            <img src="{{ asset('img/' . $post->user->avatar) }}" alt="{{ $post->user->name }}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                        @else
                            {{ strtoupper(substr($post->user->name, 0, 1)) }}
                        @endif
                    </div>
                </a>
                <div>
                    <a href="{{ route('auteur.profile', $post->user->id) }}" style="text-decoration:none;">
                        <div class="author-name">{{ $post->user->name }}</div>
                    </a>
                    <div class="author-role">Writer & Creator</div>
                </div>
            </div>
        </div>

        <div class="sidebar-card">
            <p class="sidebar-title">✦ Topics</p>
            <div class="tags-list">
                @foreach($post->user->posts()->where('status','approved')->with('categorie')->get()->pluck('categorie')->filter()->unique('id') as $cat)
                    <a href="{{ route('category.show', $cat->slug) }}" class="tag-pill">{{ $cat->name }}</a>
                @endforeach
            </div>
        </div>

        <div class="sidebar-card">
            <p class="sidebar-title">✦ Newsletter</p>
            <p style="font-size:.85rem;color:var(--muted);line-height:1.6;margin-bottom:1rem;">Get new articles delivered to your inbox every week.</p>
            @if(session('subscribed'))
                <div style="background:#fef3c7;color:#92400e;padding:12px;border-radius:4px;font-size:.85rem;">{{ session('subscribed') }}</div>
            @else
                <form method="POST" action="{{ route('subscribe') }}">
                    @csrf
                    <div class="newsletter-mini">
                        <input type="email" name="email" placeholder="your@email.com" required>
                        @error('email')<div style="color:#c0392b;font-size:.75rem;margin-top:4px;">{{ $message }}</div>@enderror
                        <button type="submit">Subscribe</button>
                    </div>
                </form>
            @endif
        </div>
    </aside>
</div>

<!-- ARTICLES RÉCENTS — Carousel one-by-one -->
<section class="related-section">
    <div class="related-inner">
        <div class="related-header">
            <h2 class="related-title">More articles to explore</h2>
            <div class="train-nav">
                <button class="train-btn" id="trainPrev" aria-label="Previous">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button class="train-btn" id="trainNext" aria-label="Next">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>

        @php
            $related = \App\Models\Post::where('status', 'approved')
                ->where('id', '!=', $post->id)
                ->with('user', 'categorie')
                ->latest()
                ->take(12)
                ->get();
        @endphp

        <div class="train-viewport" id="trainViewport">
            <div class="train-track" id="trainTrack">
                @foreach($related as $rel)
                <a href="{{ route('fullpost', $rel->id) }}" class="train-card">
                    <div class="train-card-img">
                        @if($rel->image)
                            <img src="{{ asset('img/' . $rel->image) }}" alt="{{ $rel->title }}" loading="lazy">
                        @else
                            <div class="train-no-img"><i class="far fa-image"></i></div>
                        @endif
                        @if($rel->categorie)
                            <span class="train-cat">{{ $rel->categorie->name }}</span>
                        @endif
                    </div>
                    <div class="train-card-body">
                        <h3 class="train-card-title">{{ $rel->title }}</h3>
                        <div class="train-card-meta">
                            <span>{{ $rel->created_at->format('d M Y') }}</span>
                            <span>{{ $rel->vues }} vue{{ $rel->vues > 1 ? 's' : '' }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        <div class="train-progress-wrap">
            <div class="train-progress-bar" id="trainProgress"></div>
        </div>
    </div>
    <div style="text-align: center; margin-top: 2.5rem;">
            <a href="{{ route('blog') }}" style="
                display: inline-flex;
                align-items: center;
                gap: .6rem;
                padding: .85rem 2.2rem;
                border: 1.5px solid var(--terracotta);
                border-radius: 30px;
                font-family: var(--sans);
                font-size: .8rem;
                font-weight: 500;
                letter-spacing: .1em;
                text-transform: uppercase;
                color: var(--terracotta);
                text-decoration: none;
                transition: all .25s;
            "
            onmouseover="this.style.background='var(--terracotta)';this.style.color='#fff';"
            onmouseout="this.style.background='transparent';this.style.color='var(--terracotta)';">
                See all articles
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        {{-- ───────────────────────────────────────────────── --}}

    </div>
</section>
@endsection

@push('scripts')
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
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
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

// ─── Reactions ───
const mainBtn = document.getElementById('reactionMainBtn');
const picker  = document.getElementById('reactionPicker');
const csrf    = '{{ csrf_token() }}';
let hideTimer;
if (mainBtn && picker) {
    mainBtn.addEventListener('mouseenter', () => { clearTimeout(hideTimer); picker.classList.add('show'); });
    mainBtn.addEventListener('mouseleave', () => { hideTimer = setTimeout(() => picker.classList.remove('show'), 300); });
    picker.addEventListener('mouseenter', () => clearTimeout(hideTimer));
    picker.addEventListener('mouseleave', () => { hideTimer = setTimeout(() => picker.classList.remove('show'), 300); });
}
document.querySelectorAll('.reaction-btn').forEach(btn => {
    btn.addEventListener('click', async () => {
        @auth
        const type = btn.dataset.type;
        const res = await fetch(`/reactions/${btn.dataset.post}`, { method:'POST', headers:{'X-CSRF-TOKEN':csrf,'Content-Type':'application/json'}, body:JSON.stringify({type}) });
        const data = await res.json();
        ['like','love','haha','wow','sad','angry'].forEach(t => { const w = document.getElementById('count-wrap-'+t); if(w) w.style.display='none'; });
        if (data.counts) Object.entries(data.counts).forEach(([t,n]) => { if(n>0) { const w=document.getElementById('count-wrap-'+t); const el=document.getElementById('count-'+t); if(w) w.style.display='inline'; if(el) el.textContent=n; }});
        const te = document.getElementById('reactionTotal');
        if(te) { te.textContent = data.total + (data.total > 1 ? ' reactions' : ' reaction'); te.style.display = data.total > 0 ? 'inline' : 'none'; }
        document.querySelectorAll('.reaction-btn').forEach(b => b.classList.remove('active'));
        if(data.user_reaction) btn.classList.add('active');
        const em = {like:'👍',love:'❤️',haha:'😂',wow:'😮',sad:'😢',angry:'😡'};
        const lb = {like:'Like',love:'Love',haha:'Haha',wow:'Wow',sad:'Sad',angry:'Angry'};
        mainBtn.innerHTML = data.user_reaction ? `<span>${em[data.user_reaction]}</span><span style="color:var(--terracotta)">${lb[data.user_reaction]}</span>` : `<span>👍</span><span>Like</span>`;
        picker.classList.remove('show');
        @else
        window.location.href = '{{ route("login") }}';
        @endauth
    });
});

// ─── Favorites ───
document.querySelectorAll('.favorite-form').forEach(form => {
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const btn = form.querySelector('.favorite-btn');
        const icon = btn.querySelector('i');
        const span = btn.querySelector('span');
        const response = await fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({})
        });
        const data = await response.json();
        if (data.favorited) {
            icon.className = 'fas fa-bookmark';
            btn.style.color = 'var(--terracotta)';
        } else {
            icon.className = 'far fa-bookmark';
            btn.style.color = 'var(--muted)';
        }
        span.textContent = data.count;
    });
});

// ─── Train Carousel (one by one) ───
document.addEventListener('DOMContentLoaded', function () {
    const track    = document.getElementById('trainTrack');
    const viewport = document.getElementById('trainViewport');
    const btnPrev  = document.getElementById('trainPrev');
    const btnNext  = document.getElementById('trainNext');
    const bar      = document.getElementById('trainProgress');
    if (!track || !viewport) return;

    const GAP     = 20;
    const cards   = Array.from(track.querySelectorAll('.train-card'));
    const total   = cards.length;
    let current   = 0;
    let autoTimer = null;
    let dragging  = false;
    let dragStartX    = 0;
    let dragStartPos  = 0;
    let currentOffset = 0;

    function cardWidth() {
        return (cards[0]?.offsetWidth || 270) + GAP;
    }

    function maxOffset() {
        return Math.max(0, track.scrollWidth - viewport.offsetWidth);
    }

    function goTo(index, animate = true) {
        current = Math.max(0, Math.min(index, total - 1));
        const targetOffset = Math.min(current * cardWidth(), maxOffset());
        currentOffset = targetOffset;
        track.style.transition = animate ? 'transform .5s cubic-bezier(.4,0,.2,1)' : 'none';
        track.style.transform  = `translateX(-${targetOffset}px)`;

        // barre de progression
        if (bar) bar.style.width = (total > 1 ? (current / (total - 1)) * 100 : 100) + '%';

        // état boutons
        if (btnPrev) btnPrev.disabled = current <= 0;
        if (btnNext) btnNext.disabled = current >= total - 1;
    }

    function next() { goTo(current + 1); }
    function prev() { goTo(current - 1); }

    function startAuto() {
        stopAuto();
        autoTimer = setInterval(() => {
            if (current >= total - 1) goTo(0);
            else next();
        }, 2000);
    }
    function stopAuto()  { clearInterval(autoTimer); autoTimer = null; }
    function resetAuto() { startAuto(); }

    if (btnNext) btnNext.addEventListener('click', () => { next(); resetAuto(); });
    if (btnPrev) btnPrev.addEventListener('click', () => { prev(); resetAuto(); });

    viewport.addEventListener('mouseenter', stopAuto);
    viewport.addEventListener('mouseleave', startAuto);

    // Drag souris
    viewport.addEventListener('mousedown', e => {
        dragging     = true;
        dragStartX   = e.clientX;
        dragStartPos = currentOffset;
        track.style.transition = 'none';
        stopAuto();
    });
    document.addEventListener('mousemove', e => {
        if (!dragging) return;
        const delta = dragStartX - e.clientX;
        const raw   = Math.max(0, Math.min(dragStartPos + delta, maxOffset()));
        track.style.transform = `translateX(-${raw}px)`;
    });
    document.addEventListener('mouseup', e => {
        if (!dragging) return;
        dragging = false;
        const delta = dragStartX - e.clientX;
        if      (delta >  50) goTo(current + 1);
        else if (delta < -50) goTo(current - 1);
        else                   goTo(current);
        startAuto();
    });

    // Touch
    let touchStartX = 0;
    viewport.addEventListener('touchstart', e => {
        touchStartX = e.touches[0].clientX;
        track.style.transition = 'none';
        stopAuto();
    }, { passive: true });
    viewport.addEventListener('touchmove', e => {
        const delta = touchStartX - e.touches[0].clientX;
        const raw   = Math.max(0, Math.min(currentOffset + delta, maxOffset()));
        track.style.transform = `translateX(-${raw}px)`;
    }, { passive: true });
    viewport.addEventListener('touchend', e => {
        const delta = touchStartX - e.changedTouches[0].clientX;
        if      (delta >  50) goTo(current + 1);
        else if (delta < -50) goTo(current - 1);
        else                   goTo(current);
        startAuto();
    });

    // Empêcher le clic après un drag
    cards.forEach(card => {
        card.addEventListener('click', e => {
            if (Math.abs(dragStartX - e.clientX) > 5) e.preventDefault();
        });
    });

    goTo(0, false);
    startAuto();
});
</script>
@endpush