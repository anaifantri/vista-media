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
            $products = Product::with('area');

            $dataCity = request('requestCity');

            if (request('area') != request('requestArea')) {
                $dataCity = 'All';
            }
            if (request('area') != 'All') {
                $products->where('area_id', 'like', '%' . request('area') . '%' );
            }
            if ($dataCity != 'All') {
                $products->where('city_id', 'like', '%' . $dataCity . '%' );
            }
            if (request('build') != 'All') {
                $products->where('build_status', 'like', '%' . request('build') . '%' );
            }
            if (request('sale') != 'All') {
                $products->where('sale_status', 'like', '%' . request('sale') . '%' );
            }

            $areas = Area::with('products')->get();
            $cities = City::with('products')->get();
            $sizes = Size::with('products')->get();

        // dd($request->area, $request->city, $request->property,$request->build);
            return response()-> view ('dashboard.media.billboards.index', [
                'products'=>$products->get(),
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'title' => 'Daftar Billboard',
                compact('areas', 'cities', 'sizes')
            ]);
    }

    public function test()
    {
        dd(request('property'));
        if ($request->area == 'All') {
            $request->area = '';
        }
        if ($request->city == 'All') {
            $request->city = '';
        }
        if ($request->property == 'All') {
            $request->property = '';
        }
        if ($request->build == 'All') {
            $request->build = '';
        }

        if ($request) {
            dd($request->area, $request->city, $request->property,$request->build);   
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()-> view ('dashboard.media.billboards.create', [
            'areas'=>Area::all(),
            'cities'=>City::all(),
            'sizes'=>Size::all(),
            'title' => 'Menambahkan Billboard'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->area_id == 'Pilih Area'){
            return back()->withErrors(['area_id' => ['Silahkan pilih area']])->withInput();
        }
        if ($request->city == 'Pilih Kota'){
            return back()->withErrors(['city' => ['Silahkan pilih kota']])->withInput();
        }
        if ($request->lighting == 'Pilih Penerangan'){
            return back()->withErrors(['lighting' => ['Silahkan pilih jenis']])->withInput();
        }
        if ($request->size_id == 'Pilih Ukuran'){
            return back()->withErrors(['size_id' => ['Silahkan pilih ukuran']])->withInput();
        }
        if ($request->property_status == 'Pilih Kepemilikan'){
            return back()->withErrors(['property_status' => ['Silahkan pilih kepemilikan']])->withInput();
        }
        if ($request->buildSelect == 'Pilih Kondisi'){
            return back()->withErrors(['buildSelect' => ['Silahkan pilih kondisi']])->withInput();
        }
        if ($request->road_segment == 'Pilih Type Jalan'){
            return back()->withErrors(['road_segment' => ['Silahkan pilih type jalan']])->withInput();
        }
        if ($request->max_distance== 'Pilih Jarak Pandang'){
            return back()->withErrors(['max_distance' => ['Silahkan pilih jarak pandang']])->withInput();
        }
        if ($request->speed_average == 'Pilih Kecepatan Kendaraan'){
            return back()->withErrors(['speed_average' => ['Silahkan pilih kecepatan kendaraan']])->withInput();
        }
        if ($request->sector == ''){
            return back()->withErrors(['sector' => ['Silahkan pilih minimal 1 kawasan']])->withInput();
        }
        $validateData = $request->validate([
            'area_id' => 'required',
            'city_id' => 'required',
            'size_id' => 'required',
            'lighting' => 'required',
            'address' => 'required|max:255',
            'photo' => 'required|image|file|max:1024',
            'lat' => 'required',
            'lng' => 'required',
            'sector' => 'required|max:255',
            'property_status' => 'required',
            'build_status' => 'required',
            'road_segment' => 'required',
            'max_distance' => 'required',
            'speed_average' => 'required'
        ]);
        $validateData['led_id'] = $request->input('led_id');
        $validateData['led_id'] = $request->input('led_id');
        $validateData['vendor_id'] = $request->input('vendor_id');
        $validateData['qty'] = 1;
        $validateData['category'] = 'Billboard';
        $validateData['sale_status'] = 'Available';
        $validateData['user_id'] = auth()->user()->id;

        $dataArea = Area::all();
        $areaCode = '';
        foreach ($dataArea as $area) {
            if($request->area_id == $area->id){
                $areaCode = $area->area_code;
            }
        }

        $dataProduct = Product::all();
        $i = 0;
        $codeNumber = '001';
        $codeMNumber = '001';
        $codeRNumber = '001';
        foreach ($dataProduct as $product) {
            if($product->category == $validateData['category']){
                if($product->area_id == $request->area_id && $product->property_status == 'Mitra'){
                    $codeMNumber = '00';
                    $codeMNumber = $codeMNumber . $i+2;
                    $i = $i+1;
                } else if ($product->area_id == $request->area_id && $product->build_status == 'Rencana') {
                    $codeRNumber = '00';
                    $codeRNumber = $codeRNumber . $i+2;
                    $i = $i+1;
                } else {
                    $codeNumber = '00';
                    $codeNumber = $codeNumber . $i+2;
                    $i = $i+1;
                }
            }
        }
        // dd($request->product_category_id);
        if ($request->property_status == 'Mitra') {
            $validateData['code'] = 'M-'. $areaCode . $codeMNumber . ' - ' . $request->input('cityCode');
        } else {
            if ($request->build_status == 'Terbangun' || $request->build_status == 'Pembangunan') {
                $validateData['code'] = $areaCode . $codeNumber . ' - ' . $request->input('cityCode');
            } else {
                $validateData['code'] = 'R-'. $areaCode . $codeRNumber . ' - ' . $request->input('cityCode');
            }
        }
        //  dd($validateData['code']);

        if($request->file('photo')){
            $validateData['photo'] = $request->file('photo')->store('billboard-images');
        }

        Product::create($validateData);
        
        return redirect('/dashboard/media/billboards')->with('success','Billboard dengan kode '. $validateData['code'] . ' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): Response
    {
        dd($product->id);
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
