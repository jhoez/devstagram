@extends('layouts.main')

@section('titulopagina')
    Detalles
@endsection

@section('titulo')
    {{$publicacion->titulo}}
@endsection

@section('contenido')
    @if (session('errorlike'))
        <div class="bg-red-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
            {{session('errorlike')}}
        </div>
    @endif

    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{asset('fotos').'/'.$publicacion->image}}" alt="" class="">

            <div class="p-3 flex items-center">
                @auth
                    @if ( $publicacion->checkLike( auth()->user() ) )
                        <form method="POST" action="{{ route('posts.likes.destroy',$publicacion) }}">
                            @method('DELETE')
                            @csrf
                            <div class="my-4">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="red" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    @else
                        <form method="POST" action="{{ route('posts.likes.store',$publicacion) }}">
                            @csrf
                            <div class="my-4">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    @endif
                @endauth
                <p class="font-bold">
                    {{ $publicacion->likes->count() }}
                    <span class="font-normal">Likeds</span>
                </p>
            </div>

            <div>
                <p class="font-bold">{{$publicacion->user->username}}</p>
                <p class="text-sm text-gray-500">
                    {{$publicacion->created_at->diffForHumans()}}
                </p>
                <p class="mt-5">
                    {{$publicacion->descripcion}}
                </p>
            </div>

            @auth
                @if ($publicacion->user_id === auth()->user()->id)
                    <!-- aviso de no eliminacion de la publicación -->
                    @if (session('msjd'))
                        <div class="bg-red-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{session('msjd')}}
                        </div>
                    @endif

                    <form action="{{route('posts.destroy',$publicacion)}}" method="POST">
                        @method('DELETE')<!-- metodo spoofing - agrega al navegador el metodo DELETE -->
                        @csrf
                        <input type="submit" class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursos-pointer" value="Eliminar Publicación">
                    </form>
                @endif
            @endauth
        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                    <p class="text-xl font-bold text-center mb-4">Agregar un nuevo comentario</p>

                    @if (session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{session('mensaje')}}
                        </div>
                    @endif

                    <form action="{{route('comentarios.store',['user'=>$user,'publicacion'=>$publicacion])}}" method="post">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">Añade un comentario</label>
                            <textarea id="comentario" class="border p-2 w-full rounded-lg @error('comentario') border-red-500 @enderror" name="comentario" placeholder="Agrega un comentario"></textarea>
                            @error('comentario')
                                <p class="bg-red-500 text-black my-2 rounded-lg text-sm p-2 text-center">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <input class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" type="submit" value="Comentar">
                    </form>
                @endauth

                <div class="bg-white shadow mb-5 mt-5 max-h-96 overflow-y-scroll">
                    @if ($publicacion->comentarios->count())
                        @foreach ($publicacion->comentarios as $data)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('posts.index', $data->user) }}" class="font-bold">{{$data->user->username}}</a>
                                <p>{{$data->comentario}}</p>
                                <p class="text-sm text-gray-500">{{$data->created_at->diffForHumans()}}</p>
                            </div>    
                        @endforeach
                    @else
                        <p class="p-10 text-center">No hay comentarios aún!!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection