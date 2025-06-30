<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ActualizarAlbumRequest extends FormRequest
{
    public function authorize()
    {
        $albumId = $this->route('album')->id ?? $this->input('id'); 
        return Auth::check() && Auth::user()->albums->contains($albumId);
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255', 
            'descripcion' => 'nullable|string|max:1000', 
            'id' => 'required|exists:albums,id', 
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'El ID del álbum es obligatorio para la actualización.',
            'id.exists' => 'El álbum especificado no existe.',
            'nombre.required' => 'El nombre del álbum es obligatorio.',
            'nombre.string' => 'El nombre del álbum debe ser una cadena de texto.',
            'nombre.max' => 'El nombre del álbum no puede exceder los :max caracteres.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'descripcion.max' => 'La descripción no puede exceder los :max caracteres.',
        ];
    }
}
