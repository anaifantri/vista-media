<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
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

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        if(Gate::allows('isComplaint') && Gate::allows('isWorkshopRead'))
        {
            $sale = Sale::with('complaints')->get();
            $location = Location::with('complaints')->get();
            return response()-> view ('complaints.index', [
                'complaints'=>Complaint::filter(request('search'))->month()->year()->sortable()->paginate(30)->withQueryString(),
                'title' => 'Daftar Komplain',
                compact('sale', 'location')
            ]);
        } else {
            abort(403);
        }
    }
    
    public function complaintReport(): View
    { 
        if(Gate::allows('isComplaint') && Gate::allows('isWorkshopRead'))
        {
            $sale = Sale::with('complaints')->get();
            $location = Location::with('complaints')->get();
            return view ('complaints.complaint-report', [
                'complaints'=>Complaint::filter(request('search'))->month()->year()->sortable()->get(),
                'title' => 'Laporan Komplain',
                compact('sale', 'location')
            ]);
        } else {
            abort(403);
        }
    }
    
    public function complaintCreate(String $saleId): View
    { 
        if((Gate::allows('isAdmin') || Gate::allows('isWorkshop') || Gate::allows('isMedia') || Gate::allows('isMarketing') || Gate::allows('isAccounting')) && (Gate::allows('isComplaint') && Gate::allows('isWorkshopCreate'))){
            $sale = Sale::findOrFail($saleId);
            return view ('complaints.create', [
                'sale' => $sale,
                'title' => 'Menambahkan Data Komplain'
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
        if((Gate::allows('isAdmin') || Gate::allows('isMedia') || Gate::allows('isWorkshop') || Gate::allows('isAccounting') || Gate::allows('isMarketing')) && (Gate::allows('isComplaint') && Gate::allows('isWorkshopCreate'))){
            $quotation = Quotation::with('sales')->get();
            return response()->view ('complaints.select-sale', [
                'sales'=>Sale::activeSale()->filter(request('search'))->area()->city()->get(),
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'title' => 'Pilih Data Penjualan',
                compact('quotation')
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
        if((Gate::allows('isAdmin') || Gate::allows('isWorkshop') || Gate::allows('isMedia') || Gate::allows('isMarketing') || Gate::allows('isAccounting')) && (Gate::allows('isComplaint') && Gate::allows('isWorkshopCreate'))){
            $request->validate([
                'images.*'=> 'image|file|mimes:jpeg,png,jpg|max:2048',
                'images' => 'required',
            ]);

            $romawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
            // Set number --> start
            $lastComplaint = Complaint::whereYear('created_at', Carbon::now()->year)->orderBy("number", "asc")->get()->last();
            if($lastComplaint){
                $lastNumber = (int)substr($lastComplaint->number,0,4);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
            
            if($newNumber > 0 && $newNumber < 10){
                $number = '000'.$newNumber.'/CP/'.$romawi[(int) date('m')].'-'. date('Y');
            }else if($newNumber >= 10 && $newNumber < 100 ){
                $number = '00'.$newNumber.'/CP/'.$romawi[(int) date('m')].'-'. date('Y');
            }else if($newNumber >= 100 && $newNumber < 1000 ){
                $number = '0'.$newNumber.'/CP/'.$romawi[(int) date('m')].'-'. date('Y');
            } else {
                $number = $newNumber.'/CP/'.$romawi[(int) date('m')].'-'. date('Y');
            }
            // Set number --> end

            $request->request->add(['number' => $number]);
            $validateData = $request->validate([
                'number' => 'required|unique:complaints',
                'sale_id' => 'nullable',
                'location_id' => 'required',
                'complaint_date' => 'required',
                'descriptions' => 'required',
                'notes' => 'required',
                'created_by' => 'required',
                'updated_by' => 'required'
            ]);
            $getImages = $request->file('images');
            $images = [];
            foreach($getImages as $image){
                array_push($images,$image->store('complaint-images'));
            }
            $validateData['images'] = json_encode($images);

            Complaint::create($validateData);

            return redirect('/workshop/complaints')->with('success', ' Data komplain dari klien berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Complaint $complaint): Response
    {
        if(Gate::allows('isComplaint') && Gate::allows('isWorkshopRead')){
            $sale = Sale::findOrFail($complaint->sale_id);
            $location = Location::findOrFail($complaint->location_id);
            return response()-> view ('complaints.show', [
                'complaint'=>$complaint,
                'sale'=>$sale,
                'location'=>$location,
                'title' => 'Detail Komplain'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Complaint $complaint): Response
    {
        if((Gate::allows('isAdmin') || Gate::allows('isWorkshop') || Gate::allows('isMedia') || Gate::allows('isMarketing') || Gate::allows('isAccounting')) && (Gate::allows('isComplaint') && Gate::allows('isWorkshopEdit'))){
            $sale = Sale::findOrFail($complaint->sale_id);
            $location = Location::findOrFail($complaint->location_id);
            return response()-> view ('complaints.edit', [
                'complaint'=>$complaint,
                'sale'=>$sale,
                'location'=>$location,
                'title' => 'Edit Data Komplain'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Complaint $complaint): RedirectResponse
    {
        if((Gate::allows('isAdmin') || Gate::allows('isWorkshop') || Gate::allows('isMedia') || Gate::allows('isMarketing') || Gate::allows('isAccounting')) && (Gate::allows('isComplaint') && Gate::allows('isWorkshopEdit'))){
            if($request->file('images')){
                $request->validate([
                    'images.*'=> 'image|file|mimes:jpeg,png,jpg|max:2048'
                ]);
            }
            $rules = [
                'updated_by' => 'required',
                'descriptions' => 'required',
                'complaint_date' => 'required',
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
                    array_push($images,$image->store('complaint-images'));
                }
                $validateData['images'] = json_encode($images);
            }

            Complaint::where('id', $complaint->id)->update($validateData);

            return redirect('/workshop/complaints/'.$complaint->id)->with('success','Data komplain dari klien berhasil dirubah');

        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complaint $complaint): RedirectResponse
    {
        if((Gate::allows('isAdmin') || Gate::allows('isWorkshop') || Gate::allows('isMedia') || Gate::allows('isMarketing') || Gate::allows('isAccounting')) && (Gate::allows('isComplaint') && Gate::allows('isWorkshopDelete'))){
            if($complaint->images){
                $images = json_decode($complaint->images);
                foreach ($images as $image) {
                    Storage::delete($image);
                }
            }

            Complaint::destroy($complaint->id);

            return redirect('/workshop/complaints')->with('success', 'Data komplain dari klien dihapus');
        } else {
            abort(403);
        }
    }
}
