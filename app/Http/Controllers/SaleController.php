<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Company;
use App\Models\Quotation;
use App\Models\Location;
use App\Models\Area;
use App\Models\City;
use App\Models\MediaSize;
use App\Models\PrintOrder;
use App\Models\InstallOrder;
use App\Models\MediaCategory;
use App\Models\QuotationOrder;
use App\Models\QuotationStatus;
use App\Models\QuotationApproval;
use App\Models\QuotationRevision;
use App\Models\QuotationAgreement;
use App\Models\QuotRevisionStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Carbon\Carbon;
use Validator;
use Gate;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    public function getSales(String $id, String $scope)
    {
        if($scope == "area"){
            $sales = Sale::where('end_at', '>', date('Y-m-d'))
            ->whereHas('location', function($query) use ($id){
                $query->where('area_id', '=', $id);
            })->whereHas('media_category', function($query){
                $query->where('name', '!=', "Service");
            })->get();
        }elseif($scope == "city"){
            $sales = Sale::where('end_at', '>', date('Y-m-d'))
            ->whereHas('location', function($query) use ($id){
                $query->where('area_id', '=', $id);
            })->whereHas('media_category', function($query){
                $query->where('name', '!=', "Service");
            })->get();
        }

        return response()->json(['sales'=> $sales]);
    }

    public function preview(String $category, String $id): View
    { 
        if(Gate::allows('isSale') && Gate::allows('isMarketingRead')){
            $quotation = Quotation::findOrFail($id);
            $revision = QuotationRevision::where('quotation_id', $id)->get()->last();
            if($revision){
                $number = $revision->number;
                $notes = json_decode($revision->notes);
                $created_at = $revision->created_at;
                $payment_terms = json_decode($revision->payment_terms);
                $price = json_decode($revision->price);
                $dataApprovals = QuotationApproval::where('quotation_id', $id)->get();
                $dataAgreements = QuotationAgreement::where('quotation_id', $id)->get();
                $dataOrders = QuotationOrder::where('quotation_id', $id)->get();
            } else{
                $number = $quotation->number;
                $notes = json_decode($quotation->notes);
                $created_at = $quotation->created_at;
                $payment_terms = json_decode($quotation->payment_terms);
                $price = json_decode($quotation->price);
                $lastQuotationStatus = QuotationStatus::where('quotation_id', $id)->get()->last();
                $dataApprovals = QuotationApproval::where('quotation_id', $id)->get();
                $dataAgreements = QuotationAgreement::where('quotation_id', $id)->get();
                $dataOrders = QuotationOrder::where('quotation_id', $id)->get();
            }
            $clients = json_decode($quotation->clients);
            $media_categories = MediaCategory::with('sales')->get();
            $sales = Sale::where('quotation_id', $id)->get();
            return view('sales.preview', [
                'quotation'=>$quotation,
                'sales'=>$sales,
                'number'=>$number,
                'notes'=>$notes,
                'created_at'=>$created_at,
                'clients'=>$clients,
                'price'=>$price,
                'payment_terms'=>$payment_terms,
                'quotation_approvals'=>$dataApprovals,
                'quotation_agreements'=>$dataAgreements,
                'quotation_orders'=>$dataOrders,
                'category'=>$category,
                'title' => 'Data Penjualan'.$category,
                compact('media_categories')
            ]);
        } else {
            abort(403);
        }
    }

    public function report(String $category, Request $request): View
    {
        if($category == "All"){
            $dataCategory = MediaCategory::where('id', $request->media_category_id)->get()->last();
            $sales = Sale::filter(request('search'))->sortable()->category()->paginate(10)->withQueryString();
            $dataLocations = Location::filter(request('search'))->area()->city()->condition()->category()->sortable()->paginate(10)->withQueryString();
        }else{
            $dataCategory = MediaCategory::where('name', $category)->get()->last();
            $media_category_id = $dataCategory->id;
            $sales = Sale::where('media_category_id', $dataCategory->id)->filter(request('search'))->sortable()->paginate(10)->withQueryString();
            $dataLocations = Location::where('media_category_id', $media_category_id)->filter(request('search'))->area()->city()->condition()->sortable()->paginate(10)->withQueryString();
        }

        $media_categories = MediaCategory::with('sales')->get();
        $areas = Area::with('locations')->get();
        $cities = City::with('locations')->get();
        $media_sizes = MediaSize::with('locations')->get();
        $location_categories = MediaCategory::with('locations')->get();
        $companies = Company::with('sales')->get();
        $quotations = Quotation::with('sales')->get();
        return view ('sales.reports', [
            'sales'=>$sales,
            'locations'=>$dataLocations,
            'categories'=>MediaCategory::all(),
            'areas'=>Area::all(),
            'data_category'=>$dataCategory,
            'category'=>$category,
            'title' => 'Daftar Penjualan',
            compact('media_categories', 'companies','quotations', 'location_categories', 'areas', 'cities', 'media_sizes')
        ]);
    }

    public function home(String $category, String $company_id, Request $request): View
    {
        if(Gate::allows('isSale') && Gate::allows('isMarketingRead')){
            if($category == "All"){
                $dataCategory = MediaCategory::where('id', $request->media_category_id)->get()->last();
                $sales = Sale::where('company_id', $company_id)->filter(request('search'))->weekday()->monthly()->annual()->category()->month()->year()->sortable()->orderBy("number", "desc")->paginate(8)->withQueryString();
            }else{
                $dataCategory = MediaCategory::where('name', $category)->get()->last();
                $media_category_id = $dataCategory->id;
                $sales = Sale::where('company_id', $company_id)->where('media_category_id', $dataCategory->id)->filter(request('search'))->category()->weekday()->monthly()->annual()->month()->year()->sortable()->orderBy("number", "desc")->paginate(8)->withQueryString();
            }
    
            $media_categories = MediaCategory::with('sales')->get();
            $companies = Company::with('sales')->get();
            $quotations = Quotation::with('sales')->get();
            return view ('sales.index', [
                'sales'=>$sales,
                'data_category'=>$dataCategory,
                'category'=>$category,
                'title' => 'Daftar Penjualan',
                compact('media_categories', 'companies','quotations')
            ]);
        } else {
            abort(403);
        }
    }

    public function selectQuotation(String $category, String $company_id): View
    {
        if((Gate::allows('isAdmin') && Gate::allows('isSale') && Gate::allows('isMarketingCreate')) || (Gate::allows('isMarketing') && Gate::allows('isSale') && Gate::allows('isMarketingCreate'))){
            $mediaCategory = MediaCategory::where('name', $category)->firstOrFail();
            $media_categories = MediaCategory::with('quotations')->get();
            $quotation_revisions = QuotationRevision::with('quotation')->get();
            return view ('sales.select-quotation', [
                'categories'=>MediaCategory::all(),
                'quotations'=>Quotation::where('company_id', $company_id)->where('media_category_id', $mediaCategory->id)->dealSales()->deal()->filter(request('search'))->sortable()->get(),
                'title' => 'Pilih Penawaran',
                'data_category' => $mediaCategory,
                compact('media_categories', 'quotation_revisions')
            ]);
        } else {
            abort(403);
        }
    }

    public function createSales(String $category, String $quotationId)
    {
        if((Gate::allows('isAdmin') && Gate::allows('isSale') && Gate::allows('isMarketingCreate')) || (Gate::allows('isMarketing') && Gate::allows('isSale') && Gate::allows('isMarketingCreate'))){
            $quotation = Quotation::findOrFail($quotationId);
            $revision = QuotationRevision::where('quotation_id', $quotationId)->get()->last();
            if($revision){
                $number = $revision->number;
                $notes = json_decode($revision->notes);
                $created_at = $revision->created_at;
                $products = json_decode($revision->products);
                $payment_terms = json_decode($revision->payment_terms);
                $price = json_decode($revision->price);
                $lastRevisionStatus = QuotRevisionStatus::where('quotation_revision_id', $revision->id)->get()->last();
            } else{
                $number = $quotation->number;
                $notes = json_decode($quotation->notes);
                $created_at = $quotation->created_at;
                $products = json_decode($quotation->products);
                $payment_terms = json_decode($quotation->payment_terms);
                $price = json_decode($quotation->price);
                $lastQuotationStatus = QuotationStatus::where('quotation_id', $quotationId)->get()->last();
            }
            $clients = json_decode($quotation->clients);
            $mediaCategory = MediaCategory::where('name', $category)->firstOrFail();
            $dataApprovals = QuotationApproval::where('quotation_id', $quotationId)->get();
            $dataOrders = QuotationOrder::where('quotation_id', $quotationId)->get();
            $dataAgreements = QuotationAgreement::where('quotation_id', $quotationId)->get();
            return response()-> view ('sales.create', [
                'quotation'=>$quotation,
                'number'=>$number,
                'notes'=>$notes,
                'created_at'=>$created_at,
                'products'=>$products,
                'clients'=>$clients,
                'price'=>$price,
                'payment_terms'=>$payment_terms,
                'data_approvals'=>$dataApprovals,
                'data_orders'=>$dataOrders,
                'data_agreements'=>$dataAgreements,
                'category'=>$category,
                'data_category' => $mediaCategory,
                'categories'=>MediaCategory::all(),
                'title' => 'Membuat Penjualan'.$category
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isSale') && Gate::allows('isMarketingCreate')) || (Gate::allows('isMarketing') && Gate::allows('isSale') && Gate::allows('isMarketingCreate'))){
            $sales = json_decode($request->salesData);
            $romawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VII', 'IX', 'X', 'XI', 'XII'];
            $dataCompany = Company::where('id', $sales[0]->company_id)->firstOrFail();
            $request->validate([
                'document_po.*'=> 'image|file|mimes:jpeg,png,jpg|max:2048',
                'document_agreement.*'=> 'image|file|mimes:jpeg,png,jpg|max:2048',
            ]);
            // dd($request);
            foreach($sales as $sale){
                // Set number --> start
                $lastSales = Sale::where('company_id', $sale->company_id)->whereYear('created_at', Carbon::now()->year)->orderBy("number", "asc")->get()->last();
                if($lastSales){
                    $lastNumber = (int)substr($lastSales->number,0,4);
                    $newNumber = $lastNumber + 1;
                } else {
                    $newNumber = 1;
                }
                
                if($newNumber > 0 && $newNumber < 10){
                    $number = '000'.$newNumber.'/PJ/'.$dataCompany->code.'/'.$romawi[(int) date('m')].'-'.date('Y');
                }else if($newNumber >= 10 && $newNumber < 100 ){
                    $number = '00'.$newNumber.'/PJ/'.$dataCompany->code.'/'.$romawi[(int) date('m')].'-'.date('Y');
                }else if($newNumber >= 100 && $newNumber < 1000 ){
                    $number = '0'.$newNumber.'/PJ/'.$dataCompany->code.'/'.$romawi[(int) date('m')].'-'.date('Y');
                } else {
                    $number = $newNumber.'/PJ/'.$dataCompany->code.'/'.$romawi[(int) date('m')].'-'.date('Y');
                }
                // Set number --> end
                
                $validateData['number'] = $number;
                $validateData['quotation_id'] = $sale->quotation_id;
                $validateData['location_id'] = $sale->location_id;
                $validateData['company_id'] = $sale->company_id;
                $validateData['media_category_id'] = $sale->media_category_id;
                $validateData['product'] = json_encode($sale->product);
                if($sale->dpp){
                    $validateData['dpp'] = $sale->dpp;
                }
                if($sale->ppn){
                    $validateData['ppn'] = $sale->ppn;
                }
                $validateData['note'] = $sale->note;
                $validateData['price'] = $sale->price;
                $validateData['duration'] = $sale->duration;
                if($sale->start_at){
                    $validateData['start_at'] = date('Y-m-d',strtotime($sale->start_at));
                }
                if($sale->end_at){
                    $validateData['end_at'] = date('Y-m-d',strtotime($sale->end_at));
                }
                $validateData['created_by'] = json_encode($sale->created_by);

                Sale::create($validateData);
            }

            if($request->file('document_po')){
                $images = $request->file('document_po');
                foreach($images as $image){
                    $documentPO = [];
                    $documentPO = [
                        'quotation_id' => $validateData['quotation_id'],
                        'number' => $request->order_number,
                        'date' => $request->order_date,
                        'image' => $image->store('order-images')
                    ];
                    QuotationOrder::create($documentPO);
                }
            }

            if($request->file('document_agreement')){
                $images = $request->file('document_agreement');
                foreach($images as $image){
                    $documentAgreement = [];
                    $documentAgreement = [
                        'quotation_id' => $validateData['quotation_id'],
                        'number' => $request->agreement_number,
                        'date' => $request->agreement_date,
                        'image' => $image->store('agreement-images')
                    ];
                    QuotationAgreement::create($documentAgreement);
                }
            }
                
            return redirect('/marketing/sales/preview/'.$request->category.'/'.$validateData['quotation_id'])->with('success', 'Data penjualan berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale): Response
    {
        if(Gate::allows('isSale') && Gate::allows('isMarketingRead')){
            $quotation = Quotation::findOrFail($sale->quotation->id);
            $revision = QuotationRevision::where('quotation_id', $sale->quotation->id)->get()->last();
            if($revision){
                $revisionStatus = true;
                $number = $revision->number;
                $quotId = $revision->id;
                $notes = json_decode($revision->notes);
                $created_at = $revision->created_at;
                $category = $quotation->media_category->name;
                $products = json_decode($revision->products);
                $payment_terms = json_decode($revision->payment_terms);
                $price = json_decode($revision->price);
                $dataApprovals = QuotationApproval::where('quotation_id', $sale->quotation->id)->get();
                $dataAgreements = QuotationAgreement::where('quotation_id', $sale->quotation->id)->get();
                $dataOrders = QuotationOrder::where('quotation_id', $sale->quotation->id)->get();
            } else{
                $revisionStatus = false;
                $number = $quotation->number;
                $quotId = $quotation->id;
                $notes = json_decode($quotation->notes);
                $created_at = $quotation->created_at;
                $category = $quotation->media_category->name;
                $products = json_decode($quotation->products);
                $payment_terms = json_decode($quotation->payment_terms);
                $price = json_decode($quotation->price);
                $lastQuotationStatus = QuotationStatus::where('quotation_id', $sale->quotation->id)->get()->last();
                $dataApprovals = QuotationApproval::where('quotation_id', $sale->quotation->id)->get();
                $dataAgreements = QuotationAgreement::where('quotation_id', $sale->quotation->id)->get();
                $dataOrders = QuotationOrder::where('quotation_id', $sale->quotation->id)->get();
            }
            $clients = json_decode($quotation->clients);
            $media_categories = MediaCategory::with('sales')->get();
            $print_orders = PrintOrder::whereJsonContains('product->main_sale_id','')->get();
            $install_orders = InstallOrder::whereJsonContains('product->main_sale_id','')->get();
            $paid_print_orders = PrintOrder::whereJsonContains('product->main_sale_id',(string)$sale->id)->get();
            $paid_install_orders = InstallOrder::whereJsonContains('product->main_sale_id',(string)$sale->id)->get();
            return response()->view('sales.show', [
                'sales'=>$sale,
                'quotation'=>$quotation,
                'quot_id'=>$quotId,
                'revision_status'=>$revisionStatus,
                'number'=>$number,
                'notes'=>$notes,
                'created_at'=>$created_at,
                'products'=>$products,
                'clients'=>$clients,
                'price'=>$price,
                'payment_terms'=>$payment_terms,
                'quotation_approvals'=>$dataApprovals,
                'quotation_agreements'=>$dataAgreements,
                'quotation_orders'=>$dataOrders,
                'paid_print_orders' => $paid_print_orders,
                'paid_install_orders' => $paid_install_orders,
                'category'=>$category,
                'title' => 'Data Penjualan'.$category,
                compact('media_categories', 'print_orders', 'install_orders')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isSale') && Gate::allows('isMarketingEdit')) || (Gate::allows('isMarketing') && Gate::allows('isSale') && Gate::allows('isMarketingEdit'))){
            if($request->start_at && $request->end_at){
                if($request->start_at > $request->end_at){
                    return redirect('/marketing/sales/home/'.$request->category.'/'.$request->company_id)->with('failed','Akhir kontrak harus lebih besar dari awal kontrak')->with('id', $request->sales_id);
                }else{
                    $validateData['start_at'] = $request->start_at;
                    $validateData['end_at'] = $request->end_at;
    
                    Sale::where('id', $request->sales_id)
                        ->update($validateData);
                }
                
                return redirect('/marketing/sales/home/'.$request->category.'/'.$request->company_id)->with('success','Tanggal kontrak berhasil diupdate')->with('id', $request->sales_id);
            }else{
                return redirect('/marketing/sales/home/'.$request->category.'/'.$request->company_id)->with('failed','Terdapat tanggal yang belum diinput')->with('id', $request->sales_id);
            }
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale): RedirectResponse
    {
        //
    }
}
