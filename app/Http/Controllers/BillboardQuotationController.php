<?php

namespace App\Http\Controllers;

use App\Models\BillboardQuotation;
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
use Illuminate\Support\Facades\Storage;

class BillboardQuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()->view('dashboard.marketing.billboard-quotations.index', [
            'billboard_quotations' => BillboardQuotation::filter(request('search'))->sortable()->paginate(10)->withQueryString(),
            'title' => 'Daftar Penawaran Billboard'
        ]);
    }

    public function showBillboardQuotation(){
        $dataBillboardQuotation = BillboardQuotation::All();

        return response()->json(['dataBillboardQuotation'=> $dataBillboardQuotation]);
    }

    public function preview(string $id): View
    {
        $billboard_quotations = BillboardQuotation::with('billboard');
        $clients = Client::with('billboard_quotations')->get();
        $contacts = Contact::with('billboard_quotations')->get();

        return view('dashboard.marketing.billboard-quotations.preview', [
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
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            return response()-> view ('dashboard.marketing.billboard-quotations.create', [
                'billboard_categories'=>BillboardCategory::all(),
                'clients'=>Client::orderBy("name", "asc")->get(),
                'areas'=>Area::orderBy("area", "asc")->get(),
                'cities'=>City::orderBy("city", "asc")->get(),
                'contacts'=>Contact::orderBy("name", "asc")->get(),
                'title' => 'Membuat Penawaran Billboard'
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
                'number' => 'required|unique:billboard_quotations',
                'attachment' => 'required',
                'subject' => 'required',
                'body_top' => 'required',
                'billboards' => 'required',
                'billboard_category_id' => 'required',
                'note' => 'required',
                'body_end' => 'required',
                'price_type' => 'required'
            ]);

            $validateData['user_id'] = auth()->user()->id;
            $validateData['company_id'] = "1";
            $validateData['price_periode'] = "Test";
            $validateData['status'] = "Created";

            
    
            BillboardQuotation::create($validateData);
            
            $dataQuotations = BillboardQuotation::all();
            $quotId = 0;
            foreach ($dataQuotations as $quotation) {
                if($quotation->number == $validateData['number']){
                    $quotId = $quotation->id;
                }
            }
            
            return redirect('/dashboard/marketing/billboard-quotations/preview/'.$quotId)->with('success','Surat penawaran dengan nomor '. $request->number . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BillboardQuotation $billboardQuotation): Response
    {
        $billboard_quotations = BillboardQuotation::with('billboard');
        $clients = Client::with('billboard_quotations')->get();
        $contacts = Contact::with('billboard_quotations')->get();

        return response()->view('dashboard.marketing.billboard-quotations.show', [
            'billboard_quotation' => $billboardQuotation,
            'title' => 'Detail Billboard',
            'billboard_photos'=>BillboardPhoto::all(),
            'companies'=>Company::all(),
            compact('billboard_quotations', 'clients', 'contacts')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BillboardQuotation $billboardQuotation): Response
    {
       //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BillboardQuotation $billboardQuotation): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BillboardQuotation $billboardQuotation): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            BillboardQuotation::destroy($billboardQuotation->id);

            return redirect('/dashboard/marketing/billboard-quotations')->with('success','Surat penawaran nomor '. $billboardQuotation->number .' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
