<?php

namespace App\Http\Controllers;

use App\Models\SignageQuotation;
use App\Models\SignageQuotRevision;
use App\Models\SignageQuotStatus;
use App\Models\SignageCategory;
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

class SignageQuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $signage_quot_statuses = SignageQuotation::with('signage_quot_statuses')->get();
        $signage_quot_revisions = SignageQuotation::with('signage_quot_revisions');
        $clients = Client::with('signage_quotations')->get();
        $companies = Company::with('signage_quotations')->get();
        
        return response()->view('dashboard.marketing.signage-quotations.index', [
            'signage_quotations' => SignageQuotation::filter(request('search'))->sortable()->paginate(10)->withQueryString(),
            'title' => 'Daftar Penawaran Signage',
            compact('signage_quot_statuses', 'signage_quot_revisions', 'clients', 'companies')
        ]);
    }

    public function createQuotation(String $id, String $area, String $city)
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            $getId = explode(",", $id);
            $signages = Signage::whereIn('id', $getId)->get();
            $areas = Area::with('signages')->get();
            $cities = City::with('signages')->get();

            return response()-> view ('dashboard.marketing.signage-quotations.create-preview', [
                'signages'=>$signages,
                'clients'=>Client::orderBy("name", "asc")->get(),
                'contacts'=>Contact::orderBy("name", "asc")->get(),
                'area'=>$area,
                'city'=>$city,
                'signage_id'=>$getId,
                'signage_photos' => SignagePhoto::whereIn('signage_id', $getId)->get(),
                'title' => 'Membuat Penawaran signage',
                compact('areas', 'cities')
            ]);
        } else {
            abort(403);
        }
    }

    public function preview(string $id): View
    {
        $getId = [];
        $signage_quotation = SignageQuotation::findOrFail($id);
        if($signage_quotation){
            $products = json_decode($signage_quotation->products);
        }
        // dd($products);
        foreach($products as $product){
            $getId[]= $product->id;
        }
        $signages = Signage::whereIn('id', $getId)->get();
        $clients = Client::with('signage_quotations')->get();
        $companies = Company::with('signage_quotations')->get();

        return view('dashboard.marketing.signage-quotations.preview', [
            'signage_quotation' => $signage_quotation,
            'signages' => $signages,
            'title' => 'Preview Surat Penawaran signage',
            'signage_photos' => SignagePhoto::whereIn('signage_id', $getId)->get(),
            compact('clients', 'companies')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            return response()-> view ('dashboard.marketing.signage-quotations.create', [
                'clients'=>Client::orderBy("name", "asc")->get(),
                'areas'=>Area::orderBy("area", "asc")->get(),
                'cities'=>City::orderBy("city", "asc")->get(),
                'contacts'=>Contact::orderBy("name", "asc")->get(),
                'signages'=>Signage::filter(request('search'))->area()->city()->condition()->sortable()->paginate(10)->withQueryString(),
                'title' => 'Membuat Penawaran Signage'
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
            // Create New Number --> start
            $lastQuotation = SignageQuotation::all()->last();
            $number = 0;
            $monthRomawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
    
            $month = $monthRomawi[(int)date('m')];
            $year = date('y');
    
            if($lastQuotation){
                $lastNumber = (int)substr($lastQuotation->number,0,4);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
            
            if($newNumber < 10 ){
                $number = '000'.$newNumber.'/APP/Pen-SG/VM/'.$month.'-'.$year;
            } else if($newNumber < 100 ) {
                $number = '00'.$newNumber.'/APP/Pen-SG/VM/'.$month.'-'.$year;
            } else if($newNumber < 1000 ) {
                $number = '0'.$newNumber.'/APP/Pen-SG/VM/'.$month.'-'.$year;
            } else {
                $number = $newNumber.'/APP/Pen-SG/VM/'.$month.'-'.$year;
            }
            // Create New Number --> end

            // Validate Data --> start
            $validateData['company_id'] = 1;
            $validateData['number'] = $number;
            $validateData['attachment'] = $request->attachment;
            $validateData['subject'] = $request->subject;
            $validateData['client_contact'] = $request->client_contact;
            $validateData['contact_email'] = $request->contact_email;
            $validateData['contact_phone'] = $request->contact_phone;
            $validateData['body_top'] = $request->body_top;
            $validateData['products'] = $request->products;
            $validateData['notes'] = $request->notes;
            $validateData['body_end'] = $request->body_end;
            $validateData['client_id'] = $request->client_id;
            $validateData['signage_id'] = $request->signage_id;
            $validateData['payment_terms'] = $request->payment_terms;
            $validateData['price'] = $request->price;
            $validateData['created_by'] = $request->created_by;
            // dd($validateData);

            SignageQuotation::create($validateData); 
            // Validate Data --> end

            // Get Quotation ID --> start
            $dataSignage = SignageQuotation::where('number', $validateData['number'])->firstOrFail();

            $validateData['signage_quotation_id'] = $dataSignage->id;
            $validateData['status'] = "Created";
            $validateData['updated_by'] = $request->created_by;
            $validateData['description'] = "Surat penawaran signage dengan nomor".$validateData['number']." telah dibuat dan tersimpan";
            // dd($validateData);
            
            SignageQuotStatus::create($validateData);
            // Get Quotation ID --> end

            return redirect('/dashboard/marketing/signage-quotations/preview/'.$dataSignage->id)->with('success','Surat penawaran signage dengan nomor '. $validateData['number'] . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SignageQuotation $signageQuotation): Response
    {
        $getId = [];
        $products = json_decode($signageQuotation->products);
        // dd($products);
        foreach($products as $product){
            $getId[]= $product->id;
        }
        $signages = Signage::whereIn('id', $getId)->get();
        $signage_quot_statuses = SignageQuotation::with('signage_quot_statuses');
        $signage_quot_revisions = SignageQuotation::with('signage_quot_revisions');
        $clients = Client::with('signage_quotations')->get();
        $companies = Company::with('signage_quotations')->get();

        return response()->view('dashboard.marketing.signage-quotations.show', [
            'signage_quotation' => $signageQuotation,
            'title' => 'Preview Signage Quotation',
            'signages'=> $signages,
            'last_quot_statuses' => SignageQuotStatus::where('signage_quotation_id', $signageQuotation->id)->get()->last(),
            'signage_photos' => SignagePhoto::whereIn('signage_id', $getId)->get(),
            compact('clients', 'companies', 'signage_quot_statuses', 'signage_quot_revisions')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SignageQuotation $signageQuotation): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SignageQuotation $signageQuotation): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SignageQuotation $signageQuotation): RedirectResponse
    {
        //
    }
}
