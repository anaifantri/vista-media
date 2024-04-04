<?php

namespace App\Http\Controllers;

use App\Models\ClientOrder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    public function showClientOrder(){
        $dataClientOrder = ClientOrder::all();
        return response()->json(['dataClientOrder'=> $dataClientOrder]);
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
        if($request->file('document_po')){
            $images = $request->file('document_po');
            foreach($images as $image){
                $documentPO = [];
                $documentPO = [
                    'billboard_quotation_id' => $request->po_billboard_quotation_id,
                    'billboard_quot_revision_id' => $request->po_billboard_quot_revision_id,
                    'name' => $request->order_name,
                    'number' => $request->order_number,
                    'order_date' => $request->order_date,
                    'order_image' => $image->store('order-images')
                ];
                ClientOrder::create($documentPO);
            }
            return back()->with('order_success','Dokumen PO/SPK berhasil ditambahkan');
        }
        // dd($documentPO);
    }

    /**
     * Display the specified resource.
     */
    public function show(ClientOrder $clientOrder): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClientOrder $clientOrder): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClientOrder $clientOrder): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClientOrder $clientOrder): RedirectResponse
    {
        //
    }
}
