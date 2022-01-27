<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\ProductAjaxController;
use App\Http\Controllers\RoutingController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('buyers', BuyerController::class);
Route::resource('ajaxproducts',ProductAjaxController::class);
// Route::get('/product/cetak_pdf', [ProductAjaxController::class,'cetak_pdf']);
Route::get('/product/pdf', [ProductAjaxController::class, 'cetak_pdf']);
Route::get('/export', [BuyerController::class, 'export'])->name('export');

Route::get('routings', [RoutingController::class, 'index']);
Route::post('import-routings', [RoutingController::class, 'import']);
Route::get('export-routings', [RoutingController::class, 'export']);
