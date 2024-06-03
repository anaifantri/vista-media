<?php

namespace App\Http\Controllers;

use App\Models\BillboardCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BillboardCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()-> view ('dashboard.media.billboard-categories.index', [
            'billboard_categories'=>BillboardCategory::filter(request('search'))->sortable()->with(['user'])->orderBy("name", "asc")->paginate(10)->withQueryString(),
            'title' => 'Daftar Katagori Billboard'
        ]);
    }

    public function showBillboardCategory(){
        $dataBillboardCategory = BillboardCategory::All();

        return response()->json(['dataBillboardCategory'=> $dataBillboardCategory]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()-> view ('dashboard.media.billboard-categories.create', [
                'title' => 'Create Billboard Category'
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
        
            $validateData = $request->validate([
                'name' => 'required|unique:billboard_categories',
                'description' => 'required'
            ]);
            
            $validateData['user_id'] = auth()->user()->id;
            BillboardCategory::create($validateData);
    
            return redirect('/dashboard/media/billboard-categories')->with('success','Katagori billboard dengan nama '. $request->name . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BillboardCategory $billboardCategory): Response
    {
        return response()-> view ('dashboard.media.billboard-categories.show', [
            'billboard_category' => $billboardCategory,
            'title' => 'Detail Katagori Billboard' . $billboardCategory->name
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BillboardCategory $billboardCategory): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()->view('dashboard.media.billboard-categories.edit', [
                'billboard_category' => $billboardCategory,
                'title' => 'Edit Katagori Billboard'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BillboardCategory $billboardCategory): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            if ($request->name != $billboardCategory->name) {
                $validateData = $request->validate([
                    'name' => 'required|unique:billboard_categories',
                    'description' => 'required'
                ]);
            } else {
                $validateData = $request->validate([
                    'description' => 'required'
                ]);
            }
                
            $validateData['user_id'] = auth()->user()->id;
                
            BillboardCategory::where('id', $billboardCategory->id)
                ->update($validateData);
        
            return redirect('/dashboard/media/billboard-categories')->with('success','Katagori Billboard dengan nama '. $billboardCategory->name . ' berhasil diupdate');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BillboardCategory $billboardCategory): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            BillboardCategory::destroy($billboardCategory->id);

            return redirect('/dashboard/media/billboard-categories')->with('success','Katagori billboard dengan nama '. $billboardCategory->name .' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
