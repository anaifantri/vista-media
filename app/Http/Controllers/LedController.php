<?php

namespace App\Http\Controllers;

use App\Models\Led;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Gate;

class LedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        if(Gate::allows('isMediaSetting') && Gate::allows('isMediaRead')){
            $vendors = Vendor::with('leds')->get();
            $users = User::with('leds')->get();
    
            return response()-> view ('leds.index', [
                'leds'=>Led::filter(request('search'))->sortable()->paginate(10)->withQueryString(),
                'title' => 'Daftar Jenis LED',
                compact('users', 'vendors')
            ]);
        } else {
            abort(403);
        }
    }

    public function showLed(){
        $dataLed = Led::All();

        return response()->json(['dataLed'=> $dataLed]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMediaSetting') && Gate::allows('isMediaCreate')) || (Gate::allows('isMedia') && Gate::allows('isMediaSetting') && Gate::allows('isMediaCreate'))){
            return response()-> view ('leds.create', [
                'vendors'=>Vendor::WhereHas('vendor_category', function($query){
                    $query->where('name','LED');
                })->orderBy("name", "asc")->get(),
                'title' => 'Menambahkan Produk LED'
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
        if((Gate::allows('isAdmin') && Gate::allows('isMediaSetting') && Gate::allows('isMediaCreate')) || (Gate::allows('isMedia') && Gate::allows('isMediaSetting') && Gate::allows('isMediaCreate'))){
            if($request->vendor_id == 'pilih'){
                return back()->withErrors(['vendor_id' => ['Silahkan pilih vendor']])->withInput();
            }
            if($request->type == 'pilih'){
                return back()->withErrors(['type' => ['Silahkan pilih type led']])->withInput();
            }
            if($request->pixel_config == 'pilih'){
                return back()->withErrors(['pixel_config' => ['Silahkan pilih konfigurasi pixel']])->withInput();
            }
            if($request->pixel_pitch == 'pilih'){
                return back()->withErrors(['pixel_pitch' => ['Silahkan pilih ukuran pixel']])->withInput();
            }
            if($request->vertical_angle == 'pilih'){
                return back()->withErrors(['vertical_angle' => ['Silahkan pilih sudut pandang vertikal']])->withInput();
            }
            if($request->horizontal_angle == 'pilih'){
                return back()->withErrors(['horizontal_angle' => ['Silahkan pilih sudut pandang horizontal']])->withInput();
            }
            if($request->refresh_rate == 'pilih'){
                return back()->withErrors(['refresh_rate' => ['Silahkan pilih refresh rate']])->withInput();
            }
            if($request->optimal_distance == 'pilih'){
                return back()->withErrors(['optimal_distance' => ['Silahkan pilih jarak pandang terbaik']])->withInput();
            }
            if($request->cabinet_material == 'pilih'){
                return back()->withErrors(['cabinet_material' => ['Silahkan pilih material cabinet']])->withInput();
            }

            // Set Code --> start
            $dataLeds = Led::orderBy("code", "asc")->get()->last();
            if($dataLeds){
                $lastCode = (int)substr($dataLeds->code,4,3);
                $newCode = $lastCode + 1;
            } else {
                $newCode = 1;
            }
            

            if($newCode < 10 ){
                $code = 'LED-00'.$newCode;
            } else {
                $code = 'LED-0'.$newCode;
            }
            // Set Code --> end
        
            $request->request->add(['code' => $code,'user_id' => auth()->user()->id]);
            $validateData = $request->validate([
                'vendor_id' => 'required',
                'user_id' => 'required',
                'code' => 'required|unique:leds',
                'name' => 'required|unique:leds',
                'pixel_pitch' => 'required',
                'pixel_density' => 'required',
                'module_width' => 'required',
                'module_height' => 'required',
                'cabinet_width' => 'required',
                'cabinet_height' => 'required',
                'cabinet_material' => 'required',
                'cabinet_weight' => 'required',
                'front_protection' => 'required',
                'back_protection' => 'required',
                'optimal_distance' => 'required',
                'vertical_angle' => 'required',
                'horizontal_angle' => 'required',
                'max_power' => 'required',
                'average_power' => 'required',
                'brightness' => 'required',
                'type' => 'required',
                'refresh_rate' => 'required',
                'pixel_config' => 'required'
            ]);
            
            Led::create($validateData);
    
            return redirect('/media/leds')->with('success','Produk dengan nama '. $request->name . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Led $led): Response
    {
        if(Gate::allows('isMediaSetting') && Gate::allows('isMediaRead')){
            $vendors = Vendor::with('leds')->get();
            $users = User::with('leds')->get();
            return response()-> view ('leds.show', [
                'led' => $led,
                'title' => 'Detail Produk LED ' . $led->name,
                compact('users', 'vendors')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Led $led): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMediaSetting') && Gate::allows('isMediaEdit')) || (Gate::allows('isMedia') && Gate::allows('isMediaSetting') && Gate::allows('isMediaEdit'))){
            $vendors = Vendor::with('leds')->get();
            $users = User::with('leds')->get();
            return response()->view('leds.edit', [
                'led' => $led,
                'vendors'=>Vendor::orderBy("name", "asc")->get(),
                'title' => 'Edit Data Produk LED'.$led->name,
                compact('users', 'vendors')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Led $led): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMediaSetting') && Gate::allows('isMediaEdit')) || (Gate::allows('isMedia') && Gate::allows('isMediaSetting') && Gate::allows('isMediaEdit'))){
            $request->request->add(['user_id' => auth()->user()->id]);
            $rules = [
                'vendor_id' => 'required',
                'user_id' => 'required',
                'pixel_pitch' => 'required',
                'pixel_density' => 'required',
                'module_width' => 'required',
                'module_height' => 'required',
                'cabinet_width' => 'required',
                'cabinet_height' => 'required',
                'cabinet_material' => 'required',
                'cabinet_weight' => 'required',
                'front_protection' => 'required',
                'back_protection' => 'required',
                'optimal_distance' => 'required',
                'vertical_angle' => 'required',
                'horizontal_angle' => 'required',
                'max_power' => 'required',
                'average_power' => 'required',
                'brightness' => 'required',
                'type' => 'required',
                'refresh_rate' => 'required',
                'pixel_config' => 'required'
            ];
            if($request->name != $led->name){
                $rules['name'] = 'required|unique:leds';
            }

            $validateData = $request->validate($rules);
                
            Led::where('id', $led->id)
                ->update($validateData);
        
            return redirect('/media/leds')->with('success','Produk LED dengan nama '. $led->name . ' berhasil dirubah');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Led $led): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMediaSetting') && Gate::allows('isMediaDelete')) || (Gate::allows('isMedia') && Gate::allows('isMediaSetting') && Gate::allows('isMediaDelete'))){
            Led::destroy($led->id);

            return redirect('/media/leds')->with('success','Produk LED dengan nama'. $led->name .' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
