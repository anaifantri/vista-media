<form class="flex justify-center" action="/dashboard/marketing/print-instal-quotations" method="post"
    enctype="multipart/form-data">
    @csrf
    <div id="preview_modal" name="preview_modal"
        class="absolute justify-center top-0 w-full h-full bg-black bg-opacity-90 z-50 hidden">
        <div class="mt-10">
            <div class="flex w-full justify-center">
                <div class="flex w-[950px] justify-end">
                    <button class="flex justify-center items-center mx-1 btn-primary" title="Save">
                        <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                        </svg>
                        <span class="ml-2 text-white">Save</span>
                    </button>
                    <button id="btnPreviewCancel"
                        class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-danger" type="button">
                        <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.151 17.943l-4.143-4.102-4.117 4.159-1.833-1.833 4.104-4.157-4.162-4.119 1.833-1.833 4.155 4.102 4.106-4.16 1.849 1.849-4.1 4.141 4.157 4.104-1.849 1.849z" />
                        </svg>
                        <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Close</span>
                    </button>
                </div>
            </div>
            <input type="text" id="sale_id" name="sale_id" value="{{ $billboard_sale->id }}" hidden>
            <input type="text" id="billboard_id" name="billboard_id" value="{{ $billboard_sale->billboard_id }}"
                hidden>
            <input type="text" id="billboard_code" name="billboard_code"
                value="{{ $billboard_sale->billboard->code }}-{{ $billboard_sale->billboard->city->code }}" hidden>
            <input type="text" id="billboard_address" name="billboard_address"
                value="{{ $billboard_sale->billboard->address }}" hidden>
            <input type="text" id="company_id" name="company_id" value="{{ $billboard_sale->company_id }}" hidden>
            <input type="text" id="client_id" name="client_id" value="{{ $billboard_sale->client_id }}" hidden>
            <input type="text" id="contact_id" name="contact_id" value="{{ $billboard_sale->contact_id }}" hidden>
            <input type="text" id="products" name="products" hidden>
            <div class="w-[950px] h-[1345px] border mb-10 mt-2 bg-white">
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
                                <label class="ml-1 text-sm text-gray-500 flex">Auto Number</label>
                            </div>
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">Lampiran</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label class="ml-1 text-sm text-black flex">-</label>
                            </div>
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">Perihal</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label class="ml-1 text-sm text-black font-semibold flex">Penawaran
                                    Biaya Cetak dan Pasang Materi Iklan Billboard</label>
                            </div>
                            <div class="flex mt-4">
                                <div>
                                    <label class="ml-1 text-sm text-black flex w-20">Kepada Yth</label>
                                    <label
                                        class="ml-1 text-sm text-black flex font-semibold">{{ $billboard_sale->client->company }}</label>
                                    <div class="flex">
                                        <label id="clientPreviewContact"
                                            class="ml-1 text-sm text-black flex font-semibold">{{ $billboard_sale->contact->name }}</label>
                                    </div>
                                    <label class="ml-1 text-sm text-black flex">Di -</label>
                                    <label class="ml-6 text-sm text-black flex">Tempat</label>
                                </div>
                            </div>
                            <div class="flex mt-4">
                                <label class="ml-1 text-sm text-black flex w-20">Email</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label id="contactPreviewEmail"
                                    class="ml-1 text-sm text-black flex">{{ $billboard_sale->contact->email }}</label>
                            </div>
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">No. Telp.</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label id="contactPreviewPhone"
                                    class="ml-1 text-sm text-black flex">{{ $billboard_sale->contact->phone }}</label>
                            </div>
                            <div class="flex mt-4">
                                <label class="ml-1 text-sm text-black flex">Dengan hormat,</label>
                            </div>
                            <div class="flex mt-2">
                                <textarea class="ml-1 w-[721px] outline-none text-sm" readonly>Bersama ini kami menyampaikan surat penawaran biaya cetak dan pasang materi billboard dengan spesifikasi sebagai berikut :</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- quotation table start -->
                    <div class="ml-2">
                        <div class="flex justify-center">
                            <div class="w-[725px]">
                                <table id="billboardTable" class="table-fix mt-2 w-full">
                                    <thead>
                                        <tr>
                                            <th class="text-xs text-teal-700 border w-6" rowspan="2">No</th>
                                            <th class="text-xs text-teal-700 border w-16" rowspan="2">Jenis</th>
                                            <th class="text-xs text-teal-700 border" colspan="2">Lokasi</th>
                                            <th class="text-xs text-teal-700 border w-[340px]" colspan="4">
                                                Deskripsi
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="text-xs text-teal-700 border w-20">Kode</th>
                                            <th class="text-xs text-teal-700 border">Alamat</th>
                                            <th class="text-xs text-teal-700 border w-28">Bahan</th>
                                            <th class="text-xs text-teal-700 border w-10">Luas</th>
                                            <th class="text-xs text-teal-700 border w-16">Harga (Rp.)</th>
                                            <th class="text-xs text-teal-700 border w-24">Total (Rp.)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="billboardsPreviewTBody">
                                        <tr>
                                            <td class="text-xs text-teal-700 border text-center p-1">1</td>
                                            <td class="text-xs text-teal-700 border text-center p-1">Cetak</td>
                                            <td class="text-xs text-teal-700 border text-center p-1">7001 - BDG
                                            </td>
                                            <td class="text-xs text-teal-700 border p-1">Jl. Raya Uluwatu - Dekat
                                                GWK
                                            </td>
                                            <td class="text-xs text-teal-700 border text-center">
                                                <div id="printingProductPreview" class="ml-1 mt-1"></div>
                                            </td>
                                            <td id="widePrintPreview"
                                                class="text-xs text-teal-700 border text-center p-1"></td>
                                            <td id="printingPricePreview"
                                                class="text-xs text-teal-700 border text-center"></td>
                                            <td id="totalPrintPreview"
                                                class="text-xs text-teal-700 border text-right p-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-xs text-teal-700 border text-center p-1">2</td>
                                            <td class="text-xs text-teal-700 border text-center p-1">Pasang</td>
                                            <td class="text-xs text-teal-700 border text-center p-1">7001 - BDG
                                            </td>
                                            <td class="text-xs text-teal-700 border p-1">Jl. Raya Uluwatu - Dekat
                                                GWK
                                            </td>
                                            <td id="installationProductPreview"
                                                class="text-xs text-teal-700 border text-center"></td>
                                            <td id="wideInstalPreview"
                                                class="text-xs text-teal-700 border text-center p-1"></td>
                                            <td id="installPricePreview"
                                                class="text-xs text-teal-700 border text-center"></td>
                                            <td id="totalInstalPreview"
                                                class="text-xs text-teal-700 border text-right p-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-xs text-teal-700 border text-right px-2 font-semibold"
                                                colspan="7">Sub Total</td>
                                            <td id="subTotalPreview"
                                                class="text-xs text-teal-700 border text-right p-1 font-semibold"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-xs text-teal-700 border text-right px-2 font-semibold"
                                                colspan="7">PPN 11%</td>
                                            <td id="ppnValuePreview"
                                                class="text-xs text-teal-700 border text-right p-1 font-semibold">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-xs text-teal-700 border text-right px-2 font-semibold"
                                                colspan="7">Grand Total</td>
                                            <td id="grandTotalPreview"
                                                class="text-xs text-teal-700 border text-right p-1 font-semibold"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- quotation table end -->

                    <!-- quotation note start -->
                    <div class="flex justify-center">
                        <div class="w-[725px] mt-2">
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">Catatan</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                            </div>
                            <div>
                                <div class="flex">
                                    <label class="ml-1 text-sm">-</label>
                                    <textarea class="text-area-notes" rows="1" readonly>Harga di atas sudah termasuk PPN.</textarea>
                                </div>
                            </div>
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex mt-2">Sistem pembayaran :</label>
                            </div>
                            <div>
                                <div class="flex">
                                    <label class="ml-1 text-sm">-</label>
                                    <textarea class="text-area-notes" rows="1" placeholder="input catatan" readonly>100 % setelah cetak dan pemasangan</textarea>
                                </div>
                            </div>
                            {{-- <div id="notesPreview">
                            </div> --}}
                        </div>
                    </div>
                    <!-- quotation note end -->

                    <div class="flex justify-center">
                        <div class="flex mt-2">
                            <textarea class="ml-1 w-[721px] outline-none text-sm" rows="1" readonly>Demikian surat penawaran ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</textarea>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <div class="w-[725px] mt-4">
                            <?php
                            $searchDate = strtotime(request('search'));
                            $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            ?>
                            <label class="ml-1 text-sm text-black flex">Denpasar, {{ date('j') }}
                                {{ $bulan[(int) date('m')] }} {{ date('Y') }}</label>
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
                            <label id="salesPotition"
                                class="ml-1 text-sm text-black flex">{{ auth()->user()->level }}</label>
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
        </div>
    </div>
</form>
