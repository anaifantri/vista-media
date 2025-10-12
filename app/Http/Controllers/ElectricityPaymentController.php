<?php

namespace App\Http\Controllers;

use App\Models\ElectricityPayment;
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

class ElectricityPaymentController extends Controller
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
            $electrical_powers = ElectricalPower::with('electricity_payments')->get();
            $locations = Location::with('electrical_powers')->get();
            return response()-> view ('electricity-payments.index', [
                'electricity_payments'=>ElectricityPayment::filter(request('search'))->area()->city()->month()->year()->sortable()->paginate(30)->withQueryString(),
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'title' => 'Daftar Data Pembayaran Listrik',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'electrical_powers', 'locations')
            ]);
        } else {
            abort(403);
        }
    }

    public function electricityPaymentReport(): View
    { 
        if(Gate::allows('isElectricity') && Gate::allows('isWorkshopRead')){
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $sales = Sale::with('location')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $electricity_payments = ElectricityPayment::with('location')->get();
            return view ('electricity-payments.report', [
                'locations'=>Location::filter(request('search'))->area()->city()->condition()->category()->sortable()->paginate(15)->withQueryString(),
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'title' => 'Laporan Pembayaran Listrik',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'electricity_payments', 'sales')
            ]);
        } else {
            abort(403);
        }
    }

    public function showElectricityPayment(String $electricalId): View
    { 
        if(Gate::allows('isElectricity') && Gate::allows('isWorkshopRead')){
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $electrical_power = ElectricalPower::findOrFail($electricalId);
            $locations = Location::with('electrical_powers')->get();
            $payments = ElectricityPayment::where('electrical_power_id', $electricalId)->year()->get();
            return view ('electricity-payments.show-payments', [
                'electrical_power' => $electrical_power,
                'payments' => $payments,
                'title' => 'Detail Data Pembayaran Listrik',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'locations')
            ]);
        } else {
            abort(403);
        }
    }

    public function createElectricityPayment(String $electricalId): View
    { 
        if((Gate::allows('isAdmin') && Gate::allows('isElectricity') && Gate::allows('isWorkshopCreate')) || (Gate::allows('isWorkshop') && Gate::allows('isElectricity') && Gate::allows('isWorkshopCreate'))){
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $electrical_power = ElectricalPower::findOrFail($electricalId);
            $locations = Location::with('electrical_powers')->get();
            return view ('electricity-payments.create', [
                'electrical_power' => $electrical_power,
                'title' => 'Menambahkan Data Pembayaran Listrik',
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
            return response()-> view ('electricity-payments.select-power', [
                'electrical_powers'=>ElectricalPower::where('type', 'Pascabayar')->filter(request('search'))->area()->city()->get(),
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
        if((Gate::allows('isAdmin') && Gate::allows('isElectricity') && Gate::allows('isWorkshopCreate')) || (Gate::allows('isWorkshop') && Gate::allows('isElectricity') && Gate::allows('isWorkshopCreate'))){
            $validateData = $request->validate([
                'electrical_power_id' => 'required',
                'user_id' => 'required',
                'bill_date' => 'required',
                'payment_date' => 'required',
                'payment' => 'required',
                'payment_image' => 'required|image|file|max:1024'
            ]);
            $validateData['bill_date'] = $request->bill_date.'-01';
            $validateData['payment_image'] = $request->file('payment_image')->store('electricity-images');

            ElectricityPayment::create($validateData);

            return redirect('/workshop/electricity-payments')->with('success','Data pembayaran listrik berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ElectricityPayment $electricityPayment): Response
    {
        if(Gate::allows('isElectricity') && Gate::allows('isWorkshopRead')){
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $electrical_power = ElectricalPower::findOrFail($electricityPayment->electrical_power_id);
            $locations = Location::with('electrical_powers')->get();
            return response()-> view ('electricity-payments.show', [
                'electrical_power' => $electrical_power,
                'electricity_payment' => $electricityPayment,
                'title' => 'Detail Pembayaran Tagihan Listrik',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'locations')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ElectricityPayment $electricityPayment): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isElectricity') && Gate::allows('isWorkshopEdit')) || (Gate::allows('isWorkshop') && Gate::allows('isElectricity') && Gate::allows('isWorkshopEdit'))){$areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $electrical_power = ElectricalPower::findOrFail($electricityPayment->electrical_power_id);
            $locations = Location::with('electrical_powers')->get();
            return response()-> view ('electricity-payments.edit', [
                'electrical_power' => $electrical_power,
                'electricity_payment' => $electricityPayment,
                'title' => 'Edit Data Pembayaran Listrik',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'locations')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ElectricityPayment $electricityPayment): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isElectricity') && Gate::allows('isWorkshopEdit')) || (Gate::allows('isWorkshop') && Gate::allows('isElectricity') && Gate::allows('isWorkshopEdit'))){    
            $rules = [
                'user_id' => 'required',
                'bill_date' => 'required',
                'payment_date' => 'required',
                'payment' => 'required',
            ];

            if($request->file('payment_image')){
                $rules['payment_image'] = 'required|image|file|max:1024';
            }

            $validateData = $request->validate($rules);

            $validateData['bill_date'] = $request->bill_date.'-01';

            if($request->file('payment_image')){
                Storage::delete($request->oldPaymentImage);
                $validateData['payment_image'] = $request->file('payment_image')->store('electricity-images');
            }

            ElectricityPayment::where('id', $electricityPayment->id)->update($validateData);

            return redirect('/workshop/electricity-payments')->with('success','Data pembayaran listrik berhasil dirubah');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ElectricityPayment $electricityPayment): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isElectricity') && Gate::allows('isWorkshopDelete')) || (Gate::allows('isWorkshop') && Gate::allows('isElectricity') && Gate::allows('isWorkshopDelete'))){
            if($electricityPayment->payment_image){
                Storage::delete($electricityPayment->payment_image);
            }
            ElectricityPayment::destroy($electricityPayment->id);
            return redirect('/workshop/electricity-payments')->with('success', 'Data pembayaran listrik berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
