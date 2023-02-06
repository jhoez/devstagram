<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Publicacion;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Publicacion $publicacion)
    {
        $like = new Like;
        $like->user_id = $request->user()->id;
        $like->publicacion_id = $publicacion->id;

        if ( $like->save() ) {
            return back();
        }else {
            return back()->with('errorlike','Ocurrio un error no se pudo dar like!!');
        }
    }

    public function destroy(Request $request, Publicacion $publicacion)
    {
        $request->user()->likes()->where('publicacion_id',$publicacion->id)->delete();
        return back();
    }
}
