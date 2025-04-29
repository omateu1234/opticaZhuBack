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

    public function generarFactura(Request $request/* idPedido */){
        $idPedido = $request->query('idPedido');
        //dd($idPedido);

        if (!$idPedido) {
           // return redirect()->back()->with('error', 'Pedido no encontrado.');
            dd("fallo Entrando en generarFactura con ID: $idPedido");
        }


        $pedido=Pedido::with('lineasPedido', 'proveedor')->find($idPedido);


        $datosFactura=[
            'idPedido'=> $pedido->id,
            'fecha'=> now(),
            'estadoPago'=> 'pendiente',
            'proveedor'=> $pedido->proveedor->nombre,
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
        //dd($datosFactura);

        /* $factura=FacturaPedido::create([
            'fecha'=> $datosFactura['fecha'],
            'estadoPago'=> $datosFactura['estadoPago']
        ]); */
        return view('factura', compact('datosFactura'));
    }

    public function pagarFactura(Request $request){
        $datos= $request->validate([
            'fecha' => 'required|date',
            'estadoPago' => 'required|string|max:255',
            'idPedido' => 'required|integer',
        ]);
        FacturaPedido::create($datos);

        $pedidoActualizado=Pedido::find($datos['idPedido']);
        if($pedidoActualizado){
            $pedidoActualizado->estado ='recibido';
            $pedidoActualizado->save();
        }

        return redirect()->route('pedidos')->with('success', 'Factura guardada correctamente.');
    }
}
