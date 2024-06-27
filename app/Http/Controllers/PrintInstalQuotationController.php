<?php

namespace App\Http\Controllers;

use App\Models\PrintInstalQuotation;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Company;
use App\Models\Sale;
use App\Models\WOPrint;
use App\Models\WOInstall;
use App\Models\User;
use App\Models\Billboard;
use App\Models\BillboardPhoto;
use App\Models\PrintingProduct;
use App\Models\InstallationPrice;
use App\Models\PrintInstallStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PrintInstalQuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()->view('dashboard.marketing.print-instal-quotations.index', [
            'print_instal_quotations' => PrintInstalQuotation::filter(request('search'))->sortable()->paginate(10)->withQueryString(),
            'print_install_statuses' => PrintInstallStatus::all(),
            'title' => 'Daftar Penawaran Cetak dan Pasang'
        ]);
    }

    public function preview(string $id): View
    {
        $clients = Client::with('print_instal_quotations')->get();
        $contacts = Contact::with('print_instal_quotations')->get();

        return view('dashboard.marketing.print-instal-quotations.preview', [
            'print_instal_quotation' => PrintInstalQuotation::findOrFail($id),
            'title' => 'Preview Print & Install Quotation',
            'companies'=>Company::all(),
            compact('clients', 'contacts')
        ]);
    }

    public function createQuotation(string $id): View
    {
        $clients = Client::with('sales')->get();
        $contacts = Contact::with('sales')->get();
        $companies = Company::with('sales')->get();
        $users = User::with('sales')->get();
        $billboards = Billboard::with('sales')->get();
        $billboard_photos = Billboard::with('billboard_photos')->get();
        
        return view('dashboard.marketing.print-instal-quotations.create-quotations', [
            'billboard_sale' => Sale::findOrFail($id),
            'title' => 'Create Print & Instal Quotation',
            'w_o_prints' => WOPrint::all(),
            'w_o_installs' => WOInstall::all(),
            'printing_products' => PrintingProduct::all(),
            'contacts' => Contact::all(),
            compact('clients', 'companies','users', 'contacts', 'billboards', 'billboard_photos')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            return response()-> view ('dashboard.marketing.print-instal-quotations.create', [
                'clients'=>Client::orderBy("name", "asc")->get(),
                'contacts'=>Contact::orderBy("name", "asc")->get(),
                'printing_products'=>PrintingProduct::all(),
                'installation_prices'=>InstallationPrice::all(),
                'w_o_installs' => WOInstall::all(),
                'w_o_prints' => WOPrint::all(),
                'sales' => Sale::filter(request('search'))->sortable()->paginate(10)->withQueryString(),
                'title' => 'Membuat Penawaran Cetak & Pasang'
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
            // dd($request->products);
            $validateData = $request->validate([
                'client_id' => 'required',
                'contact_id' => 'required',
                'products' => 'required',
                'company_id' => 'required'
            ]);

            $validateData['user_id'] = auth()->user()->id;

            $quotationData = PrintInstalQuotation::all()->last();
            $number = 0;
            $monthRomawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];

            $month = $monthRomawi[(int)date('m')];
            $year = date('y');

            if($quotationData){
                $lastNumber = (int)substr($quotationData->number,0,4);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
            
            if($newNumber < 10 ){
                $number = '000'.$newNumber.'/VM/Print&Install/'.$month.'-'.$year;
            } else if($newNumber < 100 ) {
                $number = '00'.$newNumber.'/VM/Print&Install/'.$month.'-'.$year;
            } else if($newNumber < 1000 ) {
                $number = '0'.$newNumber.'/VM/Print&Install/'.$month.'-'.$year;
            } else {
                $number = $newNumber.'/VM/Print&Install/'.$month.'-'.$year;
            }

            $validateData['number'] = $number;
            // dd($validateData);
    
            PrintInstalQuotation::create($validateData);
            
            $dataQuotations = PrintInstalQuotation::all();
            $quotId = 0;
            foreach ($dataQuotations as $quotation) {
                if($quotation->number == $validateData['number']){
                    $quotId = $quotation->id;
                }
            }

            $validateData['print_instal_quotation_id'] = $quotId;
            $validateData['status'] = "Created";
            $validateData['description'] = "Surat penawaran cetak dan pasang telah dibuat dan tersimpan";
            
            PrintInstallStatus::create($validateData);
            
            return redirect('/dashboard/marketing/print-instal-quotations/preview/'.$quotId)->with('success','Surat penawaran cetak dan pasang dengan nomor '. $validateData['number'] . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PrintInstalQuotation $printInstalQuotation): Response
    {
        $print_install_statuses = PrintInstalQuotation::with('print_install_statuses');
        
        $clients = Client::with('print_instal_quotations')->get();
        $contacts = Contact::with('print_instal_quotations')->get();
        $companies = Company::with('print_instal_quotations')->get();

        return response()-> view('dashboard.marketing.print-instal-quotations.show', [
            'print_instal_quotation' => $printInstalQuotation,
            'title' => 'Preview Print & Install Quotation',
            compact('clients', 'contacts','print_install_statuses','companies')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrintInstalQuotation $printInstalQuotation): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrintInstalQuotation $printInstalQuotation): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrintInstalQuotation $printInstalQuotation): RedirectResponse
    {
        //
    }
}
