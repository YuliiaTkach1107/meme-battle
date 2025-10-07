<x-guest-layout>
    <h1 class="text-xl font-bold mb-4">Modifier le battle</h1>

    @if ($errors->any())
        <div class="mb-4 text-red-500">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('battles.update',$battle->id )}}" method="POST">
        @csrf
        @method('PUT')

                <div>
                    <x-input-label for="title" :value="__('Titre')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                        :value="old('title',$battle->title)" autofocus />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="end_date" :value="__('Date d\'expiration')" />
                    <x-text-input id="end_date" type="date" name="end_date" :value="old('end_date',$battle->end_date?->format('Y-m-d'))" />
                    <x-input-label for="end_time" :value="__('Heure de fin (facultatif)')" />
                    <x-text-input id="end_time" type="time" name="end_time" :value="old('end_time',$battle->end_time?->format('H:i'))" />
                    <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                </div>
                


                <div>
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea id="description"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        name="description" rows="10">{{ old('description',$battle->description) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
                <div class="mt-8 flex items-center justify-center ">
        <button type="submit" class="font-bold bg-white text-gray-700 px-4 py-2 rounded shadow'">Enregistrer</button>
        <a href="{{ route('profile.my-battles', $battle->id) }}" class="ml-2 text-gray-700">Annuler</a>
    </form>
</x-guest-layout>
