<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'nombre' => "Administrador",
            'descripcion' => 'Usuario principal que tiene acceso a todos los permisos y acceso a todas las vistas.'
        ]);
    }
}
