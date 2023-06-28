<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\User;
use App\Models\VendorContact;
use App\Models\VendorCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $vendors = Vendor::with('vendor_category')->get();
        $vendor_categories = VendorCategory::with('vendors')->get();
        $users = User::with('vendors')->get();

        return response()-> view ('dashboard.media.vendors.index', [
            'vendors'=>Vendor::filter(request('search'))->sortable()->paginate(10)->withQueryString(),
            'title' => 'Daftar Vendor',
            compact('vendors', 'users', 'vendor_categories')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('dashboard.media.vendors.create', [
            'vendor_categories'=>VendorCategory::all(),
            'title' => 'Tambah Klien'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->vendor_category_id == 'Pilih Katagori'){
            return back()->withErrors(['vendor_category_id' => ['Silahkan pilih katagori']])->withInput();
        }
    
        $validateData = $request->validate([
            'name' => 'required|max:255|unique:vendors',
            'company' => 'required|min:6|unique:vendors',
            'phone' => 'min:10|unique:vendors',
            'email' => 'email:dns|unique:vendors',
            'address' => 'required',
            'vendor_category_id' => 'required',
            'logo' => 'image|file|max:1024'
        ]);

        if($request->file('logo')){
            $validateData['logo'] = $request->file('logo')->store('vendor-images');
        }
        $validateData['user_id'] = auth()->user()->id;
        
        Vendor::create($validateData);
        
        return redirect('/dashboard/media/vendors')->with('success','Vendor baru '. $request->name . ' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor): Response
    {
        return response()->view('dashboard.media.vendors.show', [
            'vendor' => $vendor,
            'vendor_contacts' => VendorContact::all(),
            'title' => 'Detail Vendor'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor): Response
    {
        return response()->view('dashboard.media.vendors.edit', [
            'vendor' => $vendor,
            'vendor_categories'=>VendorCategory::all(),
            'title' => 'Edit Vendor'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor): RedirectResponse
    {
        if ($request->vendor_category_id == 'Pilih Katagori'){
            return back()->withErrors(['vendor_category_id' => ['Silahkan pilih katagori']])->withInput();
        }
        
        $rules = [
            'name' => 'required|max:255',
            'address' => 'required',
            'logo' => 'image|file|max:1024'
        ];

        if($request->email != $vendor->email){
            $rules['email'] = 'email:dns|unique:vendors';
        }

        if($request->company != $vendor->company){
            $rules['company'] = 'required|unique:vendors';
        } 

        if($request->phone != $vendor->phone){
            $rules['phone'] = 'min:10|unique:vendors';
        }

        if($request->vendor_category_id != $vendor->vendor_category_id){
            $rules['vendor_category_id'] = 'required';
        }

        $validateData = $request->validate($rules);


        if($request->file('logo')){
            if($request->oldLogo){
                Storage::delete($request->oldLogo);
            }
            $validateData['logo'] = $request->file('logo')->store('vendor-images');
        }

        Vendor::where('id', $vendor->id)
                ->update($validateData);

        return redirect('/dashboard/media/vendors')->with('success','Vendor '. $request->name . ' berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor): RedirectResponse
    {
        //
    }
}
