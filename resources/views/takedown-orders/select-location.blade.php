@extends('dashboard.layouts.main');

@section('container')
    <!-- Quotation Signage start -->
    @php
        $bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $bulan_full = [
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
    @endphp
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex w-[1550px] border-b">
                <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[600px] py-1">Pilih Lokasi Penurunan Gambar
                </h1>
                <div class="flex justify-end w-full">
                    <a class="flex justify-center items-center btn-danger" href="/takedown-orders/index/{{ $company->id }}">
                        <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                        </svg>
                        <span class="ml-1">Cancel</span>
                    </a>
                </div>
            </div>
            <form action="/takedown-orders/select-locations/{{ $company->id }}">
                <div class="flex mt-1 ml-2">
                    <div class="w-36">
                        <span class="text-sm text-stone-100">Area</span>
                        @if (request('area'))
                            <select class="w-full border rounded-lg text-sm text-stone-900 outline-none p-1" name="area"
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
                            <select class="w-full border rounded-lg text-sm text-stone-900 outline-none p-1" name="area"
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
                    <div class="ml-2">
                        <span class="text-sm text-stone-100">Kota</span>
                        <div class="flex">
                            @if (request('area'))
                                @if (request('area') != 'All')
                                    <select id="city"
                                        class="w-36 p-1 border rounded-lg text-sm text-stone-900 outline-none"
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
                                        class="w-36 p-1 border rounded-lg text-sm text-stone-900 outline-none"
                                        name="city" onchange="submit()" disabled>
                                        <option value="All">All</option>
                                    </select>
                                @endif
                            @else
                                <select id="city"
                                    class="w-36 p-1 border rounded-lg text-sm text-stone-900 outline-none" name="city"
                                    onchange="submit()" disabled>
                                    <option value="All">All</option>
                                </select>
                            @endif
                            <div class="flex">
                                <input id="search" name="search"
                                    class="flex border rounded-l-lg ml-2 p-1 outline-none text-sm text-stone-900"
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
                    </div>
                </div>
            </form>
            <div class="flex justify-center w-full mt-2">
                <div class="w-[1550px]">
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="bg-stone-400">
                                <th class="text-stone-900 border border-stone-900 text-xs w-8 text-center" rowspan="2">
                                    No.</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-48" rowspan="2">
                                    <button class="flex justify-center items-center w-full">@sortablelink('number', 'No. SPK Pasang')
                                        <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24">
                                            <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                        </svg>
                                    </button>
                                </th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-24" rowspan="2">
                                    Tgl. Tayang</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-24" rowspan="2">
                                    Klien</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center" rowspan="2">
                                    Tema/Design</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-12" rowspan="2">
                                    Jumlah</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center" colspan="4">Data
                                    Lokasi</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-20" rowspan="2">
                                    Action</th>
                            </tr>
                            <tr class="bg-stone-400">
                                <th class="text-stone-900 border border-stone-900 text-xs w-[72px] text-center">
                                    Kode</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center">Lokasi
                                </th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-10">
                                    Jenis</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-20">
                                    Ukuran
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-stone-200">
                            @php
                                $number = 1 + ($install_orders->currentPage() - 1) * $install_orders->perPage();
                            @endphp
                            @foreach ($install_orders as $order)
                                @php
                                    $client = '-';
                                    $product = json_decode($order->product);
                                    if ($order->sale) {
                                        $client = json_decode($order->sale->quotation->clients);
                                    }
                                @endphp
                                <tr>
                                    <td class="text-stone-900 px-1 border border-stone-900 text-xs  text-center">
                                        {{ $number++ }}
                                    </td>
                                    <td class="text-stone-900 px-1 border border-stone-900 text-xs text-center">
                                        {{ $order->number }}
                                    </td>
                                    <td class="text-stone-900 px-1 border border-stone-900 text-xs text-center">
                                        {{ date('d', strtotime($order->install_at)) }}-{{ $bulan[(int) date('m', strtotime($order->install_at))] }}-{{ date('Y', strtotime($order->install_at)) }}
                                    </td>
                                    <td class="text-stone-900 p-1 border border-stone-900 text-xs text-center">
                                        @if ($order->sale)
                                            @if (strlen($client->name) > 15)
                                                <a href="/marketing/clients/{{ $client->id }}">
                                                    {{ substr($client->name, 0, 15) }}..
                                                </a>
                                            @else
                                                <a href="/marketing/clients/{{ $client->id }}">
                                                    {{ $client->name }}
                                                </a>
                                            @endif
                                        @else
                                            {{ $client }}
                                        @endif
                                    </td>
                                    <td class="text-stone-900 px-1 border border-stone-900 text-xs text-center">
                                        @if (strlen($order->theme) > 40)
                                            {{ substr($order->theme, 0, 40) }}..
                                        @else
                                            {{ $order->theme }}
                                        @endif
                                    </td>
                                    <td class="text-stone-900 px-1 border border-stone-900 text-xs text-center">
                                        {{ $product->qty }}
                                    </td>
                                    <td class="text-stone-900 px-1 border border-stone-900 text-xs text-center">
                                        <a href="/media/locations/{{ $product->location_id }}">
                                            {{ $product->location_code }}-{{ $product->city_code }}
                                        </a>
                                    </td>
                                    <td class="text-stone-900 px-1 border border-stone-900 text-xs">
                                        {{ $order->location->address }}
                                    </td>
                                    <td class="text-stone-900 px-1 border border-stone-900 text-xs text-center">
                                        @if ($order->type == 'Frontlight')
                                            FL
                                        @elseif ($order->type == 'Backlight')
                                            BL
                                        @endif
                                    </td>
                                    <td class="text-stone-900 px-1 border border-stone-900 text-xs  text-center">
                                        {{ $product->location_size }}
                                    </td>
                                    <td class="text-stone-900 px-1 border border-stone-900 text-xs text-center">
                                        <div class="flex justify-center items-center">
                                            <a href="/takedown-orders/create-order/{{ $order->id }}"
                                                class="index-link text-white w-8 h-5 rounded bg-teal-500 hover:bg-teal-600 drop-shadow-md">
                                                <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="m11.998 2.005c5.517 0 9.997 4.48 9.997 9.997 0 5.518-4.48 9.998-9.997 9.998-5.518 0-9.998-4.48-9.998-9.998 0-5.517 4.48-9.997 9.998-9.997zm-5.049 10.386 3.851 3.43c.142.128.321.19.499.19.202 0 .405-.081.552-.242l5.953-6.509c.131-.143.196-.323.196-.502 0-.41-.331-.747-.748-.747-.204 0-.405.082-.554.243l-5.453 5.962-3.298-2.938c-.144-.127-.321-.19-.499-.19-.415 0-.748.335-.748.746 0 .205.084.409.249.557z"
                                                        fill-rule="nonzero" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex justify-center text-stone-100 mt-2">
                {!! $install_orders->appends(Request::query())->render('dashboard.layouts.pagination') !!}
            </div>
        </div>
    </div>
@endsection
