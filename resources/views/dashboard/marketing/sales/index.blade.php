@extends('dashboard.layouts.main');

@section('container')
    <div id="test"></div>
    <div class="mt-10 z-0">
        <div class="flex justify-center w-full">
            <div class="w-[1200px] p-2">
                <div class="flex">
                    <h1 class="index-h1"> Daftar Penjualan</h1>
                    <div class="flex border-b">
                        <a href="/dashboard/marketing/sales/create" class="index-link btn-primary">
                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1">Tambah Penjualan</span>
                        </a>
                    </div>
                </div>
                <form class="flex mt-2" action="/dashboard/marketing/sales/">
                    <div class="flex">
                        <input id="search" name="search"
                            class="flex border rounded-l-lg ml-2 p-1 outline-none text-base text-teal-900" type="text"
                            placeholder="Search" value="{{ request('search') }}">
                        <button class="flex border p-1 rounded-r-lg text-slate-700 justify-center w-10 bg-slate-50"
                            type="submit">
                            <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z" />
                            </svg>
                        </button>
                    </div>
                    @if (session()->has('success'))
                        <div class="ml-2 flex alert-success">
                            <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                            </svg>
                            <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                        </div>
                    @elseif (session()->has('order_success'))
                        <div class="ml-2 flex alert-success">
                            <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                            </svg>
                            <span class="font-semibold mx-1">Success!</span> {{ session('order_success') }}
                        </div>
                    @elseif (session()->has('agreement_success'))
                        <div class="ml-2 flex alert-success">
                            <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                            </svg>
                            <span class="font-semibold mx-1">Success!</span> {{ session('agreement_success') }}
                        </div>
                    @endif
                </form>
            </div>
        </div>
        <div class="flex justify-center px-2 pb-8 w-full z-0">
            <div class="w-[1200px] overflow-x-scroll h-[450px] overflow-y-auto">
                <table class="table-auto w-max mb-6">
                    <thead class="sticky top-0 z-10">
                        <tr class="bg-teal-100">
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-6" rowspan="2">No.</th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-44 text-center" rowspan="2">
                                <button class="flex justify-center items-center w-44">@sortablelink('number', 'Data Penjualan')
                                    <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                    </svg>
                                </button>
                            </th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-44" rowspan="2">Data Reklame
                            </th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-52" rowspan="2">Klien</th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-36" rowspan="2">Deskripsi</th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-48" rowspan="2">Penawaran</th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-32" rowspan="2">Harga (Rp.)
                            </th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-[360px]" colspan="5">Termin
                                Pembayaran</th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-40" colspan="2">Penagihan</th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-40" colspan="2">Pembayaran</th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-16" rowspan="2">Approval</th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-16" rowspan="2">PO/SPK</th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-16" rowspan="2">Agreement</th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-24" rowspan="2">Tanggal Dibuat
                            </th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-24" rowspan="2">Dibuat Oleh
                            </th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-16" rowspan="2">Action</th>
                        </tr>
                        <tr class="bg-teal-100">
                            <th class="text-teal-700 border text-[0.65rem] w-10">Termin</th>
                            <th class="text-teal-700 border text-[0.65rem] w-20">Nominal (Rp.)</th>
                            <th class="text-teal-700 border text-[0.65rem] w-20">PPN (Rp.)</th>
                            <th class="text-teal-700 border text-[0.65rem] w-20">PPh (Rp.)</th>
                            <th class="text-teal-700 border text-[0.65rem] w-20">Total (Rp.)</th>
                            <th class="text-teal-700 border text-[0.65rem] w-20">No. Invoice</th>
                            <th class="text-teal-700 border text-[0.65rem] w-20">Tgl. Invoice</th>
                            <th class="text-teal-700 border text-[0.65rem] w-20">Nominal (Rp.)</th>
                            <th class="text-teal-700 border text-[0.65rem] w-20">Tgl. Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                    {{ $loop->iteration }}</td>
                                <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                    <div>
                                        <div class="flex ml-1">
                                            <label class="w-6">No.</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2">{{ $sale->number }}</label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-6">Tgl.</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2">{{ date('d-M-Y', strtotime($sale->created_at)) }}</label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-6">Oleh</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2">{{ $sale->user->name }}</label>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                    <div>
                                        <div class="flex ml-1">
                                            <label class="w-8">Kode</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2 w-32">{{ $sale->billboard->code }}</label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-8">Lokasi</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2 w-32">{{ $sale->billboard->address }}</label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-8">Size</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2 w-32">{{ $sale->billboard->size->size }}</label>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                    <div>
                                        <div class="flex ml-1">
                                            <label class="w-14">Klien</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2 w-36">{{ $sale->client->name }}</label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-14">Perusahaan</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2 w-36">{{ $sale->client->company }}</label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-14">Kontak</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2 w-36">{{ $sale->contact->name }}</label>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                    <div>
                                        <div class="flex ml-1">
                                            <label class="w-10">Jenis</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2">{{ $sale->category }}</label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-10">Periode</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2">{{ $sale->duration }}</label>
                                        </div>
                                        @if ($sale->start_at || $sale->end_at)
                                            <div class="flex ml-1">
                                                <label class="w-10">Awal</label>
                                                <label class="ml-1">:</label>
                                                @if ($sale->start_at)
                                                    <label
                                                        class="ml-2">{{ date('d-M-Y', strtotime($sale->start_at)) }}</label>
                                                @else
                                                    {{-- <label class="ml-2">-</label> --}}
                                                    <input
                                                        class="text-[0.65rem] text-teal-700 ml-2 outline-none border rounded-sm w-20"
                                                        type="date" name="start_at" id="start_at">
                                                @endif
                                            </div>
                                            <div class="flex ml-1">
                                                <label class="w-10">Akhir</label>
                                                <label class="ml-1">:</label>
                                                @if ($sale->end_at)
                                                    <label
                                                        class="ml-2">{{ date('d-M-Y', strtotime($sale->end_at)) }}</label>
                                                @else
                                                    {{-- <label class="ml-2">-</label> --}}
                                                    <input
                                                        class="text-[0.65rem] text-teal-700 ml-2 outline-none border rounded-sm w-20"
                                                        type="date" name="end_at" id="end_at">
                                                @endif
                                            </div>
                                        @else
                                            <form class="flex" action="/dashboard/marketing/sales/{{ $sale->id }}"
                                                method="post" enctype="multipart/form-data">
                                                @method('put')
                                                @csrf
                                                <div class="flex items-center">
                                                    <div>
                                                        <div class="flex ml-1">
                                                            <label class="w-10">Awal</label>
                                                            <label class="ml-1">:</label>
                                                            @if ($sale->start_at)
                                                                <label
                                                                    class="ml-2">{{ date('d-M-Y', strtotime($sale->start_at)) }}</label>
                                                            @else
                                                                {{-- <label class="ml-2">-</label> --}}
                                                                <input
                                                                    class="text-[0.65rem] text-teal-700 ml-2 outline-none border rounded-sm w-20"
                                                                    type="date" name="start_at" id="start_at">
                                                            @endif
                                                        </div>
                                                        <div class="flex ml-1">
                                                            <label class="w-10">Akhir</label>
                                                            <label class="ml-1">:</label>
                                                            @if ($sale->end_at)
                                                                <label
                                                                    class="ml-2">{{ date('d-M-Y', strtotime($sale->end_at)) }}</label>
                                                            @else
                                                                {{-- <label class="ml-2">-</label> --}}
                                                                <input
                                                                    class="text-[0.65rem] text-teal-700 ml-2 outline-none border rounded-sm w-20"
                                                                    type="date" name="end_at" id="end_at">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="ml-2">
                                                        <button
                                                            class="index-link text-white w-8 h-5 rounded bg-green-700 hover:bg-green-900 drop-shadow-md mr-1"
                                                            onclick="return confirm('Apakah anda yakin ingin update data penjualan {{ $sale->number }} ?')"
                                                            title="Update" type="submit">
                                                            <svg class="fill-current w-4" clip-rule="evenodd"
                                                                fill-rule="evenodd" stroke-linejoin="round"
                                                                stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 20l-1.359-2.038c-1.061.653-2.305 1.038-3.641 1.038-3.859 0-7-3.14-7-7h2c0 2.757 2.243 5 5 5 .927 0 1.786-.264 2.527-.708l-1.527-2.292h5.719l-1.719 6zm0-8c0-2.757-2.243-5-5-5-.927 0-1.786.264-2.527.708l1.527 2.292h-5.719l1.719-6 1.359 2.038c1.061-.653 2.305-1.038 3.641-1.038 3.859 0 7 3.14 7 7h-2z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        @endif
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
                                    <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                        <div>
                                            <div class="flex ml-1">
                                                <label class="w-5">No.</label>
                                                <label class="ml-1">:</label>
                                                <label class="ml-2">{{ $sale->billboard_quotation->number }}</label>
                                            </div>
                                            <div class="flex ml-1">
                                                <label class="w-5">Tgl.</label>
                                                <label class="ml-1">:</label>
                                                <label
                                                    class="ml-2">{{ date('d-M-Y', strtotime($sale->billboard_quotation->created_at)) }}</label>
                                            </div>
                                            <div class="flex ml-1">
                                                <label class="w-16">Free Cetak</label>
                                                <label class="ml-1">:</label>
                                                <label class="ml-2">{{ $sale->free_print }}</label>
                                            </div>
                                            <div class="flex ml-1">
                                                <label class="w-16">Free Pasang</label>
                                                <label class="ml-1">:</label>
                                                <label class="ml-2">{{ $sale->free_instalation }}</label>
                                            </div>
                                        </div>
                                    </td>
                                @elseif($sale->billboard_quot_revision_id)
                                    <?php
                                    $quotID = $sale->billboard_quot_revision_id;
                                    $quot = 'Revision';
                                    ?>
                                    <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                        <div>
                                            <div class="flex ml-1">
                                                <label class="w-5">No.</label>
                                                <label class="ml-1">:</label>
                                                <label class="ml-2">{{ $sale->billboard_quot_revision->number }}</label>
                                            </div>
                                            <div class="flex ml-1">
                                                <label class="w-5">Tgl.</label>
                                                <label class="ml-1">:</label>
                                                <label
                                                    class="ml-2">{{ date('d-M-Y', strtotime($sale->billboard_quot_revision->created_at)) }}</label>
                                            </div>
                                            <div class="flex ml-1">
                                                <label class="w-16">Free Cetak</label>
                                                <label class="ml-1">:</label>
                                                <label class="ml-2">{{ $sale->free_print }}</label>
                                            </div>
                                            <div class="flex ml-1">
                                                <label class="w-16">Free Pasang</label>
                                                <label class="ml-1">:</label>
                                                <label class="ml-2">{{ $sale->free_instalation }}</label>
                                            </div>
                                        </div>
                                    </td>
                                @endif
                                <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                    <div>
                                        <div class="flex ml-1">
                                            <label class="w-8">Harga</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2">{{ number_format($sale->price) }}</label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-8">DPP</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2">{{ number_format($sale->dpp) }}</label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-8">PPN</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2">{{ number_format($sale->dpp * (11 / 100)) }}</label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-8">PPh 23</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2">{{ number_format($sale->dpp * (2 / 100)) }}</label>
                                        </div>
                                    </div>
                                </td>
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
                                <td class="text-teal-700 border text-[0.65rem] text-center align-top"></td>
                                <td class="text-teal-700 border text-[0.65rem] text-center align-top"></td>
                                <td class="text-teal-700 border text-[0.65rem] text-center align-top"></td>
                                <td class="text-teal-700 border text-[0.65rem] text-center align-top"></td>
                                <td class="text-teal-700 border text-[0.65rem] text-center align-center">
                                    <div class="flex items-center justify-center">
                                        <button class="btn-sale" id="btnApproval"
                                            onclick="previewAppovalImage('{{ $quotID }}', '{{ $quot }}')"
                                            type="button">
                                            <span class="text-sm mx-2">view</span>
                                        </button>
                                    </div>
                                </td>
                                <td class="text-teal-700 border text-[0.65rem]">
                                    <div class="flex items-center justify-center">
                                        <?php
                                        $hasOrders = false;
                                        ?>
                                        @foreach ($client_orders as $order)
                                            @if ($quot == 'Main')
                                                @if ($order->billboard_quotation_id == $quotID)
                                                    <?php
                                                    $hasOrders = true;
                                                    ?>
                                                @endif
                                            @elseif ($quot == 'Revision')
                                                @if ($order->billboard_quot_revision_id == $quotID)
                                                    <?php
                                                    $hasOrders = true;
                                                    ?>
                                                @endif
                                            @endif
                                        @endforeach
                                        @if ($hasOrders == true)
                                            <button class="btn-sale flex justify-center" id="btnPO"
                                                onclick="previewPOImage('{{ $quotID }}', '{{ $quot }}')"
                                                type="button">
                                                <span id="spanBtnPO" class="text-sm mx-2">view</span>
                                            </button>
                                        @else
                                            <button class="btn-sale flex justify-center" id="btnViewPO"
                                                onclick="addPOImage('{{ $quotID }}', '{{ $quot }}')"
                                                type="button">
                                                <span id="spanBtnPO" class="text-sm mx-2">add</span>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-teal-700 border text-[0.65rem]">
                                    <div class="flex items-center justify-center">
                                        <?php
                                        $hasAgreements = false;
                                        ?>
                                        @foreach ($client_agreements as $agreement)
                                            @if ($quot == 'Main')
                                                @if ($agreement->billboard_quotation_id == $quotID)
                                                    <?php
                                                    $hasAgreements = true;
                                                    ?>
                                                @endif
                                            @elseif ($quot == 'Revision')
                                                @if ($agreement->billboard_quot_revision_id == $quotID)
                                                    <?php
                                                    $hasAgreements = true;
                                                    ?>
                                                @endif
                                            @endif
                                        @endforeach
                                        @if ($hasAgreements == true)
                                            <button class="btn-sale flex justify-center" id="btnAgreement"
                                                onclick="previewAgreementImage('{{ $quotID }}', '{{ $quot }}')"
                                                type="button">
                                                <span id="spanBtnAgreement" class="text-sm mx-2">view</span>
                                            </button>
                                        @else
                                            <button class="btn-sale flex justify-center" id="btnViewAgreement"
                                                onclick="addAgreementImage('{{ $quotID }}', '{{ $quot }}')"
                                                type="button">
                                                <span id="spanBtnAgreement" class="text-sm mx-2">add</span>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-teal-700 border text-[0.65rem] text-center align-center">
                                    {{ date('d-M-Y', strtotime($sale->created_at)) }}</td>
                                <td class="text-teal-700 border text-[0.65rem] text-center align-center">
                                    {{ $sale->user->name }}
                                </td>
                                <td class="text-teal-700 border text-[0.65rem] text-center align-center">
                                    <div class="flex justify-center">
                                        <a href="/dashboard/marketing/print-install-sales/{{ $sale->id }}"
                                            class="index-link text-white w-8 h-5 rounded bg-teal-500 hover:bg-teal-600 drop-shadow-md mr-1"
                                            title="Show">
                                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm8.413 7c-1.837 2.878-4.897 5.5-8.413 5.5-3.465 0-6.532-2.632-8.404-5.5 1.871-2.868 4.939-5.5 8.404-5.5 3.518 0 6.579 2.624 8.413 5.5zm-8.411-4c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                        </a>
                                        {{-- <a href="/dashboard/marketing/sales/{{ $sale->id }}/edit"
                                            class="index-link text-white w-8 h-5 rounded bg-amber-400 hover:bg-amber-500 drop-shadow-md mr-1"
                                            title="Edit">
                                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                        </a>
                                        <form action="/dashboard/marketing/sales/{{ $sale->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button
                                                class="index-link text-white w-8 h-5 rounded bg-red-600 hover:bg-red-700 drop-shadow-md mr-1"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus quotation {{ $sale->number }} ?')"
                                                title="Delete">
                                                <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                        fill-rule="nonzero" />
                                                </svg>
                                            </button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-center text-teal-900">
            {{ $sales->links() }}
        </div>

        <!-- View Approval start -->
        @include('dashboard.layouts.billboard-approvals')
        <!-- View Approval end -->

        <!-- Add / view PO / SPK start -->
        @include('dashboard.layouts.add-billboard-orders')
        @include('dashboard.layouts.view-billboard-orders')
        <!-- Add / view PO / SPK end -->

        <!-- Add / view Agreement start -->
        @include('dashboard.layouts.add-billboard-agreements')
        @include('dashboard.layouts.view-billboard-agreements')
        <!-- Add / view Agreement end -->
    </div>

    <!-- Script start -->
    <script src="/js/billboardapprovals.js"></script>
    <script src="/js/addbillboardorders.js"></script>
    <script src="/js/viewbillboardorders.js"></script>
    <script src="/js/addbillboardagreements.js"></script>
    <script src="/js/viewbillboardagreements.js"></script>
    <!-- Script end -->
@endsection
