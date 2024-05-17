@extends('dashboard.layouts.main');

@section('container')
    <!-- Create Sales Report start -->
    <div>
        <input type="text" name="sales_value" id="sales_value" hidden>
        <div class="flex mt-10 justify-center">
            <h1 class="text-xl text-cyan-800 font-bold tracking-wider w-[1200px] border-b">LAPORAN PENJUALAN</h1>
        </div>
        <div class="flex justify-center">
            <div id="divButton" class="flex w-[1200px] justify-end border rounded-lg mt-2 p-2">
                <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-primary" title="Preview"
                    type="button">
                    <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24">
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
        <div class="flex justify-center z-0 p-10">
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
                                        <label class="text-xl font-semibold text-center">SEPTEMBER 2024</label>
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
                                                                <label class="ml-2 w-28">{{ $sale->contact->name }}</label>
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
                        <div class="flex justify-end mt-1 text-teal-900">
                            <label for="">Halaman {{ $i + 1 }} dari {{ $pageQty }}</label>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Create Sales Report end -->

    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>

    <script>
        document.getElementById("btnCreatePdf").onclick = function() {
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
            // html2pdf(element, opt);
            html2pdf().set(opt).from(element).save();
        };
    </script>
    <!-- Script end -->
@endsection
