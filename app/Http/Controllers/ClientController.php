<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contact;
use App\Models\User;
use App\Models\MediaCategory;
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
        $client_categories = ClientCategory::with('clients')->get();
        $users = User::with('clients')->get();

        return response()->view('clients.index', [
            'clients' => Client::filter(request('search'))->sortable()->paginate(10)->withQueryString(),
            'title' => 'Daftar Klien',
            'categories' => MediaCategory::all(),
            compact('users', 'client_categories')
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
        return response()->view('clients.create', [
            'title' => 'Tambah Data Klien',
            'categories' => MediaCategory::all(),
            'client_categories'=>ClientCategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->client_category_id){
            if ($request->client_category_id == 'pilih'){
                return back()->withErrors(['client_category_id' => ['Silahkan pilih katagori']])->withInput();
            }
        }

        // Set code --> start
        $dataClient = Client::all()->last();
        if($dataClient){
            $lastCode = (int)substr($dataClient->code,4,4);
            $newCode = $lastCode + 1;
        } else {
            $newCode = 1;
        }
        
        if($newCode < 100 ){
            $code = 'CLI-000'.$newCode;
        } elseif($newCode < 10 ){
            $code = 'CLI-00'.$newCode;
        } else {
            $code = 'CLI-0'.$newCode;
        }
        // Set code --> end
        $request->request->add(['code' => $code, 'user_id' => auth()->user()->id]);
        $rules = [
            'code' => 'required|max:255|unique:clients',
            'name' => 'required|max:255|unique:clients',
            'company' => 'min:6|unique:clients',
            'user_id' => 'required',
            'type' => 'required',
            'address' => 'required',
            'logo' => 'image|file|max:1024'
        ];
        if($request->email){
            $rules['email'] = 'email:dns|unique:clients';
        }
        if($request->email){
            $rules['phone'] = 'min:8|unique:clients';
        }
        $validateData = $request->validate($rules);

        $validateData['client_category_id'] = $request->client_category_id;

        if($request->file('logo')){
            $validateData['logo'] = $request->file('logo')->store('client-images');
        }
        
        Client::create($validateData);
        
        return redirect('/marketing/clients')->with('success','Data klien baru dengan nama '. $request->name . ' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client): Response
    {
        return response()->view('clients.show', [
            'client' => $client,
            'contacts' => Contact::all(),
            'categories' => MediaCategory::all(),
            'title' => 'Detail Klien'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client): Response
    {
        return response()->view('clients.edit', [
            'client' => $client,
            'client_categories'=>ClientCategory::all(),
            'categories' => MediaCategory::all(),
            'title' => 'Merubah Data Klien'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client): RedirectResponse
    {
        if($request->client_category_id){
            if ($request->client_category_id == 'pilih'){
                return back()->withErrors(['client_category_id' => ['Silahkan pilih katagori']])->withInput();
            }
        }
        
        $rules = [
            'name' => 'required|max:255',
            'type' => 'required',
            'address' => 'required',
            'logo' => 'image|file|max:1024'
        ];

        if($request->email != $client->email){
            $rules['email'] = 'email:dns|unique:clients';
        }

        if($request->company != $client->company){
            $rules['company'] = 'unique:clients';
        } 

        if($request->phone != $client->phone){
            $rules['phone'] = 'min:10|unique:clients';
        }

        if($request->client_category_id != $client->category){
            $rules['client_category_id'] = 'required';
        }

        $validateData = $request->validate($rules);

        if($request->type == "Perorangan"){
            $validateData['client_category_id'] = null;
            $validateData['company'] = "";
        }


        if($request->file('logo')){
            if($request->oldLogo){
                Storage::delete($request->oldLogo);
            }
            $validateData['logo'] = $request->file('logo')->store('client-images');
        }

        Client::where('id', $client->id)
                ->update($validateData);

        return redirect('/marketing/clients/')->with('success','Klien '. $request->name . ' berhasil di update');
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

        return redirect('/marketing/clients')->with('success','Klien ' . $client->name . ' berhasil dihapus');
    }
}
