@extends('app')

@section('content')
<div class="container-flex containerPagina">
    <div class="row w-100 mb-4">
        <div class="col-auto me-auto">
            <h1 class="tituloPagina">Pedidos</h1>
        </div>

        <!-- <div class="col d-flex justify-content-end">
            <a href="{{url('propietario/opticas')}}"><i class="fa-solid fa-x fa-lg"></i></a>
        </div> -->

        <!-- {{-- <div class="col-auto ms-auto d-flex ">
            <button class="botonNuevaCita" data-bs-toggle="modal" data-bs-target="#buscarCliModal2">Nueva Cita</button>
        </div> --}} -->
    </div>
    <table class="table-container table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Metodo Pago</th>
                <th>Proveedor</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pedidos as $pedido)
            <tr class="table-row"
                @if ($pedido->estado !== 'recibido' && $pedido->estado !== 'cancelado')
                onclick="window.location='{{route('pedido', $pedido->id )}}'"
                @else
                    onclick="window.location='{{route('generarFactura', ['idPedido' => $pedido->id] )}}'"
                @endif>
                <td>{{$pedido->id}}</td>
                <td>{{$pedido->fecha}}</td>
                <td>{{$pedido->estado}}</td>
                <td>{{$pedido->metodoPago}}</td>
                <td>{{$pedido->proveedor->nombre}}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6">No hay pedidos para esta óptica.</td>
            </tr>
            @endforelse
        </tbody>
    </table>


</div>

@endsection
