<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()-> view ('dashboard.media.areas.index', [
            'areas'=>Area::filter(request('search'))->sortable()->with(['user'])->paginate(10)->withQueryString(),
            'title' => 'Daftar Area'
        ]);
    }

    public function showArea(){
        $dataArea = Area::All();

        return response()->json(['dataArea'=> $dataArea]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()-> view ('dashboard.media.areas.create', [
                'title' => 'Menambahkan Area'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            $validateData = $request->validate([
                'area_code' => 'required',
                'provinsi' => 'required|max:255',
                'area' => 'required|unique:areas',
                'lat' => 'required',
                'lng' => 'required',
                'zoom' => 'required'
            ]);
    
            $validateData['area_code'] = $request->input('area_code');
            $validateData['area'] = $request->input('area');
            $validateData['lat'] = $request->input('lat');
            $validateData['lng'] = $request->input('lng');
            $validateData['zoom'] = $request->input('zoom');
            $validateData['user_id'] = auth()->user()->id;
            Area::create($validateData);
    
            $area = $request->input('area');
            return redirect('/dashboard/media/area')->with('success','Area '. $area . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area): Response
    {
        return response()-> view ('dashboard.media.areas.show', [
            'area' => $area,
            'title' => 'Area ' . $area->area
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Area $area): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            Area::destroy($area->id);

            return redirect('/dashboard/media/area')->with('success','Area '. $area->area .' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
