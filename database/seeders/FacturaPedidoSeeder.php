<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Import Carbon here


class FacturaPedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $facturas= [
            [
                'fecha' => Carbon::now()->subDays(7),
                'estadoPago' => 'pendiente',
                'idPedido' => 1,
            ],
            [
                'fecha' => Carbon::now()->subDays(6),
                'estadoPago' => 'pagado',
                'idPedido' => 2,
            ],
            [
                'fecha' => Carbon::now()->subDays(5),
                'estadoPago' => 'cancelado',
                'idPedido' => 3,
            ],
            [
                'fecha' => Carbon::now()->subDays(4),
                'estadoPago' => 'pagado',
                'idPedido' => 4,
            ],
            [
                'fecha' => Carbon::now()->subDays(3),
                'estadoPago' => 'pendiente',
                'idPedido' => 5,
            ],
        ];

        foreach ($facturas as $factura){

            DB::table('factura_pedido')->insert([
                'fecha'=> $factura['fecha'],
                'estadoPago'=> $factura['estadoPago'],
                'idPedido'=> $factura['idPedido'],
            ]);
        }
    }
}
