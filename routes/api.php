<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vehicles;

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

Route::prefix('/vehicles')->group(function () {
    Route::controller(Vehicles::class)->group(function () {
        Route::post('/export','export');
        Route::get('/autocomplete','autoComplete');
        Route::post('/store','store');
        Route::post('/update','update');
        Route::get('/destroy','destroy');
        Route::get('/','index');
        Route::get('/{id}','show');
        Route::post('/keyword','scopeSearch');
    });
});
