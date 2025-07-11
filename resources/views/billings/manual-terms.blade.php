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

        if (count($sales) > 1) {
            $saleNumber = substr($sales[0]->number, 0, 4) . '-' . substr($sales[count($sales) - 1]->number, 0, 4);
        } else {
            $saleNumber = substr($sales[0]->number, 0, 4);
        }
        $saleYear = date('y', strtotime($sales[0]->created_at));

        $invoice_content = new stdClass();
        $invoice_content->description = [];
        $invoice_content->merge = 'normal';

        $receipt_content = new stdClass();
        $receiptTypes = [];
        $receiptSizes = [];
        $receiptSides = [];
        $receiptOrientations = [];
        $receipt_content->qty = count($sales) . ' Unit';
        $receipt_content->size = '';
        $receipt_content->type = '';
        $receipt_content->nominal = '';
        if (count($sales) > 1) {
            $receipt_content->title = 'Jasa Penempatan Media Luar Ruang';
            $receipt_content->periode = 'Sesuai dengan yang tertera pada invoice';
        } else {
            $receipt_content->title = 'Jasa Penempatan Media Luar Ruang';
            if (is_null($sales[0]->start_at)) {
                $receipt_content->periode = $sales[0]->duration . ' (sejak materi iklan pertama tayang)';
            } else {
                $receipt_content->periode =
                    $sales[0]->duration .
                    ' (' .
                    date('d', strtotime($sales[0]->start_at)) .
                    ' ' .
                    $bulan[(int) date('m', strtotime($sales[0]->start_at))] .
                    ' ' .
                    date('Y', strtotime($sales[0]->start_at)) .
                    ' s.d. ' .
                    date('d', strtotime($sales[0]->end_at)) .
                    ' ' .
                    $bulan[(int) date('m', strtotime($sales[0]->end_at))] .
                    ' ' .
                    date('Y', strtotime($sales[0]->end_at)) .
                    ')';
            }
        }

        $receipt_content->locations = [];
        $receipt_content->terbilang = '';

        $dataTitles = [
            'Produksi Media Luar Ruang',
            'Daya Listrik Media Luar Ruang',
            'Pemakaian Listrik Media Luar Ruang',
            'Jasa Penyediaan Tempat Media Luar Ruang',
            'Pajak Reklame',
            'PPN',
            'Lainnya',
        ];
    @endphp
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex items-center w-[1200px] border-b px-2">
                <!-- Title start -->
                <h1 class="index-h1 w-[1200px]">Input Termin Pembayaran</h1>
                <!-- Title end -->
                <a href="/billings/index/{{ $company->id }}" class="flex justify-center items-center mx-1 btn-danger"
                    title="Cancel">
                    <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                    </svg>
                    <span class="mx-1 text-white">Cancel</span>
                </a>
            </div>
            <div class="flex justify-center w-full">
                <div class="w-[1200px] mb-10 p-2">
                    <!-- Modal Select Term start-->
                    @foreach ($sales as $sale)
                        @php
                            if (count($sale->quotation->quotation_revisions) != 0) {
                                $quotationDeal = $sale->quotation->quotation_revisions->last();
                                $price = json_decode($quotationDeal->price);
                                $payment_terms = json_decode($quotationDeal->payment_terms);
                            } else {
                                $quotationDeal = $sale->quotation;
                                $price = json_decode($quotationDeal->price);
                                $payment_terms = json_decode($quotationDeal->payment_terms);
                            }
                            $product = json_decode($sale->product);
                            $description = json_decode($product->description);
                            if (
                                $product->category == 'Videotron' ||
                                ($product->category == 'Signage' && $description->type == 'Videotron')
                            ) {
                                $lighting = 'LED';
                            } else {
                                if ($description->lighting == 'Frontlight') {
                                    $lighting = 'FL';
                                } elseif ($description->lighting == 'Backlight') {
                                    $lighting = 'BL';
                                } else {
                                    $lighting = 'NL';
                                }
                            }

                            $saleStart =
                                date('d', strtotime($sale->start_at)) .
                                ' ' .
                                $bulan[(int) date('m', strtotime($sale->start_at))] .
                                ' ' .
                                date('Y', strtotime($sale->start_at));
                            $saleEnd =
                                date('d', strtotime($sale->end_at)) .
                                ' ' .
                                $bulan[(int) date('m', strtotime($sale->end_at))] .
                                ' ' .
                                date('Y', strtotime($sale->end_at));

                            $invoice_description = new stdClass();
                            $invoice_description->sale_id = $sale->id;
                            $invoice_description->nominal = 0;
                            $invoice_description->qty = '1 (satu) unit';
                            $invoice_description->size =
                                $product->size . ' x ' . $product->side . ' - ' . $product->orientation;
                            $invoice_description->type = $product->category . ' - ' . $lighting;
                            if (is_null($sale->start_at)) {
                                $invoice_description->periode =
                                    $sale->duration . ' (sejak materi iklan pertama tayang)';
                            } else {
                                $invoice_description->periode =
                                    $sale->duration . ' (' . $saleStart . ' s.d. ' . $saleEnd . ')';
                            }
                            $invoice_description->location =
                                $product->code . '-' . $product->city_code . ' | ' . $product->address;
                            array_push($invoice_content->description, $invoice_description);
                            $invoice_content->manual_detail = [];
                            array_push(
                                $receipt_content->locations,
                                $product->code . '-' . $product->city_code . ' | ' . $product->address,
                            );

                            if (count($receiptSizes) > 0) {
                                if (in_array($product->size, $receiptSizes)) {
                                } else {
                                    array_push($receiptSizes, $product->size);
                                }
                            } else {
                                array_push($receiptSizes, $product->size);
                            }

                            if (count($receiptTypes) > 0) {
                                $type = $product->category . ' - ' . $lighting;
                                if (!in_array($type, $receiptTypes)) {
                                    array_push($receiptTypes, $type);
                                }
                            } else {
                                $type = $product->category . ' - ' . $lighting;
                                array_push($receiptTypes, $type);
                            }

                            if (count($receiptSides) > 0) {
                                if (!in_array($product->side, $receiptSides)) {
                                    array_push($receiptSides, $product->side);
                                }
                            } else {
                                array_push($receiptSides, $product->side);
                            }

                            if (count($receiptOrientations) > 0) {
                                if (!in_array($product->orientation, $receiptOrientations)) {
                                    array_push($receiptOrientations, $product->orientation);
                                }
                            } else {
                                array_push($receiptOrientations, $product->orientation);
                            }
                        @endphp
                        <div class="w-full bg-stone-200 border rounded-lg border-stone-400 my-2 p-2">
                            @include('billings.sale-media-detail')
                            <label class="flex mt-4 text-md font-semibold">
                                <u>Input Termin Pembayaran Manual : </u>
                            </label>
                            @foreach ($dataTitles as $itemTitle)
                                @if ($itemTitle == 'PPN')
                                    <div class="flex w-full items-center border rounded-md border-stone-900 p-1 mt-2">
                                        <input id="cbTerm{{ $loop->iteration - 1 }}" class="flex outline-none"
                                            value="ppn" type="checkbox" onclick="cbSelectTerm(this)">
                                        <label class="flex ml-2 w-14">{{ $loop->iteration }}. Jenis</label>
                                        <input id="inputTitle" type="text"
                                            class="flex ml-3 px-2 outline-none w-[350px] rounded-md"
                                            value="PPN (Total dari Nilai PO)" readonly>
                                        <label class="flex ml-4">Nominal</label>
                                        <input id="inputNominal"
                                            class="flex ml-2 px-2 outline-none w-32 text-right in-out-spin-none rounded-md"
                                            type="number" value="" disabled>
                                        <label class="ml-2">DPP</label>
                                        <input id="inputDpp"
                                            class="flex ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md"
                                            type="number" value="" disabled>
                                        <label class="flex ml-2">PPN</label>
                                        <input id="inputPpn" onfocus="inputPpnAction(this)" onchange="setPpn(this)"
                                            class="flex ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md"
                                            type="number" value="" readonly>
                                    </div>
                                @else
                                    <div class=" flex w-full items-center border rounded-md border-stone-900 p-1 mt-2">
                                        <input id="cbTerm{{ $loop->iteration - 1 }}" class="flex outline-none"
                                            value="other" type="checkbox" onclick="cbSelectTerm(this)">
                                        <label class="flex ml-2 w-14">{{ $loop->iteration }}. Jenis</label>
                                        <input id="inputTitle" type="text" onfocus="inputTitleAction(this)"
                                            class="flex ml-3 px-2 outline-none w-[350px] rounded-md"
                                            value="{{ $itemTitle }}" onchange="setTitle(this)" readonly>
                                        <label class="flex ml-4">Nominal</label>
                                        <input id="inputNominal" onfocus="inputNominalAction(this)"
                                            class="flex ml-2 px-2 outline-none w-32 text-right in-out-spin-none rounded-md"
                                            type="number" onchange="setNominal(this)" readonly>
                                        <label class="flex ml-2">DPP</label>
                                        <input id="inputDpp" onfocus="inputDppAction(this)" type="number"
                                            onchange="setDpp(this)"
                                            class="flex ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md"
                                            type="number" value="" readonly>
                                        <label class="ml-2">PPN</label>
                                        <input id="inputPpn"
                                            class="flex ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md"
                                            type="number" value="" readonly>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                    @php
                        $i = 0;
                        foreach ($receiptSizes as $receiptSize) {
                            if (count($receiptSizes) > 0) {
                                if ($i == 0) {
                                    $receipt_content->size = $receiptSize;
                                } elseif ($i == count($receiptSizes) - 1) {
                                    $receipt_content->size = $receipt_content->size . ' & ' . $receiptSize;
                                } else {
                                    $receipt_content->size = $receipt_content->size . ', ' . $receiptSize;
                                }
                            } else {
                                $receipt_content->size = $receiptSize;
                            }
                            $i++;
                        }

                        if (count($receiptSides) == 2) {
                            $receipt_content->size = $receipt_content->size . ', 1-2 Sisi';
                        } else {
                            $receipt_content->size = $receipt_content->size . ', ' . $receiptSides[0];
                        }
                        if (count($receiptOrientations) == 2) {
                            $receipt_content->size = $receipt_content->size . ', V/H';
                        } else {
                            $receipt_content->size = $receipt_content->size . ', ' . $receiptOrientations[0];
                        }
                        $i = 0;
                        foreach ($receiptTypes as $receiptType) {
                            if (count($receiptTypes) > 1) {
                                if ($i == 0) {
                                    $receipt_content->type = $receiptType;
                                } elseif ($i == count($receiptTypes) - 1) {
                                    $receipt_content->type = $receipt_content->type . ' & ' . $receiptType;
                                } else {
                                    $receipt_content->type = $receipt_content->type . ', ' . $receiptType;
                                }
                            } else {
                                $receipt_content->type = $receiptType;
                            }
                            $i++;
                        }
                    @endphp
                    <div class="flex w-full items-end bg-stone-400 rounded-lg justify-end px-4 pt-2 border-b pb-2">
                        <form class="m-1" action="/billings/select-sale/media/{{ $company->id }}">
                            <button class="flex justify-center items-center mx-1 btn-primary" title="Back" type="submit">
                                <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                                </svg>
                                <span class="mx-1 text-white">Back</span>
                            </button>
                            <input type="text" name="model" value="{{ $model }}" hidden>
                        </form>
                        <form class="m-1" id="formSelectDocuments" action="/billings/select-documents" method="post">
                            @csrf
                            <input type="text" name="model" value="{{ $model }}" hidden>
                            <input type="text" id="inputReceipt" name="receipt_content"
                                value="{{ json_encode($receipt_content) }}" hidden>
                            <input type="text" id="inputInvoice" name="invoice_content"
                                value="{{ json_encode($invoice_content) }}" hidden>
                            <input type="text" name="client" value="{{ json_encode($client) }}" hidden>
                            <input type="text" name="sale_id" value="{{ $sale_id }}" hidden>
                            <input type="text" name="sale_year" value="{{ $saleYear }}" hidden>
                            <input type="text" name="sale_number" value="{{ $saleNumber }}" hidden>
                            <button class="flex justify-center items-center mx-1 btn-success" title="Next"
                                type="button" onclick="btnTermNext()">
                                <span class="mx-1 text-white">Next</span>
                                <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Modal Select Term end-->
            </div>
        </div>
    </div>

    <script>
        const inputNominal = document.querySelectorAll("[id=inputNominal]");
        const inputDpp = document.querySelectorAll("[id=inputDpp]");
        const inputPpn = document.querySelectorAll("[id=inputPpn]");
        const inputTitle = document.querySelectorAll("[id=inputTitle]");
        const formSelectDocuments = document.getElementById("formSelectDocuments");
        const inputReceipt = document.getElementById("inputReceipt");
        const inputInvoice = document.getElementById("inputInvoice");
        let invoiceContent = @json($invoice_content);
        let receiptContent = @json($receipt_content);
        let salePrice = @json($sale->price);
        var indexTitle = "";
        var indexNominal = "";
        var indexDpp = "";
        var indexPpn = "";

        cbSelectTerm = (sel) => {
            var indexTerm = parseInt(sel.id.replace(/[A-Za-z$-]/g, ""));
            var objManualDetail = {
                'id': indexTerm,
                "title": inputTitle[indexTerm].value,
                "nominal": inputNominal[indexTerm].value,
                "dpp": inputDpp[indexTerm].value,
                "ppn": false
            }

            if (sel.checked == true) {
                if (sel.value == "ppn") {
                    for (let i = 0; i < invoiceContent.manual_detail.length; i++) {
                        invoiceContent.manual_detail[i].dpp = 0;
                    }
                    for (let j = 0; j < inputDpp.length; j++) {
                        inputDpp[j].value = "";
                        inputPpn[j].value = "";
                    }
                    objManualDetail.ppn = true;
                    inputPpn[indexTerm].value = Number((salePrice / 12 * 11) * 12 / 100);
                    objManualDetail.nominal = inputPpn[indexTerm].value;
                } else {
                    inputTitle[indexTerm].removeAttribute("readonly");
                    inputNominal[indexTerm].removeAttribute("readonly");
                    inputNominal[indexTerm].focus();
                    inputDpp[indexTerm].removeAttribute("readonly");
                }
                invoiceContent.manual_detail.push(objManualDetail);
            } else {
                if (sel.value == "ppn") {
                    inputPpn[indexTerm].setAttribute("readonly", "readonly");
                    inputPpn[indexTerm].value = inputPpn[indexTerm].defaultValue;
                } else {
                    inputTitle[indexTerm].setAttribute("readonly", "readonly");
                    inputTitle[indexTerm].value = inputTitle[indexTerm].defaultValue;
                    inputNominal[indexTerm].setAttribute("readonly", "readonly");
                    inputNominal[indexTerm].value = inputNominal[indexTerm].defaultValue;
                    inputDpp[indexTerm].setAttribute("readonly", "readonly");
                    inputDpp[indexTerm].value = inputDpp[indexTerm].defaultValue;
                    inputPpn[indexTerm].value = inputPpn[indexTerm].defaultValue;
                }
                for (let i = 0; i < invoiceContent.manual_detail.length; i++) {
                    if (invoiceContent.manual_detail[i].id == indexTerm) {
                        invoiceContent.manual_detail.splice(i, 1);
                    }
                }
            }
        }

        inputTitleAction = (sel) => {
            for (let i = 0; i < inputTitle.length; i++) {
                if (inputTitle[i] == document.activeElement) {
                    indexTitle = i;
                }
            }
        }

        inputNominalAction = (sel) => {
            for (let i = 0; i < inputNominal.length; i++) {
                if (inputNominal[i] == document.activeElement) {
                    indexNominal = i;
                }
            }
        }

        inputDppAction = (sel) => {
            for (let i = 0; i < inputDpp.length; i++) {
                if (inputDpp[i] == document.activeElement) {
                    indexDpp = i;
                }
            }
        }

        setTitle = (sel) => {
            for (let i = 0; i < invoiceContent.manual_detail.length; i++) {
                if (invoiceContent.manual_detail[i].id == indexTitle) {
                    invoiceContent.manual_detail[i].title = sel.value;
                }
            }
        }

        setNominal = (sel) => {
            for (let i = 0; i < invoiceContent.manual_detail.length; i++) {
                if (invoiceContent.manual_detail[i].id == indexNominal) {
                    invoiceContent.manual_detail[i].nominal = Number(sel.value);
                    invoiceContent.manual_detail[i].dpp = invoiceContent.manual_detail[i].nominal / 12 * 11;
                    inputDpp[indexNominal].value = Math.round(invoiceContent.manual_detail[i].dpp);
                    inputPpn[indexNominal].value = Math.round(invoiceContent.manual_detail[i].dpp * 12 / 100);
                }
            }
        }

        setDpp = (sel) => {
            for (let i = 0; i < invoiceContent.manual_detail.length; i++) {
                if (invoiceContent.manual_detail[i].id == indexDpp) {
                    invoiceContent.manual_detail[i].dpp = Number(sel.value);
                    inputPpn[indexDpp].value = Math.round(invoiceContent.manual_detail[i].dpp * 12 / 100);
                }
            }
        }

        termCheck = () => {
            if (invoiceContent.manual_detail.length == 0 || invoiceContent.description[0].nominal == 0) {
                return false;
            } else {
                return true;
            }
        }

        btnTermNext = () => {
            var countNominal = 0;
            for (let i = 0; i < invoiceContent.manual_detail.length; i++) {
                if (invoiceContent.manual_detail[i].ppn == false) {
                    countNominal = countNominal + invoiceContent.manual_detail[i].nominal;
                }
            }

            invoiceContent.description[0].nominal = countNominal;

            if (invoiceContent.manual_detail.length == 1) {
                receiptContent.title = invoiceContent.manual_detail[0].title;
            }

            inputInvoice.value = JSON.stringify(invoiceContent);
            inputReceipt.value = JSON.stringify(receiptContent);

            if (termCheck() == true) {
                formSelectDocuments.submit();
            } else {
                alert("Silahkan input minimal 1 termin pembayaran dan nominal tidak bolah kosong..!!");
            }

        }
    </script>
@endsection
