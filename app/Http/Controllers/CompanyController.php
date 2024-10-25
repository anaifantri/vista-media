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
        // Set Code --> start
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
        // Set Code --> end

        $request->request->add(['code' => $code, 'user_id' => auth()->user()->id]);
        $validateData = $request->validate([
            'name' => 'required|unique:companies',
            'code' => 'required|unique:companies',
            'user_id' => 'required',
            'address' => 'required',
            'phone' => 'unique:companies',
            'm_phone' => 'unique:companies',
            'email' => 'required|email:dns|unique:companies',
            'logo' => 'required|image|file|max:1024'
        ]);


        if($request->file('logo')){
            $validateData['logo'] = $request->file('logo')->store('company-images');
        }
        
        Company::create($validateData);
        
        return redirect('/media/companies')->with('success','Data perusahaan baru dengan nama  '. $request->name . ' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company): Response
    {
        return response()->view('companies.show', [
            'company' => $company,
            'title' => 'Detail Perusahaan'.$company->name
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company): Response
    {
        return response()->view('companies.edit', [
            'company' => $company,
            'title' => 'Merubah Data Perusahaan'.$company->name
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company): RedirectResponse
    {
        $request->request->add(['user_id' => auth()->user()->id]);
        $rules = [
            'address' => 'required',
            'user_id' => 'required',
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

        if($request->m_phone != $company->m_phone){
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

        return redirect('/media/companies')->with('success','Data perusahaan dengan nama '. $request->name . ' berhasil dirubah');
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

            return redirect('/media/companies')->with('success','Data perusahaan dengan nama '. $company->name .' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
