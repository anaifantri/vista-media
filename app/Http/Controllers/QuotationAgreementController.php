<?php

namespace App\Http\Controllers;

use App\Models\QuotationAgreement;
use App\Models\Quotation;
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

    public function showAgreements(String $category, String $quotationId): View
    {
        if(Gate::allows('isSale') && Gate::allows('isMarketingRead')){
            $dataAgreements = QuotationAgreement::where('quotation_id', $quotationId)->get();
            $quotation = Quotation::where('id', $quotationId)->get();
            return view('quotation-agreements.show', [
                'quotation_agreements' => $dataAgreements,
                'quotation' => $quotation,
                'category' => $category,
                'title' => 'Dokumen Perjanjian'
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
            if($request->file('document_agreement')){
                $images = $request->file('document_agreement');
                foreach($images as $image){
                    $documentAgreement = [];
                    $documentAgreement = [
                        'quotation_id' => $request->quotation_id,
                        'number' => $request->number,
                        'date' => $request->date,
                        'image' => $image->store('agreement-images')
                    ];
                    QuotationAgreement::create($documentAgreement);
                }
            }

            return redirect('/marketing/quotation-agreements/show-agreements/'.$request->category.'/'.$request->quotation_id)->with('success', count($request->document_agreement).' Dokumen Perjanjian berhasil ditambahkan');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuotationAgreement $quotationAgreement): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuotationAgreement $quotationAgreement): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isSale') && Gate::allows('isMarketingDelete')) || (Gate::allows('isMarketing') && Gate::allows('isSale') && Gate::allows('isMarketingDelete'))){
            $quotation_id = $quotationAgreement->quotation_id;
            $category = $quotationAgreement->quotation->media_category->name;

            if($quotationAgreement->image){
                Storage::delete($quotationAgreement->image);
            }

            QuotationAgreement::destroy($quotationAgreement->id);

            return redirect('marketing/quotation-agreements/show-agreements/'.$category.'/'.$quotation_id)->with('success','Dokumen Perjanjian berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
