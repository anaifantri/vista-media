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
}
