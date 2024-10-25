<?php

namespace App\Http\Controllers;

use App\Models\InstallOrder;
use App\Models\PrintOrder;
use App\Models\Sale;
use App\Models\MediaSize;
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

class InstallOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $sale = Sale::with('install_order')->get();
        return response()-> view ('install-orders.index', [
            'install_orders'=>InstallOrder::filter(request('search'))->sortable()->orderBy("code", "asc")->paginate(10)->withQueryString(),
            'title' => 'Daftar SPK Pemasangan Gambar',
            compact('sale')
        ]);
    }

    public function selectLocations(Request $request): View
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Marketing'){
            if($request->orderType){
                if($request->orderType == "locations"){
                    $locations = Location::print()->filter(request('search'))->area()->city()->category()->sortable()->paginate(15)->withQueryString();
                    return view ('install-orders.select-location', [
                        'locations'=>$locations,
                        'areas' => Area::all(),
                        'cities' => City::all(),
                        'title' => 'Pilih Lokasi',
                    ]);
                }else if($request->orderType == "sales"){
                    $locations = Sale::install()->filter(request('search'))->area()->city()->category()->sortable()->paginate(15)->withQueryString();
                    return view ('install-orders.select-location', [
                        'locations'=>$locations,
                        'areas' => Area::all(),
                        'cities' => City::all(),
                        'title' => 'Pilih Lokasi',
                    ]);
                }else if($request->orderType == "free"){
                    $locations = collect([]);
                    $clients = [];
                    $usedInstalls = [];
                    $freeInstalls = [];
                    $dataSales = Sale::freeInstall()->filter(request('search'))->area()->city()->category()->sortable()->paginate(15)->withQueryString();
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
                            $locations->push($dataSale);
                            array_push($clients,json_decode($dataSale->quotation->clients));
                            array_push($freeInstalls, $freeInstall);
                            array_push($usedInstalls, count($dataInstalls));
                        }
                    }
                    return view ('install-orders.select-location', [
                        'locations'=>$locations,
                        'clients'=>$clients,
                        'freeInstalls'=>$freeInstalls,
                        'usedInstalls'=>$usedInstalls,
                        'areas' => Area::all(),
                        'cities' => City::all(),
                        'title' => 'Pilih Lokasi',
                    ]);
                }
            }else{
                $locations = Location::print()->filter(request('search'))->area()->city()->category()->sortable()->paginate(15)->withQueryString();
                $cities = City::with('locations')->get();
                $areas = Area::with('locations')->get();
                return view ('install-orders.select-location', [
                    'locations'=>$locations,
                    'areas' => Area::all(),
                    'cities' => City::all(),
                    'title' => 'Pilih Lokasi',
                    compact('areas', 'cities')
                ]);
            }
        } else {
            abort(403);
        }
    }

    public function createOrder(String $dataId, String $orderType, Request $request): View
    {
        if ($orderType == "sale"){
            $dataOrder = Sale::findOrFail($dataId);
            $saleNumber = $dataOrder->number;
            $revision = QuotationRevision::where('quotation_id', $dataOrder->quotation->id)->get()->last();
            if($revision){
                $saleProducts = json_decode($revision->products);
                $notes = json_decode($revision->notes);
                $freeInstall = $notes->freeInstall;
            }else{
                $saleProducts = json_decode($dataOrder->quotation->products);
                $notes = json_decode($dataOrder->quotation->notes);
                $freeInstall = $notes->freeInstall;
            }
            
            foreach($saleProducts as $saleProduct){
                if($saleProduct->code == $dataOrder->product_code){
                    $product = $saleProduct;
                    $description = json_decode($saleProduct->description);
                    $productType = $description->lighting;
                }
            }
            $usedInstall = count(InstallOrder::where('sale_id', $dataOrder->id)->get());
            $quotations = Quotation::with('sales')->get();
            $media_categories = MediaCategory::with('sales')->get();
            return view('install-orders.create', [
                'dataOrder'=>$dataOrder,
                'print_orders'=>PrintOrder:: whereDoesntHave('install_order')->get(),
                'product'=>$product,
                'freeInstall'=>$freeInstall,
                'usedInstall'=>$usedInstall,
                'description'=>$description,
                'title' => 'Tambah SPK Cetak Gambar',
                'installation_prices' => InstallationPrice::all(),
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
            $media_categories = MediaCategory::with('locations')->get();
            $location_photo = LocationPhoto::where('location_id', $location->id)->where('set_default', true)->get();
            return view('install-orders.create', [
                'location'=>$location,
                'print_orders'=>PrintOrder:: whereDoesntHave('install_order')->get(),
                'title' => 'Tambah SPK Cetak Gambar',
                'installation_prices' => InstallationPrice::all(),
                'location_photo' => $location_photo[0]->photo,
                'orderType'=>$orderType,
                'dataId'=>$dataId,
                compact('areas', 'media_categories', 'cities', 'media_sizes')
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('install-orders.create', [
            'title' => 'Tambah SPK Psang Gambar',
            'categories' => MediaCategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(InstallOrder $installOrder): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InstallOrder $installOrder): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InstallOrder $installOrder): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InstallOrder $installOrder): RedirectResponse
    {
        //
    }
}
