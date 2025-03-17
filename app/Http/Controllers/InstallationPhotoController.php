<?php

namespace App\Http\Controllers;

use App\Models\InstallationPhoto;
use App\Models\InstallOrder;
use App\Models\Sale;
use App\Models\Quotation;
use App\Models\Area;
use App\Models\City;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Validator;
use Gate;

class InstallationPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(String $company_id): Response
    {
        if(Gate::allows('isDocumentation') && Gate::allows('isWorkshopRead')){
            $installation_photos = InstallationPhoto::with('install_order')->get();
            $sale = Sale::with('install_order')->get();
            $quotations = Quotation::with('sales')->get();
            return response()-> view ('installation-photos.index', [
                'install_orders'=>InstallOrder::where('company_id', $company_id)->filter(request('search'))->area()->city()->year()->month()->days()->sortable()->orderBy("number", "desc")->paginate(20)->withQueryString(),
                'title' => 'Daftar Dokumentasi Pemasangan Gambar',
                compact('installation_photos','sale', 'quotations')
            ]);
        } else {
            abort(403);
        }
    }

    public function showInstallationPhotos(String $installOrderId): View
    { 
        if((Gate::allows('isAdmin') && Gate::allows('isDocumentation') && Gate::allows('isWorkshopCreate')) || (Gate::allows('isDocumentation') && Gate::allows('isWorkshopCreate'))){
            $installationPhotos = InstallationPhoto::where('install_order_id', $installOrderId)->get();
            $install_order = InstallOrder::where('id', $installOrderId)->firstOrFail();
            $sale = Sale::with('install_order')->get();
            $quotations = Quotation::with('sales')->get();
            return view ('installation-photos.show-installation-photos', [
                'installation_photos' => InstallationPhoto::where('install_order_id', $installOrderId)->get(),
                'install_order' => $install_order,
                'title' => 'Data Foto Dokumentasi Pemasangan Gambar',
                compact('sale', 'quotations')
            ]);
        } else {
            abort(403);
        }
    }

    public function createInstallationPhotos(String $installOrderId, String $type): View
    { 
        if((Gate::allows('isAdmin') && Gate::allows('isDocumentation') && Gate::allows('isWorkshopCreate')) || (Gate::allows('isDocumentation') && Gate::allows('isWorkshopCreate'))){
            $install_order = InstallOrder::where('id', $installOrderId)->firstOrFail();
            $sale = Sale::with('install_order')->get();
            $quotations = Quotation::with('sales')->get();
            return view ('installation-photos.create', [
                'type' => $type,
                'install_order' => $install_order,
                'title' => 'Menambahkan Foto Pemasangan Gambar',
                compact('sale', 'quotations')
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
        if((Gate::allows('isAdmin') && Gate::allows('isDocumentation') && Gate::allows('isWorkshopCreate')) || (Gate::allows('isDocumentation') && Gate::allows('isWorkshopCreate'))){
            $request->validate([
                'images.*'=> 'image|file|mimes:jpeg,png,jpg|max:2048',
                'images' => 'required',
            ]);
            if($request->file('images')){
                $images = $request->file('images');
                foreach($images as $image){
                    $installationPhoto = [];
                    $installationPhoto = [
                        'install_order_id' => $request->install_order_id,
                        'company_id' => $request->company_id,
                        'user_id' => $request->user_id,
                        'type' => $request->type,
                        'image' => $image->store('installation-photos')
                    ];
                    InstallationPhoto::create($installationPhoto);
                }
            }
            return redirect('/installation-photos/show/'. $request->install_order_id)->with('success', count($request->images).' foto berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(InstallationPhoto $installationPhoto): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InstallationPhoto $installationPhoto): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isDocumentation') && Gate::allows('isWorkshopEdit')) || (Gate::allows('isDocumentation') && Gate::allows('isWorkshopEdit'))){
            return response()-> view ('installation-photos.edit', [
                'installation_photo' => $installationPhoto,
                'title' => 'Mengganti Foto Pemasangan Gambar'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InstallationPhoto $installationPhoto): RedirectResponse
    {
        
        if((Gate::allows('isAdmin') && Gate::allows('isDocumentation') && Gate::allows('isWorkshopEdit')) || (Gate::allows('isDocumentation') && Gate::allows('isWorkshopEdit'))){
            $request->validate([
                'image' => 'required|image|file|mimes:jpeg,png,jpg|max:2048'
            ]);
            Storage::delete($request->oldPhoto);
            // $validateData['user_id'] = auth()->user()->id;
            $validateData['image'] = $request->file('image')->store('land-agreement-images');

            InstallationPhoto::where('id', $installationPhoto->id)->update($validateData);
            return redirect('/installation-photos/show/'. $installationPhoto->install_order_id)->with('success', 'Foto berhasil diganti');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InstallationPhoto $installationPhoto): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isDocumentation') && Gate::allows('isWorkshopDelete')) || (Gate::allows('isDocumentation') && Gate::allows('isWorkshopDelete'))){
            Storage::delete($installationPhoto->image);
            InstallationPhoto::destroy($installationPhoto->id);
            return redirect('/installation-photos/show/'. $installationPhoto->install_order_id)->with('success', 'Foto berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
