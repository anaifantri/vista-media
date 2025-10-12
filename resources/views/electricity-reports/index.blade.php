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
    $romawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VII', 'IX', 'X', 'XI', 'XII'];
    
    if (fmod(count($electricals), 25) == 0) {
        $pageQty = count($electricals) / 25;
    } else {
        $pageQty = (count($electricals) - fmod(count($electricals), 25)) / 25 + 1;
    }
    
    if (request('rbView')) {
        if (request('rbView') == 'Daya') {
            $reportTitle = 'DAYA';
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
        } elseif (request('rbView') == 'Pascabayar') {
            $reportTitle = 'PEMBAYARAN';
        } else {
            $reportTitle = 'PENGISIAN PULSA';
        }
    } else {
        $reportTitle = 'DAYA';
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
    }
    
    ?>
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex justify-center w-full">
                <div class="w-[1550px]">
                    <div class="flex border-b">
                        <h1 class="index-h1">LIST DATA {{ $reportTitle }} LISTRIK</h1>
                        <div class="flex">
                            @canany(['isAdmin', 'isWorkshop'])
                                @can('isElectricity')
                                    @can('isWorkshopRead')
                                        <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-primary mb-2"
                                            title="Create PDF" type="button">
                                            <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24">
                                                <path
                                                    d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                                            </svg>
                                            <span class="mx-1 text-white">Save PDF</span>
                                        </button>
                                        <button id="btnExportExcel" class="flex justify-center items-center mx-1 btn-success mb-2"
                                            title="Create PDF" type="button">
                                            <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24">
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
                    <form id="formFilter" action="/workshop/electricity-reports">
                        <div class="flex">
                            @if (request('rbView'))
                                @if (request('rbView') == 'Daya')
                                    <div class="w-36">
                                        <span class="text-base text-stone-100">Area</span>
                                        <select class="w-full border rounded-lg text-base text-stone-900 outline-none"
                                            name="area" id="area" onchange="changeArea()"
                                            value="{{ request('area') }}">
                                            <option value="All">All</option>
                                            @foreach ($areas as $area)
                                                @if (request('area') == $area->id)
                                                    <option value="{{ $area->id }}" selected>{{ $area->area }}
                                                    </option>
                                                @else
                                                    <option value="{{ $area->id }}">{{ $area->area }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    @if (request('area') && request('area') != 'All')
                                        <div class="w-full ml-2">
                                            <span class="text-base text-stone-100">Kota</span>
                                            <div class="flex">
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
                                                <div class="ml-2 flex w-full justify-end px-2">
                                                    <span class="text-base text-stone-100">Pilih Data</span>
                                                    <span class="ml-2 text-base text-stone-100">:</span>
                                                    @if (request('rbView'))
                                                        @if (request('rbView') == 'Daya')
                                                            <input type="radio" name="rbView" class="ml-6 outline-none"
                                                                value="Daya" onclick="submit()" checked>
                                                            <span class="ml-2 text-base text-stone-100">Daya Listrik</span>
                                                            <input type="radio" name="rbView" class="ml-6 outline-none"
                                                                value="Pascabayar" onclick="submit()">
                                                            <span class="ml-2 text-base text-stone-100">Pembayaran
                                                                Listrik</span>
                                                            <input type="radio" name="rbView" class="ml-6 outline-none"
                                                                value="Prabayar" onclick="submit()">
                                                            <span class="ml-2 text-base text-stone-100">Pengisian Pulsa
                                                                Listrik</span>
                                                        @elseif (request('rbView') == 'Pascabayar')
                                                            <input type="radio" name="rbView" class="ml-6 outline-none"
                                                                value="Daya" onclick="submit()">
                                                            <span class="ml-2 text-base text-stone-100">Daya Listrik</span>
                                                            <input type="radio" name="rbView" class="ml-6 outline-none"
                                                                value="Pascabayar" onclick="submit()" checked>
                                                            <span class="ml-2 text-base text-stone-100">Pembayaran
                                                                Listrik</span>
                                                            <input type="radio" name="rbView" class="ml-6 outline-none"
                                                                value="Prabayar" onclick="submit()">
                                                            <span class="ml-2 text-base text-stone-100">Pengisian Pulsa
                                                                Listrik</span>
                                                        @else
                                                            <input type="radio" name="rbView" class="ml-6 outline-none"
                                                                value="Daya" onclick="submit()">
                                                            <span class="ml-2 text-base text-stone-100">Daya Listrik</span>
                                                            <input type="radio" name="rbView" class="ml-6 outline-none"
                                                                value="Pascabayar" onclick="submit()">
                                                            <span class="ml-2 text-base text-stone-100">Pembayaran
                                                                Listrik</span>
                                                            <input type="radio" name="rbView"
                                                                class="ml-6 outline-none" value="Prabayar"
                                                                onclick="submit()" checked>
                                                            <span class="ml-2 text-base text-stone-100">Pengisian Pulsa
                                                                Listrik</span>
                                                        @endif
                                                    @else
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Daya" onclick="submit()" checked>
                                                        <span class="ml-2 text-base text-stone-100">Daya Listrik</span>
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Pascabayar" onclick="submit()">
                                                        <span class="ml-2 text-base text-stone-100">Pembayaran
                                                            Listrik</span>
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Prabayar" onclick="submit()">
                                                        <span class="ml-2 text-base text-stone-100">Pengisian Pulsa
                                                            Listrik</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="w-full ml-2">
                                            <span class="text-base text-stone-100">Kota</span>
                                            <div class="flex">
                                                <select id="city" name="city"
                                                    class="flex text-base text-stone-900 w-36 border rounded-lg px-1 outline-none"
                                                    type="text" value="{{ request('city') }}" onchange="submit()"
                                                    disabled>
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
                                                <div class="ml-2 flex w-full justify-end px-2">
                                                    <span class="text-base text-stone-100">Pilih Data</span>
                                                    <span class="ml-2 text-base text-stone-100">:</span>
                                                    @if (request('rbView'))
                                                        @if (request('rbView') == 'Daya')
                                                            <input type="radio" name="rbView"
                                                                class="ml-6 outline-none" value="Daya"
                                                                onclick="submit()" checked>
                                                            <span class="ml-2 text-base text-stone-100">Daya Listrik</span>
                                                            <input type="radio" name="rbView"
                                                                class="ml-6 outline-none" value="Pascabayar"
                                                                onclick="submit()">
                                                            <span class="ml-2 text-base text-stone-100">Pembayaran
                                                                Listrik</span>
                                                            <input type="radio" name="rbView"
                                                                class="ml-6 outline-none" value="Prabayar"
                                                                onclick="submit()">
                                                            <span class="ml-2 text-base text-stone-100">Pengisian Pulsa
                                                                Listrik</span>
                                                        @elseif (request('rbView') == 'Pascabayar')
                                                            <input type="radio" name="rbView"
                                                                class="ml-6 outline-none" value="Daya"
                                                                onclick="submit()">
                                                            <span class="ml-2 text-base text-stone-100">Daya Listrik</span>
                                                            <input type="radio" name="rbView"
                                                                class="ml-6 outline-none" value="Pascabayar"
                                                                onclick="submit()" checked>
                                                            <span class="ml-2 text-base text-stone-100">Pembayaran
                                                                Listrik</span>
                                                            <input type="radio" name="rbView"
                                                                class="ml-6 outline-none" value="Prabayar"
                                                                onclick="submit()">
                                                            <span class="ml-2 text-base text-stone-100">Pengisian Pulsa
                                                                Listrik</span>
                                                        @else
                                                            <input type="radio" name="rbView"
                                                                class="ml-6 outline-none" value="Daya"
                                                                onclick="submit()">
                                                            <span class="ml-2 text-base text-stone-100">Daya Listrik</span>
                                                            <input type="radio" name="rbView"
                                                                class="ml-6 outline-none" value="Pascabayar"
                                                                onclick="submit()">
                                                            <span class="ml-2 text-base text-stone-100">Pembayaran
                                                                Listrik</span>
                                                            <input type="radio" name="rbView"
                                                                class="ml-6 outline-none" value="Prabayar"
                                                                onclick="submit()" checked>
                                                            <span class="ml-2 text-base text-stone-100">Pengisian Pulsa
                                                                Listrik</span>
                                                        @endif
                                                    @else
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Daya" onclick="submit()" checked>
                                                        <span class="ml-2 text-base text-stone-100">Daya Listrik</span>
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Pascabayar" onclick="submit()">
                                                        <span class="ml-2 text-base text-stone-100">Pembayaran
                                                            Listrik</span>
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Prabayar" onclick="submit()">
                                                        <span class="ml-2 text-base text-stone-100">Pengisian Pulsa
                                                            Listrik</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="ml-2 w-32">
                                        <span class="text-base text-stone-100">Bulan</span>
                                        <select name="month"
                                            class="p-1 outline-none border w-full text-sm text-stone-900 rounded-md bg-stone-100"
                                            onchange="submit()">
                                            @if (request('month'))
                                                @for ($i = 1; $i < 13; $i++)
                                                    @if ($i == request('month'))
                                                        <option value="{{ $i }}" selected>
                                                            {{ $bulan_full[$i] }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $i }}">{{ $bulan_full[$i] }}
                                                        </option>
                                                    @endif
                                                @endfor
                                            @else
                                                @for ($i = 1; $i < 13; $i++)
                                                    @if ($i == date('m'))
                                                        <option value="{{ $i }}" selected>
                                                            {{ $bulan_full[$i] }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $i }}">{{ $bulan_full[$i] }}
                                                        </option>
                                                    @endif
                                                @endfor
                                            @endif
                                        </select>
                                    </div>
                                    <div class="ml-2 w-full">
                                        <span class="text-base text-stone-100">Tahun</span>
                                        <div class="flex items-center">
                                            <select name="year"
                                                class="p-1 text-center outline-none border w-20 text-sm text-stone-900 rounded-md bg-stone-100"
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
                                            <div class="ml-2 flex w-full justify-end px-2">
                                                <span class="text-base text-stone-100">Pilih Data</span>
                                                <span class="ml-2 text-base text-stone-100">:</span>
                                                @if (request('rbView'))
                                                    @if (request('rbView') == 'Daya')
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Daya" onclick="submit()" checked>
                                                        <span class="ml-2 text-base text-stone-100">Daya Listrik</span>
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Pascabayar" onclick="submit()">
                                                        <span class="ml-2 text-base text-stone-100">Pembayaran
                                                            Listrik</span>
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Prabayar" onclick="submit()">
                                                        <span class="ml-2 text-base text-stone-100">Pengisian Pulsa
                                                            Listrik</span>
                                                    @elseif (request('rbView') == 'Pascabayar')
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Daya" onclick="submit()">
                                                        <span class="ml-2 text-base text-stone-100">Daya Listrik</span>
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Pascabayar" onclick="submit()" checked>
                                                        <span class="ml-2 text-base text-stone-100">Pembayaran
                                                            Listrik</span>
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Prabayar" onclick="submit()">
                                                        <span class="ml-2 text-base text-stone-100">Pengisian Pulsa
                                                            Listrik</span>
                                                    @else
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Daya" onclick="submit()">
                                                        <span class="ml-2 text-base text-stone-100">Daya Listrik</span>
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Pascabayar" onclick="submit()">
                                                        <span class="ml-2 text-base text-stone-100">Pembayaran
                                                            Listrik</span>
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Prabayar" onclick="submit()" checked>
                                                        <span class="ml-2 text-base text-stone-100">Pengisian Pulsa
                                                            Listrik</span>
                                                    @endif
                                                @else
                                                    <input type="radio" name="rbView" class="ml-6 outline-none"
                                                        value="Daya" onclick="submit()" checked>
                                                    <span class="ml-2 text-base text-stone-100">Daya Listrik</span>
                                                    <input type="radio" name="rbView" class="ml-6 outline-none"
                                                        value="Pascabayar" onclick="submit()">
                                                    <span class="ml-2 text-base text-stone-100">Pembayaran
                                                        Listrik</span>
                                                    <input type="radio" name="rbView" class="ml-6 outline-none"
                                                        value="Prabayar" onclick="submit()">
                                                    <span class="ml-2 text-base text-stone-100">Pengisian Pulsa
                                                        Listrik</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="w-36">
                                    <span class="text-base text-stone-100">Area</span>
                                    <select class="w-full border rounded-lg text-base text-stone-900 outline-none"
                                        name="area" id="area" onchange="changeArea()"
                                        value="{{ request('area') }}">
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
                                    <div class="w-full ml-2">
                                        <span class="text-base text-stone-100">Kota</span>
                                        <div class="flex">
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
                                            <div class="ml-2 flex w-full justify-end px-2">
                                                <span class="text-base text-stone-100">Pilih Data</span>
                                                <span class="ml-2 text-base text-stone-100">:</span>
                                                @if (request('rbView'))
                                                    @if (request('rbView') == 'Daya')
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Daya" onclick="submit()" checked>
                                                        <span class="ml-2 text-base text-stone-100">Daya Listrik</span>
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Pascabayar" onclick="submit()">
                                                        <span class="ml-2 text-base text-stone-100">Pembayaran
                                                            Listrik</span>
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Prabayar" onclick="submit()">
                                                        <span class="ml-2 text-base text-stone-100">Pengisian Pulsa
                                                            Listrik</span>
                                                    @elseif (request('rbView') == 'Pascabayar')
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Daya" onclick="submit()">
                                                        <span class="ml-2 text-base text-stone-100">Daya Listrik</span>
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Pascabayar" onclick="submit()" checked>
                                                        <span class="ml-2 text-base text-stone-100">Pembayaran
                                                            Listrik</span>
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Prabayar" onclick="submit()">
                                                        <span class="ml-2 text-base text-stone-100">Pengisian Pulsa
                                                            Listrik</span>
                                                    @else
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Daya" onclick="submit()">
                                                        <span class="ml-2 text-base text-stone-100">Daya Listrik</span>
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Pascabayar" onclick="submit()">
                                                        <span class="ml-2 text-base text-stone-100">Pembayaran
                                                            Listrik</span>
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Prabayar" onclick="submit()" checked>
                                                        <span class="ml-2 text-base text-stone-100">Pengisian Pulsa
                                                            Listrik</span>
                                                    @endif
                                                @else
                                                    <input type="radio" name="rbView" class="ml-6 outline-none"
                                                        value="Daya" onclick="submit()" checked>
                                                    <span class="ml-2 text-base text-stone-100">Daya Listrik</span>
                                                    <input type="radio" name="rbView" class="ml-6 outline-none"
                                                        value="Pascabayar" onclick="submit()">
                                                    <span class="ml-2 text-base text-stone-100">Pembayaran
                                                        Listrik</span>
                                                    <input type="radio" name="rbView" class="ml-6 outline-none"
                                                        value="Prabayar" onclick="submit()">
                                                    <span class="ml-2 text-base text-stone-100">Pengisian Pulsa
                                                        Listrik</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="w-full ml-2">
                                        <span class="text-base text-stone-100">Kota</span>
                                        <div class="flex">
                                            <select id="city" name="city"
                                                class="flex text-base text-stone-900 w-36 border rounded-lg px-1 outline-none"
                                                type="text" value="{{ request('city') }}" onchange="submit()"
                                                disabled>
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
                                            <div class="ml-2 flex w-full justify-end px-2">
                                                <span class="text-base text-stone-100">Pilih Data</span>
                                                <span class="ml-2 text-base text-stone-100">:</span>
                                                @if (request('rbView'))
                                                    @if (request('rbView') == 'Daya')
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Daya" onclick="submit()" checked>
                                                        <span class="ml-2 text-base text-stone-100">Daya Listrik</span>
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Pascabayar" onclick="submit()">
                                                        <span class="ml-2 text-base text-stone-100">Pembayaran
                                                            Listrik</span>
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Prabayar" onclick="submit()">
                                                        <span class="ml-2 text-base text-stone-100">Pengisian Pulsa
                                                            Listrik</span>
                                                    @elseif (request('rbView') == 'Pascabayar')
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Daya" onclick="submit()">
                                                        <span class="ml-2 text-base text-stone-100">Daya Listrik</span>
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Pascabayar" onclick="submit()" checked>
                                                        <span class="ml-2 text-base text-stone-100">Pembayaran
                                                            Listrik</span>
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Prabayar" onclick="submit()">
                                                        <span class="ml-2 text-base text-stone-100">Pengisian Pulsa
                                                            Listrik</span>
                                                    @else
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Daya" onclick="submit()">
                                                        <span class="ml-2 text-base text-stone-100">Daya Listrik</span>
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Pascabayar" onclick="submit()">
                                                        <span class="ml-2 text-base text-stone-100">Pembayaran
                                                            Listrik</span>
                                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                                            value="Prabayar" onclick="submit()" checked>
                                                        <span class="ml-2 text-base text-stone-100">Pengisian Pulsa
                                                            Listrik</span>
                                                    @endif
                                                @else
                                                    <input type="radio" name="rbView" class="ml-6 outline-none"
                                                        value="Daya" onclick="submit()" checked>
                                                    <span class="ml-2 text-base text-stone-100">Daya Listrik</span>
                                                    <input type="radio" name="rbView" class="ml-6 outline-none"
                                                        value="Pascabayar" onclick="submit()">
                                                    <span class="ml-2 text-base text-stone-100">Pembayaran
                                                        Listrik</span>
                                                    <input type="radio" name="rbView" class="ml-6 outline-none"
                                                        value="Prabayar" onclick="submit()">
                                                    <span class="ml-2 text-base text-stone-100">Pengisian Pulsa
                                                        Listrik</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="flex justify-center w-full">
                <div id="pdfPreview">
                    @if (count($electricals) == 0)
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
                                            <label class="text-lg text-center font-bold">LIST DATA {{ $reportTitle }}
                                                LISTRIK</label>
                                        </div>
                                        <div class="flex justify-center w-96">
                                            <label class="text-sm text-center"></label>
                                        </div>
                                        <div class="flex justify-center w-96 border rounded-md">
                                            @if (request('month'))
                                                <label class="month-report text-xl font-semibold text-center">
                                                    {{ $bulan_full[(int) request('month')] }} {{ request('year') }}
                                                </label>
                                            @else
                                                <label class="month-report text-xl font-semibold text-center">
                                                    {{ $bulan_full[(int) date('m')] }} {{ date('Y') }}
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
                                @if (request('rbView'))
                                    @if (request('rbView') == 'Daya')
                                        @if (request('area') && request('area') != 'All')
                                            @if (request('city') && request('city') != 'All')
                                                <label class="flex text-base text-red-600 font-serif tracking-wider">
                                                    ~~ Tidak ada data {{ $reportTitle }} listrik untuk area
                                                    {{ $getArea->area }} kota {{ $getCity->city }} ~~
                                                </label>
                                            @else
                                                <label class="flex text-base text-red-600 font-serif tracking-wider">
                                                    ~~ Tidak ada data {{ $reportTitle }} listrik untuk area
                                                    {{ $getArea->area }} ~~
                                                </label>
                                            @endif
                                        @else
                                            <label class="flex text-base text-red-600 font-serif tracking-wider">
                                                ~~ Tidak ada data {{ $reportTitle }} listrik ~~
                                            </label>
                                        @endif
                                    @else
                                        @if (request('month'))
                                            <label class="flex text-base text-red-600 font-serif tracking-wider">
                                                ~~ Tidak ada data {{ $reportTitle }} listrik pada bulan
                                                {{ $bulan_full[(int) request('month')] }} {{ request('year') }} ~~
                                            </label>
                                        @else
                                            <label class="flex text-base text-red-600 font-serif tracking-wider">
                                                ~~ Tidak ada data {{ $reportTitle }} listrik
                                                {{ $bulan[(int) date('m')] }}
                                                {{ date('Y') }} ~~
                                            </label>
                                        @endif
                                    @endif
                                @else
                                    @if (request('area') && request('area') != 'All')
                                        @if (request('city') && request('city') != 'All')
                                            <label class="flex text-base text-red-600 font-serif tracking-wider">
                                                ~~ Tidak ada data {{ $reportTitle }} listrik untuk area
                                                {{ request('area') }} kota {{ request('city') }} ~~
                                            </label>
                                        @else
                                            <label class="flex text-base text-red-600 font-serif tracking-wider">
                                                ~~ Tidak ada data {{ $reportTitle }} listrik untuk area
                                                {{ request('area') }} ~~
                                            </label>
                                        @endif
                                    @else
                                        <label class="flex text-base text-red-600 font-serif tracking-wider">
                                            ~~ Tidak ada data {{ $reportTitle }} listrik ~~
                                        </label>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @else
                        @for ($i = 0; $i < $pageQty; $i++)
                            @if (request('rbView'))
                                @if (request('rbView') == 'Daya')
                                    @include('electricity-reports.electrical-power')
                                @else
                                    @include('electricity-reports.payments-topups')
                                @endif
                            @else
                                @include('electricity-reports.electrical-power')
                            @endif
                        @endfor
                    @endif
                </div>
            </div>
        </div>
    </div>

    <table id="exportExcelTable" class="table-auto w-full mt-4" hidden>
        @if (request('rbView'))
            @if (request('rbView') == 'Daya')
                @include('electricity-reports.electrical-table')
            @else
                @include('electricity-reports.payment-table')
            @endif
        @else
            @include('electricity-reports.electrical-table')
        @endif
    </table>
    @if (request('month') && request('month') != 'All')
        <input id="saveName" type="text"
            value="LIST {{ $reportTitle }} LISTRIK - {{ $bulan_full[request('month')] }} {{ request('year') }}" hidden>
    @else
        <input id="saveName" type="text" value="LIST {{ $reportTitle }} LISTRIK TAHUN {{ date('Y') }}" hidden>
    @endif


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
                    filename: "List Data {{ $reportTitle }} Listrik.xls"
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
