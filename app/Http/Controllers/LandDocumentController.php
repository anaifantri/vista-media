<?php

namespace App\Http\Controllers;

use App\Models\LandAgreement;
use App\Models\LandDocument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Gate;

class LandDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    public function createDocuments(String $landAgreementId, String $name): View
    { 
        if((Gate::allows('isAdmin') && Gate::allows('isLegal') && Gate::allows('isMediaCreate')) || (Gate::allows('isMedia') && Gate::allows('isLegal') && Gate::allows('isMediaCreate'))){
            $land_agreement = LandAgreement::where('id', $landAgreementId)->firstOrFail();
            return view ('land-documents.create', [
                'name' => $name,
                'land_agreement_id' => $landAgreementId,
                'title' => 'Menambahkan Document Sewa Lahan'
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isLegal') && Gate::allows('isMediaCreate')) || (Gate::allows('isMedia') && Gate::allows('isLegal') && Gate::allows('isMediaCreate'))){
            $request->validate([
                'land_document.*'=> 'image|file|mimes:jpeg,png,jpg|max:2048',
                'land_document' => 'required',
            ]);
            if($request->file('land_document')){
                $images = $request->file('land_document');
                foreach($images as $image){
                    $landDocument = [];
                    $landDocument = [
                        'land_agreement_id' => $request->land_agreement_id,
                        'user_id' => $request->user_id,
                        'name' => $request->name,
                        'image' => $image->store('land-agreement-images')
                    ];
                    LandDocument::create($landDocument);
                }
            }
            return redirect('/media/land-agreements/'. $request->land_agreement_id.'/edit')->with('success', count($request->land_document).' Dokumen sewa lahan berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LandDocument $landDocument): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LandDocument $landDocument): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isLegal') && Gate::allows('isMediaEdit')) || (Gate::allows('isMedia') && Gate::allows('isLegal') && Gate::allows('isMediaEdit'))){
            return response()-> view ('land-documents.edit', [
                'land_document' => $landDocument,
                'title' => 'Mengganti Dokumen Sewa Lahan'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LandDocument $landDocument): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isLegal') && Gate::allows('isMediaEdit')) || (Gate::allows('isMedia') && Gate::allows('isLegal') && Gate::allows('isMediaEdit'))){
            $request->validate([
                'land_document' => 'required|image|file|mimes:jpeg,png,jpg|max:2048'
            ]);
            Storage::delete($request->oldDocument);
            $validateData['user_id'] = auth()->user()->id;
            $validateData['image'] = $request->file('land_document')->store('land-agreement-images');

            LandDocument::where('id', $landDocument->id)->update($validateData);
            return redirect('/media/land-agreements/'. $landDocument->land_agreement_id.'/edit')->with('success', ' Dokumen sewa lahan berhasil diganti');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LandDocument $landDocument): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isLegal') && Gate::allows('isMediaDelete')) || (Gate::allows('isMedia') && Gate::allows('isLegal') && Gate::allows('isMediaDelete'))){
            if(count(LandDocument::where('land_agreement_id', $landDocument->land_agreement->id)->where('name', $landDocument->name)->get()) > 1 ){
                Storage::delete($landDocument->image);
                LandDocument::destroy($landDocument->id);
                return redirect('/media/land-agreements/'. $landDocument->land_agreement_id.'/edit')->with('success', 'Dokumen sewa lahan berhasil dihapus');
            }else{
                return back()->withErrors(['delete' => ['Gagal menghapus dokumen, Minimal harus ada 1 dokumen']]);
            }
        } else {
            abort(403);
        }
    }
}
