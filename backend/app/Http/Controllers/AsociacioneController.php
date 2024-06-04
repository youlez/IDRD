<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asociacione;
use App\Http\Controllers\ProyectoController;
use Dompdf\Dompdf;

class AsociacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        Asociacione::create($request->all());
        return response()->json(['message' => 'Asociacion creado exitosamente'], 200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Asociacione::find($id)->delete();
        return response()->json(['message' => 'Asociacion eliminado exitosamente'],  200);
    }

    public function getAsociacionesByProyecto($proyecto_id)
    {
        $asociacion = Asociacione::with('materiales','materiales.nombreUnidad:nombre,value')
            ->where('proyecto_id', $proyecto_id)->get();        
        return response()->json($asociacion, 200);
    }

    public function pdfMateriales($proyecto_id)
    {
        $materiales = $this->getAsociacionesByProyecto($proyecto_id);
        $proyectoController = new ProyectoController();
        $proyecto = $proyectoController->show($proyecto_id);

        $datos = [
            'proyecto' => $proyecto,
            'materiales' => json_decode(json_encode($materiales->original))
        ];

        $view = view('pdf_materiales', $datos)->render();
        $pdf = new Dompdf();
        $pdf->loadHtml($view );
        
        // (Optional) Setup the paper size and orientation
        $pdf->setPaper('A4', 'portrait');
        
        // Render the HTML as PDF
        $pdf->render();
        
        // Output the generated PDF to Browser
        $pdf->stream('Reporte de Materiales.pdf');
    }

}
