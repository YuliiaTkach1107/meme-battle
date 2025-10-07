<x-guest-layout>
  
    <h1 class="font-bold text-xl mb-4">Liste des mèmes</h1>
         
    <ul class="grid sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-8">
        @foreach ($memes as $meme)
            <li>
                <x-meme-card :meme="$meme" />
                
            </li>
        @endforeach
    </ul>
    {{ $memes->links() }}
</x-guest-layout>

