<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Articulo;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Import Carbon here



class LineaPedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $lineaPedidos=[
            [
                'cantidad' => 2,
                'idPedido' => 1,
                'idArticulo' => 1,
            ],
            [
                'cantidad' => 1,
                'idPedido' => 2,
                'idArticulo' => 2,
            ],
            [
                'cantidad' => 4,
                'idPedido' => 3,
                'idArticulo' => 3,
            ],
            [
                'cantidad' => 1,
                'idPedido' => 4,
                'idArticulo' => 4,
            ],
            [
                'cantidad' => 3,
                'idPedido' => 5,
                'idArticulo' => 5,
            ],
        ];

        foreach ($lineaPedidos as $lineaPedido){

            $articulo= Articulo::find($lineaPedido['idArticulo']);
            $precioUnitario= $articulo->precioProveedor;
            $importe= $lineaPedido['cantidad'] * $precioUnitario;


            DB::table('linea_pedido')->insert([
                'cantidad'=> $lineaPedido['cantidad'],
                'precio_unitario'=> $precioUnitario,
                'importe'=> $importe,
                'idPedido'=> $lineaPedido['idPedido'],
                'idArticulo'=> $lineaPedido['idArticulo'],
            ]);
        }
    }
}
