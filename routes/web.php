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
foreach($shortenedUrls as $url) {
    Route::redirect($url->url_key, $url->original_url, 301);
}

Route::get('/', [MainController::class, 'inicio'])->name('inicio');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Urls por usuario
Route::get('/url_list', [UrlShorterController::class, 'listUrls'])->name('short.list');
// Fin
Route::post('/short', [UrlShorterController::class, 'short'])->name('short.url');
