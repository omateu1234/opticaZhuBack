@extends('app')

@section('content')
<div class="container-flex containerPagina">
    <div class="row w-100 mb-4">
        <div class="col-auto me-auto">
            <h1 class="tituloPagina">Pedido a {{$proveedor->nombre}} {{$proveedor->id}}</h1>
        </div>
        <div class="col d-flex justify-content-end">
            <a href="{{url('propietario/proveedores')}}"><i class="fa-solid fa-x fa-lg"></i></a>
        </div>


        <!-- {{-- <div class="col-auto ms-auto d-flex ">
            <button class="botonNuevaCita" data-bs-toggle="modal" data-bs-target="#buscarCliModal2">Nueva Cita</button>
        </div> --}} -->
    </div>
    


    <h3>Productos</h3>
    <table class="table-container table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Stock Actual</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>


            @forelse($articulos as $articulo)
            <tr class="table-row">
                <td>{{$articulo->nombre}}</td>
                <td>{{$articulo->descripcion}}</td>
                <td>{{$articulo->precioProveedor}}€</td>
                <td>{{$articulo->stock}}</td>
                <td><input type="number" min="0" max="199" value="0"></td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No hay Productos para este proveedor.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="col d-flex justify-content-end my-5">
        <button class="botonNuevaCita">Siguiente</button>
    </div>
</div>

@endsection

{{-- <button class="boton-menos"><i class="fa-solid fa-minus fa-2xs"></i></button>

 <button class="boton-mas"><i class="fa-solid fa-plus fa-2xs"></i></button> --}}
