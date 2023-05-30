<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\userdata;

class PruebasUsers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
            // random de 10 digitos
            {
                $cedula = rand(1000000000, 9999999999);
                $email = $cedula . '@example.com';
                userdata::create([
                    'cedula' => $cedula,
                    'name' => 'John Doe',
                    'email' => $email,
                    'celular' => '1234567890',
                    'fecha_nacimiento' => '1990-01-01',
                    'user_type' => 'user',
                    'direccion' => 'Calle Principal 123',
                    'updated_at' => now(),
                    'created_at' => now(),
                ]);
        
                // Crea más registros si es necesario
            }
}