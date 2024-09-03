<?php

namespace App\Http\Controllers;

use App\Models\VideotronQuotRevision;
use App\Models\VideotronQuotation;
use App\Models\VideotronQuotStatus;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Company;
use App\Models\Area;
use App\Models\City;
use App\Models\Size;
use App\Models\Led;
use App\Models\Videotron;
use App\Models\VideotronPhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class VideotronQuotRevisionController extends Controller
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
        $quotationData = VideotronQuotation::findOrFail($id);
        $clients = Client::with('videotron_quotations')->get();
        $companies = Company::with('videotron_quotations')->get();

        return view('dashboard.marketing.videotron-quot-revisions.create', [
            'videotron_quotation' => $quotationData,
            'videotron'=>Videotron::findOrFail($quotationData->videotron_id),
            'title' => 'Revisi Penawaran Videotron',
            'videotron_photo' => VideotronPhoto::where('videotron_id', $quotationData->videotron_id)->get()->last(),
            compact('clients', 'companies')
        ]);
    }

    public function preview(string $id): View
    {
        $data_quot_revision = VideotronQuotRevision::findOrFail($id);
        $data_quotation = VideotronQuotation::findOrFail($data_quot_revision->videotron_quotation_id);
        $videotron_quotations = VideotronQuotation::with('videotron_quot_revisions')->get();

        return view('dashboard.marketing.videotron-quot-revisions.preview', [
            'videotron_quot_revision' => $data_quot_revision,
            'videotron_quotation' => $data_quotation,
            'title' => 'Preview Revisi Surat Penawaran',
            'videotron'=>Videotron::findOrFail($data_quotation->videotron_id),
            'videotron_photo' => VideotronPhoto::where('videotron_id', $data_quotation->videotron_id)->get()->last(),
            compact('videotron_quotations')
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
            $revisionData = VideotronQuotRevision::where('videotron_quotation_id', $request->videotron_quotation_id)->get();
            $revisionNumber = count($revisionData) + 1;

            $number = 0;
            $monthRomawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
    
            $month = $monthRomawi[(int)date('m')];
            $year = date('y');
    
            $number = $request->quotation_number.'_Rev'.$revisionNumber.'/APP/Pen-VT/VM/'.$month.'-'.$year;
            // Create New Number --> end

            // Validate Data --> start
            $validateData = $request->validate([
                'videotron_quotation_id' => 'required',
                'notes' => 'required',
                'modified_by' => 'required',
                'payment_terms' => 'required',
                'price' => 'required'
            ]);
            $validateData['number'] = $number;

            VideotronQuotRevision::create($validateData); 
            // Validate Data --> end

            // Get Quotation ID --> start
            $dataVideotron = VideotronQuotRevision::where('number', $validateData['number'])->firstOrFail();

            $validateData['videotron_quotation_id'] = $request->videotron_quotation_id;
            $validateData['videotron_quot_revision_id'] = $dataVideotron->id;
            $validateData['status'] = "Created";
            $validateData['updated_by'] = $validateData['modified_by'];
            $validateData['description'] = "Revisi surat penawaran videotron dengan nomor".$validateData['number']." telah dibuat dan tersimpan";
            
            VideotronQuotStatus::create($validateData);
            // Get Quotation ID --> end

            return redirect('/dashboard/marketing/videotron-quot-revisions/preview/'.$dataVideotron->id)->with('success','Revisi surat penawaran videotron dengan nomor '. $validateData['number'] . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(VideotronQuotRevision $videotronQuotRevision): Response
    {
        $videotron_quot_statuses = VideotronQuotRevision::with('videotron_quot_revision_statuses');
        $data_quotation = VideotronQuotation::findOrFail($videotronQuotRevision->videotron_quotation_id);
        $videotron_quotations = VideotronQuotation::with('videotron_quot_revisions')->get();

        return response()->view('dashboard.marketing.videotron-quot-revisions.show', [
            'videotron_quot_revision' => $videotronQuotRevision,
            'videotron_quotation' => $data_quotation,
            'title' => 'Detail Revisi Surat Penawaran',
            'videotron'=>Videotron::findOrFail($data_quotation->videotron_id),
            'last_quot_statuses' => VideotronQuotStatus::where('videotron_quot_revision_id', $videotronQuotRevision->id)->get()->last(),
            'videotron_photo' => VideotronPhoto::where('videotron_id', $data_quotation->videotron_id)->get()->last(),
            compact('videotron_quotations','videotron_quot_statuses')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VideotronQuotRevision $videotronQuotRevision): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VideotronQuotRevision $videotronQuotRevision): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VideotronQuotRevision $videotronQuotRevision): RedirectResponse
    {
        //
    }
}
