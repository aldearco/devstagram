<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){

        $atributos = [
            'email' => 'correo electrónico',
            'password' => 'contraseña'
        ];

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ], [], $atributos);

        if(!auth()->attempt($request->only('email', 'password'), $request->remember)){
            return back()->with('mensaje', 'Credenciales incorrectas');
        }

        return redirect()->route('posts.index', ['user'=> auth()->user()]);

    }
}
