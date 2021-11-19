<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProdukController;

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

// Route::get('/', function () {
//     return view('dashboard');
// });


Route::get('/', [AdminController::class, 'dashboard']);

Route::get('/produk', [ProdukController::class, 'produk']);
Route::post('/produk/create', [ProdukController::class, 'create']);
Route::get('/produk/{id}/delete', [ProdukController::class, 'delete']);
Route::get('/produk/edit/{id}', [ProdukController::class, 'edit']);
Route::post('/produk/update', [ProdukController::class, 'update']);