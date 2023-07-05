<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Area;
use App\Models\City;
use App\Models\Size;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $products = Product::with('area')->get();
        $areas = Area::with('products')->get();
        $cities = City::with('products')->get();
        $sizes = Size::with('products')->get();
        $users = User::with('products')->get();

        return response()-> view ('dashboard.media.billboards.index', [
            'products'=>Product::all(),
            'title' => 'Daftar Billboard',
            compact('products', 'areas', 'cities', 'sizes', 'users')
        ]);
    }

    public function showProduct(){
        $dataProduct = Product::All();

        return response()->json(['dataProduct'=> $dataProduct]);
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
        //
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
            compact('products', 'areas', 'cities', 'sizes')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            $products = Product::with('area');
            $areas = Area::with('products')->get();
            $cities = City::with('products')->get();
            $sizes = Size::with('products')->get();
            
            return response()->view('dashboard.media.billboards.edit', [
                'product' => $product,
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'sizes'=>Size::all(),
                'title' => 'Edit Detail Billboard',
                compact('products', 'areas', 'cities', 'sizes')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            if ($request->sale_status == 'Sold') {
                $rules = [
                    'area_id' => 'required',
                    'city_id' => 'required',
                    'size_id' => 'required',
                    'client' => 'required',
                    'price' => 'required',
                    'start_contract' => 'required',
                    'end_contract' => 'required'
                ];
            } else {
                $rules = [
                    'area_id' => 'required',
                    'city_id' => 'required',
                    'size_id' => 'required'
                ];
            }
    
            if ($request->code == $product->code) {
                $validateData['code'] = $request->input('code');
            } else {
                $rules['code'] = 'required|unique:products';
            }
    
            $validateData = $request->validate($rules);
    
            if ($request->sale_status == 'Available'){
                $validateData['client'] = '';
                $validateData['price'] = null;
                $validateData['start_contract'] = null;
                $validateData['end_contract'] = null;
            } else {
                $validateData['client'] = $request->input('client');
                $validateData['price'] = $request->input('price');
                $validateData['start_contract'] = $request->input('start_contract');
                $validateData['end_contract'] = $request->input('end_contract');
            }
    
            $validateData['lighting'] = $request->input('lighting');
            $validateData['address'] = $request->input('address');
            $validateData['lat'] = $request->input('lat');
            $validateData['lng'] = $request->input('lng');
            $validateData['sector'] = $request->input('sector');
            $validateData['property_status'] = $request->input('property_status');
            $validateData['build_status'] = $request->input('build_status');
            $validateData['road_segment'] = $request->input('road_segment');
            $validateData['sale_status'] = $request->input('sale_status');
            $validateData['max_distance'] = $request->input('max_distance');
            $validateData['speed_average'] = $request->input('speed_average');
            $validateData['led_id'] = $request->input('led_id');
            $validateData['vendor_id'] = $request->input('vendor_id');
            $validateData['qty'] = 1;
            $validateData['category'] = 'Billboard';
            $validateData['user_id'] = auth()->user()->id;
    
            if($request->file('photo')){
                if($request->oldPhoto){
                    Storage::delete($request->oldPhoto);
                }
                $validateData['photo'] = $request->file('photo')->store('billboard-images');
            }
    
            Product::where('id', $product->id)
                    ->update($validateData);
    
            return redirect('/dashboard/media/billboards')->with('success','Lokasi Billboard Has Been Updated');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            if($product->photo){
                Storage::delete($product->photo);
            }
    
            Product::destroy($product->id);
    
            if ($product->category === 'Billboard'){
                return redirect('/dashboard/media/billboards')->with('success','Billboard dengan kode ' . $product->code . ' berhasil dihapus');
            }
        } else {
            abort(403);
        }
        // dd($product->product_category->name);
        
    }
}
