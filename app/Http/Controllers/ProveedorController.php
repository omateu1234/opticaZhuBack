<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedorController extends Controller
{
    function getAll(){
        $proveedores = Proveedor::all();
         return view('proveedores', compact('proveedores'));
    }

    function getAllApi(){
        $proveedores = Proveedor::all();
        return response()->json($proveedores);
    }

    function getAllSelect(){
        $proveedores = Proveedor::all();
        return view('navbar', compact('proveedores'));
    }

    function getById($id){
        //$proveedor = Proveedor::find($id);
        $proveedor = Proveedor::with('articulos')->find($id);

        $articulos = $proveedor->articulos;

        return view('perfilProv', compact('proveedor', 'articulos'));
    }

    public function buscarProveedor($nif=null, $nombre=null){
        $query=Proveedor::with('articulos');
        if($nif){
            $query->where('nif', $nif);
        }
        if($nombre){
            $query->where('nombre', 'like', '%'.$nombre.'%');
        }
       $proveedor=$query->first();
        if ($proveedor == null) {
            return response()->json(['message' => 'Proveedor no encontrado']);
        }
        return $proveedor;
    }

    public function getByNifOrName(Request $request){
        $request->validate([
            'nif' => 'nullable|string|max:255',
            'nombre' => 'nullable|string|max:255',
        ]);
        $nif = $request->query('nif');
        $nombre= $request->query('nombre');

        $proveedor= $this->buscarProveedor($nif, $nombre);

        if ($proveedor == null) {
            return response()->json(['message' => 'Proveedor no encontrado']);
        }
        $articulos = $proveedor->articulos;
        return view('perfilProv', compact('proveedor', 'articulos'));
    }

    public function getByNifOrNamePedido(Request $request){
        $request->validate([
            'nif' => 'nullable|string|max:255',
            'nombre' => 'nullable|string|max:255',
        ]);
        $nif = $request->query('nif');
        $nombre= $request->query('nombre');

        $proveedor= $this->buscarProveedor($nif, $nombre);

        if ($proveedor == null) {
            return response()->json(['message' => 'Proveedor no encontrado']);
        }
        $articulos = $proveedor->articulos;
        return view('pedido', compact('proveedor', 'articulos'));
    }

    function getArticulos($id){
        $proveedor= Proveedor::with('articulos')->find($id);
        $articulos = $proveedor->articulos;
        dd($articulos);
        //return view('perfilProv', compact('articulos'));
    }


    public function guardar(Request $request)
    {
        //dd($request);

        $validateData = $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'codPostal' => 'required|string|max:10',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|string|max:255|email',
            'nif' => 'required|string|max:255',
        ]);
        //dd($request ->all());
        Proveedor::create($validateData);

        return redirect()->route('proveedores');
    }

    public function getPedidos(Request $request){
        $request->validate([
            'nif' => 'nullable|string|max:255',
            'nombre' => 'nullable|string|max:255',
        ]);
        $nif = $request->query('nif');
        $nombre= $request->query('nombre');

        $proveedor= $this->buscarProveedor($nif, $nombre);

        if ($proveedor == null) {
            return response()->json(['message' => 'Proveedor no encontrado']);
        }
        $pedidos = $proveedor->pedidos;
        return view('pedidosProveedor', compact('proveedor', 'pedidos'));
    }

    public function editar(Request $request){
        $datos=$request->validate([
            'id' => 'required|integer',
            'nombre' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'codPostal' => 'nullable|string|max:5',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'nullable|string|max:255|email',
            'nif' => 'nullable|string|max:255',
        ]);
        $proveedor= Proveedor::find($datos['id']);
        if($proveedor){
            $proveedor->nombre= $datos['nombre'];
            $proveedor->direccion= $datos['direccion'];
            $proveedor->codPostal= $datos['codPostal'];
            $proveedor->telefono= $datos['telefono'];
            $proveedor->correo= $datos['correo'];
            $proveedor->nif= $datos['nif'];
            $proveedor->save();
        }
        return redirect()->route('perfilProv', ['id' => $datos['id']])->with('success', 'Proveedor editado con exito');
    }
}

