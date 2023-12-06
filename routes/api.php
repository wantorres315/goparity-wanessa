<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AmortizationController;
use App\Http\Controllers\ProjectController;
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
Route::group(["prefix"=> "amortizations"], function () {
    Route::get('/get_all_amortizations/{query?}', [AmortizationController::class,'get_all_amortizations']);
    Route::get('/getAllPaid', [AmortizationController::class,'getAllPaid']);
    Route::get('/paid/{id}',  [AmortizationController::class,'paid']);
    Route::post('paid_batch',[AmortizationController::class,'paid_batch']);
});
Route::group(["prefix"=> "projects"], function () {
    Route::post("/project_add_value/{id}",[ProjectController::class, 'projectAddValue']);
    Route::get('/{id}',  [ProjectController::class,'getProject']);
});