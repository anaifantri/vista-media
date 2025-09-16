<?php

namespace App\Http\Controllers;

use App\Models\License;
use App\Models\LicenseDocument;
use App\Models\LicensingCategory;
use App\Models\Location;
use App\Models\MediaCategory;
use App\Models\Company;
use App\Models\Area;
use App\Models\City;
use App\Models\MediaSize;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Gate;

class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        if(Gate::allows('isLegal') && Gate::allows('isMediaRead')){
            $prinsip = LicensingCategory::where('name', 'Prinsip')->get()->last();
            $pbg = LicensingCategory::where('name', 'PBG')->get()->last();
            $slf = LicensingCategory::where('name', 'SLF')->get()->last();
            $ipr = LicensingCategory::where('name', 'IPR')->get()->last();
            $skpd = LicensingCategory::where('name', 'SKPD')->get()->last();
            $sspd = LicensingCategory::where('name', 'SSPD')->get()->last();
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $licenses = License::with('location')->get();
            $licensing_categories = LicensingCategory::with('licenses')->get();
            return response()-> view ('licenses.index', [
                'locations'=>Location::filter(request('search'))->area()->city()->condition()->category()->sortable()->paginate(15)->withQueryString(),
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'prinsip'=>$prinsip,
                'pbg'=>$pbg,
                'slf'=>$slf,
                'ipr'=>$ipr,
                'skpd'=>$skpd,
                'sspd'=>$sspd,
                'title' => 'Daftar Data Perizinan',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'licenses', 'licensing_categories')
            ]);
        } else {
            abort(403);
        }
    }

    public function activeLicenses(): View
    { 
        if(Gate::allows('isLegal') && Gate::allows('isMediaRead')){
            $prinsip = LicensingCategory::where('name', 'Prinsip')->get()->last();
            $pbg = LicensingCategory::where('name', 'PBG')->get()->last();
            $slf = LicensingCategory::where('name', 'SLF')->get()->last();
            $ipr = LicensingCategory::where('name', 'IPR')->get()->last();
            $skpd = LicensingCategory::where('name', 'SKPD')->get()->last();
            $sspd = LicensingCategory::where('name', 'SSPD')->get()->last();
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $licenses = License::with('location')->get();
            $licensing_categories = LicensingCategory::with('licenses')->get();
            return view ('licenses.active-licenses', [
                'locations'=>Location::activeLicenses()->filter(request('search'))->area()->city()->condition()->category()->sortable()->paginate(15)->withQueryString(),
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'prinsip'=>$prinsip->id,
                'pbg'=>$pbg->id,
                'slf'=>$slf->id,
                'ipr'=>$ipr->id,
                'skpd'=>$skpd->id,
                'sspd'=>$sspd->id,
                'title' => 'Daftar Data Perizinan',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'licenses', 'licensing_categories')
            ]);
        } else {
            abort(403);
        }
    }

    public function expiredLicenses(): View
    { 
        if(Gate::allows('isLegal') && Gate::allows('isMediaRead')){
            $prinsip = LicensingCategory::where('name', 'Prinsip')->get()->last();
            $pbg = LicensingCategory::where('name', 'PBG')->get()->last();
            $slf = LicensingCategory::where('name', 'SLF')->get()->last();
            $ipr = LicensingCategory::where('name', 'IPR')->get()->last();
            $skpd = LicensingCategory::where('name', 'SKPD')->get()->last();
            $sspd = LicensingCategory::where('name', 'SSPD')->get()->last();
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $licenses = License::with('location')->get();
            $licensing_categories = LicensingCategory::with('licenses')->get();
            return view ('licenses.expired-licenses', [
                'locations'=>Location::expiredLicenses()->filter(request('search'))->area()->city()->condition()->category()->sortable()->paginate(15)->withQueryString(),
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'prinsip'=>$prinsip->id,
                'pbg'=>$pbg->id,
                'slf'=>$slf->id,
                'ipr'=>$ipr->id,
                'skpd'=>$skpd->id,
                'sspd'=>$sspd->id,
                'title' => 'Daftar Data Perizinan',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'licenses', 'licensing_categories')
            ]);
        } else {
            abort(403);
        }
    }

    public function expiredSoonLicenses(): View
    { 
        if(Gate::allows('isLegal') && Gate::allows('isMediaRead')){
            $prinsip = LicensingCategory::where('name', 'Prinsip')->get()->last();
            $pbg = LicensingCategory::where('name', 'PBG')->get()->last();
            $slf = LicensingCategory::where('name', 'SLF')->get()->last();
            $ipr = LicensingCategory::where('name', 'IPR')->get()->last();
            $skpd = LicensingCategory::where('name', 'SKPD')->get()->last();
            $sspd = LicensingCategory::where('name', 'SSPD')->get()->last();
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $licenses = License::with('location')->get();
            $licensing_categories = LicensingCategory::with('licenses')->get();
            return view ('licenses.expired-soon-licenses', [
                'locations'=>Location::expiredSoonLicenses()->filter(request('search'))->area()->city()->condition()->category()->sortable()->paginate(15)->withQueryString(),
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'prinsip'=>$prinsip->id,
                'pbg'=>$pbg->id,
                'slf'=>$slf->id,
                'ipr'=>$ipr->id,
                'skpd'=>$skpd->id,
                'sspd'=>$sspd->id,
                'title' => 'Daftar Data Perizinan',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'licenses', 'licensing_categories')
            ]);
        } else {
            abort(403);
        }
    }

    public function createLicense(String $locationId): View
    { 
        if((Gate::allows('isAdmin') && Gate::allows('isLegal') && Gate::allows('isMediaCreate')) || (Gate::allows('isMedia') && Gate::allows('isLegal') && Gate::allows('isMediaCreate'))){
            $location = Location::findOrFail($locationId);
            return view ('licenses.create', [
                'licensing_categories' => LicensingCategory::all(),
                'location_id' => $locationId,
                'location' => $location,
                'title' => 'Menambahkan Data Izin'
            ]);
        } else {
            abort(403);
        }
    }

    public function showLicense(String $locationId): View
    { 
        if((Gate::allows('isAdmin') && Gate::allows('isLegal') && Gate::allows('isMediaCreate')) || (Gate::allows('isMedia') && Gate::allows('isLegal') && Gate::allows('isMediaCreate'))){
            $dataPrinsip = License::where('location_id', $locationId)->whereHas('licensing_category', function($query){
                $query->where('name', '=', "Prinsip");
            })->get();
            $dataPBG = License::where('location_id', $locationId)->whereHas('licensing_category', function($query){
                $query->where('name', '=', "PBG")->orWhere('name', '=', "SLF");
            })->get();
            $dataIPR = License::where('location_id', $locationId)->whereHas('licensing_category', function($query){
                $query->where('name', '=', "IPR");
            })->get();
            $dataSKPD = License::where('location_id', $locationId)->whereHas('licensing_category', function($query){
                $query->where('name', '=', "SKPD");
            })->get();
            $dataSSPD = License::where('location_id', $locationId)->whereHas('licensing_category', function($query){
                $query->where('name', '=', "SSPD");
            })->get();
            $location = Location::where('id', $locationId)->firstOrFail();
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            return view ('licenses.show-licenses', [
                'data_prinsip' => $dataPrinsip,
                'data_pbg' => $dataPBG,
                'data_ipr' => $dataIPR,
                'data_skpd' => $dataSKPD,
                'data_sspd' => $dataSSPD,
                'location' => $location,
                'title' => 'Detail Data Perizinan',
                compact('areas', 'cities', 'media_categories', 'media_sizes')
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
        if((Gate::allows('isAdmin') && Gate::allows('isLegal') && Gate::allows('isMediaCreate')) || (Gate::allows('isMedia') && Gate::allows('isLegal') && Gate::allows('isMediaCreate'))){
            if ($request->licensing_category_id == 'pilih'){
                return back()->withErrors(['licensing_category_id' => ['Silahkan pilih katagori izin']])->withInput();
            }
            $request->validate([
                'legal_documents.*'=> 'image|file|mimes:jpeg,png,jpg|max:1024',
                'legal_documents' => 'required',
            ]);
            $request->request->add(['user_id' => auth()->user()->id]);
            $validateData = $request->validate([
                'number' => 'required',
                'licensing_category_id' => 'required',
                'company_id' => 'required',
                'user_id' => 'required',
                'location_id' => 'required',
                'government' => 'required',
                'notes' => 'nullable',
                'published' => 'required',
                'start_at' => 'required',
                'end_at' => 'nullable'
            ]);
            License::create($validateData);
    
            $dataLicense = License::where('number', $validateData['number'])->firstOrFail();
            $category = LicensingCategory::where('id', $dataLicense->licensing_category_id)->firstOrFail();
            $name = $category->name;
    
            if($request->file('legal_documents')){
                $images = $request->file('legal_documents');
                foreach($images as $image){
                    $documentLicense = [];
                    $documentLicense = [
                        'license_id' => $dataLicense->id,
                        'user_id' => auth()->user()->id,
                        'licensing_category_id' => $validateData['licensing_category_id'],
                        'name' => $name,
                        'image' => $image->store('license-images')
                    ];
                    LicenseDocument::create($documentLicense);
                }
            }
            return redirect('/media/licenses')->with('success', 'Data izin '.$name.' dengan nomor '. $validateData['number'] . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(License $license): Response
    {
        if(Gate::allows('isLegal') && Gate::allows('isMediaRead')){
            $licensing_categories = LicensingCategory::with('licenses')->get();
            $locations = Location::with('licenses')->get();
            $license_documents = LicenseDocument::where('license_id', $license->id)->get();
            $cities = City::with('locations')->get();
            $areas = Area::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            return response()-> view ('licenses.show', [
                'license' => $license,
                'license_documents' => $license_documents,
                'title' => 'Detail Izin' . $license->licensing_category->name,
                compact('locations', 'cities', 'areas', 'media_sizes', 'media_categories')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(License $license): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isLegal') && Gate::allows('isMediaEdit')) || (Gate::allows('isMedia') && Gate::allows('isLegal') && Gate::allows('isMediaEdit'))){
            $licensing_categories = LicensingCategory::with('licenses')->get();
            $locations = Location::with('licenses')->get();
            $license_documents = LicenseDocument::where('license_id', $license->id)->get();
            $cities = City::with('locations')->get();
            $areas = Area::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            return response()-> view ('licenses.edit', [
                'license' => $license,
                'license_documents' => $license_documents,
                'title' => 'Edit Data Izin' . $license->licensing_category->name,
                compact('locations', 'cities', 'areas', 'media_sizes', 'media_categories')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, License $license): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isLegal') && Gate::allows('isMediaEdit')) || (Gate::allows('isMedia') && Gate::allows('isLegal') && Gate::allows('isMediaEdit'))){
            $request->request->add(['user_id' => auth()->user()->id]);
            $rules = [
                'government' => 'required',
                'notes' => 'nullable',
                'published' => 'required',
                'start_at' => 'required',
                'end_at' => 'nullable',
                'user_id' => 'required'
            ];
    
            if($request->number != $license->number){
                $rules['number'] = 'required';
            }
            $validateData = $request->validate($rules);

            License::where('id', $license->id)
                    ->update($validateData);
                    
            return redirect('/show-license/'.$license->location->id)->with('success', 'Data izin '.$license->licensing_category->name.' dengan nomor '. $license->number. ' berhasil dirubah');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(License $license): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isLegal') && Gate::allows('isMediaDelete')) || (Gate::allows('isMedia') && Gate::allows('isLegal') && Gate::allows('isMediaDelete'))){
            foreach($license->license_documents as $document){
                Storage::delete($document->image);
                LicenseDocument::destroy($document->id);
            }
            License::destroy($license->id);
            return redirect('/show-license/'.$license->location->id)->with('success', 'Dokumen izin '.$license->licensing_category->name.' dengan nomor'.$license->number.' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
