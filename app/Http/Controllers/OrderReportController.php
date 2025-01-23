<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Quotation;
use App\Models\Company;
use App\Models\Location;
use App\Models\PrintOrder;
use App\Models\InstallOrder;
use App\Models\Area;
use App\Models\City;
use App\Models\MediaSize;
use App\Models\MediaCategory;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;
use Gate;

class OrderReportController extends Controller
{
    public function index(String $Company_id): View
    {
        if(Gate::allows('isOrder') && Gate::allows('isMarketingRead')){
            $year = date('Y');
            $mm = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
            for ($i=1; $i <= 12; $i++) { 
                $printOrders = PrintOrder::whereYear('created_at', $year)->whereMonth('created_at', $i)->get();
                $monthData[] = $mm[$i];
                $printOrderQty[] = count($printOrders);
            }
            $printSales = PrintOrder::sales()->year()->get();
            $freePrintSales = PrintOrder::freeSales()->year()->get();
            $freePrintOther = PrintOrder::freeOther()->year()->get();
            $printOrderData = [count($printSales), count($freePrintSales), count($freePrintOther)];

            for ($i=1; $i <= 12; $i++) { 
                $installOrders = InstallOrder::whereYear('created_at', $year)->whereMonth('created_at', $i)->get();
                $installOrderQty[] = count($installOrders);
            }
            $installSales = InstallOrder::sales()->year()->get();
            $freeInstallSales = InstallOrder::freeSales()->year()->get();
            $freeInstallOther = InstallOrder::freeOther()->year()->get();
            $installOrderData = [count($installSales), count($freeInstallSales), count($freeInstallOther)];

            $labelData = ['Berbayar', 'Gratis Penjualan', 'Gratis Lain-Lain'];
            return view ('orders-report.index', [
                'printOrderQty' => $printOrderQty,
                'printSales' => $printSales,
                'installOrderQty' => $installOrderQty,
                'monthData' => $monthData,
                'printOrderData' => $printOrderData,
                'installOrderData' => $installOrderData,
                'labelData' => $labelData,
                'todaysPrint' => PrintOrder::whereDate('created_at', Carbon::today())->get(),
                'weekdayPrints' => PrintOrder::whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->get(),
                'monthPrints' => PrintOrder::whereMonth('created_at', Carbon::now()->month)->get(),
                'yearPrints' => PrintOrder::whereYear('created_at', Carbon::now()->year)->get(),
                'todaysInstall' => InstallOrder::whereDate('created_at', Carbon::today())->get(),
                'weekdayInstalls' => InstallOrder::whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->get(),
                'monthInstalls' => InstallOrder::whereMonth('created_at', Carbon::now()->month)->get(),
                'yearInstalls' => InstallOrder::whereYear('created_at', Carbon::now()->year)->get(),
                'title' => 'Laporan SPK Cetak dan Pasang'
            ]);
        } else {
            abort(403);
        }
    }

    public function printReports(Request $request): View
    {
        if(Gate::allows('isOrder') && Gate::allows('isMarketingRead')){
            return view ('orders-report.print-reports', [
                'print_orders'=>PrintOrder::filter(request('search'))->sortable()->orderBy("number", "asc")->get(),
                'amount'=>PrintOrder::filter(request('search'))->sum('price'),
                'sales' => Sale::all(),
                'title' => 'Laporan SPK Cetak'
            ]);
        } else {
            abort(403);
        }
    }

    public function installReports(Request $request): View
    {
        if(Gate::allows('isOrder') && Gate::allows('isMarketingRead')){
            return view ('orders-report.install-reports', [
                'install_orders'=>InstallOrder::filter(request('search'))->sortable()->orderBy("number", "asc")->get(),
                'sales' => Sale::all(),
                'title' => 'Laporan SPK Pasang'
            ]);
        } else {
            abort(403);
        }
    }
}
