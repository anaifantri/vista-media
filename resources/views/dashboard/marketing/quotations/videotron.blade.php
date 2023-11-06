<!-- Quotation Videotron Preview start -->
<div id="videotronQuotPreview" hidden>
    <div class="w-[950px] h-[1345px] border mb-10 mt-1">
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
                        <label id="quotationNumberVideotron" class="ml-1 text-sm text-black flex"></label>
                    </div>
                    <div class="flex">
                        <label class="ml-1 text-sm text-black flex w-20">Lampiran</label>
                        <label class="ml-1 text-sm text-black flex">:</label>
                        <label id="attachmentVideotron" class="ml-1 text-sm text-black flex"></label>
                    </div>
                    <div class="flex">
                        <label class="ml-1 text-sm text-black flex w-20">Perihal</label>
                        <label class="ml-1 text-sm text-black flex">:</label>
                        <label id="quotationSubjectVideotron" class="ml-1 text-sm text-black flex"></label>
                    </div>
                    <div class="flex mt-4">
                        <div>
                            <label class="ml-1 text-sm text-black flex w-20">Kepada Yth</label>
                            <label id="clientCompanyVideotron"
                                class="ml-1 text-sm text-black flex font-semibold"></label>
                            <label id="clientContactVideotron"
                                class="ml-1 text-sm text-black flex font-semibold"></label>
                            <label class="ml-1 text-sm text-black flex">Di -</label>
                            <label class="ml-6 text-sm text-black flex">Tempat</label>
                        </div>
                    </div>
                    <div class="flex mt-4">
                        <label class="ml-1 text-sm text-black flex w-20">Email</label>
                        <label class="ml-1 text-sm text-black flex">:</label>
                        <label id="contactEmailVideotron" class="ml-1 text-sm text-black flex">-</label>
                    </div>
                    <div class="flex">
                        <label class="ml-1 text-sm text-black flex w-20">No. Telp.</label>
                        <label class="ml-1 text-sm text-black flex">:</label>
                        <label id="contactPhoneVideotron" class="ml-1 text-sm text-black flex">-</label>
                    </div>
                    <div class="flex mt-4">
                        <label class="ml-1 text-sm text-black flex">Dengan hormat,</label>
                    </div>
                    <div class="flex mt-2">
                        <textarea id="letterBodyVideotron" class="ml-1 w-[721px] outline-none text-sm">Bersama ini kami menyampaikan surat penawaran penggunaan media reklame ................. area ............... dengan spesifikasi sebagai berikut :</textarea>
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <div class="w-[725px] mt-2">
                    <div class="flex border-b p-1 w-[725px]">
                        <div class="flex w-[725px] justify-end">
                            <button type="button" id="btnAddVideotron" class="flex items-center btn-disabled" disabled>
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
                </div>
            </div>
            <!-- videotron table start -->
            <div id="videotronQuotation" class="ml-2">
                <div class="flex justify-center">
                    <table id="videotronTable" class="table-auto mt-2">
                        <thead>
                            <tr>
                                <th class="text-xs text-teal-700 border w-48" rowspan="2">Deskripsi
                                </th>
                                <th class="text-xs text-teal-700 border w-[520px]" rowspan="2">
                                    Spesifikasi
                                </th>
                            </tr>
                        </thead>
                        <tbody id="videotronsTBody">
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- videotron table end -->

            <!-- videotron note start -->
            <div class="flex justify-center">
                <div id="videotronNote" class="w-[725px] mt-2">
                    <div class="flex">
                        <label class="ml-1 text-sm text-black flex w-20">Catatan</label>
                        <label class="ml-1 text-sm text-black flex">:</label>
                    </div>
                    <div class="flex">
                        <input class="ml-1" type="checkbox" checked>
                        <label class="ml-1 text-sm text-black flex">-</label>
                        <input class="ml-2 text-sm text-black outline-none w-full" type="text"
                            value="Biaya di atas belum termasuk PPN dan Desain Materi Iklan">
                    </div>
                    <div class="flex">
                        <input class="ml-1" type="checkbox" checked>
                        <label class="ml-1 text-sm text-black flex">-</label>
                        <input class="ml-2 text-sm text-black outline-none w-full" type="text"
                            value="Harga tersebut termasuk :">
                    </div>
                    <div class="flex">
                        <input class="ml-1" type="checkbox" checked>
                        <input class="ml-4 text-sm text-black outline-none w-full" type="text"
                            value="•	 Penggantian (upload / take out) materi iklan.">
                    </div>
                    <div class="flex">
                        <input class="ml-1" type="checkbox" checked>
                        <input class="ml-4 text-sm text-black outline-none w-full" type="text"
                            value="•	 Sewa Lokasi, konsumsi listrik selama kontrak, maintenance selama kontrak.">
                    </div>
                    <div class="flex">
                        <input class="ml-1" type="checkbox" checked>
                        <label class="ml-1 text-sm text-black flex">-</label>
                        <input class="ml-2 text-sm text-black outline-none w-full" type="text"
                            value="Sistem Pembayaran :" checked>
                    </div>
                    <div>
                        <div class="flex">
                            <input class="ml-1" type="checkbox" checked>
                            <input class="ml-4 text-sm text-black outline-none w-full" type="text"
                                value="• 100% Pelunasan sebelum materi iklan tayang untuk masa kontrak kurang dari 1 tahun">
                        </div>
                        <div class="flex">
                            <input class="ml-1" type="checkbox" checked>
                            <input class="ml-4 text-sm text-black outline-none w-full" type="text"
                                value="• 50% DP, 50% Pelunasan setelah BAPP untuk masa kontrak 1 tahun">
                        </div>
                    </div>
                    <div id="videotronTArea" hidden>
                        <div class="flex items-start">
                            <input class="ml-1 mt-1" type="checkbox" checked>
                            <label class="ml-1 text-sm text-black flex">-</label>
                            <textarea class="ml-1 w-[721px] outline-none text-sm" rows="5">Pajak reklame dan perijinan (SKPD, SSPD dan Ijin Reklame) belum dapat kami berikan segera dan tidak menjadi salah satu syarat penagihan mengingat saat ini Kebijakan Penataan Reklame di Kab. Badung dan kota Denpasar masih belum ada keputusan, namun kami akan menjamin media reklame billboard tidak akan diturunkan dan kami akan segera memproses perijinan begitu sudah ada keputusan tentang Penataan Reklame di Kab. Badung dan kota Denpasar.
                                        </textarea>
                        </div>
                    </div>
                    <div class="flex">
                        <input class="ml-1" type="checkbox" checked>
                        <label class="ml-1 text-sm text-black flex">-</label>
                        <input class="ml-2 text-sm text-black outline-none w-full" type="text"
                            value="Harga & lokasi tidak mengikat, sewaktu-waktu dapat berubah sebelum ada persetujuan tertulis">
                    </div>
                    <div class="flex">
                        <input class="ml-1" type="checkbox" checked>
                        <label class="ml-1 text-sm text-black flex">-</label>
                        <input class="ml-2 text-sm text-black outline-none w-full font-semibold" type="text"
                            value="OOH Premium milik kami tersebar di Area Lombok, Bali, Jawa Timur dan Kalimantan">
                    </div>
                </div>

            </div>
            <!-- videotron note end -->
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

    <!-- Header start -->
    <div class="w-[950px] h-[1345px] border mb-10 mt-1">
        <div class="h-28 mt-4">
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
    </div>
    <!-- Footer end -->

</div>
<!-- Quotation Videotron Preview start -->
