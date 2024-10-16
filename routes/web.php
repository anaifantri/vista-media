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
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MediaSizeController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\PrintOrderController;
use App\Http\Controllers\InstallOrderController;
use App\Http\Controllers\LandDocumentController;
use App\Http\Controllers\LandAgreementController;
use App\Http\Controllers\LocationPhotoController;
use App\Http\Controllers\MediaCategoryController;
use App\Http\Controllers\PrintingPriceController;
use App\Http\Controllers\VendorContactController;
use App\Http\Controllers\ClientCategoryController;
use App\Http\Controllers\QuotationOrderController;
use App\Http\Controllers\VendorCategoryController;
use App\Http\Controllers\LicenseDocumentController;
use App\Http\Controllers\PrintingProductController;
use App\Http\Controllers\QuotationStatusController;
use App\Http\Controllers\InstallationPriceController;
use App\Http\Controllers\LicensingCategoryController;
use App\Http\Controllers\QuotationApprovalController;
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

// Route users --> start
Route::resource('/users', UserController::class)->middleware(['auth','user_access']);
// Route users --> end

// Marketing Group --> start
// Route Client --> start
Route::resource('/marketing/client-categories', ClientCategoryController::class)->middleware(['auth','user_access']);
Route::resource('/marketing/clients', ClientController::class)->middleware(['auth','user_access']);
Route::resource('/marketing/contacts', ContactController::class)->middleware(['auth','user_access']);
// Route Client --> end

// Route Vendor --> start
Route::resource('/marketing/vendors', VendorController::class)->middleware(['auth','user_access']);
Route::resource('/marketing/vendor-contacts', VendorContactController::class)->middleware(['auth','user_access']);
Route::resource('/marketing/vendor-categories', VendorCategoryController::class)->middleware(['auth','user_access']);
// Route Vendor --> end

// Route Quotations --> start
Route::resource('/marketing/quotations', QuotationController::class)->middleware(['auth','user_access']);
Route::get('/marketing/quotations/preview/{category}/{id}', [QuotationController::class,'preview']);
Route::get('/marketing/quotations/select-location/{category}', [QuotationController::class,'selectLocation']);
Route::get('/marketing/quotations/create-quotation/{category}/{type}/{id}/{city}/{area}', [QuotationController::class,'createQuotation']);
Route::get('/marketing/quotations/home/{category}', [QuotationController::class,'home']);
Route::resource('/marketing/quotation-statuses', QuotationStatusController::class)->middleware(['auth','user_access']);
// Route Quotations --> end

// Route Quotation Revisions --> start
Route::resource('/marketing/quotation-revisions', QuotationRevisionController::class)->middleware(['auth','user_access']);
Route::get('/marketing/quotation-revisions/revision/{category}/{id}', [QuotationRevisionController::class,'revision']);
Route::get('/marketing/quotation-revisions/preview/{category}/{id}', [QuotationRevisionController::class,'preview']);
Route::resource('/marketing/quot-revision-statuses', QuotRevisionStatusController::class)->middleware(['auth','user_access']);
// Route Quotation Revisions --> end

// Route Quotation Documents --> start
Route::resource('/marketing/quotation-approvals', QuotationApprovalController::class)->middleware(['auth','user_access']);
Route::get('/marketing/quotation-approvals/show-approvals/{category}/{id}', [QuotationApprovalController::class,'showApprovals']);
Route::resource('/marketing/quotation-agreements', QuotationAgreementController::class)->middleware(['auth','user_access']);
Route::get('/marketing/quotation-agreements/show-agreements/{category}/{id}', [QuotationAgreementController::class,'showAgreements']);
Route::resource('/marketing/quotation-orders', QuotationOrderController::class)->middleware(['auth','user_access']);
Route::get('/marketing/quotation-orders/show-orders/{category}/{id}', [QuotationOrderController::class,'showOrders']);
// Route Quotation Documents --> end

// Route Sales --> start
Route::resource('/marketing/sales', SaleController::class)->middleware(['auth','user_access']);
Route::get('/marketing/sales/home/{category}', [SaleController::class,'home'])->middleware(['auth','user_access']);
Route::get('/marketing/sales/report/{category}', [SaleController::class,'report'])->middleware(['auth','user_access']);
Route::get('/marketing/sales/select-quotation/{category}', [SaleController::class,'selectQuotation'])->middleware(['auth','user_access']);
Route::get('/marketing/sales/create-sales/{category}/{id}', [SaleController::class,'createSales'])->middleware(['auth','user_access']);
Route::get('/marketing/sales/preview/{category}/{id}', [SaleController::class,'preview'])->middleware(['auth','user_access']);
// Route Sales --> end

// Route Service --> start
Route::resource('/marketing/printing-products', PrintingProductController::class)->middleware(['auth','user_access']);
Route::resource('/marketing/printing-prices', PrintingPriceController::class)->middleware(['auth','user_access']);
Route::resource('/marketing/installation-prices', InstallationPriceController::class)->middleware(['auth','user_access']);
Route::resource('/marketing/install-orders', InstallOrderController::class)->middleware(['auth','user_access']);
Route::resource('/marketing/print-orders', PrintOrderController::class)->middleware(['auth','user_access']);
Route::get('/print-orders/select-locations', [PrintOrderController::class,'selectLocations'])->middleware(['auth','user_access']);
Route::get('/print-orders/create-order/{id}/{type}', [PrintOrderController::class,'createOrder'])->middleware(['auth','user_access']);
Route::get('/marketing/print-orders/preview/{id}', [PrintOrderController::class,'preview'])->middleware(['auth','user_access']);
// Route Service --> end
// Marketing Group --> end

// Media Group --> start
Route::resource('/media/companies', CompanyController::class)->middleware(['auth','user_access']);
Route::resource('/media/leds', LedController::class)->middleware(['auth','user_access']);

// Route Area & City --> start
Route::resource('/media/area', AreaController::class)->middleware(['auth','user_access']);
Route::resource('/media/cities', CityController::class)->middleware(['auth','user_access']);
// Route Area & City --> end

// Route Location --> start
Route::resource('/media/location-photos', LocationPhotoController::class)->middleware(['auth','user_access']);
Route::resource('/media/media-categories', MediaCategoryController::class)->middleware(['auth','user_access']);
Route::resource('/media/media-sizes', MediaSizeController::class)->middleware(['auth','user_access']);
Route::resource('/media/locations', LocationController::class)->middleware(['auth','user_access']);
Route::get('/media/locations/preview/{category}/{id}', [LocationController::class,'preview']);
Route::get('/media/locations/create-location/{category}', [LocationController::class,'createLocation']);
Route::get('/media/locations/home/{category}', [LocationController::class,'home']);
// Route Location --> end

// Route Legality --> start
Route::resource('/media/licensing-categories', LicensingCategoryController::class)->middleware(['auth','user_access']);
Route::resource('/media/land-agreements', LandAgreementController::class)->middleware(['auth','user_access']);
Route::resource('/media/licenses', LicenseController::class)->middleware(['auth','user_access']);
Route::resource('/media/license-documents', LicenseDocumentController::class)->middleware(['auth','user_access']);
Route::resource('/media/land-documents', LandDocumentController::class)->middleware(['auth','user_access']);
// Route Legality --> end
// Media Group --> end

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