<?php

namespace App\Http\Controllers;

use App\Models\Signage;
use App\Models\Area;
use App\Models\City;
use App\Models\Size;
use App\Models\Led;
use App\Models\Vendor;
use App\Models\SignageCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

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
                'vendors'=>Vendor::WhereHas('vendor_category', function($query){
                    $query->where('name','OOH');
                })->orderBy("name", "asc")->get(),
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
            if ($request->signageCategory == 'Videotron'){
                if ($request->led_id == 'pilih'){
                    return back()->withErrors(['led_id' => ['Silahkan pilih jenis LED']])->withInput();
                }
            }
            if ($request->size_id == 'pilih'){
                return back()->withErrors(['size_id' => ['Silahkan pilih ukuran']])->withInput();
            }
            if ($request->owneship == 'Mitra'){
                if ($request->vendor_id == 'pilih'){
                    return back()->withErrors(['vendor_id' => ['Silahkan pilih vendor']])->withInput();
                }
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
                'code' => 'required|unique:signages',
                'area_id' => 'required',
                'city_id' => 'required',
                'size_id' => 'required',
                'signage_category_id' => 'required',
                'address' => 'required|max:255',
                'qty' => 'required',
                'locations' => 'required',
                'ownership' => 'required',
                'condition' => 'required',
                'road_segment' => 'required',
                'max_distance' => 'required',
                'speed_average' => 'required',
                'sector' => 'required|max:255',
                'photo' => 'image|file|max:1024'
            ]);

            if ($request->input('signageCategory') == 'Videotron'){
                $validateData['led_id'] = $request->input('led_id');
                $validateData['slot_qty'] = $request->input('slot_qty');
                $validateData['duration'] = $request->input('duration');
                $validateData['start_at'] = $request->input('start_at');
                $validateData['slots'] = null;
                $validateData['end_at'] = $request->input('end_at');
                $validateData['exclusive_price'] = $request->input('exclusive_price');
                $validateData['sharing_price'] = $request->input('sharing_price');
            } else {
                $validateData['price'] = $request->input('price');
                $validateData['led_id'] = null;
                $validateData['slot_qty'] = null;
                $validateData['duration'] = null;
                $validateData['start_at'] = null;
                $validateData['end_at'] = null;
                $validateData['slots'] = null;
                $validateData['exclusive_price'] = null;
                $validateData['sharing_price'] = null;
            }

            if ($request->input('ownership') == 'Vista Media'){
                $validateData['vendor_id'] = null;
            } else {
                $validateData['vendor_id'] = $request->input('vendor_id');
            }
            
            $validateData['user_id'] = auth()->user()->id;
    
            if($request->file('photo')){
                $validateData['photo'] = $request->file('photo')->store('signage-images');
            }
    
            Signage::create($validateData);
            
            return redirect('/dashboard/media/signages')->with('success','Signage dengan kode '. $validateData['code'] . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Signage $signage): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Signage $signage): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Signage $signage): RedirectResponse
    {
        //
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
