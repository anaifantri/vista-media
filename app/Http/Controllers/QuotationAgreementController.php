<?php

namespace App\Http\Controllers;

use App\Models\QuotationAgreement;
use App\Models\Sale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Gate;

class QuotationAgreementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    public function showAgreements(String $category, String $saleId): View
    {
        if(Gate::allows('isSale') && Gate::allows('isMarketingRead')){
            $dataAgreements = QuotationAgreement::where('sale_id', $saleId)->get();
            $sale = Sale::findOrFail($saleId);
            return view('quotation-agreements.show', [
                'quotation_agreements' => $dataAgreements,
                'sale' => $sale,
                'category' => $category,
                'title' => 'Dokumen Agreement'
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
                'document_agreement.*'=> 'image|file|mimes:jpeg,png,jpg|max:1024',
                'document_agreement' => 'required',
            ]);
            $request->request->add(['user_id' => auth()->user()->id]);
        
            $validateData = $request->validate([
                'sale_id' => 'required',
                'user_id' => 'required',
                'quotation_id' => 'required',
                'number' => 'required',
                'date' => 'required'
            ]);

            $getImages = $request->file('document_agreement');
            $images = [];
            foreach($getImages as $image){
                array_push($images,$image->store('agreement-images'));
            }
            $validateData['images'] = json_encode($images);   

            QuotationAgreement::create($validateData);

            return redirect('/marketing/quotation-agreements/show-agreements/'.$request->category.'/'.$request->sale_id)->with('success', ' Dokumen Perjanjian dengan nomor '.$request->number.' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(QuotationAgreement $quotationAgreement): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuotationAgreement $quotationAgreement): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isSale') && Gate::allows('isMarketingEdit')) || (Gate::allows('isMarketing') && Gate::allows('isSale') && Gate::allows('isMarketingEdit'))){
            $sale = Sale::findOrFail($quotationAgreement->sale->id);
            $category = $sale->media_category->name;
            $images = json_decode($quotationAgreement->images);
            return response()->view('quotation-agreements.edit', [
                'quotation_agreement' => $quotationAgreement,
                'sale' => $sale,
                'category' => $category,
                'images' => $images,
                'title' => 'Edit Dokumen Perjanjian'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuotationAgreement $quotationAgreement): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isSale') && Gate::allows('isMarketingEdit')) || (Gate::allows('isMarketing') && Gate::allows('isSale') && Gate::allows('isMarketingEdit'))){
            $sale_id = $quotationAgreement->sale->id;
            $category = $quotationAgreement->sale->media_category->name;
            $request->validate([
                'document_agreement.*'=> 'image|file|mimes:jpeg,png,jpg|max:1024'
            ]);
        
            $validateData = $request->validate([
                'number' => 'required',
                'date' => 'required'
            ]);

            if($request->file('document_agreement')){
                $newImages = $request->file('document_agreement');
                $oldImages = [];
                $oldImages = json_decode($request->oldImages);
                if(count($oldImages) > 0){
                    foreach ($oldImages as $oldImage) {
                        Storage::delete($oldImage);
                    }
                }
                $images = [];
                foreach($newImages as $newImage){
                    array_push($images,$newImage->store('agreement-images'));
                }
                $validateData['images'] = json_encode($images); 
            }

            QuotationAgreement::where('id', $quotationAgreement->id)->update($validateData);

            return redirect('/marketing/quotation-agreements/show-agreements/'.$category.'/'.$sale_id)->with('success', ' Dokumen Perjanjian dengan nomor '.$quotationAgreement->number.' berhasil dirubah');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuotationAgreement $quotationAgreement): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isSale') && Gate::allows('isMarketingDelete')) || (Gate::allows('isMarketing') && Gate::allows('isSale') && Gate::allows('isMarketingDelete'))){
            $images = json_decode($quotationAgreement->images);
            $sale_id = $quotationAgreement->sale->id;
            $category = $quotationAgreement->sale->media_category->name;

            foreach ($images as $image) {
                Storage::delete($image);
            }

            QuotationAgreement::destroy($quotationAgreement->id);

            return redirect('marketing/quotation-agreements/show-agreements/'.$category.'/'.$sale_id)->with('success','Dokumen Perjanjian dengan nomor '.$quotationAgreement->number.' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
