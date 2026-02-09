<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bicicleta extends Model
{
    use HasFactory;

    protected $table = 'bicicleta';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'tipo',
        'comentario'
    ];

    // Relaciones
    public function componentes()
    {
        return $this->hasMany(ComponentesBicicleta::class, 'id_bicicleta');
    }

    public function entrenamientos()
    {
        return $this->hasMany(Entrenamiento::class, 'id_bicicleta');
    }
}
