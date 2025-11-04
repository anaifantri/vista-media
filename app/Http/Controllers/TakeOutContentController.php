<?php

namespace App\Http\Controllers;

use App\Models\TakeOutContent;
use App\Models\PublishContent;
use App\Models\Sale;
use App\Models\User;
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

class TakeOutContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        if(Gate::allows('isContent') && Gate::allows('isWorkshopRead')){
            $sale = Sale::with('take_out_contents')->get();
            $location = Location::with('take_out_contents')->get();
            $user = User::with('take_out_contents')->get();
            return response()-> view ('takeout-contents.index', [
                'take_out_contents'=>TakeOutContent::filter(request('search'))->month()->year()->sortable()->paginate(30)->withQueryString(),
                'title' => 'Daftar Penurunan Materi Videotron',
                compact('sale', 'location', 'user')
            ]);
        } else {
            abort(403);
        }
    }    

    public function takeoutCreate(String $contentId): View
    { 
        if((Gate::allows('isAdmin') || Gate::allows('isWorkshop') || Gate::allows('isMedia') || Gate::allows('isMarketing') || Gate::allows('isAccounting')) && (Gate::allows('isContent') && Gate::allows('isWorkshopCreate'))){
            $publish_content = PublishContent::findOrFail($contentId);
            $sale = Sale::where('id',$publish_content->sale_id)->get()->last();
            $location = Location::findOrFail($publish_content->location_id);
            return view ('takeout-contents.create', [
                'publish_content'=>$publish_content,
                'sale'=>$sale,
                'location'=>$location,
                'title' => 'Tambah Data Take Out Materi Videotron'
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
            $quotation = Quotation::with('sales')->get();
            $sale = Sale::with('publish_contents')->get();
            $location = Location::with('publish_contents')->get();
            return response()->view ('takeout-contents.select-publish-content', [
                'publish_contents'=>PublishContent::filter(request('search'))->takeout()->sortable()->orderBy('publish_date', 'desc')->paginate(30)->withQueryString(),
                'title' => 'Pilih Data Penayangan Materi Videotron Yang Akan Di Take Out',
                compact('quotation', 'sale', 'location')
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
            $validateData = $request->validate([
                'sale_id' => 'nullable',
                'user_id' => 'required',
                'location_id' => 'required',
                'publish_content_id' => 'required',
                'take_out_date' => 'required',
                'notes' => 'required'
            ]);

            TakeOutContent::create($validateData);

            return redirect('/workshop/takeout-contents')->with('success', ' Data takeout materi videotron berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TakeOutContent $takeoutContent): Response
    {
        if(Gate::allows('isContent') && Gate::allows('isWorkshopRead')){
            $publish_content = PublishContent::findOrFail( $takeoutContent->publish_content_id);
            $sale = Sale::where('id', $takeoutContent->sale_id)->get()->last();
            $location = Location::findOrFail( $takeoutContent->location_id);
            return response()-> view ('takeout-contents.show', [
                'take_out_content'=> $takeoutContent,
                'publish_content'=> $publish_content,
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
    public function edit(TakeOutContent $takeoutContent): Response
    {
        if((Gate::allows('isAdmin') || Gate::allows('isWorkshop') || Gate::allows('isMedia') || Gate::allows('isMarketing') || Gate::allows('isAccounting')) && (Gate::allows('isContent') && Gate::allows('isWorkshopEdit'))){
            $publish_content = PublishContent::findOrFail($takeoutContent->publish_content_id);
            $sale = Sale::where('id', $takeoutContent->sale_id)->get()->last();
            $location = Location::findOrFail( $takeoutContent->location_id);
            return response()->view ('takeout-contents.edit', [
                'take_out_content'=>$takeoutContent,
                'publish_content'=>$publish_content,
                'sale'=>$sale,
                'location'=>$location,
                'title' => 'Edit Data Take Out Materi Videotron'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TakeOutContent $takeoutContent): RedirectResponse
    {
        if((Gate::allows('isAdmin') || Gate::allows('isWorkshop') || Gate::allows('isMedia') || Gate::allows('isMarketing') || Gate::allows('isAccounting')) && (Gate::allows('isContent') && Gate::allows('isWorkshopEdit'))){
           $rules = [
                'user_id' => 'required',
                'take_out_date' => 'required',
                'notes' => 'required',
            ];

            $validateData = $request->validate($rules);

            TakeOutContent::where('id', $takeoutContent->id)->update($validateData);

            return redirect('/workshop/takeout-contents/'.$takeoutContent->id)->with('success','Data takeout materi videotron berhasil dirubah');

        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TakeOutContent $takeoutContent): RedirectResponse
    {
        if((Gate::allows('isAdmin') || Gate::allows('isWorkshop') || Gate::allows('isMedia') || Gate::allows('isMarketing') || Gate::allows('isAccounting')) && (Gate::allows('isContent') && Gate::allows('isWorkshopDelete'))){
            TakeOutContent::destroy($takeoutContent->id);

            return redirect('/workshop/takeout-contents')->with('success', 'Data takeout materi videotron dihapus');
        } else {
            abort(403);
        }
    }
}
