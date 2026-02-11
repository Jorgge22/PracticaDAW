<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesionBloque extends Model
{
    use HasFactory;

    protected $table = 'sesion_bloque';
    public $timestamps = false;

    protected $fillable = [
        'id_sesion_entrenamiento',
        'id_bloque_entrenamiento',
        'orden',
        'repeticiones'
    ];

    // Relaciones
    public function sesion()
    {
        // Relación de pertenencia con el modelo SesionEntrenamiento
        return $this->belongsTo(SesionEntrenamiento::class, 'id_sesion_entrenamiento');
    }

    public function bloque()
    {
        // Relación de pertenencia con el modelo BloqueEntrenamiento
        return $this->belongsTo(BloqueEntrenamiento::class, 'id_bloque_entrenamiento');
    }
}
