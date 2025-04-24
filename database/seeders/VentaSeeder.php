<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Import Carbon here



class VentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ventas= [
            [
                'fecha' => Carbon::now()->subDays(10),
                'importe' => 150.00,
                'estadoPago' => 'pendiente',
                'idOptica' => 1,
                'idCliente' => 1,
            ],
            [
                'fecha' => Carbon::now()->subDays(8),
                'importe' => 89.90,
                'estadoPago' => 'pagado',
                'idOptica' => 2,
                'idCliente' => 2,
            ],
            [
                'fecha' => Carbon::now()->subDays(6),
                'importe' => 49.99,
                'estadoPago' => 'cancelado',
                'idOptica' => 1,
                'idCliente' => 1,
            ],
            [
                'fecha' => Carbon::now()->subDays(3),
                'importe' => 200.00,
                'estadoPago' => 'pagado',
                'idOptica' => 2,
                'idCliente' => 2,
            ],
            [
                'fecha' => Carbon::now(),
                'importe' => 120.00,
                'estadoPago' => 'pendiente',
                'idOptica' => 1,
                'idCliente' => 1,
            ],
        ];

        foreach ($ventas as $venta){
            DB::table('ventas')->insert([
                'fecha'=> $venta['fecha'],
                'importe'=> $venta['importe'],
                'estadoPago'=> $venta['estadoPago'],
                'idOptica'=> $venta['idOptica'],
                'idCliente'=> $venta['idCliente'],
            ]);
        }
    }
}
