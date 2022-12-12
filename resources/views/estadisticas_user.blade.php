@extends('layouts.main_layout')

@section('content')
<h1 class="text-center">Estadísticas de {{ Auth::user()->name }}</h1>
<br>
<div class="card-body">
    <h2>Dirección IP: {{ Request::ip(); }}</h2>
    <h2>Correo electrónico: {{ Auth::user()->email }}</h2>
    <h2>Fecha de registro: {{ Auth::user()->created_at }}</h2>
</div>
<div id="contenedorGrafico" class="card-body">
    <h1>{{ $urlsChart->options['chart_title'] }}</h1>
    {!! $urlsChart->renderHtml() !!}
</div>
<br><br><br><br><br><br>

<!-- GRÁFICO -->
@section('scripts')

{!! $urlsChart->renderChartJsLibrary() !!}
{!! $urlsChart->renderJs() !!}

@endsection
<!-- FIN -->

@endsection
<!-- {{ route('short.list') }} -->
