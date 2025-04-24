<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
                'fecha' => Carbon::now()->subDays(10),
                'importe' => 49.99,
                'idVenta' => 1,
                'idArticulo' => 1,
            ],
            [
                'fecha' => Carbon::now()->subDays(9),
                'importe' => 29.90,
                'idVenta' => 2,
                'idArticulo' => 2,
            ],
            [
                'fecha' => Carbon::now()->subDays(8),
                'importe' => 19.50,
                'idVenta' => 3,
                'idArticulo' => 3,
            ],
            [
                'fecha' => Carbon::now()->subDays(6),
                'importe' => 120.00,
                'idVenta' => 4,
                'idArticulo' => 4,
            ],
            [
                'fecha' => Carbon::now()->subDays(5),
                'importe' => 45.75,
                'idVenta' => 5,
                'idArticulo' => 5,
            ],
        ];

        foreach ($lineaVentas as $lineaVenta){
            DB::table('linea_venta')->insert([
                'fecha'=> $lineaVenta['fecha'],
                'importe'=> $lineaVenta['importe'],
                'idVenta'=> $lineaVenta['idVenta'],
                'idArticulo'=> $lineaVenta['idArticulo'],
            ]);
        }
    }
}
