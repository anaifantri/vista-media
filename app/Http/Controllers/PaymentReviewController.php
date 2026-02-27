<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\PaymentReviewRequest;
use App\Models\Payment;
use App\Models\PaymentReview;
use Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PaymentReviewController extends Controller
{
    public function index(String $companyId): view
    {
        if((Gate::allows('isAdmin') || Gate::allows('isAccounting') || Gate::allows('isOwner')) && Gate::allows('isReview')){
            $payment_review = PaymentReview::with('payment')->get();
            $user_review = PaymentReview::with('user')->get();
            return view ('payment-reviews.index', [
                'payments'=>Payment::where('company_id', $companyId)->yearReport()->monthReport()->sortable()->orderBy("payment_date", "desc")->get(),
                'title' => 'Review Pembayaran',
                compact('payment_review', 'user_review')
            ]);
        } else {
            abort(403);
        }
    }

    public function store(PaymentReviewRequest $request): RedirectResponse
    {
        if((Gate::allows('isAdmin') || Gate::allows('isAccounting') || Gate::allows('isOwner')) && Gate::allows('isReview')){
            $user = auth()->user();
            $user->payments()->syncWithoutDetaching([
                $request->payment_id => ['note' => $request->note]
            ]);

            return redirect('/payment-review/'.$request->company_id.'?month='.$request->payment_month.'&year='.$request->payment_year)->with('success', 'Konfirmasi pemeriksaan pembayaran berhasil');
        } else {
            abort(403);
        }
    }

    public function review(String $paymentId): view
    {
        if((Gate::allows('isAdmin') || Gate::allows('isAccounting') || Gate::allows('isOwner')) && Gate::allows('isReview')){
            $payment = Payment::findOrFail($paymentId);
            return view('payment-reviews.review', [
                'payment' => $payment,
                'title' => 'Review Pembayaran'
            ]);
        } else {
            abort(403);
        }
    }

    public function unReview(String $reviewedId): RedirectResponse
    {
        if((Gate::allows('isAdmin') || Gate::allows('isAccounting') || Gate::allows('isOwner')) && Gate::allows('isReview')){
            $paymentReview = PaymentReview::findOrFail($reviewedId);
            $payment = Payment::findOrFail($paymentReview->payment_id);
            $ownerReviewed = false;
            foreach ($payment->payment_reviews as $review) {
                if ($review->user->division == 'Owner') {
                    $ownerReviewed = true;
                }
            }
            if(auth()->user()->id == $paymentReview->user->id){
                if($ownerReviewed == true){
                    return back()->withErrors(['delete' => ['Gagal untuk menghapus konfirmasi pembayaran, pembayaran telah diperiksa oleh Owner']]);
                }else{
                    PaymentReview::destroy($reviewedId);
                    return redirect('/payment-review/review/'.$paymentReview->payment_id)->with('success', 'Konfirmasi pemeriksaan pembayaran berhasil dihapus');
                }
            }else{
                abort(403);
            }
        } else {
            abort(403);
        }
    }
}
