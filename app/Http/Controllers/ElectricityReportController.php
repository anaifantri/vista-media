<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Gate;

class ElectricityReportController extends Controller
{
    public function index(): View
    { 
        if(Gate::allows('isWorkshopRead')){
            $areas = Area::with('locations')->get();
            return view ('electricity-reports.index', [
                'locations'=>Location::all(),
                'areas'=>Area::all(),
                'title' => 'Laporan Data Produksi',
                compact('areas')
            ]);
        } else {
            abort(403);
        }
    }
}
