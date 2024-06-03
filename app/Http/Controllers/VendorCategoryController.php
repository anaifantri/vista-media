<?php

namespace App\Http\Controllers;

use App\Models\VendorCategory;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VendorCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()-> view ('dashboard.media.vendor-categories.index', [
            'vendor_categories'=>VendorCategory::filter(request('search'))->sortable()->with(['user'])->orderBy("name", "asc")->paginate(10)->withQueryString(),
            'title' => 'Daftar Katagori Vendor'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()-> view ('dashboard.media.vendor-categories.create', [
                'title' => 'Create Vendor Category'
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
                'name' => 'required|unique:vendor_categories',
                'description' => 'required'
            ]);
            
            $validateData['user_id'] = auth()->user()->id;
            VendorCategory::create($validateData);
    
            return redirect('/dashboard/media/vendor-categories')->with('success','Katagori vendor dengan nama '. $request->name . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(VendorCategory $vendorCategory): Response
    {
        return response()-> view ('dashboard.media.vendor-categories.show', [
            'vendor_category' => $vendorCategory,
            'title' => 'Detail Katagori Vendor' . $vendorCategory->name
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VendorCategory $vendorCategory): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()->view('dashboard.media.vendor-categories.edit', [
                'vendor_category' => $vendorCategory,
                'title' => 'Edit Katagori Vendor'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VendorCategory $vendorCategory): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            if ($request->name != $vendorCategory->name) {
                $validateData = $request->validate([
                    'name' => 'required|unique:vendor_categories',
                    'description' => 'required'
                ]);
            } else {
                $validateData = $request->validate([
                    'description' => 'required'
                ]);
            }
                
            $validateData['user_id'] = auth()->user()->id;
                
            VendorCategory::where('id', $vendorCategory->id)
                ->update($validateData);
        
            return redirect('/dashboard/media/vendor-categories')->with('success','Katagori vendor dengan nama '. $vendorCategory->name . ' berhasil diupdate');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VendorCategory $vendorCategory): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            VendorCategory::destroy($vendorCategory->id);

            return redirect('/dashboard/media/vendor-categories')->with('success','Katagori vendor dengan nama '. $vendorCategory->name .' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
