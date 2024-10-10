@extends('dashboard.layouts.main');

@section('container')
    <?php
    $dataProducts = [];
    if ($quotation_type == 'new') {
        foreach ($locations as $location) {
            $dataProduct = new stdClass();
            $dataProduct->id = $location->id;
            $dataProduct->code = $location->code;
            $dataProduct->category = $location->media_category->name;
            $dataProduct->area = $location->area->area;
            $dataProduct->city = $location->city->city;
            $dataProduct->city_code = $location->city->code;
            $dataProduct->address = $location->address;
            foreach ($locationPhotos as $photo) {
                if ($photo->location_id == $location->id && $photo->set_default == true) {
                    $dataProduct->location_photo = $photo->photo;
                }
            }
            $dataProduct->description = $location->description;
            $dataProduct->size = $location->media_size->size;
            $dataProduct->width = $location->media_size->width;
            $dataProduct->height = $location->media_size->height;
            $dataProduct->side = $location->side;
            $dataProduct->orientation = $location->orientation;
            $dataProduct->road_segment = $location->road_segment;
            $dataProduct->max_distance = $location->max_distance;
            $dataProduct->speed_average = $location->speed_average;
            $dataProduct->sector = $location->sector;
            array_push($dataProducts, $dataProduct);
        }
    } elseif ($quotation_type == 'extend' || $quotation_type == 'existing') {
        foreach ($locations as $sale) {
            if (count($sale->quotation->quotation_revisions) != 0) {
                $dataRevisions = $sale->quotation->quotation_revisions;
                $lastIndex = count($dataRevisions) - 1;
                $getProducts = json_decode($dataRevisions[$lastIndex]->products);
                $price = json_decode($dataRevisions[$lastIndex]->price);
            } else {
                $getProducts = json_decode($sale->quotation->products);
                $price = json_decode($sale->quotation->price);
            }
            foreach ($getProducts as $getProduct) {
                if ($getProduct->code == $sale->product_code) {
                    $getLocation = $getProduct;
                }
            }
            $dataProduct = new stdClass();
            $dataProduct->id = $getLocation->id;
            $dataProduct->code = $getLocation->code;
            $dataProduct->category = $getLocation->category;
            $dataProduct->area = $getLocation->area;
            $dataProduct->city = $getLocation->city;
            $dataProduct->city_code = $getLocation->city_code;
            $dataProduct->address = $getLocation->address;
            $dataProduct->location_photo = $getLocation->location_photo;
            $dataProduct->description = $getLocation->description;
            $dataProduct->size = $getLocation->size;
            $dataProduct->width = $getLocation->width;
            $dataProduct->height = $getLocation->height;
            $dataProduct->side = $getLocation->side;
            $dataProduct->orientation = $getLocation->orientation;
            $dataProduct->road_segment = $getLocation->road_segment;
            $dataProduct->max_distance = $getLocation->max_distance;
            $dataProduct->speed_average = $getLocation->speed_average;
            $dataProduct->sector = $getLocation->sector;
            array_push($dataProducts, $dataProduct);
    
            $dataClient = json_decode($sale->quotation->clients);
        }
    }
    if ($category == 'Service') {
        $products = new stdClass();
        $products = $dataProducts;
    } else {
        $products = new stdClass();
        $products = $dataProducts;
    }
    
    $created_by = new stdClass();
    $created_by->id = auth()->user()->id;
    $created_by->name = auth()->user()->name;
    $created_by->position = auth()->user()->position;
    
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $romawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VII', 'IX', 'X', 'XI', 'XII'];
    ?>
    <!-- Quotation start -->
    <div class="p-10 z-0 bg-black">
        <div class="flex w-full justify-center">
            <div class="flex w-[950px]">
                <button id="btnPreview" class="flex justify-center items-center mx-1 btn-primary" title="Preview"
                    type="button">
                    <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24">
                        <path
                            d="M15 12c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-.199.02-.393.057-.581 1.474.541 2.927-.882 2.405-2.371.174-.03.354-.048.538-.048 1.657 0 3 1.344 3 3zm-2.985-7c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 12c-2.761 0-5-2.238-5-5 0-2.761 2.239-5 5-5 2.762 0 5 2.239 5 5 0 2.762-2.238 5-5 5z" />
                    </svg>
                    <span class="ml-2 text-white">Preview</span>
                </button>
                <a class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-danger"
                    href="/quotations/select-location/{{ $category }}">
                    <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                    </svg>
                    <span class="ml-1 xl:mx-2 text-sm">Cancel</span>
                </a>
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

    <!-- Modal Preview start -->
    @include('quotations.create-preview')
    <!-- Modal Preview end -->
    <!-- Quotation end -->
    <script src="/js/createquotation.js"></script>
    @if ($category == 'Service')
        <script src="/js/servicetable.js"></script>
    @endif
@endsection
