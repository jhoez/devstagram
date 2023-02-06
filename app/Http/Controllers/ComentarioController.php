<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Publicacion;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request, User $user, Publicacion $publicacion)
    {
        $this->validate($request,[
            'comentario'=>'required|max:255',
        ]);

        //almacenar
        $comentario = new Comentario;
        $comentario->user_id = auth()->user()->id;
        $comentario->publicacion_id = $publicacion->id;
        $comentario->comentario = $request->comentario;
        $comentario->created_at = date('Y-m-d H:i:s',time());
        
        if ( $comentario->save() ) {
            return back()->with('mensaje','Comentario realizado exitosamente!!');
            //return redirect()->route('posts.show', ['user'=>$user,'publicacion'=>$publicacion])->with('mensaje','Comentario realizado exitosamente!!');
        }
    }
}
