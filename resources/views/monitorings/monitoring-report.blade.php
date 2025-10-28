@extends('dashboard.layouts.main');

@section('container')
    @php
        $bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sept', 'Okt', 'Nov', 'Des'];
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

        if (fmod(count($locations), 30) == 0) {
            $totalPages = count($locations) / 30;
        } else {
            $totalPages = (count($locations) - fmod(count($locations), 30)) / 30 + 1;
        }
    @endphp
    <!-- Container start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex p-1 w-full border-b">
                <!-- Title start -->
                <h1 class="index-h1">List Dokumentasi Pemasangan Gambar</h1>
                <!-- Title end -->
                <div class="flex items-center w-full justify-end">
                    @canany(['isAdmin', 'isWorkshop', 'isAccounting', 'isMarketing', 'isMedia'])
                        @can('isMonitoring')
                            @can('isWorkshopRead')
                                <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-warning" title="Create PDF"
                                    type="button">
                                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                                    </svg>
                                    <span class="mx-1 text-white">Save PDF</span>
                                </button>
                                <button id="btnExportExcel" class="flex justify-center items-center mx-1 btn-success" title="Create PDF"
                                    type="button">
                                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                                    </svg>
                                    <span class="mx-1 text-white">Export to EXCEL</span>
                                </button>
                            @endcan
                        @endcan
                    @endcanany
                </div>
            </div>
            <div>
                <!-- Form search start -->
                <form action="/workshop/monitoring-report">
                    <div class="flex mt-1">
                        <div class="w-36">
                            <span class="text-base text-stone-100">Area</span>
                            <select class="w-full border rounded-lg text-base text-stone-900 outline-none" name="area"
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
                        </div>
                        @if (request('area') && request('area') != 'All')
                            <div class="w-36 ml-2">
                                <span class="text-base text-stone-100">Kota</span>
                                <select id="city" name="city"
                                    class="flex text-base text-stone-900 w-full border rounded-lg px-1 outline-none"
                                    type="text" value="{{ request('city') }}" onchange="submit()">
                                    <option value="All">All</option>
                                    @foreach ($cities as $city)
                                        @if (request('area') == $city->area_id)
                                            @if (request('city'))
                                                @if (request('city') == $city->id)
                                                    <option value="{{ $city->id }}" selected>
                                                        {{ $city->city }}
                                                    </option>
                                                @else
                                                    <option value="{{ $city->id }}">
                                                        {{ $city->city }}
                                                    </option>
                                                @endif
                                            @else
                                                <option value="{{ $city->id }}">
                                                    {{ $city->city }}
                                                </option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="ml-2 w-full">
                            <span class="text-base text-stone-100">Pencarian</span>
                            <div class="flex w-full">
                                <input id="search" name="search"
                                    class="flex border rounded-l-lg px-1 outline-none text-base text-stone-900"
                                    type="text" placeholder="Search" value="{{ request('search') }}" onkeyup="submit()"
                                    onfocus="this.setSelectionRange(this.value.length, this.value.length);" autofocus>
                                <button class="flex border px-1 rounded-r-lg text-slate-700 justify-center w-10 bg-slate-50"
                                    type="submit">
                                    <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Form search end -->
            </div>
            <div class="flex justify-center w-full">
                <div id="pdfPreview">
                    @if (count($locations) == 0)
                        <div class="w-[1550px] h-[980px] bg-white p-8">
                            <div class="flex items-center border rounded-lg p-2 mt-6">
                                <div class="w-44">
                                    <img class="ml-2 w-[125px]" src="{{ asset('storage/' . $company->logo) }}"
                                        alt="">
                                </div>
                                <div class="w-[750px] ml-6">
                                    <div>
                                        <span class="text-sm font-semibold">{{ $company->name }}</span>
                                    </div>
                                    <div>
                                        <span class="text-sm">{{ $company->address }}, Desa/Kel. {{ $company->village }},
                                            Kec.
                                            {{ $company->district }}</span>
                                    </div>
                                    <div>
                                        <span class="text-sm">{{ $company->city }} - {{ $company->province }}
                                            {{ $company->post_code }}</span>
                                    </div>
                                    <div>
                                        <span class="text-sm">Ph. {{ $company->phone }} | Mobile.
                                            {{ $company->m_phone }}</span>
                                    </div>
                                    <div>
                                        <span class="text-sm">e-mail : {{ $company->email }} | website :
                                            {{ $company->website }}</span>
                                    </div>
                                </div>
                                <div class="flex w-full justify-end">
                                    <div>
                                        <div class="flex items-end justify-center w-96">
                                            <label class="text-5xl text-center font-bold">-</label>
                                        </div>
                                        <div class="flex justify-center w-96">
                                            <label class="text-lg text-center font-bold">{{ strtoupper($title) }}</label>
                                        </div>
                                        <div class="flex justify-center w-96 border rounded-md">
                                            @if (request('area') && request('area') != 'All')
                                                @php
                                                    $getArea = $areas->where('id', request('area'))->last();
                                                @endphp
                                                <label class="month-report text-xl font-semibold text-center">
                                                    Area {{ $getArea->area }}
                                                </label>
                                            @else
                                                <label class="month-report text-xl font-semibold text-center">
                                                    Semua Area
                                                </label>
                                            @endif
                                        </div>
                                        <div class="flex justify-center w-96 border rounded-md mt-2">
                                            <label class="text-sm">
                                                <span class="text-sm font-semibold text-red-600">Tgl. Cetak :
                                                </span>
                                                {{ date('d') }} {{ $bulan[(int) date('m')] }}
                                                {{ date('Y') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center h-[875px] mt-2">
                                <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak ada data
                                    Pemantauan Bulanan
                                    ~~</label>
                            </div>
                        </div>
                    @else
                        @for ($i = 0; $i < $totalPages; $i++)
                            <div class="w-[1550px] h-[1100px] bg-white p-8 mt-2">
                                <div class="flex items-center border rounded-lg p-2 mt-6">
                                    <div class="w-44">
                                        <img class="ml-2 w-[125px]" src="{{ asset('storage/' . $company->logo) }}"
                                            alt="">
                                    </div>
                                    <div class="w-[750px] ml-6">
                                        <div>
                                            <span class="text-sm font-semibold">{{ $company->name }}</span>
                                        </div>
                                        <div>
                                            <span class="text-sm">{{ $company->address }}, Desa/Kel.
                                                {{ $company->village }},
                                                Kec.
                                                {{ $company->district }}</span>
                                        </div>
                                        <div>
                                            <span class="text-sm">{{ $company->city }} - {{ $company->province }}
                                                {{ $company->post_code }}</span>
                                        </div>
                                        <div>
                                            <span class="text-sm">Ph. {{ $company->phone }} | Mobile.
                                                {{ $company->m_phone }}</span>
                                        </div>
                                        <div>
                                            <span class="text-sm">e-mail : {{ $company->email }} | website :
                                                {{ $company->website }}</span>
                                        </div>
                                    </div>
                                    <div class="flex w-full justify-end">
                                        <div>
                                            <div class="flex items-end justify-center w-96">
                                                <label class="text-5xl text-center font-bold">-</label>
                                            </div>
                                            <div class="flex justify-center w-96">
                                                <label
                                                    class="text-lg text-center font-bold">{{ strtoupper($title) }}</label>
                                            </div>
                                            <div class="flex justify-center w-96 border rounded-md">
                                                @if (request('area') && request('area') != 'All')
                                                    @php
                                                        $getArea = $areas->where('id', request('area'))->last();
                                                    @endphp
                                                    <label class="month-report text-xl font-semibold text-center">
                                                        Area {{ $getArea->area }}
                                                    </label>
                                                @else
                                                    <label class="month-report text-xl font-semibold text-center">
                                                        Semua Area
                                                    </label>
                                                @endif
                                            </div>
                                            <div class="flex justify-center w-96 border rounded-md mt-2">
                                                <label class="text-sm">
                                                    <span class="text-sm font-semibold text-red-600">Tgl. Cetak :
                                                    </span>
                                                    {{ date('d') }} {{ $bulan[(int) date('m')] }}
                                                    {{ date('Y') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="h-[800px] mt-6">
                                    <table class="table-auto w-full mt-4">
                                        <thead>
                                            <tr>
                                                <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center"
                                                    rowspan="2">No
                                                </th>
                                                <th class="text-stone-900 border border-stone-900 text-sm w-20 text-center"
                                                    rowspan="2">
                                                    Kode
                                                </th>
                                                <th class="text-stone-900 border border-stone-900 text-sm text-center"
                                                    rowspan="2">Lokasi
                                                </th>
                                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-24"
                                                    rowspan="2">Area
                                                </th>
                                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-24"
                                                    rowspan="2">Kota
                                                </th>
                                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-48"
                                                    rowspan="2">Klien
                                                </th>
                                                <th class="text-stone-900 border border-stone-900 text-sm text-center"
                                                    colspan="3">Data
                                                    Pemantauan Terakhir</th>
                                            </tr>
                                            <tr>
                                                <th
                                                    class="text-stone-900 border border-stone-900 text-sm text-center w-28">
                                                    Bulan</th>
                                                <th
                                                    class="text-stone-900 border border-stone-900 text-sm text-center w-20">
                                                    Tgl. Foto</th>
                                                <th class="text-stone-900 border border-stone-900 text-sm text-center">
                                                    Catatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($locations as $location)
                                                @if ($loop->iteration > $i * 30 && $loop->iteration < ($i + 1) * 30 + 1)
                                                    @php
                                                        $last_monitoring = $location->monitorings
                                                            ->sortBy('month')
                                                            ->last();
                                                        $sale = $location->sales->last();
                                                        if ($sale) {
                                                            if ($sale->end_at > date('Y-m-d')) {
                                                                $client = json_decode($sale->quotation->clients);
                                                            } else {
                                                                $client = null;
                                                            }
                                                        } else {
                                                            $client = null;
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-sm text-center">
                                                            {{ $loop->iteration }}
                                                        </td>
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-sm text-center">
                                                            {{ $location->code }} -
                                                            {{ $location->city->code }}</td>
                                                        <td class="text-stone-900 border border-stone-900 text-sm px-1">
                                                            {{ $location->address }}
                                                        </td>
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-sm text-center">
                                                            {{ $location->area->area }}</td>
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-sm text-center">
                                                            {{ $location->city->city }}</td>
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-sm text-center">
                                                            @if ($client != null)
                                                                {{ $client->name }}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-sm text-center">
                                                            @if ($last_monitoring)
                                                                {{ $bulan[(int) date('m', strtotime($last_monitoring->month))] }}
                                                                {{ date('Y', strtotime($last_monitoring->month)) }}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-sm text-center">
                                                            @if ($last_monitoring)
                                                                {{ date('d-m-Y', strtotime($last_monitoring->monitoring_date)) }}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-sm text-center">
                                                            @if ($last_monitoring)
                                                                {{ $last_monitoring->notes }}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="flex items-end justify-end mt-8 text-black">
                                    <label for="">Halaman {{ $i + 1 }} dari
                                        {{ $totalPages }}</label>
                                </div>
                            </div>
                        @endfor
                    @endif
                </div>
            </div>
        </div>
    </div>

    <table id="exportExcelTable" class="table-auto w-full" hidden>
        <thead>
            <tr class="bg-stone-400">
                <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center" rowspan="2">No
                </th>
                <th class="text-stone-900 border border-stone-900 text-sm w-20 text-center" rowspan="2">
                    Kode
                </th>
                <th class="text-stone-900 border border-stone-900 text-sm text-center" rowspan="2">Lokasi
                </th>
                <th class="text-stone-900 border border-stone-900 text-sm text-center w-24" rowspan="2">Area
                </th>
                <th class="text-stone-900 border border-stone-900 text-sm text-center w-24" rowspan="2">Kota
                </th>
                <th class="text-stone-900 border border-stone-900 text-sm text-center w-48" rowspan="2">Klien
                </th>
                <th class="text-stone-900 border border-stone-900 text-sm text-center" colspan="3">Data
                    Pemantauan Terakhir</th>
            </tr>
            <tr class="bg-stone-400">
                <th class="text-stone-900 border border-stone-900 text-sm text-center w-28">
                    Bulan</th>
                <th class="text-stone-900 border border-stone-900 text-sm text-center w-20">
                    Tgl. Foto</th>
                <th class="text-stone-900 border border-stone-900 text-sm text-center">
                    Catatan</th>
            </tr>
        </thead>
        <tbody class="bg-stone-300">
            @foreach ($locations as $location)
                @php
                    $last_monitoring = $location->monitorings->sortBy('month')->last();
                    $sale = $location->sales->last();
                    if ($sale) {
                        if ($sale->end_at > date('Y-m-d')) {
                            $client = json_decode($sale->quotation->clients);
                        } else {
                            $client = null;
                        }
                    } else {
                        $client = null;
                    }
                @endphp
                <tr>
                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                        {{ $location->code }} -
                        {{ $location->city->code }}</td>
                    <td class="text-stone-900 border border-stone-900 text-sm px-1">
                        {{ $location->address }}
                    </td>
                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                        {{ $location->area->area }}</td>
                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                        {{ $location->city->city }}</td>
                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                        @if ($client != null)
                            {{ $client->name }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                        @if ($last_monitoring)
                            {{ $bulan[(int) date('m', strtotime($last_monitoring->month))] }}
                            {{ date('Y', strtotime($last_monitoring->month)) }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                        @if ($last_monitoring)
                            {{ date('d-m-Y', strtotime($last_monitoring->monitoring_date)) }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                        @if ($last_monitoring)
                            {{ $last_monitoring->notes }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <input id="saveName" type="text" value="LIST PEMANTAUAN BULANAN" hidden>
    <!-- Container end -->
    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery.table2excel.min.js"></script>

    <script>
        // Save PDF --> start
        const saveName = document.querySelectorAll("[id=saveName]");
        const pdfPreview = document.querySelectorAll("[id=pdfPreview]");
        document.getElementById("btnCreatePdf").onclick = function() {
            for (let i = 0; i < pdfPreview.length; i++) {
                var element = document.getElementById('pdfPreview');
                var opt = {
                    margin: 0,
                    filename: saveName[i].value,
                    image: {
                        type: 'jpeg',
                        quality: 1
                    },
                    pagebreak: {
                        mode: ['avoid-all', 'css', 'legacy']
                    },
                    html2canvas: {
                        dpi: 300,
                        scale: 2,
                        letterRendering: true,
                        useCORS: true
                    },
                    jsPDF: {
                        unit: 'px',
                        format: [1590, 1130],
                        orientation: 'landscape',
                        putTotalPages: true
                    }
                };
                html2pdf().set(opt).from(element).save();
            }
        };
        // Save PDF --> end

        $(document).ready(function() {
            $('#btnExportExcel').on('click', function() {
                $('#exportExcelTable').table2excel({
                    filename: "List Pemantauan Bulanan.xls"
                });
            });
        });
    </script>
    <!-- Script end -->
@endsection
