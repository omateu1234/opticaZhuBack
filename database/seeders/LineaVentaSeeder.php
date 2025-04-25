<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Articulo;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Import Carbon here


class LineaVentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $lineaVentas= [
            [
                'cantidad' => 1,
                'idVenta' => 1,
                'idArticulo' => 1,
            ],
            [
                'cantidad' => 2,
                'idVenta' => 2,
                'idArticulo' => 2,
            ],
            [
                'cantidad' => 3,
                'idVenta' => 3,
                'idArticulo' => 3,
            ],
            [
                'cantidad' => 1,
                'idVenta' => 4,
                'idArticulo' => 4,
            ],
            [
                'cantidad' => 5,
                'idVenta' => 5,
                'idArticulo' => 5,
            ],
        ];

        foreach ($lineaVentas as $lineaVenta){

            $articulo= Articulo::find($lineaVenta['idArticulo']);
            $precioUnitario= $articulo->precioCliente;
            $importe= $lineaVenta['cantidad'] * $precioUnitario;

            DB::table('linea_venta')->insert([
                'cantidad'=> $lineaVenta['cantidad'],
                'precio_unitario'=> $precioUnitario,
                'importe'=> $importe,
                'idVenta'=> $lineaVenta['idVenta'],
                'idArticulo'=> $lineaVenta['idArticulo'],
            ]);
        }
    }
}
