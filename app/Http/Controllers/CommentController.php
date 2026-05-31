<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Notifications\NewComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate(['content' => 'required|min:2|max:1000']);

        $post = Post::findOrFail($postId);

        $comment = Comment::create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        // Notifier l'auteur (sauf si c'est lui qui commente)
        if ($post->user_id !== auth()->id()) {
            $post->user->notify(new NewComment($comment));
        }

        return back()->with('success', 'Commentaire ajouté !');
    }
}