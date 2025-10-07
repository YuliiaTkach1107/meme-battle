<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Battle;
use App\Models\Vote;
use App\Models\Meme;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Battle $battle, Meme $meme)
    {

        if ($battle->end_date < now()) {
            return redirect()->back()->with('error','Ce battle est terminé, il n’est plus possible de voter.');

        }

        
        $existingVote = Vote::where('user_id', Auth::id())
                            ->where('battle_id', $battle->id)
                            ->where('meme_id', $meme->id)
                            ->first();

        if ($existingVote) {
              return back()->with('error','Vous avez déjà voté pour ce meme.');
        }

        Vote::create([
            'user_id' => Auth::id(),
            'meme_id' => $meme->id,
            'battle_id' => $battle->id,
        ]);

        return redirect()->back()->with('success', 'Votre vote a été enregistré !');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
