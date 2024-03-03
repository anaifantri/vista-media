<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contact;
use App\Models\User;
use App\Models\ClientCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()->view('dashboard.marketing.clients.index', [
            'clients' => Client::filter(request('search'))->sortable()->paginate(10)->withQueryString(),
            'title' => 'Daftar Klien'
        ]);
    }

    public function showClient(){
        $dataClient = Client::All();

        return response()->json(['dataClient'=> $dataClient]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('dashboard.marketing.clients.create', [
            'title' => 'Tambah Klien',
            'client_categories'=>ClientCategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->client_category_id == 'Pilih Katagori'){
            return back()->withErrors(['client_category_id' => ['Silahkan pilih katagori']])->withInput();
        }
    
        $validateData = $request->validate([
            'name' => 'required|max:255|unique:clients',
            'company' => 'required|min:6|unique:clients',
            'phone' => 'min:10|unique:clients',
            'email' => 'email:dns|unique:clients',
            'address' => 'required',
            'client_category_id' => 'required',
            'logo' => 'image|file|max:1024'
        ]);

        if($request->file('logo')){
            $validateData['logo'] = $request->file('logo')->store('client-images');
        }
        $validateData['user_id'] = auth()->user()->id;
        
        Client::create($validateData);
        
        return redirect('/dashboard/marketing/clients')->with('success','Klien baru '. $request->name . ' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client): Response
    {
        return response()->view('dashboard.marketing.clients.show', [
            'client' => $client,
            'contacts' => Contact::all(),
            'title' => 'Detail Klien'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client): Response
    {
        return response()->view('dashboard.marketing.clients.edit', [
            'client' => $client,
            'client_categories'=>ClientCategory::all(),
            'title' => 'Edit Klien'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client): RedirectResponse
    {
        if ($request->client_category_id == 'Pilih Katagori'){
            return back()->withErrors(['client_category_id' => ['Silahkan pilih katagori']])->withInput();
        }
        
        $rules = [
            'name' => 'required|max:255',
            'address' => 'required',
            'logo' => 'image|file|max:1024'
        ];

        if($request->email != $client->email){
            $rules['email'] = 'email:dns|unique:clients';
        }

        if($request->company != $client->company){
            $rules['company'] = 'required|unique:clients';
        } 

        if($request->phone != $client->phone){
            $rules['phone'] = 'min:10|unique:clients';
        }

        if($request->client_category_id != $client->category){
            $rules['client_category_id'] = 'required';
        }

        $validateData = $request->validate($rules);


        if($request->file('logo')){
            if($request->oldLogo){
                Storage::delete($request->oldLogo);
            }
            $validateData['logo'] = $request->file('logo')->store('client-images');
        }

        Client::where('id', $client->id)
                ->update($validateData);

        return redirect('/dashboard/marketing/clients/' . $client->id)->with('success','Klien '. $request->name . ' berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client): RedirectResponse
    {
        if($client->logo){
            Storage::delete($client->logo);
        }

        Client::destroy($client->id);

        return redirect('/dashboard/marketing/clients')->with('success','Klien ' . $client->name . ' berhasil dihapus');
    }
}
