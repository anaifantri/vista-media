<?php

namespace App\Http\Controllers;

use App\Models\SignageQuotRevision;
use App\Models\SignageQuotation;
use App\Models\SignageApproval;
use App\Models\SignageCategory;
use App\Models\SignageQuotStatus;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Company;
use App\Models\Area;
use App\Models\City;
use App\Models\Size;
use App\Models\Signage;
use App\Models\SignagePhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SignageQuotRevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    public function revision(string $id): View
    {
        $getId = [];
        $quotationData = SignageQuotation::findOrFail($id);
        if($quotationData){
            $products = json_decode($quotationData->products);
        }
        // dd($products);
        foreach($products as $product){
            $getId[]= $product->id;
        }
        $signages = Signage::whereIn('id', $getId)->get();
        $clients = Client::with('signage_quotations')->get();
        $companies = Company::with('signage_quotations')->get();

        return view('dashboard.marketing.signage-quot-revisions.create', [
            'signage_quotation' => $quotationData,
            'signages'=>$signages,
            'title' => 'Revisi Penawaran signage',
            'signage_photos' => SignagePhoto::whereIn('signage_id', $getId)->get(),
            compact('clients', 'companies')
        ]);
    }

    public function preview(string $id): View
    {
        $data_quot_revision = SignageQuotRevision::findOrFail($id);
        $getId = [];
        if($data_quot_revision){
            $products = json_decode($data_quot_revision->products);
        }
        // dd($products);
        foreach($products as $product){
            $getId[]= $product->id;
        }
        $signages = Signage::whereIn('id', $getId)->get();
        $data_quotation = SignageQuotation::findOrFail($data_quot_revision->signage_quotation_id);
        $signage_quotations = SignageQuotation::with('signage_quot_revisions')->get();

        return view('dashboard.marketing.signage-quot-revisions.preview', [
            'signage_quot_revision' => $data_quot_revision,
            'signage_quotation' => $data_quotation,
            'title' => 'Preview Revisi Surat Penawaran Signage',
            'signages'=>$signages,
            'signage_photos' => SignagePhoto::whereIn('signage_id', $getId)->get(),
            compact('signage_quotations')
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
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            // Create New Number --> start
            $revisionData = SignageQuotRevision::where('signage_quotation_id', $request->signage_quotation_id)->get();
            $revisionNumber = count($revisionData) + 1;

            $number = 0;
            $monthRomawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
    
            $month = $monthRomawi[(int)date('m')];
            $year = date('y');
    
            $number = $request->quotation_number.'_Rev'.$revisionNumber.'/APP/Pen-VT/VM/'.$month.'-'.$year;
            // Create New Number --> end

            // Validate Data --> start
            $validateData = $request->validate([
                'signage_quotation_id' => 'required',
                'notes' => 'required',
                'products' => 'required',
                'modified_by' => 'required',
                'payment_terms' => 'required',
                'price' => 'required'
            ]);
            $validateData['number'] = $number;
            // dd($validateData);

            SignageQuotRevision::create($validateData); 
            // Validate Data --> end

            // Get Quotation ID --> start
            $datasignage = SignageQuotRevision::where('number', $validateData['number'])->firstOrFail();

            $validateData['signage_quotation_id'] = $request->signage_quotation_id;
            $validateData['signage_quot_revision_id'] = $datasignage->id;
            $validateData['status'] = "Created";
            $validateData['updated_by'] = $validateData['modified_by'];
            $validateData['description'] = "Revisi surat penawaran signage dengan nomor".$validateData['number']." telah dibuat dan tersimpan";
            
            SignageQuotStatus::create($validateData);
            // Get Quotation ID --> end

            return redirect('/dashboard/marketing/signage-quot-revisions/preview/'.$datasignage->id)->with('success','Revisi surat penawaran signage dengan nomor '. $validateData['number'] . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SignageQuotRevision $signageQuotRevision): Response
    {
        $getId = [];
        $products = json_decode($signageQuotRevision->products);
        foreach($products as $product){
            $getId[]= $product->id;
        }
        $signages = Signage::whereIn('id', $getId)->get();
        $signage_quot_statuses = SignageQuotRevision::with('signage_quot_statuses');
        $data_quotation = SignageQuotation::findOrFail($signageQuotRevision->signage_quotation_id);
        $clients = Client::with('signage_quotations')->get();
        $companies = Company::with('signage_quotations')->get();

        return response()->view('dashboard.marketing.signage-quot-revisions.show', [
            'signage_quot_revision' => $signageQuotRevision,
            'signage_quotation' => $data_quotation,
            'title' => 'Detail Revisi Penawaran Signage',
            'signages'=> $signages,
            'last_quot_statuses' => SignageQuotStatus::where('signage_quot_revision_id', $signageQuotRevision->id)->get()->last(),
            'signage_photos' => SignagePhoto::whereIn('signage_id', $getId)->get(),
            compact('clients', 'companies', 'signage_quot_statuses')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SignageQuotRevision $signageQuotRevision): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SignageQuotRevision $signageQuotRevision): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SignageQuotRevision $signageQuotRevision): RedirectResponse
    {
        //
    }
}
