<x-guest-layout>

    <h2 class="text-2xl font-bold mb-6">
            Mes Memes</h2>
            @include('profile._subnav')
    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @forelse ($memes as $meme)
        <div class='meme'>
        <a href="{{ route('memes.show', ['meme' => $meme->id, 'from' => 'profile']) }}">
          <img src="{{ asset('storage/' . $meme->img_path) }}" alt="Meme" class="w-64 h-64">
        </a>

                    <div class="flex justify-end space-x-3 mt-4">
                        <a href="{{ route('memes.edit', $meme->id) }}"
                            class=" px-3 py-5 bg-grey-500 text-white rounded hover:bg-grey-600">Modifier</a>

                        <form action="{{ route('memes.destroy', $meme->id) }}" method="POST"
                              onsubmit="return confirm('Voulez-vous vraiment supprimer ce mème ?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 rounded hover:bg-grey-600">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </a>
                </div>
                @empty
                <p class="text-gray-600 text-center">Vous n’avez créé aucun battle pour l’instant.</p>
            @endforelse
        </div>
    </div>
    
</x-guest-layout>