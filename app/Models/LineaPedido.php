<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineaPedido extends Model
{
    //
    protected $fillable = ['fecha', 'importe'];
    public $timestamps = false;

    public function pedido(){
        return $this->belongsTo(Pedido::class, 'idPedido');
    }

    public function articulo(){
        return $this->belongsTo(Articulo::class, 'idArticulo');
    }
    

}
