<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Meme Battle Arena') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #121212, #1a1a1a, #121212);
            color: #f1f1f1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        form{
            padding:20px 20px 20px 20px;
        }
        .dark {
        background-color: #2d2d2d; /* темно-серый фон */
        color: #e0e0e0; /* светло-серый текст */
        border: 1px solid #555;
}
        .dark-card{
            background-color: #2d2d2d; /* темно-серый фон */
        color: #dfdbdbff; /* светло-серый текст */
        border: 1px solid #555;
        }
        .dark-card h2{
           color: #b8b4b4ff;
        }
        .dark-card p{
             color: #dfdbdbff;
        }
        /* Navbar */
        nav.top {
            position: sticky;
            top: 0;
            z-index: 50;
            background: linear-gradient(90deg, #ff007f, #ff9900, #ff007f);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #ff007f;
        }
        nav a {
            color: white;
            font-weight: 600;
            transition: all 0.3s;
        }
        nav a:hover {
            text-shadow: 0 0 10px #ff007f, 0 0 20px #ff9900;
            transform: scale(1.1);
        }

        /* Banner */
        .battle-banner {
            position: relative;
            text-align: center;
            padding: 4rem 2rem;
            margin: 2rem auto;
            border-radius: 16px;
            background: linear-gradient(135deg, #ff007f, #ff9900, #ff007f);
            box-shadow: 0 0 25px rgba(255,0,127,0.5);
            overflow: hidden;
            animation: pulseBanner 2s infinite;
        }
        .battle-banner h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: white;
            text-shadow: 2px 2px 6px rgba(0,0,0,0.5);
        }
        @keyframes pulseBanner {
            0%,100% { transform: scale(1); box-shadow: 0 0 25px rgba(255,0,127,0.5); }
            50% { transform: scale(1.02); box-shadow: 0 0 35px rgba(255,0,127,0.8); }
        }

        /* Flash messages */
        .flash-message {
            max-width: 600px;
            margin: 0 auto 2rem;
            text-align: center;
        }
        .flash-message div {
            border-radius: 12px;
            padding: 1rem 1.5rem;
            font-weight: 600;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }

        /* Main content */
        main {
            flex: 1;
            margin:auto;
            padding:20px;
            max-width: 1200px;
            background: rgba(30,30,30,0.7);
            border-radius: 20px;
            backdrop-filter: blur(6px);
            box-shadow: 0 0 20px rgba(255,0,127,0.2);
            animation: fadeIn 0.8s ease-out forwards;
        }
        

        /* Footer */
        footer {
            background: linear-gradient(90deg, #ff007f, #ff9900, #ff007f);
            padding: 1.5rem 2rem;
            text-align: center;
            font-weight: bold;
            box-shadow: inset 0 0 15px rgba(255,0,127,0.4);
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class='top'>
        <a href="/" class="flex items-center gap-3">
            <x-application-logo class="w-12 h-12 text-white drop-shadow-lg" />
            <span class="text-2xl md:text-3xl font-extrabold">🔥 Meme Battle Arena</span>
        </a>
        <div class="flex gap-6">
            <a href="{{ route('battles.index') }}">Battles</a>
            <a href="{{ route('memes.index') }}">Memes</a>
            @auth
                <a href="{{ route('profile.index') }}">Profile</a>
            @endauth
        </div>
    </nav>

    <!-- Banner -->
    <section class="battle-banner">
        <h1>⚔️ Que le meilleur meme gagne ! ⚔️</h1>
    </section>

    <!-- Flash messages -->
    <div class="flash-message">
        @if(session('success'))
            <div class="bg-green-600/70 text-white">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-600/70 text-white">{{ session('error') }}</div>
        @endif
    </div>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

     <div class=" flex space-x-4 justify-end mr-6 mb-4 mt-4">
            @guest
            @if(!request()->routeIs('login'))
                <a href="{{ route('login') }}" class="text-sm text-white hover:text-grey-600 ">Connexion</a>
            @endif
            @if(!request()->routeIs('register'))
                <a href="{{ route('register') }}" class="text-sm text-white hover:text-grey-600">Créer un compte</a>
            @endif
            @endguest
            @auth
                <form method="POST" action="{{ route('logout') }}">
                   @csrf
                <button type="submit" class="text-sm text-white hover:text-grey-600">Se déconnecter</button>
                </form>
            @endauth
            </div>

    <!-- Footer -->
    <footer>
        &copy; {{ date('Y') }} Meme Battle Arena — Créé avec ❤️ et beaucoup de mèmes.
    </footer>

</body>
</html>
