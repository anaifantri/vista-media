<?php

namespace App\Http\Controllers;

use App\Models\VatTaxInvoice;
use App\Models\Billing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Validator;
use Gate;

class VatTaxInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(String $company_id): Response
    {
        if(Gate::allows('isCollect') && Gate::allows('isAccountingRead')){
            $billing = Billing::with('vat_tax_invoice')->get();
            return response()-> view ('vat-tax-invoices.index', [
                'vat_tax_invoices'=>VatTaxInvoice::where('company_id', $company_id)->filter(request('search'))->year()->month()->sortable()->orderBy("number", "desc")->paginate(30)->withQueryString(),
                'title' => 'Daftar Faktur Pajak PPN',
                compact('billing')
            ]);
        } else {
            abort(403);
        }
    }

    public function report(String $company_id): Response
    {
        if(Gate::allows('isCollect') && Gate::allows('isAccountingRead')){
            return response()-> view ('vat-tax-invoices.vat-tax-report', [
                'vat_taxes'=>VatTaxInvoice::where('company_id', $company_id)->filter(request('search'))->year()->month()->sortable()->orderBy("number", "asc")->get(),
                'title' => 'List Faktur Pajak'
            ]);
        } else {
            abort(403);
        }
    }

    public function selectBilling(String $companyId): view
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate'))){
            return view ('vat-tax-invoices.select-billings', [
                'billings' => Billing::where('company_id', $companyId)->whereDoesntHave('vat_tax_invoice')->get(),
                'title' => 'Menambahkan Data Faktur PPN'
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
            return  response()-> view ('vat-tax-invoices.create', [
                'billing' => Billing::findOrFail($billingId),
                'title' => 'Menambahkan Data Faktur PPN'
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
            $request->validate([
                'documents.*'=> 'image|file|mimes:jpeg,png,jpg|max:1024',
                'documents' => 'required',
            ]);

            $validateData = $request->validate([
                'number' => 'required|unique:vat_tax_invoices',
                'billing_id' => 'required',
                'company_id' => 'required',
                'nominal' => 'required',
                'tax_date'=>'required'
            ]);

            if($request->file('documents')){
                $getImages = $request->file('documents');
                $images = [];
                foreach($getImages as $image){
                        array_push($images,$image->store('vat_tax_images'));
                }
                
                $validateData['images'] = json_encode($images);
            }

            VatTaxInvoice::create($validateData);

            return redirect('/vat-tax-invoices/index/'.$request->company_id)->with('success', 'Dokumen faktur pajak berhasil diupload');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(VatTaxInvoice $vatTaxInvoice): Response
    {
        if(Gate::allows('isCollect') && Gate::allows('isAccountingRead')){
            return response()-> view('vat-tax-invoices.show', [
                'vat_tax_invoice' => $vatTaxInvoice,
                'billing' => Billing::findOrFail($vatTaxInvoice->billing_id),
                'title' => 'Detail Faktur PPN Nomor '.$vatTaxInvoice->number
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VatTaxInvoice $vatTaxInvoice): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VatTaxInvoice $vatTaxInvoice): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VatTaxInvoice $vatTaxInvoice): RedirectResponse
    {
        //
    }
}
