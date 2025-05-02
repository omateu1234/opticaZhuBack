<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $articulos= [
            [
                'nombre' => 'Lentes Sol',
                'descripcion' => 'Lentes de sol polarizados.',
                'precioProveedor' => 49.99,
                'stock' => 10,
                'idProveedor' => 1,
                'idOptica' => 1,
            ],
            [
                'nombre' => 'Gafas Lectura',
                'descripcion' => 'Gafas para lectura de cerca.',
                'precioProveedor' => 29.90,

                'stock' => 15,
                'idProveedor' => 2,
                'idOptica' => 1,
            ],
            [
                'nombre' => 'Estuche',
                'descripcion' => 'Estuche rígido para gafas.',
                'precioProveedor' => 9.99,
                'stock' => 25,
                'idProveedor' => 1,
                'idOptica' => 2,
            ],
            [
                'nombre' => 'Limpia Cristales',
                'descripcion' => 'Spray para limpiar gafas.',
                'precioProveedor' => 4.50,
                'stock' => 50,
                'idProveedor' => 2,
                'idOptica' => 2,
            ],
            [
                'nombre' => 'Gafas Premium',
                'descripcion' => 'Montura metálica con cristales.',
                'precioProveedor' => 120.00,
                'stock' => 5,
                'idProveedor' => 1,
                'idOptica' => 1,
            ],
        ];

        foreach ($articulos as $articulo){
            DB::table('articulos')->insert([
                'nombre'=> $articulo['nombre'],
                'descripcion'=> $articulo['descripcion'],
                'precioProveedor'=> $articulo['precioProveedor'],
                'precioCliente'=> $articulo['precioProveedor'] * 1.21, // Precio cliente es un 21% más que el precio proveedo
                'stock'=> $articulo['stock'],
                'idProveedor'=> $articulo['idProveedor'],
                'idOptica'=> $articulo['idOptica'],
            ]);
        }
    }
}
