<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Cliente;


class VentaController extends Controller
{
    //
    public function getAll(){
        $ventas = Venta::with('cliente')->get();
        return response()->json($ventas);
    }

    public function guardar(Request $request){
        $datos= $request->validate([
            'fecha' => 'required|date',
            'metodoPago' => 'required|string|max:255',
            'dniCliente' => 'required|string',
        ]);
    $cliente= Cliente::where('dni', $datos['dniCliente'])->first();

    if (!$cliente) {
        return response()->json(['message' => 'Cliente no encontrado'], 404);
    }

    $datos['idCliente']=$cliente->id;
    unset($datos['dniCliente']);

    Venta::create($datos);

    }
}
