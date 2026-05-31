<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Categorie;
use App\Models\User; 
use App\Models\ContactMessage;  
use App\Notifications\PostApprovedNotification;
use App\Notifications\PostRejectedNotification;
use Illuminate\Support\Str;
use App\Models\Subscriber;
use App\Mail\NewPostPublished;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NewPostFromFollowedAuthor;

class AdminController extends Controller
{
    public function approve(Post $post)
    {
        $post->update([
            'status'      => 'approved',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        $post->user->notify(new PostApprovedNotification($post));

        foreach ($post->user->followers as $follower) {
            $follower->notify(new NewPostFromFollowedAuthor($post));
        }

        $subscribers = Subscriber::all();
        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new NewPostPublished($post));
        }

        return back()->with('success', 'Post approuvé, followers et subscribers notifiés.');
    }

    public function reject(Request $request, Post $post)
    {
        $request->validate(['reason' => 'nullable|string|max:500']);
        $post->update([
            'status'           => 'rejected',
            'rejection_reason' => $request->reason,
            'reviewed_by'      => auth()->id(),
            'reviewed_at'      => now(),
        ]);
        $post->user->notify(new PostRejectedNotification($post));
        return back()->with('success', 'Post rejeté.');
    }

    public function categories()
    {
        $categories = Categorie::withCount('posts')->latest()->get();
        $stats = [
            'unread_messages' => ContactMessage::unread()->count(),
        ];
        return view('admin.categories', compact('categories', 'stats'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:100|unique:categories,name',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $file      = $request->file('image');
            $imageName = 'cat_' . Str::slug($request->name) . '_' . time() . '.' . $file->extension();
            $file->move(public_path('img'), $imageName);
        }

        Categorie::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description ?? '',
            'image'       => $imageName,
        ]);

        return back()->with('success', 'Catégorie créée avec succès.');
    }

    public function deleteCategory($id)
    {
        $cat = Categorie::findOrFail($id);

        if ($cat->image && file_exists(public_path('img/' . $cat->image))) {
            unlink(public_path('img/' . $cat->image));
        }

        $cat->delete();
        return back()->with('success', 'Catégorie supprimée.');
    }

    public function statistiques()
    {
        $viewsPerMonth = Post::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, SUM(vues) as total')
            ->where('created_at', '>=', now()->subMonths(12))
            ->where('status', 'approved')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $auteursActifs = User::where('usertype', 'auteur')
            ->where('is_active', true)  // ← Filtrer uniquement les actifs
            ->whereHas('posts', fn($q) => $q->where('status', 'approved'))
            ->withCount(['posts' => fn($q) => $q->where('status', 'approved')])
            ->orderByDesc('posts_count')
            ->get();

        $auteursParMois = User::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as total')
            ->where('usertype', 'auteur')
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $totalLecteurs = Post::where('status', 'approved')->sum('vues');

        $stats = [
            'unread_messages' => ContactMessage::unread()->count(),
        ];

        return view('admin.statistiques', compact(
            'viewsPerMonth', 'auteursActifs', 'auteursParMois', 'totalLecteurs', 'stats'
        ));
    }

    public function auteurs(Request $request)
    {
        $filter = $request->get('filter');
        
        $query = User::where('usertype', 'auteur');
        
        // Appliquer le filtre si présent
        if ($filter === 'active') {
            $query->where('is_active', true);
        } elseif ($filter === 'inactive') {
            $query->where('is_active', false);
        }
        
        $auteurs = $query->withCount(['posts' => fn($q) => $q->whereIn('status', ['approved', 'pending', 'rejected'])])
            ->orderByDesc('posts_count')
            ->get();

        $totalArticles = Post::whereIn('status', ['approved', 'pending', 'rejected'])->count();
        $moyenneArticles = $auteurs->count() > 0 ? round($totalArticles / $auteurs->count(), 1) : 0;
        
        $stats = [
            'unread_messages' => ContactMessage::unread()->count(),
        ];

        return view('admin.auteurs', compact('auteurs', 'totalArticles', 'moyenneArticles', 'stats'));
    }

    public function editCategory($id)
    {
        $categorie  = Categorie::findOrFail($id);
        $categories = Categorie::withCount('posts')->latest()->get();
        $stats = [
            'unread_messages' => ContactMessage::unread()->count(),
        ];
        return view('admin.categories', compact('categorie', 'categories', 'stats'));
    }

    public function updateCategory(Request $request, $id)
    {
        $categorie = Categorie::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:100|unique:categories,name,' . $id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($categorie->image && file_exists(public_path('img/' . $categorie->image))) {
                unlink(public_path('img/' . $categorie->image));
            }
            $file      = $request->file('image');
            $imageName = 'cat_' . Str::slug($request->name) . '_' . time() . '.' . $file->extension();
            $file->move(public_path('img'), $imageName);
            $categorie->image = $imageName;
        }

        $categorie->name        = $request->name;
        $categorie->slug        = Str::slug($request->name);
        $categorie->description = $request->description ?? '';
        $categorie->save();

        return redirect()->route('admin.categories')->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function dashboard(Request $request)
    {
        $filter = $request->get('filter');
        $search = $request->get('search');

        $posts = Post::with(['user', 'categorie'])
            ->whereIn('status', ['approved', 'pending', 'rejected'])
            ->when($filter, fn($q) => $q->where('status', $filter))
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%"));
                });
            })
            ->latest()
            ->get();

        $stats = [
            'approved'        => Post::where('status', 'approved')->count(),
            'pending'         => Post::where('status', 'pending')->count(),
            'rejected'        => Post::where('status', 'rejected')->count(),
            'authors'         => User::where('usertype', 'auteur')->count(),
            'total_views'     => Post::where('status', 'approved')->sum('vues'),
            'unread_messages' => ContactMessage::unread()->count(),
        ];

        $topAuthors = User::where('usertype', 'auteur')
            ->where('is_active', true)  // ← Filtrer uniquement les auteurs actifs
            ->withCount(['posts' => fn($q) => $q->whereIn('status', ['approved', 'pending', 'rejected'])])
            ->orderByDesc('posts_count')
            ->take(5)
            ->get();

        $categories = Categorie::withCount(['posts' => fn($q) => $q->whereIn('status', ['approved', 'pending', 'rejected'])])->get();
        $notifications = auth()->user()->unreadNotifications;

        return view('admin.dashboard', compact(
            'posts', 'stats', 'topAuthors', 'categories', 'notifications', 'search'
        ));
    }

    public function activateAuteur($id)
    {
        $auteur = User::where('usertype', 'auteur')->findOrFail($id);
        $auteur->update(['is_active' => true]);
        
        return redirect()->route('admin.auteurs')->with('success', 'Compte de ' . $auteur->name . ' activé avec succès.');
    }

    public function deactivateAuteur($id)
    {
        $auteur = User::where('usertype', 'auteur')->findOrFail($id);
        $auteur->update(['is_active' => false]);
        
        return redirect()->route('admin.auteurs')->with('success', 'Compte de ' . $auteur->name . ' désactivé.');
    }
}