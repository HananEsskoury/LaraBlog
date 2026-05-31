<?php
namespace App\Http\Controllers;

use App\Models\Reaction;
use App\Models\Post;
use App\Notifications\ReactionNotification;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate(['type' => 'required|in:like,love,haha,wow,sad,angry']);

        $post     = Post::with('user')->findOrFail($postId);
        $existing = Reaction::where('post_id', $postId)
                            ->where('user_id', auth()->id())
                            ->first();

        $userReaction = null;

        if ($existing) {
            if ($existing->type === $request->type) {
                $existing->delete();
                // Pas de notif pour un "unlike"
            } else {
                $existing->update(['type' => $request->type]);
                $userReaction = $request->type;
                // Notifier seulement si l'auteur n'est pas celui qui réagit
                if ($post->user_id !== auth()->id()) {
                    $existing->load('user', 'post');
                    $post->user->notify(new ReactionNotification($existing));
                }
            }
        } else {
            $reaction = Reaction::create([
                'post_id' => $postId,
                'user_id' => auth()->id(),
                'type'    => $request->type,
            ]);
            $userReaction = $request->type;

            // Notifier l'auteur (pas si c'est lui-même qui réagit)
            if ($post->user_id !== auth()->id()) {
                $reaction->load('user', 'post');
                $post->user->notify(new ReactionNotification($reaction));
            }
        }

        $counts = $post->reactions()
                       ->selectRaw('type, count(*) as total')
                       ->groupBy('type')
                       ->pluck('total', 'type');

        return response()->json([
            'counts'        => $counts,
            'total'         => $post->reactions()->count(),
            'user_reaction' => $userReaction,
        ]);
    }
}