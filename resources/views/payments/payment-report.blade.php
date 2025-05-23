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
    $qty = 0;
    $index = 0;
    foreach ($payments as $payment) {
        foreach ($payment->billings as $itemBilling) {
            $descriptions = json_decode($itemBilling->invoice_content)->description;
            foreach ($descriptions as $description) {
                $qty++;
            }
        }
    }
    if (fmod($qty, 25) == 0) {
        $pageQty = $qty / 25;
    } else {
        $pageQty = ($qty - fmod($qty, 25)) / 25 + 1;
    }
    ?>
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex justify-center w-full">
                <div class="w-[1550px]">
                    <div class="flex border-b">
                        <h1 class="index-h1">LAPORAN KAS MASUK</h1>
                        <div class="flex">
                            @canany(['isAdmin', 'isAccounting'])
                                @can('isCollect')
                                    @can('isAccountingRead')
                                        <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-primary mb-2"
                                            title="Create PDF" type="button">
                                            <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24">
                                                <path
                                                    d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                                            </svg>
                                            <span class="mx-1 text-white">Save PDF</span>
                                        </button>
                                    @endcan
                                @endcan
                            @endcanany
                        </div>
                    </div>
                    <form id="formFilter" action="/payments/report/{{ $company->id }}">
                        <div class="flex">
                            <div class="flex h-14">
                                <div class="w-24">
                                    <span class="text-base text-stone-100">Bulan</span>
                                    <select name="month"
                                        class="p-1 outline-none border w-full text-sm text-stone-900 rounded-md bg-stone-100"
                                        onchange="submit()">
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
                                                @if ($i == date('m'))
                                                    <option value="{{ $i }}" selected>{{ $bulan_full[$i] }}
                                                    </option>
                                                @endif
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
                </div>
            </div>
            <div class="flex justify-center w-full">
                <div id="pdfPreview">
                    @if ($qty == 0)
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
                                        <div class="flex justify-center w-56">
                                            <label class="text-5xl text-center font-bold">B</label>
                                        </div>
                                        <div class="flex justify-center w-56">
                                            <label class="text-lg text-center font-bold">LAPORAN KAS MASUK</label>
                                        </div>
                                        <div class="flex justify-center w-56">
                                            <label class="text-sm text-center"></label>
                                        </div>
                                        <div class="flex justify-center w-56 border rounded-md">
                                            @if (request('month'))
                                                <label class="month-report text-xl font-semibold text-center">
                                                    {{ $bulan_full[request('month')] }}
                                                    {{ request('year') }}
                                                </label>
                                            @else
                                                <label
                                                    class="month-report text-xl font-semibold text-center">{{ $bulan_full[(int) date('m')] }}
                                                    {{ date('Y') }}</label>
                                            @endif
                                        </div>
                                        <div class="flex justify-center w-56 border rounded-md mt-2">
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
                                @if (request('month'))
                                    <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak ada data
                                        kas
                                        masuk pada bulan
                                        {{ $bulan_full[request('month')] }}
                                        {{ request('year') }} ~~
                                    </label>
                                @else
                                    <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak ada data
                                        kas
                                        masuk pada bulan
                                        {{ $bulan_full[(int) date('m')] }}
                                        {{ request('year') }} ~~
                                    </label>
                                @endif
                            </div>
                        </div>
                    @else
                        @for ($i = 0; $i < $pageQty; $i++)
                            @if ($i == $pageQty - 1)
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
                                                <div class="flex justify-center w-56">
                                                    <label class="text-5xl text-center font-bold">B</label>
                                                </div>
                                                <div class="flex justify-center w-56">
                                                    <label class="text-lg text-center font-bold">LAPORAN KAS MASUK</label>
                                                </div>
                                                <div class="flex justify-center w-56">
                                                    <label class="text-sm text-center"></label>
                                                </div>
                                                <div class="flex justify-center w-56 border rounded-md">
                                                    @if (request('month'))
                                                        <label class="month-report text-xl font-semibold text-center">
                                                            {{ $bulan_full[request('month')] }}
                                                            {{ request('year') }}
                                                        </label>
                                                    @else
                                                        <label
                                                            class="month-report text-xl font-semibold text-center">{{ $bulan_full[(int) date('m')] }}
                                                            {{ date('Y') }}</label>
                                                    @endif
                                                </div>
                                                <div class="flex justify-center w-56 border rounded-md mt-2">
                                                    <label class="text-sm">
                                                        <span class="text-sm font-semibold text-red-600">Tgl. Cetak :
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
                                                <tr class="bg-stone-200 h-8">
                                                    <th class="text-stone-900 border border-black text-sm w- text-center">
                                                        No.</th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-24">
                                                        Tgl. Bayar
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-44">
                                                        Klien
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-52">
                                                        Nomor Invoice
                                                    </th>
                                                    <th class="text-stone-900 border border-black text-sm text-center">
                                                        Deskripsi Pekerjaan
                                                    </th>
                                                    <th class="text-stone-900 border border-black text-sm text-center">
                                                        Lokasi
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-28">
                                                        Nilai Invoice
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-28">
                                                        Kas Masuk
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-24">
                                                        Sisa Tagihan
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $index = 0;
                                                    $number = 0;
                                                @endphp
                                                @foreach ($payments as $payment)
                                                    @php
                                                        $client = json_decode($payment->billings[0]->client);
                                                        $number++;
                                                        $totalSales = 0;
                                                        $totalBilling = 0;
                                                    @endphp
                                                    @foreach ($payment->billings as $itemBilling)
                                                        @php
                                                            $descriptions = json_decode($itemBilling->invoice_content)
                                                                ->description;
                                                            $descriptionNumber = 0;
                                                            $totalPayment = $itemBilling->bill_payments->sum('nominal');
                                                            $totalBilling =
                                                                $totalBilling +
                                                                ($itemBilling->nominal +
                                                                    $itemBilling->ppn -
                                                                    ($itemBilling->nominal * 2) / 100);
                                                        @endphp
                                                        @foreach ($descriptions as $description)
                                                            @php
                                                                $index++;
                                                                $descriptionNumber++;
                                                            @endphp
                                                            @if ($index > $i * 25 && $index < ($i + 1) * 25 + 1)
                                                                @if ($descriptionNumber == 1)
                                                                    <tr class="h-[25px]">
                                                                        <td
                                                                            class="text-stone-900 px-1 border border-black text-sm align-top text-center">
                                                                            {{ $number }}
                                                                        </td>
                                                                        <td
                                                                            class="text-stone-900 px-1 border border-black text-sm align-top text-center">
                                                                            {{ date('d', strtotime($payment->created_at)) }}-{{ $bulan[(int) date('m', strtotime($payment->created_at))] }}-{{ date('Y', strtotime($payment->created_at)) }}
                                                                        </td>
                                                                        <td
                                                                            class="text-stone-900 border border-black text-sm px-1 align-top">
                                                                            @if (strlen($client->company) > 20)
                                                                                {{ substr($client->company, 0, 20) }}..
                                                                            @else
                                                                                {{ $client->company }}
                                                                            @endif
                                                                        </td>
                                                                        <td
                                                                            class="text-stone-900 px-1 border border-black text-sm align-top">
                                                                            <a
                                                                                href="/accounting/billings/{{ $itemBilling->id }}">{{ $itemBilling->invoice_number }}</a>
                                                                        </td>
                                                                        <td
                                                                            class="text-stone-900 px-1 border border-black text-sm">
                                                                            @if (isset(json_decode($itemBilling->invoice_content)->manual_detail))
                                                                                @if (strlen(json_decode($itemBilling->invoice_content)->manual_detail[0]->title) > 50)
                                                                                    {{ substr(json_decode($itemBilling->invoice_content)->manual_detail[0]->title, 5, 50) }}
                                                                                @else
                                                                                    {{ json_decode($itemBilling->invoice_content)->manual_detail[0]->title }}
                                                                                @endif
                                                                            @else
                                                                                @if (strlen($description->title) > 50)
                                                                                    {{ substr($description->title, 5, 50) }}
                                                                                @else
                                                                                    {{ $description->title }}
                                                                                @endif
                                                                            @endif
                                                                        </td>
                                                                        <td
                                                                            class="text-stone-900 px-1 border border-black text-sm">
                                                                            @if (strlen($description->location) > 45)
                                                                                {{ substr($description->location, 0, 45) }}..
                                                                            @else
                                                                                {{ $description->location }}
                                                                            @endif
                                                                        </td>
                                                                        <td
                                                                            class="text-stone-900 bg-teal-50 px-1 border border-black text-sm text-right align-top">
                                                                            {{ number_format($description->nominal) }}
                                                                        </td>
                                                                        <td
                                                                            class="text-stone-900 px-1 bg-yellow-50 border border-black text-sm align-top text-right">
                                                                            {{ number_format($payment->nominal) }}
                                                                        </td>
                                                                        <td
                                                                            class="text-stone-900 px-1 border border-black text-sm bg-red-50 align-top text-right">
                                                                            @if ($totalPayment >= $totalBilling)
                                                                                <span
                                                                                    class="flex w-full justify-center">LUNAS</span>
                                                                            @else
                                                                                {{ number_format($totalBilling - $totalPayment) }}
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @else
                                                                    <tr class="h-[25px]">
                                                                        <td
                                                                            class="text-stone-900 px-1 border border-black text-sm align-top text-center">
                                                                        </td>
                                                                        <td
                                                                            class="text-stone-900 px-1 border border-black text-sm align-top text-center">
                                                                        </td>
                                                                        <td
                                                                            class="text-stone-900 border border-black text-sm px-1 align-top">
                                                                        </td>
                                                                        <td
                                                                            class="text-stone-900 px-1 border border-black text-sm text-center align-top">
                                                                        </td>
                                                                        <td
                                                                            class="text-stone-900 px-1 border border-black text-sm">
                                                                            @if (strlen($description->title) > 50)
                                                                                {{ substr($description->title, 5, 50) }}
                                                                            @else
                                                                                {{ $description->title }}
                                                                            @endif
                                                                        </td>
                                                                        <td
                                                                            class="text-stone-900 px-1 border border-black text-sm">
                                                                            @if (strlen($description->location) > 45)
                                                                                {{ substr($description->location, 0, 45) }}..
                                                                            @else
                                                                                {{ $description->location }}
                                                                            @endif
                                                                        </td>
                                                                        <td
                                                                            class="text-stone-900 bg-teal-50 px-1 border border-black text-sm text-right align-top">
                                                                            {{ number_format($description->nominal) }}
                                                                        </td>
                                                                        <td
                                                                            class="text-stone-900 px-1 bg-yellow-50 border border-black text-sm align-top text-right">
                                                                        </td>
                                                                        <td
                                                                            class="text-stone-900 px-1 border border-black text-sm bg-red-50 align-top text-right">
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                                <tr class="h-[25px]">
                                                    <td class="text-stone-900 px-1 border border-black text-sm bg-red-50 align-top text-right font-semibold"
                                                        colspan="6">Total Kas Masuk</td>
                                                    <td
                                                        class="text-stone-900 px-1 border border-black text-sm bg-red-50 align-top text-right font-semibold">
                                                        {{ number_format($billing_total) }}
                                                    </td>
                                                    <td
                                                        class="text-stone-900 px-1 border border-black text-sm bg-red-50 align-top text-right font-semibold">
                                                        {{ number_format($payments->sum('nominal')) }}
                                                    </td>
                                                    <td
                                                        class="text-stone-900 px-1 border border-black text-sm align-top text-right bg-slate-200">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="flex items-end justify-end mt-1 text-black">
                                        <label for="">Halaman {{ $i + 1 }} dari
                                            {{ $pageQty }}</label>
                                    </div>
                                </div>
                            @else
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
                                                <div class="flex justify-center w-56">
                                                    <label class="text-5xl text-center font-bold">B</label>
                                                </div>
                                                <div class="flex justify-center w-56">
                                                    <label class="text-lg text-center font-bold">LAPORAN KAS MASUK</label>
                                                </div>
                                                <div class="flex justify-center w-56">
                                                    <label class="text-sm text-center"></label>
                                                </div>
                                                <div class="flex justify-center w-56 border rounded-md">
                                                    @if (request('month'))
                                                        <label class="month-report text-xl font-semibold text-center">
                                                            {{ $bulan_full[request('month')] }}
                                                            {{ request('year') }}
                                                        </label>
                                                    @else
                                                        <label
                                                            class="month-report text-xl font-semibold text-center">{{ $bulan_full[(int) date('m')] }}
                                                            {{ date('Y') }}</label>
                                                    @endif
                                                </div>
                                                <div class="flex justify-center w-56 border rounded-md mt-2">
                                                    <label class="text-sm">
                                                        <span class="text-sm font-semibold text-red-600">Tgl. Cetak :
                                                        </span>
                                                        {{ date('d') }} {{ $bulan[(int) date('m')] }}
                                                        {{ date('Y') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="h-[25px]">
                                        <table class="table-auto w-full mt-4">
                                            <thead>
                                                <tr class="bg-stone-200 h-8">
                                                    <th class="text-stone-900 border border-black text-sm w- text-center">
                                                        No.</th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-24">
                                                        Tgl. Bayar
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-44">
                                                        Klien
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-52">
                                                        Nomor Invoice
                                                    </th>
                                                    <th class="text-stone-900 border border-black text-sm text-center">
                                                        Deskripsi Pekerjaan
                                                    </th>
                                                    <th class="text-stone-900 border border-black text-sm text-center">
                                                        Lokasi
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-28">
                                                        Nilai Invoice
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-28">
                                                        Kas Masuk
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-24">
                                                        Sisa Tagihan
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $index = 0;
                                                    $number = 0;
                                                @endphp
                                                @foreach ($payments as $payment)
                                                    @php
                                                        $client = json_decode($payment->billings[0]->client);
                                                        $number++;
                                                        $totalSales = 0;
                                                        $totalBilling = 0;
                                                    @endphp
                                                    @foreach ($payment->billings as $itemBilling)
                                                        @php
                                                            $descriptions = json_decode($itemBilling->invoice_content)
                                                                ->description;
                                                            $descriptionNumber = 0;
                                                            $totalPayment = $itemBilling->bill_payments->sum('nominal');
                                                            $totalBilling =
                                                                $totalBilling +
                                                                ($itemBilling->nominal +
                                                                    $itemBilling->ppn -
                                                                    ($itemBilling->nominal * 2) / 100);
                                                        @endphp
                                                        @foreach ($descriptions as $description)
                                                            @php
                                                                $index++;
                                                                $descriptionNumber++;
                                                            @endphp
                                                            @if ($i == 0)
                                                                @if ($index < 26)
                                                                    @if ($descriptionNumber == 1)
                                                                        <tr>
                                                                            <td
                                                                                class="text-stone-900 px-1 border border-black text-sm align-top text-center">
                                                                                {{ $number }}
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 px-1 border border-black text-sm align-top text-center">
                                                                                {{ date('d', strtotime($payment->created_at)) }}-{{ $bulan[(int) date('m', strtotime($payment->created_at))] }}-{{ date('Y', strtotime($payment->created_at)) }}
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 border border-black text-sm px-1 align-top">
                                                                                @if (strlen($client->company) > 20)
                                                                                    {{ substr($client->company, 0, 20) }}..
                                                                                @else
                                                                                    {{ $client->company }}
                                                                                @endif
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 px-1 border border-black text-sm align-top">
                                                                                <a
                                                                                    href="/accounting/billings/{{ $itemBilling->id }}">{{ $itemBilling->invoice_number }}</a>
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 px-1 border border-black text-sm">
                                                                                @if (isset(json_decode($itemBilling->invoice_content)->manual_detail))
                                                                                    @if (strlen(json_decode($itemBilling->invoice_content)->manual_detail[0]->title) > 50)
                                                                                        {{ substr(json_decode($itemBilling->invoice_content)->manual_detail[0]->title, 5, 50) }}
                                                                                    @else
                                                                                        {{ json_decode($itemBilling->invoice_content)->manual_detail[0]->title }}
                                                                                    @endif
                                                                                @else
                                                                                    @if (strlen($description->title) > 50)
                                                                                        {{ substr($description->title, 5, 50) }}
                                                                                    @else
                                                                                        {{ $description->title }}
                                                                                    @endif
                                                                                @endif
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 px-1 border border-black text-sm">
                                                                                @if (strlen($description->location) > 45)
                                                                                    {{ substr($description->location, 0, 45) }}..
                                                                                @else
                                                                                    {{ $description->location }}
                                                                                @endif
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 bg-teal-50 px-1 border border-black text-sm text-right align-top">
                                                                                {{ number_format($description->nominal) }}
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 px-1 bg-yellow-50 border border-black text-sm align-top text-right">
                                                                                {{ number_format($payment->nominal) }}
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 px-1 border border-black text-sm bg-red-50 align-top text-right">
                                                                                @if ($totalPayment >= $totalBilling)
                                                                                    <span
                                                                                        class="flex w-full justify-center">LUNAS</span>
                                                                                @else
                                                                                    {{ number_format($totalBilling - $totalPayment) }}
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    @else
                                                                        <tr>
                                                                            <td
                                                                                class="text-stone-900 px-1 border border-black text-sm align-top text-center">
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 px-1 border border-black text-sm align-top text-center">
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 border border-black text-sm px-1 align-top">
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 px-1 border border-black text-sm text-center align-top">
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 px-1 border border-black text-sm">
                                                                                @if (strlen($description->title) > 50)
                                                                                    {{ substr($description->title, 5, 50) }}
                                                                                @else
                                                                                    {{ $description->title }}
                                                                                @endif
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 px-1 border border-black text-sm">
                                                                                @if (strlen($description->location) > 45)
                                                                                    {{ substr($description->location, 0, 45) }}..
                                                                                @else
                                                                                    {{ $description->location }}
                                                                                @endif
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 bg-teal-50 px-1 border border-black text-sm text-right align-top">
                                                                                {{ number_format($description->nominal) }}
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 px-1 bg-yellow-50 border border-black text-sm align-top text-right">
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 px-1 border border-black text-sm bg-red-50 align-top text-right">
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @endif
                                                            @else
                                                                @if ($index > $i * 25 && $index < ($i + 1) * 25 + 1)
                                                                    @if ($descriptionNumber == 1)
                                                                        <tr>
                                                                            <td
                                                                                class="text-stone-900 px-1 border border-black text-sm align-top text-center">
                                                                                {{ $number }}
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 px-1 border border-black text-sm align-top text-center">
                                                                                {{ date('d', strtotime($payment->created_at)) }}-{{ $bulan[(int) date('m', strtotime($payment->created_at))] }}-{{ date('Y', strtotime($payment->created_at)) }}
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 border border-black text-sm px-1 align-top">
                                                                                @if (strlen($client->company) > 20)
                                                                                    {{ substr($client->company, 0, 20) }}..
                                                                                @else
                                                                                    {{ $client->company }}
                                                                                @endif
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 px-1 border border-black text-sm align-top">
                                                                                <a
                                                                                    href="/accounting/billings/{{ $itemBilling->id }}">{{ $itemBilling->invoice_number }}</a>
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 px-1 border border-black text-sm">
                                                                                @if (isset(json_decode($itemBilling->invoice_content)->manual_detail))
                                                                                    @if (strlen(json_decode($itemBilling->invoice_content)->manual_detail[0]->title) > 50)
                                                                                        {{ substr(json_decode($itemBilling->invoice_content)->manual_detail[0]->title, 5, 50) }}
                                                                                    @else
                                                                                        {{ json_decode($itemBilling->invoice_content)->manual_detail[0]->title }}
                                                                                    @endif
                                                                                @else
                                                                                    @if (strlen($description->title) > 50)
                                                                                        {{ substr($description->title, 5, 50) }}
                                                                                    @else
                                                                                        {{ $description->title }}
                                                                                    @endif
                                                                                @endif
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 px-1 border border-black text-sm">
                                                                                @if (strlen($description->location) > 45)
                                                                                    {{ substr($description->location, 0, 45) }}..
                                                                                @else
                                                                                    {{ $description->location }}
                                                                                @endif
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 bg-teal-50 px-1 border border-black text-sm text-right align-top">
                                                                                {{ number_format($description->nominal) }}
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 px-1 bg-yellow-50 border border-black text-sm align-top text-right">
                                                                                {{ number_format($payment->nominal) }}
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 px-1 border border-black text-sm bg-red-50 align-top text-right">
                                                                                @if ($payment->nominal >= $totalBilling)
                                                                                    <span
                                                                                        class="flex w-full justify-center">LUNAS</span>
                                                                                @else
                                                                                    {{ number_format($totalBilling - $payment->nominal) }}
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    @else
                                                                        <tr>
                                                                            <td
                                                                                class="text-stone-900 px-1 border border-black text-sm align-top text-center">
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 px-1 border border-black text-sm align-top text-center">
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 border border-black text-sm px-1 align-top">
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 px-1 border border-black text-sm text-center align-top">
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 px-1 border border-black text-sm">
                                                                                @if (strlen($description->title) > 50)
                                                                                    {{ substr($description->title, 5, 50) }}
                                                                                @else
                                                                                    {{ $description->title }}
                                                                                @endif
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 px-1 border border-black text-sm">
                                                                                @if (strlen($description->location) > 45)
                                                                                    {{ substr($description->location, 0, 45) }}..
                                                                                @else
                                                                                    {{ $description->location }}
                                                                                @endif
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 bg-teal-50 px-1 border border-black text-sm text-right align-top">
                                                                                {{ number_format($description->nominal) }}
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 px-1 bg-yellow-50 border border-black text-sm align-top text-right">
                                                                            </td>
                                                                            <td
                                                                                class="text-stone-900 px-1 border border-black text-sm bg-red-50 align-top text-right">
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="flex items-end justify-end mt-1 text-black">
                                        <label for="">Halaman {{ $i + 1 }} dari
                                            {{ $pageQty }}</label>
                                    </div>
                                </div>
                            @endif
                        @endfor
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if (request('month'))
        <input id="saveName" type="text"
            value="Laporan Kas Masuk - {{ $bulan_full[request('month')] }} {{ request('year') }}" hidden>
    @else
        <input id="saveName" type="text"
            value="Laporan Kas Masuk - {{ $bulan_full[(int) date('m')] }} {{ date('Y') }}" hidden>
    @endif


    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>

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
    </script>
    <!-- Script end -->
@endsection
