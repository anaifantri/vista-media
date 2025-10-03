@extends('dashboard.layouts.main');

@section('container')
    @php
        $salesNote = [];
        $quotationSale = $quotation->sales;
        $description = json_decode($products[0]->description);
        if ($category == 'Service') {
            for ($i = 0; $i < count($notes->dataNotes); $i++) {
                array_push($salesNote, $notes->dataNotes[$i]);
            }
        } else {
            if ($category == 'Videotron' || ($category == 'Signage' && $description->type == 'Videotron')) {
                for ($i = 0; $i < count($notes->dataNotes); $i++) {
                    if ($i == 2) {
                        array_push($salesNote, $notes->dataNotes[$i]);
                    }
                }
            } else {
                $freeInstall = $notes->freeInstall;
                $freePrint = $notes->freePrint;
                if ($freeInstall != 0 && $freePrint != 0) {
                    for ($i = 0; $i < count($notes->dataNotes); $i++) {
                        if ($i == 2 || $i == 3) {
                            array_push($salesNote, $notes->dataNotes[$i]);
                        }
                    }
                } elseif (($freeInstall != 0 && $freePrint == 0) || ($freeInstall == 0 && $freePrint != 0)) {
                    for ($i = 0; $i < count($notes->dataNotes); $i++) {
                        if ($i == 2) {
                            array_push($salesNote, $notes->dataNotes[$i]);
                        }
                    }
                }
            }
        }

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
        $bulanShort = [
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
        $product = json_decode($sale->product);
        $description = json_decode($product->description);
        if ($product->category == 'Signage') {
            $wide = $product->width * $product->height * (int) $product->side * $description->qty;
        } else {
            $wide = $product->width * $product->height * (int) $product->side;
        }
        if (isset($notes->includedPrint) && $notes->includedPrint->checked == true) {
            $totalPrint = $notes->includedPrint->price * $notes->includedPrint->qty * $wide;
        } else {
            $totalPrint = 0;
        }
        if (isset($notes->includedInstall) && $notes->includedInstall->checked == true) {
            $totalInstall = $notes->includedInstall->price * $notes->includedInstall->qty * $wide;
        } else {
            $totalInstall = 0;
        }
        $getPrice = $sale->price - $totalPrint - $totalInstall;
    @endphp
    <!-- Show Sales Data start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex border-b w-[950px]">
                <div class="flex w-96 items-center">
                    <h1 class="text-xl text-stone-100 font-bold tracking-wider">DETAIL DATA PENJUALAN</h1>
                </div>
                <div class="flex justify-end w-[660px]">
                    <a class="flex justify-center items-center ml-1 btn-success"
                        href="/marketing/sales/home/{{ $category }}/{{ $company->id }}">
                        <svg class="fill-current w-4 ml-1" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m12.012 2c5.518 0 9.997 4.48 9.997 9.998 0 5.517-4.479 9.997-9.997 9.997s-9.998-4.48-9.998-9.997c0-5.518 4.48-9.998 9.998-9.998zm-1.523 6.21s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="ml-1 xl:mx-2 text-sm">Back</span>
                    </a>
                    <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-primary mb-2 text-sm"
                        title="Create PDF" type="button">
                        <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M12.819 14.427c.064.267.077.679-.021.948-.128.351-.381.528-.754.528h-.637v-2.12h.496c.474 0 .803.173.916.644zm3.091-8.65c2.047-.479 4.805.279 6.09 1.179-1.494-1.997-5.23-5.708-7.432-6.882 1.157 1.168 1.563 4.235 1.342 5.703zm-7.457 7.955h-.546v.943h.546c.235 0 .467-.027.576-.227.067-.123.067-.366 0-.489-.109-.198-.341-.227-.576-.227zm13.547-2.732v13h-20v-24h8.409c4.858 0 3.334 8 3.334 8 3.011-.745 8.257-.42 8.257 3zm-12.108 2.761c-.16-.484-.606-.761-1.224-.761h-1.668v3.686h.907v-1.277h.761c.619 0 1.064-.277 1.224-.763.094-.292.094-.597 0-.885zm3.407-.303c-.297-.299-.711-.458-1.199-.458h-1.599v3.686h1.599c.537 0 .961-.181 1.262-.535.554-.659.586-2.035-.063-2.693zm3.701-.458h-2.628v3.686h.907v-1.472h1.49v-.732h-1.49v-.698h1.721v-.784z" />
                        </svg>
                        <span class="ml-2 text-white">Create PDF</span>
                    </button>
                </div>
            </div>
            <div id="pdfPreview">
                <div class="flex justify-center w-full">
                    <div>
                        <div class="w-[950px] h-[1345px] bg-white mt-2 p-4">
                            <!-- Header start -->
                            @include('dashboard.layouts.letter-header')
                            <!-- Header end -->
                            <!-- Body start -->
                            <div class="h-[1100px]">
                                <div class="flex justify-center">
                                    <div class="w-[725px]">
                                        <div class="flex justify-center mt-5">
                                            @if ($category == 'Service')
                                                <label class="sale-label-title">DATA PENJUALAN CETAK / PASANG</label>
                                            @else
                                                <label class="sale-label-title">DATA PENJUALAN
                                                    {{ strtoupper($category) }}</label>
                                            @endif
                                        </div>
                                        <div class="flex justify-center mt-5">
                                            <div class="sale-detail">
                                                <div class="div-sale">
                                                    <label class="label-sale-01">Nomor Penjualan</label>
                                                    <label class="label-sale-02">:</label>
                                                    <label class="label-sale-02 font-semibold">{{ $sale->number }}</label>
                                                </div>
                                                <div class="div-sale">
                                                    <label class="label-sale-01">Tgl. Penjualan</label>
                                                    <label class="label-sale-02">:</label>
                                                    <label class="label-sale-02 font-semibold">
                                                        {{ date('d', strtotime($sale->created_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($sale->created_at))] }}
                                                        {{ date('Y', strtotime($sale->created_at)) }}
                                                    </label>
                                                </div>
                                                <div class="div-sale">
                                                    <label class="label-sale-01">Dok. Approval</label>
                                                    <label class="label-sale-02">:</label>
                                                    <label
                                                        class="label-sale-02 font-semibold">{{ count($quotation_approvals) }}
                                                        dokumen</label>
                                                </div>
                                                <div class="div-sale">
                                                    <label class="label-sale-01">Dok. PO/SPK</label>
                                                    <label class="label-sale-02">:</label>
                                                    <label
                                                        class="label-sale-02 font-semibold">{{ count($quotation_orders) }}
                                                        dokumen</label>
                                                </div>
                                                @if ($category != 'Service')
                                                    <div class="div-sale">
                                                        <label class="label-sale-01">Dok. Agreement</label>
                                                        <label class="label-sale-02">:</label>
                                                        <label
                                                            class="label-sale-02 font-semibold">{{ count($quotation_agreements) }}
                                                            dokumen</label>
                                                    </div>
                                                    <div class="div-sale justify-center">
                                                        <label class="title-periode font-semibold">Periode Kontrak</label>
                                                    </div>
                                                    <div class="div-sale justify-center w-[350px] border rounded-lg p-1">
                                                        <div>
                                                            <div class="flex justify-center w-[160px]">
                                                                <label class="text-sm text-black flex">Awal Kontrak
                                                                    :</label>
                                                            </div>
                                                            <div class="flex justify-center w-[160px]">
                                                                <label class="text-sm text-black flex font-semibold">
                                                                    @if ($sale->start_at)
                                                                        {{ date('d', strtotime($sale->start_at)) }}
                                                                        {{ $bulan[(int) date('m', strtotime($sale->start_at))] }}
                                                                        {{ date('Y', strtotime($sale->start_at)) }}
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="flex justify-center w-[160px]">
                                                                <label class="text-sm text-black flex">Akhir Kontrak
                                                                    :</label>
                                                            </div>
                                                            <div class="flex justify-center w-[160px]">
                                                                <label class="text-sm text-black flex font-semibold">
                                                                    @if ($sale->end_at)
                                                                        {{ date('d', strtotime($sale->end_at)) }}
                                                                        {{ $bulan[(int) date('m', strtotime($sale->end_at))] }}
                                                                        {{ date('Y', strtotime($sale->end_at)) }}
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="sale-detail ml-2">
                                                <div class="div-sale">
                                                    <label class="label-sale-01">No. Penawaran</label>
                                                    <label class="label-sale-02">:</label>
                                                    <label class="label-sale-02 font-semibold">
                                                        @if ($revision_status == true)
                                                            <a
                                                                href="/marketing/quotation-revisions/{{ $quot_id }}">{{ $number }}</a>
                                                        @else
                                                            <a
                                                                href="/marketing/quotations/{{ $quot_id }}">{{ $number }}</a>
                                                        @endif
                                                    </label>
                                                </div>
                                                <div class="div-sale">
                                                    <label class="label-sale-01">Tgl. Penawaran</label>
                                                    <label class="label-sale-02">:</label>
                                                    <label
                                                        class="label-sale-02 font-semibold">{{ date('d', strtotime($created_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($created_at))] }}
                                                        {{ date('Y', strtotime($created_at)) }}</label>
                                                </div>
                                                <div class="div-sale">
                                                    <label class="label-sale-01">Nama Klien</label>
                                                    <label class="label-sale-02">:</label>
                                                    <label class="label-sale-02 font-semibold">{{ $clients->name }}</label>
                                                </div>
                                                @if ($clients->type == 'Perusahaan')
                                                    <div class="div-sale">
                                                        <label class="label-sale-01">Perusahaan</label>
                                                        <label class="label-sale-02">:</label>
                                                        <label
                                                            class="label-sale-02 font-semibold">{{ $clients->company }}</label>
                                                    </div>
                                                @endif
                                                <div class="div-sale">
                                                    <label class="label-sale-01">Alamat</label>
                                                    <label class="label-sale-02">:</label>
                                                    <label
                                                        class="ml-2 w-[230px] text-stone-900 text-xs font-semibold">{{ $clients->address }}</label>
                                                </div>
                                                @if ($clients->type == 'Perusahaan')
                                                    <div class="div-sale">
                                                        <label class="label-sale-01">Kontak Person</label>
                                                        <label class="label-sale-02">:</label>
                                                        <label
                                                            class="label-sale-02 font-semibold">{{ $clients->contact_name }}</label>
                                                    </div>
                                                @endif
                                                @if ($clients->type == 'Perusahaan')
                                                    <div class="div-sale">
                                                        <label class="label-sale-01">No. Handphone</label>
                                                        <label class="label-sale-02">:</label>
                                                        <label
                                                            class="label-sale-02 font-semibold">{{ $clients->contact_phone }}</label>
                                                    </div>
                                                    <div class="div-sale">
                                                        <label class="label-sale-01">Email</label>
                                                        <label class="label-sale-02">:</label>
                                                        <label
                                                            class="label-sale-02 font-semibold">{{ $clients->contact_email }}</label>
                                                    </div>
                                                @elseif ($clients->type == 'Perorangan')
                                                    <div class="div-sale">
                                                        <label class="label-sale-01">No. Handphone</label>
                                                        <label class="label-sale-02">:</label>
                                                        <label
                                                            class="label-sale-02 font-semibold">{{ $clients->phone }}</label>
                                                    </div>
                                                    <div class="div-sale">
                                                        <label class="label-sale-01">Email</label>
                                                        <label class="label-sale-02">:</label>
                                                        <label
                                                            class="label-sale-02 font-semibold">{{ $clients->email }}</label>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- table start -->
                                <div class="flex justify-center mt-2">
                                    <div class="w-[750px]">
                                        @if ($category == 'Service')
                                            @include('sales.service-show-table')
                                        @else
                                            @include('sales.show-table')
                                        @endif
                                    </div>
                                </div>
                                <!-- table end -->

                                <!-- notes start -->
                                <div class="flex justify-center mt-2">
                                    <div class="div-sale-notes w-[365px] p-2">
                                        <div>
                                            <label class="sale-note-title">Termin Pembayaran</label>
                                            @foreach ($payment_terms->dataPayments as $payment_term)
                                                <div class="flex">
                                                    <label class="label-number-notes">{{ $loop->iteration }}. </label>
                                                    <label class="label-sale-notes">{{ $payment_term->term }}
                                                        {{ $payment_term->note }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @if ($category != 'Service')
                                            <div class="mt-4">
                                                <label class="sale-note-title">Gratis Pelayanan :</label>
                                                <div>
                                                    @foreach ($salesNote as $note)
                                                        <label class="label-sale-notes flex">{{ $note }}</label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="div-sale-notes w-[365px] p-2 ml-5">
                                        <div>
                                            <label class="sale-note-title">Keterangan Tambahan :</label>
                                            <textarea class="label-sale-notes border outline-none p-2" rows="7" readonly>{{ $sale->note }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- notes end -->

                                <!-- sign area start -->
                                <div class="flex justify-center mt-2">
                                    <div class="sign-area">
                                        <div class="div-sign">
                                            <table class="table-sign">
                                                <thead>
                                                    <tr class="h-10">
                                                        <th class="th-title-sign" colspan="4">Mengetahui :</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="td-sign">Nur Cahyono</td>
                                                        <td class="td-sign">Yudhi Pratama</td>
                                                        <td class="td-sign">Ayu Putri Lestari</td>
                                                        <td class="td-sign">Texun Sandy Kamboy</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- sign area end -->

                                <!-- photo start -->
                                <div class="flex justify-center mt-2">
                                    <div class="sale-detail">
                                        <img class="img-location-sale" src="{{ asset('storage/' . $product->photo) }}">
                                    </div>
                                    <div class="qr-code-sale ml-4">
                                        {{ QrCode::size(100)->generate('http://' . $company->website . '/marketing/sales/' . $sale->id) }}
                                    </div>
                                </div>
                                <!-- photo end -->
                            </div>
                            <!-- Body end -->
                            <!-- Footer start -->
                            @include('dashboard.layouts.letter-footer')
                            <!-- Footer end -->
                        </div>
                    </div>
                </div>
                @if ($category != 'Service')
                    <div class="mt-2 w-[950px]">
                        <div class="w-[950px] h-[1345px] mt-1 bg-white p-4">
                            <!-- Header start -->
                            @include('dashboard.layouts.letter-header')
                            <!-- Header end -->
                            <!-- Body start -->
                            <div class="h-[1100px]">
                                <div>
                                    <div class="flex justify-center mt-2 w-full">
                                        <label class="flex text-lg text-center font-bold underline text-black mt-4">DETAIL
                                            PENJUALAN</label>
                                    </div>
                                    <div class="flex justify-center w-full">
                                        <label class="flex text-sm text-center font-bold text-black">Nomor :
                                            {{ $sale->number }}</label>
                                    </div>
                                </div>
                                <div class="flex justify-center mx-1 w-full mt-4">
                                    <div class="w-[780px]">
                                        <div class="mt-2 ml-2">
                                            <label class="text-sm font-semibold underline text-black w-28">A. Data Cetak
                                                dan
                                                Pasang</label>
                                        </div>
                                        <div class="flex border rounded-lg mt-1 w-[760px] p-1">
                                            <div>
                                                <div class="flex items-center">
                                                    @if (isset($notes->includedPrint) && $notes->includedPrint->checked == true)
                                                        <label class="text-sm text-black h-6 items-center w-28">Include
                                                            cetak</label>
                                                    @else
                                                        <label class="text-sm text-black h-6 items-center w-28">Free
                                                            cetak</label>
                                                    @endif
                                                    <label class="flex text-sm text-black h-6 items-center">: </label>
                                                    <label
                                                        class="flex text-sm text-black ml-2 h-5 justify-center items-center border rounded-md w-8">{{ $notes->freePrint }}</label>
                                                    <label
                                                        class="flex text-sm text-black h-6 items-center w-20 ml-6">Terpakai</label>
                                                    <label class="flex text-sm text-black h-6 items-center">: </label>
                                                    <label
                                                        class="flex text-sm text-black ml-2 h-5 justify-center items-center border rounded-md w-8">{{ count($sale->print_orders) }}</label>
                                                    <label
                                                        class="flex text-sm text-black h-6 items-center w-10 ml-6">Sisa</label>
                                                    <label class="flex text-sm text-black h-6 items-center">: </label>
                                                    <label
                                                        class="flex text-sm text-black ml-2 h-5 justify-center items-center border rounded-md w-8">{{ $notes->freePrint - count($sale->print_orders) }}</label>
                                                </div>
                                                <div class="flex items-center">
                                                    @if (isset($notes->includedInstall) && $notes->includedInstall->checked == true)
                                                        <label class="text-sm text-black h-6 items-center w-28">Include
                                                            Pasang</label>
                                                    @else
                                                        <label class="text-sm text-black h-6 items-center w-28">Free
                                                            Pasang</label>
                                                    @endif
                                                    <label class="flex text-sm text-black h-6 items-center">:</label>
                                                    <label
                                                        class="flex text-sm text-black ml-2 h-5 justify-center items-center border rounded-md w-8">{{ $notes->freeInstall }}</label>
                                                    <label
                                                        class="flex text-sm text-black h-6 items-center w-20 ml-6">Terpakai</label>
                                                    <label class="flex text-sm text-black h-6 items-center">: </label>
                                                    <label
                                                        class="flex text-sm text-black ml-2 h-5 justify-center items-center border rounded-md w-8">{{ count($sale->install_orders) }}
                                                    </label>
                                                    <label
                                                        class="flex text-sm text-black h-6 items-center w-10 ml-6">Sisa</label>
                                                    <label class="flex text-sm text-black h-6 items-center">: </label>
                                                    <label
                                                        class="flex text-sm text-black ml-2 h-5 justify-center items-center border rounded-md w-8">
                                                        {{ $notes->freeInstall - count($sale->install_orders) }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 ml-2">
                                            <label class="text-sm font-semibold underline text-black">B. Data
                                                Penagihan</label>
                                        </div>
                                        <div class="border rounded-lg mt-1 w-[760px] p-2">
                                            <div>
                                                <label class="flex text-sm text-black">Termin Pembayaran</label>
                                                <table class="table-auto w-[740px] mt-1">
                                                    <thead>
                                                        <tr>
                                                            <th class="w-12 text-[0.7rem] text-black border">Termin</th>
                                                            <th class="w-20 text-[0.7rem] text-black border">Harga</th>
                                                            <th class="w-20 text-[0.7rem] text-black border">DPP</th>
                                                            <th class="w-20 text-[0.7rem] text-black border">PPN
                                                                {{ $sale->ppn }} %
                                                            </th>
                                                            <th class="w-16 text-[0.7rem] text-black border">PPh
                                                                {{ $sale->pph }} 2 %</th>
                                                            <th class="w-20 text-[0.7rem] text-black border">Total</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($payment_terms->dataPayments as $terms)
                                                            <?php
                                                            $ppn = $sale['dpp'] * ($sale->ppn / 100);
                                                            $pph = $sale['dpp'] * (2 / 100);
                                                            ?>
                                                            <tr>
                                                                <td class="text-[0.7rem] text-center text-black border">
                                                                    {{ $loop->iteration }}.
                                                                    {{ $terms->term }} %</td>
                                                                <td class="text-[0.7rem] text-center text-black border">
                                                                    {{ number_format(($sale['price'] * $terms->term) / 100) }}
                                                                </td>
                                                                <td class="text-[0.7rem] text-center text-black border">
                                                                    {{ number_format(($sale['dpp'] * $terms->term) / 100) }}
                                                                </td>
                                                                <td class="text-[0.7rem] text-center text-black border">
                                                                    {{ number_format(($ppn * $terms->term) / 100) }}</td>
                                                                <td class="text-[0.7rem] text-center text-black border">
                                                                    {{ number_format(($pph * $terms->term) / 100) }}</td>
                                                                <td class="text-[0.7rem] text-center text-black border">
                                                                    {{ number_format((($sale['price'] + $ppn - $pph) * $terms->term) / 100) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="mt-2">
                                                <label class="text-sm text-black underline">Data Penagihan</label>
                                                <table class="table-auto w-[740px] mt-1">
                                                    <thead>
                                                        <tr>
                                                            <th class="w-12 text-[0.7rem] text-black border">No.
                                                            </th>
                                                            <th class="w-24 text-[0.7rem] text-black border">No.
                                                                Invoice</th>
                                                            <th class="w-24 text-[0.7rem] text-black border">Tgl.
                                                                Invoice</th>
                                                            <th class="w-28 text-[0.7rem] text-black border">Nominal
                                                            </th>
                                                            <th class="w-20 text-[0.7rem] text-black border">Status</th>
                                                            <th class="w-20 text-[0.7rem] text-black border">Tgl. Bayar
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($sale->billings as $billing)
                                                            <?php
                                                            $billingNominal = 0;
                                                            $descriptions = json_decode($billing->invoice_content)->description;
                                                            foreach ($descriptions as $description) {
                                                                if ($description->sale_id == $sale->id) {
                                                                    $billingNominal = $description->nominal;
                                                                }
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td class="text-[0.7rem] text-center text-black border">
                                                                    {{ $loop->iteration }}.
                                                                </td>
                                                                <td class="text-[0.7rem] text-center text-black border">
                                                                    {{ $billing->invoice_number }}
                                                                </td>
                                                                <td class="text-[0.7rem] text-center text-black border">
                                                                    {{ date('d', strtotime($billing->created_at)) }}-{{ $bulanShort[(int) date('m', strtotime($billing->created_at))] }}-{{ date('Y', strtotime($billing->created_at)) }}
                                                                </td>
                                                                <td class="text-[0.7rem] text-center text-black border">
                                                                    {{ number_format($billingNominal) }}
                                                                </td>
                                                                <td class="text-[0.7rem] text-center text-black border">
                                                                    @if (count($billing->bill_payments) > 0)
                                                                        Paid
                                                                    @else
                                                                        Unpaid
                                                                    @endif
                                                                </td>
                                                                <td class="text-[0.7rem] text-center text-black border">
                                                                    @if (count($billing->bill_payments) > 0)
                                                                        @php
                                                                            $lastPayment = $billing->bill_payments->last();
                                                                            $paymentDate = $lastPayment->payment_date;
                                                                        @endphp
                                                                        {{ date('d', strtotime($paymentDate)) }}-{{ $bulanShort[(int) date('m', strtotime($paymentDate))] }}-{{ date('Y', strtotime($paymentDate)) }}
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="mt-4 ml-2">
                                            <label class="text-sm font-semibold underline text-black">C. Data Cetak &
                                                Pasang</label>
                                        </div>
                                        <div class="flex border rounded-lg mt-1 w-[760px] p-2">
                                            <div>
                                                <table class="table-auto w-[360px] mt-1">
                                                    <thead>
                                                        <tr>
                                                            <th class="w-12 text-[0.65rem] text-black border"
                                                                colspan="6">
                                                                Detail Cetak</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="w-6 text-[0.65rem] text-black border">No.</th>
                                                            <th class="w-16 text-[0.65rem] text-black border">No. SPK</th>
                                                            <th class="w-16 text-[0.65rem] text-black border">Tgl. Cetak
                                                            </th>
                                                            <th class="text-[0.65rem] text-black border">Design</th>
                                                            <th class="w-12 text-[0.65rem] text-black border">Status</th>
                                                            <th class="w-16 text-[0.65rem] text-black border">No. Penj.
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $printNumber = 1;
                                                        @endphp
                                                        @foreach ($sale->print_orders as $print_order)
                                                            <tr>
                                                                <td class="text-[0.65rem] text-black border text-center">
                                                                    {{ $printNumber++ }}</td>
                                                                <td class="text-[0.65rem] text-black border text-center">
                                                                    <a
                                                                        href="/marketing/print-orders/{{ $print_order->id }}">
                                                                        {{ substr($print_order->number, 0, 8) }}..</a>
                                                                </td>
                                                                <td class="text-[0.65rem] text-black border text-center">
                                                                    {{ date('d-m-Y', strtotime($print_order->created_at)) }}
                                                                </td>
                                                                <td class="text-[0.65rem] text-black border text-center">
                                                                    @if (strlen($print_order->theme) > 15)
                                                                        {{ substr($print_order->theme, 0, 15) }}..
                                                                    @else
                                                                        {{ $print_order->theme }}
                                                                    @endif
                                                                </td>
                                                                <td class="text-[0.65rem] text-black border text-center">
                                                                    Free
                                                                </td>
                                                                <td class="text-[0.65rem] text-black border text-center">
                                                                    -
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        @foreach ($paid_print_orders as $paid_print_order)
                                                            <tr>
                                                                <td class="text-[0.65rem] text-black border text-center">
                                                                    {{ $printNumber++ }}</td>
                                                                <td class="text-[0.65rem] text-black border text-center">
                                                                    <a
                                                                        href="/marketing/print-orders/{{ $paid_print_order->id }}">
                                                                        {{ substr($paid_print_order->number, 0, 8) }}..</a>
                                                                </td>
                                                                <td class="text-[0.65rem] text-black border text-center">
                                                                    {{ date('d-m-Y', strtotime($paid_print_order->created_at)) }}
                                                                </td>
                                                                <td class="text-[0.65rem] text-black border text-center">
                                                                    @if (strlen($paid_print_order->theme) > 15)
                                                                        {{ substr($paid_print_order->theme, 0, 15) }}..
                                                                    @else
                                                                        {{ $paid_print_order->theme }}
                                                                    @endif
                                                                </td>
                                                                <td class="text-[0.65rem] text-black border text-center">
                                                                    Berbayar
                                                                </td>
                                                                <td class="text-[0.65rem] text-black border text-center">
                                                                    <a
                                                                        href="/marketing/sales/{{ $paid_print_order->sale->id }}">{{ substr($paid_print_order->sale->number, 0, 8) }}..</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div>
                                                <table class="table-auto w-[360px] mt-1 ml-4">
                                                    <thead>
                                                        <tr>
                                                            <th class="w-12 text-[0.65rem] text-black border"
                                                                colspan="6">
                                                                Detail Pasang</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="w-6 text-[0.65rem] text-black border">No.</th>
                                                            <th class="w-16 text-[0.65rem] text-black border">No. SPK
                                                            </th>
                                                            <th class="w-16 text-[0.65rem] text-black border">Tgl. Pasang
                                                            </th>
                                                            <th class="text-[0.65rem] text-black border">Design
                                                            </th>
                                                            <th class="w-12 text-[0.65rem] text-black border">Status
                                                            </th>
                                                            <th class="w-16 text-[0.65rem] text-black border">No. Penj.
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $installNumber = 1;
                                                        @endphp
                                                        @foreach ($sale->install_orders as $install_order)
                                                            <tr>
                                                                <td class="text-[0.65rem] text-black border text-center">
                                                                    {{ $installNumber++ }}</td>
                                                                <td class="text-[0.65rem] text-black border text-center">
                                                                    <a
                                                                        href="/marketing/install-orders/{{ $install_order->id }}">
                                                                        {{ substr($install_order->number, 0, 8) }}..</a>
                                                                </td>
                                                                <td class="text-[0.65rem] text-black border text-center">
                                                                    {{ date('d-m-Y', strtotime($install_order->install_at)) }}
                                                                </td>
                                                                <td class="text-[0.65rem] text-black border text-center">
                                                                    @if (strlen($install_order->theme) > 15)
                                                                        {{ substr($install_order->theme, 0, 15) }}..
                                                                    @else
                                                                        {{ $install_order->theme }}
                                                                    @endif
                                                                </td>
                                                                <td class="text-[0.65rem] text-black border text-center">
                                                                    Free
                                                                </td>
                                                                <td class="text-[0.65rem] text-black border text-center">
                                                                    -
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        @foreach ($paid_install_orders as $paid_install_order)
                                                            <tr>
                                                                <td class="text-[0.65rem] text-black border text-center">
                                                                    {{ $installNumber++ }}</td>
                                                                <td class="text-[0.65rem] text-black border text-center">
                                                                    <a
                                                                        href="/marketing/install-orders/{{ $paid_install_order->id }}">
                                                                        {{ substr($paid_install_order->number, 0, 8) }}..</a>
                                                                </td>
                                                                <td class="text-[0.65rem] text-black border text-center">
                                                                    {{ date('d-m-Y', strtotime($paid_install_order->created_at)) }}
                                                                </td>
                                                                <td class="text-[0.65rem] text-black border text-center">
                                                                    @if (strlen($paid_install_order->theme) > 15)
                                                                        {{ substr($paid_install_order->theme, 0, 15) }}..
                                                                    @else
                                                                        {{ $paid_install_order->theme }}
                                                                    @endif
                                                                </td>
                                                                <td class="text-[0.65rem] text-black border text-center">
                                                                    Berbayar
                                                                </td>
                                                                <td class="text-[0.65rem] text-black border text-center">
                                                                    <a
                                                                        href="/marketing/sales/{{ $paid_install_order->sale->id }}">{{ substr($paid_install_order->sale->number, 0, 8) }}..</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Body end -->
                            <!-- Footer start -->
                            @include('dashboard.layouts.letter-footer')
                            <!-- Footer end -->
                        </div>
                    </div>
                @else
                    <div class="mt-2 w-[950px]">
                        <div class="w-[950px] h-[1345px] mt-1 bg-white p-4">
                            <!-- Header start -->
                            @include('dashboard.layouts.letter-header')
                            <!-- Header end -->
                            <!-- Body start -->
                            <div class="h-[1100px]">
                                <div>
                                    <div class="flex justify-center mt-2 w-full">
                                        <label class="flex text-lg text-center font-bold underline text-black mt-4">DETAIL
                                            PENJUALAN</label>
                                    </div>
                                    <div class="flex justify-center w-full">
                                        <label class="flex text-sm text-center font-bold text-black">Nomor :
                                            {{ $sale->number }}</label>
                                    </div>
                                </div>
                                <div class="flex justify-center mx-1 w-full mt-4">
                                    <div class="w-[780px]">
                                        <div class="border rounded-lg mt-1 w-[760px] p-2">
                                            <div>
                                                <label class="flex text-sm text-black">Termin Pembayaran</label>
                                                <table class="table-auto w-[740px] mt-1">
                                                    <thead>
                                                        <tr>
                                                            <th class="w-12 text-[0.7rem] text-black border">Termin</th>
                                                            <th class="w-20 text-[0.7rem] text-black border">Harga</th>
                                                            <th class="w-20 text-[0.7rem] text-black border">DPP</th>
                                                            <th class="w-20 text-[0.7rem] text-black border">PPN
                                                                {{ $sale->ppn }} %
                                                            </th>
                                                            <th class="w-16 text-[0.7rem] text-black border">PPh
                                                                {{ $sale->pph }} 2 %</th>
                                                            <th class="w-20 text-[0.7rem] text-black border">Total</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($payment_terms->dataPayments as $terms)
                                                            <?php
                                                            $ppn = $sale['dpp'] * ($sale->ppn / 100);
                                                            $pph = $sale['dpp'] * (2 / 100);
                                                            ?>
                                                            <tr>
                                                                <td class="text-[0.7rem] text-center text-black border">
                                                                    {{ $loop->iteration }}.
                                                                    {{ $terms->term }} %</td>
                                                                <td class="text-[0.7rem] text-center text-black border">
                                                                    {{ number_format(($sale['price'] * $terms->term) / 100) }}
                                                                </td>
                                                                <td class="text-[0.7rem] text-center text-black border">
                                                                    {{ number_format(($sale['dpp'] * $terms->term) / 100) }}
                                                                </td>
                                                                <td class="text-[0.7rem] text-center text-black border">
                                                                    {{ number_format(($ppn * $terms->term) / 100) }}</td>
                                                                <td class="text-[0.7rem] text-center text-black border">
                                                                    {{ number_format(($pph * $terms->term) / 100) }}</td>
                                                                <td class="text-[0.7rem] text-center text-black border">
                                                                    {{ number_format((($sale['price'] + $ppn - $pph) * $terms->term) / 100) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="mt-2">
                                                <label class="text-sm text-black underline">Data Penagihan</label>
                                                <table class="table-auto w-[740px] mt-1">
                                                    <thead>
                                                        <tr>
                                                            <th class="w-12 text-[0.7rem] text-black border">No.
                                                            </th>
                                                            <th class="w-40 text-[0.7rem] text-black border">No.
                                                                Invoice</th>
                                                            <th class="w-24 text-[0.7rem] text-black border">Tgl.
                                                                Invoice</th>
                                                            <th class="w-28 text-[0.7rem] text-black border">Nominal
                                                            </th>
                                                            <th class="w-20 text-[0.7rem] text-black border">Status</th>
                                                            <th class="w-20 text-[0.7rem] text-black border">Tgl. Bayar
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($sale->billings as $billing)
                                                            <?php
                                                            $billingNominal = 0;
                                                            $descriptions = json_decode($billing->invoice_content)->description;
                                                            foreach ($descriptions as $description) {
                                                                if ($description->sale_id == $sale->id) {
                                                                    $billingNominal = $description->nominal;
                                                                }
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td class="text-[0.7rem] text-center text-black border">
                                                                    {{ $loop->iteration }}.
                                                                </td>
                                                                <td class="text-[0.7rem] text-center text-black border">
                                                                    {{ $billing->invoice_number }}
                                                                </td>
                                                                <td class="text-[0.7rem] text-center text-black border">
                                                                    {{ date('d', strtotime($billing->created_at)) }}-{{ $bulanShort[(int) date('m', strtotime($billing->created_at))] }}-{{ date('Y', strtotime($billing->created_at)) }}
                                                                </td>
                                                                <td class="text-[0.7rem] text-center text-black border">
                                                                    {{ number_format($billingNominal) }}
                                                                </td>
                                                                <td class="text-[0.7rem] text-center text-black border">
                                                                    @if (count($billing->bill_payments) > 0)
                                                                        Paid
                                                                    @else
                                                                        Unpaid
                                                                    @endif
                                                                </td>
                                                                <td class="text-[0.7rem] text-center text-black border">
                                                                    @if (count($billing->bill_payments) > 0)
                                                                        @php
                                                                            $lastPayment = $billing->bill_payments->last();
                                                                            $paymentDate = $lastPayment->payment_date;
                                                                        @endphp
                                                                        {{ date('d', strtotime($paymentDate)) }}-{{ $bulanShort[(int) date('m', strtotime($paymentDate))] }}-{{ date('Y', strtotime($paymentDate)) }}
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Body end -->
                            <!-- Footer start -->
                            @include('dashboard.layouts.letter-footer')
                            <!-- Footer end -->
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @if ($category == 'Service')
        <input id="saveName" type="text"
            value="{{ Str::substr($sale->number, 0, 4) }}-PJ-Cetak-Pasang-{{ $clients->name }}" hidden>
    @else
        <input id="saveName" type="text"
            value="{{ Str::substr($sale->number, 0, 4) }}-PJ-{{ $category }}-{{ $clients->name }}" hidden>
    @endif

    <!-- Show Sales Data end -->

    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>

    <script>
        const saveName = document.getElementById("saveName");
        document.getElementById("btnCreatePdf").onclick = function() {
            var element = document.getElementById('pdfPreview');
            var opt = {
                margin: 0,
                filename: saveName.value,
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                pagebreak: {
                    mode: ['avoid-all', 'css', 'legacy']
                },
                html2canvas: {
                    dpi: 300,
                    scale: 1.5,
                    letterRendering: true,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'px',
                    format: [950, 1365],
                    orientation: 'portrait',
                    putTotalPages: true
                }
            };
            html2pdf().set(opt).from(element).save();
        };
    </script>

    <!-- Script end -->
@endsection
