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
    public function index(): View
    {
        if(Gate::allows('isOrder') && Gate::allows('isMarketingRead')){
            return view ('orders-report.index', [
                'todaysPrint' => Quotation::whereDate('created_at', Carbon::today())->get(),
                'weekdayPrints' => PrintOrder::whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->get(),
                'monthPrints' => PrintOrder::whereMonth('created_at', Carbon::now()->month)->get(),
                'yearPrints' => PrintOrder::whereYear('created_at', Carbon::now()->year)->get(),
                'todaysInstall' => Quotation::whereDate('created_at', Carbon::today())->get(),
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
