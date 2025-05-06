<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LineaPedido;
use App\Models\Articulo;




class LineaPedidoController extends Controller
{
    //
    public function getAll(){
        $lineas= LineaPedido::all();
    }

    public function guardar(Request $request){

        $articulos= $request->input('articulos', []);

        foreach($articulos as $articulo){
            if($articulo['cantidad'] <= 0){
                LineaPedido::create([
                    'cantidad' => 0,
                    'precio_unitario' => 0,
                    'importe' => 0,
                    'idPedido' => $articulo['idPedido'],
                    'idArticulo' => $articulo['idArticulo'],
                ]);
                $articuloActualizado=Articulo::find($articulo['idArticulo']);
                if($articuloActualizado){
                    $articuloActualizado->stock += $articulo['cantidad'];
                    $articuloActualizado->save();
                }
            }else{
                LineaPedido::create([
                    'cantidad' => $articulo['cantidad'],
                    'precio_unitario' => $articulo['precio_unitario'],
                    'importe' => $articulo['importe'],
                    'idPedido' => $articulo['idPedido'],
                    'idArticulo' => $articulo['idArticulo'],
                ]);
                $articuloActualizado=Articulo::find($articulo['idArticulo']);
                if($articuloActualizado){
                    $articuloActualizado->stock += $articulo['cantidad'];
                    $articuloActualizado->save();
                }
            }
            $idPedido = $articulo['idPedido'];
        }
        return redirect()->route('generarFactura', ['idPedido' => $idPedido]);
    }
}
