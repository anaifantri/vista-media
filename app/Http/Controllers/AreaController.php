<?php

namespace App\Http\Controllers;

use App\Models\Area;
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
        return response()-> view ('dashboard.media.area.index',[
            'areas'=>Area::all(),
            'title' => 'Area'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()-> view ('dashboard.media.area.create', [
            'title' => 'Menambahkan Area'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
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
        $validateData['username'] = auth()->user()->name;
        Area::create($validateData);

        // $area_code = $request->input('area_code');
        // $provinsi = $request->input('provinsi');
        $area = $request->input('area');
        // $lat = $request->input('lat');
        // $lng = $request->input('lng');
        // $zoom = $request->input('zoom');
        // $username = $request->input('username');
        return redirect('/dashboard/media/area')->with('success','Area baru '. $area . ' berhasil ditambahkan');
        // return request()->all();
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area): Response
    {
        return response()-> view ('dashboard.media.area.show', [
            'area' => $area,
            'title' => 'Area ' . $area->area
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area): Response
    {
        // return response()-> view ('dashboard.media.area.edit', [
        //     'area' => $area,
        //     'title' => 'Edit Area ' . $area->area
        // ]);
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
        Area::destroy($area->id);

        return redirect('/dashboard/media/area')->with('success','Area '. $area->area .' berhasil dihapus');
    }
}
