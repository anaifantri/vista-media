<!-- Quotation Billboard Preview start -->
<div id="billboardQuotPreview" class="w-[950px] h-[1345px] border mb-10 mt-1" hidden>
    <!-- Header start -->
    <div class="h-28">
        <div class="flex w-full justify-center items-center">
            <img class="mt-3" src="/img/logo-vm.png" alt="">
        </div>
        <div class="flex w-full justify-center items-center mt-2">
            <img src="/img/line-top.png" alt="">
        </div>
    </div>
    <!-- Header end -->
    <!-- Body start -->
    <div class="h-[1125px]">
        <div class="flex justify-center">
            <div class="w-[725px] mt-2">
                <div class="flex">
                    <label class="ml-1 text-sm text-black flex w-20">Nomor</label>
                    <label class="ml-1 text-sm text-black flex">:</label>
                    <label id="quotationNumber" class="ml-1 text-sm text-black flex"></label>
                </div>
                <div class="flex">
                    <label class="ml-1 text-sm text-black flex w-20">Lampiran</label>
                    <label class="ml-1 text-sm text-black flex">:</label>
                    <label id="attachmentBillboard" class="ml-1 text-sm text-black flex"></label>
                </div>
                <div class="flex">
                    <label class="ml-1 text-sm text-black flex w-20">Perihal</label>
                    <label class="ml-1 text-sm text-black flex">:</label>
                    <label id="subjectBillboard" class="ml-1 text-sm text-black flex"></label>
                </div>
                <div class="flex mt-4">
                    <div>
                        <label class="ml-1 text-sm text-black flex w-20">Kepada Yth</label>
                        <label id="clientCompany" class="ml-1 text-sm text-black flex font-semibold"></label>
                        <label id="clientContact" class="ml-1 text-sm text-black flex font-semibold"></label>
                        <label class="ml-1 text-sm text-black flex">Di -</label>
                        <label class="ml-6 text-sm text-black flex">Tempat</label>
                    </div>
                </div>
                <div class="flex mt-4">
                    <label class="ml-1 text-sm text-black flex w-20">Email</label>
                    <label class="ml-1 text-sm text-black flex">:</label>
                    <label id="contactEmail" class="ml-1 text-sm text-black flex">-</label>
                </div>
                <div class="flex">
                    <label class="ml-1 text-sm text-black flex w-20">No. Telp.</label>
                    <label class="ml-1 text-sm text-black flex">:</label>
                    <label id="contactPhone" class="ml-1 text-sm text-black flex">-</label>
                </div>
                <div class="flex mt-4">
                    <label class="ml-1 text-sm text-black flex">Dengan hormat,</label>
                </div>
                <div class="flex mt-2">
                    <textarea id="bodyTopBillboard" class="ml-1 w-[721px] outline-none text-sm">Bersama ini kami menyampaikan surat penawaran penggunaan media reklame ................. area ............... dengan spesifikasi sebagai berikut :</textarea>
                </div>
            </div>
        </div>
        <div class="flex justify-center">
            <div class="w-[725px] mt-2">
                <div class="flex border-b p-1 w-[725px]">
                    <label class="text-sm font-semibold text-teal-700 flex w-32 p-1">Type Harga</label>
                    <div class="flex w-[600px] justify-end">
                        <button type="button" id="btnAdd" class="flex items-center btn-disabled" disabled>
                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1">Pilih Lokasi</span>
                        </button>
                    </div>
                </div>
                <div id="priceTypeBillboard">
                    <div class="flex w-[600px] mt-1">
                        <input class="ml-2" type="checkbox" id="aMonth" name="aMonth" value="1" checked>
                        <label class="ml-1 text-sm text-teal-700 flex w-20">1
                            Bulan</label>
                        <input type="checkbox" id="quarterYear" name="quarterYear" value="3" checked>
                        <label class="ml-1 text-sm text-teal-700 flex w-20">3
                            Bulan</label>
                        <input type="checkbox" id="halfYear" name="halfYear" value="6" checked>
                        <label class="ml-1 text-sm text-teal-700 flex w-20">6
                            Bulan</label>
                        <input type="checkbox" id="aYear" name="aYear" value="12" checked>
                        <label class="ml-1 text-sm text-teal-700 flex w-20">1
                            Tahun</label>
                        <input type="checkbox" id="manualInput" name="manualInput">
                        <label class="ml-1 text-sm text-teal-700 flex w-24">Manual Input</label>
                    </div>
                </div>
            </div>
        </div>
        <!-- billboard table start -->
        <div id="billboardQuotation" class="ml-2">
            <div class="flex justify-center">
                <table id="billboardTable" class="table-auto mt-2">
                    <thead>
                        <tr>
                            <th class="text-xs text-teal-700 border w-6" rowspan="2">No</th>
                            <th class="text-xs text-teal-700 border w-20" rowspan="2">Kode</th>
                            <th class="text-xs text-teal-700 border w-56" rowspan="2">Lokasi</th>
                            <th class="text-xs text-teal-700 border" colspan="3">Deskripsi</th>
                            <th class="text-xs text-teal-700 border" colspan="5">Harga</th>
                        </tr>
                        <tr>
                            <th class="text-xs text-teal-700 border w-9">Jenis</th>
                            <th class="text-xs text-teal-700 border w-9">BL/FL</th>
                            <th class="text-xs text-teal-700 border w-[88px]">Size - V/H</th>
                            <th id="thAMonth" class="text-xs text-teal-700 border w-[72px]">1 Bulan
                            </th>
                            <th id="thQuarterYear" class="text-xs text-teal-700 border w-[72px]">3
                                Bulan
                            </th>
                            <th id="thHalfYear" class="text-xs text-teal-700 border w-[72px]">6 Bulan
                            </th>
                            <th id="thAYear" class="text-xs text-teal-700 border w-[88px]">1 Tahun
                            </th>
                            <th id="thManual" class="text-xs text-teal-700 border w-[88px] justify-center" hidden>
                                <input id="manualPrice" class="input-price" type="text"
                                    placeholder="Input Periode">
                            </th>
                            {{-- <th class="text-xs text-teal-700 border"></th> --}}
                        </tr>
                    </thead>
                    <tbody id="billboardsTBody">
                    </tbody>
                </table>
            </div>
        </div>
        <!-- billboard table end -->

        <!-- billboard note start -->
        <div class="flex justify-center">
            <div id="billboardNote" class="w-[725px] mt-2">
                <div class="flex">
                    <label class="ml-1 text-sm text-black flex w-20">Catatan</label>
                    <label class="ml-1 text-sm text-black flex">:</label>
                </div>
                <div id="billboardNote01" class="flex">
                    <input id="cbBillboardNote01" class="ml-1" type="checkbox" checked>
                    <label class="ml-1 text-sm text-black flex">-</label>
                    <input id="inputBBNote01" class="ml-2 text-sm text-black outline-none w-full" type="text"
                        value="Biaya di atas belum termasuk PPN.">
                </div>
                <div id="billboardNote02" class="flex">
                    <input id="cbBillboardNote02" class="ml-1" type="checkbox" checked>
                    <label class="ml-1 text-sm text-black flex">-</label>
                    <input id="inputBBNote02" class="ml-2 text-sm text-black outline-none w-full" type="text"
                        value="Harga tersebut termasuk :">
                </div>
                <div id="billboardNote03" class="flex">
                    <input id="cbBillboardNote03" class="ml-1" type="checkbox" checked>
                    <input id="inputBBNote03" class="ml-4 text-sm text-black outline-none w-full" type="text"
                        value="•	 Free pemasangan visual 1 x selama kontrak di luar Biaya Cetak dan Design.">
                </div>
                <div id="billboardNote04" class="flex">
                    <input id="cbBillboardNote04" class="ml-1" type="checkbox" checked>
                    <input id="inputBBNote04" class="ml-4 text-sm text-black outline-none w-full" type="text"
                        value="•	 Sewa Lokasi, konsumsi listrik selama kontrak, maintenance selama kontrak.">
                </div>
                <div id="billboardNote05" class="flex">
                    <input id="cbBillboardNote05" class="ml-1" type="checkbox" checked>
                    <label class="ml-1 text-sm text-black flex">-</label>
                    <input id="inputBBNote05" class="ml-2 text-sm text-black outline-none w-full" type="text"
                        value="Sistem Pembayaran :">
                </div>
                <div>
                    <div id="billboardNote06" class="flex">
                        <input id="cbBillboardNote06" class="ml-1" type="checkbox" checked>
                        <input id="inputBBNote06" class="ml-4 text-sm text-black outline-none w-full" type="text"
                            value="• 100% Pelunasan sebelum materi iklan tayang untuk masa kontrak kurang dari 1 tahun">
                    </div>
                    <div id="billboardNote07" class="flex">
                        <input id="cbBillboardNote07" class="ml-1" type="checkbox" checked>
                        <input id="inputBBNote07" class="ml-4 text-sm text-black outline-none w-full" type="text"
                            value="• 50% DP, 50% Pelunasan setelah BAPP untuk masa kontrak 1 tahun">
                    </div>
                </div>
                <div id="billboardTArea">
                    <div id="billboardNote08" class="flex items-start">
                        <input id="cbBillboardNote08" class="ml-1 mt-1" type="checkbox" checked>
                        <label class="ml-1 text-sm text-black flex">-</label>
                        <textarea id="inputBBNote08" class="ml-1 w-[721px] outline-none text-sm" rows="5">Pajak reklame dan perijinan (SKPD, SSPD dan Ijin Reklame) belum dapat kami berikan segera dan tidak menjadi salah satu syarat penagihan mengingat saat ini Kebijakan Penataan Reklame di Kab. Badung dan kota Denpasar masih belum ada keputusan, namun kami akan menjamin media reklame billboard tidak akan diturunkan dan kami akan segera memproses perijinan begitu sudah ada keputusan tentang Penataan Reklame di Kab. Badung dan kota Denpasar.
                                        </textarea>
                    </div>
                </div>
                <div id="billboardNote09" class="flex">
                    <input id="cbBillboardNote09" class="ml-1" type="checkbox" checked>
                    <label class="ml-1 text-sm text-black flex">-</label>
                    <input id="inputBBNote09" class="ml-2 text-sm text-black outline-none w-full" type="text"
                        value="Harga & lokasi tidak mengikat, sewaktu-waktu dapat berubah sebelum ada persetujuan tertulis">
                </div>
                <div id="billboardNote10" class="flex">
                    <input id="cbBillboardNote10" class="ml-1" type="checkbox" checked>
                    <label class="ml-1 text-sm text-black flex">-</label>
                    <input id="inputBBNote10" class="ml-2 text-sm text-black outline-none w-full font-semibold"
                        type="text"
                        value="OOH Premium milik kami tersebar di Area Lombok, Bali, Jawa Timur dan Kalimantan">
                </div>
            </div>
        </div>
        <!-- billboard note end -->

        <div class="flex justify-center">
            <div class="flex mt-2">
                <textarea class="ml-1 w-[721px] outline-none text-sm" rows="1">Demikian surat penawaran ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</textarea>
            </div>
        </div>
        <div class="flex justify-center">
            <?php
            $quotationDate = date('d F Y');
            ?>
            <div class="w-[725px] mt-2">
                <label class="ml-1 text-sm text-black flex">Denpasar, {{ $quotationDate }}</label>
            </div>
        </div>
        <div class="flex justify-center">
            <div class="w-[725px]">
                <label class="ml-1 text-sm text-black flex font-semibold">PT. Vista Media</label>
            </div>
        </div>
        <div class="flex justify-center">
            <div class="w-[725px] mt-16">
                <label id="salesUser"
                    class="ml-1 text-sm text-black flex font-semibold">{{ auth()->user()->name }}</label>
            </div>
        </div>
        <div class="flex justify-center">
            <div class="w-[725px]">
                <label id="salesPotition" class="ml-1 text-sm text-black flex">{{ auth()->user()->level }}</label>
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
    <!-- Footer end -->
</div>
<!-- Quotation Billboard Preview start -->
