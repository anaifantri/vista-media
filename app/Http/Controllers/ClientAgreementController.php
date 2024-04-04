<?php

namespace App\Http\Controllers;

use App\Models\ClientAgreement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientAgreementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    public function showClientAgreement(){
        $dataClientAgreement = ClientAgreement::all();
        return response()->json(['dataClientAgreement'=> $dataClientAgreement]);
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
        if($request->file('document_agreement')){
            $images = $request->file('document_agreement');
            foreach($images as $image){
                $documentAgreement = [];
                $documentAgreement = [
                    'billboard_quotation_id' => $request->agreement_billboard_quotation_id,
                    'billboard_quot_revision_id' => $request->agreement_billboard_quot_revision_id,
                    'number' => $request->agreement_number,
                    'date' => $request->agreement_date,
                    'agreement_image' => $image->store('agreement-images')
                ];
                ClientAgreement::create($documentAgreement);
            }
            // dd($documentAgreement['number']);
            return back()->with('agreement_success','Dokumen agreement berhasil ditambahkan');
        }
        // dd($documentAgreement);
    }

    /**
     * Display the specified resource.
     */
    public function show(ClientAgreement $clientAgreement): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClientAgreement $clientAgreement): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClientAgreement $clientAgreement): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClientAgreement $clientAgreement): RedirectResponse
    {
        //
    }
}
