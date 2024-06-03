<?php

namespace App\Http\Controllers;

use App\Models\SaleCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SaleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()-> view ('dashboard.marketing.sale-categories.index', [
            'sale_categories'=>SaleCategory::filter(request('search'))->sortable()->with(['user'])->orderBy("name", "asc")->paginate(10)->withQueryString(),
            'title' => 'Daftar Katagori Penjualan'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()-> view ('dashboard.marketing.sale-categories.create', [
                'title' => 'Create Sale Category'
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
        
            $validateData = $request->validate([
                'name' => 'required|unique:sale_categories',
                'description' => 'required'
            ]);
            
            $validateData['user_id'] = auth()->user()->id;
            SaleCategory::create($validateData);
    
            return redirect('/dashboard/marketing/sale-categories')->with('success','Katagori penjualan dengan nama '. $request->name . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SaleCategory $saleCategory): Response
    {
        return response()-> view ('dashboard.marketing.sale-categories.show', [
            'sale_category' => $saleCategory,
            'title' => 'Detail Katagori Penjualan' . $saleCategory->name
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SaleCategory $saleCategory): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()->view('dashboard.marketing.sale-categories.edit', [
                'sale_category' => $saleCategory,
                'title' => 'Edit Katagori Penjualan'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SaleCategory $saleCategory): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            if ($request->name != $saleCategory->name) {
                $validateData = $request->validate([
                    'name' => 'required|unique:sale_categories',
                    'description' => 'required'
                ]);
            } else {
                $validateData = $request->validate([
                    'description' => 'required'
                ]);
            }
                
            $validateData['user_id'] = auth()->user()->id;
                
            SaleCategory::where('id', $saleCategory->id)
                ->update($validateData);
        
            return redirect('/dashboard/marketing/sale-categories')->with('success','Katagori penjualan dengan nama '. $saleCategory->name . ' berhasil diupdate');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaleCategory $saleCategory): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            SaleCategory::destroy($saleCategory->id);

            return redirect('/dashboard/marketing/sale-categories')->with('success','Katagori penjualan dengan nama '. $saleCategory->name .' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
