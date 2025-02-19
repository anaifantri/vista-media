<?php

namespace App\Http\Controllers;

use App\Models\BillCoverLetter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Validator;
use Gate;

class BillCoverLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(String $company_id): Response
    {
        if(Gate::allows('isCollect') && Gate::allows('isAccountingRead')){
            return response()-> view ('bill-cover-letters.index', [
                'bill_cover_letters'=>BillCoverLetter::where('company_id', $company_id)->sortable()->orderBy("number", "desc")->paginate(30)->withQueryString(),
                'title' => 'Daftar Surat Pengantar Tagihan'
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
    public function show(BillCoverLetter $billCoverLetter): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BillCoverLetter $billCoverLetter): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BillCoverLetter $billCoverLetter): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BillCoverLetter $billCoverLetter): RedirectResponse
    {
        //
    }
}
