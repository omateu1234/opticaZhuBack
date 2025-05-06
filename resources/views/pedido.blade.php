@extends('app')

@section('content')
<div class="container-flex containerPagina">
    <div class="row w-100 mb-4">
        <div class="col-auto me-auto">
            <h1 class="tituloPagina">Pedido a {{$proveedor->nombre}}</h1>
        </div>


        <!-- {{-- <div class="col-auto ms-auto d-flex ">
            <button class="botonNuevaCita" data-bs-toggle="modal" data-bs-target="#buscarCliModal2">Nueva Cita</button>
        </div> --}} -->
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
    // Selecciona todos los inputs de cantidad
    const cantidades = document.querySelectorAll('.cantidad');

    cantidades.forEach(input => {
        input.addEventListener('input', function () {
            const precio = parseFloat(this.dataset.precio);
            const cantidad = parseInt(this.value);
            const importe = precio * cantidad;


            const importeInput = this.closest('tr').querySelector('.importe');
            importeInput.value = importe.toFixed(2);
        });
    });
});
    </script>

    <h3>Productos</h3>
    <form class="form-cli row" method="POST" action="{{url('propietario/insertarLineaPedido')}}">
        @csrf
            <table class="table-container table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock Actual</th>
                    <th>Cantidad</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>


                @forelse($articulos as $articulo)
                <tr class="table-row">
                    <td>{{$articulo->nombre}}</td>
                    <td>{{$articulo->descripcion}}</td>
                    <td class="precio">{{$articulo->precioProveedor}}€</td>
                    <td>{{$articulo->stock}}</td>

                    <td><input type="number" class="cantidad" name="articulos[{{$articulo->id}}][cantidad]" min="0" max="199" value="0" data-precio="{{$articulo->precioProveedor}}"></td>

                    <td><input type="text" class="importe" name="articulos[{{$articulo->id}}][importe]" readonly></td>
                    <input type="hidden" name="articulos[{{$articulo->id}}][precio_unitario]" value="{{$articulo->precioProveedor}}">
                    <input type="hidden" name="articulos[{{$articulo->id}}][idPedido]" value="{{$pedido->id}}">
                    <input type="hidden" name="articulos[{{$articulo->id}}][idArticulo]" value="{{$articulo->id}}">
                </tr>
                    @empty
                <tr>
                    <td colspan="4">No hay Productos para este proveedor.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="col d-flex justify-content-end my-5">
            <button class="btn btn-primary botonNuevaCita" type="submit">Siguiente</button>
        </div>
    </form>
</div>

@endsection

{{-- <button class="boton-menos"><i class="fa-solid fa-minus fa-2xs"></i></button>

 <button class="boton-mas"><i class="fa-solid fa-plus fa-2xs"></i></button> --}}
