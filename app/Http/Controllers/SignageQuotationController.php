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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SignageQuotation $signageQuotation): Response
    {
        //
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
