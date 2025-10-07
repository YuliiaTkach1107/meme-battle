<x-guest-layout>

    <h2 class="text-2xl font-bold mb-6">
            Mes Battles</h2>
            @include('profile._subnav')
            <div class="flex  items-center justify-end space-x-8 mb-8">
                            <a href="{{ route('battles.create') }}"
                                class="text-gray-200 font-bold py-2 px-4 rounded hover:bg-gray-600 transition">
                                 <x-heroicon-o-plus class="w-4 h-4 mr-2" />
                                Ajouter une battle </a>
    </div>
    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 ">
            @forelse ($battles as $battle)
                <div class="bg-white shadow-sm rounded-lg p-6 mb-4 dark">
                    <a href="{{ route('battles.show', ['battle' => $battle->id, 'from' => 'profile']) }}">
                    <h3 class="text-lg font-bold">{{ $battle->title }}</h3>
                    <p class="text-sm text-gray-500 mb-3">{{ $battle->description }}</p>
                    <p class="text-sm text-gray-400">Date de fin : {{ $battle->end_date->format('d/m/Y H:i') }}</p>

                    <div class="flex justify-end space-x-3 mt-4">
                        <a href="{{ route('battles.edit', $battle->id) }}"
                           class=" px-3 py-5 bg-grey-500 text-white rounded hover:bg-grey-600">Modifier</a>

                        <form action="{{ route('battles.destroy', $battle->id) }}" method="POST"
                              onsubmit="return confirm('Voulez-vous vraiment supprimer ce battle ?')">
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