<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Imagen;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        return view('perfil.index',[
            'user'=>$user
        ]);
    }

    public function store(Request $request)
    {
        // MODIFICAR EL REQUEST
        $request->request->add(['username'=>Str::slug($request->username)]);

        $this->validate(
            $request,
            [
                'username'=>['required','unique:users,username,'.auth()->user()->id,'min:3','max:20'],
            ],
            [
                'username.required'=>'El nombre de usuario es requerido',
                'username.unique'=>'Éste nombre de usuario ya ha sido utilizado',
            ]
        );

        //$imgform = $request->imagen;
        $imgform = $request->file('imagen');
        
        if ( $imgform ) {
            /**
             * subir imagen con
             * Intervention\Image\Facades\Image
            */            
            $nombreImagen = Str::uuid() . "." . $imgform->extension();
            $imagenServidor = Image::make($imgform);
            $imagenServidor->fit(1000,1000);

            // ruta de imagen
            $imagenPath = public_path('perfiles').'/'.$nombreImagen;
            
            $imagenServidor->save($imagenPath);
        }

        
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username ?? auth()->user()->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        if ( $usuario->save() ) {
            return redirect()->route('posts.index',$usuario->username)->with('mensaje','Se ha modificado la foto de perfil!!');
        }        
    }
}
