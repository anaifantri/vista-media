<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\VoidSale;
use App\Models\ChangeSale;
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
    public function index(String $company_id): View
    {
        if(Gate::allows('isSale') && Gate::allows('isMarketingRead')){
            $year = date('Y');
            // $month = date('m');
            $mm = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
            for ($i=1; $i <= 12; $i++) { 
                $thisYearSales = Sale::where('company_id', $company_id)->whereYear('created_at', $year)->whereMonth('created_at', $i)->sum('price');
                $prevYearSales = Sale::where('company_id', $company_id)->whereYear('created_at', $year - 1)->whereMonth('created_at', $i)->sum('price');
                $monthData[] = $mm[$i];
                $thisYearTotal[] = $thisYearSales;
                $prevYearTotal[] = $prevYearSales;
            }
            return view ('sales-report.index', [
                'areas' => Area::all(),
                'thisYearTotal' => $thisYearTotal,
                'prevYearTotal' => $prevYearTotal,
                'monthData' => $monthData,
                'weekSales' => Sale::where('company_id', $company_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->sum('price'),
                'monthSales' => Sale::where('company_id', $company_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('price'),
                'yearSales' => Sale::where('company_id', $company_id)->whereYear('created_at', Carbon::now()->year)->sum('price'),
                'title' => 'Laporan Penjualan'
            ]);
        } else {
            abort(403);
        }
    }

    public function chartReports(String $areaId, Request $request): View
    {
        if(Gate::allows('isSale') && Gate::allows('isMarketingRead')){
            $categories_id = [];
            if(request('get_categories')){
                $categories_id = json_decode(request('get_categories'));
                if(count($categories_id) == 1){    
                    $dataCategory = MediaCategory::findOrFail($categories_id[0]);
                    $category = $dataCategory->name;
                }else{
                    $category = "All";
                }
                $data_locations = Location::where('area_id', $areaId)->whereIn('media_category_id', $categories_id)->sortable()->orderBy("code", "asc")->get();
            }else{
                $category = "All";
                $data_locations = Location::where('area_id', $areaId)->sortable()->orderBy("code", "asc")->get();
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
                'locations'=>$data_locations,
                'area'=>$area,
                'category'=>$category,
                'categories_id'=>$categories_id,
                'title' => 'Grafik Periode Kontrak',
                compact('sales_categories', 'companies','quotations', 'location_categories', 'areas', 'cities', 'media_sizes', 'sales')
            ]);
        } else {
            abort(403);
        }
    }

    public function cReports(String $company_id): View
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
            $void_sales = VoidSale::with('sale')->get();
            $change_sales = VoidSale::with('sale')->get();
            return view ('sales-report.c-reports', [
                'sales'=>Sale::unionAll(Sale::void())->unionAll(Sale::change())->where('company_id', $company_id)->filter(request('search'))->year()->month()->sortable()->orderBy("number", "asc")->get(),
                'void_sales'=>VoidSale::where('company_id', $company_id)->filter(request('search'))->year()->month()->get(),
                'change_sales'=>ChangeSale::where('company_id', $company_id)->filter(request('search'))->year()->month()->get(),
                'title' => 'Data Penjualan',
                compact('sales_categories', 'companies','quotations', 'location_categories', 'areas', 'cities', 'media_sizes', 'locations', 'void_sales', 'change_sales')
            ]);
        } else {
            abort(403);
        }
    }
}
