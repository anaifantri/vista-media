@extends('dashboard.layouts.main');

@section('container')
    <?php
    $salesData = [];
    $salesNote = [];
    $documentImages = $data_approvals;
    if ($category == 'Service') {
        for ($i = 0; $i < count($notes->dataNotes); $i++) {
            array_push($salesNote, $notes->dataNotes[$i]);
        }
    } else {
        if ($category == 'Billboard') {
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
        } elseif ($category == 'Signage') {
            $description = json_decode($products[0]->description);
            if ($description->type == 'Videotron') {
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
        } else {
            for ($i = 0; $i < count($notes->dataNotes); $i++) {
                if ($i == 2) {
                    array_push($salesNote, $notes->dataNotes[$i]);
                }
            }
        }
    }
    
    $created_by = new stdClass();
    $created_by->id = auth()->user()->id;
    $created_by->name = auth()->user()->name;
    $created_by->position = auth()->user()->position;
    
    foreach ($products as $product) {
        $objSales = new stdClass();
        $objSales->company_id = $quotation->company_id;
        $objSales->media_category_id = $quotation->media_category_id;
        $objSales->quotation_id = $quotation->id;
        $objSales->location_id = $product->id;
        $objSales->product_code = $product->code;
        $objSales->dpp = null;
        $objSales->ppn = null;
        $objSales->pph = null;
        $objSales->price = 0;
        $objSales->duration = '';
        $objSales->note = '';
        $objSales->start_at = null;
        $objSales->end_at = null;
        $objSales->created_by = $created_by;
    
        array_push($salesData, $objSales);
    }
    
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $romawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VII', 'IX', 'X', 'XI', 'XII'];
    ?>
    <!-- Create Sales start -->
    <div class="p-10 z-0 bg-black">
        <div class="flex w-full justify-center">
            <div class="flex w-[950px]">
                <button id="btnPreview" class="flex justify-center items-center mx-1 btn-primary" title="Preview" type="button"
                    onclick="btnPreviewAction()">
                    <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24">
                        <path
                            d="M15 12c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-.199.02-.393.057-.581 1.474.541 2.927-.882 2.405-2.371.174-.03.354-.048.538-.048 1.657 0 3 1.344 3 3zm-2.985-7c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 12c-2.761 0-5-2.238-5-5 0-2.761 2.239-5 5-5 2.762 0 5 2.239 5 5 0 2.762-2.238 5-5 5z" />
                    </svg>
                    <span class="ml-2 text-white">Preview</span>
                </button>
                <a class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-danger"
                    href="/sales/select-quotation/{{ $category }}">
                    <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                    </svg>
                    <span class="ml-1 xl:mx-2 text-sm">Cancel</span>
                </a>
            </div>
        </div>
        <div class="flex justify-center w-full">
            <div>
                @foreach ($products as $product)
                    <div class="w-[950px] h-[1345px] bg-white mt-1">
                        <!-- Header start -->
                        @include('dashboard.layouts.letter-header')
                        <!-- Header end -->
                        <!-- Body start -->
                        <div class="h-[1125px]">
                            <div class="flex justify-center">
                                <div class="w-[750px]">
                                    @if ($category == 'Service')
                                        <div class="flex justify-center mt-5">
                                            <label class="sale-label-title">DATA PENJUALAN CETAK/PASANG</label>
                                        </div>
                                    @else
                                        <div class="flex justify-center mt-5">
                                            <label class="sale-label-title">DATA PENJUALAN
                                                {{ strtoupper($category) }}</label>
                                        </div>
                                    @endif
                                    <div class="flex justify-center mt-5">
                                        <div class="sale-detail">
                                            <div class="div-sale">
                                                <label class="label-sale-01">Nomor Penjualan</label>
                                                <label class="label-sale-02">:</label>
                                                <label class="text-sm text-slate-300 ml-2">Penomoran otomatis</label>
                                            </div>
                                            <div class="div-sale">
                                                <label class="label-sale-01">Tgl. Penjualan</label>
                                                <label class="label-sale-02">:</label>
                                                <label class="label-sale-02">
                                                    {{ date('d') }}
                                                    {{ $bulan[(int) date('m')] }}
                                                    {{ date('Y') }}
                                                </label>
                                            </div>
                                            <div class="div-sale">
                                                <label class="label-sale-01">Dok. Approval</label>
                                                <label class="label-sale-02">:</label>
                                                <input id="approvalDocuments" type="text"
                                                    value="{{ json_encode($documentImages) }}" hidden>
                                                <label id="labelApproval"
                                                    class="label-sale-02 w-32">{{ count($documentImages) }}
                                                    dokumen</label>
                                                <button
                                                    class="flex items-center ml-2 px-1 w-20 h-5 bg-teal-500 rounded-md text-white hover:bg-teal-600 drop-shadow-md"
                                                    onclick="btnShowModalView(document.getElementById('approvalDocuments'))">
                                                    <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm.002 3c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c1.38 0 2.5 1.12 2.5 2.5s-1.12 2.5-2.5 2.5-2.5-1.12-2.5-2.5 1.12-2.5 2.5-2.5z"
                                                            fill-rule="nonzero" />
                                                    </svg>
                                                    <span class="text-sm ml-1">Lihat</span>
                                                </button>
                                            </div>
                                            <div class="div-sale">
                                                <label class="label-sale-01">Dok. PO/SPK</label>
                                                <label class="label-sale-02">:</label>
                                                <label id="labelPo" class="label-sale-02 w-32"> 0 dokumen</label>
                                                <button id="po"
                                                    class="flex justify-center items-center ml-2 px-1 w-20 h-5 bg-teal-500 rounded-md text-white hover:bg-teal-600 drop-shadow-md"
                                                    onclick="btnImages(this, document.getElementById('poImages'), document.querySelectorAll('[id=labelPo]'))">
                                                    <svg class="fill-current w-3" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 13h-5v5h-2v-5h-5v-2h5v-5h2v5h5v2z" />
                                                    </svg>
                                                    <span class="text-sm ml-1">Tambah</span>
                                                </button>
                                            </div>
                                            @if ($category != 'Service')
                                                <div class="div-sale">
                                                    <label class="label-sale-01">Dok. Agreement</label>
                                                    <label class="label-sale-02">:</label>
                                                    <label id="labelAgreement" class="label-sale-02 w-32"> 0 dokumen</label>
                                                    <button id="agreement"
                                                        class="flex justify-center items-center ml-2 px-1 w-20 h-5 bg-teal-500 rounded-md text-white hover:bg-teal-600 drop-shadow-md"
                                                        onclick="btnImages(this, document.getElementById('agreementImages'), document.querySelectorAll('[id=labelAgreement]'))">
                                                        <svg class="fill-current w-3" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 24 24">
                                                            <path
                                                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 13h-5v5h-2v-5h-5v-2h5v-5h2v5h5v2z" />
                                                        </svg>
                                                        <span class="text-sm ml-1">Tambah</span>
                                                    </button>
                                                </div>
                                                <div class="div-sale justify-center">
                                                    <label class="title-periode font-semibold">Periode Kontrak</label>
                                                </div>
                                                <div class="div-sale justify-center w-[350px] border rounded-lg p-1">
                                                    <div class="flex justify-center w-[160px]">
                                                        <div>
                                                            <div class="flex justify-center">
                                                                <label class="text-sm text-teal-700">Awal Kontrak :</label>
                                                            </div>
                                                            <input id="start" name="start{{ $loop->iteration - 1 }}"
                                                                class="flex border rounded-lg outline-none text-sm text-teal-700 mt-1"
                                                                type="date" onchange="getStartAt(this)">
                                                        </div>
                                                    </div>
                                                    <div class="flex justify-center w-[160px]">
                                                        <div>
                                                            <div class="flex justify-center">
                                                                <label class="text-sm text-teal-700">Akhir Kontrak :</label>
                                                            </div>
                                                            <input id="end" name="end{{ $loop->iteration - 1 }}"
                                                                class="flex border rounded-lg outline-none text-sm text-teal-700 mt-1"
                                                                type="date" onchange="getEndAt(this)">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="sale-detail ml-2">
                                            <div class="div-sale">
                                                <label class="label-sale-01">No. Penawaran</label>
                                                <label class="label-sale-02">:</label>
                                                <label class="label-sale-02">{{ $number }}</label>
                                            </div>
                                            <div class="div-sale">
                                                <label class="label-sale-01">Tgl. Penawaran</label>
                                                <label class="label-sale-02">:</label>
                                                <label class="label-sale-02">{{ date('d', strtotime($created_at)) }}
                                                    {{ $bulan[(int) date('m', strtotime($created_at))] }}
                                                    {{ date('Y', strtotime($created_at)) }}</label>
                                            </div>
                                            <div class="div-sale">
                                                <label class="label-sale-01">Nama Klien</label>
                                                <label class="label-sale-02">:</label>
                                                <label class="label-sale-02">{{ $clients->name }}</label>
                                            </div>
                                            @if ($clients->type == 'Perusahaan')
                                                <div class="div-sale">
                                                    <label class="label-sale-01">Perusahaan</label>
                                                    <label class="label-sale-02">:</label>
                                                    <label class="label-sale-02">{{ $clients->company }}</label>
                                                </div>
                                            @endif
                                            <div class="div-sale">
                                                <label class="label-sale-01">Alamat</label>
                                                <label class="label-sale-02">:</label>
                                                <textarea class="ml-1 w-[230px] outline-none border text-teal-700 text-sm" rows="2" readonly>{{ $clients->address }}</textarea>
                                            </div>
                                            @if ($clients->type == 'Perusahaan')
                                                <div class="div-sale">
                                                    <label class="label-sale-01">Kontak Person</label>
                                                    <label class="label-sale-02">:</label>
                                                    <label class="label-sale-02">{{ $clients->contact_name }}</label>
                                                </div>
                                            @endif
                                            @if ($clients->type == 'Perusahaan')
                                                <div class="div-sale">
                                                    <label class="label-sale-01">No. Handphone</label>
                                                    <label class="label-sale-02">:</label>
                                                    <label class="label-sale-02">{{ $clients->contact_phone }}</label>
                                                </div>
                                                <div class="div-sale">
                                                    <label class="label-sale-01">Email</label>
                                                    <label class="label-sale-02">:</label>
                                                    <label class="label-sale-02">{{ $clients->contact_email }}</label>
                                                </div>
                                            @elseif ($clients->type == 'Perorangan')
                                                <div class="div-sale">
                                                    <label class="label-sale-01">No. Handphone</label>
                                                    <label class="label-sale-02">:</label>
                                                    <label class="label-sale-02">{{ $clients->phone }}</label>
                                                </div>
                                                <div class="div-sale">
                                                    <label class="label-sale-01">Email</label>
                                                    <label class="label-sale-02">:</label>
                                                    <label class="label-sale-02">{{ $clients->email }}</label>
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
                                        @include('sales.service-table')
                                    @else
                                        @include('sales.media-table')
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
                                            @foreach ($salesNote as $note)
                                                <label class="label-sale-notes flex">{{ $note }}</label>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="div-sale-notes w-[365px] p-2 ml-5">
                                    <div>
                                        <label class="sale-note-title">Keterangan Tambahan :</label>
                                        <textarea class="label-sale-notes border outline-none p-2" id="otherNote" rows="6"></textarea>
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
                            @if ($category != 'Service')
                                <div class="flex justify-center mt-2">
                                    <div class="sale-detail">
                                        <img class="img-location-sale"
                                            src="{{ asset('storage/' . $product->location_photo) }}">
                                    </div>
                                    <div class="qr-code-sale ml-4">

                                    </div>
                                </div>
                            @endif
                            <!-- photo end -->
                        </div>
                        <!-- Body end -->
                        <!-- Footer start -->
                        @include('dashboard.layouts.letter-footer')
                        <!-- Footer end -->
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Create Sales end -->

    <!-- Create Sales preview start -->
    @include('sales.create-preview')
    <!-- Create Sales preview end -->

    <!-- Modal Add / View Document start -->
    @include('dashboard.layouts.modal-add-document')
    @include('dashboard.layouts.modal-view-document')
    <!-- Modal Add / View Document end -->

    <!-- Javascript start -->
    <script src="/js/createsalesdata.js"></script>
    <script src="/js/modaladddocument.js"></script>
    <script src="/js/modalviewdocument.js"></script>
    <!-- Javascript end -->
@endsection
