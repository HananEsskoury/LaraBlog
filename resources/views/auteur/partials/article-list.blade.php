@if($posts->isEmpty())
    <div class="empty-state">
        <i class="far fa-newspaper"></i>
        <p>Aucun article dans cette catégorie.</p>
    </div>
@else
    <div class="articles-list">
        @foreach($posts as $post)
        <div class="article-card">

            {{-- THUMBNAIL --}}
            @if($post->image)
                <img src="{{ asset('img/' . $post->image) }}" alt="" class="article-thumb">
            @else
                <div class="article-thumb-placeholder">
                    <i class="far fa-image"></i>
                </div>
            @endif

            {{-- INFO --}}
            <div class="article-info">
                <div class="article-top">
                    <span class="status-badge status-{{ $post->status }}">
                        @switch($post->status)
                            @case('approved') Publié @break
                            @case('pending')  En attente @break
                            @case('draft')    Brouillon @break
                            @case('rejected') Rejeté @break
                        @endswitch
                    </span>
                    @if($post->categorie)
                        <span class="article-cat">{{ $post->categorie->name }}</span>
                    @endif
                </div>

                <div class="article-title" title="{{ $post->title }}">{{ $post->title }}</div>

                <div class="article-meta">
                    <span><i class="far fa-calendar"></i> {{ $post->created_at->format('d M Y') }}</span>
                    <span><i class="far fa-eye"></i> {{ $post->vues }} vue{{ $post->vues > 1 ? 's' : '' }}</span>
                    <span><i class="far fa-comment"></i> {{ $post->comments_count ?? $post->comments->count() }} commentaire{{ ($post->comments_count ?? $post->comments->count()) > 1 ? 's' : '' }}</span>
                </div>

                @if($post->status === 'rejected' && $post->rejection_reason)
                    <div class="article-rejection">
                        <i class="fas fa-info-circle" style="margin-top:1px;flex-shrink:0"></i>
                        <span>{{ $post->rejection_reason }}</span>
                    </div>
                @endif
            </div>

            {{-- ACTIONS --}}
            <div class="article-actions">
                <a href="{{ route('auteur.editpost', $post->id) }}" class="btn-icon" title="Modifier">
                    <i class="fas fa-pen"></i>
                </a>
                <button class="btn-icon danger" title="Supprimer" onclick="confirmDelete({{ $post->id }})">
                    <i class="fas fa-trash"></i>
                </button>
            </div>

        </div>
        @endforeach
    </div>
@endif