<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    public function descargarDocumentoMaestro(Request $request){

        $estandar = $request->estandar;
        $nombre_archivo = $request->nombre_archivo;
        return response()->download(public_path()."/detalle_documento/documentos/".$estandar."/".$nombre_archivo,'documento');
    }
}
