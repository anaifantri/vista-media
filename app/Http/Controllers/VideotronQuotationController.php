<?php

namespace App\Http\Controllers;

use App\Models\VideotronQuotation;
use App\Models\VideotronQuotRevision;
use App\Models\VideotronQuotStatus;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Company;
use App\Models\Area;
use App\Models\City;
use App\Models\Size;
use App\Models\Led;
use App\Models\Videotron;
use App\Models\VideotronPhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class VideotronQuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $videotron_quot_statuses = VideotronQuotation::with('videotron_quot_statuses')->get();
        $videotron_quot_revisions = VideotronQuotation::with('videotron_quot_revisions');
        $clients = Client::with('videotron_quotations')->get();
        $companies = Company::with('videotron_quotations')->get();
        
        return response()->view('dashboard.marketing.videotron-quotations.index', [
            'videotron_quotations' => VideotronQuotation::filter(request('search'))->sortable()->paginate(10)->withQueryString(),
            'title' => 'Daftar Penawaran videotron',
            compact('videotron_quot_statuses', 'videotron_quot_revisions', 'clients', 'companies')
        ]);
    }

    public function createQuotation(string $id){
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            // dd($id);
            return response()-> view ('dashboard.marketing.videotron-quotations.create-preview', [
                'videotron'=>Videotron::findOrFail($id),
                'clients'=>Client::orderBy("name", "asc")->get(),
                'areas'=>Area::orderBy("area", "asc")->get(),
                'cities'=>City::orderBy("city", "asc")->get(),
                'contacts'=>Contact::orderBy("name", "asc")->get(),
                'videotron_photo' => VideotronPhoto::where('videotron_id', $id)->get()->last(),
                // 'videotron_photos'=>VideotronPhoto::all(),
                'title' => 'Membuat Penawaran Videotron'
            ]);
        } else {
            abort(403);
        }
    }

    public function preview(string $id): View
    {
        $clients = Client::with('videotron_quotations')->get();
        $companies = Company::with('videotron_quotations')->get();
        $data_quotation = VideotronQuotation::findOrFail($id);

        return view('dashboard.marketing.videotron-quotations.preview', [
            'videotron_quotation' => VideotronQuotation::findOrFail($id),
            'title' => 'Preview Surat Penawaran Videotron',
            'videotron'=>Videotron::findOrFail($data_quotation->videotron_id),
            'videotron_photo' => VideotronPhoto::where('videotron_id', $data_quotation->videotron_id)->get()->last(),
            compact('clients', 'companies')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            return response()-> view ('dashboard.marketing.videotron-quotations.create', [
                'clients'=>Client::orderBy("name", "asc")->get(),
                'areas'=>Area::orderBy("area", "asc")->get(),
                'cities'=>City::orderBy("city", "asc")->get(),
                'contacts'=>Contact::orderBy("name", "asc")->get(),
                'videotrons'=>Videotron::filter(request('search'))->area()->city()->condition()->sortable()->paginate(10)->withQueryString(),
                'title' => 'Membuat Penawaran Billboard'
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
            // Create New Number --> start
            $lastQuotation = VideotronQuotation::all()->last();
            $number = 0;
            $monthRomawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
    
            $month = $monthRomawi[(int)date('m')];
            $year = date('y');
    
            if($lastQuotation){
                $lastNumber = (int)substr($lastQuotation->number,0,4);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
            
            if($newNumber < 10 ){
                $number = '000'.$newNumber.'/APP/Pen-VT/VM/'.$month.'-'.$year;
            } else if($newNumber < 100 ) {
                $number = '00'.$newNumber.'/APP/Pen-VT/VM/'.$month.'-'.$year;
            } else if($newNumber < 1000 ) {
                $number = '0'.$newNumber.'/APP/Pen-VT/VM/'.$month.'-'.$year;
            } else {
                $number = $newNumber.'/APP/Pen-VT/VM/'.$month.'-'.$year;
            }
            // Create New Number --> end

            // Validate Data --> start
            $validateData['company_id'] = 1;
            $validateData['number'] = $number;
            $validateData['attachment'] = $request->attachment;
            $validateData['subject'] = $request->subject;
            $validateData['client_contact'] = $request->client_contact;
            $validateData['contact_email'] = $request->contact_email;
            $validateData['contact_phone'] = $request->contact_phone;
            $validateData['body_top'] = $request->body_top;
            $validateData['products'] = $request->products;
            $validateData['notes'] = $request->notes;
            $validateData['body_end'] = $request->body_end;
            $validateData['client_id'] = $request->client_id;
            $validateData['videotron_id'] = $request->videotron_id;
            $validateData['payment_terms'] = $request->payment_terms;
            $validateData['price'] = $request->price;
            $validateData['created_by'] = $request->created_by;
            // dd($validateData);

            VideotronQuotation::create($validateData); 
            // Validate Data --> end

            // Get Quotation ID --> start
            $dataVideotron = VideotronQuotation::where('number', $validateData['number'])->firstOrFail();

            $validateData['videotron_quotation_id'] = $dataVideotron->id;
            $validateData['status'] = "Created";
            $validateData['updated_by'] = $request->created_by;
            $validateData['description'] = "Surat penawaran videotron dengan nomor".$validateData['number']." telah dibuat dan tersimpan";
            // dd($validateData);
            
            VideotronQuotStatus::create($validateData);
            // Get Quotation ID --> end

            return redirect('/dashboard/marketing/videotron-quotations/preview/'.$dataVideotron->id)->with('success','Surat penawaran videotron dengan nomor '. $validateData['number'] . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(VideotronQuotation $videotronQuotation): Response
    {
        $videotron_quot_statuses = VideotronQuotation::with('videotron_quot_statuses');
        $videotron_quot_revisions = VideotronQuotation::with('videotron_quot_revisions');
        $clients = Client::with('videotron_quotations')->get();
        $companies = Company::with('videotron_quotations')->get();
        $data_quotation = VideotronQuotation::findOrFail($videotronQuotation->id);

        return response()->view('dashboard.marketing.videotron-quotations.show', [
            'videotron_quotation' => $videotronQuotation,
            'title' => 'Preview Videotron Quotation',
            'videotron'=>Videotron::findOrFail($data_quotation->videotron_id),
            'last_quot_statuses' => VideotronQuotStatus::where('videotron_quotation_id', $videotronQuotation->id)->get()->last(),
            'videotron_photo' => VideotronPhoto::where('videotron_id', $data_quotation->videotron_id)->get()->last(),
            compact('clients', 'companies', 'videotron_quot_statuses', 'videotron_quot_revisions')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VideotronQuotation $videotronQuotation): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VideotronQuotation $videotronQuotation): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VideotronQuotation $videotronQuotation): RedirectResponse
    {
        //
    }
}
