<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
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
        $validateData = $request->validate([
            'name' => 'required|max:255|unique:clients',
            'phone' => 'unique:clients',
            'email' => 'unique:clients',
            'position' => 'required',
            'photo' => 'image|file|max:1024'
        ]);

        $validateData['username'] = auth()->user()->username;
        $validateData['client_name'] = $request->client_name;

        if($request->file('photo')){
            $validateData['photo'] = $request->file('photo')->store('contact-images');
        }

        Contact::create($validateData);

        return redirect('/dashboard/clients/'. $request->client_name)->with('success','Klien baru '. $request->name . ' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        if($contact->photo){
            Storage::delete($contact->photo);
        }

        Contact::destroy($contact->id);

        return redirect('/dashboard/clients/'. $contact->client_name)->with('success','Contact ' . $contact->name . ' berhasil dihapus');
    }
}
