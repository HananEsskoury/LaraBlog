<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Categorie;
use App\Notifications\PostSubmittedNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuteurController extends Controller
{
    /**
     * Vérifie si l'auteur est actif
     */
    private function checkActive()
    {
        if (!auth()->user()->is_active) {
            return false;
        }
        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | ADD POST — afficher formulaire
    |--------------------------------------------------------------------------
    */
    public function addpost()
    {
        // Vérifier si l'auteur est actif
        if (!auth()->user()->is_active) {
            return redirect()->route('auteur.dashboard')
                ->with('error', '❌ Votre compte est désactivé. Vous ne pouvez pas soumettre de nouveaux articles.');
        }
        
        $categories = Categorie::all();
        return view('auteur.addpost', compact('categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE POST
    |--------------------------------------------------------------------------
    */
    public function createpost(Request $request)
    {
        // Vérifier si l'auteur est actif
        if (!auth()->user()->is_active) {
            return redirect()->route('auteur.dashboard')
                ->with('error', '❌ Votre compte est désactivé. Vous ne pouvez pas soumettre d\'articles.');
        }

        $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string'],
            'image'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'categorie_id' => ['nullable', 'exists:categories,id'],
        ]);

        $post = new Post();
        $post->title        = $request->title;
        $post->description  = $request->description;
        $post->user_id      = Auth::id();
        $post->categorie_id = $request->categorie_id;
        $post->slug         = Str::slug($request->title) . '-' . time();
        $post->status       = 'pending';

        // ✅ Stocker dans public/img
        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $post->image = $filename;
        }

        $post->save();

        // Notifier tous les admins
        User::where('usertype', 'admin')->get()
            ->each(fn($admin) => $admin->notify(new PostSubmittedNotification($post)));

        return redirect()
            ->route('auteur.dashboard')
            ->with('success', 'Article soumis ! En attente de validation par l\'admin.');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT POST — afficher formulaire
    |--------------------------------------------------------------------------
    */
    public function editpost($id)
    {
        // Vérifier si l'auteur est actif
        if (!auth()->user()->is_active) {
            return redirect()->route('auteur.dashboard')
                ->with('error', '❌ Votre compte est désactivé. Vous ne pouvez pas modifier d\'articles.');
        }
        
        $post       = Post::where('user_id', auth()->id())->findOrFail($id);
        $categories = Categorie::all();
        return view('auteur.editpost', compact('post', 'categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE POST
    |--------------------------------------------------------------------------
    */
    public function updatepost(Request $request, $id)
    {
        // Vérifier si l'auteur est actif
        if (!auth()->user()->is_active) {
            return redirect()->route('auteur.dashboard')
                ->with('error', '❌ Votre compte est désactivé. Vous ne pouvez pas modifier d\'articles.');
        }
        
        $post = Post::where('user_id', auth()->id())->findOrFail($id);

        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'categorie_id' => 'nullable|exists:categories,id',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['title', 'description', 'categorie_id']);
        $data['status']           = 'pending'; // ← toujours pending après modif
        $data['rejection_reason'] = null;      // ← efface le refus précédent

        if ($request->title !== $post->title) {
            $data['slug'] = Str::slug($request->title) . '-' . $post->id;
        }

        if ($request->hasFile('image')) {
            if ($post->image && file_exists(public_path('img/' . $post->image))) {
                unlink(public_path('img/' . $post->image));
            }
            $file     = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $data['image'] = $filename;
        }

        $post->update($data);
        $post->load('user');

        // ✅ Notifier les admins
        User::where('usertype', 'admin')->get()
            ->each(fn($admin) => $admin->notify(new PostSubmittedNotification($post)));

        return redirect()->route('auteur.dashboard')
            ->with('success', 'Article modifié et resoumis pour validation.');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE POST
    |--------------------------------------------------------------------------
    */
    public function deletepost($id)
    {
        $post = Post::where('user_id', auth()->id())->findOrFail($id);

        // ✅ Supprimer depuis public/img
        if ($post->image && file_exists(public_path('img/' . $post->image))) {
            unlink(public_path('img/' . $post->image));
        }

        $post->delete();

        return redirect()->route('auteur.dashboard')->with('success', 'Article supprimé.');
    }
}