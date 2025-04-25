@extends('app')

@section('content')
<div class="container-flex containerPagina">
    <div class="row w-100 mb-4">
        <div class="col-auto me-auto">
            <h1 class="tituloPagina">Resumen</h1>
        </div>
        <div class="col d-flex justify-content-end">
            <a href="{{url('propietario/proveedores')}}"><i class="fa-solid fa-x fa-lg"></i></a>
        </div>
    </div>
</div>

@endsection
