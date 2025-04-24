@extends('dashboard.layouts.main');

@section('container')
    <!-- Show Quotatin start -->
    <?php
    $salesNote = [];
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
            $product = json_decode($sales[0]->product);
            $description = json_decode($product->description);
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
    
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    ?>
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <!-- Title Show Quotatin start -->
            <div class="flex border-b">
                <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-primary mb-2" title="Create PDF"
                    type="button">
                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                    </svg>
                    <span class="mx-1">Save PDF</span>
                </button>
                <a class="flex justify-center items-center mx-1 btn-danger"
                    href="/marketing/sales/home/{{ $category }}/{{ $company->id }}">
                    <svg class="fill-white w-4 m-auto hover:fill-red-600" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                    </svg>
                    <span class="mx-1">Close</span>
                </a>
            </div>
            @if (session()->has('success'))
                <div class="mt-2 flex alert-success">
                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                    </svg>
                    <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                </div>
            @endif
            <!-- Title Show Quotatin end -->
            @foreach ($sales as $sale)
                @php
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
                <div id="pdfPreview">
                    <div class="flex justify-center w-full">
                        <div class="w-[950px] h-[1345px] bg-white mt-1">
                            <!-- Header start -->
                            @include('dashboard.layouts.letter-header')
                            <!-- Header end -->
                            <!-- Body start -->
                            <div class="h-[1125px]">
                                <div class="flex justify-center">
                                    <div class="w-[725px]">
                                        <div class="flex justify-center mt-5">
                                            <label class="sale-label-title">DATA PENJUALAN
                                                {{ strtoupper($category) }}</label>
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
                                                        <label class="title-periode font-semibold">Periode
                                                            Kontrak</label>
                                                    </div>
                                                    <div class="div-sale justify-center w-[350px] border rounded-lg p-1">
                                                        <div>
                                                            <div class="flex justify-center w-[160px]">
                                                                <label class="text-sm text-black">Awal Kontrak :</label>
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
                                                                <label class="text-sm text-black">Akhir Kontrak :</label>
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
                                                    <label class="label-sale-02 font-semibold">{{ $number }}</label>
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
                                            @include('sales.service-preview-table')
                                        @else
                                            @include('sales.preview-table')
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
                                            <label class="label-sale-notes">{{ $sale->note }}</label>
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
                                        {{ QrCode::size(100)->generate('http://vistamedia.co.id/marketing/sales/' . $sale->id) }}
                                    </div>
                                </div>
                                <!-- photo end -->
                            </div>
                            <!-- Body end -->
                            <!-- Footer start -->
                            @include('dashboard.layouts.letter-footer')
                            <!-- Footer end -->
                        </div>
                        @if ($category == 'Service')
                            <input id="saveName" type="text"
                                value="{{ Str::substr($sale->number, 0, 4) }}-PJ-Cetak-Pasang-{{ $clients->name }}"
                                hidden>
                        @else
                            <input id="saveName" type="text"
                                value="{{ Str::substr($sale->number, 0, 4) }}-PJ-{{ $category }}-{{ $clients->name }}"
                                hidden>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Show Quotatin end -->

    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>

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
            }
        };
    </script>
    <!-- Script end -->
@endsection
