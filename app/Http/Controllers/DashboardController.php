<?php

namespace App\Http\Controllers;

use App\Models\MediaCategory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard.index',[
            'title' => "Dashboard",
            'categories' => MediaCategory::all(),
        ]);
    }
}
