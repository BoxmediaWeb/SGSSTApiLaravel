<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class subirImagenController extends Controller
{
    public function imagen(Request $request)
    {
        $image = $request->file('image');
        $image->move(public_path(), 'imagenprueba.png');

        /*if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'imagen_guardada_server.jpg';
            $image->move(public_path());
        }*/

        return $request;

        //return response()->json(['patient' => $patient])->header('Access-Control-Allow-Origin', '*');
    }
}
