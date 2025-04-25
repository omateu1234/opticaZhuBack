<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    //
    protected $table = 'proveedores';
    protected $fillable = [ 'nombre', 'direccion','codPostal','telefono','correo','nif'];
    public $timestamps = false;

    public function pedidos(){
        return $this->hasMany(Pedido::class);
    }

    public function articulos(){
        return $this->hasMany(Articulo::class, 'idProveedor');
    }
}
