<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use App\Models\MonitoringPhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Gate;

class MonitoringPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }
    public function createPhotos(String $monitoringId): View
    { 
        if((Gate::allows('isAdmin') && Gate::allows('isMonitoring') && Gate::allows('isWorkshopCreate')) || (Gate::allows('isWorkshop') && Gate::allows('isMonitoring') && Gate::allows('isWorkshopCreate'))){
            $monitoring = Monitoring::where('id', $monitoringId)->firstOrFail();
            return view ('monitoring-photos.create', [
                'monitoring_id' => $monitoringId,
                'title' => 'Menambahkan Foto Pemantauan'
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMonitoring') && Gate::allows('isWorkshopCreate')) || (Gate::allows('isWorkshop') && Gate::allows('isMonitoring') && Gate::allows('isWorkshopCreate'))){
            $request->validate([
                'photos.*'=> 'image|file|mimes:jpeg,png,jpg|max:1024',
                'photos'=> 'required'
            ]);

            if($request->file('photos')){
                $images = $request->file('photos');
                foreach($images as $image){
                    $photos = [];
                    $photos = [
                        'monitoring_id' => $request->monitoring_id,
                        'user_id' => $request->user_id,
                        'photo' => $image->store('monitoring-images')
                    ];
                    MonitoringPhoto::create($photos);
                }
            }

            return redirect('/workshop/monitorings/'.$request->monitoring_id.'/edit')->with('success','Foto monitoring berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MonitoringPhoto $monitoringPhoto): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MonitoringPhoto $monitoringPhoto): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMonitoring') && Gate::allows('isWorkshopEdit')) || (Gate::allows('isWorkshop') && Gate::allows('isMonitoring') && Gate::allows('isWorkshopEdit'))){
            return response()-> view ('monitoring-photos.edit', [
                'monitoring_photo' => $monitoringPhoto,
                'title' => 'Mengganti Foto Pemantauan'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MonitoringPhoto $monitoringPhoto): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMonitoring') && Gate::allows('isWorkshopEdit')) || (Gate::allows('isWorkshop') && Gate::allows('isMonitoring') && Gate::allows('isWorkshopEdit'))){
            $request->validate([
                'photo' => 'required|image|file|mimes:jpeg,png,jpg|max:1024'
            ]);
            Storage::delete($request->oldPhoto);
            $validateData['user_id'] = auth()->user()->id;
            $validateData['photo'] = $request->file('photo')->store('monitoring-images');

            MonitoringPhoto::where('id', $monitoringPhoto->id)->update($validateData);
            return redirect('/workshop/monitorings/'. $monitoringPhoto->monitoring_id.'/edit')->with('success', 'Foto pemantauan berhasil diganti');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MonitoringPhoto $monitoringPhoto): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMonitoring') && Gate::allows('isWorkshopDelete')) || (Gate::allows('isWorkshop') && Gate::allows('isMonitoring') && Gate::allows('isWorkshopDelete'))){
            $monitoringPhotos = MonitoringPhoto::where('monitoring_id', $monitoringPhoto->monitoring_id)->get();
            if(count($monitoringPhotos) > 1){
                Storage::delete($monitoringPhoto->photo);
                MonitoringPhoto::destroy($monitoringPhoto->id);
                return redirect('/workshop/monitorings/'. $monitoringPhoto->monitoring_id.'/edit')->with('success', 'Foto Pemantauan berhasil dihapus');
            }else{
                return back()->withErrors(['delete' => ['Gagal untuk menghapus foto, minimal harus terdapat 1 foto']]);
            }
        } else {
            abort(403);
        }
    }
}
