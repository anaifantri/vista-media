@extends('dashboard.layouts.main');

@section('container')
    @php
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

        $invoice_content = json_decode($billing->invoice_content);
        $receipt_content = json_decode($billing->receipt_content);
        $client = json_decode($billing->client);
        $invoice_descriptions = $invoice_content->description;
        if (fmod(count($invoice_descriptions), 4) == 0) {
            $pageQty = count($invoice_descriptions) / 4;
        } else {
            $pageQty = (count($invoice_descriptions) - fmod(count($invoice_descriptions), 4)) / 4 + 1;
        }

        if (isset($invoice_content->merge)) {
            if ($invoice_content->merge != 'normal') {
                $subTotal = $invoice_content->description[0]->nominal + $invoice_content->description[1]->nominal;
                if ($invoice_content->merge == 'size') {
                    if ($product->orientation == 'Horizontal') {
                        if ($product->width < $product->height) {
                            $size =
                                $product->width .
                                'm x ' .
                                $product->height * 2 .
                                ' x ' .
                                $product->side .
                                ' - ' .
                                $product->orientation;
                        } else {
                            $size =
                                $product->height .
                                'm x ' .
                                $product->width * 2 .
                                ' x ' .
                                $product->side .
                                ' - ' .
                                $product->orientation;
                        }
                    } else {
                        if ($product->width < $product->height) {
                            $size =
                                $product->width * 2 .
                                'm x ' .
                                $product->height .
                                ' x ' .
                                $product->side .
                                ' - ' .
                                $product->orientation;
                        } else {
                            $size =
                                $product->height * 2 .
                                'm x ' .
                                $product->width .
                                ' x ' .
                                $product->side .
                                ' - ' .
                                $product->orientation;
                        }
                    }
                } else {
                    $size = $product->size . ' x 2 sisi - ' . $product->orientation;
                }
            } else {
                if (isset($invoice_content->manual_detail)) {
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
            }
        } else {
            $subTotal = 0;
        }
    @endphp
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
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
                <a class="flex justify-center items-center mx-1 btn-danger" href="/billings/index/{{ $company->id }}">
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
            <div class="flex justify-center w-full mt-2">
                <div id="pdfPreview" class="w-[950px]mt-2">
                    <!-- Surat Invoice start -->
                    @for ($i = 0; $i < $pageQty; $i++)
                        <div class="w-[950px] h-[1345px] mt-1 bg-white p-4">
                            <!-- Header start -->
                            @include('dashboard.layouts.letter-header')
                            <!-- Header end -->
                            <!-- Body start -->
                            @if ($category == 'Media')
                                @if (isset($invoice_content->manual_detail))
                                    @include('billings.manual-invoice-preview')
                                @else
                                    @include('billings.auto-invoice-preview')
                                @endif
                            @elseif($category == 'Service')
                                @include('billings.invoice-service-body-preview')
                            @endif
                            <!-- Body end -->
                            @if ($pageQty > 1)
                                <div class="flex w-[850px] justify-end text-sm">
                                    Halaman {{ $i + 1 }} dari {{ $pageQty }}
                                </div>
                            @endif
                            <!-- Footer start -->
                            @include('dashboard.layouts.letter-footer')
                            <!-- Footer end -->
                        </div>
                    @endfor
                    <!-- Surat Invoice end -->

                    <!-- Kwitansi start -->
                    <div class="w-[950px] h-[1345px] mt-1 bg-white p-4">
                        <!-- Header start -->
                        @include('billings.receipt-header-preview')
                        <!-- Header end -->
                        <!-- Body start -->
                        @if ($category == 'Media')
                            @include('billings.receipt-media-body-preview')
                        @elseif ($category == 'Service')
                            @include('billings.receipt-service-body-preview')
                        @endif
                        <!-- Body end -->
                        <!-- Sign start -->
                        @include('billings.receipt-service-sign-preview')
                        <!-- Sign end -->
                        {{-- <div class="flex w-full justify-center items-center pt-2">
                            <div class="border-t h-2 border-slate-500 border-dashed w-full">
                            </div>
                        </div> --}}
                        <!-- Header start -->
                        {{-- @include('billings.receipt-header-preview') --}}
                        <!-- Header end -->
                        <!-- Body start -->
                        {{-- @if ($category == 'Media')
                            @include('billings.receipt-media-body-preview')
                        @elseif ($category == 'Service')
                            @include('billings.receipt-service-body-preview')
                        @endif --}}
                        <!-- Body end -->
                        <!-- Sign start -->
                        {{-- @include('billings.receipt-service-sign-preview') --}}
                        <!-- Sign end -->
                    </div>
                    <!-- Kwitansi end -->
                </div>
            </div>
        </div>
        @if ($category == 'Media')
            <input id="saveName" type="text"
                value="{{ substr($billing->invoice_number, 0, 3) }}-INV-Media-{{ $client->company }}" hidden>
        @elseif($category == 'Service')
            <input id="saveName" type="text"
                value="{{ substr($billing->invoice_number, 0, 3) }}-INV-Revisual-{{ $client->company }}" hidden>
        @endif
    </div>

    <!-- Script start-->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>

    <script>
        const saveName = document.getElementById("saveName");
        document.getElementById("btnCreatePdf").onclick = function() {
            var element = document.getElementById('pdfPreview');
            var opt = {
                margin: 0,
                filename: saveName.value + '.pdf',
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
                    format: [950, 1365],
                    orientation: 'portrait',
                    putTotalPages: true
                }
            };
            // html2pdf(element, opt);
            html2pdf().set(opt).from(element).save();
        };
    </script>
    <!-- Script end-->
@endsection
