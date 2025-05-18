<?php

namespace App\Http\Controllers;

use App\Models\IncomeTaxDocument;
use App\Models\Payment;
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

    /**
     * Show the form for creating a new resource.
     */
    public function create(String $paymentId, String $clientCompany): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate'))){
            return  response()-> view ('income-tax-documents.create', [
                'payment' => Payment::findOrFail($paymentId),
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
                'number' => 'required|unique:income_tax_documents',
                'company' => 'required',
                'payment_id' => 'required',
                'company_id' => 'required',
                'nominal' => 'required',
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IncomeTaxDocument $incomeTaxDocument): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IncomeTaxDocument $incomeTaxDocument): RedirectResponse
    {
        //
    }
}
