@extends('layouts.main_layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mx-auto">
            <div class="card" style="align-items: center">
                <h1>Introduce la Url a recortar</h1>
                <div class="card-body">
                    @if (session('success_message'))
                        {!! session('success_message') !!}
                    @endif
                    <form action="{{ route('short.url') }}" method="post">
                        <div id="formurl">
                        <input type="url" maxlength="100" name="original_url" placeholder="Introduce la URL aquí...">
                        @csrf
                        <input type="submit" value="Acortar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- COPIAR AL BORRADOR -->
@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/clipboard@1/dist/clipboard.min.js"></script>

<script type="text/javascript">
    var Clipboard = new Clipboard('.copyBtn');
</script>

@endsection

@endsection
