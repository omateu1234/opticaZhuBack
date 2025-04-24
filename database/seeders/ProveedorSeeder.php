<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proveedores= [
            [
                'nombre' => 'Proveedor Uno',
                'direccion' => 'Calle Falsa 123',
                'codPostal' => 28001,
                'telefono' => '600123456',
                'correo' => 'uno@correo.com',
                'nif' => 'A12345678',
            ],
            [
                'nombre' => 'Proveedor Dos',
                'direccion' => 'Avenida Siempre Viva 742',
                'codPostal' => 28002,
                'telefono' => '611223344',
                'correo' => 'dos@correo.com',
                'nif' => 'B23456789',
            ],
            [
                'nombre' => 'Proveedor Tres',
                'direccion' => 'Calle Luna 45',
                'codPostal' => 28003,
                'telefono' => '622334455',
                'correo' => 'tres@correo.com',
                'nif' => 'C34567890',
            ],
            [
                'nombre' => 'Proveedor Cuatro',
                'direccion' => 'Paseo del Sol 101',
                'codPostal' => 28004,
                'telefono' => '633445566',
                'correo' => 'cuatro@correo.com',
                'nif' => 'D45678901',
            ],
            [
                'nombre' => 'Proveedor Cinco',
                'direccion' => 'Calle Río 88',
                'codPostal' => 28005,
                'telefono' => '644556677',
                'correo' => 'cinco@correo.com',
                'nif' => 'E56789012',
            ],
        ];

        foreach ($proveedores as $proveedor){
            DB::table('proveedores')->insert([
                'nombre'=> $proveedor['nombre'],
                'direccion'=> $proveedor['direccion'],
                'codPostal'=> $proveedor['codPostal'],
                'telefono'=> $proveedor['telefono'],
                'correo'=> $proveedor['correo'],
                'nif'=> $proveedor['nif'],
               /*  'idAdmin'=> $cliente['idAdmin'], */
            ]);
        }
    }
}
