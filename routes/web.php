<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\UrlShorterController;
use App\Models\Shorter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
/ Crear las redirecciones
/ el 301 indica una redireccion
/ permanente
*/
$shortenedUrls = Shorter::all();
// Aumentar contador
    \DB::table('shorters')
            ->where("redirect_url", "=", url()->current())
            ->update([
                'visitas' => \DB::raw('visitas + 1'),
            ]);
    // Fin
foreach($shortenedUrls as $url) {

    Route::redirect('redirect/'.$url->url_key, $url->original_url);
}

// Aumentar el contador de visitas
Route::get('redirect/{key}', [UrlShorterController::class, 'countVisit']);
// Rutas
Route::get('/', [MainController::class, 'inicio'])->name('inicio');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('delete/{key}', [UrlShorterController::class, 'deleteUrl']);
// Urls por usuario
Route::get('/url_list', [UrlShorterController::class, 'listUrls'])->name('short.list');
// Estadisticas de una url
Route::get('stats/{id}', [UrlShorterController::class, 'showStatistics']);
// Acortar Url
Route::post('/short', [UrlShorterController::class, 'short'])->name('short.url');

