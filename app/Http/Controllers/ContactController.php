<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Client;
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
        if ($request->gender == 'pilih'){
            return back()->withErrors(['gender' => ['Silahkan pilih jenis kelamin']])->withInput();
        }
        $request->request->add(['client_id' => $request->client_id, 'user_id' => auth()->user()->id]);
        $rules = [
            'user_id' => 'required',
            'client_id' => 'required',
            'gender' => 'required',
            'name' => 'required|max:255',
            'photo' => 'image|file|max:1024'
        ];
        if($request->email){
            $rules['email'] = 'email:dns|unique:contacts';
        }
        if($request->phone){
            $rules['phone'] = 'min:10|max:15|unique:contacts';
        }

        $validateData = $request->validate($rules);
        $validateData['position'] = $request->position;

        if($request->file('photo')){
            $validateData['photo'] = $request->file('photo')->store('contact-images');
        }

        Contact::create($validateData);

        return redirect('/media/clients/'. $request->client_id)->with('success','Kontak baru dengan nama '. $request->name . ' berhasil ditambahkan');
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
        return response()->view('contacts.edit', [
            'contact' => $contact,
            'title' => 'Edit Kontak Person'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact): RedirectResponse
    {
        $request->request->add(['client_id' => $request->client_id, 'user_id' => auth()->user()->id]);
        $rules = [
            'user_id' => 'required',
            'client_id' => 'required',
            'gender' => 'required',
            'name' => 'required|max:255',
            'photo' => 'image|file|max:1024'
        ];

        if($request->email){
            if($request->email != $contact->email){
                $rules['email'] = 'email:dns|unique:contacts';
            } 
        }elseif($contact->email){
            $rules['email'] = '';
        }

        if($request->phone){
            if($request->phone != $contact->phone){
                $rules['phone'] = 'min:10|max:15|unique:contacts';
            }
        }elseif($contact->phone){
            $rules['phone'] = '';
        }

        $validateData = $request->validate($rules);
        $validateData['position'] = $request->position;

        if($request->file('photo')){
            if($request->oldPhoto){
                Storage::delete($request->oldPhoto);
            }
            $validateData['photo'] = $request->file('photo')->store('contact-images');
        }

        Contact::where('id', $contact->id)
                ->update($validateData);

        return redirect('/media/clients/'. $request->client_id)->with('success','Kontak person dengan nama '. $request->name . ' berhasil dirubah');
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

        return redirect('/media/clients/'. $contact->client_id)->with('success','Kontak person dengan nama' . $contact->name . ' berhasil dihapus');
    }

    /**
     * Convert contact data to json.
     */
    public function getContacts(String $id){
        $contacts = Contact::whereHas('client', function($query) use ($id){
            $query->where('id', '=', $id);
        })->get();

        return response()->json(['contacts'=> $contacts]);
    }
}


