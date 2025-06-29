<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'jose',
        //     'email' => 'jose@gmail.com',
        //     'password' => bcrypt('12121212'), // Asegúrate de usar bcrypt para el password
        // ]);
        $this->call(AlbumSeeder::class); 
        $this->call(FotoSeeder::class); // <-- ¡Añade esta línea!
    }
}
