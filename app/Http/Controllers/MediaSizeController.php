<?php

namespace App\Http\Controllers;

use App\Models\MediaSize;
use App\Models\MediaCategory;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Gate;

class MediaSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        if(Gate::allows('isMediaSetting') && Gate::allows('isMediaRead')){
            $media_categories = MediaCategory::with('media_sizes')->get();
            return response()-> view ('media-sizes.index', [
                'media_sizes'=>MediaSize::filter(request('search'))->sortable()->with(['user'])->orderBy("code", "asc")->paginate(10)->withQueryString(),
                'title' => 'Daftar Ukuran',
                compact('media_categories')
            ]);
        } else {
            abort(403);
        }
    }

    public function getMediaSizes(String $category){
        $mediaSizes = MediaSize::whereHas('media_category', function($query) use ($category){
            $query->where('name', $category);
        })->orderBy("width", "asc")->get();

        return response()->json(['mediaSizes'=> $mediaSizes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMediaSetting') && Gate::allows('isMediaCreate')) || (Gate::allows('isMedia') && Gate::allows('isMediaSetting') && Gate::allows('isMediaCreate'))){
            return response()-> view ('media-sizes.create', [
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
        
        if((Gate::allows('isAdmin') && Gate::allows('isMediaSetting') && Gate::allows('isMediaCreate')) || (Gate::allows('isMedia') && Gate::allows('isMediaSetting') && Gate::allows('isMediaCreate'))){
            if ($request->media_category_id == 'pilih'){
                return back()->withErrors(['media_category_id' => ['Silahkan pilih katagori']])->withInput();
            }

            // Set Code --> start
            $dataSize = MediaSize::all()->last();
            if($dataSize){
                $lastCode = (int)substr($dataSize->code,3,3);
                $newCode = $lastCode + 1;
            } else {
                $newCode = 1;
            }
            
    
            if($newCode < 10 ){
                $code = 'SZ-00'.$newCode;
            } else {
                $code = 'SZ-0'.$newCode;
            }
            // Set Code --> end

            if($request->width < $request->height){
                $size = $request->width.'m x '.$request->height.'m';
            }else{
                $size = $request->height.'m x '.$request->width.'m';
            }

            $dataSizes = MediaSize::where('size', $size)->get();
            foreach($dataSizes as $getSize){
                if($getSize->media_category_id == $request->media_category_id){
                    return back()->withErrors(['width' => ['Ukuran sudah terdaftar, silahkan input ukuran / katagori yang berbeda']])->withInput();
                }
            }

            $request->request->add(['size' => $size, 'code' => $code, 'user_id' => auth()->user()->id]);
            
            $validateData = $request->validate([
                'code' => 'required|unique:media_sizes',
                'size' => 'required',
                'media_category_id' => 'required',
                'width' => 'required',
                'height' => 'required',
                'user_id' => 'required'
            ]);

            MediaSize::create($validateData);
    
            return redirect('/media/media-sizes')->with('success','Ukuran '. $request->size . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MediaSize $mediaSize): Response
    {
        if(Gate::allows('isMediaSetting') && Gate::allows('isMediaRead')){
            $media_categories = MediaCategory::with('media_sizes')->get();
            return response()-> view ('media-sizes.show', [
                'media_size' => $mediaSize,
                'title' => 'Detail Ukuran ' . $mediaSize->size,
                compact('media_categories')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MediaSize $mediaSize): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMediaSetting') && Gate::allows('isMediaEdit')) || (Gate::allows('isMedia') && Gate::allows('isMediaSetting') && Gate::allows('isMediaEdit'))){
            $media_categories = MediaCategory::with('media_sizes')->get();
            return response()->view('media-sizes.edit', [
                'media_size' => $mediaSize,
                'title' => 'Edit Ukuran',
                compact('media_categories')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MediaSize $mediaSize): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMediaSetting') && Gate::allows('isMediaEdit')) || (Gate::allows('isMedia') && Gate::allows('isMediaSetting') && Gate::allows('isMediaEdit'))){
            if($request->width < $request->height){
                $size = $request->width.'m x '.$request->height.'m';
            }else{
                $size = $request->height.'m x '.$request->width.'m';
            }

            if($size != $mediaSize->size){
                $dataSizes = MediaSize::where('size', $size)->get();
                foreach($dataSizes as $getSize){
                    if($getSize->media_category_id == $request->media_category_id){
                        return back()->withErrors(['width' => ['Ukuran sudah terdaftar, silahkan input ukuran yang berbeda']])->withInput();
                    }
                }
            }

            $request->request->add(['size' => $size, 'user_id' => auth()->user()->id]);
            
            $validateData = $request->validate([
                'size' => 'required',
                'media_category_id' => 'required',
                'width' => 'required',
                'height' => 'required',
                'user_id' => 'required'
            ]);
            
            MediaSize::where('id', $mediaSize->id)
                ->update($validateData);
    
            return redirect('/media/media-sizes')->with('success','Ukuran '. $mediaSize->size . ' berhasil diupdate');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MediaSize $mediaSize): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMediaSetting') && Gate::allows('isMediaDelete')) || (Gate::allows('isMedia') && Gate::allows('isMediaSetting') && Gate::allows('isMediaDelete'))){
            if($mediaSize->locations()->exists()){
                return back()->withErrors(['delete' => ['Gagal untuk menghapus data ukuran, terdapat relasi dengan data pada tabel data lainnya']]);
            }else{
                MediaSize::destroy($mediaSize->id);
    
                return redirect('/media/media-sizes')->with('success','Ukuran '. $mediaSize->size .' berhasil dihapus');
            }
        } else {
            abort(403);
        }
    }
}
