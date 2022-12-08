@extends('layouts.main_layout')

@section('content')
<h1>Estadísticas</h1>
<br>
<b>CONTENIDO QUE AÚN TENGO QUE METER...</b>
<div id="contenedorGrafico" class="card-body">
    <h1>{{ $urlsChart->options['chart_title'] }}</h1>
    {!! $urlsChart->renderHtml() !!}
</div>

<!-- GRÁFICO -->
@section('scripts')

{!! $urlsChart->renderChartJsLibrary() !!}
{!! $urlsChart->renderJs() !!}

@endsection
<!-- FIN -->

@endsection
<!-- {{ route('short.list') }} -->
