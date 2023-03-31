<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contact;
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
            'clients' => Client::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('dashboard.marketing.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->category == 'Pilih Katagori'){
            return back()->withErrors(['category' => ['Silahkan pilih katagori']])->withInput();
        }
       
        $validateData = $request->validate([
            'name' => 'required|max:255|unique:clients',
            'company' => 'required|min:6|unique:clients',
            'phone' => 'unique:clients',
            'email' => 'unique:clients',
            'address' => 'required',
            'category' => 'required',
            'logo' => 'image|file|max:1024'
        ]);

        if($request->file('logo')){
            $validateData['logo'] = $request->file('logo')->store('client-images');
        }
        $validateData['username'] = auth()->user()->username;
        
        Client::create($validateData);
        
        return redirect('/dashboard/clients')->with('success','Klien baru '. $request->name . ' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client): Response
    {
        return response()->view('dashboard.marketing.clients.show', [
            'client' => $client,
            'contacts' => Contact::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client): Response
    {
        return response()->view('dashboard.marketing.clients.edit', [
            'client' => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client): RedirectResponse
    {
        $rules = [
            'name' => 'required|max:255',
            'address' => 'required',
            'logo' => 'image|file|max:1024'
        ];

        if($request->email != $client->email){
            $rules['email'] = 'unique:clients';
        }

        if($request->company != $client->company){
            $rules['company'] = 'required|unique:clients';
        } 

        if($request->phone != $client->phone){
            $rules['phone'] = 'unique:users';
        }

        if($request->category != $client->category){
            $rules['category'] = 'required';
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

        return redirect('/dashboard/clients')->with('success','Klien '. $request->name . ' berhasil di update');
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

        return redirect('/dashboard/clients')->with('success','Klien ' . $client->name . ' berhasil dihapus');
    }
}
