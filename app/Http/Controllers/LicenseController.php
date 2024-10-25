<?php

namespace App\Http\Controllers;

use App\Models\License;
use App\Models\Location;
use App\Models\MediaCategory;
use App\Models\Company;
use App\Models\Area;
use App\Models\City;
use App\Models\MediaSize;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LicenseController extends Controller
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
        $licenses = License::with('location')->get();
        return response()-> view ('licenses.index', [
            'locations'=>Location::filter(request('search'))->area()->city()->condition()->category()->sortable()->paginate(15)->withQueryString(),
            'areas'=>Area::all(),
            'cities'=>City::all(),
            'title' => 'Daftar Data Perizinan',
            compact('areas', 'cities', 'media_sizes', 'media_categories', 'licenses')
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
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(License $license): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(License $license): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, License $license): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(License $license): RedirectResponse
    {
        //
    }
}
