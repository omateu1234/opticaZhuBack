<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\FacturaPedido;


class PedidoController extends Controller
{
    public function getAll(){
        $pedidos = Pedido::all();
        return view('pedidos', compact('pedidos'));
    }

    public function guardar(Request $request){

        $datos= $request->validate([
            'fecha' => 'required|date',
            'metodoPago' => 'required|string|max:255',
            'idProveedor' => 'required|integer',
        ]);
        Pedido::create($datos);

        return redirect()->route('pedidos')->with('success', 'Pedido guardado correctamente.');
    }

    public function getById($id){
        $pedido = Pedido::with('proveedores')->find($id);

        $proveedor = Proveedor::with('articulos')->find($id);


        return view('pedido', compact('proveedor', 'articulos' ));
    }

    public function getProveedor($id){
        $pedido = Pedido::find($id);

        $proveedor= $pedido->proveedor;

        $articulos = $proveedor->articulos;

        return view('pedido', compact('proveedor', 'articulos', 'pedido' ));
    }
}
