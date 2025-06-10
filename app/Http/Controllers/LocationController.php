<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\LocationPhoto;
use App\Models\MediaCategory;
use App\Models\Area;
use App\Models\City;
use App\Models\Led;
use App\Models\Sale;
use App\Models\MediaSize;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use \stdClass;
use Gate;
use Illuminate\Support\Facades\Crypt;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    public function getLocations(String $id, String $scope)
    {
        if($scope == "area"){
            $locations = Location::where('area_id', '=', $id)
            ->whereHas('media_category', function($query){
                $query->where('name', '!=', "Service");
            })->get();
        }elseif($scope == "city"){
            $locations = Location::where('city_id', '=', $id)
            ->whereHas('media_category', function($query){
                $query->where('name', '!=', "Service");
            })->get();
        }

        return response()->json(['locations'=> $locations]);
    }

    public function home(String $category, Request $request): View
    {
        if(Gate::allows('isLocation') && Gate::allows('isMediaRead')){
            if($category == "All"){
                $dataCategory = MediaCategory::where('id', $request->media_category_id)->get()->last();
                $dataLocations = Location::filter(request('search'))->area()->city()->condition()->category()->sortable()->orderBy("code", "asc")->paginate(35)->withQueryString();
            }else{
                $dataCategory = MediaCategory::where('name', $category)->get()->last();
                $media_category_id = $dataCategory->id;
                $dataLocations = Location::where('media_category_id', $media_category_id)->filter(request('search'))->area()->city()->condition()->sortable()->orderBy("code", "asc")->paginate(35)->withQueryString();
            }
    
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $sales = Sale::with('location')->get();
            return view ('locations.index', [
                'locations'=>$dataLocations,
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'category'=>$category,
                'data_categories'=>$dataCategory,
                'title' => 'Daftar Lokasi Media',
                compact('areas', 'cities', 'media_sizes', 'media_categories', 'sales')
            ]);
        } else {
            abort(403);
        }
    }

    public function guestPreview(String $category, String $id): View
    { 
        $location = Location::findOrFail(Crypt::decrypt($id));
        $areas = Area::with('locations')->get();
        $cities = City::with('locations')->get();
        $media_sizes = MediaSize::with('locations')->get();
        $media_categories = MediaCategory::with('locations')->get();

        return view('locations.preview', [
            'location' => $location,
            'leds' => Led::all(),
            'title' => 'Detail Location',
            'data_photos'=>LocationPhoto::where('location_id', $location->id)->where('set_default', true)->get(),
            'category'=>$category,
            compact('areas', 'cities', 'media_sizes', 'media_categories')
        ]);
    }

    public function preview(String $category, String $id): View
    { 
        if(Gate::allows('isLocation') && Gate::allows('isMediaRead')){
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
    
            return view('locations.preview', [
                'location' => Location::findOrFail($id),
                'leds' => Led::all(),
                'title' => 'Detail Location',
                'data_photos'=>LocationPhoto::where('location_id', $id)->where('set_default', true)->get(),
                'category'=>$category,
                compact('areas', 'cities', 'media_sizes', 'media_categories')
            ]);
        } else {
            abort(403);
        }
    }

    public function createLocation(String $category): View
    {
        if((Gate::allows('isAdmin') && Gate::allows('isLocation') && Gate::allows('isMediaCreate')) || (Gate::allows('isLocation') && Gate::allows('isMediaCreate'))){
            $dataCategory = MediaCategory::where('name', $category)->firstOrFail();
            return view ('locations.create', [
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'leds'=>Led::all(),
                'media_sizes'=>MediaSize::orderBy("size", "asc")->get(),
                'title' => 'Menambahkan Data Lokasi',
                'data_category' => $dataCategory,
                'category' => $category
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
        if((Gate::allows('isAdmin') && Gate::allows('isLocation') && Gate::allows('isMediaCreate')) || (Gate::allows('isLocation') && Gate::allows('isMediaCreate'))){
            if ($request->area_id == 'pilih'){
                return back()->withErrors(['area_id' => ['Silahkan pilih area']])->withInput();
            }
            if ($request->city_id == 'pilih'){
                return back()->withErrors(['city_id' => ['Silahkan pilih kota']])->withInput();
            }
            if ($request->lighting == 'pilih'){
                return back()->withErrors(['lighting' => ['Silahkan pilih Penerangan']])->withInput();
            }
            if ($request->media_size_id == 'pilih'){
                return back()->withErrors(['media_size_id' => ['Silahkan pilih ukuran']])->withInput();
            }
            if ($request->side == 'pilih'){
                return back()->withErrors(['side' => ['Silahkan pilih jumlah sisi']])->withInput();
            }
            if ($request->orientation == 'pilih'){
                return back()->withErrors(['orientation' => ['Silahkan pilih orientasi']])->withInput();
            }
            if ($request->condition == 'pilih'){
                return back()->withErrors(['condition' => ['Silahkan pilih kondisi']])->withInput();
            }
            if ($request->led_id == 'pilih' && $request->category == "Videotron"){
                return back()->withErrors(['led_id' => ['Silahkan pilih type LED']])->withInput();
            }
            if ($request->signage_type == 'pilih'){
                return back()->withErrors(['signage_type' => ['Silahkan pilih type signage']])->withInput();
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
            if($request->category == "Billboard" || $request->category == "Bando" || $request->category == "Baliho" || $request->category == "Midiboard"){
                $description = new stdClass();
                $description->lighting = $request->lighting;
                $description->lat = json_decode($request->lat);
                $description->lng = json_decode($request->lng);
            }
            if($request->category == "Videotron"){
                $description = new stdClass();
                $description->led_id = $request->led_id;
                $description->lat = json_decode($request->lat);
                $description->lng = json_decode($request->lng);
                $description->slots = $request->slots;
                $description->duration = $request->duration;
                $description->screen_w = $request->screen_w;
                $description->screen_h = $request->screen_h;
                $description->start_at = $request->start_at;
                $description->end_at = $request->end_at;
            }
            if($request->category == "Signage"){
                if ($request->signage_type == "Videotron"){
                    if ($request->led_id == 'pilih'){
                    return back()->withErrors(['led_id' => ['Silahkan pilih type LED']])->withInput();
                    }else{
                        $description = new stdClass();
                        $description->type = $request->signage_type;
                        $description->led_id = $request->led_id;
                        $description->qty = $request->qty;
                        $description->lat = json_decode($request->lat);
                        $description->lng = json_decode($request->lng);
                        $description->slots = $request->slots;
                        $description->duration = $request->duration;
                        $description->screen_w = $request->screen_w;
                        $description->screen_h = $request->screen_h;
                        $description->start_at = $request->start_at;
                        $description->end_at = $request->end_at;
                    }
                } else {
                    $description = new stdClass();
                    $description->type = $request->signage_type;
                    $description->lighting = $request->lighting;
                    $description->qty = $request->qty;
                    $description->lat = json_decode($request->lat);
                    $description->lng = json_decode($request->lng);
                }
            }
            $dataDescription = json_encode($description);

            if($request->category == "Signage"){
                if(count($description->lat) == 0 || $description->lat == null){
                    return back()->withErrors(['lat' => ['Silahkan tentukan lokasi pada Google Maps']])->withInput();
                } if(count($description->lat) != (int)$description->qty){
                    return back()->withErrors(['lat' => ['Jumlah penanda lokasi signage pada Google Maps tidak sesuai dengan jumlah signage']])->withInput();
                }
            } else {
                if($description->lat == "" || $description->lat == null){
                    return back()->withErrors(['lat' => ['Silahkan tentukan lokasi pada Google Maps']])->withInput();
                }
            }

            $request->request->add(['description' => $dataDescription]);
            $validateData = $request->validate([
                'code' => 'required|unique:locations',
                'area_id' => 'required',
                'city_id' => 'required',
                'company_id' => 'required',
                'address' => 'required',
                'media_category_id' => 'required',
                'media_size_id' => 'required',
                'side' => 'required',
                'orientation' => 'required',
                'description' => 'required',
                'condition' => 'required',
                'road_segment' => 'required',
                'max_distance' => 'required',
                'speed_average' => 'required',
                'created_by' => 'required',
                'modified_by' => 'required',
                'sector' => 'required',
                'price' => 'nullable',
                'photo' => 'required|image|file|max:1024'
            ]);

            Location::create($validateData);

            $dataLocation = Location::where('code', $validateData['code'])->firstOrFail();

            if($request->file('photo')){
                $validateData['photo'] = $request->file('photo')->store('location-images');
            }

            $validateData['user_id'] = auth()->user()->id;
            $validateData['location_code'] = $request->input('code');
            $validateData['set_default'] = true;
            $validateData['location_id'] = $dataLocation->id;

            LocationPhoto::create($validateData);
                
            return redirect('/media/locations/preview/'.$dataLocation->media_category->name.'/'.$dataLocation->id)->with('success',$dataLocation->media_category->name. ' dengan kode '. $validateData['code'] . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location): Response
    {
        if(Gate::allows('isLocation') && Gate::allows('isMediaRead')){
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
    
            return response()->view('locations.show', [
                'location' => $location,
                'title' => 'Detail Lokasi',
                'leds'=>Led::all(),
                'category'=>$location->media_category->name,
                'data_photos'=>LocationPhoto::where('location_id', $location->id)->get(),
                compact('areas', 'cities', 'media_sizes', 'media_categories')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isLocation') && Gate::allows('isMediaEdit')) || (Gate::allows('isLocation') && Gate::allows('isMediaEdit'))){
            $areas = Area::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
    
            return response()->view('locations.edit', [
                'location' => $location,
                'title' => 'Edit Data Lokasi '. $location->media_category->name,
                'leds'=>Led::all(),
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'media_sizes'=>MediaSize::orderBy("size", "asc")->get(),
                'category'=>$location->media_category->name,
                'data_photos'=>LocationPhoto::where('location_id', $location->id)->get(),
                compact('areas', 'media_sizes', 'media_categories')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isLocation') && Gate::allows('isMediaEdit')) || (Gate::allows('isLocation') && Gate::allows('isMediaEdit'))){
            if ($request->city_id == 'pilih'){
                return back()->withErrors(['city_id' => ['Silahkan pilih kota']])->withInput();
            }
            if ($request->media_size_id == 'pilih'){
                return back()->withErrors(['media_size_id' => ['Silahkan pilih ukuran']])->withInput();
            }
            if ($request->sector == ''){
                return back()->withErrors(['sector' => ['Silahkan pilih minimal 1 kawasan']])->withInput();
            }
            if($request->category == "Billboard" || $request->category == "Bando" || $request->category == "Baliho" || $request->category == "Midiboard"){
                $description = new stdClass();
                $description->lighting = $request->lighting;
                $description->lat = json_decode($request->lat);
                $description->lng = json_decode($request->lng);
            }
            if($request->category == "Videotron"){
                if ($request->led_id == 'pilih'){
                    return back()->withErrors(['led_id' => ['Silahkan pilih jenis LED']])->withInput();
                }
                $description = new stdClass();
                $description->led_id = $request->led_id;
                $description->lat = json_decode($request->lat);
                $description->lng = json_decode($request->lng);
                $description->slots = $request->slots;
                $description->duration = $request->duration;
                $description->screen_w = $request->screen_w;
                $description->screen_h = $request->screen_h;
                $description->start_at = $request->start_at;
                $description->end_at = $request->end_at;
            }
            if($request->category == "Signage"){
                if ($request->signage_type == "Videotron"){
                    if ($request->led_id == 'pilih'){
                    return back()->withErrors(['led_id' => ['Silahkan pilih jenis LED']])->withInput();
                    }else{
                        $description = new stdClass();
                        $description->type = $request->signage_type;
                        $description->led_id = $request->led_id;
                        $description->qty = $request->qty;
                        $description->lat = json_decode($request->lat);
                        $description->lng = json_decode($request->lng);
                        $description->slots = $request->slots;
                        $description->duration = $request->duration;
                        $description->screen_w = $request->screen_w;
                        $description->screen_h = $request->screen_h;
                        $description->start_at = $request->start_at;
                        $description->end_at = $request->end_at;
                    }
                } else {
                    $description = new stdClass();
                    $description->type = $request->signage_type;
                    $description->lighting = $request->lighting;
                    $description->qty = $request->qty;
                    $description->lat = json_decode($request->lat);
                    $description->lng = json_decode($request->lng);
                }
            }
            $dataDescription = json_encode($description);

            if($request->category == "Signage"){
                if(count($description->lat) == 0 || $description->lat == null){
                    return back()->withErrors(['lat' => ['Silahkan tentukan lokasi pada Google Maps']])->withInput();
                } if(count($description->lat) != (int)$description->qty){
                    return back()->withErrors(['lat' => ['Jumlah penanda lokasi signage pada Google Maps tidak sesuai dengan jumlah signage']])->withInput();
                }
            } else {
                if($description->lat == "" || $description->lat == null){
                    return back()->withErrors(['lat' => ['Silahkan tentukan lokasi pada Google Maps']])->withInput();
                }
            }
            $request->request->add(['description' => $dataDescription]);
            $rules = [
                'area_id' => 'required',
                'city_id' => 'required',
                'company_id' => 'required',
                'address' => 'required',
                'media_category_id' => 'required',
                'media_size_id' => 'required',
                'side' => 'required',
                'orientation' => 'required',
                'description' => 'required',
                'condition' => 'required',
                'road_segment' => 'required',
                'max_distance' => 'required',
                'speed_average' => 'required',
                'modified_by' => 'required',
                'sector' => 'required',
                'price' => 'required'
            ];

            if ($request->code == $location->code) {
                $validateData['code'] = $request->input('code');
            } else {
                $rules['code'] = 'required|unique:locations';
            }

            $validateData = $request->validate($rules);

            Location::where('id', $location->id)
                    ->update($validateData);
                
            return redirect('/media/locations/preview/'.$request->category.'/'.$location->id)->with('success',$request->category. ' dengan kode '. $location->code . ' berhasil diupdate');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isLocation') && Gate::allows('isMediaDelete')) || (Gate::allows('isLocation') && Gate::allows('isMediaDelete'))){
            if($location->location_photos()->exists() || $location->sales()->exists() || $location->land_agreements()->exists() || $location->print_orders()->exists() || $location->licenses()->exists() || $location->install_orders()->exists()){
                return back()->withErrors(['delete' => ['Gagal untuk menghapus data lokasi, terdapat relasi dengan data pada tabel data lainnya']]);
            }else{
                dd($location);
                Area::destroy($location->id);
    
                return redirect('/media/locations/home/'.$category)->with('success','Lokasi dengan kode '. $location->code .' berhasil dihapus');
            }
        } else {
            abort(403);
        }
    }
}
