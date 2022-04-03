<?php

use App\Http\Controllers\{AnimesController, SeasonsController};
use Illuminate\Support\Facades\Route;

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

Route::controller(AnimesController::class)->group( function () {
    Route::get('/', 'index')->name('index');
});

Route::controller(AnimesController::class)
    ->prefix('/admin/animes')
    ->group( function () {

    Route::get('/', 'showAnimes')->name('admin_animes');

    Route::get('/criar', 'createAnime')->name('criar_anime');
    Route::post('/criar', 'storeCreateAnime')->name('salvar_anime');

    Route::get('/editar/{id}', 'updateAnime')->name('editar_anime');
    Route::post('/editar/{id}', 'storeUpdateAnime')->name('salvar_anime_editado');

    Route::post('/remover/{id}', 'deleteAnime')->name('remover_anime');
});

Route::controller(SeasonsController::class)
    ->name('seasons.')
    ->prefix('/admin/animes')
    ->group( function () {
    
    Route::get('/criar/temporadas/{id}', 'create')->name('create');
    Route::post('/criar/temporadas/{id}', 'storeCreate')->name('store');

    Route::get('/editar/temporada/{id}', 'update')->name('update');
    Route::post('/editar/temporada/{id}', 'storeUpdate')->name('storeUpdate');

    Route::post('/remover/temporada/{id}', 'delete')->name('delete');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
