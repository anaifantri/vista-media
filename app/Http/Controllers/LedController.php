<?php

namespace App\Http\Controllers;

use App\Models\Led;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $leds = LED::with('vendor')->get();
        $vendors = Vendor::with('leds')->get();
        $users = User::with('leds')->get();

        return response()-> view ('dashboard.media.leds.index', [
            'leds'=>Led::filter(request('search'))->sortable()->paginate(10)->withQueryString(),
            'title' => 'Daftar Jenis LED',
            compact('leds', 'users', 'vendors')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()-> view ('dashboard.media.leds.create', [
                'vendors'=>Vendor::orderBy("name", "asc")->get(),
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
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            if($request->vendor_id == 'Pilih Vendor'){
                return back()->withErrors(['vendor_id' => ['Silahkan pilih vendor']])->withInput();
            }
        
            $validateData = $request->validate([
                'vendor_id' => 'required',
                'name' => 'required',
                'pixel_pitch' => 'required',
                'pixel_density' => 'required',
                'module_size' => 'required',
                'cabinet_size' => 'required',
                'cabinet_material' => 'required',
                'cabinet_weight' => 'required',
                'protective_grade' => 'required',
                'view_distancing' => 'required',
                'view_angle_v' => 'required',
                'view_angle_h' => 'required',
                'max_power' => 'required',
                'average_power' => 'required',
                'brightness' => 'required',
            ]);
    
            $validateData['user_id'] = auth()->user()->id;
            Led::create($validateData);
    
            return redirect('/dashboard/media/leds')->with('success','Produk '. $request->name . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Led $led): Response
    {
        $vendors = Vendor::with('leds')->get();
        $users = User::with('leds')->get();
        return response()-> view ('dashboard.media.leds.show', [
            'led' => $led,
            'title' => 'Detail Produk LED ' . $led->name,
            compact('users', 'vendors')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Led $led): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            $vendors = Vendor::with('leds')->get();
            $users = User::with('leds')->get();
            return response()->view('dashboard.media.leds.edit', [
                'led' => $led,
                'vendors'=>Vendor::orderBy("name", "asc")->get(),
                'title' => 'Edit Produk LED',
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
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
                if($request->vendor_id == 'Pilih Vendor'){
                    return back()->withErrors(['vendor_id' => ['Silahkan pilih vendor']])->withInput();
                }
            
                $validateData = $request->validate([
                    'vendor_id' => 'required',
                    'name' => 'required',
                    'pixel_pitch' => 'required',
                    'pixel_density' => 'required',
                    'module_size' => 'required',
                    'cabinet_size' => 'required',
                    'cabinet_material' => 'required',
                    'cabinet_weight' => 'required',
                    'protective_grade' => 'required',
                    'view_distancing' => 'required',
                    'view_angle_v' => 'required',
                    'view_angle_h' => 'required',
                    'max_power' => 'required',
                    'average_power' => 'required',
                    'brightness' => 'required',
                ]);
        
                $validateData['user_id'] = auth()->user()->id;
                
                Led::where('id', $led->id)
                    ->update($validateData);
        
                return redirect('/dashboard/media/leds')->with('success','Produk LED '. $led->name . ' berhasil diupdate');
            
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Led $led): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            Led::destroy($led->id);

            return redirect('/dashboard/media/leds')->with('success','Produk LED '. $led->name .' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
