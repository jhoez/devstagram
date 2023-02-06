<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Publicacion;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke()
    {
        $user = new User;
        /**
         * OBTENER A QUIENES SEGUIMOS
         * pluck('id') permite obtener un campo en especifico
        */
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $publicacion = Publicacion::whereIn('user_id',$ids)->latest()->paginate(20);

        return view('home',[
            'publicacion'=>$publicacion
        ]);
    }
}
