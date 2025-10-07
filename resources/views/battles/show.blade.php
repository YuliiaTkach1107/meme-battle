<x-guest-layout>

  @if (session('success'))
    <div class="alert alert-success" style="background-color: #d1fae5; color: #065f46; padding: 10px; border-radius: 8px; margin-bottom: 10px;">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger" style="background-color: #fee2e2; color: #991b1b; padding: 10px; border-radius: 8px; margin-bottom: 10px;">
        {{ session('error') }}
    </div>
@endif

  <h1 class="font-bold text-xl mb-4 capitalize">{{ $battle->title }}</h1>


  <div class="mb-4 text-xs text-gray-500">
    {{ $battle->end_date?->diffForHumans() }}
  </div>



@if ($battle->end_date < now())
    <div class="flex items-center justify-end space-x-8 mb-8">
        <p class="font-bold text-right text-gray-200">La battle est terminée</p>
    </div>
    @if($winner)

    <h2 class="font-bold text-center text-xl mb-4 text-gray-200 ">Mème gagnant :</h2>
    <a href="{{ route('memes.show', $winner->id) }}">
    
        <img src="{{ asset('storage/' . $winner->img_path) }}" alt="Winner" class=" w-100 h-100 justify-center">
    </a>
    
    @else
        <p class='font-bold text-center text-xl text-gray-200 '>Aucun gagnant pour ce battle.</p>
    @endif
@elseif ($battle->memes->count() >= 4)
    <div class="flex items-center justify-end space-x-8 mb-8">
        <p class="font-bold text-right">La battle est déjà pleine</p>
    </div>
@else
    <div class="flex items-center justify-end space-x-8 mb-8">
        <a href="{{ route('battles.memes.create', $battle->id) }}"
           class="text-gray-200 font-bold py-2 px-4 rounded hover:bg-gray-600 transition">
            <x-heroicon-o-plus class="w-4 h-4 mr-2" />
            Ajouter un mème
        </a>
    </div>
@endif



  <div class="mt-4">{!! \nl2br(e($battle->description)) !!}</div>

  @if($battle->end_date>=now())
  <div class="mt-8 flex items-center justify-center gap-10">
    @foreach($battle->memes as $meme)
    <div class='meme'>
        <a href="{{ route('memes.show', ['meme' => $meme->id, 'from' => 'battle']) }}">
          <img src="{{ asset('storage/' . $meme->img_path) }}" alt="Meme" class="w-64 h-64">
        </a>

        @php
          $userVoteForThisMeme = $meme->votes()->where('user_id', auth()->id())->exists();
        @endphp

        @if(!$userVoteForThisMeme)
          <form action="{{ route('votes.store', ['battle' => $battle->id, 'meme' => $meme->id]) }}" method="POST">
            @csrf
            <button type='submit' class="font-bold bg-white text-gray-700 px-4 py-2 rounded shadow mt-4 dark">
              Voter pour ce mème
            </button>
          </form>
          @else
          <p class="mt-2 text-gray-200 font-semibold">
            Score : {{ $meme->votes()->count() }}
          </p>
        @endif
    </div>
     
      @endforeach
      </div>
@else
@php 
$winner = $battle->winnerMeme()
@endphp
@endif
  <div class="flex mt-8">
    <div class="ml-4 flex flex-col justify-center">
        <x-avatar class="h-20 w-20" :user="$battle->user" />
      <div class="text-gray-400">{{ $battle->user->name }}</div>
      <div class="text-gray-300">{{ $battle->user->email }}</div>
    </div>
  </div>


  <div class="mt-8 flex items-center justify-center ">
    @if ($from === 'profile')
        <a href="{{ route('profile.my-battles') }}" 
           class="font-bold bg-white text-gray-700 px-4 py-2 rounded shadow dark">
           Retour à mon profil
        </a>
    @else
        <a href="{{ route('battles.index') }}" 
           class="font-bold bg-white text-gray-700 px-4 py-2 rounded shadow dark">
           Retour à la liste des battles
        </a>
    @endif
</div>

</x-guest-layout>