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

            return redirect('/payments/index/'.$request->company_id.'?month='.(int) date('m', strtotime($request->payment_date)).'&year='.date('Y', strtotime($request->payment_date)))->with('success', 'Data pembayaran berhasil diinput');
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
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingEdit')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingEdit'))){
            $billings = $payment->billings;
            $income_taxes = $payment->income_taxes;
            return  response()-> view ('payments.edit', [
                'payment' => $payment,
                'income_taxes' => $income_taxes,
                'billings' => $billings,
                'title' => 'Edit Data Pembayaran'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isCollect') && Gate::allows('isAccountingEdit')) || (Gate::allows('isAccounting') && Gate::allows('isCollect') && Gate::allows('isAccountingEdit'))){
            $rules = [
                'note' => 'nullable',
                'nominal' => 'required',
                'updated_by' => 'required',
                'payment_date' => 'required'
            ];

            $validateData = $request->validate($rules);
            $income_taxes = json_decode(request('income_taxes'));
            $data_pph = json_decode(request('data_pph'));
            $other_fee = json_decode(request('other_fee'));
            if(count($income_taxes) != 0){
                foreach($income_taxes as $incomeTax){
                    if($incomeTax->nominal != 0){
                        $dataIncomeTax['nominal'] = $incomeTax->nominal;
                        IncomeTax::where('id', $incomeTax->id)
                        ->update($dataIncomeTax);
                    }else{
                        IncomeTax::destroy($incomeTax->id);
                    }
                }
            }
            if(count($data_pph) != 0){
                foreach($data_pph as $itemPph){
                    if($itemPph->nominal != 0){
                        $dataPph['company_id'] = $itemPph->company_id;
                        $dataPph['payment_id'] = $payment->id;
                        $dataPph['billing_id'] = $itemPph->billing_id;
                        $dataPph['sale_id'] = $itemPph->sale_id;
                        $dataPph['nominal'] = $itemPph->nominal;
                        IncomeTax::create($dataPph);
                    }
                }
            }
            if(isset($other_fee->id)){
                if($other_fee->nominal != 0){
                    $dataOtherFee['nominal'] = $other_fee->nominal;
                    OtherFee::where('id', $other_fee->id)
                    ->update($dataOtherFee);
                }else{
                    OtherFee::destroy($other_fee->id);
                }
            }else{
                if($other_fee->nominal !=0){
                    $dataOtherFee['company_id'] = $other_fee->company_id;
                    $dataOtherFee['payment_id'] = $other_fee->payment_id;
                    $dataOtherFee['nominal'] = $other_fee->nominal;
                    OtherFee::create($dataOtherFee);
                }
            }

            Payment::where('id', $payment->id)
                ->update($validateData);
        
            return redirect('/accounting/payments/'.$payment->id)->with('success','Data pembayaran berhasil dirubah');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment): RedirectResponse
    {
        //
    }
}
