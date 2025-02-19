@extends('dashboard.layouts.main');

@section('container')
    <?php
    $bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    $bulan_full = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    if (request('days') && request('month')) {
        if (request('days') != 'All' && request('month') != 'All') {
            $periode = request('days') . ' ' . $bulan_full[request('month')] . ' ' . request('year');
        } else {
            $periode = 'Tahun ' . request('year');
        }
    } elseif (request('todays')) {
        $periode = (int) date('d', strtotime(request('todays'))) . ' ' . $bulan_full[(int) date('m', strtotime(request('todays')))] . ' ' . date('Y', strtotime(request('todays')));
    } elseif (request('month') && request('month') != 'All') {
        $periode = $bulan_full[request('month')] . ' ' . request('year');
    } elseif (request('year')) {
        $periode = 'Tahun ' . request('year');
    } else {
        $periode = 'Tahun ' . date('Y');
    }
    ?>
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex justify-center w-full">
                <div class="w-[1200px]">
                    <div class="flex border-b">
                        <h1 class="index-h1">Daftar Dokumentasi Pemasangan Gambar -
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
                        </h1>
                    </div>
                    <form id="formFilter" action="/installation-photos/index/{{ $company->id }}">
                        <div class="flex">
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
                                @if (request('month'))
                                    @if (request('month') != 'All')
                                        <select name="days" id="days"
                                            class="flex outline-none text-sm text-stone-900 border rounded-lg w-14 p-1"
                                            type="date" onchange="submit()">
                                            <option value="All">All</option>
                                            @if (request('days') && request('days') != 'All')
                                                @for ($i = 1; $i <= $d; $i++)
                                                    @if ($i == request('days'))
                                                        <option value="{{ $i }}" selected>
                                                            {{ $i }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $i }}">{{ $i }}
                                                        </option>
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
                                    onchange="setDays(this)">
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
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-28" rowspan="2">
                                    No. Penj.</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-28" rowspan="2">
                                    No. SPK</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-20" rowspan="2">
                                    Tgl. Tayang</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-24" rowspan="2">
                                    Klien</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center" rowspan="2">
                                    Tema/Design</th>
                                <th class="text-stone-900 border border-stone-900 text-xs w-[72px] text-center"
                                    rowspan="2">
                                    Kode</th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center" rowspan="2">
                                    Lokasi
                                </th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center" colspan="2">
                                    Foto
                                </th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-14" rowspan="2">
                                    Action</th>
                            </tr>
                            <tr class="bg-stone-400">
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-[88px]">
                                    Siang
                                </th>
                                <th class="text-stone-900 border border-stone-900 text-xs text-center w-[88px]">
                                    Malam
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
                                    // $installation_photos = $order->installation_photos;
                                    $night_photos = $order->installation_photos->where('type', 'night');
                                    $day_photos = $order->installation_photos->where('type', 'day');
                                @endphp
                                <tr>
                                    <td class="text-stone-900 px-1 border border-stone-900 text-xs  text-center">
                                        {{ $number++ }}
                                    </td>
                                    <td class="text-stone-900 px-1 border border-stone-900 text-xs text-center">
                                        {{ substr($order->sale->number, 0, 15) }}..
                                    </td>
                                    <td class="text-stone-900 px-1 border border-stone-900 text-xs text-center">
                                        {{ substr($order->number, 0, 15) }}..
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
                                        @if (strlen($order->theme) > 20)
                                            {{ substr($order->theme, 0, 20) }}..
                                        @else
                                            {{ $order->theme }}
                                        @endif
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
                                        <div class="flex">
                                            {{ count($day_photos) }} photo
                                            @canany(['isAdmin', 'isWorkshop'])
                                                @can('isDocumentation')
                                                    @can('isWorkshopCreate')
                                                        <a href="/installation-photos/create/{{ $order->id }}/day"
                                                            title="Tambah Foto"
                                                            class="index-link text-white w-7 h-5 rounded bg-amber-500 hover:bg-amber-600 drop-shadow-md ml-1">
                                                            <svg class="fill-current w-[18px]" clip-rule="evenodd"
                                                                fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm-.747 9.25h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                                                    fill-rule="nonzero" />
                                                            </svg>
                                                        </a>
                                                    @endcan
                                                @endcan
                                            @endcanany
                                        </div>
                                    </td>
                                    <td class="text-stone-900 px-1 border border-stone-900 text-xs  text-center">
                                        <div class="flex">
                                            {{ count($night_photos) }} photo
                                            @canany(['isAdmin', 'isWorkshop'])
                                                @can('isDocumentation')
                                                    @can('isWorkshopCreate')
                                                        <a href="/installation-photos/create/{{ $order->id }}/night"
                                                            title="Tambah Foto"
                                                            class="index-link text-white w-7 h-5 rounded bg-amber-500 hover:bg-amber-600 drop-shadow-md ml-1">
                                                            <svg class="fill-current w-[18px]" clip-rule="evenodd"
                                                                fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm-.747 9.25h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                                                    fill-rule="nonzero" />
                                                            </svg>
                                                        </a>
                                                    @endcan
                                                @endcan
                                            @endcanany
                                        </div>
                                    </td>
                                    <td class="text-stone-900 px-1 border border-stone-900 text-xs text-center">
                                        <div class="flex justify-center items-center">
                                            <a href="/installation-photos/show/{{ $order->id }}"
                                                class="index-link text-white w-8 h-5 rounded bg-teal-500 hover:bg-teal-600 drop-shadow-md">
                                                <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm8.413 7c-1.837 2.878-4.897 5.5-8.413 5.5-3.465 0-6.532-2.632-8.404-5.5 1.871-2.868 4.939-5.5 8.404-5.5 3.518 0 6.579 2.624 8.413 5.5zm-8.411-4c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"
                                                        fill-rule="nonzero" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (count($install_orders) == 0)
                        <div class="flex justify-center items-center w-full h-16 bg-stone-200">
                            <label class="flex text-base text-red-600 font-serif tracking-wider">
                                ~~ Tidak ada data SPK pemasangan gambar untuk periode {{ $periode }} ~~
                            </label>
                        </div>
                    @endif
                </div>
            </div>
            <div class="flex justify-center text-stone-100 mt-2">
                {!! $install_orders->appends(Request::query())->render('dashboard.layouts.pagination') !!}
            </div>
        </div>
    </div>

    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    {{-- <script src="/js/savepdf.js"></script> --}}

    <script>
        setDays = (sel) => {
            if (sel.value == "All") {
                document.getElementById("days").value = "All";
                document.getElementById("formFilter").submit();
            } else {
                document.getElementById("formFilter").submit();
            }
        }

        // pdfPreview = () => {
        //     window.scrollTo({
        //         top: 0,
        //         behavior: 'smooth'
        //     });
        //     document.getElementById("modalPdfPreview").classList.add('flex');
        //     document.getElementById("modalPdfPreview").classList.remove('hidden');
        // }

        // btnClosePreview = () => {
        //     window.scrollTo({
        //         top: 0,
        //         behavior: 'smooth'
        //     });
        //     document.getElementById("modalPdfPreview").classList.remove('flex');
        //     document.getElementById("modalPdfPreview").classList.add('hidden');
        // }
    </script>
    <!-- Script end -->
@endsection
