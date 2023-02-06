@extends('layouts.main')

@section('titulopagina')
    Principal
@endsection

@section('titulo')
    Pagina principal
@endsection

@section('contenido')
    @if ($publicacion->count())
        <div class="grid md:grid-cols-2 ls:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($publicacion as $data)
                <div class="">
                    <a href="{{ route('posts.show', ['user'=>$data->user,'publicacion'=>$data]) }}">
                        <img src="{{asset('fotos').'/'.$data->image}}" alt="">
                    </a>
                </div>
            @endforeach
        </div>
        <div class="my-10">{{ $publicacion->links() }}</div>
    @else
        <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay Publicaciones, sigue a alguien para poder mostrar sus Publicaciones</p>
    @endif
@endsection