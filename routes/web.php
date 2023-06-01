<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LedController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SignageController;
use App\Http\Controllers\BillboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VideotronController;
use App\Http\Controllers\VendorCategoryController;
use App\Http\Controllers\ProductCategoryController;

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
Route::resource('/dashboard/users/users', UserController::class)->middleware('auth');
Route::resource('/dashboard/marketing/clients', ClientController::class)->middleware('auth');
Route::resource('/dashboard/marketing/contacts', ContactController::class)->middleware('auth');

Route::resource('/dashboard/media/area', AreaController::class)->middleware('auth');
Route::resource('/dashboard/media/cities', CityController::class)->middleware('auth');
Route::resource('/dashboard/media/products', ProductController::class)->middleware('auth');
Route::resource('/dashboard/media/billboards', BillboardController::class)->middleware('auth');
Route::resource('/dashboard/media/videotrons', VideotronController::class)->middleware('auth');
Route::resource('/dashboard/media/signages', SignageController::class)->middleware('auth');
Route::resource('/dashboard/media/sizes', SizeController::class)->middleware('auth');
Route::resource('/dashboard/media/product-categories', ProductCategoryController::class)->middleware('auth');
Route::resource('/dashboard/media/leds', LedController::class)->middleware('auth');
Route::resource('/dashboard/media/vendors', VendorController::class)->middleware('auth');
Route::resource('/dashboard/media/vendor-categories', VendorCategoryController::class)->middleware('auth');
Route::get('/dashboard/media/billboards/preview', [ProductController::class,'preview'])->middleware('auth');
Route::get('/showProduct', [ProductController::class,'showProduct'])->middleware('auth');
Route::get('/showArea', [AreaController::class,'showArea'])->middleware('auth');
Route::get('/showCity', [CityController::class,'showCity'])->middleware('auth');
Route::get('/showSize', [SizeController::class,'showSize'])->middleware('auth');
Route::get('/test', [BillboardController::class,'test'])->middleware('auth');

Route::get('/dashboard/media', function () {
    return view('dashboard.media.index');   
})->middleware('auth');

Route::get('/dashboard/notifications', function () {
    return view('dashboard.users.notifications.index',[
        'title' => 'Daftar Signage'
    ]);   
})->middleware('auth');