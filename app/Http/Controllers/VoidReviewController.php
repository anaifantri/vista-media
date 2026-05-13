<?php

namespace App\Http\Controllers;

use App\Models\VoidReview;
use App\Models\Quotation;
use App\Models\QuotationAgreement;
use App\Models\QuotationApproval;
use App\Models\QuotationOrder;
use App\Models\QuotationRevision;
use App\Models\QuotationStatus;
use App\Models\Sale;
use App\Models\VoidSale;
use Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class VoidReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): view
    {
        //
    }

    public function voidReview(String $voidId): view
    {
        if((Gate::allows('isAdmin') || Gate::allows('isAccounting') || Gate::allows('isOwner')) && Gate::allows('isReview')){
            $voidSale = VoidSale::findOrFail($voidId);
            $sale = Sale::findOrFail($voidSale->sale_id);
            $quotation = Quotation::findOrFail($sale->quotation->id);
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
            $void_review = VoidReview::with('void_sale')->get();
            $user_review = VoidReview::with('user')->get();
            return view ('sales-reviews.void-review', [
                'void_sale' => $voidSale,
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
                compact('void_review', 'user_review')
            ]);
        } else {
            abort(403);
        }
    }

    public function unReview(String $reviewedId): RedirectResponse
    {
        if((Gate::allows('isAdmin') || Gate::allows('isAccounting') || Gate::allows('isOwner')) && Gate::allows('isReview')){
            $voidReview = VoidReview::findOrFail($reviewedId);
            $void_sale = VoidSale::findOrFail($voidReview->void_sale_id);
            $ownerReviewed = false;
            foreach ($void_sale->void_reviews as $review) {
                if ($review->user->division == 'Owner') {
                    $ownerReviewed = true;
                }
            }
            if(auth()->user()->id == $voidReview->user->id){
                if($ownerReviewed == true){
                    return back()->withErrors(['delete' => ['Gagal untuk menghapus konfirmasi, pembatalan penjualan telah diperiksa oleh Owner']]);
                }else{
                    VoidReview::destroy($reviewedId);
                    return redirect('/void-review/'.$voidReview->void_sale_id)->with('success', 'Konfirmasi pemeriksaan pembatalan penjualan berhasil dihapus');
                }
            }else{
                abort(403);
            }
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
        if((Gate::allows('isAdmin') || Gate::allows('isAccounting') || Gate::allows('isOwner')) && Gate::allows('isReview')){
            $user = auth()->user();
            $user->void_sales()->syncWithoutDetaching([
                $request->void_sale_id => ['note' => $request->note]
            ]);

            return redirect('/sales-review/'.$request->company_id.'?month='.$request->void_month.'&year='.$request->void_year)->with('success', 'Konfirmasi pemeriksaan pembatalan penjualan berhasil');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(VoidReview $voidReview): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VoidReview $voidReview): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VoidReview $voidReview): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VoidReview $voidReview): RedirectResponse
    {
        //
    }
}
