<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ciclista extends Authenticatable
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