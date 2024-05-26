<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ParametroDetalle;

class Materiale extends Model
{
    use HasFactory;
    
    protected $table = 'materiales';

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'unidad_id',
        'precio',
        'proyecto'
    ];
    
    public function nombreUnidad()
    {
        return $this->hasOne(ParametroDetalle::class, 'value', 'unidad_id')->where('parametro_id', 1);
    }
}
