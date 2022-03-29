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

Route::get('/', [AnimesController::class, 'index']);
Route::get('/admin/animes', [AnimesController::class, 'show']);
Route::get('/admin/animes/criar', [AnimesController::class, 'create']);
Route::post('/admin/animes/criar', [AnimesController::class, 'store']);
Route::post('/admin/animes/remover/{id}', [AnimesController::class, 'delete']);
