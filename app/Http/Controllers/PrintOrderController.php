<?php

namespace App\Http\Controllers;

use App\Models\PrintOrder;
use App\Models\MediaCategory;
use App\Models\MediaSize;
use App\Models\Sale;
use App\Models\Company;
use App\Models\Location;
use App\Models\Quotation;
use App\Models\QuotationRevision;
use App\Models\PrintingPrice;
use App\Models\PrintingProduct;
use App\Models\Vendor;
use App\Models\Area;
use App\Models\City;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PrintOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $sale = Sale::with('print_order')->get();
        return response()-> view ('print-orders.index', [
            'print_orders'=>PrintOrder::filter(request('search'))->sortable()->orderBy("number", "asc")->paginate(10)->withQueryString(),
            'title' => 'Daftar SPK Cetak',
            'categories' => MediaCategory::all(),
            compact('sale')
        ]);
    }

    public function preview(String $id): View
    { 
        $locations = Location::with('print_orders')->get();
        $sales = Sale::with('print_orders')->get();
        $companies = Company::with('print_orders')->get();
        return view('print-orders.preview', [
            'print_orders' => PrintOrder::findOrFail($id),
            'title' => 'Preview SPK Cetak',
            'categories' => MediaCategory::all(),
            compact('companies', 'locations', 'sales')
        ]);
    }

    public function selectLocations(Request $request): View
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Marketing'){
            if($request->orderType){
                if($request->orderType == "locations"){
                    $locations = Location::print()->filter(request('search'))->area()->city()->category()->sortable()->paginate(15)->withQueryString();
                    return view ('print-orders.select-location', [
                        'locations'=>$locations,
                        'categories'=>MediaCategory::all(),
                        'areas' => Area::all(),
                        'cities' => City::all(),
                        'title' => 'Pilih Lokasi',
                    ]);
                }else if($request->orderType == "sales"){
                    $locations = Sale::print()->filter(request('search'))->area()->city()->category()->sortable()->paginate(15)->withQueryString();
                    return view ('print-orders.select-location', [
                        'locations'=>$locations,
                        'categories'=>MediaCategory::all(),
                        'areas' => Area::all(),
                        'cities' => City::all(),
                        'title' => 'Pilih Lokasi',
                    ]);
                }else if($request->orderType == "free"){
                    $locations = collect([]);
                    $clients = [];
                    $usedPrints = [];
                    $freePrints = [];
                    $dataSales = Sale::free()->filter(request('search'))->area()->city()->category()->sortable()->paginate(15)->withQueryString();
                    foreach($dataSales as $dataSale){
                        $revision = QuotationRevision::where('quotation_id', $dataSale->quotation->id)->get()->last();
                        if($revision){
                            $notes = json_decode($revision->notes);
                            $freePrint = $notes->freePrint;
                            $dataPrints = PrintOrder::where('sale_id', $dataSale->id)->get();
                        }else{
                            $notes = json_decode($dataSale->quotation->notes);
                            $freePrint = $notes->freePrint;
                            $dataPrints = PrintOrder::where('sale_id', $dataSale->id)->get();
                        }
                        if($freePrint > count($dataPrints)){
                            $locations->push($dataSale);
                            array_push($clients,json_decode($dataSale->quotation->clients));
                            array_push($freePrints, $freePrint);
                            array_push($usedPrints, count($dataPrints));
                        }
                    }
                    return view ('print-orders.select-location', [
                        'locations'=>$locations,
                        'clients'=>$clients,
                        'freePrints'=>$freePrints,
                        'usedPrints'=>$usedPrints,
                        'categories'=>MediaCategory::all(),
                        'areas' => Area::all(),
                        'cities' => City::all(),
                        'title' => 'Pilih Lokasi',
                    ]);
                }
            }else{
                $locations = Location::print()->filter(request('search'))->area()->city()->category()->sortable()->paginate(15)->withQueryString();
                $cities = City::with('locations')->get();
                $areas = Area::with('locations')->get();
                return view ('print-orders.select-location', [
                    'locations'=>$locations,
                    'categories'=>MediaCategory::all(),
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
                $freePrint = $notes->freePrint;
            }else{
                $saleProducts = json_decode($dataOrder->quotation->products);
                $notes = json_decode($dataOrder->quotation->notes);
                $freePrint = $notes->freePrint;
            }
            
            foreach($saleProducts as $saleProduct){
                if($saleProduct->code == $dataOrder->product_code){
                    $product = $saleProduct;
                    $description = json_decode($saleProduct->description);
                    $productType = $description->lighting;
                }
            }
            $usedPrint = count(PrintOrder::where('sale_id', $dataOrder->id)->get());
            $quotations = Quotation::with('sales')->get();
            $media_categories = MediaCategory::with('sales')->get();
            if(request('vendorId')){
                if(request('vendorId') != "pilih"){
                    $printing_prices = PrintingPrice::where('vendor_id', request('vendorId'))->product()->get();
                    $vendor = Vendor::findOrFail(request('vendorId'));
                }else{
                    $printing_prices = null;
                    $vendor = null;
                }
            }else{
                $printing_prices = null;
                $vendor = null;
            }
            $vendors = Vendor::print()->get();
            $printing_products = PrintingProduct::with('printing_prices')->get();
            return view('print-orders.create', [
                'dataOrder'=>$dataOrder,
                'product'=>$product,
                'freePrint'=>$freePrint,
                'usedPrint'=>$usedPrint,
                'description'=>$description,
                'title' => 'Tambah SPK Cetak Gambar',
                'vendors' => $vendors,
                'vendor' => $vendor,
                'printing_prices' => $printing_prices,
                'dataId'=>$dataId,
                'orderType'=>$orderType,
                'productType'=>$productType,
                'categories' => MediaCategory::all(),
                compact('quotations', 'media_categories', 'printing_products')
            ]);
        }else if($orderType == "location"){
            $location = Location::findOrFail($dataId);
            if(request('vendorId')){
                if(request('vendorId') != "pilih"){
                    $printing_prices = PrintingPrice::where('vendor_id', request('vendorId'))->product()->get();
                    $vendor = Vendor::findOrFail(request('vendorId'));
                }else{
                    $printing_prices = null;
                    $vendor = null;
                }
            }else{
                $printing_prices = null;
                $vendor = null;
            }
            $areas = Area::with('locations')->get();
            $cities = City::with('locations')->get();
            $media_sizes = MediaSize::with('locations')->get();
            $media_categories = MediaCategory::with('locations')->get();
            $vendors = Vendor::print()->get();
            return view('print-orders.create', [
                'location'=>$location,
                'title' => 'Tambah SPK Cetak Gambar',
                'vendors' => $vendors,
                'vendor' => $vendor,
                'printing_prices' => $printing_prices,
                'orderType'=>$orderType,
                'dataId'=>$dataId,
                'categories' => MediaCategory::all(),
                compact('areas', 'media_categories', 'cities', 'media_sizes')
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $vendors = Vendor::print()->get();
        return response()->view('print-orders.create', [
            'title' => 'Tambah SPK Cetak Gambar',
            'vendors' => $vendors,
            'categories' => MediaCategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Marketing'){
            $romawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VII', 'IX', 'X', 'XI', 'XII'];
            // Set number --> start
            $lastOrder = PrintOrder::where('company_id', $request->company_id)->whereYear('created_at', Carbon::now()->year)->get()->last();
            if($lastOrder){
                $lastNumber = (int)substr($lastOrder->number,0,4);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
            
            if($newNumber > 0 && $newNumber < 10){
                $number = '000'.$newNumber.'/SPK/VISTA/'.$romawi[(int) date('m')].'-'. date('Y');
            }else if($newNumber > 10 && $newNumber < 100 ){
                $number = '00'.$newNumber.'/SPK/VISTA/'.$romawi[(int) date('m')]- date('Y');
            }else if($newNumber > 100 && $newNumber < 1000 ){
                $number = '0'.$newNumber.'/SPK/VISTA/'.$romawi[(int) date('m')].'-'. date('Y');
            } else {
                $number = $newNumber.'/SPK/VISTA/'.$romawi[(int) date('m')].'-'. date('Y');
            }
            // Set number --> end

            $request->request->add(['number' => $number]);
            $validateData = $request->validate([
                'number' => 'required|unique:print_orders',
                'company_id' => 'required',
                'vendor_id' => 'required',
                'sale_id' => 'required',
                'location_id' => 'required',
                'theme' => 'required',
                'notes' => 'required',
                'product' => 'required',
                'created_by' => 'required',
                'updated_by' => 'required',
                'price' => 'required',
                'design' => 'required'
            ]);

            if($request->file('design')){
                $validateData['design'] = $request->file('design')->store('print-designs');
            }
            
            PrintOrder::create($validateData);

            $dataOrder = PrintOrder::where('number', $validateData['number'])->firstOrFail();
    
            return redirect('/marketing/print-orders/preview/'.$dataOrder->id)->with('success','SPK Cetak dengan nomor '. $number . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PrintOrder $printOrder): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrintOrder $printOrder): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrintOrder $printOrder): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrintOrder $printOrder): RedirectResponse
    {
        //
    }
}
