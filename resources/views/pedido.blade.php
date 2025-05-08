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
        <div class="col d-flex justify-content-between my-5">
            <button type="button" class="botonOutline" data-bs-toggle="modal" data-bs-target="#borrarEmpModal">Cancelar</button>
            <button class="btn btn-primary botonNuevaCita" type="submit">Siguiente</button>
        </div>
    </form>


</div>

    <div class="modal  fade" id="borrarEmpModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <div class="w-100 row mx-1 border-bottom pt-2 pb-3">
                        <div class="col-auto d-flex align-items-center">
                            <h5 class="modal-title tituloModal" id="exampleModalLabel">¿Quieres cancelar el pedido?</h5>
                        </div>
                        <div class="col-auto ms-auto d-flex align-items-center"><button type="button" class="ms-auto btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    </div>
                </div>
                <div class="modal-body mt-2 mb-3">
                    <form class="form-cli row" method="post" action="{{route('cancelarPedido', $pedido->id)}}">
                        @csrf
                        @method('PATCH')
                        <div class="col px-2">
                            <div class="row my-2 d-flex justify-content-between">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary botonOutline me-4"><i class="fa-solid fa-trash"></i> Si</button>
                                </div>
                                <div class="col">
                                <button type="button" class="btn btn-primary  botonNuevaCita justify-content-end " data-bs-dismiss="modal"><i class="fa-solid fa-x"></i> No</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- <button class="boton-menos"><i class="fa-solid fa-minus fa-2xs"></i></button>

 <button class="boton-mas"><i class="fa-solid fa-plus fa-2xs"></i></button> --}}
