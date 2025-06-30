<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Album;

class CrearFotoRequest extends FormRequest
{

    public function authorize()
    {
        $albumId = $this->route('album_id') ?? $this->input('album_id');
        $album = Album::find($albumId);

        return Auth::check() && $album && $album->user_id === Auth::id();
    }
    public function rules()
    {
        return [
            'album_id' => 'required|exists:albums,id', // El ID del álbum es obligatorio y debe existir
            'nombre' => 'required|string|max:255',     // El nombre de la foto es obligatorio
            'descripcion' => 'nullable|string|max:1000', // La descripción es opcional
            'foto' => 'required|image|max:5120',      // La foto es obligatoria, debe ser una imagen, máximo 5MB
        ];
    }

    public function messages()
    {
        return [
            'album_id.required' => 'El ID del álbum es obligatorio.',
            'album_id.exists' => 'El álbum seleccionado no existe.',
            'nombre.required' => 'El nombre de la foto es obligatorio.',
            'nombre.string' => 'El nombre de la foto debe ser una cadena de texto.',
            'nombre.max' => 'El nombre de la foto no puede exceder los :max caracteres.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'descripcion.max' => 'La descripción no puede exceder los :max caracteres.',
            'foto.required' => 'Debes seleccionar una imagen para subir.',
            'foto.image' => 'El archivo debe ser una imagen (jpeg, png, bmp, gif, svg, o webp).',
            'foto.max' => 'La imagen no debe exceder los 5MB de tamaño.',
        ];
    }
}
