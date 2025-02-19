@extends('dashboard.layouts.main');

@section('container')
    @php
        $description = json_decode($products[0]->description);
        $salesData = [];
        $salesNote = [];
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

        $created_by = new stdClass();
        $created_by->id = auth()->user()->id;
        $created_by->name = auth()->user()->name;
        $created_by->position = auth()->user()->position;

        $objPrice = $price;
        if ($category == 'Service') {
            $objPpn = $objPrice->objServicePpn;
        } else {
            $objPpn = $objPrice->objPpn;
        }

        foreach ($products as $product) {
            $objSales = new stdClass();
            $objSales->company_id = $quotation->company_id;
            $objSales->media_category_id = $quotation->media_category_id;
            $objSales->quotation_id = $quotation->id;
            $objSales->location_id = $product->id;
            $objSales->dpp = 0;
            $objSales->ppn = $objPpn->value;
            $objSales->price = 0;
            $objSales->product = $product;
            $objSales->duration = '';
            $objSales->note = '';
            $objSales->start_at = null;
            $objSales->end_at = null;
            if ($product->type == 'extend' || $product->type == 'existing') {
                $objSales->main_sale_id = $product->sale_id;
            }
            $objSales->created_by = $created_by;

            array_push($salesData, $objSales);
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
        $romawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VII', 'IX', 'X', 'XI', 'XII'];
    @endphp
    <!-- Create Sales start -->
    <form action="/marketing/sales" method="post" enctype="multipart/form-data">
        @csrf
        <input id="approvalImages" class="hidden" name="document_approval[]" type="file"
            accept="image/png, image/jpg, image/jpeg"
            onchange="imagePreview(this, document.querySelectorAll('[id=labelApproval]'))" multiple>
        <input id="poImages" class="hidden" name="document_po[]" type="file" accept="image/png, image/jpg, image/jpeg"
            onchange="imagePreview(this, document.querySelectorAll('[id=labelPo]'))" multiple>
        <input id="agreementImages" class="hidden" name="document_agreement[]" type="file"
            accept="image/png, image/jpg, image/jpeg"
            onchange="imagePreview(this, document.querySelectorAll('[id=labelAgreement]'))" multiple>
        <input id="category" type="text" name="category" value="{{ $category }}" hidden>
        <input type="date" id="agreement_date" name="agreement_date" hidden>
        <input type="text" id="agreement_number" name="agreement_number" hidden>
        <input type="date" id="order_date" name="order_date" hidden>
        <input type="text" id="order_number" name="order_number" hidden>
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
                <div class="flex w-full justify-center">
                    <div class="flex w-[950px]">
                        <button class="flex justify-center items-center mx-1 btn-primary" title="Save"
                            onclick="return insertSalesData()">
                            <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                            </svg>
                            <span class="mx-1">Save</span>
                        </button>
                        <a class="flex justify-center items-center mx-1 btn-danger"
                            href="/marketing/sales/select-quotation/{{ $category }}/{{ $company->id }}">
                            <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="mx-1">Cancel</span>
                        </a>
                    </div>
                </div>
                <div class="flex justify-center w-full">
                    <div>
                        @foreach ($products as $product)
                            @php
                                $description = json_decode($product->description);
                                $totalInstall = 0;
                                $totalPrint = 0;
                                if ($product->category == 'Signage') {
                                    $wide =
                                        $product->width * $product->height * (int) $product->side * $description->qty;
                                } else {
                                    $wide = $product->width * $product->height * (int) $product->side;
                                }
                            @endphp
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
                                                        <label class="text-sm text-slate-400 ml-2">Penomoran
                                                            otomatis</label>
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
                                                            value="{{ json_encode($data_approvals) }}" hidden>
                                                        <label id="labelApproval"
                                                            class="label-sale-02 w-32">{{ count($data_approvals) }}
                                                            dokumen</label>
                                                        <button type="button"
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
                                                    <div hidden>
                                                        <label class="label-sale-01">Dok. PO/SPK</label>
                                                        <label class="label-sale-02">:</label>
                                                        <label id="labelPo"
                                                            class="label-sale-02 w-32 @error('document_po') is-invalid @enderror">{{ count($data_orders) }}
                                                            dokumen</label>
                                                        <button id="po" type="button"
                                                            class="flex justify-center items-center ml-2 px-1 w-20 h-5 bg-teal-500 rounded-md text-white hover:bg-teal-600 drop-shadow-md"
                                                            onclick="btnImages(this, document.getElementById('poImages'), document.querySelectorAll('[id=labelPo]'))">
                                                            <svg class="fill-current w-3"
                                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                                <path
                                                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 13h-5v5h-2v-5h-5v-2h5v-5h2v5h5v2z" />
                                                            </svg>
                                                            <span class="text-sm ml-1">Tambah</span>
                                                        </button>
                                                    </div>
                                                    @error('document_po.*')
                                                        <div class="invalid-feedback">
                                                            Ukuran file max 2048 kb, tipe file jpeg/jpg/png
                                                        </div>
                                                    @enderror
                                                    @if ($category != 'Service')
                                                        <div hidden>
                                                            <label class="label-sale-01">Dok. Agreement</label>
                                                            <label class="label-sale-02">:</label>
                                                            <label id="labelAgreement"
                                                                class="label-sale-02 w-32 @error('document_agreement') is-invalid @enderror">{{ count($data_agreements) }}
                                                                dokumen</label>
                                                            <button id="agreement" type="button"
                                                                class="flex justify-center items-center ml-2 px-1 w-20 h-5 bg-teal-500 rounded-md text-white hover:bg-teal-600 drop-shadow-md"
                                                                onclick="btnImages(this, document.getElementById('agreementImages'), document.querySelectorAll('[id=labelAgreement]'))">
                                                                <svg class="fill-current w-3"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 24 24">
                                                                    <path
                                                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 13h-5v5h-2v-5h-5v-2h5v-5h2v5h5v2z" />
                                                                </svg>
                                                                <span class="text-sm ml-1">Tambah</span>
                                                            </button>
                                                        </div>
                                                        @error('document_agreement.*')
                                                            <div class="invalid-feedback">
                                                                Ukuran file max 2048 kb, tipe file jpeg/jpg/png
                                                            </div>
                                                        @enderror
                                                        <div class="div-sale justify-center">
                                                            <label class="title-periode font-semibold mt-4">Periode
                                                                Kontrak</label>
                                                        </div>
                                                        <div
                                                            class="div-sale justify-center w-[350px] border rounded-lg p-1">
                                                            <div class="flex justify-center w-[160px]">
                                                                <div>
                                                                    <div class="flex justify-center">
                                                                        <label class="text-sm text-black">Awal Kontrak
                                                                            :</label>
                                                                    </div>
                                                                    <input id="start"
                                                                        name="start{{ $loop->iteration - 1 }}"
                                                                        class="flex border rounded-lg outline-none text-sm text-black mt-1"
                                                                        type="date" onchange="getStartAt(this)">
                                                                </div>
                                                            </div>
                                                            <div class="flex justify-center w-[160px]">
                                                                <div>
                                                                    <div class="flex justify-center">
                                                                        <label class="text-sm text-black">Akhir Kontrak
                                                                            :</label>
                                                                    </div>
                                                                    <input id="end"
                                                                        name="end{{ $loop->iteration - 1 }}"
                                                                        class="flex border rounded-lg outline-none text-sm text-black mt-1"
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
                                                        <label
                                                            class="label-sale-02">{{ date('d', strtotime($created_at)) }}
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
                                                        <textarea class="text-xs ml-1 w-[230px] outline-none border text-stone-900" rows="3" readonly>{{ $clients->address }}</textarea>
                                                    </div>
                                                    @if ($clients->type == 'Perusahaan')
                                                        <div class="div-sale">
                                                            <label class="label-sale-01">Kontak Person</label>
                                                            <label class="label-sale-02">:</label>
                                                            <label
                                                                class="label-sale-02">{{ $clients->contact_name }}</label>
                                                        </div>
                                                    @endif
                                                    @if ($clients->type == 'Perusahaan')
                                                        <div class="div-sale">
                                                            <label class="label-sale-01">No. Handphone</label>
                                                            <label class="label-sale-02">:</label>
                                                            <label
                                                                class="label-sale-02">{{ $clients->contact_phone }}</label>
                                                        </div>
                                                        <div class="div-sale">
                                                            <label class="label-sale-01">Email</label>
                                                            <label class="label-sale-02">:</label>
                                                            <label
                                                                class="label-sale-02">{{ $clients->contact_email }}</label>
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
                                                <textarea class="label-sale-notes border outline-none p-2" id="otherNote" rows="4"></textarea>
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
                                                        <tr class="h-6">
                                                            <th class="th-title-sign text-sm" colspan="4">Mengetahui :
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="td-sign">{{ auth()->user()->name }}</td>
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
                                    {{-- @if ($category != 'Service') --}}
                                    <div class="flex justify-center mt-2">
                                        <div class="sale-detail">
                                            <img class="img-location-sale"
                                                src="{{ asset('storage/' . $product->photo) }}">
                                        </div>
                                        <div class="qr-code-sale ml-4">

                                        </div>
                                    </div>
                                    {{-- @endif --}}
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
        </div>
        <input type="text" id="salesData" name="salesData" value="{{ json_encode($salesData) }}" hidden>
        <!-- Create Sales end -->
    </form>

    <!-- Create Sales preview start -->
    {{-- @include('sales.create-preview') --}}
    <!-- Create Sales preview end -->

    <!-- Modal Add / View Document start -->
    @include('dashboard.layouts.modal-add-document')
    @include('dashboard.layouts.modal-view-document')
    <!-- Modal Add / View Document end -->

    <!-- Javascript start -->
    <script src="/js/createsales.js"></script>
    <script src="/js/modaladddocument.js"></script>
    <script src="/js/modalviewdocument.js"></script>
    <!-- Javascript end -->
@endsection
