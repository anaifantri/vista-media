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
use App\Models\Company;
use App\Models\PrintOrder;
use App\Models\InstallOrder;

use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        $locations = Location::with('area')->get();
        $cities = City::with('area')->get();
        $active_licenses = count(Location::activeLicenses()->get());
        $expired_licenses = count(Location::expiredLicenses()->get());
        $expired_soon_licenses = count(Location::expiredSoonLicenses()->get());
        $active_agreements = count(Location::activeAgreements()->get());
        $expired_agreements = count(Location::expiredAgreements()->get());
        $expired_soon_agreements = count(Location::expiredSoonAgreements()->get());

        $year = date('Y');
        $month = date('m');
        $mm = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        for ($i=1; $i <= $month; $i++) { 
            $thisYearQuotation = Quotation::whereYear('created_at', $year)->whereMonth('created_at', $i)->get();
            $monthData[] = $mm[$i];
            $thisYearQty[] = count($thisYearQuotation);
        }
        $deals = Quotation::deal()->get();
        $closeds = Quotation::closed()->get();
        $followups = Quotation::followUp()->get();
        $createds = Quotation::createds()->get();
        $sents = Quotation::sent()->get();
        $quotationData = [count($createds), count($sents), count($followups), count($deals), count($closeds)];
        $labelData = ['Created', 'Sent', 'Follow Up','Deal', 'Closed'];
        $quotation_revisions = QuotationRevision::with('quotation')->get();
        $quot_revision_statuses = QuotRevisionStatus::with('quotation_revision')->get();
        $quotation_statuses = QuotationStatus::with('quotation')->get();

        for ($i=1; $i <= $month; $i++) { 
            $thisYearSales = Sale::whereYear('created_at', $year)->whereMonth('created_at', $i)->sum('price');
            $prevYearSales = Sale::whereYear('created_at', $year - 1)->whereMonth('created_at', $i)->sum('price');
            $thisYearTotal[] = $thisYearSales;
            $prevYearTotal[] = $prevYearSales;
        }

        for ($i=1; $i <= $month; $i++) { 
            $printOrders = PrintOrder::whereYear('created_at', $year)->whereMonth('created_at', $i)->get();
            $printOrderQty[] = count($printOrders);
        }
        $printSales = PrintOrder::sales()->get();
        $freePrintSales = PrintOrder::freeSales()->get();
        $freePrintOther = PrintOrder::freeOther()->get();
        $printOrderData = [count($printSales), count($freePrintSales), count($freePrintOther)];

        for ($i=1; $i <= $month; $i++) { 
            $installOrders = InstallOrder::whereYear('created_at', $year)->whereMonth('created_at', $i)->get();
            $installOrderQty[] = count($installOrders);
        }
        $installSales = InstallOrder::sales()->get();
        $freeInstallSales = InstallOrder::freeSales()->get();
        $freeInstallOther = InstallOrder::freeOther()->get();
        $installOrderData = [count($installSales), count($freeInstallSales), count($freeInstallOther)];

        $labelDataOrder = ['Berbayar', 'Gratis Penjualan', 'Gratis Lain-Lain'];
        return view('dashboard.index',[
            'title' => "Dashboard",
            'printOrderQty' => $printOrderQty,
            'printOrderData' => $printOrderData,
            'todaysPrint' => PrintOrder::whereDate('created_at', Carbon::today())->get(),
            'weekdayPrints' => PrintOrder::whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->get(),
            'monthPrints' => PrintOrder::whereMonth('created_at', Carbon::now()->month)->get(),
            'yearPrints' => PrintOrder::whereYear('created_at', Carbon::now()->year)->get(),
            'printSales' => $printSales,
            'freePrintSales' => $freePrintSales,
            'freePrintOther' => $freePrintOther,

            'labelDataOrder' => $labelDataOrder,

            'installOrderQty' => $installOrderQty,
            'installOrderData' => $installOrderData,
            'todaysInstall' => InstallOrder::whereDate('created_at', Carbon::today())->get(),
            'weekdayInstalls' => InstallOrder::whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->get(),
            'monthInstalls' => InstallOrder::whereMonth('created_at', Carbon::now()->month)->get(),
            'yearInstalls' => InstallOrder::whereYear('created_at', Carbon::now()->year)->get(),
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
            'todays' => Quotation::whereDate('created_at', Carbon::today())->get(),
            'weekday' => Quotation::whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->get(),
            'monthQuots' => Quotation::whereMonth('created_at', Carbon::now()->month)->get(),
            'yearQuots' => Quotation::whereYear('created_at', Carbon::now()->year)->get(),
            
            'weekSales' => Sale::whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->sum('price'),
            'monthSales' => Sale::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('price'),
            'yearSales' => Sale::whereYear('created_at', Carbon::now()->year)->sum('price'),
            'sales' => Sale::whereYear('created_at', Carbon::now()->year)->get(),
            'thisYearTotal' => $thisYearTotal,
            'prevYearTotal' => $prevYearTotal,
            compact('locations', 'cities', 'quotation_revisions', 'quotation_statuses', 'quot_revision_statuses')
        ]);
    }
}
