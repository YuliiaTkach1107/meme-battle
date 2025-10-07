<div class="rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 ">
    <a class="flex flex-col h-full space-y-4 bg-white rounded-md shadow-md p-5 w-full hover:shadow-lg hover:scale-105 transition dark-card"
    href="{{ route('memes.show', $meme) }}">
    <img src="{{ asset('storage/' . $meme->img_path) }}" alt="Meme" class="w-full h-64 object-cover">

    <div class="p-4">
        <p class="text-gray-800 font-semibold mb-2">Auteur: {{ $meme->user->name }}</p>
        @if($meme->battle)
            <p class="text-gray-500 text-sm mb-2">Battle: {{ $meme->battle->title }}</p>
        @endif
    </div>
</a>
</div>