@extends('app')

@section('content')
<div class="container-flex containerPagina">
    <div class="row w-100 mb-4">
        <div class="col-auto me-auto">
            <h1 class="tituloPagina">Proveedores</h1>
        </div>

        <script>
            $(document).ready(function () {
                $('#tablaProveedores').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json' // Traducción al español
                    }
                });
            });
         </script>

    <table class="table-container table table-striped" id="tablaProveedores">
        <thead>
            <tr>
                <th>ID</th>
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
            <tr class="table-row" onclick="window.location='{{route('perfilProv', $proveedor->id )}}'">
                <td>{{$proveedor->id}}</td>
                <td>{{$proveedor->nif}}</td>
                <td>{{$proveedor->nombre}}</td>
                <td>{{$proveedor->direccion}}</td>
                <td>{{$proveedor->codPostal}}</td>
                <td>{{$proveedor->telefono}}</td>
                <td>{{$proveedor->correo}}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6">No hay Proveedores para esta óptica.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
