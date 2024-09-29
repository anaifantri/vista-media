<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\QuotationRevision;
use App\Models\QuotationStatus;
use App\Models\QuotRevisionStatus;
use App\Models\Area;
use App\Models\City;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Location;
use App\Models\Led;
use App\Models\LocationPhoto;
use App\Models\Company;
use App\Models\MediaCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    public function home(String $category, Request $request): View
    {
        if($category == "All"){
            $dataCategory = MediaCategory::where('id', $request->media_category_id)->get()->last();
            $dataQuotations = Quotation::filter(request('search'))->sortable()->category()->paginate(10)->withQueryString();
        }else{
            $dataCategory = MediaCategory::where('name', $category)->get()->last();
            $media_category_id = $dataCategory->id;
            $dataQuotations = Quotation::where('media_category_id', $dataCategory->id)->filter(request('search'))->sortable()->paginate(10)->withQueryString();
        }

        $media_categories = MediaCategory::with('quotations')->get();
        $companies = Company::with('quotations')->get();
        $quotation_revisions = QuotationRevision::with('quotation')->get();
        $quotation_statuses = QuotationStatus::with('quotation')->get();
        $quot_revision_statuses = QuotRevisionStatus::with('quotation')->get();
        return view ('quotations.index', [
            'quotations'=>$dataQuotations,
            'categories'=>MediaCategory::all(),
            'data_category'=>$dataCategory,
            'category'=>$category,
            'title' => 'Daftar Penawaran',
            compact('media_categories', 'companies', 'quotation_statuses', 'quotation_revisions', 'quot_revision_statuses')
        ]);
    }

    public function preview(String $category, String $id): View
    { 
        $media_categories = MediaCategory::with('quotations')->get();
        return view('quotations.preview', [
            'quotation' => Quotation::findOrFail($id),
            'title' => 'Detail Penawaran',
            'category'=>$category,
            'categories' => MediaCategory::all(),
            'leds' => Led::all(),
            compact('media_categories')
        ]);
    }

    public function selectLocation(String $category): View
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Marketing'){
            $mediaCategory = MediaCategory::where('name', $category)->firstOrFail();
            return view ('quotations.select-location', [
                'categories'=>MediaCategory::all(),
                'areas' => Area::all(),
                'cities' => City::all(),
                'locations'=>Location::where('media_category_id', $mediaCategory->id)->filter(request('search'))->area()->city()->type()->sortable()->paginate(10)->withQueryString(),
                'title' => 'Pilih Lokasi Penawaran',
                'data_category' => $mediaCategory
            ]);
        } else {
            abort(403);
        }
    }

    public function createQuotation(String $category, String $locationId, String $city, String $area){
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Marketing' ){
            $dataId = json_decode($locationId);
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $locations = Location::whereIn('id', $dataId)->get();
            $mediaCategory = MediaCategory::where('name', $category)->firstOrFail();

            return response()-> view ('quotations.create', [
                'locations'=>$locations,
                'clients'=>Client::orderBy("name", "asc")->get(),
                'contacts'=>Contact::orderBy("name", "asc")->get(),
                'leds'=>Led::orderBy("name", "asc")->get(),
                'area'=>$area,
                'city'=>$city,
                'category'=>$category,
                'data_category' => $mediaCategory,
                'categories'=>MediaCategory::all(),
                'locationPhotos' => LocationPhoto::whereIn('location_id', $dataId)->get(),
                'title' => 'Membuat Penawaran'.$category,
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Marketing' ){
            $validateData = $request->validate([
                'number' => 'required|unique:quotations',
                'media_category_id' => 'required',
                'company_id' => 'required',
                'attachment' => 'required',
                'subject' => 'required',
                'body_top' => 'required',
                'body_end' => 'required',
                'clients' => 'required',
                'notes' => 'required',
                'payment_terms' => 'required',
                'price' => 'required',
                'products' => 'required',
                'created_by' => 'required',
                'modified_by' => 'required'
            ]);

            Quotation::create($validateData);

            $dataQuotation = Quotation::where('number', $validateData['number'])->firstOrFail();

            $validateData['quotation_id'] = $dataQuotation->id;
            $validateData['status'] = "Created";
            $validateData['updated_by'] = $request->created_by;
            $validateData['description'] = "Surat penawaran ". $dataQuotation->media_category->name ." dengan nomor ".$validateData['number']." telah dibuat dan tersimpan";
            
            QuotationStatus::create($validateData);
                
            return redirect('/quotations/preview/'.$dataQuotation->media_category->name.'/'.$dataQuotation->id)->with('success', 'Penawaran dengan nomor '. $validateData['number'] . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Quotation $quotation): Response
    {
        $quotation_statuses = Quotation::with('quotation_statuses');
        $companies = Company::with('quotations')->get();
        $media_categories = MediaCategory::with('quotations')->get();
        $quotation_revisions = Quotation::with('quotation_revisions');
        $dataRevisions = QuotationRevision::where('quotation_id', $quotation->id)->get();

        return response()->view('quotations.show', [
            'quotation' => $quotation,
            'title' => 'Data Penawaran',
            'categories'=>MediaCategory::all(),
            'data_revisions' => $dataRevisions,
            'leds' => Led::all(),
            'last_statuses' => QuotationStatus::where('quotation_id', $quotation->id)->get()->last(),
            compact('companies', 'quotation_statuses', 'media_categories', 'quotation_revisions')
        ]);
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
