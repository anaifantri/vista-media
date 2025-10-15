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
        if (fmod(count($electricity_payments), 25) == 0) {
            $pageQty = count($electricity_payments) / 25;
        } else {
            $pageQty = (count($electricity_payments) - fmod(count($electricity_payments), 25)) / 25 + 1;
        }
    @endphp
    <!-- Container start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex p-1 w-full border-b">
                <!-- Title start -->
                <h1 class="index-h1">DAFTAR PEMBAYARAN TAGIHAN LISTRIK</h1>
                <div class="flex items-center w-full justify-end">
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
                <!-- Title end -->
            </div>
            <div>
                <!-- Form search start -->
                <form action="/workshop/electricity-reports/payment">
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
                            <span class="text-base text-stone-100">Bulan</span>
                            <select name="month"
                                class="outline-none border w-full text-base text-stone-900 rounded-md bg-stone-100"
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
            <!-- View start -->
            <div id="pdfPreview">
                @if (count($electricity_payments) == 0)
                    <div class="w-[1550px] h-[980px] bg-white p-8">
                        <div class="flex items-center border rounded-lg p-2 mt-6">
                            <div class="w-44">
                                <img class="ml-2 w-[125px]" src="{{ asset('storage/' . $company->logo) }}" alt="">
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
                                        <label class="text-lg text-center font-bold">LIST DATA PEMBAYARAN LISTRIK</label>
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
                            @if (request('month'))
                                <label class="flex text-base text-red-600 font-serif tracking-wider">
                                    ~~ Tidak ada data pembayaran listrik pada bulan
                                    {{ $bulan_full[(int) request('month')] }} {{ request('year') }} ~~
                                </label>
                            @else
                                <label class="flex text-base text-red-600 font-serif tracking-wider">
                                    ~~ Tidak ada data pembayaran listrik
                                    {{ $bulan[(int) date('m')] }}
                                    {{ date('Y') }} ~~
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
                                            <label class="text-5xl text-center font-bold">-</label>
                                        </div>
                                        <div class="flex justify-center w-96">
                                            <label class="text-lg text-center font-bold">LIST DATA PEMBAYARAN
                                                LISTRIK</label>
                                        </div>
                                        <div class="flex justify-center w-96">
                                            <label class="text-sm text-center"></label>
                                        </div>
                                        <div class="flex justify-center w-96 border rounded-md">
                                            @if (request('month'))
                                                <label class="month-report text-xl font-semibold text-center">
                                                    {{ $bulan_full[(int) request('month')] }}
                                                    {{ request('year') }}
                                                </label>
                                            @else
                                                <label class="month-report text-xl font-semibold text-center">
                                                    {{ $bulan_full[(int) date('m')] }} {{ date('Y') }}
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
                            <div class="h-[680px]">
                                <table class="table-auto w-full mt-4">
                                    <thead>
                                        <tr>
                                            <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center"
                                                rowspan="2">No</th>
                                            <th class="text-stone-900 border border-stone-900 w-36 text-sm text-center"
                                                rowspan="2">
                                                <button class="flex justify-center items-center w-36">@sortablelink('id_number', 'ID Pelanggan')
                                                    <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24">
                                                        <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                                    </svg>
                                                </button>
                                            </th>
                                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-40"
                                                rowspan="2">Nama</th>
                                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-14"
                                                rowspan="2">Daya</th>
                                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-[72px]"
                                                rowspan="2">Area</th>
                                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-[72px]"
                                                rowspan="2">Kota</th>
                                            <th class="text-stone-900 border border-stone-900 text-sm text-center"
                                                rowspan="2">
                                                Lokasi</th>
                                            <th class="text-stone-900 border border-stone-900 text-sm text-center"
                                                colspan="3">
                                                Data Pembayaran Tagihan Listrik
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-28">
                                                Tagihan Bulan</th>
                                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-28">
                                                Tgl. Bayar</th>
                                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-32">
                                                Nominal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($electricity_payments as $electrical)
                                            @if ($loop->iteration > $indexPage * 25 && $loop->iteration < ($indexPage + 1) * 25 + 1)
                                                <tr>
                                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        {{ $loop->iteration }}</td>
                                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        {{ $electrical->electrical_power->id_number }}
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
                                                        {{ $electrical->electrical_power->name }}
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
                                                        {{ number_format($electrical->electrical_power->power) }}
                                                    </td>
                                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        {{ $electrical->electrical_power->area->area }}
                                                    </td>
                                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        {{ $electrical->electrical_power->city->city }}
                                                    </td>
                                                    <td class="text-stone-900 border border-stone-900 text-sm px-1">
                                                        <div>
                                                            @if (count($electrical->electrical_power->locations) > 0)
                                                                @foreach ($electrical->electrical_power->locations as $location)
                                                                    <span class="flex">
                                                                        {{ $location->code }} |
                                                                        {{ $location->address }}
                                                                    </span>
                                                                @endforeach
                                                            @else
                                                                -
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        {{ $bulan_full[(int) date('m', strtotime($electrical->bill_date))] }}
                                                    </td>
                                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                                        {{ date('d', strtotime($electrical->payment_date)) }}-{{ $bulan[(int) date('m', strtotime($electrical->payment_date))] }}-{{ date('Y', strtotime($electrical->payment_date)) }}
                                                    </td>
                                                    <td
                                                        class="text-stone-900 border border-stone-900 text-sm text-right px-2">
                                                        {{ number_format($electrical->payment) }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td class="text-stone-900 border border-stone-900 text-sm text-right font-semibold px-2"
                                                colspan="9">
                                                TOTAL</td>
                                            <td
                                                class="text-stone-900 border border-stone-900 text-sm text-right font-semibold px-2">
                                                {{ number_format($electricity_payments->sum('payment')) }}
                                            </td>
                                        </tr>
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
                    <tr class="bg-stone-400">
                        <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center" rowspan="2">No</th>
                        <th class="text-stone-900 border border-stone-900 w-36 text-sm text-center" rowspan="2">
                            <button class="flex justify-center items-center w-36">@sortablelink('id_number', 'ID Pelanggan')
                                <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                </svg>
                            </button>
                        </th>
                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-40" rowspan="2">Nama
                        </th>
                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-14" rowspan="2">Daya
                        </th>
                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-[72px]" rowspan="2">
                            Area</th>
                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-[72px]" rowspan="2">
                            Kota</th>
                        <th class="text-stone-900 border border-stone-900 text-sm text-center" rowspan="2">
                            Lokasi</th>
                        <th class="text-stone-900 border border-stone-900 text-sm text-center" colspan="3">
                            Data Pembayaran Tagihan Listrik
                        </th>
                    </tr>
                    <tr class="bg-stone-400">
                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-28">
                            Tagihan Bulan</th>
                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-28">
                            Tgl. Bayar</th>
                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-32">
                            Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($electricity_payments as $electrical)
                        <tr>
                            <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                {{ $loop->iteration }}</td>
                            <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                '{{ $electrical->electrical_power->id_number }}
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
                                {{ $electrical->electrical_power->name }}
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
                                {{ $electrical->electrical_power->power }}
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                {{ $electrical->electrical_power->area->area }}
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                {{ $electrical->electrical_power->city->city }}
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-sm px-1">
                                <div>
                                    @if (count($electrical->electrical_power->locations) > 0)
                                        @foreach ($electrical->electrical_power->locations as $location)
                                            <span class="flex">
                                                {{ $location->code }} |
                                                {{ $location->address }}
                                            </span>
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </div>
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                {{ $bulan_full[(int) date('m', strtotime($electrical->bill_date))] }}
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                {{ date('d', strtotime($electrical->payment_date)) }}-{{ $bulan[(int) date('m', strtotime($electrical->payment_date))] }}-{{ date('Y', strtotime($electrical->payment_date)) }}
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-sm text-right px-2">
                                {{ number_format($electrical->payment) }}
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="text-stone-900 border border-stone-900 text-sm text-right font-semibold px-2"
                            colspan="9">
                            TOTAL</td>
                        <td class="text-stone-900 border border-stone-900 text-sm text-right font-semibold px-2">
                            {{ number_format($electricity_payments->sum('payment')) }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- View end -->
        </div>
    </div>

    @if (request('month'))
        <input id="saveName" type="text"
            value="LIST PEMBAYARAN LISTRIK - {{ $bulan_full[(int) request('month')] }} - {{ request('year') }}" hidden>
    @else
        <input id="saveName" type="text"
            value="LIST PEMBAYARAN LISTRIK - {{ $bulan_full[(int) date('m')] }} - {{ date('Y') }}" hidden>
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
                    filename: "List Data Pembayaran Listrik.xls"
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
