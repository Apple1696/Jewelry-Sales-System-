<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\JewelryItemcController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    
});

Route::post('/login', [AuthController::class, 'login']);

Route::get('/items', [JewelryItemcController::class, 'index']);

Route::get('/items/statistic-by-category', [JewelryItemcController::class, 'statistic']);

Route::get('/items/{id}', [JewelryItemcController::class, 'show']);

Route::post('/items/{id}', [JewelryItemcController::class, 'update']);

// Order routes
Route::get('/orders', [OrderController::class, 'index']);
Route::post('/orders', [OrderController::class, 'store']);
Route::put('/orders/{id}', [OrderController::class, 'update']);
Route::delete('/orders/{id}', [OrderController::class, 'destroy']);

//Invoice
Route::get('/invoices', [InvoiceController::class,'index']);
Route::get('/invoices/{id}', [InvoiceController::class,'show']);
Route::post('/invoices', [InvoiceController::class,'create']);
Route::put('/invoices/{id}', [InvoiceController::class,'update']);
Route::delete('/invoices/{id}', [InvoiceController::class,'destroy']);