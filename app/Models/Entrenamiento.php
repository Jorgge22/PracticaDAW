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

    // Relaciones foreign key
    public function ciclista()
    {
        // Relación de pertenencia con el modelo Ciclista
        return $this->belongsTo(Ciclista::class, 'id_ciclista');
    }

    public function bicicleta()
    {
        // Relación de pertenencia con el modelo Bicicleta
        return $this->belongsTo(Bicicleta::class, 'id_bicicleta');
    }

    public function sesion()
    {
        // Relación de pertenencia con el modelo SesionEntrenamiento
        return $this->belongsTo(SesionEntrenamiento::class, 'id_sesion');
    }
}