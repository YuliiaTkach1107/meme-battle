<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-200">
<div class="min-h-screen flex flex-col pt-6 sm:pt-0">
    <div class="container mx-auto flex flex-col space-y-10">

         <!-- Navbar -->
        <nav class="flex justify-between items-center py-4 px-6 bg-gradient-to-r from-indigo-500 via-purple-500 to-red-500 rounded-xl shadow-lg">
            <a href="/" class="flex items-center space-x-4 transform transition duration-300 hover:scale-105">
                <x-application-logo class="w-12 h-12 text-white drop-shadow-lg" />
                <span class="text-white font-extrabold text-3xl drop-shadow-lg">Meme Battle Arena</span>
            </a>
            <div class='flex justify-between items-center color-white-400 gap-7'>
                <a href="{{ route('battles.index') }}" class="hover:text-gray-300 text-white">Battles</a>
                <a href="{{ route('memes.index') }}" class='hover:text-gray-300 text-white'> Memes </a>
                @auth
                <a href=" {{ route('profile.index') }}" class='hover:text-gray-300 text-white'>Profile</a>
                @endauth
            </div>
        </nav>

        <!-- Main Content -->
        <main class="bg-gray-100 rounded-2xl shadow-2xl p-6 md:p-10 mx-2 md:mx-0 animate-fadeIn">
            {{ $slot }}
        </main>
        <div class="mt-4 flex space-x-4 justify-end">
            @guest
            @if(!request()->routeIs('login'))
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900 ">Connexion</a>
            @endif
            @if(!request()->routeIs('register'))
                <a href="{{ route('register') }}" class="text-sm text-gray-600 hover:text-gray-900">Créer un compte</a>
            @endif
            @endguest
            @auth
                <form method="POST" action="{{ route('logout') }}">
                   @csrf
                <button type="submit" class="text-sm text-gray-600 hover:text-gray-900">Se déconnecter</button>
                </form>
            @endauth
            </div>
    </div>
</div>


<!-- Footer -->
<footer class="bg-gradient-to-r from-indigo-500 via-purple-500 to-red-500 text-white py-6 mt-10 rounded-t-3xl shadow-xl">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
        <p class="mb-4 md:mb-0 font-bold text-lg text-white drop-shadow-md animate-fadeIn">&copy; 2025 Meme Battle Arena. Tous droits réservés.</p>
    </div>
</footer>

<!-- Tailwind Animations -->
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.8s ease-out forwards;
    }
</style>

</body>
</html>



