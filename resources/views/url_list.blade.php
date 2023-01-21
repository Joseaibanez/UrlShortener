@extends('layouts.main_layout')

@section('content')
<div class="col-md-11 mx-auto">
    <h1 class="text-center display-5 text-light fw-bolder">Lista de Urls</h1>
    <br>
    <div class="table-responsive bg-light">
        <table id="tablaUrls" class="display">
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
                        <td style="width: 20%">{{ $url->original_url }}</td>
                        <td><a href="{{ $url->redirect_url }}">{{ $url->redirect_url }}</a></td>
                        <td>{{ $url->visitas }}</td>
                        <td><a href="{{ url('delete/'.$url->id) }}"><i class="fa fa-trash"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- DATATABLES -->
@section('scripts')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tablaUrls').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });
    });
</script>

@endsection

@endsection
