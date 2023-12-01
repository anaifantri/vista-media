<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Signage;
use App\Models\Quotation;
use App\Models\Videotron;
use App\Models\Company;
use App\Models\QuotationCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()->view('dashboard.marketing.quotations.index', [
            'quotations' => Quotation::filter(request('search'))->sortable()->paginate(10)->withQueryString(),
            'title' => 'Daftar Penawaran'
        ]);
    }

    public function showQuotation(){
        $dataQuotation = Quotation::All();

        return response()->json(['dataQuotation'=> $dataQuotation]);
    }

    // public function streamPdf(){
    //     // $pdf = App::make('dompdf.wrapper');
    //     // $pdf->loadHTML('<h1>Test</h1>');
    //     $pdf = Pdf::loadView('dashboard.marketing.quotations.testpdf');
    //     return $pdf->stream();
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            return response()-> view ('dashboard.marketing.quotations.create', [
                'quotation_categories'=>QuotationCategory::all(),
                'clients'=>Client::orderBy("name", "asc")->get(),
                'areas'=>Area::orderBy("area", "asc")->get(),
                'cities'=>City::orderBy("city", "asc")->get(),
                'contacts'=>Contact::orderBy("name", "asc")->get(),
                'title' => 'Membuat Penawaran'
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
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            
            $validateData = $request->validate([
                'client_id' => 'required',
                'contact_id' => 'required',
                'quotation_category_id' => 'required',
                'number' => 'required|unique:quotations',
                'attachment' => 'required',
                'subject' => 'required',
                'body_top' => 'required',
                'products' => 'required',
                'note' => 'required',
                'body_end' => 'required',
                'price_type' => 'required'
            ]);

            $validateData['user_id'] = auth()->user()->id;
            $validateData['company_id'] = "1";
            $validateData['status'] = "Created";
            $validateData['send_at'] = date('Y-m-d');
    
            Quotation::create($validateData);
            
            return redirect('/dashboard/marketing/quotations')->with('success','Quotation dengan nomor '. $request->id . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Quotation $quotation): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quotation $quotation): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quotation $quotation): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quotation $quotation): RedirectResponse
    {
        //
    }
}
