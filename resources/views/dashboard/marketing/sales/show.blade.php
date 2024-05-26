@extends('dashboard.layouts.main');

@section('container')
    <!-- Show Quotatin start -->
    <div class="flex justify-center bg-gray-800">
        <div class="mt-10">
            <!-- Title Show Quotatin start -->
            <div class="flex border-b w-[950px]">
                <div class="flex w-72 items-center">
                    <h1 class="text-xl text-white font-bold tracking-wider">DETAIL PENJUALAN</h1>
                </div>
                <div class="flex justify-end w-[660px]">
                    <a class="flex justify-center items-center ml-1 btn-success" href="/dashboard/marketing/sales">
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
            <!-- Title Show Quotatin end -->
            <input type="text" id="saveNumber"
                value="{{ Str::substr($sale['number'], 0, 4) }}-Sales-{{ $sale->client->name }}" hidden>
            <div id="pdfPreview">
                <div class="mt-2 w-[950px]">
                    <!-- Header start -->
                    <div class="w-[950px] h-[1345px] mt-2 bg-white">
                        <div class="h-24 mt-4">
                            <div class="flex w-full justify-center items-center">
                                <img class="mt-3" src="/img/logo-vm.png" alt="">
                            </div>
                            <div class="flex w-full justify-center items-center mt-2">
                                <img src="/img/line-top.png" alt="">
                            </div>
                        </div>
                        <!-- Header end -->
                        <!-- Body start -->
                        <div class="h-[1125px]">
                            <div>
                                <div class="flex justify-center mt-4 w-full">
                                    <label class="flex text-lg text-center font-bold underline text-teal-700 mt-4">DETAIL
                                        PENJUALAN</label>
                                </div>
                                <div class="flex justify-center w-full">
                                    <label class="flex text-sm text-center font-bold text-teal-700">Nomor :
                                        {{ $sale->number }}</label>
                                </div>
                            </div>
                            <div class="flex justify-center mx-1 w-full mt-4">
                                <div class="w-[780px]">
                                    <div class="mt-2 ml-2">
                                        <label class="text-sm font-semibold underline text-teal-700 w-28">A. Data Cetak
                                            dan
                                            Pasang</label>
                                    </div>
                                    <div class="border rounded-lg mt-1 w-[760px] p-2">
                                        <div class="flex">
                                            <label class="text-sm text-teal-700 w-28">Free cetak</label>
                                            @if ($sale->free_print)
                                                <label class="flex text-sm text-teal-700 w-24">: {{ $sale->free_print }}
                                                    x</label>
                                                <label class="text-sm text-teal-700 w-10">Sisa</label>
                                                <label class="flex text-sm text-teal-700 w-24">: - </label>
                                            @else
                                                <label class="flex text-sm text-teal-700 w-24">: - </label>
                                            @endif
                                        </div>
                                        <div class="flex">
                                            <label class="text-sm text-teal-700 w-28">Free Pemasangan</label>
                                            @if ($sale->free_instalation)
                                                <label class="flex text-sm text-teal-700 w-24">:
                                                    {{ $sale->free_instalation }}
                                                    x</label>
                                                <label class="text-sm text-teal-700 w-10">Sisa</label>
                                                <label class="flex text-sm text-teal-700 w-24">: - </label>
                                            @else
                                                <label class="flex text-sm text-teal-700 w-24">: - </label>
                                            @endif
                                        </div>
                                        @if ($sale->free_print)
                                            <div class="mt-2">
                                                <label class="text-sm text-teal-700 underline">Penggunaan Free
                                                    Cetak & Pemasangan</label>
                                                <table class="table-auto w-[740px] mt-1">
                                                    <thead>
                                                        <tr>
                                                            <th class="w-10 text-[0.7rem] text-teal-700 border">No.
                                                            </th>
                                                            <th class="w-24 text-[0.7rem] text-teal-700 border">No. SPK
                                                                Cetak
                                                            </th>
                                                            <th class="w-24 text-[0.7rem] text-teal-700 border">Tgl.
                                                                Cetak</th>
                                                            <th class="w-24 text-[0.7rem] text-teal-700 border">No. SPK
                                                                Pasang
                                                            </th>
                                                            <th class="w-20 text-[0.7rem] text-teal-700 border">Tgl.
                                                                Pasang</th>
                                                            <th class="w-52 text-[0.7rem] text-teal-700 border">Desain
                                                            </th>
                                                            <th class="w-10 text-[0.7rem] text-teal-700 border">Dok.
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                1</td>
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                -
                                                            </td>
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                {{-- {{ date('d-M-Y', strtotime($sale->created_at)) }} --}}
                                                            </td>
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                -
                                                            </td>
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                {{-- {{ date('d-M-Y', strtotime($sale->created_at)) }} --}}
                                                            </td>
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                -
                                                            </td>
                                                            <td
                                                                class="flex justify-center text-[0.7rem] text-center text-teal-700 border">
                                                                <button
                                                                    class="flex justify-center items-center w-6 h-4 rounded-lg border bg-teal-200 hover:bg-teal-500"
                                                                    type="button">
                                                                    <svg class="fill-current w-4" clip-rule="evenodd"
                                                                        fill-rule="evenodd" stroke-linejoin="round"
                                                                        stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm8.413 7c-1.837 2.878-4.897 5.5-8.413 5.5-3.465 0-6.532-2.632-8.404-5.5 1.871-2.868 4.939-5.5 8.404-5.5 3.518 0 6.579 2.624 8.413 5.5zm-8.411-4c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"
                                                                            fill-rule="nonzero" />
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mt-4 ml-2">
                                        <label class="text-sm font-semibold underline text-teal-700">B. Data
                                            Penagihan</label>
                                    </div>
                                    <div class="border rounded-lg mt-1 w-[760px] p-2">
                                        <div>
                                            <?php
                                            $objPayments = json_decode($sale->terms_of_payment);
                                            $payments = $objPayments->payments;
                                            ?>
                                            <label class="flex text-sm text-teal-700">Termin Pembayaran</label>
                                            <table class="table-auto w-[740px] mt-1">
                                                <thead>
                                                    <tr>
                                                        <th class="w-12 text-[0.7rem] text-teal-700 border">Termin</th>
                                                        <th class="w-20 text-[0.7rem] text-teal-700 border">Harga</th>
                                                        <th class="w-20 text-[0.7rem] text-teal-700 border">DPP</th>
                                                        <th class="w-20 text-[0.7rem] text-teal-700 border">PPN 11%
                                                        </th>
                                                        <th class="w-16 text-[0.7rem] text-teal-700 border">PPh 2%</th>
                                                        <th class="w-20 text-[0.7rem] text-teal-700 border">Total</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($payments as $terms)
                                                        <?php
                                                        $ppn = $sale['dpp'] * (11 / 100);
                                                        $pph = $sale['dpp'] * (2 / 100);
                                                        ?>
                                                        <tr>
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                {{ $loop->iteration }}.
                                                                {{ $terms->termValue }} %</td>
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                {{ number_format(($sale['price'] * $terms->termValue) / 100) }}
                                                            </td>
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                {{ number_format(($sale['dpp'] * $terms->termValue) / 100) }}
                                                            </td>
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                {{ number_format(($ppn * $terms->termValue) / 100) }}</td>
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                {{ number_format(($pph * $terms->termValue) / 100) }}</td>
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                {{ number_format((($sale['price'] + $ppn - $pph) * $terms->termValue) / 100) }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mt-2">
                                            <label class="text-sm text-teal-700 underline">Data Penagihan</label>
                                            <table class="table-auto w-[740px] mt-1">
                                                <thead>
                                                    <tr>
                                                        <th class="w-12 text-[0.7rem] text-teal-700 border">Termin
                                                        </th>
                                                        <th class="w-24 text-[0.7rem] text-teal-700 border">No.
                                                            Invoice</th>
                                                        <th class="w-24 text-[0.7rem] text-teal-700 border">Tgl.
                                                            Invoice</th>
                                                        <th class="w-28 text-[0.7rem] text-teal-700 border">Nominal
                                                        </th>
                                                        <th class="w-20 text-[0.7rem] text-teal-700 border">Status</th>
                                                        <th class="w-20 text-[0.7rem] text-teal-700 border">Tgl. Bayar
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($payments as $terms)
                                                        <?php
                                                        $ppn = $sale['dpp'] * (11 / 100);
                                                        $pph = $sale['dpp'] * (2 / 100);
                                                        ?>
                                                        <tr>
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                {{ $loop->iteration }}.
                                                                {{ $terms->termValue }} %</td>
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                -
                                                            </td>
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                {{-- {{ date('d-M-Y', strtotime($sale->created_at)) }} --}}
                                                            </td>
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                {{ number_format((($sale['price'] + $ppn - $pph) * $terms->termValue) / 100) }}
                                                            </td>
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                sent / paid </td>
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                {{-- {{ date('d-M-Y', strtotime($sale->created_at)) }} --}}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="mt-4 ml-2">
                                        <label class="text-sm font-semibold underline text-teal-700">C. Data Cetak &
                                            Pasang</label>
                                    </div>
                                    <div class="border rounded-lg mt-1 w-[760px] p-2">
                                        <div>
                                            <table class="table-auto w-[740px] mt-1">
                                                <thead>
                                                    <tr>
                                                        <th class="w-12 text-[0.65rem] text-teal-700 border"
                                                            colspan="6">Detail Cetak</th>
                                                        <th class="w-20 text-[0.65rem] text-teal-700 border"
                                                            colspan="6">Detail Pasang</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="w-6 text-[0.65rem] text-teal-700 border">No.</th>
                                                        <th class="w-16 text-[0.65rem] text-teal-700 border">SPK Cetak</th>
                                                        <th class="w-16 text-[0.65rem] text-teal-700 border">Tgl. Cetak
                                                        </th>
                                                        <th class="w-16 text-[0.65rem] text-teal-700 border">Design</th>
                                                        <th class="w-12 text-[0.65rem] text-teal-700 border">Status</th>
                                                        <th class="w-24 text-[0.65rem] text-teal-700 border">No. Penawaran
                                                        </th>
                                                        <th class="w-6 text-[0.65rem] text-teal-700 border">No.</th>
                                                        <th class="w-16 text-[0.65rem] text-teal-700 border">SPK Pasang
                                                        </th>
                                                        <th class="w-16 text-[0.65rem] text-teal-700 border">Tgl. Pasang
                                                        </th>
                                                        <th class="w-16 text-[0.65rem] text-teal-700 border">Design</th>
                                                        <th class="w-12 text-[0.65rem] text-teal-700 border">Status</th>
                                                        <th class="w-24 text-[0.65rem] text-teal-700 border">No. Penawaran
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @for ($i = 0; $i < 36; $i++)
                                                        <tr>
                                                            <td class="text-[0.65rem] text-teal-700 border text-center">
                                                                {{ $i + 1 }}</td>
                                                            <td class="text-[0.65rem] text-teal-700 border text-center">-
                                                            </td>
                                                            <td class="text-[0.65rem] text-teal-700 border text-center">-
                                                            </td>
                                                            <td class="text-[0.65rem] text-teal-700 border text-center">-
                                                            </td>
                                                            <td class="text-[0.65rem] text-teal-700 border text-center">-
                                                            </td>
                                                            <td class="text-[0.65rem] text-teal-700 border text-center">-
                                                            </td>
                                                            <td class="text-[0.65rem] text-teal-700 border text-center">-
                                                            </td>
                                                            <td class="text-[0.65rem] text-teal-700 border text-center">-
                                                            </td>
                                                            <td class="text-[0.65rem] text-teal-700 border text-center">-
                                                            </td>
                                                            <td class="text-[0.65rem] text-teal-700 border text-center">-
                                                            </td>
                                                            <td class="text-[0.65rem] text-teal-700 border text-center">-
                                                            </td>
                                                            <td class="text-[0.65rem] text-teal-700 border text-center">-
                                                            </td>
                                                        </tr>
                                                    @endfor
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Body end -->
                        <!-- Footer start -->
                        <div class="flex items-end justify-center">
                            <div>
                                <div class="flex w-full h-max justify-center mt-2">
                                    <img src="/img/line-bottom.png" alt="">
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <span class="text-xs font-semibold">PT. Vista Media</span>
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <span class="text-xs">Jl. Pulau Kawe No. 40 - Denpasar | Bali - Indonesia</span>
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <span class="text-xs">Ph. +62 361 230000 | Fax. +62 361 237800 </span>
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <span class="text-xs">e-mail : info@vistamedia.co.id | www.vistamedia.co.id</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Footer end -->
                </div>
                <div class="mt-2 w-[950px]">
                    <!-- Header start -->
                    <div class="w-[950px] h-[1345px] mt-2 bg-white">
                        <div class="h-24 mt-4">
                            <div class="flex w-full justify-center items-center">
                                <img class="mt-3" src="/img/logo-vm.png" alt="">
                            </div>
                            <div class="flex w-full justify-center items-center mt-2">
                                <img src="/img/line-top.png" alt="">
                            </div>
                        </div>
                        <!-- Header end -->
                        <!-- Body start -->
                        <div class="h-[1125px]">
                            <div class="flex justify-center mt-1">
                                <label class="sale-label-title">DATA PENJUALAN</label>
                            </div>
                            <div class="body-detail">
                                <div class="sale-detail">
                                    <div class="div-sale">
                                        <label class="label-sale-01">No. Penjualan</label>
                                        <label class="label-sale-02">:</label>
                                        <label class="label-sale-02">{{ $sale->number }}</label>
                                    </div>
                                    <div class="div-sale">
                                        <label class="label-sale-01">Tgl. Penjualan</label>
                                        <label class="label-sale-02">:</label>
                                        <label
                                            class="label-sale-02">{{ date('d-M-Y', strtotime($sale->created_at)) }}</label>
                                    </div>
                                    <div class="div-sale">
                                        <label class="label-sale-01">Dok. Approval</label>
                                        <label class="label-sale-02">:</label>
                                        <?php
                                        $approvals = 0;
                                        ?>
                                        @if ($sale->billboard_quotation_id)
                                            @foreach ($client_approvals as $approval)
                                                @if ($approval->billboard_quotation_id === $sale->billboard_quotation_id)
                                                    <?php
                                                    $approvals = $approvals + 1;
                                                    ?>
                                                @endif
                                            @endforeach
                                            @if ($approvals == 0)
                                                <label class="text-xs text-teal-700 ml-2">-</label>
                                                {{-- <button
                                                    class="w-max h-4 ml-2 items-center cursor-pointer bg-teal-500 rounded-lg text-white hover:bg-teal-600 drop-shadow-lg flex justify-center"
                                                    id="btnAgreement"
                                                    onclick="previewApprovalImage('Main', '{{ $sale->billboard_quotation_id }}')"
                                                    type="button">
                                                    <span id="spanBtnApproval" class="text-xs mx-2">add</span>
                                                </button> --}}
                                            @else
                                                <label class="text-xs text-teal-700 ml-2">{{ $approvals }}
                                                    documents</label>
                                                {{-- <button
                                                    class="w-max h-4 ml-2 items-center cursor-pointer bg-teal-500 rounded-lg text-white hover:bg-teal-600 drop-shadow-lg flex justify-center"
                                                    id="btnAgreement"
                                                    onclick="previewApprovalImage('Main', '{{ $sale->billboard_quotation_id }}')"
                                                    type="button">
                                                    <span id="spanBtnApproval" class="text-xs mx-2">view</span>
                                                </button> --}}
                                            @endif
                                        @elseif ($sale->billboard_quot_revision_id)
                                            @foreach ($client_approvals as $approval)
                                                @if ($approval->billboard_quot_revision_id === $sale->billboard_quot_revision_id)
                                                    <?php
                                                    $approvals = $approvals + 1;
                                                    ?>
                                                @endif
                                            @endforeach
                                            @if ($approvals == 0)
                                                <label class="text-xs text-teal-700 ml-2">-</label>
                                                {{-- <button
                                                    class="w-max h-4 ml-2 items-center cursor-pointer bg-teal-500 rounded-lg text-white hover:bg-teal-600 drop-shadow-lg flex justify-center"
                                                    id="btnAgreement"
                                                    onclick="previewApprovalImage('Revision', '{{ $sale->billboard_quot_revision_id }}')"
                                                    type="button">
                                                    <span id="spanBtnApproval" class="text-xs mx-2">add</span>
                                                </button> --}}
                                            @else
                                                <label class="text-xs text-teal-700 ml-2">{{ $approvals }}
                                                    documents</label>
                                                {{-- <button
                                                    class="w-max h-4 ml-2 items-center cursor-pointer bg-teal-500 rounded-lg text-white hover:bg-teal-600 drop-shadow-lg flex justify-center"
                                                    id="btnAgreement"
                                                    onclick="previewApprovalImage('Revision', '{{ $sale->billboard_quot_revision_id }}')"
                                                    type="button">
                                                    <span id="spanBtnApproval" class="text-xs mx-2">view</span>
                                                </button> --}}
                                            @endif
                                        @endif
                                    </div>
                                    <div class="div-sale">
                                        <label class="label-sale-01">Dok. PO/SPK</label>
                                        <label class="label-sale-02">:</label>
                                        <?php
                                        $orders = 0;
                                        ?>
                                        @if ($sale->billboard_quotation_id)
                                            @foreach ($client_orders as $order)
                                                @if ($order->billboard_quotation_id === $sale->billboard_quotation_id)
                                                    <?php
                                                    $orders = $orders + 1;
                                                    ?>
                                                @endif
                                            @endforeach
                                            @if ($orders == 0)
                                                <label class="label-sale-02">-</label>
                                                {{-- <button
                                                    class="w-max h-4 ml-2 items-center cursor-pointer bg-teal-500 rounded-lg text-white hover:bg-teal-600 drop-shadow-lg flex justify-center"
                                                    id="btnAgreement"
                                                    onclick="previewPOImage('Main', '{{ $sale->billboard_quotation_id }}')"
                                                    type="button">
                                                    <span id="spanBtnPo" class="text-xs mx-2">add</span>
                                                </button> --}}
                                            @else
                                                <label class="label-sale-02">{{ $orders }}
                                                    documents</label>
                                                {{-- <button
                                                    class="w-max h-4 ml-2 items-center cursor-pointer bg-teal-500 rounded-lg text-white hover:bg-teal-600 drop-shadow-lg flex justify-center"
                                                    id="btnAgreement"
                                                    onclick="previewPOImage('Main', '{{ $sale->billboard_quotation_id }}')"
                                                    type="button">
                                                    <span id="spanBtnPo" class="text-xs mx-2">view</span>
                                                </button> --}}
                                            @endif
                                        @elseif ($sale->billboard_quot_revision_id)
                                            @foreach ($client_approvals as $order)
                                                @if ($order->billboard_quot_revision_id === $sale->billboard_quot_revision_id)
                                                    <?php
                                                    $orders = $orders + 1;
                                                    ?>
                                                @endif
                                            @endforeach
                                            @if ($orders == 0)
                                                <label class="label-sale-02">-</label>
                                                {{-- <button
                                                    class="w-max h-4 ml-2 items-center cursor-pointer bg-teal-500 rounded-lg text-white hover:bg-teal-600 drop-shadow-lg flex justify-center"
                                                    id="btnAgreement"
                                                    onclick="previewPOImage('Revision', '{{ $sale->billboard_quot_revision_id }}')"
                                                    type="button">
                                                    <span id="spanBtnPo" class="text-xs mx-2">add</span>
                                                </button> --}}
                                            @else
                                                <label class="label-sale-02">{{ $orders }}
                                                    documents</label>
                                                {{-- <button
                                                    class="w-max h-4 ml-2 items-center cursor-pointer bg-teal-500 rounded-lg text-white hover:bg-teal-600 drop-shadow-lg flex justify-center"
                                                    id="btnAgreement"
                                                    onclick="previewPOImage('Revision', '{{ $sale->billboard_quot_revision_id }}')"
                                                    type="button">
                                                    <span id="spanBtnPo" class="text-xs mx-2">view</span>
                                                </button> --}}
                                            @endif
                                        @endif
                                    </div>
                                    <div class="div-sale">
                                        <label class="label-sale-01">Dok. Agreement</label>
                                        <label class="label-sale-02">:</label>
                                        <?php
                                        $agreements = 0;
                                        ?>
                                        @if ($sale->billboard_quotation_id)
                                            @foreach ($client_agreements as $agreement)
                                                @if ($agreement->billboard_quotation_id === $sale->billboard_quotation_id)
                                                    <?php
                                                    $agreements = $agreements + 1;
                                                    ?>
                                                @endif
                                            @endforeach
                                            @if ($agreements == 0)
                                                <label class="label-sale-02">-</label>
                                                {{-- <button
                                                    class="w-max h-4 ml-2 items-center cursor-pointer bg-teal-500 rounded-lg text-white hover:bg-teal-600 drop-shadow-lg flex justify-center"
                                                    id="btnAgreement"
                                                    onclick="previewAgreementImage('Main', '{{ $sale->billboard_quotation_id }}')"
                                                    type="button">
                                                    <span id="spanBtnAgreement" class="text-xs mx-2">add</span>
                                                </button> --}}
                                            @else
                                                <label class="label-sale-02">{{ $agreements }}
                                                    documents</label>
                                                {{-- <button
                                                    class="w-max h-4 ml-2 items-center cursor-pointer bg-teal-500 rounded-lg text-white hover:bg-teal-600 drop-shadow-lg flex justify-center"
                                                    id="btnAgreement"
                                                    onclick="previewAgreementImage('Main', '{{ $sale->billboard_quotation_id }}')"
                                                    type="button">
                                                    <span id="spanBtnAgreement" class="text-xs mx-2">view</span>
                                                </button> --}}
                                            @endif
                                        @elseif ($sale->billboard_quot_revision_id)
                                            @foreach ($client_approvals as $agreement)
                                                @if ($agreement->billboard_quot_revision_id === $sale->billboard_quot_revision_id)
                                                    <?php
                                                    $agreements = $agreements + 1;
                                                    ?>
                                                @endif
                                            @endforeach
                                            @if ($agreements == 0)
                                                <label class="label-sale-02">-</label>
                                                {{-- <button
                                                    class="w-max h-4 ml-2 items-center cursor-pointer bg-teal-500 rounded-lg text-white hover:bg-teal-600 drop-shadow-lg flex justify-center"
                                                    id="btnAgreement"
                                                    onclick="previewAgreementImage('Revision', '{{ $sale->billboard_quot_revision_id }}')"
                                                    type="button">
                                                    <span id="spanBtnAgreement" class="text-xs mx-2">add</span>
                                                </button> --}}
                                            @else
                                                <label class="label-sale-02">{{ $agreements }}
                                                    documents</label>
                                                {{-- <button
                                                    class="w-max h-4 ml-2 items-center cursor-pointer bg-teal-500 rounded-lg text-white hover:bg-teal-600 drop-shadow-lg flex justify-center"
                                                    id="btnAgreement"
                                                    onclick="previewAgreementImage('Revision', '{{ $sale->billboard_quot_revision_id }}')"
                                                    type="button">
                                                    <span id="spanBtnAgreement" class="text-xs mx-2">view</span>
                                                </button> --}}
                                            @endif
                                        @endif
                                    </div>
                                    <div class="div-sale">
                                        <label class="text-teal-700 text-xs border-b-2 border-teal-700">PERIODE
                                            KONTRAK</label>
                                    </div>
                                    <div class="div-sale">
                                        <label class="label-sale-01">Awal</label>
                                        <label class="label-sale-02">:</label>
                                        @if ($sale->start_at)
                                            <label
                                                class="label-sale-02">{{ date('d-M-Y', strtotime($sale->start_at)) }}</label>
                                        @else
                                            <label class="label-sale-02"> -</label>
                                            {{-- <input class="label-sale-02 outline-none border rounded-sm" type="date"
                                                name="start_at" id="start_at"> --}}
                                        @endif
                                    </div>
                                    <div class="div-sale">
                                        <label class="label-sale-01">Akhir</label>
                                        <label class="label-sale-02">:</label>
                                        @if ($sale->end_at)
                                            <label
                                                class="label-sale-02">{{ date('d-M-Y', strtotime($sale->end_at)) }}</label>
                                        @else
                                            <label class="label-sale-02"> -</label>
                                            {{-- <input class="label-sale-02 outline-none border rounded-sm" type="date"
                                                name="end_at" id="end_at"> --}}
                                        @endif
                                    </div>
                                </div>
                                <div class="sale-detail ml-4">
                                    <div class="div-sale">
                                        <label class="label-sale-01">No. Penawaran</label>
                                        <label class="label-sale-02">:</label>
                                        @if ($sale->billboard_quotation_id)
                                            <label class="label-sale-02">{{ $sale->billboard_quotation->number }}</label>
                                        @elseif ($sale->billboard_quot_revision_id)
                                            <label
                                                class="label-sale-02">{{ $sale->billboard_quot_revision->number }}</label>
                                        @endif
                                    </div>
                                    <div class="div-sale">
                                        <label class="label-sale-01">Tgl. Penawaran</label>
                                        <label class="label-sale-02">:</label>
                                        @if ($sale->billboard_quotation_id)
                                            <label
                                                class="label-sale-02">{{ date('d-M-Y', strtotime($sale->billboard_quotation->created_at)) }}</label>
                                        @elseif ($sale->billboard_quot_revision_id)
                                            <label
                                                class="label-sale-02">{{ date('d-M-Y', strtotime($sale->billboard_quot_revision->created_at)) }}</label>
                                        @endif
                                    </div>
                                    <div class="div-sale">
                                        <label class="label-sale-01">Nama Klien</label>
                                        <label class="label-sale-02">:</label>
                                        <label class="label-sale-02">{{ $sale->client->name }}</label>
                                    </div>
                                    <div class="div-sale">
                                        <label class="label-sale-01">Perusahaan</label>
                                        <label class="label-sale-02">:</label>
                                        <label class="label-sale-02">{{ $sale->client->company }}</label>
                                    </div>
                                    <div class="div-sale">
                                        <label class="label-sale-01">Alamat</label>
                                        <label class="label-sale-02">:</label>
                                        <label class="label-sale-02">{{ $sale->client->address }}</label>
                                    </div>
                                    <div class="div-sale">
                                        <label class="label-sale-01">Kontak Person</label>
                                        <label class="label-sale-02">:</label>
                                        <label class="label-sale-02">{{ $sale->contact->name }}</label>
                                    </div>
                                    <div class="div-sale">
                                        <label class="label-sale-01">No. Telp./Hp.</label>
                                        <label class="label-sale-02">:</label>
                                        <label class="label-sale-02">{{ $sale->contact->phone }}</label>
                                    </div>
                                    <div class="div-sale">
                                        <label class="label-sale-01">Email</label>
                                        <label class="label-sale-02">:</label>
                                        <label class="label-sale-02">{{ $sale->contact->email }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center mt-4">
                                <table class="table-auto mt-2 w-[780px]">
                                    <thead>
                                        <tr>
                                            <th class="th-table w-8" rowspan="2">No.</th>
                                            <th class="th-table w-20" rowspan="2">Kode</th>
                                            <th class="th-table" rowspan="2">Lokasi</th>
                                            <th class="th-table w-48" colspan="3">Deskripsi</th>
                                            <th class="th-table w-28">Harga</th>
                                        </tr>
                                        <tr>
                                            <th class="th-table w-10">Jenis</th>
                                            <th class="th-table w-10">BL/FL</th>
                                            <th class="th-table w-28">Size - V/H</th>
                                            <th class="th-table">{{ $sale->duration }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="td-table">1</td>
                                            <td class="td-table">{{ $sale->billboard->code }}</td>
                                            <td class="text-xs text-teal-700 border">{{ $sale->billboard->address }}
                                            </td>
                                            @if ($sale->billboard->billboard_category->name == 'Billboard')
                                                <td class="td-table w-10">BB</td>
                                            @elseif ($sale->billboard->billboard_category->name == 'Bando')
                                                <td class="td-table w-10">BD</td>
                                            @elseif ($sale->billboard->billboard_category->name == 'Baliho')
                                                <td class="td-table w-10">BLH</td>
                                            @elseif ($sale->billboard->billboard_category->name == 'Midiboard')
                                                <td class="td-table w-10">MB</td>
                                            @endif
                                            @if ($sale->billboard->lighting == 'Backlight')
                                                <td class="td-table w-10">BL</td>
                                            @elseif ($sale->billboard->lighting == 'Frontlight')
                                                <td class="td-table w-10">FL</td>
                                            @elseif ($sale->billboard->lighting == 'Nonlight')
                                                <td class="td-table w-10">NL</td>
                                            @endif
                                            @if ($sale->billboard->orientation == 'Vertikal')
                                                <td class="td-table w-28">{{ $sale->billboard->size->size }} - V</td>
                                            @elseif ($sale->billboard->orientation == 'Horizontal')
                                                <td class="td-table w-28">{{ $sale->billboard->size->size }} - H</td>
                                            @endif
                                            <td class="td-table-sale">{{ number_format($sale['price']) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="td-table-sale" colspan="6">DPP</td>
                                            <td class="td-table-sale">{{ number_format($sale['dpp']) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="td-table-sale" colspan="6">PPN 11% (A)</td>
                                            <td class="td-table-sale">
                                                {{ number_format($sale['dpp'] * (11 / 100)) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="td-table-sale" colspan="6">PPh 23 2% (B)</td>
                                            <td class="td-table-sale">
                                                {{ number_format($sale['dpp'] * (2 / 100)) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="td-table-sale" colspan="6">Grand Total ((Harga + A) - B)
                                            </td>
                                            <td class="td-table-sale">
                                                {{ number_format($sale['price'] + $sale['dpp'] * (11 / 100) - $sale['dpp'] * (2 / 100)) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="sale-note w-[780px]">
                                <div class="div-sale-notes w-[325px]">
                                    <div>
                                        <div class="flex">
                                            <label class="text-xs font-semibold underline text-teal-700">Termin
                                                Pembayaran</label>
                                        </div>
                                        <?php
                                        $objPayments = json_decode($sale['terms_of_payment']);
                                        $payments = $objPayments->payments;
                                        ?>
                                        @foreach ($payments as $terms)
                                            <div class="flex">
                                                <label class="label-number-notes">{{ $loop->iteration }}.</label>
                                                <label
                                                    class="flex text-xs text-teal-700 w-[270px]">{{ $terms->termValue }}
                                                    %
                                                    {{ $terms->termNote }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mt-2">
                                        <div>
                                            <label class="sale-note-title">Services</label>
                                        </div>
                                        <div>
                                            @if ($sale['free_instalation'])
                                                <label class="label-sale-notes">• Free pemasangan
                                                    {{ $sale['free_instalation'] }} x</label>
                                            @else
                                                <label class="label-sale-notes">• Tidak ada free
                                                    pemasangan</label>
                                            @endif
                                            @if ($sale['free_print'])
                                                <label class="label-sale-notes">• Free cetak
                                                    {{ $sale['free_print'] }} x</label>
                                            @else
                                                <label class="label-sale-notes">• Tidak ada free
                                                    cetak</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="div-sale-notes w-[435px] ml-5">
                                    <div>
                                        <div>
                                            <label class="sale-note-title">Keterangan
                                                Tambahan :</label>
                                            <label class="line-label"></label>
                                            <label class="line-label"></label>
                                            <label class="line-label"></label>
                                            <label class="line-label"></label>
                                            <label class="line-label"></label>
                                            <label class="line-label"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sale-note w-[780px]">
                                <table class="mt-2 w-[780px]">
                                    <thead>
                                        <tr>
                                            <th class="th-title-sign" colspan="4">Mengetahui :</th>
                                        </tr>
                                        <tr>
                                            <th class="th-sign">Penjualan dan Pemasaran</th>
                                            <th class="th-sign">Penagihan</th>
                                            <th class="th-sign">Keuangan</th>
                                            <th class="th-sign">Direktur</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="h-28">
                                            <td class="td-sign">
                                                Nur Cahyono</td>
                                            <td class="td-sign">
                                                Yudhi Pratama</td>
                                            <td class="td-sign">
                                                Ayu Putri Lestari</td>
                                            <td class="td-sign">
                                                Sandy Kamboy</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="body-bottom-sale mt-4">
                                <div class="sale-detail">
                                    @foreach ($billboard_photos as $photo)
                                        @if ($sale->company_id == $photo->company_id && $sale->billboard->code == $photo->billboard_code)
                                            <img class="img-location-sale" src="/storage/{{ $photo->photo }}"
                                                alt="">
                                        @endif
                                    @endforeach
                                </div>
                                <div class="qr-code-sale">
                                    {{ QrCode::size(100)->generate('http://vistamedia.co.id/') }}
                                </div>
                            </div>
                        </div>
                        <!-- Body end -->
                        <!-- Footer start -->
                        <div class="flex items-end justify-center">
                            <div>
                                <div class="flex w-full h-max justify-center mt-2">
                                    <img src="/img/line-bottom.png" alt="">
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <span class="text-xs font-semibold">PT. Vista Media</span>
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <span class="text-xs">Jl. Pulau Kawe No. 40 - Denpasar | Bali - Indonesia</span>
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <span class="text-xs">Ph. +62 361 230000 | Fax. +62 361 237800 </span>
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <span class="text-xs">e-mail : info@vistamedia.co.id | www.vistamedia.co.id</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer end -->
            </div>
            <div class="h-10"></div>
        </div>
    </div>
    </div>
    <!-- Show Quotatin end -->

    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>

    <script>
        const saveName = document.getElementById("saveNumber");
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
                    scale: 4,
                    letterRendering: true,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'px',
                    format: [950, 1380],
                    orientation: 'portrait',
                    putTotalPages: true
                }
            };
            // html2pdf(element, opt);
            html2pdf().set(opt).from(element).save();
        };
    </script>
    <!-- Script end -->
@endsection
