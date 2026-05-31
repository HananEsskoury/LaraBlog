<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(Request $request): View
    {
        return view('profile.show', [
            'user' => $request->user(),
        ]);
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $user = $request->user();

        $user->name  = $request->input('name');
        $user->email = $request->input('email');
        $user->bio   = $request->input('bio');

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($request->hasFile('avatar')) {
            // Supprimer l'ancien avatar
            if ($user->avatar) {
                $oldPath = public_path('img/' . $user->avatar);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // Sauvegarder dans public/img/
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $user->avatar = $filename;
        }

        $user->save();

        return Redirect::route('profile.show')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
{
    $request->validateWithBag('userDeletion', [
        'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    // Supprimer l'avatar du disque
    if ($user->avatar) {
        $path = public_path('img/' . $user->avatar);
        if (file_exists($path)) {
            @unlink($path); // @ pour éviter la warning
        }
    }

    Auth::logout();
    foreach ($user->posts as $post) {
    if ($post->image && file_exists(public_path('img/posts/'.$post->image))) {
        @unlink(public_path('img/posts/'.$post->image));
    }
}
    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return Redirect::to('/')->with('status', 'account-deleted');
}
}