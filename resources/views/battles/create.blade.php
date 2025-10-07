<x-guest-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Battles') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="flex justify-between mt-8">
                <div class=" text-2xl">
                    Créer une battle
                </div>
            </div>

            <form method="POST" action="{{ route('battles.store') }}" class="flex flex-col space-y-4 text-gray-500">

                @csrf

                <div>
                    <x-input-label for="title" :value="__('Titre')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                        :value="old('title')" autofocus />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="end_date" :value="__('Date d\'expiration')" />
                    <x-text-input id="end_date" type="date" name="end_date" :value="old('end_date')" />
                    <x-input-label for="end_time" :value="__('Heure de fin (facultatif)')" />
                    <x-text-input id="end_time" type="time" name="end_time" :value="old('end_time')" />
                    <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                </div>
                


                <div>
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea id="description"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        name="description" rows="10">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="flex justify-end">
                    <x-primary-button type="submit">
                        {{ __('Créer') }}
                    </x-primary-button>
                </div>
                <div class="mt-8 flex items-center justify-center ">
                    <a
                    href="{{ route('battles.index') }}" class='font-bold bg-white text-gray-700 px-4 py-2 rounded shadow' >
                    Retour à la liste des battles
                    </a>
            </form>
        </div>
    </div>
</x-guest-layout>
