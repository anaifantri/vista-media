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
    // $name = 'DAFTAR SPK CETAK - ' . date('d', strtotime(request('periode'))) . ' ' . $bulan_full[(int) date('m', strtotime(request('periode')))] . ' ' . date('Y', strtotime(request('periode')));
    ?>
    <!-- Container start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex p-1 w-full border-b">
                <!-- Title start -->
                @if ($category == 'All')
                    <h1 class="index-h1">Daftar Lokasi Media</h1>
                @else
                    <h1 class="index-h1">Daftar Lokasi Media {{ $category }}</h1>
                @endif
                <!-- Title end -->
                <div class="flex">
                    {{-- <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-warning"
                        title="Simpan dalam bentuk pdf" type="button">
                        <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M15 12c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-.199.02-.393.057-.581 1.474.541 2.927-.882 2.405-2.371.174-.03.354-.048.538-.048 1.657 0 3 1.344 3 3zm-2.985-7c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 12c-2.761 0-5-2.238-5-5 0-2.761 2.239-5 5-5 2.762 0 5 2.239 5 5 0 2.762-2.238 5-5 5z" />
                        </svg>
                        <span class="mx-1">Save PDF</span>
                    </button> --}}
                    <!-- Button Create start -->
                    @if ($category == 'All')
                        @if (request('media_category_id') != '' && request('media_category_id') != 'All')
                            @canany(['isAdmin', 'isMedia', 'isMarketing'])
                                @can('isLocation')
                                    @can('isMediaCreate')
                                        <a href="/media/locations/create-location/{{ $data_categories->name }}"
                                            class="index-link btn-primary">
                                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                            <span class="mx-1 hidden sm:flex">Tambah Lokasi</span>
                                        </a>
                                    @endcan
                                @endcan
                            @endcanany
                        @endif
                    @else
                        @canany(['isAdmin', 'isMedia', 'isMarketing'])
                            @can('isLocation')
                                @can('isMediaCreate')
                                    <a href="/media/locations/create-location/{{ $category }}" class="index-link btn-primary">
                                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                                fill-rule="nonzero" />
                                        </svg>
                                        <span class="mx-1 hidden sm:flex">Tambah Lokasi</span>
                                    </a>
                                @endcan
                            @endcan
                        @endcanany
                    @endif
                </div>
                <!-- Button Create end -->
            </div>
            <div>
                <!-- Form search start -->
                <form action="/media/locations/home/{{ $category }}">
                    <div class="flex mt-1 ml-2">
                        <div class="w-36">
                            <span class="text-base text-stone-200">Area</span>
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
                                <span class="text-base text-stone-200">Kota</span>
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
                        @if ($category == 'All')
                            <div class="w-36 ml-2">
                                <span class="text-base text-stone-200">Katagori</span>
                                <select class="w-full border rounded-lg text-base text-stone-900 outline-none"
                                    name="media_category_id" id="media_category_id" onchange="submit()"
                                    value="{{ request('media_category_id') }}">
                                    <option value="All">All</option>
                                    @foreach ($categories as $category)
                                        @if ($category->name != 'Service')
                                            @if (request('media_category_id') == $category->id)
                                                <option value="{{ $category->id }}" selected>{{ $category->name }}
                                                </option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="w-36 ml-2">
                            <span class="text-base text-stone-200">Kondisi</span>
                            <select class="w-full border rounded-lg text-base text-stone-900 outline-none" name="condition"
                                id="condition" onchange="submit()">
                                <?php $condition = ['All', 'Terbangun', 'Rencana']; ?>
                                @for ($i = 0; $i < count($condition); $i++)
                                    @if (request('condition') == $condition[$i])
                                        <option value="{{ $condition[$i] }}" selected> {{ $condition[$i] }} </option>
                                    @else
                                        <option value="{{ $condition[$i] }}"> {{ $condition[$i] }} </option>
                                    @endif
                                @endfor
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
                @error('delete')
                    <div class="mt-2 flex alert-warning">
                        <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                        </svg>
                        <span class="font-semibold mx-1">Warning!!</span> {{ $message }}
                    </div>
                @enderror
                <!-- Alert end -->
            </div>
            <!-- View start -->
            <div class="w-[1200px] mt-2">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-stone-400">
                            <th class="text-stone-900 border border-stone-900 text-[0.65rem] w-8 text-center"
                                rowspan="2">No
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-[0.65rem] w-16 text-center"
                                rowspan="2">
                                <button class="flex justify-center items-center w-16">@sortablelink('code', 'Kode')
                                    <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                    </svg>
                                </button>
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-[0.65rem] text-center" rowspan="2"
                                colspan="2">
                                Lokasi
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-20"
                                rowspan="2">
                                Area</th>
                            <th class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-20"
                                rowspan="2">
                                Kota</th>
                            <th class="text-stone-900 border border-stone-900 text-[0.65rem] text-center" colspan="5">
                                Deskripsi Reklame
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-16"
                                rowspan="2">
                                Kondisi</th>
                            @canany(['isAdmin', 'isMarketing', 'isOwner'])
                                @can('isLocation')
                                    <th class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-16"
                                        rowspan="2">
                                        status</th>
                                    <th class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-20"
                                        rowspan="2">
                                        <button class="flex justify-center items-center w-20">@sortablelink('price', 'Harga (Rp.)')
                                            <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                            </svg>
                                        </button>
                                    </th>
                                @endcan
                            @endcanany
                            <th class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-24"
                                rowspan="2">
                                Action</th>
                        </tr>
                        <tr class="bg-stone-400">
                            <th class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-10">Jenis</th>
                            <th class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-10">BL/FL</th>
                            <th class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-8">Side</th>
                            <th class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-8">Qty</th>
                            <th class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-20">Size - V/H
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-stone-200">
                        @php
                            $number = 1 + ($locations->currentPage() - 1) * $locations->perPage();
                        @endphp
                        @foreach ($locations as $location)
                            @php
                                $description = json_decode($location->description);
                                $created_by = json_decode($location->created_by);
                                if (
                                    $location->media_category->name == 'Videotron' ||
                                    ($location->media_category->name == 'Signage' && $description->type == 'Videotron')
                                ) {
                                    // $videotronSales = $location->sales->where('end_at', '>', date('Y-m-d'));
                                    $videotronSales = $location->videotron_active_sales;
                                    $slots = $description->slots;
                                } else {
                                    $sale = $location->active_sale;
                                    if ($sale) {
                                        $status = 'Sold';
                                    } else {
                                        $status = 'Available';
                                    }
                                }
                            @endphp
                            @if (
                                $location->media_category->name == 'Videotron' ||
                                    ($location->media_category->name == 'Signage' && $description->type == 'Videotron'))
                                <tr>
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                        {{ $number++ }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                        {{ $location->code }} -
                                        {{ $location->city->code }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] px-2" colspan="2">
                                        {{ $location->address }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                        {{ $location->area->area }}</td>
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                        {{ $location->city->city }}</td>
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                        {{ $location->media_category->code }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                        @if (
                                            $location->media_category->name == 'Videotron' ||
                                                ($location->media_category->name == 'Signage' && $description->type == 'Videotron'))
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
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                        {{ (int) filter_var($location->side, FILTER_SANITIZE_NUMBER_INT) }}</td>
                                    @if ($location->media_category->name == 'Signage')
                                        <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                            {{ $description->qty }}</td>
                                    @else
                                        <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">1
                                        </td>
                                    @endif
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                        {{ $location->media_size->size }}
                                        -
                                        @if ($location->orientation == 'Vertikal')
                                            V
                                        @elseif ($location->orientation == 'Horizontal')
                                            H
                                        @endif
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                        {{ $location->condition }}</td>
                                    @canany(['isAdmin', 'isMarketing', 'isOwner'])
                                        @can('isLocation')
                                            <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">-
                                            </td>
                                            <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-right px-1">
                                                {{ number_format($location->price) }}
                                            </td>
                                        @endcan
                                    @endcanany
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                        <div class="flex justify-center items-center">
                                            <a href="/media/locations/{{ $location->id }}"
                                                class="index-link text-white w-7 h-5 rounded bg-lime-500 hover:bg-lime-600 drop-shadow-md mx-1">
                                                <svg class="fill-current w-[18px]" clip-rule="evenodd"
                                                    fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm8.413 7c-1.837 2.878-4.897 5.5-8.413 5.5-3.465 0-6.532-2.632-8.404-5.5 1.871-2.868 4.939-5.5 8.404-5.5 3.518 0 6.579 2.624 8.413 5.5zm-8.411-4c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"
                                                        fill-rule="nonzero" />
                                                </svg>
                                            </a>
                                            @canany(['isAdmin', 'isMedia', 'isMarketing'])
                                                @can('isLocation')
                                                    @can('isMediaEdit')
                                                        <a href="/media/locations/{{ $location->id }}/edit"
                                                            class="index-link text-white w-7 h-5 rounded bg-amber-400 hover:bg-amber-500 drop-shadow-md mx-1">
                                                            <svg class="fill-current w-[18px]" clip-rule="evenodd"
                                                                fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                                    fill-rule="nonzero" />
                                                            </svg>
                                                        </a>
                                                    @endcan
                                                @endcan
                                            @endcanany
                                            @canany(['isAdmin', 'isMedia', 'isMarketing'])
                                                @can('isLocation')
                                                    @can('isMediaDelete')
                                                        <form action="/media/locations/{{ $location->id }}" method="post"
                                                            class="d-inline m-1">
                                                            @method('delete')
                                                            @csrf
                                                            <button
                                                                class="index-link text-white w-7 h-5 bg-red-500 rounded-md hover:bg-red-600"
                                                                onclick="return confirm('Apakah anda yakin ingin menghapus lokasi dengan kode {{ $location->code }} ?')">
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

                                @canany(['isAdmin', 'isMarketing', 'isOwner'])
                                    @can('isLocation')
                                        <tr class="border border-stone-900">
                                            <td class="text-stone-900 text-[0.65rem] bg-stone-400 text-center"></td>
                                            <td
                                                class="text-stone-900 border border-stone-900 text-[0.65rem] bg-stone-300 text-center">
                                                Slot
                                            </td>
                                            <td
                                                class="text-stone-900 border border-stone-900 text-[0.65rem] bg-stone-300 text-center">
                                                Klien
                                            </td>
                                            <td
                                                class="text-stone-900 border border-stone-900 text-[0.65rem] bg-stone-300 text-center">
                                                Perusahaan
                                            </td>
                                            <td
                                                class="text-stone-900 border border-stone-900 text-[0.65rem] bg-stone-300 text-center">
                                                Periode
                                            </td>
                                            <td
                                                class="text-stone-900 border border-stone-900 text-[0.65rem] bg-stone-300 text-center">
                                                Awal
                                            </td>
                                            <td class="text-stone-900 border border-stone-900 text-[0.65rem] bg-stone-300 text-center"
                                                colspan="2">
                                                Akhir
                                            </td>
                                            <td class="text-stone-900 text-[0.65rem] bg-stone-300 text-center" colspan="3">
                                                Status</td>
                                            <td class="text-stone-900 text-[0.65rem] bg-stone-400 text-center"></td>
                                            <td class="text-stone-900 text-[0.65rem] bg-stone-400 text-center"></td>
                                            <td class="text-stone-900 text-[0.65rem] bg-stone-400 text-center"></td>
                                            <td class="text-stone-900 text-[0.65rem] bg-stone-400 text-center"></td>
                                        </tr>
                                        @if ($videotronSales)
                                            @php
                                                $indexSlot = 0;
                                            @endphp
                                            @foreach ($videotronSales as $videotronSale)
                                                @php
                                                    $client = json_decode($videotronSale->quotation->clients);
                                                    $getPrice = json_decode($videotronSale->quotation->price);
                                                    $slotQty = $getPrice->slotQty;
                                                    $clientName = $client->name;
                                                    $clientCompany = $client->company;
                                                    $periode = $videotronSale->duration;
                                                    $startAt = $videotronSale->start_at;
                                                    $endAt = $videotronSale->end_at;
                                                @endphp
                                                @for ($i = 0; $i < $slotQty; $i++)
                                                    @php
                                                        $indexSlot++;
                                                    @endphp
                                                    <tr class="border border-stone-900">
                                                        <td class="text-stone-900 text-[0.65rem] bg-stone-400 text-center">
                                                        </td>
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-[0.65rem] bg-lime-50 text-center">
                                                            {{ $i + 1 }}
                                                        </td>
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-[0.65rem] bg-lime-50 text-center">
                                                            {{ $clientName }}
                                                        </td>
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-[0.65rem] bg-lime-50 text-center">
                                                            {{ $clientCompany }}
                                                        </td>
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-[0.65rem] bg-lime-50 text-center">
                                                            {{ $periode }}
                                                        </td>
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-[0.65rem] bg-lime-50 text-center">
                                                            {{ $startAt }}
                                                        </td>
                                                        <td class="text-stone-900 border border-stone-900 text-[0.65rem] bg-lime-50 text-center"
                                                            colspan="2">
                                                            {{ $endAt }}
                                                        </td>
                                                        <td class="text-stone-900 text-[0.65rem] bg-lime-50 text-center"
                                                            colspan="3">Sold
                                                        </td>
                                                        <td class="text-stone-900 text-[0.65rem] bg-stone-400 text-center">
                                                        </td>
                                                        <td class="text-stone-900 text-[0.65rem] bg-stone-400 text-center">
                                                        </td>
                                                        <td class="text-stone-900 text-[0.65rem] bg-stone-400 text-center">
                                                        </td>
                                                        <td class="text-stone-900 text-[0.65rem] bg-stone-400 text-center">
                                                        </td>
                                                    </tr>
                                                @endfor
                                            @endforeach
                                            @if ($indexSlot < $slots)
                                                @for ($i = $indexSlot; $i < $slots; $i++)
                                                    <tr class="border border-stone-900">
                                                        <td class="text-stone-900 text-[0.65rem] bg-stone-400 text-center">
                                                        </td>
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-[0.65rem] bg-lime-50 text-center">
                                                            {{ $i + 1 }}
                                                        </td>
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-[0.65rem] bg-lime-50 text-center">
                                                            -</td>
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-[0.65rem] bg-lime-50 text-center">
                                                            -
                                                        </td>
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-[0.65rem] bg-lime-50 text-center">
                                                            -
                                                        </td>
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-[0.65rem] bg-lime-50 text-center">
                                                            -</td>
                                                        <td class="text-stone-900 border border-stone-900 text-[0.65rem] bg-lime-50 text-center"
                                                            colspan="2">-</td>
                                                        <td class="text-stone-900 text-[0.65rem] bg-lime-50 text-center"
                                                            colspan="3">Available</td>
                                                        <td class="text-stone-900 text-[0.65rem] bg-stone-400 text-center">
                                                        </td>
                                                        <td class="text-stone-900 text-[0.65rem] bg-stone-400 text-center">
                                                        </td>
                                                        <td class="text-stone-900 text-[0.65rem] bg-stone-400 text-center">
                                                        </td>
                                                        <td class="text-stone-900 text-[0.65rem] bg-stone-400 text-center">
                                                        </td>
                                                    </tr>
                                                @endfor
                                            @endif
                                        @endif
                                    @endcan
                                @endcanany
                            @else
                                <tr>
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                        {{ $number++ }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                        {{ $location->code }} -
                                        {{ $location->city->code }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] px-2" colspan="2">
                                        {{ $location->address }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                        {{ $location->area->area }}</td>
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                        {{ $location->city->city }}</td>
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                        {{ $location->media_category->code }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
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
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                        {{ (int) filter_var($location->side, FILTER_SANITIZE_NUMBER_INT) }}</td>
                                    @if ($location->media_category->name == 'Signage')
                                        <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                            {{ $description->qty }}</td>
                                    @else
                                        <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">1
                                        </td>
                                    @endif
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                        {{ $location->media_size->size }}
                                        -
                                        @if ($location->orientation == 'Vertikal')
                                            V
                                        @elseif ($location->orientation == 'Horizontal')
                                            H
                                        @endif
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                        {{ $location->condition }}</td>
                                    @canany(['isAdmin', 'isMarketing', 'isOwner'])
                                        @can('isLocation')
                                            <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                                {{ $status }}</td>
                                            <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-right px-1">
                                                {{ number_format($location->price) }}
                                            </td>
                                        @endcan
                                    @endcanany
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                        <div class="flex justify-center items-center">
                                            <a href="/media/locations/{{ $location->id }}"
                                                class="index-link text-white w-7 h-5 rounded bg-lime-500 hover:bg-lime-600 drop-shadow-md mx-1">
                                                <svg class="fill-current w-[18px]" clip-rule="evenodd"
                                                    fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm8.413 7c-1.837 2.878-4.897 5.5-8.413 5.5-3.465 0-6.532-2.632-8.404-5.5 1.871-2.868 4.939-5.5 8.404-5.5 3.518 0 6.579 2.624 8.413 5.5zm-8.411-4c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"
                                                        fill-rule="nonzero" />
                                                </svg>
                                            </a>
                                            @canany(['isAdmin', 'isMedia', 'isMarketing'])
                                                @can('isLocation')
                                                    @can('isMediaEdit')
                                                        <a href="/media/locations/{{ $location->id }}/edit"
                                                            class="index-link text-white w-7 h-5 rounded bg-amber-400 hover:bg-amber-500 drop-shadow-md mx-1">
                                                            <svg class="fill-current w-[18px]" clip-rule="evenodd"
                                                                fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                                    fill-rule="nonzero" />
                                                            </svg>
                                                        </a>
                                                    @endcan
                                                @endcan
                                            @endcanany
                                            @canany(['isAdmin', 'isMedia', 'isMarketing'])
                                                @can('isLocation')
                                                    @can('isMediaDelete')
                                                        <form action="/media/locations/{{ $location->id }}" method="post"
                                                            class="d-inline m-1">
                                                            @method('delete')
                                                            @csrf
                                                            <button
                                                                class="index-link text-white w-7 h-5 bg-red-500 rounded-md hover:bg-red-600"
                                                                onclick="return confirm('Apakah anda yakin ingin menghapus lokasi dengan kode {{ $location->code }} ?')">
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

    {{-- <div class="bg-black p-10">
        <div class="flex justify-center w-full">
            <div id="pdfPreview" class="w-[950px] h-[1345px] mt-1 bg-white p-4">
                <!-- Header start -->
                @include('dashboard.layouts.letter-header')
                <!-- Header end -->
                <!-- Body start -->
                <div class="h-[1080px]">
                    <label class="flex text-md font-semibold justify-center w-full mt-6">
                        <u>
                            DAFTAR HARGA
                            @if ($data_categories)
                                {{ strtoupper($data_categories->name) }}
                            @endif
                        </u>
                    </label>
                    <div class="flex justify-center w-full mt-6">
                        <div class="w-[725px]">
                            <div class="flex">
                                <label class="text-md w-28">Area</label>
                                <label class="text-md">:</label>
                                <label class="text-md px-2">
                                    @if (request('area'))
                                        @if (request('area') != 'All')
                                            @php
                                                $getArea = $areas->where('id', request('area'))->last();
                                            @endphp
                                            {{ $getArea->area }}
                                        @else
                                            Semua
                                        @endif
                                    @else
                                        Semua
                                    @endif
                                </label>
                            </div>
                            <div class="flex">
                                <label class="text-md w-28">Kota</label>
                                <label class="text-md">:</label>
                                <label class="text-md px-2">
                                    @if (request('city'))
                                        @if (request('city') != 'All')
                                            @php
                                                $getCity = $cities->where('id', request('city'))->last();
                                            @endphp
                                            {{ $getCity->city }}
                                        @else
                                            Semua
                                        @endif
                                    @else
                                        Semua
                                    @endif
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center w-full mt-8">
                        <div class="w-[850px]">
                            <table class="table-auto w-full">
                                <thead>
                                    <tr>
                                        <th class="text-stone-900 border border-stone-900 text-[0.65rem] w-6 text-center"
                                            rowspan="2">No
                                        </th>
                                        <th class="text-stone-900 border border-stone-900 text-[0.65rem] w-16 text-center"
                                            rowspan="2">
                                            <button class="flex justify-center items-center w-full">@sortablelink('code', 'Kode')
                                                <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24">
                                                    <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                                </svg>
                                            </button>
                                        </th>
                                        <th class="text-stone-900 border border-stone-900 text-[0.65rem] text-center"
                                            rowspan="2" colspan="2">
                                            Lokasi
                                        </th>
                                        @if ($location->media_category->name == 'Videotron' || ($location->media_category->name == 'Signage' && $description->type == 'Videotron'))
                                            <th class="text-stone-900 border border-stone-900 text-[0.65rem] text-center"
                                                colspan="4">
                                                Deskripsi Reklame
                                            </th>
                                        @else
                                            <th class="text-stone-900 border border-stone-900 text-[0.65rem] text-center"
                                                colspan="5">
                                                Deskripsi Reklame
                                            </th>
                                        @endif
                                        @if ($location->media_category->name == 'Videotron' || ($location->media_category->name == 'Signage' && $description->type == 'Videotron'))
                                            <th class="text-stone-900 border border-stone-900 text-[0.65rem] text-center"
                                                colspan="5">Harga
                                            </th>
                                        @else
                                            <th class="text-stone-900 border border-stone-900 text-[0.65rem] text-center"
                                                colspan="4">Harga
                                            </th>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if ($location->media_category->name != 'Videotron' || ($location->media_category->name == 'Signage' && $description->type != 'Videotron'))
                                            <th
                                                class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-8">
                                                Jenis</th>
                                            <th
                                                class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-10">
                                                BL/FL</th>
                                        @endif
                                        <th class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-8">
                                            Side</th>
                                        <th class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-8">
                                            Qty</th>
                                        <th
                                            class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-[72px]">
                                            Size - V/H
                                        </th>
                                        @if ($location->media_category->name == 'Videotron' || ($location->media_category->name == 'Signage' && $description->type == 'Videotron'))
                                            <th class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-8"
                                                rowspan="2">
                                                Slot</th>
                                            <th
                                                class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-10">
                                                Jenis
                                            </th>
                                            <th
                                                class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-16">
                                                1 Bulan
                                            </th>
                                            <th
                                                class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-16">
                                                3 Bulan
                                            </th>
                                            <th
                                                class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-16">
                                                6 Bulan
                                            </th>
                                            <th
                                                class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-20">
                                                1 Tahun
                                            </th>
                                        @else
                                            <th
                                                class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-16">
                                                1 Bulan
                                            </th>
                                            <th
                                                class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-16">
                                                3 Bulan
                                            </th>
                                            <th
                                                class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-16">
                                                6 Bulan
                                            </th>
                                            <th
                                                class="text-stone-900 border border-stone-900 text-[0.65rem] text-center w-20">
                                                1 Tahun
                                            </th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $number = 1 + ($locations->currentPage() - 1) * $locations->perPage();
                                    @endphp
                                    @foreach ($locations as $location)
                                        @php
                                            $description = json_decode($location->description);
                                            $created_by = json_decode($location->created_by);
                                            if (
                                                $location->media_category->name == 'Videotron' ||
                                                ($location->media_category->name == 'Signage' &&
                                                    $description->type == 'Videotron')
                                            ) {
                                                // $videotronSales = $location->sales->where('end_at', '>', date('Y-m-d'));
                                                $videotronSales = $location->videotron_active_sales;
                                                $slots = $description->slots;
                                            } else {
                                                $sale = $location->active_sale;
                                                if ($sale) {
                                                    $status = 'Sold';
                                                } else {
                                                    $status = 'Available';
                                                }
                                            }
                                        @endphp
                                        @if ($location->media_category->name == 'Videotron' || ($location->media_category->name == 'Signage' && $description->type == 'Videotron'))
                                            <tr>
                                                <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center"
                                                    rowspan="2">
                                                    {{ $number++ }}
                                                </td>
                                                <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center"
                                                    rowspan="2">
                                                    {{ $location->code }} -
                                                    {{ $location->city->code }}
                                                </td>
                                                <td class="text-stone-900 border border-stone-900 text-[0.65rem] px-2"
                                                    rowspan="2" colspan="2">
                                                    {{ $location->address }}
                                                </td>
                                                <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center"
                                                    rowspan="2">
                                                    {{ (int) filter_var($location->side, FILTER_SANITIZE_NUMBER_INT) }}
                                                </td>
                                                @if ($location->media_category->name == 'Signage')
                                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center"
                                                        rowspan="2">
                                                        {{ $description->qty }}</td>
                                                @else
                                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center"
                                                        rowspan="2">
                                                        1
                                                    </td>
                                                @endif
                                                <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center"
                                                    rowspan="2">
                                                    {{ $location->media_size->size }}
                                                    -
                                                    @if ($location->orientation == 'Vertikal')
                                                        V
                                                    @elseif ($location->orientation == 'Horizontal')
                                                        H
                                                    @endif
                                                </td>
                                                <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-center px-1"
                                                    rowspan="2">
                                                    {{ $slots }}
                                                </td>
                                                </td>
                                                <td
                                                    class="text-stone-900 border border-stone-900 text-[0.65rem] text-center px-1">
                                                    Sharing/Slot
                                                </td>
                                                <td
                                                    class="text-stone-900 border border-stone-900 text-[0.65rem] text-right px-1">
                                                    {{ number_format($location->price / 10 / $slots) }}
                                                </td>
                                                <td
                                                    class="text-stone-900 border border-stone-900 text-[0.65rem] text-right px-1">
                                                    {{ number_format(($location->price * (27.5 / 100)) / $slots) }}
                                                </td>
                                                <td
                                                    class="text-stone-900 border border-stone-900 text-[0.65rem] text-right px-1">
                                                    {{ number_format(($location->price * (52.5 / 100)) / $slots) }}
                                                </td>
                                                <td
                                                    class="text-stone-900 border border-stone-900 text-[0.65rem] text-right px-1">
                                                    {{ number_format($location->price / $slots) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="text-stone-900 border border-stone-900 text-[0.65rem] text-center px-1">
                                                    Eksklusif
                                                </td>
                                                <td
                                                    class="text-stone-900 border border-stone-900 text-[0.65rem] text-right px-1">
                                                    {{ number_format($location->price / 10) }}
                                                </td>
                                                <td
                                                    class="text-stone-900 border border-stone-900 text-[0.65rem] text-right px-1">
                                                    {{ number_format($location->price * (27.5 / 100)) }}
                                                </td>
                                                <td
                                                    class="text-stone-900 border border-stone-900 text-[0.65rem] text-right px-1">
                                                    {{ number_format($location->price * (52.5 / 100)) }}
                                                </td>
                                                <td
                                                    class="text-stone-900 border border-stone-900 text-[0.65rem] text-right px-1">
                                                    {{ number_format($location->price) }}
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td
                                                    class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                                    {{ $number++ }}
                                                </td>
                                                <td
                                                    class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                                    {{ $location->code }} -
                                                    {{ $location->city->code }}
                                                </td>
                                                <td class="text-stone-900 border border-stone-900 text-[0.65rem] px-2"
                                                    colspan="2">
                                                    {{ $location->address }}
                                                </td>
                                                <td
                                                    class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                                    {{ $location->media_category->code }}
                                                </td>
                                                <td
                                                    class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
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
                                                <td
                                                    class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                                    {{ (int) filter_var($location->side, FILTER_SANITIZE_NUMBER_INT) }}
                                                </td>
                                                @if ($location->media_category->name == 'Signage')
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                                        {{ $description->qty }}</td>
                                                @else
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                                        1
                                                    </td>
                                                @endif
                                                <td
                                                    class="text-stone-900 border border-stone-900 text-[0.65rem] text-center">
                                                    {{ $location->media_size->size }}
                                                    -
                                                    @if ($location->orientation == 'Vertikal')
                                                        V
                                                    @elseif ($location->orientation == 'Horizontal')
                                                        H
                                                    @endif
                                                </td>
                                                <td
                                                    class="text-stone-900 border border-stone-900 text-[0.65rem] text-right px-1">
                                                    {{ number_format($location->price / 10) }}
                                                </td>
                                                <td
                                                    class="text-stone-900 border border-stone-900 text-[0.65rem] text-right px-1">
                                                    {{ number_format($location->price * (27.5 / 100)) }}
                                                </td>
                                                <td
                                                    class="text-stone-900 border border-stone-900 text-[0.65rem] text-right px-1">
                                                    {{ number_format($location->price * (52.5 / 100)) }}
                                                </td>
                                                <td
                                                    class="text-stone-900 border border-stone-900 text-[0.65rem] text-right px-1">
                                                    {{ number_format($location->price) }}
                                                </td>
                                            </tr>
                                        @endif
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
    </div> --}}
@endsection
