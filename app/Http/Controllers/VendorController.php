<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\User;
use App\Models\VendorContact;
use App\Models\MediaCategory;
use App\Models\VendorCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

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

        return response()-> view ('vendors.index', [
            'vendors'=>Vendor::filter(request('search'))->sortable()->paginate(10)->withQueryString(),
            'title' => 'Daftar Vendor',
            'categories' => MediaCategory::all(),
            compact('vendors', 'users', 'vendor_categories')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('vendors.create', [
            'vendor_categories'=>VendorCategory::all(),
            'title' => 'Menambah Data Vendor',
            'categories' => MediaCategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            if ($request->vendor_category_id == 'Pilih Katagori'){
                return back()->withErrors(['vendor_category_id' => ['Silahkan pilih katagori']])->withInput();
            }

            // Set code --> start
            $dataVendor = Vendor::all()->last();
            if($dataVendor){
                $lastCode = (int)substr($dataVendor->code,3,3);
                $newCode = $lastCode + 1;
            } else {
                $newCode = 1;
            }
            

            if($newCode < 10 ){
                $code = 'DV-00'.$newCode;
            } else {
                $code = 'DV-0'.$newCode;
            }
            // Set code --> end
        
            $request->request->add(['code' => $code, 'user_id' => auth()->user()->id]);
            $validateData = $request->validate([
                'code' => 'required|unique:vendors',
                'name' => 'required|max:255|unique:vendors',
                'company' => 'required|min:6|unique:vendors',
                'phone' => 'unique:vendors',
                'email' => 'email:dns|unique:vendors',
                'user_id' => 'required',
                'address' => 'required',
                'vendor_category_id' => 'required',
                'logo' => 'image|file|max:1024'
            ]);

            if($request->file('logo')){
                $validateData['logo'] = $request->file('logo')->store('vendor-images');
            }
            
            Vendor::create($validateData);
            
            return redirect('/vendors')->with('success','Vendor baru dengan nama '. $request->name . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor): Response
    {
        return response()->view('vendors.show', [
            'vendor' => $vendor,
            'vendor_contacts' => VendorContact::all(),
            'title' => 'Data Vendor'.$vendor->name,
            'categories' => MediaCategory::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor): Response
    {
        return response()->view('vendors.edit', [
            'vendor' => $vendor,
            'vendor_categories'=>VendorCategory::all(),
            'title' => 'Edit Data Vendor'.$vendor->name,
            'categories' => MediaCategory::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            $request->request->add(['user_id' => auth()->user()->id]);
            $rules = [
                'user_id' => 'required',
                'vendor_category_id' => 'required',
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
                $rules['phone'] = 'unique:vendors';
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

            return redirect('/vendors')->with('success','Vendor dengan nama '. $request->name . ' berhasil dirubah');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator'){
            Vendor::destroy($vendor->id);

            return redirect('/vendors')->with('success','Data vendor dengan nama '. $vendor->name .' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
