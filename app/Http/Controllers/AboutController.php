<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Categorie;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // Limiter à 10 auteurs pour la page about
        $auteurs = User::where('usertype', 'auteur')
            ->withCount(['posts' => function ($q) {
                $q->where('status', 'approved');
            }])
            ->withCount('followers')
            ->take(10)
            ->get();

        // Compter le nombre TOTAL d'auteurs 
        $totalAuteurs = User::where('usertype', 'auteur')->count();

        $stats = [
            'auteurs'  => $totalAuteurs,
            'articles' => \App\Models\Post::where('status', 'approved')->count(),
            'lecteurs' => User::where('usertype', 'user')->count(),
        ];

        $categories = Categorie::withCount('posts')->latest()->get();

        return view('about', compact('auteurs', 'stats', 'categories', 'totalAuteurs'));
    }

    public function allAuthors(Request $request)
    {
        $query = User::where('usertype', 'auteur')
            ->with('following')  
            ->withCount(['posts' => function ($q) {
                $q->where('status', 'approved');
            }])
            ->withCount('followers');
        
        // Recherche par nom
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $auteurs = $query->paginate(12);
        
        $categories = Categorie::withCount('posts')->latest()->get();
        
        return view('all-authors', compact('auteurs', 'categories'));
    }
}