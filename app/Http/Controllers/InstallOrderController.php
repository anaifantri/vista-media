<?php

namespace App\Http\Controllers;

use App\Models\InstallOrder;
use App\Models\MediaCategory;
use App\Models\Sale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InstallOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $sale = Sale::with('install_order')->get();
        return response()-> view ('install-orders.index', [
            'install_orders'=>InstallOrder::filter(request('search'))->sortable()->orderBy("code", "asc")->paginate(10)->withQueryString(),
            'title' => 'Daftar SPK Pemasangan Gambar',
            'categories' => MediaCategory::all(),
            compact('sale')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('install-orders.create', [
            'title' => 'Tambah SPK Psang Gambar',
            'categories' => MediaCategory::all()
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
    public function show(InstallOrder $installOrder): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InstallOrder $installOrder): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InstallOrder $installOrder): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InstallOrder $installOrder): RedirectResponse
    {
        //
    }
}
