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
        //
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
