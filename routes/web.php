<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LedController;
use App\Http\Controllers\CompanyController;
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
use App\Http\Controllers\SignageCategoryController;
use App\Http\Controllers\BillboardController;
use App\Http\Controllers\BillboardPhotoController;
use App\Http\Controllers\BillboardCategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\BillboardQuotationController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleCategoryController;
use App\Http\Controllers\BillboardQuotRevisionController;
use App\Http\Controllers\BillboardQuotStatusController;
use App\Http\Controllers\VideotronController;
use App\Http\Controllers\VendorContactController;
use App\Http\Controllers\VendorCategoryController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ClientApprovalController;
use App\Http\Controllers\ClientOrderController;
use App\Http\Controllers\ClientAgreementController;
use App\Http\Controllers\PrintingProductController;
use App\Http\Controllers\PrintingPriceController;
use App\Http\Controllers\InstallationPriceController;
use App\Http\Controllers\PrintInstalQuotationController;
use App\Http\Controllers\PrintInstallStatusController;
use App\Http\Controllers\PrintInstallSaleController;
use App\Http\Controllers\PrintInstallApprovalController;
use App\Http\Controllers\PrintInstallOrderController;

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
Route::resource('/dashboard/marketing/billboard-quotations', BillboardQuotationController::class)->middleware(['auth','user_access']);
Route::get('/dashboard/marketing/billboard-quotations/preview/{id}', [BillboardQuotationController::class, 'preview']);
Route::resource('/dashboard/marketing/billboard-quot-revisions', BillboardQuotRevisionController::class)->middleware(['auth','user_access']);
Route::get('/dashboard/marketing/quotation-revisions/revision/{number}', [BillboardQuotRevisionController::class, 'revision'])->middleware(['auth','user_access']);
Route::get('/dashboard/marketing/quotation-revisions/preview/{id}', [BillboardQuotRevisionController::class, 'preview']);
Route::resource('/dashboard/marketing/billboard-quot-statuses', BillboardQuotStatusController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/marketing/print-instal-quotations', PrintInstalQuotationController::class)->middleware(['auth','user_access']);
Route::get('/dashboard/marketing/print-instal-quotations/preview/{id}', [PrintInstalQuotationController::class, 'preview']);
Route::get('/dashboard/marketing/print-instal-quotations/create-quotations/{id}', [PrintInstalQuotationController::class, 'createQuotation']);
Route::resource('/dashboard/marketing/print-install-statuses', PrintInstallStatusController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/marketing/print-install-sales', PrintInstallSaleController::class)->middleware(['auth','user_access']);
Route::get('/dashboard/marketing/print-install-sales/create-sales/{id}', [PrintInstallSaleController::class, 'createSales'])->middleware(['auth','user_access']);
Route::get('/dashboard/marketing/print-install-sales/preview/{id}', [PrintInstallSaleController::class, 'preview'])->middleware(['auth','user_access']);
Route::resource('/dashboard/marketing/sales', SaleController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/marketing/sale-categories', SaleCategoryController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/marketing/client-approvals', ClientApprovalController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/marketing/client-orders', ClientOrderController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/marketing/client-agreements', ClientAgreementController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/marketing/print-install-orders', PrintInstallOrderController::class)->middleware(['auth','user_access']);

Route::resource('/dashboard/media/companies', CompanyController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/media/area', AreaController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/media/cities', CityController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/media/products', ProductController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/media/billboards', BillboardController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/media/billboard-categories', BillboardCategoryController::class)->middleware(['auth','user_access']);
Route::get('/dashboard/media/billboards/preview/{id}', [BillboardController::class,'preview']);
Route::get('/dashboard/media/billboards/pdf-preview/{id}', [BillboardController::class,'pdfPreview'])->middleware(['auth','user_access']);
Route::resource('/dashboard/media/videotrons', VideotronController::class)->middleware(['auth','user_access']);
Route::get('/dashboard/media/videotrons/preview/{id}', [VideotronController::class,'preview']);
Route::get('/dashboard/media/videotrons/pdf-preview/{id}', [VideotronController::class,'pdfPreview'])->middleware(['auth','user_access']);
Route::resource('/dashboard/media/signages', SignageController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/media/signage-categories', SignageCategoryController::class)->middleware(['auth','user_access']);
Route::get('/dashboard/media/signages/preview/{id}', [SignageController::class,'preview']);
Route::get('/dashboard/media/signages/pdf-preview/{id}', [SignageController::class,'pdfPreview'])->middleware(['auth','user_access']);
Route::resource('/dashboard/media/sizes', SizeController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/media/leds', LedController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/media/vendors', VendorController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/media/contacts', VendorContactController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/media/vendor-categories', VendorCategoryController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/media/printing-products', PrintingProductController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/media/printing-prices', PrintingPriceController::class)->middleware(['auth','user_access']);
Route::resource('/dashboard/media/installation-prices', InstallationPriceController::class)->middleware(['auth','user_access']);
Route::get('/showProduct', [ProductController::class,'showProduct'])->middleware(['auth','user_access']);
Route::get('/showBillboard', [BillboardController::class,'showBillboard'])->middleware(['auth','user_access']);
Route::get('/showVideotron', [VideotronController::class,'showVideotron'])->middleware(['auth','user_access']);
Route::get('/showArea', [AreaController::class,'showArea'])->middleware(['auth','user_access']);
Route::get('/showCity', [CityController::class,'showCity'])->middleware(['auth','user_access']);
Route::get('/showLed', [LedController::class,'showLed'])->middleware(['auth','user_access']);
Route::get('/showContact', [ContactController::class,'showContact'])->middleware(['auth','user_access']);
Route::get('/showClient', [ClientController::class,'showClient'])->middleware(['auth','user_access']);
Route::get('/showSize', [SizeController::class,'showSize'])->middleware(['auth','user_access']);
Route::get('/test', [BillboardController::class,'test'])->middleware(['auth','user_access']);
// Route::get('/preview/{id}', [PreviewController::class, 'preview']);
// Route::get('/videotron/{id}', [PreviewController::class, 'videotronPreview']);
Route::get('/showQuotation', [QuotationController::class,'showQuotation'])->middleware(['auth','user_access']);
Route::get('/showBillboardQuotation', [BillboardQuotationController::class,'showBillboardQuotation'])->middleware(['auth','user_access']);
Route::get('/showBillboardPhoto', [BillboardPhotoController::class,'showBillboardPhoto'])->middleware(['auth','user_access']);
Route::get('/showBillboardCategory', [BillboardCategoryController::class,'showBillboardCategory'])->middleware(['auth','user_access']);
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
        'title' => 'Welcome'
    ]);   
});

Route::get('/dashboard/users/notifications', function () {
    return view('dashboard.users.notifications.index',[
        'title' => 'Notifications'
    ]);   
})->middleware(['auth','user_access']);