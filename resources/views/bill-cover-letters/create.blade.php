@extends('dashboard.layouts.main');

@section('container')
    <?php
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $romawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VII', 'IX', 'X', 'XI', 'XII'];
    $receiptContent = json_decode($billings[0]->receipt_content);
    $invoiceContent = json_decode($billings[0]->invoice_content);
    $billTitle = $receiptContent->title;
    $billLocation = $invoiceContent->description[0]->location;
    $area = $invoiceContent->description[0]->area;
    $city = $invoiceContent->description[0]->city;
    $approval = $invoiceContent->approval;
    $orders = $invoiceContent->orders;
    if (isset($invoiceContent->agreements)) {
        $agreements = $invoiceContent->agreements;
    } else {
        $agreements = [];
    }
    
    $attachments = [];
    $approvalId = $approval->id;
    $orderId = [];
    $agreementId = [];
    $vatTaxId = [];
    $billingNumber = [];
    $workReportId = $orders;
    if ($client->company == 'PT. Gudang Garam Tbk') {
        array_push($attachments, 'Surat Pengantar');
        $indexOrder = 1;
        $firstOrderNumber = $orders[0]->number;
        $i = 0;
        foreach ($orders as $order) {
            if ($i == 0) {
                array_push($orderId, $order->id);
                array_push($attachments, 'Copy Purchase Order (PO) No. ' . $order->number . ' Tanggal ' . date('d', strtotime($order->date)) . ' ' . $bulan[(int) date('m', strtotime($order->date))] . ' ' . date('Y', strtotime($order->date)));
            } elseif ($order->number != $firstOrderNumber) {
                array_push($orderId, $order->id);
                array_push($attachments, 'Copy Purchase Order (PO) No. ' . $order->number . ' Tanggal ' . date('d', strtotime($order->date)) . ' ' . $bulan[(int) date('m', strtotime($order->date))] . ' ' . date('Y', strtotime($order->date)));
            }
            $i++;
        }
        foreach ($agreements as $agreement) {
            array_push($agreementId, $agreement->id);
            array_push($attachments, 'Copy Surat Perjanjian No. ' . $agreement->number . ' Tanggal ' . date('d', strtotime($agreement->date)) . ' ' . $bulan[(int) date('m', strtotime($agreement->date))] . ' ' . date('Y', strtotime($agreement->date)));
        }
        array_push($attachments, 'Lembar Evaluasi Pekerjaan (LEP)');
        array_push($attachments, 'Berita Acara Serah Terima Pekerjaan (BASTP)');
        array_push($attachments, 'Dokumentasi Pekerjaan');
        foreach ($billings as $billing) {
            array_push($billingNumber, $billing->invoice_number);
            array_push($attachments, 'Invoice No. ' . $billing->invoice_number . ' Tanggal ' . date('d', strtotime($billing->created_at)) . ' ' . $bulan[(int) date('m', strtotime($billing->created_at))] . ' ' . date('Y', strtotime($billing->created_at)));
            array_push($attachments, 'Kwitansi No. ' . $billing->receipt_number . ' Tanggal ' . date('d', strtotime($billing->created_at)) . ' ' . $bulan[(int) date('m', strtotime($billing->created_at))] . ' ' . date('Y', strtotime($billing->created_at)));
            if ($billing->vat_tax_invoice) {
                array_push($vatTaxId, $billing->vat_tax_invoice->id);
                array_push($attachments, 'Faktur Pajak No. ' . $billing->vat_tax_invoice->number . ' Tanggal ' . date('d', strtotime($billing->vat_tax_invoice->created_at)) . ' ' . $bulan[(int) date('m', strtotime($billing->vat_tax_invoice->created_at))] . ' ' . date('Y', strtotime($billing->vat_tax_invoice->created_at)));
            }
        }
    } else {
        $attachments[0] = 'Surat Pengantar';
        $attachments[1] = 'Copy Penawaran';
        $index = 2;
        foreach ($orders as $order) {
            array_push($orderId, $order->id);
            $attachments[$index] = 'Copy Purchase Order (PO) No. ' . $order->number . ' Tanggal ' . date('d', strtotime($order->date)) . ' ' . $bulan[(int) date('m', strtotime($order->date))] . ' ' . date('Y', strtotime($order->date));
            $index++;
        }
        foreach ($agreements as $agreement) {
            array_push($agreementId, $agreement->id);
            $attachments[$index] = 'Copy Surat Perjanjian No. ' . $agreement->number . ' Tanggal ' . date('d', strtotime($agreement->date)) . ' ' . $bulan[(int) date('m', strtotime($agreement->date))] . ' ' . date('Y', strtotime($agreement->date));
            $index++;
        }
        foreach ($billings as $billing) {
            $attachments[$index] = 'Invoice No. ' . $billing->invoice_number . ' Tanggal ' . date('d', strtotime($billing->created_at)) . ' ' . $bulan[(int) date('m', strtotime($billing->created_at))] . ' ' . date('Y', strtotime($billing->created_at));
            $attachments[$index + 1] = 'Kwitansi No. ' . $billing->receipt_number . ' Tanggal ' . date('d', strtotime($billing->created_at)) . ' ' . $bulan[(int) date('m', strtotime($billing->created_at))] . ' ' . date('Y', strtotime($billing->created_at));
            if ($billing->vat_tax_invoice) {
                array_push($vatTaxId, $billing->vat_tax_invoice->id);
                $attachments[$index + 2] = 'Faktur Pajak No. ' . $billing->vat_tax_invoice->number . ' Tanggal ' . date('d', strtotime($billing->vat_tax_invoice->created_at)) . ' ' . $bulan[(int) date('m', strtotime($billing->vat_tax_invoice->created_at))] . ' ' . date('Y', strtotime($billing->vat_tax_invoice->created_at));
            }
            $index = $index + 2;
        }
        $attachments[$index + 1] = 'Surat Pemberitahuan Nomor Seri Faktur Pajak dari Kantor Pajak';
        $attachments[$index + 2] = 'Berita Acara Serah Terima Pekerjaan (BASTP)';
        $attachments[$index + 3] = 'Dokumentasi Pekerjaan';
    }
    
    $content = new stdClass();
    if ($category == 'Service') {
        $content->letter_top = 'Bersama ini kami sampaikan perlengkapan dokumen untuk memenuhi persyaratan penagihan atas jasa ' . $billTitle . ' dengan tema ' . $receiptContent->theme . ' dengan perincian sebagai berikut :';
    } else {
        $content->letter_top = 'Bersama ini kami sampaikan perlengkapan dokumen untuk memenuhi persyaratan penagihan atas jasa ' . $billTitle . ' yang berlokasi di ' . $billLocation . ',' . $city . ', ' . $area . ' dengan perincian sebagai berikut :';
    }
    $content->attachments = $attachments;
    $content->client = $client;
    $content->billing_number = $billingNumber;
    $content->category = $category;
    
    $created_by = new stdClass();
    $created_by->id = auth()->user()->id;
    $created_by->name = auth()->user()->name;
    $created_by->position = auth()->user()->position;
    $created_by->phone = auth()->user()->phone;
    ?>
    <!-- Quotation start -->
    <form id="formCreate" action="/accounting/bill-cover-letters" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="company_id" value="{{ $company->id }}" hidden>
        <input type="text" name="billing_id" value="{{ $billing_id }}" hidden>
        <input type="text" name="vat_tax_invoice_id" value="{{ json_encode($vatTaxId) }}" hidden>
        <input type="text" name="work_report_id" value="{{ json_encode($workReportId) }}" hidden>
        <input type="text" name="quotation_approval_id" value="{{ json_encode($approvalId) }}" hidden>
        <input type="text" name="quotation_order_id" value="{{ json_encode($orderId) }}" hidden>
        <input type="text" name="quotation_agreement_id" value="{{ json_encode($agreementId) }}" hidden>
        <input id="letterContent" type="text" name="content" value="{{ json_encode($content) }}" hidden>
        <input type="text" name="created_by" value="{{ json_encode($created_by) }}" hidden>
        <input type="text" name="updated_by" value="{{ json_encode($created_by) }}" hidden>
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="z-0 mb-8 bg-stone-700 p-4 border rounded-md">
                <div class="flex w-full justify-center">
                    <div class="flex w-[950px] border-b py-2">
                        <h1 class="text-xl text-stone-100 px-2 w-[900px] font-bold tracking-wider">
                            MEMBUAT SURAT PENGANTAR TAGIHAN
                        </h1>
                        <div class="flex w-full justify-end">
                            @canany(['isAdmin', 'isAccounting'])
                                @can('isCollect')
                                    @can('isAccountingCreate')
                                        <button id="btnSave" class="flex justify-center items-center mx-1 btn-primary" title="Save"
                                            type="submit">
                                            <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24">
                                                <path
                                                    d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                                            </svg>
                                            <span class="ml-2 text-white">Save</span>
                                        </button>
                                    @endcan
                                @endcan
                            @endcanany
                            <a class="flex justify-center items-center ml-1 btn-danger"
                                href="/bill-cover-letters/index/{{ $company->id }}">
                                <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                                </svg>
                                <span class="ml-1 xl:mx-2 text-sm">Cancel</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center w-full">
                    <div class="w-[950px] h-[1345px] bg-white mb-10 p-2 mt-2">
                        <!-- Header start -->
                        @include('dashboard.layouts.letter-header')
                        <!-- Header end -->
                        <!-- Body start -->
                        <div class="h-[1100px]">
                            <div class="flex justify-center">
                                <div class="w-[725px] mt-2">
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black flex w-20">Nomor</label>
                                        <label class="ml-1 text-sm text-black">:</label>
                                        <label class="ml-1 text-sm text-slate-500">Penomoran otomatis</label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black flex w-20">Lampiran</label>
                                        <label class="ml-1 text-sm text-black flex">:</label>
                                        <label id="createAttachment" class="ml-1 text-sm text-black flex">1 (Satu)
                                            Set</label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black flex w-20">Perihal</label>
                                        <label class="ml-1 text-sm text-black flex">:</label>
                                        <label id="createSubject" class="ml-1 text-sm text-black flex">
                                            Pengantar Tagihan
                                        </label>
                                    </div>
                                    <div class="flex mt-4">
                                        <div>
                                            <label class="ml-1 text-sm text-black flex w-20">Kepada Yth</label>
                                            <label
                                                class="ml-1 text-sm text-black font-semibold flex">{{ $client->company }}</label>
                                            <label class="ml-1 text-sm text-black flex">Di -</label>
                                            <label class="ml-6 text-sm text-black flex">Tempat</label>
                                        </div>
                                    </div>
                                    <div class="flex mt-6">
                                        <label class="ml-1 text-sm text-black flex">Dengan hormat,</label>
                                    </div>
                                    <div class="flex mt-2">
                                        <textarea id="createBodyTop" class="ml-1 w-[721px] outline-none text-sm border rounded-md text-justify" rows="3"
                                            onchange="changeLetterTop(this)">{{ $content->letter_top }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center mt-2">
                                <div id="attachment" class="w-[650px]">
                                    @foreach ($attachments as $item)
                                        <div class="flex">
                                            <input id="cbAttachment" value="cbAttachment{{ $loop->iteration - 1 }}"
                                                type="checkbox" class="outline-none" onclick="cbAttachmentChange(this)"
                                                checked>
                                            <input id="attachmentValue" type="text"
                                                class="ml-1 text-sm text-black outline-none border rounded-md px-1 w-full"
                                                value="{{ $item }}" onchange="changeAttachment(this)">
                                        </div>
                                    @endforeach
                                    <div class="flex mt-2">
                                        <button type="button" class="btn-add-note w-max h-5"
                                            onclick="btnAddAttachment()">
                                            <svg class="fill-current w-4" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm-.747 9.25h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                                    fill-rule="nonzero" />
                                            </svg>Tambah Lampiran</button>
                                        <button type="button" class="btn-del-note w-max h-5"
                                            onclick="btnDelAttachment()">
                                            <svg class="fill-current w-4" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm4.253 9.25h-8.5c-.414 0-.75.336-.75.75s.336.75.75.75h8.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75z"
                                                    fill-rule="nonzero" />
                                            </svg>Hapus Lampiran</button>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-center">
                                    <div class="w-[721px] mt-4 text-sm text-justify">Demikian surat ini kami sampaikan dan
                                        mohon kiranya dapat diterima dengan baik, atas perhatian dan kerjasamanya kami
                                        ucapkan terima kasih.
                                        {{-- <textarea id="createBodyEnd" class="ml-1 w-[721px] outline-none border rounded-md "
                                            rows="2">Demikian surat ini kami sampaikan dan mohon kiranya dapat diterima dengan baik, atas perhatian dan kerjasamanya kami ucapkan terima kasih.
                                        </textarea> --}}
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="w-[725px] mt-10">
                                        <label class="ml-1 text-sm text-black flex">Denpasar, {{ date('d') }}
                                            {{ $bulan[(int) date('m')] }}
                                            {{ date('Y') }}</label>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="w-[725px]">
                                        <label
                                            class="ml-1 text-sm text-black flex font-semibold">{{ $company->name }}</label>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="w-[725px] mt-16">
                                        <label id="salesUser" class="ml-1 text-sm text-black flex font-semibold"><u>Texun
                                                Sandy Kamboy</u></label>
                                        <label id="salesPhone" class="ml-1 text-xs text-black flex">Direktur</label>
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
            </div>
        </div>
    </form>

    <script>
        const attachment = document.getElementById("attachment");
        var attachmentQty = attachment.children.length;
        let content = @json($content);
        // Button Add Attachment Action --> start
        btnAddAttachment = () => {
            const divAttachment = document.createElement("div");
            const cbAttachment = document.createElement("input");
            const inputAttachment = document.createElement("input");
            divAttachment.classList.add("flex");
            inputAttachment.classList.add("input-attachment");
            inputAttachment.setAttribute("type", "text");
            divAttachment.classList.add("flex");
            cbAttachment.classList.add("outline-none");
            cbAttachment.setAttribute("type", "checkbox");

            divAttachment.appendChild(cbAttachment);
            divAttachment.appendChild(inputAttachment);

            // attachment.appendChild(divAttachment);
            attachment.insertBefore(divAttachment, attachment.children[attachment.children.length - 1]);
            inputAttachment.focus();
        };
        // Button Add Attachment Action --> end

        // Button Remove Last Attachment Action --> start
        btnDelAttachment = () => {
            const attachment = document.getElementById("attachment");
            if (attachment.children.length > attachmentQty) {
                attachment.removeChild(attachment.children[attachment.children.length - 2]);
            } else {
                alert("Tidak ada tambahan lampiran yang bisa dihapus");
            }
        };
        // Button Remove Last Attachment Action --> end

        cbAttachmentChange = (sel) => {
            const attachmentValue = document.querySelectorAll('[id=attachmentValue]');
            const cbAttachment = document.querySelectorAll('[id=cbAttachment]');
            var index = parseInt(sel.value.replace(/[A-Za-z$-]/g, ""));
            content.attachments = [];

            if (sel.checked == true) {
                attachmentValue[index].setAttribute('disabled', 'disabled');
            } else {
                attachmentValue[index].removeAttribute('disabled');
            }

            for (let i = 0; i < cbAttachment.length; i++) {
                if (cbAttachment[i].checked == true && attachmentValue[i].value != "") {
                    content.attachments.push(attachmentValue[i].value);
                }
            }
            document.getElementById("letterContent").value = JSON.stringify(content);
        }

        changeLetterTop = (sel) => {
            if (sel.value == "") {
                alert("Input body surat tidak boleh kosong..!!");
                sel.value = sel.defaultValue;
            } else {
                content.letter_top = sel.value;
                document.getElementById("letterContent").value = JSON.stringify(content);
            }
        }
    </script>
@endsection
