@extends('layouts.main_layout')

@section('content')
<h1 class="text-center display-5 text-light fw-bolder">Estadísticas de {{ Auth::user()->name }}</h1>
<br>
<div class="col-md-7 mx-auto" style="margin-top: 20px; width: 80%; display: flex; gap: 10px;">
    <div class="card" style="width: 25%; height: 20%">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Dirección IP: {{ Request::ip(); }}</li>
            <li class="list-group-item">Correo electrónico: {{ Auth::user()->email }}</li>
            <li class="list-group-item">Fecha de registro: {{ Auth::user()->created_at }}</li>
            <li class="list-group-item"><a class="btn btn-warning" href="{{ url('deleteUser/'.Auth::user()->email) }}" onclick="return confirm('Tu usuario se eliminará de forma permanente ¿Estás seguro?')">Eliminar Cuenta</a></li>
        </ul>
    </div>
    <br>
    <div id="contenedorGrafico" class="card-body bg-light" style="width: 60%;">
        {!! $urlsChart->renderHtml() !!}
    </div>
</div>

<!-- GRÁFICO -->
@section('scripts')

{!! $urlsChart->renderChartJsLibrary() !!}
{!! $urlsChart->renderJs() !!}

@endsection
<!-- FIN -->

@endsection
<!-- {{ route('short.list') }} -->
