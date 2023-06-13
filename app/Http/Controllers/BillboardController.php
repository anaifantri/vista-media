<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Area;
use App\Models\City;
use App\Models\Size;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class BillboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
            $products = Product::with(['area', 'city', 'size', 'user'])->sortable();

            return response()-> view ('dashboard.media.billboards.index', [
                'products'=>Product::filter()->area()->city()->build()->status()->paginate(10),
                'areas'=>Area::all(),
                'title' => 'Daftar Billboard'
            ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            return response()-> view ('dashboard.media.billboards.create', [
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'sizes'=>Size::all(),
                'title' => 'Menambahkan Billboard'
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
            if ($request->area_id == 'Pilih Area'){
                return back()->withErrors(['area_id' => ['Silahkan pilih area']])->withInput();
            }
            if ($request->city == 'Pilih Kota'){
                return back()->withErrors(['city' => ['Silahkan pilih kota']])->withInput();
            }
            if ($request->lighting == 'Pilih Penerangan'){
                // return back()->withErrors(['lighting' => ['Silahkan pilih jenis']])->withInput();
                $request->lighting = '';
            }
            if ($request->size_id == 'Pilih Ukuran'){
                // return back()->withErrors(['size_id' => ['Silahkan pilih ukuran']])->withInput();
                $request->size_id = '';
            }
            if ($request->property_status == 'Pilih Kepemilikan'){
                // return back()->withErrors(['property_status' => ['Silahkan pilih kepemilikan']])->withInput();
                $request->property_status = '';
            }
            if ($request->buildSelect == 'Pilih Kondisi'){
                // return back()->withErrors(['buildSelect' => ['Silahkan pilih kondisi']])->withInput();
                $request->buildSelect = '';
            }
            if ($request->saleSelect == 'Pilih Status'){
                // return back()->withErrors(['saleSelect' => ['Silahkan pilih status']])->withInput();
                $request->saleSelect = '';
                $validateData['sale_status'] = 'Available';
            }
            if ($request->sale_status == 'Sold') {
                $validateData = $request->validate([
                    'client' => 'required',
                    'price' => 'required',
                    'start_contract' => 'required',
                    'end_contract' => 'required'
                ]);
            }
    
            if ($request->road_segment == 'Pilih Type Jalan'){
                // return back()->withErrors(['road_segment' => ['Silahkan pilih type jalan']])->withInput();
                $request->road_segment = '';
            }
            if ($request->max_distance== 'Pilih Jarak Pandang'){
                // return back()->withErrors(['max_distance' => ['Silahkan pilih jarak pandang']])->withInput();
                $request->max_distance= '';
            }
            if ($request->speed_average == 'Pilih Kecepatan Kendaraan'){
                // return back()->withErrors(['speed_average' => ['Silahkan pilih kecepatan kendaraan']])->withInput();
                $request->speed_average = '';
            }
            // if ($request->sector == ''){
            //     return back()->withErrors(['sector' => ['Silahkan pilih minimal 1 kawasan']])->withInput();
            // }
            $validateData = $request->validate([
                'code' => 'required|unique:products',
                'area_id' => 'required',
                'city_id' => 'required',
                'size_id' => 'required'
                // 'lighting' => 'required',
                // 'address' => 'required|max:255',
                // 'photo' => 'required|image|file|max:1024',
                // 'lat' => 'required',
                // 'lng' => 'required',
                // 'sector' => 'required|max:255',
                // 'property_status' => 'required',
                // 'build_status' => 'required',
                // 'sale_status' => 'required',
                // 'road_segment' => 'required',
                // 'max_distance' => 'required',
                // 'speed_average' => 'required'
            ]);
            if($request->build_status == ''){
                $validateData['build_status'] = 'Rencana';
            } else {
                $validateData['build_status'] = $request->input('build_status');
            }
            if($request->sale_status == ''){
                $validateData['sale_status'] = 'Available';
            } else {
                $validateData['sale_status'] = $request->input('sale_status');
            }
    
            $validateData['lighting'] = $request->input('lighting');
            $validateData['address'] = $request->input('address');
            $validateData['lat'] = $request->input('lat');
            $validateData['lng'] = $request->input('lng');
            $validateData['sector'] = $request->input('sector');
            $validateData['property_status'] = $request->input('property_status');
            $validateData['road_segment'] = $request->input('road_segment');
            $validateData['client'] = $request->input('client');
            $validateData['price'] = $request->input('price');
            $validateData['start_contract'] = $request->input('start_contract');
            $validateData['end_contract'] = $request->input('end_contract');
            $validateData['max_distance'] = $request->input('max_distance');
            $validateData['speed_average'] = $request->input('speed_average');
            $validateData['led_id'] = $request->input('led_id');
            $validateData['vendor_id'] = $request->input('vendor_id');
            $validateData['qty'] = 1;
            $validateData['category'] = 'Billboard';
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
                $validateData['photo'] = $request->file('photo')->store('billboard-images');
            }
    
            Product::create($validateData);
            
            return redirect('/dashboard/media/billboards')->with('success','Billboard dengan kode '. $validateData['code'] . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): Response
    {
        $products = Product::with('area');
        $areas = Area::with('products')->get();
        $cities = City::with('products')->get();
        $sizes = Size::with('products')->get();

        return response()->view('dashboard.media.billboards.show', [
            'product' => $product,
            'title' => 'Detail Billboard',
            compact('product', 'areas', 'cities', 'sizes')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        dd($product->id);
        // if($product->photo){
        //     Storage::delete($product->photo);
        // }

        // Product::destroy($product->id);
        
        // return redirect('/dashboard/media/billboards')->with('success','Billboard dengan kode ' . $product->code . ' berhasil dihapus');
    }
}
