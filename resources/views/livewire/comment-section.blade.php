<div>
    <h2 class="comments-heading">
        Leave a <em>comment</em>
        <span class="comments-count">{{ $comments->count() }}</span>
    </h2>

    {{-- Liste des commentaires --}}
    @forelse($comments as $comment)
        <div class="comment-card">
            <div class="comment-avatar">
                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
            </div>
            <div class="comment-body">
                <div class="comment-author">{{ $comment->user->name }}</div>
                <div class="comment-time">{{ $comment->created_at->diffForHumans() }}</div>
                <p class="comment-text">{{ $comment->content }}</p>
            </div>
        </div>
    @empty
        <div class="comment-empty">
            <i class="far fa-comment-dots"></i>
            <p>No comments yet — be the first to share your thoughts!</p>
        </div>
    @endforelse

    {{-- Formulaire --}}
    @auth
        <div class="comment-form-wrap">
            <p class="comment-form-title">Share your thoughts</p>
            <textarea
                wire:model="content"
                class="comment-input"
                placeholder="Write your comment here...">
            </textarea>
            @error('content')
                <p class="comment-error">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                </p>
            @enderror
            <button wire:click="addComment" class="comment-submit">
                Post Comment
            </button>
        </div>
    @else
        <div class="login-prompt">
            <a href="{{ route('login') }}">Log in</a> to join the conversation.
        </div>
    @endauth
</div>