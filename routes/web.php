<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecordController;





Route::get('/', function () {
    return view('welcome');
});



Route::get('/test', [TestController::class, 'firstAction'] );

Route::get('/companies', [CompanyController::class, 'index']);

Route::get('/lines/{company_id}', [LineController::class, 'getLines']);
Route::get('/machines/{line_id}', [MachineController::class, 'getMachines']);
Route::get('/products/{line_id}', [ProductController::class, 'getProducts']);


Route::post('/oee-activation', [RecordController::class, 'store']);

