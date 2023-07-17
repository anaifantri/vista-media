<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Product;
use App\Models\Videotron;
use App\Models\Area;
use App\Models\City;
use App\Models\Size;
use App\Models\User;
use App\Models\Led;
use App\Models\Vendor;

class PreviewController extends Controller
{
    public function preview(string $id): View
    {
        $products = Product::with('area');
        $areas = Area::with('products')->get();
        $cities = City::with('products')->get();
        $sizes = Size::with('products')->get();

        return view('dashboard.media.billboards.preview', [
            'product' =>Product::findOrFail($id),
            'title' => 'Detail Billboard',
            compact('products', 'areas', 'cities', 'sizes')
        ]);
    }

    public function videotronPreview(string $id): View
    {
        $videotrons = Videotron::with('area');
        $areas = Area::with('videotrons')->get();
        $cities = City::with('videotrons')->get();
        $sizes = Size::with('videotrons')->get();
        $leds = Led::with('videotrons')->get();
        $vendors = Vendor::with('videotrons')->get();

        return view('dashboard.media.videotrons.preview', [
            'videotron' =>Videotron::findOrFail($id),
            'title' => 'Detail Videotron',
            compact('videotrons', 'areas', 'cities', 'sizes', 'leds', 'vendors')
        ]);
    }
}
