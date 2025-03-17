<?php

namespace App\Http\Controllers;

use App\Models\BillCoverLetter;
use App\Models\Billing;
use App\Models\VatTaxInvoice;
use App\Models\Sale;
use App\Models\WorkReport;
use App\Models\Quotation;
use App\Models\QuotationRevision;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Validator;
use Gate;

class BillCoverLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(String $company_id): Response
    {
        if(Gate::allows('isCollect') && Gate::allows('isAccountingRead')){
            return response()-> view ('bill-cover-letters.index', [
                'bill_cover_letters'=>BillCoverLetter::where('company_id', $company_id)->sortable()->orderBy("number", "desc")->paginate(30)->withQueryString(),
                'title' => 'Daftar Surat Pengantar Tagihan'
            ]);
        } else {
            abort(403);
        }
    }
    
    public function selectBilling(String $companyId): view
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate'))){
            $quotations = Quotation::with('sales')->get();
            $quotation_revisions = QuotationRevision::with('quotation')->get();
            return view ('bill-cover-letters.select-billings', [
                'billings' => Billing::where('company_id', $companyId)->get(),
                'sales' => Sale::where('company_id', $companyId)->get(),
                'title' => 'Menambahkan Data Faktur PPN',
                compact('quotations', 'quotation_revisions')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(String $billingId): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate'))){
            $dataBilling = Billing::whereIn('id', json_decode($billingId))->get();
            $vat_tax_invoice = VatTaxInvoice::with('billing')->get();
            $work_reports = WorkReport::with('sale')->get();
            return  response()-> view ('bill-cover-letters.create', [
                'billings' => $dataBilling,
                'billing_id' => $billingId,
                'client' => json_decode($dataBilling[0]->client),
                'title' => 'Menambahkan Data Surat Pengantar Tagihan',
                compact('vat_tax_invoice','work_reports')
            ]);
        } else {
            abort(403);
        }
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
    public function show(BillCoverLetter $billCoverLetter): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BillCoverLetter $billCoverLetter): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BillCoverLetter $billCoverLetter): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BillCoverLetter $billCoverLetter): RedirectResponse
    {
        //
    }
}
