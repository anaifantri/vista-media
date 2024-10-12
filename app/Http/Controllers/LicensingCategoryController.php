<?php

namespace App\Http\Controllers;

use App\Models\LicensingCategory;
use App\Models\MediaCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LicensingCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()-> view ('licensing-categories.index', [
            'licensing_categories'=>LicensingCategory::filter(request('search'))->sortable()->with(['user'])->orderBy("code", "asc")->paginate(10)->withQueryString(),
            'title' => 'Daftar Katagori Perizinan',
            'categories' => MediaCategory::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()-> view ('licensing-categories.create', [
                'title' => 'Menambahkan Katagori Perizinan',
                'categories' => MediaCategory::all()
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
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            // Set code --> start
            $dataCategory = LicensingCategory::all()->last();
            if($dataCategory){
                $lastCode = (int)substr($dataCategory->code,3,3);
                $newCode = $lastCode + 1;
            } else {
                $newCode = 1;
            }
            
    
            if($newCode < 10 ){
                $code = 'MC-00'.$newCode;
            } else {
                $code = 'MC-0'.$newCode;
            }
            // Set code --> end

            $request->request->add(['code' => $code, 'user_id' => auth()->user()->id]);
            $validateData = $request->validate([
                'code' => 'required|unique:licensing_categories',
                'name' => 'required|unique:licensing_categories',
                'user_id' => 'required',
                'description' => 'required'
            ]);
            
            LicensingCategory::create($validateData);
    
            return redirect('/media/licensing-categories')->with('success','Katagori perizinan dengan nama '. $request->name . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LicensingCategory $licensingCategory): Response
    {
        return response()-> view ('licensing-categories.show', [
            'licensing_category' => $licensingCategory,
            'title' => 'Detail Katagori Perizinan' . $licensingCategory->name,
            'categories' => MediaCategory::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LicensingCategory $licensingCategory): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()->view('licensing-categories.edit', [
                'licensing_category' => $licensingCategory,
                'title' => 'Edit Katagori Perizinan',
                'categories' => MediaCategory::all()
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LicensingCategory $licensingCategory): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            $request->request->add(['user_id' => auth()->user()->id]);
            $rules = [
                'user_id' => 'required',
                'description' => 'required'
            ];
            
            if ($request->name != $licensingCategory->name) {
                $rules['name'] = 'required|unique:media_categories';
            } 

            $validateData = $request->validate($rules);
                
            LicensingCategory::where('id', $licensingCategory->id)
                ->update($validateData);
        
            return redirect('/media/licensing-categories')->with('success','Katagori perizinan dengan nama '. $licensingCategory->name . ' berhasil diupdate');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LicensingCategory $licensingCategory): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            LicensingCategory::destroy($licensingCategory->id);

            return redirect('/media/licensing-categories')->with('success','Katagori perizinan dengan nama '. $licensingCategory->name .' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
