<div class="bg-gray-100 px-6 py-3 mb-6 flex space-x-4 shadow-sm rounded">
    <a href="{{ route('profile.my-battles') }}"
       class="px-3 py-2 rounded font-semibold {{ request()->routeIs('profile.my-battles') ? 'bg-gray-300' : '' }}">
       Mes battles
    </a>
    <a href="{{ route('profile.my-memes') }}"
       class="px-3 py-2 rounded font-semibold {{ request()->routeIs('profile.my-memes') ? 'bg-gray-300' : '' }}">
       Mes memes
    </a>
    <a href="{{ route('profile.edit') }}"
       class="px-3 py-2 rounded font-semibold {{ request()->routeIs('profile.edit') ? 'bg-gray-300' : '' }}">
       Modifier mon profile
    </a>


    
</div>
