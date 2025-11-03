@extends('dashboard.layouts.main');

@section('container')
    <?php
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    
    $content = json_decode($bill_cover_letter->content);
    $client = $content->client;
    
    $updated_by = new stdClass();
    $updated_by->id = auth()->user()->id;
    $updated_by->name = auth()->user()->name;
    $updated_by->position = auth()->user()->position;
    ?>
    <form id="formCreate" action="/accounting/bill-cover-letters/{{ $bill_cover_letter->id }}" method="post"
        enctype="multipart/form-data">
        @method('put')
        @csrf
        <input type="text" name="updated_by" value="{{ json_encode($updated_by) }}" hidden>
        <input id="inputContent" type="text" name="content" value="{{ json_encode($content) }}" hidden>
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="z-0 mb-8 bg-stone-700 p-4 border rounded-md">
                <div class="flex border-b justify-end py-1">
                    <button class="flex items-center justify-center btn-primary mx-1" type="submit">
                        <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                        </svg>
                        <span class="mx-2"> Save </span>
                    </button>
                    <a class="flex justify-center items-center mx-1 btn-danger"
                        href="/bill-cover-letters/index/{{ $company->id }}">
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
                <div class="flex justify-center w-full">
                    <div id="pdfPreview" class="w-[950px] h-[1345px] bg-white p-2 mt-2">
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
                                        <label class="ml-1 text-sm text-black">{{ $bill_cover_letter->number }}</label>
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
                                            <label class="ml-1 text-sm text-black font-semibold flex">
                                                @if (isset($client->company))
                                                    {{ $client->company }}
                                                @elseif (isset($client->name))
                                                    {{ $client->name }}
                                                @else
                                                    {{ $client->contact_name }}
                                                @endif
                                            </label>
                                            <label class="ml-1 text-sm text-black flex">Di -</label>
                                            <label class="ml-6 text-sm text-black flex">Tempat</label>
                                        </div>
                                    </div>
                                    <div class="flex mt-6">
                                        <label class="ml-1 text-sm text-black flex">Dengan hormat,</label>
                                    </div>
                                    <div class="flex mt-2 text-justify w-[721px] text-sm">
                                        <textarea class="ml-1 px-1 w-[721px] outline-none text-sm border rounded-md text-justify" rows="3"
                                            onchange="changeLetterTop(this)">{{ $content->letter_top }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center mt-2">
                                <div id="attachments" class="w-[650px]">
                                    @foreach ($content->attachments as $item)
                                        <div id="divAttachment" class="flex text-sm mt-1">
                                            <input id="cbAttachment" type="checkbox" class="outline-none"
                                                onclick="cbAttachmentChange(this)" title="cb*{{ $loop->iteration - 1 }}"
                                                checked>
                                            <label class="ml-2">{{ $loop->iteration }}. </label>
                                            <input id="itemAttachment" title="attachment*{{ $loop->iteration - 1 }}"
                                                class="ml-2 text-sm text-black outline-none border rounded-md px-1 w-full"
                                                type="text" value="{{ $item }}"
                                                onchange="itemAttachmentChange(this)">
                                        </div>
                                    @endforeach
                                    <div class="flex mt-2">
                                        <button type="button" class="btn-add-note w-max h-5" onclick="btnAddAttachment()">
                                            <svg class="fill-current w-4" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm-.747 9.25h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                                    fill-rule="nonzero" />
                                            </svg>Tambah Lampiran</button>
                                        <button type="button" class="btn-del-note w-max h-5" onclick="btnDelAttachment()">
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
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="w-[725px] mt-10">
                                        <label class="ml-1 text-sm text-black flex">Denpasar,
                                            {{ date('d', strtotime($bill_cover_letter->created_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($bill_cover_letter->created_at))] }}
                                            {{ date('Y', strtotime($bill_cover_letter->created_at)) }}</label>
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
                                        <label id="salesUser"
                                            class="ml-1 text-sm text-black flex font-semibold"><u>{{ $bank_account->director }}</u></label>
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
    @if ($content->category == 'Service')
        @if (isset($client->type) && $client->type == 'Perusahaan')
            <input id="saveName" type="text"
                value="{{ substr($bill_cover_letter->number, 0, 4) }}-SP-Revisual-{{ $client->company }}" hidden>
        @elseif (isset($client->name))
            <input id="saveName" type="text"
                value="{{ substr($bill_cover_letter->number, 0, 4) }}-SP-Revisual-{{ $client->name }}" hidden>
        @else
            <input id="saveName" type="text"
                value="{{ substr($bill_cover_letter->number, 0, 4) }}-SP-Revisual-{{ $client->contact_name }}" hidden>
        @endif
    @else
        @if ($client->type == 'Perusahaan')
            <input id="saveName" type="text"
                value="{{ substr($bill_cover_letter->number, 0, 4) }}-SP-Media-{{ $client->company }}" hidden>
        @else
            <input id="saveName" type="text"
                value="{{ substr($bill_cover_letter->number, 0, 4) }}-SP-Media-{{ $client->name }}" hidden>
        @endif
    @endif

    <!-- Script start-->

    <script>
        const inputContent = document.getElementById("inputContent");
        const attachments = document.getElementById("attachments");
        var attachmentQty = attachments.children.length;
        let content = @json($content);
        const itemAttachment = document.querySelectorAll("[id=itemAttachment]");
        const divAttachment = document.querySelectorAll("[id=divAttachment]");
        const cbAttachment = document.querySelectorAll("[id=cbAttachment]");

        // Button Add Attachment Action --> start
        btnAddAttachment = () => {
            const newDivAttachment = divAttachment[0].cloneNode(true);
            newDivAttachment.children[0].title = "cb*" + attachments.children.length - 1;
            newDivAttachment.children[1].innerText = (attachments.children.length) + ".";
            newDivAttachment.children[2].value = "";

            attachments.insertBefore(newDivAttachment, attachments.children[attachments.children.length - 1]);

            attachments.children[attachments.children.length - 2].children[2].focus();
        };
        // Button Add Attachment Action --> end

        // Button Remove Last Attachment Action --> start
        btnDelAttachment = () => {
            const attachments = document.getElementById("attachments");
            if (attachments.children.length > attachmentQty) {
                attachments.removeChild(attachments.children[attachments.children.length - 2]);
                content.attachments.splice(-1);
                inputContent.value = JSON.stringify(content);
            } else {
                alert("Tidak ada tambahan lampiran yang bisa dihapus");
            }
        };
        // Button Remove Last Attachment Action --> end

        cbAttachmentChange = (sel) => {
            var getTitle = sel.title.split("*");
            var indexCb = getTitle[1];
            content.attachments = [];

            if (sel.checked == true) {
                itemAttachment[indexCb].removeAttribute('disabled');
            } else {
                itemAttachment[indexCb].setAttribute('disabled', 'disabled');
            }
            for (let i = 0; i < cbAttachment.length; i++) {
                if (cbAttachment[i].checked == true && itemAttachment[i].value != "") {
                    content.attachments.push(itemAttachment[i].value);
                }
            }
            inputContent.value = JSON.stringify(content);
        }

        changeLetterTop = (sel) => {
            if (sel.value == "") {
                alert("Input body surat tidak boleh kosong..!!");
                sel.value = sel.defaultValue;
            } else {
                content.letter_top = sel.value;
                inputContent.value = JSON.stringify(content);
            }
        }

        itemAttachmentChange = (sel) => {
            const attachments = document.getElementById("attachments");
            const cbAttachment = document.querySelectorAll("[id=cbAttachment]");
            var attachmentQty = attachments.children.length;
            content.attachments = [];

            for (let i = 0; i < attachmentQty - 1; i++) {
                if (attachments.children[i].children[0].checked == true && attachments.children[i].children[2].value !=
                    "") {
                    content.attachments.push(attachments.children[i].children[2].value);
                }
            }

            inputContent.value = JSON.stringify(content);
        }
    </script>
    <!-- Script end-->
@endsection
