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
                <th>Recibir</th>
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
                @if ($pedido->recibir())
                <td><button type="button" class="botonOutline" data-bs-toggle="modal" data-bs-target="#borrarEmpModal" onclick="event.stopPropagation()">Recibir</button></td>
                @else
                <td><strong> {{$pedido->estado}}</strong></td>
                @endif
            </tr>
                @empty
            <tr>
                <td colspan="6">No hay pedidos para esta óptica.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="modal  fade" id="borrarEmpModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <div class="w-100 row mx-1 border-bottom pt-2 pb-3">
                    <div class="col-auto d-flex align-items-center">
                        <h5 class="modal-title tituloModal" id="exampleModalLabel">Recibe el pedido</h5>
                    </div>
                    <div class="col-auto ms-auto d-flex align-items-center"><button type="button" class="ms-auto btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                </div>
            </div>
            <div class="modal-body mt-2 mb-3">
                <form class="form-cli row" method="post" action="{{route('recibirPedido', $pedido->id)}}">
                    @csrf
                    @method('PATCH')
                    <div class="col px-2">
                        <div class="row my-2 d-flex justify-content-center">
                            <div class="col">
                                <button type="submit" class="btn btn-primary botonOutline me-4">Recibir</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary  botonNuevaCita justify-content-end " data-bs-dismiss="modal"> Cancelar</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
