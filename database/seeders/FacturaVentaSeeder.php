<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
//use Database\Seeders\Carbon;
use Carbon\Carbon; // Import Carbon here



class FacturaVentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $facturas=[
            [
                'fecha' => Carbon::now()->subDays(7),
                'idVenta' => 1,
            ],
            [
                'fecha' => Carbon::now()->subDays(6),
                'idVenta' => 2,
            ],
            [
                'fecha' => Carbon::now()->subDays(5),
                'estadoPago' => 'cancelado',
                'idVenta' => 3,
            ],
            [
                'fecha' => Carbon::now()->subDays(3),
                'idVenta' => 4,
            ],
            [
                'fecha' => Carbon::now()->subDay(),
                'idVenta' => 5,
            ],
        ];

        foreach ($facturas as $factura){

            $estadoPago= DB::table('ventas')->where('id', $factura['idVenta'])->value('estadoPago');

            DB::table('factura_venta')->insert([
                'fecha'=> $factura['fecha'],
                'estadoPago'=> $estadoPago,
                'idVenta'=> $factura['idVenta'],
            ]);
        }
    }
}
