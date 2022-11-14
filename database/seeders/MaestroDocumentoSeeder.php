<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MaestroDocumento;
use App\Models\DetalleDocumento;
use File;

class MaestroDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ruta = public_path()."/data-maestros/";
        $archivos = ["maestros","hacer"];

        foreach($archivos as $key => $archivo){
            
            $json = File::get($ruta.$archivo.".json");
            $data = json_decode($json);

            foreach ($data as $key => $value) {
                $maestroDocumento=MaestroDocumento::create([
                    "codigo" => $value->codigo?$value->codigo:null,
                    "seccion" => $value->seccion?$value->seccion:null,
                    "empresa_id" => 1,
                    "vigencia" => "2022",
                    "estandar" => $value->estandar?$value->estandar:null,
                    "nombre" => $value->nombre?$value->nombre:null,
                    "nombre_corto" => $value->nombre_corto?$value->nombre_corto:null,
                    "ubicacion" => $value->ubicacion?$value->ubicacion:null,
                    "tipo_documento" => $value->tipo_documento?$value->tipo_documento:null,
                    "enlace_modelo" => $value->enlace_modelo?$value->enlace_modelo:null,
                    "sistema" => $value->sistema?$value->sistema:null,
                    "observaciones" => $value->observaciones?$value->observaciones:null,
                    "estado" => $value->estado?$value->estado:null,
                ]);

                if($value->tipo_documento=="Documento"){
                    DetalleDocumento::create([
                        "maestro_id" => $maestroDocumento? $maestroDocumento->id:null,
                        "version" => 1,
                        "estado" => 1,
                    ]);
                }
            }
        }

    }
}
