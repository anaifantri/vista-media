<?php

namespace App\Http\Controllers;

use App\Models\SignageCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SignageCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()-> view ('dashboard.media.signage-categories.index', [
            'signage_categories'=>SignageCategory::filter(request('search'))->sortable()->with(['user'])->orderBy("name", "asc")->paginate(10)->withQueryString(),
            'title' => 'Daftar Katagori Signage'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()-> view ('dashboard.media.signage-categories.create', [
                'title' => 'Create Signage Category'
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
                'name' => 'required|unique:signage_categories',
                'description' => 'required'
            ]);
            
            $validateData['user_id'] = auth()->user()->id;
            SignageCategory::create($validateData);
    
            return redirect('/dashboard/media/signage-categories')->with('success','Katagori signage dengan nama '. $request->name . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SignageCategory $signageCategory): Response
    {
        return response()-> view ('dashboard.media.signage-categories.show', [
            'signage_category' => $signageCategory,
            'title' => 'Detail Katagori Signage' . $signageCategory->name
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SignageCategory $signageCategory): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()->view('dashboard.media.signage-categories.edit', [
                'signage_category' => $signageCategory,
                'title' => 'Edit Katagori Signage'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SignageCategory $signageCategory): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            if ($request->name != $signageCategory->name) {
                $validateData = $request->validate([
                    'name' => 'required|unique:signage_categories',
                    'description' => 'required'
                ]);
            } else {
                $validateData = $request->validate([
                    'description' => 'required'
                ]);
            }
                
            $validateData['user_id'] = auth()->user()->id;
                
            SignageCategory::where('id', $signageCategory->id)
                ->update($validateData);
        
            return redirect('/dashboard/media/signage-categories')->with('success','Katagori signage dengan nama '. $signageCategory->name . ' berhasil diupdate');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SignageCategory $signageCategory): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            SignageCategory::destroy($signageCategory->id);

            return redirect('/dashboard/media/signage-categories')->with('success','Katagori signage dengan nama '. $signageCategory->name .' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
