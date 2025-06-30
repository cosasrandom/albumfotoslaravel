<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Foto;
use App\Http\Controllers\Controller;
use App\Http\Requests\CrearFotoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\ActualizarFotoRequest;

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


    public function create(Album $album)
    {

        if ($album->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para añadir fotos a este álbum.');
        }

        return view('album.fotos.crear', compact('album'));
    }


    public function store(CrearFotoRequest $request, Album $album)
    {
        $path = $request->file('foto')->store('fotos', 'public');

        $foto = new Foto();
        $foto->album_id = $album->id;
        $foto->nombre = $request->nombre;
        $foto->descripcion = $request->descripcion;
        $foto->foto_ruta = $path; 
        $foto->save();
        return redirect()->route('foto.index', ['album_id' => $album->id])->with('correcto', '¡Foto añadida correctamente!');
    }




    public function edit(Foto $foto)
    {
        if ($foto->album->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar esta foto.');
        }

        return view('album.fotos.editar', compact('foto'));
    }

    public function update(ActualizarFotoRequest $request, Foto $foto)
    {

        if ($foto->album->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para actualizar esta foto.');
        }

        $foto->nombre = $request->nombre;
        $foto->descripcion = $request->descripcion;

        if ($request->hasFile('foto')) {
            if (Storage::disk('public')->exists($foto->foto_ruta)) {
                Storage::disk('public')->delete($foto->foto_ruta);
            }
            $path = $request->file('foto')->store('fotos', 'public');
            $foto->foto_ruta = $path;
        }

        $foto->save();

        return redirect()->route('foto.index', ['album_id' => $foto->album_id])->with('correcto', '¡Foto actualizada correctamente!');
    }

    public function destroy(Foto $foto)
    {
        if ($foto->album->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para eliminar esta foto.');
        }
        if (Storage::disk('public')->exists($foto->foto_ruta)) {
            Storage::disk('public')->delete($foto->foto_ruta);
        }
        $foto->delete();
        return redirect()->route('foto.index', ['album_id' => $foto->album_id])->with('correcto', '¡Foto eliminada correctamente!');
    }
}
