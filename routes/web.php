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
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MediaSizeController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\SalesDataController;
use App\Http\Controllers\ClientOrderController;
use App\Http\Controllers\SaleCategoryController;
use App\Http\Controllers\LocationPhotoController;
use App\Http\Controllers\MediaCategoryController;
use App\Http\Controllers\PrintingPriceController;
use App\Http\Controllers\VendorContactController;
use App\Http\Controllers\ClientApprovalController;
use App\Http\Controllers\ClientCategoryController;
use App\Http\Controllers\QuotationOrderController;
use App\Http\Controllers\VendorCategoryController;
use App\Http\Controllers\ClientAgreementController;
use App\Http\Controllers\PrintingProductController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\QuotationStatusController;
use App\Http\Controllers\PrintInstallSaleController;
use App\Http\Controllers\SignageQuotationController;
use App\Http\Controllers\InstallationPriceController;
use App\Http\Controllers\PrintInstallOrderController;
use App\Http\Controllers\QuotationApprovalController;
use App\Http\Controllers\QuotationCategoryController;
use App\Http\Controllers\QuotationRevisionController;
use App\Http\Controllers\SignageQuotStatusController;
use App\Http\Controllers\BillboardQuotationController;
use App\Http\Controllers\PrintInstallStatusController;
use App\Http\Controllers\QuotationAgreementController;
use App\Http\Controllers\QuotRevisionStatusController;
use App\Http\Controllers\VideotronQuotationController;
use App\Http\Controllers\BillboardQuotStatusController;
use App\Http\Controllers\SignageQuotRevisionController;
use App\Http\Controllers\VideotronQuotStatusController;
use App\Http\Controllers\PrintInstallApprovalController;
use App\Http\Controllers\PrintInstalQuotationController;
use App\Http\Controllers\BillboardQuotRevisionController;
use App\Http\Controllers\VideotronQuotRevisionController;

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
Route::get('/quotations/create-quotation/{category}/{id}/{city}/{area}', [QuotationController::class,'createQuotation']);
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

Route::resource('/sales-data', SalesDataController::class)->middleware(['auth','user_access']);
Route::get('/sales-data/home/{category}', [SalesDataController::class,'home']);
Route::get('/sales-data/select-quotation/{category}', [SalesDataController::class,'selectQuotation']);
Route::get('/sales-data/create-sales/{category}/{id}', [SalesDataController::class,'createSales']);
Route::get('/sales-data/preview/{category}/{id}', [SalesDataController::class,'preview']);

// Route dashboard->marketing->billboard_quotations --> start
Route::resource('/dashboard/marketing/billboard-quotations', BillboardQuotationController::class)->middleware(['auth','user_access']);
Route::get('/dashboard/marketing/billboard-quotations/preview/{id}', [BillboardQuotationController::class, 'preview']);
Route::resource('/dashboard/marketing/billboard-quot-revisions', BillboardQuotRevisionController::class)->middleware(['auth','user_access']);
Route::get('/dashboard/marketing/quotation-revisions/revision/{number}', [BillboardQuotRevisionController::class, 'revision'])->middleware(['auth','user_access']);
Route::get('/dashboard/marketing/quotation-revisions/preview/{id}', [BillboardQuotRevisionController::class, 'preview']);
Route::resource('/dashboard/marketing/billboard-quot-statuses', BillboardQuotStatusController::class)->middleware(['auth','user_access']);
// Route dashboard->marketing->billboard_quotations --> end

// Route dashboard->marketing->videotron_quotations --> start
Route::resource('/dashboard/marketing/videotron-quot-statuses', VideotronQuotStatusController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/marketing/videotron-quotations', VideotronQuotationController::class)->middleware(['auth','user_access']);
Route::get('/dashboard/marketing/videotron-quotations/create-quotations/{id}', [VideotronQuotationController::class, 'createQuotation'])->middleware(['auth','user_access']);
Route::get('/dashboard/marketing/videotron-quotations/preview/{id}', [VideotronQuotationController::class, 'preview']);
Route::resource('/dashboard/marketing/videotron-quot-revisions', VideotronQuotRevisionController::class)->middleware(['auth','user_access']);
Route::get('/dashboard/marketing/videotron-quot-revisions/revision/{number}', [VideotronQuotRevisionController::class, 'revision'])->middleware(['auth','user_access']);
Route::get('/dashboard/marketing/videotron-quot-revisions/preview/{id}', [VideotronQuotRevisionController::class, 'preview']);
// Route dashboard->marketing->videotron_quotations --> end

// Route dashboard->marketing->signage_quotations --> start
Route::resource('/dashboard/marketing/signage-quotations', SignageQuotationController::class)->middleware(['auth','user_access']);
Route::get('/dashboard/marketing/signage-quotations/create-quotations/{id}/{area}/{city}', [SignageQuotationController::class, 'createQuotation'])->middleware(['auth','user_access']);
Route::get('/dashboard/marketing/signage-quotations/preview/{id}', [SignageQuotationController::class, 'preview']);
Route::resource('/dashboard/marketing/signage-quot-statuses', SignageQuotStatusController::class)->middleware(['auth','user_access']);
// Route dashboard->marketing->signage_quotations --> end

// Route dashboard->marketing->signage_quot_revisions --> start
Route::resource('/dashboard/marketing/signage-quot-revisions', SignageQuotRevisionController::class)->middleware(['auth','user_access']);
Route::get('/dashboard/marketing/signage-quot-revisions/revision/{number}', [SignageQuotRevisionController::class, 'revision'])->middleware(['auth','user_access']);
Route::get('/dashboard/marketing/signage-quot-revisions/preview/{id}', [SignageQuotRevisionController::class, 'preview']);
// Route dashboard->marketing->signage_quot_revisions --> end

// Route dashboard->marketing->print_install_quotations --> end
Route::resource('/dashboard/marketing/print-instal-quotations', PrintInstalQuotationController::class)->middleware(['auth','user_access']);
Route::get('/dashboard/marketing/print-instal-quotations/preview/{id}', [PrintInstalQuotationController::class, 'preview']);
Route::get('/dashboard/marketing/print-instal-quotations/create-quotations/{id}', [PrintInstalQuotationController::class, 'createQuotation']);
Route::resource('/dashboard/marketing/print-install-statuses', PrintInstallStatusController::class)->middleware(['auth','user_access']);
// Route dashboard->marketing->print_install_quotations --> end

Route::resource('/dashboard/marketing/print-install-sales', PrintInstallSaleController::class)->middleware(['auth','user_access']);
Route::get('/dashboard/marketing/print-install-sales/create-sales/{id}', [PrintInstallSaleController::class, 'createSales'])->middleware(['auth','user_access']);
Route::get('/dashboard/marketing/print-install-sales/preview/{id}', [PrintInstallSaleController::class, 'preview'])->middleware(['auth','user_access']);
Route::resource('/dashboard/marketing/sales', SaleController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/marketing/sale-categories', SaleCategoryController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/marketing/client-approvals', ClientApprovalController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/marketing/client-orders', ClientOrderController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/marketing/client-agreements', ClientAgreementController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/marketing/print-install-orders', PrintInstallOrderController::class)->middleware(['auth','user_access']);

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
Route::resource('/dashboard/media/installation-prices', InstallationPriceController::class)->middleware(['auth','user_access']);

Route::get('/showArea', [AreaController::class,'showArea'])->middleware(['auth','user_access']);
Route::get('/showCity', [CityController::class,'showCity'])->middleware(['auth','user_access']);
Route::get('/showLed', [LedController::class,'showLed'])->middleware(['auth','user_access']);
Route::get('/showContact', [ContactController::class,'showContact'])->middleware(['auth','user_access']);
Route::get('/showClient', [ClientController::class,'showClient'])->middleware(['auth','user_access']);
Route::get('/showQuotation', [QuotationController::class,'showQuotation'])->middleware(['auth','user_access']);
Route::get('/showBillboardQuotation', [BillboardQuotationController::class,'showBillboardQuotation'])->middleware(['auth','user_access']);
Route::get('/showBillboardQuotRevision', [BillboardQuotRevisionController::class,'showBillboardQuotRevision'])->middleware(['auth','user_access']);
Route::get('/showClientApproval', [ClientApprovalController::class,'showClientApproval'])->middleware(['auth','user_access']);
Route::get('/showClientOrder', [ClientOrderController::class,'showClientOrder'])->middleware(['auth','user_access']);
Route::get('/showClientAgreement', [ClientAgreementController::class,'showClientAgreement'])->middleware(['auth','user_access']);
Route::get('/showSale', [SaleController::class,'showSale'])->middleware(['auth','user_access']);
Route::get('/sales/preview/', [SaleController::class,'preview'])->middleware(['auth','user_access']);
Route::get('/sales/reports/', [SaleController::class,'reports'])->middleware(['auth','user_access']);
Route::get('/showPrintProduct', [PrintingProductController::class,'showPrintProduct'])->middleware(['auth','user_access']);
Route::get('/showPrintPrice', [PrintingPriceController::class,'showPrintPrice'])->middleware(['auth','user_access']);
Route::get('/printInstallApproval', [PrintInstallApprovalController::class,'printInstallApproval'])->middleware(['auth','user_access']);
Route::get('/printInstallOrder', [PrintInstallOrderController::class,'printInstallOrder'])->middleware(['auth','user_access']);

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