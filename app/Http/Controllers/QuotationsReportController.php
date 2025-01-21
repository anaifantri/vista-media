<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\QuotationStatus;
use App\Models\QuotationRevision;
use App\Models\QuotRevisionStatus;
use App\Models\Location;
use App\Models\MediaCategory;
use App\Models\Area;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;
use Gate;

class QuotationsReportController extends Controller
{
    public function index(String $company_id): View
    {
        if(Gate::allows('isQuotation') && Gate::allows('isMarketingRead')){
            $year = date('Y');
            // $month = date('m');
            $mm = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
            for ($i=1; $i <= 12; $i++) { 
                $thisYearQuotation = Quotation::where('company_id', $company_id)->whereYear('created_at', $year)->whereMonth('created_at', $i)->get();
                $monthData[] = $mm[$i];
                $thisYearTotal[] = count($thisYearQuotation);
            }
            $deals = Quotation::where('company_id', $company_id)->year()->deal()->get();
            $closeds = Quotation::where('company_id', $company_id)->year()->closed()->get();
            $createds = Quotation::where('company_id', $company_id)->year()->createds()->get();
            $followups = Quotation::where('company_id', $company_id)->year()->followUp()->get();
            $sents = Quotation::where('company_id', $company_id)->year()->sent()->get();
            $quotationData = [count($createds), count($sents), count($followups),count($deals), count($closeds)];
            $labelData = ['Created', 'Sent', 'Follow Up', 'Deal', 'Closed'];
            $quotation_revisions = QuotationRevision::with('quotation')->get();
            $quot_revision_statuses = QuotRevisionStatus::with('quotation_revision')->get();
            $quotation_statuses = QuotationStatus::with('quotation')->get();
            return view ('quotations-report.index', [
                'media_categories' => MediaCategory::all(),
                'thisYearTotal' => $thisYearTotal,
                'monthData' => $monthData,
                'quotationData' => $quotationData,
                'labelData' => $labelData,
                'todays' => Quotation::where('company_id', $company_id)->whereDate('created_at', Carbon::today())->get(),
                'weekday' => Quotation::where('company_id', $company_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->get(),
                'monthQuots' => Quotation::where('company_id', $company_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get(),
                'yearQuots' => Quotation::where('company_id', $company_id)->whereYear('created_at', Carbon::now()->year)->get(),
                'title' => 'Laporan Penawaran',
                compact('quotation_revisions', 'quotation_statuses', 'quot_revision_statuses')
            ]);
        } else {
            abort(403);
        }
    }

    public function quotationReports(String $categoryId, String $company_id, Request $request): View
    {
        if(Gate::allows('isQuotation') && Gate::allows('isMarketingRead')){
            $quotation_category = MediaCategory::findOrFail($categoryId);
            $media_categories = MediaCategory::with('quotations')->get();
            $quotation_revisions = QuotationRevision::with('quotation')->get();
            $quot_revision_statuses = QuotRevisionStatus::with('quotation_revision')->get();
            $quotation_statuses = QuotationStatus::with('quotation')->get();
            return view ('quotations-report.quotation-reports', [
                'quotations'=>Quotation::where('company_id', $company_id)->where('media_category_id', $categoryId)->filter(request('search'))->sortable()->orderBy("number", "asc")->get(),
                'quotation_category'=>$quotation_category,
                'title' => 'Laporan Penawaran '.$quotation_category->name,
                compact('media_categories','quotation_revisions', 'quotation_statuses', 'quot_revision_statuses')
            ]);
        } else {
            abort(403);
        }
    }
}
