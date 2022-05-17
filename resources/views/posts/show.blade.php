@extends('layouts.app')

@section('titulo')
{{ $post->titulo }}
@endsection

@section('contenido')
<div class="container mx-auto md:flex gap-6">
    <div class="md:w-1/2">
        <img src="{{ asset('uploads').'/'.$post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
    </div>
    <div class="md:w-1/2 p-5 shadow-lg md:rounded-lg bg-white">
        <div>
            <a href="{{ route('posts.index', ['user'=> $user->username]) }}" class="font-bold">{{ $user->username }}</a>
            <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
            <p class="mt-5">{{ $post->descripcion }}</p>
        </div>
        <div class="py-3 flex items-center gap-2">
            @auth
            <livewire:like-post :post="$post" />
            {{-- <livewire:like-post :post="$post" /> --}}
            {{-- @if ($post->checkLike(auth()->user()))
            <form method="POST" action="{{ route('posts.likes.destroy', $post) }}">
                <div class="my-4">
                    @csrf
                    @method('DELETE')
                    
                </div>
            </form>
            @else
            <form method="POST" action="{{ route('posts.likes.store', $post) }}">
                <div class="my-4">
                    @csrf
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button>
                </div>
            </form>
            @endif --}}
            @endauth
            @guest
            <div class="my-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
            </div>
            <p class="font-bold">{{ $post->likes->count() }} <span class="font-normal">Me gusta</span></p>
            @endguest
        </div>

        @auth
            @if($post->user_id === auth()->user()->id)
                <div>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Eliminar publicación" class="bg-red-500 hover:bg-red-600 p-2 text-sm rounded text-white mt-4 cursor-pointer">
                    </form>
                </div>
            @endif
        @endauth

        <div class="mt-5">
            <p class="text-xl font-bold text-center mb-4">Comentarios</p>
        </div>
        @if(session('mensaje'))
            <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                {{ session('mensaje') }}
            </div>
        @endif
        @guest
            <p class="text-gray-600 uppercase text-sm text-center font-bold">Debes iniciar sesión para poder comentar.</p>
        @endguest
        @auth
            <form action="{{ route('comentarios.store', ['post'=>$post, 'user'=>$user]) }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">Escribe un comentario</label>
                    <textarea name="comentario" id="comentario" placeholder="Descripción de la publicación" class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror"></textarea>
                    @error('comentario')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <input type="submit" value="Comentar" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        @endauth
        <div class="shadow rounded-md my-5 max-h-96 overflow-y-scroll">
            @if($comentarios->count())
                @foreach($comentarios as $comentario)
                    <div class="p-5 border-gray-300 border-b">
                        <a href="{{ route('posts.index', ['user'=> $comentario->user]) }}" class="font-bold">{{ $comentario->user->username }}</a>
                        <p>{{ $comentario->comentario }}</p>
                        <p class="text-sm text-gray-500">{{ $comentario->created_at->DiffForHumans() }}</p>
                    </div>
                @endforeach
            @else
                <p class="p-10 text-center text-gray-700">No hay comentarios aún.</p>
            @endif
        </div>
    </div>
</div>
@endsection
