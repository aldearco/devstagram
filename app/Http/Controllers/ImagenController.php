<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagenController extends Controller
{
    public function store(Request $request){
        $imagen = $request->file('file');

        return response()->json(['imagen' => $imagen->extension() ]);
    }
}
