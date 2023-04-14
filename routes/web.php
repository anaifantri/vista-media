<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::resource('/dashboard/users', UserController::class)->middleware('auth');
Route::resource('/dashboard/clients', ClientController::class)->middleware('auth');
Route::resource('/dashboard/contacts', ContactController::class)->middleware('auth');

Route::resource('/dashboard/media/area', AreaController::class)->middleware('auth');
Route::resource('/dashboard/media/cities', CityController::class)->middleware('auth');
Route::get('/showArea', [CityController::class,'showArea']);

Route::get('/dashboard/media', function () {
    return view('dashboard.media.index');   
});
