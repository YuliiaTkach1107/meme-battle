<x-guest-layout>
    <div class="max-w-3xl mx-auto py-6">
        <h1 class="text-2xl font-bold mb-6">Mon profile</h1>
@include('profile._subnav')

            <div class="bg-white shadow rounded p-6 space flex flex-col text-center items-center ">
              <x-avatar class="h-20 w-20 rounded-full" :user="$user" />
            <div class="mb-6 mt-6">
                <h2 class="font-semibold text-gray-700">Nom</h2>
                <p class="text-gray-900">{{ $user->name }}</p>
            </div>

            <div class="mb-6">
                <h2 class="font-semibold text-gray-700 ">Email</h2>
                <p class="text-gray-900">{{ $user->email }}</p>
            </div>

            <div>
                <h2 class="font-semibold text-gray-700">Rôle</h2>
                <p class="text-gray-900">{{ $user->role->name }}</p>
            </div>

        </div>
    </div>
</x-guest-layout>
