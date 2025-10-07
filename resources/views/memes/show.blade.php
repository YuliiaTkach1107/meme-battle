<x-guest-layout>
    <div class="max-w-lg mx-auto py-8 text-center">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ asset('storage/' . $meme->img_path) }}" alt="Meme Image" class="w-full object-cover h-auto">
        </div>
    <a href="{{ route('memes.download', $meme->id) }}"
          class="px-3 py-2 flex justify-row gap-2">
          Télécharger
         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 12v8m0 0l-4-4m4 4l4-4M12 4v8" />
    </svg>
    </a>


        
        <p class="mt-4 text-gray-200 font-semibold">
            Auteur: {{ $meme->user->name }}
        </p>

        <div class="mt-4">
        @if($from === 'battle')
        <div class="mt-8 flex items-center justify-center ">
            <a href="{{ route('battles.show', $meme->battle_id) }}" 
                 class="font-bold bg-white text-gray-700 px-4 py-2 rounded shadow dark">
                Retour au battle
            </a>
        </div>
        @elseif ($from === 'profile')
        <a href="{{ route('profile.my-memes') }}" 
           class="font-bold bg-white text-gray-700 px-4 py-2 rounded shadow dark">
           Retour à mon profile
        </a>
        @else
        <div class="mt-8 flex items-center justify-center">
            <a href="{{ route('memes.index') }}" 
              class="font-bold bg-white text-gray-700 px-4 py-2 rounded shadow dark"
            >
                Retour à la liste des memes
            </a>
        </div>
        @endif
    </div>
    </div>
</x-guest-layout>
