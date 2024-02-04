<?php

namespace App\Http\Controllers;

use App\Models\BillboardCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BillboardCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    public function showBillboardCategory(){
        $dataBillboardCategory = BillboardCategory::All();

        return response()->json(['dataBillboardCategory'=> $dataBillboardCategory]);
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
    public function show(BillboardCategory $billboardCategory): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BillboardCategory $billboardCategory): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BillboardCategory $billboardCategory): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BillboardCategory $billboardCategory): RedirectResponse
    {
        //
    }
}
