@extends('dashboard.layouts.main');

@section('container')
    @php
        $angka = [
            '',
            'Satu',
            'Dua',
            'Tiga',
            'Empat',
            'Lima',
            'Enam',
            'Tujuh',
            'Delapan',
            'Sembilan',
            'Sepuluh',
            'Sebelas',
        ];
        function terbilang($nilai)
        {
            $huruf = [
                '',
                'Satu',
                'Dua',
                'Tiga',
                'Empat',
                'Lima',
                'Enam',
                'Tujuh',
                'Delapan',
                'Sembilan',
                'Sepuluh',
                'Sebelas',
            ];
            if ($nilai == 0) {
                return '';
            } elseif (($nilai < 12) & ($nilai != 0)) {
                return '' . $huruf[$nilai];
            } elseif ($nilai < 20) {
                return Terbilang($nilai - 10) . ' Belas ';
            } elseif ($nilai < 100) {
                return Terbilang($nilai / 10) . ' Puluh ' . Terbilang($nilai % 10);
            } elseif ($nilai < 200) {
                return ' Seratus ' . Terbilang($nilai - 100);
            } elseif ($nilai < 1000) {
                return Terbilang($nilai / 100) . ' Ratus ' . Terbilang($nilai % 100);
            } elseif ($nilai < 2000) {
                return ' Seribu ' . Terbilang($nilai - 1000);
            } elseif ($nilai < 1000000) {
                return Terbilang($nilai / 1000) . ' Ribu ' . Terbilang($nilai % 1000);
            } elseif ($nilai < 1000000000) {
                return Terbilang($nilai / 1000000) . ' Juta ' . Terbilang($nilai % 1000000);
            } elseif ($nilai < 1000000000000) {
                return Terbilang($nilai / 1000000000) . ' Milyar ' . Terbilang($nilai % 1000000000);
            } elseif ($nilai < 100000000000000) {
                return Terbilang($nilai / 1000000000000) . ' Trilyun ' . Terbilang($nilai % 1000000000000);
            } elseif ($nilai <= 100000000000000) {
                return 'Maaf Tidak Dapat di Prose Karena Jumlah nilai Terlalu Besar';
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
        $month = [
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

        if ($merge != 'normal') {
            $subTotal = $invoice_content->description[0]->nominal + $invoice_content->description[1]->nominal;
            if ($merge == 'size') {
                $width = 2 * $product->width;
                if ($width < $product->height) {
                    $size = $width . 'm x ' . $product->height . ' x ' . $product->side . ' - ' . $product->orientation;
                } else {
                    $size = $product->height . 'm x ' . $width . ' x ' . $product->side . ' - ' . $product->orientation;
                }
                $receipt_content->size = $size;
                $receipt_content->qty = '1 (satu) Unit';
            } else {
                $size = $product->size . ' x 2 sisi - ' . $product->orientation;
                $receipt_content->size = $size;
                $receipt_content->qty = '1 (satu) Unit';
            }
        }

        $created_by = new stdClass();
        $created_by->id = auth()->user()->id;
        $created_by->name = auth()->user()->name;
        $created_by->position = auth()->user()->position;

        $invoice_descriptions = $invoice_content->description;

        if ($model == 'auto') {
            if (fmod(count($invoice_descriptions), 4) == 0) {
                $pageQty = count($invoice_descriptions) / 4;
            } else {
                $pageQty = (count($invoice_descriptions) - fmod(count($invoice_descriptions), 4)) / 4 + 1;
            }
        } else {
            $dpp = 0;
            $subPpn = 0;
            $ppnCheck = false;
            $manual_details = $invoice_content->manual_detail;
            if (fmod(count($manual_details), 4) == 0) {
                $pageQty = count($manual_details) / 4;
            } else {
                $pageQty = (count($manual_details) - fmod(count($manual_details), 4)) / 4 + 1;
            }
        }
        $subTotal = 0;
    @endphp

    <form action="/accounting/billings" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="company_id" value="{{ $company->id }}" hidden>
        <input type="text" name="sale_id" value="{{ json_encode($sale_id) }}" hidden>
        <input type="text" name="sale_year" value="{{ $sale_year }}" hidden>
        <input type="text" name="sale_number" value="{{ $sale_number }}" hidden>
        <input type="text" name="category" value="Media" hidden>
        <input type="text" id="invoice" name="invoice_content" value="{{ json_encode($invoice_content) }}" hidden>
        <input type="text" name="created_by" value="{{ json_encode($created_by) }}" hidden>
        <input type="text" name="updated_by" value="{{ json_encode($created_by) }}" hidden>

        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
                <div class="flex items-center w-[1200px] border-b px-2">
                    <!-- Title start -->
                    <h1 class="index-h1 w-[1200px]">Preview Invoice & Kwitansi</h1>
                    <!-- Title end -->
                    <div class="flex w-[150px] justify-end">
                        <button class="flex justify-center items-center mx-1 btn-primary" title="Back" type="button"
                            onclick="btnBackAction()">
                            <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                            </svg>
                            <span class="mx-1 text-white">Back</span>
                        </button>
                        <button class="flex justify-center items-center mx-1 btn-success" title="Save">
                            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                            </svg>
                            <span class="mx-1 text-white">Save</span>
                        </button>
                    </div>
                    <div>
                        <a href="/billings/index/{{ $company->id }}"
                            class="flex justify-center items-center mx-1 btn-danger" title="Cancel">
                            <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="mx-1 text-white">Cancel</span>
                        </a>
                    </div>
                </div>

                <!-- Surat Invoice start -->
                <div class="flex justify-center w-full mt-2">
                    {{-- @if (count($invoice_descriptions) >= 4) --}}
                    <div>
                        @for ($i = 0; $i < $pageQty; $i++)
                            <div class="w-[950px] h-[1345px] mt-1 bg-white p-4">
                                <!-- Header start -->
                                @include('dashboard.layouts.letter-header')
                                <!-- Header end -->
                                <!-- Body start -->
                                @if ($model == 'auto')
                                    @include('billings.auto-invoice-body')
                                @else
                                    @include('billings.manual-invoice-body')
                                @endif
                                @if ($pageQty > 1)
                                    <div class="flex w-[850px] justify-end text-sm">
                                        Halaman {{ $i + 1 }} dari {{ $pageQty }}
                                    </div>
                                @endif
                                <!-- Body end -->
                                <!-- Footer start -->
                                @include('dashboard.layouts.letter-footer')
                                <!-- Footer end -->
                            </div>
                        @endfor
                    </div>
                </div>
                <!-- Surat Invoice end -->

                <!-- Kwitansi start -->
                <div class="flex justify-center w-full mt-2">
                    <div class="w-[950px] h-[1345px] mt-1 bg-white p-4">
                        <!-- Header start -->
                        @include('billings.receipt-header')
                        <!-- Header end -->
                        <!-- Body start -->
                        @include('billings.receipt-media-body')
                        <!-- Body end -->
                        <!-- Sign start -->
                        @include('billings.receipt-media-sign')
                        <!-- Sign end -->
                        <div class="flex w-full justify-center items-center pt-2">
                            <div class="border-t h-2 border-slate-500 border-dashed w-full">
                            </div>
                        </div>
                        <!-- Header start -->
                        {{-- @include('billings.receipt-header') --}}
                        <!-- Header end -->
                        <!-- Body start -->
                        {{-- @include('billings.receipt-media-body') --}}
                        <!-- Body end -->
                        <!-- Sign start -->
                        {{-- @include('billings.receipt-media-sign') --}}
                        <!-- Sign end -->
                    </div>
                </div>
                <!-- Kwitansi end -->
            </div>
        </div>
    </form>
    <form class="m-1" id="formSelectDocuments" action="/billings/select-documents" method="post">
        @csrf
        <input type="text" name="model" value="{{ $model }}" hidden>
        <input type="text" name="receipt_content" value="{{ json_encode($receipt_content) }}" hidden>
        <input type="text" name="invoice_content" value="{{ json_encode($invoice_content) }}" hidden>
        <input type="text" name="client" value="{{ json_encode($client) }}" hidden>
        <input type="text" name="sale_id" value="{{ json_encode($sale_id) }}" hidden>
        <input type="text" name="sale_year" value="{{ $sale_year }}" hidden>
        <input type="text" name="sale_number" value="{{ $sale_number }}" hidden>
    </form>

    <form id="formCreateBilling" action="create-media-billing" method="POST">
        @csrf
        <input type="text" name="model" value="{{ $model }}" hidden>
        <input type="text" id="inputReceipt" name="receipt_content" value="{{ json_encode($receipt_content) }}"
            hidden>
        <input type="text" id="inputInvoice" name="invoice_content" value="{{ json_encode($invoice_content) }}"
            hidden>
        <input type="text" name="client" value="{{ json_encode($client) }}" hidden>
        <input type="text" name="sale_id" value="{{ json_encode($sale_id) }}" hidden>
        <input type="text" name="sale_year" value="{{ $sale_year }}" hidden>
        <input type="text" name="sale_number" value="{{ $sale_number }}" hidden>
        <input type="text" id="merge" name="merge" value="normal" hidden>
    </form>


    <!-- Script Preview Image start-->
    <script src="/js/createbillings.js"></script>
    <script>
        const formSelectDocuments = document.getElementById("formSelectDocuments");
        btnBackAction = () => {
            formSelectDocuments.submit();
        }
    </script>
    <!-- Script Preview Image end-->
@endsection
