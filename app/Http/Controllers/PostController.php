<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Categorie;
use App\Models\User;  // ← AJOUTEZ CETTE LIGNE
use App\Notifications\PostSubmittedNotification;

class PostController extends Controller
{
   public function store(Request $request)
{
    $validated = $request->validate([
        'title'   => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    $post = Post::create([
        ...$validated,
        'user_id' => auth()->id(),
        'status'  => 'pending',
    ]);

    // ✅ Notifier tous les admins
    User::where('usertype', 'admin')->get()
        ->each(fn($admin) => $admin->notify(new PostSubmittedNotification($post)));

    return redirect()->route('author.posts')
        ->with('success', 'Post soumis. En attente de validation.');
}
    // L'auteur voit ses propres posts avec leurs statuts
    public function myPosts()
    {
        $posts = Post::where('user_id', auth()->id())
                     ->latest()
                     ->paginate(10);

        return view('author.posts.index', compact('posts'));
    }
  public function index(Request $request)
{
    $query = Post::with(['categorie', 'user'])->where('status', 'approved');

    if ($request->search)
        $query->where(function($q) use ($request) {
            $q->where('title', 'like', '%'.$request->search.'%')
              ->orWhere('description', 'like', '%'.$request->search.'%');
        });

    // ← 'category' au lieu de 'categorie'
    if ($request->category)
        $query->whereHas('categorie', fn($q) => $q->where('slug', $request->category));

    if ($request->sort === 'oldest') $query->oldest();
    elseif ($request->sort === 'popular') $query->orderByDesc('vues');
    else $query->latest();

    $posts = $query->paginate(9)->withQueryString();

    // Compter seulement les posts approuvés
    $categories = Categorie::withCount([
        'posts' => fn($q) => $q->where('status', 'approved')
    ])->get();

    return view('blog', compact('posts', 'categories'));
}
}
