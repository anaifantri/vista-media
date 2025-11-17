<?php

namespace App\Http\Controllers;

use App\Models\IncomeTaxCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Validator;
use Gate;

class IncomeTaxCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        if(Gate::allows('isPPh') && Gate::allows('isAccountingRead')){
            return response()-> view ('income-tax-categories.index', [
                'income_tax_categories'=>IncomeTaxCategory::filter(request('search'))->paginate(30)->withQueryString(),
                'title' => 'Daftar Objek PPh'
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
        if((Gate::allows('isAdmin') || Gate::allows('isAccounting') || Gate::allows('isMedia') || Gate::allows('isMarketing')) && (Gate::allows('isPPh') && Gate::allows('isAccountingCreate'))){
            return  response()-> view ('income-tax-categories.create', [
                'title' => 'Menambahkan Objek PPh'
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
        if((Gate::allows('isAdmin') || Gate::allows('isAccounting') || Gate::allows('isMedia') || Gate::allows('isMarketing')) && (Gate::allows('isPPh') && Gate::allows('isAccountingCreate'))){
            $validateData = $request->validate([
                'user_id' => 'required',
                'code' => 'required|unique:income_tax_categories',
                'name' => 'required|unique:income_tax_categories',
                'rates' => 'required'
            ]);

            IncomeTaxCategory::create($validateData);

            return redirect('/accounting/income-tax-categories')->with('success', 'Data objek PPh berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(IncomeTaxCategory $incomeTaxCategory): Response
    {
        if(Gate::allows('isPPh') && Gate::allows('isAccountingRead')){
            return response()-> view('income-tax-categories.show', [
                'income_tax_category' => $incomeTaxCategory,
                'title' => 'Detail Objek PPH'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IncomeTaxCategory $incomeTaxCategory): Response
    {
        if((Gate::allows('isAdmin') || Gate::allows('isAccounting') || Gate::allows('isMedia') || Gate::allows('isMarketing')) && (Gate::allows('isPPh') && Gate::allows('isAccountingEdit'))){
            return  response()-> view ('income-tax-categories.edit', [
                'income_tax_category' => $incomeTaxCategory,
                'title' => 'Edit Data Objek PPh'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IncomeTaxCategory $incomeTaxCategory): RedirectResponse
    {
        if((Gate::allows('isAdmin') || Gate::allows('isAccounting') || Gate::allows('isMedia') || Gate::allows('isMarketing')) && (Gate::allows('isPPh') && Gate::allows('isAccountingEdit'))){
            $rules = [
                'rates' => 'required'
            ];

            if($request->code != $incomeTaxCategory->code){
                $rules['code'] = 'required|unique:income_tax_categories';
            }

            if($request->name != $incomeTaxCategory->name){
                $rules['name'] = 'required|unique:income_tax_categories';
            }

            $validateData = $request->validate($rules);

            IncomeTaxCategory::where('id', $incomeTaxCategory->id)
                ->update($validateData);
        
            return redirect('/accounting/income-tax-categories/'.$incomeTaxCategory->id)->with('success','Data Objek PPh dengan kode '. $incomeTaxCategory->code . ' berhasil dirubah');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IncomeTaxCategory $incomeTaxCategory): RedirectResponse
    {
        //
    }
}
