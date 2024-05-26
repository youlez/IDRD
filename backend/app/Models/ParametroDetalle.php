<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParametroDetalle extends Model
{
    use HasFactory;
    
    protected $table = 'parametro_detalles';

    protected $fillable = [
        'nombre',
        'parametro_id',
        'value'
    ];
}
