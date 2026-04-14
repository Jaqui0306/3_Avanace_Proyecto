<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emocion extends Model
{
    use HasFactory;

    protected $table = 'emociones';
    protected $primaryKey = 'id';

    protected $fillable = [
        'usuario_id',
        'emocion',
        'nota',
        'fecha',
    ];

    // Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}