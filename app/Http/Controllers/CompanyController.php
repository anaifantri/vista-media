<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Gate;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        if(Gate::allows('isMediaSetting') && Gate::allows('isMediaRead')){
            return response()-> view ('companies.index', [
                'companies'=>Company::filter(request('search'))->sortable()->with(['user'])->orderBy("code", "asc")->paginate(10)->withQueryString(),
                'title' => 'Daftar Perusahaan'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMediaSetting') && Gate::allows('isMediaDelete')) || (Gate::allows('isMedia') && Gate::allows('isMediaSetting') && Gate::allows('isMediaCreate'))){
            return response()->view('companies.create', [
                'companies'=>Company::all(),
                'title' => 'Tambah Perusahaan'
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
        if((Gate::allows('isAdmin') && Gate::allows('isMediaSetting') && Gate::allows('isMediaDelete')) || (Gate::allows('isMedia') && Gate::allows('isMediaSetting') && Gate::allows('isMediaCreate'))){
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
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company): Response
    {
        if(Gate::allows('isMediaSetting') && Gate::allows('isMediaRead')){
            return response()->view('companies.show', [
                'company' => $company,
                'title' => 'Detail Perusahaan'.$company->name
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMediaSetting') && Gate::allows('isMediaDelete')) || (Gate::allows('isMedia') && Gate::allows('isMediaSetting') && Gate::allows('isMediaEdit'))){
            return response()->view('companies.edit', [
                'company' => $company,
                'title' => 'Merubah Data Perusahaan'.$company->name
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMediaSetting') && Gate::allows('isMediaDelete')) || (Gate::allows('isMedia') && Gate::allows('isMediaSetting') && Gate::allows('isMediaEdit'))){
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
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMediaSetting') && Gate::allows('isMediaDelete')) || (Gate::allows('isMedia') && Gate::allows('isMediaSetting') && Gate::allows('isMediaDelete'))){
            if($company->location_photos()->exists() || $company->locations()->exists() || $company->sales()->exists() || $company->quotations()->exists() || $company->print_orders()->exists() || $company->install_orders()->exists() || $company->land_agreements()->exists() || $company->licenses()->exists()){
                return back()->withErrors(['delete' => ['Gagal untuk menghapus data perusahaan, terdapat relasi dengan data pada tabel data lainnya']]);
            }else{
                if($company->logo){
                    Storage::delete($company->logo);
                }
                Company::destroy($company->id);
    
                return redirect('/media/companies')->with('success','Data perusahaan dengan nama '. $company->name .' berhasil dihapus');
            }
        } else {
            abort(403);
        }
    }
}
