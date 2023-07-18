<?php

namespace App\Http\Controllers;

use App\Models\Videotron;
use App\Models\Area;
use App\Models\City;
use App\Models\Size;
use App\Models\Led;
use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class VideotronController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()-> view ('dashboard.media.videotrons.index', [
            'videotrons'=>Videotron::filter(request('search'))->area()->city()->condition()->sortable()->paginate(10)->withQueryString(),
            'areas'=>Area::all(),
            'title' => 'Daftar Videotron'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            return response()-> view ('dashboard.media.videotrons.create', [
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'sizes'=>Size::orderBy("size", "asc")->get(),
                'leds'=>Led::orderBy("pixel_pitch", "asc")->get(),
                'vendors'=>Vendor::WhereHas('vendor_category', function($query){
                    $query->where('name','OOH');
                })->orderBy("name", "asc")->get(),
                'title' => 'Menambahkan Videotron'
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
            if ($request->led_id == 'pilih'){
                return back()->withErrors(['led_id' => ['Silahkan pilih jenis LED']])->withInput();
            }
            if ($request->size_id == 'pilih'){
                return back()->withErrors(['size_id' => ['Silahkan pilih ukuran']])->withInput();
            }
            if ($request->owneship == 'pilih'){
                return back()->withErrors(['ownership' => ['Silahkan pilih kepemilikan']])->withInput();
            }
            if ($request->condition == 'pilih'){
                return back()->withErrors(['condition' => ['Silahkan pilih kondisi']])->withInput();
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
                'code' => 'required|unique:products',
                'area_id' => 'required',
                'city_id' => 'required',
                'size_id' => 'required',
                'led_id' => 'required',
                'address' => 'required|max:255',
                'slots' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'ownership' => 'required',
                'condition' => 'required',
                'road_segment' => 'required',
                'max_distance' => 'required',
                'speed_average' => 'required',
                'exclusive_price' => 'required',
                'sharing_price' => 'required',
                'sector' => 'required|max:255',
                'photo' => 'image|file|max:1024'
            ]);
            if ($request->input('ownership') == 'Vista Media'){
                $validateData['vendor_id'] = null;
            } else {
                $validateData['vendor_id'] = $request->input('vendor_id');
            }
            
            $validateData['user_id'] = auth()->user()->id;
    
            // $dataArea = Area::all();
            // $areaCode = '';
            // foreach ($dataArea as $area) {
            //     if($request->area_id == $area->id){
            //         $areaCode = $area->area_code;
            //     }
            // }
    
            // $dataProduct = Product::all();
            // $i = 0;
            // $codeNumber = '001';
            // $codeMNumber = '001';
            // $codeRNumber = '001';
            // foreach ($dataProduct as $product) {
            //     if($product->category == $validateData['category']){
            //         if($product->area_id == $request->area_id && $product->property_status == 'Mitra'){
            //             $codeMNumber = '00';
            //             $codeMNumber = $codeMNumber . $i+2;
            //             $i = $i+1;
            //         } else if ($product->area_id == $request->area_id && $product->build_status == 'Rencana') {
            //             $codeRNumber = '00';
            //             $codeRNumber = $codeRNumber . $i+2;
            //             $i = $i+1;
            //         } else {
            //             $codeNumber = '00';
            //             $codeNumber = $codeNumber . $i+2;
            //             $i = $i+1;
            //         }
            //     }
            // }
            // dd($request->product_category_id);
            // if ($request->property_status == 'Mitra') {
            //     $validateData['code'] = 'M-'. $areaCode . $codeMNumber . ' - ' . $request->input('cityCode');
            // } else {
            //     if ($request->build_status == 'Terbangun' || $request->build_status == 'Pembangunan') {
            //         $validateData['code'] = $areaCode . $codeNumber . ' - ' . $request->input('cityCode');
            //     } else {
            //         $validateData['code'] = 'R-'. $areaCode . $codeRNumber . ' - ' . $request->input('cityCode');
            //     }
            // }
            //  dd($validateData['code']);
    
            if($request->file('photo')){
                $validateData['photo'] = $request->file('photo')->store('videotron-images');
            }
    
            Videotron::create($validateData);
            
            return redirect('/dashboard/media/videotrons')->with('success','Videotron dengan kode '. $validateData['code'] . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Videotron $videotron): Response
    {
        $videotrons = Videotron::with('area');
        $areas = Area::with('videotrons')->get();
        $cities = City::with('videotrons')->get();
        $sizes = Size::with('videotrons')->get();
        $leds = Led::with('videotrons')->get();
        $vendors = Vendor::with('videotrons')->get();

        return response()->view('dashboard.media.videotrons.show', [
            'videotron' => $videotron,
            'title' => 'Detail Videotron',
            compact('videotrons', 'areas', 'cities', 'sizes', 'leds', 'vendors')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Videotron $videotron): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            $videotrons = Videotron::with('area');
            $areas = Area::with('videotrons')->get();
            $cities = City::with('videotrons')->get();
            $sizes = Size::with('videotrons')->get();
            
            return response()->view('dashboard.media.videotrons.edit', [
                'videotron' => $videotron,
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'sizes'=>Size::orderBy("size", "asc")->get(),
                'leds'=>Led::orderBy("pixel_pitch", "asc")->get(),
                'vendors'=>Vendor::WhereHas('vendor_category', function($query){
                    $query->where('name','OOH');
                })->orderBy("name", "asc")->get(),
                'title' => 'Edit Detail Videotron',
                compact('videotrons', 'areas', 'cities', 'sizes')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Videotron $videotron): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            if ($request->sector == ''){
                return back()->withErrors(['sector' => ['Silahkan pilih minimal 1 kawasan']])->withInput();
            }

            $rules = [
                'area_id' => 'required',
                'city_id' => 'required',
                'size_id' => 'required',
                'led_id' => 'required',
                'address' => 'required|max:255',
                'slots' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'ownership' => 'required',
                'condition' => 'required',
                'road_segment' => 'required',
                'max_distance' => 'required',
                'speed_average' => 'required',
                'exclusive_price' => 'required',
                'sharing_price' => 'required',
                'sector' => 'required|max:255',
                'photo' => 'image|file|max:1024'
            ];

            if ($request->code == $videotron->code) {
                $validateData['code'] = $request->input('code');
            } else {
                $rules['code'] = 'required|unique:videotrons';
            }

            if ($request->input('ownership') == 'Vista Media'){
                $validateData['vendor_id'] = null;
            } else {
                $validateData['vendor_id'] = $request->input('vendor_id');
            }
            
            $validateData['user_id'] = auth()->user()->id;

            $validateData = $request->validate($rules);

            if($request->file('photo')){
                if($request->oldPhoto){
                    Storage::delete($request->oldPhoto);
                }
                $validateData['photo'] = $request->file('photo')->store('videotron-images');
            }

            Videotron::where('id', $videotron->id)
                    ->update($validateData);
    
            return redirect('/dashboard/media/videotrons')->with('success','Lokasi Videotron Has Been Updated');

        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Videotron $videotron): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            if($videotron->photo){
                Storage::delete($videotron->photo);
            }
    
            Videotron::destroy($videotron->id);
    
            return redirect('/dashboard/media/videotrons')->with('success','Videotron dengan kode ' . $videotron->code . ' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
