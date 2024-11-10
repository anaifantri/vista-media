<?php

namespace App\Http\Controllers;

use App\Models\ElectricalPower;
use App\Models\Location;
use App\Models\LocationPhoto;
use App\Models\MediaCategory;
use App\Models\Company;
use App\Models\Area;
use App\Models\City;
use App\Models\MediaSize;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Gate;

class ElectricalPowerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        if(Gate::allows('isElectricity') && Gate::allows('isWorkshopRead')){
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $electrical_power = ElectricalPower::with('location')->get();
            return response()-> view ('electrical-powers.index', [
                'locations'=>Location::filter(request('search'))->area()->city()->condition()->category()->sortable()->paginate(15)->withQueryString(),
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'title' => 'Daftar Data Daya Listrik',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'electrical_power')
            ]);
        } else {
            abort(403);
        }
    }

    public function createElectricalPower(String $locationId): View
    { 
        if((Gate::allows('isAdmin') && Gate::allows('isElectricity') && Gate::allows('isWorkshopCreate')) || (Gate::allows('isWorkshop') && Gate::allows('isElectricity') && Gate::allows('isWorkshopCreate'))){
            $location = Location::findOrFail($locationId);
            return view ('electrical-powers.create', [
                'location_id' => $locationId,
                'location' => $location,
                'location_photo'=>LocationPhoto::where('location_id', $locationId)->where('company_id', $location->company_id)->where('set_default', true)->get()->last(),
                'title' => 'Menambahkan Data Daya Listrik'
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
            if ($request->type == 'pilih'){
                return back()->withErrors(['type' => ['Silahkan pilih jenis daya']])->withInput();
            }
            if ($request->power == 'pilih'){
                return back()->withErrors(['power' => ['Silahkan pilih daya listrik']])->withInput();
            }
            $validateData = $request->validate([
                'user_id' => 'required',
                'location_id' => 'required',
                'type' => 'required',
                'power' => 'nullable',
                'id_number' => 'required',
                'name' => 'required'
            ]);
            ElectricalPower::create($validateData);
    
            return redirect('/workshop/electrical-powers')->with('success', 'Data daya listrik berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ElectricalPower $electricalPower): Response
    {
        if(Gate::allows('isElectricity') && Gate::allows('isWorkshopRead')){
            $location = Location::findOrFail($electricalPower->location->id);
            $cities = City::with('locations')->get();
            $areas = Area::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            return response()-> view ('electrical-powers.show', [
                'electrical_power' => $electricalPower,
                'location' => $location,
                'location_photo'=>LocationPhoto::where('location_id', $location->id)->where('company_id', $location->company_id)->where('set_default', true)->get()->last(),
                'title' => 'Detail Daya Listrik',
                compact('location', 'cities', 'areas', 'media_sizes', 'media_categories')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ElectricalPower $electricalPower): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isElectricity') && Gate::allows('isWorkshopEdit')) || (Gate::allows('isWorkshop') && Gate::allows('isElectricity') && Gate::allows('isWorkshopEdit'))){
            $location = Location::findOrFail($electricalPower->location->id);
            return response()-> view ('electrical-powers.edit', [
                'electrical_power' => $electricalPower,
                'location' => $location,
                'location_photo'=>LocationPhoto::where('location_id', $location->id)->where('company_id', $location->company_id)->where('set_default', true)->get()->last(),
                'title' => 'Edit Data Daya Listrik'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ElectricalPower $electricalPower): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isElectricity') && Gate::allows('isWorkshopEdit')) || (Gate::allows('isWorkshop') && Gate::allows('isElectricity') && Gate::allows('isWorkshopEdit'))){
            $rules = [
                'user_id' => 'required',
                'type' => 'required',
                'power' => 'nullable',
                'id_number' => 'required',
                'name' => 'required'
            ];

            $validateData = $request->validate($rules);

            ElectricalPower::where('id', $electricalPower->id)
                    ->update($validateData);
                    
            return redirect('/workshop/electrical-powers')->with('success', 'Data daya listrik untuk lokasi dengan kode '.$electricalPower->location->code.' berhasil dirubah');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ElectricalPower $electricalPower): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isElectricity') && Gate::allows('isWorkshopDelete')) || (Gate::allows('isWorkshop') && Gate::allows('isElectricity') && Gate::allows('isWorkshopDelete'))){
                ElectricalPower::destroy($electricalPower->id);
                return redirect('/workshop/electrical-powers')->with('success', 'Data daya listrik untuk lokasi dengan kode '.$electricalPower->location->code.' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
