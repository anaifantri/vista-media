<?php

namespace App\Http\Controllers;

use App\Models\BillboardPhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BillboardPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    public function showBillboardPhoto(){
        $dataBillboardPhoto = BillboardPhoto::All();

        return response()->json(['dataBillboardPhoto'=> $dataBillboardPhoto]);
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
    public function show(BillboardPhoto $billboardPhoto): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BillboardPhoto $billboardPhoto): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BillboardPhoto $billboardPhoto): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BillboardPhoto $billboardPhoto): RedirectResponse
    {
        //
    }
}
