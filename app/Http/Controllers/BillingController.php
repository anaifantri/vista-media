<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Company;
use App\Models\Sale;
use App\Models\Quotation;
use App\Models\QuotationOrder;
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
                'billings'=>Billing::where('company_id', $company_id)->sortable()->orderBy("invoice_number", "desc")->paginate(30)->withQueryString(),
                'title' => 'Daftar Penagihan'
            ]);
        } else {
            abort(403);
        }
    }
    
    public function selectSale(String $category): View
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate'))){
            if($category == "media"){
                $data_sales = Sale::billMedia()->get();
            }else if($category == "service"){
                $data_sales = Sale::billService()->get();
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
    
    public function createMediaBilling(String $saleId): View
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate'))){
            $sale = Sale::findOrFail($saleId);
            if (count($sale->quotation->quotation_revisions) != 0) {
                $quotationDeal = $sale->quotation->quotation_revisions->last();
                $price = json_decode($quotationDeal->price);
                $payment_terms = json_decode($quotationDeal->payment_terms);
            } else {
                $quotationDeal = $sale->quotation;
                $price = json_decode($quotationDeal->price);
                $payment_terms = json_decode($quotationDeal->payment_terms);
            }
            $product = json_decode($sale->product);
            $quotation_orders = QuotationOrder::where('sale_id', $saleId)->get();
            $quotation_agreements = QuotationAgreement::where('sale_id', $saleId)->get();
            $quotation_approvals = QuotationApproval::where('quotation_id', $sale->quotation->id)->get();
            $client = json_decode($sale->quotation->clients);
            return view ('billings.media-create', [
                'title' => 'Membuat Invoice & Kwitansi',
                'sale' => $sale,
                'quotation_deal' => $quotationDeal,
                'quotation_approvals' => $quotation_approvals,
                'quotation_orders' => $quotation_orders,
                'quotation_agreements' => $quotation_agreements,
                'price' => $price,
                'payment_terms' => $payment_terms,
                'client' => $client,
                'product' => $product,
                'sale_ppn' => $sale->ppn
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Billing $billing): Response
    {
        //
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
