<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //
    protected $fillable = ['fecha', 'importe', 'estadoPago'];
    public $timestamps = false;

    public function optica()
    {
        return $this->belongsTo(Optica::class, 'idOptica');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idCliente');
    }

    public function facturaVenta()
    {
        return $this->hasOne(FacturaVenta::class);
    }

    public function lineasVenta()
    {
        return $this->hasMany(LineaVenta::class);
    }

}
