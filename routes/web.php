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

    Route::get('/admin/animes', 'showAnimes')->name('admin_animes');

    Route::get('/admin/animes/criar', 'createAnime')->name('criar_anime');
    Route::post('/admin/animes/criar', 'storeCreateAnime')->name('salvar_anime');

    Route::get('/admin/animes/editar/{id}', 'updateAnime')->name('editar_anime');
    Route::post('/admin/animes/editar/{id}', 'storeUpdateAnime')->name('salvar_anime_editado');

    Route::post('/admin/animes/remover/{id}', 'deleteAnime')->name('remover_anime');
});

Route::controller(SeasonsController::class)
    ->name('seasons.')
    ->prefix('/admin/animes/')
    ->group( function () {
    
    Route::get('criar/temporadas/{id}', 'create')->name('create');
    Route::post('criar/temporadas/{id}', 'storeCreate')->name('store');

    Route::get('editar/temporada/{id}', 'update')->name('update');
    Route::post('editar/temporada/{id}', 'storeUpdate')->name('storeUpdate');

    Route::post('remover/temporada/{id}', 'delete')->name('delete');
});