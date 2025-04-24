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
}
