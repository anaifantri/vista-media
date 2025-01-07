<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use App\Models\MonitoringPhoto;
use App\Models\Location;
use App\Models\Sale;
use App\Models\LocationPhoto;
use App\Models\MediaCategory;
use App\Models\Company;
use App\Models\Area;
use App\Models\City;
use App\Models\MediaSize;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Gate;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        if(Gate::allows('isMonitoring') && Gate::allows('isWorkshopRead')){
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $sales = Sale::with('location')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $monitorings = Monitoring::with('location')->get();
            return response()-> view ('monitorings.index', [
                'locations'=>Location::filter(request('search'))->area()->city()->condition()->category()->sortable()->paginate(30)->withQueryString(),
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'title' => 'Daftar Data Pembayaran Tagihan Listrik',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'monitorings', 'sales')
            ]);
        } else {
            abort(403);
        }
    }

    public function showMonitoring(String $locationId): View
    { 
        if(Gate::allows('isMonitoring') && Gate::allows('isWorkshopRead')){
            $dataMonitorings = Monitoring::where('location_id', $locationId)->get();
            $location = Location::where('id', $locationId)->firstOrFail();
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            return view ('monitorings.show-monitorings', [
                'monitorings' => $dataMonitorings,
                'location' => $location,
                'title' => 'Detail Data Pemantauan Bulanan',
                compact('areas', 'cities', 'media_categories', 'media_sizes')
            ]);
        } else {
            abort(403);
        }
    }

    public function createMonitoring(String $locationId): View
    { 
        if((Gate::allows('isAdmin') && Gate::allows('isMonitoring') && Gate::allows('isWorkshopCreate')) || (Gate::allows('isWorkshop') && Gate::allows('isMonitoring') && Gate::allows('isWorkshopCreate'))){
            $location = Location::findOrFail($locationId);
            return view ('monitorings.create', [
                'location_id' => $locationId,
                'location' => $location,
                'location_photo'=>LocationPhoto::where('location_id', $locationId)->where('company_id', $location->company_id)->where('set_default', true)->get()->last(),
                'title' => 'Upload Foto Monitoring'
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
            $validateData = $request->validate([
                'location_id' => 'required',
                'user_id' => 'required',
                'month' => 'required|unique:monitorings',
                'monitoring_date' => 'required',
                'notes' => 'required',
                'photos' => 'required'
            ]);
            $request->validate([
                'photos.*'=> 'image|file|mimes:jpeg,png,jpg|max:1024'
            ]);
            $validateData['month'] = $request->month.'-01';

            Monitoring::create($validateData);

            $dataMonitoring = Monitoring::where('month', $validateData['month'])->firstOrFail();

            if($request->file('photos')){
                $images = $request->file('photos');
                foreach($images as $image){
                    $photos = [];
                    $photos = [
                        'monitoring_id' => $dataMonitoring->id,
                        'user_id' => $request->user_id,
                        'photo' => $image->store('monitoring-images')
                    ];
                    MonitoringPhoto::create($photos);
                }
            }

            return redirect('/workshop/monitorings')->with('success','Foto monitoring berhasil di upload');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Monitoring $monitoring): Response
    {
        if(Gate::allows('isMonitoring') && Gate::allows('isWorkshopRead')){
            $location = Location::findOrFail($monitoring->location_id);
            $cities = City::with('locations')->get();
            $areas = Area::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            return response()-> view ('monitorings.show', [
                'monitoring' => $monitoring,
                'location' => $location,
                'location_photo'=>LocationPhoto::where('location_id', $location->id)->where('company_id', $location->company_id)->where('set_default', true)->get()->last(),
                'photos'=>MonitoringPhoto::where('monitoring_id', $monitoring->id)->get(),
                'title' => 'Detail Foto Pemantauan',
                compact('location', 'cities', 'areas', 'media_sizes', 'media_categories')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Monitoring $monitoring): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMonitoring') && Gate::allows('isWorkshopEdit')) || (Gate::allows('isWorkshop') && Gate::allows('isMonitoring') && Gate::allows('isWorkshopEdit'))){
            $location = Location::findOrFail($monitoring->location_id);
            return response()-> view ('monitorings.edit', [
                'monitoring' => $monitoring,
                'location' => $location,
                'location_photo'=>LocationPhoto::where('location_id', $location->id)->where('company_id', $location->company_id)->where('set_default', true)->get()->last(),
                'photos'=>MonitoringPhoto::where('monitoring_id', $monitoring->id)->get(),
                'title' => 'Edit Data Pembayaran Listrik'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Monitoring $monitoring): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMonitoring') && Gate::allows('isWorkshopEdit')) || (Gate::allows('isWorkshop') && Gate::allows('isMonitoring') && Gate::allows('isWorkshopEdit'))){
            $rules = [
                'user_id' => 'required',
                'month' => 'required',
                'monitoring_date' => 'required',
                'notes' => 'required',
            ];

            $validateData = $request->validate($rules);

            $validateData['month'] = $request->month.'-01';

            Monitoring::where('id', $monitoring->id)->update($validateData);

            return redirect('/show-monitoring/'.$monitoring->location_id)->with('success','Data foto pemantauan dirubah');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Monitoring $monitoring): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMonitoring') && Gate::allows('isWorkshopDelete')) || (Gate::allows('isWorkshop') && Gate::allows('isMonitoring') && Gate::allows('isWorkshopDelete'))){
            $monitoringPhotos = MonitoringPhoto::where('monitoring_id', $monitoring->id)->get();

            foreach($monitoringPhotos as $photo){
                Storage::delete($photo->photo);
                MonitoringPhoto::destroy($photo->id);
            }
            
            Monitoring::destroy($monitoring->id);
            return redirect('/show-monitoring/'.$monitoring->location_id)->with('success', 'Data foto pemantauan berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
