<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JewelryItemcController;
use App\Http\Controllers\GemsController;

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

Route::get('/gems/search/{barcode}', [GemsController::class, 'search']);

