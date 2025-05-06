<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FacturaVenta;
use App\Models\Venta;
use App\Models\Cliente;


class FacturaVentaController extends Controller
{
    //
    public function generarFactura(Request $request){
        $idVenta = $request->input('idVenta');
        //dd($idVenta);
        if (!$idVenta) {
            dd("Venta no encontrada", [
                'idVenta' => $idVenta,
                'consulta' => Venta::with('lineasVenta', 'cliente')->toSql(),
                'bindings' => Venta::getBindings(),
            ]);
            //dd($request->all());
        }
        $venta=Venta::with('lineasVenta', 'cliente')->find($idVenta);
        if (!$venta) {
            return response()->json(['error' => 'Venta no encontrada'], 404);
        }
        $lineas = $venta->lineasVenta->map(function($linea) {
            return [
                'articulo' => $linea->articulo->nombre,
                'cantidad' => $linea->cantidad,
                'precio_unitario' => $linea->precio_unitario,
                'importe' => $linea->importe,
            ];
        });
        $datosFactura=[
            'idVenta'=> $venta->id,
            'fecha'=> now(),
            'estadoPago'=> 'pendiente',
            'cliente'=> $venta->cliente->nombre,
            'apellido'=> $venta->cliente->apellido,
            'dni'=> $venta->cliente->dni,
            'telefono'=> $venta->cliente->telefono,
            'codPostal'=> $venta->cliente->codPostal,
            'lineas'=> $lineas,
            'subtotal'=> $lineas->sum('importe'),
            'total'=>$lineas->sum('importe')*1.21,
        ];
        return response()->json($datosFactura);
    }
    public function pagarFactura(Request $request){
        $datos= $request->validate([
            'fecha' => 'required|date',
            'estadoPago' => 'required|string|max:255',
            'idVenta' => 'required|integer',
        ]);
        FacturaVenta::create($datos);

        $ventaActualizada=Venta::find($datos['idVenta']);
        if($ventaActualizada){
            $ventaActualizada->estado ='recibido';
            $ventaActualizada->save();
        }
       
    }
}
