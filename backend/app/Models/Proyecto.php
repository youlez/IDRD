<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ParametroDetalle;
use App\Models\Ciudade;

class Proyecto extends Model
{
    use HasFactory;
    
    protected $table = 'proyectos';

    protected $fillable = [
        'nombre',
        'departamento_id',
        'ciudad_id'
    ];
    
    public function nombreDepartamento()
    {
        return $this->hasOne(ParametroDetalle::class, 'value', 'departamento_id')->where('parametro_id', 2);
    }
    
    public function nombreCiudad()
    {
        return $this->hasOne(Ciudade::class, 'id', 'ciudad_id');
    }
}
