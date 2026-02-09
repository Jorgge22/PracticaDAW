<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentesBicicleta extends Model
{
    use HasFactory;

    protected $table = 'componentes_bicicleta';
    public $timestamps = false;

    protected $fillable = [
        'id_bicicleta',
        'id_tipo_componente',
        'marca',
        'modelo',
        'especificacion',
        'velocidad',
        'posicion',
        'fecha_montaje',
        'fecha_retiro',
        'km_actuales',
        'km_max_recomendado',
        'activo',
        'comentario'
    ];

    protected $dates = [
        'fecha_montaje',
        'fecha_retiro',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    // Relaciones
    public function bicicleta()
    {
        return $this->belongsTo(Bicicleta::class, 'id_bicicleta');
    }

    public function tipoComponente()
    {
        return $this->belongsTo(TipoComponente::class, 'id_tipo_componente');
    }
}
