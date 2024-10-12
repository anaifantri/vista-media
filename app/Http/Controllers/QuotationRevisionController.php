<?php

namespace App\Http\Controllers;

use App\Models\QuotationRevision;
use App\Models\QuotRevisionStatus;
use App\Models\Quotation;
use App\Models\Company;
use App\Models\Led;
use App\Models\PrintingProduct;
use App\Models\InstallationPrice;
use App\Models\MediaCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class QuotationRevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    public function preview(String $category, String $id): View
    { 
        $quotation = Quotation::with('quotation_revisions')->get();
        return view('quotation-revisions.preview', [
            'quotation_revision' => QuotationRevision::findOrFail($id),
            'title' => 'Detail Revisi Penawaran',
            'category'=>$category,
            'categories' => MediaCategory::all(),
            'leds' => Led::all(),
            compact('quotation')
        ]);
    }

    public function revision(String $category, String $id): View
    {
        $companies = Company::with('quotations')->get();
        $media_categories = MediaCategory::with('quotations')->get();
        $quotation_revisions = QuotationRevision::with('quotation')->get();

        return view('quotation-revisions.create', [
            'quotation' => Quotation::findOrFail($id),
            'categories'=>MediaCategory::all(),
            'printing_products'=>PrintingProduct::all(),
            'installation_prices'=>InstallationPrice::all(),
            'leds' => Led::all(),
            'category'=>$category,
            'title' => 'Revisi Penawaran',
            compact('media_categories', 'companies', 'quotation_revisions')
        ]);
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
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Marketing' ){
            $validateData = $request->validate([
                'number' => 'required|unique:quotation_revisions',
                'quotation_id' => 'required',
                'notes' => 'required',
                'payment_terms' => 'required',
                'price' => 'required',
                'products' => 'required',
                'modified_by' => 'required'
            ]);

            QuotationRevision::create($validateData);

            $dataQuotation = QuotationRevision::where('number', $validateData['number'])->firstOrFail();

            $validateData['quotation_id'] = $validateData['quotation_id'];
            $validateData['quotation_revision_id'] = $dataQuotation->id;
            $validateData['status'] = "Created";
            $validateData['updated_by'] = $request->modified_by;
            if($dataQuotation->quotation->media_category->name == "Service"){
                $validateData['description'] = "Revisi surat penawaran cetak / pasang dengan nomor ".$validateData['number']." telah dibuat dan tersimpan";
            }else{
                $validateData['description'] = "Revisi surat penawaran ". $request->category ." dengan nomor ".$validateData['number']." telah dibuat dan tersimpan";
            }
            
            QuotRevisionStatus::create($validateData);
                
            return redirect('/marketing/quotation-revisions/preview/'.$request->category.'/'.$dataQuotation->id)->with('success', 'Revisi penawaran dengan nomor '. $validateData['number'] . ' berhasil dibuat');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(QuotationRevision $quotationRevision): Response
    {
        $quot_revision_statuses = QuotationRevision::with('quot_revision_statuses');
        $quotation = Quotation::with('quotation_revisions')->get();
        $lastRevision = QuotationRevision::where('quotation_id', $quotationRevision->quotation_id)->get()->last();

        return response()->view('quotation-revisions.show', [
            'quotation_revision' => $quotationRevision,
            'last_revision' => $lastRevision,
            'title' => 'Data Revisi Penawaran',
            'categories'=>MediaCategory::all(),
            'leds' => Led::all(),
            'last_statuses' => QuotRevisionStatus::where('quotation_revision_id', $quotationRevision->id)->get()->last(),
            compact('quot_revision_statuses', 'quotation')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuotationRevision $quotationRevision): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuotationRevision $quotationRevision): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuotationRevision $quotationRevision): RedirectResponse
    {
        //
    }
}
