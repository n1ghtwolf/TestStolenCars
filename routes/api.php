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
Route::get('/vehicles/export',[Vehicles::class,'export']);
Route::get('/vehicles/autocomplete',[Vehicles::class,'autoComplete']);

//Route::apiResource('/vehicles', Vehicles::class);
Route::apiResource('/vehicles', Vehicles::class);
//->only([
//        'index', 'show', 'store', 'update', 'destroy'
//]);
Route::post('/vehicles/store',[Vehicles::class,'store']);
Route::post('/vehicles/show_all',[Vehicles::class,'index']);
//Route::get('/vehicles/ordered/{order}',[Vehicles::class,'index']);
//Route::get('/vehicles/filter/{filter}',[Vehicles::class,'index']);
Route::post('/vehicles/keyword',[Vehicles::class,'scopeSearch']);
//Route::get('/vehicles/show/{id}',[Vehicles::class,'show']);