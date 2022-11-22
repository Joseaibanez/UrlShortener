<?php

use App\Models\UrlShorter;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UrlShorterController;
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
$urlList = UrlShorter::all();

foreach($urlList as $list) {
    //Hacer algo
    Route::redirect($list->url_key, $list->url_redirect, 301);
}
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', [MainController::class, 'inicio'])->name('inicio');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/short', [UrlShorterController::class, 'short'])->name('short.url');
