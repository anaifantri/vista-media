<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Area;
use App\Models\City;
use App\Models\ProductCategory;
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
        $products = Product::with('area')->get();
        $areas = Area::with('products')->get();
        $cities = City::with('products')->get();
        $product_categories = ProductCategory::with('products')->get();
        $sizes = Size::with('products')->get();

        return response()-> view ('dashboard.media.billboards.index', [
            'products'=>Product::all(),
            'title' => 'Daftar Billboard',
            compact('products', 'areas', 'cities', 'product_categories', 'sizes')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()-> view ('dashboard.media.billboards.create', [
            'product_categories'=>ProductCategory::all(),
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
        if ($request->product_category_id == 'Pilih Jenis'){
            return back()->withErrors(['product_category_id' => ['Silahkan pilih jenis']])->withInput();
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
        if ($request->build_status == 'Pilih Kondisi'){
            return back()->withErrors(['build_status' => ['Silahkan pilih kondisi']])->withInput();
        }
        if ($request->sale_status == 'Pilih Status'){
            return back()->withErrors(['sale_status' => ['Silahkan pilih status']])->withInput();
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
            'product_category_id' => 'required',
            'lighting' => 'required',
            'address' => 'required|max:255',
            'photo' => 'required|image|file|max:1024',
            'lat' => 'required',
            'lng' => 'required',
            'sector' => 'required|max:255',
            'property_status' => 'required',
            'build_status' => 'required',
            'sale_status' => 'required',
            'road_segment' => 'required',
            'max_distance' => 'required',
            'speed_average' => 'required'
        ]);
        $validateData['led_id'] = $request->input('led_id');
        $validateData['led_id'] = $request->input('led_id');
        $validateData['vendor_id'] = $request->input('vendor_id');
        $validateData['qty'] = 1;
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
        foreach ($dataProduct as $product) {
            if($product->product_category_id == $request->product_category_id){
                if($product->area_id == $request->area_id){
                    $codeNumber = '00';
                    $codeNumber = $codeNumber . $i+2;
                    $i = $i+1;
                }
            }
        }
        // dd($codeNumber);
        $validateData['code'] = $areaCode . $codeNumber . ' - ' . $request->input('cityCode');

        if($request->file('photo')){
            $validateData['photo'] = $request->file('photo')->store('billboard-images');
        }
            
        // dd($validateData['code']);

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
