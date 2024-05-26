<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Parametro;

class ParametroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datos = array(
            array(
                "id" => 1,
                "nombre" => "UNIDAD",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ),
            array(
                "id" => 2,
                "nombre" => "DEPARTAMENTOS",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ),
        );
        $parametros = new Parametro();
        $parametros->insert($datos);
    }
}
