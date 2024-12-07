<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Quotation;
use App\Models\Company;
use App\Models\Location;
use App\Models\Area;
use App\Models\City;
use App\Models\MediaSize;
use App\Models\MediaCategory;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;
use Gate;

class SalesReportController extends Controller
{
    public function index(): View
    {
        if(Gate::allows('isSale') && Gate::allows('isMarketingRead')){
            $year = date('Y');
            $month = date('m');
            $mm = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
            for ($i=1; $i <= $month; $i++) { 
                $thisYearSales = Sale::whereYear('created_at', $year)->whereMonth('created_at', $i)->sum('price');
                $prevYearSales = Sale::whereYear('created_at', $year - 1)->whereMonth('created_at', $i)->sum('price');
                $monthData[] = $mm[$i];
                $thisYearTotal[] = $thisYearSales;
                $prevYearTotal[] = $prevYearSales;
            }
            return view ('sales-report.index', [
                'areas' => Area::all(),
                'thisYearTotal' => $thisYearTotal,
                'prevYearTotal' => $prevYearTotal,
                'monthData' => $monthData,
                'weekSales' => Sale::whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->sum('price'),
                'monthSales' => Sale::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('price'),
                'yearSales' => Sale::whereYear('created_at', Carbon::now()->year)->sum('price'),
                'title' => 'Laporan Penjualan'
            ]);
        } else {
            abort(403);
        }
    }

    public function chartReports(String $areaId, Request $request): View
    {
        if(Gate::allows('isSale') && Gate::allows('isMarketingRead')){
            if($request->media_category_id){
                if($request->media_category_id != "All"){
                    $dataCategory = MediaCategory::findOrFail($request->media_category_id);
                    $category = $dataCategory->name;
                }else{
                    $category = "All";
                }
            }else{
                $category = "All";
            }
            $area = Area::findOrFail($areaId);
            $sales_categories = MediaCategory::with('sales')->get();
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $location_categories = MediaCategory::with('locations')->get();
            $companies = Company::with('sales')->get();
            $quotations = Quotation::with('sales')->get();
            $sales = Sale::with('location')->get();
            return view ('sales-report.chart-reports', [
                'locations'=>Location::where('area_id', $areaId)->category()->sortable()->orderBy("code", "asc")->get(),
                'area'=>$area,
                'category'=>$category,
                'title' => 'Grafik Periode Kontrak',
                compact('sales_categories', 'companies','quotations', 'location_categories', 'areas', 'cities', 'media_sizes', 'sales')
            ]);
        } else {
            abort(403);
        }
    }

    public function cReports(): View
    {
        if(Gate::allows('isSale') && Gate::allows('isMarketingRead')){
            $sales_categories = MediaCategory::with('sales')->get();
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $location_categories = MediaCategory::with('locations')->get();
            $companies = Company::with('sales')->get();
            $quotations = Quotation::with('sales')->get();
            $locations = Location::with('sales')->get();
            return view ('sales-report.c-reports', [
                'sales'=>Sale::filter(request('search'))->sortable()->orderBy("number", "asc")->get(),
                'title' => 'Data Penjualan',
                compact('sales_categories', 'companies','quotations', 'location_categories', 'areas', 'cities', 'media_sizes', 'locations')
            ]);
        } else {
            abort(403);
        }
    }
}
