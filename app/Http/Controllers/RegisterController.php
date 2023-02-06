<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // MODIFICAR EL REQUEST
        $request->request->add(['username'=>Str::slug($request->username)]);

        // VALIDACION
        $this->validate($request,[
            'name'=>'required|max:30',
            'username'=>'required|unique:users|min:3|max:20',
            'email'=>'required|unique:users|email|max:150',
            'password'=>'required|confirmed',
            //'password_confirmation'=>'required',
        ]);

        // 1. FORMA PARA REGISTRAR
        User::create([
            'name'      =>  $request->name,
            'username'  =>  Str::lower($request->username),
            'email'     =>  $request->email,
            'password'  =>  Hash::make($request->password),
        ]);

        // auntenticar usuario
        /*auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
        ]);*/
        // otra forma de autenticar
        auth()->attempt($request->only('email','password'));


        // REDIRECCIONAR
        return redirect()->route('posts.index',auth()->user()->username);
    }
}
