<?php

namespace App\Http\Controllers;

use App\Models\ElectricityTopUp;
use App\Models\ElectricalPower;
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
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $electrical_powers = ElectricalPower::with('electricity_top_ups')->get();
            $locations = Location::with('electrical_powers')->get();
            return response()-> view ('electricity-top-ups.index', [
                'electricity_top_ups'=>ElectricityTopUp::filter(request('search'))->area()->city()->month()->year()->sortable()->paginate(30)->withQueryString(),
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'title' => 'Daftar Data Pengisian Pulsa Listrik',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'electrical_powers', 'locations')
            ]);
        } else {
            abort(403);
        }
    }

    public function showElectricityTopup(String $electricalId): View
    { 
        if(Gate::allows('isElectricity') && Gate::allows('isWorkshopRead')){
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $electrical_power = ElectricalPower::findOrFail($electricalId);
            $locations = Location::with('electrical_powers')->get();
            $topUps = ElectricityTopUp::where('electrical_power_id', $electricalId)->year()->get();
            return view ('electricity-top-ups.show-top-ups', [
                'electrical_power' => $electrical_power,
                'top_ups' => $topUps,
                'title' => 'Detail Pengisian Pulsa Listrik',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'locations')
            ]);
        } else {
            abort(403);
        }
    }

    public function createElectricityTopUp(String $electricalId): View
    { 
        if((Gate::allows('isAdmin') || Gate::allows('isWorkshop') || Gate::allows('isMedia') || Gate::allows('isMarketing') || Gate::allows('isAccounting')) && (Gate::allows('isElectricity') && Gate::allows('isWorkshopCreate'))){
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $electrical_power = ElectricalPower::findOrFail($electricalId);
            $locations = Location::with('electrical_powers')->get();
            return view ('electricity-top-ups.create', [
                'electrical_power' => $electrical_power,
                'title' => 'Menambahkan Data Pengisian Pulsa Listrik',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'locations')
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
        if(Gate::allows('isElectricity') && Gate::allows('isWorkshopRead')){
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $sales = Sale::with('location')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $electrical_powers = ElectricalPower::with('electricity_top_ups')->get();
            $locations = Location::with('electrical_powers')->get();
            return response()-> view ('electricity-top-ups.select-power', [
                'electrical_powers'=>ElectricalPower::where('type', 'Prabayar')->filter(request('search'))->area()->city()->get(),
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'title' => 'Daftar Data Pengisian Pulsa Listrik',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'sales', 'locations')
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
        if((Gate::allows('isAdmin') || Gate::allows('isWorkshop') || Gate::allows('isMedia') || Gate::allows('isMarketing') || Gate::allows('isAccounting')) && (Gate::allows('isElectricity') && Gate::allows('isWorkshopCreate'))){
            $validateData = $request->validate([
                'electrical_power_id' => 'required',
                'user_id' => 'required',
                'topup_date' => 'required',
                'top_up_nominal' => 'required',
                'kwh_qty' => 'required',
                'remaining_kwh_qty' => 'nullable',
                'last_kwh_qty' => 'nullable',
                'receipt_image' => 'required|image|file|max:1024',
                'remaining_image' => 'nullable|image|file|max:1024',
                'last_image' => 'nullable|image|file|max:1024'
            ]);
            
            $validateData['receipt_image'] = $request->file('receipt_image')->store('electricity-images');
            if($request->file('remaining_image')){
                $validateData['remaining_image'] = $request->file('remaining_image')->store('electricity-images');
            }
            
            if($request->file('remaining_image')){
                $validateData['last_image'] = $request->file('last_image')->store('electricity-images');
            }

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
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $electrical_power = ElectricalPower::findOrFail($electricityTopUp->electrical_power_id);
            $locations = Location::with('electrical_powers')->get();
            return response()-> view ('electricity-top-ups.show', [
                'electrical_power' => $electrical_power,
                'electricity_top_up' => $electricityTopUp,
                'title' => 'Detail Pengisian Pulsa Listrik',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'locations')
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
        if((Gate::allows('isAdmin') || Gate::allows('isWorkshop') || Gate::allows('isMedia') || Gate::allows('isMarketing') || Gate::allows('isAccounting')) && (Gate::allows('isElectricity') && Gate::allows('isWorkshopEdit'))){
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $electrical_power = ElectricalPower::findOrFail($electricityTopUp->electrical_power_id);
            $locations = Location::with('electrical_powers')->get();
            return response()-> view ('electricity-top-ups.edit', [
                'electrical_power' => $electrical_power,
                'electricity_top_up' => $electricityTopUp,
                'title' => 'Menambahkan Data Pengisian Pulsa Listrik',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'locations')
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
        if((Gate::allows('isAdmin') || Gate::allows('isWorkshop') || Gate::allows('isMedia') || Gate::allows('isMarketing') || Gate::allows('isAccounting')) && (Gate::allows('isElectricity') && Gate::allows('isWorkshopEdit'))){
            $rules = [
                'user_id' => 'required',
                'topup_date' => 'required',
                'top_up_nominal' => 'required',
                'kwh_qty' => 'required',
                'remaining_kwh_qty' => 'nullable',
                'last_kwh_qty' => 'nullable'
            ];
            if($request->file('receipt_image')){
                $rules['receipt_image'] = 'nullable|image|file|max:1024';
            }
            if($request->file('remaining_image')){
                $rules['remaining_image'] = 'nullable|image|file|max:1024';
            }
            if($request->file('last_image')){
                $rules['last_image'] = 'nullable|image|file|max:1024';
            }

            $validateData = $request->validate($rules);

            if($request->file('receipt_image')){
                Storage::delete($request->oldReceiptImage);
                $validateData['receipt_image'] = $request->file('receipt_image')->store('electricity-images');
            }
            if($request->file('remaining_image')){
                if($request->oldRemainingImage){
                    Storage::delete($request->oldRemainingImage);
                }
                $validateData['remaining_image'] = $request->file('remaining_image')->store('electricity-images');
            }
            if($request->file('last_image')){
                if($request->oldLastImage){
                    Storage::delete($request->oldLastImage);
                }
                $validateData['last_image'] = $request->file('last_image')->store('electricity-images');
            }

            ElectricityTopUp::where('id', $electricityTopUp->id)->update($validateData);

            return redirect('/workshop/electricity-top-ups')->with('success','Data pengisian pulsa listrik berhasil dirubah');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ElectricityTopUp $electricityTopUp): RedirectResponse
    {
        if((Gate::allows('isAdmin') || Gate::allows('isWorkshop') || Gate::allows('isMedia') || Gate::allows('isMarketing') || Gate::allows('isAccounting')) && (Gate::allows('isElectricity') && Gate::allows('isWorkshopDelete'))){
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
            return redirect('/workshop/electricity-top-ups')->with('success', 'Data pengisian pulsa listrik berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
