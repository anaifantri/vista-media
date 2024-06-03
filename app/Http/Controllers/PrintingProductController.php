<?php

namespace App\Http\Controllers;

use App\Models\PrintingProduct;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PrintingProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()-> view ('dashboard.media.printing-products.index', [
            'printing_products'=>PrintingProduct::filter(request('search'))->sortable()->with(['user'])->orderBy("name", "asc")->paginate(10)->withQueryString(),
            'title' => 'Daftar Bahan Printing'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()-> view ('dashboard.media.printing-products.create', [
                'title' => 'Create Printing Product'
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
                'name' => 'required|unique:printing_products'
            ]);
            
            $validateData['description'] = $request->description;
            $validateData['user_id'] = auth()->user()->id;
            PrintingProduct::create($validateData);
    
            return redirect('/dashboard/media/printing-products')->with('success','Bahan cetak '. $request->name . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PrintingProduct $printingProduct): Response
    {
        return response()-> view ('dashboard.media.printing-products.show', [
            'printing_product' => $printingProduct,
            'title' => 'Detail Bahan ' . $printingProduct->name
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrintingProduct $printingProduct): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()->view('dashboard.media.printing-products.edit', [
                'printing_product' => $printingProduct,
                'title' => 'Edit Bahan Cetak'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrintingProduct $printingProduct): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            if ($request->name != $printingProduct->name) {
                $validateData = $request->validate([
                    'name' => 'required|unique:printing_products'
                ]);
            }
                
            $validateData['description'] = $request->description;
            $validateData['user_id'] = auth()->user()->id;
                
            PrintingProduct::where('id', $printingProduct->id)
                ->update($validateData);
        
            return redirect('/dashboard/media/printing-products')->with('success','Bahan cetak dengan nama '. $printingProduct->name . ' berhasil diupdate');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrintingProduct $printingProduct): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            PrintingProduct::destroy($printingProduct->id);

            return redirect('/dashboard/media/printing-products')->with('success','Bahan cetak dengan nama '. $printingProduct->name .' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
