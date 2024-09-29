<?php

namespace App\Http\Controllers;

use App\Models\VendorContact;
use App\Models\MediaCategory;
use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class VendorContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->request->add(['vendor_id' => $request->vendor_id, 'user_id' => auth()->user()->id]);
        $rules = [
            'user_id' => 'required',
            'vendor_id' => 'required',
            'name' => 'required|max:255',
            'photo' => 'image|file|max:1024'
        ];
        if($request->email){
            $rules['email'] = 'email:dns|unique:vendor_contacts';
        }
        if($request->phone){
            $rules['phone'] = 'min:10|max:15|unique:vendor_contacts';
        }

        $validateData = $request->validate($rules);

        $validateData['position'] = $request->position;

        if($request->file('photo')){
            $validateData['photo'] = $request->file('photo')->store('vendor-contact-images');
        }

        VendorContact::create($validateData);

        return redirect('/vendors/'. $request->vendor_id)->with('success','Kontak baru dengan nama '. $request->name . ' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(VendorContact $vendorContact): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VendorContact $vendorContact): Response
    {
        $vendors = Vendor::with('vendor_contacts')->get();
        return response()->view('vendor-contacts.edit', [
            'contact' => $vendorContact,
            'title' => 'Edit Kontak Vendor',
            'categories' => MediaCategory::all(),
            compact('vendors')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VendorContact $vendorContact): RedirectResponse
    {
        $request->request->add(['vendor_id' => $request->vendor_id, 'user_id' => auth()->user()->id]);
        $rules = [
            'user_id' => 'required',
            'vendor_id' => 'required',
            'name' => 'required|max:255',
            'photo' => 'image|file|max:1024'
        ];

        if($request->email != $vendorContact->email){
            $rules['email'] = 'email:dns|unique:vendor_contacts';
        } 

        if($request->phone != $vendorContact->phone){
            $rules['phone'] = 'min:10|max:15|unique:vendor_contacts';
        }

        $validateData = $request->validate($rules);
        $validateData['position'] = $request->position;

        if($request->file('photo')){
            if($request->oldPhoto){
                Storage::delete($request->oldPhoto);
            }
            $validateData['photo'] = $request->file('photo')->store('contact-images');
        }

        VendorContact::where('id', $vendorContact->id)
                ->update($validateData);

        return redirect('/vendors/'. $request->vendor_id)->with('success','Kontak person dengan nama '. $request->name . ' berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VendorContact $vendorContact): RedirectResponse
    {
        if($vendorContact->photo){
            Storage::delete($vendorContact->photo);
        }

        VendorContact::destroy($vendorContact->id);
        
        return redirect('/vendors/'. $vendorContact->vendor_id)->with('success','Kontak person dengan nama ' . $vendorContact->name . ' berhasil dihapus');
    }
}
