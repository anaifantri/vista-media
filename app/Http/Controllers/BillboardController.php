<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Billboard;
use App\Models\BillboardPhoto;
use App\Models\BillboardCategory;
use App\Models\Area;
use App\Models\City;
use App\Models\Size;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BillboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
            // $products = Product::with(['area', 'city', 'size', 'user'])->sortable();

            return response()-> view ('dashboard.media.billboards.index', [
                'billboards'=>Billboard::filter(request('search'))->area()->city()->condition()->sortable()->paginate(10)->withQueryString(),
                'areas'=>Area::all(),
                'title' => 'Daftar Lokasi Billboard'
            ]);
    }

    public function showBillboard(){
        $dataBillboard = Billboard::orderBy("code", "asc")->get();
        return response()->json(['dataBillboard'=> $dataBillboard]);
    }

    public function preview(string $id): View
    {
        $billboards = Billboard::with('area');
        $areas = Area::with('billboards')->get();
        $cities = City::with('billboards')->get();
        $sizes = Size::with('billboards')->get();
        $billboard_categories = BillboardCategory::with('billboards')->get();

        return view('dashboard.media.billboards.preview', [
            'billboard' => Billboard::findOrFail($id),
            'title' => 'Detail Billboard',
            'billboard_photos'=>BillboardPhoto::all(),
            compact('billboards', 'areas', 'cities', 'sizes', 'billboard_categories')
        ]);
    }

    public function pdfPreview(string $id): View
    {
        $billboards = Billboard::with('area');
        $areas = Area::with('billboards')->get();
        $cities = City::with('billboards')->get();
        $sizes = Size::with('billboards')->get();
        $billboard_categories = BillboardCategory::with('billboards')->get();

        return view('dashboard.media.billboards.pdf-preview', [
            'billboard' => Billboard::findOrFail($id),
            'title' => 'Detail Billboard',
            'billboard_photos'=>BillboardPhoto::all(),
            compact('billboards', 'areas', 'cities', 'sizes', 'billboard_categories')
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            return response()-> view ('dashboard.media.billboards.create', [
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'billboard_categories'=>BillboardCategory::all(),
                'sizes'=>Size::orderBy("size", "asc")->get(),
                'title' => 'Menambahkan Billboard'
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
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            if ($request->area_id == 'Pilih Area'){
                return back()->withErrors(['area_id' => ['Silahkan pilih area']])->withInput();
            }
            if ($request->city == 'Pilih Kota'){
                return back()->withErrors(['city' => ['Silahkan pilih kota']])->withInput();
            }
            if ($request->billboard_category_id == 'pilih'){
                return back()->withErrors(['billboard_category_id' => ['Silahkan pilih katagori']])->withInput();
            }
            if ($request->lighting == 'pilih'){
                return back()->withErrors(['lighting' => ['Silahkan pilih Penerangan']])->withInput();
            }
            if ($request->size_id == 'pilih'){
                return back()->withErrors(['size_id' => ['Silahkan pilih ukuran']])->withInput();
            }
            if ($request->condition == 'pilih'){
                return back()->withErrors(['orientation' => ['Silahkan pilih orientasi']])->withInput();
            }
            if ($request->condition == 'pilih'){
                return back()->withErrors(['condition' => ['Silahkan pilih kondisi']])->withInput();
            }
            if ($request->road_segment == 'pilih'){
                return back()->withErrors(['road_segment' => ['Silahkan pilih type jalan']])->withInput();
            }
            if ($request->max_distance== 'pilih'){
                return back()->withErrors(['max_distance' => ['Silahkan pilih jarak pandang']])->withInput();
            }
            if ($request->speed_average == 'pilih'){
                return back()->withErrors(['speed_average' => ['Silahkan pilih kecepatan kendaraan']])->withInput();
            }
            if ($request->sector == ''){
                return back()->withErrors(['sector' => ['Silahkan pilih minimal 1 kawasan']])->withInput();
            }
            $validateData = $request->validate([
                'code' => 'required|unique:billboards',
                'area_id' => 'required',
                'city_id' => 'required',
                'address' => 'required|max:255',
                'lighting' => 'required',
                'billboard_category_id' => 'required',
                'size_id' => 'required',
                'orientation' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'condition' => 'required',
                'road_segment' => 'required',
                'max_distance' => 'required',
                'speed_average' => 'required',
                'sector' => 'required|max:255',
                'photo' => 'required|image|file|max:1024',
            ]);
           
            if($request->input('price')){
                $validateData['price'] = $request->input('price');
            }else{
                $validateData['price'] = 0;
            }
            
            $validateData['user_id'] = auth()->user()->id;
    
            Billboard::create($validateData);

            $dataBillboards = Billboard::all();
            $billboardId = 0;
            foreach ($dataBillboards as $billboard) {
                if($billboard->code == $validateData['code']){
                    $billboardId = $billboard->id;
                }
            }

            if($request->file('photo')){
                $validateData['photo'] = $request->file('photo')->store('billboard-images');
            }

            $validateData['company_id'] = '1';
            $validateData['billboard_code'] = $request->input('code');
            $validateData['billboard_id'] = $billboardId;

            BillboardPhoto::create($validateData);
            
            return redirect('/dashboard/media/billboards/pdf-preview/'.$billboardId)->with('success',$request->input('billboardCategory'). ' dengan kode '. $validateData['code'] . ' berhasil ditambahkan');
            // return redirect('/dashboard/media/billboards')->with('success',$request->input('billboardCategory'). ' dengan kode '. $validateData['code'] . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Billboard $billboard): Response
    {
        $billboards = Billboard::with('area');
        $areas = Area::with('billboards')->get();
        $cities = City::with('billboards')->get();
        $sizes = Size::with('billboards')->get();
        $billboard_categories = BillboardCategory::with('billboards')->get();

        return response()->view('dashboard.media.billboards.show', [
            'billboard' => $billboard,
            'title' => 'Detail Billboard',
            'billboard_photos'=>BillboardPhoto::all(),
            compact('billboards', 'areas', 'cities', 'sizes', 'billboard_categories')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Billboard $billboard): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            $billboards = Billboard::with('area');
            $areas = Area::with('billboards')->get();
            $cities = City::with('billboards')->get();
            $sizes = Size::with('billboards')->get();
            $billboard_categories = BillboardCategory::with('billboards')->get();
            
            return response()->view('dashboard.media.billboards.edit', [
                'billboard' => $billboard,
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'sizes'=>Size::all(),
                'billboard_photos'=>BillboardPhoto::all(),
                'billboard_categories'=>BillboardCategory::all(),
                'title' => 'Edit Detail Billboard',
                compact('billboards', 'areas', 'cities', 'sizes', 'billboard_categories')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Billboard $billboard): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            if ($request->sector == ''){
                return back()->withErrors(['sector' => ['Silahkan pilih minimal 1 kawasan']])->withInput();
            }
        
        $rules = [
            'area_id' => 'required',
            'city_id' => 'required',
            'address' => 'required|max:255',
            'lighting' => 'required',
            'billboard_category_id' => 'required',
            'size_id' => 'required',
            'orientation' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'condition' => 'required',
            'road_segment' => 'required',
            'max_distance' => 'required',
            'speed_average' => 'required',
            'sector' => 'required|max:255'
        ];

        if ($request->code == $billboard->code) {
            $validateData['code'] = $request->input('code');
        } else {
            $rules['code'] = 'required|unique:products';
        }

        $validateData = $request->validate($rules);
        $validateData['price'] = $request->input('price');
        $validateData['user_id'] = auth()->user()->id;

        Billboard::where('id', $billboard->id)
                    ->update($validateData);
        

        $rules = [
            'photo' => 'image|file|max:1024'
        ];

        $validateData = $request->validate($rules);

        if($request->file('photo')){
            if($request->oldPhoto){
                Storage::delete($request->oldPhoto);
            }
            $validateData['photo'] = $request->file('photo')->store('billboard-images');
        }
        
        $dataPhotos = BillboardPhoto::all();
        $photiId = '';
        foreach ($dataPhotos as $photo) {
            if($photo->billboard_code == $billboard->code && $photo->company_id == '1'){
                if($photo->photo){
                    $photoId = $photo->id;
                }
            }
        }

        $dataBillboards = Billboard::all();
        $billboardId = 0;
        foreach ($dataBillboards as $billboard) {
            if($billboard->code == $request->input('code')){
                $billboardId = $billboard->id;
            }
        }

        $validateData['company_id'] = '1';
        $validateData['billboard_code'] = $request->input('code');
        $validateData['billboard_id'] = $billboardId;

        BillboardPhoto::where('id', $photoId)
                        ->update($validateData);
                        
        return redirect('/dashboard/media/billboards/pdf-preview/'.$billboardId)->with('success',$request->input('billboardCategory'). ' dengan kode '. $request->input('code') . ' berhasil diupdate');
        // return redirect('/dashboard/media/billboards')->with('success','Lokasi Has Been Updated');
        } else {
            abort(403);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Billboard $billboard): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' ){
            $dataPhotos = BillboardPhoto::all();
            $dataCategories = BillboardCategory::all();
            $category = '';
            $id = '';
            foreach ($dataPhotos as $photo) {
                    if($photo->billboard_code == $billboard->code && $photo->company_id == '1'){
                        if($photo->photo){
                            Storage::delete($photo->photo);
                        }
                        $id = $photo->id;
                    }
                }
            foreach ($dataCategories as $categories) {
                if($categories->id == $billboard->billboard_category_id){
                        $category = $categories->name;
                    }
                }
            Billboard::destroy($billboard->id);
            BillboardPhoto::destroy($id);
    
            return redirect('/dashboard/media/billboards')->with('success',$category .' dengan kode ' . $billboard->code . ' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
