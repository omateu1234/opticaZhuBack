<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineaVenta extends Model
{
    //
    protected $table= 'linea_venta';
    protected $fillable = ['cantidad','precio_unitario' ,'importe','idVenta', 'idArticulo'];
    public $timestamps = false;

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'idVenta');
    }

    public function articulo()
    {
        return $this->belongsTo(Articulo::class, 'idArticulo');
    }
}
