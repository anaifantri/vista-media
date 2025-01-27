<?php

namespace App\Http\Controllers;

use App\Models\ElectricityTopUp;
use App\Models\Location;
use App\Models\Sale;
use App\Models\LocationPhoto;
use App\Models\MediaCategory;
use App\Models\Company;
use App\Models\Area;
use App\Models\City;
use App\Models\MediaSize;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Gate;

class ElectricityTopUpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        if(Gate::allows('isElectricity') && Gate::allows('isWorkshopRead')){
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $sales = Sale::with('location')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $electricity_top_ups = ElectricityTopUp::with('location')->get();
            return response()-> view ('electricity-top-ups.index', [
                'locations'=>Location::filter(request('search'))->area()->city()->condition()->category()->sortable()->paginate(30)->withQueryString(),
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'title' => 'Daftar Data Pengisian Pulsa Listrik',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'electricity_top_ups', 'sales')
            ]);
        } else {
            abort(403);
        }
    }

    public function showElectricityTopup(String $locationId): View
    { 
        if(Gate::allows('isElectricity') && Gate::allows('isWorkshopRead')){
            $dataTopUps = ElectricityTopUp::where('location_id', $locationId)->get();
            $location = Location::where('id', $locationId)->firstOrFail();
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            return view ('electricity-top-ups.show-top-ups', [
                'top_ups' => $dataTopUps,
                'location' => $location,
                'title' => 'Detail Data Pengisian Pulsa Listrik',
                compact('areas', 'cities', 'media_categories', 'media_sizes')
            ]);
        } else {
            abort(403);
        }
    }

    public function createElectricityTopUp(String $locationId): View
    { 
        if((Gate::allows('isAdmin') && Gate::allows('isElectricity') && Gate::allows('isWorkshopCreate')) || (Gate::allows('isWorkshop') && Gate::allows('isElectricity') && Gate::allows('isWorkshopCreate'))){
            $location = Location::findOrFail($locationId);
            return view ('electricity-top-ups.create', [
                'location_id' => $locationId,
                'location' => $location,
                'location_photo'=>LocationPhoto::where('location_id', $locationId)->where('company_id', $location->company_id)->where('set_default', true)->get()->last(),
                'title' => 'Menambahkan Data Pengisian Pulsa Listrik'
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
        if((Gate::allows('isAdmin') && Gate::allows('isElectricity') && Gate::allows('isWorkshopCreate')) || (Gate::allows('isWorkshop') && Gate::allows('isElectricity') && Gate::allows('isWorkshopCreate'))){
            $validateData = $request->validate([
                'location_id' => 'required',
                'user_id' => 'required',
                'topup_date' => 'required',
                'top_up_nominal' => 'required',
                'kwh_qty' => 'required',
                'remaining_kwh_qty' => 'required',
                'last_kwh_qty' => 'required',
                'receipt_image' => 'required|image|file|max:1024',
                'remaining_image' => 'required|image|file|max:1024',
                'last_image' => 'required|image|file|max:1024'
            ]);
            $validateData['receipt_image'] = $request->file('receipt_image')->store('electricity-images');
            $validateData['remaining_image'] = $request->file('remaining_image')->store('electricity-images');
            $validateData['last_image'] = $request->file('last_image')->store('electricity-images');

            ElectricityTopUp::create($validateData);

            return redirect('/workshop/electricity-top-ups')->with('success','Data pengisian pulsa listrik berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ElectricityTopUp $electricityTopUp): Response
    {
        if(Gate::allows('isElectricity') && Gate::allows('isWorkshopRead')){
            $location = Location::findOrFail($electricityTopUp->location->id);
            $cities = City::with('locations')->get();
            $areas = Area::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            return response()-> view ('electricity-top-ups.show', [
                'electricity_top_up' => $electricityTopUp,
                'location' => $location,
                'location_photo'=>LocationPhoto::where('location_id', $location->id)->where('company_id', $location->company_id)->where('set_default', true)->get()->last(),
                'title' => 'Detail Pengisian Pulsa Listrik',
                compact('location', 'cities', 'areas', 'media_sizes', 'media_categories')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ElectricityTopUp $electricityTopUp): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isElectricity') && Gate::allows('isWorkshopEdit')) || (Gate::allows('isWorkshop') && Gate::allows('isElectricity') && Gate::allows('isWorkshopEdit'))){
            $location = Location::findOrFail($electricityTopUp->location->id);
            return response()-> view ('electricity-top-ups.edit', [
                'electricity_top_up' => $electricityTopUp,
                'location' => $location,
                'location_photo'=>LocationPhoto::where('location_id', $location->id)->where('company_id', $location->company_id)->where('set_default', true)->get()->last(),
                'title' => 'Edit Data Pembelian Pulsa Listrik'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ElectricityTopUp $electricityTopUp): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isElectricity') && Gate::allows('isWorkshopEdit')) || (Gate::allows('isWorkshop') && Gate::allows('isElectricity') && Gate::allows('isWorkshopEdit'))){
            $rules = [
                'user_id' => 'required',
                'topup_date' => 'required',
                'top_up_nominal' => 'required',
                'kwh_qty' => 'required',
                'remaining_kwh_qty' => 'required',
                'last_kwh_qty' => 'required'
            ];
            if($request->file('receipt_image')){
                $rules['receipt_image'] = 'required|image|file|max:1024';
            }
            if($request->file('remaining_image')){
                $rules['remaining_image'] = 'required|image|file|max:1024';
            }
            if($request->file('last_image')){
                $rules['last_image'] = 'required|image|file|max:1024';
            }

            $validateData = $request->validate($rules);

            if($request->file('receipt_image')){
                Storage::delete($request->oldReceiptImage);
                $validateData['receipt_image'] = $request->file('receipt_image')->store('electricity-images');
            }
            if($request->file('remaining_image')){
                Storage::delete($request->oldRemainingImage);
                $validateData['remaining_image'] = $request->file('remaining_image')->store('electricity-images');
            }
            if($request->file('last_image')){
                Storage::delete($request->oldLastImage);
                $validateData['last_image'] = $request->file('last_image')->store('electricity-images');
            }

            ElectricityTopUp::where('id', $electricityTopUp->id)->update($validateData);

            return redirect('/show-electricity-top-up/'.$electricityTopUp->location->id)->with('success','Data pengisian pulsa listrik berhasil dirubah');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ElectricityTopUp $electricityTopUp): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isElectricity') && Gate::allows('isWorkshopDelete')) || (Gate::allows('isWorkshop') && Gate::allows('isElectricity') && Gate::allows('isWorkshopDelete'))){
            if($electricityTopUp->receipt_image){
                Storage::delete($electricityTopUp->receipt_image);
            }
            if($electricityTopUp->remaining_image){
                Storage::delete($electricityTopUp->remaining_image);
            }
            if($electricityTopUp->last_image){
                Storage::delete($electricityTopUp->last_image);
            }
            ElectricityTopUp::destroy($electricityTopUp->id);
            return redirect('/show-electricity-top-up/'.$electricityTopUp->location->id)->with('success', 'Data pengisian pulsa listrik berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
