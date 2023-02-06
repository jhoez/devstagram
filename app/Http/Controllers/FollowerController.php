<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(Request $request, User $user)
    {
        /*
        $followers = new Follower;
        $followers->user_id = $user->id;
        //$followers->follower_id = $request->user()->id;// almacena el id del usuario autenticado
        $followers->follower_id = auth()->user()->id;// almacena el id del usuario autenticado
        if ($followers->save()) {
            return back();
        }
        */

        /**
         * attach se utiliza cuando existe una tabla pibote y se sale de las convenciones de laravel
         * donde se relaciona un usuario visitante con un usuario
        */
        $user->followers()->attach( auth()->user()->id );
        return back();
    }

    public function destroy(Request $request, User $user)
    {
        /*
        $followers = Follower::where(['user_id'=>$user->id,'follower_id'=>$request->user()->id]);
        
        if ( $followers->delete() ) {
            return back();
        }
        */

        $user->followers()->detach( auth()->user()->id );
        return back();
    }
}
