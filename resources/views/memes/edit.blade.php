<x-guest-layout>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 dark">
            <div class="flex justify-between mt-8">
                <div class=" text-2xl">

    <h2 class="text-2xl mb-4">Modifier un mème </h2>
                </div>
            </div>
    <form action="{{ route('memes.update', $meme->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col space-y-4 text-gray-500 ">
        @csrf
        @method('PUT')

            <x-input-label for="img_path" :value="__('Image:')" class='text-gray-200' />
            <x-text-input  type="file" class='text-gray-200 file:bg-gray-700 file:text-white' name="img_path" id="img_path" required
            :value="old('img_path',$meme->img_path)" autofocus />
            @error('img_path')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>


        <div class="mt-8 flex items-center justify-center ">
        <button type="submit" class="font-bold bg-white text-gray-700 px-4 py-2 rounded shadow dark">Enregistrer</button>
        <a href="{{ route('profile.my-memes', $meme->id) }}" class="ml-2 text-gray-200">Annuler</a>
    </form>
</x-guest-layout>

