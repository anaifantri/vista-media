<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\LocationPhoto;
use App\Models\MediaCategory;
use App\Models\Area;
use App\Models\City;
use App\Models\License;
use App\Models\LicensingCategory;
use App\Models\Quotation;
use App\Models\QuotationStatus;
use App\Models\QuotationRevision;
use App\Models\QuotRevisionStatus;
use App\Models\Sale;
use App\Models\ChangeSale;
use App\Models\VoidSale;
use App\Models\Billing;
use App\Models\Payment;
use App\Models\Company;
use App\Models\PrintOrder;
use App\Models\InstallOrder;
use App\Models\ElectricalPower;
use App\Models\ElectricityTopUp;
use App\Models\ElectricityPayment;
use App\Models\Complaint;
use App\Models\ComplaintResponse;
use App\Models\PublishContent;
use App\Models\TakeOutContent;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(String $company_id){
        $companyId = Crypt::decrypt($company_id);
        $locations = Location::with('area')->get();
        $cities = City::with('area')->get();
        $active_licenses = count(Location::activeLicenses()->get());
        $expired_licenses = count(Location::expiredLicenses()->get());
        $expired_soon_licenses = count(Location::expiredSoonLicenses()->get());
        $active_agreements = count(Location::activeAgreements()->get());
        $expired_agreements = count(Location::expiredAgreements()->get());
        $expired_soon_agreements = count(Location::expiredSoonAgreements()->get());

        $year = date('Y');
        $mm = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        for ($i=1; $i <= 12; $i++) { 
            $thisYearQuotation = Quotation::where('company_id', $companyId)->whereYear('created_at', $year)->whereMonth('created_at', $i)->get();
            $monthData[] = $mm[$i];
            $thisYearQty[] = count($thisYearQuotation);
        }
        $deals = Quotation::where('company_id', $companyId)->year()->deal()->get();
        $closeds = Quotation::where('company_id', $companyId)->year()->closed()->get();
        $followups = Quotation::where('company_id', $companyId)->year()->followUp()->get();
        $createds = Quotation::where('company_id', $companyId)->year()->createds()->get();
        $sents = Quotation::where('company_id', $companyId)->year()->sent()->get();
        $quotationData = [count($createds), count($sents), count($followups), count($deals), count($closeds)];
        $labelData = ['Created', 'Sent', 'Follow Up','Deal', 'Closed'];
        $quotation_revisions = QuotationRevision::with('quotation')->get();
        $quot_revision_statuses = QuotRevisionStatus::with('quotation_revision')->get();
        $quotation_statuses = QuotationStatus::with('quotation')->get();

        for ($i=1; $i <= 12; $i++) { 
            $getSales = Sale::where('company_id', $companyId)->whereYear('created_at', $year)->whereMonth('created_at', $i)->sum('price');
            $getChangeSales = ChangeSale::where('company_id', $companyId)->whereYear('created_at', $year)->whereMonth('created_at', $i)->sum('price_diff');
            $getVoidSales = VoidSale::where('company_id', $companyId)->whereYear('created_at', $year)->whereMonth('created_at', $i)->sum('price');
            $thisYearSales = $getSales + $getChangeSales - $getVoidSales;
            $getPrevSales = Sale::where('company_id', $companyId)->whereYear('created_at', $year - 1)->whereMonth('created_at', $i)->sum('price');
            $getPrevChangeSales = ChangeSale::where('company_id', $companyId)->whereYear('created_at', $year - 1)->whereMonth('created_at', $i)->sum('price_diff');
            $getPrevVoidSales = VoidSale::where('company_id', $companyId)->whereYear('created_at', $year - 1)->whereMonth('created_at', $i)->sum('price');
            $prevYearSales = $getPrevSales + $getPrevChangeSales - $getPrevVoidSales;
            $thisYearTotal[] = $thisYearSales;
            $prevYearTotal[] = $prevYearSales;
        }

        for ($i=1; $i <= 12; $i++) { 
            $billingTotal = Billing::where('company_id', $companyId)->whereYear('created_at', $year)->whereMonth('created_at', $i)->sum('nominal');
            $billingPpn = Billing::where('company_id', $companyId)->whereYear('created_at', $year)->whereMonth('created_at', $i)->sum('ppn');
            $thisYearBillings[] = $billingTotal + $billingPpn;
        }

        for ($i=1; $i <= 12; $i++) { 
            $paymentTotal = Payment::where('company_id', $companyId)->whereYear('payment_date', $year)->whereMonth('payment_date', $i)->sum('nominal');
            $thisYearPayments[] = round($paymentTotal);
        }

        for ($i=1; $i <= 12; $i++) { 
            $printOrders = PrintOrder::where('company_id', $companyId)->whereYear('created_at', $year)->whereMonth('created_at', $i)->get();
            $printOrderQty[] = count($printOrders);
        }
        $printSales = PrintOrder::where('company_id', $companyId)->sales()->year()->get();
        $freePrintSales = PrintOrder::where('company_id', $companyId)->freeSales()->year()->get();
        $freePrintOther = PrintOrder::where('company_id', $companyId)->freeOther()->year()->get();
        $printOrderData = [count($printSales), count($freePrintSales), count($freePrintOther)];

        for ($i=1; $i <= 12; $i++) { 
            $installOrders = InstallOrder::where('company_id', $companyId)->whereYear('created_at', $year)->whereMonth('created_at', $i)->get();
            $installOrderQty[] = count($installOrders);
        }
        $installSales = InstallOrder::where('company_id', $companyId)->sales()->year()->get();
        $freeInstallSales = InstallOrder::where('company_id', $companyId)->freeSales()->year()->get();
        $freeInstallOther = InstallOrder::where('company_id', $companyId)->freeOther()->year()->get();
        $installOrderData = [count($installSales), count($freeInstallSales), count($freeInstallOther)];
        $electrical_powers = ElectricalPower::all();
        $electricity_top_ups = ElectricityTopUp::month()->year()->get();
        $electricity_payments = ElectricityPayment::month()->year()->get();
        $complaints = Complaint::month()->year()->get();
        $complaint_responses = ComplaintResponse::month()->year()->get();
        $publish_contents = PublishContent::month()->year()->get();
        $takeout_contents = TakeOutContent::month()->year()->get();

        $labelDataOrder = ['Berbayar', 'Gratis Penjualan', 'Gratis Lain-Lain'];

        $getMonthSales = Sale::where('company_id', $companyId)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('price');
        $getChangeMonthSales = ChangeSale::where('company_id', $companyId)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('price_diff');
        $getVoidMonthSales = ChangeSale::where('company_id', $companyId)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('price');
        $monthSales = $getMonthSales + $getChangeSales - $getVoidSales;

        $getYearSales = Sale::where('company_id', $companyId)->whereYear('created_at', Carbon::now()->year)->sum('price');
        $getChangeYearSales = ChangeSale::where('company_id', $companyId)->whereYear('created_at', Carbon::now()->year)->sum('price_diff');
        $getVoidYearSales = VoidSale::where('company_id', $companyId)->whereYear('created_at', Carbon::now()->year)->sum('price');
        $yearSales = $getYearSales + $getChangeYearSales - $getVoidYearSales;
        return view('dashboard.index',[
            'title' => "Dashboard",
            'printOrderQty' => $printOrderQty,
            'printOrderData' => $printOrderData,
            'todaysPrint' => PrintOrder::where('company_id', $companyId)->whereDate('created_at', Carbon::today())->get(),
            'weekdayPrints' => PrintOrder::where('company_id', $companyId)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->get(),
            'monthPrints' => PrintOrder::where('company_id', $companyId)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get(),
            'yearPrints' => PrintOrder::where('company_id', $companyId)->whereYear('created_at', Carbon::now()->year)->get(),
            'printSales' => $printSales,
            'freePrintSales' => $freePrintSales,
            'freePrintOther' => $freePrintOther,

            'labelDataOrder' => $labelDataOrder,

            'installOrderQty' => $installOrderQty,
            'installOrderData' => $installOrderData,
            'todaysInstall' => InstallOrder::where('company_id', $companyId)->whereDate('created_at', Carbon::today())->get(),
            'weekdayInstalls' => InstallOrder::where('company_id', $companyId)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->get(),
            'monthInstalls' => InstallOrder::where('company_id', $companyId)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get(),
            'yearInstalls' => InstallOrder::where('company_id', $companyId)->whereYear('created_at', Carbon::now()->year)->get(),
            'installSales' => $installSales,
            'freeInstallSales' => $freeInstallSales,
            'freeInstallOther' => $freeInstallOther,

            'active_licenses' => $active_licenses,
            'expired_licenses' => $expired_licenses,
            'expired_soon_licenses' => $expired_soon_licenses,
            'active_agreements' => $active_agreements,
            'expired_agreements' => $expired_agreements,
            'expired_soon_agreements' => $expired_soon_agreements,
            'areas' => Area::All(),
            
            'thisYearQty' => $thisYearQty,
            'monthData' => $monthData,
            'quotationData' => $quotationData,
            'labelData' => $labelData,
            'todays' => Quotation::where('company_id', $companyId)->whereDate('created_at', Carbon::today())->get(),
            'weekday' => Quotation::where('company_id', $companyId)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->get(),
            'monthQuots' => Quotation::where('company_id', $companyId)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get(),
            'yearQuots' => Quotation::where('company_id', $companyId)->whereYear('created_at', Carbon::now()->year)->get(),
            
            'weekSales' => Sale::where('company_id', $companyId)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->sum('price'),
            'monthSales' => $monthSales,
            'yearSales' => $yearSales,
            'sales' => Sale::where('company_id', $companyId)->whereYear('created_at', Carbon::now()->year)->get(),

            'monthBillings' => Billing::where('company_id', $companyId)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get(),
            'thisYearBillings' => $thisYearBillings,
            'thisYearPayments' => $thisYearPayments,
            'yearBillings' => Billing::where('company_id', $companyId)->whereYear('created_at', Carbon::now()->year)->get(),
            'monthPayments' => Payment::where('company_id', $companyId)->whereYear('payment_date', Carbon::now()->year)->whereMonth('payment_date', Carbon::now()->month)->sum('nominal'),
            'yearPayments' => Payment::where('company_id', $companyId)->whereYear('payment_date', Carbon::now()->year)->sum('nominal'),

            'thisYearTotal' => $thisYearTotal,
            'prevYearTotal' => $prevYearTotal,
            'electrical_powers' => $electrical_powers,
            'electricity_top_ups' => $electricity_top_ups,
            'electricity_payments' => $electricity_payments,
            'complaints' => $complaints,
            'complaint_responses' => $complaint_responses,
            'publish_contents' => $publish_contents,
            'takeout_contents' => $takeout_contents,
            compact('locations', 'cities', 'quotation_revisions', 'quotation_statuses', 'quot_revision_statuses')
        ]);
    }
}
