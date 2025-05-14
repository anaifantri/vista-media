<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Billing;
use App\Models\BillingPayment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Validator;
use Gate;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(String $company_id): Response
    {
        if(Gate::allows('isCollect') && Gate::allows('isAccountingRead')){
            return response()-> view ('payments.index', [
                'payments'=>Payment::where('company_id', $company_id)->filter(request('search'))->year()->month()->sortable()->orderBy("payment_date", "desc")->paginate(30)->withQueryString(),
                'title' => 'Daftar Pembayaran'
            ]);
        } else {
            abort(403);
        }
    }
    
    public function selectBilling(String $companyId): view
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate'))){
            return view ('payments.select-billings', [
                'billings' => Billing::where('company_id', $companyId)->whereDoesntHave('bill_payments')->get(),
                'title' => 'Menambahkan Data Faktur PPN'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(String $billingId): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate'))){
            return  response()-> view ('payments.create', [
                'billing' => Billing::findOrFail($billingId),
                'title' => 'Menambahkan Data Pembayaran'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate'))){
            $validateData = $request->validate([
                'company_id' => 'required',
                'nominal' => 'required',
                'payment_date'=>'required',
                'note'=>'nullable',
                'created_by'=>'required',
                'updated_by'=>'required'
            ]);


            $id = Payment::create($validateData)->id;

            $billingPayment['billing_id'] = $request->billing_id;
            $billingPayment['payment_id'] = $id;
            BillingPayment::insert($billingPayment);

            return redirect('/payments/index/'.$request->company_id)->with('success', 'Data pembayaran berhasil diupload');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment): RedirectResponse
    {
        //
    }
}
