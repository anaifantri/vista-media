<?php

namespace App\Http\Controllers;

use App\Models\VideotronQuotation;
use App\Models\VideotronQuotRevision;
use App\Models\VideotronQuotStatus;
use App\Models\Client;
use App\Models\Contact;
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
        $videotron_quot_statuses = VideotronQuotation::with('videotron_quot_statuses');
        $videotron_quot_revisions = VideotronQuotation::with('videotron_quot_revisions');
        
        return response()->view('dashboard.marketing.videotron-quotations.index', [
            'videotron_quotations' => VideotronQuotation::filter(request('search'))->sortable()->paginate(10)->withQueryString(),
            'title' => 'Daftar Penawaran videotron',
            compact('videotron_quot_statuses', 'videotron_quot_revisions')
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
                'videotron_photos'=>VideotronPhoto::all(),
                'title' => 'Membuat Penawaran Videotron'
            ]);
        } else {
            abort(403);
        }
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(VideotronQuotation $videotronQuotation): Response
    {
        //
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
