@extends('dashboard.layouts.main');

@section('container')
    <?php
    $bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    $bulan_full = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $daftar_hari = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu',
    ];
    if (request('days') && request('days') != 'All') {
        $periode = request('days') . ' ' . $bulan_full[request('month')] . ' ' . request('year');
    } elseif (request('todays')) {
        $periode = (int) date('d', strtotime(request('todays'))) . ' ' . $bulan_full[(int) date('m', strtotime(request('todays')))] . ' ' . date('Y', strtotime(request('todays')));
    } elseif (request('month') && request('month') != 'All') {
        $periode = $bulan_full[request('month')] . ' ' . request('year');
    } elseif (request('year')) {
        $periode = 'Tahun ' . request('year');
    } else {
        $periode = 'Tahun ' . date('Y');
    }
    $name = 'Daftar SPK Cetak - ' . $periode;
    ?>
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex justify-center w-full">
                <div class="w-[1200px] p-2">
                    <div class="flex border-b">
                        <h1 class="index-h1">Daftar SPK Cetak -
                            @if (request('todays'))
                                Hari Ini
                            @elseif (request('weekday'))
                                Minggu Ini
                            @elseif (request('monthly'))
                                Bulan Ini
                            @elseif (request('annual'))
                                Tahun Ini
                            @else
                                @if (request('days') || request('month'))
                                    @if (request('days') && request('days') != 'All')
                                        {{ request('days') }} {{ $bulan_full[request('month')] }} {{ request('year') }}
                                    @elseif (request('month') && request('month') != 'All')
                                        {{ $bulan_full[request('month')] }} {{ request('year') }}
                                    @elseif (request('year'))
                                        Tahun {{ request('year') }}
                                    @endif
                                @elseif (request('year'))
                                    Tahun {{ request('year') }}
                                @else
                                    Tahun {{ date('Y') }}
                                @endif
                            @endif
                        </h1>
                        <div class="flex">
                            <button class="flex justify-center items-center mx-1 btn-success" title="preview PDF"
                                type="button" onclick="pdfPreview()">
                                <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M24 11v12h-24v-12h4v-10h10.328c1.538 0 5.672 4.852 5.672 6.031v3.969h4zm-6-3.396c0-1.338-2.281-1.494-3.25-1.229.453-.813.305-3.375-1.082-3.375h-7.668v13h12v-8.396zm-2 5.396h-8v-1h8v1zm0-3h-8v1h8v-1zm0-2h-8v1h8v-1z" />
                                </svg>
                                <span class="mx-1">Preview</span>
                            </button>
                            @canany(['isAdmin', 'isMarketing'])
                                @can('isOrder')
                                    @can('isMarketingCreate')
                                        <a href="/print-orders/select-locations/{{ $company->id }}" class="index-link btn-primary">
                                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                            <span class="mx-1">Tambah SPK</span>
                                        </a>
                                    @endcan
                                @endcan
                            @endcanany
                        </div>
                    </div>
                    <form class="flex mt-2" action="/print-orders/index/{{ $company->id }}">
                        @if (request('todays'))
                            <input type="text" name="todays" value="{{ request('todays') }}" hidden>
                        @endif
                        @if (request('weekday'))
                            <input type="text" name="weekday" value="{{ request('weekday') }}" hidden>
                        @endif
                        @if (request('monthly'))
                            <input type="text" name="monthly" value="{{ request('monthly') }}" hidden>
                        @endif
                        @if (request('annual'))
                            <input type="text" name="annual" value="{{ request('annual') }}" hidden>
                        @endif
                        <div class="flex">
                            <div class="w-36">
                                <span class="text-base text-stone-100">Area</span>
                                @if (request('area'))
                                    <select class="w-full border rounded-lg text-sm text-stone-900 outline-none p-1"
                                        name="area" id="area" onchange="submit()" value="{{ request('area') }}">
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
                                    <select class="w-full border rounded-lg text-sm text-stone-900 outline-none p-1"
                                        name="area" id="area" onchange="submit()" value="{{ request('area') }}">
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
                                <span class="text-base text-stone-100">Kota</span>
                                @if (request('area'))
                                    @if (request('area') != 'All')
                                        <select id="city"
                                            class="w-full border rounded-lg text-sm text-stone-900 outline-none p-1"
                                            name="city" onchange="submit()">
                                            <option value="All">All</option>
                                            @foreach ($cities as $city)
                                                @if (request('area') == $city->area_id)
                                                    @if (request('city') == $city->id)
                                                        <option value="{{ $city->id }}" selected>{{ $city->city }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $city->id }}">{{ $city->city }}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    @else
                                        <select id="city"
                                            class="w-full border rounded-lg text-sm text-stone-900 outline-none p-1"
                                            name="city" onchange="submit()" disabled>
                                            <option value="All">All</option>
                                        </select>
                                    @endif
                                @else
                                    <select id="city"
                                        class="w-full border rounded-lg text-sm text-stone-900 outline-none p-1"
                                        name="city" onchange="submit()" disabled>
                                        <option value="All">All</option>
                                    </select>
                                @endif
                            </div>
                            @if (!request('todays') && !request('weekday') && !request('monthly') && !request('annual'))
                                <div class="w-16 ml-2">
                                    @php
                                        if (request('year')) {
                                            $y = date('Y', request('year'));
                                        } else {
                                            $y = date('Y');
                                        }
                                        if (request('month')) {
                                            if (request('month') != 'All') {
                                                $m = date('m', request('month'));
                                            } else {
                                                $m = date('m');
                                            }
                                        } else {
                                            $m = date('m');
                                        }
                                        $d = cal_days_in_month(CAL_GREGORIAN, $m, $y);
                                    @endphp
                                    <span class="flex text-base text-stone-100">Tanggal</span>
                                    @if (request('month') && request('month') != 'All')
                                        <select name="days" id="days"
                                            class="flex outline-none text-sm text-stone-900 border rounded-lg w-14 p-1"
                                            type="date" onchange="submit()">
                                            <option value="All">All</option>
                                            @if (request('days') && request('days') != 'All')
                                                @for ($i = 1; $i <= $d; $i++)
                                                    @if ($i == request('days'))
                                                        <option value="{{ $i }}" selected>{{ $i }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endif
                                                @endfor
                                            @else
                                                @for ($i = 1; $i <= $d; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            @endif
                                        </select>
                                    @else
                                        <select name="days" id="days"
                                            class="flex outline-none text-sm text-stone-900 border rounded-lg w-14 p-1"
                                            type="date" onchange="submit()" disabled>
                                            <option value="All">All</option>
                                            @for ($i = 0; $i < $d; $i++)
                                                <option value="{{ $i + 1 }}">{{ $i + 1 }}</option>
                                            @endfor
                                        </select>
                                    @endif
                                </div>
                                <div class="ml-2 w-24">
                                    <span class="text-base text-stone-100">Bulan</span>
                                    <select name="month"
                                        class="p-1 outline-none border w-full text-sm text-stone-900 rounded-md bg-stone-100"
                                        onchange="submit()">
                                        <option value="All">All</option>
                                        @if (request('month'))
                                            @for ($i = 1; $i < 13; $i++)
                                                @if ($i == request('month'))
                                                    <option value="{{ $i }}" selected>{{ $bulan_full[$i] }}
                                                    </option>
                                                @else
                                                    <option value="{{ $i }}">{{ $bulan_full[$i] }}</option>
                                                @endif
                                            @endfor
                                        @else
                                            @for ($i = 1; $i < 13; $i++)
                                                <option value="{{ $i }}">{{ $bulan_full[$i] }}</option>
                                            @endfor
                                        @endif
                                    </select>
                                </div>
                                <div class="ml-2 w-20">
                                    <span class="text-base text-stone-100">Tahun</span>
                                    <select name="year"
                                        class="p-1 text-center outline-none border w-full text-sm text-stone-900 rounded-md bg-stone-100"
                                        onchange="submit()">
                                        @if (request('year'))
                                            @for ($i = date('Y'); $i > date('Y') - 5; $i--)
                                                @if ($i == request('year'))
                                                    <option value="{{ $i }}" selected>{{ $i }}
                                                    </option>
                                                @else
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endif
                                            @endfor
                                        @else
                                            @for ($i = date('Y'); $i > date('Y') - 5; $i--)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        @endif
                                    </select>
                                </div>
                            @endif
                            <div class="w-48 ml-2">
                                <span class="text-base text-stone-100">Pencarian</span>
                                <div class="flex">
                                    <input id="search" name="search"
                                        class="border rounded-l-lg p-1 outline-none text-sm text-stone-900" type="text"
                                        placeholder="Search" value="{{ request('search') }}" onkeyup="submit()"
                                        onfocus="this.setSelectionRange(this.value.length, this.value.length);" autofocus>
                                    <button
                                        class="flex border p-1 rounded-r-lg text-slate-700 justify-center w-10 bg-slate-50"
                                        type="submit">
                                        <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @if (session()->has('success'))
                        <div class="ml-2 flex alert-success">
                            <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                            </svg>
                            <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="flex justify-center w-full">
                <div class="w-[1200px]">
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="bg-stone-400 h-10">
                                <th class="text-stone-900 border border-stone-900 text-xs w-8 text-center" rowspan="2">
                                    No.</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-28"
                                    rowspan="2">
                                    <button class="flex justify-center items-center w-full">@sortablelink('number', 'Nomor SPK')
                                        <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24">
                                            <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                        </svg>
                                    </button>
                                </th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-24"
                                    rowspan="2">Vendor</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-20"
                                    rowspan="2">Tgl. Cetak</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-20"
                                    colspan="10">Detail Cetak</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-20"
                                    rowspan="2">Action</th>
                            </tr>
                            <tr class="bg-stone-400 h-10">
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-20">No. Penj.
                                </th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-[72px]">Lokasi</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-24">Klien</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-20">Status</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center">Tema/Design</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-24">Bahan</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-20">Ukuran</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-10">Qty</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-14">Harga</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-[72px]">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-stone-200">
                            @php
                                $number = 1 + ($print_orders->currentPage() - 1) * $print_orders->perPage();
                            @endphp
                            @foreach ($print_orders as $order)
                                @php
                                    $client = '-';
                                    $product = json_decode($order->product);
                                    $created_by = json_decode($order->created_by);
                                    $notes = json_decode($order->notes);
                                    if ($order->sale) {
                                        $client = json_decode($order->sale->quotation->clients);
                                    }
                                @endphp
                                <tr>
                                    <td class="text-stone-900 p-1 border border-stone-900 text-xs  text-center">
                                        {{ $number++ }}
                                    </td>
                                    <td class="text-stone-900 p-1 border border-stone-900 text-xs text-center">
                                        <a href="/marketing/print-orders/{{ $order->id }}">
                                            {{ substr($order->number, 0, 15) }}..
                                        </a>
                                    </td>
                                    <td class="text-stone-900 p-1 border border-stone-900 text-xs text-center">
                                        <a href="/marketing/vendors/{{ $order->vendor->id }}">
                                            {{ $order->vendor->name }}
                                        </a>
                                    </td>
                                    <td class="text-stone-900 p-1 border border-stone-900 text-xs text-center">
                                        {{ date('d', strtotime($order->created_at)) }}-{{ $bulan[(int) date('m', strtotime($order->created_at))] }}-{{ date('Y', strtotime($order->created_at)) }}
                                    </td>
                                    <td class="text-stone-900 p-1 border border-stone-900 text-xs text-center">
                                        <a href="/marketing/sales/{{ $order->sale->id }}">
                                            {{ substr($order->sale->number, 0, 8) }}..
                                        </a>
                                    </td>
                                    <td class="text-stone-900 p-1 border border-stone-900 text-xs text-center">
                                        {{ $product->location_code }} - {{ $product->city_code }}
                                    </td>
                                    <td class="text-stone-900 p-1 border border-stone-900 text-xs text-center">
                                        @if ($order->sale)
                                            <a href="/marketing/clients/{{ $client->id }}">
                                                {{ $client->name }}
                                            </a>
                                        @else
                                            {{ $client }}
                                        @endif
                                    </td>
                                    <td class="text-stone-900 p-1 border border-stone-900 text-xs text-center">
                                        {{ $product->status }}
                                    </td>
                                    <td class="text-stone-900 p-1 border border-stone-900 text-xs text-center">
                                        {{ $order->theme }}
                                    </td>
                                    <td class="text-stone-900 p-1 border border-stone-900 text-xs text-center">
                                        {{ $product->product_name }}
                                    </td>
                                    <td class="text-stone-900 p-1 border border-stone-900 text-xs text-center">
                                        {{ $product->location_size }}
                                    </td>
                                    <td class="text-stone-900 p-1 border border-stone-900 text-xs text-center">
                                        {{ $product->qty }}
                                    </td>
                                    <td class="text-stone-900 p-1 border border-stone-900 text-xs text-center">
                                        {{ number_format($product->product_price) }}
                                    </td>
                                    <td class="text-stone-900 p-1 border border-stone-900 text-xs text-center">
                                        {{ number_format($order->price) }}
                                    </td>
                                    <td class="text-stone-900 p-1 border border-stone-900 text-xs text-center">
                                        <div class="flex justify-center items-center">
                                            <a href="/marketing/print-orders/{{ $order->id }}"
                                                class="index-link text-white w-8 h-5 rounded bg-teal-500 hover:bg-teal-600 drop-shadow-md">
                                                <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm8.413 7c-1.837 2.878-4.897 5.5-8.413 5.5-3.465 0-6.532-2.632-8.404-5.5 1.871-2.868 4.939-5.5 8.404-5.5 3.518 0 6.579 2.624 8.413 5.5zm-8.411-4c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"
                                                        fill-rule="nonzero" />
                                                </svg>
                                            </a>
                                            @canany(['isAdmin', 'isMarketing'])
                                                @can('isOrder')
                                                    @can('isMarketingEdit')
                                                        <a href="/marketing/print-orders/{{ $order->id }}/edit"
                                                            class="index-link text-white w-8 h-5 rounded bg-amber-400 hover:bg-amber-500 drop-shadow-md ml-1">
                                                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                                    fill-rule="nonzero" />
                                                            </svg>
                                                        </a>
                                                    @endcan
                                                @endcan
                                            @endcanany
                                            @can('isAdmin')
                                                <form action="/marketing/print-orders/{{ $order->id }}" method="post"
                                                    class="d-inline m-1">
                                                    @method('delete')
                                                    @csrf
                                                    <button
                                                        class="index-link text-white w-7 h-5 bg-red-500 rounded-md hover:bg-red-600"
                                                        onclick="return confirm('Apakah anda yakin ingin menghapus data SPK Cetak dengan nomor {{ $order->number }} ?')">
                                                        <svg class="w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" viewBox="0 0 24 24">
                                                            <title>DELETE</title>
                                                            <path
                                                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (count($print_orders) == 0)
                        <div class="flex justify-center items-center w-full h-16 bg-stone-200">
                            <label class="flex text-base text-red-600 font-serif tracking-wider">
                                ~~ Tidak ada data SPK cetak untuk periode {{ $periode }} ~~
                            </label>
                        </div>
                    @endif
                </div>
            </div>
            <div class="flex justify-center text-stone-100 mt-2">
                {!! $print_orders->appends(Request::query())->render('dashboard.layouts.pagination') !!}
            </div>
        </div>
    </div>
    @include('print-orders.pdf-preview')
    <input id="saveName" type="text" value="{{ $name }}" hidden>

    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/savepdf.js"></script>

    <script>
        pdfPreview = () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            document.getElementById("modalPdfPreview").classList.add('flex');
            document.getElementById("modalPdfPreview").classList.remove('hidden');
        }

        btnClosePreview = () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            document.getElementById("modalPdfPreview").classList.remove('flex');
            document.getElementById("modalPdfPreview").classList.add('hidden');
        }
    </script>
    <!-- Script end -->
@endsection
