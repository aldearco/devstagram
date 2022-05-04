<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'email' => 'emilio',
        ];
    }
    //
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request){
        // dd($request);
        // dd($request->get('username'));
        $atributos = [
            'name' => 'nombre',
            'username' => 'nombre de usuario',
            'email' => 'correo electrónico',
            'password' => 'contraseña',
        ];

        // Modificar el request
        $request->request->add(['username'=> Str::slug($request->username)]);

        // Validación
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|unique:users,username|min:3|max:20|regex:/\w*$/',
            'email' => 'required|unique:users,email|email|max:60',
            'password' => 'required|confirmed|min:6'
        ], [], $atributos);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Autenticar al usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ]);

        // Otra forma de autenticar
        auth()->attempt($request->only('email', 'password'));

        // Redireccionar al usuario
        return redirect()->route('post.index');

    }
}
