<?php

use App\Http\Controllers\AnimesController;
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

Route::get('/', [AnimesController::class, 'index'])
    ->name('index');
Route::get('/admin/animes', [AnimesController::class, 'show'])
    ->name('admin_animes');
Route::get('/admin/animes/criar', [AnimesController::class, 'create'])
    ->name('criar_anime');
Route::post('/admin/animes/criar', [AnimesController::class, 'store'])
    ->name('salvar_anime');
Route::get('/admin/animes/criar/temporadas/{id}', [AnimesController::class, 'createSeasons'])
    ->name('criar_temporadas');
Route::post('/admin/animes/remover/{id}', [AnimesController::class, 'delete'])
    ->name('deletar_anime');
