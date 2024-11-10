<?php

namespace App\Http\Controllers;

use App\Models\ClientCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Gate;

class ClientCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        if(Gate::allows('isClient') && Gate::allows('isMarketingRead')){
            return response()-> view ('client-categories.index', [
                'client_categories'=>ClientCategory::filter(request('search'))->sortable()->with(['user'])->orderBy("code", "asc")->paginate(10)->withQueryString(),
                'title' => 'Daftar Katagori Media'
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
        if((Gate::allows('isAdmin') && Gate::allows('isClient') && Gate::allows('isMarketingCreate')) || (Gate::allows('isMarketing') && Gate::allows('isClient') && Gate::allows('isMarketingCreate'))){
            return response()-> view ('client-categories.create', [
                'title' => 'Menambahkan Katagori Klien'
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
            $dataCategory = ClientCategory::all()->last();
            if($dataCategory){
                $lastCode = (int)substr($dataCategory->code,3,3);
                $newCode = $lastCode + 1;
            } else {
                $newCode = 1;
            }
            
    
            if($newCode < 10 ){
                $code = 'CL-00'.$newCode;
            } else {
                $code = 'CL-0'.$newCode;
            }
            // Set code --> end

            $request->request->add(['code' => $code, 'user_id' => auth()->user()->id]);
            $validateData = $request->validate([
                'code' => 'required|unique:client_categories',
                'name' => 'required|unique:client_categories',
                'user_id' => 'required',
                'description' => 'required'
            ]);
            
            ClientCategory::create($validateData);
    
            return redirect('/marketing/client-categories')->with('success','Katagori klien dengan nama '. $request->name . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ClientCategory $clientCategory): Response
    {
        if(Gate::allows('isClient') && Gate::allows('isMarketingRead')){
            return response()-> view ('client-categories.show', [
                'client_category' => $clientCategory,
                'title' => 'Detail Katagori Klien' . $clientCategory->name
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClientCategory $clientCategory): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isClient') && Gate::allows('isMarketingEdit')) || (Gate::allows('isMarketing') && Gate::allows('isClient') && Gate::allows('isMarketingEdit'))){
            return response()->view('client-categories.edit', [
                'client_category' => $clientCategory,
                'title' => 'Edit Katagori Klien'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClientCategory $clientCategory): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isClient') && Gate::allows('isMarketingEdit')) || (Gate::allows('isMarketing') && Gate::allows('isClient') && Gate::allows('isMarketingEdit'))){
            $request->request->add(['user_id' => auth()->user()->id]);
            $rules = [
                'user_id' => 'required',
                'description' => 'required'
            ];
            
            if ($request->name != $clientCategory->name) {
                $rules['name'] = 'required|unique:media_categories';
            } 

            $validateData = $request->validate($rules);
                
            ClientCategory::where('id', $clientCategory->id)
                ->update($validateData);
        
            return redirect('/marketing/client-categories')->with('success','Katagori klien dengan nama '. $clientCategory->name . ' berhasil diupdate');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClientCategory $clientCategory): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isClient') && Gate::allows('isMarketingDelete')) || (Gate::allows('isMarketing') && Gate::allows('isClient') && Gate::allows('isMarketingDelete'))){
            if($clientCategory->clients()->exists()){
                return back()->withErrors(['delete' => ['Gagal untuk menghapus data katagori klien, terdapat relasi dengan data pada tabel data lainnya']]);
            }else{
                ClientCategory::destroy($clientCategory->id);
    
                return redirect('/marketing/client-categories')->with('success','Katagori klien dengan nama '. $clientCategory->name .' berhasil dihapus');
            }
        } else {
            abort(403);
        }
    }
}
