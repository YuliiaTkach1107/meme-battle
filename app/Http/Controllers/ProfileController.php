<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Battle;
use App\Models\Meme;

class ProfileController extends Controller

{
    public function index()
{
       $user = Auth::user(); // текущий пользователь
       $battles = Battle::where('user_id', $user->id)
                        ->orderByDesc('created_at')
                        ->get();

    return view('profile.index', compact('battles', 'user'));
}

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function myBattles(){
        $battles = Battle::where('user_id',Auth::id())->latest()->get();
        return view('profile.my-battles',compact('battles'));
    }

    public function myMemes(){
        $memes = Meme::where('user_id',Auth::id())->latest()->get();
        return view('profile.my-memes',compact('memes'));
    }

    public function updateAvatar(Request $request): RedirectResponse
{
  
    $request->validate([
        'avatar' => ['required', 'image', 'max:2048'],
    ]);

   
    if ($request->hasFile('avatar')) {
        $user = $request->user();
        $path = $request->file('avatar')->store('avatars', 'public');
        $user->avatar_path = $path;
        $user->save();
    }

    return Redirect::route('profile.edit')->with('status', 'avatar-updated');
}
}
