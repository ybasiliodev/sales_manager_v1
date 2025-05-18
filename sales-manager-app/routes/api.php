<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('me', [AuthController::class, 'me']);
        Route::get('/sales', [SaleController::class, 'index']);
        Route::get('/sales/seller/{sellerId}', [SaleController::class, 'bySeller']);
        Route::post('/sales', [SaleController::class, 'store']);
        Route::get('/sellers', [SellerController::class, 'index']);
        Route::post('/sellers', [SellerController::class, 'store']);
    });
});
