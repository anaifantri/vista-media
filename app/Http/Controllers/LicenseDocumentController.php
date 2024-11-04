<?php

namespace App\Http\Controllers;

use App\Models\LicenseDocument;
use App\Models\License;
use App\Models\LicensingCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Gate;

class LicenseDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    public function createDocuments(String $licenseId): View
    { 
        if((Gate::allows('isAdmin') && Gate::allows('isLegal') && Gate::allows('isMediaCreate')) || (Gate::allows('isMedia') && Gate::allows('isLegal') && Gate::allows('isMediaCreate'))){
            $license = License::where('id', $licenseId)->firstOrFail();
            return view ('license-documents.create', [
                'name' => $license->licensing_category->name,
                'license_id' => $licenseId,
                'licensing_category_id' => $license->licensing_category->id,
                'title' => 'Menambahkan Document Izin'.$license->licensing_category->name
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
                'document_license.*'=> 'image|file|mimes:jpeg,png,jpg|max:2048',
                'document_license' => 'required',
            ]);
            if($request->file('document_license')){
                $images = $request->file('document_license');
                foreach($images as $image){
                    $documentLicense = [];
                    $documentLicense = [
                        'license_id' => $request->license_id,
                        'user_id' => auth()->user()->id,
                        'licensing_category_id' => $request->licensing_category_id,
                        'name' => $request->name,
                        'image' => $image->store('license-images')
                    ];
                    LicenseDocument::create($documentLicense);
                }
            }
            return redirect('/media/licenses/'. $request->license_id.'/edit')->with('success', count($request->document_license).' Dokumen izin '.$request->name.' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LicenseDocument $licenseDocument): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LicenseDocument $licenseDocument): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isLegal') && Gate::allows('isMediaEdit')) || (Gate::allows('isMedia') && Gate::allows('isLegal') && Gate::allows('isMediaEdit'))){
            $licensing_categories = LicensingCategory::with('licenses')->get();
            return response()-> view ('license-documents.edit', [
                'license_document' => $licenseDocument,
                'title' => 'Mengganti Dokumen Izin'.$licenseDocument->license->licensing_category->name
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LicenseDocument $licenseDocument): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isLegal') && Gate::allows('isMediaEdit')) || (Gate::allows('isMedia') && Gate::allows('isLegal') && Gate::allows('isMediaEdit'))){
            $request->validate([
                'license_document' => 'required|image|file|mimes:jpeg,png,jpg|max:2048'
            ]);
            Storage::delete($request->oldDocument);
            $validateData['user_id'] = auth()->user()->id;
            $validateData['image'] = $request->file('license_document')->store('license-images');

            LicenseDocument::where('id', $licenseDocument->id)->update($validateData);
            return redirect('/media/licenses/'. $licenseDocument->license_id.'/edit')->with('success', ' Dokumen izin '.$licenseDocument->name.' berhasil diganti');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LicenseDocument $licenseDocument): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isLegal') && Gate::allows('isMediaDelete')) || (Gate::allows('isMedia') && Gate::allows('isLegal') && Gate::allows('isMediaDelete'))){
            Storage::delete($licenseDocument->image);
            LicenseDocument::destroy($licenseDocument->id);
            return redirect('/media/licenses/'. $licenseDocument->license_id.'/edit')->with('success', 'Dokumen izin '.$licenseDocument->name.' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
