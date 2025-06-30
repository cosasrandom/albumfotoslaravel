<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActualizarAlbumRequest;


use App\Http\Requests\CrearFotoRequest; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Album;
use App\Models\User;

class AlbumController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $albumes = $user->albums()->with('fotos')->get();

        return view('album.mostrar', compact('albumes'));
    }

    public function create()
    {
        return view('album.crear');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:1000',
        ]);
        $album = new Album();
        $album->user_id = Auth::id(); 
        $album->nombre = $request->nombre;
        $album->descripcion = $request->descripcion;
        $album->save();
        return redirect()->route('album.mostrar')->with('correcto', '¡Álbum creado correctamente!');
    }

    public function getActualizar(Album $album)
    {
        if ($album->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar este álbum.');
        }
        return view('album.actualizar', compact('album'));
    }

    public function postActualizar(ActualizarAlbumRequest $request, Album $album)
    {
        if ($album->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar este álbum.');
        }
        $album->nombre = $request->nombre;
        $album->descripcion = $request->descripcion;
        $album->save();

        return redirect()->route('album.mostrar')->with('correcto', '¡El álbum ha sido actualizado correctamente!');
    }
}
