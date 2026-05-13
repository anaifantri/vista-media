<?php

namespace App\Http\Controllers;

use App\Models\ChangeReview;
use App\Models\Quotation;
use App\Models\QuotationAgreement;
use App\Models\QuotationApproval;
use App\Models\QuotationOrder;
use App\Models\QuotationRevision;
use App\Models\QuotationStatus;
use App\Models\Sale;
use App\Models\ChangeSale;
use Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ChangeReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    public function changeReview(String $changeId): view
    {
        if((Gate::allows('isAdmin') || Gate::allows('isAccounting') || Gate::allows('isOwner')) && Gate::allows('isReview')){
            $changeSale = ChangeSale::findOrFail($changeId);
            $sale = Sale::findOrFail($changeSale->sale_id);
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
            $change_review = ChangeReview::with('change_sale')->get();
            $user_review = ChangeReview::with('user')->get();
            return view ('sales-reviews.change-review', [
                'change_sale' => $changeSale,
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
                compact('change_review', 'user_review')
            ]);
        } else {
            abort(403);
        }
    }

    
    public function unReview(String $reviewedId): RedirectResponse
    {
        if((Gate::allows('isAdmin') || Gate::allows('isAccounting') || Gate::allows('isOwner')) && Gate::allows('isReview')){
            $changeReview = ChangeReview::findOrFail($reviewedId);
            $change_sale = ChangeSale::findOrFail($changeReview->change_sale_id);
            $ownerReviewed = false;
            foreach ($change_sale->change_reviews as $review) {
                if ($review->user->division == 'Owner') {
                    $ownerReviewed = true;
                }
            }
            if(auth()->user()->id == $changeReview->user->id){
                if($ownerReviewed == true){
                    return back()->withErrors(['delete' => ['Gagal untuk menghapus konfirmasi, perubahan penjualan telah diperiksa oleh Owner']]);
                }else{
                    ChangeReview::destroy($reviewedId);
                    return redirect('/change-review/'.$changeReview->change_sale_id)->with('success', 'Konfirmasi pemeriksaan penjualan berhasil dihapus');
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
            $user->change_sales()->syncWithoutDetaching([
                $request->change_sale_id => ['note' => $request->note]
            ]);

            return redirect('/change-review/'.$request->company_id.'?month='.$request->change_month.'&year='.$request->change_year)->with('success', 'Konfirmasi pemeriksaan perubahan penjualan berhasil');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ChangeReview $changeReview): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChangeReview $changeReview): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChangeReview $changeReview): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChangeReview $changeReview): RedirectResponse
    {
        //
    }
}
