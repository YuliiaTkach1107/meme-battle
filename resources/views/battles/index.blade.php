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
    <h1 class="font-bold text-xl mb-4">Liste des battles</h1>

    <form action="{{ route('battles.index') }}" method="GET" class="flex items-center space-x-2">
    <input 
        type="text" 
        name="search" 
        placeholder="Rechercher des battles..." 
        value="{{ request('search') }}" 
        class="border rounded px-3 py-1 w-full"
    >
    <button type="submit" class="font-bold bg-white text-gray-700 px-4 py-2 rounded shadow ">
        Trouver
    </button>
</form>

<form action="{{ route('battles.index') }}" method="GET" class="flex items-center  space-x-2">
<select name='status' class="border rounded px-3 py-1">
    <option value=""> Tous </option>
    <option value="open"{{ request('status')=='open'? 'selected':'' }}>Ouvert</option>
    <option value="closed"{{ request('status')=='closed'? 'selected':'' }}>Clos</option>
</select>

<button type="submit" class="font-bold bg-white text-gray-700 px-4 py-2 rounded shadow ">
        Appliquer
    </button>
</form>

    <div class="flex  items-center justify-end space-x-8 mb-8">
                            <a href="{{ route('battles.create') }}"
                                class="text-gray-500 font-bold py-2 px-4 rounded hover:bg-gray-200 transition">
                                 <x-heroicon-o-plus class="w-4 h-4 mr-2" />
                                Ajouter une battle </a>
    </div>
    <ul class="grid sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-8">
        @foreach ($battles as $battle)
           <li>
            <x-battle-card :battle="$battle"/>
           </li>
        @endforeach
    </ul>
    {{ $battles->links() }}
</x-guest-layout>

