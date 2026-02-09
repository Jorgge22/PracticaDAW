<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesionEntrenamiento extends Model
{
    use HasFactory;

    protected $table = 'sesion_entrenamiento';
    public $timestamps = false;

    protected $fillable = [
        'id_plan',
        'fecha',
        'nombre',
        'descripcion',
        'completada'
    ];

    protected $dates = [
        'fecha',
    ];

    protected $casts = [
        'completada' => 'boolean',
    ];

    // Relaciones
    public function plan()
    {
        return $this->belongsTo(PlanEntrenamiento::class, 'id_plan');
    }

    public function bloques()
    {
        return $this->belongsToMany(
            BloqueEntrenamiento::class,
            'sesion_bloque',
            'id_sesion_entrenamiento',
            'id_bloque_entrenamiento'
        )->withPivot('orden', 'repeticiones');
    }

    public function sesionesBloque()
    {
        return $this->hasMany(SesionBloque::class, 'id_sesion_entrenamiento');
    }

    public function entrenamientos()
    {
        return $this->hasMany(Entrenamiento::class, 'id_sesion');
    }
}
