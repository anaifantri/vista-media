<?php

namespace App\Http\Controllers;

use App\Models\BillboardQuotRevision;
use App\Models\BillboardQuotStatus;
use App\Models\Area;
use App\Models\User;
use App\Models\City;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Billboard;
use App\Models\Company;
use App\Models\BillboardCategory;
use App\Models\BillboardPhoto;
use App\Models\BillboardQuotation;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class BillboardQuotRevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()->view('dashboard.marketing.quotation-revisions.index', [
            'billboard_quote_revisions' => BillboardQuoteRevision::filter(request('search'))->sortable()->paginate(10)->withQueryString(),
            'title' => 'Daftar Revisi Penawaran Billboard'
        ]);
    }

    public function showBillboardQuotRevision(){
        $dataBillboardQuotRevision = BillboardQuotRevision::All();

        return response()->json(['dataBillboardQuotRevision'=> $dataBillboardQuotRevision]);
    }

    public function revision(string $id): View
    {
        $billboard_quotations = BillboardQuotation::with('billboard');
        $clients = Client::with('billboard_quotations')->get();
        $contacts = Contact::with('billboard_quotations')->get();

        return view('dashboard.marketing.quotation-revisions.create', [
            'billboard_quotation' => BillboardQuotation::findOrFail($id),
            'title' => 'Revisi Penawaran Billboard',
            'billboard_photos'=>BillboardPhoto::all(),
            'billboard_categories'=>BillboardCategory::all(),
            'companies'=>Company::all(),
            compact('billboard_quotations', 'clients', 'contacts')
        ]);
    }

    public function preview(string $id): View
    {
        $billboard_quotations = BillboardQuotation::with('billboard');
        $clients = Client::with('billboard_quotations')->get();
        $contacts = Contact::with('billboard_quotations')->get();

        $dataRevision = BillboardQuotRevision::findOrFail($id);
        $quotationId = $dataRevision->billboard_quotation_id;

        // dd($quotationId);

        return view('dashboard.marketing.quotation-revisions.preview', [
            'billboard_quot_revision' => BillboardQuotRevision::findOrFail($id),
            'billboard_quotation' => BillboardQuotation::findOrFail($quotationId),
            'title' => 'Detail Revisi Penawaran Billboard',
            'billboard_photos'=>BillboardPhoto::all(),
            'billboard_categories'=>BillboardCategory::all(),
            'companies'=>Company::all(),
            compact('billboard_quotations', 'clients', 'contacts')
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
            $validateData = $request->validate([
                'billboard_quotation_id' => 'required',
                'number' => 'required|unique:billboard_quot_revisions',
                'attachment' => 'required',
                'subject' => 'required',
                'body_top' => 'required',
                'billboards' => 'required',
                'note' => 'required',
                'body_end' => 'required',
                'price_type' => 'required'
            ]);

            $validateData['user_id'] = auth()->user()->id;
            $validateData['price_periode'] = "Test";
            $validateData['status'] = "Tersimpan";

            // dd($validateData);
    
            BillboardQuotRevision::create($validateData);
            
            $dataQuotRevisions = BillboardQuotRevision::all();
            $quotId = 0;
            foreach ($dataQuotRevisions as $quotRevision) {
                if($quotRevision->number == $validateData['number']){
                    $quotId = $quotRevision->id;
                }
            }

            $validateData['billboard_quot_revision_id'] = $quotId;
            $validateData['billboard_quotation_id'] = null;
            $validateData['status'] = "Created";
            $validateData['description'] = "Revisi surat penawaran telah dibuat dan tersimpan";

            BillboardQuotStatus::create($validateData);
            
            return redirect('/dashboard/marketing/quotation-revisions/preview/'.$quotId)->with('success','Revisi surat penawaran dengan nomor '. $request->number . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BillboardQuotRevision $billboardQuotRevision): Response
    {
        // dd($billboardQuotRevision);
        $billboard_quotation = BillboardQuotRevision::with('billboard_quotation');
        $billboard_quot_statuses = BillboardQuotRevision::with('billboard_quot_statuses');
        $clients = Client::with('billboard_quotations')->get();
        $contacts = Contact::with('billboard_quotations')->get();

        // dd($billboardQuotation->id);

        return response()->view('dashboard.marketing.quotation-revisions.show', [
            'billboard_quot_revision' => $billboardQuotRevision,
            'billboard_quot_revisions' => BillboardQuotRevision::all(),
            'title' => 'Detail Revisi Penawaran Billboard',
            'billboard_photos'=>BillboardPhoto::all(),
            'billboard_categories'=>BillboardCategory::all(),
            'companies'=>Company::all(),
            compact('billboard_quotation', 'billboard_quot_statuses', 'clients', 'contacts')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BillboardQuotRevision $billboardQuotRevision): Response
    {
        dd($billboardQuotRevision);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BillboardQuotRevision $billboardQuotRevision): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BillboardQuotRevision $billboardQuotRevision): RedirectResponse
    {
        //
    }
}
