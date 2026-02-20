<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalesReviewRequest;
use App\Models\Quotation;
use App\Models\QuotationAgreement;
use App\Models\QuotationApproval;
use App\Models\QuotationOrder;
use App\Models\QuotationRevision;
use App\Models\QuotationStatus;
use App\Models\Sale;
use App\Models\SalesReview;
use Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SalesReviewController extends Controller
{
    public function index(String $companyId): view
    {
        if((Gate::allows('isAdmin') || Gate::allows('isAccounting') || Gate::allows('isOwner')) && Gate::allows('isReview')){
            $sales_review = SalesReview::with('sale')->get();
            $user_review = SalesReview::with('user')->get();
            return view ('sales-reviews.index', [
                'sales'=> Sale::where('company_id', $companyId)->year()->monthReport()->get(),
                'title' => 'Review Penjualan',
                compact('sales_review', 'user_review')
            ]);
        } else {
            abort(403);
        }
    }

    public function store(SalesReviewRequest $request): RedirectResponse
    {
        if((Gate::allows('isAdmin') || Gate::allows('isAccounting') || Gate::allows('isOwner')) && Gate::allows('isReview')){
            $user = auth()->user();
            $user->sales()->syncWithoutDetaching([
                $request->sale_id => ['note' => $request->note]
            ]);

            return redirect('/sales-review/'.$request->company_id.'?month='.$request->sale_month.'&year='.$request->sale_year)->with('success', 'Konfirmasi pemeriksaan penjualan berhasil');
        } else {
            abort(403);
        }
    }

    public function review(String $saleId): view
    {
        if((Gate::allows('isAdmin') || Gate::allows('isAccounting') || Gate::allows('isOwner')) && Gate::allows('isReview')){
            $sale = Sale::findOrFail($saleId);$quotation = Quotation::findOrFail($sale->quotation->id);
            $revision = QuotationRevision::where('quotation_id', $sale->quotation->id)->get()->last();
            if($revision){
                $revisionStatus = true;
                $number = $revision->number;
                $quotId = $revision->id;
                $notes = json_decode($revision->notes);
                $created_at = $revision->created_at;
                $category = $quotation->media_category->name;
                $products = json_decode($revision->products);
                $payment_terms = json_decode($revision->payment_terms);
                $price = json_decode($revision->price);
                $dataApprovals = QuotationApproval::where('quotation_id', $sale->quotation->id)->get();
                $dataAgreements = QuotationAgreement::where('quotation_id', $sale->quotation->id)->get();
                $dataOrders = QuotationOrder::where('quotation_id', $sale->quotation->id)->get();
            } else{
                $revisionStatus = false;
                $number = $quotation->number;
                $quotId = $quotation->id;
                $notes = json_decode($quotation->notes);
                $created_at = $quotation->created_at;
                $category = $quotation->media_category->name;
                $products = json_decode($quotation->products);
                $payment_terms = json_decode($quotation->payment_terms);
                $price = json_decode($quotation->price);
                $lastQuotationStatus = QuotationStatus::where('quotation_id', $sale->quotation->id)->get()->last();
                $dataApprovals = QuotationApproval::where('quotation_id', $sale->quotation->id)->get();
                $dataAgreements = QuotationAgreement::where('quotation_id', $sale->quotation->id)->get();
                $dataOrders = QuotationOrder::where('quotation_id', $sale->quotation->id)->get();
            }
            $clients = json_decode($quotation->clients);
            $sales_review = SalesReview::with('sale')->get();
            $user_review = SalesReview::with('user')->get();
            return view ('sales-reviews.review', [
                'sale'=> $sale,
                'quotation'=>$quotation,
                'quot_id'=>$quotId,
                'revision_status'=>$revisionStatus,
                'number'=>$number,
                'notes'=>$notes,
                'created_at'=>$created_at,
                'products'=>$products,
                'clients'=>$clients,
                'price'=>$price,
                'payment_terms'=>$payment_terms,
                'quotation_approvals'=>$dataApprovals,
                'quotation_agreements'=>$dataAgreements,
                'quotation_orders'=>$dataOrders,
                'title' => 'Review Penjualan',
                compact('sales_review', 'user_review')
            ]);
        } else {
            abort(403);
        }
    }
}
