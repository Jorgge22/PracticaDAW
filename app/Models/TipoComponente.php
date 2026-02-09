<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoComponente extends Model
{
    use HasFactory;

    protected $table = 'tipo_componente';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    // Relaciones
    public function componentes()
    {
        return $this->hasMany(ComponentesBicicleta::class, 'id_tipo_componente');
    }
}
