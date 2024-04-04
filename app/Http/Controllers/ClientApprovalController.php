<?php

namespace App\Http\Controllers;

use App\Models\ClientApproval;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    public function showClientApproval(){
        $dataClientApproval = ClientApproval::all();
        return response()->json(['dataClientApproval'=> $dataClientApproval]);
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
    public function show(ClientApproval $clientApproval): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClientApproval $clientApproval): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClientApproval $clientApproval): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClientApproval $clientApproval): RedirectResponse
    {
        //
    }
}
