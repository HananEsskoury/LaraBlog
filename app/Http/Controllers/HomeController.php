<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('author')
                     ->where('status', 'approved')
                     ->latest('reviewed_at')
                     ->paginate(12);
        
        $categories = Categorie::withCount('posts')->latest()->take(10)->get();
        $totalCategories = Categorie::count();
        
        return view('home', compact('posts', 'categories', 'totalCategories'));
    }
    
    public function allCategories(Request $request)
{
    $query = Categorie::withCount('posts')->latest();
    
    // Recherche par nom de catégorie
    if ($request->has('search') && !empty($request->search)) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }
    
    $categories = $query->paginate(24);
    
    return view('all-categories', compact('categories'));
}
}