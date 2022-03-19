<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MaestroDocumento;
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
        $json = File::get(public_path()."/data-maestros/maestros.json");
        $data = json_decode($json);

        foreach ($data as $key => $value) {
            MaestroDocumento::create([
                "codigo" => $value->codigo,
                "seccion" => $value->seccion,
                "empresa_id" => 1,
                "vigencia" => "2022",
                "estandar" => $value->estandar,
                "nombre" => $value->nombre,
                "nombre_corto" => $value->nombre_corto,
                "ubicacion" => $value->ubicacion,
                "tipo_documento" => $value->tipo_documento,
                "enlace_modelo" => $value->enlace_modelo,
                "sistema" => $value->sistema,
                "observaciones" => $value->observaciones,
                "estado" => $value->estado,
            ]);
        }
        
    }
}
