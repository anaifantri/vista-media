<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Area;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()-> view ('dashboard.media.cities.index',[
            'cities'=>City::all(),
            'title' => 'Daftar Kota',
            'areas'=>Area::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('dashboard.media.cities.create', [
            'title' => 'Tambah Kota',
        ]);
    }

    public function showCity(){
        $dataCity = City::All();

        return response()->json(['dataCity'=> $dataCity]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if($request->area == 'Pilih Area'){
            return back()->withErrors(['area' => ['Silahkan pilih area']]);
        }

        if($request->city == 'Pilih Kota'){
            return back()->withErrors(['city' => ['Silahkan pilih Kota'],'area' => ['Silahkan pilih Area']]);
        }

        $validateData = $request->validate([
            'code' => 'required',
            'area' => 'required',
            'city' => 'required|unique:cities',
            'lat' => 'required',
            'lng' => 'required',
            'zoom' => 'required'
        ]);
        $validateData['code'] = $request->input('code');
        $validateData['area'] = $request->input('area');
        $validateData['city'] = $request->input('city');
        $validateData['lat'] = $request->input('lat');
        $validateData['lng'] = $request->input('lng');
        $validateData['zoom'] = $request->input('zoom');
        $validateData['username'] = auth()->user()->name;
        City::create($validateData);

        $city = $request->input('city');
        return redirect('/dashboard/media/cities')->with('success','Kota '. $city . ' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city): Response
    {
        return response()-> view ('dashboard.media.cities.show', [
            'city' => $city,
            'title' => 'Kota ' . $city->city,
            'areas'=>Area::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city): RedirectResponse
    {
        City::destroy($city->id);

        return redirect('/dashboard/media/cities')->with('success','Kota '. $city->city .' berhasil dihapus');
    }
}
