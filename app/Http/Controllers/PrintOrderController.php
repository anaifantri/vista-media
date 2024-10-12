<?php

namespace App\Http\Controllers;

use App\Models\PrintOrder;
use App\Models\MediaCategory;
use App\Models\Sale;
use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PrintOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $sale = Sale::with('print_order')->get();
        return response()-> view ('print-orders.index', [
            'print_orders'=>PrintOrder::filter(request('search'))->sortable()->orderBy("code", "asc")->paginate(10)->withQueryString(),
            'title' => 'Daftar SPK Cetak',
            'categories' => MediaCategory::all(),
            compact('sale')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $vendors = Vendor::print()->get();
        return response()->view('print-orders.create', [
            'title' => 'Tambah SPK Cetak Gambar',
            'vendors' => $vendors,
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
    public function show(PrintOrder $printOrder): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrintOrder $printOrder): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrintOrder $printOrder): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrintOrder $printOrder): RedirectResponse
    {
        //
    }
}
