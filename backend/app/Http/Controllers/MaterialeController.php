<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materiale;

class MaterialeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materiales = Materiale::with('nombreUnidad:nombre,value')->get();
        return response()->json($materiales, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Materiale::create($request->all());
        return response()->json(['message' => 'Material creado exitosamente'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Materiale::find($id)->update($request->all());
        return response()->json(['message' => 'Material actualizado exitosamente'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Materiale::find($id)->delete();
        return response()->json(['message' => 'Material eliminado exitosamente'],  200);
    }

    public function getMaterialesByProyecto($proyecto_id)
    {
        $materiales = Materiale::where('proyecto_id', $proyecto_id)->get();        
        return response()->json($materiales, 200);
    }

    public function getSelectMaterial()
    {
        $materiales = Materiale::select('codigo','id')
            ->whereRaw('proyecto_id IS NULL')
            ->get();
        return response()->json($materiales, 200);
    }

    public function toogleProyecto(Request $request)
    {        
        $form = $request->form;
        $update = [
            'proyecto_id' => $form['proyecto_id']
        ];        
        Materiale::where('id', $form['material_id'])->update($update);
        //return ($form);
        //return response()->json(['message' => 'Material actualizado exitosamente'], 200);
    }
}
