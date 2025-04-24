<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    //
    protected $fillable = ['nombre', 'descripcion', 'precio', 'stock'];
    public $timestamps = false;

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'idProveedor');
    }

    public function optica(){
        return $this->belongsTo(Optica::class, 'idOptica');
    }

    public function lineasPedido(){
        return $this->hasMany(LineaPedido::class, 'idArticulo');
    }

    public function lineasVenta(){
        return $this->hasMany(LineaVenta::class, 'idArticulo');
    }
}
