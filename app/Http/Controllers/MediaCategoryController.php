<?php

namespace App\Http\Controllers;

use App\Models\MediaCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Gate;

class MediaCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        if(Gate::allows('isMediaSetting') && Gate::allows('isMediaRead')){
            return response()-> view ('media-categories.index', [
                'media_categories'=>MediaCategory::filter(request('search'))->sortable()->with(['user'])->orderBy("code", "asc")->paginate(10)->withQueryString(),
                'title' => 'Daftar Katagori Media'
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
        if((Gate::allows('isAdmin') && Gate::allows('isMediaSetting') && Gate::allows('isMediaCreate')) || (Gate::allows('isMedia') && Gate::allows('isMediaSetting') && Gate::allows('isMediaCreate'))){
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
        if((Gate::allows('isAdmin') && Gate::allows('isMediaSetting') && Gate::allows('isMediaCreate')) || (Gate::allows('isMedia') && Gate::allows('isMediaSetting') && Gate::allows('isMediaCreate'))){
            if($request->name == "Billboard"){
                $code = "BB";
            }elseif($request->name == "Videotron"){
                $code = "VT";
            }elseif($request->name == "Signage"){
                $code = "SN";
            }elseif($request->name == "Bando"){
                $code = "BD";
            }elseif($request->name == "Baliho"){
                $code = "BLH";
            }elseif($request->name == "Midiboard"){
                $code = "MB";
            }elseif($request->name == "Service"){
                $code = "SV";
            }
            // Set code --> end

            $request->request->add(['code' => $code, 'user_id' => auth()->user()->id]);
            $validateData = $request->validate([
                'code' => 'required|unique:media_categories',
                'name' => 'required|unique:media_categories',
                'user_id' => 'required',
                'description' => 'required'
            ]);
            
            MediaCategory::create($validateData);
    
            return redirect('/media/media-categories')->with('success','Katagori media dengan nama '. $request->name . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MediaCategory $mediaCategory): Response
    {
        if(Gate::allows('isMediaSetting') && Gate::allows('isMediaRead')){
            return response()-> view ('media-categories.show', [
                'media_category' => $mediaCategory,
                'title' => 'Detail Katagori Media' . $mediaCategory->name
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MediaCategory $mediaCategory): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMediaSetting') && Gate::allows('isMediaEdit')) || (Gate::allows('isMedia') && Gate::allows('isMediaSetting') && Gate::allows('isMediaEdit'))){
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
        if((Gate::allows('isAdmin') && Gate::allows('isMediaSetting') && Gate::allows('isMediaEdit')) || (Gate::allows('isMedia') && Gate::allows('isMediaSetting') && Gate::allows('isMediaEdit'))){
            $request->request->add(['user_id' => auth()->user()->id]);
            $rules = [
                'user_id' => 'required',
                'description' => 'required'
            ];
            
            if ($request->name != $mediaCategory->name) {
                if($request->name == "Billboard"){
                    $code = "BB";
                }elseif($request->name == "Videotron"){
                    $code = "VT";
                }elseif($request->name == "Signage"){
                    $code = "SN";
                }elseif($request->name == "Bando"){
                    $code = "BD";
                }elseif($request->name == "Baliho"){
                    $code = "BLH";
                }elseif($request->name == "Midiboard"){
                    $code = "MB";
                }elseif($request->name == "Service"){
                    $code = "SV";
                }
                $rules['name'] = 'required|unique:media_categories';
                $rules['code'] = 'required|unique:media_categories';
                $request->request->add(['code' => $code]);
            } 

            $validateData = $request->validate($rules);
                
            MediaCategory::where('id', $mediaCategory->id)
                ->update($validateData);
        
            return redirect('/media/media-categories')->with('success','Katagori media dengan nama '. $mediaCategory->name . ' berhasil diupdate');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MediaCategory $mediaCategory): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMediaSetting') && Gate::allows('isMediaDelete')) || (Gate::allows('isMedia') && Gate::allows('isMediaSetting') && Gate::allows('isMediaDelete'))){
            if($mediaCategory->location_photos()->exists() || $mediaCategory->locations()->exists() || $mediaCategory->sales()->exists() || $mediaCategory->quotations()->exists()){
                return back()->withErrors(['delete' => ['Gagal untuk menghapus data katagori media, terdapat relasi dengan data pada tabel data lainnya']]);
            }else{
                MediaCategory::destroy($mediaCategory->id);
    
                return redirect('/media/media-categories')->with('success','Katagori media dengan nama '. $mediaCategory->name .' berhasil dihapus');
            }
        } else {
            abort(403);
        }
    }
}
