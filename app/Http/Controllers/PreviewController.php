<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Product;
use App\Models\Area;
use App\Models\City;
use App\Models\Size;
use App\Models\User;

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
}
