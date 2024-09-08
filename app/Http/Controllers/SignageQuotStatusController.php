<?php

namespace App\Http\Controllers;

use App\Models\SignageQuotStatus;
use App\Models\SignageApproval;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class SignageQuotStatusController extends Controller
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
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            if($request->status == "Deal"){
                $validateData = $request->validate([
                    'status' => 'required',
                    'description' => 'required',
                    'updated_by' => 'required',
                    'status_image' => 'image|file|max:1024',
                    'document_approval' => 'required'
                ]);
            }else {
                $validateData = $request->validate([
                    'status' => 'required',
                    'description' => 'required',
                    'updated_by' => 'required',
                    'status_image' => 'image|file|max:1024'
                ]);
            }
            $validateData['signage_quotation_id'] = $request->signage_quotation_id;

            if($request->signage_quot_revision_id){
                $validateData['signage_quot_revision_id'] = $request->signage_quot_revision_id;
            } else {
                $validateData['signage_quot_revision_id'] = null;
            }
            
            // dd($validateData);
            SignageQuotStatus::create($validateData);

            if($request->file('document_approval')){
                $images = $request->file('document_approval');
                foreach($images as $image){
                    $documentApproval = [];
                    $documentApproval = [
                        'signage_quotation_id' => $validateData['signage_quotation_id'],
                        'signage_quot_revision_id' => $validateData['signage_quot_revision_id'],
                        'approval_image' => $image->store('approval-images')
                    ];
                    SignageApproval::create($documentApproval);
                }
            }
            if($request->signage_quot_revision_id){
                return redirect('/dashboard/marketing/signage-quot-revisions/'.$validateData['signage_quot_revision_id'])->with('success','Progress revisi surat penawaran telah di update');
            }else{
                return redirect('/dashboard/marketing/signage-quotations/'.$validateData['signage_quotation_id'])->with('success','Progress surat penawaran telah di update');
            }
            
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SignageQuotStatus $signageQuotStatus): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SignageQuotStatus $signageQuotStatus): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SignageQuotStatus $signageQuotStatus): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SignageQuotStatus $signageQuotStatus): RedirectResponse
    {
        //
    }
}
