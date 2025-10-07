<x-guest-layout>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="flex justify-between mt-8">
                <div class=" text-2xl">

    <h2 class="text-2xl mb-4">Ajouter un mème au battle </h2>
                </div>
            </div>
@if($battle->memes->count() < 10)
    <form action="{{ route('battles.memes.store', $battle->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col space-y-4 text-gray-500">
        @csrf

        <div>
            <x-input-label for="img_path" :value="__('Image:')" />
            <x-text-input  type="file" name="img_path" id="img_path" required/>
            @error('img_path')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex justify-center">
                    <x-primary-button type="submit">
                        {{ __('Ajouter le meme') }}
                    </x-primary-button>
        </div>

                    <div class="mt-8 flex items-center justify-center">

                    <a href="{{ route('battles.show', $battle->id) }}" class='font-bold bg-white text-gray-700 px-4 py-2 rounded shadow'>
                        {{ __('Retour au battle') }}
                    </a>
              
    </form>

    @else
    <p>Ce battle a déjà atteint le nombre maximum de 10 memes.</p>
    @endif
</x-guest-layout>
