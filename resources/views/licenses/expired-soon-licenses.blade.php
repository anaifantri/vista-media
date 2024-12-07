@extends('dashboard.layouts.main');

@section('container')
    <?php
    $bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agst', 'Sept', 'Okt', 'Nov', 'Des'];
    ?>
    <!-- Container start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex p-1 w-full border-b">
                <!-- Title start -->
                <h1 class="index-h1">DAFTAR DATA PERIZINAN YANG SEGERA BERAKHIR</h1>
                <!-- Title end -->
            </div>
            <div>
                <!-- Form search start -->
                <form action="/media/expired-soon-licenses/">
                    <div class="flex mt-1 ml-2">
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
                        <div class="ml-2 w-36">
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
                    </div>
                    <div class="flex mt-2">
                        <div class="flex">
                            <input id="search" name="search"
                                class="flex border rounded-l-lg ml-2 p-1 outline-none text-base text-stone-900"
                                type="text" placeholder="Search" value="{{ request('search') }}" onkeyup="submit()"
                                onfocus="this.setSelectionRange(this.value.length, this.value.length);" autofocus>
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
            <div class="w-[1250px] mt-2">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-stone-400 h-6">
                            <th class="text-stone-900 border border-stone-900 text-xs w-8 text-center">No</th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center">Data Lokasi</th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-36">Izin Prinsip</th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-36">PBG/SLF</th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-36">Izin Reklame</th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-36">SKPD</th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-36">SSPD</th>
                            <th class="text-stone-900 border border-stone-900 text-xs text-center w-24">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-stone-200">
                        @php
                            $number = 1 + ($locations->currentPage() - 1) * $locations->perPage();
                        @endphp
                        @foreach ($locations as $location)
                            @php
                                $dataPrinsip = $location->licenses->where('licensing_category_id', $prinsip)->last();
                                $dataPbg = $location->licenses->where('licensing_category_id', $pbg)->last();
                                $dataSlf = $location->licenses->where('licensing_category_id', $slf)->last();
                                $dataIpr = $location->licenses->where('licensing_category_id', $ipr)->last();
                                $dataSkpd = $location->licenses->where('licensing_category_id', $skpd)->last();
                                $dataSspd = $location->licenses->where('licensing_category_id', $sspd)->last();
                            @endphp
                            @if ($number % 2 == 0)
                                <tr class="bg-stone-100">
                                    <td class="text-stone-900 border border-stone-900 text-xs text-center align-top">
                                        {{ $number++ }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-xs px-1 align-top">
                                        <div class="flex">
                                            <label class="flex w-10">Kode</label>
                                            <label class="flex">:</label>
                                            <label class="flex ml-1">{{ $location->code }} -
                                                {{ $location->city->code }}</label>
                                        </div>
                                        <div class="flex">
                                            <label class="flex w-10">Lokasi</label>
                                            <label class="flex">:</label>
                                            <label class="flex ml-1">{{ $location->address }}</label>
                                        </div>
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-xs">
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Nomor</label>
                                            <label class="flex font-semibold">:
                                                @if ($dataPrinsip)
                                                    @if ($dataPrinsip->number)
                                                        @if (strlen($dataPrinsip->number) > 10)
                                                            {{ substr($dataPrinsip->number, 0, 11) }}...
                                                        @else
                                                            {{ substr($dataPrinsip->number, 0, 10) }}
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Awal</label>
                                            <label class="flex">:
                                                @if ($dataPrinsip)
                                                    @if ($dataPrinsip->start_at)
                                                        {{ date('d', strtotime($dataPrinsip->start_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($dataPrinsip->start_at))] }}
                                                        {{ date('Y', strtotime($dataPrinsip->start_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Akhir</label>
                                            <label class="flex">:
                                                @if ($dataPrinsip)
                                                    @if ($dataPrinsip->end_at)
                                                        {{ date('d', strtotime($dataPrinsip->end_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($dataPrinsip->end_at))] }}
                                                        {{ date('Y', strtotime($dataPrinsip->end_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-xs">
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Nomor</label>
                                            <label class="flex">:
                                                @if ($dataPbg)
                                                    @if ($dataPbg->number)
                                                        @if (strlen($dataPbg->number) > 10)
                                                            {{ substr($dataPbg->number, 0, 11) }}...
                                                        @else
                                                            {{ substr($dataPbg->number, 0, 10) }}
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                @elseif ($dataSlf)
                                                    @if ($dataSlf->number)
                                                        @if (strlen($dataSlf->number) > 10)
                                                            {{ substr($dataSlf->number, 0, 11) }}...
                                                        @else
                                                            {{ substr($dataSlf->number, 0, 10) }}
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Awal</label>
                                            <label class="flex">:
                                                @if ($dataPbg)
                                                    @if ($dataPbg->start_at)
                                                        {{ date('d', strtotime($dataPbg->start_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($dataPbg->start_at))] }}
                                                        {{ date('Y', strtotime($dataPbg->start_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                @elseif ($dataSlf)
                                                    @if ($dataSlf->start_at)
                                                        {{ date('d', strtotime($dataSlf->start_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($dataSlf->start_at))] }}
                                                        {{ date('Y', strtotime($dataSlf->start_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Akhir</label>
                                            <label class="flex">:
                                                @if ($dataPbg)
                                                    @if ($dataPbg->end_at)
                                                        {{ date('d', strtotime($dataPbg->end_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($dataPbg->end_at))] }}
                                                        {{ date('Y', strtotime($dataPbg->end_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                @elseif ($dataSlf)
                                                    @if ($dataSlf->end_at)
                                                        {{ date('d', strtotime($dataSlf->end_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($dataSlf->end_at))] }}
                                                        {{ date('Y', strtotime($dataSlf->end_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-xs">
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Nomor</label>
                                            <label class="flex">:
                                                @if ($dataIpr)
                                                    @if ($dataIpr->number)
                                                        @if (strlen($dataIpr->number) > 10)
                                                            {{ substr($dataIpr->number, 0, 10) }}...
                                                        @else
                                                            {{ substr($dataIpr->number, 0, 10) }}
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Awal</label>
                                            <label class="flex">:
                                                @if ($dataIpr)
                                                    @if ($dataIpr->start_at)
                                                        {{ date('d', strtotime($dataIpr->start_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($dataIpr->start_at))] }}
                                                        {{ date('Y', strtotime($dataIpr->start_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Akhir</label>
                                            <label class="flex">:
                                                @if ($dataIpr)
                                                    @if ($dataIpr->end_at)
                                                        {{ date('d', strtotime($dataIpr->end_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($dataIpr->end_at))] }}
                                                        {{ date('Y', strtotime($dataIpr->end_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-xs">
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Nomor</label>
                                            <label class="flex">:
                                                @if ($dataSkpd)
                                                    @if ($dataSkpd->number)
                                                        @if (strlen($dataSkpd->number) > 10)
                                                            {{ substr($dataSkpd->number, 0, 11) }}...
                                                        @else
                                                            {{ substr($dataSkpd->number, 0, 10) }}
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Awal</label>
                                            <label class="flex">:
                                                @if ($dataSkpd)
                                                    @if ($dataSkpd->start_at)
                                                        {{ date('d', strtotime($dataSkpd->start_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($dataSkpd->start_at))] }}
                                                        {{ date('Y', strtotime($dataSkpd->start_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Akhir</label>
                                            <label class="flex">:
                                                @if ($dataSkpd)
                                                    @if ($dataSkpd->end_at)
                                                        {{ date('d', strtotime($dataSkpd->end_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($dataSkpd->end_at))] }}
                                                        {{ date('Y', strtotime($dataSkpd->end_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-xs">
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Nomor</label>
                                            <label class="flex">:
                                                @if ($dataSspd)
                                                    @if ($dataSspd->number)
                                                        @if (strlen($dataSspd->number) > 10)
                                                            {{ substr($dataSspd->number, 0, 11) }}...
                                                        @else
                                                            {{ substr($dataSspd->number, 0, 10) }}
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Awal</label>
                                            <label class="flex">:
                                                @if ($dataSspd)
                                                    @if ($dataSspd->start_at)
                                                        {{ date('d', strtotime($dataSspd->start_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($dataSspd->start_at))] }}
                                                        {{ date('Y', strtotime($dataSspd->start_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Akhir</label>
                                            <label class="flex">:
                                                @if ($dataSspd)
                                                    @if ($dataSspd->end_at)
                                                        {{ date('d', strtotime($dataSspd->end_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($dataSspd->end_at))] }}
                                                        {{ date('Y', strtotime($dataSspd->end_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                        <div class="flex justify-center items-center">
                                            <a href="/show-license/{{ $location->id }}" title="Lihat Data Izin"
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
                                                        <a href="/create-license/{{ $location->id }}" title="Tambah Data Izin"
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
                            @else
                                <tr>
                                    <td class="text-stone-900 border border-stone-900 text-xs text-center align-top">
                                        {{ $number++ }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-xs px-1 align-top">
                                        <div class="flex">
                                            <label class="flex w-10">Kode</label>
                                            <label class="flex">:</label>
                                            <label class="flex ml-1">{{ $location->code }} -
                                                {{ $location->city->code }}</label>
                                        </div>
                                        <div class="flex">
                                            <label class="flex w-10">Lokasi</label>
                                            <label class="flex">:</label>
                                            <label class="flex ml-1">{{ $location->address }}</label>
                                        </div>
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-xs">
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Nomor</label>
                                            <label class="flex font-semibold">:
                                                @if ($dataPrinsip)
                                                    @if ($dataPrinsip->number)
                                                        @if (strlen($dataPrinsip->number) > 10)
                                                            {{ substr($dataPrinsip->number, 0, 11) }}...
                                                        @else
                                                            {{ substr($dataPrinsip->number, 0, 10) }}
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Awal</label>
                                            <label class="flex">:
                                                @if ($dataPrinsip)
                                                    @if ($dataPrinsip->start_at)
                                                        {{ date('d', strtotime($dataPrinsip->start_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($dataPrinsip->start_at))] }}
                                                        {{ date('Y', strtotime($dataPrinsip->start_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Akhir</label>
                                            <label class="flex">:
                                                @if ($dataPrinsip)
                                                    @if ($dataPrinsip->end_at)
                                                        {{ date('d', strtotime($dataPrinsip->end_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($dataPrinsip->end_at))] }}
                                                        {{ date('Y', strtotime($dataPrinsip->end_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-xs">
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Nomor</label>
                                            <label class="flex">:
                                                @if ($dataPbg)
                                                    @if ($dataPbg->number)
                                                        @if (strlen($dataPbg->number) > 10)
                                                            {{ substr($dataPbg->number, 0, 11) }}...
                                                        @else
                                                            {{ substr($dataPbg->number, 0, 10) }}
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                @elseif ($dataSlf)
                                                    @if ($dataSlf->number)
                                                        @if (strlen($dataSlf->number) > 10)
                                                            {{ substr($dataSlf->number, 0, 11) }}...
                                                        @else
                                                            {{ substr($dataSlf->number, 0, 10) }}
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Awal</label>
                                            <label class="flex">:
                                                @if ($dataPbg)
                                                    @if ($dataPbg->start_at)
                                                        {{ date('d', strtotime($dataPbg->start_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($dataPbg->start_at))] }}
                                                        {{ date('Y', strtotime($dataPbg->start_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                @elseif ($dataSlf)
                                                    @if ($dataSlf->start_at)
                                                        {{ date('d', strtotime($dataSlf->start_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($dataSlf->start_at))] }}
                                                        {{ date('Y', strtotime($dataSlf->start_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Akhir</label>
                                            <label class="flex">:
                                                @if ($dataPbg)
                                                    @if ($dataPbg->end_at)
                                                        {{ date('d', strtotime($dataPbg->end_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($dataPbg->end_at))] }}
                                                        {{ date('Y', strtotime($dataPbg->end_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                @elseif ($dataSlf)
                                                    @if ($dataSlf->end_at)
                                                        {{ date('d', strtotime($dataSlf->end_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($dataSlf->end_at))] }}
                                                        {{ date('Y', strtotime($dataSlf->end_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-xs">
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Nomor</label>
                                            <label class="flex">:
                                                @if ($dataIpr)
                                                    @if ($dataIpr->number)
                                                        @if (strlen($dataIpr->number) > 10)
                                                            {{ substr($dataIpr->number, 0, 10) }}...
                                                        @else
                                                            {{ substr($dataIpr->number, 0, 10) }}
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Awal</label>
                                            <label class="flex">:
                                                @if ($dataIpr)
                                                    @if ($dataIpr->start_at)
                                                        {{ date('d', strtotime($dataIpr->start_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($dataIpr->start_at))] }}
                                                        {{ date('Y', strtotime($dataIpr->start_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Akhir</label>
                                            <label class="flex">:
                                                @if ($dataIpr)
                                                    @if ($dataIpr->end_at)
                                                        {{ date('d', strtotime($dataIpr->end_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($dataIpr->end_at))] }}
                                                        {{ date('Y', strtotime($dataIpr->end_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-xs">
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Nomor</label>
                                            <label class="flex">:
                                                @if ($dataSkpd)
                                                    @if ($dataSkpd->number)
                                                        @if (strlen($dataSkpd->number) > 10)
                                                            {{ substr($dataSkpd->number, 0, 11) }}...
                                                        @else
                                                            {{ substr($dataSkpd->number, 0, 10) }}
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Awal</label>
                                            <label class="flex">:
                                                @if ($dataSkpd)
                                                    @if ($dataSkpd->start_at)
                                                        {{ date('d', strtotime($dataSkpd->start_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($dataSkpd->start_at))] }}
                                                        {{ date('Y', strtotime($dataSkpd->start_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Akhir</label>
                                            <label class="flex">:
                                                @if ($dataSkpd)
                                                    @if ($dataSkpd->end_at)
                                                        {{ date('d', strtotime($dataSkpd->end_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($dataSkpd->end_at))] }}
                                                        {{ date('Y', strtotime($dataSkpd->end_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-xs">
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Nomor</label>
                                            <label class="flex">:
                                                @if ($dataSspd)
                                                    @if ($dataSspd->number)
                                                        @if (strlen($dataSspd->number) > 10)
                                                            {{ substr($dataSspd->number, 0, 11) }}...
                                                        @else
                                                            {{ substr($dataSspd->number, 0, 10) }}
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Awal</label>
                                            <label class="flex">:
                                                @if ($dataSspd)
                                                    @if ($dataSspd->start_at)
                                                        {{ date('d', strtotime($dataSspd->start_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($dataSspd->start_at))] }}
                                                        {{ date('Y', strtotime($dataSspd->start_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                        <div class="flex w-36 px-1">
                                            <label class="flex w-12">Akhir</label>
                                            <label class="flex">:
                                                @if ($dataSspd)
                                                    @if ($dataSspd->end_at)
                                                        {{ date('d', strtotime($dataSspd->end_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($dataSspd->end_at))] }}
                                                        {{ date('Y', strtotime($dataSspd->end_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                        <div class="flex justify-center items-center">
                                            <a href="/show-license/{{ $location->id }}" title="Lihat Data Izin"
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
                                                        <a href="/create-license/{{ $location->id }}" title="Tambah Data Izin"
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
    <!-- Container end -->
@endsection
