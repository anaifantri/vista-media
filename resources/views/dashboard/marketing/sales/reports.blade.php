@extends('dashboard.layouts.main');

@section('container')
    <!-- Create Sales Report start -->
    <div>
        {{-- <input type="text" name="sales_value" id="sales_value" value="{{ $sales }}" hidden> --}}
        <div class="flex mt-10 justify-center">
            <h1 class="text-xl text-cyan-800 font-bold tracking-wider w-[1200px] border-b">LAPORAN PENJUALAN</h1>
        </div>
        <div class="flex justify-center">
            <div class="flex items-center border rounded-lg mt-2 p-2 w-[1200px]">
                <form action="/sales/reports/">
                    <input id="search" name="search" type="text" value="{{ request('search') }}" hidden>
                    <div>
                        <div class="flex">
                            <span class="text-sm  text-teal-700 font-semibold w-24">Jenis Laporan</span>
                            <span class="text-sm  text-teal-700 font-semibold ml-2">:</span>
                            @if (request('type'))
                                @if (request('type') == 'c1Report')
                                    <input class="ml-2" type="radio" name="type" id="c1Type" value="c1Report"
                                        checked>
                                    <span class="ml-2 text-sm  text-teal-700 font-semibold w-8">C1</span>
                                    <input type="radio" name="type" id="chartType" value="chartReport">
                                    <span class="ml-2 text-sm  text-teal-700 font-semibold w-12">Grafik</span>
                                @elseif (request('type') == 'chartReport')
                                    <input class="ml-2" type="radio" name="type" id="c1Type" value="c1Report">
                                    <span class="ml-2 text-sm  text-teal-700 font-semibold w-8">C1</span>
                                    <input type="radio" name="type" id="chartType" value="chartReport" checked>
                                    <span class="ml-2 text-sm  text-teal-700 font-semibold w-12">Grafik</span>
                                @endif
                            @else
                                <input class="ml-2" type="radio" name="type" id="c1Type" value="c1Report" checked>
                                <span class="ml-2 text-sm  text-teal-700 font-semibold w-8">C1</span>
                                <input type="radio" name="type" id="chartType" value="chartReport">
                                <span class="ml-2 text-sm  text-teal-700 font-semibold w-12">Grafik</span>
                            @endif
                        </div>
                        <div class="flex h-[22px]">
                            <span class="text-sm  text-teal-700 font-semibold w-24">Periode</span>
                            <span class="text-sm  text-teal-700 font-semibold ml-2">:</span>
                            @if (request('search'))
                                <input class="ml-2 outline-none text-sm text-teal-700 border rounded-lg w-36 p-1"
                                    type="month" name="monthReport" id="monthReport" value="{{ request('search') }}">
                            @else
                                <input class="ml-2 outline-none text-sm text-teal-700 border rounded-lg w-36 p-1"
                                    type="month" name="monthReport" id="monthReport">
                            @endif
                            <?php
                            $getYear = date('Y') + 1;
                            $year = [];
                            $totalYear = 0;
                            for ($i = 2014; $i <= $getYear; $i++) {
                                $totalYear = $totalYear + 1;
                            }
                            for ($i = 0; $i < $totalYear; $i++) {
                                if ($i == 0) {
                                    $year[$i] = $getYear;
                                } else {
                                    $year[$i] = $getYear - $i;
                                }
                            }
                            ?>
                            <div>
                                <select class="outline-none border w-20 text-sm text-teal-700 rounded-md ml-2"
                                    name="yearReport" id="yearReport" onmousedown="if(this.options.length>5){this.size=5;}"
                                    onchange="this.size=0" onblur="this.size=0" hidden>
                                    @for ($i = 0; $i < $totalYear; $i++)
                                        @if (request('yearReport'))
                                            @if (request('yearReport') == $year[$i])
                                                <option value="{{ $year[$i] }}" selected>{{ $year[$i] }}</option>
                                            @else
                                                <option value="{{ $year[$i] }}">{{ $year[$i] }}</option>
                                            @endif
                                        @else
                                            @if ($year[$i] == date('Y'))
                                                <option value="{{ $year[$i] }}" selected>{{ $year[$i] }}</option>
                                            @else
                                                <option value="{{ $year[$i] }}">{{ $year[$i] }}</option>
                                            @endif
                                        @endif
                                    @endfor
                                </select>
                            </div>
                            <button id="btnSubmit"
                                class="flex items-center border p-1 rounded-lg justify-center w-16 bg-slate-50 ml-2 text-sm text-teal-700 font-semibold hover:bg-slate-200"
                                type="submit">Submit</button>
                        </div>
                    </div>
                </form>
                <div id="divButton" class="flex justify-end w-full">
                    <button id="btnC1Pdf" class="hidden justify-center items-center mx-1 btn-primary" title="C1 Preview"
                        type="button">
                        <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M15 12c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-.199.02-.393.057-.581 1.474.541 2.927-.882 2.405-2.371.174-.03.354-.048.538-.048 1.657 0 3 1.344 3 3zm-2.985-7c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 12c-2.761 0-5-2.238-5-5 0-2.761 2.239-5 5-5 2.762 0 5 2.239 5 5 0 2.762-2.238 5-5 5z" />
                        </svg>
                        <span class="ml-2 text-white">Preview</span>
                    </button>
                    <button id="btnChartPdf" class="hidden justify-center items-center mx-1 btn-primary"
                        title="Chart Preview" type="button">
                        <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M15 12c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-.199.02-.393.057-.581 1.474.541 2.927-.882 2.405-2.371.174-.03.354-.048.538-.048 1.657 0 3 1.344 3 3zm-2.985-7c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 12c-2.761 0-5-2.238-5-5 0-2.761 2.239-5 5-5 2.762 0 5 2.239 5 5 0 2.762-2.238 5-5 5z" />
                        </svg>
                        <span class="ml-2 text-white">Preview</span>
                    </button>
                    <a class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-danger"
                        href="/dashboard/marketing/sales">
                        <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                        </svg>
                        <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Cancel</span>
                    </a>
                </div>
            </div>
        </div>
        <div id="c1Report" class="flex justify-center z-0 p-10">
            <?php
            if (fmod(count($sales), 5) == 0) {
                $pageQty = count($sales) / 5;
            } else {
                $pageQty = (count($sales) - fmod(count($sales), 5)) / 5 + 1;
            }
            ?>
            <div id="pdfPreview">
                @for ($i = 0; $i < $pageQty; $i++)
                    <div class="w-[1180px] h-[832px] p-4">
                        <div class="flex h-[136px] items-center border rounded-lg p-2 mt-4">
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
                                    <div class="flex justify-center w-48">
                                        <label class="text-5xl text-center">C1</label>
                                    </div>
                                    <div class="flex justify-center w-48">
                                        <label class="text-sm text-center">LAPORAN PENJUALAN</label>
                                    </div>
                                    <div class="flex justify-center w-48">
                                        <label class="text-sm text-center"></label>
                                    </div>
                                    <div class="flex justify-center w-48 border rounded-md">
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
                                </div>
                            </div>
                        </div>
                        <div class="h-[622px] mt-2">
                            <table class="table-auto">
                                <thead>
                                    <tr class="bg-teal-100">
                                        <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-6" rowspan="2">
                                            No.
                                        </th>
                                        <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-44 text-center"
                                            rowspan="2">
                                            <button class="flex justify-center items-center w-44">@sortablelink('number', 'Data Penjualan')
                                                <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24">
                                                    <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                                </svg>
                                            </button>
                                        </th>
                                        <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-40" rowspan="2">
                                            Klien
                                        </th>
                                        <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-32" rowspan="2">
                                            Penawaran
                                        </th>
                                        <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-[340px]"
                                            colspan="5">
                                            Termin
                                            Pembayaran</th>
                                        <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-40" colspan="2">
                                            Penagihan
                                        </th>
                                        <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-36" colspan="2">
                                            Pembayaran
                                        </th>
                                    </tr>
                                    <tr class="bg-teal-100">
                                        <th class="text-teal-700 border text-[0.65rem] w-10">Termin</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-20">Nominal (Rp.)</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-[72px]">PPN (Rp.)</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-16">PPh (Rp.)</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-20">Total (Rp.)</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-20">No. Invoice</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-20">Tgl. Invoice</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-[72px]">Jadwal Bayar</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-[72px]">Tgl. Bayar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales as $sale)
                                        @if ($i == 0)
                                            @if ($loop->iteration < 6)
                                                <tr>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                        {{ $loop->iteration }}</td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                                        <div>
                                                            <div class="flex ml-1">
                                                                <label class="w-8">No.</label>
                                                                <label class="ml-1">:</label>
                                                                <label
                                                                    class="ml-2 w-32">{{ Str::substr($sale->number, 0, 4) }}</label>
                                                            </div>
                                                            <div class="flex ml-1">
                                                                <label class="w-8">Tgl.</label>
                                                                <label class="ml-1">:</label>
                                                                <label
                                                                    class="ml-2 w-32">{{ date('d-M-Y', strtotime($sale->created_at)) }}</label>
                                                            </div>
                                                            <div class="flex ml-1">
                                                                <label class="w-8">Oleh</label>
                                                                <label class="ml-1">:</label>
                                                                <label class="ml-2 w-32">{{ $sale->user->name }}</label>
                                                            </div>
                                                            <div class="flex ml-1">
                                                                <label class="w-8">Kode</label>
                                                                <label class="ml-1">:</label>
                                                                <label
                                                                    class="ml-2 w-32">{{ $sale->billboard->code }}</label>
                                                            </div>
                                                            <div class="flex ml-1">
                                                                <label class="w-8">Lokasi</label>
                                                                <label class="ml-1">:</label>
                                                                <label
                                                                    class="ml-2 w-32">{{ $sale->billboard->address }}</label>
                                                            </div>
                                                            <div class="flex ml-1">
                                                                <label class="w-8">Size</label>
                                                                <label class="ml-1">:</label>
                                                                <label
                                                                    class="ml-2 w-32">{{ $sale->billboard->size->size }}</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                                        <div>
                                                            <div class="flex ml-1">
                                                                <label class="w-8">Klien</label>
                                                                <label class="ml-1">:</label>
                                                                <label class="ml-2 w-28">{{ $sale->client->name }}</label>
                                                            </div>
                                                            <div class="flex ml-1">
                                                                <label class="w-8">Kontak</label>
                                                                <label class="ml-1">:</label>
                                                                <label
                                                                    class="ml-2 w-28">{{ $sale->contact->name }}</label>
                                                            </div>
                                                            <div class="flex ml-1">
                                                                <label class="w-8">Jenis</label>
                                                                <label class="ml-1">:</label>
                                                                <label class="ml-2 w-28">{{ $sale->category }}</label>
                                                            </div>
                                                            <div class="flex ml-1">
                                                                <label class="w-8">Periode</label>
                                                                <label class="ml-1">:</label>
                                                                <label class="ml-2 w-28">{{ $sale->duration }}</label>
                                                            </div>
                                                            <div class="flex ml-1">
                                                                <label class="w-8">Awal</label>
                                                                <label class="ml-1">:</label>
                                                                @if ($sale->start_at)
                                                                    <label
                                                                        class="ml-2  w-28">{{ date('d-M-Y', strtotime($sale->start_at)) }}</label>
                                                                @else
                                                                    <label class="ml-2 w-28">-</label>
                                                                @endif
                                                            </div>
                                                            <div class="flex ml-1">
                                                                <label class="w-8">Akhir</label>
                                                                <label class="ml-1">:</label>
                                                                @if ($sale->end_at)
                                                                    <label
                                                                        class="ml-2 w-28">{{ date('d-M-Y', strtotime($sale->end_at)) }}</label>
                                                                @else
                                                                    <label class="ml-2 w-28">-</label>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <?php
                                                    $quotID = '';
                                                    $quot = '';
                                                    ?>
                                                    @if ($sale->billboard_quotation_id)
                                                        <?php
                                                        $quotID = $sale->billboard_quotation_id;
                                                        $quot = 'Main';
                                                        ?>
                                                        <td
                                                            class="text-teal-700 border text-[0.65rem] text-start align-top">
                                                            <div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-8">No.</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label
                                                                        class="ml-2">{{ Str::substr($sale->billboard_quotation->number, 0, 4) }}</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-8">Tgl.</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label
                                                                        class="ml-2">{{ date('d-M-Y', strtotime($sale->billboard_quotation->created_at)) }}</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-8">Harga</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label
                                                                        class="ml-2">{{ number_format($sale->price) }}</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-8">DPP</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label
                                                                        class="ml-2">{{ number_format($sale->dpp) }}</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-8">PPN</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label
                                                                        class="ml-2">{{ number_format($sale->dpp * (11 / 100)) }}</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-8">PPh 23</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label
                                                                        class="ml-2">{{ number_format($sale->dpp * (2 / 100)) }}</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-14">Free Cetak</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label class="ml-2">{{ $sale->free_print }}
                                                                        x</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-14">Free Pasang</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label class="ml-2">{{ $sale->free_instalation }}
                                                                        x</label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    @elseif($sale->billboard_quot_revision_id)
                                                        <?php
                                                        $quotID = $sale->billboard_quot_revision_id;
                                                        $quot = 'Revision';
                                                        ?>
                                                        <td
                                                            class="text-teal-700 border text-[0.65rem] text-start align-top">
                                                            <div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-8">No.</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label
                                                                        class="ml-2">{{ Str::substr($sale->billboard_quot_revision->number, 0, 9) }}</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-8">Tgl.</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label
                                                                        class="ml-2">{{ date('d-M-Y', strtotime($sale->billboard_quot_revision->created_at)) }}</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-8">Harga</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label
                                                                        class="ml-2">{{ number_format($sale->price) }}</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-8">DPP</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label
                                                                        class="ml-2">{{ number_format($sale->dpp) }}</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-8">PPN</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label
                                                                        class="ml-2">{{ number_format($sale->dpp * (11 / 100)) }}</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-8">PPh 23</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label
                                                                        class="ml-2">{{ number_format($sale->dpp * (2 / 100)) }}</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-14">Free Cetak</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label class="ml-2">{{ $sale->free_print }}
                                                                        x</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-14">Free Pasang</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label class="ml-2">{{ $sale->free_instalation }}
                                                                        x</label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    @endif
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                        <div>
                                                            <?php
                                                            $objPayments = json_decode($sale->terms_of_payment);
                                                            $payments = $objPayments->payments;
                                                            ?>
                                                            @foreach ($payments as $terms)
                                                                <div class="flex ml-1 justify-center">
                                                                    <label>{{ $terms->termValue }} %</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                        <div>
                                                            <?php
                                                            $nominal = [];
                                                            ?>
                                                            @foreach ($payments as $terms)
                                                                <div class="flex mr-1 justify-end">
                                                                    <label>{{ number_format($sale->price * ($terms->termValue / 100)) }}</label>
                                                                </div>
                                                                <?php
                                                                $nominal[$loop->iteration - 1] = $sale->price * ($terms->termValue / 100);
                                                                ?>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                        <div>
                                                            <?php
                                                            $ppn = [];
                                                            ?>
                                                            @foreach ($payments as $terms)
                                                                <div class="flex mr-1 justify-end">
                                                                    <label>{{ number_format($sale->dpp * ($terms->termValue / 100) * (11 / 100)) }}</label>
                                                                </div>
                                                                <?php
                                                                $ppn[$loop->iteration - 1] = $sale->dpp * ($terms->termValue / 100) * (11 / 100);
                                                                ?>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                        <div>
                                                            <?php
                                                            $pph = [];
                                                            ?>
                                                            @foreach ($payments as $terms)
                                                                <div class="flex mr-1 justify-end">
                                                                    <label>{{ number_format($sale->dpp * ($terms->termValue / 100) * (2 / 100)) }}</label>
                                                                </div>
                                                                <?php
                                                                $pph[$loop->iteration - 1] = $sale->dpp * ($terms->termValue / 100) * (2 / 100);
                                                                ?>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                        <div>
                                                            @foreach ($payments as $terms)
                                                                <div class="flex mr-1 justify-end">
                                                                    <label>{{ number_format($nominal[$loop->iteration - 1] + $ppn[$loop->iteration - 1] - $pph[$loop->iteration - 1]) }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                    </td>
                                                </tr>
                                            @endif
                                        @else
                                            @if ($loop->iteration > $i * 5 && $loop->iteration < ($i + 1) * 5 + 1)
                                                <tr>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                        {{ $loop->iteration }}</td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                                        <div>
                                                            <div class="flex ml-1">
                                                                <label class="w-8">No.</label>
                                                                <label class="ml-1">:</label>
                                                                <label
                                                                    class="ml-2 w-32">{{ Str::substr($sale->number, 0, 4) }}</label>
                                                            </div>
                                                            <div class="flex ml-1">
                                                                <label class="w-8">Tgl.</label>
                                                                <label class="ml-1">:</label>
                                                                <label
                                                                    class="ml-2 w-32">{{ date('d-M-Y', strtotime($sale->created_at)) }}</label>
                                                            </div>
                                                            <div class="flex ml-1">
                                                                <label class="w-8">Oleh</label>
                                                                <label class="ml-1">:</label>
                                                                <label class="ml-2 w-32">{{ $sale->user->name }}</label>
                                                            </div>
                                                            <div class="flex ml-1">
                                                                <label class="w-8">Kode</label>
                                                                <label class="ml-1">:</label>
                                                                <label
                                                                    class="ml-2 w-32">{{ $sale->billboard->code }}</label>
                                                            </div>
                                                            <div class="flex ml-1">
                                                                <label class="w-8">Lokasi</label>
                                                                <label class="ml-1">:</label>
                                                                <label
                                                                    class="ml-2 w-32">{{ $sale->billboard->address }}</label>
                                                            </div>
                                                            <div class="flex ml-1">
                                                                <label class="w-8">Size</label>
                                                                <label class="ml-1">:</label>
                                                                <label
                                                                    class="ml-2 w-32">{{ $sale->billboard->size->size }}</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                                        <div>
                                                            <div class="flex ml-1">
                                                                <label class="w-8">Klien</label>
                                                                <label class="ml-1">:</label>
                                                                <label class="ml-2 w-28">{{ $sale->client->name }}</label>
                                                            </div>
                                                            <div class="flex ml-1">
                                                                <label class="w-8">Kontak</label>
                                                                <label class="ml-1">:</label>
                                                                <label
                                                                    class="ml-2 w-28">{{ $sale->contact->name }}</label>
                                                            </div>
                                                            <div class="flex ml-1">
                                                                <label class="w-8">Jenis</label>
                                                                <label class="ml-1">:</label>
                                                                <label class="ml-2 w-28">{{ $sale->category }}</label>
                                                            </div>
                                                            <div class="flex ml-1">
                                                                <label class="w-8">Periode</label>
                                                                <label class="ml-1">:</label>
                                                                <label class="ml-2 w-28">{{ $sale->duration }}</label>
                                                            </div>
                                                            <div class="flex ml-1">
                                                                <label class="w-8">Awal</label>
                                                                <label class="ml-1">:</label>
                                                                @if ($sale->start_at)
                                                                    <label
                                                                        class="ml-2  w-28">{{ date('d-M-Y', strtotime($sale->start_at)) }}</label>
                                                                @else
                                                                    <label class="ml-2 w-28">-</label>
                                                                @endif
                                                            </div>
                                                            <div class="flex ml-1">
                                                                <label class="w-8">Akhir</label>
                                                                <label class="ml-1">:</label>
                                                                @if ($sale->end_at)
                                                                    <label
                                                                        class="ml-2 w-28">{{ date('d-M-Y', strtotime($sale->end_at)) }}</label>
                                                                @else
                                                                    <label class="ml-2 w-28">-</label>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <?php
                                                    $quotID = '';
                                                    $quot = '';
                                                    ?>
                                                    @if ($sale->billboard_quotation_id)
                                                        <?php
                                                        $quotID = $sale->billboard_quotation_id;
                                                        $quot = 'Main';
                                                        ?>
                                                        <td
                                                            class="text-teal-700 border text-[0.65rem] text-start align-top">
                                                            <div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-8">No.</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label
                                                                        class="ml-2">{{ Str::substr($sale->billboard_quotation->number, 0, 4) }}</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-8">Tgl.</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label
                                                                        class="ml-2">{{ date('d-M-Y', strtotime($sale->billboard_quotation->created_at)) }}</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-8">Harga</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label
                                                                        class="ml-2">{{ number_format($sale->price) }}</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-8">DPP</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label
                                                                        class="ml-2">{{ number_format($sale->dpp) }}</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-8">PPN</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label
                                                                        class="ml-2">{{ number_format($sale->dpp * (11 / 100)) }}</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-8">PPh 23</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label
                                                                        class="ml-2">{{ number_format($sale->dpp * (2 / 100)) }}</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-14">Free Cetak</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label class="ml-2">{{ $sale->free_print }}
                                                                        x</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-14">Free Pasang</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label class="ml-2">{{ $sale->free_instalation }}
                                                                        x</label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    @elseif($sale->billboard_quot_revision_id)
                                                        <?php
                                                        $quotID = $sale->billboard_quot_revision_id;
                                                        $quot = 'Revision';
                                                        ?>
                                                        <td
                                                            class="text-teal-700 border text-[0.65rem] text-start align-top">
                                                            <div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-8">No.</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label
                                                                        class="ml-2">{{ Str::substr($sale->billboard_quot_revision->number, 0, 9) }}</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-8">Tgl.</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label
                                                                        class="ml-2">{{ date('d-M-Y', strtotime($sale->billboard_quot_revision->created_at)) }}</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-8">Harga</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label
                                                                        class="ml-2">{{ number_format($sale->price) }}</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-8">DPP</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label
                                                                        class="ml-2">{{ number_format($sale->dpp) }}</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-8">PPN</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label
                                                                        class="ml-2">{{ number_format($sale->dpp * (11 / 100)) }}</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-8">PPh 23</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label
                                                                        class="ml-2">{{ number_format($sale->dpp * (2 / 100)) }}</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-14">Free Cetak</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label class="ml-2">{{ $sale->free_print }}
                                                                        x</label>
                                                                </div>
                                                                <div class="flex ml-1">
                                                                    <label class="w-14">Free Pasang</label>
                                                                    <label class="ml-1">:</label>
                                                                    <label class="ml-2">{{ $sale->free_instalation }}
                                                                        x</label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    @endif
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                        <div>
                                                            <?php
                                                            $objPayments = json_decode($sale->terms_of_payment);
                                                            $payments = $objPayments->payments;
                                                            ?>
                                                            @foreach ($payments as $terms)
                                                                <div class="flex ml-1 justify-center">
                                                                    <label>{{ $terms->termValue }} %</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                        <div>
                                                            <?php
                                                            $nominal = [];
                                                            ?>
                                                            @foreach ($payments as $terms)
                                                                <div class="flex mr-1 justify-end">
                                                                    <label>{{ number_format($sale->price * ($terms->termValue / 100)) }}</label>
                                                                </div>
                                                                <?php
                                                                $nominal[$loop->iteration - 1] = $sale->price * ($terms->termValue / 100);
                                                                ?>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                        <div>
                                                            <?php
                                                            $ppn = [];
                                                            ?>
                                                            @foreach ($payments as $terms)
                                                                <div class="flex mr-1 justify-end">
                                                                    <label>{{ number_format($sale->dpp * ($terms->termValue / 100) * (11 / 100)) }}</label>
                                                                </div>
                                                                <?php
                                                                $ppn[$loop->iteration - 1] = $sale->dpp * ($terms->termValue / 100) * (11 / 100);
                                                                ?>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                        <div>
                                                            <?php
                                                            $pph = [];
                                                            ?>
                                                            @foreach ($payments as $terms)
                                                                <div class="flex mr-1 justify-end">
                                                                    <label>{{ number_format($sale->dpp * ($terms->termValue / 100) * (2 / 100)) }}</label>
                                                                </div>
                                                                <?php
                                                                $pph[$loop->iteration - 1] = $sale->dpp * ($terms->termValue / 100) * (2 / 100);
                                                                ?>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                        <div>
                                                            @foreach ($payments as $terms)
                                                                <div class="flex mr-1 justify-end">
                                                                    <label>{{ number_format($nominal[$loop->iteration - 1] + $ppn[$loop->iteration - 1] - $pph[$loop->iteration - 1]) }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                    </td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- </div> --}}
                        {{-- <div class="flex justify-end mt-1 text-teal-900">
                            <label for="">Halaman {{ $i + 1 }} dari {{ $pageQty }}</label>
                        </div> --}}
                    </div>
                @endfor
            </div>
        </div>
        <div id="chartReport" class="hidden justify-center z-0 p-10">
            <?php
            if (fmod(count($billboards), 30) == 0) {
                $pageQtyChart = count($sales) / 30;
            } else {
                $pageQtyChart = (count($billboards) - fmod(count($billboards), 30)) / 30 + 1;
            }
            ?>
            <div id="pdfChartPreview">
                @for ($j = 0; $j < $pageQtyChart; $j++)
                    <div class="w-[1280px] h-[890px] p-6 mt-2">
                        <div class="flex h-[100px] items-center border rounded-lg p-2 mt-4">
                            <div class="w-28">
                                <img class="ml-2" src="/img/logo-vm.png" alt="">
                            </div>
                            <div class="w-[450px] ml-6">
                                <div>
                                    <span class="text-xs font-semibold">PT. Vista Media</span>
                                </div>
                                <div>
                                    <span class="text-[0.7rem]">Jl. Pulau Kawe No. 40 - Dauh Puri Kauh</span>
                                </div>
                                <div>
                                    <span class="text-[0.7rem]">Kota Denpasar, Bali 80114</span>
                                </div>
                                <div>
                                    <span class="text-[0.7rem]">Ph. +62 361 230000 | Fax. +62 361 237800 </span>
                                </div>
                                <div>
                                    <span class="text-[0.7rem]">e-mail : info@vistamedia.co.id |
                                        www.vistamedia.co.id</span>
                                </div>
                            </div>
                            <div class="flex w-full justify-end">
                                <div>
                                    <div class="flex justify-center w-60">
                                        <label class="text-3xl text-center border rounded-md p-1">1. BALI</label>
                                    </div>
                                    <div class="flex justify-center w-60">
                                        <label class="text-sm text-center">GRAFIK PERIODE KONTRAK</label>
                                    </div>
                                    <div class="flex justify-center w-60">
                                        <label class="text-sm text-center"></label>
                                    </div>
                                    <div class="flex justify-center w-60 border rounded-md">
                                        <?php
                                        $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                        ?>
                                        <label id="labelPeriode" class="month-report">
                                            <span class="text-md font-semibold text-red-600">Tgl. Cetak : </span>
                                            {{ date('d') }} {{ $bulan[(int) date('m')] }} {{ date('Y') }}</label>
                                    </div>
                                </div>
                                <div class=" ml-4 mt-1">
                                    <div class="flex justify-center items-center w-24 border rounded-md p-1">
                                        <label class="text-4xl font-semibold text-center">H</label>
                                    </div>
                                    <div class="flex justify-center items-center w-24 border rounded-md mt-1">
                                        @if (request('yearReport'))
                                            <label
                                                class="text-xl font-semibold text-center">{{ request('yearReport') }}</label>
                                        @else
                                            <label class="text-xl font-semibold text-center">2024</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="h-[622px] mt-2">
                            <table class="table-auto w-full">
                                <thead>
                                    <tr class="bg-teal-100 h-6">
                                        <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-8" rowspan="2">
                                            No.
                                        </th>
                                        <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-16 text-center"
                                            rowspan="2">
                                            <button class="flex justify-center items-center w-16">@sortablelink('code', 'Kode')
                                                <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24">
                                                    <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                                </svg>
                                            </button>
                                        </th>
                                        <th class="text-teal-700 sticky top-0 border text-[0.65rem]" rowspan="2">Lokasi
                                        </th>
                                        <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-8" rowspan="2">
                                            Kota</th>
                                        <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-32" colspan="3">
                                            Jenis Reklame</th>
                                        <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-48" colspan="3">
                                            Detail Kontrak</th>

                                        <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-36" colspan="2">
                                            Periode Kontrak</th>
                                        <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-[365px]"
                                            colspan="12">
                                            Grafik Periode Kontrak</th>
                                    </tr>
                                    <tr class="bg-teal-100 h-6">
                                        <th class="text-teal-700 border text-[0.65rem] w-8">Jenis</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-8">BL/FL</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-20">Size - V/H</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-24">Klien</th>
                                        <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-20">Nilai (Rp.)</th>
                                        <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-12">Durasi</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-16">Awal</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-16">Akhir</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-[31px]">Jan</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-[28px]">Feb</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-[31px]">Mar</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-[30px]">Apr</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-[31px]">Mei</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-[30px]">Jun</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-[31px]">Jul</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-[31px]">Agu</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-[30px]">Sep</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-[31px]">Okt</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-[30px]">Nov</th>
                                        <th class="text-teal-700 border text-[0.65rem] w-[31px]">Des</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($billboards as $billboard)
                                        @if ($j == 0)
                                            @if ($loop->iteration < 31)
                                                <?php
                                                $billboardSales = [];
                                                $activeClient = [];
                                                $billboardSaleNumber = 0;
                                                $saleObjects = [];
                                                $numberSales = 0;
                                                $hasClient = false;
                                                if (request('yearReport')) {
                                                    $thisYear = request('yearReport');
                                                } else {
                                                    $thisYear = date('Y');
                                                }
                                                $prevYear = $thisYear - 1;
                                                $nextYear = $thisYear + 1;
                                                ?>
                                                <tr class="h-[22px]">
                                                    <td class="text-teal-700 border text-[0.65rem] text-center">
                                                        {{ $loop->iteration }}</td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center">
                                                        {{ $billboard->code }} - {{ $billboard->city->code }}</td>
                                                    <td class="text-teal-700 border text-[0.65rem] px-1">
                                                        {{ $billboard->address }}</td>
                                                    <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                        {{ $billboard->city->code }}</td>
                                                    @if ($billboard->billboard_category->name == 'Billboard')
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">BB
                                                        </td>
                                                    @elseif ($billboard->billboard_category->name == 'Bando')
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">BD
                                                        </td>
                                                    @elseif ($billboard->billboard_category->name == 'Baliho')
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                            BLH</td>
                                                    @elseif ($billboard->billboard_category->name == 'Midiboard')
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">MB
                                                        </td>
                                                    @endif
                                                    @if ($billboard->lighting == 'Frontlight')
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">FL
                                                        </td>
                                                    @elseif ($billboard->lighting == 'Backlight')
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">BL
                                                        </td>
                                                    @elseif ($billboard->lighting == 'Nonlight')
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">NL
                                                        </td>
                                                    @endif
                                                    @if ($billboard->orientation == 'Vertikal')
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                            {{ $billboard->size->size }} - V</td>
                                                    @elseif ($billboard->orientation == 'Horizontal')
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                            {{ $billboard->size->size }} - V</td>
                                                    @endif
                                                    @foreach ($sales as $sale)
                                                        @if ($sale->billboard_id == $billboard->id)
                                                            <?php
                                                            $billboardSales[$billboardSaleNumber] = $sale;
                                                            $billboardSaleNumber = $billboardSaleNumber + 1;
                                                            ?>
                                                        @endif
                                                    @endforeach
                                                    @if ($billboardSales)
                                                        @foreach ($billboardSales as $billboardSale)
                                                            @if ($thisYear == date('Y'))
                                                                @if (strtotime($billboardSale->end_at) > strtotime(date('Y/m/d')))
                                                                    <?php
                                                                    $activeClient[0] = $billboardSale;
                                                                    $startThisYear = 0;
                                                                    $diffPrevYear = 0;
                                                                    $diffThisYear = 0;
                                                                    $endPrevYear = strtotime(date($prevYear . '-12-31'));
                                                                    if (strtotime($billboardSale->start_at) <= $endPrevYear && strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01'))) {
                                                                        $diffPrevYear = ($endPrevYear - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime($billboardSale->end_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $startThisYear = 0;
                                                                    } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) <= strtotime(date($thisYear . '-12-31'))) {
                                                                        $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime($billboardSale->end_at) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                    } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) >= strtotime(date($nextYear . '-01-01'))) {
                                                                        $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime(date($thisYear . '-12-31')) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                    }
                                                                    $saleObjects[$numberSales] = (object) [
                                                                        'active' => true,
                                                                        'start' => $startThisYear,
                                                                        'end' => $startThisYear + $diffThisYear,
                                                                        'client' => $billboardSale->client->name,
                                                                    ];
                                                                    $numberSales = $numberSales + 1;
                                                                    ?>
                                                                @else
                                                                    <?php
                                                                    $startThisYear = 0;
                                                                    $diffPrevYear = 0;
                                                                    $diffThisYear = 0;
                                                                    $endPrevYear = strtotime(date($prevYear . '-12-31'));
                                                                    if (strtotime($billboardSale->start_at) <= $endPrevYear && strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01'))) {
                                                                        $diffPrevYear = ($endPrevYear - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime($billboardSale->end_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $startThisYear = 0;
                                                                    } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) <= strtotime(date($thisYear . '-12-31'))) {
                                                                        $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime($billboardSale->end_at) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                    } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) >= strtotime(date($nextYear . '-01-01'))) {
                                                                        $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime(date($thisYear . '-12-31')) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                    }
                                                                    $saleObjects[$numberSales] = (object) [
                                                                        'active' => false,
                                                                        'start' => $startThisYear,
                                                                        'end' => $startThisYear + $diffThisYear,
                                                                        'client' => $billboardSale->client->name,
                                                                    ];
                                                                    $numberSales = $numberSales + 1;
                                                                    ?>
                                                                @endif
                                                            @elseif ($thisYear > date('Y'))
                                                                @if (strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01')))
                                                                    <?php
                                                                    $activeClient[0] = $billboardSale;
                                                                    $startThisYear = 0;
                                                                    $diffPrevYear = 0;
                                                                    $diffThisYear = 0;
                                                                    $endPrevYear = strtotime(date($prevYear . '-12-31'));
                                                                    if (strtotime($billboardSale->start_at) <= $endPrevYear && strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01'))) {
                                                                        $diffPrevYear = ($endPrevYear - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime($billboardSale->end_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $startThisYear = 0;
                                                                    } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) <= strtotime(date($thisYear . '-12-31'))) {
                                                                        $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime($billboardSale->end_at) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                    } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) >= strtotime(date($nextYear . '-01-01'))) {
                                                                        $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime(date($thisYear . '-12-31')) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                    }
                                                                    $saleObjects[$numberSales] = (object) [
                                                                        'active' => true,
                                                                        'start' => $startThisYear,
                                                                        'end' => $startThisYear + $diffThisYear,
                                                                        'client' => $billboardSale->client->name,
                                                                    ];
                                                                    $numberSales = $numberSales + 1;
                                                                    ?>
                                                                @else
                                                                    <?php
                                                                    $startThisYear = 0;
                                                                    $diffPrevYear = 0;
                                                                    $diffThisYear = 0;
                                                                    $endPrevYear = strtotime(date($prevYear . '-12-31'));
                                                                    if (strtotime($billboardSale->start_at) <= $endPrevYear && strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01'))) {
                                                                        $diffPrevYear = ($endPrevYear - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime($billboardSale->end_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $startThisYear = 0;
                                                                    } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) <= strtotime(date($thisYear . '-12-31'))) {
                                                                        $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime($billboardSale->end_at) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                    } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) >= strtotime(date($nextYear . '-01-01'))) {
                                                                        $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime(date($thisYear . '-12-31')) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                    }
                                                                    $saleObjects[$numberSales] = (object) [
                                                                        'active' => false,
                                                                        'start' => $startThisYear,
                                                                        'end' => $startThisYear + $diffThisYear,
                                                                        'client' => $billboardSale->client->name,
                                                                    ];
                                                                    $numberSales = $numberSales + 1;
                                                                    ?>
                                                                @endif
                                                            @elseif ($thisYear < date('Y'))
                                                                @if (strtotime($billboardSale->start_at) <= strtotime(date($thisYear . '-12-31')) &&
                                                                        strtotime($billboardSale->end_at) > strtotime(date('Y/m/d')))
                                                                    <?php
                                                                    $activeClient[0] = $billboardSale;
                                                                    $startThisYear = 0;
                                                                    $diffPrevYear = 0;
                                                                    $diffThisYear = 0;
                                                                    $endPrevYear = strtotime(date($prevYear . '-12-31'));
                                                                    if (strtotime($billboardSale->start_at) <= $endPrevYear && strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01'))) {
                                                                        $diffPrevYear = ($endPrevYear - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime($billboardSale->end_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $startThisYear = 0;
                                                                    } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) <= strtotime(date($thisYear . '-12-31'))) {
                                                                        $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime($billboardSale->end_at) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                    } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) >= strtotime(date($nextYear . '-01-01'))) {
                                                                        $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime(date($thisYear . '-12-31')) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                    }
                                                                    $saleObjects[$numberSales] = (object) [
                                                                        'active' => true,
                                                                        'start' => $startThisYear,
                                                                        'end' => $startThisYear + $diffThisYear,
                                                                        'client' => $billboardSale->client->name,
                                                                    ];
                                                                    $numberSales = $numberSales + 1;
                                                                    ?>
                                                                @else
                                                                    <?php
                                                                    $startThisYear = 0;
                                                                    $diffPrevYear = 0;
                                                                    $diffThisYear = 0;
                                                                    $endPrevYear = strtotime(date($prevYear . '-12-31'));
                                                                    if (strtotime($billboardSale->start_at) <= $endPrevYear && strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01'))) {
                                                                        $diffPrevYear = ($endPrevYear - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime($billboardSale->end_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $startThisYear = 0;
                                                                    } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) <= strtotime(date($thisYear . '-12-31'))) {
                                                                        $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime($billboardSale->end_at) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                    } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) >= strtotime(date($nextYear . '-01-01'))) {
                                                                        $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime(date($thisYear . '-12-31')) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                    }
                                                                    $saleObjects[$numberSales] = (object) [
                                                                        'active' => false,
                                                                        'start' => $startThisYear,
                                                                        'end' => $startThisYear + $diffThisYear,
                                                                        'client' => $billboardSale->client->name,
                                                                    ];
                                                                    $numberSales = $numberSales + 1;
                                                                    ?>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        {{-- {{ var_dump($saleObjects) }} --}}
                                                        @if ($activeClient)
                                                            <td
                                                                class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                                {{ $activeClient[0]->client->name }}</td>
                                                            <td
                                                                class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                                {{ number_format($activeClient[0]->price) }}</td>
                                                            <td
                                                                class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                                {{ $activeClient[0]->duration }}</td>
                                                            <td
                                                                class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                                {{ date('d-M-Y', strtotime($activeClient[0]->start_at)) }}
                                                            </td>
                                                            <td
                                                                class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                                {{ date('d-M-Y', strtotime($activeClient[0]->end_at)) }}
                                                            </td>
                                                            <td class="relative border text-[0.65rem]">
                                                                <div class="flex absolute w-[365px] h-4 z-50">
                                                                    @foreach ($saleObjects as $saleObject)
                                                                        @if ($saleObject->active == true)
                                                                            @if ($loop->iteration - 1 == 0)
                                                                                @if ($saleObject->start == 0)
                                                                                    @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                        @if ($i == 0)
                                                                                            <div class="relative">
                                                                                                <div
                                                                                                    class="flex absolute mt-[-12px] w-max">
                                                                                                    <label
                                                                                                        for="">{{ $saleObject->client }}</label>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-red-700">
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="relative">
                                                                                                <div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-red-700">
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @else
                                                                                    @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                        @if ($i < $saleObject->start)
                                                                                            <div class="w-[1px] h-[3px]">
                                                                                            </div>
                                                                                        @else
                                                                                            @if ($i == $saleObject->start)
                                                                                                <div class="relative">
                                                                                                    <div
                                                                                                        class="flex absolute mt-[-12px] w-max">
                                                                                                        <label
                                                                                                            for="">{{ $saleObject->client }}</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-red-700">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @else
                                                                                                <div class="relative">
                                                                                                    <div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-red-700">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @endif
                                                                            @else
                                                                                @if ($startContract == $saleObject->start)
                                                                                    @for ($i = $saleObject->start; $i < $saleObject->end; $i++)
                                                                                        @if ($i == $saleObject->start)
                                                                                            <div class="relative">
                                                                                                <div
                                                                                                    class="flex absolute mt-[-12px] w-max">
                                                                                                    <label
                                                                                                        for="">{{ $saleObject->client }}</label>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-red-700">
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="relative">
                                                                                                <div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-red-700">
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @else
                                                                                    @for ($i = $startContract; $i < $saleObject->end; $i++)
                                                                                        @if ($i < $saleObject->start)
                                                                                            <div class="w-[1px] h-[3px]">
                                                                                            </div>
                                                                                        @else
                                                                                            @if ($i == $saleObject->start)
                                                                                                <div class="relative">
                                                                                                    <div
                                                                                                        class="flex absolute mt-[-12px] w-max">
                                                                                                        <label
                                                                                                            for="">{{ $saleObject->client }}</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-red-700">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @else
                                                                                                <div class="relative">
                                                                                                    <div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-red-700">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @endif
                                                                            @endif
                                                                        @else
                                                                            @if ($loop->iteration - 1 == 0)
                                                                                @if ($saleObject->start == 0)
                                                                                    @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                        @if ($i == 0)
                                                                                            <div class="relative">
                                                                                                <div
                                                                                                    class="flex absolute mt-[-12px] w-max">
                                                                                                    <label
                                                                                                        for="">{{ $saleObject->client }}</label>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-slate-500">
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="relative">
                                                                                                <div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-slate-500">
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @else
                                                                                    @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                        @if ($i < $saleObject->start)
                                                                                            <div class="w-[1px] h-[3px]">
                                                                                            </div>
                                                                                        @else
                                                                                            @if ($i == $saleObject->start)
                                                                                                <div class="relative">
                                                                                                    <div
                                                                                                        class="flex absolute mt-[-12px] w-max">
                                                                                                        <label
                                                                                                            for="">{{ $saleObject->client }}</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-slate-500">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @else
                                                                                                <div class="relative">
                                                                                                    <div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-slate-500">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @endif
                                                                            @else
                                                                                @if ($startContract == $saleObject->start)
                                                                                    @for ($i = $saleObject->start; $i < $saleObject->end; $i++)
                                                                                        @if ($i == $saleObject->start)
                                                                                            <div class="relative">
                                                                                                <div
                                                                                                    class="flex absolute mt-[-12px] w-max">
                                                                                                    <label
                                                                                                        for="">{{ $saleObject->client }}</label>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-slate-500">
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="relative">
                                                                                                <div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-slate-500">
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @else
                                                                                    @for ($i = $startContract; $i < $saleObject->end; $i++)
                                                                                        @if ($i < $saleObject->start)
                                                                                            <div class="w-[1px] h-[3px]">
                                                                                            </div>
                                                                                        @else
                                                                                            @if ($i == $saleObject->start)
                                                                                                <div class="relative">
                                                                                                    <div
                                                                                                        class="flex absolute mt-[-12px] w-max">
                                                                                                        <label
                                                                                                            for="">{{ $saleObject->client }}</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-slate-500">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @else
                                                                                                <div class="relative">
                                                                                                    <div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-slate-500">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                        @else
                                                            <td
                                                                class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                            </td>
                                                            <td
                                                                class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                            </td>
                                                            <td
                                                                class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                            </td>
                                                            <td
                                                                class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                            </td>
                                                            <td
                                                                class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                            </td>
                                                            <td class="relative border text-[0.65rem]">
                                                                <div class="flex absolute w-[365px]">
                                                                    @foreach ($saleObjects as $saleObject)
                                                                        @if ($saleObject->active == true)
                                                                            @if ($loop->iteration - 1 == 0)
                                                                                @if ($saleObject->start == 0)
                                                                                    @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                        @if ($i == 0)
                                                                                            <div class="relative">
                                                                                                <div
                                                                                                    class="flex absolute mt-[-12px]">
                                                                                                    <label
                                                                                                        for="">{{ $saleObject->client }}</label>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-red-700">
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="relative">
                                                                                                <div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-red-700">
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @else
                                                                                    @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                        @if ($i < $saleObject->start)
                                                                                            <div class="w-[1px] h-[3px]">
                                                                                            </div>
                                                                                        @else
                                                                                            @if ($i == $saleObject->start)
                                                                                                <div class="relative">
                                                                                                    <div
                                                                                                        class="flex absolute mt-[-12px]">
                                                                                                        <label
                                                                                                            for="">{{ $saleObject->client }}</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-red-700">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @else
                                                                                                <div class="relative">
                                                                                                    <div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-red-700">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @endif
                                                                            @else
                                                                                @if ($startContract == $saleObject->start)
                                                                                    @for ($i = $saleObject->start; $i < $saleObject->end; $i++)
                                                                                        @if ($i == $saleObject->start)
                                                                                            <div class="relative">
                                                                                                <div
                                                                                                    class="flex absolute mt-[-12px]">
                                                                                                    <label
                                                                                                        for="">{{ $saleObject->client }}</label>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-red-700">
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="relative">
                                                                                                <div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-red-700">
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @else
                                                                                    @for ($i = $startContract; $i < $saleObject->end; $i++)
                                                                                        @if ($i < $saleObject->start)
                                                                                            <div class="w-[1px] h-[3px]">
                                                                                            </div>
                                                                                        @else
                                                                                            @if ($i == $saleObject->start)
                                                                                                <div class="relative">
                                                                                                    <div
                                                                                                        class="flex absolute mt-[-12px]">
                                                                                                        <label
                                                                                                            for="">{{ $saleObject->client }}</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-red-700">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @else
                                                                                                <div class="relative">
                                                                                                    <div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-red-700">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @endif
                                                                            @endif
                                                                        @else
                                                                            @if ($loop->iteration - 1 == 0)
                                                                                @if ($saleObject->start == 0)
                                                                                    @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                        @if ($i == 0)
                                                                                            <div class="relative">
                                                                                                <div
                                                                                                    class="flex absolute mt-[-12px]">
                                                                                                    <label
                                                                                                        for="">{{ $saleObject->client }}</label>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-slate-500">
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="relative">
                                                                                                <div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-slate-500">
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @else
                                                                                    @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                        @if ($i < $saleObject->start)
                                                                                            <div class="w-[1px] h-[3px]">
                                                                                            </div>
                                                                                        @else
                                                                                            @if ($i == $saleObject->start)
                                                                                                <div class="relative">
                                                                                                    <div
                                                                                                        class="flex absolute mt-[-12px]">
                                                                                                        <label
                                                                                                            for="">{{ $saleObject->client }}</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-slate-500">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @else
                                                                                                <div class="relative">
                                                                                                    <div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-slate-500">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @endif
                                                                            @else
                                                                                @if ($startContract == $saleObject->start)
                                                                                    @for ($i = $saleObject->start; $i < $saleObject->end; $i++)
                                                                                        @if ($i == $saleObject->start)
                                                                                            <div class="relative">
                                                                                                <div
                                                                                                    class="flex absolute mt-[-12px]">
                                                                                                    <label
                                                                                                        for="">{{ $saleObject->client }}</label>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-slate-500">
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="relative">
                                                                                                <div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-slate-500">
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @else
                                                                                    @for ($i = $startContract; $i < $saleObject->end; $i++)
                                                                                        @if ($i < $saleObject->start)
                                                                                            <div class="w-[1px] h-[3px]">
                                                                                            </div>
                                                                                        @else
                                                                                            @if ($i == $saleObject->start)
                                                                                                <div class="relative">
                                                                                                    <div
                                                                                                        class="flex absolute mt-[-12px]">
                                                                                                        <label
                                                                                                            for="">{{ $saleObject->client }}</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-slate-500">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @else
                                                                                                <div class="relative">
                                                                                                    <div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-slate-500">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                        @endif
                                                    @else
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                        </td>
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                        </td>
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                        </td>
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                        </td>
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                        </td>
                                                        <td class="relative border text-[0.65rem]"></td>
                                                        <td class="relative border text-[0.65rem]"></td>
                                                        <td class="relative border text-[0.65rem]"></td>
                                                        <td class="relative border text-[0.65rem]"></td>
                                                        <td class="relative border text-[0.65rem]"></td>
                                                        <td class="relative border text-[0.65rem]"></td>
                                                        <td class="relative border text-[0.65rem]"></td>
                                                        <td class="relative border text-[0.65rem]"></td>
                                                        <td class="relative border text-[0.65rem]"></td>
                                                        <td class="relative border text-[0.65rem]"></td>
                                                        <td class="relative border text-[0.65rem]"></td>
                                                        <td class="relative border text-[0.65rem]"></td>
                                                    @endif
                                                </tr>
                                            @endif
                                        @else
                                            @if ($loop->iteration > $j * 30 && $loop->iteration < ($j + 1) * 30 + 1)
                                                <?php
                                                $billboardSales = [];
                                                $activeClient = [];
                                                $billboardSaleNumber = 0;
                                                $saleObjects = [];
                                                $numberSales = 0;
                                                $hasClient = false;
                                                if (request('yearReport')) {
                                                    $thisYear = request('yearReport');
                                                } else {
                                                    $thisYear = date('Y');
                                                }
                                                $prevYear = $thisYear - 1;
                                                $nextYear = $thisYear + 1;
                                                ?>
                                                <tr class="h-[22px]">
                                                    <td class="text-teal-700 border text-[0.65rem] text-center">
                                                        {{ $loop->iteration }}</td>
                                                    <td class="text-teal-700 border text-[0.65rem] text-center">
                                                        {{ $billboard->code }} - {{ $billboard->city->code }}</td>
                                                    <td class="text-teal-700 border text-[0.65rem] px-1">
                                                        {{ $billboard->address }}</td>
                                                    <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                        {{ $billboard->city->code }}</td>
                                                    @if ($billboard->billboard_category->name == 'Billboard')
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">BB
                                                        </td>
                                                    @elseif ($billboard->billboard_category->name == 'Bando')
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">BD
                                                        </td>
                                                    @elseif ($billboard->billboard_category->name == 'Baliho')
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                            BLH</td>
                                                    @elseif ($billboard->billboard_category->name == 'Midiboard')
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">MB
                                                        </td>
                                                    @endif
                                                    @if ($billboard->lighting == 'Frontlight')
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">FL
                                                        </td>
                                                    @elseif ($billboard->lighting == 'Backlight')
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">BL
                                                        </td>
                                                    @elseif ($billboard->lighting == 'Nonlight')
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">NL
                                                        </td>
                                                    @endif
                                                    @if ($billboard->orientation == 'Vertikal')
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                            {{ $billboard->size->size }} - V</td>
                                                    @elseif ($billboard->orientation == 'Horizontal')
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                            {{ $billboard->size->size }} - V</td>
                                                    @endif
                                                    @foreach ($sales as $sale)
                                                        @if ($sale->billboard_id == $billboard->id)
                                                            <?php
                                                            $billboardSales[$billboardSaleNumber] = $sale;
                                                            $billboardSaleNumber = $billboardSaleNumber + 1;
                                                            ?>
                                                        @endif
                                                    @endforeach
                                                    @if ($billboardSales)
                                                        @foreach ($billboardSales as $billboardSale)
                                                            @if ($thisYear == date('Y'))
                                                                @if (strtotime($billboardSale->end_at) > strtotime(date('Y/m/d')))
                                                                    <?php
                                                                    $activeClient[0] = $billboardSale;
                                                                    $startThisYear = 0;
                                                                    $diffPrevYear = 0;
                                                                    $diffThisYear = 0;
                                                                    $endPrevYear = strtotime(date($prevYear . '-12-31'));
                                                                    if (strtotime($billboardSale->start_at) <= $endPrevYear && strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01'))) {
                                                                        $diffPrevYear = ($endPrevYear - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime($billboardSale->end_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $startThisYear = 0;
                                                                    } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) <= strtotime(date($thisYear . '-12-31'))) {
                                                                        $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime($billboardSale->end_at) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                    } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) >= strtotime(date($nextYear . '-01-01'))) {
                                                                        $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime(date($thisYear . '-12-31')) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                    }
                                                                    $saleObjects[$numberSales] = (object) [
                                                                        'active' => true,
                                                                        'start' => $startThisYear,
                                                                        'end' => $startThisYear + $diffThisYear,
                                                                        'client' => $billboardSale->client->name,
                                                                    ];
                                                                    $numberSales = $numberSales + 1;
                                                                    ?>
                                                                @else
                                                                    <?php
                                                                    $startThisYear = 0;
                                                                    $diffPrevYear = 0;
                                                                    $diffThisYear = 0;
                                                                    $endPrevYear = strtotime(date($prevYear . '-12-31'));
                                                                    if (strtotime($billboardSale->start_at) <= $endPrevYear && strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01'))) {
                                                                        $diffPrevYear = ($endPrevYear - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime($billboardSale->end_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $startThisYear = 0;
                                                                    } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) <= strtotime(date($thisYear . '-12-31'))) {
                                                                        $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime($billboardSale->end_at) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                    } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) >= strtotime(date($nextYear . '-01-01'))) {
                                                                        $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime(date($thisYear . '-12-31')) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                    }
                                                                    $saleObjects[$numberSales] = (object) [
                                                                        'active' => false,
                                                                        'start' => $startThisYear,
                                                                        'end' => $startThisYear + $diffThisYear,
                                                                        'client' => $billboardSale->client->name,
                                                                    ];
                                                                    $numberSales = $numberSales + 1;
                                                                    ?>
                                                                @endif
                                                            @elseif ($thisYear > date('Y'))
                                                                @if (strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01')))
                                                                    <?php
                                                                    $activeClient[0] = $billboardSale;
                                                                    $startThisYear = 0;
                                                                    $diffPrevYear = 0;
                                                                    $diffThisYear = 0;
                                                                    $endPrevYear = strtotime(date($prevYear . '-12-31'));
                                                                    if (strtotime($billboardSale->start_at) <= $endPrevYear && strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01'))) {
                                                                        $diffPrevYear = ($endPrevYear - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime($billboardSale->end_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $startThisYear = 0;
                                                                    } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) <= strtotime(date($thisYear . '-12-31'))) {
                                                                        $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime($billboardSale->end_at) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                    } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) >= strtotime(date($nextYear . '-01-01'))) {
                                                                        $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime(date($thisYear . '-12-31')) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                    }
                                                                    $saleObjects[$numberSales] = (object) [
                                                                        'active' => true,
                                                                        'start' => $startThisYear,
                                                                        'end' => $startThisYear + $diffThisYear,
                                                                        'client' => $billboardSale->client->name,
                                                                    ];
                                                                    $numberSales = $numberSales + 1;
                                                                    ?>
                                                                @else
                                                                    <?php
                                                                    $startThisYear = 0;
                                                                    $diffPrevYear = 0;
                                                                    $diffThisYear = 0;
                                                                    $endPrevYear = strtotime(date($prevYear . '-12-31'));
                                                                    if (strtotime($billboardSale->start_at) <= $endPrevYear && strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01'))) {
                                                                        $diffPrevYear = ($endPrevYear - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime($billboardSale->end_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $startThisYear = 0;
                                                                    } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) <= strtotime(date($thisYear . '-12-31'))) {
                                                                        $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime($billboardSale->end_at) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                    } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) >= strtotime(date($nextYear . '-01-01'))) {
                                                                        $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime(date($thisYear . '-12-31')) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                    }
                                                                    $saleObjects[$numberSales] = (object) [
                                                                        'active' => false,
                                                                        'start' => $startThisYear,
                                                                        'end' => $startThisYear + $diffThisYear,
                                                                        'client' => $billboardSale->client->name,
                                                                    ];
                                                                    $numberSales = $numberSales + 1;
                                                                    ?>
                                                                @endif
                                                            @elseif ($thisYear < date('Y'))
                                                                @if (strtotime($billboardSale->start_at) <= strtotime(date($thisYear . '-12-31')) &&
                                                                        strtotime($billboardSale->end_at) > strtotime(date('Y/m/d')))
                                                                    <?php
                                                                    $activeClient[0] = $billboardSale;
                                                                    $startThisYear = 0;
                                                                    $diffPrevYear = 0;
                                                                    $diffThisYear = 0;
                                                                    $endPrevYear = strtotime(date($prevYear . '-12-31'));
                                                                    if (strtotime($billboardSale->start_at) <= $endPrevYear && strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01'))) {
                                                                        $diffPrevYear = ($endPrevYear - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime($billboardSale->end_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $startThisYear = 0;
                                                                    } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) <= strtotime(date($thisYear . '-12-31'))) {
                                                                        $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime($billboardSale->end_at) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                    } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) >= strtotime(date($nextYear . '-01-01'))) {
                                                                        $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime(date($thisYear . '-12-31')) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                    }
                                                                    $saleObjects[$numberSales] = (object) [
                                                                        'active' => true,
                                                                        'start' => $startThisYear,
                                                                        'end' => $startThisYear + $diffThisYear,
                                                                        'client' => $billboardSale->client->name,
                                                                    ];
                                                                    $numberSales = $numberSales + 1;
                                                                    ?>
                                                                @else
                                                                    <?php
                                                                    $startThisYear = 0;
                                                                    $diffPrevYear = 0;
                                                                    $diffThisYear = 0;
                                                                    $endPrevYear = strtotime(date($prevYear . '-12-31'));
                                                                    if (strtotime($billboardSale->start_at) <= $endPrevYear && strtotime($billboardSale->end_at) >= strtotime(date($thisYear . '-01-01'))) {
                                                                        $diffPrevYear = ($endPrevYear - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime($billboardSale->end_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $startThisYear = 0;
                                                                    } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) <= strtotime(date($thisYear . '-12-31'))) {
                                                                        $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime($billboardSale->end_at) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                    } elseif (strtotime($billboardSale->start_at) >= strtotime(date($thisYear . '-01-01')) && strtotime($billboardSale->end_at) >= strtotime(date($nextYear . '-01-01'))) {
                                                                        $startThisYear = (strtotime($billboardSale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                                                                        $diffThisYear = (strtotime(date($thisYear . '-12-31')) - strtotime($billboardSale->start_at)) / 60 / 60 / 24;
                                                                    }
                                                                    $saleObjects[$numberSales] = (object) [
                                                                        'active' => false,
                                                                        'start' => $startThisYear,
                                                                        'end' => $startThisYear + $diffThisYear,
                                                                        'client' => $billboardSale->client->name,
                                                                    ];
                                                                    $numberSales = $numberSales + 1;
                                                                    ?>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        {{-- {{ var_dump($saleObjects) }} --}}
                                                        @if ($activeClient)
                                                            <td
                                                                class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                                {{ $activeClient[0]->client->name }}</td>
                                                            <td
                                                                class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                                {{ number_format($activeClient[0]->price) }}</td>
                                                            <td
                                                                class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                                {{ $activeClient[0]->duration }}</td>
                                                            <td
                                                                class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                                {{ date('d-M-Y', strtotime($activeClient[0]->start_at)) }}
                                                            </td>
                                                            <td
                                                                class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                                {{ date('d-M-Y', strtotime($activeClient[0]->end_at)) }}
                                                            </td>
                                                            <td class="relative border text-[0.65rem]">
                                                                <div class="flex absolute w-[365px] h-4">
                                                                    @foreach ($saleObjects as $saleObject)
                                                                        @if ($saleObject->active == true)
                                                                            @if ($loop->iteration - 1 == 0)
                                                                                @if ($saleObject->start == 0)
                                                                                    @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                        @if ($i == 0)
                                                                                            <div class="relative">
                                                                                                <div
                                                                                                    class="flex absolute mt-[-12px] w-max">
                                                                                                    <label
                                                                                                        for="">{{ $saleObject->client }}</label>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-red-700">
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="relative">
                                                                                                <div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-red-700">
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @else
                                                                                    @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                        @if ($i < $saleObject->start)
                                                                                            <div class="w-[1px] h-[3px]">
                                                                                            </div>
                                                                                        @else
                                                                                            @if ($i == $saleObject->start)
                                                                                                <div class="relative">
                                                                                                    <div
                                                                                                        class="flex absolute mt-[-12px] w-max">
                                                                                                        <label
                                                                                                            for="">{{ $saleObject->client }}</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-red-700">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @else
                                                                                                <div class="relative">
                                                                                                    <div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-red-700">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @endif
                                                                            @else
                                                                                @if ($startContract == $saleObject->start)
                                                                                    @for ($i = $saleObject->start; $i < $saleObject->end; $i++)
                                                                                        @if ($i == $saleObject->start)
                                                                                            <div class="relative">
                                                                                                <div
                                                                                                    class="flex absolute mt-[-12px] w-max">
                                                                                                    <label
                                                                                                        for="">{{ $saleObject->client }}</label>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-red-700">
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="relative">
                                                                                                <div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-red-700">
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @else
                                                                                    @for ($i = $startContract; $i < $saleObject->end; $i++)
                                                                                        @if ($i < $saleObject->start)
                                                                                            <div class="w-[1px] h-[3px]">
                                                                                            </div>
                                                                                        @else
                                                                                            @if ($i == $saleObject->start)
                                                                                                <div class="relative">
                                                                                                    <div
                                                                                                        class="flex absolute mt-[-12px] w-max">
                                                                                                        <label
                                                                                                            for="">{{ $saleObject->client }}</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-red-700">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @else
                                                                                                <div class="relative">
                                                                                                    <div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-red-700">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @endif
                                                                            @endif
                                                                        @else
                                                                            @if ($loop->iteration - 1 == 0)
                                                                                @if ($saleObject->start == 0)
                                                                                    @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                        @if ($i == 0)
                                                                                            <div class="relative">
                                                                                                <div
                                                                                                    class="flex absolute mt-[-12px] w-max">
                                                                                                    <label
                                                                                                        for="">{{ $saleObject->client }}</label>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-slate-500">
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="relative">
                                                                                                <div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-slate-500">
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @else
                                                                                    @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                        @if ($i < $saleObject->start)
                                                                                            <div class="w-[1px] h-[3px]">
                                                                                            </div>
                                                                                        @else
                                                                                            @if ($i == $saleObject->start)
                                                                                                <div class="relative">
                                                                                                    <div
                                                                                                        class="flex absolute mt-[-12px] w-max">
                                                                                                        <label
                                                                                                            for="">{{ $saleObject->client }}</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-slate-500">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @else
                                                                                                <div class="relative">
                                                                                                    <div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-slate-500">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @endif
                                                                            @else
                                                                                @if ($startContract == $saleObject->start)
                                                                                    @for ($i = $saleObject->start; $i < $saleObject->end; $i++)
                                                                                        @if ($i == $saleObject->start)
                                                                                            <div class="relative">
                                                                                                <div
                                                                                                    class="flex absolute mt-[-12px] w-max">
                                                                                                    <label
                                                                                                        for="">{{ $saleObject->client }}</label>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-slate-500">
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="relative">
                                                                                                <div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-slate-500">
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @else
                                                                                    @for ($i = $startContract; $i < $saleObject->end; $i++)
                                                                                        @if ($i < $saleObject->start)
                                                                                            <div class="w-[1px] h-[3px]">
                                                                                            </div>
                                                                                        @else
                                                                                            @if ($i == $saleObject->start)
                                                                                                <div class="relative">
                                                                                                    <div
                                                                                                        class="flex absolute mt-[-12px] w-max">
                                                                                                        <label
                                                                                                            for="">{{ $saleObject->client }}</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-slate-500">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @else
                                                                                                <div class="relative">
                                                                                                    <div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-slate-500">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                        @else
                                                            <td
                                                                class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                            </td>
                                                            <td
                                                                class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                            </td>
                                                            <td
                                                                class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                            </td>
                                                            <td
                                                                class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                            </td>
                                                            <td
                                                                class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                            </td>
                                                            <td class="relative border text-[0.65rem]">
                                                                <div class="flex absolute w-[365px]">
                                                                    @foreach ($saleObjects as $saleObject)
                                                                        @if ($saleObject->active == true)
                                                                            @if ($loop->iteration - 1 == 0)
                                                                                @if ($saleObject->start == 0)
                                                                                    @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                        @if ($i == 0)
                                                                                            <div class="relative">
                                                                                                <div
                                                                                                    class="flex absolute mt-[-12px]">
                                                                                                    <label
                                                                                                        for="">{{ $saleObject->client }}</label>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-red-700">
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="relative">
                                                                                                <div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-red-700">
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @else
                                                                                    @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                        @if ($i < $saleObject->start)
                                                                                            <div class="w-[1px] h-[3px]">
                                                                                            </div>
                                                                                        @else
                                                                                            @if ($i == $saleObject->start)
                                                                                                <div class="relative">
                                                                                                    <div
                                                                                                        class="flex absolute mt-[-12px]">
                                                                                                        <label
                                                                                                            for="">{{ $saleObject->client }}</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-red-700">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @else
                                                                                                <div class="relative">
                                                                                                    <div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-red-700">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @endif
                                                                            @else
                                                                                @if ($startContract == $saleObject->start)
                                                                                    @for ($i = $saleObject->start; $i < $saleObject->end; $i++)
                                                                                        @if ($i == $saleObject->start)
                                                                                            <div class="relative">
                                                                                                <div
                                                                                                    class="flex absolute mt-[-12px]">
                                                                                                    <label
                                                                                                        for="">{{ $saleObject->client }}</label>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-red-700">
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="relative">
                                                                                                <div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-red-700">
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @else
                                                                                    @for ($i = $startContract; $i < $saleObject->end; $i++)
                                                                                        @if ($i < $saleObject->start)
                                                                                            <div class="w-[1px] h-[3px]">
                                                                                            </div>
                                                                                        @else
                                                                                            @if ($i == $saleObject->start)
                                                                                                <div class="relative">
                                                                                                    <div
                                                                                                        class="flex absolute mt-[-12px]">
                                                                                                        <label
                                                                                                            for="">{{ $saleObject->client }}</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-red-700">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @else
                                                                                                <div class="relative">
                                                                                                    <div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-red-700">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @endif
                                                                            @endif
                                                                        @else
                                                                            @if ($loop->iteration - 1 == 0)
                                                                                @if ($saleObject->start == 0)
                                                                                    @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                        @if ($i == 0)
                                                                                            <div class="relative">
                                                                                                <div
                                                                                                    class="flex absolute mt-[-12px]">
                                                                                                    <label
                                                                                                        for="">{{ $saleObject->client }}</label>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-slate-500">
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="relative">
                                                                                                <div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-slate-500">
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @else
                                                                                    @for ($i = 0; $i < $saleObject->end; $i++)
                                                                                        @if ($i < $saleObject->start)
                                                                                            <div class="w-[1px] h-[3px]">
                                                                                            </div>
                                                                                        @else
                                                                                            @if ($i == $saleObject->start)
                                                                                                <div class="relative">
                                                                                                    <div
                                                                                                        class="flex absolute mt-[-12px]">
                                                                                                        <label
                                                                                                            for="">{{ $saleObject->client }}</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-slate-500">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @else
                                                                                                <div class="relative">
                                                                                                    <div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-slate-500">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @endif
                                                                            @else
                                                                                @if ($startContract == $saleObject->start)
                                                                                    @for ($i = $saleObject->start; $i < $saleObject->end; $i++)
                                                                                        @if ($i == $saleObject->start)
                                                                                            <div class="relative">
                                                                                                <div
                                                                                                    class="flex absolute mt-[-12px]">
                                                                                                    <label
                                                                                                        for="">{{ $saleObject->client }}</label>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-slate-500">
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="relative">
                                                                                                <div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="w-[1px] h-[3px] bg-slate-500">
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @else
                                                                                    @for ($i = $startContract; $i < $saleObject->end; $i++)
                                                                                        @if ($i < $saleObject->start)
                                                                                            <div class="w-[1px] h-[3px]">
                                                                                            </div>
                                                                                        @else
                                                                                            @if ($i == $saleObject->start)
                                                                                                <div class="relative">
                                                                                                    <div
                                                                                                        class="flex absolute mt-[-12px]">
                                                                                                        <label
                                                                                                            for="">{{ $saleObject->client }}</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-slate-500">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @else
                                                                                                <div class="relative">
                                                                                                    <div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="w-[1px] h-[3px] bg-slate-500">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endfor
                                                                                    <?php
                                                                                    $startContract = $saleObject->end;
                                                                                    ?>
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                            <td class="relative border text-[0.65rem]"></td>
                                                        @endif
                                                    @else
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                        </td>
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                        </td>
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                        </td>
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                        </td>
                                                        <td class="text-teal-700 border text-[0.65rem] px-1 text-center">
                                                        </td>
                                                        <td class="relative border text-[0.65rem]"></td>
                                                        <td class="relative border text-[0.65rem]"></td>
                                                        <td class="relative border text-[0.65rem]"></td>
                                                        <td class="relative border text-[0.65rem]"></td>
                                                        <td class="relative border text-[0.65rem]"></td>
                                                        <td class="relative border text-[0.65rem]"></td>
                                                        <td class="relative border text-[0.65rem]"></td>
                                                        <td class="relative border text-[0.65rem]"></td>
                                                        <td class="relative border text-[0.65rem]"></td>
                                                        <td class="relative border text-[0.65rem]"></td>
                                                        <td class="relative border text-[0.65rem]"></td>
                                                        <td class="relative border text-[0.65rem]"></td>
                                                    @endif
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Create Sales Report end -->

    <!-- Script start -->
    <script src="/js/html2pdf.bundle.min.js"></script>

    <script>
        //Format date --> start
        const btnC1Pdf = document.getElementById("btnC1Pdf");
        const btnChartPdf = document.getElementById("btnChartPdf");
        const date = new Date();
        const year = date.getFullYear();
        let month = "";
        let options = [{
            month: 'long'
        }, {
            year: 'numeric'
        }];

        function getFormatDate(date, options, separator) {
            function format(option) {
                let formatter = new Intl.DateTimeFormat('en', option);
                return formatter.format(date);
            }
            return options.map(format).join(separator);
        }
        //Format date --> end

        // Action Type & Periode --> start
        const c1Type = document.getElementById("c1Type");
        const chartType = document.getElementById("chartType");
        const yearReport = document.getElementById("yearReport");
        const monthReport = document.getElementById("monthReport");
        const labelPeriode = document.querySelectorAll("[id='labelPeriode']");
        const c1Report = document.getElementById("c1Report");
        const search = document.getElementById("search");

        monthReport.addEventListener("change", function() {
            // for (i = 0; i < labelPeriode.length; i++) {
            //     labelPeriode[i].innerHTML = "";
            //     labelPeriode[i].innerHTML = getFormatDate(new Date(monthReport.value), options, ' ');
            // }
            search.value = monthReport.value;
        })

        if (search.value) {
            if (c1Type.checked == true) {
                c1Report.classList.remove("hidden");
                c1Report.classList.add("flex");
            }
        }
        if (c1Type.checked == true) {
            monthReport.removeAttribute("hidden");
            c1Report.classList.remove("hidden");
            c1Report.classList.add("flex");
            btnC1Pdf.classList.remove("hidden");
            btnC1Pdf.classList.add("flex");
            chartReport.classList.add("hidden");
            chartReport.classList.remove("flex");
            btnChartPdf.classList.add("hidden");
            btnChartPdf.classList.remove("flex");
            yearReport.setAttribute("hidden", "hidden");
        } else if (chartType.checked == true) {
            monthReport.setAttribute("hidden", "hidden");
            c1Report.classList.remove("flex");
            c1Report.classList.add("hidden");
            btnC1Pdf.classList.remove("flex");
            btnC1Pdf.classList.add("hidden");
            chartReport.classList.remove("hidden");
            chartReport.classList.add("flex");
            btnChartPdf.classList.remove("hidden");
            btnChartPdf.classList.add("flex");
            yearReport.removeAttribute("hidden");
            search.value = "";
            monthReport.value == "";
        }

        c1Type.addEventListener("click", function() {
            monthReport.removeAttribute("hidden");
            c1Report.classList.remove("hidden");
            c1Report.classList.add("flex");
            chartReport.classList.add("hidden");
            chartReport.classList.remove("flex");
            btnChartPdf.classList.add("hidden");
            btnChartPdf.classList.remove("flex");
            btnC1Pdf.classList.remove("hidden");
            btnC1Pdf.classList.add("flex");
            yearReport.setAttribute("hidden", "hidden");
        })

        chartType.addEventListener("click", function() {
            monthReport.setAttribute("hidden", "hidden");
            c1Report.classList.remove("flex");
            c1Report.classList.add("hidden");
            chartReport.classList.remove("hidden");
            chartReport.classList.add("flex");
            btnChartPdf.classList.remove("hidden");
            btnChartPdf.classList.add("flex");
            btnC1Pdf.classList.remove("flex");
            btnC1Pdf.classList.add("hidden");
            yearReport.removeAttribute("hidden");
            search.value = "";
            monthReport.value == "";
        })

        // Action Type & Periode --> end

        // Create PDF --> start
        document.getElementById("btnC1Pdf").onclick = function() {
            var element = document.getElementById('pdfPreview');
            var opt = {
                margin: 0,
                filename: 'test.pdf',
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
                    format: [1200, 848],
                    orientation: 'landscape',
                    putTotalPages: true
                }
            };
            html2pdf().set(opt).from(element).save();
        };

        document.getElementById("btnChartPdf").onclick = function() {
            var element = document.getElementById('pdfChartPreview');
            var opt = {
                margin: 0,
                filename: 'test.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                pagebreak: {
                    mode: ['avoid-all', 'css', 'legacy']
                },
                html2canvas: {
                    dpi: 300,
                    scale: 4,
                    letterRendering: true,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'px',
                    format: [1280, 905],
                    orientation: 'landscape',
                    putTotalPages: true
                }
            };
            html2pdf().set(opt).from(element).save();
        };
        // Create PDF --> end
    </script>
    <!-- Script end -->
@endsection
