<?php

namespace App\Http\Controllers;

use App\Models\IncomeTax;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Validator;
use Gate;

class IncomeTaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(String $company_id): Response
    {
        if(Gate::allows('isCollect') && Gate::allows('isAccountingRead')){
            return response()-> view ('income-taxes.index', [
                'payments'=>Payment::where('company_id', $company_id)->filter(request('search'))->year()->month()->sortable()->orderBy("payment_date", "desc")->paginate(30)->withQueryString(),
                'title' => 'Daftar Pemotongan PPh'
            ]);
        } else {
            abort(403);
        }
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
    public function show(IncomeTax $incomeTax): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IncomeTax $incomeTax): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IncomeTax $incomeTax): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IncomeTax $incomeTax): RedirectResponse
    {
        //
    }
}
