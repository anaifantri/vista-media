<?php

namespace App\Http\Controllers;

use App\Models\InstallationPrice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InstallationPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()-> view ('installation-prices.index', [
            'installation_prices'=>InstallationPrice::filter(request('search'))->sortable()->with(['user'])->orderBy("code", "asc")->paginate(10)->withQueryString(),
            'title' => 'Daftar Harga Pasang'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()-> view ('installation-prices.create', [
                'title' => 'Menambah Harga Pasang'
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
            if ($request->type == 'pilih'){
                return back()->withErrors(['type' => ['Silahkan pilih tipe harga pasang']])->withInput();
            }
            $dataInstallationPrices = InstallationPrice::all()->last();
            if($dataInstallationPrices){
                $lastCode = (int)substr($dataInstallationPrices->code,3,3);
                $newCode = $lastCode + 1;
            } else {
                $newCode = 1;
            }
            

            if($newCode < 10 ){
                $code = 'HP-00'.$newCode;
            } else {
                $code = 'HP-0'.$newCode;
            }
            
            $request->request->add(['code' => $code, 'user_id' => auth()->user()->id]);
            $validateData = $request->validate([
                'code' => 'required|unique:installation_prices',
                'user_id' => 'required',
                'type' => 'required|unique:installation_prices',
                'price' => 'required'
            ]);

            InstallationPrice::create($validateData);
    
            return redirect('/marketing/installation-prices')->with('success','Harga pemasangan dengan tipe ' . $request->type . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(InstallationPrice $installationPrice): Response
    {
        return response()->view('installation-prices.show', [
            'installation_price' => $installationPrice,
            'title' => 'Detail Harga Pasang'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InstallationPrice $installationPrice): Response
    {
        return response()->view('installation-prices.edit', [
            'installation_price' => $installationPrice,
            'title' => 'Edit Harga Pasang'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InstallationPrice $installationPrice): RedirectResponse
    {
        $request->request->add(['user_id' => auth()->user()->id]);
        $rules = [
            'user_id' => 'required',
            'price' => 'required'
        ];
        if($request->type != $installationPrice->type ){
            $rules = [
                'type' => 'required|unique:installation_prices'
            ];
        }

        $validateData = $request->validate($rules);

        InstallationPrice::where('id', $installationPrice->id)
                ->update($validateData);

        return redirect('/marketing/installation-prices')->with('success','Harga pasang dengan type '. $installationPrice->type .' berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InstallationPrice $installationPrice): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            
            InstallationPrice::destroy($installationPrice->id);

            return redirect('/marketing/installation-prices')->with('success','Harga pasang dengan tipe ' . $installationPrice->type . ' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
