<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FraseFavorita extends Model
{
    use HasFactory;

    protected $table = 'frases_favoritas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'usuario_id',
        'frase',
        'fecha_guardada',
    ];

    // Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}