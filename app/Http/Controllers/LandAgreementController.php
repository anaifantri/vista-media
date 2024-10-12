<?php

namespace App\Http\Controllers;

use App\Models\LandAgreement;
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

class LandAgreementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $areas = Area::with('locations')->get();
        $cities = City::with('locations')->get();
        $media_sizes = MediaSize::with('locations')->get();
        $media_categories = MediaCategory::with('locations')->get();
        $land_agreements = LandAgreement::with('location')->get();
        return response()-> view ('land-agreements.index', [
            'locations'=>Location::filter(request('search'))->area()->city()->condition()->category()->sortable()->paginate(15)->withQueryString(),
            'areas'=>Area::all(),
            'cities'=>City::all(),
            'categories'=>MediaCategory::all(),
            'title' => 'Daftar Perjanjian Sewa',
            compact('areas', 'cities', 'media_sizes', 'media_categories', 'land_agreements')
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LandAgreement $landAgreement): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LandAgreement $landAgreement): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLandAgreementRequest $request, LandAgreement $landAgreement): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LandAgreement $landAgreement): RedirectResponse
    {
        //
    }
}
