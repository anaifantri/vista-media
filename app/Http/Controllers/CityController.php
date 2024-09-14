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
        return response()-> view ('cities.index',[
            'cities'=>City::sortable()->with(['user', 'area'])->filter(request(['search']))->paginate(10)->withQueryString(),
            'title' => 'Daftar Kota'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()->view('cities.create', [
                'title' => 'Tambah Kota',
                'cities'=>City::all(),
                'areas'=>Area::all()
            ]);
        } else {
            abort(403);
        }
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
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
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
            return redirect('/cities')->with('success','Kota '. $city . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city): Response
    {
        $cities = City::with('area')->with('user')->get();
        $areas = Area::with('cities')->get();
        $users = User::with('cities')->get();

        return response()-> view ('cities.show', [
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
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            City::destroy($city->id);

            return redirect('/cities')->with('success','Kota '. $city->city .' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
