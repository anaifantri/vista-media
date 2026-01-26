<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\QuotationRevision;
use App\Models\QuotationStatus;
use App\Models\QuotRevisionStatus;
use App\Models\Area;
use App\Models\City;
use App\Models\Sale;
use App\Models\Client;
use App\Models\ClientGroup;
use App\Models\Contact;
use App\Models\Location;
use App\Models\PrintingProduct;
use App\Models\PrintOrder;
use App\Models\InstallOrder;
use App\Models\InstallationPrice;
use App\Models\Led;
use App\Models\LocationPhoto;
use App\Models\Company;
use App\Models\MediaCategory;
use App\Models\MediaSize;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Carbon\Carbon;
use Gate;
use Illuminate\Support\Facades\Crypt;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    public function home(String $category, String $company_id, Request $request): View
    {
        if(Gate::allows('isQuotation') && Gate::allows('isMarketingRead')){
            if($category == "All"){
                $dataCategory = MediaCategory::where('id', $request->media_category_id)->get()->last();
                $dataQuotations = Quotation::where('company_id', $company_id)->filter(request('search'))->todays()->weekday()->monthly()->annual()->year()->month()->sortable()->category()->orderBy("number", "desc")->paginate(30)->withQueryString();
            }else{
                $dataCategory = MediaCategory::where('name', $category)->get()->last();
                $media_category_id = $dataCategory->id;
                $dataQuotations = Quotation::where('company_id', $company_id)->where('media_category_id', $dataCategory->id)->filter(request('search'))->todays()->weekday()->monthly()->annual()->year()->month()->orderBy("number", "desc")->sortable()->paginate(30)->withQueryString();
            }
    
            $media_categories = MediaCategory::with('quotations')->get();
            $companies = Company::with('quotations')->get();
            $quotation_revisions = QuotationRevision::with('quotation')->get();
            $quotation_statuses = QuotationStatus::with('quotation')->get();
            $quot_revision_statuses = QuotRevisionStatus::with('quotation')->get();
            return view ('quotations.index', [
                'quotations'=>$dataQuotations,
                'data_category'=>$dataCategory,
                'category'=>$category,
                'title' => 'Daftar Penawaran',
                compact('media_categories', 'companies', 'quotation_statuses', 'quotation_revisions', 'quot_revision_statuses')
            ]);
        } else {
            abort(403);
        }
    }

    public function guestPreview(String $category, String $id): View
    { 
        $quotation = Quotation::findOrFail(Crypt::decrypt($id));
        $media_categories = MediaCategory::with('quotations')->get();
        return view('quotations.preview', [
            'quotation' => $quotation,
            'title' => 'Detail Penawaran',
            'category'=>$category,
            'leds' => Led::all(),
            compact('media_categories')
        ]);
    }

    public function preview(String $category, String $id): View
    { 
        if(Gate::allows('isQuotation') && Gate::allows('isMarketingRead')){
            $media_categories = MediaCategory::with('quotations')->get();
            return view('quotations.preview', [
                'quotation' => Quotation::findOrFail($id),
                'title' => 'Detail Penawaran',
                'category'=>$category,
                'leds' => Led::all(),
                compact('media_categories')
            ]);
        } else {
            abort(403);
        }
    }

    public function selectLocation(String $category, String $company_id, Request $request): View
    {
        if((Gate::allows('isAdmin') && Gate::allows('isQuotation') && Gate::allows('isMarketingCreate')) || (Gate::allows('isMarketing') && Gate::allows('isQuotation') && Gate::allows('isMarketingCreate'))){
            $sales = collect([]);
            $dataLocations = collect([]);
            $clients = [];
            $usedPrints = [];
            $usedInstalls = [];
            $freePrints = [];
            $freeInstalls = [];
            if($category == "Service"){
                if($request->serviceType){
                    if($request->serviceType == "new"){
                        $dataLocations = Location::filter(request('search'))->area()->city()->category()->print()->sortable()->orderBy("code", "asc")->get();
                    }else if($request->serviceType == "existing"){
                        $dataSales = Sale::where('company_id', $company_id)->filter(request('search'))->service()->area()->city()->category()->sortable()->get();
                        // $sales = $dataSales;
                        foreach ($dataSales as $sale) {
                            $product = json_decode($sale->product);
                            $description = json_decode($product->description);
                            if($product->category != "Signage" || ($product->category == "Signage" && $description->type != "Videotron")){
                                $revision = QuotationRevision::where('quotation_id', $sale->quotation->id)->get()->last();
                                if($revision){
                                    $notes = json_decode($revision->notes);
                                    $freePrint = $notes->freePrint;
                                    $freeInstall = $notes->freeInstall;
                                    $dataPrints = PrintOrder::where('sale_id', $sale->id)->get();
                                    $dataInstalls = InstallOrder::where('sale_id', $sale->id)->get();
                                }else{
                                    $notes = json_decode($sale->quotation->notes);
                                    $freePrint = $notes->freePrint;
                                    $freeInstall = $notes->freeInstall;
                                    $dataPrints = PrintOrder::where('sale_id', $sale->id)->get();
                                    $dataInstalls = InstallOrder::where('sale_id', $sale->id)->get();
                                }

                                $sales->push($sale);
                                $dataLocations->push(json_decode($sale->product));
                                array_push($clients,json_decode($sale->quotation->clients));
                                array_push($freePrints, $freePrint);
                                array_push($usedPrints, count($dataPrints));
                                array_push($freeInstalls, $freeInstall);
                                array_push($usedInstalls, count($dataInstalls));
    
                                // if($freePrint == 0 || $freePrint - count($dataPrints) == 0 || $freeInstall == 0 || $freeInstall - count($dataInstalls) == 0 ){
                                //     $sales->push($sale);
                                //     $dataLocations->push(json_decode($sale->product));
                                //     array_push($clients,json_decode($sale->quotation->clients));
                                //     array_push($freePrints, $freePrint);
                                //     array_push($usedPrints, count($dataPrints));
                                // }
                            }
                        }
                    }
                }else{
                    $dataSales = Sale::where('company_id', $company_id)->filter(request('search'))->service()->area()->city()->category()->sortable()->get();
                    // $sales = $dataSales;
                    foreach ($dataSales as $sale) {
                        $product = json_decode($sale->product);
                        $description = json_decode($product->description);
                        if($product->category != "Signage" || ($product->category == "Signage" && $description->type != "Videotron")){
                            $revision = QuotationRevision::where('quotation_id', $sale->quotation->id)->get()->last();
                            if($revision){
                                $notes = json_decode($revision->notes);
                                $freePrint = $notes->freePrint;
                                $freeInstall = $notes->freeInstall;
                                $dataPrints = PrintOrder::where('sale_id', $sale->id)->get();
                                $dataInstalls = InstallOrder::where('sale_id', $sale->id)->get();
                            }else{
                                $notes = json_decode($sale->quotation->notes);
                                $freePrint = $notes->freePrint;
                                $freeInstall = $notes->freeInstall;
                                $dataPrints = PrintOrder::where('sale_id', $sale->id)->get();
                                $dataInstalls = InstallOrder::where('sale_id', $sale->id)->get();
                            }

                            
                            
                            $sales->push($sale);
                            $dataLocations->push(json_decode($sale->product));
                            array_push($clients,json_decode($sale->quotation->clients));
                            array_push($freePrints, $freePrint);
                            array_push($usedPrints, count($dataPrints));
                            array_push($freeInstalls, $freeInstall);
                            array_push($usedInstalls, count($dataInstalls));

                            // if($freePrint == 0 || $freePrint - count($dataPrints) == 0 || $freeInstall == 0 || $freeInstall - count($dataInstalls) == 0 ){
                            //     $sales->push($sale);
                            //     $dataLocations->push(json_decode($sale->product));
                            //     array_push($clients,json_decode($sale->quotation->clients));
                            //     array_push($freePrints, $freePrint);
                            //     array_push($usedPrints, count($dataPrints));
                            // }
                        }
                    }
                }
            }else{
                if($request->quotationType){
                    if($request->quotationType == "new"){
                        $dataLocations = Location::quotationNew()->categoryName($category)->filter(request('search'))->area()->city()->type()->sortable()->orderBy("code", "asc")->get();
                    }else if($request->quotationType == "extend"){
                        $dataLocations = Location::categoryName($category)->quotationExtend()->filter(request('search'))->area()->city()->type()->sortable()->orderBy("code", "asc")->get();
                        foreach ($dataLocations as $location) {
                            $salesData = $location->active_sale;
                            $sales->push($salesData);
                            array_push($clients, json_decode($salesData->quotation->clients));
                        }
                    }
                }else{
                    $dataLocations = Location::quotationNew()->categoryName($category)->sortable()->orderBy("code", "asc")->get();
                }
            }
            $media_categories = MediaCategory::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $quotations = Quotation::with('sales')->get();
            return view ('quotations.select-location', [
                'areas' => Area::all(),
                'client_groups' => ClientGroup::all(),
                'cities' => City::all(),
                'locations'=>$dataLocations,
                'clients'=>$clients,
                'free_prints'=>$freePrints,
                'used_prints'=>$usedPrints,
                'free_installs'=>$freeInstalls,
                'used_installs'=>$usedInstalls,
                'sales'=>$sales,
                'category' => $category,
                'title' => 'Pilih Lokasi Penawaran',
                compact('quotations', 'media_categories', 'media_sizes')
            ]);
        } else {
            abort(403);
        }
    }

    public function createQuotation(String $category, String $type, String $locationId, String $area, String $city)
    {
        if((Gate::allows('isAdmin') && Gate::allows('isQuotation') && Gate::allows('isMarketingCreate')) || (Gate::allows('isMarketing') && Gate::allows('isQuotation') && Gate::allows('isMarketingCreate'))){
            $dataId = json_decode($locationId);
            $extendLocation = null;
            $mediaCategory = MediaCategory::where('name', $category)->firstOrFail();
            if($area != "All"){
                $data_area = Area::where('id', $area)->firstOrFail();
                $area = $data_area->area;
            }
            if($city != "All"){
                $data_city = City::where('id', $city)->firstOrFail();
                $city = $data_city->city;
            }
            if($type == "new"){
                $dataQuotations = Location::whereIn('id', $dataId)->get();
            }else if($type == "extend" || $type == "existing"){
                $dataQuotations = Sale::whereIn('id', $dataId)->get();
                if($type == "extend"){
                    $product = json_decode($dataQuotations[0]->product);
                    $extendLocation = Location::findOrFail($product->id);
                }
            }
            $sales = Sale::with('location')->get();
            $printing_products = PrintingProduct::with('printing_prices')->get();
            $quotations = Quotation::with('sales')->get();
            $quotation_revisions = QuotationRevision::with('quotation')->get();
            return response()-> view ('quotations.create', [
                'locations'=>$dataQuotations,
                'extend_location' => $extendLocation,
                'quotation_type'=>$type,
                'clients'=>Client::orderBy("name", "asc")->get(),
                'client_groups'=>ClientGroup::orderBy("group", "asc")->get(),
                'contacts'=>Contact::orderBy("name", "asc")->get(),
                'leds'=>Led::orderBy("name", "asc")->get(),
                'printing_products'=>PrintingProduct::all(),
                'installation_prices'=>InstallationPrice::all(),
                'area'=>$area,
                'city'=>$city,
                'category'=>$category,
                'data_category' => $mediaCategory,
                'data_photos' => LocationPhoto::whereIn('location_id', $dataId)->where('set_default', true)->get(),
                'title' => 'Membuat Penawaran'.$category,
                compact('sales', 'quotations', 'quotation_revisions','printing_products')
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
        if((Gate::allows('isAdmin') && Gate::allows('isQuotation') && Gate::allows('isMarketingCreate')) || (Gate::allows('isMarketing') && Gate::allows('isQuotation') && Gate::allows('isMarketingCreate'))){
            $romawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
            $dataCompany = Company::where('id', $request->company_id)->firstOrFail();
            // Set number --> start
            $lastQuotation = Quotation::where('company_id', $request->company_id)->whereYear('created_at', Carbon::now()->year)->orderBy("number", "asc")->get()->last();
            if($lastQuotation){
                $lastNumber = (int)substr($lastQuotation->number,0,4);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
            
            if($newNumber > 0 && $newNumber < 10){
                $number = '000'.$newNumber.'/SPH/'.$dataCompany->code.'/'.$romawi[(int) date('m')].'-'. date('Y');
            }else if($newNumber >= 10 && $newNumber < 100 ){
                $number = '00'.$newNumber.'/SPH/'.$dataCompany->code.'/'.$romawi[(int) date('m')].'-'. date('Y');
            }else if($newNumber >= 100 && $newNumber < 1000 ){
                $number = '0'.$newNumber.'/SPH/'.$dataCompany->code.'/'.$romawi[(int) date('m')].'-'. date('Y');
            } else {
                $number = $newNumber.'/SPH/'.$dataCompany->code.'/'.$romawi[(int) date('m')].'-'. date('Y');
            }
            // Set number --> end
            $request->request->add(['number' => $number]);
            // dd($request);
            $validateData = $request->validate([
                'number' => 'required|unique:quotations',
                'media_category_id' => 'required',
                'company_id' => 'required',
                'attachment' => 'required',
                'subject' => 'required',
                'body_top' => 'required|max:255',
                'body_end' => 'required',
                'clients' => 'required',
                'notes' => 'required',
                'payment_terms' => 'required',
                'price' => 'required',
                'products' => 'required',
                'created_by' => 'required',
                'modified_by' => 'required'
            ]);
            // dd($validateData);
            Quotation::create($validateData);

            $dataQuotation = Quotation::where('number', $validateData['number'])->firstOrFail();

            $validateData['quotation_id'] = $dataQuotation->id;
            $validateData['status'] = "Created";
            $validateData['updated_by'] = $request->created_by;
            if($dataQuotation->media_category->name == "Service"){
                $validateData['description'] = "Surat penawaran cetak / pasang dengan nomor ".$validateData['number']." telah dibuat dan tersimpan";
            }else{
                $validateData['description'] = "Surat penawaran ". $dataQuotation->media_category->name ." dengan nomor ".$validateData['number']." telah dibuat dan tersimpan";
            }
            
            
            QuotationStatus::create($validateData);
                
            return redirect('/marketing/quotations/preview/'.$dataQuotation->media_category->name.'/'.$dataQuotation->id)->with('success', 'Penawaran dengan nomor '. $validateData['number'] . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Quotation $quotation): Response
    {
        if(Gate::allows('isQuotation') && Gate::allows('isMarketingRead')){
            $quotation_statuses = QuotationStatus::where('quotation_id', $quotation->id)->orderBy("id", "desc")->get();
            $companies = Company::with('quotations')->get();
            $media_categories = MediaCategory::with('quotations')->get();
            $quotation_revisions = Quotation::with('quotation_revisions');
            $dataRevisions = QuotationRevision::where('quotation_id', $quotation->id)->get();
    
            return response()->view('quotations.show', [
                'quotation' => $quotation,
                'quotation_statuses' => $quotation_statuses,
                'last_revision_status' => QuotRevisionStatus::where('quotation_id', $quotation->id)->get()->last(),
                'title' => 'Data Penawaran',
                'data_revisions' => $dataRevisions,
                'leds' => Led::all(),
                'last_status' => QuotationStatus::where('quotation_id', $quotation->id)->orderBy("id", "asc")->get()->last(),
                compact('companies', 'media_categories', 'quotation_revisions')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quotation $quotation): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isQuotation') && Gate::allows('isMarketingEdit')) || (Gate::allows('isMarketing') && Gate::allows('isQuotation') && Gate::allows('isMarketingEdit'))){
            $client = json_decode($quotation->clients);
            if(request('new_products')){
                $products = json_decode(request('new_products'));
                $description = json_decode($products[0]->description);
            }else{
                $products = json_decode($quotation->products);
                $description = json_decode($products[0]->description);
            }
            if(request('new_price')){
                $price = json_decode(request('new_price'));
            }else{
                $price = json_decode($quotation->price);
            }
            $payment_terms = json_decode($quotation->payment_terms);
            $notes = json_decode($quotation->notes);
            $category = $quotation->media_category->name;
            if($category == "Signage"){
                $dataLocations = Location::quotationNew()->categoryName($category)->where('description->type', '!=', 'videotron')->sortable()->orderBy("code", "asc")->get();
            }else{
                $dataLocations = Location::quotationNew()->categoryName($category)->sortable()->orderBy("code", "asc")->get();
            }
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $location_photos = LocationPhoto::with('location')->get();
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $location = null;
            if($category == "Videotron" || ($category == "Signage" && $description->type == "Videotron")){
                $location = Location::findOrFail($products[0]->id);
            }
            return response()-> view ('quotations.edit', [
                'quotation'=>$quotation,
                'locations'=>$dataLocations,
                'location' => $location,
                'areas'=>Area::all(),
                'cities'=>City::all(),
                'client' => $client,
                'products'=> $products,
                'category'=> $category,
                'leds' => Led::all(),
                'printing_products'=>PrintingProduct::all(),
                'installation_prices'=>InstallationPrice::all(),
                'clients'=>Client::orderBy("name", "asc")->get(),
                'client_groups'=>ClientGroup::orderBy("group", "asc")->get(),
                'contacts'=>Contact::orderBy("name", "asc")->get(),
                'price'=> $price,
                'payment_terms'=> $payment_terms,
                'notes'=> $notes,
                'title' => 'Edit Penawaran Nomor '.$quotation->number,
                compact('media_sizes', 'media_categories', 'location_photos', 'areas', 'cities')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quotation $quotation): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isQuotation') && Gate::allows('isMarketingEdit')) || (Gate::allows('isMarketing') && Gate::allows('isQuotation') && Gate::allows('isMarketingEdit'))){
            $validateData = $request->validate([
                'body_top' => 'required|max:255',
                'body_end' => 'required',
                'notes' => 'required',
                'payment_terms' => 'required',
                'price' => 'required',
                'products' => 'required',
                'modified_by' => 'required'
            ]); 
            Quotation::where('id', $quotation->id)
                ->update($validateData);
    
            return redirect('/marketing/quotations/preview/'.$quotation->media_category->name.'/'.$quotation->id)->with('success', 'Penawaran dengan nomor '. $quotation->number . ' berhasil dirubah');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quotation $quotation): RedirectResponse
    {
        //
    }
}
