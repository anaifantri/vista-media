<?php

namespace App\Http\Controllers;

use App\Models\ClientGroup;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()-> view ('client-groups.index', [
            'client_groups'=>ClientGroup::filter(request('search'))->sortable()->with(['user'])->paginate(10)->withQueryString(),
            'title' => 'Daftar Group Client'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Marketing'){
            return response()-> view ('client-groups.create', [
                'title' => 'Menambahkan Group Klien',
                'clients' => Client::all()
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
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Marketing'){
            $request->request->add(['user_id' => auth()->user()->id]);
            $validateData = $request->validate([
                'group' => 'required|unique:client_groups',
                'user_id' => 'required',
                'member' => 'required'
            ]);
            ClientGroup::create($validateData);
    
            return redirect('/marketing/client-groups')->with('success','Data group client dengan nama '. $request->group . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ClientGroup $clientGroup): Response
    {
        return response()-> view ('client-groups.show', [
            'client_group' => $clientGroup,
            'title' => 'Detail Group Klien ' . $clientGroup->group
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClientGroup $clientGroup): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Marketing'){
            return response()->view('client-groups.edit', [
                'client_group' => $clientGroup,
                'title' => 'Edit Group Klien',
                'clients' => Client::all()
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClientGroup $clientGroup): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Marketing'){
            $request->request->add(['user_id' => auth()->user()->id]);
            $rules = [
                'user_id' => 'required',
                'member' => 'required'
            ];
            
            if ($request->group != $clientGroup->group) {
                $rules['group'] = 'required|unique:client_groups';
            } 

            $validateData = $request->validate($rules);
            // dd($validateData);
                
            ClientGroup::where('id', $clientGroup->id)
                ->update($validateData);
        
            return redirect('/marketing/client-groups')->with('success','Group klien dengan nama '. $clientGroup->group . ' berhasil diupdate');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClientGroup $clientGroup): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Marketing'){
            ClientGroup::destroy($clientGroup->id);

            return redirect('/marketing/client-groups')->with('success','Group klien dengan nama '. $clientGroup->group .' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
