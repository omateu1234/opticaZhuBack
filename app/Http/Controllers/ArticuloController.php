<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Articulo;
use Illuminate\Support\Facades\DB;



class ArticuloController extends Controller
{
    public function getAll(){
        $articulos= Articulo::all();
        return response()->json($articulos);
    }

    public function getById(Request $request){
        $request->validate([
            'id' => 'required|string|max:255',
        ]);

        $id= $request->query('id');

        $articulo= DB::table('articulos')->where('id', $id)->first();

        if($articulo==null){
            return response()->json(['message' => 'Cliente no encontrado'])
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
        }

        //dd($cliente);
        return response()->json($articulo)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
    }

    public function guardar(Request $request){
        $datos= $request->validate([
            'nombre'=> 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precioProveedor' => 'required|numeric|',
            'stock' => 'nullable|integer|max:20',
            'idProveedor' => 'required|integer|max:255',
            'idOptica' => 'nullable|integer|max:255',
        ]);
        $iva= 1.21;
        $datos['precioCliente']= $datos['precioProveedor']*$iva;
        $articulo= Articulo::create($datos);
    }

    public function articulosByOptica(Request $request){
        $datos= $request->validate([
            'idOptica' => 'required|integer'
        ]);
        $articulos= Articulo::where('idOptica', $datos['idOptica'])->get();

        if($articulos==null){
            return response()->json(['message' => 'No hay articulos']);
        }
        return response()->json($articulos);
    }


    public function editar(Request $request){
        $datos= $request->validate([
            'id' => 'required|integer',
            'nombre'=> 'nullable|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'precioProveedor' => 'nullable|numeric|',
        ]);
        $articulo= Articulo::find($datos['id']);
        if($articulo){
            if (isset($datos['nombre'])) {
                $articulo->nombre = $datos['nombre'];
            }
            if (isset($datos['descripcion'])) {
                $articulo->descripcion = $datos['descripcion'];
            }
            if (isset($datos['precioProveedor'])) {
                $articulo->precioProveedor = $datos['precioProveedor'];
            }
            $articulo->save();
            return response()->json(['message' => 'Articulo editado']);
        }else{
            return response()->json(['message' => 'Articulo no encontrado']);
        }
        if(!$articulo || $articulo==null){
            return response()->json(['mesasge' => 'Articulo no encontrado']);
        }
    }
}
