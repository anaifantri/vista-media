<?php

namespace App\Http\Controllers;

use App\Models\BillCoverLetter;
use App\Models\Billing;
use App\Models\BillingLetter;
use App\Models\VatTaxInvoice;
use App\Models\Sale;
use App\Models\Company;
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
                'bill_cover_letters'=>BillCoverLetter::where('company_id', $company_id)->filter(request('search'))->year()->month()->sortable()->orderBy("number", "desc")->paginate(30)->withQueryString(),
                'title' => 'Daftar Surat Pengantar Tagihan'
            ]);
        } else {
            abort(403);
        }
    }

        
    public function preview(String $id): View
    { 
        if(Gate::allows('isCollect') && Gate::allows('isAccountingRead')){
            return view('bill-cover-letters.preview', [
                'bill_cover_letter' => BillCoverLetter::findOrFail($id),
                'title' => 'Preview Surat Pengantar'
            ]);
        } else {
            abort(403);
        }
    }
    
    public function selectBilling(String $companyId, String $category): view
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate'))){
            if($category == "Service"){
                $billings = Billing::where('company_id', $companyId)->where('category', '=', 'Service')->whereDoesntHave('bill_cover_letters')->get();
            }else{
                $billings = Billing::where('company_id', $companyId)->where('category', '!=', 'Service')->whereDoesntHave('bill_cover_letters')->get();
            }
            $quotations = Quotation::with('sales')->get();
            $quotation_revisions = QuotationRevision::with('quotation')->get();
            return view ('bill-cover-letters.select-billings', [
                'billings' => $billings,
                'sales' => Sale::where('company_id', $companyId)->get(),
                'category' => $category,
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
    public function create(String $billingId, String $category): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate'))){
            $dataBilling = Billing::whereIn('id', json_decode($billingId))->get();
            $vat_tax_invoice = VatTaxInvoice::with('billing')->get();
            $work_reports = WorkReport::with('sale')->get();
            return  response()-> view ('bill-cover-letters.create', [
                'billings' => $dataBilling,
                'billing_id' => $billingId,
                'category' => $category,
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
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate'))){
            $romawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
            $dataCompany = Company::where('id', $request->company_id)->firstOrFail();
            // Set number --> start
            $lastLetter = BillCoverLetter::where('company_id', $request->company_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->orderBy("number", "asc")->get()->last();
            if($lastLetter){
                $lastNumber = (int)substr($lastLetter->number,0,3);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
            
            if($newNumber > 0 && $newNumber < 10){
                $number = '00'.$newNumber.'/SP/'.$dataCompany->code.'/'.$romawi[(int) date('m')].'-'. date('Y');
            }else if($newNumber >= 10 && $newNumber < 100 ){
                $number = '0'.$newNumber.'/SP/'.$dataCompany->code.'/'.$romawi[(int) date('m')].'-'. date('Y');
            }else{
                $number = $newNumber.'/SP/'.$dataCompany->code.'/'.$romawi[(int) date('m')].'-'. date('Y');
            }
            // Set number --> end

            $request->request->add(['number' => $number]);
            // dd($request);
            $validateData = $request->validate([
                'number' => 'required|unique:bill_cover_letters',
                'company_id' => 'required',
                'billing_id' => 'required',
                'work_report_id' => 'nullable',
                'vat_tax_invoice_id' => 'nullable',
                'quotation_approval_id' => 'nullable',
                'quotation_order_id' => 'nullable',
                'quotation_agreement_id' => 'nullable',
                'content' => 'required',
                'created_by' => 'required',
                'updated_by' => 'required'
            ]);
            BillCoverLetter::create($validateData);

            $billCoverLetter = BillCoverLetter::where('number', $validateData['number'])->firstOrFail();
            
            $getBillingId = json_decode($validateData['billing_id']);

            foreach ($getBillingId as $billingId) {
                $billingLetter['billing_id'] = $billingId;
                $billingLetter['bill_cover_letter_id'] = $billCoverLetter->id;
                BillingLetter::insert($billingLetter);
            }
    
            return redirect('/bill-cover-letters/preview/'.$billCoverLetter->id)->with('success','Surat pengantar dengan nomor '. $number . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BillCoverLetter $billCoverLetter): Response
    {
        if(Gate::allows('isCollect') && Gate::allows('isAccountingRead')){
            return response()-> view('bill-cover-letters.show', [
                'bill_cover_letter' => $billCoverLetter,
                'title' => 'Detail Surat Pengantar No. '.$billCoverLetter->number
            ]);
        } else {
            abort(403);
        }
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
