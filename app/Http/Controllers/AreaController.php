<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Gate;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        if(Gate::allows('isArea') && Gate::allows('isMediaRead')){
            return response()-> view ('areas.index', [
                'areas'=>Area::filter(request('search'))->sortable()->with(['user'])->paginate(10)->withQueryString(),
                'title' => 'Daftar Area'
            ]);
        } else {
            abort(403);
        }
    }

    public function showArea(){
        $dataArea = Area::All();

        return response()->json(['dataArea'=> $dataArea]);
    }

    public function showMaps(String $id){
        if(Gate::allows('isArea') && Gate::allows('isMediaRead')){
            $area = Area::where('id', $id)->firstOrFail();
            return response()-> view ('areas.show-maps', [
                'area' => $area,
                'title' => 'Peta Area ' . $area->area
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isArea') && Gate::allows('isMediaCreate')) || (Gate::allows('isMedia') && Gate::allows('isArea') && Gate::allows('isMediaCreate'))){
            return response()-> view ('areas.create', [
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
        if((Gate::allows('isAdmin') && Gate::allows('isArea') && Gate::allows('isMediaCreate')) || (Gate::allows('isMedia') && Gate::allows('isArea') && Gate::allows('isMediaCreate'))){
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
        if(Gate::allows('isArea') && Gate::allows('isMediaRead')){
            return response()-> view ('areas.show', [
                'area' => $area,
                'title' => 'Data Area ' . $area->area
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isArea') && Gate::allows('isMediaEdit')) || (Gate::allows('isMedia') && Gate::allows('isArea') && Gate::allows('isMediaEdit'))){
            return response()->view('areas.edit', [
                'area' => $area,
                'title' => 'Merubah Data Area'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Area $area): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isArea') && Gate::allows('isMediaEdit')) || (Gate::allows('isMedia') && Gate::allows('isArea') && Gate::allows('isMediaEdit'))){
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
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isArea') && Gate::allows('isMediaDelete')) || (Gate::allows('isMedia') && Gate::allows('isArea') && Gate::allows('isMediaDelete'))){
            if($area->locations()->exists() || $area->cities()->exists()){
                return back()->withErrors(['delete' => ['Gagal untuk menghapus data area, terdapat relasi dengan data pada tabel data lainnya']]);
            }else{
                Area::destroy($area->id);
    
                return redirect('/media/area')->with('success','Area dengan nama '. $area->area .' berhasil dihapus');
            }
        } else {
            abort(403);
        }
    }
}
