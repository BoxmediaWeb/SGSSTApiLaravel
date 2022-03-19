<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

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
            'name' => "Andrés Salas",
            'email' => 'andres@gmail.com',
            'password' => bcrypt('1234567'),
            'avatar' => 'andres.jpg'
        ]);
    }
}
