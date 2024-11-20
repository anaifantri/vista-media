@extends('dashboard.layouts.main');

@section('container')
    <!-- Create Sales Report start -->
    @php
        $bulan = [
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
    @endphp
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="bg-stone-700 p-2 border rounded-md">
            <div class="flex justify-center m-2 w-[1280px]">
                <h1 class="text-xl text-stone-100 font-bold tracking-wider w-[1580px] border-b">LAPORAN PENAWARAN
                    {{ strtoupper($quotation_category->name) }}</h1>
            </div>
            @include('quotations-report.quotation-header')
            <div id="chartReport" class="flex justify-center z-0">
                <?php
                if (fmod(count($quotations), 5) == 0) {
                    $pageQty = count($quotations) / 5;
                } else {
                    $pageQty = (count($quotations) - fmod(count($quotations), 5)) / 5 + 1;
                }
                ?>
                <div id="pdfPreview">
                    @if (count($quotations) == 0)
                        <div class="w-[1280px] h-[900px] px-10 mt-2 p-4 bg-white z-0">
                            <div class="flex items-center border rounded-lg p-4 mt-8">
                                <div class="w-44">
                                    <img class="ml-2" src="/img/logo-vm.png" alt="">
                                </div>
                                <div class="w-[450px] ml-6">
                                    <div>
                                        <span class="text-sm font-semibold">PT. Vista Media</span>
                                    </div>
                                    <div>
                                        <span class="text-xs">Jl. Pulau Kawe No. 40 - Dauh Puri Kauh</span>
                                    </div>
                                    <div>
                                        <span class="text-xs">Kota Denpasar, Bali 80114</span>
                                    </div>
                                    <div>
                                        <span class="text-xs">Ph. +62 361 230000 | Fax. +62 361 237800 </span>
                                    </div>
                                    <div>
                                        <span class="text-xs">e-mail : info@vistamedia.co.id | www.vistamedia.co.id</span>
                                    </div>
                                </div>
                                <div class="flex w-full justify-end">
                                    <div>
                                        <div class="flex justify-center w-56">
                                            <label class="text-5xl text-center">Q1</label>
                                        </div>
                                        <div class="flex justify-center w-56">
                                            <label class="text-sm text-center">LAPORAN PENAWARAN
                                                {{ strtoupper($quotation_category->name) }}</label>
                                        </div>
                                        <div class="flex justify-center w-56">
                                            <label class="text-sm text-center"></label>
                                        </div>
                                        <div class="flex justify-center w-56 border rounded-md">
                                            @if (request('search'))
                                                <?php
                                                $searchDate = strtotime(request('search'));
                                                ?>
                                                <label id="labelPeriode"
                                                    class="month-report text-xl font-semibold text-center">
                                                    {{ $bulan[(int) date('m', $searchDate)] }}
                                                    {{ date('Y', $searchDate) }}
                                                </label>
                                            @else
                                                <label id="labelPeriode"
                                                    class="month-report text-xl font-semibold text-center">JAN - DES
                                                    {{ date('Y') }}</label>
                                            @endif
                                        </div>
                                        <div class="flex justify-center w-56 border rounded-md mt-2">
                                            <label class="text-sm">
                                                <span class="text-sm font-semibold text-red-600">Tgl. Cetak : </span>
                                                {{ date('d') }} {{ $bulan[(int) date('m')] }}
                                                {{ date('Y') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center h-[625px] mt-2">
                                @if (request('search'))
                                    <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak ada data
                                        penawaran {{ $quotation_category->name }} pada
                                        bulan
                                        {{ $bulan[(int) date('m', strtotime(request('search')))] }}
                                        {{ date('Y', strtotime(request('search'))) }} ~~
                                    </label>
                                @else
                                    <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak ada data
                                        penawaran {{ $quotation_category->name }} pada tahun
                                        {{ date('Y', strtotime(date('Y-m-d'))) }} ~~
                                    </label>
                                @endif
                            </div>
                        </div>
                    @else
                        @for ($i = 0; $i < $pageQty; $i++)
                            <div class="w-[1280px] h-[900px] px-10 mt-2 p-4 bg-white z-0">
                                <div class="flex items-center border rounded-lg p-4 mt-8">
                                    <div class="w-44">
                                        <img class="ml-2" src="/img/logo-vm.png" alt="">
                                    </div>
                                    <div class="w-[450px] ml-6">
                                        <div>
                                            <span class="text-sm font-semibold">PT. Vista Media</span>
                                        </div>
                                        <div>
                                            <span class="text-xs">Jl. Pulau Kawe No. 40 - Dauh Puri Kauh</span>
                                        </div>
                                        <div>
                                            <span class="text-xs">Kota Denpasar, Bali 80114</span>
                                        </div>
                                        <div>
                                            <span class="text-xs">Ph. +62 361 230000 | Fax. +62 361 237800 </span>
                                        </div>
                                        <div>
                                            <span class="text-xs">e-mail : info@vistamedia.co.id |
                                                www.vistamedia.co.id</span>
                                        </div>
                                    </div>
                                    <div class="flex w-full justify-end">
                                        <div>
                                            <div class="flex justify-center w-56">
                                                <label class="text-5xl text-center">Q1</label>
                                            </div>
                                            <div class="flex justify-center w-56">
                                                <label class="text-sm text-center">LAPORAN PENAWARAN
                                                    {{ strtoupper($quotation_category->name) }}</label>
                                            </div>
                                            <div class="flex justify-center w-56">
                                                <label class="text-sm text-center"></label>
                                            </div>
                                            <div class="flex justify-center w-56 border rounded-md">
                                                @if (request('search'))
                                                    <?php
                                                    $searchDate = strtotime(request('search'));
                                                    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                                    ?>
                                                    <label id="labelPeriode"
                                                        class="month-report text-xl font-semibold text-center">{{ $bulan[(int) date('m', $searchDate)] }}
                                                        {{ date('Y', $searchDate) }}</label>
                                                @else
                                                    <label id="labelPeriode"
                                                        class="month-report text-xl font-semibold text-center">JAN
                                                        - DES {{ date('Y') }}</label>
                                                @endif
                                            </div>
                                            <div class="flex justify-center w-56 border rounded-md mt-2">
                                                <label class="text-sm">
                                                    <span class="text-sm font-semibold text-red-600">Tgl. Cetak : </span>
                                                    {{ date('d') }} {{ $bulan[(int) date('m')] }}
                                                    {{ date('Y') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="h-[622px] mt-2">
                                    <table class="table-auto w-full">
                                        <thead>
                                            <tr class="bg-teal-100">
                                                <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-6"
                                                    rowspan="2">
                                                    No.
                                                </th>
                                                <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-14"
                                                    rowspan="2">
                                                    Jenis
                                                </th>
                                                <th class="text-teal-700 sticky top-0 border text-[0.65rem] text-center w-32"
                                                    rowspan="2">
                                                    <button class="flex justify-center items-center w-32">@sortablelink('number', 'Nomor Penawaran')
                                                        <svg class="fill-current w-3 ml-1"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                            <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                                        </svg>
                                                    </button>
                                                </th>
                                                <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-20"
                                                    rowspan="2">
                                                    Tanggal
                                                </th>
                                                <th class="text-teal-700 sticky top-0 border text-[0.65rem]" colspan="2">
                                                    Data Klien
                                                </th>
                                                <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-32"
                                                    rowspan="2">
                                                    Lokasi
                                                </th>
                                                <th class="text-teal-700 sticky top-0 border text-[0.65rem]" colspan="2">
                                                    Progress Penawaran
                                                </th>
                                            </tr>
                                            <tr class="bg-teal-100">
                                                <th class="text-teal-700 border text-[0.65rem] w-24">Nama</th>
                                                <th class="text-teal-700 border text-[0.65rem] w-32">Kontak Person</th>
                                                <th class="text-teal-700 border text-[0.65rem] w-24">Status Akhir</th>
                                                <th class="text-teal-700 border text-[0.65rem]">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($quotations as $quotation)
                                                @php
                                                    $client = json_decode($quotation->clients);
                                                    $products = json_decode($quotation->products);
                                                @endphp
                                                <tr>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                        {{ $quotation->media_category->name }}
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                        {{ $quotation->number }}
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                        {{ date('d-M-Y', strtotime($quotation->created_at)) }}
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                        {{ $client->name }}
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                        {{ $client->contact_name }}
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                        @foreach ($products as $product)
                                                            @if ($loop->iteration != count($products))
                                                                {{ $product->code }},
                                                            @else
                                                                {{ $product->code }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                        @if (count($quotation->quotation_revisions) != 0)
                                                            Revisi ke {{ count($quotation->quotation_revisions) }} :
                                                            {{ $quotation->quot_revision_statuses[count($quotation->quot_revision_statuses) - 1]->status }}
                                                        @else
                                                            Utama :
                                                            {{ $quotation->quotation_statuses[count($quotation->quotation_statuses) - 1]->status }}
                                                        @endif
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] align-top px-1">
                                                        @if (count($quotation->quotation_revisions) != 0)
                                                            {{ $quotation->quot_revision_statuses[count($quotation->quot_revision_statuses) - 1]->description }}
                                                        @else
                                                            {{ $quotation->quotation_statuses[count($quotation->quotation_statuses) - 1]->description }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="flex justify-end mt-1 text-teal-900">
                                    <label for="">Halaman {{ $i + 1 }} dari {{ $pageQty }}</label>
                                </div>
                            </div>
                        @endfor
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
