<?php

namespace App\Http\Controllers;

use App\Models\PublishContent;
use App\Models\Sale;
use App\Models\Location;
use App\Models\Quotation;
use App\Models\Area;
use App\Models\City;
use App\Models\MediaSize;
use App\Models\MediaCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Validator;
use Gate;

class PublishContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        if(Gate::allows('isContent') && Gate::allows('isWorkshopRead')){
            $sale = Sale::with('publish_contents')->get();
            $location = Location::with('publish_contents')->get();
            return response()-> view ('publish-contents.index', [
                'publish_contents'=>PublishContent::filter(request('search'))->month()->year()->sortable()->paginate(30)->withQueryString(),
                'title' => 'Daftar Penayangan Materi Videotron',
                compact('sale', 'location')
            ]);
        } else {
            abort(403);
        }
    }

    public function publishContentFree(): View
    { 
        if((Gate::allows('isAdmin') || Gate::allows('isMedia') || Gate::allows('isWorkshop') || Gate::allows('isAccounting') || Gate::allows('isMarketing')) && (Gate::allows('isContent') && Gate::allows('isWorkshopCreate'))){
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            return view ('publish-contents.select-location', [
                'locations'=>Location::videotron()->filter(request('search'))->area()->city()->get(),
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'title' => 'Pilih Data Penjualan',
                compact('areas', 'cities', 'media_sizes', 'media_categories')
            ]);
        } else {
            abort(403);
        }
    }

    public function publishContentSale(): View
    { 
        if((Gate::allows('isAdmin') || Gate::allows('isMedia') || Gate::allows('isWorkshop') || Gate::allows('isAccounting') || Gate::allows('isMarketing')) && (Gate::allows('isContent') && Gate::allows('isWorkshopCreate'))){
            $quotation = Quotation::with('sales')->get();
            return view ('publish-contents.select-sale', [
                'sales'=>Sale::videotron()->activeSale()->filter(request('search'))->area()->city()->get(),
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'title' => 'Pilih Data Penjualan',
                compact('quotation')
            ]);
        } else {
            abort(403);
        }
    }
    
    public function publishCreateFree(String $locationId): View
    { 
        if((Gate::allows('isAdmin') || Gate::allows('isWorkshop') || Gate::allows('isMedia') || Gate::allows('isMarketing') || Gate::allows('isAccounting')) && (Gate::allows('isContent') && Gate::allows('isWorkshopCreate'))){
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $location = Location::findOrFail($locationId);
            return view ('publish-contents.publish-free', [
                'location' => $location,
                'title' => 'Menambahkan Data Penayangan Materi Videotron',
                compact('areas', 'cities', 'media_sizes', 'media_categories')
            ]);
        } else {
            abort(403);
        }
    }
    
    public function publishCreateSale(String $saleId): View
    { 
        if((Gate::allows('isAdmin') || Gate::allows('isWorkshop') || Gate::allows('isMedia') || Gate::allows('isMarketing') || Gate::allows('isAccounting')) && (Gate::allows('isContent') && Gate::allows('isWorkshopCreate'))){
            $sale = Sale::findOrFail($saleId);
            return view ('publish-contents.publish-sale', [
                'sale' => $sale,
                'title' => 'Menambahkan Data Penayangan Materi Videotron'
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
        if((Gate::allows('isAdmin') || Gate::allows('isMedia') || Gate::allows('isWorkshop') || Gate::allows('isAccounting') || Gate::allows('isMarketing')) && (Gate::allows('isContent') && Gate::allows('isWorkshopCreate'))){
            return response()->view ('publish-contents.create', [
                'title' => 'Pilih Status Penayangan'
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
        if((Gate::allows('isAdmin') || Gate::allows('isWorkshop') || Gate::allows('isMedia') || Gate::allows('isMarketing') || Gate::allows('isAccounting')) && (Gate::allows('isContent') && Gate::allows('isWorkshopCreate'))){
            $request->validate([
                'images.*'=> 'image|file|mimes:jpeg,png,jpg|max:2048',
                'images' => 'required',
            ]);
        
            $validateData = $request->validate([
                'sale_id' => 'nullable',
                'location_id' => 'required',
                'publish_date' => 'required',
                'theme' => 'required',
                'notes' => 'required',
                'status' => 'required',
                'created_by' => 'required',
                'updated_by' => 'required'
            ]);
            $getImages = $request->file('images');
            $images = [];
            foreach($getImages as $image){
                array_push($images,$image->store('videotron-images'));
            }
            $validateData['images'] = json_encode($images);

            PublishContent::create($validateData);

            return redirect('/workshop/publish-contents')->with('success', ' Foto penayangan materi videotron berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PublishContent $publishContent): Response
    {
        if(Gate::allows('isContent') && Gate::allows('isWorkshopRead')){
            $sale = Sale::where('id',$publishContent->sale_id)->get()->last();
            $location = Location::findOrFail($publishContent->location_id);
            return response()-> view ('publish-contents.show', [
                'publish_content'=>$publishContent,
                'sale'=>$sale,
                'location'=>$location,
                'title' => 'Detail Penayangan Materi Videotron'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PublishContent $publishContent): Response
    {
        if((Gate::allows('isAdmin') || Gate::allows('isWorkshop') || Gate::allows('isMedia') || Gate::allows('isMarketing') || Gate::allows('isAccounting')) && (Gate::allows('isContent') && Gate::allows('isWorkshopEdit'))){
            $sale = Sale::where('id',$publishContent->sale_id)->get()->last();
            $location = Location::findOrFail($publishContent->location_id);
            return response()-> view ('publish-contents.edit', [
                'publish_content'=>$publishContent,
                'sale'=>$sale,
                'location'=>$location,
                'title' => 'Detail Penayangan Materi Videotron'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PublishContent $publishContent): RedirectResponse
    {
        if((Gate::allows('isAdmin') || Gate::allows('isWorkshop') || Gate::allows('isMedia') || Gate::allows('isMarketing') || Gate::allows('isAccounting')) && (Gate::allows('isContent') && Gate::allows('isWorkshopEdit'))){
            if($request->file('images')){
                $request->validate([
                    'images.*'=> 'image|file|mimes:jpeg,png,jpg|max:2048'
                ]);
            }
            $rules = [
                'updated_by' => 'required',
                'theme' => 'required',
                'publish_date' => 'required',
                'notes' => 'required',
            ];

            $validateData = $request->validate($rules);

            if($request->file('images')){
                $oldImages = json_decode(request('old_images'));
                foreach ($oldImages as $oldImage) {
                    Storage::delete($oldImage);
                }
                
                $newImages = $request->file('images');
                $images = [];
                foreach($newImages as $image){
                    array_push($images,$image->store('videotron-images'));
                }
                $validateData['images'] = json_encode($images);
            }

            PublishContent::where('id', $publishContent->id)->update($validateData);

            return redirect('/workshop/publish-contents/'.$publishContent->id)->with('success','Data upload materi videotron berhasil dirubah');

        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PublishContent $publishContent): RedirectResponse
    {
        if((Gate::allows('isAdmin') || Gate::allows('isWorkshop') || Gate::allows('isMedia') || Gate::allows('isMarketing') || Gate::allows('isAccounting')) && (Gate::allows('isContent') && Gate::allows('isWorkshopDelete'))){
            if($publishContent->images){
                $images = json_decode($publishContent->images);
                foreach ($images as $image) {
                    Storage::delete($image);
                }
            }

            PublishContent::destroy($publishContent->id);

            return redirect('/workshop/publish-contents')->with('success', 'Data upload materi videotron dihapus');
        } else {
            abort(403);
        }
    }
}
