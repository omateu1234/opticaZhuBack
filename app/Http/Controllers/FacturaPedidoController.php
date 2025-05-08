<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FacturaPedido;
use App\Models\Pedido;
use App\Models\Proveedor;


class FacturaPedidoController extends Controller
{
    //
    public function getAll(){
        $facturas=FacturaPedido::all();
    }

    public function generarFactura(Request $request){
        $idPedido = $request->input('idPedido');
        //dd($idPedido);

        if (!$idPedido) {
            /* dd("Pedido no encontrado", [
                'idPedido' => $idPedido,
                'consulta' => Pedido::with('lineasPedido', 'proveedor')->toSql(),
                'bindings' => Pedido::getBindings(),
            ]); */
            dd($request->all());
        }

        $pedido=Pedido::with('lineasPedido', 'proveedor')->find($idPedido);

        $datosFactura=[
            'idPedido'=> $pedido->id,
            'fecha'=> now(),
            'estadoPedido'=> $pedido->estado,
            'proveedor'=> $pedido->proveedor->nombre,
            'nif'=> $pedido->proveedor->nif,
            'direccion'=> $pedido->proveedor->direccion,
            'lineas'=> $pedido->lineasPedido->map(function($linea){
                return [
                    'articulo' => $linea->articulo->nombre,
                    'cantidad'=> $linea->cantidad,
                    'precio_unitario'=> $linea->precio_unitario,
                    'importe'=> $linea->importe,
                ];
            }),
            'subtotal'=> $pedido->lineasPedido->sum('importe'),
            'total'=>$pedido->lineasPedido->sum('importe')*1.21,
        ];
        return view('factura', compact('datosFactura'));
    }

    public function pagarFactura(Request $request){
        $datos= $request->validate([
            'fecha' => 'required|date',
            'estadoPago' => 'required|string|max:255',
            'idPedido' => 'required|integer',
        ]);
        FacturaPedido::create($datos);

       /*  $pedidoActualizado=Pedido::find($datos['idPedido']);
        if($pedidoActualizado){
            $pedidoActualizado->estado ='recibido';
            $pedidoActualizado->save();
        } */

        return redirect()->route('pedidos')->with('success', 'Factura guardada correctamente.');
    }
}
