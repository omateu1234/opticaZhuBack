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

    /* public function guardar(Request $request){

        $articulos= $request->input('articulos', []);
        //
        if (empty($articulos)) {
            //dd($articulos);
            dd($request->all());
            return response()->json(['message' => 'No se enviaron articulos'], 400);
        }
        foreach($articulos as $articulo){
            try {
                // Verificar que la venta y el artículo existan
                $venta = Venta::find($articulo['idVenta']);
                $articuloModel = Articulo::find($articulo['idArticulo']);

                if (!$venta || !$articuloModel) {
                    return response()->json(['message' => 'Venta o artículo no encontrado'], 404)
                    ->header('Access-Control-Allow-Origin', '*')
                    ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                    ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
                }
                // Crear la línea de venta
                LineaVenta::create([
                    'cantidad' => $articulo['cantidad'],
                    'precio_unitario' => $articulo['precio_unitario'],
                    'importe' => $articulo['importe'],
                    'idVenta' => $articulo['idVenta'],
                    'idArticulo' => $articulo['idArticulo'],
                ]);
                 // Verificar si la línea de venta se creó correctamente
            if (!$lineaVenta) {
                return response()->json(['message' => 'Error al crear la línea de venta'], 500)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
            }
                // Actualizar el stock del artículo
                $articuloModel->stock -= $articulo['cantidad'];
                $articuloModel->save();
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
            }
        }
        return response()->json(['message' => 'Líneas de venta creadas correctamente'])
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
    } */

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
