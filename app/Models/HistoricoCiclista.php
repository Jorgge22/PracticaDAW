<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoCiclista extends Model
{
    use HasFactory;

    protected $table = 'historico_ciclista';
    public $timestamps = false;

    protected $fillable = [
        'id_ciclista',
        'fecha',
        'peso',
        'ftp',
        'pulso_max',
        'pulso_reposo',
        'potencia_max',
        'grasa_corporal',
        'vo2max',
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
}
