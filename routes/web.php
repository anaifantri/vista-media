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
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SignageController;
use App\Http\Controllers\BillboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\VideotronController;
use App\Http\Controllers\VendorContactController;
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
Route::resource('/dashboard/users/users', UserController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/marketing/clients', ClientController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/marketing/contacts', ContactController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/marketing/quotations', QuotationController::class)->middleware(['auth','user_access']);

Route::resource('/dashboard/media/area', AreaController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/media/cities', CityController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/media/products', ProductController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/media/billboards', BillboardController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/media/videotrons', VideotronController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/media/signages', SignageController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/media/sizes', SizeController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/media/leds', LedController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/media/vendors', VendorController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/media/contacts', VendorContactController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/media/vendor-categories', VendorCategoryController::class)->middleware(['auth','user_access']);
Route::get('/showProduct', [ProductController::class,'showProduct'])->middleware(['auth','user_access']);
Route::get('/showVideotron', [VideotronController::class,'showVideotron'])->middleware(['auth','user_access']);
Route::get('/showArea', [AreaController::class,'showArea'])->middleware(['auth','user_access']);
Route::get('/showCity', [CityController::class,'showCity'])->middleware(['auth','user_access']);
Route::get('/showLed', [LedController::class,'showLed'])->middleware(['auth','user_access']);
Route::get('/showContact', [ContactController::class,'showContact'])->middleware(['auth','user_access']);
Route::get('/showSize', [SizeController::class,'showSize'])->middleware(['auth','user_access']);
Route::get('/test', [BillboardController::class,'test'])->middleware(['auth','user_access']);
Route::get('/preview/{id}', [PreviewController::class, 'preview']);
Route::get('/videotron/{id}', [PreviewController::class, 'videotronPreview']);
Route::get('/showQuotation', [QuotationController::class,'showQuotation'])->middleware(['auth','user_access']);
Route::get('/streampdf', [QuotationController::class,'streamPdf'])->middleware(['auth','user_access']);

Route::get('/', function () {
    return view('index',[
        'title' => 'Welcome'
    ]);   
});

Route::get('/dashboard/users/notifications', function () {
    return view('dashboard.users.notifications.index',[
        'title' => 'Notifications'
    ]);   
})->middleware(['auth','user_access']);