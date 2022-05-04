<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request){
        $imagen = $request->file('file');

        $nombreImagen = Str::uuid().'.'.$imagen->extension();
        
        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(1080, 1080);

        $fecha = Carbon::now();
        $imagenPath = public_path('uploads').'/'.$nombreImagen;

        $imagenServidor->save($imagenPath);


        return response()->json(['imagen' => $nombreImagen ]);
    }
}
