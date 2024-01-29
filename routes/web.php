<?php

use App\Http\Controllers\ControllerGrade;
use App\Http\Controllers\ControllerTrains;
use Illuminate\Support\Facades\Route;

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
    return view('index');
});

Route::get('/trains/create', [ControllerTrains::class, 'index']);
Route::post('/trains/create', [ControllerTrains::class, 'create']);
Route::get('/trains/update/{id}', [ControllerTrains::class, 'view']);
Route::post('/trains/update/{id}', [ControllerTrains::class, 'update']);
Route::get('/trains/delete/{id}', [ControllerTrains::class, 'confirm']);
Route::post('/trains/delete/{id}', [ControllerTrains::class, 'delete']);

Route::get('/grade/create', [ControllerGrade::class, 'index']);
Route::post('/grade/create', [ControllerGrade::class, 'create']);
Route::get('/grade/update/{id}', [ControllerGrade::class, 'view']);
Route::post('/grade/update/{id}', [ControllerGrade::class, 'update']);
Route::get('/grade/delete/{id}', [ControllerGrade::class, 'confirm']);
Route::post('/grade/delete/{id}', [ControllerGrade::class, 'delete']);