<?php

namespace App\Http\Controllers;

use App\Models\BillboardQuotStatus;
use App\Models\ClientApproval;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BillboardQuotStatusController extends Controller
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
            if ($request->document_approval == null){
                return back()->withErrors(['document_approval' => ['Silahkan pilih dokumen approval']])->withInput();
            }
        }

        $validateData = $request->validate([
            'status' => 'required',
            'description' => 'required',
            'status_image' => 'image|file|max:1024',
        ]);

        // dd($request->billboard_quotation_id);

        if($request->billboard_quot_revision_id == ""){
            $validateData['billboard_quot_revision_id'] = null;
        } else {
            $validateData['billboard_quot_revision_id'] = $request->billboard_quot_revision_id;
        }
        
        if($request->billboard_quotation_id == ""){
            $validateData['billboard_quotation_id'] = null;
        } else {
            $validateData['billboard_quotation_id'] = $request->billboard_quotation_id;
        }
        
        $validateData['user_id'] = auth()->user()->id;

        // dd($validateData['billboard_quotation_id']);
            
        BillboardQuotStatus::create($validateData);

        if($request->file('document_approval')){
            $documentApproval = [];
            $images = $request->file('document_approval');
            foreach($images as $image){
                $documentApproval[] = [
                    'billboard_quotation_id' => $validateData['billboard_quotation_id'],
                    'billboard_quot_revision_id' => $validateData['billboard_quot_revision_id'],
                    'approval_image' => $image->store('approval-images')
                ];
            }
            // dd($documentApproval);
            ClientApproval::insert($documentApproval);
        }
        // dd($validateData);

        if($request->billboard_quot_revision_id != ""){
        return redirect('/dashboard/marketing/billboard-quot-revisions/'.$validateData['billboard_quot_revision_id'])->with('success','Progress revisi surat penawaran telah di update');
        } elseif($request->billboard_quotation_id != ""){
            return redirect('/dashboard/marketing/billboard-quotations/'.$validateData['billboard_quotation_id'])->with('success','Progress surat penawaran telah di update');
        }
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BillboardQuotStatus $billboardQuotStatus): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BillboardQuotStatus $billboardQuotStatus): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BillboardQuotStatus $billboardQuotStatus): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BillboardQuotStatus $billboardQuotStatus): RedirectResponse
    {
        //
    }
}
