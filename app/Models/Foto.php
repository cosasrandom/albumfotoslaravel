<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $fillable = [
        'album_id',
        'nombre',
        'descripcion',
        'foto_ruta',
    ];
    public function getRutaAttribute()
    {
        return $this->attributes['foto_ruta'];
    }
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
