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
                'estadoPago' => 'pendiente',
                'idVenta' => 1,
            ],
            [
                'fecha' => Carbon::now()->subDays(6),
                'estadoPago' => 'cancelado',
                'idVenta' => 2,
            ],
            [
                'fecha' => Carbon::now()->subDays(5),
                'estadoPago' => 'pagado',
                'idVenta' => 3,
            ],
            [
                'fecha' => Carbon::now()->subDays(3),
                'estadoPago' => 'cancelado',
                'idVenta' => 4,
            ],
            [
                'fecha' => Carbon::now()->subDay(),
                'estadoPago' => 'pendiente',
                'idVenta' => 5,
            ],
        ];

        foreach ($facturas as $factura){

           /*  $estadoPago= DB::table('ventas')->where('id', $factura['idVenta'])->value('estadoPago'); */

            DB::table('factura_venta')->insert([
                'fecha'=> $factura['fecha'],
                'estadoPago'=> $factura['estadoPago'],
                'idVenta'=> $factura['idVenta']
            ]);
        }
    }
}
