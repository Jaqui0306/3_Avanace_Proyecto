<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'apellido',
        'correo',
        'contrasena',
    ];

    protected $hidden = [
        'contrasena',
    ];

    // Relaciones
    public function emociones()
    {
        return $this->hasMany(Emocion::class, 'usuario_id');
    }

    public function frasesFavoritas()
    {
        return $this->hasMany(FraseFavorita::class, 'usuario_id');
    }
}