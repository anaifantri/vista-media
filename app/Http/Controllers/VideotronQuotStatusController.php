<?php

namespace App\Http\Controllers;

use App\Models\VideotronQuotStatus;
use App\Models\VideotronQuotationApproval;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class VideotronQuotStatusController extends Controller
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
            $validateData = $request->validate([
                'status' => 'required',
                'description' => 'required',
                'status_image' => 'image|file|max:1024',
            ]);
            $validateData['videotron_quotation_id'] = $request->videotron_quotation_id;

            if($request->videotron_quot_revision_id){
                $validateData['videotron_quot_revision_id'] = $request->videotron_quot_revision_id;
            }
            
            VideotronQuotStatus::create($validateData);

            if($request->file('document_approval')){
                $images = $request->file('document_approval');
                foreach($images as $image){
                    $documentApproval = [];
                    $documentApproval = [
                        'videotron_quotation_id' => $validateData['videotron_quotation_id'],
                        'approval_image' => $image->store('approval-images')
                    ];
                    VideotronQuotationApproval::create($documentApproval);
                }
            }
            if($request->videotron_quot_revision_id){
                return redirect('/dashboard/marketing/videotron-quot-revisions/'.$validateData['videotron_quot_revision_id'])->with('success','Progress revisi surat penawaran telah di update');
            }else{
                return redirect('/dashboard/marketing/videotron-quotations/'.$validateData['videotron_quotation_id'])->with('success','Progress surat penawaran telah di update');
            }
            
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(VideotronQuotStatus $videotronQuotStatus): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VideotronQuotStatus $videotronQuotStatus): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VideotronQuotStatus $videotronQuotStatus): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VideotronQuotStatus $videotronQuotStatus): RedirectResponse
    {
        //
    }
}
