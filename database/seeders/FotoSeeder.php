<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Album;
use App\Models\Foto;
use Illuminate\Support\Facades\Storage; 

class FotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $albums = Album::all();
        $rutas_ejemplo = [
            'photos/imagen1.jpg',
            'photos/imagen2.Jpg',
            'photos/imagen3.jpg',
        ];

        if (!Storage::disk('public')->exists('photos')) {
            Storage::disk('public')->makeDirectory('photos');
        }
        foreach ($albums as $album) {
            for ($i = 0; $i < 3; $i++) {
                $selected_ruta = $rutas_ejemplo[($album->id + $i) % count($rutas_ejemplo)];
                Foto::create([
                    'nombre' => 'Foto ' . ($i + 1) . ' del álbum ' . $album->nombre,
                    'descripcion' => 'Una foto sembrada para el álbum ' . $album->nombre . '.',
                    'foto_ruta' => $selected_ruta, 
                    'album_id' => $album->id,
                ]);
            }
        }
    }
}