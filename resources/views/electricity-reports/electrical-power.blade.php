@extends('dashboard.layouts.main');

@section('container')
    @php
        $bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agst', 'Sept', 'Okt', 'Nov', 'Des'];
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
        $types = ['Prabayar', 'Pascabayar'];
        $periods = ['Januari - Juni', 'Juli - Desember'];
        if (request('year')) {
            $getYear = request('year');
        } else {
            $getYear = date('Y');
        }

        if (request('area')) {
            $getArea = $areas->where('id', request('area'))->last();
        } else {
            $getArea = '';
        }

        if (request('city')) {
            $getCity = $cities->where('id', request('city'))->last();
        } else {
            $getCity = '';
        }

        if (fmod(count($electrical_powers), 25) == 0) {
            $pageQty = count($electrical_powers) / 25;
        } else {
            $pageQty = (count($electrical_powers) - fmod(count($electrical_powers), 25)) / 25 + 1;
        }
    @endphp
    <!-- Container start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex p-1 w-full border-b">
                <!-- Title start -->
                @if (request('type') && request('type') != 'All')
                    <h1 class="index-h1">DAFTAR DAYA LISTRIK {{ strtoupper(request('type')) }}</h1>
                @else
                    <h1 class="index-h1">DAFTAR DAYA LISTRIK</h1>
                @endif
                <div class="flex">
                    <a href="/workshop/electricity-reports" class="flex items-center justify-center btn-primary mx-1">
                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m12.017 1.995c5.517 0 9.997 4.48 9.997 9.998s-4.48 9.998-9.997 9.998c-5.518 0-9.998-4.48-9.998-9.998s4.48-9.998 9.998-9.998zm0 1.5c-4.69 0-8.498 3.808-8.498 8.498s3.808 8.498 8.498 8.498 8.497-3.808 8.497-8.498-3.807-8.498-8.497-8.498zm-1.528 4.715s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="mx-1"> Back </span>
                    </a>
                    @canany(['isAdmin', 'isWorkshop', 'isAccounting', 'isMarketing', 'isMedia'])
                        @can('isElectricity')
                            @can('isWorkshopRead')
                                <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-warning mb-2"
                                    title="Create PDF" type="button">
                                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                                    </svg>
                                    <span class="mx-1 text-white">Save PDF</span>
                                </button>
                                <button id="btnExportExcel" class="flex justify-center items-center mx-1 btn-success mb-2"
                                    title="Create PDF" type="button">
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
                <!-- Title end -->
            </div>
            <div>
                <!-- Form search start -->
                <form action="/workshop/electricity-reports/power">
                    <div class="flex mt-1 ml-2">
                        <div class="w-36">
                            <span class="text-base text-stone-100">Area</span>
                            <select class="w-36 border rounded-lg text-base text-stone-900 outline-none" name="area"
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
                                    class="flex text-base text-stone-900 w-36 border rounded-lg px-1 outline-none"
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
                        <div class="w-36 ml-2">
                            <span class="text-base text-stone-100">Jenis Daya</span>
                            <select id="type" name="type"
                                class="w-36 text-base text-stone-900 border rounded-lg outline-none" type="text"
                                onchange="submit()">
                                <option value="All">- All -</option>
                                @if (request('type') && request('type') != 'All')
                                    @foreach ($types as $type)
                                        @if (request('type') == $type)
                                            <option value="{{ $type }}" selected>
                                                {{ $type }}
                                            </option>
                                        @else
                                            <option value="{{ $type }}">
                                                {{ $type }}
                                            </option>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($types as $type)
                                        <option value="{{ $type }}">
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="w-36 ml-2">
                            <span class="text-base text-stone-100">Periode</span>
                            <select id="type" name="period"
                                class="w-36 text-base text-stone-900 border rounded-lg outline-none" type="text"
                                onchange="submit()">
                                @if (request('period') && request('period') != 'All')
                                    @foreach ($periods as $period)
                                        @if (request('period') == $period)
                                            <option value="{{ $period }}" selected>
                                                {{ $period }}
                                            </option>
                                        @else
                                            <option value="{{ $period }}">
                                                {{ $period }}
                                            </option>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($periods as $period)
                                        <option value="{{ $period }}">
                                            {{ $period }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="ml-2 w-32">
                            <span class="text-base text-stone-100">Tahun</span>
                            <div class="flex items-center">
                                <select name="year"
                                    class="text-center outline-none border w-20 text-base text-stone-900 rounded-md bg-stone-100"
                                    onchange="submit()">
                                    @php
                                        $oldYear = 2020;
                                    @endphp
                                    @if (request('year'))
                                        @for ($i = date('Y'); $i > $oldYear; $i--)
                                            @if ($i == request('year'))
                                                <option value="{{ $i }}" selected>
                                                    {{ $i }}
                                                </option>
                                            @else
                                                <option value="{{ $i }}">{{ $i }}
                                                </option>
                                            @endif
                                        @endfor
                                    @else
                                        @for ($i = date('Y'); $i > $oldYear; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="ml-2 w-full">
                            <span class="text-base text-stone-100">Pencarian</span>
                            <div class="flex w-full">
                                <input id="search" name="search"
                                    class="flex border rounded-l-lg px-1 outline-none text-base text-stone-900"
                                    type="text" placeholder="Search" value="{{ request('search') }}" onkeyup="submit()"
                                    onfocus="this.setSelectionRange(this.value.length, this.value.length);" autofocus>
                                <button
                                    class="flex border px-1 rounded-r-lg text-slate-700 justify-center w-10 bg-slate-50"
                                    type="submit">
                                    <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex mt-2">
                    </div>
                </form>
                <!-- Form search end -->
            </div>
            <!-- View start -->
            <div id="pdfPreview">
                @if (count($electrical_powers) == 0)
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
                                        <label class="text-5xl text-center font-bold">A5</label>
                                    </div>
                                    <div class="flex justify-center w-96">
                                        @if (request('type') && request('type') != 'All')
                                            <label class="text-lg text-center font-bold">LIST DATA DAYA LISTRIK
                                                {{ strtoupper(request('type')) }}</label>
                                        @else
                                            <label class="text-lg text-center font-bold">LIST DATA DAYA LISTRIK</label>
                                        @endif
                                    </div>
                                    <div class="flex justify-center w-96 border rounded-md">
                                        @if (request('period'))
                                            <label class="month-report text-xl font-semibold text-center">
                                                {{ request('period') }}
                                                @if (request('year'))
                                                    {{ request('year') }}
                                                @else
                                                    {{ date('Y') }}
                                                @endif
                                            </label>
                                        @else
                                            <label class="month-report text-xl font-semibold text-center">
                                                JAN - JUN
                                                @if (request('year'))
                                                    {{ request('year') }}
                                                @else
                                                    {{ date('Y') }}
                                                @endif
                                            </label>
                                        @endif
                                    </div>
                                    <div class="flex justify-center w-96 border rounded-md">
                                        @if (request('area') && request('area') != 'All')
                                            @if (request('city') && request('city') != 'All')
                                                <label class="month-report text-xl font-semibold text-center">
                                                    Area {{ $getArea->area }} Kota
                                                    {{ $getCity->city }}
                                                </label>
                                            @else
                                                <label class="month-report text-xl font-semibold text-center">
                                                    Area {{ $getArea->area }}
                                                </label>
                                            @endif
                                        @else
                                            <label class="month-report text-xl font-semibold text-center">
                                                SELURUH AREA
                                            </label>
                                        @endif
                                    </div>
                                    <div class="flex justify-center w-96 border rounded-md mt-2">
                                        <label class="text-sm">
                                            <span class="text-sm font-semibold text-red-600">Tgl. Cetak : </span>
                                            {{ date('d') }} {{ $bulan[(int) date('m')] }}
                                            {{ date('Y') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center h-[875px] mt-2">
                            @if (request('area') && request('area') != 'All')
                                @if (request('city') && request('city') != 'All')
                                    <label class="flex text-base text-red-600 font-serif tracking-wider">
                                        ~~ Belum ada data daya listrik untuk area
                                        {{ $getArea->area }} kota {{ $getCity->city }} ~~
                                    </label>
                                @else
                                    <label class="flex text-base text-red-600 font-serif tracking-wider">
                                        ~~ Belum ada data daya listrik untuk area
                                        {{ $getArea->area }} ~~
                                    </label>
                                @endif
                            @else
                                <label class="flex text-base text-red-600 font-serif tracking-wider">
                                    ~~ Belum ada data daya listrik ~~
                                </label>
                            @endif
                        </div>
                    </div>
                @else
                    @for ($indexPage = 0; $indexPage < $pageQty; $indexPage++)
                        <div class="w-[1550px] h-[980px] bg-white p-8 mt-2">
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
                                            <label class="text-5xl text-center font-bold">A</label>
                                            <label class="text-3xl text-center font-bold">5</label>
                                        </div>
                                        <div class="flex justify-center w-96">
                                            @if (request('type') && request('type') != 'All')
                                                <label class="text-lg text-center font-bold">LIST DATA DAYA LISTRIK
                                                    {{ strtoupper(request('type')) }}</label>
                                            @else
                                                <label class="text-lg text-center font-bold">LIST DATA DAYA LISTRIK</label>
                                            @endif
                                        </div>
                                        <div class="flex justify-center w-96">
                                            <label class="text-sm text-center"></label>
                                        </div>
                                        <div class="flex justify-center w-96 border rounded-md">
                                            @if (request('period'))
                                                <label class="month-report text-xl font-semibold text-center">
                                                    {{ request('period') }}
                                                    @if (request('year'))
                                                        {{ request('year') }}
                                                    @else
                                                        {{ date('Y') }}
                                                    @endif
                                                </label>
                                            @else
                                                <label class="month-report text-xl font-semibold text-center">
                                                    JAN - JUN
                                                    @if (request('year'))
                                                        {{ request('year') }}
                                                    @else
                                                        {{ date('Y') }}
                                                    @endif
                                                </label>
                                            @endif
                                        </div>
                                        <div class="flex justify-center w-96 border rounded-md">
                                            @if (request('area') && request('area') != 'All')
                                                @if (request('city') && request('city') != 'All')
                                                    <label class="month-report text-xl font-semibold text-center">
                                                        Area {{ $getArea->area }} Kota
                                                        {{ $getCity->city }}
                                                    </label>
                                                @else
                                                    <label class="month-report text-xl font-semibold text-center">
                                                        Area {{ $getArea->area }}
                                                    </label>
                                                @endif
                                            @else
                                                <label class="month-report text-xl font-semibold text-center">
                                                    SELURUH AREA
                                                </label>
                                            @endif
                                        </div>
                                        <div class="flex justify-center w-96 border rounded-md mt-2">
                                            <label class="text-md">
                                                <span class="text-md font-semibold text-red-600">Tgl. Cetak :
                                                </span>
                                                {{ date('d') }} {{ $bulan[(int) date('m')] }}
                                                {{ date('Y') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="h-[680px] mt-4">
                                <table class="w-full">
                                    <thead>
                                        <tr>
                                            <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center"
                                                rowspan="2">No</th>
                                            <th class="text-stone-900 border border-stone-900 w-28 text-sm text-center"
                                                rowspan="2">
                                                <button class="flex justify-center items-center w-28">@sortablelink('id_number', 'ID Pelanggan')
                                                    <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24">
                                                        <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                                    </svg>
                                                </button>
                                            </th>
                                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-20"
                                                rowspan="2">Type</th>
                                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-36"
                                                rowspan="2">Nama</th>
                                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-14"
                                                rowspan="2">Daya</th>
                                            <th class="text-stone-900 border border-stone-900 text-sm text-center"
                                                colspan="4">
                                                Data Lokasi</th>
                                            <th
                                                class="text-stone-900 border border-stone-900 text-sm text-center"colspan="6">
                                                @if (request('type'))
                                                    @if (request('type') == 'Pascabayar')
                                                        Nominal Pembayaran Listrik
                                                    @elseif (request('type') == 'Prabayar')
                                                        Nominal Pengisian Pulsa Listrik
                                                    @else
                                                        Nominal
                                                    @endif
                                                @else
                                                    Nominal
                                                @endif
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-20">
                                                Kode
                                            </th>
                                            <th class="text-stone-900 border border-stone-900 text-sm text-center">Lokasi
                                            </th>
                                            <th
                                                class="text-stone-900 border border-stone-900 text-sm text-center w-[100px]">
                                                Ukuran</th>
                                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-12">
                                                BL/FL</th>
                                            @if (request('period') && request('period') == 'Juli - Desember')
                                                @for ($i = 6; $i < 12; $i++)
                                                    <th
                                                        class="text-stone-900 border border-stone-900 text-sm text-center w-[72px]">
                                                        {{ $bulan[$i + 1] }}
                                                    </th>
                                                @endfor
                                            @else
                                                @for ($i = 0; $i < 6; $i++)
                                                    <th
                                                        class="text-stone-900 border border-stone-900 text-sm text-center w-[72px]">
                                                        {{ $bulan[$i + 1] }}
                                                    </th>
                                                @endfor
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $number =
                                                1 +
                                                ($electrical_powers->currentPage() - 1) * $electrical_powers->perPage();
                                        @endphp
                                        @foreach ($electrical_powers as $electrical)
                                            <tr>
                                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                                    {{ $number++ }}</td>
                                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                                    {{ $electrical->id_number }}
                                                </td>
                                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                                    {{ $electrical->type }}</td>
                                                <td
                                                    class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
                                                    {{ $electrical->name }}
                                                </td>
                                                <td
                                                    class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
                                                    {{ number_format($electrical->power) }}
                                                </td>
                                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                                    <div class="flex justify-center">
                                                        @if (count($electrical->locations) > 0)
                                                            @foreach ($electrical->locations as $location)
                                                                <span class="flex">
                                                                    {{ $location->code }} - {{ $location->city->code }}
                                                                </span>
                                                            @endforeach
                                                        @else
                                                            -
                                                        @endif
                                                    </div>
                                                </td>
                                                <td
                                                    class="text-stone-900 border border-stone-900 text-sm text-center px-1">
                                                    <div>
                                                        @if (count($electrical->locations) > 0)
                                                            @foreach ($electrical->locations as $location)
                                                                <span class="flex">
                                                                    {{ $location->address }}
                                                                </span>
                                                            @endforeach
                                                        @else
                                                            -
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                                    <div class="flex justify-center">
                                                        @if (count($electrical->locations) > 0)
                                                            @foreach ($electrical->locations as $location)
                                                                <span class="flex">
                                                                    {{ $location->media_size->size }} -
                                                                    @if ($location->orientation == 'Vertikal')
                                                                        V
                                                                    @else
                                                                        H
                                                                    @endif
                                                                </span>
                                                            @endforeach
                                                        @else
                                                            -
                                                        @endif
                                                    </div>
                                                </td>
                                                <td
                                                    class="text-stone-900 border border-stone-900 text-sm text-center px-1">
                                                    <div class="flex justify-center">
                                                        @if (count($electrical->locations) > 0)
                                                            @php
                                                                $description = json_decode($location->description);
                                                            @endphp
                                                            @foreach ($electrical->locations as $location)
                                                                <span class="flex">
                                                                    @if (isset($description->lighting))
                                                                        @if ($description->lighting == 'Backlight')
                                                                            BL
                                                                        @elseif ($description->lighting == 'Frontlight')
                                                                            FL
                                                                        @else
                                                                            t
                                                                        @endif
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </span>
                                                            @endforeach
                                                        @else
                                                            -
                                                        @endif
                                                    </div>
                                                </td>
                                                @if (request('period') && request('period') == 'Juli - Desember')
                                                    @for ($i = 6; $i < 12; $i++)
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
                                                            @if ($electrical->type == 'Pascabayar')
                                                                @php
                                                                    if (count($electrical->electricity_payments) > 0) {
                                                                        $getNominal = $electrical->electricity_payments
                                                                            ->where(
                                                                                'bill_date',
                                                                                $getYear . '-0' . $i + 1 . '-01',
                                                                            )
                                                                            ->sum('payment');
                                                                    } else {
                                                                        $getNominal = 0;
                                                                    }
                                                                @endphp
                                                                @if ($getNominal != 0)
                                                                    {{ number_format($getNominal) }}
                                                                @else
                                                                    -
                                                                @endif
                                                            @else
                                                                @php
                                                                    $startDate = $getYear . '-0' . $i + 1 . '-01';
                                                                    $getDate = new DateTime($startDate);
                                                                    $endDate = $getDate->modify(
                                                                        'last day of this month',
                                                                    );
                                                                    if (count($electrical->electricity_top_ups) > 0) {
                                                                        $getNominal = $electrical->electricity_top_ups
                                                                            ->whereBetween('topup_date', [
                                                                                $startDate,
                                                                                $endDate->format('Y-m-d'),
                                                                            ])
                                                                            ->sum('top_up_nominal');
                                                                    } else {
                                                                        $getNominal = 0;
                                                                    }
                                                                @endphp
                                                                @if ($getNominal != 0)
                                                                    {{ number_format($getNominal) }}
                                                                @else
                                                                    -
                                                                @endif
                                                            @endif
                                                        </td>
                                                    @endfor
                                                @else
                                                    @for ($i = 0; $i < 6; $i++)
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
                                                            @if ($electrical->type == 'Pascabayar')
                                                                @php
                                                                    if (count($electrical->electricity_payments) > 0) {
                                                                        $getNominal = $electrical->electricity_payments
                                                                            ->where(
                                                                                'bill_date',
                                                                                $getYear . '-0' . $i + 1 . '-01',
                                                                            )
                                                                            ->sum('payment');
                                                                    } else {
                                                                        $getNominal = 0;
                                                                    }
                                                                @endphp
                                                                @if ($getNominal != 0)
                                                                    {{ number_format($getNominal) }}
                                                                @else
                                                                    -
                                                                @endif
                                                            @else
                                                                @php
                                                                    $startDate = $getYear . '-0' . $i + 1 . '-01';
                                                                    $getDate = new DateTime($startDate);
                                                                    $endDate = $getDate->modify(
                                                                        'last day of this month',
                                                                    );
                                                                    if (count($electrical->electricity_top_ups) > 0) {
                                                                        $getNominal = $electrical->electricity_top_ups
                                                                            ->whereBetween('topup_date', [
                                                                                $startDate,
                                                                                $endDate->format('Y-m-d'),
                                                                            ])
                                                                            ->sum('top_up_nominal');
                                                                    } else {
                                                                        $getNominal = 0;
                                                                    }
                                                                @endphp
                                                                @if ($getNominal != 0)
                                                                    {{ number_format($getNominal) }}
                                                                @else
                                                                    -
                                                                @endif
                                                            @endif
                                                        </td>
                                                    @endfor
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="flex items-end justify-end mt-1 text-black">
                                <label for="">Halaman {{ $indexPage + 1 }} dari
                                    {{ $pageQty }}</label>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>

            <table id="exportExcelTable" hidden>
                <thead>
                    <tr>
                        <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center" rowspan="2">No</th>
                        <th class="text-stone-900 border border-stone-900 w-28 text-sm text-center" rowspan="2">
                            <button class="flex justify-center items-center w-28">@sortablelink('id_number', 'ID Pelanggan')
                                <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                </svg>
                            </button>
                        </th>
                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-20" rowspan="2">Type
                        </th>
                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-36" rowspan="2">Nama
                        </th>
                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-14" rowspan="2">Daya
                        </th>
                        <th class="text-stone-900 border border-stone-900 text-sm text-center" colspan="4">Data Lokasi
                        </th>
                        <th class="text-stone-900 border border-stone-900 text-sm text-center"colspan="6">
                            @if (request('type'))
                                @if (request('type') == 'Pascabayar')
                                    Nominal Pembayaran Listrik
                                @else
                                    Nominal Pengisian Pulsa Listrik
                                @endif
                            @else
                                Nominal
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-20">Kode
                        </th>
                        <th class="text-stone-900 border border-stone-900 text-sm text-center">Lokasi
                        </th>
                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-[100px]">
                            Ukuran</th>
                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-12">
                            BL/FL</th>
                        @if (request('period') && request('period') == 'Juli - Desember')
                            @for ($i = 6; $i < 12; $i++)
                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-[72px]">
                                    {{ $bulan[$i + 1] }}
                                </th>
                            @endfor
                        @else
                            @for ($i = 0; $i < 6; $i++)
                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-[72px]">
                                    {{ $bulan[$i + 1] }}
                                </th>
                            @endfor
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php
                        $number = 1 + ($electrical_powers->currentPage() - 1) * $electrical_powers->perPage();
                    @endphp
                    @foreach ($electrical_powers as $electrical)
                        <tr>
                            <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                {{ $number++ }}</td>
                            <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                '{{ $electrical->id_number }}
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                {{ $electrical->type }}</td>
                            <td class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
                                {{ $electrical->name }}
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
                                {{ $electrical->power }}
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                <div class="flex justify-center">
                                    @if (count($electrical->locations) > 0)
                                        @foreach ($electrical->locations as $location)
                                            <span class="flex">
                                                {{ $location->code }} - {{ $location->city->code }}
                                            </span>
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </div>
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-sm text-center px-1">
                                <div>
                                    @if (count($electrical->locations) > 0)
                                        @foreach ($electrical->locations as $location)
                                            <span class="flex">
                                                {{ $location->address }}
                                            </span>
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </div>
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                <div class="flex justify-center">
                                    @if (count($electrical->locations) > 0)
                                        @foreach ($electrical->locations as $location)
                                            <span class="flex">
                                                {{ $location->media_size->size }} -
                                                @if ($location->orientation == 'Vertikal')
                                                    V
                                                @else
                                                    H
                                                @endif
                                            </span>
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </div>
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-sm text-center px-1">
                                <div class="flex justify-center">
                                    @if (count($electrical->locations) > 0)
                                        @php
                                            $description = json_decode($location->description);
                                        @endphp
                                        @foreach ($electrical->locations as $location)
                                            <span class="flex">
                                                @if (isset($description->lighting))
                                                    @if ($description->lighting == 'Backlight')
                                                        BL
                                                    @elseif ($description->lighting == 'Frontlight')
                                                        FL
                                                    @else
                                                        t
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </span>
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </div>
                            </td>
                            @if (request('period') && request('period') == 'Juli - Desember')
                                @for ($i = 6; $i < 12; $i++)
                                    <td class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
                                        @if ($electrical->type == 'Pascabayar')
                                            @php
                                                if (count($electrical->electricity_payments) > 0) {
                                                    $getNominal = $electrical->electricity_payments
                                                        ->where('bill_date', $getYear . '-0' . $i + 1 . '-01')
                                                        ->sum('payment');
                                                } else {
                                                    $getNominal = 0;
                                                }
                                            @endphp
                                            @if ($getNominal != 0)
                                                {{ number_format($getNominal) }}
                                            @else
                                                -
                                            @endif
                                        @else
                                            @php
                                                $startDate = $getYear . '-0' . $i + 1 . '-01';
                                                $getDate = new DateTime($startDate);
                                                $endDate = $getDate->modify('last day of this month');
                                                if (count($electrical->electricity_top_ups) > 0) {
                                                    $getNominal = $electrical->electricity_top_ups
                                                        ->whereBetween('topup_date', [
                                                            $startDate,
                                                            $endDate->format('Y-m-d'),
                                                        ])
                                                        ->sum('top_up_nominal');
                                                } else {
                                                    $getNominal = 0;
                                                }
                                            @endphp
                                            @if ($getNominal != 0)
                                                {{ number_format($getNominal) }}
                                            @else
                                                -
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @else
                                @for ($i = 0; $i < 6; $i++)
                                    <td class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
                                        @if ($electrical->type == 'Pascabayar')
                                            @php
                                                if (count($electrical->electricity_payments) > 0) {
                                                    $getNominal = $electrical->electricity_payments
                                                        ->where('bill_date', $getYear . '-0' . $i + 1 . '-01')
                                                        ->sum('payment');
                                                } else {
                                                    $getNominal = 0;
                                                }
                                            @endphp
                                            @if ($getNominal != 0)
                                                {{ number_format($getNominal) }}
                                            @else
                                                -
                                            @endif
                                        @else
                                            @php
                                                $startDate = $getYear . '-0' . $i + 1 . '-01';
                                                $getDate = new DateTime($startDate);
                                                $endDate = $getDate->modify('last day of this month');
                                                if (count($electrical->electricity_top_ups) > 0) {
                                                    $getNominal = $electrical->electricity_top_ups
                                                        ->whereBetween('topup_date', [
                                                            $startDate,
                                                            $endDate->format('Y-m-d'),
                                                        ])
                                                        ->sum('top_up_nominal');
                                                } else {
                                                    $getNominal = 0;
                                                }
                                            @endphp
                                            @if ($getNominal != 0)
                                                {{ number_format($getNominal) }}
                                            @else
                                                -
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- View end -->
        </div>
    </div>

    @if (request('period') && request('period') == 'Juli - Desember')
        <input id="saveName" type="text" value="LIST DAYA LISTRIK - JUL-DES {{ $getYear }}" hidden>
    @else
        <input id="saveName" type="text" value="LIST DAYA LISTRIK - JAN-JUN {{ $getYear }}" hidden>
    @endif
    <!-- Container end -->

    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery.table2excel.min.js"></script>

    <script>
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
                        scale: 2.5,
                        letterRendering: true,
                        useCORS: true
                    },
                    jsPDF: {
                        unit: 'px',
                        format: [1550, 1000],
                        orientation: 'landscape',
                        putTotalPages: true
                    }
                };
                html2pdf().set(opt).from(element).save();
            }
        };

        $(document).ready(function() {
            $('#btnExportExcel').on('click', function() {
                $('#exportExcelTable').table2excel({
                    filename: "List Data Daya Listrik.xls"
                });
            });
        });

        changeArea = () => {
            const cityId = document.getElementById("city");
            const formFilter = document.getElementById("formFilter");

            cityId.value = "All"

            formFilter.submit();
        }
    </script>
    <!-- Script end -->
@endsection
