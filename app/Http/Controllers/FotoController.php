<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Foto;
use App\Http\Controllers\Controller;
class FotoController extends Controller
{

     public function index(Request $request)
    {
        $album_id = $request->get('album_id');

        $album = Album::find($album_id);

        if (!$album || $album->user_id !== auth()->id()) {
            abort(404, 'Álbum no encontrado o no tienes permiso para verlo.');
        }
        $fotos = $album->fotos;

        return view('album.fotos', [
            'fotos' => $fotos,
            'album' => $album,
        ]);
    }
}