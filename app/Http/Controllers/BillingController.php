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

    public function preview(String $category, String $id): View
    { 
        if(Gate::allows('isCollect') && Gate::allows('isAccountingRead')){
            return view('billings.preview', [
                'billing' => Billing::findOrFail($id),
                'category' => $category,
                'title' => 'Preview Penagihan'
            ]);
        } else {
            abort(403);
        }
    }
    
    public function selectSale(String $category, String $companyId): View
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate'))){
            if($category == "media"){
                $data_sales = Sale::with('billings')->billMedia()->where('company_id', $companyId)->get();
            }else if($category == "service"){
                $data_sales = Sale::billService()->where('company_id', $companyId)->get();
            }
            $quotations = Quotation::with('sales')->get();
            $quotation_revisions = QuotationRevision::with('quotation')->get();
            return view ('billings.select-sale', [
                'title' => 'Menambahkan Data Penagihan',
                'data_sales' => $data_sales,
                'bill_category' => $category,
                compact('quotations', 'quotation_revisions')
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

    public function createMediaBilling(String $saleId): View
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate'))){
            $sales = Sale::whereIn('id',json_decode($saleId))->get();
            if (count($sales[0]->quotation->quotation_revisions) != 0) {
                $quotationDeal = $sales[0]->quotation->quotation_revisions->last();
                $price = json_decode($quotationDeal->price);
                $payment_terms = json_decode($quotationDeal->payment_terms);
            } else {
                $quotationDeal = $sales[0]->quotation;
                $price = json_decode($quotationDeal->price);
                $payment_terms = json_decode($quotationDeal->payment_terms);
            }
            $quotation_orders = QuotationOrder::whereIn('sale_id', json_decode($saleId))->get();
            $quotation_agreements = QuotationAgreement::whereIn('sale_id', json_decode($saleId))->get();
            $quotation_approvals = QuotationApproval::where('quotation_id', $sales[0]->quotation->id)->get();
            $clientId = json_decode($sales[0]->quotation->clients)->id;
            $client = Client::findOrFail($clientId);
            $quotationClient = json_decode($sales[0]->quotation->clients);
            return view ('billings.media-create', [
                'title' => 'Membuat Invoice & Kwitansi',
                'sales' => $sales,
                'sale_id' => $saleId,
                'quotation_deal' => $quotationDeal,
                'quotation_approvals' => $quotation_approvals,
                'quotation_orders' => $quotation_orders,
                'quotation_agreements' => $quotation_agreements,
                'price' => $price,
                'sale_price' => $sales->sum('price'),
                'payment_terms' => $payment_terms,
                'client' => $client,
                'quotationClient' => $quotationClient,
                'sale_ppn' => $sales[0]->ppn
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
            
            dd($getSaleNumber);
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

            $request->request->add(['invoice_number' => $invoiceNumber,'receipt_number' => $receiptNumber]);
            
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
            return response()-> view('billings.show', [
                'billing' => $billing,
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
