<?php

namespace App\Http\Controllers;

use App\Models\QuotationOrder;
use App\Models\Sale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Gate;

class QuotationOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    public function showOrders(String $category, String $saleId): View
    {
        if(Gate::allows('isSale') && Gate::allows('isMarketingRead')){
            $dataOrders = QuotationOrder::where('sale_id', $saleId)->get();
            $sale = Sale::findOrFail($saleId);
            return view('quotation-orders.show', [
                'quotation_orders' => $dataOrders,
                'sale' => $sale,
                'category' => $category,
                'title' => 'Dokumen PO'
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
        if((Gate::allows('isAdmin') && Gate::allows('isSale') && Gate::allows('isMarketingCreate')) || (Gate::allows('isMarketing') && Gate::allows('isSale') && Gate::allows('isMarketingCreate'))){
            $request->validate([
                'document_order.*'=> 'image|file|mimes:jpeg,png,jpg|max:1024',
                'document_order' => 'required',
            ]);
            $request->request->add(['user_id' => auth()->user()->id]);
        
            $validateData = $request->validate([
                'sale_id' => 'required',
                'user_id' => 'required',
                'quotation_id' => 'required',
                'number' => 'required',
                'date' => 'required'
            ]);

            $getImages = $request->file('document_order');
            $images = [];
            foreach($getImages as $image){
                array_push($images,$image->store('order-images'));
            }
            $validateData['images'] = json_encode($images);   

            QuotationOrder::create($validateData);

            return redirect('/marketing/quotation-orders/show-orders/'.$request->category.'/'.$request->sale_id)->with('success', ' Dokumen PO dengan nomor '.$request->number.' berhasil ditambahkan');
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
        if((Gate::allows('isAdmin') && Gate::allows('isSale') && Gate::allows('isMarketingEdit')) || (Gate::allows('isMarketing') && Gate::allows('isSale') && Gate::allows('isMarketingEdit'))){
            $sale = Sale::findOrFail($quotationOrder->sale->id);
            $category = $sale->media_category->name;
            $images = json_decode($quotationOrder->images);
            return response()->view('quotation-orders.edit', [
                'quotation_order' => $quotationOrder,
                'sale' => $sale,
                'category' => $category,
                'images' => $images,
                'title' => 'Edit Dokumen PO'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuotationOrder $quotationOrder): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isSale') && Gate::allows('isMarketingEdit')) || (Gate::allows('isMarketing') && Gate::allows('isSale') && Gate::allows('isMarketingEdit'))){
            $sale_id = $quotationOrder->sale->id;
            $category = $quotationOrder->sale->media_category->name;
            $request->validate([
                'document_order.*'=> 'image|file|mimes:jpeg,png,jpg|max:1024'
            ]);
        
            $validateData = $request->validate([
                'number' => 'required',
                'date' => 'required'
            ]);

            if($request->file('document_order')){
                $newImages = $request->file('document_order');
                $oldImages = [];
                $oldImages = json_decode($request->oldImages);
                if(count($oldImages) > 0){
                    foreach ($oldImages as $oldImage) {
                        Storage::delete($oldImage);
                    }
                }
                $images = [];
                foreach($newImages as $newImage){
                    array_push($images,$newImage->store('order-images'));
                }
                $validateData['images'] = json_encode($images); 

            }

            QuotationOrder::where('id', $quotationOrder->id)->update($validateData);

            return redirect('/marketing/quotation-orders/show-orders/'.$category.'/'.$sale_id)->with('success', ' Dokumen PO dengan nomor '.$quotationOrder->number.' berhasil dirubah');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuotationOrder $quotationOrder): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isSale') && Gate::allows('isMarketingDelete')) || (Gate::allows('isMarketing') && Gate::allows('isSale') && Gate::allows('isMarketingDelete'))){
            $images = json_decode($quotationOrder->images);
            $sale_id = $quotationOrder->sale->id;
            $category = $quotationOrder->sale->media_category->name;

            foreach ($images as $image) {
                Storage::delete($image);
            }

            QuotationOrder::destroy($quotationOrder->id);

            return redirect('marketing/quotation-orders/show-orders/'.$category.'/'.$sale_id)->with('success','Dokumen PO dengan nomor '.$quotationOrder->number.' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
