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
                'estado' => 'pendiente',
                'metodoPago' => 'transferencia',
                'idOptica' => 1,
                'idCliente' => 1,
            ],
            [
                'fecha' => Carbon::now()->subDays(8),
                'estado' => 'pendiente',
                'metodoPago' => 'efectivo',
                'idOptica' => 2,
                'idCliente' => 2,
            ],
            [
                'fecha' => Carbon::now()->subDays(6),
                'estado' => 'cancelado',
                'metodoPago' => 'tarjeta',
                'idOptica' => 1,
                'idCliente' => 1,
            ],
            [
                'fecha' => Carbon::now()->subDays(3),
                'estado' => 'recibido',
                'metodoPago' => 'efectivo',
                'idOptica' => 2,
                'idCliente' => 2,
            ],
            [
                'fecha' => Carbon::now(),
                'estado' => 'recibido',
                'metodoPago' => 'transferencia',
                'idOptica' => 1,
                'idCliente' => 1,
            ],
        ];

        foreach ($ventas as $venta){
            DB::table('ventas')->insert([
                'fecha'=> $venta['fecha'],
                'estado'=>$venta['estado'],
                'metodoPago'=> $venta['metodoPago'],
                'idOptica'=> $venta['idOptica'],
                'idCliente'=> $venta['idCliente'],
            ]);
        }
    }
}
