@extends('dashboard.layouts.main');

@section('container')
    <!-- Quotation Signage start -->
    <div class="flex justify-center">
        <div>
            <div class="mt-10">
                <div class="flex w-[1100px] border-b">
                    @if ($data_category->name == 'Service')
                        <h1 class="flex text-xl text-cyan-800 font-bold tracking-wider w-[600px] py-1">Pilih Lokasi Cetak /
                            Pasang</h1>
                    @else
                        <h1 class="flex text-xl text-cyan-800 font-bold tracking-wider w-[600px] py-1">Pilih Lokasi
                            {{ $data_category->name }}</h1>
                    @endif

                    <div class="flex justify-end w-full">
                        <button class="flex justify-center items-center btn-primary w-44" type="button"
                            onclick="quotationCreate()">
                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1">Buat Penawaran</span>
                        </button>
                        <a id="btnCreate" hidden></a>
                        <input type="text" name="dataId" id="location_id" value="test" hidden>
                        <input type="text" name="category" id="category" value="{{ $data_category->name }}" hidden>

                        <a class="flex justify-center items-center ml-1 btn-danger"
                            href="/quotations/home/{{ $data_category->name }}">
                            <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="ml-1">Cancel</span>
                        </a>
                    </div>
                </div>
                <form action="/quotations/select-location/{{ $data_category->name }}">
                    <input id="requestService" type="text" value="{{ request('serviceType') }}" hidden>
                    <input id="requestType" type="text" value="{{ request('quotationType') }}" hidden>
                    <div class="flex mt-1 ml-2">
                        <div class="w-36">
                            <span class="text-base text-teal-900">Area</span>
                            @if (request('area'))
                                <select class="w-full border rounded-lg text-base text-teal-900 outline-none" name="area"
                                    id="area" onchange="submit()" value="{{ request('area') }}">
                                    <option value="All">All</option>
                                    @foreach ($areas as $area)
                                        @if (request('area') == $area->id)
                                            <option value="{{ $area->id }}" selected>{{ $area->area }}</option>
                                        @else
                                            <option value="{{ $area->id }}">{{ $area->area }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @else
                                <select class="w-full border rounded-lg text-base text-teal-900 outline-none" name="area"
                                    id="area" onchange="submit()" value="{{ request('area') }}">
                                    <option value="All">All</option>
                                    @foreach ($areas as $area)
                                        @if (request('area') == $area->id)
                                            <option value="{{ $area->id }}">{{ $area->area }}</option>
                                        @else
                                            <option value="{{ $area->id }}">{{ $area->area }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @endif
                        </div>
                        <div class="w-36 ml-2">
                            <span class="text-base text-teal-900">Kota</span>
                            @if (request('area'))
                                <select id="city" class="w-full border rounded-lg text-base text-teal-900 outline-none"
                                    name="city" onchange="submit()">
                                    <option value="All">All</option>
                                    @foreach ($cities as $city)
                                        @if (request('area') == $city->area_id)
                                            @if (request('city') == $city->id)
                                                <option value="{{ $city->id }}" selected>{{ $city->city }}</option>
                                            @else
                                                <option value="{{ $city->id }}">{{ $city->city }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            @else
                                <select id="city" class="w-full border rounded-lg text-base text-teal-900 outline-none"
                                    name="city" onchange="submit()" disabled>
                                    <option value="All">All</option>
                                </select>
                            @endif
                        </div>

                        @if ($data_category->name == 'Signage')
                            <div class="w-36 ml-2">
                                @php
                                    $dataType = ['Neon Box', 'Videotron', 'Papan'];
                                @endphp
                                <span class="text-base text-teal-900">Jenis</span>
                                @if (request('type'))
                                    <select class="w-full border rounded-lg text-base text-teal-900 outline-none"
                                        name="type" id="type" onchange="submit()" value="{{ request('type') }}">
                                        <option value="All">All</option>
                                        @foreach ($dataType as $type)
                                            @if (request('type') == $type)
                                                <option value="{{ $type }}" selected>{{ $type }}</option>
                                            @else
                                                <option value="{{ $type }}">{{ $type }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                @else
                                    <select class="w-full border rounded-lg text-base text-teal-900 outline-none"
                                        name="type" id="type" onchange="submit()" value="{{ request('type') }}">
                                        <option value="All">All</option>
                                        @foreach ($dataType as $type)
                                            @if (request('type') == $type)
                                                <option value="{{ $type }}">{{ $type }}</option>
                                            @else
                                                <option value="{{ $type }}">{{ $type }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        @endif
                        @if ($data_category->name == 'Service')
                            <div class="w-36 ml-4">
                                <span class="text-base text-teal-900">Katagori</span>
                                <select class="w-full border rounded-lg text-base text-teal-900 outline-none"
                                    name="media_category_id" id="media_category_id" onchange="submit()"
                                    value="{{ request('media_category_id') }}">
                                    <option value="All">All</option>
                                    @foreach ($categories as $dataCategory)
                                        @if ($dataCategory->name != 'Videotron' && $dataCategory->name != 'Service')
                                            @if (request('media_category_id') == $dataCategory->id)
                                                <option value="{{ $dataCategory->id }}" selected>
                                                    {{ $dataCategory->name }}
                                                </option>
                                            @else
                                                <option value="{{ $dataCategory->id }}">{{ $dataCategory->name }}
                                                </option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="ml-4">
                                <span class="text-base text-teal-900">Jenis Penawaran</span>
                                <div class="flex items-center">
                                    <input id="existingRadioService" class="outline-none" type="radio"
                                        name="serviceType" value="existing" onclick="typeServiceCheck(this)" checked>
                                    <label class="text-sm text-teal-900 ml-2" for="existing">Dari Data Penjualan</label>
                                    <input id="newRadioService" class="outline-none  ml-4" type="radio"
                                        name="serviceType" value="new" onclick="typeServiceCheck(this)">
                                    <label class="text-sm text-teal-900 ml-2" for="new">Penawaran Baru</label>
                                </div>
                            </div>
                        @else
                            <div class="ml-4">
                                <span class="text-base text-teal-900">Jenis Penawaran</span>
                                <div class="flex items-center">
                                    <input id="newType" class="outline-none" type="radio" name="quotationType"
                                        value="new" checked onclick="typeCheck(this)">
                                    <label class="text-sm text-teal-900 ml-2" for="new">Penawaran Baru</label>
                                    <input id="extendType" class="outline-none ml-4" type="radio" name="quotationType"
                                        value="extend" onclick="typeCheck(this)">
                                    <label class="text-sm text-teal-900 ml-2" for="extend">Penawaran
                                        Perpanjangan</label>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="flex mt-2">
                        <div class="flex">
                            <input id="search" name="search"
                                class="flex border rounded-l-lg ml-2 p-1 outline-none text-base text-teal-900"
                                type="text" placeholder="Search" value="{{ request('search') }}" onkeyup="submit()"
                                autofocus onfocus="this.setSelectionRange(this.value.length,this.value.length);">
                            <button class="flex border p-1 rounded-r-lg text-slate-700 justify-center w-10 bg-slate-50"
                                type="submit">
                                <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="w-[1100px] mt-4">
                @if ($category == 'Service')
                    <table id="newService" class="table-auto w-full" hidden>
                        <thead>
                            <tr class="bg-teal-100 h-10">
                                <th class="text-teal-700 border text-sm w-8 text-center">No</th>
                                <th class="text-teal-700 border text-sm w-24 text-center">Kode</th>
                                <th class="text-teal-700 border text-sm text-center">Lokasi</th>
                                <th class="text-teal-700 border text-sm text-center w-24">Area</th>
                                <th class="text-teal-700 border text-sm text-center w-24">Kota</th>
                                <th class="text-teal-700 border text-sm text-center w-24">Jenis</th>
                                <th class="text-teal-700 border text-sm text-center w-28">Size - V/H</th>
                                <th class="text-teal-700 border text-sm text-center w-12">BL/FL</th>
                                <th class="text-teal-700 border text-sm text-center w-16">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="/quotations/select-location/{{ $data_category->name }}">
                                @php
                                    $index = 0;
                                @endphp
                                @foreach ($locations as $location)
                                    @if ($location->media_category->name != 'Videotron')
                                        @php
                                            $description = json_decode($location->description);
                                            $index++;
                                        @endphp
                                        @if ($location->media_category->name == 'Signage')
                                            @if ($description->type != 'Videotron')
                                                <tr>
                                                    <td class="text-teal-700 border text-sm text-center">
                                                        {{ $index }}
                                                    </td>
                                                    <td class="text-teal-700 border text-sm text-center">
                                                        {{ $location->code }}
                                                        -
                                                        {{ $location->city->code }}</td>
                                                    <td class="text-teal-700 border text-sm px-2">{{ $location->address }}
                                                    </td>
                                                    <td class="text-teal-700 border text-sm text-center">
                                                        {{ $location->area->area }}
                                                    </td>
                                                    <td class="text-teal-700 border text-sm text-center">
                                                        {{ $location->city->city }}
                                                    </td>
                                                    <td class="text-teal-700 border text-sm text-center">
                                                        {{ $location->media_category->name }}
                                                    </td>
                                                    <td class="text-teal-700 border text-sm text-center">
                                                        {{ $location->media_size->size }}
                                                        -
                                                        @if ($location->orientation == 'Vertikal')
                                                            V
                                                        @elseif ($location->orientation == 'Horizontal')
                                                            H
                                                        @endif
                                                    </td>
                                                    <td class="text-teal-700 border text-sm text-center">
                                                        @if ($location->media_category->name == 'Videotron')
                                                            -
                                                        @elseif ($location->media_category->name == 'Signage')
                                                            @if ($description->type == 'Videotron')
                                                                -
                                                            @else
                                                                @if ($description->lighting == 'Backlight')
                                                                    BL
                                                                @elseif ($description->lighting == 'Frontlight')
                                                                    FL
                                                                @elseif ($description->lighting == 'Nonlight')
                                                                    NL
                                                                @endif
                                                            @endif
                                                        @else
                                                            @if ($description->lighting == 'Backlight')
                                                                BL
                                                            @elseif ($description->lighting == 'Frontlight')
                                                                FL
                                                            @elseif ($description->lighting == 'Nonlight')
                                                                NL
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td class="text-teal-700 border text-center text-sm">
                                                        @if ($data_category->name == 'Signage')
                                                            @if (request('type') == null || request('type') == 'All')
                                                                <input id="{{ $description->type }}"
                                                                    value="{{ $location->id }}" type="checkbox"
                                                                    title="pilih" onclick="getLocation(this)" disabled>
                                                            @else
                                                                <input value="{{ $location->id }}" type="checkbox"
                                                                    title="pilih" onclick="getLocation(this)">
                                                            @endif
                                                        @else
                                                            <input value="{{ $location->id }}" type="checkbox"
                                                                title="pilih" onclick="getLocation(this)">
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @else
                                            <tr>
                                                <td class="text-teal-700 border text-sm text-center">{{ $index }}
                                                </td>
                                                <td class="text-teal-700 border text-sm text-center">{{ $location->code }}
                                                    -
                                                    {{ $location->city->code }}</td>
                                                <td class="text-teal-700 border text-sm px-2">{{ $location->address }}
                                                </td>
                                                <td class="text-teal-700 border text-sm text-center">
                                                    {{ $location->area->area }}
                                                </td>
                                                <td class="text-teal-700 border text-sm text-center">
                                                    {{ $location->city->city }}
                                                </td>
                                                <td class="text-teal-700 border text-sm text-center">
                                                    {{ $location->media_category->name }}
                                                </td>
                                                <td class="text-teal-700 border text-sm text-center">
                                                    {{ $location->media_size->size }}
                                                    -
                                                    @if ($location->orientation == 'Vertikal')
                                                        V
                                                    @elseif ($location->orientation == 'Horizontal')
                                                        H
                                                    @endif
                                                </td>
                                                <td class="text-teal-700 border text-sm text-center">
                                                    @if ($location->media_category->name == 'Videotron')
                                                        -
                                                    @elseif ($location->media_category->name == 'Signage')
                                                        @if ($description->type == 'Videotron')
                                                            -
                                                        @else
                                                            @if ($description->lighting == 'Backlight')
                                                                BL
                                                            @elseif ($description->lighting == 'Frontlight')
                                                                FL
                                                            @elseif ($description->lighting == 'Nonlight')
                                                                NL
                                                            @endif
                                                        @endif
                                                    @else
                                                        @if ($description->lighting == 'Backlight')
                                                            BL
                                                        @elseif ($description->lighting == 'Frontlight')
                                                            FL
                                                        @elseif ($description->lighting == 'Nonlight')
                                                            NL
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="text-teal-700 border text-center text-sm">
                                                    @if ($data_category->name == 'Signage')
                                                        @if (request('type') == null || request('type') == 'All')
                                                            <input id="{{ $description->type }}"
                                                                value="{{ $location->id }}" type="checkbox"
                                                                title="pilih" onclick="getLocation(this)" disabled>
                                                        @else
                                                            <input value="{{ $location->id }}" type="checkbox"
                                                                title="pilih" onclick="getLocation(this)">
                                                        @endif
                                                    @else
                                                        <input value="{{ $location->id }}" type="checkbox"
                                                            title="pilih" onclick="getLocation(this)">
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                @endforeach
                            </form>
                        </tbody>
                    </table>
                    <table id="existingService" class="table-auto w-full">
                        <thead>
                            <tr class="bg-teal-100">
                                <th class="text-teal-700 border text-xs w-8 text-center" rowspan="2">No</th>
                                <th class="text-teal-700 border text-xs w-20 text-center" rowspan="2">Kode</th>
                                <th class="text-teal-700 border text-xs text-center" rowspan="2">Lokasi</th>
                                <th class="text-teal-700 border text-xs text-center w-28" rowspan="2">Klien</th>
                                <th class="text-teal-700 border text-xs text-center w-40" colspan="2">Periode Kontrak
                                </th>
                                <th class="text-teal-700 border text-xs text-center w-14" rowspan="2">Free Cetak</th>
                                <th class="text-teal-700 border text-xs text-center w-14" rowspan="2">Free Pasang</th>
                                <th class="text-teal-700 border text-xs text-center w-16" rowspan="2">Area</th>
                                <th class="text-teal-700 border text-xs text-center w-16" rowspan="2">Kota</th>
                                <th class="text-teal-700 border text-xs text-center w-20" rowspan="2">Size - V/H</th>
                                <th class="text-teal-700 border text-xs text-center w-10" rowspan="2">BL/FL</th>
                                <th class="text-teal-700 border text-xs text-center w-12" rowspan="2">Action</th>
                            </tr>
                            <tr class="bg-teal-100">
                                <th class="text-teal-700 border text-xs w-20 text-center" rowspan="2">Awal</th>
                                <th class="text-teal-700 border text-xs w-20 text-center" rowspan="2">Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="/quotations/select-location/{{ $data_category->name }}">
                                @php
                                    $index = 0;
                                @endphp
                                @foreach ($sales as $sale)
                                    @php
                                        $products = json_decode($sale->quotation->products);
                                        foreach ($products as $product) {
                                            if ($product->code == $sale->product_code) {
                                                $dataProduct = $product;
                                            }
                                        }
                                        $client = json_decode($sale->quotation->clients);
                                        $notes = json_decode($sale->quotation->notes);
                                    @endphp
                                    @if ($sale->end_at > date('Y-m-d') && $dataProduct->category == 'Signage')
                                        @if ($description->type != 'Videotron')
                                            @php
                                                $freePrint = $notes->freePrint;
                                                $freeInstall = $notes->freeInstall;
                                                $description = json_decode($dataProduct->description);
                                                $index++;
                                            @endphp
                                            <tr>
                                                <td class="text-teal-700 border text-xs text-center">
                                                    {{ $index }}
                                                </td>
                                                <td class="text-teal-700 border text-xs text-center">
                                                    {{ $dataProduct->code }}
                                                    -
                                                    {{ $dataProduct->city_code }}</td>
                                                <td class="text-teal-700 border text-xs px-2">
                                                    {{ $dataProduct->address }}
                                                </td>
                                                <td class="text-teal-700 border text-xs px-2 text-center">
                                                    {{ $client->name }}
                                                </td>
                                                <td class="text-teal-700 border text-xs px-2 text-center">
                                                    {{ date('d-m-Y', strtotime($sale->start_at)) }}
                                                </td>
                                                <td class="text-teal-700 border text-xs px-2 text-center">
                                                    {{ date('d-m-Y', strtotime($sale->end_at)) }}
                                                </td>
                                                <td class="text-teal-700 border text-xs text-center">
                                                    {{ $dataProduct->area }}</td>
                                                <td class="text-teal-700 border text-xs text-center">
                                                    {{ $dataProduct->city }}</td>
                                                <td class="text-teal-700 border text-xs text-center">
                                                    {{ $dataProduct->size }}
                                                    -
                                                    @if ($dataProduct->orientation == 'Vertikal')
                                                        V
                                                    @elseif ($dataProduct->orientation == 'Horizontal')
                                                        H
                                                    @endif
                                                </td>
                                                @if ($dataProduct->category == 'Signage')
                                                    <td class="text-teal-700 border text-xs text-center w-12">
                                                        {{ $description->type }}
                                                    </td>
                                                @endif
                                                <td class="text-teal-700 border text-xs text-center">
                                                    @if ($dataProduct->category == 'Videotron')
                                                        -
                                                    @elseif ($dataProduct->category == 'Signage')
                                                        @if ($description->type == 'Videotron')
                                                            -
                                                        @else
                                                            @if ($description->lighting == 'Backlight')
                                                                BL
                                                            @elseif ($description->lighting == 'Frontlight')
                                                                FL
                                                            @elseif ($description->lighting == 'Nonlight')
                                                                NL
                                                            @endif
                                                        @endif
                                                    @else
                                                        @if ($description->lighting == 'Backlight')
                                                            BL
                                                        @elseif ($description->lighting == 'Frontlight')
                                                            FL
                                                        @elseif ($description->lighting == 'Nonlight')
                                                            NL
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="text-teal-700 border text-center text-xs">
                                                    @if ($dataProduct->category == 'Signage')
                                                        @if (request('type') == null || request('type') == 'All')
                                                            <input id="{{ $description->type }}"
                                                                value="{{ $sale->id }}" type="checkbox"
                                                                title="pilih" onclick="getLocation(this)" disabled>
                                                        @else
                                                            <input value="{{ $sale->id }}" type="checkbox"
                                                                title="pilih" onclick="getLocation(this)">
                                                        @endif
                                                    @else
                                                        <input value="{{ $sale->id }}" type="checkbox"
                                                            title="pilih" onclick="getLocation(this)">
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @elseif($sale->end_at > date('Y-m-d') && $dataProduct->category != 'Videotron')
                                        @php
                                            $freePrint = $notes->freePrint;
                                            $freeInstall = $notes->freeInstall;
                                            $description = json_decode($dataProduct->description);
                                            $index++;
                                        @endphp
                                        <tr>
                                            <td class="text-teal-700 border text-xs text-center">
                                                {{ $index }}
                                            </td>
                                            <td class="text-teal-700 border text-xs text-center">
                                                {{ $dataProduct->code }}
                                                -
                                                {{ $dataProduct->city_code }}</td>
                                            <td class="text-teal-700 border text-xs px-2">{{ $dataProduct->address }}
                                            </td>
                                            <td class="text-teal-700 border text-xs px-2 text-center">
                                                {{ $client->name }}
                                            </td>
                                            <td class="text-teal-700 border text-xs px-2 text-center">
                                                {{ date('d-m-Y', strtotime($sale->start_at)) }}
                                            </td>
                                            <td class="text-teal-700 border text-xs px-2 text-center">
                                                {{ date('d-m-Y', strtotime($sale->end_at)) }}
                                            </td>
                                            <td class="text-teal-700 border text-xs text-center">
                                                {{ $freePrint }}</td>
                                            <td class="text-teal-700 border text-xs text-center">
                                                {{ $freeInstall }}</td>
                                            <td class="text-teal-700 border text-xs text-center">
                                                {{ $dataProduct->area }}</td>
                                            <td class="text-teal-700 border text-xs text-center">
                                                {{ $dataProduct->city }}</td>
                                            <td class="text-teal-700 border text-xs text-center">
                                                {{ $dataProduct->size }}
                                                -
                                                @if ($dataProduct->orientation == 'Vertikal')
                                                    V
                                                @elseif ($dataProduct->orientation == 'Horizontal')
                                                    H
                                                @endif
                                            </td>
                                            @if ($dataProduct->category == 'Signage')
                                                <td class="text-teal-700 border text-xs text-center w-12">
                                                    {{ $description->type }}
                                                </td>
                                            @endif
                                            <td class="text-teal-700 border text-xs text-center">
                                                @if ($dataProduct->category == 'Videotron')
                                                    -
                                                @elseif ($dataProduct->category == 'Signage')
                                                    @if ($description->type == 'Videotron')
                                                        -
                                                    @else
                                                        @if ($description->lighting == 'Backlight')
                                                            BL
                                                        @elseif ($description->lighting == 'Frontlight')
                                                            FL
                                                        @elseif ($description->lighting == 'Nonlight')
                                                            NL
                                                        @endif
                                                    @endif
                                                @else
                                                    @if ($description->lighting == 'Backlight')
                                                        BL
                                                    @elseif ($description->lighting == 'Frontlight')
                                                        FL
                                                    @elseif ($description->lighting == 'Nonlight')
                                                        NL
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-teal-700 border text-center text-xs">
                                                @if ($dataProduct->category == 'Signage')
                                                    @if (request('type') == null || request('type') == 'All')
                                                        <input id="{{ $description->type }}" value="{{ $sale->id }}"
                                                            type="checkbox" title="pilih" onclick="getLocation(this)"
                                                            disabled>
                                                    @else
                                                        <input value="{{ $sale->id }}" type="checkbox"
                                                            title="pilih" onclick="getLocation(this)">
                                                    @endif
                                                @else
                                                    <input value="{{ $sale->id }}" type="checkbox" title="pilih"
                                                        onclick="getLocation(this)">
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </form>
                        </tbody>
                    </table>
                @else
                    <table id="newQuotation" class="table-auto w-full">
                        <thead>
                            <tr class="bg-teal-100 h-10">
                                <th class="text-teal-700 border text-sm w-8 text-center">No</th>
                                <th class="text-teal-700 border text-sm w-24 text-center">Kode</th>
                                <th class="text-teal-700 border text-sm text-center">Lokasi</th>
                                <th class="text-teal-700 border text-sm text-center w-24">Area</th>
                                <th class="text-teal-700 border text-sm text-center w-24">Kota</th>
                                <th class="text-teal-700 border text-sm text-center w-24">Jenis</th>
                                <th class="text-teal-700 border text-sm text-center w-28">Size - V/H</th>
                                @if ($data_category->name == 'Signage')
                                    <th class="text-teal-700 border text-sm text-center w-20">Tipe</th>
                                @endif
                                <th class="text-teal-700 border text-sm text-center w-12">BL/FL</th>
                                <th class="text-teal-700 border text-sm text-center w-16">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="/quotations/select-location/{{ $data_category->name }}">
                                @php
                                    $index = 0;
                                @endphp
                                @foreach ($locations as $location)
                                    @if (count($location->sales) != 0)
                                        @if ($location->sales[count($location->sales) - 1]->end_at < date('Y-m-d'))
                                            @php
                                                $description = json_decode($location->description);
                                                $index++;
                                            @endphp
                                            <tr>
                                                <td class="text-teal-700 border text-sm text-center">{{ $index }}
                                                </td>
                                                <td class="text-teal-700 border text-sm text-center">{{ $location->code }}
                                                    -
                                                    {{ $location->city->code }}</td>
                                                <td class="text-teal-700 border text-sm px-2">{{ $location->address }}
                                                </td>
                                                <td class="text-teal-700 border text-sm text-center">
                                                    {{ $location->area->area }}</td>
                                                <td class="text-teal-700 border text-sm text-center">
                                                    {{ $location->city->city }}</td>
                                                <td class="text-teal-700 border text-sm text-center">
                                                    {{ $location->media_category->name }}</td>
                                                <td class="text-teal-700 border text-sm text-center">
                                                    {{ $location->media_size->size }}
                                                    -
                                                    @if ($location->orientation == 'Vertikal')
                                                        V
                                                    @elseif ($location->orientation == 'Horizontal')
                                                        H
                                                    @endif
                                                </td>
                                                @if ($location->media_category->name == 'Signage')
                                                    <td class="text-teal-700 border text-sm text-center w-12">
                                                        {{ $description->type }}
                                                    </td>
                                                @endif
                                                <td class="text-teal-700 border text-sm text-center">
                                                    @if ($location->media_category->name == 'Videotron')
                                                        -
                                                    @elseif ($location->media_category->name == 'Signage')
                                                        @if ($description->type == 'Videotron')
                                                            -
                                                        @else
                                                            @if ($description->lighting == 'Backlight')
                                                                BL
                                                            @elseif ($description->lighting == 'Frontlight')
                                                                FL
                                                            @elseif ($description->lighting == 'Nonlight')
                                                                NL
                                                            @endif
                                                        @endif
                                                    @else
                                                        @if ($description->lighting == 'Backlight')
                                                            BL
                                                        @elseif ($description->lighting == 'Frontlight')
                                                            FL
                                                        @elseif ($description->lighting == 'Nonlight')
                                                            NL
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="text-teal-700 border text-center text-sm">
                                                    @if ($data_category->name == 'Signage')
                                                        @if (request('type') == null || request('type') == 'All')
                                                            <input id="{{ $description->type }}"
                                                                value="{{ $location->id }}" type="checkbox"
                                                                title="pilih" onclick="getLocation(this)" disabled>
                                                        @else
                                                            <input value="{{ $location->id }}" type="checkbox"
                                                                title="pilih" onclick="getLocation(this)">
                                                        @endif
                                                    @else
                                                        <input value="{{ $location->id }}" type="checkbox"
                                                            title="pilih" onclick="getLocation(this)">
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @else
                                        @php
                                            $description = json_decode($location->description);
                                            $index++;
                                        @endphp
                                        <tr>
                                            <td class="text-teal-700 border text-sm text-center">{{ $index }}</td>
                                            <td class="text-teal-700 border text-sm text-center">{{ $location->code }} -
                                                {{ $location->city->code }}</td>
                                            <td class="text-teal-700 border text-sm px-2">{{ $location->address }}</td>
                                            <td class="text-teal-700 border text-sm text-center">
                                                {{ $location->area->area }}
                                            </td>
                                            <td class="text-teal-700 border text-sm text-center">
                                                {{ $location->city->city }}
                                            </td>
                                            <td class="text-teal-700 border text-sm text-center">
                                                {{ $location->media_category->name }}
                                            </td>
                                            <td class="text-teal-700 border text-sm text-center">
                                                {{ $location->media_size->size }}
                                                -
                                                @if ($location->orientation == 'Vertikal')
                                                    V
                                                @elseif ($location->orientation == 'Horizontal')
                                                    H
                                                @endif
                                            </td>
                                            @if ($location->media_category->name == 'Signage')
                                                <td class="text-teal-700 border text-sm text-center w-12">
                                                    {{ $description->type }}
                                                </td>
                                            @endif
                                            <td class="text-teal-700 border text-sm text-center">
                                                @if ($location->media_category->name == 'Videotron')
                                                    -
                                                @elseif ($location->media_category->name == 'Signage')
                                                    @if ($description->type == 'Videotron')
                                                        -
                                                    @else
                                                        @if ($description->lighting == 'Backlight')
                                                            BL
                                                        @elseif ($description->lighting == 'Frontlight')
                                                            FL
                                                        @elseif ($description->lighting == 'Nonlight')
                                                            NL
                                                        @endif
                                                    @endif
                                                @else
                                                    @if ($description->lighting == 'Backlight')
                                                        BL
                                                    @elseif ($description->lighting == 'Frontlight')
                                                        FL
                                                    @elseif ($description->lighting == 'Nonlight')
                                                        NL
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-teal-700 border text-center text-sm">
                                                @if ($data_category->name == 'Signage')
                                                    @if (request('type') == null || request('type') == 'All')
                                                        <input id="{{ $description->type }}"
                                                            value="{{ $location->id }}" type="checkbox" title="pilih"
                                                            onclick="getLocation(this)" disabled>
                                                    @else
                                                        <input value="{{ $location->id }}" type="checkbox"
                                                            title="pilih" onclick="getLocation(this)">
                                                    @endif
                                                @else
                                                    <input value="{{ $location->id }}" type="checkbox" title="pilih"
                                                        onclick="getLocation(this)">
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </form>
                        </tbody>
                    </table>
                    <table id="extendQuotation" class="table-auto w-full" hidden>
                        <thead>
                            <tr class="bg-teal-100">
                                <th class="text-teal-700 border text-xs w-8 text-center" rowspan="2">No</th>
                                <th class="text-teal-700 border text-xs w-20 text-center" rowspan="2">Kode</th>
                                <th class="text-teal-700 border text-xs text-center" rowspan="2">Lokasi</th>
                                <th class="text-teal-700 border text-xs text-center w-28" rowspan="2">Klien</th>
                                <th class="text-teal-700 border text-xs text-center w-44" colspan="2">Periode Kontrak
                                </th>
                                <th class="text-teal-700 border text-xs text-center w-16" rowspan="2">Area</th>
                                <th class="text-teal-700 border text-xs text-center w-16" rowspan="2">Kota</th>
                                <th class="text-teal-700 border text-xs text-center w-20" rowspan="2">Size - V/H</th>
                                @if ($data_category->name == 'Signage')
                                    <th class="text-teal-700 border text-xs text-center w-20" rowspan="2">Tipe</th>
                                @endif
                                <th class="text-teal-700 border text-xs text-center w-12" rowspan="2">BL/FL</th>
                                <th class="text-teal-700 border text-xs text-center w-14" rowspan="2">Action</th>
                            </tr>
                            <tr class="bg-teal-100">
                                <th class="text-teal-700 border text-xs w-24 text-center" rowspan="2">Awal</th>
                                <th class="text-teal-700 border text-xs w-24 text-center" rowspan="2">Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="/quotations/select-location/{{ $data_category->name }}">
                                @php
                                    $index = 0;
                                @endphp
                                @foreach ($sales as $sale)
                                    @if ($sale->end_at > date('Y-m-d'))
                                        @php
                                            $products = json_decode($sale->quotation->products);
                                            foreach ($products as $product) {
                                                if ($product->code == $sale->product_code) {
                                                    $dataProduct = $product;
                                                }
                                            }
                                            $client = json_decode($sale->quotation->clients);
                                            $notes = json_decode($sale->quotation->notes);
                                            $description = json_decode($dataProduct->description);
                                            $index++;
                                        @endphp
                                        <tr>
                                            <td class="text-teal-700 border text-xs text-center">{{ $index }}
                                            </td>
                                            <td class="text-teal-700 border text-xs text-center">
                                                {{ $dataProduct->code }}
                                                -
                                                {{ $dataProduct->city_code }}</td>
                                            <td class="text-teal-700 border text-xs px-2">{{ $dataProduct->address }}
                                            </td>
                                            <td class="text-teal-700 border text-xs px-2 text-center">
                                                {{ $client->name }}
                                            </td>
                                            <td class="text-teal-700 border text-xs px-2 text-center">
                                                {{ date('d-M-Y', strtotime($sale->start_at)) }}
                                            </td>
                                            <td class="text-teal-700 border text-xs px-2 text-center">
                                                {{ date('d-M-Y', strtotime($sale->end_at)) }}
                                            </td>
                                            <td class="text-teal-700 border text-xs text-center">
                                                {{ $dataProduct->area }}</td>
                                            <td class="text-teal-700 border text-xs text-center">
                                                {{ $dataProduct->city }}</td>
                                            <td class="text-teal-700 border text-xs text-center">
                                                {{ $dataProduct->size }}
                                                -
                                                @if ($dataProduct->orientation == 'Vertikal')
                                                    V
                                                @elseif ($dataProduct->orientation == 'Horizontal')
                                                    H
                                                @endif
                                            </td>
                                            @if ($dataProduct->category == 'Signage')
                                                <td class="text-teal-700 border text-xs text-center w-12">
                                                    {{ $description->type }}
                                                </td>
                                            @endif
                                            <td class="text-teal-700 border text-xs text-center">
                                                @if ($dataProduct->category == 'Videotron')
                                                    -
                                                @elseif ($dataProduct->category == 'Signage')
                                                    @if ($description->type == 'Videotron')
                                                        -
                                                    @else
                                                        @if ($description->lighting == 'Backlight')
                                                            BL
                                                        @elseif ($description->lighting == 'Frontlight')
                                                            FL
                                                        @elseif ($description->lighting == 'Nonlight')
                                                            NL
                                                        @endif
                                                    @endif
                                                @else
                                                    @if ($description->lighting == 'Backlight')
                                                        BL
                                                    @elseif ($description->lighting == 'Frontlight')
                                                        FL
                                                    @elseif ($description->lighting == 'Nonlight')
                                                        NL
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-teal-700 border text-center text-xs">
                                                @if ($dataProduct->category == 'Signage')
                                                    @if (request('type') == null || request('type') == 'All')
                                                        <input id="{{ $description->type }}"
                                                            value="{{ $sale->id }}" type="checkbox" title="pilih"
                                                            onclick="getLocation(this)" disabled>
                                                    @else
                                                        <input value="{{ $sale->id }}" type="checkbox"
                                                            title="pilih" onclick="getLocation(this)">
                                                    @endif
                                                @else
                                                    <input value="{{ $sale->id }}" type="checkbox" title="pilih"
                                                        onclick="getLocation(this)">
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </form>
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <script src="/js/selectlocation.js"></script>
@endsection
