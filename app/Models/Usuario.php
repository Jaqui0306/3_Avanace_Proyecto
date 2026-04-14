<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';           // Nombre de la tabla en la BD
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'apellido',
        'correo',
        'contrasena',
    ];

    // Relaciones
    public function emociones()
    {
        return $this->hasMany(Emocion::class, 'usuario_id');
    }

    public function frasesFavoritas()
    {
        return $this->hasMany(FraseFavorita::class, 'id_usuario');
    }
}