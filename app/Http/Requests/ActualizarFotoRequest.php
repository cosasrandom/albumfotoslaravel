<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Foto; // Necesario para verificar la propiedad de la foto y su álbum

class ActualizarFotoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Determina si el usuario está autorizado para hacer esta solicitud.
     *
     * @return bool
     */
    public function authorize()
    {
        // Obtener la foto a partir del Route Model Binding (si la ruta usa {foto})
        // o del input si se pasa de forma oculta (menos común para edición, pero cubrimos).
        $foto = $this->route('foto'); // Asume que la ruta es algo como /fotos/{foto}/editar

        // Si la foto no existe, no estamos autorizados.
        if (!$foto) {
            return false;
        }

        // Obtener el álbum al que pertenece esta foto
        // Asumiendo que el modelo Foto tiene una relación 'album'
        $album = $foto->album;

        // Asegurarse de que el usuario autenticado sea el propietario del álbum de la foto.
        // Esto previene que un usuario edite fotos que no le pertenecen.
        return Auth::check() && $album && $album->user_id === Auth::id();
    }

    /**
     * Get the validation rules that apply to the request.
     * Obtén las reglas de validación que se aplican a la solicitud.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',     // El nombre de la foto es obligatorio
            'descripcion' => 'nullable|string|max:1000', // La descripción es opcional
            'foto' => 'nullable|image|max:5120',      // La foto es opcional (si no se sube una nueva, se mantiene la anterior), debe ser una imagen, máximo 5MB
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     * Obtén los mensajes de error para las reglas de validación definidas.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre de la foto es obligatorio.',
            'nombre.string' => 'El nombre de la foto debe ser una cadena de texto.',
            'nombre.max' => 'El nombre de la foto no puede exceder los :max caracteres.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'descripcion.max' => 'La descripción no puede exceder los :max caracteres.',
            'foto.image' => 'El archivo debe ser una imagen (jpeg, png, bmp, gif, svg, o webp).',
            'foto.max' => 'La imagen no debe exceder los 5MB de tamaño.',
        ];
    }
}
