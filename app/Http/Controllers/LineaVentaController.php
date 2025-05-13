<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LineaVenta;
use App\Models\Articulo;
use App\Models\Venta;




class LineaVentaController extends Controller
{
    //
    public function getAll(){
        $lineas= Lineaventa::all();
        return response()->json($lineas);
    }

    public function guardar(Request $request){

        $articulos= $request->input('articulos', []);

        foreach($articulos as $articulo){
            LineaVenta::create([
                'cantidad' => $articulo['cantidad'],
                'precio_unitario' => $articulo['precio_unitario'],
                'importe' => $articulo['importe'],
                'idVenta' => $articulo['idVenta'],
                'idArticulo' => $articulo['idArticulo'],
            ]);
            $articuloActualizado=Articulo::find($articulo['idArticulo']);
            if($articuloActualizado){
                $articuloActualizado->stock -= $articulo['cantidad'];
                $articuloActualizado->save();
            }
        }
    }
}
