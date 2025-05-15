@extends('app')

@section('content')
<div class="container-flex containerPagina">
    <div class="row w-100 mb-4">
        <div class="col-auto me-auto">
            <h1 class="tituloPagina">Resumen de Pedido  </h1>
        </div>
        <div class="col d-flex justify-content-end">
            <a href="{{url('propietario/pedidos')}}"><i class="fa-solid fa-x fa-lg"></i></a>
        </div>
    </div>

    <form method="POST" action="{{url('propietario/pagarFactura')}}">
        @csrf
        <p><strong>Número Factura:</strong> {{ $datosFactura['idPedido'] }}</p>
        <p><strong>Fecha:</strong> {{ $datosFactura['fecha']->format('d-m-Y') }}</p>
        <p><strong>Método de Pago:</strong> {{ $datosFactura['metodoPago'] }}</p>
        <p><strong>Estado del Pedido:</strong> {{ $datosFactura['estadoPedido'] }}</p>
        <h2>Proveedor</h2>
        <p><strong>Nombre:</strong> {{ $datosFactura['proveedor'] }}</p>
        <p><strong>NIF:</strong> {{$datosFactura['nif']}}</p>
        <p><strong>Dirección:</strong> {{ $datosFactura['direccion'] }}</p>

        <h2>Detalles del Pedido</h2>
            <table class="tabla-articulos ">
                <tr>
                    <th>Artículo</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Importe</th>
                </tr>
                @if(count( $datosFactura['lineas'])> 0)
                @foreach($datosFactura['lineas'] as $linea)
                <tr>
                    <td>{{ $linea['articulo'] }}</td>
                    <td>{{ $linea['cantidad'] }}</td>
                    <td>{{ number_format($linea['precio_unitario'], 2) }}€</td>
                    <td>{{ number_format($linea['importe'], 2) }}€</td>
                </tr>
                @endforeach
                @elseif ($datosFactura['estadoPedido']=='cancelado')
                <tr>
                    <td colspan="4">Pedido Cancelado</td>
                </tr>
                @else
                    <tr>
                    <td colspan="4">No hay productos</td>
                    </tr>
                @endif
            </table>

            <p><strong>Subtotal:</strong> {{ number_format($datosFactura['subtotal'], 2) }}€</p>
            <p><strong>Total (IVA incluido):</strong> {{ number_format($datosFactura['total'], 2) }}€</p>



            @if ($datosFactura['estadoPedido']== 'pendiente')
            <div class="col d-flex justify-content-end my-5">
                <button class="btn btn-primary botonNuevaCita" data-bs-toggle="modal" data-bs-target="#pagarModal" type="button">Pagar</button>
            </div>
            @endif
    </form>
</div>

<div class="modal  fade" id="pagarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <div class="w-100 row mx-1 border-bottom pt-2 pb-3">
                    <div class="col-auto d-flex align-items-center">
                        <h5 class="modal-title tituloModal" id="exampleModalLabel">Realiza el Pago</h5>
                    </div>
                    <div class="col-auto ms-auto d-flex align-items-center"><button type="button" class="ms-auto btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                </div>
            </div>
            <div class="modal-body mt-2 mb-3">
                <form class="form-cli row" method="post" action="{{url('propietario/pagarFactura')}}">
                    @csrf
                    <div class="col px-2">
                        @if ($datosFactura['metodoPago'] == 'transferencia')
                            <label class="col-form-label">IBAN</label>
                            <input class="form-control" type="text" pattern="^[A-Z]{2}\d{2}[A-Z0-9]{1,30}$" title="Por favor, introduce un IBAN válido.">
                        @elseif ($datosFactura['metodoPago'] == 'tarjeta')
                            <label class="col-form-label">Tarjeta de Crédito</label>
                            <input class="form-control" type="text" pattern="^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|3[47][0-9]{13}|6(?:011|5[0-9]{2})[0-9]{12}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35[0-9]{3})[0-9]{11})$" title="Por favor, introduce un número de tarjeta de crédito válido.">

                            <label class="col-form-label">Fecha de Caducidad (MM/YY)</label>
                            <input class="form-control" type="text" pattern="^(0[1-9]|1[0-2])\/([0-9]{2})$" title="Por favor, introduce una fecha de caducidad válida." placeholder="MM/YY">

                            <label class="col-form-label">Código de Seguridad (CVC)</label>
                            <input class="form-control" type="text" pattern="^[0-9]{3,4}$" title="Por favor, introduce un CVC válido.">
                        @endif
                        <input type="hidden" name="fecha" value="{{$datosFactura['fecha']}}">
                        <input type="hidden" name="estadoPago" value="pagado">
                        <input type="hidden" name="idPedido" value="{{$datosFactura['idPedido']}}">
                        <div class="row my-2">
                            <div class="col d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary botonNuevaCita me-4">Pagar</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
