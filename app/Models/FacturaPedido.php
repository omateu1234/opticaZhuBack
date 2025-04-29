<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaPedido extends Model
{
    //
    protected $table = 'factura_pedido';
    protected $fillable = ['fecha', 'estadoPago', 'importe', 'idPedido'];
    public $timestamps = false;

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'idPedido');
    }
}
