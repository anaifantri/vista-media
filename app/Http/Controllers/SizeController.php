<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()-> view ('dashboard.media.sizes.index', [
            'sizes'=>Size::filter(request('search'))->sortable()->with(['user'])->orderBy("size", "asc")->paginate(10)->withQueryString(),
            'title' => 'Daftar Ukuran'
        ]);
    }

    public function showSize(){
        $dataSize = Size::orderBy("size", "asc")->get();
        
        return response()->json(['dataSize'=> $dataSize]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()-> view ('dashboard.media.sizes.create', [
                'title' => 'Menambahkan Ukuran'
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
            // if($request->side == '0'){
            //     return back()->withErrors(['side' => ['Silahkan pilih jumlah sisi']])->withInput();
            // }

            // if($request->orientation == 'Pilih Orientasi'){
            //     return back()->withErrors(['orientation' => ['Silahkan pilih orientasi']])->withInput();
            // }
        
            $validateData = $request->validate([
                'size' => 'required',
                'category' => 'required'
                // 'orientation' => 'required'
            ]);
    
            $validateData['user_id'] = auth()->user()->id;
            Size::create($validateData);
    
            return redirect('/dashboard/media/sizes')->with('success','Ukuran '. $request->size . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Size $size): Response
    {
        return response()-> view ('dashboard.media.sizes.show', [
            'size' => $size,
            'title' => 'Detail Ukuran ' . $size->size
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Size $size): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()->view('dashboard.media.sizes.edit', [
                'size' => $size,
                'title' => 'Edit Ukuran'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Size $size): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            if ($request->size == $size->size) {
                return redirect('/dashboard/media/sizes')->with('success','Ukuran '. $request->size . ' tidak ada perubahan');
            } else {
                // if($request->side == '0'){
                //     return back()->withErrors(['side' => ['Silahkan pilih jumlah sisi']])->withInput();
                // }

                // if($request->orientation == 'Pilih Orientasi'){
                //     return back()->withErrors(['orientation' => ['Silahkan pilih orientasi']])->withInput();
                // }
            
                $validateData = $request->validate([
                    'size' => 'required',
                    'category' => 'required',
                    // 'orientation' => 'required'
                ]);
        
                $validateData['user_id'] = auth()->user()->id;
                
                Size::where('id', $size->id)
                    ->update($validateData);
        
                return redirect('/dashboard/media/sizes')->with('success','Ukuran '. $size->size . ' berhasil diupdate');
            }
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            Size::destroy($size->id);

            return redirect('/dashboard/media/sizes')->with('success','Ukuran '. $size->size .' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
