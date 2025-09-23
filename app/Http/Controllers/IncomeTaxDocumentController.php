<?php

namespace App\Http\Controllers;

use App\Models\IncomeTaxDocument;
use App\Models\Payment;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Validator;
use Gate;

class IncomeTaxDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    public function report(String $company_id): Response
    {
        if(Gate::allows('isCollect') && Gate::allows('isAccountingRead')){
            return response()-> view ('income-taxes.income-tax-report', [
                'income_taxes'=>IncomeTaxDocument::where('company_id', $company_id)->filter(request('search'))->period()->sortable()->orderBy("tax_date", "asc")->get(),
                'title' => 'List Pemotongan Pph'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(String $paymentId, String $clientCompany): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate'))){
            $payment = Payment::findOrFail($paymentId);
            $billingClient = json_decode($payment->billings[0]->client);
            $client = Client::findOrFail($billingClient->id);
            return  response()-> view ('income-tax-documents.create', [
                'payment' => $payment,
                'bill_client' => $billingClient,
                'client' => $client,
                'client_company' => $clientCompany,
                'title' => 'Menambahkan Dokumen Bukti Potong PPh'
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
                'number' => 'required',
                'company' => 'required',
                'payment_id' => 'required',
                'company_id' => 'required',
                'nominal' => 'required',
                'client_city' => 'required',
                'period' => 'required',
                'tax_date'=>'required'
            ]);

            if($request->file('documents')){
                $getImages = $request->file('documents');
                $images = [];
                foreach($getImages as $image){
                        array_push($images,$image->store('income_tax_documents'));
                }
                
                $validateData['images'] = json_encode($images);
            }

            IncomeTaxDocument::create($validateData);

            if(request('old_city') == "" || (request('old_city') != request('client_city'))){
                $data_city['city'] = $request->client_city;
                Client::where('id', request('client_id'))
                        ->update($data_city);
            }

            return redirect('/income-taxes/index/'.$request->company_id)->with('success', 'Dokumen bukti potong PPh berhasil diupload');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(IncomeTaxDocument $incomeTaxDocument): Response
    {
        if(Gate::allows('isCollect') && Gate::allows('isAccountingRead')){
            return response()-> view('income-tax-documents.show', [
                'income_tax_document' => $incomeTaxDocument,
                'payment' => Payment::findOrFail($incomeTaxDocument->payment_id),
                'title' => 'Detail Bukti Potong PPH'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IncomeTaxDocument $incomeTaxDocument): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingEdit')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingEdit'))){
            return  response()-> view ('income-tax-documents.edit', [
                'income_tax_document' => $incomeTaxDocument,
                'title' => 'Edit Dokumen Bukti Potong PPh'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IncomeTaxDocument $incomeTaxDocument): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingEdit')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingEdit'))){
            if($request->file('documents')){
                $request->validate([
                'documents.*'=> 'image|file|mimes:jpeg,png,jpg|max:1024'
            ]);
            }

            $rules = [
                'number' => 'required',
                'nominal' => 'required',
                'tax_date' => 'required',
                'period' => 'required'
            ];

            $validateData = $request->validate($rules);

            if($request->file('documents')){
                $getImages = $request->file('documents');
                $images = [];
                foreach($getImages as $image){
                        array_push($images,$image->store('income_tax_documents'));
                }
                
                $validateData['images'] = json_encode($images);
            }

            IncomeTaxDocument::where('id', $incomeTaxDocument->id)
                ->update($validateData);
        
            return redirect('/accounting/income-tax-documents/'.$incomeTaxDocument->id)->with('success','Bukti Potong dengan nomor '. $incomeTaxDocument->number . ' berhasil dirubah');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IncomeTaxDocument $incomeTaxDocument): RedirectResponse
    {
        //
    }
}
