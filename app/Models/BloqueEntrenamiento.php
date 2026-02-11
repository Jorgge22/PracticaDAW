<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloqueEntrenamiento extends Model
{
    use HasFactory;

    protected $table = 'bloque_entrenamiento';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'tipo',
        'duracion_estimada',
        'potencia_pct_min',
        'potencia_pct_max',
        'pulso_pct_max',
        'pulso_reserva_pct',
        'comentario'
    ];

    // Relaciones foreign key
    public function sesiones()
    {
        return $this->belongsToMany(
            SesionEntrenamiento::class,
            'sesion_bloque',
            'id_bloque_entrenamiento',
            'id_sesion_entrenamiento'
        )->withPivot('orden', 'repeticiones');
    }

    public function sesionesBloque()
    {
        // Relación de uno a muchos con el modelo SesionBloque
        return $this->hasMany(SesionBloque::class, 'id_bloque_entrenamiento');
    }
}
