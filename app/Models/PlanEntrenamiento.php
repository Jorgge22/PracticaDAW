<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanEntrenamiento extends Model
{
    use HasFactory;

    protected $table = 'plan_entrenamiento';
    public $timestamps = false;

    protected $fillable = [
        'id_ciclista',
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'objetivo',
        'activo'
    ];

    protected $dates = [
        'fecha_inicio',
        'fecha_fin',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    // Relaciones
    public function ciclista()
    {
        return $this->belongsTo(Ciclista::class, 'id_ciclista');
    }

    public function sesiones()
    {
        return $this->hasMany(SesionEntrenamiento::class, 'id_plan');
    }
}
