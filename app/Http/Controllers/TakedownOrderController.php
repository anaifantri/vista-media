<?php

namespace App\Http\Controllers;

use App\Models\TakedownOrder;
use App\Models\Location;
use App\Models\InstallOrder;
use App\Models\Area;
use App\Models\City;
use App\Models\Company;
use App\Models\MediaSize;
use App\Models\MediaCategory;
use App\Models\LocationPhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Validator;
use Gate;

class TakedownOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(String $company_id): Response
    {
        if(Gate::allows('isOrder') && Gate::allows('isMarketingRead')){
            $dataTakedowns = TakedownOrder::where('company_id', $company_id)->year()->month()->days()->filter(request('search'))->todays()->weekday()->monthly()->annual()->sortable()->orderBy("number", "asc")->get();
            $install_order = InstallOrder::with('takedown_order')->get();
            $locations = Location::with('takedown_orders')->get();
            return response()-> view ('takedown-orders.index', [
                'takedown_orders'=>TakedownOrder::where('company_id', $company_id)->year()->filter(request('search'))->year()->month()->days()->todays()->weekday()->monthly()->annual()->sortable()->orderBy("number", "desc")->paginate(20)->withQueryString(),
                'data_takedowns'=>$dataTakedowns,
                'areas' => Area::all(),
                'cities' => City::all(),
                'title' => 'Daftar SPK Penurunan Gambar',
                compact('install_order', 'locations')
            ]);
        } else {
            abort(403);
        }
    }
    
    public function preview(String $id): View
    { 
        if(Gate::allows('isOrder') && Gate::allows('isMarketingRead')){
            $install_order = InstallOrder::with('takedown_order')->get();
            return view('takedown-orders.preview', [
                'takedown_order' => TakedownOrder::findOrFail($id),
                'title' => 'Preview SPK Penurunan Gambar',
                compact('install_order')
            ]);
        } else {
            abort(403);
        }
    }
    
    public function selectLocations(Request $request): View
    {
        if((Gate::allows('isAdmin') && Gate::allows('isOrder') && Gate::allows('isMarketingCreate')) || (Gate::allows('isMarketing') && Gate::allows('isOrder') && Gate::allows('isMarketingCreate'))){
            $locations = Location::takedown()->filter(request('search'))->area()->city()->category()->sortable()->orderBy("code", "asc")->paginate(30)->withQueryString();
            $install_orders = InstallOrder::with('location')->orderBy("number", "asc")->get();
            return view ('takedown-orders.select-location', [
                'locations'=>$locations,
                'areas' => Area::all(),
                'cities' => City::all(),
                'title' => 'Pilih Lokasi Pemasangan',
                compact('install_orders')
            ]);
        } else {
            abort(403);
        }
    }

    public function createOrder(String $dataId, Request $request): View
    {
        if((Gate::allows('isAdmin') && Gate::allows('isOrder') && Gate::allows('isMarketingCreate')) || (Gate::allows('isMarketing') && Gate::allows('isOrder') && Gate::allows('isMarketingCreate'))){
            $location = Location::findOrFail($dataId);
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $location_photos = LocationPhoto::with('location')->get();
            $media_categories = MediaCategory::with('locations')->get();
            return view('takedown-orders.create', [
                'location'=>$location,
                'title' => 'Tambah SPK Penurunan Gambar',
                'dataId'=>$dataId,
                compact('areas', 'media_categories', 'cities', 'media_sizes', 'location_photos')
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
        if((Gate::allows('isAdmin') && Gate::allows('isOrder') && Gate::allows('isMarketingCreate')) || (Gate::allows('isMarketing') && Gate::allows('isOrder') && Gate::allows('isMarketingCreate'))){
            if($request->file('design')){
                $request->validate([
                    'design'=> 'image|file|mimes:jpeg,png,jpg|max:1024',
                ]);
            }
            $romawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VII', 'IX', 'X', 'XI', 'XII'];
            $dataCompany = Company::where('id', $request->company_id)->firstOrFail();
            // Set number --> start
            $lastOrder = TakedownOrder::where('company_id', $request->company_id)->whereYear('created_at', Carbon::now()->year)->get()->last();
            if($lastOrder){
                $lastNumber = (int)substr($lastOrder->number,0,4);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
            
            if($newNumber > 0 && $newNumber < 10){
                $number = '000'.$newNumber.'/SPK-PT/'.$dataCompany->code.'/'.$romawi[(int) date('m')].'-'. date('Y');
            }else if($newNumber >= 10 && $newNumber < 100 ){
                $number = '00'.$newNumber.'/SPK-PT/'.$dataCompany->code.'/'.$romawi[(int) date('m')].'-'. date('Y');
            }else if($newNumber >= 100 && $newNumber < 1000 ){
                $number = '0'.$newNumber.'/SPK-PT/'.$dataCompany->code.'/'.$romawi[(int) date('m')].'-'. date('Y');
            } else {
                $number = $newNumber.'/SPK-PT/'.$dataCompany->code.'/'.$romawi[(int) date('m')].'-'. date('Y');
            }
            // Set number --> end

            $request->request->add(['number' => $number]);
            $validateData = $request->validate([
                'number' => 'required|unique:takedown_orders',
                'company_id' => 'required',
                'install_order_id' => 'nullable',
                'location_id' => 'required',
                'theme' => 'required',
                'takedown_at' => 'required',
                'notes' => 'nullable',
                'product' => 'required',
                'created_by' => 'required',
                'updated_by' => 'required',
                'design' => 'nullable'
            ]);
            // dd($validateData);

            if($request->file('design')){
                $validateData['design'] = $request->file('design')->store('takedown-designs');
            }
            
            TakedownOrder::create($validateData);

            $dataOrder = TakedownOrder::where('number', $validateData['number'])->firstOrFail();
    
            return redirect('/marketing/takedown-orders/preview/'.$dataOrder->id)->with('success','SPK penurunan gambar dengan nomor '. $number . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TakedownOrder $takedownOrder): Response
    {
        if(Gate::allows('isOrder') && Gate::allows('isMarketingRead')){
            $locations = Location::with('takedown_orders')->get();
            $install_order = InstallOrder::with('takedown_order')->get();
            return response()-> view ('takedown-orders.show', [
                'takedown_order' => $takedownOrder,
                'title' => 'Detail SPK Penurunan',
                compact('locations', 'install_order')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TakedownOrder $takedownOrder): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isOrder') && Gate::allows('isMarketingEdit')) || (Gate::allows('isMarketing') && Gate::allows('isOrder') && Gate::allows('isMarketingEdit'))){
            $locations = Location::with('takedown_orders')->get();
            return response()-> view ('takedown-orders.edit', [
                'takedown_order' => $takedownOrder,
                'title' => 'Edit Data SPK Penurunan Gambar',
                compact('locations')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TakedownOrder $takedownOrder): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isOrder') && Gate::allows('isMarketingEdit')) || (Gate::allows('isMarketing') && Gate::allows('isOrder') && Gate::allows('isMarketingEdit'))){
            if($request->file('design')){
                $request->validate([
                    'design'=> 'image|file|mimes:jpeg,png,jpg|max:1024',
                ]);
            }
            $rules = [
                'theme' => 'required',
                'takedown_at' => 'required',
                'updated_by' => 'required',
                'notes' => 'nullable'
            ];

            $validateData = $request->validate($rules);
                
            if($request->file('design')){
                if($request->oldDesign){
                    Storage::delete($request->oldDesign);
                }
                $validateData['design'] = $request->file('design')->store('takedown-designs');
            }
            
            TakedownOrder::where('id', $takedownOrder->id)
                ->update($validateData);
    
            return redirect('/marketing/takedown-orders/preview/'.$takedownOrder->id)->with('success','SPK penurunan gambar dengan nomor '. $takedownOrder->number . ' berhasil diedit');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TakedownOrder $takedownOrder): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isOrder') && Gate::allows('isMarketingDelete')) || (Gate::allows('isMarketing') && Gate::allows('isOrder') && Gate::allows('isMarketingDelete'))){
            Storage::delete($takedownOrder->design);
            TakedownOrder::destroy($takedownOrder->id);
            return redirect('/takedown-orders/index/'.$takedownOrder->company_id)->with('success', 'Data SPK penurunan gambar dengan nomor '.$takedownOrder->number.' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
