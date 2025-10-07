<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MemeCreateRequest;
use App\Models\Meme;
use App\Models\Battle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class MemeController extends Controller
{
      use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memes = Meme::orderByDesc('updated_at')
        ->paginate(10);
        return view('memes.index',['memes'=>$memes,]);
    }
   


    /**
     * Show the form for creating a new resource.
     */

    public function create(Battle $battle)
    {
        return view('memes.create', compact('battle'));
    }

   /**
     * Store a newly created resource in storage.
     */
    public function store(MemeCreateRequest $request, Battle $battle)
    {

        if ($battle->memes()->count() >= 4) {
        return redirect()->back()->with('error','Ce battle a déjà 4 mèmes. Vous ne pouvez pas en ajouter plus.');
    }
        if($battle->end_date < now()){
            return redirect()->back()->with('error','Ce battle est terminé, il n’est plus possible d’ajouter des mèmes.');
        }

        $meme = new Meme();
        $meme->user_id = Auth::id();
        $meme->battle_id = $battle->id;

        if ($request->hasFile('img_path')) {
            $meme->img_path = $request->file('img_path')->store('memes', 'public');
        }


            $meme->save();

        return redirect()->route('battles.show', $battle->id)->with('success', 'Mème ajouté !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Meme $meme, Request $request)
   {

        $from = $request->query('from', 'all'); // 'battle' ou 'all'

    return view('memes.show', compact('meme', 'from'));
   }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meme $meme)
    {
         if($meme->user_id!==Auth::id()){
                abort(403,'Vous n’êtes pas autorisé à modifier ce mème.');
            }
            return view('memes.edit',compact('meme'));

        }

        public function update(Request $request, Meme $meme)
    {
        $validated = $request->validate([
            'img_path'=>'required|image|max:2048'
        ]);

        if ($request->hasFile('img_path')) {
        $meme->img_path = $request->file('img_path')->store('memes', 'public');
    }

    $meme->save();
        return redirect()->route('profile.my-memes', $meme->id)
                         ->with('success', 'Le mème a été mis à jour !');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meme $meme){
        $this->authorize('delete', $meme);
        $meme->delete();

        return redirect()->back();
    }

    public function download(Meme $meme)
    {
    
        if (!Storage::disk('public')->exists($meme->img_path)) {
            return redirect()->back()->with('error', 'Le fichier n\'existe pas.');
       }

    
    return Storage::disk('public')->download($meme->img_path);
   }
}
