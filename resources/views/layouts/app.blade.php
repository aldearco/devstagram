<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>DevStagram - @yield('titulo')</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}" defer></script>

    </head>
    <body class="bg-gray-100">
        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between items-center">
                <a href="{{ route('principal') }}"><h1 class="text-3xl font-black">DevStagram</h1></a>
                <nav class="flex gap-2 items-center">
                    @auth
                        
                    <a class="font-bold text-gray-600 text-sm" href="{{ route('post.index', ['user'=> auth()->user()]) }}">{{ '@'.auth()->user()->username }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="font-bold uppercase text-gray-600 text-sm">Cerrar sesión</button>
                    </form>
                    @endauth

                    @guest
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('login') }}">Login</a>
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register.index') }}">Crear cuenta</a>
                    @endguest
                </nav>
            </div>
        </header>

        <main class="container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10">@yield('titulo')</h2>
            @yield('contenido')
        </main>

        <footer class="text-center p-5 text-gray-600 font-bold uppercase mt-10">
           DevStagram - Todos los derechos reservados {{ now()->year }}
        </footer>

    </body>
</html>
