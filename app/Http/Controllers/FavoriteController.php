<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function toggle($postId)
    {
        $post = Post::findOrFail($postId);
        $user = auth()->user();
        
        if ($user->favorites()->where('post_id', $postId)->exists()) {
            $user->favorites()->detach($postId);
            $isFavorited = false;
        } else {
            $user->favorites()->attach($postId);
            $isFavorited = true;
        }
        
        if (request()->wantsJson()) {
            return response()->json([
                'favorited' => $isFavorited,
                'count' => $post->favoritedBy()->count()
            ]);
        }
        
        return back();
    }
    
    public function index(Request $request)
{
    $query = auth()->user()->favorites()
        ->where('status', 'approved')
        ->with('categorie')
        ->latest();
    
    // Recherche par titre
    if ($request->has('search') && !empty($request->search)) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }
    
    $favorites = $query->paginate(12);
    
    return view('favorites', compact('favorites'));
}
}