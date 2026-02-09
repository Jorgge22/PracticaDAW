<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciclista extends Model
{
    use HasFactory;

    protected $table = 'ciclista';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'peso_base',
        'altura_base',
        'email',
        'password'
    ];

    protected $dates = [
        'fecha_nacimiento',
    ];

    // Relaciones
    public function planes()
    {
        return $this->hasMany(PlanEntrenamiento::class, 'id_ciclista');
    }

    public function historico()
    {
        return $this->hasMany(HistoricoCiclista::class, 'id_ciclista');
    }

    public function entrenamientos()
    {
        return $this->hasMany(Entrenamiento::class, 'id_ciclista');
    }
}