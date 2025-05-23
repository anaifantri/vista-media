<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\BillingSale;
use App\Models\Company;
use App\Models\Sale;
use App\Models\Client;
use App\Models\Quotation;
use App\Models\QuotationOrder;
use App\Models\InstallOrder;
use App\Models\QuotationApproval;
use App\Models\QuotationAgreement;
use App\Models\QuotationRevision;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Validator;
use Gate;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(String $company_id): Response
    {
        if(Gate::allows('isCollect') && Gate::allows('isAccountingRead')){
            return response()-> view ('billings.index', [
                'billings'=>Billing::where('company_id', $company_id)->filter(request('search'))->year()->month()->sortable()->orderBy("invoice_number", "desc")->paginate(30)->withQueryString(),
                'title' => 'Daftar Penagihan'
            ]);
        } else {
            abort(403);
        }
    }

    public function report(String $company_id): Response
    {
        if(Gate::allows('isCollect') && Gate::allows('isAccountingRead')){
            return response()-> view ('billings.billing-report', [
                'billings'=>Billing::where('company_id', $company_id)->filter(request('search'))->year()->month()->sortable()->orderBy("invoice_number", "asc")->get(),
                'title' => 'Laporan Invoice'
            ]);
        } else {
            abort(403);
        }
    }

    public function preview(String $category, String $id): View
    { 
        if(Gate::allows('isCollect') && Gate::allows('isAccountingRead')){
            $billing = Billing::findOrFail($id);
            $sales = $billing->sales;
            $product = json_decode($sales[0]->product);
            $approvals = json_decode($billing->invoice_content)->approval;
            $orders = json_decode($billing->invoice_content)->orders;
            if($billing->category == "Media"){
                $agreements = json_decode($billing->invoice_content)->agreements;
            }else{
                $agreements = [];
            }
            return view('billings.preview', [
                'billing' => $billing,
                'category' => $category,
                'approvals' => $approvals,
                'orders' => $orders,
                'agreements' => $agreements,
                'product' => $product,
                'title' => 'Preview Penagihan'
            ]);
        } else {
            abort(403);
        }
    }
        
    public function selectModel(): View
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate'))){
            return view ('billings.select-model', [
                'title' => 'Pilih Model Invoice'
            ]);
        } else {
            abort(403);
        }
    }
    
    public function selectSale(String $category, String $companyId): View
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate'))){
            $quotations = Quotation::with('sales')->get();
            $quotation_revisions = QuotationRevision::with('quotation')->get();
            if($category == "media"){
                $data_sales = Sale::with('billings')->billMedia()->where('company_id', $companyId)->get();
                return view ('billings.select-sale', [
                    'title' => 'Menambahkan Data Penagihan',
                    'data_sales' => $data_sales,
                    'bill_category' => $category,
                    'model' => request('model'),
                    compact('quotations', 'quotation_revisions')
                ]);
            }else if($category == "service"){
                $data_sales = Sale::billService()->where('company_id', $companyId)->get();
                return view ('billings.select-sale', [
                    'title' => 'Menambahkan Data Penagihan',
                    'data_sales' => $data_sales,
                    'bill_category' => $category,
                    compact('quotations', 'quotation_revisions')
                ]);
            }
        } else {
            abort(403);
        }
    }

    public function selectTerm(String $saleId): View
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate'))){
            $sales = Sale::whereIn('id',json_decode($saleId))->orderBy("number", "asc")->get();
            $quotations = Quotation::with('sales')->get();
            $quotation_revisions = QuotationRevision::with('quotation')->get();
            $client = json_decode($sales[0]->quotation->clients);
            if(request('model') == "auto"){
                return view ('billings.select-terms', [
                    'title' => 'Membuat Invoice & Kwitansi',
                    'sales' => $sales,
                    'sale_id' => $saleId,
                    'client' => $client,
                    'model' => request('model'),
                    compact('quotations', 'quotation_revisions')
                ]);
            }else{
                return view ('billings.manual-terms', [
                    'title' => 'Membuat Invoice & Kwitansi',
                    'sales' => $sales,
                    'sale_id' => $saleId,
                    'client' => $client,
                    'model' => request('model'),
                    compact('quotations', 'quotation_revisions')
                ]);
            }
        } else {
            abort(403);
        }
    }

    public function selectDocuments(Request $request): View
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate'))){
            $saleId = json_decode(request('sale_id'));
            $sales = Sale::whereIn('id', $saleId)->get();
            $approvals = [];
            $orders = [];
            $agreements = [];
            foreach ($sales as $sale) {
                if (count($sale->quotation->quotation_revisions) != 0) {
                    $quotationDeal = $sale->quotation->quotation_revisions->last();
                } else {
                    $quotationDeal = $sale->quotation;
                }
                array_push($approvals, (object)[
                    'id' =>  $quotationDeal->id,
                    'number' =>  $quotationDeal->number,
                    'created_at' =>  $quotationDeal->created_at
                ]);
                $dataOrders = $sale->quotation_orders;
                $dataAgreements = $sale->quotation_agreements;
                foreach($dataOrders as $dataOrder){
                    array_push($orders, $dataOrder);
                }
                foreach($dataAgreements as $dataAgreement){
                    array_push($agreements, $dataAgreement);
                }
            }
            return view ('billings.select-documents', [
                'invoice_content' => json_decode(request('invoice_content')),
                'receipt_content' => json_decode(request('receipt_content')),
                'client' => json_decode(request('client')),
                'sale_id' => json_decode(request('sale_id')),
                'sale_year' => request('sale_year'),
                'sale_number' => request('sale_number'),
                'model' => request('model'),
                'approvals' => $approvals,
                'orders' => $orders,
                'agreements' => $agreements,
                'title' => 'Pilih Dokumen Pendukung Invoice'
            ]);
        } else {
            abort(403);
        }
    }
    
    public function createServiceBilling(String $saleId): View
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate'))){
            $sales = Sale::whereIn('id',json_decode($saleId))->get();
            if (count($sales[0]->quotation->quotation_revisions) != 0) {
                $quotationDeal = $sales[0]->quotation->quotation_revisions->last();
                $price = json_decode($quotationDeal->price);
            } else {
                $quotationDeal = $sales[0]->quotation;
                $price = json_decode($quotationDeal->price);
            }
            $install_orders = InstallOrder::with('sale')->get();
            $quotation_orders = QuotationOrder::where('quotation_id', $sales[0]->quotation->id)->get();
            $clientId = json_decode($sales[0]->quotation->clients)->id;
            $client = Client::findOrFail($clientId);
            $quotationClient = json_decode($sales[0]->quotation->clients);
            return view ('billings.service-create', [
                'title' => 'Membuat Invoice & Kwitansi',
                'sales' => $sales,
                'sale_id' => json_decode($saleId),
                'quotation_deal' => $quotationDeal,
                'quotation_orders' => $quotation_orders,
                'price' => $price,
                'client' => $client,
                'quotationClient' => $quotationClient,
                compact('install_orders')
            ]);
        } else {
            abort(403);
        }
    }

    public function createMediaBilling(Request $request): view
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate'))){
            $sale = Sale::findOrFail(json_decode(request('sale_id'))[0]);
            $product = json_decode($sale->product);
            // dd(json_decode(request('invoice_content')));
            return view ('billings.media-create', [
                'sale' => $sale,
                'invoice_content' => json_decode(request('invoice_content')),
                'receipt_content' => json_decode(request('receipt_content')),
                'client' => json_decode(request('client')),
                'sale_id' => json_decode(request('sale_id')),
                'approvals' => json_decode(request('invoice_content'))->approval,
                'orders' => json_decode(request('invoice_content'))->orders,
                'agreements' => json_decode(request('invoice_content'))->agreements,
                'sale_year' => request('sale_year'),
                'sale_number' => request('sale_number'),
                'model' => request('model'),
                'merge' => request('merge'),
                'product' => $product,
                'title' => 'Membuat Invoice & Kwitansi'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate'))){
            if($request->category == "Media"){
                $getSaleNumber = $request->sale_number;
            }elseif($request->category == "Service"){
                $saleNumber = json_decode($request->sale_number);
                sort($saleNumber);
                if(count($saleNumber) > 1){
                    $getSaleNumber = $saleNumber[0].'-'.end($saleNumber);
                }else{
                    $getSaleNumber = $saleNumber[0];
                }
            }
            
            $romawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VII', 'IX', 'X', 'XI', 'XII'];
            $dataCompany = Company::where('id', $request->company_id)->firstOrFail();
            // Set number --> start
            $lastBilling = Billing::where('company_id', $request->company_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->orderBy("invoice_number", "asc")->get()->last();
            if($lastBilling){
                $lastNumber = (int) substr($lastBilling->invoice_number,0,3);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
            
            if($newNumber > 0 && $newNumber < 10){
                $invoice_number = '00'.$newNumber.'/INV/'.$getSaleNumber.':'.$request->sale_year.'/'.$romawi[(int) date('m')].'-'. date('Y');
                $receipt_number = '00'.$newNumber.'/KW/'.$getSaleNumber.':'.$request->sale_year.'/'.$romawi[(int) date('m')].'-'. date('Y');
            }else if($newNumber >= 10 && $newNumber < 100 ){
                $invoice_number = '0'.$newNumber.'/INV/'.$getSaleNumber.':'.$request->sale_year.'/'.$romawi[(int) date('m')].'-'. date('Y');
                $receipt_number = '0'.$newNumber.'/KW/'.$getSaleNumber.':'.$request->sale_year.'/'.$romawi[(int) date('m')].'-'. date('Y');
            }else if($newNumber >= 100 && $newNumber < 1000 ){
                $invoice_number = $newNumber.'/INV/'.$getSaleNumber.':'.$request->sale_year.'/'.$romawi[(int) date('m')].'-'. date('Y');
                $receipt_number = $newNumber.'/KW/'.$getSaleNumber.':'.$request->sale_year.'/'.$romawi[(int) date('m')].'-'. date('Y');
            }
            // Set number --> end
            $invoiceNumber = $invoice_number;
            $receiptNumber = $receipt_number;

            $invoiceContent = json_decode($request->invoice_content);
            if(count($invoiceContent->description) > 1){
                $invoiceContent->merge = $request->merge;
                $request->request->add(['invoice_number' => $invoiceNumber,'receipt_number' => $receiptNumber,'invoice_content' => json_encode($invoiceContent)]);
            }else{
                $request->request->add(['invoice_number' => $invoiceNumber,'receipt_number' => $receiptNumber]);
            }
            // dd(json_decode($request->invoice_content));
            
            $validateData = $request->validate([
                'company_id' => 'required',
                'sale_id' => 'required',
                'category' => 'required',
                'invoice_number' => 'required|unique:billings',
                'invoice_content' => 'required',
                'receipt_number' => 'required|unique:billings',
                'receipt_content' => 'required',
                'client' => 'required',
                'dpp' => 'nullable',
                'ppn' => 'required',
                'nominal' => 'required',
                'created_by' => 'required',
                'updated_by' => 'required'
            ]);
            
            // dd($validateData);

            Billing::create($validateData);

            $dataBilling = Billing::where('invoice_number', $validateData['invoice_number'])->firstOrFail();
            $getSaleId = json_decode($validateData['sale_id']);
            foreach ($getSaleId as $saleId) {
                $billingSale['sale_id'] = $saleId;
                $billingSale['billing_id'] = $dataBilling->id;
                BillingSale::insert($billingSale);
            }
                
            return redirect('/billings/preview/'.$request->category.'/'.$dataBilling->id)->with('success', 'Data penagihan dengan nomor invoice '.$validateData['invoice_number'].' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Billing $billing): Response
    {
        if(Gate::allows('isCollect') && Gate::allows('isAccountingRead')){
            $sales = $billing->sales;
            $product = json_decode($sales[0]->product);
            $approvals = json_decode($billing->invoice_content)->approval;
            $orders = json_decode($billing->invoice_content)->orders;
            if($billing->category == "Media"){
                $agreements = json_decode($billing->invoice_content)->agreements;
            }else{
                $agreements = [];
            }            
            return response()-> view('billings.show', [
                'billing' => $billing,
                'category' => $billing->category,
                'approvals' => $approvals,
                'orders' => $orders,
                'agreements' => $agreements,
                'product' => $product,
                'title' => 'Detail Invoice '.$billing->invoice_number
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Billing $billing): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Billing $billing): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Billing $billing): RedirectResponse
    {
        //
    }
}
