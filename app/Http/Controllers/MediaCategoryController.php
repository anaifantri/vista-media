<?php

namespace App\Http\Controllers;

use App\Models\MediaCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MediaCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()-> view ('media-categories.index', [
            'media_categories'=>MediaCategory::filter(request('search'))->sortable()->with(['user'])->orderBy("code", "asc")->paginate(10)->withQueryString(),
            'title' => 'Daftar Katagori Media'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()-> view ('media-categories.create', [
                'title' => 'Menambahkan Katagori Media'
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
                'name' => 'required|unique:media_categories',
                'description' => 'required'
            ]);

            $dataCategory = MediaCategory::all()->last();
            if($dataCategory){
                $lastCode = (int)substr($dataCategory->code,3,3);
                $newCode = $lastCode + 1;
            } else {
                $newCode = 1;
            }
            
    
            if($newCode < 10 ){
                $code = 'CM-00'.$newCode;
            } else {
                $code = 'CM-0'.$newCode;
            }
    
            $validateData['user_id'] = auth()->user()->id;
            $validateData['code'] = $code;
            
            MediaCategory::create($validateData);
    
            return redirect('/media-categories')->with('success','Katagori media dengan nama '. $request->name . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MediaCategory $mediaCategory): Response
    {
        return response()-> view ('media-categories.show', [
            'media_category' => $mediaCategory,
            'title' => 'Detail Katagori Media' . $mediaCategory->name
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MediaCategory $mediaCategory): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()->view('media-categories.edit', [
                'media_category' => $mediaCategory,
                'title' => 'Edit Katagori Media'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MediaCategory $mediaCategory): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            if ($request->name != $mediaCategory->name) {
                $validateData = $request->validate([
                    'name' => 'required|unique:media_categories',
                    'description' => 'required'
                ]);
            } else {
                $validateData = $request->validate([
                    'description' => 'required'
                ]);
            }
                
            $validateData['user_id'] = auth()->user()->id;
                
            MediaCategory::where('id', $mediaCategory->id)
                ->update($validateData);
        
            return redirect('/media-categories')->with('success','Katagori media dengan nama '. $mediaCategory->name . ' berhasil diupdate');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MediaCategory $mediaCategory): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            MediaCategory::destroy($mediaCategory->id);

            return redirect('/media-categories')->with('success','Katagori media dengan nama '. $mediaCategory->name .' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
