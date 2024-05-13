<?php

namespace App\Http\Controllers;

use App\Models\Signage;
use App\Models\Area;
use App\Models\City;
use App\Models\Size;
use App\Models\Led;
use App\Models\SignageCategory;
use App\Models\SignagePhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SignageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()-> view ('dashboard.media.signages.index', [
            'signages'=>Signage::filter(request('search'))->area()->city()->condition()->sortable()->paginate(10)->withQueryString(),
            'areas'=>Area::all(),
            'title' => 'Daftar Signage'
        ]);
    }

    public function preview(string $id): View
    {
        $signages = Signage::with('area');
        $areas = Area::with('signages')->get();
        $cities = City::with('signages')->get();
        $sizes = Size::with('signages')->get();
        $leds = Led::with('signages')->get();

        return view('dashboard.media.signages.preview', [
            'signage' => Signage::findOrFail($id),
            'title' => 'Detail Signage',
            'signage_photos'=>SignagePhoto::all(),
            compact('signages', 'areas', 'cities', 'sizes', 'leds')
        ]);
    }

    public function pdfPreview(string $id): View
    {
        
        $signages = Signage::with('area');
        $areas = Area::with('signages')->get();
        $cities = City::with('signages')->get();
        $sizes = Size::with('signages')->get();
        $leds = Led::with('signages')->get();

        return view('dashboard.media.signages.pdf-preview', [
            'signage' => Signage::findOrFail($id),
            'title' => 'Detail Signage',
            'signage_photos'=>SignagePhoto::all(),
            compact('signages', 'areas', 'cities', 'sizes', 'leds')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            return response()-> view ('dashboard.media.signages.create', [
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'sizes'=>Size::orderBy("size", "asc")->get(),
                'leds'=>Led::orderBy("pixel_pitch", "asc")->get(),
                'signage_categories'=>SignageCategory::all(),
                'title' => 'Menambahkan Signage'
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
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            if ($request->area_id == 'pilih'){
                return back()->withErrors(['area_id' => ['Silahkan pilih area']])->withInput();
            }
            if ($request->city_id == 'pilih'){
                return back()->withErrors(['city_id' => ['Silahkan pilih kota']])->withInput();
            }

            $objLocations = json_decode($request->locations);
            $locationQty = count($objLocations->signageLocations);
            // dd($locationQty);

            if ($locationQty != $request->qty){
                return back()->withErrors(['locations' => ['Silahkan tentukan marker koordinat pada peta sesuai jumlah signage']])->withInput();
            }

            if ($request->signageCategory == 'Videotron'){
                if ($request->led_id == 'pilih'){
                    return back()->withErrors(['led_id' => ['Silahkan pilih jenis LED']])->withInput();
                }
            }
            if ($request->size_id == 'pilih'){
                return back()->withErrors(['size_id' => ['Silahkan pilih ukuran']])->withInput();
            }

            if ($request->condition == 'pilih'){
                return back()->withErrors(['condition' => ['Silahkan pilih kondisi']])->withInput();
            }

            if ($request->orientation == 'pilih'){
                return back()->withErrors(['orientation' => ['Silahkan pilih orientasi']])->withInput();
            }

            if ($request->side == 'pilih'){
                return back()->withErrors(['side' => ['Silahkan pilih jumlah sisi']])->withInput();
            }
    
            if ($request->road_segment == 'pilih'){
                return back()->withErrors(['road_segment' => ['Silahkan pilih type jalan']])->withInput();
            }
            if ($request->max_distance== 'pilih'){
                return back()->withErrors(['max_distance' => ['Silahkan pilih jarak pandang']])->withInput();
            }
            if ($request->speed_average == 'pilih'){
                return back()->withErrors(['speed_average' => ['Silahkan pilih kecepatan kendaraan']])->withInput();
            }
            if ($request->sector == ''){
                return back()->withErrors(['sector' => ['Silahkan pilih minimal 1 kawasan']])->withInput();
            }
            $validateData = $request->validate([
                'code' => 'required|unique:signages',
                'area_id' => 'required',
                'city_id' => 'required',
                'size_id' => 'required',
                'signage_category_id' => 'required',
                'address' => 'required|max:255',
                'qty' => 'required',
                'locations' => 'required',
                'condition' => 'required',
                'orientation' => 'required',
                'side' => 'required',
                'road_segment' => 'required',
                'max_distance' => 'required',
                'speed_average' => 'required',
                'sector' => 'required|max:255',
                'photo' => 'required|image|file|max:1024',
                'price' => 'required'
            ]);

            if ($request->input('signageCategory') == 'Videotron'){
                $validateData['led_id'] = $request->input('led_id');
                $validateData['slots'] = $request->input('slots');
                $validateData['duration'] = $request->input('duration');
                $validateData['start_at'] = $request->input('start_at');
                $validateData['end_at'] = $request->input('end_at');
            } else {
                $validateData['led_id'] = null;
                $validateData['duration'] = null;
                $validateData['start_at'] = null;
                $validateData['end_at'] = null;
                $validateData['slots'] = null;
            }
            
            $validateData['user_id'] = auth()->user()->id;
    
            Signage::create($validateData);

            $dataSignages = Signage::all();
            $signageId = 0;
            foreach ($dataSignages as $signage) {
                if($signage->code == $validateData['code']){
                    $signageId = $signage->id;
                }
            }

            if($request->file('photo')){
                $validateData['photo'] = $request->file('photo')->store('signage-images');
            }

            $validateData['company_id'] = '1';
            $validateData['signage_code'] = $validateData['code'];
            $validateData['signage_id'] =  $signageId;

            SignagePhoto::create($validateData);
            
            return redirect('/dashboard/media/signages/pdf-preview/'.$signageId)->with('success','Signage dengan kode '. $validateData['code'] . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Signage $signage): Response
    {
        $signages = Signage::with('area');
        $areas = Area::with('signages')->get();
        $cities = City::with('signages')->get();
        $sizes = Size::with('signages')->get();
        $leds = Led::with('signages')->get();

        return response()->view('dashboard.media.signages.show', [
            'signage' => $signage,
            'title' => 'Detail Signage',
            'signage_photos'=>SignagePhoto::all(),
            compact('signages', 'areas', 'cities', 'sizes', 'leds')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Signage $signage): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            $signages = Signage::with('area');
            $areas = Area::with('signages')->get();
            $cities = City::with('signages')->get();
            $sizes = Size::with('signages')->get();
            $leds = Led::with('signages')->get();
            
            return response()->view('dashboard.media.signages.edit', [
                'signage' => $signage,
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'signage_categories'=>SignageCategory::all(),
                'signage_photos'=>SignagePhoto::all(),
                'sizes'=>Size::orderBy("size", "asc")->get(),
                'leds'=>Led::orderBy("pixel_pitch", "asc")->get(),
                'title' => 'Edit Detail signage',
                compact('signages', 'areas', 'cities', 'sizes', 'leds')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Signage $signage): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            if ($request->sector == ''){
                return back()->withErrors(['sector' => ['Silahkan pilih minimal 1 kawasan']])->withInput();
            }

            $rules = [
                'area_id' => 'required',
                'city_id' => 'required',
                'size_id' => 'required',
                'signage_category_id' => 'required',
                'address' => 'required|max:255',
                'qty' => 'required',
                'locations' => 'required',
                'condition' => 'required',
                'orientation' => 'required',
                'side' => 'required',
                'road_segment' => 'required',
                'max_distance' => 'required',
                'speed_average' => 'required',
                'sector' => 'required|max:255',
                'price' => 'required'
            ];
            if ($request->code == $signage->code) {
                $validateData['code'] = $request->input('code');
            } else {
                $rules['code'] = 'required|unique:signages';
            }

            if ($request->input('signageCategory') == 'Videotron'){
                $validateData['led_id'] = $request->input('led_id');
                $validateData['slots'] = $request->input('slots');
                $validateData['duration'] = $request->input('duration');
                $validateData['start_at'] = $request->input('start_at');
                $validateData['end_at'] = $request->input('end_at');
            } else {
                $validateData['led_id'] = null;
                $validateData['duration'] = null;
                $validateData['start_at'] = null;
                $validateData['end_at'] = null;
                $validateData['slots'] = null;
            }
            
            $validateData['user_id'] = auth()->user()->id;

            $validateData = $request->validate($rules);

            Signage::where('id', $signage->id)
                    ->update($validateData);
            
            $rules = [
                'photo' => 'image|file|max:1024'
            ];

            $validateData = $request->validate($rules);
            
            $dataSignages = Signage::all();
            $signageId = 0;
            foreach ($dataSignages as $signage) {
                if($signage->code == $request->input('code')){
                    $signageId = $signage->id;
                }
            }

            if($request->file('photo')){
                if($request->oldPhoto){
                    Storage::delete($request->oldPhoto);
                }
                $validateData['photo'] = $request->file('photo')->store('signage-images');
            }

            $dataPhotos = SignagePhoto::all();
            $photoId = '';
            foreach ($dataPhotos as $photo) {
                if($photo->signage_code == $request->input('code')){
                    $photoId = $photo->id;
                }
            }

            $validateData['company_id'] = '1';
            $validateData['signage_code'] = $request->input('code');
            $validateData['signage_id'] =  $signageId;

            SignagePhoto::where('id', $photoId)
                    ->update($validateData);
            
            return redirect('/dashboard/media/signages/pdf-preview/'.$signageId)->with('success','Lokasi signage dengan kode '. $request->input('code') . ' berhasil di update');

        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Signage $signage): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            if($signage->photo){
                Storage::delete($signage->photo);
            }
    
            Signage::destroy($signage->id);
    
            return redirect('/dashboard/media/signages')->with('success','Signage dengan kode ' . $signage->code . ' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
