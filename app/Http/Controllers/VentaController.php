<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Cliente;
use Carbon\Carbon;


class VentaController extends Controller
{
    //
    public function getAll(){
        $ventas = Venta::with('cliente')->get();
        return response()->json($ventas);
    }

    public function guardar(Request $request){
        $datos= $request->validate([
            'metodoPago' => 'required|string|max:255',
            'dniCliente' => 'required|string',
            'idOptica' => 'required|integer'
        ]);
        $datos['fecha']= Carbon::now();

        $cliente= Cliente::where('dni', $datos['dniCliente'])->first();

    if (!$cliente) {
        return response()->json(['message' => 'Cliente no encontrado'], 404);
    }

    $datos['idCliente']=$cliente->id;
    unset($datos['dniCliente']);

    Venta::create($datos);
    }


    public function cancelarVenta(Request $request){

        $datos= $request->validate([
            'idVenta' => 'required|numeric',
        ]);

        $idVenta= $datos['idVenta'];

        $venta = Venta::find($idVenta);
        //dd($venta);
        if($venta){
            $venta->estado ='cancelado';
            $venta->save();
            //dd($venta);
        }else{
            return response()->json(['message' => 'Venta no encontrada'], 404);
        }
    }
}
