<?php

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
    return view('welcome');
});

Route::post('/1', [\App\Http\Controllers\UserController::class, 'findUser']);
Route::post('/2', [\App\Http\Controllers\UserController::class, 'refillBalance']);
Route::post('/3', [\App\Http\Controllers\UserController::class, 'addPhoneForUser']);
Route::post('/4', [\App\Http\Controllers\UserController::class, 'deleteUser']);
