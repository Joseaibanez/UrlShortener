@extends('layouts.main_layout')

@section('content')
<div id="content" style="width: 80%; margin: 0 auto;">
    <h1 class="display-4 text-white fw-bolder" style="text-align: center">ShortLy</h1>
    <br><br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mx-auto">
                <div class="card" style="align-items: center">
                    <h1 style="margin: 20px">Introduce la Url a recortar</h1>
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
    <br>
    <br>
    <div class="col-md-8 mx-auto" style="display: flex; gap: 10px; width: 60%; margin: 0 auto;">
        <div class="card " style="width: 32%">
            <div class="card-body">
                <div style="text-align: center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bar-chart" viewBox="0 0 16 16">
                        <path d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z"/>
                    </svg>
                </div>
                <hr>
                <h3 class="card-title">Estadisticas de usuario</h3>
            </div>
        </div>
        <div class="card " style="width: 32%">
            <div class="card-body">
                <div style="text-align: center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
                        <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/>
                    </svg>
                </div>
                <hr>
                <h3 class="card-title">Perfecto para compartir enlaces</h3>
            </div>
        </div>
        <div class="card " style="width: 32%">
            <div class="card-body">
                <div style="text-align: center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                        <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                        <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                    </svg>
                </div>
                <hr>
                <h3 class="card-title">Funciona con cualquier URL</h3>
            </div>
        </div>
    </div>
    <br><br>
    <div class="col-md-8 mx-auto">
        <div class="card " style="">
            <div class="card-body">
                <h3 class="card-title text-primary"><u>Acortador de URL simple y rapido</u></h3>
                <p class="card-text fs-5">ShortLy permite a los usuarios registrados reducir links de cualquier página, simplemente pega el enlace
                    en el area de texto y pulsa Acortar.</p><br>
                <h3 class="card-title text-primary"><u>No pierdas de vista tus enlaces</u></h3>
                <p class="card-text fs-5">Accede en cualquier momento a todas las URL generadas,
                    mostradas en una cómoda tabla para poder ver la cantidad de veces que han
                    sido visitadas o eliminarlas en cualquier momento.</p>
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
