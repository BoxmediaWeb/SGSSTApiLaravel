<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Perfil;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Maestro BoxMedia",
            'role_id' => 1,
            'email' => 'maestro.box@gmail.com',
            'password' => bcrypt('1234567'),
            'avatar' => 'user-default.jpg',
            'nickname' => 'maestro.box',
        ]);

        Perfil::create([
            'nombres' => "Maestro",
            'apellidos' => "BoxMedia",
            'fecha' => "2022-04-04",
            'cargo' => "Administrador sistema",
            'empresa' => "BoxMedia S.A.S",
            'telefono' => "3118976896",
            'usuario_id' => 1
        ]);
    }
}
