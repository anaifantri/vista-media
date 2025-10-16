<?php

namespace App\Http\Controllers;

use App\Models\ElectricalPower;
use App\Models\ElectricityTopUp;
use App\Models\ElectricityPayment;
use App\Models\ElectricalLocation;
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
            $locations = Location::with('electrical_powers')->get();
            $electrical_powers = ElectricalPower::with('locations')->get();
            $electricity_top_ups = ElectricityTopUp::with('electrical_power')->year()->get();
            $electricity_payments = ElectricityPayment::with('electrical_power')->year()->get();
            return response()-> view ('electrical-powers.index', [
                'locations'=>Location::filter(request('search'))->area()->city()->condition()->category()->sortable()->paginate(30)->withQueryString(),
                'electrical_powers'=>ElectricalPower::filter(request('search'))->type()->area()->city()->sortable()->paginate(30)->withQueryString(),
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'title' => 'Daftar Data Daya Listrik',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'locations', 'electricity_top_ups', 'electricity_payments')
            ]);
        } else {
            abort(403);
        }
    }

    public function deleteLocation(String $locationId, String $electricalId): RedirectResponse
    {
        if((Gate::allows('isAdmin') || Gate::allows('isMedia') || Gate::allows('isWorkshop') || Gate::allows('isAccounting') || Gate::allows('isMarketing')) && (Gate::allows('isElectricity') && Gate::allows('isWorkshopDelete'))){
                $getData = ElectricalPower::findOrFail($electricalId);
                $getData->locations()->detach($locationId);
                return redirect('workshop/electrical-powers/'.$electricalId.'/edit')->with('success', 'Lokasi berhasil dihapus');
        } else {
            abort(403);
        }
    }

    public function addLocation(String $locationId, String $electricalId): RedirectResponse
    {
        if((Gate::allows('isAdmin') || Gate::allows('isMedia') || Gate::allows('isWorkshop') || Gate::allows('isAccounting') || Gate::allows('isMarketing')) && (Gate::allows('isElectricity') && Gate::allows('isWorkshopDelete'))){
                $getData = ElectricalPower::findOrFail($electricalId);
                if($getData->locations()->where('location_id', $locationId)->exists()){
                    return redirect('workshop/electrical-powers/'.$electricalId.'/edit')->with('success', 'Lokasi sudah terdaftar');
                }else{
                    $getData->locations()->attach($locationId);
                    return redirect('workshop/electrical-powers/'.$electricalId.'/edit')->with('success', 'Lokasi berhasil ditambahkan');
                }
        } else {
            abort(403);
        }
    }

    public function showLocation(String $areaId, String $cityId, String $electricalId): View
    {
        if((Gate::allows('isAdmin') || Gate::allows('isMedia') || Gate::allows('isWorkshop')) && (Gate::allows('isElectricity') && Gate::allows('isWorkshopDelete'))){
            $locations = Location::where('area_id', $areaId)->where('city_id', $cityId)->filter(request('search'))->sortable()->paginate(30)->withQueryString();
            return view ('electrical-powers.add-locations', [
                'locations' => $locations,
                'electrical_id' => $electricalId,
                'area_id' => $areaId,
                'city_id' => $cityId,
                'title' => 'Menambahkan Lokasi'
            ]);
        } else {
            abort(403);
        }
    }

    public function createElectricalPower(String $locationId): View
    { 
        if((Gate::allows('isAdmin') || Gate::allows('isMedia') || Gate::allows('isWorkshop') || Gate::allows('isAccounting') || Gate::allows('isMarketing')) && (Gate::allows('isElectricity') && Gate::allows('isWorkshopCreate'))){
            $location = Location::findOrFail($locationId);
            return view ('electrical-powers.create', [
                'location' => $location,
                'areas' => Area::all(),
                'cities' => City::all(),
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
        if((Gate::allows('isAdmin') || Gate::allows('isMedia') || Gate::allows('isWorkshop') || Gate::allows('isAccounting') || Gate::allows('isMarketing')) && (Gate::allows('isElectricity') && Gate::allows('isWorkshopRead'))){
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $locations = Location::with('electrical_powers')->get();
            $electrical_powers = ElectricalPower::with('locations')->get();
            $electricity_top_ups = ElectricityTopUp::with('electrical_power')->year()->get();
            $electricity_payments = ElectricityPayment::with('electrical_power')->year()->get();
            return response()-> view ('electrical-powers.location-view', [
                'locations'=>Location::filter(request('search'))->area()->city()->condition()->category()->sortable()->paginate(30)->withQueryString(),
                'electrical_powers'=>ElectricalPower::filter(request('search'))->type()->area()->city()->sortable()->paginate(30)->withQueryString(),
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'title' => 'Daftar Data Daya Listrik',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'locations', 'electricity_top_ups', 'electricity_payments')
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
        if((Gate::allows('isAdmin') || Gate::allows('isMedia') || Gate::allows('isWorkshop') || Gate::allows('isAccounting') || Gate::allows('isMarketing')) && (Gate::allows('isElectricity') && Gate::allows('isWorkshopCreate'))){
            if ($request->type == 'pilih'){
                return back()->withErrors(['type' => ['Silahkan pilih jenis daya']])->withInput();
            }
            if ($request->power == 'pilih'){
                return back()->withErrors(['power' => ['Silahkan pilih daya listrik']])->withInput();
            }
            if ($request->area_id == 'pilih'){
                return back()->withErrors(['area_id' => ['Silahkan Area']])->withInput();
            }
            if ($request->city_id == 'pilih'){
                return back()->withErrors(['city_id' => ['Silahkan Kota']])->withInput();
            }
            $validateData = $request->validate([
                'user_id' => 'required',
                'area_id' => 'required',
                'city_id' => 'required',
                'type' => 'required',
                'power' => 'nullable',
                'id_number' => 'required|unique:electrical_powers',
                'name' => 'required'
            ]);

            $id = ElectricalPower::create($validateData)->id;

            $electricalLocation['location_id'] = $request->location_id;
            $electricalLocation['electrical_power_id'] = $id;
            ElectricalLocation::insert($electricalLocation);
    
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
            $locations = Location::with('electrical_powers')->get();
            $cities = City::with('locations')->get();
            $areas = Area::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            return response()-> view ('electrical-powers.show', [
                'electrical_power' => $electricalPower,
                'title' => 'Detail Daya Listrik',
                compact('cities', 'areas', 'media_sizes', 'media_categories', 'locations')
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
        if((Gate::allows('isAdmin') || Gate::allows('isMedia') || Gate::allows('isWorkshop') || Gate::allows('isAccounting') || Gate::allows('isMarketing')) && (Gate::allows('isElectricity') && Gate::allows('isWorkshopEdit'))){
            $locations = Location::with('electrical_powers')->get();
            $location_photos = LocationPhoto::with('location')->get();
            return response()-> view ('electrical-powers.edit', [
                'electrical_power' => $electricalPower,
                'data_locations' => Location::all(),
                'areas' => Area::all(),
                'cities' => City::all(),
                'title' => 'Edit Data Daya Listrik',
                compact('locations', 'location_photos')
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
        if((Gate::allows('isAdmin') || Gate::allows('isMedia') || Gate::allows('isWorkshop') || Gate::allows('isAccounting') || Gate::allows('isMarketing')) && (Gate::allows('isElectricity') && Gate::allows('isWorkshopEdit'))){
            $rules = [
                'user_id' => 'required',
                'type' => 'required',
                'power' => 'nullable',
                'id_number' => 'required',
                'name' => 'required'
            ];
                
            if($request->id_number != $electricalPower->id_number){
                $rules['id_number'] = 'required|unique:electrical_powers';
            }

            $validateData = $request->validate($rules);

            ElectricalPower::where('id', $electricalPower->id)
                    ->update($validateData);
                    
            return redirect('/workshop/electrical-powers/' . $electricalPower->id)->with('success', 'Data daya listrik  berhasil dirubah');
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
