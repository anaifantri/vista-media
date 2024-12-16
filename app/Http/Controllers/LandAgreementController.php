<?php

namespace App\Http\Controllers;

use App\Models\LandAgreement;
use App\Models\LandDocument;
use App\Models\Location;
use App\Models\MediaCategory;
use App\Models\Company;
use App\Models\Area;
use App\Models\City;
use App\Models\MediaSize;
use App\Http\Requests\StoreLandAgreementRequest;
use App\Http\Requests\UpdateLandAgreementRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use \stdClass;
use Gate;

class LandAgreementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        if(Gate::allows('isLegal') && Gate::allows('isMediaRead')){
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $land_agreements = LandAgreement::with('location')->get();
            $land_documents = LandDocument::with('land_agreement')->get();
            return response()-> view ('land-agreements.index', [
                'locations'=>Location::filter(request('search'))->area()->city()->condition()->category()->sortable()->paginate(15)->withQueryString(),
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'title' => 'Daftar Perjanjian Sewa',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'land_agreements', 'land_documents')
            ]);
        } else {
            abort(403);
        }
    }

    public function activeAgreement(): View
    { 
        if(Gate::allows('isLegal') && Gate::allows('isMediaRead')){
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $land_agreements = LandAgreement::with('location')->get();
            $land_documents = LandDocument::with('land_agreement')->get();
            return view ('land-agreements.active-agreements', [
                'locations'=>Location::activeAgreements()->filter(request('search'))->area()->city()->condition()->category()->sortable()->paginate(15)->withQueryString(),
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'title' => 'Daftar Perjanjian Sewa',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'land_agreements', 'land_documents')
            ]);
        } else {
            abort(403);
        }
    }

    public function expiredAgreement(): View
    { 
        if(Gate::allows('isLegal') && Gate::allows('isMediaRead')){
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $land_agreements = LandAgreement::with('location')->get();
            $land_documents = LandDocument::with('land_agreement')->get();
            return view ('land-agreements.expired-agreements', [
                'locations'=>Location::expiredAgreements()->filter(request('search'))->area()->city()->condition()->category()->sortable()->paginate(15)->withQueryString(),
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'title' => 'Daftar Perjanjian Sewa',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'land_agreements', 'land_documents')
            ]);
        } else {
            abort(403);
        }
    }

    public function expiredSoonAgreement(): View
    { 
        if(Gate::allows('isLegal') && Gate::allows('isMediaRead')){
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $land_agreements = LandAgreement::with('location')->get();
            $land_documents = LandDocument::with('land_agreement')->get();
            return view ('land-agreements.expired-soon-agreements', [
                'locations'=>Location::expiredSoonAgreements()->filter(request('search'))->area()->city()->condition()->category()->sortable()->paginate(15)->withQueryString(),
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'title' => 'Daftar Perjanjian Sewa',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'land_agreements', 'land_documents')
            ]);
        } else {
            abort(403);
        }
    }

    public function createLandAgreement(String $locationId): View
    { 
        if((Gate::allows('isAdmin') && Gate::allows('isLegal') && Gate::allows('isMediaCreate')) || (Gate::allows('isMedia') && Gate::allows('isLegal') && Gate::allows('isMediaCreate'))){
            $location = Location::findOrFail($locationId);
            return view ('land-agreements.create', [
                'location_id' => $locationId,
                'location'=>$location,
                'title' => 'Menambahkan Data Sewa Lahan'
            ]);
        } else {
            abort(403);
        }
    }

    public function showLandAgreement(String $locationId): View
    { 
        if((Gate::allows('isAdmin') && Gate::allows('isLegal') && Gate::allows('isMediaCreate')) || (Gate::allows('isMedia') && Gate::allows('isLegal') && Gate::allows('isMediaCreate'))){
            $dataAgreements = LandAgreement::where('location_id', $locationId)->get();
            $location = Location::where('id', $locationId)->firstOrFail();
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            return view ('land-agreements.show-land-agreements', [
                'agreements' => $dataAgreements,
                'location' => $location,
                'title' => 'Detail Data Sewa Lahan',
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
    public function store(StoreLandAgreementRequest $request): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isLegal') && Gate::allows('isMediaCreate')) || (Gate::allows('isMedia') && Gate::allows('isLegal') && Gate::allows('isMediaCreate'))){
            $request->validate([
                'legal_documents.*'=> 'image|file|mimes:jpeg,png,jpg|max:1024',
                'legal_documents' => 'required',
                'ktpFirst.*'=> 'image|file|mimes:jpeg,png,jpg|max:1024',
                'ktpFirst' => 'required',
                'ktpSecond.*'=> 'image|file|mimes:jpeg,png,jpg|max:1024',
                'ktpSecond' => 'required'
            ]);
            $firstParty = new stdClass();
            $firstParty->name = $request->nameFirst;
            $firstParty->address = $request->addressFirst;
            $firstParty->idNumber = $request->idNumberFirst;
            $firstParty->phone = $request->phoneFirst;
            $firstParty->idCard = $request->ktpFirst->store('id-card-images');

            $secondParty = new stdClass();
            $secondParty->name = $request->nameSecond;
            $secondParty->address = $request->addressSecond;
            $secondParty->idNumber = $request->idNumberSecond;
            $secondParty->phone = $request->phoneSecond;
            $secondParty->idCard = $request->ktpSecond->store('id-card-images');

            $request->request->add(['first_party' => json_encode($firstParty), 'second_party' => json_encode($secondParty)]);
            $validateData = $request->validate([
                'number' => 'required|unique:land_agreements',
                'company_id' => 'required',
                'user_id' => 'required',
                'location_id' => 'required',
                'first_party' => 'required',
                'price' => 'required',
                'duration' => 'required',
                'second_party' => 'required',
                'notes' => 'nullable',
                'published' => 'required',
                'start_at' => 'required',
                'end_at' => 'required'
            ]);
            // dd($validateData);
            LandAgreement::create($validateData);
    
            $dataLandAgreement = LandAgreement::where('number', $validateData['number'])->firstOrFail();
    
            if($request->file('legal_documents')){
                $images = $request->file('legal_documents');
                foreach($images as $image){
                    $documentLandAgreement = [];
                    $documentLandAgreement = [
                        'land_agreement_id' => $dataLandAgreement->id,
                        'user_id' => auth()->user()->id,
                        'name' => 'agreement',
                        'image' => $image->store('land-agreement-images')
                    ];
                    LandDocument::create($documentLandAgreement);
                }
            }
            return redirect('/media/land-agreements')->with('success', 'Data surat perjanjian sewa dengan nomor '. $validateData['number'] . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LandAgreement $landAgreement): Response
    {
        if(Gate::allows('isLegal') && Gate::allows('isMediaRead')){
            $locations = Location::with('land_agreements')->get();
            $agreements = LandDocument::where('land_agreement_id', $landAgreement->id)->where('name', 'agreement')->get();
            $certificates = LandDocument::where('land_agreement_id', $landAgreement->id)->where('name', 'certificate')->get();
            $receipts = LandDocument::where('land_agreement_id', $landAgreement->id)->where('name', 'receipt')->get();
            $cities = City::with('locations')->get();
            $areas = Area::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            return response()-> view ('land-agreements.show', [
                'land_agreement' => $landAgreement,
                'agreements' => $agreements,
                'certificates' => $certificates,
                'receipts' => $receipts,
                'title' => 'Detail Perjanjian Sewa',
                compact('locations', 'cities', 'areas', 'media_sizes', 'media_categories')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LandAgreement $landAgreement): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isLegal') && Gate::allows('isMediaEdit')) || (Gate::allows('isMedia') && Gate::allows('isLegal') && Gate::allows('isMediaEdit'))){
            $locations = Location::with('land_agreements')->get();
            $agreements = LandDocument::where('land_agreement_id', $landAgreement->id)->where('name', 'agreement')->get();
            $certificates = LandDocument::where('land_agreement_id', $landAgreement->id)->where('name', 'certificate')->get();
            $receipts = LandDocument::where('land_agreement_id', $landAgreement->id)->where('name', 'receipt')->get();
            $cities = City::with('locations')->get();
            $areas = Area::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            return response()-> view ('land-agreements.edit', [
                'land_agreement' => $landAgreement,
                'agreements' => $agreements,
                'certificates' => $certificates,
                'receipts' => $receipts,
                'title' => 'Edit Data Sewa Lahan',
                compact('locations', 'cities', 'areas', 'media_sizes', 'media_categories')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLandAgreementRequest $request, LandAgreement $landAgreement): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isLegal') && Gate::allows('isMediaEdit')) || (Gate::allows('isMedia') && Gate::allows('isLegal') && Gate::allows('isMediaEdit'))){
            if($request->ktpFirst){
                $request->validate([
                    'ktpFirst.*'=> 'image|file|mimes:jpeg,png,jpg|max:2048'
                ]);
            }
            if($request->ktpSecond){
                $request->validate([
                    'ktpSecond.*'=> 'image|file|mimes:jpeg,png,jpg|max:2048'
                ]);
            }

            $firstParty = new stdClass();
            $firstParty->name = $request->nameFirst;
            $firstParty->address = $request->addressFirst;
            $firstParty->idNumber = $request->idNumberFirst;
            $firstParty->phone = $request->phoneFirst;
            if($request->ktpFirst){
                Storage::delete($request->oldKtpFirst);
                $firstParty->idCard = $request->ktpFirst->store('id-card-images');
            }else{
                $firstParty->idCard = $request->oldKtpFirst;
            }

            $secondParty = new stdClass();
            $secondParty->name = $request->nameSecond;
            $secondParty->address = $request->addressSecond;
            $secondParty->idNumber = $request->idNumberSecond;
            $secondParty->phone = $request->phoneSecond;
            if($request->ktpSecond){
                Storage::delete($request->oldKtpSecond);
                $secondParty->idCard = $request->ktpSecond->store('id-card-images');
            }else{
                $secondParty->idCard = $request->oldKtpSecond;
            }

            $request->request->add(['user_id' => auth()->user()->id, 'first_party' => json_encode($firstParty), 'second_party' => json_encode($secondParty)]);
            $rules = [
                'user_id' => 'required',
                'first_party' => 'required',
                'price' => 'required',
                'duration' => 'required',
                'second_party' => 'required',
                'notes' => 'nullable',
                'published' => 'required',
                'start_at' => 'required',
                'end_at' => 'required'
            ];
    
            if($request->number != $landAgreement->number){
                $rules['number'] = 'required|unique:land_agreements';
            }
            $validateData = $request->validate($rules);

            LandAgreement::where('id', $landAgreement->id)
                    ->update($validateData);
                    
            return redirect('/show-land-agreement/'.$landAgreement->location->id)->with('success', 'Data sewa lahan dengan nomor '. $landAgreement->number. ' berhasil dirubah');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LandAgreement $landAgreement): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isLegal') && Gate::allows('isMediaDelete')) || (Gate::allows('isMedia') && Gate::allows('isLegal') && Gate::allows('isMediaDelete'))){
            foreach($landAgreement->land_documents as $document){
                Storage::delete($document->image);
                LandDocument::destroy($document->id);
            }
            LandAgreement::destroy($landAgreement->id);
            return redirect('/show-land-agreement/'.$landAgreement->location->id)->with('success', 'Dokumen sewa lahan dengan nomor '.$landAgreement->number.' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
