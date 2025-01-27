<?php

namespace App\Http\Controllers;

use App\Models\PrintOrder;
use App\Models\MediaSize;
use App\Models\MediaCategory;
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
use Validator;
use Gate;

class PrintOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(String $company_id): Response
    {
        if(Gate::allows('isOrder') && Gate::allows('isMarketingRead')){
            $dataPrints = PrintOrder::where('company_id', $company_id)->year()->month()->days()->filter(request('search'))->todays()->weekday()->monthly()->annual()->sortable()->orderBy("number", "asc")->get();
            $sale = Sale::with('print_order')->get();
            $quotations = Quotation::with('sales')->get();
            $vendors = Vendor::with('print_orders')->get();
            return response()-> view ('print-orders.index', [
                'print_orders'=>PrintOrder::where('company_id', $company_id)->year()->filter(request('search'))->year()->month()->days()->todays()->weekday()->monthly()->annual()->sortable()->orderBy("number", "desc")->paginate(20)->withQueryString(),
                'data_prints'=>$dataPrints,
                'amount'=>PrintOrder::where('company_id', $company_id)->filter(request('search'))->year()->month()->days()->todays()->weekday()->monthly()->annual()->sum('price'),
                'title' => 'Daftar SPK Cetak',
                compact('sale', 'vendors', 'quotations')
            ]);
        } else {
            abort(403);
        }
    }

    public function printOrders(String $status, String $company_id)
    { 
        if(Gate::allows('isOrder') && Gate::allows('isMarketingRead')){
            if($status == "print-sales"){
                $getStatus = "Berbayar";
                $print_orders = PrintOrder::where('company_id', $company_id)->filter(request('search'))->sales()->orderBy("number", "asc")->paginate(10)->withQueryString();
            }else if($status == "free-sales"){
                $getStatus = "Gratis Penjualan";
                $print_orders = PrintOrder::where('company_id', $company_id)->filter(request('search'))->freeSales()->orderBy("number", "asc")->paginate(10)->withQueryString();
            }else if($status == "free-other"){
                $getStatus = "Gratis Lain-Lain";
                $print_orders = PrintOrder::where('company_id', $company_id)->filter(request('search'))->freeOther()->orderBy("number", "asc")->paginate(10)->withQueryString();
            }
            return view ('print-orders.print-orders', [
                'print_orders'=> $print_orders,
                'status'=>$status,
                'getStatus'=>$getStatus,
                'title' => 'Daftar SPK Cetak '.$getStatus
            ]);
        } else {
            abort(403);
        }
    }

    public function getPrintingPrices(String $vendorId, String $productType)
    {
        $printingPrices = PrintingPrice::where('vendor_id', $vendorId)->whereHas('printing_product', function($query) use ($productType){
            $query->where('type', $productType);
        })->get();
        $printingProducts = PrintingProduct::where('type', $productType)->get();

        return response()->json(['printingPrices'=> $printingPrices, 'printingProducts'=>$printingProducts]);
    }

    public function preview(String $id): View
    { 
        if(Gate::allows('isOrder') && Gate::allows('isMarketingRead')){
            $locations = Location::with('print_orders')->get();
            $sales = Sale::with('print_orders')->get();
            $companies = Company::with('print_orders')->get();
            $vendors = Vendor::with('print_orders')->get();
            return view('print-orders.preview', [
                'print_order' => PrintOrder::findOrFail($id),
                'title' => 'Preview SPK Cetak',
                compact('companies', 'locations', 'sales', 'vendors')
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
                    return view ('print-orders.select-location', [
                        'locations'=>$locations,
                        'areas' => Area::all(),
                        'cities' => City::all(),
                        'title' => 'Pilih Lokasi',
                    ]);
                }else if($request->orderType == "free"){
                    $sales = collect([]);
                    $clients = [];
                    $usedPrints = [];
                    $freePrints = [];
                    $dataSales = Sale::where('company_id', $company_id)->free()->filter(request('search'))->area()->city()->category()->sortable()->get();
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
                            $sales->push($dataSale);
                            array_push($clients,json_decode($dataSale->quotation->clients));
                            array_push($freePrints, $freePrint);
                            array_push($usedPrints, count($dataPrints));
                        }
                    }
                    $locations = Location::with('sales')->get();
                    $quotations = Quotation::with('sales')->get();
                    $quotation_revisions = QuotationRevision::with('quotation')->get();
                    return view ('print-orders.select-location', [
                        'sales'=>$sales,
                        'clients'=>$clients,
                        'freePrints'=>$freePrints,
                        'usedPrints'=>$usedPrints,
                        'areas' => Area::all(),
                        'cities' => City::all(),
                        'title' => 'Pilih Lokasi',
                        compact('locations', 'quotations', 'quotation_revisions')
                    ]);
                }elseif($request->orderType == "sales"){
                    $sales = collect([]);
                    $clients = [];
                    $usedPrints = [];
                    $freePrints = [];
                    $printProducts = [];
                    $dataSales = Sale::where('company_id', $company_id)->printOrderSide()->filter(request('search'))->area()->city()->category()->sortable()->get();
                    foreach($dataSales as $dataSale){
                        $product = json_decode($dataSale->product);
                        $revision = QuotationRevision::where('quotation_id', $dataSale->quotation->id)->get()->last();
                        $index = 0;
                        if($revision){
                            $notes = json_decode($revision->notes);
                            $freePrint = $notes->freePrint;
                            $dataPrints = PrintOrder::where('sale_id', $dataSale->id)->get();
                            $price = json_decode($revision->price);
                            foreach($price->objPrints as $print){
                                if($print->code == $dataSale->product->code){
                                    $printProduct = $print->printProduct;
                                    $sideView = $price->objSideView[$index];
                                    // dd($sideView);
                                }
                                $index++;
                            }
                        }else{
                            $notes = json_decode($dataSale->quotation->notes);
                            $freePrint = $notes->freePrint;
                            $dataPrints = PrintOrder::where('sale_id', $dataSale->id)->get();
                            $price = json_decode($dataSale->quotation->price);
                            foreach($price->objPrints as $print){
                                if($print->code == $product->code){
                                    $printProduct = $print->printProduct;
                                    $sideView = $price->objSideView[$index];
                                    // dd($sideView);
                                }
                                $index++;
                            }
                        }
                        // dd(count($dataPrints));
                        if($sideView->left == true && $sideView->right == true){
                            if(($freePrint < count($dataPrints) || $freePrint == 0) && count($dataPrints) < 2){
                                $sales->push($dataSale);
                                array_push($clients,json_decode($dataSale->quotation->clients));
                                array_push($freePrints, $freePrint);
                                array_push($printProducts, $printProduct);
                                array_push($usedPrints, count($dataPrints));
                            }
                        }else{
                            if(($freePrint < count($dataPrints) || $freePrint == 0) && count($dataPrints) == 0){
                                $sales->push($dataSale);
                                array_push($clients,json_decode($dataSale->quotation->clients));
                                array_push($freePrints, $freePrint);
                                array_push($printProducts, $printProduct);
                                array_push($usedPrints, count($dataPrints));
                            }
                        }
                        // if($freePrint < count($dataPrints) || $freePrint == 0){
                        //     $sales->push($dataSale);
                        //     array_push($clients,json_decode($dataSale->quotation->clients));
                        //     array_push($freePrints, $freePrint);
                        //     array_push($printProducts, $printProduct);
                        //     array_push($usedPrints, count($dataPrints));
                        // }
                    }
                    $locations = Location::with('sales')->get();
                    $quotations = Quotation::with('sales')->get();
                    $quotation_revisions = QuotationRevision::with('quotation')->get();
                    return view ('print-orders.select-location', [
                        'sales'=>$sales,
                        'clients'=>$clients,
                        'print_products'=>$printProducts,
                        'areas' => Area::all(),
                        'cities' => City::all(),
                        'title' => 'Pilih Lokasi',
                        compact('locations', 'quotations', 'quotation_revisions')
                    ]);
                }
            }else{
                $sales = collect([]);
                $clients = [];
                $usedPrints = [];
                $freePrints = [];
                $printProducts = [];
                $dataSales = Sale::printOrder()->filter(request('search'))->area()->city()->category()->sortable()->get();
                foreach($dataSales as $dataSale){
                    $product = json_decode($dataSale->product);
                    $revision = QuotationRevision::where('quotation_id', $dataSale->quotation->id)->get()->last();
                    if($revision){
                        $notes = json_decode($revision->notes);
                        $freePrint = $notes->freePrint;
                        $dataPrints = PrintOrder::where('sale_id', $dataSale->id)->get();
                        $price = json_decode($revision->price);
                        foreach($price->objPrints as $print){
                            if($print->code == $dataSale->product->code){
                                $printProduct = $print->printProduct;
                            }
                        }
                    }else{
                        $notes = json_decode($dataSale->quotation->notes);
                        $freePrint = $notes->freePrint;
                        $dataPrints = PrintOrder::where('sale_id', $dataSale->id)->get();
                        $price = json_decode($dataSale->quotation->price);
                        foreach($price->objPrints as $print){
                            if($print->code == $product->code){
                                $printProduct = $print->printProduct;
                            }
                        }
                    }
                    if($freePrint < count($dataPrints) || $freePrint == 0){
                        $sales->push($dataSale);
                        array_push($clients,json_decode($dataSale->quotation->clients));
                        array_push($freePrints, $freePrint);
                        array_push($printProducts, $printProduct);
                        array_push($usedPrints, count($dataPrints));
                    }
                }
                $locations = Location::with('sales')->get();
                $quotations = Quotation::with('sales')->get();
                $quotation_revisions = QuotationRevision::with('quotation')->get();
                return view ('print-orders.select-location', [
                    'sales'=>$sales,
                    'clients'=>$clients,
                    'print_products'=>$printProducts,
                    'areas' => Area::all(),
                    'cities' => City::all(),
                    'title' => 'Pilih Lokasi',
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
                    $freePrint = $notes->freePrint;
                }else{
                    $notes = json_decode($dataOrder->quotation->notes);
                    $freePrint = $notes->freePrint;
                }
                $description = json_decode($product->description);
                $productType = $description->lighting;
                $usedPrint = count(PrintOrder::where('sale_id', $dataOrder->id)->get());
                $quotations = Quotation::with('sales')->get();
                $media_categories = MediaCategory::with('sales')->get();
                if(request('vendorID')){
                    if(request('vendorID') != "pilih"){
                        $printing_prices = PrintingPrice::where('vendor_id', request('vendorID'))->name()->product()->get();
                        $vendor = Vendor::findOrFail(request('vendorID'));
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
                    compact('quotations', 'media_categories', 'printing_products')
                ]);
            }else if ($orderType == "sales"){
                $dataOrder = Sale::findOrFail($dataId);
                $saleNumber = $dataOrder->number;
                $revision = QuotationRevision::where('quotation_id', $dataOrder->quotation->id)->get()->last();
                $product = json_decode($dataOrder->product);
                if($revision){
                    $notes = json_decode($revision->notes);
                    $freePrint = $notes->freePrint;
                    $price = json_decode($revision->price);
                    foreach($price->objPrints as $print){
                        if($print->code == $dataSale->product->code){
                            $printProduct = $print->printProduct;
                        }
                    }
                }else{
                    $notes = json_decode($dataOrder->quotation->notes);
                    $freePrint = $notes->freePrint;
                    $price = json_decode($dataOrder->quotation->price);
                    foreach($price->objPrints as $print){
                        if($print->code == $product->code){
                            $printProduct = $print->printProduct;
                        }
                    }
                }
                $description = json_decode($product->description);
                $productType = $description->lighting;
                $usedPrint = count(PrintOrder::where('sale_id', $dataOrder->id)->get());
                $quotations = Quotation::with('sales')->get();
                $media_categories = MediaCategory::with('sales')->get();
                if(request('vendorID')){
                    if(request('vendorID') != "pilih"){
                        $printing_prices = PrintingPrice::where('vendor_id', request('vendorID'))->name()->product()->get();
                        $vendor = Vendor::findOrFail(request('vendorID'));
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
                    'print_product'=>$printProduct,
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
                    compact('quotations', 'media_categories', 'printing_products')
                ]);
            }else if($orderType == "location"){
                $location = Location::findOrFail($dataId);
                if(request('vendorID')){
                    if(request('vendorID') != "pilih"){
                        $printing_prices = PrintingPrice::where('vendor_id', request('vendorID'))->product()->get();
                        $vendor = Vendor::findOrFail(request('vendorID'));
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
                    compact('areas', 'media_categories', 'cities', 'media_sizes')
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
        $vendors = Vendor::print()->get();
        return response()->view('print-orders.create', [
            'title' => 'Tambah SPK Cetak Gambar',
            'vendors' => $vendors
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
            $lastOrder = PrintOrder::where('company_id', $request->company_id)->whereYear('created_at', Carbon::now()->year)->get()->last();
            if($lastOrder){
                $lastNumber = (int)substr($lastOrder->number,0,4);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
            
            if($newNumber > 0 && $newNumber < 10){
                $number = '000'.$newNumber.'/SPK-PR/'.$dataCompany->code.'/'.$romawi[(int) date('m')].'-'. date('Y');
            }else if($newNumber >= 10 && $newNumber < 100 ){
                $number = '00'.$newNumber.'/SPK-PR/'.$dataCompany->code.'/'.$romawi[(int) date('m')].'-'. date('Y');
            }else if($newNumber >= 100 && $newNumber < 1000 ){
                $number = '0'.$newNumber.'/SPK-PR/'.$dataCompany->code.'/'.$romawi[(int) date('m')].'-'. date('Y');
            } else {
                $number = $newNumber.'/SPK-PR/'.$dataCompany->code.'/'.$romawi[(int) date('m')].'-'. date('Y');
            }
            // Set number --> end

            $request->request->add(['number' => $number]);
            // dd($request);
            $validateData = $request->validate([
                'number' => 'required|unique:print_orders',
                'company_id' => 'required',
                'vendor_id' => 'required',
                'sale_id' => 'nullable',
                'location_id' => 'required',
                'theme' => 'required',
                'notes' => 'nullable',
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
        if(Gate::allows('isOrder') && Gate::allows('isMarketingRead')){
            $locations = Location::with('print_orders')->get();
            $sales = Sale::with('print_orders')->get();
            $companies = Company::with('print_orders')->get();
            return response()-> view ('print-orders.show', [
                'print_order' => $printOrder,
                'title' => 'Data SPK Cetak',
                compact('companies', 'locations', 'sales')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrintOrder $printOrder): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isOrder') && Gate::allows('isMarketingEdit')) || (Gate::allows('isMarketing') && Gate::allows('isOrder') && Gate::allows('isMarketingEdit'))){
            $product = json_decode($printOrder->product);
            $locations = Location::with('print_orders')->get();
            $sales = Sale::with('print_orders')->get();
            $companies = Company::with('print_orders')->get();
            $vendors = Vendor::print()->get();
            $printing_prices = PrintingPrice::where('vendor_id', $product->vendor_id)->whereHas('printing_product', function($query)use ($product){
                $query->where('type', $product->product_type);
            })->get();
            return response()-> view ('print-orders.edit', [
                'print_orders' => $printOrder,
                'vendors'=>$vendors,
                'printing_prices' => $printing_prices,
                'title' => 'Edit Data SPK Cetak',
                compact('companies', 'locations', 'sales')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrintOrder $printOrder): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isOrder') && Gate::allows('isMarketingEdit')) || (Gate::allows('isMarketing') && Gate::allows('isOrder') && Gate::allows('isMarketingEdit'))){
            if($request->file('design')){
                $request->validate([
                    'design'=> 'image|file|mimes:jpeg,png,jpg|max:1024',
                ]);
            }
            $rules = [
                'vendor_id' => 'required',
                'theme' => 'required',
                'product' => 'required',
                'price' => 'required',
                'updated_by' => 'required',
                'notes' => 'nullable'
            ];

            $validateData = $request->validate($rules);
                
            if($request->file('design')){
                if($request->oldDesign){
                    Storage::delete($request->oldDesign);
                }
                $validateData['design'] = $request->file('design')->store('print-designs');
            }
            
            PrintOrder::where('id', $printOrder->id)
                ->update($validateData);
    
            return redirect('/marketing/print-orders/preview/'.$printOrder->id)->with('success','SPK Cetak dengan nomor '. $printOrder->number . ' berhasil diedit');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrintOrder $printOrder): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isOrder') && Gate::allows('isMarketingDelete')) || (Gate::allows('isMarketing') && Gate::allows('isOrder') && Gate::allows('isMarketingDelete'))){
            Storage::delete($printOrder->design);
            PrintOrder::destroy($printOrder->id);
            return redirect('/marketing/print-orders')->with('success', 'Data SPK Cetak dengan nomor '.$printOrder->number.' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
