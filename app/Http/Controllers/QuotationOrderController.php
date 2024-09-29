<?php

namespace App\Http\Controllers;

use App\Models\QuotationOrder;
use App\Models\Quotation;
use App\Models\MediaCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class QuotationOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    public function showOrders(String $category, String $quotationId): View
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Marketing'){
            $dataOrders = QuotationOrder::where('quotation_id', $quotationId)->get();
            $quotation = Quotation::where('id', $quotationId)->get();
            return view('quotation-orders.show', [
                'quotation_orders' => $dataOrders,
                'quotation' => $quotation,
                'category' => $category,
                'title' => 'Dokumen PO/SPK',
                'categories' => MediaCategory::all()
            ]);
        } else {
            abort(403);
        }
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
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Marketing'){
            if($request->file('document_order')){
                $images = $request->file('document_order');
                foreach($images as $image){
                    $documentOrder = [];
                    $documentOrder = [
                        'quotation_id' => $request->quotation_id,
                        'number' => $request->number,
                        'date' => $request->date,
                        'image' => $image->store('order-images')
                    ];
                    QuotationOrder::create($documentOrder);
                }
            }

            return redirect('/quotation-orders/show-orders/'.$request->quotation_id)->with('success', count($request->document_order).' Dokumen PO/SPK berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(QuotationOrder $quotationOrder): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuotationOrder $quotationOrder): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuotationOrder $quotationOrder): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuotationOrder $quotationOrder): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Marketing'){
            $quotation_id = $quotationOrder->quotation_id;

            if($quotationOrder->image){
                Storage::delete($quotationOrder->image);
            }

            QuotationOrder::destroy($quotationOrder->id);

            return redirect('quotation-orders/show-orders/'.$quotation_id)->with('success','Dokumen PO/SPK berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
