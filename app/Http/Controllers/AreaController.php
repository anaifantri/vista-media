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
        // $areas = Area::with('user')->with('cities')->get();
        // $users = User::with('areas')->get();
        return response()-> view ('dashboard.media.areas.index', [
            'areas'=>Area::sortable()->with(['user'])->paginate(10),
            'title' => 'Daftar Area'
            // compact('areas', 'users')
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
        return response()-> view ('dashboard.media.areas.create', [
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
        $validateData['user_id'] = auth()->user()->id;
        Area::create($validateData);

        // $area_code = $request->input('area_code');
        // $provinsi = $request->input('provinsi');
        $area = $request->input('area');
        // $lat = $request->input('lat');
        // $lng = $request->input('lng');
        // $zoom = $request->input('zoom');
        // $username = $request->input('username');
        return redirect('/dashboard/media/area')->with('success','Area '. $area . ' berhasil ditambahkan');
        // return request()->all();
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
        // dd($area->id);
        Area::destroy($area->id);

        return redirect('/dashboard/media/area')->with('success','Area '. $area->area .' berhasil dihapus');
    }
}
