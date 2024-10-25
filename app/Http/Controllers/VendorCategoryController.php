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
        return response()-> view ('vendor-categories.index', [
            'vendor_categories'=>VendorCategory::filter(request('search'))->sortable()->with(['user'])->orderBy("code", "asc")->paginate(10)->withQueryString(),
            'title' => 'Daftar Katagori Vendor'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()-> view ('vendor-categories.create', [
                'title' => 'Menambah Katagori Vendor'
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
            if ($request->name == 'pilih'){
                return back()->withErrors(['name' => ['Silahkan pilih katagori']])->withInput();
            }
            // Set code --> start
            $dataCategory = VendorCategory::all()->last();
            if($dataCategory){
                $lastCode = (int)substr($dataCategory->code,3,3);
                $newCode = $lastCode + 1;
            } else {
                $newCode = 1;
            }
            
    
            if($newCode < 10 ){
                $code = 'VC-00'.$newCode;
            } else {
                $code = 'VC-0'.$newCode;
            }
            // Set code --> end

            $request->request->add(['code' => $code, 'user_id' => auth()->user()->id]);
            $validateData = $request->validate([
                'code' => 'required|unique:vendor_categories',
                'name' => 'required|unique:vendor_categories',
                'user_id' => 'required',
                'description' => 'required'
            ]);
            
            VendorCategory::create($validateData);
    
            return redirect('/mrketing/vendor-categories')->with('success','Katagori vendor dengan nama '. $request->name . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(VendorCategory $vendorCategory): Response
    {
        return response()-> view ('vendor-categories.show', [
            'vendor_category' => $vendorCategory,
            'title' => 'Data Katagori Vendor' . $vendorCategory->name
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VendorCategory $vendorCategory): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()->view('vendor-categories.edit', [
                'vendor_category' => $vendorCategory,
                'title' => 'Edit Data Katagori Vendor'
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
            $request->request->add(['user_id' => auth()->user()->id]);
            $rules = [
                'user_id' => 'required',
                'description' => 'required'
            ];
            
            if ($request->name != $vendorCategory->name) {
                $rules['name'] = 'required|unique:vendor_categories';
            } 
                
            $validateData = $request->validate($rules);
                
            VendorCategory::where('id', $vendorCategory->id)
                ->update($validateData);
        
            return redirect('/mrketing/vendor-categories')->with('success','Katagori vendor dengan nama '. $vendorCategory->name . ' berhasil dirubah');
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

            return redirect('/mrketing/vendor-categories')->with('success','Katagori vendor dengan nama '. $vendorCategory->name .' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
