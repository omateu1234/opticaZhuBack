@extends('app')

@section('content')
<div class="container-flex containerPagina">
    <div class="row w-100 mb-4">
        <div class="col-auto me-auto">
            <h1 class="tituloPagina">Pedidos</h1>
        </div>

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
            @foreach($pedidos as $pedido)
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
                    <td>
                        <button type="button" class="botonRecibir" data-bs-toggle="modal" data-bs-target="#modalPedido{{$pedido->id}}" onclick="event.stopPropagation()">Recibir</button>
                    </td>
                    @else
                    <td><strong> {{$pedido->estado}}</strong></td>
                    @endif
                </tr>

{{-- Modal individual para este pedido --}}
        <div class="modal fade" id="modalPedido{{$pedido->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$pedido->id}}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <div class="w-100 row mx-1 border-bottom pt-2 pb-3">
                            <div class="col-auto d-flex align-items-center">
                                <h5 class="modal-title tituloModalOutline" id="exampleModalLabel{{$pedido->id}}">Recibe el pedido</h5>
                            </div>
                            <div class="col-auto ms-auto d-flex align-items-center">
                                <button type="button" class="ms-auto btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body mt-2 mb-3">
                        <form class="form-cli row" method="post" action="{{route('recibirPedido', $pedido->id)}}">
                            @csrf
                            @method('PATCH')
                            <div class="col px-2">
                                <div class="row my-2">
                                    <div class="col d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary botonRecibir me-4">Recibir</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                @endforeach

            </tbody>
        </table>
    </div>



@endsection
