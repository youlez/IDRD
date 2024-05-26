<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Materiale;

class Asociacione extends Model
{
    use HasFactory;

    protected $table = 'asociaciones';

    protected $fillable = [
        'proyecto_id',
        'material_id',
    ];
    
    public function materiales()
    {
        return $this->hasOne(Materiale::class, 'id', 'material_id');
    }
}
