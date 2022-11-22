@extends('layouts.main_layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mx-auto">
            <div class="card" style="align-items: center">
                <h1>Introduce la Url a recortar</h1>
                <div class="card-body">
                    <form action="{{ route('short.url') }}" method="post">
                        <div id="formurl">
                        <input type="url" name="original_url" placeholder="Introduce la URL aquí...">
                        @csrf
                        <input type="submit" value="Acortar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
