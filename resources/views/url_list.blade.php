@extends('layouts.main_layout')

@section('content')
<h1>Lista de Urls</h1>
<br>
<table id="tablaUrls" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Url Original</th>
            <th>Url Acortada</th>
            <th>Veces visitada</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($urls as $url)
            <tr>
                <td>{{ $url->original_url }}</td>
                <td><a href="{{ $url->redirect_url }}">{{ $url->redirect_url }}</a></td>
                <td>{{ $url->visitas }}</td>
                <td><a href="{{ url('delete/'.$url->id) }}"><i class="fa fa-trash"></i></a></td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- DATATABLES -->
@section('scripts')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tablaUrls').DataTable();
    });
</script>

@endsection

@endsection
