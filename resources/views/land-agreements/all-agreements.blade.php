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

        if (fmod(count($export_locations), 30) == 0) {
            $totalPages = count($export_locations) / 30;
        } else {
            $totalPages = (count($export_locations) - fmod(count($export_locations), 30)) / 30 + 1;
        }
    @endphp
    <!-- Container start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex p-1 w-full border-b">
                <!-- Title start -->
                <h1 class="index-h1">DAFTAR DATA SEWA LAHAN</h1>
                <!-- Title end -->
            </div>
            <div>
                <!-- Form search start -->
                <form action="/media/all-agreements/">
                    <div class="flex mt-1 ml-2">
                        <div class="w-48">
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
                            <div class="w-48 ml-2">
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
                        <div class="ml-2 w-48">
                            <span class="text-base text-stone-100">Katagori</span>
                            <select class="w-full border rounded-lg text-base text-stone-900 outline-none"
                                name="media_category_id" id="media_category_id" onchange="submit()"
                                value="{{ request('media_category_id') }}">
                                <option value="All">All</option>
                                @foreach ($categories as $category)
                                    @if (request('media_category_id') == $category->id)
                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="flex w-full items-end">
                            <div class="ml-2 w-52">
                                <span class="text-base text-stone-100">Pencarian</span>
                                <div class="flex">
                                    <input id="search" name="search"
                                        class="flex border rounded-l-lg outline-none text-base text-stone-900 px-1"
                                        type="text" placeholder="Search" value="{{ request('search') }}"
                                        onkeyup="submit()"
                                        onfocus="this.setSelectionRange(this.value.length, this.value.length);" autofocus>
                                    <button class="flex border rounded-r-lg text-slate-700 justify-center w-10 bg-slate-50"
                                        type="submit">
                                        <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div id="divButton" class="flex justify-end w-full items-end">
                                <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-primary"
                                    title="Simpan dalam bentuk pdf" type="button">
                                    <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24">
                                        <path
                                            d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                                    </svg>
                                    <span class="mx-1">Save PDF</span>
                                </button>
                                <button id="btnExportExcel" class="flex justify-center items-center mx-1 btn-success"
                                    title="Create PDF" type="button">
                                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24">
                                        <path
                                            d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                                    </svg>
                                    <span class="mx-1 text-white">Export to EXCEL</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Form search end -->
                <!-- Alert start -->
                @if (session()->has('success'))
                    <div class="ml-2 flex alert-success">
                        <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                        </svg>
                        <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                    </div>
                @endif
                <!-- Alert end -->
            </div>
            <!-- View start -->
            <div class="w-[1550px] mt-2">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-stone-400">
                            <th class="text-stone-900 border border-stone-900 text-xs w-8 text-center" rowspan="2">No
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center" colspan="2">Data
                                Lokasi</th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center" colspan="4">Data
                                Perjanjian</th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center" colspan="3">Periode
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center" colspan="2">Harga
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-20" rowspan="2">
                                Action</th>
                        </tr>
                        <tr class="bg-stone-400">
                            <th class="text-stone-900 border border-stone-900 text-xs w-[72px] text-center">
                                <button class="flex justify-center items-center w-[72px]">@sortablelink('code', 'Kode')
                                    <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                    </svg>
                                </button>
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center">Lokasi</th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-48">Nomor</th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-24">Tanggal</th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-48">Pemilik</th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-24">No. HP</th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-12">Durasi</th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-20">Awal</th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-20">Akhir</th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-20">Per Tahun</th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-20">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-stone-300">
                        @php
                            $number = 1 + ($locations->currentPage() - 1) * $locations->perPage();
                        @endphp
                        @foreach ($locations as $location)
                            @php
                                $agreements = $location->land_agreements;
                            @endphp
                            @if (count($agreements) > 0)
                                @if (count($agreements) > 1)
                                    @php
                                        $rowSpan = count($agreements) + 1;
                                    @endphp
                                    <tr>
                                        <td class="text-stone-900 border border-stone-900 text-xs text-center"
                                            rowspan="{{ $rowSpan }}">{{ $number++ }}
                                        </td>
                                        <td class="text-stone-900 border border-stone-900 text-xs text-center"
                                            rowspan="{{ $rowSpan }}">
                                            {{ $location->code }} -
                                            {{ $location->city->code }}
                                        </td>
                                        <td class="text-stone-900 border border-stone-900 text-xs px-2"
                                            rowspan="{{ $rowSpan }}">
                                            @if (strlen($location->address) > 65)
                                                {{ substr($location->address, 0, 65) }}..
                                            @else
                                                {{ $location->address }}
                                            @endif
                                        </td>
                                    </tr>
                                    @foreach ($agreements as $agreement)
                                        @php
                                            $secondParty = json_decode($agreement->second_party);
                                        @endphp
                                        <tr>
                                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                                {{ $agreement->number }}
                                            </td>
                                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                                {{ date('d', strtotime($agreement->published)) }}-{{ $bulan[(int) date('m', strtotime($agreement->published))] }}-{{ date('Y', strtotime($agreement->published)) }}
                                            </td>
                                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                                {{ $secondParty->name }}
                                            </td>
                                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                                {{ $secondParty->phone }}
                                            </td>
                                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                                {{ $agreement->duration }} th
                                            </td>
                                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                                {{ date('d', strtotime($agreement->start_at)) }}-{{ $bulan[(int) date('m', strtotime($agreement->start_at))] }}-{{ date('Y', strtotime($agreement->start_at)) }}
                                            </td>
                                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                                {{ date('d', strtotime($agreement->end_at)) }}-{{ $bulan[(int) date('m', strtotime($agreement->end_at))] }}-{{ date('Y', strtotime($agreement->end_at)) }}
                                            </td>
                                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                                {{ number_format($agreement->price) }}
                                            </td>
                                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                                {{ number_format($agreement->price * $agreement->duration) }}
                                            </td>
                                            @if ($loop->iteration == 1)
                                                <td class="text-stone-900 border border-stone-900 text-xs text-center"
                                                    rowspan="{{ $rowSpan - 1 }}">
                                                    <div class="flex justify-center items-center">
                                                        <a href="/show-land-agreement/{{ $location->id }}"
                                                            title="Lihat Data Sewa Lahan"
                                                            class="index-link text-white w-7 h-5 rounded bg-teal-500 hover:bg-teal-600 drop-shadow-md mx-1">
                                                            <svg class="fill-current w-[18px]" clip-rule="evenodd"
                                                                fill-rule="evenodd" stroke-linejoin="round"
                                                                stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm8.413 7c-1.837 2.878-4.897 5.5-8.413 5.5-3.465 0-6.532-2.632-8.404-5.5 1.871-2.868 4.939-5.5 8.404-5.5 3.518 0 6.579 2.624 8.413 5.5zm-8.411-4c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"
                                                                    fill-rule="nonzero" />
                                                            </svg>
                                                        </a>
                                                        @canany(['isAdmin', 'isMedia'])
                                                            @can('isLegal')
                                                                @can('isMediaCreate')
                                                                    <a href="/create-land-agreement/{{ $location->id }}"
                                                                        title="Tambah Data Sewa Lahan"
                                                                        class="index-link text-white w-7 h-5 rounded bg-amber-500 hover:bg-amber-600 drop-shadow-md">
                                                                        <svg class="fill-current w-[18px]" clip-rule="evenodd"
                                                                            fill-rule="evenodd" stroke-linejoin="round"
                                                                            stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                            xmlns="http://www.w3.org/2000/svg">
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
                                            @endif
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                            {{ $number++ }}
                                        </td>
                                        <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                            {{ $location->code }} -
                                            {{ $location->city->code }}
                                        </td>
                                        <td class="text-stone-900 border border-stone-900 text-xs px-2">
                                            @if (strlen($location->address) > 65)
                                                {{ substr($location->address, 0, 65) }}..
                                            @else
                                                {{ $location->address }}
                                            @endif
                                        </td>
                                        @foreach ($agreements as $agreement)
                                            @php
                                                $secondParty = json_decode($agreement->second_party);
                                            @endphp
                                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                                {{ $agreement->number }}
                                            </td>
                                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                                {{ date('d', strtotime($agreement->published)) }}-{{ $bulan[(int) date('m', strtotime($agreement->published))] }}-{{ date('Y', strtotime($agreement->published)) }}
                                            </td>
                                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                                {{ $secondParty->name }}
                                            </td>
                                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                                {{ $secondParty->phone }}
                                            </td>
                                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                                {{ $agreement->duration }} th
                                            </td>
                                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                                {{ date('d', strtotime($agreement->start_at)) }}-{{ $bulan[(int) date('m', strtotime($agreement->start_at))] }}-{{ date('Y', strtotime($agreement->start_at)) }}
                                            </td>
                                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                                {{ date('d', strtotime($agreement->end_at)) }}-{{ $bulan[(int) date('m', strtotime($agreement->end_at))] }}-{{ date('Y', strtotime($agreement->end_at)) }}
                                            </td>
                                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                                {{ number_format($agreement->price) }}
                                            </td>
                                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                                {{ number_format($agreement->price * $agreement->duration) }}
                                            </td>
                                        @endforeach
                                        <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                            <div class="flex justify-center items-center">
                                                <a href="/show-land-agreement/{{ $location->id }}"
                                                    title="Lihat Data Sewa Lahan"
                                                    class="index-link text-white w-7 h-5 rounded bg-teal-500 hover:bg-teal-600 drop-shadow-md mx-1">
                                                    <svg class="fill-current w-[18px]" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm8.413 7c-1.837 2.878-4.897 5.5-8.413 5.5-3.465 0-6.532-2.632-8.404-5.5 1.871-2.868 4.939-5.5 8.404-5.5 3.518 0 6.579 2.624 8.413 5.5zm-8.411-4c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"
                                                            fill-rule="nonzero" />
                                                    </svg>
                                                </a>
                                                @canany(['isAdmin', 'isMedia'])
                                                    @can('isLegal')
                                                        @can('isMediaCreate')
                                                            <a href="/create-land-agreement/{{ $location->id }}"
                                                                title="Tambah Data Sewa Lahan"
                                                                class="index-link text-white w-7 h-5 rounded bg-amber-500 hover:bg-amber-600 drop-shadow-md">
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
                                    </tr>
                                @endif
                            @else
                                <tr>
                                    <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                        {{ $number++ }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                        {{ $location->code }} -
                                        {{ $location->city->code }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-xs px-2">
                                        @if (strlen($location->address) > 65)
                                            {{ substr($location->address, 0, 65) }}..
                                        @else
                                            {{ $location->address }}
                                        @endif
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-xs text-center">-</td>
                                    <td class="text-stone-900 border border-stone-900 text-xs text-center">-</td>
                                    <td class="text-stone-900 border border-stone-900 text-xs text-center">-</td>
                                    <td class="text-stone-900 border border-stone-900 text-xs text-center">-</td>
                                    <td class="text-stone-900 border border-stone-900 text-xs text-center">-</td>
                                    <td class="text-stone-900 border border-stone-900 text-xs text-center">-</td>
                                    <td class="text-stone-900 border border-stone-900 text-xs text-center">-</td>
                                    <td class="text-stone-900 border border-stone-900 text-xs text-center">-</td>
                                    <td class="text-stone-900 border border-stone-900 text-xs text-center">-</td>
                                    <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                        <div class="flex justify-center items-center">
                                            <a href="#" title="Lihat Data Sewa Lahan"
                                                class="index-link text-white w-7 h-5 rounded bg-slate-500 hover:bg-slate-600 drop-shadow-md mx-1">
                                                <svg class="fill-current w-[18px]" clip-rule="evenodd"
                                                    fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm8.413 7c-1.837 2.878-4.897 5.5-8.413 5.5-3.465 0-6.532-2.632-8.404-5.5 1.871-2.868 4.939-5.5 8.404-5.5 3.518 0 6.579 2.624 8.413 5.5zm-8.411-4c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"
                                                        fill-rule="nonzero" />
                                                </svg>
                                            </a>
                                            @canany(['isAdmin', 'isMedia'])
                                                @can('isLegal')
                                                    @can('isMediaCreate')
                                                        <a href="/create-land-agreement/{{ $location->id }}"
                                                            title="Tambah Data Sewa Lahan"
                                                            class="index-link text-white w-7 h-5 rounded bg-amber-500 hover:bg-amber-600 drop-shadow-md">
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
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- View end -->
            <!-- Pagination start -->
            <div class="flex justify-center text-stone-100 mt-2">
                {!! $locations->appends(Request::query())->render('dashboard.layouts.pagination') !!}
            </div>
            <!-- Pagination end -->
        </div>
    </div>

    @include('land-agreements.export-pdf')
    @include('land-agreements.export-excel')

    <input id="saveName" type="text" value="LIST SEWA LAHAN" hidden>
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
                    filename: "List Sewa Lahan.xls"
                });
            });
        });
    </script>
    <!-- Script end -->
@endsection
