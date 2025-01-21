@extends('dashboard.layouts.main');

@section('container')
    <?php
    $dataProducts = [];
    $location_photos = [];
    foreach ($data_photos as $photo) {
        if ($photo->company_id == $company->id) {
            array_push($location_photos, $photo->photo);
        }
    }
    if ($quotation_type == 'new') {
        $i = 0;
        foreach ($locations as $location) {
            $dataProduct = new stdClass();
            $dataProduct->id = $location->id;
            $dataProduct->code = $location->code;
            $dataProduct->category = $location->media_category->name;
            $dataProduct->area = $location->area->area;
            $dataProduct->city = $location->city->city;
            $dataProduct->city_code = $location->city->code;
            $dataProduct->address = $location->address;
            if (count($location_photos) > 0) {
                $dataProduct->photo = $location_photos[$i];
            } else {
                $dataProduct->photo = '';
            }
            $dataProduct->description = $location->description;
            $dataProduct->size = $location->media_size->size;
            $dataProduct->width = $location->media_size->width;
            $dataProduct->height = $location->media_size->height;
            $dataProduct->side = $location->side;
            $dataProduct->price = $location->price;
            $dataProduct->orientation = $location->orientation;
            $dataProduct->road_segment = $location->road_segment;
            $dataProduct->max_distance = $location->max_distance;
            $dataProduct->speed_average = $location->speed_average;
            $dataProduct->sector = $location->sector;
            $dataProduct->type = 'new';
            array_push($dataProducts, $dataProduct);
            $i++;
        }
    } elseif ($quotation_type == 'extend' || $quotation_type == 'existing') {
        foreach ($locations as $sale) {
            if (count($sale->quotation->quotation_revisions) != 0) {
                $dataRevisions = $sale->quotation->quotation_revisions->last();
                $price = json_decode($dataRevisions->price);
                $notes = json_decode($dataRevisions->notes);
                $freePrint = $notes->freePrint;
                $usedPrint = count($sale->print_orders);
                $freeInstall = $notes->freeInstall;
                $usedInstall = count($sale->install_orders);
            } else {
                $price = json_decode($sale->quotation->price);
                $notes = json_decode($sale->quotation->notes);
                $freePrint = $notes->freePrint;
                $usedPrint = count($sale->print_orders);
                $freeInstall = $notes->freeInstall;
                $usedInstall = count($sale->install_orders);
            }
            $getLocation = json_decode($sale->product);
            $dataProduct = new stdClass();
            $dataProduct->id = $getLocation->id;
            $dataProduct->code = $getLocation->code;
            $dataProduct->category = $getLocation->category;
            $dataProduct->area = $getLocation->area;
            $dataProduct->city = $getLocation->city;
            $dataProduct->city_code = $getLocation->city_code;
            $dataProduct->address = $getLocation->address;
            $dataProduct->photo = $getLocation->photo;
            $dataProduct->description = $getLocation->description;
            $dataProduct->size = $getLocation->size;
            $dataProduct->width = $getLocation->width;
            $dataProduct->height = $getLocation->height;
            $dataProduct->side = $getLocation->side;
            $dataProduct->price = $getLocation->price;
            $dataProduct->orientation = $getLocation->orientation;
            $dataProduct->road_segment = $getLocation->road_segment;
            $dataProduct->max_distance = $getLocation->max_distance;
            $dataProduct->speed_average = $getLocation->speed_average;
            $dataProduct->sector = $getLocation->sector;
            $dataProduct->free_print = $freePrint;
            $dataProduct->used_print = $usedPrint;
            $dataProduct->get_print = $usedPrint + 1;
            $dataProduct->free_install = $freeInstall;
            $dataProduct->used_install = $usedInstall;
            $dataProduct->get_install = $usedInstall + 1;
            if ($quotation_type == 'extend') {
                $dataProduct->type = 'extend';
                $dataProduct->sale_id = $sale->id;
            } elseif ($quotation_type == 'existing') {
                $dataProduct->type = 'existing';
                $dataProduct->sale_id = $sale->id;
            }
            array_push($dataProducts, $dataProduct);
    
            $dataClient = json_decode($sale->quotation->clients);
        }
    }
    
    $products = new stdClass();
    $products = $dataProducts;
    
    $created_by = new stdClass();
    $created_by->id = auth()->user()->id;
    $created_by->name = auth()->user()->name;
    $created_by->position = auth()->user()->position;
    $created_by->phone = auth()->user()->phone;
    
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $romawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VII', 'IX', 'X', 'XI', 'XII'];
    ?>
    <!-- Quotation start -->
    <form id="formCreate" action="/marketing/quotations" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="company_id" id="company_id" value="{{ $company->id }}" hidden>
        <input type="text" name="media_category_id" id="media_category_id" value="{{ $data_category->id }}" hidden>
        @if ($data_category->name == 'Signage')
            @php
                $dataDescription = json_decode($products[0]->description);
            @endphp
            <input type="text" id="category" name="{{ $dataDescription->type }}" value="{{ $data_category->name }}"
                hidden>
        @else
            <input type="text" id="category" value="{{ $data_category->name }}" hidden>
        @endif

        <input type="text" id="quotationType" value="{{ $quotation_type }}" hidden>
        @if ($quotation_type == 'extend' || $quotation_type == 'existing')
            <input type="text" id="client_type" value="{{ $dataClient->type }}" hidden>
            <input type="text" id="clientId" value="{{ $dataClient->id }}" hidden>
        @endif
        @if ($data_category->name == 'Signage')
            <input type="text" value="{{ $dataDescription->type }}" id="signageType" hidden>
        @endif
        <input type="text" id="attachment" name="attachment" hidden>
        <input type="text" id="subject" name="subject" hidden>
        @if ($quotation_type == 'extend' || $quotation_type == 'existing')
            <input type="text" name="clients" id="clients" value="{{ json_encode($dataClient) }}" hidden>
        @else
            <input type="text" name="clients" id="clients" hidden>
        @endif
        <input type="text" name="body_top" id="body_top" hidden>
        <input type="text" name="body_end" id="body_end" hidden>
        <input type="text" name="notes" id="notes" hidden>
        <input type="text" name="payment_terms" id="payment_terms" hidden>
        <input type="text" name="price" id="price" hidden>
        <input type="text" name="created_by" id="created_by" value="{{ json_encode($created_by) }}" hidden>
        <input type="text" name="modified_by" id="modified_by" value="{{ json_encode($created_by) }}" hidden>
        <input type="text" name="products" id="products" value="{{ json_encode($products) }}" hidden>
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="z-0 mb-8 bg-stone-700 p-4 border rounded-md">
                <div class="flex w-full justify-center">
                    <div class="flex w-[950px] border-b py-2">
                        @if ($category == 'Service')
                            <h1 class="text-xl text-stone-100 px-2 w-[900px] font-bold tracking-wider">MEMBUAT PENAWARAN
                                CETAK/PASANG</h1>
                        @else
                            @if ($quotation_type == 'extend')
                                <h1 class="text-xl text-stone-100 px-2 w-[900px] font-bold tracking-wider">MEMBUAT PENAWARAN
                                    PERPANJANGAN</h1>
                            @else
                                <h1 class="text-xl text-stone-100 px-2 w-[900px] font-bold tracking-wider">MEMBUAT PENAWARAN
                                    BARU
                                </h1>
                            @endif
                        @endif
                        <div class="flex w-full justify-end">
                            @canany(['isAdmin', 'isMarketing'])
                                @can('isQuotation')
                                    @can('isMarketingCreate')
                                        <button id="btnSave" class="flex justify-center items-center mx-1 btn-primary" title="Save"
                                            type="button" onclick="submitAction()">
                                            <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24">
                                                <path
                                                    d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                                            </svg>
                                            <span class="ml-2 text-white">Save</span>
                                        </button>
                                    @endcan
                                @endcan
                            @endcanany
                            @if ($category == 'Service' || $category == 'Videotron' || $category == 'Signage')
                                <a class="flex justify-center items-center ml-1 btn-danger"
                                    href="/marketing/quotations/select-location/{{ $category }}/{{ $company->id }}">
                                    <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                                    </svg>
                                    <span class="ml-1 xl:mx-2 text-sm">Cancel</span>
                                </a>
                            @else
                                <a class="flex justify-center items-center ml-1 btn-danger"
                                    href="/marketing/quotations/select-location/All/{{ $company->id }}">
                                    <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                                    </svg>
                                    <span class="ml-1 xl:mx-2 text-sm">Cancel</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex justify-center w-full">
                    <div class="w-[950px] h-[1345px] bg-white mb-10 p-2 mt-2">
                        <!-- Header start -->
                        @include('dashboard.layouts.letter-header')
                        <!-- Header end -->
                        <!-- Body start -->
                        @if ($category == 'Service')
                            @if ($quotation_type == 'new')
                                @include('quotations.new-service-body');
                            @elseif ($quotation_type == 'existing')
                                @include('quotations.existing-service-body');
                            @endif
                        @else
                            @if ($quotation_type == 'new')
                                @include('quotations.new-media-body');
                            @elseif ($quotation_type == 'extend')
                                @include('quotations.extend-media-body');
                            @endif
                        @endif
                        <!-- Body end -->
                        <!-- Footer start -->
                        @include('dashboard.layouts.letter-footer')
                        <!-- Footer end -->
                    </div>
                </div>
                <!-- View Location start -->
                @if ($category != 'Service')
                    @if ($quotation_type == 'new')
                        @include('quotations.locations-view')
                    @else
                        @include('quotations.locations-extend-view')
                    @endif
                @endif
                <!-- View Location end -->
            </div>
        </div>
    </form>

    <!-- Modal Preview start -->
    {{-- @include('quotations.create-preview') --}}
    <!-- Modal Preview end -->
    <!-- Quotation end -->
    <script src="/js/createquotation.js"></script>
    @if ($category == 'Service')
        <script src="/js/servicetable.js"></script>
    @endif
@endsection
