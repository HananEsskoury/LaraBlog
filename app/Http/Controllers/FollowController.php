<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function toggle($authorId)
    {
        $auteur = User::findOrFail($authorId);
        $user   = auth()->user();

        // Empêcher un auteur de se follow lui-même
        if ($user->id === $auteur->id) {
            return back();
        }

        if ($user->following->contains($auteur->id)) {
            $user->following()->detach($auteur->id);
            $following = false;
        } else {
            $user->following()->attach($auteur->id);
            $following = true;
        }

        if (request()->wantsJson()) {
            return response()->json([
                'following'       => $following,
                'followers_count' => $auteur->fresh()->followers()->count(),
            ]);
        }

        return back();
    }
}