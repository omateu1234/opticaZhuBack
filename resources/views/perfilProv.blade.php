@extends('app')

@section('content')
<?php
$idProveedor= $proveedor->id;

?>

<div class="container-flex containerPagina">
    <div class="row w-100 mb-4">
        <div class="col-auto me-auto">
            <h1 class="tituloPagina">{{ $proveedor->nombre }}</h1>
        </div>
        <div class="col d-flex justify-content-end">
            <a href="{{url('propietario/proveedores')}}"><i class="fa-solid fa-x fa-lg"></i></a>
        </div>
    </div>

    <div class="row my-3">
        <div class="col-md-6">
            <p>Nombre Completo</p>
            <p><strong>{{ $proveedor->nombre }}</strong></p>
        </div>
        <div class="col-md-6">
            <p>NIF</p>
            <p><strong>{{ $proveedor->nif }}</strong></p>
        </div>
    </div>

    <div class="row my-3">
        <div class="col-md-6">
            <p>Dirección</p>
            <p><strong>{{ $proveedor->direccion }}</strong></p>
        </div>

        <div class="col-md-6">
            <p>Código Postal</p>
            <p><strong>{{ $proveedor->codPostal }}</strong></p>
        </div>


    </div>

    <div class="row my-3">
        <div class="col-md-6">
            <p>Correo</p>
            <p><strong>{{ $proveedor->correo }}</strong></p>
        </div>
        <div class="col-md-6">
            <p>Teléfono</p>
            <p><strong>{{ $proveedor->telefono }}</strong></p>
        </div>

    </div>

    <h2 class="tituloPagina">Articulos</h2>
    <table class="tabla-articulos ">
        <tr>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Stock</th>
        </tr>
        @forelse($articulos as $articulo)
        <tr>
            <td>{{$articulo->nombre}}</td>
            <td>{{$articulo->descripcion}}</td>
            <td>{{$articulo->precioProveedor}}€</td>
            <td>{{$articulo->stock}}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4">No hay Productos para este proveedor.</td>
        </tr>
        @endforelse
    </table>


@endsection

