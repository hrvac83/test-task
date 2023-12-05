<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CryptocurrencyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [CryptocurrencyController::class, 'index'])->name('index');
Route::get('/top10', [CryptocurrencyController::class, 'top10List'])->name('top10');
Route::get('/{id}', [CryptocurrencyController::class, 'edit'])->name('edit');
Route::patch('/{id}', [CryptocurrencyController::class, 'updatePrice'])->name('update');
