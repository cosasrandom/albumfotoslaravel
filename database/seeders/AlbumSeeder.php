<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Album; 
use App\Models\User;

class AlbumSeeder extends Seeder
{

    public function run(): void
    {
        $user = User::first();
        if ($user) {
            Album::create([
                'nombre' => 'Viaje con mi perro Oddie',
                'descripcion' => 'Fotos con mi perro Oddie durante mis vacaciones.',
                'user_id' => $user->id,
            ]);

            Album::create([
                'nombre' => 'Amigos y Familia',
                'descripcion' => 'Momentos especiales con mis seres queridos.',
                'user_id' => $user->id,
            ]);

            Album::create([
                'nombre' => 'Eventos de Trabajo',
                'descripcion' => 'Imágenes de conferencias y reuniones.',
                'user_id' => $user->id,
            ]);
        } 
    }
}