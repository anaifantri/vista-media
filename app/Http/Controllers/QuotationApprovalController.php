<?php

namespace App\Http\Controllers;

use App\Models\QuotationApproval;
use App\Models\Quotation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Gate;

class QuotationApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    public function showApprovals(String $category, String $quotationId): View
    {
        if(Gate::allows('isSale') && Gate::allows('isMarketingRead')){
            $dataApprovals = QuotationApproval::where('quotation_id', $quotationId)->get();
            $quotation = Quotation::where('id', $quotationId)->get();
            return view('quotation-approvals.show', [
                'quotation_approvals' => $dataApprovals,
                'quotation' => $quotation,
                'category' => $category,
                'title' => 'Dokumen Approval'
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
        
        if((Gate::allows('isAdmin') && Gate::allows('isSale') && Gate::allows('isMarketingCreate')) || (Gate::allows('isMarketing') && Gate::allows('isSale') && Gate::allows('isMarketingCreate'))){
            if($request->file('document_approval')){
                $images = $request->file('document_approval');
                foreach($images as $image){
                    $documentApproval = [];
                    $documentApproval = [
                        'quotation_id' => $request->quotation_id,
                        'image' => $image->store('approval-images')
                    ];
                    QuotationApproval::create($documentApproval);
                }
            }

            return redirect('/marketing/quotation-approvals/show-approvals/'.$request->category.'/'.$request->quotation_id)->with('success', count($request->document_approval).' Dokumen persetujuan berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(QuotationApproval $quotationApproval): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuotationApproval $quotationApproval): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuotationApproval $quotationApproval): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuotationApproval $quotationApproval): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isSale') && Gate::allows('isMarketingDelete')) || (Gate::allows('isMarketing') && Gate::allows('isSale') && Gate::allows('isMarketingDelete'))){
            $quotation_id = $quotationApproval->quotation_id;
            $category = $quotationApproval->quotation->media_category->name;

            if($quotationApproval->image){
                Storage::delete($quotationApproval->image);
            }

            QuotationApproval::destroy($quotationApproval->id);

            return redirect('marketing/quotation-approvals/show-approvals/'.$category.'/'.$quotation_id)->with('success','Dokumen persetujuan berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
