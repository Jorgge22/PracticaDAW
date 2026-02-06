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
        'fecha',
        'duracion',
        'kilometros',
        'recorrido',
        'comentario',
        'id_bicicleta',
        'id_sesion'
    ];

    protected $dates = [
        'fecha',
    ];
}