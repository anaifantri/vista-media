<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\LocationPhoto;
use App\Models\MediaCategory;
use App\Models\Area;
use App\Models\City;
use App\Models\License;
use App\Models\LicensingCategory;

use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        $locations = Location::with('area')->get();
        $cities = City::with('area')->get();
        $active_licenses = count(Location::activeLicenses()->get());
        $expired_licenses = count(Location::expiredLicenses()->get());
        $expired_soon_licenses = count(Location::expiredSoonLicenses()->get());
        $active_agreements = count(Location::activeAgreements()->get());
        $expired_agreements = count(Location::expiredAgreements()->get());
        $expired_soon_agreements = count(Location::expiredSoonAgreements()->get());
        return view('dashboard.index',[
            'title' => "Dashboard",
            'active_licenses' => $active_licenses,
            'expired_licenses' => $expired_licenses,
            'expired_soon_licenses' => $expired_soon_licenses,
            'active_agreements' => $active_agreements,
            'expired_agreements' => $expired_agreements,
            'expired_soon_agreements' => $expired_soon_agreements,
            'areas' => Area::All(),
            compact('locations', 'cities')
        ]);
    }
}
