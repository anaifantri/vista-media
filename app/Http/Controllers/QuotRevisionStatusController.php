<?php

namespace App\Http\Controllers;

use App\Models\QuotRevisionStatus;
use App\Models\QuotationApproval;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuotRevisionStatusController extends Controller
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
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Marketing' ){
            if($request->status == "Deal"){
                $request->validate([
                    'document_approval.*'=> 'image|file|mimes:jpeg,png,jpg|max:1048',
                    'document_approval' => 'required',
                ]);
                $validateData = $request->validate([
                    'quotation_id' => 'required',
                    'quotation_revision_id' => 'required',
                    'status' => 'required',
                    'description' => 'required',
                    'updated_by' => 'required',
                    'status_image' => 'image|file|max:1024'
                ]);
            }else {
                $validateData = $request->validate([
                    'quotation_id' => 'required',
                    'quotation_revision_id' => 'required',
                    'status' => 'required',
                    'description' => 'required',
                    'updated_by' => 'required',
                    'status_image' => 'image|file|max:1024'
                ]);
            }
            QuotRevisionStatus::create($validateData);

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

            return redirect('/marketing/quotation-revisions/'.$validateData['quotation_revision_id'])->with('success','Progress revisi surat penawaran telah di update');
            
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(QuotRevisionStatus $quotRevisionStatus): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuotRevisionStatus $quotRevisionStatus): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuotRevisionStatus $quotRevisionStatus): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuotRevisionStatus $quotRevisionStatus): RedirectResponse
    {
        //
    }
}
