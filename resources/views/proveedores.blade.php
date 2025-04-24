@extends('app')

@section('content')
<div class="container-flex containerPagina">
    <div class="row w-100 mb-4">
        <div class="col-auto me-auto">
            <h1 class="tituloPagina">Proveedores</h1>
        </div>

        <!-- <div class="col d-flex justify-content-end">
            <a href="{{url('propietario/opticas')}}"><i class="fa-solid fa-x fa-lg"></i></a>
        </div> -->

        <!-- {{-- <div class="col-auto ms-auto d-flex ">
            <button class="botonNuevaCita" data-bs-toggle="modal" data-bs-target="#buscarCliModal2">Nueva Cita</button>
        </div> --}} -->


    </div>
    <form action="">
        <div class="row">
            <div class="col-auto col-2">
                <select class="form-select form-select-sm" name="Cambiar vista" id="">
                    <option value="" selected disabled>Cambiar vista</option>
                </select>
            </div>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>NIF</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Cod Postal</th>
                <th>Teléfono</th>
                <th>Correo</th>
            </tr>
        </thead>
        <tbody>
            @forelse($proveedores as $proveedor)
            <tr>
                <td>{{$proveedor->nif}}</td>
                <td>{{$proveedor->nombre}}</td>
                <td>{{$proveedor->direccion}}</td>
                <td>{{$proveedor->codPostal}}</td>
                <td>{{$proveedor->telefono}}</td>
                <td>{{$proveedor->correo}}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3">No hay Proveedores para esta óptica.</td>
            </tr>
            @endforelse
        </tbody>
    </table>



</div>

@endsection
