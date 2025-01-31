@extends('dashboard.layouts.main');

@section('container')
    @php
        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
        $spkDate = date('d') . ' ' . $bulan[(int) date('m')] . ' ' . date('Y');
        if ($orderType == 'free') {
            $description = json_decode($product->description);
            $location_id = $product->id;
            $location_address = $product->address;
            $location_category = $product->category;
            $company_id = $dataOrder->company_id;
            $code = $product->code;
            $cityCode = $product->city_code;
            $side = $product->side;
            $size = $product->size;
            $width = $product->width;
            $height = $product->height;
            if ($product->category == 'Signage') {
                $location_qty = $description->qty;
                $location_lat = $description->lat[0];
                $location_lng = $description->lng[0];
            } else {
                $location_qty = 1;
                $location_lat = $description->lat;
                $location_lng = $description->lng;
            }
            $qty = (int) filter_var($product->side, FILTER_SANITIZE_NUMBER_INT) * $location_qty;
        } elseif ($orderType == 'sales') {
            $description = json_decode($product->description);
            $location_id = $product->id;
            $location_address = $product->address;
            $location_category = $product->category;
            $company_id = $dataOrder->company_id;
            $code = $product->code;
            $cityCode = $product->city_code;
            $side = $product->side;
            $size = $product->size;
            $width = $product->width;
            $height = $product->height;
            if ($product->category == 'Signage') {
                $location_qty = $description->qty;
                $location_lat = $description->lat[0];
                $location_lng = $description->lng[0];
            } else {
                $location_qty = 1;
                $location_lat = $description->lat;
                $location_lng = $description->lng;
            }
            $qty = (int) filter_var($product->side, FILTER_SANITIZE_NUMBER_INT) * $location_qty;
        } elseif ($orderType == 'location') {
            $description = json_decode($location->description);
            $location_id = $location->id;
            $location_address = $location->address;
            $location_category = $location->media_category->name;
            $company_id = $location->company_id;
            $code = $location->code;
            $cityCode = $location->city->code;
            $side = $location->side;
            $size = $location->media_size->size;
            $width = $location->media_size->width;
            $height = $location->media_size->height;
            $productType = $description->lighting;
            if ($location_category == 'Signage') {
                $location_qty = $description->qty;
                $location_lat = $description->lat[0];
                $location_lng = $description->lng[0];
            } else {
                $location_qty = 1;
                $location_lat = $description->lat;
                $location_lng = $description->lng;
            }
            $qty = (int) filter_var($side, FILTER_SANITIZE_NUMBER_INT) * $location_qty;
        }
        $created_by = new stdClass();
        $created_by->id = auth()->user()->id;
        $created_by->name = auth()->user()->name;
        $created_by->position = auth()->user()->position;
    @endphp
    <form action="/marketing/print-orders" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="company_id" id="company_id" value="{{ $company->id }}" hidden>
        <input type="text" name="vendor_id" id="vendor_id" hidden>
        @if ($orderType == 'free')
            <input type="text" name="sale_id" id="sale_id" value="{{ $dataOrder->id }}" hidden>
            <input type="text" name="main_sale_id" id="main_sale_id" hidden>
        @elseif ($orderType == 'sales')
            <input type="text" name="sale_id" id="sale_id" value="{{ $dataOrder->id }}" hidden>
            @if ($product->type == 'new')
                <input type="text" name="main_sale_id" id="main_sale_id" hidden>
            @else
                <input type="text" name="main_sale_id" id="main_sale_id" value="{{ $product->sale_id }}" hidden>
            @endif
        @else
            <input type="text" name="sale_id" id="sale_id" hidden>
            <input type="text" name="main_sale_id" id="main_sale_id" hidden>
        @endif
        <input type="text" name="theme" id="theme" value="{{ old('theme') }}" hidden>
        <input type="text" id="location_id" name="location_id" value="{{ $location_id }}" hidden>
        <input type="text" id="location_code" value="{{ $code }}" hidden>
        <input type="text" id="location_qty" value="{{ $location_qty }}" hidden>
        <input type="number" id="location_side" value="{{ (int) filter_var($side, FILTER_SANITIZE_NUMBER_INT) }}" hidden>
        <input type="text" id="location_address" value="{{ $location_address }}" hidden>
        <input type="text" id="location_lat" value="{{ $location_lat }}" hidden>
        <input type="text" id="location_lng" value="{{ $location_lng }}" hidden>
        <input type="text" id="location_category" value="{{ $location_category }}" hidden>
        <input type="text" id="cityCode" value="{{ $cityCode }}" hidden>
        <input type="text" id="orderType" value="{{ $orderType }}" hidden>
        <input type="number" id="price" name="price" value="{{ old('price') }}" hidden>
        <input type="text" name="product" id="product" value="{{ old('product') }}" hidden>
        <input type="text" name="notes" value="{{ old('notes') }}" id="notes" hidden>
        <input type="text" name="created_by" id="created_by" value="{{ json_encode($created_by) }}" hidden>
        <input type="text" name="updated_by" id="updated_by" value="{{ json_encode($created_by) }}" hidden>
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
                <div class="flex items-center w-[950px] border-b px-2">
                    <!-- Title Area start -->
                    <h1 class="index-h1 w-[500px] text-stone-100"> MENAMBAHKAN DATA SPK CETAK</h1>
                    <!-- Title Area end -->
                    <div class="flex w-full justify-end items-center p-1">
                        <button class="flex justify-center items-center mx-1 btn-primary" title="Preview" type="submit"
                            onclick="return fillData()">
                            <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                            </svg>
                            <span class="mx-1">save</span>
                        </button>
                        <a class="flex justify-center items-center mx-1 btn-danger"
                            href="/print-orders/select-locations/{{ $company->id }}">
                            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="mx-1">Cancel</span>
                        </a>
                    </div>
                </div>
                <div class="flex justify-center w-full">
                    <div class="w-[950px] h-[1345px] bg-white mb-10 p-2 mt-2">
                        <!-- SPK Header start-->
                        @include('print-orders.spk-header')
                        <!-- SPK Header end-->

                        <!-- SPK Body start-->
                        @include('print-orders.spk-body')
                        <!-- SPK Body end-->

                        <!-- SPK Sign start-->
                        @include('print-orders.spk-sign')
                        <!-- SPK Sign end-->

                        <div class="flex w-full justify-center items-center pt-2">
                            <div class="border-t h-2 border-slate-500 border-dashed w-full">
                            </div>
                            <svg class="fill-slate-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M14.686 13.646l-6.597 3.181c-1.438.692-2.755-1.124-2.755-1.124l6.813-3.287 2.539 1.23zm6.168 5.354c-.533 0-1.083-.119-1.605-.373-1.511-.731-2.296-2.333-1.943-3.774.203-.822-.23-.934-.891-1.253l-11.036-5.341s1.322-1.812 2.759-1.117c.881.427 4.423 2.136 7.477 3.617l.766-.368c.662-.319 1.094-.43.895-1.252-.351-1.442.439-3.043 1.952-3.77.521-.251 1.068-.369 1.596-.369 1.799 0 3.147 1.32 3.147 2.956 0 1.23-.766 2.454-2.032 3.091-1.266.634-2.15.14-3.406.75l-.394.19.431.21c1.254.614 2.142.122 3.404.759 1.262.638 2.026 1.861 2.026 3.088 0 1.64-1.352 2.956-3.146 2.956zm-1.987-9.967c.381.795 1.459 1.072 2.406.617.945-.455 1.405-1.472 1.027-2.267-.381-.796-1.46-1.073-2.406-.618-.946.455-1.408 1.472-1.027 2.268zm-2.834 2.819c0-.322-.261-.583-.583-.583-.321 0-.583.261-.583.583s.262.583.583.583c.322.001.583-.261.583-.583zm5.272 2.499c-.945-.457-2.025-.183-2.408.611-.381.795.078 1.814 1.022 2.271.945.458 2.024.184 2.406-.611.382-.795-.075-1.814-1.02-2.271zm-18.305-3.351h-3v2h3v-2zm4 0h-3v2h3v-2z" />
                            </svg>
                        </div>

                        <!-- SPK Header start-->
                        @include('print-orders.spk-header-copy')
                        <!-- SPK Header end-->

                        <!-- SPK Body start-->
                        @include('print-orders.spk-body-copy')
                        <!-- SPK Body end-->

                        <!-- SPK Sign start-->
                        @include('print-orders.spk-sign-copy')
                        <!-- SPK Sign end-->
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="formVendor" action="/print-orders/create-order/{{ $dataId }}/{{ $orderType }}">
        <input name="productType" type="text" value="{{ $productType }}" hidden>
        @if ($orderType == 'sales')
            <input name="productName" type="text" value="{{ $print_product }}" hidden>
        @endif
        <input id="vendorID" name="vendorID" type="text" value="{{ old('vendorID') }}" hidden>
    </form>
    @include('print-orders.create-preview')

    <!-- Script Preview Image start-->
    <script src="/js/createprintorders.js"></script>
    <!-- Script Preview Image end-->
@endsection
