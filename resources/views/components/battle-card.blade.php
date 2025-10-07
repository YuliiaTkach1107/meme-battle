<div>
<a class=" flex flex-col h-full space-y-4 bg-white rounded-md shadow-md p-5 w-full hover:shadow-lg hover:scale-105 transition"
    href="{{ route('battles.show', $battle) }}">
    
    <div class="uppercase font-bold text-gray-800">
        {{ $battle->title }}
    </div>
    <div class="flex-grow text-gray-700 text-sm text-justify">
        {{ Str::limit($battle->description,50) }}
    </div>
    <div class="text-xs text-gray-500">
        <p>Valable jusqu'au:
        {{ $battle->end_date }}
        </p>
    </div>
</a>
</div>