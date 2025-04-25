<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    //
    protected $fillable = ['fecha', 'estado', 'metodPago', 'idProveedor' ];
    public $timestamps = false;

    public function auxiliar()
    {
        return $this->belongsTo(Auxiliar::class, 'idEmpleado');
    }

    public function optica(){
        return $this->belongsTo(Optica::class, 'idOptica');
    }

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'idProveedor');
    }

    public function facturaPedido(){
        return $this->hasOne(FacturaPedido::class);
    }

    public function lineasPedido(){
        return $this->hasMany(LineaPedido::class);
    }

}
