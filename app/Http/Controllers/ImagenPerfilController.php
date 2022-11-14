<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GraphQL\Error\Error;
use App\Models\User;

class ImagenPerfilController extends Controller
{
    public function subir(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $nombre = $request->nickname.'_'.$this->generateRandomString().'.jpg';
            $image->move(public_path().'/fotos_perfil', $nombre);

            $user = User::where('id',$request->usuario_id)->first();

            if($user){
                $user->avatar = $nombre;
                $user->save();
            }

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
