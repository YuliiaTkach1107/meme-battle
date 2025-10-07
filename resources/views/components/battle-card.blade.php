<div>
<a class=" flex flex-col h-full space-y-4 bg-white rounded-md shadow-md p-5 w-full hover:shadow-lg hover:scale-105 transition dark-card"
    href="{{ route('battles.show', $battle) }}">
    
    <div class="uppercase font-bold text-gray-400">
        {{ $battle->title }}
    </div>
    <div class="flex-grow text-gray-300 text-sm text-justify">
        {{ $battle->description }}
        
    </div>
    <div class="text-xs text-gray-100">
        <p>Valable jusqu'au:
        {{ $battle->end_date }}
        </p>
    </div>
</a>
</div>