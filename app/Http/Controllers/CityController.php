<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Area;
use App\Models\User;
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
        // $cities = City::with('area')->with('user')->get();
        // $areas = Area::with('cities')->get();
        // $users = User::with('cities')->get();
        
        return response()-> view ('dashboard.media.cities.index',[
            'cities'=>City::sortable()->with(['user', 'area'])->get(),
            'title' => 'Daftar Kota'
            // compact('cities','areas', 'users')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('dashboard.media.cities.create', [
            'title' => 'Tambah Kota',
            'cities'=>City::all(),
            'areas'=>Area::all()
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
        if($request->area_id == 'Pilih Area'){
            return back()->withErrors(['area_id' => ['Silahkan pilih area']])->withInput();
        }

        if ($request->city == 'Pilih Kota'){
            return back()->withErrors(['city' => ['Silahkan pilih kota']])->withInput();
        }

        $validateData = $request->validate([
            'code' => 'required',
            'area_id' => 'required',
            'city' => 'required|unique:cities',
            'lat' => 'required',
            'lng' => 'required',
            'zoom' => 'required'
        ]);
        $validateData['code'] = $request->input('code');
        $validateData['area_id'] = $request->input('area_id');
        $validateData['city'] = $request->input('city');
        $validateData['lat'] = $request->input('lat');
        $validateData['lng'] = $request->input('lng');
        $validateData['zoom'] = $request->input('zoom');
        $validateData['user_id'] = auth()->user()->id;
        City::create($validateData);

        $city = $request->input('city');
        return redirect('/dashboard/media/cities')->with('success','Kota '. $city . ' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city): Response
    {
        $cities = City::with('area')->with('user')->get();
        $areas = Area::with('cities')->get();
        $users = User::with('cities')->get();

        return response()-> view ('dashboard.media.cities.show', [
            'city' => $city,
            'title' => 'Kota ' . $city->city,
            'areas'=>Area::all(),
            compact('cities','areas', 'users')
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
