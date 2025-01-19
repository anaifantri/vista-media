<?php

namespace App\Http\Controllers;

use App\Models\LocationPhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class LocationPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
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
    if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
        if($request->file('add_photo')){
            if($request->add_default == "Yes"){
                $set_default = true;
                $validateData['set_default'] = false;
                $setDefaultUpdate = LocationPhoto::where('location_id', $request->location_id)->where('company_id', $request->company_id)->update($validateData);
            } else {
                $set_default = false;
            }
        } else{
            return back()->withErrors(['add_photo' => ['Silahkan pilih file photo yang ingin ditambahkan']])->withInput();
        }

        $request->request->add(['user_id' => auth()->user()->id, 'set_default' => $set_default]);
        
        $validateData = $request->validate([
            'company_id' => 'required',
            'user_id' => 'required',
            'set_default' => 'required',
            'media_category_id' => 'required',
            'location_id' => 'required',
            'location_code' => 'required',
            'add_photo' => 'required|image|file|max:1024'
        ]);
        $validateData['photo'] = $request->file('add_photo')->store('location-images');

        LocationPhoto::create($validateData);

        return redirect('/media/locations/'.$request->location_id.'/edit')->with('success','Foto Lokasi berhasil ditambahkan');
    } else {
        abort(403);
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(LocationPhoto $locationPhoto): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LocationPhoto $locationPhoto): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LocationPhoto $locationPhoto): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            if($request->setDefault){
                $validateData['set_default'] = false;
                LocationPhoto::where('location_id', $locationPhoto->location_id)->where('company_id', $request->company_id)->update($validateData);
                
                $validateData['set_default'] = true;

                LocationPhoto::where('id', $locationPhoto->id)->update($validateData);

                return redirect('/media/locations/'.$locationPhoto->location_id.'/edit')->with('success','Foto telah dirubah menjadi aktif');
            } else {
                if($request->file('update_photo')){
                    if($request->update_default == "Yes"){
                        $set_default = true;
                        $validateData['set_default'] = false;
                        LocationPhoto::where('location_id', $locationPhoto->location_id)->where('company_id', $request->company_id)->update($validateData);
                    } else{
                        if($locationPhoto->set_default == true){
                            $set_default = true;
                        } else{
                            $set_default = false;
                        }
                    }
                } else{
                    return back()->withErrors(['add_photo' => ['Silahkan pilih file photo pengganti']])->withInput();
                }
    
                $request->request->add(['user_id' => auth()->user()->id, 'set_default' => $set_default, 'photo' => $request->update_photo]);
                
                $validateData = $request->validate([
                    'user_id' => 'required',
                    'set_default' => 'required',
                    'photo' => 'required|image|file|max:1024'
                ]);
    
                Storage::delete($request->old_photo);
    
                $validateData['photo'] = $request->file('update_photo')->store('location-images');

                LocationPhoto::where('id', $locationPhoto->id)->update($validateData);

                return redirect('/media/locations/'.$locationPhoto->location_id.'/edit')->with('success','Foto Lokasi berhasil diganti');
            }
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LocationPhoto $locationPhoto): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            Storage::delete($locationPhoto->photo);
            LocationPhoto::destroy($locationPhoto->id);
            return redirect('/media/locations/'.$locationPhoto->location_id.'/edit')->with('success','Foto Lokasi berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
