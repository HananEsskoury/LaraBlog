<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register.register'); 
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
            'is_auteur' => ['nullable', 'in:1'],                                    
            'avatar'    => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:20480'], 
            'bio' => ['nullable', 'string', 'max:10000'],
        ]);

        //  traitement avatar
        $avatarName = null;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('img'), $avatarName);
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => $request->is_auteur === "1" ? 'auteur' : 'user', 
            'avatar'   => $avatarName,
            'bio'      => $request->bio,                                      
        ]);

        event(new Registered($user));
        Auth::login($user);

        if ($user->usertype === 'auteur') {
            return redirect()->route('auteur.dashboard');
        }

        return redirect()->route('home');
    }
}