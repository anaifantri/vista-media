<?php

namespace App\Http\Controllers;

use App\Models\PrintInstalQuotation;
use App\Models\Client;
use App\Models\Contact;
use App\Models\PrintingProduct;
use App\Models\InstallationPrice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PrintInstalQuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()->view('dashboard.marketing.print-instal-quotations.index', [
            'print_instal_quotations' => PrintInstalQuotation::filter(request('search'))->sortable()->paginate(10)->withQueryString(),
            'title' => 'Daftar Penawaran Cetak dan Pasang'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            return response()-> view ('dashboard.marketing.print-instal-quotations.create', [
                'clients'=>Client::orderBy("name", "asc")->get(),
                'contacts'=>Contact::orderBy("name", "asc")->get(),
                'printing_products'=>PrintingProduct::all(),
                'installation_prices'=>InstallationPrice::all(),
                'title' => 'Membuat Penawaran Cetak & Pasang'
            ]);
        } else {
            abort(403);
        }
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
    public function show(PrintInstalQuotation $printInstalQuotation): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrintInstalQuotation $printInstalQuotation): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrintInstalQuotation $printInstalQuotation): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrintInstalQuotation $printInstalQuotation): RedirectResponse
    {
        //
    }
}
