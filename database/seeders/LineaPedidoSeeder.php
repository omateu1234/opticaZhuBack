<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
                'fecha' => Carbon::now()->subDays(5),
                'importe' => 49.99,
                'idPedido' => 1,
                'idArticulo' => 1,
            ],
            [
                'fecha' => Carbon::now()->subDays(4),
                'importe' => 29.90,
                'idPedido' => 2,
                'idArticulo' => 2,
            ],
            [
                'fecha' => Carbon::now()->subDays(3),
                'importe' => 9.99,
                'idPedido' => 3,
                'idArticulo' => 3,
            ],
            [
                'fecha' => Carbon::now()->subDays(2),
                'importe' => 4.50,
                'idPedido' => 4,
                'idArticulo' => 4,
            ],
            [
                'fecha' => Carbon::now()->subDay(),
                'importe' => 120.00,
                'idPedido' => 5,
                'idArticulo' => 5,
            ],
        ];

        foreach ($lineaPedidos as $lineaPedido){
            DB::table('linea_pedido')->insert([
                'fecha'=> $lineaPedido['fecha'],
                'importe'=> $lineaPedido['importe'],
                'idPedido'=> $lineaPedido['idPedido'],
                'idArticulo'=> $lineaPedido['idArticulo'],
            ]);
        }
    }
}
