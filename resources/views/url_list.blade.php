@extends('layouts.main_layout')

@section('content')
<h1>Lista de Urls</h1>
<br>
<table id="tablaUrls" class="table table-striped">
    <thead class="bg-secondary text-white">
        <tr>
            <th>Url Original</th>
            <th>Url Acortada</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($urls as $url)
            <tr>
                <td>{{ $url->original_url }}</td>
                <td>{{ $url->redirect_url }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- DATATABLES -->
@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript src = "https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" defer ></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
<script >
    $(document).ready(function () {
        $('#tablaUrls').DataTable();
    });
</script>
@endsection

@endsection
