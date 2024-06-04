<!DOCTYPE html>
<html lang="es-co">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>REPORTE DE MATERIALES</title>
</head>
<style type="text/css">
    @page {
        margin-bottom: 75px;
    }
    * {
        font-family: Helvetica, Arial, sans-serif;
        font-size: 9pt;
    }
    h1{
        font-size: 12pt;
    }
    table{
        table-layout: fixed;
    }
    th, td {
        border: 1px solid #949494;
        overflow: hidden;
        padding: 5px;
    }
    th, td{
        padding: 2px 5px;        
    }
    .numero{
        text-align: right;
    }
    .titulo{        
        background-color: #c7c4c4;
        font-weight: bold;
    }
    .sin_borde{
        border: 0px;
        height: 5px;
    }
    footer {
        position: fixed;
        bottom: -50px;
        left: 0px;
        right: 0px;
        height: 50px;
    }
</style>

<body>
    <table style="width: 100%;" cellspacing=0>
        <colgroup>
            <col style="width:8.333%;">
            <col style="width:8.333%;">
            <col style="width:8.333%;">
            <col style="width:8.333%;">
            <col style="width:8.333%;">
            <col style="width:8.333%;">
            <col style="width:8.333%;">
            <col style="width:8.333%;">
            <col style="width:8.333%;">
            <col style="width:8.333%;">
            <col style="width:8.333%;">
            <col style="width:8.333%;">
        </colgroup>
        <thead>
            <tr>
                <th class="sin_borde" colspan="12">
                    <h1>REPORTE DE MATERIALES</h1>
                </th>
            </tr>
            <tr>
                <td colspan="3" class="titulo">Nombre del Proyecto:</td>
                <td colspan="9">{{$proyecto->nombre}}</td>
            </tr> 
            <tr>
                <td colspan="2" class="titulo">Departamento:</td>
                <td colspan="4">{{$proyecto->nombreDepartamento->nombre}}</td>
                <td colspan="2" class="titulo">Ciudad:</td>
                <td colspan="4">{{$proyecto->nombreCiudad->nombre}}</td>
            </tr>             
            <tr>
                <td class="sin_borde" colspan="12">
                </td>
            </tr>
            <tr>
                <th colspan="2" class="titulo">Código:</th>
                <th colspan="3" class="titulo">Nombre:</th>
                <th colspan="3" class="titulo">Descripcion:</th>
                <th colspan="2" class="titulo">Unidad:</th>
                <th colspan="2" class="titulo">Precio:</th>
            </tr> 
        </thead>     
        <tbody>    
            <?php $total = 0; ?>          
            @foreach( $materiales as $material)
                <tr>
                    <td colspan="2">{{$material->materiales->codigo}}</td>
                    <td colspan="3">{{$material->materiales->nombre}}</td>
                    <td colspan="3">{{$material->materiales->descripcion}}</td>
                    <td colspan="2">{{$material->materiales->nombre_unidad->nombre}}</td>
                    <td colspan="2" class="numero">$ {{number_format($material->materiales->precio, 0, ',', '.')}}</td>
                </tr>
                <?php $total += $material->materiales->precio; ?>
            @endforeach
            @if($total>0)                
                <tr>
                    <td colspan="10" class="titulo">Total</td>
                    <td colspan="2" class="titulo numero">$ {{number_format($total, 0, ',', '.')}}</td>
                </tr>
            @endif
        </tbody>
    </table>
</body>