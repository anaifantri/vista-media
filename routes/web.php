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
use App\Http\Controllers\BillingController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\VoidSaleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncomeTaxController;
use App\Http\Controllers\MediaSizeController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\ChangeSaleController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\PrintOrderController;
use App\Http\Controllers\WorkReportController;
use App\Http\Controllers\ClientGroupController;
use App\Http\Controllers\OrderReportController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\InstallOrderController;
use App\Http\Controllers\LandDocumentController;
use App\Http\Controllers\LandAgreementController;
use App\Http\Controllers\LocationPhotoController;
use App\Http\Controllers\MediaCategoryController;
use App\Http\Controllers\PrintingPriceController;
use App\Http\Controllers\TakedownOrderController;
use App\Http\Controllers\VatTaxInvoiceController;
use App\Http\Controllers\VendorContactController;
use App\Http\Controllers\ClientCategoryController;
use App\Http\Controllers\QuotationOrderController;
use App\Http\Controllers\VendorCategoryController;
use App\Http\Controllers\BillCoverLetterController;
use App\Http\Controllers\ElectricalPowerController;
use App\Http\Controllers\LicenseDocumentController;
use App\Http\Controllers\MonitoringPhotoController;
use App\Http\Controllers\PrintingProductController;
use App\Http\Controllers\QuotationStatusController;
use App\Http\Controllers\ElectricityTopUpController;
use App\Http\Controllers\QuotationsReportController;
use App\Http\Controllers\ElectricityReportController;
use App\Http\Controllers\IncomeTaxCategoryController;
use App\Http\Controllers\IncomeTaxDocumentController;
use App\Http\Controllers\InstallationPhotoController;
use App\Http\Controllers\InstallationPriceController;
use App\Http\Controllers\LicensingCategoryController;
use App\Http\Controllers\QuotationApprovalController;
use App\Http\Controllers\QuotationRevisionController;
use App\Http\Controllers\ElectricityPaymentController;
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
Route::get('/dashboard/{companyid}', [DashboardController::class, 'index'])->middleware('auth');
// Route dashboard --> end

// Route users --> start
Route::resource('/user/users', UserController::class)->middleware(['auth','user_access']);
// Route users --> end

// Marketing Group --> start
// Route Client --> start
Route::resource('/marketing/client-categories', ClientCategoryController::class)->middleware(['auth','user_access']);
Route::resource('/marketing/clients', ClientController::class)->middleware(['auth','user_access']);
Route::resource('/marketing/client-groups', ClientGroupController::class)->middleware(['auth','user_access']);
Route::resource('/marketing/contacts', ContactController::class)->middleware(['auth','user_access']);
Route::get('/get-contacts/{id}', [ContactController::class,'getContacts'])->middleware(['auth','user_access']);
// Route Client --> end

// Route Vendor --> start
Route::resource('/marketing/vendors', VendorController::class)->middleware(['auth','user_access']);
Route::resource('/marketing/vendor-contacts', VendorContactController::class)->middleware(['auth','user_access']);
Route::resource('/marketing/vendor-categories', VendorCategoryController::class)->middleware(['auth','user_access']);
// Route Vendor --> end

// Route Quotations --> start
Route::resource('/marketing/quotations', QuotationController::class)->middleware(['auth','user_access']);
Route::get('/marketing/quotations/preview/{category}/{id}', [QuotationController::class,'preview']);
Route::get('/quotations/preview/{category}/{id}', [QuotationController::class,'guestPreview']);
Route::get('/marketing/quotations/select-location/{category}/{companyid}', [QuotationController::class,'selectLocation']);
Route::get('/marketing/quotations/create-quotation/{category}/{type}/{id}/{city}/{area}', [QuotationController::class,'createQuotation']);
Route::get('/marketing/quotations/home/{category}/{companyid}', [QuotationController::class,'home']);
Route::resource('/marketing/quotation-statuses', QuotationStatusController::class)->middleware(['auth','user_access']);
// Route Quotations --> end

// Route Quotation Revisions --> start
Route::resource('/marketing/quotation-revisions', QuotationRevisionController::class)->middleware(['auth','user_access']);
Route::get('/marketing/quotation-revisions/revision/{category}/{id}', [QuotationRevisionController::class,'revision']);
Route::get('/marketing/quotation-revisions/preview/{category}/{id}', [QuotationRevisionController::class,'preview']);
Route::get('/quotation-revisions/preview/{category}/{id}', [QuotationRevisionController::class,'guestPreview']);
Route::resource('/marketing/quot-revision-statuses', QuotRevisionStatusController::class)->middleware(['auth','user_access']);
// Route Quotation Revisions --> end

// Route Quotation Documents --> start
Route::resource('/marketing/quotation-approvals', QuotationApprovalController::class)->middleware(['auth','user_access']);
Route::get('/marketing/quotation-approvals/show-approvals/{category}/{id}', [QuotationApprovalController::class,'showApprovals']);
Route::resource('/marketing/quotation-agreements', QuotationAgreementController::class)->middleware(['auth','user_access']);
Route::get('/marketing/quotation-agreements/show-agreements/{category}/{saleid}', [QuotationAgreementController::class,'showAgreements']);
Route::resource('/marketing/quotation-orders', QuotationOrderController::class)->middleware(['auth','user_access']);
Route::get('/marketing/quotation-orders/show-orders/{category}/{saleid}', [QuotationOrderController::class,'showOrders']);
// Route Quotation Documents --> end

// Route Sales --> start
Route::resource('/marketing/sales', SaleController::class)->middleware(['auth','user_access']);
Route::get('/marketing/sales/home/{category}/{companyid}', [SaleController::class,'home'])->middleware(['auth','user_access']);
Route::get('/marketing/sales/report/{category}', [SaleController::class,'report'])->middleware(['auth','user_access']);
Route::get('/marketing/sales/select-quotation/{category}/{companyid}', [SaleController::class,'selectQuotation'])->middleware(['auth','user_access']);
Route::get('/marketing/sales/create-sales/{category}/{id}', [SaleController::class,'createSales'])->middleware(['auth','user_access']);
Route::get('/marketing/sales/preview/{category}/{id}', [SaleController::class,'preview'])->middleware(['auth','user_access']);
Route::get('/get-sales/{id}/{scope}', [SaleController::class,'getSales'])->middleware(['auth','user_access']);

Route::resource('/marketing/void-sales', VoidSaleController::class)->except(['create'])->middleware(['auth','user_access']);
Route::get('/void-sales/create/{saleid}', [VoidSaleController::class,'create'])->middleware(['auth','user_access']);

Route::resource('/marketing/change-sales', ChangeSaleController::class)->except(['create'])->middleware(['auth','user_access']);
Route::get('/change-sales/create/{saleid}', [ChangeSaleController::class,'create'])->middleware(['auth','user_access']);
// Route Sales --> end

// Route Sales Report --> start
Route::get('/marketing/sales-report/{companyid}', [SalesReportController::class,'index'])->middleware(['auth','user_access']);
Route::get('/marketing/sales-report/chart-report/{areaId}', [SalesReportController::class,'chartReports'])->middleware(['auth','user_access']);
Route::get('/marketing/sales-report/c-report/{companyid}', [SalesReportController::class,'cReports'])->middleware(['auth','user_access']);
Route::get('/marketing/sales-report/custom-report/{companyid}', [SalesReportController::class,'customReports'])->middleware(['auth','user_access']);
Route::get('/marketing/sales-report/receivables-report/{companyid}', [SalesReportController::class,'receivablesReports'])->middleware(['auth','user_access']);
// Route Sales Report --> end

// Route Quotation Report --> start
Route::get('/marketing/quotations-report/{companyid}', [QuotationsReportController::class,'index'])->middleware(['auth','user_access']);
Route::get('/marketing/quotations-report/reports/{categoryId}/{companyid}', [QuotationsReportController::class,'quotationReports'])->middleware(['auth','user_access']);
// Route Quotation Report --> end

// Route Order Report --> start
Route::get('/marketing/orders-report/{companyid}', [OrderReportController::class,'index'])->middleware(['auth','user_access']);
Route::get('/marketing/orders-report/print-orders', [OrderReportController::class,'printReports'])->middleware(['auth','user_access']);
Route::get('/marketing/orders-report/install-orders', [OrderReportController::class,'installReports'])->middleware(['auth','user_access']);
// Route Order Report --> end

// Route Service --> start
Route::resource('/marketing/printing-products', PrintingProductController::class)->middleware(['auth','user_access']);
Route::resource('/marketing/printing-prices', PrintingPriceController::class)->middleware(['auth','user_access']);
Route::resource('/marketing/installation-prices', InstallationPriceController::class)->middleware(['auth','user_access']);

Route::resource('/marketing/takedown-orders', TakedownOrderController::class)->except(['index'])->middleware(['auth','user_access']);
Route::get('/takedown-orders/index/{companyid}', [TakedownOrderController::class,'index'])->middleware(['auth','user_access']);
Route::get('/takedown-orders/select-locations', [TakedownOrderController::class,'selectLocations'])->middleware(['auth','user_access']);
Route::get('/takedown-orders/create-order/{id}', [TakedownOrderController::class,'createOrder'])->middleware(['auth','user_access']);
Route::get('/marketing/takedown-orders/preview/{id}', [TakedownOrderController::class,'preview'])->middleware(['auth','user_access']);

Route::resource('/marketing/install-orders', InstallOrderController::class)->except(['index'])->middleware(['auth','user_access']);
Route::get('/install-orders/index/{companyid}', [InstallOrderController::class,'index'])->middleware(['auth','user_access']);
Route::get('/install-orders/select-locations/{companyid}', [InstallOrderController::class,'selectLocations'])->middleware(['auth','user_access']);
Route::get('/install-orders/{status}/{companyid}', [InstallOrderController::class,'installOrders'])->middleware(['auth','user_access']);
Route::get('/install-orders/create-order/{id}/{type}', [InstallOrderController::class,'createOrder'])->middleware(['auth','user_access']);
Route::get('/marketing/install-orders/preview/{id}', [InstallOrderController::class,'preview'])->middleware(['auth','user_access']);

Route::resource('/marketing/print-orders', PrintOrderController::class)->except(['index'])->middleware(['auth','user_access']);
Route::get('/print-orders/index/{companyid}', [PrintOrderController::class,'index'])->middleware(['auth','user_access']);
Route::get('/print-orders/select-locations/{companyid}', [PrintOrderController::class,'selectLocations'])->middleware(['auth','user_access']);
Route::get('/print-orders/create-order/{id}/{type}', [PrintOrderController::class,'createOrder'])->middleware(['auth','user_access']);
Route::get('/marketing/print-orders/preview/{id}', [PrintOrderController::class,'preview'])->middleware(['auth','user_access']);
Route::get('/print-orders/{status}/{companyid}', [PrintOrderController::class,'printOrders'])->middleware(['auth','user_access']);
Route::get('/get-printing-prices/{id}/{type}', [PrintOrderController::class,'getPrintingPrices'])->middleware(['auth','user_access']);
// Route Service --> end
// Marketing Group --> end

// Accounting Group --> start
// Billing  --> start
Route::resource('/accounting/billings', BillingController::class)->except(['index', 'create'])->middleware(['auth','user_access']);
Route::get('/billings/index/{companyid}', [BillingController::class,'index'])->middleware(['auth','user_access']);
Route::get('/billings/report/{companyid}', [BillingController::class,'report'])->middleware(['auth','user_access']);
Route::get('/billings/select-models', [BillingController::class,'selectModel'])->middleware(['auth','user_access']);
Route::get('/billings/select-sale/{category}/{companyid}', [BillingController::class,'selectSale'])->middleware(['auth','user_access']);
Route::get('/billings/select-terms/{saleid}', [BillingController::class,'selectTerm'])->middleware(['auth','user_access']);
Route::post('/billings/select-documents', [BillingController::class,'selectDocuments'])->middleware(['auth','user_access']);
Route::post('/billings/create-media-billing', [BillingController::class,'createMediaBilling'])->middleware(['auth','user_access']);
Route::get('/billings/create-service-billing/{saleid}', [BillingController::class,'createServiceBilling'])->middleware(['auth','user_access']);
Route::get('/billings/preview/{category}/{id}', [BillingController::class,'preview'])->middleware(['auth','user_access']);
// Billing  --> end

// Work Report  --> start
Route::resource('/accounting/work-reports', WorkReportController::class)->except(['index', 'create'])->middleware(['auth','user_access']);
Route::get('/work-reports/index/{companyid}', [WorkReportController::class,'index'])->middleware(['auth','user_access']);
Route::get('/work-reports/create/{category}/{companyid}', [WorkReportController::class,'create'])->middleware(['auth','user_access']);
Route::get('/work-reports/preview/{id}', [WorkReportController::class,'preview'])->middleware(['auth','user_access']);
Route::get('/work-reports/select-documentation/{id}/{mainid}/{category}', [WorkReportController::class,'selectDocumentation'])->middleware(['auth','user_access']);
Route::get('/work-reports/select-format/{id}/{mainid}/{installorderid}/{firstphotoid}/{firsttitle}/{secondphotoid}/{secondtitle}/{category}', [WorkReportController::class,'selectFormat'])->middleware(['auth','user_access']);
// Work Report  --> end

// Bill Cover Letter  --> start
Route::resource('/accounting/bill-cover-letters', BillCoverLetterController::class)->except(['index', 'create'])->middleware(['auth','user_access']);
Route::get('/bill-cover-letters/index/{companyid}', [BillCoverLetterController::class,'index'])->middleware(['auth','user_access']);
Route::get('/bill-cover-letters/select-billing/{companyid}/{category}', [BillCoverLetterController::class,'selectBilling'])->middleware(['auth','user_access']);
Route::get('/bill-cover-letters/create/{billingid}/{category}', [BillCoverLetterController::class,'create'])->middleware(['auth','user_access']);
Route::get('/bill-cover-letters/preview/{id}', [BillCoverLetterController::class,'preview'])->middleware(['auth','user_access']);
// Bill Cover Letter  --> end

// VAT Tax  --> start
Route::resource('/accounting/vat-tax-invoices', VatTaxInvoiceController::class)->except(['index', 'create'])->middleware(['auth','user_access']);
Route::get('/vat-tax-invoices/index/{companyid}', [VatTaxInvoiceController::class,'index'])->middleware(['auth','user_access']);
Route::get('/vat-taxes/report/{companyid}', [VatTaxInvoiceController::class,'report'])->middleware(['auth','user_access']);
Route::get('/vat-tax-invoices/select-billing/{companyid}', [VatTaxInvoiceController::class,'selectBilling'])->middleware(['auth','user_access']);
Route::get('/vat-tax-invoices/create/{saleid}', [VatTaxInvoiceController::class,'create'])->middleware(['auth','user_access']);
// VAT Tax  --> end

// Payments  --> start
Route::resource('/accounting/payments', PaymentController::class)->except(['index', 'create'])->middleware(['auth','user_access']);
Route::get('/payments/index/{companyid}', [PaymentController::class,'index'])->middleware(['auth','user_access']);
Route::get('/payments/report/{companyid}', [PaymentController::class,'report'])->middleware(['auth','user_access']);
Route::get('/payments/select-billing/{companyid}', [PaymentController::class,'selectBilling'])->middleware(['auth','user_access']);
Route::get('/payments/create/{billingid}', [PaymentController::class,'create'])->middleware(['auth','user_access']);
// Payments  --> end

// Income Taxes  --> start
Route::resource('/accounting/income-taxes', IncomeTaxController::class)->except(['index'])->middleware(['auth','user_access']);
Route::get('/income-taxes/index/{companyid}', [IncomeTaxController::class,'index'])->middleware(['auth','user_access']);
// Income Taxes  --> end

// Income Tax Categories  --> start
Route::resource('/accounting/income-tax-categories', IncomeTaxCategoryController::class)->middleware(['auth','user_access']);
// Income Tax Categories  --> end

// Income Taxes  --> start
Route::resource('/accounting/income-tax-documents', IncomeTaxDocumentController::class)->except(['create'])->middleware(['auth','user_access']);
Route::get('/income-taxes/report/{companyid}', [IncomeTaxDocumentController::class,'report'])->middleware(['auth','user_access']);
Route::get('/income-tax-documents/create/{paymentid}/{company}', [IncomeTaxDocumentController::class,'create'])->middleware(['auth','user_access']);
// Income Taxes  --> end
// Accounting Group --> end

// Media Group --> start
Route::resource('/media/companies', CompanyController::class)->middleware(['auth','user_access']);
Route::resource('/media/leds', LedController::class)->middleware(['auth','user_access']);

// Route Area & City --> start
Route::resource('/media/area', AreaController::class)->middleware(['auth','user_access']);
Route::resource('/media/cities', CityController::class)->middleware(['auth','user_access']);
Route::get('/media/show-maps/{id}', [AreaController::class,'showMaps'])->middleware(['auth','user_access']);
// Route Area & City --> end

// Route Location --> start
Route::resource('/media/location-photos', LocationPhotoController::class)->middleware(['auth','user_access']);
Route::resource('/media/media-categories', MediaCategoryController::class)->middleware(['auth','user_access']);
Route::resource('/media/media-sizes', MediaSizeController::class)->middleware(['auth','user_access']);
Route::get('/get-media-sizes/{category}', [MediaSizeController::class,'getMediaSizes'])->middleware(['auth','user_access']);
Route::resource('/media/locations', LocationController::class)->middleware(['auth','user_access'])->middleware(['auth','user_access']);
Route::get('/media/locations/preview/{category}/{id}', [LocationController::class,'preview'])->middleware(['auth','user_access']);
Route::get('/locations/guest-preview/{category}/{id}', [LocationController::class,'guestPreview']);
Route::get('/media/locations/create-location/{category}', [LocationController::class,'createLocation'])->middleware(['auth','user_access']);
Route::get('/media/locations/home/{category}', [LocationController::class,'home'])->middleware(['auth','user_access']);
Route::get('/get-locations/{id}/{scope}', [LocationController::class,'getLocations'])->middleware(['auth','user_access']);
// Route Location --> end

// Route Legality --> start
Route::resource('/media/licensing-categories', LicensingCategoryController::class)->middleware(['auth','user_access']);
Route::resource('/media/land-agreements', LandAgreementController::class)->middleware(['auth','user_access']);
Route::get('/create-land-agreement/{locationId}', [LandAgreementController::class,'createLandAgreement'])->middleware(['auth','user_access']);
Route::get('/show-land-agreement/{locationId}', [LandAgreementController::class,'showLandAgreement'])->middleware(['auth','user_access']);
Route::get('/media/active-agreements', [LandAgreementController::class,'activeAgreement'])->middleware(['auth','user_access']);
Route::get('/media/expired-agreements', [LandAgreementController::class,'expiredAgreement'])->middleware(['auth','user_access']);
Route::get('/media/expired-soon-agreements', [LandAgreementController::class,'expiredSoonAgreement'])->middleware(['auth','user_access']);
Route::resource('/media/licenses', LicenseController::class)->middleware(['auth','user_access']);
Route::get('/create-license/{locationId}', [LicenseController::class,'createLicense'])->middleware(['auth','user_access']);
Route::get('/show-license/{locationId}', [LicenseController::class,'showLicense'])->middleware(['auth','user_access']);
Route::get('/media/active-licenses', [LicenseController::class,'activeLicenses'])->middleware(['auth','user_access']);
Route::get('/media/expired-licenses', [LicenseController::class,'expiredLicenses'])->middleware(['auth','user_access']);
Route::get('/media/expired-soon-licenses', [LicenseController::class,'expiredSoonLicenses'])->middleware(['auth','user_access']);
Route::resource('/media/license-documents', LicenseDocumentController::class)->middleware(['auth','user_access']);
Route::get('/create-license-documents/{licenseId}', [LicenseDocumentController::class,'createDocuments'])->middleware(['auth','user_access']);
Route::resource('/media/land-documents', LandDocumentController::class)->middleware(['auth','user_access']);
Route::get('/create-land-documents/{landAgreementId}/{name}', [LandDocumentController::class,'createDocuments'])->middleware(['auth','user_access']);
// Route Legality --> end
// Media Group --> end

// Workshop Group --> start
Route::resource('/workshop/installation-photos', InstallationPhotoController::class)->except(['index','create'])->middleware(['auth','user_access']);
Route::get('/installation-photos/index/{companyid}', [InstallationPhotoController::class,'index'])->middleware(['auth','user_access']);
Route::get('/installation-photos/show/{installorderid}', [InstallationPhotoController::class,'showInstallationPhotos'])->middleware(['auth','user_access']);
Route::get('/installation-photos/create/{installorderId}/{type}', [InstallationPhotoController::class,'createInstallationPhotos'])->middleware(['auth','user_access']);

Route::resource('/workshop/monitoring-photos', MonitoringPhotoController::class)->middleware(['auth','user_access']);
Route::get('/create-photos/{monitoringId}', [MonitoringPhotoController::class,'createPhotos'])->middleware(['auth','user_access']);
Route::resource('/workshop/monitorings', MonitoringController::class)->middleware(['auth','user_access']);
Route::get('/show-monitoring/{locationId}', [MonitoringController::class,'showMonitoring'])->middleware(['auth','user_access']);
Route::get('/create-monitoring/{locationId}', [MonitoringController::class,'createMonitoring'])->middleware(['auth','user_access']);

Route::resource('/workshop/electricity-payments', ElectricityPaymentController::class)->middleware(['auth','user_access']);
Route::get('/show-electricity-payment/{electricalId}', [ElectricityPaymentController::class,'showElectricityPayment'])->middleware(['auth','user_access']);
Route::get('/create-electricity-payment/{electricalId}', [ElectricityPaymentController::class,'createElectricityPayment'])->middleware(['auth','user_access']);

Route::resource('/workshop/electricity-top-ups', ElectricityTopUpController::class)->middleware(['auth','user_access']);
Route::get('/show-electricity-top-up/{electricalId}', [ElectricityTopUpController::class,'showElectricityTopUp'])->middleware(['auth','user_access']);
Route::get('/create-electricity-top-up/{electricalId}', [ElectricityTopUpController::class,'createElectricityTopUp'])->middleware(['auth','user_access']);

Route::resource('/workshop/electrical-powers', ElectricalPowerController::class)->middleware(['auth','user_access']);
Route::get('/create-electrical-power/{locationId}', [ElectricalPowerController::class,'createElectricalPower'])->middleware(['auth','user_access']);
Route::get('/electrical-power/delete-location/{locationId}/{electricalId}', [ElectricalPowerController::class,'deleteLocation'])->middleware(['auth','user_access']);
Route::get('/electrical-power/add-location/{locationId}/{electricalId}', [ElectricalPowerController::class,'addLocation'])->middleware(['auth','user_access']);
Route::get('/electrical-power/show-location/{areaId}/{cityId}/{electricalId}', [ElectricalPowerController::class,'showLocation'])->middleware(['auth','user_access']);

Route::get('/workshop/electricity-reports', [ElectricityReportController::class,'index'])->middleware(['auth','user_access']);
// Workshop Group --> end

Route::get('/showArea', [AreaController::class,'showArea'])->middleware(['auth','user_access']);
Route::get('/showCity', [CityController::class,'showCity'])->middleware(['auth','user_access']);
Route::get('/showLed', [LedController::class,'showLed'])->middleware(['auth','user_access']);
Route::get('/showClient', [ClientController::class,'showClient'])->middleware(['auth','user_access']);

Route::get('/', function () {
    return view('index',[
        'title' => 'Selamat Datang'
    ]);   
});

Route::get('/media', function () {
    return view('home.media-home',[
        'title' => 'Data Media'
    ]);   
})->middleware(['auth','user_access']);

Route::get('/marketing', function () {
    return view('home.marketing-home',[
        'title' => 'Data Pemasaran'
    ]);   
})->middleware(['auth','user_access']);