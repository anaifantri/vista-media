<?php

namespace App\Http\Controllers;

use App\Models\PrintInstallApproval;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PrintInstallApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    public function printInstallApproval(){
        $dataApproval = PrintInstallApproval::all();
        return response()->json(['dataApproval'=> $dataApproval]);
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
    public function show(PrintInstallApproval $printInstallApproval): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrintInstallApproval $printInstallApproval): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrintInstallApproval $printInstallApproval): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrintInstallApproval $printInstallApproval): RedirectResponse
    {
        //
    }
}
