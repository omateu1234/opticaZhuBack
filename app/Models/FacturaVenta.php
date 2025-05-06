<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaVenta extends Model
{
    //
    protected $table = 'factura_venta';
    protected $fillable = ['fecha', 'estadoPago', 'idVenta'];
    public $timestamps = false;


    public function venta()
    {
        return $this->belongsTo(Venta::class, 'idVenta');
    }
}
