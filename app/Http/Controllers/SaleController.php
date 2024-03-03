<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleCategory;
use App\Models\BillboardQuotation;
use App\Models\BillboardQuotRevision;
use App\Models\BillboardQuotStatus;
use App\Models\Client;
use App\Models\Billboard;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $clients = Client::with('sales')->get();
        $billboards = Billboard::with('sales')->get();
        $companies = Company::with('sales')->get();
        $billboard_quotations = BillboardQuotation::with('sales')->get();
        return response()->view('dashboard.marketing.sales.index', [
            'sales' => Sale::filter(request('search'))->sortable()->paginate(10)->withQueryString(),
            'title' => 'Daftar Penjualan',
            compact('clients', 'billboards', 'companies', 'billboard_quotations')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            return response()-> view ('dashboard.marketing.sales.create', [
                'sales'=>Sale::all(),
                'sale_categories'=>SaleCategory::all(),
                'billboard_quotations'=>BillboardQuotation::all(),
                'billboard_quot_revisions'=>BillboardQuotRevision::all(),
                'billboard_quot_statuses'=>BillboardQuotStatus::all(),
                'title' => 'Input Data Penjualan'
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale): RedirectResponse
    {
        //
    }
}
