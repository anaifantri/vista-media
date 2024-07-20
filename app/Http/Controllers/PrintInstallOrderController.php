<?php

namespace App\Http\Controllers;

use App\Models\PrintInstallOrder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PrintInstallOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    public function printInstallOrder(){
        $dataOrder = PrintInstallOrder::all();
        return response()->json(['dataOrder'=> $dataOrder]);
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
            if($request->file('document_po')){
                $images = $request->file('document_po');
                foreach($images as $image){
                    $documentPO = [];
                    $documentPO = [
                        'print_instal_quotation_id' => $request->print_instal_quotation_id,
                        'name' => $request->order_name,
                        'number' => $request->order_number,
                        'order_date' => $request->order_date,
                        'order_image' => $image->store('print-install-order-images')
                    ];
                    PrintInstallOrder::create($documentPO);
                }
            }

            return back()->with('order_success','Dokumen PO/SPK berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PrintInstallOrder $printInstallOrder): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrintInstallOrder $printInstallOrder): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrintInstallOrder $printInstallOrder): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrintInstallOrder $printInstallOrder): RedirectResponse
    {
        //
    }
}
