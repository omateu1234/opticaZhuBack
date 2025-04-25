<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;


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

        return view('pedido', compact('proveedor', 'articulos'));
    }

    public function getById($id){
        $pedido = Pedido::with('proveedores')->find($id);

        $proveedor = Proveedor::with('articulos')->find($id);


        return view('pedido', compact('proveedor', 'articulos'));
    }
}
