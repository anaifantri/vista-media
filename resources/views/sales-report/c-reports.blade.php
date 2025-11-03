@extends('dashboard.layouts.main');

@section('container')
    <!-- Create Sales Report start -->
    @php
        $ppnTotal = 0;
        $pphTotal = 0;
        $priceTotal = 0;
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
        $sMonth = [
            1 => 'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sep',
            'Okt',
            'Nov',
            'Des',
        ];
    @endphp
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="bg-stone-700 p-2 border rounded-md">
            <div class="flex justify-center m-2">
                <h1 class="text-xl text-stone-100 font-bold tracking-wider w-[1580px] border-b">DATA PENJUALAN</h1>
            </div>
            @include('sales-report.c-header')
            <div id="chartReport" class="flex justify-center z-0">
                <?php
                if (fmod(count($sales), 8) == 0) {
                    $pageQty = count($sales) / 8;
                } else {
                    $pageQty = (count($sales) - fmod(count($sales), 8)) / 8 + 1;
                }
                ?>
                <div id="pdfPreview">
                    @if (count($sales) == 0)
                        <div class="w-[1580px] h-[1000px] px-10 py-4 mt-2 bg-white z-0">
                            <div class="flex items-center border rounded-lg p-4 mt-8">
                                <div class="w-44">
                                    <img class="ml-2 w-[125px]" src="{{ asset('storage/' . $company->logo) }}"
                                        alt="">
                                </div>
                                <div class="w-[750px] ml-6">
                                    <div>
                                        <span class="text-sm font-semibold">{{ $company->name }}</span>
                                    </div>
                                    <div>
                                        <span class="text-xs">{{ $company->address }}, Desa/Kel. {{ $company->village }},
                                            Kec.
                                            {{ $company->district }}</span>
                                    </div>
                                    <div>
                                        <span class="text-xs">{{ $company->city }} - {{ $company->province }}
                                            {{ $company->post_code }}</span>
                                    </div>
                                    <div>
                                        <span class="text-xs">Ph. {{ $company->phone }} | Mobile.
                                            {{ $company->m_phone }}</span>
                                    </div>
                                    <div>
                                        <span class="text-xs">e-mail : {{ $company->email }} | website :
                                            {{ $company->website }}</span>
                                    </div>
                                </div>
                                <div class="flex w-full justify-end">
                                    <div>
                                        <div class="flex justify-center w-56">
                                            <label class="text-5xl text-center">C1</label>
                                        </div>
                                        <div class="flex justify-center w-56">
                                            <label class="text-sm text-center">LAPORAN PENJUALAN</label>
                                        </div>
                                        <div class="flex justify-center w-56">
                                            <label class="text-sm text-center"></label>
                                        </div>
                                        <div class="flex justify-center w-56 border rounded-md">
                                            @if (request('month'))
                                                @if (request('month') != 'All')
                                                    <label id="labelPeriode"
                                                        class="month-report text-xl font-semibold text-center">
                                                        {{ $bulan[request('month')] }}
                                                        {{ request('year') }}
                                                    </label>
                                                @else
                                                    <label id="labelPeriode"
                                                        class="month-report text-xl font-semibold text-center">JAN - DES
                                                        {{ request('year') }}</label>
                                                @endif
                                            @else
                                                @if (request('year'))
                                                    <label id="labelPeriode"
                                                        class="month-report text-xl font-semibold text-center">JAN - DES
                                                        {{ request('year') }}</label>
                                                @else
                                                    <label id="labelPeriode"
                                                        class="month-report text-xl font-semibold text-center">JAN - DES
                                                        {{ date('Y') }}</label>
                                                @endif
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
                            <div class="flex justify-center h-[875px] mt-2">
                                @if (request('month'))
                                    @if (request('month') != 'All')
                                        <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak ada
                                            data
                                            penjualan pada
                                            bulan
                                            {{ $bulan[request('month')] }}
                                            {{ request('year') }} ~~
                                        </label>
                                    @else
                                        <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak ada
                                            data
                                            penjualan pada tahun {{ request('year') }} ~~
                                        </label>
                                    @endif
                                @else
                                    @if (request('year'))
                                        <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak ada
                                            data
                                            penjualan pada tahun {{ request('year') }} ~~
                                        </label>
                                    @else
                                        <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak ada
                                            data
                                            penjualan pada tahun {{ date('Y', strtotime(date('Y-m-d'))) }} ~~
                                        </label>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @else
                        @for ($i = 0; $i < $pageQty; $i++)
                            @if ($i == $pageQty - 1)
                                @include('sales-report.c-last-page')
                            @else
                                @include('sales-report.c-page')
                            @endif
                        @endfor
                    @endif
                </div>
            </div>
        </div>
        <input id="saveName" type="text" value="Laporan C1 - {{ date('d-m-Y') }}" hidden>
    </div>

    <table id="exportExcelTable" class="table-auto w-full" hidden>
        <thead>
            <tr class="bg-teal-100">
                <th class="sticky top-0 border border-black text-[0.65rem] w-6" rowspan="2">
                    No.
                </th>
                <th class="sticky top-0 border border-black text-[0.65rem] text-center" rowspan="2">
                    Data Penjualan
                </th>
                <th class="sticky top-0 border border-black text-[0.65rem] w-40" rowspan="2">
                    Klien
                </th>
                <th class="sticky top-0 border border-black text-[0.65rem] w-36" rowspan="2">
                    Penawaran
                </th>
                <th class="sticky top-0 border border-black text-[0.65rem] w-[120px]" rowspan="2">
                    Harga
                </th>
                <th class="sticky top-0 border border-black text-[0.65rem]" colspan="5">
                    Termin Pembayaran
                </th>
                <th class="sticky top-0 border border-black text-[0.65rem]" colspan="3">
                    Penagihan
                </th>
                <th class="sticky top-0 border border-black text-[0.65rem]" colspan="2">
                    Pembayaran
                </th>
            </tr>
            <tr class="bg-teal-100">
                <th class="border border-black text-[0.65rem] w-10">Termin</th>
                <th class="border border-black text-[0.65rem] w-[72px]">Nominal</th>
                <th class="border border-black text-[0.65rem] w-16">PPN</th>
                <th class="border border-black text-[0.65rem] w-12">PPh</th>
                <th class="border border-black text-[0.65rem] w-20">Total</th>
                <th class="border border-black text-[0.65rem] w-20">No. Invoice</th>
                <th class="border border-black text-[0.65rem] w-20">Tgl. Invoice</th>
                <th class="border border-black text-[0.65rem] w-[72px]">Nominal</th>
                <th class="border border-black text-[0.65rem] w-12">Status</th>
                <th class="border border-black text-[0.65rem] w-20">Tgl. Bayar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                @php
                    $voidFound = false;
                    $changeFound = false;
                    if ($sale->void_sale) {
                        $voidSale = $sales->where('id', $sale->id);
                        if (count($voidSale) == 2) {
                            $pphTotal = $pphTotal + ($sale->dpp * (2 / 100)) / 2;
                            $ppnTotal = $ppnTotal + ($sale->dpp * ($sale->ppn / 100)) / 2;
                            $priceTotal = $priceTotal + $sale->price / 2;
                        } else {
                            foreach ($void_sales as $void_sale) {
                                if ($void_sale->sale_id == $sale->id) {
                                    $voidFound = true;
                                }
                            }
                            if ($voidFound == false) {
                                $pphTotal = $pphTotal + $sale->dpp * (2 / 100);
                                $ppnTotal = $ppnTotal + $sale->dpp * ($sale->ppn / 100);
                                $priceTotal = $priceTotal + $sale->price;
                            }
                        }
                    } elseif ($sale->change_sale) {
                        $changeSale = $sales->where('id', $sale->id);
                        if (count($changeSale) == 2) {
                            $pphTotal = $pphTotal + ($sale->dpp * (2 / 100)) / 2;
                            $ppnTotal = $ppnTotal + ($sale->dpp * ($sale->ppn / 100)) / 2;
                            $priceTotal = $priceTotal + $sale->price / 2;
                        } else {
                            foreach ($change_sales as $change_sale) {
                                if ($change_sale->sale_id == $sale->id) {
                                    $changeFound = true;
                                }
                            }
                            if ($changeFound == false) {
                                $pphTotal = $pphTotal + $sale->dpp * (2 / 100);
                                $ppnTotal = $ppnTotal + $sale->dpp * ($sale->ppn / 100);
                                $priceTotal = $priceTotal + $sale->price;
                            }
                        }
                    } else {
                        $pphTotal = $pphTotal + $sale->dpp * (2 / 100);
                        $ppnTotal = $ppnTotal + $sale->dpp * ($sale->ppn / 100);
                        $priceTotal = $priceTotal + $sale->price;
                    }

                    $quotId = null;
                    $quotRevisionId = null;
                    $created_by = json_decode($sale->created_by);
                    $revisions = $sale->quotation->quotation_revisions;

                    if (count($revisions) != 0) {
                        $revision =
                            $sale->quotation->quotation_revisions[count($sale->quotation->quotation_revisions) - 1];
                        $number = $revision->number;
                        $quotRevisionId = $revision->id;
                        $notes = json_decode($revision->notes);
                        $created_at = $revision->created_at;
                        $payment_terms = json_decode($revision->payment_terms);
                        $price = json_decode($revision->price);
                        $dataApprovals = $sale->quotation->quotation_approvals;
                        $dataAgreements = $sale->quotation->quotation_agreements;
                        $dataOrders = $sale->quotation->quotation_orders;
                    } else {
                        $number = $sale->quotation->number;
                        $quotId = $sale->quotation->id;
                        $notes = json_decode($sale->quotation->notes);
                        $created_at = $sale->quotation->created_at;
                        $payment_terms = json_decode($sale->quotation->payment_terms);
                        $price = json_decode($sale->quotation->price);
                        $dataApprovals = $sale->quotation->quotation_approvals;
                        $dataAgreements = $sale->quotation->quotation_agreements;
                        $dataOrders = $sale->quotation->quotation_orders;
                    }
                    $clients = json_decode($sale->quotation->clients);
                    $product = json_decode($sale->product);
                    $description = json_decode($product->description);
                    $saleBillings = $sale->billings;
                @endphp
                <tr>
                    <td class="border border-black text-[0.65rem] text-center align-top">
                        {{ $loop->iteration }}</td>
                    <td class="border border-black text-[0.65rem] text-start align-top">
                        <div>
                            <div class="flex ml-1">
                                <label class="w-10">No.</label>
                                <label>:</label>
                                <a href="/marketing/sales/{{ $sale->id }}" class="ml-1 w-32">{{ $sale->number }}</a>
                            </div>
                            <div class="flex ml-1">
                                <label class="w-10">Tgl.</label>
                                <label>:</label>
                                <label class="ml-1 w-32">{{ date('d-M-Y', strtotime($sale->created_at)) }}</label>
                            </div>
                            <div class="flex ml-1">
                                <label class="w-10">Oleh</label>
                                <label>:</label>
                                <label class="ml-1 w-32">{{ $created_by->name }}</label>
                            </div>
                            <div class="flex ml-1">
                                <label class="w-10">Kode</label>
                                <label>:</label>
                                <a href="/media/locations/preview/{{ $product->category }}/{{ $product->id }}"
                                    class="ml-1">{{ $product->code }} -
                                    {{ $product->city_code }}</a>
                            </div>
                            <div class="flex ml-1">
                                <label class="w-10">Lokasi</label>
                                <label>:</label>
                                <label class="ml-1">
                                    {{ $product->address }}
                                </label>
                            </div>
                            <div class="flex ml-1">
                                <label class="w-10">Size</label>
                                <label>:</label>
                                <label class="ml-1">
                                    {{ $product->size }}x{{ $product->side }}-
                                    @if ($product->orientation == 'Horizontal')
                                        H
                                    @elseif($product->orientation == 'Vertikal')
                                        V
                                    @endif
                                </label>
                            </div>
                        </div>
                    </td>
                    <td class="border border-black text-[0.65rem] text-start align-top">
                        <div>
                            @if ($clients->type == 'Perusahaan')
                                <div class="flex ml-1">
                                    <label class="w-8">Klien</label>
                                    <label class="ml-1">:</label>
                                    <label class="ml-2 w-28">
                                        {{ $clients->company }}
                                    </label>
                                </div>
                                <div class="flex ml-1">
                                    <label class="w-8">Kontak</label>
                                    <label class="ml-1">:</label>
                                    <label class="ml-2 w-28">{{ $clients->contact_name }}</label>
                                </div>
                            @else
                                <div class="flex ml-1">
                                    <label class="w-8">Klien</label>
                                    <label class="ml-1">:</label>
                                    <label class="ml-2 w-28">{{ $clients->name }}</label>
                                </div>
                            @endif
                            <div class="flex ml-1">
                                <label class="w-8">Jenis</label>
                                <label class="ml-1">:</label>
                                @if ($sale->media_category->name == 'Service')
                                    <label class="ml-2 w-28">Cetak /
                                        Pasang</label>
                                @else
                                    <label class="ml-2 w-28">{{ $sale->media_category->name }}</label>
                                @endif
                            </div>
                            @if ($sale->media_category->name != 'Service')
                                <div class="flex ml-1">
                                    <label class="w-8">Periode</label>
                                    <label class="ml-1">:</label>
                                    <label class="ml-2 w-28">{{ $sale->duration }}</label>
                                </div>
                                <div class="flex ml-1">
                                    <label class="w-8">Awal</label>
                                    <label class="ml-1">:</label>
                                    @if ($sale->start_at)
                                        <label class="ml-2  w-28">{{ date('d-M-Y', strtotime($sale->start_at)) }}</label>
                                    @else
                                        <label class="ml-2 w-28">-</label>
                                    @endif
                                </div>
                                <div class="flex ml-1">
                                    <label class="w-8">Akhir</label>
                                    <label class="ml-1">:</label>
                                    @if ($sale->end_at)
                                        <label class="ml-2 w-28">{{ date('d-M-Y', strtotime($sale->end_at)) }}</label>
                                    @else
                                        <label class="ml-2 w-28">-</label>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="border border-black text-[0.65rem] text-start align-top">
                        <div>
                            <div class="flex ml-1">
                                <label class="w-14">No.</label>
                                <label>:</label>
                                @if ($quotId != null)
                                    <a href="/marketing/quotations/{{ $quotId }}"
                                        class="ml-1">{{ $number }}</a>
                                @elseif($quotRevisionId != null)
                                    <a href="/marketing/quotation-revisions/{{ $quotRevisionId }}"
                                        class="ml-1">{{ $number }}</a>
                                @endif
                            </div>
                            <div class="flex ml-1">
                                <label class="w-14">Tgl.</label>
                                <label>:</label>
                                <label class="ml-1">{{ date('d-M-Y', strtotime($created_at)) }}</label>
                            </div>
                            @if (
                                ($sale->media_category->name != 'Videotron' && $sale->media_category->name != 'Service') ||
                                    ($sale->media_category->name == 'Signage' && $description->type != 'Videotron'))
                                <div class="flex ml-1">
                                    <label class="w-14">Free Cetak</label>
                                    <label>:</label>
                                    <label class="ml-1">
                                        @if ($notes->freePrint)
                                            {{ $notes->freePrint }} x
                                        @else
                                            -
                                        @endif
                                    </label>
                                </div>
                                <div class="flex ml-1">
                                    <label class="w-14">Free Pasang</label>
                                    <label>:</label>
                                    <label class="ml-1">
                                        @if ($notes->freeInstall)
                                            {{ $notes->freeInstall }} x
                                        @else
                                            -
                                        @endif
                                    </label>
                                </div>
                            @endif
                            <div class="flex ml-1">
                                <label class="w-14">Produk</label>
                                <label>:</label>
                                <label class="ml-1">{{ $sale->product_name }}</label>
                            </div>
                        </div>
                    </td>
                    <td class="border border-black text-[0.65rem] text-start align-top px-1">
                        <div>
                            <div class="flex ml-1">
                                @if ($sale->void_sale)
                                    @if (count($voidSale) == 2)
                                        @if ($loop->iteration < count($sales))
                                            @if ($sale->id == $sales[$loop->iteration]->id)
                                                <label class="w-12">Harga</label>
                                                <label>:</label>
                                                <label class="ml-1 w-16 text-right">{{ $sale->price }}</label>
                                            @else
                                                <div>
                                                    <div class="flex">
                                                        <label class="w-12 text-red-800">Harga</label>
                                                        <label>:</label>
                                                        <label
                                                            class="ml-1 w-16 text-right text-red-800">({{ $sale->price }})</label>
                                                    </div>
                                                    <div class="flex">
                                                        <label class="w-12 text-red-800">PPN</label>
                                                        <label>:</label>
                                                        <label
                                                            class="ml-1 w-16 text-right text-red-800">({{ $sale->dpp * ($sale->ppn / 100) }})</label>
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            <div>
                                                <div class="flex">
                                                    <label class="w-12 text-red-800">Harga</label>
                                                    <label>:</label>
                                                    <label
                                                        class="ml-1 w-16 text-right text-red-800">({{ $sale->price }})</label>
                                                </div>
                                                <div class="flex">
                                                    <label class="w-12 text-red-800">PPN</label>
                                                    <label>:</label>
                                                    <label
                                                        class="ml-1 w-16 text-right text-red-800">({{ $sale->dpp * ($sale->ppn / 100) }})</label>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        @if (date('m', strtotime($sale->created_at)) == request('month'))
                                            <label class="w-12">Harga</label>
                                            <label>:</label>
                                            <label class="ml-1 w-16 text-right">{{ $sale->price }}</label>
                                        @else
                                            <div>
                                                <div class="flex">
                                                    <label class="w-12 text-red-800">Harga</label>
                                                    <label>:</label>
                                                    <label
                                                        class="ml-1 w-16 text-right text-red-800">({{ $sale->price }})</label>
                                                </div>
                                                <div class="flex">
                                                    <label class="w-12 text-red-800">PPN</label>
                                                    <label>:</label>
                                                    <label
                                                        class="ml-1 w-16 text-right text-red-800">({{ $sale->dpp * ($sale->ppn / 100) }})</label>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @elseif ($sale->change_sale)
                                    @if (count($changeSale) == 2)
                                        @if ($loop->iteration < count($sales))
                                            @if ($sale->id == $sales[$loop->iteration]->id)
                                                <label class="w-12">Harga</label>
                                                <label>:</label>
                                                <label class="ml-1 w-16 text-right">{{ $sale->price }}</label>
                                            @else
                                                <label class="w-12 text-red-700">Selisih</label>
                                                <label>:</label>
                                                <label
                                                    class="ml-1 w-16 text-right text-red-700">{{ $sale->change_sale->price_diff }}</label>
                                            @endif
                                        @else
                                            <label class="w-12 text-red-700">Selisih</label>
                                            <label>:</label>
                                            <label
                                                class="ml-1 w-16 text-right text-red-700">{{ $sale->change_sale->price_diff }}</label>
                                        @endif
                                    @else
                                        @if (date('m', strtotime($sale->created_at)) == request('month'))
                                            <label class="w-12">Harga</label>
                                            <label>:</label>
                                            <label class="ml-1 w-16 text-right">{{ $sale->price }}</label>
                                        @else
                                            <label class="w-12 text-red-700">Selisih</label>
                                            <label>:</label>
                                            <label
                                                class="ml-1 w-16 text-right text-red-700">{{ $sale->change_sale->price_diff }}</label>
                                        @endif
                                    @endif
                                @else
                                    <label class="w-12">Harga</label>
                                    <label>:</label>
                                    <label class="ml-1 w-16 text-right">{{ $sale->price }}</label>
                                @endif
                            </div>
                            @if ($sale->void_sale)
                                @if (count($voidSale) == 2)
                                    @if ($loop->iteration < count($sales))
                                        @if ($sale->id == $sales[$loop->iteration]->id)
                                            @if ($sale->dpp != $sale->price)
                                                <div class="flex ml-1">
                                                    <label class="w-12">DPP</label>
                                                    <label>:</label>
                                                    <label class="ml-1 w-16 text-right">
                                                        {{ $sale->dpp }}
                                                    </label>
                                                </div>
                                            @endif
                                            <div class="flex ml-1">
                                                <label class="w-12">PPN
                                                </label>
                                                <label>:</label>
                                                <label class="ml-1 w-16 text-right">
                                                    {{ $sale->dpp * ($sale->ppn / 100) }}
                                                </label>
                                            </div>
                                            <div class="flex ml-1 border-t border-black">
                                                <label class="w-12">Total</label>
                                                <label>:</label>
                                                <label class="ml-1 w-16 text-right">
                                                    {{ $sale->price + $sale->dpp * ($sale->ppn / 100) }}
                                                </label>
                                            </div>
                                        @else
                                            <div class="flex ml-1 text-red-700">
                                                <label class="w-12">PPN</label>
                                                <label>:</label>
                                                <label class="ml-1 w-16 text-right">
                                                    ({{ $sale->void_sale->ppn }})
                                                </label>
                                            </div>
                                            <div class="flex px-1 mt-2 font-semibold text-red-700 border-b border-red-700">
                                                Pembatalan
                                            </div>
                                            <div class="flex px-1 text-red-700 w-full text-justify">
                                                {{ $sale->void_sale->note }}
                                            </div>
                                        @endif
                                    @else
                                        <div class="flex ml-1 text-red-700">
                                            <label class="w-12">PPN</label>
                                            <label>:</label>
                                            <label class="ml-1 w-16 text-right">
                                                ({{ $sale->void_sale->ppn }})
                                            </label>
                                        </div>
                                        <div class="flex px-1 mt-2 font-semibold text-red-700 border-b border-red-700">
                                            Pembatalan
                                        </div>
                                        <div class="flex px-1 text-red-700 w-full text-justify">
                                            {{ $sale->void_sale->note }}
                                        </div>
                                    @endif
                                @else
                                    @if (date('m', strtotime($sale->created_at)) == request('month'))
                                        @if ($sale->dpp != $sale->price)
                                            <div class="flex ml-1">
                                                <label class="w-12">DPP</label>
                                                <label>:</label>
                                                <label class="ml-1 w-16 text-right">
                                                    {{ $sale->dpp }}
                                                </label>
                                            </div>
                                        @endif
                                        <div class="flex ml-1">
                                            <label class="w-12">PPN
                                            </label>
                                            <label>:</label>
                                            <label class="ml-1 w-16 text-right">
                                                {{ $sale->dpp * ($sale->ppn / 100) }}
                                            </label>
                                        </div>
                                        <div class="flex ml-1 border-t border-black">
                                            <label class="w-12">Total</label>
                                            <label>:</label>
                                            <label class="ml-1 w-16 text-right">
                                                {{ $sale->price + $sale->dpp * ($sale->ppn / 100) }}
                                            </label>
                                        </div>
                                    @else
                                        <div class="flex ml-1 text-red-700">
                                            <label class="w-12">PPN</label>
                                            <label>:</label>
                                            <label class="ml-1 w-16 text-right">
                                                ({{ $sale->void_sale->ppn }})
                                            </label>
                                        </div>
                                        <div class="flex px-1 mt-2 font-semibold text-red-700 border-b border-red-700">
                                            Pembatalan
                                        </div>
                                        <div class="flex px-1 text-red-700 w-full text-justify">
                                            {{ $sale->void_sale->note }}
                                        </div>
                                    @endif
                                @endif
                            @elseif ($sale->change_sale)
                                @if (count($changeSale) == 2)
                                    @if ($loop->iteration < count($sales))
                                        @if ($sale->id == $sales[$loop->iteration]->id)
                                            @if ($sale->dpp != $sale->price)
                                                <div class="flex ml-1">
                                                    <label class="w-12">DPP</label>
                                                    <label>:</label>
                                                    <label class="ml-1 w-16 text-right">
                                                        {{ $sale->dpp }}
                                                    </label>
                                                </div>
                                            @endif
                                            <div class="flex ml-1">
                                                <label class="w-12">PPN
                                                </label>
                                                <label>:</label>
                                                <label class="ml-1 w-16 text-right">
                                                    {{ $sale->dpp * ($sale->ppn / 100) }}
                                                </label>
                                            </div>
                                            <div class="flex ml-1 border-t border-black">
                                                <label class="w-12">Total</label>
                                                <label>:</label>
                                                <label class="ml-1 w-16 text-right">
                                                    {{ $sale->price + $sale->dpp * ($sale->ppn / 100) }}
                                                </label>
                                            </div>
                                        @else
                                            <div class="flex ml-1 text-red-700">
                                                <label class="w-12">PPN</label>
                                                <label>:</label>
                                                <label class="ml-1 w-16 text-right">
                                                    {{ $sale->change_sale->ppn_diff }}
                                                </label>
                                            </div>
                                            <div class="flex px-1 mt-2 font-semibold text-red-700 border-b border-red-700">
                                                Perubahan
                                            </div>
                                            <div class="flex w-full px-1 text-red-700">
                                                {{ $sale->change_sale->note }}
                                            </div>
                                        @endif
                                    @else
                                        <div class="flex ml-1 text-red-700">
                                            <label class="w-12">PPN</label>
                                            <label>:</label>
                                            <label class="ml-1 w-16 text-right">
                                                {{ $sale->change_sale->ppn_diff }}
                                            </label>
                                        </div>
                                        <div class="flex px-1 mt-2 font-semibold text-red-700 border-b border-red-700">
                                            Perubahan
                                        </div>
                                        <div class="flex w-full px-1 text-red-700">
                                            {{ $sale->change_sale->note }}
                                        </div>
                                    @endif
                                @else
                                    @if (date('m', strtotime($sale->created_at)) == request('month'))
                                        @if ($sale->dpp != $sale->price)
                                            <div class="flex ml-1">
                                                <label class="w-12">DPP</label>
                                                <label>:</label>
                                                <label class="ml-1 w-16 text-right">
                                                    {{ $sale->dpp }}
                                                </label>
                                            </div>
                                        @endif
                                        <div class="flex ml-1">
                                            <label class="w-12">PPN
                                            </label>
                                            <label>:</label>
                                            <label class="ml-1 w-16 text-right">
                                                {{ $sale->dpp * ($sale->ppn / 100) }}
                                            </label>
                                        </div>
                                        <div class="flex ml-1 border-t border-black">
                                            <label class="w-12">Total</label>
                                            <label>:</label>
                                            <label class="ml-1 w-16 text-right">
                                                {{ $sale->price + $sale->dpp * ($sale->ppn / 100) }}
                                            </label>
                                        </div>
                                    @else
                                        <div class="flex ml-1 text-red-700">
                                            <label class="w-12">PPN</label>
                                            <label>:</label>
                                            <label class="ml-1 w-16 text-right">
                                                {{ $sale->change_sale->ppn_diff }}
                                            </label>
                                        </div>
                                        <div class="flex px-1 mt-2 font-semibold text-red-700 border-b border-red-700">
                                            Perubahan
                                        </div>
                                        <div class="flex w-full px-1 text-red-700">
                                            {{ $sale->change_sale->note }}
                                        </div>
                                    @endif
                                @endif
                            @else
                                @if ($sale->dpp != $sale->price)
                                    <div class="flex ml-1">
                                        <label class="w-12">DPP</label>
                                        <label>:</label>
                                        <label class="ml-1 w-16 text-right">
                                            {{ $sale->dpp }}
                                        </label>
                                    </div>
                                @endif
                                <div class="flex ml-1">
                                    <label class="w-12">PPN
                                    </label>
                                    <label>:</label>
                                    <label class="ml-1 w-16 text-right">
                                        {{ $sale->dpp * ($sale->ppn / 100) }}
                                    </label>
                                </div>
                                <div class="flex ml-1 border-t border-black">
                                    <label class="w-12">Total</label>
                                    <label>:</label>
                                    <label class="ml-1 w-16 text-right">
                                        {{ $sale->price + $sale->dpp * ($sale->ppn / 100) }}
                                    </label>
                                </div>
                            @endif
                        </div>
                    </td>
                    @if ($sale->void_sale)
                        @if ($loop->iteration < count($sales))
                            @if ($sale->id == $sales[$loop->iteration]->id)
                                <td class="border border-black text-[0.65rem] text-center align-top">
                                    <div>
                                        @foreach ($payment_terms->dataPayments as $terms)
                                            <div class="flex ml-1 justify-center">
                                                <label>{{ $terms->term }} %</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="border border-black text-[0.65rem] text-center align-top">
                                    <div>
                                        @foreach ($payment_terms->dataPayments as $terms)
                                            <div class="flex mr-1 justify-end">
                                                <label>{{ $sale->price * ($terms->term / 100) }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="border border-black text-[0.65rem] text-center align-top">
                                    <div>
                                        @foreach ($payment_terms->dataPayments as $terms)
                                            <div class="flex mr-1 justify-end">
                                                <label>{{ $sale->dpp * ($terms->term / 100) * ($sale->ppn / 100) }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="border border-black text-[0.65rem] text-center align-top">
                                    <div>
                                        @foreach ($payment_terms->dataPayments as $terms)
                                            <div class="flex mr-1 justify-end">
                                                <label>{{ $sale->dpp * ($terms->term / 100) * (2 / 100) }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="border border-black text-[0.65rem] text-center align-top">
                                    <div>
                                        @foreach ($payment_terms->dataPayments as $terms)
                                            <div class="flex mr-1 justify-end">
                                                @if ($sale->dpp)
                                                    @php
                                                        $subTotal = $sale->price * ($terms->term / 100);
                                                        $ppnTerm =
                                                            $sale->dpp * ($terms->term / 100) * ($sale->ppn / 100);
                                                        $pphTerm = $sale->dpp * ($terms->term / 100) * (2 / 100);
                                                    @endphp
                                                    <label>{{ $subTotal + $ppnTerm - $pphTerm }}</label>
                                                @else
                                                    <label>{{ $sale->price * ($terms->term / 100) }}</label>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                            @else
                                <td class="border border-black text-[0.65rem] text-center align-top">
                                </td>
                                <td class="border border-black text-[0.65rem] text-center align-top">
                                </td>
                                <td class="border border-black text-[0.65rem] text-center align-top">
                                </td>
                                <td class="border border-black text-[0.65rem] text-center align-top">
                                </td>
                                <td class="border border-black text-[0.65rem] text-center align-top">
                                </td>
                            @endif
                        @else
                            <td class="border border-black text-[0.65rem] text-center align-top">
                            </td>
                            <td class="border border-black text-[0.65rem] text-center align-top">
                            </td>
                            <td class="border border-black text-[0.65rem] text-center align-top">
                            </td>
                            <td class="border border-black text-[0.65rem] text-center align-top">
                            </td>
                            <td class="border border-black text-[0.65rem] text-center align-top">
                            </td>
                        @endif
                    @elseif ($sale->change_sale)
                        @if ($loop->iteration < count($sales))
                            @if ($sale->id == $sales[$loop->iteration]->id)
                                <td class="border border-black text-[0.65rem] text-center align-top">
                                    <div>
                                        @foreach ($payment_terms->dataPayments as $terms)
                                            <div class="flex ml-1 justify-center">
                                                <label>{{ $terms->term }} %</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="border border-black text-[0.65rem] text-center align-top">
                                    <div>
                                        @foreach ($payment_terms->dataPayments as $terms)
                                            <div class="flex mr-1 justify-end">
                                                <label>{{ $sale->price * ($terms->term / 100) }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="border border-black text-[0.65rem] text-center align-top">
                                    <div>
                                        @foreach ($payment_terms->dataPayments as $terms)
                                            <div class="flex mr-1 justify-end">
                                                <label>{{ $sale->dpp * ($terms->term / 100) * ($sale->ppn / 100) }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="border border-black text-[0.65rem] text-center align-top">
                                    <div>
                                        @foreach ($payment_terms->dataPayments as $terms)
                                            <div class="flex mr-1 justify-end">
                                                <label>{{ $sale->dpp * ($terms->term / 100) * (2 / 100) }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="border border-black text-[0.65rem] text-center align-top">
                                    <div>
                                        @foreach ($payment_terms->dataPayments as $terms)
                                            <div class="flex mr-1 justify-end">
                                                @if ($sale->dpp)
                                                    @php
                                                        $subTotal = $sale->price * ($terms->term / 100);
                                                        $ppnTerm =
                                                            $sale->dpp * ($terms->term / 100) * ($sale->ppn / 100);
                                                        $pphTerm = $sale->dpp * ($terms->term / 100) * (2 / 100);
                                                    @endphp
                                                    <label>{{ $subTotal + $ppnTerm - $pphTerm }}</label>
                                                @else
                                                    <label>{{ $sale->price * ($terms->term / 100) }}</label>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                            @else
                                <td class="border border-black text-[0.65rem] text-center align-top">
                                </td>
                                <td class="border border-black text-[0.65rem] text-center align-top">
                                </td>
                                <td class="border border-black text-[0.65rem] text-center align-top">
                                </td>
                                <td class="border border-black text-[0.65rem] text-center align-top">
                                </td>
                                <td class="border border-black text-[0.65rem] text-center align-top">
                                </td>
                            @endif
                        @else
                            <td class="border border-black text-[0.65rem] text-center align-top">
                            </td>
                            <td class="border border-black text-[0.65rem] text-center align-top">
                            </td>
                            <td class="border border-black text-[0.65rem] text-center align-top">
                            </td>
                            <td class="border border-black text-[0.65rem] text-center align-top">
                            </td>
                            <td class="border border-black text-[0.65rem] text-center align-top">
                            </td>
                        @endif
                    @else
                        <td class="border border-black text-[0.65rem] text-center align-top">
                            <div>
                                @foreach ($payment_terms->dataPayments as $terms)
                                    <div class="flex ml-1 justify-center">
                                        <label>{{ $terms->term }} %</label>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td class="border border-black text-[0.65rem] text-center align-top">
                            <div>
                                @foreach ($payment_terms->dataPayments as $terms)
                                    <div class="flex mr-1 justify-end">
                                        <label>{{ $sale->price * ($terms->term / 100) }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td class="border border-black text-[0.65rem] text-center align-top">
                            <div>
                                @foreach ($payment_terms->dataPayments as $terms)
                                    <div class="flex mr-1 justify-end">
                                        <label>{{ $sale->dpp * ($terms->term / 100) * ($sale->ppn / 100) }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td class="border border-black text-[0.65rem] text-center align-top">
                            <div>
                                @foreach ($payment_terms->dataPayments as $terms)
                                    <div class="flex mr-1 justify-end">
                                        <label>{{ $sale->dpp * ($terms->term / 100) * (2 / 100) }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td class="border border-black text-[0.65rem] text-center align-top">
                            <div>
                                @foreach ($payment_terms->dataPayments as $terms)
                                    <div class="flex mr-1 justify-end">
                                        @if ($sale->dpp)
                                            @php
                                                $subTotal = $sale->price * ($terms->term / 100);
                                                $ppnTerm = $sale->dpp * ($terms->term / 100) * ($sale->ppn / 100);
                                                $pphTerm = $sale->dpp * ($terms->term / 100) * (2 / 100);
                                            @endphp
                                            <label>{{ $subTotal + $ppnTerm - $pphTerm }}</label>
                                        @else
                                            <label>{{ $sale->price * ($terms->term / 100) }}</label>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </td>
                    @endif
                    <td class="border border-black text-[0.65rem] text-center align-top">
                        <div>
                            @foreach ($saleBillings as $itemBilling)
                                <a
                                    href="/accounting/billings/{{ $itemBilling->id }}">{{ $itemBilling->invoice_number }}</a>
                            @endforeach
                        </div>
                    </td>
                    <td class="border border-black text-[0.65rem] text-center align-top">
                        <div>
                            @foreach ($saleBillings as $itemBilling)
                                <span>{{ date('d', strtotime($itemBilling->created_at)) }}-{{ $sMonth[(int) date('m', strtotime($itemBilling->created_at))] }}-{{ date('Y', strtotime($itemBilling->created_at)) }}</span>
                            @endforeach
                        </div>
                    </td>
                    <td class="border border-black text-[0.65rem] text-center align-top">
                        <div>
                            @if ($sale->media_category->name == 'Service')
                                @foreach ($saleBillings as $itemBilling)
                                    @foreach (json_decode($itemBilling->invoice_content)->description as $itemDescription)
                                        @if ($itemDescription->sale_id == $sale->id)
                                            {{ $itemDescription->nominal + ($sale->ppn / 100) * $itemDescription->nominal }}
                                        @endif
                                    @endforeach
                                @endforeach
                            @else
                                @foreach ($saleBillings as $itemBilling)
                                    @if (isset(json_decode($itemBilling->invoice_content)->manual_detail))
                                        {{ $itemBilling->nominal + $itemBilling->ppn }}
                                    @elseif (isset(json_decode($itemBilling->invoice_content)->data_sales))
                                        @foreach (json_decode($itemBilling->invoice_content)->data_sales as $itemSales)
                                            @if ($itemSales->id == $sale->id)
                                                {{ $itemSales->nominal + ($sale->ppn / 100) * $itemSales->nominal }}
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach (json_decode($itemBilling->invoice_content)->description as $itemDesc)
                                            @if ($itemDesc->sale_id == $sale->id)
                                                {{ $itemDesc->nominal + ($sale->ppn / 100) * $itemDesc->nominal }}
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </td>
                    <td class="border border-black text-[0.65rem] text-center align-top">
                        <div>
                            @foreach ($saleBillings as $itemBilling)
                                @if (count($itemBilling->bill_payments) > 0)
                                    Paid
                                @else
                                    Unpaid
                                @endif
                            @endforeach
                        </div>
                    </td>
                    <td class="border border-black text-[0.65rem] text-center align-top">
                        <div>
                            @foreach ($saleBillings as $itemBilling)
                                @if (count($itemBilling->bill_payments) > 0)
                                    <span>{{ date('d', strtotime($itemBilling->bill_payments[0]->payment_date)) }}-{{ $sMonth[(int) date('m', strtotime($itemBilling->bill_payments[0]->payment_date))] }}-{{ date('Y', strtotime($itemBilling->bill_payments[0]->payment_date)) }}</span>
                                @endif
                            @endforeach
                        </div>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td class="border border-black text-sm text-right align-top font-semibold px-2" colspan="4">Sub
                    Total</td>
                <td class="border border-black text-sm text-right align-top font-semibold px-2">
                    {{ $priceTotal - $void_sales->sum('price') + $change_sales->sum('price_diff') }}
                </td>
                <td class="text-black bg-slate-200 border border-black text-sm text-right align-top font-semibold"
                    colspan="10"></td>
            </tr>
            <tr>
                <td class="border border-black text-sm text-right align-top font-semibold px-2" colspan="4">PPN
                </td>
                <td class="border border-black text-sm text-right align-top font-semibold px-2">
                    {{ $ppnTotal - $void_sales->sum('ppn') + $change_sales->sum('ppn_diff') }}
                </td>
                <td class="text-black bg-slate-200 border border-black text-sm text-right align-top font-semibold"
                    colspan="10"></td>
            </tr>
            <tr>
                <td class="border border-black text-sm text-right align-top font-semibold px-2" colspan="4">PPh
                </td>
                <td class="border border-black text-sm text-right align-top font-semibold px-2">
                    {{ $pphTotal }}</td>
                <td class="text-black bg-slate-200 border border-black text-sm text-right align-top font-semibold"
                    colspan="10"></td>
            </tr>
            <tr>
                <td class="border border-black text-sm text-right align-top font-semibold px-2" colspan="4">
                    Grand Total</td>
                <td class="border border-black text-sm text-right align-top font-semibold px-2">
                    {{ $priceTotal + $ppnTotal - $pphTotal - ($void_sales->sum('price') + $void_sales->sum('ppn')) + ($change_sales->sum('price_diff') + $change_sales->sum('ppn_diff')) }}
                </td>
                <td class="text-black bg-slate-200 border border-black text-sm text-right align-top font-semibold"
                    colspan="10"></td>
            </tr>
        </tbody>
    </table>

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
                        dpi: 96,
                        scale: 1.3,
                        letterRendering: true,
                        useCORS: true
                    },
                    jsPDF: {
                        unit: 'px',
                        format: [1590, 1020],
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
                    filename: "List C1.xls"
                });
            });
        });
    </script>
    <!-- Script end -->
@endsection
