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
    $name = 'DAFTAR SPK PASANG - ' . date('d', strtotime(request('periode'))) . ' ' . $bulan_full[(int) date('m', strtotime(request('periode')))] . ' ' . date('Y', strtotime(request('periode')));
    ?>
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex justify-center w-full">
                <div class="w-[1200px]">
                    <div class="flex border-b">
                        <h1 class="index-h1">Daftar SPK Pemasangan Gambar</h1>
                        <div class="flex">
                            @if (request('periode'))
                                @if (request('periode') != '' && count($install_orders) != 0)
                                    <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-success"
                                        title="Simpan PDF" type="button" onclick="savePdf()">
                                        <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24">
                                            <path
                                                d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                                        </svg>
                                        <span class="mx-1">Save PDF</span>
                                    </button>
                                @endif
                            @endif
                            @canany(['isAdmin', 'isMarketing'])
                                @can('isOrder')
                                    @can('isMarketingCreate')
                                        <a href="/install-orders/select-locations/{{ $company->id }}" class="index-link btn-primary">
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
                    <form action="/install-orders/index/{{ $company->id }}">
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
                            <div class="w-40">
                                <span class="text-base  text-stone-100">Tgl. Tayang</span>
                                @if (request('periode'))
                                    <input class="outline-none text-sm text-stone-900 border rounded-lg w-36 p-1"
                                        type="date" name="periode" id="periode" value="{{ request('periode') }}"
                                        onchange="submit()">
                                @else
                                    <input class="outline-none text-sm text-stone-900 border rounded-lg w-36 p-1"
                                        type="date" name="periode" id="periode" onchange="submit()">
                                @endif
                            </div>
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
                        <div class="mt-2 flex alert-success">
                            <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                            </svg>
                            <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="flex justify-center w-full mt-2">
                <div class="w-[1200px]">
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="bg-stone-400">
                                <th class="text-stone-900 border border-stone-900 text-xs w-8 text-center" rowspan="2">
                                    No.</th>
                                <th class="text-stone-900 border border-stone-900 text-xs w-16 text-center" rowspan="2">
                                    Kode</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center" rowspan="2">Lokasi
                                </th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-24" rowspan="2">
                                    Klien</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-20" rowspan="2">
                                    Ukuran
                                </th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-10" rowspan="2">
                                    Jenis</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center" colspan="4">Data
                                    SPK</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-28" rowspan="2">
                                    Action</th>
                            </tr>
                            <tr class="bg-stone-400">
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-24">
                                    <button class="flex justify-center items-center w-full">@sortablelink('number', 'No. SPK')
                                        <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24">
                                            <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                        </svg>
                                    </button>
                                </th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center">Tema/Design</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-10">Qty</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-24">Jwl. Tayang
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
                                        {{ $product->location_code }}-{{ $product->city_code }}
                                    </td>
                                    <td class="text-stone-900 px-1 border border-stone-900 text-xs">
                                        {{ $order->location->address }}
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
                                    <td class="text-stone-900 px-1 border border-stone-900 text-xs  text-center">
                                        {{ $product->location_size }}
                                    </td>
                                    <td class="text-stone-900 px-1 border border-stone-900 text-xs text-center">
                                        @if ($order->type == 'Frontlight')
                                            FL
                                        @elseif ($order->type == 'Backlight')
                                            BL
                                        @endif
                                    </td>
                                    <td class="text-stone-900 px-1 border border-stone-900 text-xs text-center">
                                        <a href="/marketing/install-orders/{{ $order->id }}">
                                            {{ substr($order->number, 0, 8) }}..
                                        </a>
                                    </td>
                                    <td class="text-stone-900 px-1 border border-stone-900 text-xs text-center">
                                        @if (strlen($order->theme) > 20)
                                            {{ substr($order->theme, 0, 20) }}..
                                        @else
                                            {{ $order->theme }}
                                        @endif
                                    </td>
                                    <td class="text-stone-900 px-1 border border-stone-900 text-xs text-center">
                                        {{ $product->qty }}
                                    </td>
                                    <td class="text-stone-900 px-1 border border-stone-900 text-xs text-center">
                                        {{ date('d', strtotime($order->install_at)) }}-{{ $bulan[(int) date('m', strtotime($order->install_at))] }}-{{ date('Y', strtotime($order->install_at)) }}
                                    </td>
                                    <td class="text-stone-900 px-1 border border-stone-900 text-xs text-center">
                                        <div class="flex justify-center items-center">
                                            <a href="/marketing/install-orders/{{ $order->id }}"
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
                                                        <a href="/marketing/install-orders/{{ $order->id }}/edit"
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
                                            @canany(['isAdmin', 'isMarketing'])
                                                @can('isOrder')
                                                    @can('isMarketingDelete')
                                                        <form action="/marketing/install-orders/{{ $order->id }}" method="post"
                                                            class="d-inline m-1">
                                                            @method('delete')
                                                            @csrf
                                                            <button
                                                                class="index-link text-white w-7 h-5 bg-red-500 rounded-md hover:bg-red-600"
                                                                onclick="return confirm('Apakah anda yakin ingin menghapus data SPK Pasang dengan nomor {{ $order->number }} ?')">
                                                                <svg class="w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                                    width="24" height="24" viewBox="0 0 24 24">
                                                                    <title>DELETE</title>
                                                                    <path
                                                                        d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    @endcan
                                                @endcan
                                            @endcanany
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
    <div class="bg-black p-10" hidden>
        <div class="flex justify-center w-full">
            <div id="pdfPreview" class="w-[950px] h-[1345px] mt-1 bg-white p-4">
                <!-- Header start -->
                @include('dashboard.layouts.letter-header')
                <!-- Header end -->
                <!-- Body start -->
                <div class="h-[1080px]">
                    <label class="flex text-md font-semibold justify-center w-full mt-6"><u>DAFTAR SPK PEMASANGAN
                            GAMBAR</u></label>
                    <label class="flex text-md justify-center w-full">
                        <b class="ml-2">
                            Jadwal Tayang :
                            @if (request('periode'))
                                @if (request('periode') != '')
                                    {{ $daftar_hari[date('l', strtotime(request('periode')))] }},
                                    {{ date('d', strtotime(request('periode'))) }}
                                    {{ $bulan_full[(int) date('m', strtotime(request('periode')))] }}
                                    {{ date('Y', strtotime(request('periode'))) }}
                                @endif
                            @endif
                        </b>
                    </label>
                    <div class="flex justify-center w-full mt-8">
                        <div class="w-[850px]">
                            <table class="table-auto w-full">
                                <thead>
                                    <tr>
                                        <th class="text-stone-900 border border-stone-900 text-[0.7rem] w-8 text-center"
                                            rowspan="2">
                                            No.</th>
                                        <th class="text-stone-900 border border-stone-900 text-[0.7rem] w-16 text-center"
                                            rowspan="2">
                                            Kode</th>
                                        <th class="text-stone-900 border border-stone-900 text-[0.7rem] text-center"
                                            rowspan="2">Lokasi
                                        </th>
                                        <th class="text-stone-900 border border-stone-900 text-[0.7rem] text-center w-16"
                                            rowspan="2">
                                            Ukuran
                                        </th>
                                        <th class="text-stone-900 border border-stone-900 text-[0.7rem] text-center w-10"
                                            rowspan="2">
                                            Jenis</th>
                                        <th class="text-stone-900 border border-stone-900 text-[0.7rem] text-center"
                                            colspan="4">Data
                                            SPK</th>
                                    </tr>
                                    <tr>
                                        <th class="text-stone-900 border border-stone-900 text-[0.7rem] text-center w-20">
                                            No. SPK
                                        </th>
                                        <th class="text-stone-900 border border-stone-900 text-[0.7rem] text-center w-24">
                                            Klien</th>
                                        <th class="text-stone-900 border border-stone-900 text-[0.7rem] text-center w-32">
                                            Tema/Design
                                        </th>
                                        <th class="text-stone-900 border border-stone-900 text-[0.7rem] text-center w-12">
                                            Jumlah
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                            <td
                                                class="text-stone-900 px-1 border border-stone-900 text-[0.7rem]  text-center">
                                                {{ $number++ }}
                                            </td>
                                            <td
                                                class="text-stone-900 px-1 border border-stone-900 text-[0.7rem] text-center">
                                                {{ $product->location_code }}-{{ $product->city_code }}
                                            </td>
                                            <td class="text-stone-900 px-1 border border-stone-900 text-[0.7rem]">
                                                {{ $order->location->address }}
                                            </td>
                                            <td
                                                class="text-stone-900 px-1 border border-stone-900 text-[0.7rem]  text-center">
                                                {{ $product->location_size }}
                                            </td>
                                            <td
                                                class="text-stone-900 px-1 border border-stone-900 text-[0.7rem] text-center">
                                                @if ($order->type == 'Frontlight')
                                                    FL
                                                @elseif ($order->type == 'Backlight')
                                                    BL
                                                @endif
                                            </td>
                                            <td
                                                class="text-stone-900 px-1 border border-stone-900 text-[0.7rem] text-center">
                                                {{ substr($order->number, 0, 8) }}..
                                            </td>
                                            <td
                                                class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] text-center">
                                                @if ($order->sale)
                                                    @if (strlen($client->name) > 15)
                                                        {{ substr($client->name, 0, 15) }}..
                                                    @else
                                                        {{ $client->name }}
                                                    @endif
                                                @else
                                                    {{ $client }}
                                                @endif
                                            </td>
                                            <td
                                                class="text-stone-900 px-1 border border-stone-900 text-[0.7rem] text-center">
                                                @if (strlen($order->theme) > 20)
                                                    {{ substr($order->theme, 0, 20) }}..
                                                @else
                                                    {{ $order->theme }}
                                                @endif
                                            </td>
                                            <td
                                                class="text-stone-900 px-1 border border-stone-900 text-[0.7rem] text-center">
                                                {{ $product->qty }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-8">
                                <div class="flex justify-center">
                                    <div class="w-[725px]">
                                        <label class="text-sm text-black flex font-semibold">Denpasar,
                                            {{ date('d') }}
                                            {{ $bulan_full[(int) date('m')] }}
                                            {{ date('Y') }}
                                        </label>
                                        <label class="text-sm text-black flex font-semibold">PT. Vista Media</label>
                                        <label class="mt-12 text-sm text-black flex font-semibold">
                                            <u>{{ auth()->user()->name }}</u>
                                        </label>
                                        <label class="text-xs text-black flex">{{ auth()->user()->position }}</label>
                                        <label class="text-xs text-black flex">Hp.
                                            {{ auth()->user()->phone }}</label>
                                    </div>
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
    </div>

    <input id="saveName" type="text" value="{{ $name }}" hidden>

    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/savepdf.js"></script>
    <!-- Script end -->
@endsection
