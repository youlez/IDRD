<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ParametroDetalle;
use App\Models\Asociacione;

class Materiale extends Model
{
    use HasFactory;
    
    protected $table = 'materiales';

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'unidad_id',
        'precio'
    ];

    protected $appends = ['codigo_nombre'];

    public function getCodigoNombreAttribute()
    {
        return $this->attributes['codigo'] . " - " . $this->attributes['nombre'];
    }
    
    public function nombreUnidad()
    {
        return $this->hasOne(ParametroDetalle::class, 'value', 'unidad_id')->where('parametro_id', 1);
    }
    
    public function asociaciones()
    {
        return $this->hasMany(Asociacione::class, 'material_id', 'id');
    }
}
