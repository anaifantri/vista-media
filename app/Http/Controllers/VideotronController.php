<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Area;
use App\Models\City;
use App\Models\ProductCategory;
use App\Models\Size;
use App\Models\Led;
use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VideotronController extends Controller
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
                $products->where('area_id', 'like', '%' . request('area') . '%');
            }
            if ($dataCity != 'All') {
                $products->where('city_id', 'like', '%' . $dataCity . '%');
            }
            if (request('build') != 'All') {
                $products->where('build_status', 'like', '%' . request('build') . '%');
            }
            if (request('sale') != 'All') {
                $products->where('sale_status', 'like', '%' . request('sale') . '%');
            }

        $areas = Area::with('products')->get();
        $cities = City::with('products')->get();
        $sizes = Size::with('products')->get();
        $leds = Led::with('products')->get();
        $vendors = Vendor::with('products')->get();

        return response()-> view ('dashboard.media.videotrons.index', [
            'products'=>$products->get(),
            'areas'=>Area::all(),
            'cities'=>City::all(),
            'title' => 'Daftar Videotron',
            compact('areas', 'cities', 'sizes', 'vendors', 'leds')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()-> view ('dashboard.media.videotrons.create', [
            'areas'=>Area::all(),
            'cities'=>City::all(),
            'sizes'=>Size::all(),
            'leds'=>LED::all(),
            'vendors'=>Vendor::all(),
            'title' => 'Menambahkan Videotron'
        ]);
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
        //
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
        //
    }
}
