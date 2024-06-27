<?php

namespace App\Http\Controllers;

use App\Models\PrintInstallStatus;
use App\Models\PrintInstallApproval;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class PrintInstallStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
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

            if($request->status == "Deal"){
                if ($request->document_approval == null){
                    return back()->withErrors(['document_approval' => ['Silahkan pilih dokumen approval']])->withInput();
                }
            }
            
            $validateData = $request->validate([
                'status' => 'required',
                'description' => 'required',
                'status_image' => 'image|file|max:1024',
            ]);
    
            // dd($request->billboard_quotation_id);
            
            $validateData['user_id'] = auth()->user()->id;
            $validateData['print_instal_quotation_id'] = $request->print_instal_quotation_id;
                
            PrintInstallStatus::create($validateData);

            if($request->file('document_approval')){
                $images = $request->file('document_approval');
                foreach($images as $image){
                    $documentApproval = [];
                    $documentApproval = [
                        'print_instal_quotation_id' => $validateData['print_instal_quotation_id'],
                        'approval_image' => $image->store('print-install-approval-images')
                    ];
                    PrintInstallApproval::create($documentApproval);
                }
            }
    
            return redirect('/dashboard/marketing/print-instal-quotations/'.$validateData['print_instal_quotation_id'])->with('success','Progress telah di update');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PrintInstallStatus $printInstallStatus): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrintInstallStatus $printInstallStatus): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrintInstallStatus $printInstallStatus): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrintInstallStatus $printInstallStatus): RedirectResponse
    {
        //
    }
}
