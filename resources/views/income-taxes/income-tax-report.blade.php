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
    
    if (fmod(count($income_taxes), 25) == 0) {
        $pageQty = count($income_taxes) / 25;
    } else {
        $pageQty = (count($income_taxes) - fmod(count($income_taxes), 25)) / 25 + 1;
    }
    
    $nominalObject = 0;
    $nominalObjectAll = 0;
    $incomeType = [];
    ?>
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex justify-center w-full">
                <div class="w-[1550px]">
                    <div class="flex border-b">
                        <h1 class="index-h1">LIST PEMOTONGAN PPH</h1>
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
                    <form id="formFilter" action="/income-taxes/report/{{ $company->id }}">
                        <div class="flex">
                            <div class="flex h-14">
                                <div class="w-40">
                                    <span class="text-base text-stone-100">Masa Pajak</span>
                                    @if (request('period'))
                                        <input type="month" name="period"
                                            class="text-sm outline-none rounded-md p-1 w-36" value="{{ request('period') }}"
                                            onchange="submit()">
                                    @else
                                        <input type="month" name="period"
                                            class="text-sm outline-none rounded-md p-1 w-36" onchange="submit()">
                                    @endif
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
                    @if (count($income_taxes) == 0)
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
                                        <div class="flex items-end justify-center w-56">
                                            <label class="text-5xl text-center font-bold">-</label>
                                        </div>
                                        <div class="flex justify-center w-56">
                                            <label class="text-lg text-center font-bold">LIST PEMOTONGAN PPH</label>
                                        </div>
                                        <div class="flex justify-center w-56">
                                            <label class="text-sm text-center"></label>
                                        </div>
                                        <div class="flex justify-center w-56 border rounded-md">
                                            @if (request('period'))
                                                <label class="month-report text-xl font-semibold text-center">
                                                    {{ $bulan_full[(int) substr(request('period'), -2)] }}
                                                    {{ substr(request('period'), 0, 4) }}
                                                </label>
                                            @else
                                                <label class="month-report text-xl font-semibold text-center">-
                                                    {{-- {{ $bulan_full[(int) date('m')] }}
                                                    {{ date('Y') }} --}}
                                                </label>
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
                                @if (request('period'))
                                    <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak ada data
                                        pemotongan PPH
                                        pada bulan
                                        {{ $bulan_full[(int) substr(request('period'), -2)] }}
                                        {{ substr(request('period'), 0, 4) }} ~~
                                    </label>
                                @else
                                    <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Silahkan Pilih
                                        Masa Pajak Terlebih Dahulu..!! ~~
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
                                                <div class="flex items-end justify-center w-56">
                                                    <label class="text-5xl text-center font-bold">-</label>
                                                </div>
                                                <div class="flex justify-center w-56">
                                                    <label class="text-lg text-center font-bold">LIST PEMOTONGAN
                                                        PPH</label>
                                                </div>
                                                <div class="flex justify-center w-56">
                                                    <label class="text-sm text-center"></label>
                                                </div>
                                                <div class="flex justify-center w-56 border rounded-md">
                                                    @if (request('period'))
                                                        <label class="month-report text-xl font-semibold text-center">
                                                            {{ $bulan_full[(int) substr(request('period'), -2)] }}
                                                            {{ substr(request('period'), 0, 4) }}
                                                        </label>
                                                    @else
                                                        <label class="month-report text-xl font-semibold text-center">-
                                                        </label>
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
                                                    <th
                                                        class="text-stone-900 border border-black text-sm w- text-center w-8">
                                                        No.</th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-20">
                                                        Masa
                                                    </th>
                                                    <th class="text-stone-900 border border-black text-sm text-center">
                                                        Nama Pemotong
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-36">
                                                        NPWP
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-16">
                                                        Jenis
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-32">
                                                        Kode Objek Pajak
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-44">
                                                        Jenis Penghasilan
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-28">
                                                        Objek Potput
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-12">
                                                        Tarif
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-24">
                                                        PPH Potput
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-28">
                                                        No. Bukti
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-24">
                                                        Tgl.
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-36">
                                                        Alamat
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($income_taxes as $income_tax)
                                                    @if ($loop->iteration > $i * 25 && $loop->iteration < ($i + 1) * 25 + 1)
                                                        @php
                                                            $client = json_decode(
                                                                $income_tax->payment->billings[0]->client,
                                                            );
                                                            foreach ($income_tax->payment->billings as $billing) {
                                                                if ($billing->category == 'Service') {
                                                                    if (!in_array('Revisual', $incomeType)) {
                                                                        array_push($incomeType, 'Revisual');
                                                                    }
                                                                } elseif ($billing->category == 'Media') {
                                                                    if (!in_array('Sewa', $incomeType)) {
                                                                        array_push($incomeType, 'Sewa');
                                                                    }
                                                                }
                                                            }
                                                            $nominalObject =
                                                                $nominalObject +
                                                                $income_tax->payment->billings->sum('nominal');
                                                        @endphp
                                                        <tr class="h-[25px]">
                                                            <td
                                                                class="text-stone-900 px-1 border border-black text-sm  text-center">
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td
                                                                class="text-stone-900 px-1 border border-black text-sm  text-center">
                                                                {{ $bulan_full[(int) substr($income_tax->payment->income_tax_document->period, -2)] }}
                                                            </td>
                                                            <td class="text-stone-900 px-1 border border-black text-sm">
                                                                @if (isset($client->company))
                                                                    {{ $client->company }}
                                                                @elseif (isset($client->name))
                                                                    {{ $client->name }}
                                                                @else
                                                                    @if (strlen($client->contact_name) > 25)
                                                                        {{ substr($client->contact_name, 0, 25) }}..
                                                                    @else
                                                                        {{ $client->contact_name }}
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            <td
                                                                class="text-stone-900 border border-black text-sm px-1 text-center">
                                                                @if (isset($client->npwp))
                                                                    {{ $client->npwp }}
                                                                @endif
                                                            </td>
                                                            <td
                                                                class="text-stone-900 border border-black text-sm px-1 text-center">
                                                                PPh 23
                                                            </td>
                                                            <td
                                                                class="text-stone-900 border border-black text-sm px-1 text-center align-top">
                                                                @if ($income_tax->income_tax_category)
                                                                    {{ $income_tax->income_tax_category->code }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td class="text-stone-900 border border-black text-sm px-1">
                                                                @if (count($incomeType) == 1)
                                                                    {{ $incomeType[0] }} Reklame
                                                                @elseif(count($incomeType) == 2)
                                                                    {{ $incomeType[0] }} & {{ $incomeType[1] }} Reklame
                                                                @endif
                                                            </td>
                                                            <td
                                                                class="text-stone-900  bg-red-50 px-1 border border-black text-sm text-right">
                                                                {{ Number_format($income_tax->payment->billings->sum('nominal')) }}
                                                            </td>
                                                            <td
                                                                class="text-stone-900 border border-black text-sm px-1 text-center align-top">
                                                                @if ($income_tax->income_tax_category)
                                                                    {{ $income_tax->income_tax_category->rates }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td
                                                                class="text-stone-900 bg-teal-50 px-1 border border-black text-sm text-right ">
                                                                {{ number_format(round($income_tax->nominal)) }}
                                                            </td>
                                                            <td
                                                                class="text-stone-900 px-1 border border-black text-sm text-center">
                                                                {{ $income_tax->number }}
                                                            </td>
                                                            <td
                                                                class="text-stone-900 px-1 border border-black text-sm text-center">
                                                                {{ date('d', strtotime($income_tax->tax_date)) }}-{{ $bulan[(int) date('m', strtotime($income_tax->tax_date))] }}-{{ date('Y', strtotime($income_tax->tax_date)) }}
                                                            </td>
                                                            <td class="text-stone-900 px-1 border border-black text-sm">
                                                                {{ $income_tax->client_city }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                <tr class="h-[25px]">
                                                    <td class="text-stone-900 px-1 border border-black text-sm text-right font-semibold"
                                                        colspan="7">TOTAL</td>
                                                    <td
                                                        class="text-stone-900 bg-red-50 px-1 border border-black text-sm text-right font-semibold">
                                                        {{ number_format($nominalObject) }}
                                                    </td>
                                                    <td
                                                        class="text-stone-900 px-1 border border-black text-sm  text-right bg-slate-400 font-semibold">
                                                    </td>
                                                    <td
                                                        class="text-stone-900 px-1 border border-black text-sm bg-teal-50 text-right font-semibold">
                                                        {{ number_format($income_taxes->sum('nominal')) }}
                                                    </td>
                                                    <td
                                                        class="text-stone-900 px-1 border border-black text-sm  text-right bg-slate-400 font-semibold">
                                                    </td>
                                                    <td
                                                        class="text-stone-900 px-1 border border-black text-sm  text-right bg-slate-400 font-semibold">
                                                    </td>
                                                    <td
                                                        class="text-stone-900 px-1 border border-black text-sm  text-right bg-slate-400 font-semibold">
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
                                                <div class="flex items-end justify-center w-56">
                                                    <label class="text-5xl text-center font-bold">-</label>
                                                </div>
                                                <div class="flex justify-center w-56">
                                                    <label class="text-lg text-center font-bold">LIST PEMOTONGAN
                                                        PPH</label>
                                                </div>
                                                <div class="flex justify-center w-56">
                                                    <label class="text-sm text-center"></label>
                                                </div>
                                                <div class="flex justify-center w-56 border rounded-md">
                                                    @if (request('period'))
                                                        <label class="month-report text-xl font-semibold text-center">
                                                            {{ $bulan_full[(int) substr(request('period'), -2)] }}
                                                            {{ substr(request('period'), 0, 4) }}
                                                        </label>
                                                    @else
                                                        <label class="month-report text-xl font-semibold text-center">-
                                                        </label>
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
                                                    <th
                                                        class="text-stone-900 border border-black text-sm w- text-center w-8">
                                                        No.</th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-20">
                                                        Masa
                                                    </th>
                                                    <th class="text-stone-900 border border-black text-sm text-center">
                                                        Nama Pemotong
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-36">
                                                        NPWP
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-16">
                                                        Jenis
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-32">
                                                        Kode Objek Pajak
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-44">
                                                        Jenis Penghasilan
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-28">
                                                        Objek Potput
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-12">
                                                        Tarif
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-24">
                                                        PPH Potput
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-28">
                                                        No. Bukti
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-24">
                                                        Tgl.
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-black text-sm text-center w-36">
                                                        Alamat
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($income_taxes as $income_tax)
                                                    @if ($loop->iteration > $i * 25 && $loop->iteration < ($i + 1) * 25 + 1)
                                                        @php
                                                            $client = json_decode(
                                                                $income_tax->payment->billings[0]->client,
                                                            );
                                                            foreach ($income_tax->payment->billings as $billing) {
                                                                if ($billing->category == 'Service') {
                                                                    if (!in_array('Revisual', $incomeType)) {
                                                                        array_push($incomeType, 'Revisual');
                                                                    }
                                                                } elseif ($billing->category == 'Media') {
                                                                    if (!in_array('Sewa', $incomeType)) {
                                                                        array_push($incomeType, 'Sewa');
                                                                    }
                                                                }
                                                            }
                                                            $nominalObject =
                                                                $nominalObject +
                                                                $income_tax->payment->billings->sum('nominal');
                                                        @endphp
                                                        <tr class="h-[25px]">
                                                            <td
                                                                class="text-stone-900 px-1 border border-black text-sm  text-center">
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td
                                                                class="text-stone-900 px-1 border border-black text-sm  text-center">
                                                                {{ $bulan_full[(int) substr($income_tax->payment->income_tax_document->period, -2)] }}
                                                            </td>
                                                            <td class="text-stone-900 px-1 border border-black text-sm">
                                                                @if (isset($client->company))
                                                                    @if (strlen($client->company) > 25)
                                                                        {{ substr($client->company, 0, 25) }}..
                                                                    @else
                                                                        {{ $client->company }}
                                                                    @endif
                                                                @elseif (isset($client->name))
                                                                    @if (strlen($client->name) > 25)
                                                                        {{ substr($client->name, 0, 25) }}..
                                                                    @else
                                                                        {{ $client->name }}
                                                                    @endif
                                                                @else
                                                                    @if (strlen($client->contact_name) > 25)
                                                                        {{ substr($client->contact_name, 0, 25) }}..
                                                                    @else
                                                                        {{ $client->contact_name }}
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            <td
                                                                class="text-stone-900 border border-black text-sm px-1 text-center">
                                                                @if (isset($client->npwp))
                                                                    {{ $client->npwp }}
                                                                @endif
                                                            </td>
                                                            <td
                                                                class="text-stone-900 border border-black text-sm px-1 text-center">
                                                                PPh 23
                                                            </td>
                                                            <td
                                                                class="text-stone-900 border border-black text-sm px-1 text-center align-top">
                                                                @if ($income_tax->income_tax_category)
                                                                    {{ $income_tax->income_tax_category->code }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td class="text-stone-900 border border-black text-sm px-1">
                                                                @if (count($incomeType) == 1)
                                                                    {{ $incomeType[0] }} Reklame
                                                                @elseif(count($incomeType) == 2)
                                                                    {{ $incomeType[0] }} & {{ $incomeType[1] }} Reklame
                                                                @endif
                                                            </td>
                                                            <td
                                                                class="text-stone-900  bg-red-50 px-1 border border-black text-sm text-right">
                                                                {{ Number_format($income_tax->payment->billings->sum('nominal')) }}
                                                            </td>
                                                            <td
                                                                class="text-stone-900 border border-black text-sm px-1 text-center align-top">
                                                                @if ($income_tax->income_tax_category)
                                                                    {{ $income_tax->income_tax_category->rates }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td
                                                                class="text-stone-900 bg-teal-50 px-1 border border-black text-sm text-right ">
                                                                {{ number_format(round($income_tax->nominal)) }}
                                                            </td>
                                                            <td
                                                                class="text-stone-900 px-1 border border-black text-sm text-center">
                                                                {{ $income_tax->number }}
                                                            </td>
                                                            <td
                                                                class="text-stone-900 px-1 border border-black text-sm text-center">
                                                                {{ date('d', strtotime($income_tax->tax_date)) }}-{{ $bulan[(int) date('m', strtotime($income_tax->tax_date))] }}-{{ date('Y', strtotime($income_tax->tax_date)) }}
                                                            </td>
                                                            <td class="text-stone-900 px-1 border border-black text-sm">
                                                                {{ $income_tax->client_city }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="flex justify-end mt-1 text-black">
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

    <table id="exportExcelTable" class="table-auto w-full mt-4" hidden>
        <thead>
            <tr class="bg-stone-200 h-8">
                <th class="text-stone-900 border border-black text-sm w- text-center w-8">
                    No.</th>
                <th class="text-stone-900 border border-black text-sm text-center w-36">
                    Masa
                </th>
                <th class="text-stone-900 border border-black text-sm text-center">
                    Nama Pemotong
                </th>
                <th class="text-stone-900 border border-black text-sm text-center w-36">
                    NPWP
                </th>
                <th class="text-stone-900 border border-black text-sm text-center w-16">
                    Jenis
                </th>
                <th class="text-stone-900 border border-black text-sm text-center w-20">
                    Kode Objek Pajak
                </th>
                <th class="text-stone-900 border border-black text-sm">
                    Nama Objek Pajak
                </th>
                <th class="text-stone-900 border border-black text-sm text-center w-48">
                    Jenis Penghasilan
                </th>
                <th class="text-stone-900 border border-black text-sm text-center w-28">
                    Objek Potput
                </th>
                <th class="text-stone-900 border border-black text-sm text-center w-16">
                    Tarif
                </th>
                <th class="text-stone-900 border border-black text-sm text-center w-24">
                    PPH Potput
                </th>
                <th class="text-stone-900 border border-black text-sm text-center w-28">
                    No. Bukti
                </th>
                <th class="text-stone-900 border border-black text-sm text-center w-28">
                    Tgl.
                </th>
                <th class="text-stone-900 border border-black text-sm text-center w-36">
                    Alamat
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($income_taxes as $income_tax)
                @php
                    $client = json_decode($income_tax->payment->billings[0]->client);
                    foreach ($income_tax->payment->billings as $billing) {
                        if ($billing->category == 'Service') {
                            if (!in_array('Revisual', $incomeType)) {
                                array_push($incomeType, 'Revisual');
                            }
                        } elseif ($billing->category == 'Media') {
                            if (!in_array('Sewa', $incomeType)) {
                                array_push($incomeType, 'Sewa');
                            }
                        }
                    }
                    $nominalObjectAll = $nominalObjectAll + $income_tax->payment->billings->sum('nominal');
                @endphp
                <tr class="h-[25px]">
                    <td class="text-stone-900 px-1 border border-black text-sm  text-center align-top">
                        {{ $loop->iteration }}
                    </td>
                    <td class="text-stone-900 px-1 border border-black text-sm  text-center align-top">
                        {{ $bulan_full[(int) substr($income_tax->payment->income_tax_document->period, -2)] }}
                        {{ substr($income_tax->payment->income_tax_document->period, 0, 4) }}
                    </td>
                    <td class="text-stone-900 px-1 border border-black text-sm align-top">
                        @if (isset($client->company))
                            {{ $client->company }}
                        @elseif (isset($client->name))
                            {{ $client->name }}
                        @else
                            @if (strlen($client->contact_name) > 25)
                                {{ substr($client->contact_name, 0, 25) }}..
                            @else
                                {{ $client->contact_name }}
                            @endif
                        @endif
                    </td>
                    <td class="text-stone-900 border border-black text-sm px-1 text-center align-top">
                        @if (isset($client->npwp))
                            {{ "'" . $client->npwp }}
                        @endif
                    </td>
                    <td class="text-stone-900 border border-black text-sm px-1 text-center align-top">
                        PPh 23
                    </td>
                    <td class="text-stone-900 border border-black text-sm px-1 text-center align-top">
                        @if ($income_tax->income_tax_category)
                            {{ $income_tax->income_tax_category->code }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-stone-900 border border-black text-sm px-1 text-center align-top">
                        @if ($income_tax->income_tax_category)
                            {{ $income_tax->income_tax_category->name }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-stone-900 border border-black text-sm px-1 align-top">
                        @if (count($incomeType) == 1)
                            {{ $incomeType[0] }} Reklame
                        @elseif(count($incomeType) == 2)
                            {{ $incomeType[0] }} & {{ $incomeType[1] }} Reklame
                        @endif
                    </td>
                    <td class="text-stone-900  bg-red-50 px-1 border border-black text-sm text-right align-top">
                        {{ Number_format($income_tax->payment->billings->sum('nominal')) }}
                    </td>
                    <td class="text-stone-900 border border-black text-sm px-1 text-center align-top">
                        @if ($income_tax->income_tax_category)
                            {{ $income_tax->income_tax_category->rates }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-stone-900 bg-teal-50 px-1 border border-black text-sm text-right align-top">
                        {{ number_format(round($income_tax->nominal)) }}
                    </td>
                    <td class="text-stone-900 px-1 border border-black text-sm text-center align-top">
                        {{ $income_tax->number }}
                    </td>
                    <td class="text-stone-900 px-1 border border-black text-sm text-center align-top">
                        {{ date('d', strtotime($income_tax->tax_date)) }}-{{ $bulan[(int) date('m', strtotime($income_tax->tax_date))] }}-{{ date('Y', strtotime($income_tax->tax_date)) }}
                    </td>
                    <td class="text-stone-900 px-1 border border-black text-sm align-top">
                        {{ $income_tax->client_city }}
                    </td>
                </tr>
            @endforeach
            <tr class="h-[25px]">
                <td class="text-stone-900 px-1 border border-black text-sm text-right font-semibold" colspan="8">TOTAL
                </td>
                <td class="text-stone-900 bg-red-50 px-1 border border-black text-sm text-right font-semibold">
                    {{ number_format($nominalObjectAll) }}
                </td>
                <td class="text-stone-900 px-1 border border-black text-sm  text-right bg-slate-400 font-semibold">
                </td>
                <td class="text-stone-900 px-1 border border-black text-sm bg-teal-50 text-right font-semibold">
                    {{ number_format($income_taxes->sum('nominal')) }}
                </td>
                <td class="text-stone-900 px-1 border border-black text-sm  text-right bg-slate-400 font-semibold">
                </td>
                <td class="text-stone-900 px-1 border border-black text-sm  text-right bg-slate-400 font-semibold">
                </td>
                <td class="text-stone-900 px-1 border border-black text-sm  text-right bg-slate-400 font-semibold">
                </td>
            </tr>
        </tbody>
    </table>
    @if (request('month'))
        <input id="saveName" type="text"
            value="LIST PEMOTONGAN PPH - {{ $bulan_full[request('month')] }} {{ request('year') }}" hidden>
    @else
        <input id="saveName" type="text"
            value="LIST PEMOTONGAN PPH - {{ $bulan_full[(int) date('m')] }} {{ date('Y') }}" hidden>
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
                    filename: "List Bukti Potong PPH.xls"
                });
            });
        });
    </script>
    <!-- Script end -->
@endsection
