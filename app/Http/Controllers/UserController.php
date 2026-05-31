<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Categorie;

class UserController extends Controller
{
    public function showDataInHome()
    {
        $posts = Post::where('status', 'approved')->latest()->take(12)->get();
        $categories = Categorie::withCount('posts')->take(10)->get();
        $totalCategories = Categorie::count();
        
        return view('home', compact('posts', 'categories', 'totalCategories'));
    }

    public function showFullPost($id)
    {
        $post = Post::with(['user', 'comments.user', 'reactions'])->findOrFail($id);

        // 1 vue par session par post
        $sessionKey = 'viewed_post_' . $id;
        if (!session()->has($sessionKey)) {
            $post->increment('vues');
            session()->put($sessionKey, true);
        }

        return view('fullpost', compact('post'));
    }

    public function index(Request $request)
    {
        $usertype = $request->user()->usertype;

        if ($usertype === 'admin') {

            $filter = $request->query('filter');

            $posts = Post::with(['user', 'categorie'])
                ->when($filter, fn($q) => $q->where('status', $filter))
                ->latest()
                ->get();

            $stats = [
                'approved'    => Post::where('status', 'approved')->count(),
                'pending'     => Post::where('status', 'pending')->count(),
                'authors'     => User::where('usertype', 'auteur')->count(),
                'total_views' => Post::sum('vues'),
            ];

            $topAuthors = User::where('usertype', 'auteur')
                ->withCount('posts')
                ->orderByDesc('posts_count')
                ->take(5)
                ->get();

            $categories = Categorie::withCount('posts')
                ->orderByDesc('posts_count')
                ->get();

            return view('admin.dashboard', compact(
                'posts',
                'stats',
                'topAuthors',
                'categories'
            ));

        } elseif ($usertype === 'auteur') {
            return redirect()->route('auteur.dashboard');
        }

        return redirect()->route('home');
    }

    /**
     * Dashboard auteur — charge les posts et les passe à la vue
     */
    public function index1(Request $request)
    {
        $usertype = $request->user()->usertype;

        if ($usertype === 'auteur') {
            $user = auth()->user();
            $isActive = $user->is_active; // ← Vérifier si le compte est actif
            
            $posts = Post::where('user_id', auth()->id())
                         ->with(['categorie', 'comments'])
                         ->withCount('comments')
                         ->latest()
                         ->get();

            return view('auteur.dashboard', compact('posts', 'isActive'));
        }

        if ($usertype === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('home');
    }

    public function home(Request $request)
    {
        $usertype = $request->user()->usertype;

        if ($usertype === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($usertype === 'auteur') {
            return redirect()->route('auteur.dashboard');
        }

        return redirect()->route('home');
    }

    public function showByCategory($slug)
    {
        $categorie = Categorie::where('slug', $slug)->firstOrFail();
        
        $posts = Post::where('categorie_id', $categorie->id)
                     ->where('status', 'approved')
                     ->latest()
                     ->get();

        $allCategories = Categorie::withCount('posts')->get();

        return view('category', compact('posts', 'categorie', 'allCategories'));
    }

    public function showAuteurProfile($id)
    {
        $auteur = User::findOrFail($id);

        $posts = Post::where('user_id', $id)
                     ->where('status', 'approved')
                     ->with('categorie')
                     ->latest()
                     ->get();

        $categories = $posts->pluck('categorie')->filter()->unique('id');

        $isFollowing = auth()->check()
            ? auth()->user()->following->contains($id)
            : false;

        return view('auteur-profile', compact('auteur', 'posts', 'categories', 'isFollowing'));
    }

    public function showAuteurByCategory($id, $slug)
    {
        $auteur = User::findOrFail($id);
        $categorie = Categorie::where('slug', $slug)->firstOrFail();

        $posts = Post::where('user_id', $id)
                     ->where('categorie_id', $categorie->id)
                     ->where('status', 'approved')
                     ->with('categorie')
                     ->latest()
                     ->get();

        $categories = Post::where('user_id', $id)
                          ->where('status', 'approved')
                          ->with('categorie')
                          ->get()
                          ->pluck('categorie')
                          ->filter()
                          ->unique('id');

        $isFollowing = auth()->check()
            ? auth()->user()->following->contains($id)
            : false;

        return view('auteur-profile', compact('auteur', 'posts', 'categories', 'isFollowing', 'categorie'));
    }
}