<?php

namespace App\Http\Controllers;

use App\Models\WorkReport;
use App\Models\Company;
use App\Models\Sale;
use App\Models\Quotation;
use App\Models\QuotationRevision;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Validator;
use Gate;

class WorkReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(String $company_id): Response
    {
        if(Gate::allows('isCollect') && Gate::allows('isAccountingRead')){
            return response()-> view ('work-reports.index', [
                'work_reports'=>WorkReport::where('company_id', $company_id)->sortable()->orderBy("number", "desc")->paginate(30)->withQueryString(),
                'title' => 'Daftar BAST'
            ]);
        } else {
            abort(403);
        }
    }
        
    public function createWorkReport(String $category): View
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate'))){
            if($category == "media"){
                $data_sales = Sale::billMedia()->get();
            }else if($category == "service"){
                $data_sales = Sale::billService()->get();
            }
            $quotations = Quotation::with('sales')->get();
            $quotation_revisions = QuotationRevision::with('quotation')->get();
            return view ('work-reports.create', [
                'title' => 'Menambahkan Data Penagihan',
                'data_sales' => $data_sales,
                'work_category' => $category,
                compact('quotations', 'quotation_revisions')
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
    public function show(WorkReport $workReport): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkReport $workReport): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorkReport $workReport): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkReport $workReport): RedirectResponse
    {
        //
    }
}
