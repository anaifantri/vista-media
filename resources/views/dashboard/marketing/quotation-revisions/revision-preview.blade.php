<!-- Quotation Preview start -->
<div id="modalPreview" class="absolute justify-center top-0 w-full h-max bg-black bg-opacity-90 z-50 hidden">
    <div>
        <div class="flex mt-10">
            <div class="flex w-48">
                <button id="btnSave" class="flex justify-center items-center mx-1 btn-success" title="Save"
                    type="submit">
                    <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                    </svg>
                    <span class="ml-2 text-white">Save</span>
                </button>
            </div>
            <div class="flex w-[588px] justify-end">
                <button id="btnClosePreview" class="flex" title="Close" type="button">
                    <svg class="fill-white w-6 m-auto hover:fill-red-600" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                    </svg>
                </button>
            </div>
        </div>
        <div id="pdfPreview" class="w-[780px] max-h-max">
            <!-- Header start -->
            <div class="w-[780px] h-[1100px] mt-2 bg-white border">
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
                <div class="h-[880px]">
                    <div class="flex justify-center">
                        <div class="w-[650px] mt-4">
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">Nomor</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label id="quotationNumberBBPreview" class="ml-1 text-sm text-black flex"></label>
                            </div>
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">Lampiran</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label id="attachmentBBPreview" class="ml-1 text-sm text-black flex"></label>
                            </div>
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">Perihal</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label id="subjectBBPreview" class="ml-1 text-sm text-black flex"></label>
                            </div>
                            <div class="flex mt-4">
                                <div>
                                    <label class="ml-1 text-sm text-black flex w-20">Kepada Yth</label>
                                    <label id="clientBBPreview"
                                        class="ml-1 text-sm text-black flex font-semibold"></label>
                                    <label id="contactBBPreview"
                                        class="ml-1 text-sm text-black flex font-semibold"></label>
                                    <label class="ml-1 text-sm text-black flex">Di -</label>
                                    <label class="ml-6 text-sm text-black flex">Tempat</label>
                                </div>
                            </div>
                            <div class="flex mt-4">
                                <label class="ml-1 text-sm text-black flex w-20">Email</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label id="contactEmailBBPreview" class="ml-1 text-sm text-black flex"></label>
                            </div>
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">No. Telp.</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label id="contactPhoneBBPreview" class="ml-1 text-sm text-black flex"></label>
                            </div>
                            <div class="flex mt-4">
                                <label class="ml-1 text-sm text-black flex">Dengan hormat,</label>
                            </div>
                            <div class="flex mt-2">
                                <label id="letterBodyBBPreview"
                                    class="ml-1 w-[650px] h-max text-sm text-black flex"></label>
                            </div>
                        </div>
                    </div>
                    <!-- Billboard Location Table Preview start -->
                    <div id="" class="ml-2">
                        <div class="flex justify-center">
                            <div id="previewTableWidth" class="w-[650px]">
                                <table id="" class="table-fix mt-2 w-full">
                                    <thead>
                                        <tr>
                                            <th class="text-[0.7rem] text-teal-700 border w-6" rowspan="2">No</th>
                                            <th class="text-[0.7rem] text-teal-700 border w-16" rowspan="2">Kode
                                            </th>
                                            <th class="text-[0.7rem] text-teal-700 border" rowspan="2">Lokasi
                                            </th>
                                            <th class="text-[0.7rem] text-teal-700 border w-[116px]" colspan="3">
                                                Deskripsi
                                            </th>
                                            <th id="previewTHPrice" class="text-[0.7rem] text-teal-700 border w-max">
                                                Harga (Rp.)
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="text-[0.7rem] text-teal-700 border w-6">Jenis</th>
                                            <th class="text-[0.7rem] text-teal-700 border w-6">BL/FL</th>
                                            <th class="text-[0.7rem] text-teal-700 border w-[68px]">Size - V/H</th>
                                            <th id="previewBBthAMonth" class="text-[0.7rem] text-teal-700 border w-max">
                                            </th>
                                            <th id="previewBBthQuarterYear"
                                                class="text-[0.7rem] text-teal-700 border w-max">
                                            </th>
                                            <th id="previewBBthHalfYear"
                                                class="text-[0.7rem] text-teal-700 border w-max">
                                            </th>
                                            <th id="previewBBthAYear"
                                                class="text-[0.7rem] text-teal-700 border w-max">
                                            </th>
                                            <th id="previewBBthManual"
                                                class="text-[0.7rem] text-teal-700 border justify-center" hidden>
                                                <input id="previewBBManualPrice" class="input-price-preview"
                                                    type="text" placeholder="">
                                            </th>
                                            {{-- <th class="text-[0.7rem] text-teal-700 border"></th> --}}
                                        </tr>
                                    </thead>
                                    <tbody id="previewBBTBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Billboard Location Table Preview end -->

                    <!-- billboard note start -->
                    <div class="flex justify-center">
                        <div id="previewBBNote" class="w-[650px] mt-2">
                            <div class="flex">
                                <label class="ml-1 text-[0.7rem] text-black flex w-20">Catatan</label>
                                <label class="ml-1 text-[0.7rem] text-black flex">:</label>
                            </div>
                            <div id="previewBBNote-1" hidden>
                                <div class="flex">
                                    <label class="ml-1 text-[0.7rem] text-black flex">-</label>
                                    <label id="labelPreviewBBNote-1" class="ml-2 text-[0.7rem] text-black w-full">
                                    </label>
                                </div>
                            </div>
                            <div id="previewBBNote-2" hidden>
                                <div class="flex">
                                    <label class="ml-1 text-[0.7rem] text-black flex">-</label>
                                    <label id="labelPreviewBBNote-2" class="ml-2 text-[0.7rem] text-black w-full">
                                    </label>
                                </div>
                            </div>
                            <div id="previewBBNote-3" hidden>
                                <label id="labelPreviewBBNote-3" class="ml-4 text-[0.7rem] text-black w-full"
                                    type="text" readonly> </label>
                            </div>
                            <div id="previewBBNote-4" hidden>
                                <label id="labelPreviewBBNote-4" class="ml-4 text-[0.7rem] text-black w-full"
                                    type="text" readonly> </label>
                            </div>
                            <div id="previewBBNote-5" hidden>
                                <div class="flex">
                                    <label id="labelPreviewBBNote-5" class="ml-4 text-[0.7rem] text-black w-full">
                                    </label>
                                </div>
                            </div>
                            <div id="previewBBNote-6" hidden>
                                <div class="flex">
                                    <label class="ml-1 text-[0.7rem] text-black flex">-</label>
                                    <label id="labelPreviewBBNote-6" class="ml-2 text-[0.7rem] text-black w-full">
                                    </label>
                                </div>
                            </div>
                            <div id="previewBBNote-7" hidden>
                            </div>
                            <div id="previewBBTArea" hidden>
                                <div id="previewBBNote-8" class="flex items-start">
                                    <label class="ml-1 text-[0.7rem] text-black flex">-</label>
                                    <label id="labelPreviewBBNote-8"
                                        class="ml-1 w-[621px] h-max text-[0.7rem] text-black flex"></label>
                                </div>
                            </div>
                            <div id="previewBBNote-9" hidden>
                                <div class="flex">
                                    <label class="ml-1 text-[0.7rem] text-black flex">-</label>
                                    <label id="labelPreviewBBNote-9"
                                        class="ml-2 text-[0.7rem] text-black outline-none w-full"></label>
                                </div>
                            </div>
                            <div id="previewBBNote10" hidden>
                                <div class="flex">
                                    <label class="ml-1 text-[0.7rem] text-black flex">-</label>
                                    <label id="labelPreviewBBNote10"
                                        class="ml-2 text-[0.7rem] text-black outline-none w-full"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- billboard note end -->

                    <div class="flex justify-center">
                        <div class="flex mt-2 w-[650px]">
                            <label class="ml-1 w-[650px] h-max text-sm text-black flex">Demikian surat penawaran
                                ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima
                                kasih.</label>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <?php
                        $quotationDate = date('d F Y');
                        ?>
                        <div class="w-[650px] mt-2">
                            <label class="ml-1 text-sm text-black flex">Denpasar, {{ $quotationDate }}</label>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <div class="w-[250px]">
                            <label class="ml-1 text-sm text-black flex font-semibold">PT. Vista Media</label>
                            <label class="ml-1 my-2 text-xs text-slate-300 flex">Ditandatangani secara elektronik oleh
                                :</label>
                            <label id="salesUser"
                                class="ml-1 text-sm text-black flex font-semibold">{{ auth()->user()->name }}</label>
                            <label id="salesPotition"
                                class="ml-1 text-sm text-black flex">{{ auth()->user()->level }}</label>
                        </div>
                        <div class="w-[400px]">
                            <div>
                                {{ QrCode::size(100)->generate('https://www.vistamedia.co.id/') }}
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
                            <span class="text-sm font-semibold">PT. Vista Media</span>
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
            <div id="locationsImage" class="h-max">

            </div>
            <!-- Footer end -->
        </div>

        <div class="h-80"></div>
    </div>
</div>
<!-- Quotation Preview end -->
