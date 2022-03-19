<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GraphQL\Error\Error;

class subirImagenController extends Controller
{
    public function imagen(Request $request)
    {
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $nombre = $request->prefijo.'_'.$this->generateRandomString().'.'.$image->getClientOriginalExtension();
            $image->move(public_path().'/detalle_documento', $nombre);

            return response()->json(['nombre' => $nombre])->header('Access-Control-Allow-Origin', '*');
        }else{
            return new Error('Archivo no seleccionado');
        }
    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
