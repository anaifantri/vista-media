<?php

namespace App\Http\Controllers;

use App\Models\PrintInstallSale;
use App\Models\PrintInstalQuotation;
use App\Models\PrintInstallApproval;
use App\Models\PrintInstallOrder;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Company;
use App\Models\User;
use App\Models\Billboard;
use App\Models\BillboardPhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class PrintInstallSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    public function createSales(string $id): View
    {
        $clients = Client::with('print_instal_quotations')->get();
        $contacts = Contact::with('print_instal_quotations')->get();
        $companies = Company::with('print_instal_quotations')->get();
        $users = User::with('print_instal_quotations')->get();
        $print_install_orders = PrintInstalQuotation::with('print_install_orders')->get();
        $print_install_approvals = PrintInstalQuotation::with('print_install_approvals')->get();
        
        return view('dashboard.marketing.print-install-sales.create', [
            'print_instal_quotation' => PrintInstalQuotation::findOrFail($id),
            'title' => 'Create Print & Instal Sales',
            'billboards' => Billboard::all(),
            'billboard_photos' => BillboardPhoto::all(),
            compact('clients', 'companies','users', 'contacts', 'print_install_approvals', 'print_install_orders')
        ]);
    }

    public function preview(string $id): View
    {
        $clients = Client::with('print_install_sales')->get();
        $contacts = Contact::with('print_install_sales')->get();
        $billboards = Billboard::with('print_install_sales')->get();
        // $billboard_photos = Billboard::with('billboard_photos')->get();
        $companies = Company::with('print_install_sales')->get();
        $print_instal_quotations = PrintInstalQuotation::with('print_install_sales');
        $users = User::with('print_install_sales')->get();

        return view('dashboard.marketing.print-install-sales.preview', [
            'print_install_sales' => PrintInstallSale::where('print_instal_quotation_id', $id)->get(),
            'title' => 'Data Penjualan Cetak dan Pasang',
            'billboard_photos' => BillboardPhoto::all(),
            'print_install_approvals' => PrintInstallApproval::where('print_instal_quotation_id', $id)->get(),
            'print_install_orders' => PrintInstallOrder::where('print_instal_quotation_id', $id)->get(),
            compact('clients', 'companies', 'print_instal_quotations', 'users', 'contacts', 'billboards')
        ]);
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
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){

        $salesData = json_decode($request->sales_data);
        $salesProduct = json_decode($salesData->products);

        foreach($salesProduct->quotationProducts as $products){
            // dd($products);
            $lastSale = PrintInstallSale::all()->last();
            $number = 0;
            $monthRomawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
    
            $month = $monthRomawi[(int)date('m')];
            $year = date('y');
    
            if($lastSale){
                $lastNumber = (int)substr($lastSale->number,0,4);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
            
            if($newNumber < 10 ){
               $number = '000'.$newNumber.'/APP/Print&Install/VM/'.$month.'-'.$year;
            } else if($newNumber < 100 ) {
                $number = '00'.$newNumber.'/APP/Print&Install/VM/'.$month.'-'.$year;
            } else if($newNumber < 1000 ) {
                $number = '0'.$newNumber.'/APP/Print&Install/VM/'.$month.'-'.$year;
            } else {
                $number = $newNumber.'/APP/Print&Install/VM/'.$month.'-'.$year;
            }

            $validateData['number'] = $number;
            $validateData['user_id'] = auth()->user()->id;
            $validateData['company_id'] = $salesData->company_id;
            $validateData['client_id'] = $salesData->client_id;
            $validateData['contact_id'] = $salesData->contact_id;
            $validateData['print_instal_quotation_id'] = $salesData->id;
            $validateData['billboard_id'] = $products->billboard_id;
            $validateData['products'] = json_encode($products);

            // dd($validateData);
            PrintInstallSale::create($validateData);        
        }

        if($request->file('document_po')){
            $images = $request->file('document_po');
            foreach($images as $image){
                $documentPO = [];
                $documentPO = [
                    'print_instal_quotation_id' => $salesData->id,
                    'name' => $request->order_name,
                    'number' => $request->order_number,
                    'order_date' => $request->order_date,
                    'order_image' => $image->store('print-install-order-images')
                ];
                PrintInstallOrder::create($documentPO);
            }
        }

        return redirect('/dashboard/marketing/print-install-sales/preview/'.$salesData->id)->with('success','Data penjualan cetak dan pasang berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PrintInstallSale $printInstallSale): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrintInstallSale $printInstallSale): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrintInstallSale $printInstallSale): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrintInstallSale $printInstallSale): RedirectResponse
    {
        //
    }
}
