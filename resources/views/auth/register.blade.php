@extends('layouts.main')

@section('titulopagina')
    Registro de Usuario
@endsection

@section('titulo')
    Registro de usuario
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 shadow-xl p-5">
            <img src="{{ asset('img/registrar.jpg') }}" alt="">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ url('/registrarusuario') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                    <input id="name" class="border p-2  w-full rounded-lg @error('name') border-red-500 @enderror" name="name" type="text" placeholder="Tu nombre" value="{{ old('name') }}">
                    @error('name')
                        <p class="bg-red-500 text-black my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">User Name</label>
                    <input id="username" class="border p-2 w-full rounded-lg @error('username') border-red-500 @enderror" name="username" type="text" placeholder="Tu nombre de usuario" value="{{ old('username') }}">
                    @error('username')
                        <p class="bg-red-500 text-black my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input id="email" class="border p-2 w-full rounded-lg @error('email') border-red-500 @enderror" name="email" type="email" placeholder="Tu Email de registro" value="{{ old('email') }}">
                    @error('email')
                        <p class="bg-red-500 text-black my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Contraseña</label>
                    <input id="password" class="border p-2 w-full rounded-lg @error('password') border-red-500 @enderror" name="password" type="password" placeholder="Tu contraseña">
                    @error('password')
                        <p class="bg-red-500 text-black my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Repetir Contraseña</label>
                    <input id="password_confirmation" class="border p-2 w-full rounded-lg @error('password_confirmation') border-red-500 @enderror" name="password_confirmation" type="password" placeholder="Repeti tu contraseña">
                    @error('password_confirmation')
                        <p class="bg-red-500 text-black my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <input class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" type="submit" value="Crear cuenta">
            </form>
        </div>
    </div>
@endsection