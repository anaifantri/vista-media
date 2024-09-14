<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()-> view ('companies.index', [
            'companies'=>Company::filter(request('search'))->sortable()->with(['user'])->orderBy("code", "asc")->paginate(10)->withQueryString(),
            'title' => 'Daftar Perusahaan'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('companies.create', [
            'companies'=>Company::all(),
            'title' => 'Tambah Perusahaan'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {    
        $validateData = $request->validate([
            'name' => 'required|unique:companies',
            'address' => 'required',
            'phone' => 'min:8|unique:companies',
            'mobile_phone' => 'min:10|unique:companies',
            'email' => 'email:dns|unique:companies',
            'logo' => 'image|file|max:1024'
        ]);

        $dataCompanies = Company::all()->last();
        if($dataCompanies){
            $lastCode = (int)substr($dataCompanies->code,3,3);
            $newCode = $lastCode + 1;
        } else {
            $newCode = 1;
        }
        

        if($newCode < 10 ){
            $code = 'CP-00'.$newCode;
        } else {
            $code = 'CP-0'.$newCode;
        }

        $validateData['user_id'] = auth()->user()->id;
        $validateData['code'] = $code;

        if($request->file('logo')){
            $validateData['logo'] = $request->file('logo')->store('company-images');
        }

        // foreach($dataCompanies as $company){
        //     $companyCode = (int)substr(end$company->code,3,3);
        // }
        
        Company::create($validateData);
        
        return redirect('/companies')->with('success','Perusahaan baru '. $request->name . ' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company): Response
    {
        return response()->view('companies.show', [
            'company' => $company,
            'title' => 'Detail Perusahaan'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company): Response
    {
        return response()->view('companies.edit', [
            'company' => $company,
            'title' => 'Edit Data Perusahaan'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company): RedirectResponse
    {
        $rules = [
            'address' => 'required',
            'logo' => 'image|file|max:1024'
        ];

        if($request->name != $company->name){
            $rules['name'] = 'required|unique:companies';
        }

        if($request->email != $company->email){
            $rules['email'] = 'email:dns|unique:companies';
        }

        if($request->phone != $company->phone){
            $rules['phone'] = 'min:10|unique:companies';
        }

        if($request->mobile_phone != $company->mobile_phone){
            $rules['mobile_phone'] = 'min:10|unique:companies';
        }

        $validateData = $request->validate($rules);


        if($request->file('logo')){
            if($request->oldLogo){
                Storage::delete($request->oldLogo);
            }
            $validateData['logo'] = $request->file('logo')->store('company-images');
        }

        Company::where('id', $company->id)
                ->update($validateData);

        return redirect('/companies')->with('success','Data perusahaan dengan nama '. $request->name . ' berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            
            if($company->logo){
                Storage::delete($company->logo);
            }
            Company::destroy($company->id);

            return redirect('/companies')->with('success','Data perusahaan dengan nama '. $company->name .' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
