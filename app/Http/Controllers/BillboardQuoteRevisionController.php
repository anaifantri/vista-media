<?php

namespace App\Http\Controllers;

use App\Models\BillboardQuoteRevision;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

use App\Models\Area;
use App\Models\City;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Billboard;
use App\Models\Company;
use App\Models\BillboardCategory;
use App\Models\BillboardPhoto;
use App\Models\BillboardQuotation;
use Illuminate\Support\Facades\Storage;

class BillboardQuoteRevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    public function showBillboardQuoteRevision(){
        $dataBillboardQuoteRevision = BillboardQuoteRevision::All();

        return response()->json(['dataBillboardQuoteRevision'=> $dataBillboardQuoteRevision]);
    }

    public function revision(string $id): View
    {
        $billboard_quotations = BillboardQuotation::with('billboard');
        $clients = Client::with('billboard_quotations')->get();
        $contacts = Contact::with('billboard_quotations')->get();

        return view('dashboard.marketing.quotation-revisions.create', [
            'billboard_quotation' => BillboardQuotation::findOrFail($id),
            'title' => 'Detail Billboard',
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BillboardQuoteRevision $billboardQuoteRevision): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BillboardQuoteRevision $billboardQuoteRevision): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BillboardQuoteRevision $billboardQuoteRevision): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BillboardQuoteRevision $billboardQuoteRevision): RedirectResponse
    {
        //
    }
}
