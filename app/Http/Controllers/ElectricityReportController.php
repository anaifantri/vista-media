<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use App\Models\MediaSize;
use App\Models\MediaCategory;
use App\Models\Location;
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
        if(Gate::allows('isWorkshopRead')){
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            if(request('rbView')){
                if(request('rbView') == "Daya"){
                    $electricals = ElectricalPower::filter(request('search'))->area()->city()->get();
                    $electricity_top_ups = ElectricityTopUp::with('electrical_power')->get();
                    $electricity_payments = ElectricityPayment::with('electrical_power')->get();
                    $locations = Location::with('electrical_powers')->get();
                    return view ('electricity-reports.index', [
                        'electricals'=>$electricals,
                        'areas'=> Area::all(),
                        'cities'=> City::all(),
                        'title' => 'Daftar Data Pengisian Pulsa Listrik',
                        compact('areas', 'cities', 'media_sizes', 'media_categories', 'locations', 'electricity_top_ups', 'electricity_payments')
                    ]);
                }elseif(request('rbView') == "Pascabayar"){
                    $electricals = ElectricityPayment::month()->year()->get();
                    $electrical_powers = ElectricalPower::with('electricity_payments')->get();
                    $locations = Location::with('electrical_powers')->get();
                    return view ('electricity-reports.index', [
                        'electricals'=>$electricals,
                        'title' => 'Daftar Data Pengisian Pulsa Listrik',
                        compact('areas', 'cities', 'media_sizes', 'media_categories', 'locations', 'electrical_powers')
                    ]);
                }else{
                    $electricals = ElectricityTopUp::month()->year()->get();
                    $electrical_powers = ElectricalPower::with('electricity_top_ups')->get();
                    $locations = Location::with('electrical_powers')->get();
                    return view ('electricity-reports.index', [
                        'electricals'=>$electricals,
                        'title' => 'Daftar Data Pengisian Pulsa Listrik',
                        compact('areas', 'cities', 'media_sizes', 'media_categories', 'locations', 'electrical_powers')
                    ]);
                }
            }else{
                    $electricals = ElectricalPower::filter(request('search'))->area()->city()->get();
                    $electricity_top_ups = ElectricityTopUp::with('electrical_power')->get();
                    $electricity_payments = ElectricityPayment::with('electrical_power')->get();
                    $locations = Location::with('electrical_powers')->get();
                    return view ('electricity-reports.index', [
                        'electricals'=>$electricals,
                        'areas'=> Area::all(),
                        'cities'=> City::all(),
                        'title' => 'Daftar Data Pengisian Pulsa Listrik',
                        compact('areas', 'cities', 'media_sizes', 'media_categories', 'locations', 'electricity_top_ups', 'electricity_payments')
                    ]);
            }
        } else {
            abort(403);
        }
    }
}
