<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Billing;
use App\Models\Payment;
use App\Models\OtherFee;
use App\Models\IncomeTax;
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
            $billings = Billing::with('sales')->get();
            return view ('sales-report.c-reports', [
                'sales'=>Sale::unionAll(Sale::void()->where('company_id', $company_id))->unionAll(Sale::change()->where('company_id', $company_id))->where('company_id', $company_id)->filter(request('search'))->year()->monthReport()->sortable()->orderBy("number", "asc")->get(),
                'void_sales'=>VoidSale::where('company_id', $company_id)->filter(request('search'))->year()->monthReport()->get(),
                'change_sales'=>ChangeSale::where('company_id', $company_id)->filter(request('search'))->year()->monthReport()->get(),
                'title' => 'Laporan C1',
                compact('sales_categories', 'companies','quotations', 'location_categories', 'areas', 'cities', 'media_sizes', 'locations', 'void_sales', 'change_sales', 'billings')
            ]);
        } else {
            abort(403);
        }
    }

    public function customReports(String $company_id): View
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
            return view ('sales-report.custom-reports', [
                'sales'=>Sale::where('company_id', $company_id)->filter(request('search'))->customReport()->sortable()->orderBy("number", "asc")->get(),
                'title' => 'Data Penjualan',
                compact('sales_categories', 'companies','quotations', 'location_categories', 'areas', 'cities', 'media_sizes', 'locations')
            ]);
        } else {
            abort(403);
        }
    }

    public function receivablesReports(String $company_id): View
    {
        if(Gate::allows('isSale') && Gate::allows('isMarketingRead')){
            if(request('fromData') && request('fromData') == 'PENJUALAN'){
                $sales_categories = MediaCategory::with('sales')->get();
                $areas = Area::with('locations')->get();
                $cities = City::with('locations')->get();
                $media_sizes = MediaSize::with('locations')->get();
                $location_categories = MediaCategory::with('locations')->get();
                $companies = Company::with('sales')->get();
                $quotations = Quotation::with('sales')->get();
                $locations = Location::with('sales')->get();
                $receivables = collect([]);
                $dataPayments = [];
                $billingNominals = [];
                $incomeTaxes = [];
                $otherFees = [];
                $sales = Sale::with('quotation')->where('company_id', $company_id)->receivables()->orderBy(Quotation::select('clients')->whereColumn('quotations.id', 'sales.quotation_id'))->get();
                foreach ($sales as $sale) {
                    $otherFeeTotal = 0;
                    $billPayment = 0;
                    $billingTotal = 0;
                    $incomeTaxTotal = 0;
                    foreach ($sale->billings as $billing) {
                        $saleQty = count(json_decode($billing->sale_id));
                        $descriptions = json_decode($billing->invoice_content)->description;
                        $incomeTax = IncomeTax::where('sale_id', $sale->id)->where('billing_id', $billing->id)->sum('nominal');
                        $incomeTaxTotal = $incomeTaxTotal + $incomeTax;
                        foreach ($billing->bill_payments as $payment) {
                            $salePayments = json_decode($payment->sale_nominal);
                            foreach ($salePayments as $saleNominal) {
                                if($saleNominal->sale_id == $sale->id){
                                    $billPayment = $billPayment + $saleNominal->nominal;
                                }
                            }
                            if($payment->other_fee){
                                $otherFeeTotal = $otherFeeTotal + ($payment->other_fee->nominal / $saleQty);
                            }
                        }
                        foreach($descriptions as $description){
                            if($description->sale_id == $sale->id){
                                $billingTotal = $billingTotal + $description->nominal;
                            }
                        }
                    }
                    if(round($billPayment) < round($billingTotal - $otherFeeTotal - $incomeTaxTotal)){
                        $receivables->push($sale);
                        array_push($dataPayments, $billPayment);
                        array_push($incomeTaxes, $incomeTaxTotal);
                        array_push($otherFees, $otherFeeTotal);
                        array_push($billingNominals, $billingTotal);
                    }
                }
                return view ('receivables.receivables-reports', [
                    'receivables'=>$receivables,
                    'data_payments'=>$dataPayments,
                    'data_billings'=>$billingNominals,
                    'income_taxes'=>$incomeTaxes,
                    'other_fees'=>$otherFees,
                    'title' => 'Laporan G1',
                    compact('sales_categories', 'companies','quotations', 'location_categories', 'areas', 'cities', 'media_sizes', 'locations')
                ]);
            }else{
                $receivables = collect([]);
                $dataPayments = [];
                $billingNominals = [];
                $billings = Billing::where('company_id', $company_id)->receivables()->orderBy('client')->get();
                foreach ($billings as $billing) {
                    $billPayment = 0;
                    $otherFees = 0;
                    $billPayment = $billing->bill_payments->sum('nominal');
                    foreach ($billing->bill_payments as $payment) {
                        if($payment->other_fee){
                            $otherFees = $otherFees + $payment->other_fee->nominal;
                        }
                    }
                    $billingTotal = $billing->nominal + $billing->ppn - ((($billing->dpp/11)*12) * (2/100)) - $otherFees;
                    if(round($billPayment)< round($billingTotal)){
                        $receivables->push($billing);
                        array_push($dataPayments, $billPayment);
                        array_push($billingNominals, $billingTotal);
                    }
                }
                $payments = Payment::with('billings')->get();
                $sales = Sale::with('billings')->get();
                return view ('receivables.receivables-reports', [
                    'receivables'=>$receivables,
                    'data_payments'=>$dataPayments,
                    'billing_nominals'=>$billingNominals,
                    'title' => 'List Piutang',
                    compact('sales', 'payments')
                ]);
            }
        } else {
            abort(403);
        }
    }

}
