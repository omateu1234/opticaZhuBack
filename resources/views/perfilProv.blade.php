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

    <div class="row mt-4 ">
        <div class="col-md-11 my-3 d-flex justify-content-end">
            <button type="button" class="botonNuevaCita" data-bs-toggle="modal" data-bs-target="#editProModal">Editar</button>
        </div>
    </div>
</div>


<div class="modal modal-lg fade" id="editProModal" tabindex="-1" aria-labelledby="crearProModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <div class="w-100 row mx-1 border-bottom pt-2 pb-3">
                    <div class="col-auto d-flex align-items-center">
                        <h5 class="modal-title tituloModal" id="crearProModalLabel">Edita los Datos</h5>
                    </div>
                    <div class="col-auto ms-auto d-flex align-items-center"><button type="button" class="ms-auto btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                </div>
            </div>
            <div class="modal-body mt-2 mb-3">
                <form id="form-cli " method="POST" action="{{url('editarPropietario')}}">
                    <div class="col px-2">
                        @csrf
                        @method('PATCH')
                        <div class="row my-2">
                            <div class="col">
                                <label class="col-form-label" for="nombre">Nombre</label>
                                <input class="form-control" type="text" name="nombre" value="{{ $proveedor->nombre }}" id="nombre" maxlength="20">
                            </div>
                            <div class="col">
                                <label class="col-form-label" for="direccion">Dirección</label>
                                <input class="form-control" type="text" name="direccion" value="{{ $proveedor->direccion }}"  id="direccion" maxlength="40">
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col">
                                <label class="col-form-label" for="cp">Cód.Postal</label>
                                <input class="form-control" type="text" name="codPostal" value="{{ $proveedor->codPostal }}" id="cp">
                            </div>
                            <div class="col">
                                <label class="col-form-label" for="telf">Num. Telf</label>
                                <input class="form-control" type="text" name="telefono" value="{{ $proveedor->telefono }}" id="telf" maxlength="9">
                            </div>
                            <div class="col">
                                <label class="col-form-label" for="correo">Correo</label>
                                <input class="form-control" type="email" name="correo" value="{{ $proveedor->correo }}" id="correo">
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class='col'>
                                <label class="col-form-label" for="nif">NIF</label>
                                <input class="form-control w-50" type="text" name="nif" value="{{ $proveedor->nif }}" id="nif" maxlength="9">
                            </div>
                        </div>

                    </div>

                    <input type="hidden" name="id" value="{{$proveedor->id}}">

            </div>
            <div class="modal-footer border-0">
                <button type="submit" class="botonFooterModal mx-3 mb-2">Editar</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

