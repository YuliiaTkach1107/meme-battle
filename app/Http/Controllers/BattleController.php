<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Battle;
use App\Models\Meme;
use App\Http\Requests\BattleCreateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;

class BattleController extends Controller
{
    public function index(Request $request){
        Battle::where('end_date', '<', now()->subHours(24))->delete();

        $query = Battle::query();

        
        if($search = $request ->input('search')){
            $query->where('title','like',"%{$search}%");
        }

        if ($request->filled('status')) {
        if ($request->status === 'open') {
            $query->where('end_date', '>=', now());
        } elseif ($request->status === 'closed') {
            $query->where('end_date', '<', now());
        }
    }
        $battles = $query->orderByDesc('start_date')->paginate(10)
                   ->appends($request->all());

        //$battles = Battle::paginate(10);

        return view('battles.index',[
            'battles'=>$battles,
        ]);
    }


    public function show(Request $request, $id)
    {
       //$battle = Battle::findOrFail($id);
       $battle = Battle::with('memes.votes')->findOrFail($id);
       $from = $request->query('from', 'index');

       $winner=null;
       if ($battle->end_date < now()) { 
        $winner = $battle->memes->sortByDesc(fn($m) => $m->votes->count())->first();
       
       
    }

        return view('battles.show', compact('battle','winner','from'));
    }



    public function create()
    {
        return view('battles.create');
    }

    public function store(BattleCreateRequest $request){
        $validated = $request->validated();

        $time = $request->input('end_time', '23:59');


        // Convertir la date de la requête en objet Carbon
       $endDateTime = Carbon::parse("{$validated['end_date']} {$time}");

        $battle = Battle::make();
        $battle->title = $request->validated()['title'];
        $battle->description = $request->validated()['description'];
        $battle->end_date = $endDateTime;
        $battle->user_id = Auth::id();
        $battle->save();

        return redirect()->route('battles.index')
                     ->with('success', 'Le battle a été créé avec succès !');
}

       

        public function edit(Battle $battle){
            if($battle->user_id!==Auth::id()){
                abort(403,'Vous n’êtes pas autorisé à modifier ce battle.');
            }
            return view('battles.edit',compact('battle'));

        }
        public function update(Request $request, Battle $battle)
    {
        if ($battle->user_id !== Auth::id()) {
            abort(403, 'Vous n’êtes pas autorisé à modifier ce battle.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'end_date' => 'required|date',
        ]);

        $battle->update($validated);

        return redirect()->route('profile.my-battles', $battle->id)
                         ->with('success', 'Le battle a été mis à jour !');
    }
        public function destroy(Battle $battle){
        $this->authorize('delete', $battle);


        $battle->delete();

        return redirect()->back();
}
    }

