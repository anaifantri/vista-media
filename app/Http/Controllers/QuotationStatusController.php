<?php

namespace App\Http\Controllers;

use App\Models\QuotationStatus;
use App\Models\QuotationApproval;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Gate;

class QuotationStatusController extends Controller
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
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isQuotation') && Gate::allows('isMarketingCreate')) || (Gate::allows('isMarketing') && Gate::allows('isQuotation') && Gate::allows('isMarketingCreate'))){
            if($request->status == "Deal"){
                $request->validate([
                    'document_approval.*'=> 'image|file|mimes:jpeg,png,jpg|max:1048',
                    'document_approval' => 'required',
                ]);
                $validateData = $request->validate([
                    'quotation_id' => 'required',
                    'status' => 'required',
                    'description' => 'required',
                    'updated_by' => 'required',
                    'status_image' => 'image|file|max:1024'
                ]);
            }else {
                $validateData = $request->validate([
                    'quotation_id' => 'required',
                    'status' => 'required',
                    'description' => 'required',
                    'updated_by' => 'required',
                    'status_image' => 'image|file|max:1024'
                ]);
            }
            QuotationStatus::create($validateData);

            if($request->file('document_approval')){
                $images = $request->file('document_approval');
                foreach($images as $image){
                    $documentApproval = [];
                    $documentApproval = [
                        'quotation_id' => $validateData['quotation_id'],
                        'image' => $image->store('approval-images')
                    ];
                    QuotationApproval::create($documentApproval);
                }
            }

            return redirect('/marketing/quotations/'.$validateData['quotation_id'])->with('success','Progress surat penawaran telah diperbarui');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(QuotationStatus $quotationStatus): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuotationStatus $quotationStatus): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuotationStatus $quotationStatus): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuotationStatus $quotationStatus): RedirectResponse
    {
        //
    }
}
