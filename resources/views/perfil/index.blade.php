@extends('layouts.main')

@section('titulopagina')
    Perfil
@endsection

@section('titulo')
    Editar Perfil: {{ $user->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="{{route('perfil.store')}}" method="POST" class="mt-10 md:mt-10" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Tu nombre de Usuario</label>
                    <input id="username" class="border p-2 w-full rounded-lg @error('username') border-red-500 @enderror" name="username" type="text" placeholder="Tu nombre de usuario" value="{{ auth()->user()->username }}">
                    @error('username')
                        <p class="bg-red-500 text-black my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">Imagen de perfil</label>
                    <input id="imagen" class="border p-2 w-full rounded-lg" name="imagen" type="file" value="">
                </div>

                <input class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" type="submit" value="Guardar cambios">
            </form>
        </div>
    </div>
@endsection