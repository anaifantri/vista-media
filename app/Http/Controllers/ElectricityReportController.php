<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use App\Models\MediaSize;
use App\Models\MediaCategory;
use App\Models\Location;
use App\Models\LocationPhoto;
use App\Models\Company;
use App\Models\ElectricalLocation;
use App\Models\ElectricalPower;
use App\Models\ElectricityPayment;
use App\Models\ElectricityTopUp;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Gate;

class ElectricityReportController extends Controller
{
    public function index(): View
    { 
        if(Gate::allows('isElectricity') && Gate::allows('isWorkshopRead')){
            return view ('electricity-reports.index', [
                'title' => 'Laporan Data Kelistrikan'
            ]);
        } else {
            abort(403);
        }
    }

    public function electricalPower() : view 
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
            return view ('electricity-reports.electrical-power', [
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

    public function electricalPayment() : view 
    {
        if(Gate::allows('isElectricity') && Gate::allows('isWorkshopRead')){
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $electrical_powers = ElectricalPower::with('electricity_payments')->get();
            $locations = Location::with('electrical_powers')->get();
            return view ('electricity-reports.payment', [
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

    public function electricalTopUp() : view 
    {
        if(Gate::allows('isElectricity') && Gate::allows('isWorkshopRead')){
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $electrical_powers = ElectricalPower::with('electricity_top_ups')->get();
            $locations = Location::with('electrical_powers')->get();
            return view ('electricity-reports.top-up', [
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
}
