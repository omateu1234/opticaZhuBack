<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaVenta extends Model
{
    //
    protected $fillable = ['fecha', 'estadoPago', 'importe'];
    public $timestamps = false;


    public function venta()
    {
        return $this->belongsTo(Venta::class, 'idVenta');
    }
}
