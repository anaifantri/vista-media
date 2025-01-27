<?php

namespace App\Http\Controllers;

use App\Models\InstallOrder;
use App\Models\PrintOrder;
use App\Models\Sale;
use App\Models\MediaSize;
use App\Models\MediaCategory;
use App\Models\Company;
use App\Models\Location;
use App\Models\LocationPhoto;
use App\Models\Quotation;
use App\Models\QuotationRevision;
use App\Models\InstallationPrice;
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

class InstallOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(String $company_id): Response
    {
        if(Gate::allows('isOrder') && Gate::allows('isMarketingRead')){
            $dataInstalls = InstallOrder::where('company_id', $company_id)->year()->month()->days()->filter(request('search'))->todays()->weekday()->monthly()->annual()->sortable()->orderBy("number", "asc")->get();
            $sale = Sale::with('install_order')->get();
            $quotations = Quotation::with('sales')->get();
            $print_order = PrintOrder::with('install_order')->get();
            $locations = Location::with('install_orders')->get();
            return response()-> view ('install-orders.index', [
                'install_orders'=>InstallOrder::where('company_id', $company_id)->year()->filter(request('search'))->year()->month()->days()->todays()->weekday()->monthly()->annual()->sortable()->orderBy("number", "desc")->paginate(20)->withQueryString(),
                'data_installs'=>$dataInstalls,
                'title' => 'Daftar SPK Pemasangan Gambar',
                compact('sale', 'print_order', 'locations', 'quotations')
            ]);
        } else {
            abort(403);
        }
    }

    public function installOrders(String $status, String $company_id)
    { 
        if(Gate::allows('isOrder') && Gate::allows('isMarketingRead')){
            // $install_orders = null;
            // $getStatus = "";
            if($status == "install-sales"){
                $getStatus = "Berbayar";
                $install_orders = InstallOrder::where('company_id', $company_id)->filter(request('search'))->sales()->orderBy("number", "asc")->paginate(10)->withQueryString();
            }else if($status == "free-sales"){
                $getStatus = "Gratis Penjualan";
                $install_orders = InstallOrder::where('company_id', $company_id)->filter(request('search'))->freeSales()->orderBy("number", "asc")->paginate(10)->withQueryString();
            }else if($status == "free-other"){
                $getStatus = "Gratis Lain-Lain";
                $install_orders = InstallOrder::where('company_id', $company_id)->filter(request('search'))->freeOther()->orderBy("number", "asc")->paginate(10)->withQueryString();
            }
            return view ('install-orders.install-orders', [
                'install_orders'=> $install_orders,
                'status'=>$status,
                'getStatus'=>$getStatus,
                'title' => 'Daftar SPK Pasang '.$getStatus
            ]);
        } else {
            abort(403);
        }
    }

    public function preview(String $id): View
    { 
        if(Gate::allows('isOrder') && Gate::allows('isMarketingRead')){
            $locations = Location::with('install_orders')->get();
            $sale = Sale::with('install_order')->get();
            $companies = Company::with('install_orders')->get();
            $print_order = PrintOrder::with('install_order')->get();
            return view('install-orders.preview', [
                'install_order' => InstallOrder::findOrFail($id),
                'title' => 'Preview SPK Pasang',
                compact('companies', 'locations', 'sale', 'print_order')
            ]);
        } else {
            abort(403);
        }
    }

    public function selectLocations(String $company_id, Request $request): View
    {
        if((Gate::allows('isAdmin') && Gate::allows('isOrder') && Gate::allows('isMarketingCreate')) || (Gate::allows('isMarketing') && Gate::allows('isOrder') && Gate::allows('isMarketingCreate'))){
            if($request->orderType){
                if($request->orderType == "locations"){
                    $locations = Location::print()->filter(request('search'))->area()->city()->category()->sortable()->orderBy("code", "asc")->paginate(30)->withQueryString();
                    return view ('install-orders.select-location', [
                        'locations'=>$locations,
                        'areas' => Area::all(),
                        'cities' => City::all(),
                        'title' => 'Pilih Lokasi Pemasangan',
                    ]);
                }else if($request->orderType == "free"){
                    $sales = collect([]);
                    $clients = [];
                    $usedInstalls = [];
                    $freeInstalls = [];
                    $dataSales = Sale::where('company_id', $company_id)->free()->filter(request('search'))->area()->city()->category()->sortable()->get();
                    foreach($dataSales as $dataSale){
                        $revision = QuotationRevision::where('quotation_id', $dataSale->quotation->id)->get()->last();
                        if($revision){
                            $notes = json_decode($revision->notes);
                            $freeInstall = $notes->freeInstall;
                            $dataInstalls = InstallOrder::where('sale_id', $dataSale->id)->get();
                        }else{
                            $notes = json_decode($dataSale->quotation->notes);
                            $freeInstall = $notes->freeInstall;
                            $dataInstalls = InstallOrder::where('sale_id', $dataSale->id)->get();
                        }
                        if($freeInstall > count($dataInstalls)){
                            $sales->push($dataSale);
                            array_push($clients,json_decode($dataSale->quotation->clients));
                            array_push($freeInstalls, $freeInstall);
                            array_push($usedInstalls, count($dataInstalls));
                        }
                    }
                    $locations = Location::with('sales')->get();
                    $quotations = Quotation::with('sales')->get();
                    $quotation_revisions = QuotationRevision::with('quotation')->get();
                    return view ('install-orders.select-location', [
                        'sales'=>$sales,
                        'clients'=>$clients,
                        'freeInstalls'=>$freeInstalls,
                        'usedInstalls'=>$usedInstalls,
                        'areas' => Area::all(),
                        'cities' => City::all(),
                        'title' => 'Pilih Lokasi Pemasangan',
                        compact('locations', 'quotations', 'quotation_revisions')
                    ]);
                }elseif($request->orderType == "sales"){
                    $sales = collect([]);
                    $clients = [];
                    $usedInstalls = [];
                    $freeInstalls = [];
                    $installTypes = [];
                    $dataSales = Sale::where('company_id', $company_id)->installOrder()->filter(request('search'))->area()->city()->category()->sortable()->get();
                    foreach($dataSales as $dataSale){
                        $product = json_decode($dataSale->product);
                        $revision = QuotationRevision::where('quotation_id', $dataSale->quotation->id)->get()->last();
                        if($revision){
                            $notes = json_decode($revision->notes);
                            $freeInstall = $notes->freeInstall;
                            $dataInstalls = InstallOrder::where('sale_id', $dataSale->id)->get();
                            $price = json_decode($revision->price);
                            foreach($price->objInstalls as $install){
                                if($install->code == $dataSale->product->code){
                                    $installType = $install->type;
                                }
                            }
                        }else{
                            $notes = json_decode($dataSale->quotation->notes);
                            $freeInstall = $notes->freeInstall;
                            $dataInstalls = InstallOrder::where('sale_id', $dataSale->id)->get();
                            $price = json_decode($dataSale->quotation->price);
                            foreach($price->objInstalls as $install){
                                if($install->code == $product->code){
                                    $installType = $install->type;
                                }
                            }
                        }
                        if($freeInstall < count($dataInstalls) || $freeInstall == 0){
                            foreach($price->objInstalls as $install){
                                if($install->code == $product->code){
                                    if($install->price != 0){
                                        $sales->push($dataSale);
                                        array_push($clients,json_decode($dataSale->quotation->clients));
                                        array_push($freeInstalls, $freeInstall);
                                        array_push($installTypes, $installType);
                                        array_push($usedInstalls, count($dataInstalls));
                                    }
                                }
                            }
                        }
                    }
                    $locations = Location::with('sales')->get();
                    $quotations = Quotation::with('sales')->get();
                    $quotation_revisions = QuotationRevision::with('quotation')->get();
                    return view ('install-orders.select-location', [
                        'sales'=>$sales,
                        'clients'=>$clients,
                        'installTypes'=>$installTypes,
                        'areas' => Area::all(),
                        'cities' => City::all(),
                        'title' => 'Pilih Lokasi Pemasangan',
                        compact('locations', 'quotations', 'quotation_revisions')
                    ]);
                }
            }else{
                $sales = collect([]);
                $clients = [];
                $usedInstalls = [];
                $freeInstalls = [];
                $installTypes = [];
                $dataSales = Sale::installOrder()->filter(request('search'))->area()->city()->category()->sortable()->get();
                foreach($dataSales as $dataSale){
                    $product = json_decode($dataSale->product);
                    $revision = QuotationRevision::where('quotation_id', $dataSale->quotation->id)->get()->last();
                    if($revision){
                        $notes = json_decode($revision->notes);
                        $freeInstall = $notes->freeInstall;
                        $dataInstalls = InstallOrder::where('sale_id', $dataSale->id)->get();
                        $price = json_decode($revision->price);
                        foreach($price->objInstalls as $install){
                            if($install->code == $dataSale->product->code){
                                $installType = $install->type;
                            }
                        }
                    }else{
                        $notes = json_decode($dataSale->quotation->notes);
                        $freeInstall = $notes->freeInstall;
                        $dataInstalls = InstallOrder::where('sale_id', $dataSale->id)->get();
                        $price = json_decode($dataSale->quotation->price);
                        foreach($price->objInstalls as $install){
                            if($install->code == $product->code){
                                $installType = $install->type;
                            }
                        }
                    }
                    if($freeInstall < count($dataInstalls) || $freeInstall == 0){
                        foreach($price->objInstalls as $install){
                            if($install->code == $product->code){
                                if($install->price != 0){
                                    $sales->push($dataSale);
                                    array_push($clients,json_decode($dataSale->quotation->clients));
                                    array_push($freeInstalls, $freeInstall);
                                    array_push($installTypes, $installType);
                                    array_push($usedInstalls, count($dataInstalls));
                                }
                            }
                        }
                    }
                }
                $locations = Location::with('sales')->get();
                $quotations = Quotation::with('sales')->get();
                $quotation_revisions = QuotationRevision::with('quotation')->get();
                return view ('install-orders.select-location', [
                    'sales'=>$sales,
                    'clients'=>$clients,
                    'installTypes'=>$installTypes,
                    'areas' => Area::all(),
                    'cities' => City::all(),
                    'title' => 'Pilih Lokasi Pemasangan',
                    compact('locations', 'quotations', 'quotation_revisions')
                ]);
            }
        } else {
            abort(403);
        }
    }

    public function createOrder(String $dataId, String $orderType, Request $request): View
    {
        if((Gate::allows('isAdmin') && Gate::allows('isOrder') && Gate::allows('isMarketingCreate')) || (Gate::allows('isMarketing') && Gate::allows('isOrder') && Gate::allows('isMarketingCreate'))){
            if($orderType == "free"){
                $dataOrder = Sale::findOrFail($dataId);
                $saleNumber = $dataOrder->number;
                $revision = QuotationRevision::where('quotation_id', $dataOrder->quotation->id)->get()->last();
                $product = json_decode($dataOrder->product);
                if($revision){
                    $notes = json_decode($revision->notes);
                    $freeInstall = $notes->freeInstall;
                }else{
                    $notes = json_decode($dataOrder->quotation->notes);
                    $freeInstall = $notes->freeInstall;
                }
                $description = json_decode($product->description);
                $productType = $description->lighting;
                $usedInstall = count(InstallOrder::where('sale_id', $dataOrder->id)->get());
                $quotations = Quotation::with('sales')->get();
                $media_categories = MediaCategory::with('sales')->get();
                return view('install-orders.create', [
                    'dataOrder'=>$dataOrder,
                    'product'=>$product,
                    'freeInstall'=>$freeInstall,
                    'usedInstall'=>$usedInstall,
                    'description'=>$description,
                    'title' => 'Tambah SPK Pasang Gambar',
                    'dataId'=>$dataId,
                    'orderType'=>$orderType,
                    'productType'=>$productType,
                    compact('quotations', 'media_categories')
                ]);
            }else if ($orderType == "sales"){
                $dataOrder = Sale::findOrFail($dataId);
                $saleNumber = $dataOrder->number;
                $revision = QuotationRevision::where('quotation_id', $dataOrder->quotation->id)->get()->last();
                $product = json_decode($dataOrder->product);
                if($revision){
                    $notes = json_decode($revision->notes);
                    $freeInstall = $notes->freeInstall;
                }else{
                    $notes = json_decode($dataOrder->quotation->notes);
                    $freeInstall = $notes->freeInstall;
                }
                $description = json_decode($product->description);
                $productType = $description->lighting;
                $usedInstall = count(InstallOrder::where('sale_id', $dataOrder->id)->get());
                $quotations = Quotation::with('sales')->get();
                $media_categories = MediaCategory::with('sales')->get();
                return view('install-orders.create', [
                    'dataOrder'=>$dataOrder,
                    'product'=>$product,
                    'freeInstall'=>$freeInstall,
                    'usedInstall'=>$usedInstall,
                    'description'=>$description,
                    'title' => 'Tambah SPK Pasang Gambar',
                    'dataId'=>$dataId,
                    'orderType'=>$orderType,
                    'productType'=>$productType,
                    compact('quotations', 'media_categories')
                ]);
            }else if($orderType == "location"){
                $location = Location::findOrFail($dataId);
                $areas = Area::with('locations')->get();
                $cities = City::with('locations')->get();
                $media_sizes = MediaSize::with('locations')->get();
                $location_photos = LocationPhoto::with('location')->get();
                $media_categories = MediaCategory::with('locations')->get();
                return view('install-orders.create', [
                    'location'=>$location,
                    'title' => 'Tambah SPK Pasang Gambar',
                    'orderType'=>$orderType,
                    'dataId'=>$dataId,
                    compact('areas', 'media_categories', 'cities', 'media_sizes', 'location_photos')
                ]);
            }
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('install-orders.create', [
            'title' => 'Tambah SPK Pasang Gambar',
            'categories' => MediaCategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isOrder') && Gate::allows('isMarketingCreate')) || (Gate::allows('isMarketing') && Gate::allows('isOrder') && Gate::allows('isMarketingCreate'))){
            if($request->file('design')){
                $request->validate([
                    'design'=> 'image|file|mimes:jpeg,png,jpg|max:1024',
                ]);
            }
            $romawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VII', 'IX', 'X', 'XI', 'XII'];
            $dataCompany = Company::where('id', $request->company_id)->firstOrFail();
            // Set number --> start
            $lastOrder = InstallOrder::where('company_id', $request->company_id)->whereYear('created_at', Carbon::now()->year)->get()->last();
            if($lastOrder){
                $lastNumber = (int)substr($lastOrder->number,0,4);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
            
            if($newNumber > 0 && $newNumber < 10){
                $number = '000'.$newNumber.'/SPK-PS/'.$dataCompany->code.'/'.$romawi[(int) date('m')].'-'. date('Y');
            }else if($newNumber >= 10 && $newNumber < 100 ){
                $number = '00'.$newNumber.'/SPK-PS/'.$dataCompany->code.'/'.$romawi[(int) date('m')].'-'. date('Y');
            }else if($newNumber >= 100 && $newNumber < 1000 ){
                $number = '0'.$newNumber.'/SPK-PS/'.$dataCompany->code.'/'.$romawi[(int) date('m')].'-'. date('Y');
            } else {
                $number = $newNumber.'/SPK-PS/'.$dataCompany->code.'/'.$romawi[(int) date('m')].'-'. date('Y');
            }
            // Set number --> end

            $request->request->add(['number' => $number]);
            $validateData = $request->validate([
                'number' => 'required|unique:install_orders',
                'company_id' => 'required',
                'sale_id' => 'nullable',
                'print_order_id' => 'nullable',
                'location_id' => 'required',
                'theme' => 'required',
                'install_at' => 'required',
                'notes' => 'nullable',
                'type' => 'required',
                'product' => 'required',
                'created_by' => 'required',
                'updated_by' => 'required',
                'design' => 'nullable'
            ]);

            if($request->file('design')){
                $validateData['design'] = $request->file('design')->store('install-designs');
            }
            
            InstallOrder::create($validateData);

            $dataOrder = InstallOrder::where('number', $validateData['number'])->firstOrFail();
    
            return redirect('/marketing/install-orders/preview/'.$dataOrder->id)->with('success','SPK Pasang dengan nomor '. $number . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(InstallOrder $installOrder): Response
    {
        if(Gate::allows('isOrder') && Gate::allows('isMarketingRead')){
            $locations = Location::with('install_orders')->get();
            $sale = Sale::with('install_order')->get();
            $companies = Company::with('install_orders')->get();
            $print_order = PrintOrder::with('install_order')->get();
            return response()-> view ('install-orders.show', [
                'install_order' => $installOrder,
                'title' => 'Data SPK Pasang',
                compact('companies', 'locations', 'sale', 'print_order')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InstallOrder $installOrder): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isOrder') && Gate::allows('isMarketingEdit')) || (Gate::allows('isMarketing') && Gate::allows('isOrder') && Gate::allows('isMarketingEdit'))){
            $product = json_decode($installOrder->product);
            $locations = Location::with('print_orders')->get();
            $sale = Sale::with('print_order')->get();
            $companies = Company::with('print_orders')->get();
            return response()-> view ('install-orders.edit', [
                'install_order' => $installOrder,
                'product'=>$product,
                'title' => 'Edit Data SPK Pasang',
                compact('companies', 'locations', 'sale')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InstallOrder $installOrder): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isOrder') && Gate::allows('isMarketingEdit')) || (Gate::allows('isMarketing') && Gate::allows('isOrder') && Gate::allows('isMarketingEdit'))){
            if($request->file('design')){
                $request->validate([
                    'design'=> 'image|file|mimes:jpeg,png,jpg|max:1024',
                ]);
            }
            $rules = [
                'theme' => 'required',
                'install_at' => 'required',
                'updated_by' => 'required',
                'notes' => 'nullable'
            ];

            $validateData = $request->validate($rules);
                
            if($request->file('design')){
                if($request->oldDesign){
                    Storage::delete($request->oldDesign);
                }
                $validateData['design'] = $request->file('design')->store('install-designs');
            }
            
            InstallOrder::where('id', $installOrder->id)
                ->update($validateData);
    
            return redirect('/marketing/install-orders/preview/'.$installOrder->id)->with('success','SPK pasang dengan nomor '. $installOrder->number . ' berhasil diedit');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InstallOrder $installOrder): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isOrder') && Gate::allows('isMarketingDelete')) || (Gate::allows('isMarketing') && Gate::allows('isOrder') && Gate::allows('isMarketingDelete'))){
            Storage::delete($installOrder->design);
            InstallOrder::destroy($installOrder->id);
            return redirect('/marketing/install-orders')->with('success', 'Data SPK pasang dengan nomor '.$installOrder->number.' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
