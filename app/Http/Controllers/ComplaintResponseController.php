<?php

namespace App\Http\Controllers;

use App\Models\ComplaintResponse;
use App\Models\Complaint;
use App\Models\User;
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

class ComplaintResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        if(Gate::allows('isComplaint') && Gate::allows('isWorkshopRead')){
            $users = User::with('complaint_responses')->get();
            $sales = Sale::with('complaint_responses')->get();
            $locations = Location::with('complaint_responses')->get();
            $complaints = Complaint::with('complaint_response')->get();
            return response()-> view ('complaint-responses.index', [
                'complaint_responses'=>ComplaintResponse::filter(request('search'))->month()->year()->sortable()->paginate(30)->withQueryString(),
                'title' => 'Daftar Penyelesaian Komplain',
                compact('sales', 'locations', 'users', 'complaints')
            ]);
        } else {
            abort(403);
        }
    }
    
    public function responseCreate(String $complaintId): View
    { 
        if((Gate::allows('isAdmin') || Gate::allows('isWorkshop') || Gate::allows('isMedia') || Gate::allows('isMarketing') || Gate::allows('isAccounting')) && (Gate::allows('isComplaint') && Gate::allows('isWorkshopCreate'))){
            $complaint = Complaint::findOrFail($complaintId);
            $sale = Sale::findOrFail($complaint->sale_id);
            return view ('complaint-responses.create', [
                'complaint' => $complaint,
                'sale' => $sale,
                'title' => 'Menambahkan Data Respon Komplain'
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
            $sales = Sale::with('complaints')->get();
            $locations = Location::with('complaints')->get();
            return response()->view ('complaint-responses.select-complaint', [
                'complaints'=>Complaint::open()->filter(request('search'))->month()->year()->get(),
                'title' => 'Pilih Data Komplain',
                compact('sales', 'locations')
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

            $validateData = $request->validate([
                'user_id' => 'required',
                'sale_id' => 'required',
                'location_id' => 'required',
                'complaint_id' => 'required',
                'response_date' => 'required',
                'problem_solving' => 'required',
                'problem' => 'required'
            ]);
            $getImages = $request->file('images');
            $images = [];
            foreach($getImages as $image){
                array_push($images,$image->store('response-images'));
            }
            $validateData['images'] = json_encode($images);

            ComplaintResponse::create($validateData);

            return redirect('/workshop/complaint-responses')->with('success', ' Data penanganan / perbaikan komplain dari klien berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ComplaintResponse $complaintResponse): Response
    {
        if(Gate::allows('isComplaint') && Gate::allows('isWorkshopRead')){
            $complaint = Complaint::findOrFail($complaintResponse->complaint_id);
            $sale = Sale::findOrFail($complaintResponse->sale_id);
            return response()-> view ('complaint-responses.show', [
                'complaint_response'=>$complaintResponse,
                'complaint'=>$complaint,
                'sale'=>$sale,
                'title' => 'Detail Penanganan Komplain'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ComplaintResponse $complaintResponse): Response
    {
        if((Gate::allows('isAdmin') || Gate::allows('isWorkshop') || Gate::allows('isMedia') || Gate::allows('isMarketing') || Gate::allows('isAccounting')) && (Gate::allows('isComplaint') && Gate::allows('isWorkshopEdit'))){
            $sale = Sale::findOrFail($complaintResponse->sale_id);
            $complaint = Complaint::findOrFail($complaintResponse->complaint_id);
            return response()-> view ('complaint-responses.edit', [
                'complaint_response'=>$complaintResponse,
                'complaint'=>$complaint,
                'sale'=>$sale,
                'title' => 'Edit Data Penanganan Komplain'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ComplaintResponse $complaintResponse): RedirectResponse
    {
        if((Gate::allows('isAdmin') || Gate::allows('isWorkshop') || Gate::allows('isMedia') || Gate::allows('isMarketing') || Gate::allows('isAccounting')) && (Gate::allows('isComplaint') && Gate::allows('isWorkshopEdit'))){
            if($request->file('images')){
                $request->validate([
                    'images.*'=> 'image|file|mimes:jpeg,png,jpg|max:2048'
                ]);
            }
            $rules = [
                'problem' => 'required',
                'problem_solving' => 'required',
                'response_date' => 'required'
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
                    array_push($images,$image->store('response-images'));
                }
                $validateData['images'] = json_encode($images);
            }

            ComplaintResponse::where('id', $complaintResponse->id)->update($validateData);

            return redirect('/workshop/complaint-responses/'.$complaintResponse->id)->with('success','Data penanganan komplain dari klien berhasil dirubah');

        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ComplaintResponse $complaintResponse): RedirectResponse
    {
        if((Gate::allows('isAdmin') || Gate::allows('isWorkshop') || Gate::allows('isMedia') || Gate::allows('isMarketing') || Gate::allows('isAccounting')) && (Gate::allows('isComplaint') && Gate::allows('isWorkshopDelete'))){
            if($complaintResponse->images){
                $images = json_decode($complaintResponse->images);
                foreach ($images as $image) {
                    Storage::delete($image);
                }
            }

            ComplaintResponse::destroy($complaintResponse->id);

            return redirect('/workshop/complaint-responses')->with('success', 'Data penanganan komplain dari klien dihapus');
        } else {
            abort(403);
        }
    }
}
