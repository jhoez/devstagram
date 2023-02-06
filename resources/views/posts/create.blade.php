@extends('layouts.main')

@section('titulopagina')
    Crear Publicación
@endsection

@section('titulo')
    Crear Publicación
@endsection

<!-- carga estos estilos solo cuando se cargue esta vista
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush
-->

@section('contenido')
    <div class="md:flex md:justify-center">
        <!--<div class="md:w-1/2 px-10">
            <form action="{{ url('/login') }}" method="POST" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center" enctype="multipart/form-data">
                @csrf
            </form>
        </div>-->

        <div class="md:w-1/2 p-5 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST"  enctype="multipart/form-data">
                @csrf

                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">Titulo</label>
                    <input id="titulo" class="border p-2 w-full rounded-lg @error('titulo') border-red-500 @enderror" name="titulo" type="text" placeholder="Tu Titulo" value="{{ old('titulo') }}"/>
                    @error('titulo')
                        <p class="bg-red-500 text-black my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="mb-2 block uppercase text-gray-500 font-bold" for="image">Sube tus Imagenes</label>
                    <input class="border p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border-gray-300 cursor-pointer" id="image" name="image" type="file" multiple>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG, JPEG</p>

                    @error('image')
                        <p class="bg-red-500 text-black my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">Descripcion</label>
                    <textarea id="descripcion" class="border p-2 w-full rounded-lg @error('descripcion') border-red-500 @enderror" name="descripcion" placeholder="Tu descripcion">{{old('descripcion')}}</textarea>
                    @error('descripcion')
                        <p class="bg-red-500 text-black my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <input class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" type="submit" value="Crear Publicación">
            </form>
        </div>
    </div>
@endsection
