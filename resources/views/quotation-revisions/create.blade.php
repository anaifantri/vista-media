@extends('dashboard.layouts.main');

@section('container')
    <?php
    // $products = json_decode($quotation->products);
    $client = json_decode($quotation->clients);
    $first_number = Str::substr($quotation->number, 0, 4);
    $middle_number = '_Rev' . count($quotation->quotation_revisions) + 1;
    $last_number = Str::substr($quotation->number, 4);
    $number = $first_number . $middle_number . $last_number;
    $dataDescription = json_decode($products[0]->description);
    
    $modified_by = new stdClass();
    $modified_by->id = auth()->user()->id;
    $modified_by->name = auth()->user()->name;
    $modified_by->position = auth()->user()->position;
    $modified_by->phone = auth()->user()->phone;
    
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $romawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VII', 'IX', 'X', 'XI', 'XII'];
    ?>
    <!-- Quotation Revision start -->
    <form id="formCreate" action="/marketing/quotation-revisions" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="number" id="number" value="{{ $number }}" hidden>
        @if ($category == 'Signage')
            @php
                $dataDescription = json_decode($products[0]->description);
            @endphp
            <input type="text" id="category" name="{{ $dataDescription->type }}" value="{{ $category }}" hidden>
        @else
            <input type="text" id="category" value="{{ $category }}" hidden>
        @endif
        <input type="text" id="quotation_id" name="quotation_id" value="{{ $quotation->id }}" hidden>
        <input type="text" name="notes" id="notes" {{ json_encode($notes) }} hidden>
        <input type="text" name="payment_terms" id="payment_terms" value="{{ json_encode($payment_terms) }}" hidden>
        <input type="text" name="price" id="price" value="{{ json_encode($price) }}" hidden>
        <input type="text" name="modified_by" id="modified_by" value="{{ json_encode($modified_by) }}" hidden>
        <input type="text" name="products" id="products" value="{{ json_encode($products) }}" hidden>
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="z-0 mb-8 bg-stone-700 p-4 border rounded-md">
                <div class="flex w-full justify-center">
                    <div class="flex w-[950px] border-b py-2">
                        <h1 class="text-xl text-teal-50 px-2 w-[650px] font-bold tracking-wider">REVISI PENAWARAN NOMOR :
                            {{ substr($quotation->number, 0, 4) }}</h1>
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
                            <a class="flex justify-center items-center ml-1 mx- btn-danger"
                                href="/marketing/quotations/{{ $quotation->id }}">
                                <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                                </svg>
                                <span class="ml-1 xl:mx-2 text-sm">Cancel</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center w-full">
                    <div class="w-[950px] h-[1345px] bg-white p-4 mt-1">
                        <!-- Header start -->
                        @include('dashboard.layouts.letter-header')
                        <!-- Header end -->
                        <!-- Body start -->
                        <div class="h-[1100px]">
                            <div class="flex justify-center">
                                <div class="w-[725px] mt-2">
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black flex w-20">Nomor</label>
                                        <label class="ml-1 text-sm text-black">:</label>
                                        <label class="ml-1 text-sm text-slate-500">{{ $number }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black flex w-20">Lampiran</label>
                                        <label class="ml-1 text-sm text-black flex">:</label>
                                        <label class="ml-1 text-sm text-black flex">{{ $quotation->attachment }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black flex w-20">Perihal</label>
                                        <label class="ml-1 text-sm text-black flex">:</label>
                                        <label class="ml-1 text-sm text-black flex">{{ $quotation->subject }}</label>
                                    </div>
                                    <div class="flex mt-4">
                                        <div>
                                            <label class="ml-1 text-sm text-black flex w-20">Kepada Yth</label>
                                            @if ($client->type == 'Perorangan')
                                                <label
                                                    class="flex ml-1 text-sm text-black font-semibold">{{ $client->name }}</label>
                                            @else
                                                <label
                                                    class="flex ml-1 text-sm text-black font-semibold">{{ $client->company }}</label>
                                                @if ($client->contact_gender == 'Male')
                                                    <label class="flex ml-1 text-sm text-black font-semibold">Bapak
                                                        {{ $client->contact_name }}</label>
                                                @else
                                                    <label class="flex ml-1 text-sm text-black font-semibold">Ibu
                                                        {{ $client->contact_name }}</label>
                                                @endif
                                            @endif
                                            <label class="ml-1 text-sm text-black flex">Di -</label>
                                            <label class="ml-6 text-sm text-black flex">Tempat</label>
                                        </div>
                                    </div>
                                    <div class="flex mt-4">
                                        <label class="ml-1 text-sm text-black flex w-20">Email</label>
                                        <label class="ml-1 text-sm text-black flex">:</label>
                                        @if ($client->type == 'Perorangan')
                                            <label class="ml-1 text-sm text-black ">{{ $client->email }}</label>
                                        @else
                                            <label class="ml-1 text-sm text-black ">{{ $client->contact_email }}</label>
                                        @endif
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black flex w-20">No. Telp.</label>
                                        <label class="ml-1 text-sm text-black flex">:</label>
                                        @if ($client->type == 'Perorangan')
                                            <label class="ml-1 text-sm text-black ">{{ $client->phone }}</label>
                                        @else
                                            <label class="ml-1 text-sm text-black ">{{ $client->contact_phone }}</label>
                                        @endif
                                    </div>
                                    <div class="flex mt-4">
                                        <label class="ml-1 text-sm text-black flex">Dengan hormat,</label>
                                    </div>
                                    <div class="flex mt-2">
                                        <textarea id="createBodyTop" class="ml-1 w-[721px] outline-none text-sm" readonly>{{ $quotation->body_top }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- table start -->
                            <div class="flex justify-center ml-2">
                                @if ($category == 'Service')
                                    @include('quotation-revisions.service-rev-table')
                                @else
                                    @if ($category == 'Videotron')
                                        @include('quotation-revisions.vt-rev-table')
                                    @elseif ($category == 'Signage')
                                        @php
                                            $dataDescription = json_decode($products[0]->description);
                                        @endphp
                                        @if ($dataDescription->type == 'Videotron')
                                            @include('quotation-revisions.vt-rev-table')
                                        @else
                                            @include('quotation-revisions.bb-rev-table')
                                        @endif
                                    @else
                                        @include('quotation-revisions.bb-rev-table')
                                    @endif
                                @endif
                            </div>
                            <!-- table end -->

                            <!-- notes start -->
                            @if ($category == 'Service')
                                @include('quotation-revisions.service-notes')
                            @else
                                @if ($category == 'Videotron')
                                    @include('quotation-revisions.led-notes')
                                @elseif ($category == 'Signage')
                                    @php
                                        $dataDescription = json_decode($products[0]->description);
                                    @endphp
                                    @if ($dataDescription->type == 'Videotron')
                                        @include('quotation-revisions.led-notes')
                                    @else
                                        @include('quotation-revisions.billboard-notes')
                                    @endif
                                @else
                                    @include('quotation-revisions.billboard-notes')
                                @endif
                            @endif
                            <!-- notes end -->

                            <div>
                                <div class="flex justify-center">
                                    <div class="flex mt-2">
                                        <textarea id="createBodyEnd" class="ml-1 w-[721px] outline-none text-sm" rows="1">{{ $quotation->body_end }}</textarea>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="w-[725px] mt-2">
                                        <label class="ml-1 text-sm text-black flex">Denpasar, {{ date('d') }}
                                            {{ $bulan[(int) date('m')] }}
                                            {{ date('Y') }}</label>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="w-[725px]">
                                        <label class="ml-1 text-sm text-black flex font-semibold">PT. Vista Media</label>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="w-[725px] mt-10">
                                        <label id="salesUser"
                                            class="ml-1 text-sm text-black flex font-semibold">{{ auth()->user()->name }}</label>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="w-[725px]">
                                        <label id="salesPotition"
                                            class="ml-1 text-sm text-black flex">{{ auth()->user()->position }}</label>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="w-[725px]">
                                        <label id="salesPhone" class="ml-1 text-sm text-black flex">Hp.
                                            {{ auth()->user()->phone }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Body end -->
                        <!-- Footer start -->
                        @include('dashboard.layouts.letter-footer')
                        <!-- Footer end -->
                    </div>
                </div>
                <!-- View Location start -->
                @if ($category != 'Service')
                    @foreach ($products as $product)
                        @php
                            $description = json_decode($product->description);
                            $sectors = json_decode($product->sector);

                            if ($product->category == 'Signage') {
                                $mapsLink =
                                    'https://maps.googleapis.com/maps/api/staticmap?center=' .
                                    $description->lat[0] .
                                    ',' .
                                    $description->lng[0] .
                                    '&zoom=17&size=480x355&maptype=terrain';
                                $mapsMarkers = '';
                                $googleKey = '&key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg';
                                for ($i = 0; $i < count($description->lat); $i++) {
                                    $mapsMarkers =
                                        $mapsMarkers .
                                        '&markers=icon:https://vistamedia.co.id/img/marker-red.png%7C' .
                                        $description->lat[$i] .
                                        ',' .
                                        $description->lng[$i];
                                }
                                $src = $mapsLink . $mapsMarkers . $googleKey;
                            } else {
                                $src =
                                    'https://maps.googleapis.com/maps/api/staticmap?center=' .
                                    $description->lat .
                                    ',' .
                                    $description->lng .
                                    '&zoom=16&size=480x355&maptype=terrain&markers=icon:https://vistamedia.co.id/img/marker-red.png%7C' .
                                    $description->lat .
                                    ',' .
                                    $description->lng .
                                    '&key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg';
                            }
                        @endphp
                        <div id="locationView" class="flex justify-center w-full">
                            <div class="w-[950px] h-[1345px] p-4 mt-1 bg-white">
                                <!-- Header start -->
                                @include('dashboard.layouts.letter-header')
                                <!-- Header end -->
                                <!-- Body start -->
                                <div class="h-[1110px]">
                                    <div class="flex w-full h-[50px] justify-center items-center mt-1">
                                        <div
                                            class="flex w-[800px] h-[50px] justify-start items-center bg-slate-50 border rounded-t-xl">
                                            <span
                                                class="flex justify-end items-center w-20 h-[42px] text-lg text-red-700 font-bold">{{ $product->code }}</span>
                                            <span
                                                class="flex justify-start items-center w-20 h-[42px] text-lg font-bold ml-1">
                                                -
                                                {{ $product->city_code }}
                                            </span>
                                            <img class="h-10" src="/img/code-line.png" alt="">
                                            <span
                                                class="flex items-center w-[575px] h-[42px] text-base font-semibold">{{ $product->address }}
                                                | {{ strtoupper($product->area) }}</span>
                                        </div>
                                    </div>
                                    <div class="flex w-full h-[570px] justify-center mt-2">
                                        <div
                                            class="flex w-[800px] h-[570px] justify-center items-center bg-slate-50 border rounded-b-xl">
                                            <img class="m-auto w-[770px] h-[540px]"
                                                src="{{ asset('storage/' . $product->photo) }}" alt="">
                                        </div>
                                    </div>
                                    <div class="flex w-full justify-center mt-4 h-[470px] bg-white">
                                        <div class="w-[544px] h-[470px] bg-white justify-center">
                                            <div
                                                class="flex w-[544px] h-10 bg-slate-50 items-center border justify-center rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                                Google Maps Koordinat :
                                                @if ($category == 'Signage')
                                                    {{ number_format($description->lat[0], 7) . ', ' . number_format($description->lng[0], 7) }}
                                                @else
                                                    {{ number_format($description->lat, 7) . ', ' . number_format($description->lng, 7) }}
                                                @endif
                                            </div>
                                            <div class="flex relative w-[544px] h-[430px] mt-1 rounded-b-lg">
                                                <div class="flex absolute w-[100px] mt-[325px] ml-1">
                                                    @if ($category == 'Signage')
                                                        {{ QrCode::size(100)->generate('https://www.google.co.id/maps/place/' . $description->lat[0] . ',' . $description->lng[0] . '/@' . $description->lat[0] . ',' . $description->lng[0] . ',16z') }}
                                                    @else
                                                        {{ QrCode::size(100)->generate('https://www.google.co.id/maps/place/' . $description->lat . ',' . $description->lng . '/@' . $description->lat . ',' . $description->lng . ',16z') }}
                                                    @endif
                                                </div>
                                                <img class="w-[544px] h-[430px] border rounded-b-xl" id="myImage"
                                                    name="myImage" src="{{ $src }}" alt="">
                                            </div>
                                        </div>
                                        <div class="w-[256px] h-[470px] bg-white justify-center ml-1">
                                            <div
                                                class="flex p-1 items-center justify-center w-[256px] h-10 bg-slate-50 border rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                                Deskripsi Lokasi
                                            </div>
                                            @if ($category == 'Billboard' || $category == 'Bando' || $category == 'Baliho' || $category == 'Midiboard')
                                                @include('quotations.bb-description-show')
                                            @elseif ($category == 'Videotron')
                                                @include('quotations.vt-description-show')
                                            @elseif ($category == 'Signage')
                                                @include('quotations.sn-description-show')
                                            @endif
                                            <div
                                                class="flex w-[256px] h-10 p-1 bg-slate-50 mt-1 border justify-center items-center rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                                Informasi Area
                                            </div>
                                            <div class="w-[256px] h-[212px] border bg-slate-50 mt-1 rounded-b-lg">
                                                <div class="flex">
                                                    <span class="w-[100px] text-xs font-mono text-teal-900 ml-2">Type
                                                        Jalan</span>
                                                    <span class="w-[120px] text-xs font-mono text-teal-900">:
                                                        {{ $product->road_segment }}
                                                    </span>
                                                </div>
                                                <div class="flex">
                                                    <span class="w-[100px] text-xs font-mono text-teal-900 ml-2">Jarak
                                                        Pandang</span>
                                                    <span class="w-[120px] text-xs font-mono text-teal-900">:
                                                        {{ $product->max_distance }}
                                                    </span>
                                                </div>
                                                <div class="flex">
                                                    <span
                                                        class="w-[100px] text-xs font-mono font-thin text-teal-900 ml-2">Kecepatan
                                                        Kend.</span>
                                                    <span class="w-[120px] text-xs font-mono font-thin text-teal-900">:
                                                        {{ $product->speed_average }}
                                                    </span>
                                                </div>
                                                <div class="flex">
                                                    <div>
                                                        <span
                                                            class="w-[100px] text-xs font-mono font-thin text-teal-900 ml-2">Kawasan
                                                        </span>
                                                        <span class="w-[100px] flex mt-[40px] ml-2">
                                                            {{ QrCode::size(100)->generate('https://vistamedia.co.id/locations/guest-preview/' . $category . '/' . Crypt::encrypt($product->id)) }}
                                                        </span>
                                                    </div>
                                                    <span class="flex w-[120px] text-xs font-mono font-thin text-teal-900">
                                                        <div>:</div>
                                                        <div>
                                                            @foreach ($sectors->dataSector as $sector)
                                                                <div>
                                                                    - {{ $sector }}
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Body start -->
                                <!-- Footer start -->
                                @include('dashboard.layouts.letter-footer')
                                <!-- Footer end -->
                            </div>
                        </div>
                    @endforeach
                @endif
                <!-- View Location end -->
            </div>
        </div>
    </form>

    <div id="modalLocation" class="absolute justify-center top-0 w-full h-full bg-black bg-opacity-90 z-50 p-10 hidden">
        <div>
            <div class="flex px-2  border-b-2 border-white w-full">
                <div class="flex text-xl text-stone-100 font-bold tracking-wider w-[600px]">Pilih Lokasi
                </div>
                <div class="flex w-full justify-end">
                    <form action="/marketing/quotation-revisions/revision/{{ $category }}/{{ $quotation->id }}">
                        <input id="newProducts" name="new_products" type="text" value="{{ json_encode($products) }}"
                            hidden>
                        <input id="newPrice" name="new_price" type="text" value="{{ json_encode($price) }}" hidden>
                        <button class="flex justify-center items-center mx-1 btn-primary" title="Add" type="submit">
                            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm-.747 9.25h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="ml-2 text-white">Submit</span>
                        </button>
                    </form>
                    <button id="btnClose" class="flex justify-center items-center ml-1 mx- btn-danger" title="Close"
                        type="button" onclick="btnClose()">
                        <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                        </svg>
                        <span class="ml-1 xl:mx-2 text-sm">Close</span>
                    </button>
                </div>
            </div>
            <div class="flex mt-1 ml-2">
                <div class="w-36">
                    <span class="text-base text-stone-100">Area</span>
                    <select class="w-full border rounded-lg text-base text-stone-900 outline-none" name="area"
                        id="area" onchange="searchArea(this)">
                        <option value="All">All</option>
                        @foreach ($areas as $area)
                            <option id="{{ $area->id }}" value="{{ $area->area }}">{{ $area->area }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-36 ml-2">
                    <span class="text-base text-stone-100">Kota</span>
                    <select id="city" class="w-full border rounded-lg text-base text-stone-900 outline-none"
                        name="city" onchange="searchCity(this)" disabled>
                        <option value="All">All</option>
                    </select>
                </div>
                <div class="w-36 ml-2">
                    <span class="text-base text-stone-100">Search</span>
                    <input id="search"class="flex border rounded-lg px-1 outline-none text-base text-stone-900"
                        type="text" placeholder="Search" onkeyup="searchTable()" autofocus>
                </div>
            </div>
            <div class="w-[1200px] h-[500px] overflow-y-auto mt-4">
                <table class="table-auto w-full" id="locationsTable">
                    <thead>
                        <tr class="bg-stone-400">
                            <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center" rowspan="2">
                                No
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm w-24 text-center" rowspan="2">
                                Kode</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center" rowspan="2">
                                Lokasi
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-24" rowspan="2">
                                Area</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-24" rowspan="2">
                                Kota</th>
                            @if ($category == 'Signage')
                                <th class="text-stone-900 border border-stone-900 text-sm text-center" colspan="6">
                                    Deskripsi
                                </th>
                            @else
                                <th class="text-stone-900 border border-stone-900 text-sm text-center" colspan="4">
                                    Deskripsi
                                </th>
                            @endif
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-16" rowspan="2">
                                Action</th>
                        </tr>
                        <tr class="bg-stone-400">
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-12">Jenis</th>
                            @if ($category == 'Signage')
                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-[72px]">Bentuk
                                </th>
                            @endif
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-12">BL/FL</th>
                            @if ($category == 'Signage')
                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-8">Qty</th>
                            @endif
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-10">Side</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-28">Size - V/H</th>
                        </tr>
                    </thead>
                    <tbody class="bg-stone-300">
                        @foreach ($locations as $location)
                            @php
                                $description = json_decode($location->description);
                                $getPhoto = $location->location_photos
                                    ->where('company_id', $company->id)
                                    ->where('set_default', true)
                                    ->last();
                            @endphp
                            <tr>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $location->code }}
                                    -
                                    {{ $location->city->code }}</td>
                                <td class="text-stone-900 border border-stone-900 text-sm px-2">
                                    {{ $location->address }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $location->area->area }}</td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $location->city->city }}</td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $location->media_category->code }}
                                </td>
                                @if ($category == 'Signage')
                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                        {{ $description->type }}
                                    </td>
                                @endif
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    @if (
                                        $location->media_category->name == 'Videotron' ||
                                            ($location->media_category->name == 'Signage' && $description->type == 'Videotron'))
                                        -
                                    @else
                                        @if ($description->lighting == 'Backlight')
                                            BL
                                        @elseif($description->lighting == 'Frontlight')
                                            FL
                                        @elseif($description->lighting == 'Nonlight')
                                            -
                                        @endif
                                    @endif
                                </td>
                                @if ($category == 'Signage')
                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                        {{ $description->qty }}
                                    </td>
                                @endif
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ filter_var($location->side, FILTER_SANITIZE_NUMBER_INT) }}
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $location->media_size->size }}
                                    -
                                    @if ($location->orientation == 'Vertikal')
                                        V
                                    @elseif ($location->orientation == 'Horizontal')
                                        H
                                    @endif
                                </td>
                                <td class="text-stone-900 border border-stone-900 text-center text-sm">
                                    <input
                                        id="{{ $location->area->area }}*{{ $location->city->city }}*{{ $location->city->code }}*{{ $location->media_size->width }}*{{ $location->media_size->height }}*{{ $location->media_category->name }}*{{ $location->media_size->size }}*{{ $getPhoto->photo }}"
                                        value="{{ json_encode($location) }}" type="checkbox" title="pilih"
                                        onclick="addNewLocations(this)">
                                    {{-- <input
                                        id="{{ $location->area->area }}*{{ $location->city->city }}*{{ $location->city->code }}*{{ $location->media_size->width }}*{{ $location->media_size->height }}*{{ $location->media_category->name }}*{{ $location->media_size->size }}*{{ $getPhoto->photo }}"
                                        value="{{ json_encode($location) }}" type="checkbox" title="pilih"
                                        onclick="addNewLocations(this)"> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quotation Revision end -->
    <script src="/js/createquotrevision.js"></script>
    @if ($category == 'Service')
        <script src="/js/servicerevisiontable.js"></script>
    @endif

    <script>
        const newProducts = document.getElementById("newProducts");
        const newPrice = document.getElementById("newPrice");
        var cities = @json($cities);
        let getNewProducts = @json($products);
        let getNewPrice = @json($price);
    </script>
@endsection
