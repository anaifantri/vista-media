<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Billing;
use App\Models\BillingPayment;
use App\Models\IncomeTax;
use App\Models\OtherFee;
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
                'payments'=>Payment::where('company_id', $company_id)->filter(request('search'))->yearReport()->monthReport()->sortable()->orderBy("payment_date", "desc")->paginate(30)->withQueryString(),
                'title' => 'Daftar Pembayaran'
            ]);
        } else {
            abort(403);
        }
    }

    public function report(String $company_id): Response
    {
        if(Gate::allows('isCollect') && Gate::allows('isAccountingRead')){
            return response()-> view ('payments.payment-report', [
                'payments'=>Payment::where('company_id', $company_id)->filter(request('search'))->yearReport()->monthReport()->sortable()->orderBy("payment_date", "asc")->get(),
                'billing_total'=>Billing::where('company_id', $company_id)->whereHas('bill_payments')->filter(request('search'))->year()->month()->sum('nominal'),
                'title' => 'Laporan Kas Masuk'
            ]);
        } else {
            abort(403);
        }
    }
    
    public function selectBilling(String $companyId): view
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingCreate'))){
            return view ('payments.select-billings', [
                'billings' => Billing::where('company_id', $companyId)->get(),
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
                'billings' => Billing::whereIn('id', json_decode($billingId))->get(),
                'billing_id' => $billingId,
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
            // dd(request('billing_nominal'));
            $validateData = $request->validate([
                'company_id' => 'required',
                'nominal' => 'required',
                'sale_nominal' => 'required',
                'billing_nominal' => 'required',
                'payment_date'=>'required',
                'note'=>'nullable',
                'created_by'=>'required',
                'updated_by'=>'required'
            ]);

            $id = Payment::create($validateData)->id;

            foreach (json_decode(request('billing_id')) as $billingId) {
                $billingPayment['billing_id'] = $billingId;
                $billingPayment['payment_id'] = $id;
                BillingPayment::insert($billingPayment);
            }

            foreach(json_decode(request('data_pph')) as $itemPph){
                if($itemPph->pph != 0){
                    $dataPph['company_id'] = request('company_id');
                    $dataPph['payment_id'] = $id;
                    $dataPph['billing_id'] = $itemPph->billing_id;
                    $dataPph['sale_id'] = $itemPph->sale_id;
                    $dataPph['nominal'] = $itemPph->pph;
                    IncomeTax::create($dataPph);
                }
            }

            if(request('other_fee') != 0){
                $dataOtherFee['company_id'] = request('company_id');
                $dataOtherFee['payment_id'] = $id;
                $dataOtherFee['nominal'] = request('other_fee');
                OtherFee::create($dataOtherFee);
            }

            return redirect('/payments/index/'.$request->company_id)->with('success', 'Data pembayaran berhasil diinput');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment): Response
    {
        if(Gate::allows('isCollect') && Gate::allows('isAccountingRead')){
            return response()-> view('payments.show', [
                'payment' => $payment,
                'title' => 'Detail Pembayaran'
            ]);
        } else {
            abort(403);
        }
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
