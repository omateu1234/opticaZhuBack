<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\FacturaPedido;
use Carbon\Carbon;


class PedidoController extends Controller
{
    public function getAll(){
        $pedidos = Pedido::with('proveedor', 'facturaPedido')->get();
        return view('pedidos', compact('pedidos'));
    }

    public function guardar(Request $request){

        $datos= $request->validate([
            'metodoPago' => 'required|string|max:255',
            'idProveedor' => 'required|integer',
        ]);
        $datos['fecha']= Carbon::now();
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

    public function cancelarPedido($idPedido){
        $pedido = Pedido::find($idPedido);
        //dd($pedido);
        if($pedido){
            $pedido->estado ='cancelado';
            $pedido->save();
            //dd($pedido);
        }
        return redirect()->route('pedidos')->with('success', 'Pedido cancelado.');
    }

    public function recibirPedido($idPedido){
        $pedido = Pedido::with('facturaPedido')->findOrFail($idPedido);
        //dd($pedido);
        if(!$pedido->recibir()){
            dd($pedido);
            return redirect()->back()->withErrors('El pedido no puede ser recibido.');
        }else{
            $pedido->estado ='recibido';
            $pedido->save();
            return redirect()->route('pedidos')->with('success', 'Pedido recibido.');
        }
    }
}
