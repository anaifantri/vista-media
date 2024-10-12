<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use App\Models\MediaCategory;
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
        return response()-> view ('areas.index', [
            'areas'=>Area::filter(request('search'))->sortable()->with(['user'])->paginate(10)->withQueryString(),
            'title' => 'Daftar Area',
            'categories' => MediaCategory::all()
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
            return response()-> view ('areas.create', [
                'title' => 'Menambahkan Area',
                'categories' => MediaCategory::all()
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
            if ($request->lat == ""){
                return back()->withErrors(['lat' => ['Silahkan memberikan tanda pada peta untuk menentukan lokasi area']])->withInput();
            }

            $request->request->add(['user_id' => auth()->user()->id]);
            $validateData = $request->validate([
                'user_id' => 'required',
                'area_code' => 'required|unique:areas',
                'area' => 'required|unique:areas',
                'lat' => 'required',
                'lng' => 'required',
                'zoom' => 'required'
            ]);

            Area::create($validateData);
    
            return redirect('/media/area')->with('success','Area dengan nama '. $request->area . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area): Response
    {
        return response()-> view ('areas.show', [
            'area' => $area,
            'title' => 'Data Area ' . $area->area,
            'categories' => MediaCategory::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area): Response
    {
        return response()->view('areas.edit', [
            'area' => $area,
            'title' => 'Merubah Data Area',
            'categories' => MediaCategory::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Area $area): RedirectResponse
    {
        $request->request->add(['user_id' => auth()->user()->id]);
        $rules = [
            'user_id' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'zoom' => 'required'
        ];

        if($request->area_code != $area->area_code){
            $rules['area_code'] = 'required|unique:areas';
        }
        if($request->area != $area->area){
            $rules['area'] = 'required|unique:areas';
        }

        $validateData = $request->validate($rules);

        Area::where('id', $area->id)
                ->update($validateData);

        return redirect('/media/area')->with('success','Data area dengan nama '.$area->area.' berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            
            Area::destroy($area->id);

            return redirect('/media/area')->with('success','Area dengan nama '. $area->area .' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
