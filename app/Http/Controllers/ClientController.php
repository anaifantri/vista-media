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
use Gate;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        if(Gate::allows('isClient') && Gate::allows('isMarketingRead')){
            $client_categories = ClientCategory::with('clients')->get();
            $users = User::with('clients')->get();
    
            return response()->view('clients.index', [
                'clients' => Client::filter(request('search'))->sortable()->paginate(10)->withQueryString(),
                'title' => 'Daftar Klien',
                compact('users', 'client_categories')
            ]);
        } else {
            abort(403);
        }
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
        if((Gate::allows('isAdmin') && Gate::allows('isClient') && Gate::allows('isMarketingCreate')) || (Gate::allows('isMarketing') && Gate::allows('isClient') && Gate::allows('isMarketingCreate'))){
            return response()->view('clients.create', [
                'title' => 'Tambah Data Klien',
                'client_categories'=>ClientCategory::all()
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
        if((Gate::allows('isAdmin') && Gate::allows('isClient') && Gate::allows('isMarketingCreate')) || (Gate::allows('isMarketing') && Gate::allows('isClient') && Gate::allows('isMarketingCreate'))){
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
            
            if($newCode < 10 ){
                $code = 'CLI-000'.$newCode;
            } elseif($newCode >= 10 && $newCode < 100){
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
            if($request->phone){
                $rules['phone'] = 'min:8|unique:clients';
            }
            $validateData = $request->validate($rules);
    
            $validateData['client_category_id'] = $request->client_category_id;
    
            if($request->file('logo')){
                $validateData['logo'] = $request->file('logo')->store('client-images');
            }
            
            Client::create($validateData);
            
            return redirect('/marketing/clients')->with('success','Data klien baru dengan nama '. $request->name . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client): Response
    {
        if(Gate::allows('isClient') && Gate::allows('isMarketingRead')){
            return response()->view('clients.show', [
                'client' => $client,
                'contacts' => Contact::all(),
                'title' => 'Detail Klien'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isClient') && Gate::allows('isMarketingEdit')) || (Gate::allows('isMarketing') && Gate::allows('isClient') && Gate::allows('isMarketingEdit'))){
            return response()->view('clients.edit', [
                'client' => $client,
                'client_categories'=>ClientCategory::all(),
                'title' => 'Merubah Data Klien'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isClient') && Gate::allows('isMarketingEdit')) || (Gate::allows('isMarketing') && Gate::allows('isClient') && Gate::allows('isMarketingEdit'))){
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
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isClient') && Gate::allows('isMarketingDelete')) || (Gate::allows('isMarketing') && Gate::allows('isClient') && Gate::allows('isMarketingDelete'))){
            if($client->contacts()->exists()){
                $dataContacts = Contact::where('client_id', $client->id)->get();
                foreach($dataContacts as $contact){
                    if($contact->photo){
                        Storage::delete($contact->photo);
                    }
            
                    Contact::destroy($contact->id);
                }
                if($client->logo){
                    Storage::delete($client->logo);
                }
        
                Client::destroy($client->id);
        
                return redirect('/marketing/clients')->with('success','Klien ' . $client->name . ' berhasil dihapus');
            }else{
                if($client->logo){
                    Storage::delete($client->logo);
                }
        
                Client::destroy($client->id);
        
                return redirect('/marketing/clients')->with('success','Klien ' . $client->name . ' berhasil dihapus');
            }
        } else {
            abort(403);
        }
    }
}
