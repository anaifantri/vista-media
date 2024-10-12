<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Area;
use App\Models\User;
use App\Models\MediaCategory;
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
            'title' => 'Daftar Kota',
            'categories' => MediaCategory::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()->view('cities.create', [
                'title' => 'Menambahkan Data Kota',
                'areas'=>Area::all(),
                'categories' => MediaCategory::all()
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
            if($request->area_id == 'pilih'){
                return back()->withErrors(['area_id' => ['Silahkan pilih area']])->withInput();
            }

            if ($request->lat == ""){
                return back()->withErrors(['lat' => ['Silahkan memberikan tanda pada peta untuk menentukan lokasi kota']])->withInput();
            }
            
            $request->request->add(['user_id' => auth()->user()->id]);
            $validateData = $request->validate([
                'code' => 'required|unique:cities',
                'city' => 'required|unique:cities',
                'area_id' => 'required',
                'user_id' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'zoom' => 'required'
            ]);
            City::create($validateData);
    
            $city = $request->input('city');
            return redirect('/media/cities')->with('success','Data kota dengan nama '. $city . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city): Response
    {
        $areas = Area::with('cities')->get();
        $users = User::with('cities')->get();

        return response()-> view ('cities.show', [
            'city' => $city,
            'title' => 'Data Kota ' . $city->city,
            'categories' => MediaCategory::all(),
            compact('areas', 'users')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city): Response
    {
        return response()->view('cities.edit', [
            'city' => $city,
            'areas' => Area::all(),
            'title' => 'Merubah Data Kota'.$city->city,
            'categories' => MediaCategory::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city): RedirectResponse
    {
        $request->request->add(['user_id' => auth()->user()->id]);
        $rules = [
            'area_id' => 'required',
            'user_id' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'zoom' => 'required'
        ];

        if($request->code != $city->code){
            $rules['code'] = 'required|unique:cities';
        }
        if($request->city != $city->city){
            $rules['city'] = 'required|unique:cities';
        }

        $validateData = $request->validate($rules);

        City::where('id', $city->id)
                ->update($validateData);

        return redirect('/media/cities')->with('success','Data kota dengan nama '.$city->city.' berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            City::destroy($city->id);

            return redirect('/media/cities')->with('success','Kota '. $city->city .' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
