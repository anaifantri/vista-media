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
        if (isset($client->npwp)) {
            $npwp = $client->npwp;
        } else {
            $npwp = '';
        }
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
        $indexTitle = 0;
    @endphp
    <form id="formCreate" action="/accounting/billings/{{ $billing->id }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <input type="text" id="inputClient" name="client" value="{{ json_encode($client) }}" hidden>
        <input type="text" id="inputInvoiceContent" name="invoice_content" value="{{ json_encode($invoice_content) }}"
            hidden>
        <input type="text" id="inputReceiptContent" name="receipt_content" value="{{ json_encode($receipt_content) }}"
            hidden>
        <input type="text" id="inputNominalInvoice" name="nominal" value="{{ $billing->nominal }}" hidden>
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
                <div class="flex border-b py-1 justify-end">
                    <button class="flex items-center justify-center btn-primary mx-1" type="submit">
                        <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                        </svg>
                        <span class="mx-2"> Save </span>
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
                                        @include('billings.manual-invoice-edit')
                                    @else
                                        @include('billings.auto-invoice-edit')
                                    @endif
                                @elseif($category == 'Service')
                                    @include('billings.invoice-service-edit')
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
                                @include('billings.receipt-media-body-edit')
                            @elseif ($category == 'Service')
                                @include('billings.receipt-service-edit')
                            @endif
                            <!-- Body end -->
                            <!-- Sign start -->
                            @include('billings.receipt-sign-edit')
                            <!-- Sign end -->
                        </div>
                        <!-- Kwitansi end -->
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Script start-->

    <script>
        const inputClient = document.getElementById("inputClient");
        const inputInvoiceContent = document.getElementById("inputInvoiceContent");
        const inputReceiptContent = document.getElementById("inputReceiptContent");
        const receiptClient = document.getElementById("receiptClient");
        const receiptTitle = document.getElementById("receiptTitle");
        const labelReceiptNominal = document.getElementById("labelReceiptNominal");
        const labelTerbilang = document.getElementById("labelTerbilang");
        const subTotal = document.getElementById("subTotal");
        const inputNominalInvoice = document.getElementById("inputNominalInvoice");
        const inputDpp = document.getElementById("inputDpp");
        const inputPpn = document.getElementById("inputPpn");
        // const labelPpn = document.getElementById("labelPpn");
        const labelGrandTotal = document.getElementById("labelGrandTotal");
        const labelNominal = document.querySelectorAll("[id=labelNominal]");
        var client = @json($client);
        var invoiceContent = @json($invoice_content);
        var receiptContent = @json($receipt_content);


        changeClient = (sel) => {
            if (sel.name == "client_contact") {
                client.contact_name = sel.value;
            } else if (sel.name == "client_company") {
                client.company = sel.value;
                receiptClient.innerText = sel.value;
            } else if (sel.name == "client_address") {
                client.address = sel.value;
            } else if (sel.name == "contact_phone") {
                client.contact_phone = sel.value;
            } else if (sel.name == "contact_email") {
                client.contact_email = sel.value;
            } else if (sel.name == "npwp") {
                client.npwp = sel.value;
            }

            inputClient.value = JSON.stringify(client);
        }

        changeInvoiceTitle = (sel) => {
            var getTitle = sel.title.split('*');
            var indexTitle = getTitle[1];

            if (invoiceContent.manual_detail) {
                invoiceContent.manual_detail[indexTitle].title = sel.value;
            } else {
                invoiceContent.description[indexTitle].title = sel.value;
            }

            receiptTitle.value = sel.value;
            receiptContent.title = sel.value;

            inputInvoiceContent.value = JSON.stringify(invoiceContent);
            inputReceiptContent.value = JSON.stringify(receiptContent);
        }

        changeReceiptTitle = (sel) => {
            receiptContent.title = sel.value;
            inputReceiptContent.value = JSON.stringify(receiptContent);
        }

        changeNominal = (sel) => {
            var getTitle = sel.title.split('*');
            var indexTitle = getTitle[1];
            var nominal = Number(sel.value);
            var getSubTotal = countNominal();
            var getDpp = getSubTotal / 12 * 11;
            var getPpn = Math.round(getDpp * 11 / 100);
            var getGrandTotal = getSubTotal + getPpn;
            var getTerbilang = terbilang(getGrandTotal);

            labelNominal[indexTitle].innerText = nominal.toLocaleString();
            subTotal.innerText = getSubTotal.toLocaleString();
            inputNominalInvoice.value = getSubTotal;
            inputDpp.value = Math.round(getDpp);
            inputPpn.value = getPpn;
            // labelPpn.innerText = getPpn.toLocaleString();
            labelGrandTotal.innerText = getGrandTotal.toLocaleString();
            labelReceiptNominal.innerText = getGrandTotal.toLocaleString();
            if (getGrandTotal == 0) {
                labelTerbilang.innerText = '#  #';
                receiptContent.terbilang = '#  #';
            } else {
                labelTerbilang.innerText = '# ' + getTerbilang + ' rupiah #';
                receiptContent.terbilang = '# ' + getTerbilang + ' rupiah #';
            }

            if (invoiceContent.manual_detail) {
                invoiceContent.manual_detail[indexTitle].nominal = sel.value;
            } else {
                invoiceContent.description[indexTitle].nominal = sel.value;
            }

            receiptContent.nominal = getGrandTotal;
            inputInvoiceContent.value = JSON.stringify(invoiceContent);
            inputReceiptContent.value = JSON.stringify(receiptContent);
        }

        countNominal = () => {
            const inputNominal = document.querySelectorAll("[id=inputNominal]");
            var getSubTotal = 0;

            for (let i = 0; i < inputNominal.length; i++) {
                getSubTotal = getSubTotal + Number(inputNominal[i].value);
            }
            return getSubTotal;
        }

        function terbilang(nilai) {
            // deklarasi variabel nilai sebagai angka matemarika
            // Objek Math bertujuan agar kita bisa melakukan tugas matemarika dengan javascript
            nilai = Math.floor(Math.abs(nilai));

            // deklarasi nama angka dalam bahasa indonesia
            var huruf = [
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

            // menyimpan nilai default untuk pembagian
            var bagi = 0;
            // deklarasi variabel penyimpanan untuk menyimpan proses rumus terbilang
            var penyimpanan = '';

            // rumus terbilang
            if (nilai < 12) {
                penyimpanan = ' ' + huruf[nilai];
            } else if (nilai < 20) {
                penyimpanan = terbilang(Math.floor(nilai - 10)) + ' Belas';
            } else if (nilai < 100) {
                bagi = Math.floor(nilai / 10);
                penyimpanan = terbilang(bagi) + ' Puluh' + terbilang(nilai % 10);
            } else if (nilai < 200) {
                penyimpanan = ' Seratus' + terbilang(nilai - 100);
            } else if (nilai < 1000) {
                bagi = Math.floor(nilai / 100);
                penyimpanan = terbilang(bagi) + ' Ratus' + terbilang(nilai % 100);
            } else if (nilai < 2000) {
                penyimpanan = ' Seribu' + terbilang(nilai - 1000);
            } else if (nilai < 1000000) {
                bagi = Math.floor(nilai / 1000);
                penyimpanan = terbilang(bagi) + ' Ribu' + terbilang(nilai % 1000);
            } else if (nilai < 1000000000) {
                bagi = Math.floor(nilai / 1000000);
                penyimpanan = terbilang(bagi) + ' Juta' + terbilang(nilai % 1000000);
            } else if (nilai < 1000000000000) {
                bagi = Math.floor(nilai / 1000000000);
                penyimpanan = terbilang(bagi) + ' Miliar' + terbilang(nilai % 1000000000);
            } else if (nilai < 1000000000000000) {
                bagi = Math.floor(nilai / 1000000000000);
                penyimpanan = terbilang(nilai / 1000000000000) + ' Triliun' + terbilang(nilai % 1000000000000);
            }

            // mengambalikan nilai yang ada dalam variabel penyimpanan
            return penyimpanan;
        }

        inputDppChange = (sel) => {
            var getSubTotal = countNominal();
            var getDpp = sel.value;
            var getPpn = Math.round(getDpp * 11 / 100);
            var getGrandTotal = getSubTotal + getPpn;
            var getTerbilang = terbilang(getGrandTotal);

            inputNominalInvoice.value = getSubTotal;
            inputPpn.value = getPpn;
            // labelPpn.innerText = getPpn.toLocaleString();
            labelGrandTotal.innerText = getGrandTotal.toLocaleString();
            labelReceiptNominal.innerText = getGrandTotal.toLocaleString();
            if (getGrandTotal == 0) {
                labelTerbilang.innerText = '#  #';
                receiptContent.terbilang = '#  #';
            } else {
                labelTerbilang.innerText = '# ' + getTerbilang + ' rupiah #';
                receiptContent.terbilang = '# ' + getTerbilang + ' rupiah #';
            }

            receiptContent.nominal = getGrandTotal;
            inputInvoiceContent.value = JSON.stringify(invoiceContent);
            inputReceiptContent.value = JSON.stringify(receiptContent);

        }

        inputPpnChange = (sel) => {
            var getSubTotal = countNominal();
            var getPpn = Math.round(sel.value);
            var getGrandTotal = getSubTotal + getPpn;
            var getTerbilang = terbilang(getGrandTotal);

            inputNominalInvoice.value = getSubTotal;
            // labelPpn.innerText = getPpn.toLocaleString();
            labelGrandTotal.innerText = getGrandTotal.toLocaleString();
            labelReceiptNominal.innerText = getGrandTotal.toLocaleString();
            if (getGrandTotal == 0) {
                labelTerbilang.innerText = '#  #';
                receiptContent.terbilang = '#  #';
            } else {
                labelTerbilang.innerText = '# ' + getTerbilang + ' rupiah #';
                receiptContent.terbilang = '# ' + getTerbilang + ' rupiah #';
            }

            receiptContent.nominal = getGrandTotal;
            inputInvoiceContent.value = JSON.stringify(invoiceContent);
            inputReceiptContent.value = JSON.stringify(receiptContent);
        }
    </script>
    <!-- Script end-->
@endsection
