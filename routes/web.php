<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LedController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MediaSizeController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\LocationPhotoController;
use App\Http\Controllers\MediaCategoryController;
use App\Http\Controllers\PrintingPriceController;
use App\Http\Controllers\VendorContactController;
use App\Http\Controllers\ClientCategoryController;
use App\Http\Controllers\QuotationOrderController;
use App\Http\Controllers\VendorCategoryController;
use App\Http\Controllers\PrintingProductController;
use App\Http\Controllers\QuotationStatusController;
use App\Http\Controllers\InstallationPriceController;
use App\Http\Controllers\QuotationApprovalController;
use App\Http\Controllers\QuotationCategoryController;
use App\Http\Controllers\QuotationRevisionController;
use App\Http\Controllers\QuotationAgreementController;
use App\Http\Controllers\QuotRevisionStatusController;

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
// Route login - logout --> start
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
// Route login - logout --> end

// Route dashboard --> start
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
// Route dashboard --> end

// Route dashboard->users --> start
Route::resource('/users', UserController::class)->middleware(['auth','user_access']);
// Route dashboard->users --> end

// Route dashboard->marketing->billboard_quotations --> start
Route::resource('/client-categories', ClientCategoryController::class)->middleware(['auth','user_access']);
Route::resource('/clients', ClientController::class)->middleware(['auth','user_access']);
Route::resource('/contacts', ContactController::class)->middleware(['auth','user_access']);
// Route dashboard->marketing->client --> end

Route::resource('/quotation-categories', QuotationCategoryController::class)->middleware(['auth','user_access']);
Route::resource('/quotations', QuotationController::class)->middleware(['auth','user_access']);
Route::get('/quotations/preview/{category}/{id}', [QuotationController::class,'preview']);
Route::get('/quotations/select-location/{category}', [QuotationController::class,'selectLocation']);
Route::get('/quotations/create-quotation/{category}/{type}/{id}/{city}/{area}', [QuotationController::class,'createQuotation']);
Route::get('/quotations/home/{category}', [QuotationController::class,'home']);
Route::resource('/quotation-statuses', QuotationStatusController::class)->middleware(['auth','user_access']);


Route::resource('/quotation-revisions', QuotationRevisionController::class)->middleware(['auth','user_access']);
Route::get('/quotation-revisions/revision/{category}/{id}', [QuotationRevisionController::class,'revision']);
Route::get('/quotation-revisions/preview/{category}/{id}', [QuotationRevisionController::class,'preview']);
Route::resource('/quot-revision-statuses', QuotRevisionStatusController::class)->middleware(['auth','user_access']);

Route::resource('/quotation-approvals', QuotationApprovalController::class)->middleware(['auth','user_access']);
Route::get('/quotation-approvals/show-approvals/{category}/{id}', [QuotationApprovalController::class,'showApprovals']);
Route::resource('/quotation-agreements', QuotationAgreementController::class)->middleware(['auth','user_access']);
Route::get('/quotation-agreements/show-agreements/{category}/{id}', [QuotationAgreementController::class,'showAgreements']);
Route::resource('/quotation-orders', QuotationOrderController::class)->middleware(['auth','user_access']);
Route::get('/quotation-orders/show-orders/{category}/{id}', [QuotationOrderController::class,'showOrders']);

Route::resource('/sales', SaleController::class)->middleware(['auth','user_access']);
Route::get('/sales/home/{category}', [SaleController::class,'home']);
Route::get('/sales/report/{category}', [SaleController::class,'report']);
Route::get('/sales/select-quotation/{category}', [SaleController::class,'selectQuotation']);
Route::get('/sales/create-sales/{category}/{id}', [SaleController::class,'createSales']);
Route::get('/sales/preview/{category}/{id}', [SaleController::class,'preview']);

Route::resource('/companies', CompanyController::class)->middleware(['auth','user_access']);

// Route dashboard->area --> start
Route::resource('/area', AreaController::class)->middleware(['auth','user_access']);
Route::resource('/cities', CityController::class)->middleware(['auth','user_access']);
// Route dashboard->area --> end

Route::resource('/location-photos', LocationPhotoController::class)->middleware(['auth','user_access']);
Route::resource('/media-categories', MediaCategoryController::class)->middleware(['auth','user_access']);
Route::resource('/media-sizes', MediaSizeController::class)->middleware(['auth','user_access']);
Route::resource('/locations', LocationController::class)->middleware(['auth','user_access']);
Route::get('/locations/preview/{category}/{id}', [LocationController::class,'preview']);
Route::get('/locations/create-location/{category}', [LocationController::class,'createLocation']);
Route::get('/locations/home/{category}', [LocationController::class,'home']);

Route::resource('/leds', LedController::class)->middleware(['auth','user_access']);
Route::resource('/vendors', VendorController::class)->middleware(['auth','user_access']);
Route::resource('/vendor-contacts', VendorContactController::class)->middleware(['auth','user_access']);
Route::resource('/vendor-categories', VendorCategoryController::class)->middleware(['auth','user_access']);

Route::resource('/printing-products', PrintingProductController::class)->middleware(['auth','user_access']);
Route::resource('/printing-prices', PrintingPriceController::class)->middleware(['auth','user_access']);
Route::resource('/installation-prices', InstallationPriceController::class)->middleware(['auth','user_access']);

Route::get('/showArea', [AreaController::class,'showArea'])->middleware(['auth','user_access']);
Route::get('/showCity', [CityController::class,'showCity'])->middleware(['auth','user_access']);
Route::get('/showLed', [LedController::class,'showLed'])->middleware(['auth','user_access']);
Route::get('/showContact', [ContactController::class,'showContact'])->middleware(['auth','user_access']);
Route::get('/showClient', [ClientController::class,'showClient'])->middleware(['auth','user_access']);

Route::get('/', function () {
    return view('index',[
        'title' => 'Selamat Datang'
    ]);   
});

Route::get('/dashboard/users/notifications', function () {
    return view('dashboard.users.notifications.index',[
        'title' => 'Notifications'
    ]);   
})->middleware(['auth','user_access']);