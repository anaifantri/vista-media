<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use App\Models\SaleCategory;
use App\Models\BillboardQuotation;
use App\Models\BillboardQuotRevision;
use App\Models\BillboardQuotStatus;
use App\Models\ClientApproval;
use App\Models\ClientOrder;
use App\Models\ClientAgreement;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Billboard;
use App\Models\BillboardPhoto;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $clients = Client::with('sales')->get();
        $contacts = Contact::with('sales')->get();
        $billboards = Billboard::with('sales')->get();
        $companies = Company::with('sales')->get();
        $billboard_quotations = BillboardQuotation::with('sales');
        $billboard_quot_revisions = BillboardQuotRevision::with('sales');
        $users = User::with('sales')->get();
        return response()->view('dashboard.marketing.sales.index', [
            'sales' => Sale::filter(request('search'))->sortable()->paginate(10)->withQueryString(),
            'title' => 'Daftar Penjualan',
            'client_agreements' => ClientAgreement::all(),
            'client_orders' => ClientOrder::all(),
            compact('clients', 'billboards', 'companies', 'billboard_quotations', 'billboard_quot_revisions', 'users', 'contacts')
        ]);
    }

    public function reports(): View
    {
        $clients = Client::with('sales')->get();
        $contacts = Contact::with('sales')->get();
        $billboards = Billboard::with('sales')->get();
        $companies = Company::with('sales')->get();
        $billboard_quotations = BillboardQuotation::with('sales');
        $billboard_quot_revisions = BillboardQuotRevision::with('sales');
        $users = User::with('sales')->get();
        return view('dashboard.marketing.sales.reports', [
            'sales' => Sale::filter(request('search'))->sortable()->paginate(10)->withQueryString(),
            'title' => 'Daftar Penjualan',
            'client_agreements' => ClientAgreement::all(),
            'client_orders' => ClientOrder::all(),
            compact('clients', 'billboards', 'companies', 'billboard_quotations', 'billboard_quot_revisions', 'users', 'contacts')
        ]);
    }

    public function showSale(){
        $dataSale = Sale::all();
        return response()->json(['dataSale'=> $dataSale]);
    }

    public function preview(): View
    {
        $clients = Client::with('sales')->get();
        $contacts = Contact::with('sales')->get();
        $billboards = Billboard::with('sales')->get();
        $companies = Company::with('sales')->get();
        $billboard_quotations = BillboardQuotation::with('sales');
        $billboard_quot_revisions = BillboardQuotRevision::with('sales');
        $users = User::with('sales')->get();

        return view('dashboard.marketing.sales.preview', [
            'sales' => Sale::all(),
            'title' => 'Data Penjualan',
            'client_agreements' => ClientAgreement::all(),
            'client_orders' => ClientOrder::all(),
            compact('clients', 'billboards', 'companies', 'billboard_quotations', 'billboard_quot_revisions', 'users', 'contacts')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            return response()-> view ('dashboard.marketing.sales.create', [
                'sales'=>Sale::all(),
                'sale_categories'=>SaleCategory::all(),
                'billboard_quotations'=>BillboardQuotation::all(),
                'billboard_quot_revisions'=>BillboardQuotRevision::all(),
                'billboard_quot_statuses'=>BillboardQuotStatus::all(),
                'client_approval'=>ClientApproval::all(),
                'title' => 'Input Data Penjualan'
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
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            
            $salesData = json_decode($request->sales_value);
            $sales = [];
            $quotRevisonId = "";
            $quotationId = "";
            $saleStartAt = "";
            $saleEndAt = "";

            foreach($salesData->sales as $saleData){
                if($saleData->billboard_quot_revision_id == ""){
                    $quotRevisonId = null;
                } else {
                    $quotRevisonId = $saleData->billboard_quot_revision_id;
                }
            
                if($saleData->billboard_quotation_id == ""){
                    $quotationId = null;
                } else {
                    $quotationId = $saleData->billboard_quotation_id;
                }

                if($saleData->start_at == ""){
                    $saleStartAt = null;
                } else {
                    $saleStartAt = $saleData->start_at;
                }
                
                if($saleData->end_at == ""){
                    $saleEndAt = null;
                } else {
                    $saleEndAt = $saleData->end_at;
                }

                $sales[] = [
                    'number' => $saleData->number,
                    'date' => $saleData->date,
                    'user_id' => auth()->user()->id,
                    'company_id' => $saleData->company_id,
                    'client_approvals' => $saleData->client_approvals,
                    'client_orders' => $saleData->client_orders,
                    'client_agreements' => $saleData->client_agreements,
                    'client_id' => $saleData->client_id,
                    'client_company' => $saleData->client_company,
                    'client_name' => $saleData->client_name,
                    'client_address' => $saleData->client_address,
                    'contact_id' => $saleData->contact_id,
                    'contact_name' => $saleData->contact_name,
                    'contact_email' => $saleData->contact_email,
                    'contact_phone' => $saleData->contact_phone,
                    'billboard_id' => $saleData->billboard_id,
                    'billboard_code' => $saleData->billboard_code,
                    'billboard_address' => $saleData->billboard_address,
                    'billboard_category' => $saleData->billboard_category,
                    'billboard_lighting' => $saleData->billboard_lighting,
                    'billboard_size' => $saleData->billboard_size,
                    'billboard_orientation' => $saleData->billboard_orientation,
                    'billboard_photo' => $saleData->billboard_photo,
                    'quot_number' => $saleData->quot_number,
                    'quot_date' => $saleData->quot_date,
                    'price' => $saleData->price,
                    'dpp' => $saleData->dpp,
                    'category' => $saleData->category,
                    'duration' => $saleData->duration,
                    'terms_of_payment' => $saleData->terms_of_payment,
                    'free_instalation' => $saleData->free_instalation,
                    'free_print' => $saleData->free_print,
                    'billboard_quotation_id' => $quotationId,
                    'billboard_quot_revision_id' => $quotRevisonId,
                    'start_at' => $saleStartAt,
                    'end_at' => $saleEndAt
                    
                ];
                $validateData['number'] = $saleData->number;
                $validateData['user_id'] = auth()->user()->id;
                $validateData['company_id'] = $saleData->company_id;
                $validateData['client_id'] = $saleData->client_id;
                $validateData['contact_id'] = $saleData->contact_id;
                $validateData['billboard_id'] = $saleData->billboard_id;
                $validateData['price'] = $saleData->price;
                $validateData['dpp'] = $saleData->dpp;
                $validateData['category'] = $saleData->category;
                $validateData['duration'] = $saleData->duration;
                $validateData['terms_of_payment'] = $saleData->terms_of_payment;
                $validateData['free_instalation'] = $saleData->free_instalation;
                $validateData['free_print'] = $saleData->free_print;
                $validateData['billboard_quotation_id'] = $quotationId;
                $validateData['billboard_quot_revision_id'] = $quotRevisonId;
                $validateData['start_at'] = $saleStartAt;
                $validateData['end_at'] = $saleEndAt;
                Sale::create($validateData);
            }
            // Sale::create($sales);

            if($request->file('document_po')){
                $images = $request->file('document_po');
                foreach($images as $image){
                    $documentPO = [];
                    $documentPO = [
                        'billboard_quotation_id' => $quotationId,
                        'billboard_quot_revision_id' => $quotRevisonId,
                        'name' => $request->order_name,
                        'number' => $request->order_number,
                        'order_date' => $request->order_date,
                        'order_image' => $image->store('order-images')
                    ];
                    ClientOrder::create($documentPO);
                }
            }

            if($request->file('document_agreement')){
                $images = $request->file('document_agreement');
                foreach($images as $image){
                    $documentAgreement = [];
                    $documentAgreement = [
                        'billboard_quotation_id' => $quotationId,
                        'billboard_quot_revision_id' => $quotRevisonId,
                        'number' => $request->agreement_number,
                        'date' => $request->agreement_date,
                        'agreement_image' => $image->store('agreement-images')
                    ];
                    ClientAgreement::create($documentAgreement);
                }
            }

            $saleAll = Sale::all();
            $salesId = [];
            $salesNumber = [];
            $i = 0;
            foreach($sales as $sale){
                $saleNumber[$i] = $sale['number'];

                foreach($saleAll as $data){
                    if($data->number == $saleNumber[$i]){
                        $salesId[$i] = $data->id;
                    }
                }

                $i = $i + 1;
            }

            return redirect('/sales/preview/')->with('success','Data penjualan berhasil ditambahkan')->with(['sales_store' => $sales, 'sales_id' => $salesId]);
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale): Response
    {
        $clients = Client::with('sales')->get();
        $contacts = Contact::with('sales')->get();
        $billboards = Billboard::with('sales')->get();
        $companies = Company::with('sales')->get();
        $billboard_quotations = BillboardQuotation::with('sales');
        $billboard_quot_revisions = BillboardQuotRevision::with('sales');
        $users = User::with('sales')->get();

        return response()->view('dashboard.marketing.sales.show', [
            'sale' => $sale,
            'title' => 'Detail Penjualan',
            'client_agreements' => ClientAgreement::all(),
            'client_orders' => ClientOrder::all(),
            'client_approvals' => ClientApproval::all(),
            'billboard_photos' => BillboardPhoto::all(),
            compact('clients', 'billboards', 'companies', 'billboard_quotations', 'billboard_quot_revisions', 'users', 'contacts')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale): RedirectResponse
    {
        if($request->start_at && $request->end_at){
            $validateData['start_at'] = $request->start_at;
            $validateData['end_at'] = $request->end_at;

            Sale::where('id', $sale->id)
                ->update($validateData);

            return redirect('/dashboard/marketing/sales/')->with('success','Data Penjualan '. $sale->number . ' berhasil di update');
        }else{
            return redirect('/dashboard/marketing/sales/')->with('failed','Data Penjualan '. $sale->number . ' gagal diupdate, ada data update yang belum diinput');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale): RedirectResponse
    {
        //
    }
}
