<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pedidos= [
            [
                'fecha' =>'2025-04-27',
                'estado' => 'pendiente',
                'telefono' => '600000001',
                'idAuxiliar' => 1,
                'idProveedor' => 1,
                'idOptica' => 1,
            ],
            [
                'fecha' =>'2025-04-29',
                'estado' => 'recibido',
                'telefono' => '600000002',
                'idAuxiliar' => 2,
                'idProveedor' => 1,
                'idOptica' => 2,
            ],
            [
                'fecha' =>'2025-05-06',
                'estado' => 'cancelado',
                'telefono' => '600000003',
                'idAuxiliar' => 1,
                'idProveedor' => 2,
                'idOptica' => 1,
            ],
            [
                'fecha' =>'2025-05-09',
                'estado' => 'pendiente',
                'telefono' => '600000004',
                'idAuxiliar' => 2,
                'idProveedor' => 2,
                'idOptica' => 2,
            ],
            [
                'fecha' => '2025-05-16' ,
                'estado' => 'recibido',
                'telefono' => '600000005',
                'idAuxiliar' => 1,
                'idProveedor' => 1,
                'idOptica' => 1,
            ],
        ];

        foreach ($pedidos as $pedido){
            DB::table('pedidos')->insert([
                'fecha'=> $pedido['fecha'],
                'estado'=> $pedido['estado'],
                'telefono'=> $pedido['telefono'],
                'idAuxiliar'=> $pedido['idAuxiliar'],
                'idProveedor'=> $pedido['idProveedor'],
                'idOptica'=> $pedido['idOptica'],
            ]);
        }
    }
}
