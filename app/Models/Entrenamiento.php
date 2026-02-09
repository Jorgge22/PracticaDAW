<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrenamiento extends Model
{
    use HasFactory;

    protected $table = 'entrenamiento';
    public $timestamps = false;

    protected $fillable = [
        'id_ciclista',
        'id_bicicleta',
        'id_sesion',
        'fecha',
        'duracion',
        'kilometros',
        'recorrido',
        'pulso_medio',
        'pulso_max',
        'potencia_media',
        'potencia_normalizada',
        'velocidad_media',
        'puntos_estres_tss',
        'factor_intensidad_if',
        'ascenso_metros',
        'comentario'
    ];

    protected $dates = [
        'fecha',
    ];

    // Relaciones
    public function ciclista()
    {
        return $this->belongsTo(Ciclista::class, 'id_ciclista');
    }

    public function bicicleta()
    {
        return $this->belongsTo(Bicicleta::class, 'id_bicicleta');
    }

    public function sesion()
    {
        return $this->belongsTo(SesionEntrenamiento::class, 'id_sesion');
    }
}