<?php

namespace App\Http\Controllers;

use App\Models\QuotationCategory;
use App\Models\MediaCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuotationCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()-> view ('quotation-categories.index', [
            'quotation_categories'=>QuotationCategory::filter(request('search'))->sortable()->with(['user'])->orderBy("code", "asc")->paginate(10)->withQueryString(),
            'title' => 'Daftar Katagori Pemasaran',
            'categories' => MediaCategory::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()-> view ('quotation-categories.create', [
                'title' => 'Menambahkan Katagori Pemasaran',
                'categories' => MediaCategory::all()
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
        // Set code --> start
        $dataCategory = QuotationCategory::all()->last();
        if($dataCategory){
            $lastCode = (int)substr($dataCategory->code,3,3);
            $newCode = $lastCode + 1;
        } else {
            $newCode = 1;
        }
        

        if($newCode < 10 ){
            $code = 'QC-00'.$newCode;
        } else {
            $code = 'QC-0'.$newCode;
        }
        // Set code --> end

        $request->request->add(['code' => $code, 'user_id' => auth()->user()->id]);
        $validateData = $request->validate([
            'code' => 'required|unique:quotation_categories',
            'name' => 'required|unique:quotation_categories',
            'user_id' => 'required',
            'description' => 'required'
        ]);
        
        QuotationCategory::create($validateData);

        return redirect('/quotation-categories')->with('success','Katagori pemasaran dengan nama '. $request->name . ' berhasil ditambahkan');
    } else {
        abort(403);
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(QuotationCategory $quotationCategory): Response
    {
        return response()-> view ('quotation-categories.show', [
            'quotation_category' => $quotationCategory,
            'title' => 'Detail Katagori Pemasaran' . $quotationCategory->name,
            'categories' => MediaCategory::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuotationCategory $quotationCategory): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()->view('quotation-categories.edit', [
                'quotation_category' => $quotationCategory,
                'title' => 'Edit Katagori Pemasaran',
                'categories' => MediaCategory::all()
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuotationCategory $quotationCategory): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            $request->request->add(['user_id' => auth()->user()->id]);
            $rules = [
                'user_id' => 'required',
                'description' => 'required'
            ];
            
            if ($request->name != $quotationCategory->name) {
                $rules['name'] = 'required|unique:quotation_categories';
            } 

            $validateData = $request->validate($rules);
                
            QuotationCategory::where('id', $quotationCategory->id)
                ->update($validateData);
        
            return redirect('/quotation-categories')->with('success','Katagori pemasaran dengan nama '. $quotationCategory->name . ' berhasil diupdate');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuotationCategory $quotationCategory): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            QuotationCategory::destroy($quotationCategory->id);

            return redirect('/quotation-categories')->with('success','Katagori peamasaran dengan nama '. $quotationCategory->name .' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
