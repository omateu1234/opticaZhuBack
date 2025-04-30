@extends('app')

@section('content')
<div class="container-flex containerPagina">
    <div class="row w-100 mb-4">
        <div class="col-auto me-auto">
            <h1 class="tituloPagina">Factura  </h1>
        </div>
        <div class="col d-flex justify-content-end">
            <a href="{{url('propietario/pedidos')}}"><i class="fa-solid fa-x fa-lg"></i></a>
        </div>
    </div>

    <form method="POST" action="{{url('propietario/pagarFactura')}}">
        @csrf
        <p><strong>Fecha:</strong> {{ $datosFactura['fecha']->format('d-m-Y') }}</p>
        <p><strong>Estado del Pago:</strong> {{ $datosFactura['estadoPago'] }}</p>
        <h2>Proveedor</h2>
        <p><strong>Nombre:</strong> {{ $datosFactura['proveedor'] }}</p>
        <p><strong>NIF:</strong> {{$datosFactura['nif']}}</p>
        <p><strong>Dirección:</strong> {{ $datosFactura['direccion'] }}</p>

        <h2>Detalle del Pedido</h2>
            <table class="tabla-articulos ">
                <tr>
                    <th>Artículo</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Importe</th>
                </tr>
                @foreach($datosFactura['lineas'] as $linea)
                <tr>
                    <td>{{ $linea['articulo'] }}</td>
                    <td>{{ $linea['cantidad'] }}</td>
                    <td>{{ number_format($linea['precio_unitario'], 2) }}</td>
                    <td>{{ number_format($linea['importe'], 2) }}</td>
                </tr>
                @endforeach
            </table>

            <p><strong>Subtotal:</strong> {{ number_format($datosFactura['subtotal'], 2) }}</p>
            <p><strong>Total (IVA incluido):</strong> {{ number_format($datosFactura['total'], 2) }}</p>

            <input type="hidden" name="fecha" value="{{$datosFactura['fecha']}}">
            <input type="hidden" name="estadoPago" value="pagado">
            <input type="hidden" name="idPedido" value="{{$datosFactura['idPedido']}}">

            <div class="col d-flex justify-content-end my-5">
                <button class="btn btn-primary botonNuevaCita" type="submit">Pagar</button>
            </div>
    </form>
</div>

@endsection
