@extends('dashboard.layouts.main');

@section('container')
    <!-- Form Create New Quotatin start -->
    <div class="mt-10">
        <div class="flex w-full justify-center">
            <div id="divButton" class="flex w-[950px] justify-end">
                <button id="btnPreview" class="flex justify-center items-center mx-1 btn-primary" title="Preview"
                    type="button">
                    <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24">
                        <path
                            d="M15 12c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-.199.02-.393.057-.581 1.474.541 2.927-.882 2.405-2.371.174-.03.354-.048.538-.048 1.657 0 3 1.344 3 3zm-2.985-7c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 12c-2.761 0-5-2.238-5-5 0-2.761 2.239-5 5-5 2.762 0 5 2.239 5 5 0 2.762-2.238 5-5 5z" />
                    </svg>
                    <span class="ml-2 text-white">Preview</span>
                </button>
                <a class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-danger"
                    href="/dashboard/marketing/print-instal-quotations">
                    <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                    </svg>
                    <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Cancel</span>
                </a>
            </div>
        </div>
        <form id="formCreate" name="formCreate" class="flex justify-center"
            action="/dashboard/marketing/print-instal-quotations" method="post" enctype="multipart/form-data">
            @csrf
            <div id="pdfPreview" class="w-[950px] h-[1345px] border mb-10 mt-2">
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
                                <input class="ml-1 text-sm text-black flex @error('number') is-invalid @enderror"
                                    type="text" id="number" name="number" value="{{ old('number') }}" readonly>
                                @error('number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">Lampiran</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label id="attachmentBillboard" class="ml-1 text-sm text-black flex">-</label>
                                @error('attachment')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">Perihal</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label id="subjectBillboard" class="ml-1 text-sm text-black font-semibold flex">Penawaran
                                    Biaya Cetak dan Pasang Materi Iklan Billboard</label>
                                @error('subject')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- <div class="flex">
                                <div class="ml-1 mt-1">
                                    <input id="inputClient" name="inputClient" type="text"
                                        value="{{ old('inputClient') }}" hidden>
                                    <label class="text-sm text-teal-700">Klien</label>
                                    <select id="client_id" name="client_id"
                                        class="flex w-36 text-sm font-semibold text-teal-700 border rounded-lg p-1 outline-none @error('client_id') is-invalid @enderror"
                                        type="text" value="{{ old('client_id') }}" onchange="getClient(this)">
                                        <option value="Pilih Klien">Pilih Klien</option>
                                        @foreach ($clients as $client)
                                            @if (old('client_id') == $client->id)
                                                <option value="{{ $client->id }}" selected>
                                                    {{ $client->company }}
                                                </option>
                                            @else
                                                <option value="{{ $client->id }}">
                                                    {{ $client->company }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('client_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="ml-4 mt-1">
                                    <input id="inputContact" name="inputContact" type="text"
                                        value="{{ old('inputContact') }}" hidden>
                                    <input id="inputEmail" name="inputEmail" type="text" value="{{ old('inputEmail') }}"
                                        hidden>
                                    <input id="inputPhone" name="inputPhone" type="text" value="{{ old('inputPhone') }}"
                                        hidden>
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Kontak</label>
                                    <select id="contact_id" name="contact_id"
                                        class="flex text-sm font-semibold text-teal-700 w-36 border rounded-lg p-1 outline-teal-300 @error('contact_id') is-invalid @enderror"
                                        type="text" value="{{ old('contact_id') }}" onchange="getContact(this)">
                                    </select>
                                    @error('contact_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div> --}}
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
                            {{-- <div class="mt-4">
                                <input type="checkbox" id="print" name="print" value="print">
                                <label class="text-sm font-semibold text-teal-700" for="print"> Cetak</label>
                                <input type="checkbox" id="install" name="install" value="install">
                                <label class="text-sm font-semibold text-teal-700" for="install"> Pasang</label>
                            </div> --}}
                            <div class="flex mt-4">
                                <label class="ml-1 text-sm text-black flex">Dengan hormat,</label>
                            </div>
                            <div class="flex mt-2">
                                <textarea id="bodyTop" class="ml-1 w-[721px] outline-none text-sm">Bersama ini kami menyampaikan surat penawaran biaya ........ materi billboard dengan spesifikasi sebagai berikut :</textarea>
                                @error('body_top')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- quotation table start -->
                    <div id="billboardQuotation" class="ml-2">
                        <div class="flex justify-center">
                            <div id="billboardTableWidth" class="w-[725px]">
                                <table id="billboardTable" class="table-fix mt-2 w-full">
                                    <thead>
                                        <tr>
                                            <th class="text-xs text-teal-700 border w-6" rowspan="2">No</th>
                                            <th class="text-xs text-teal-700 border w-16" rowspan="2">Jenis</th>
                                            <th class="text-xs text-teal-700 border" colspan="2">Lokasi</th>
                                            <th class="text-xs text-teal-700 border w-80" colspan="4">Deskripsi
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="text-xs text-teal-700 border w-20">Kode</th>
                                            <th class="text-xs text-teal-700 border">Alamat</th>
                                            <th class="text-xs text-teal-700 border w-28">Bahan</th>
                                            <th class="text-xs text-teal-700 border w-8">Luas</th>
                                            <th class="text-xs text-teal-700 border w-16">Harga (Rp.)</th>
                                            <th class="text-xs text-teal-700 border w-20">Total (Rp.)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="billboardsTBody">
                                        <tr>
                                            <td class="text-xs text-teal-700 border text-center p-1">1</td>
                                            <td class="text-xs text-teal-700 border text-center p-1">Cetak</td>
                                            <td class="text-xs text-teal-700 border text-center p-1">7001 - BDG</td>
                                            <td class="text-xs text-teal-700 border p-1">Jl. Raya Uluwatu - Dekat GWK</td>
                                            <td class="text-xs text-teal-700 border text-center">
                                                <div class="ml-1 mt-1">
                                                    <input id="printing_product_id" name="printing_product_id"
                                                        type="text" value="{{ old('printing_product_id') }}" hidden>
                                                    <select id="printing_product" name="printing_product"
                                                        class="flex w-28 text-sm font-semibold text-teal-700 border rounded-lg outline-none @error('printing_product') is-invalid @enderror"
                                                        type="text" value="{{ old('printing_product') }}"
                                                        onchange="getPrintingProduct(this)">
                                                        <option value="-pilih-">-- pilih --</option>
                                                        @foreach ($printing_products as $printing_product)
                                                            @if (old('printing_product') == $printing_product->id)
                                                                <option
                                                                    value="{{ $printing_product->id }}-{{ $printing_product->price }}"
                                                                    name="" selected>
                                                                    {{ $printing_product->name }}
                                                                </option>
                                                            @else
                                                                <option
                                                                    value="{{ $printing_product->id }}-{{ $printing_product->price }}">
                                                                    {{ $printing_product->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('printing_product')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td id="widePrint" class="text-xs text-teal-700 border text-center p-1">32
                                            </td>
                                            <td class="text-xs text-teal-700 border text-center">
                                                <input class="text-xs text-teal-700 outline-none w-16 text-right"
                                                    type="number" id="printing_price" name="print_price"
                                                    min="0">
                                            </td>
                                            <td id="totalPrint" class="text-xs text-teal-700 border text-right p-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-xs text-teal-700 border text-center p-1">2</td>
                                            <td class="text-xs text-teal-700 border text-center p-1">Pasang</td>
                                            <td class="text-xs text-teal-700 border text-center p-1">7001 - BDG</td>
                                            <td class="text-xs text-teal-700 border p-1">Jl. Raya Uluwatu - Dekat GWK</td>
                                            <td class="text-xs text-teal-700 border text-center">
                                                <div class="ml-1 mt-1">
                                                    <input id="installation_price_id" name="installation_price_id"
                                                        type="text" value="{{ old('installation_price_id') }}" hidden>
                                                    <select id="installation_price" name="installation_price"
                                                        class="flex w-28 text-sm font-semibold text-teal-700 border rounded-lg outline-none @error('installation_price') is-invalid @enderror"
                                                        type="text" value="{{ old('installation_price') }}"
                                                        onchange="getInstallationPrice(this)">
                                                        <option value="-pilih-">-- pilih --</option>
                                                        @foreach ($installation_prices as $installation_price)
                                                            @if (old('installation_price') == $installation_price->id)
                                                                <option
                                                                    value="{{ $installation_price->id }}-{{ $installation_price->price }}"
                                                                    selected>
                                                                    {{ $installation_price->type }}
                                                                </option>
                                                            @else
                                                                <option
                                                                    value="{{ $installation_price->id }}-{{ $installation_price->price }}">
                                                                    {{ $installation_price->type }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('installation_price')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td id="wideInstal" class="text-xs text-teal-700 border text-center p-1">32
                                            </td>
                                            <td class="text-xs text-teal-700 border text-center">
                                                <input class="text-xs w-16 text-teal-700 outline-none text-right"
                                                    type="number" id="instal_price" name="instal_price" min="0">
                                            </td>
                                            <td id="totalInstal" class="text-xs text-teal-700 border text-right p-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-xs text-teal-700 border text-right px-2 font-semibold"
                                                colspan="7">Sub
                                                Total</td>
                                            <td id="subTotal"
                                                class="text-xs text-teal-700 border text-right p-1 font-semibold"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-xs text-teal-700 border text-right px-2 font-semibold"
                                                colspan="7">PPN 11%</td>
                                            <td id="ppnValue"
                                                class="text-xs text-teal-700 border text-right p-1 font-semibold"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-xs text-teal-700 border text-right px-2 font-semibold"
                                                colspan="7">Grand Total</td>
                                            <td id="grandTotal"
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
                        <div id="billboardNote" class="w-[725px] mt-2">
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">Catatan</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                            </div>
                            <div id="billboardNote-1" class="flex">
                                <input id="cbBillboardNote-1" class="ml-1" type="checkbox" checked>
                                <label class="ml-1 text-sm text-black flex">-</label>
                                <input id="inputBBNote-1" class="ml-2 text-sm text-black outline-none w-full"
                                    type="text" value="Harga di atas sudah termasuk PPN.">
                            </div>
                            <div id="billboardNote-6" class="flex">
                                <input id="cbBillboardNote-6" class="ml-1" type="checkbox" checked>
                                <label class="ml-1 text-sm text-black flex">-</label>
                                <input id="inputBBNote-6" class="ml-2 text-sm text-black outline-none w-full"
                                    type="text" value="Sistem Pembayaran 100% setelah cetak dan pemasangan">
                            </div>
                            <div class="flex">
                                <button id="btnAddNotes" type="button"
                                    class="flex w-max h-5 bg-teal-500 text-sm rounded-md hover:bg-teal-900 cursor-pointer ml-8 justify-center items-center text-white p-1">
                                    <svg class="fill-current w-4" clip-rule="evenodd" fill-rule="evenodd"
                                        stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm-.747 9.25h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                            fill-rule="nonzero" />
                                    </svg>add
                                    notes</button>
                                <button id="btnDelNotes" type="button"
                                    class="flex w-max h-5 bg-red-600 text-sm rounded-md hover:bg-red-900 cursor-pointer ml-2 justify-center items-center text-white p-1">
                                    <svg class="fill-current w-4" clip-rule="evenodd" fill-rule="evenodd"
                                        stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm4.253 9.25h-8.5c-.414 0-.75.336-.75.75s.336.75.75.75h8.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75z"
                                            fill-rule="nonzero" />
                                    </svg>remove last notes</button>
                            </div>
                        </div>
                        @error('note')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <!-- quotation note end -->

                    <div class="flex justify-center">
                        <div class="flex mt-2">
                            <textarea id="bodyEndBillboard" class="ml-1 w-[721px] outline-none text-sm" rows="1">Demikian surat penawaran ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</textarea>
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
        </form>
    </div>
    <!-- Form Create New Quotatin end -->

    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>
    <!-- Script end -->

    <script>
        const printingProduct = document.getElementById("printing_product");
        const printingPrice = document.getElementById("printing_price");
        const printingProductId = document.getElementById("printing_product_id");
        const installationPrice = document.getElementById("installation_price");
        const instalPrice = document.getElementById("instal_price");
        const installationPriceId = document.getElementById("installation_price_id");
        const widePrint = document.getElementById("widePrint");
        const wideInstal = document.getElementById("wideInstal");
        const totalInstal = document.getElementById("totalInstal");
        const totalPrint = document.getElementById("totalPrint");
        const subTotal = document.getElementById("subTotal");
        const ppnValue = document.getElementById("ppnValue");
        const grandTotal = document.getElementById("grandTotal");

        // Get Printing Product --> start
        function getPrintingProduct(sel) {
            var valuePriceArray = sel.value.split("-");
            var printId = valuePriceArray[0];
            var printPrice = valuePriceArray[1];

            printingPrice.value = Number(printPrice);
            printingProductId.value = printId;

            totalPrint.innerHTML = Number(printPrice) * Number(widePrint.innerHTML);
            subTotal.innerHTML = Number(totalPrint.innerHTML) + Number(totalInstal.innerHTML);
            ppnValue.innerHTML = Number(subTotal.innerHTML) * 11 / 100;
            grandTotal.innerHTML = Number(subTotal.innerHTML) + Number(ppnValue.innerHTML);
        }
        // Get Printing Product --> end

        // Get Installtion Price --> start
        function getInstallationPrice(sel) {
            var valueInstalArray = sel.value.split("-");
            var instalId = valueInstalArray[0];
            var installPrice = valueInstalArray[1];

            instalPrice.value = Number(installPrice);
            installationPriceId.value = instalId;

            totalInstal.innerHTML = Number(installPrice) * Number(wideInstal.innerHTML);
            subTotal.innerHTML = Number(totalPrint.innerHTML) + Number(totalInstal.innerHTML);
            ppnValue.innerHTML = Number(subTotal.innerHTML) * 11 / 100;
            grandTotal.innerHTML = Number(subTotal.innerHTML) + Number(ppnValue.innerHTML);
        }
        // Get Installtion Price --> end

        // const contactId = document.getElementById("contact_id");
        // const clientId = document.getElementById("client_id");
        // const clientCompany = document.getElementById("clientCompany");
        // const clientContact = document.getElementById("clientContact");
        // const contactPhone = document.getElementById("contactPhone");
        // const contactEmail = document.getElementById("contactEmail");
        // const inputClient = document.getElementById("inputClient");
        // const inputContact = document.getElementById("inputContact");
        // const inputEmail = document.getElementById("inputEmail");
        // const inputPhone = document.getElementById("inputPhone");
        // const bodyTop = document.getElementById("bodyTop");
        // const print = document.getElementById("print");
        // const install = document.getElementById("install");
        // let objContact = {};
        // let dataContact = [];

        // Get Data Contact --> start
        // getDataContact();

        // function getDataContact() {
        //     const xhrContact = new XMLHttpRequest();
        //     const methodContact = "GET";
        //     const urlContact = "/showContact";

        //     xhrContact.open(methodContact, urlContact, true);
        //     xhrContact.send();

        //     xhrContact.onreadystatechange = () => {
        //         // In local files, status is 0 upon success in Mozilla Firefox
        //         if (xhrContact.readyState === XMLHttpRequest.DONE) {
        //             const status = xhrContact.status;
        //             if (status === 0 || (status >= 200 && status < 400)) {
        //                 objContact = JSON.parse(xhrContact.responseText);
        //                 dataContact = objContact.dataContact;
        //                 showContact();
        //             } else {
        //                 // Oh no! There has been an error with the request!
        //             }
        //         }
        //     }
        // }
        // // Get Data Contact --> end

        // // Get Client --> start
        // function getClient(sel) {
        //     clientCompany.innerHTML = sel.options[sel.selectedIndex].text;
        //     inputClient.value = sel.options[sel.selectedIndex].text;

        //     showContact();

        // }
        // // Get Client --> end

        // // Show Contact --> start
        // function showContact() {
        //     const optionContact = [];
        //     optionContact[0] = document.createElement('option');
        //     optionContact[0].appendChild(document.createTextNode(['Pilih Kontak']));
        //     contactId.appendChild(optionContact[0]);

        //     if (inputContact.value != '' && inputContact.value != 'Pilih Kontak') {
        //         while (contactId.hasChildNodes()) {
        //             contactId.removeChild(contactId.firstChild);
        //         }
        //         optionContact[0] = document.createElement('option');
        //         optionContact[0].appendChild(document.createTextNode(['Pilih Kontak']));
        //         contactId.appendChild(optionContact[0]);

        //         for (i = 0; i < dataContact.length; i++) {
        //             if (dataContact[i]['client_id'] == clientId.value) {
        //                 optionContact[i + 1] = document.createElement('option');
        //                 optionContact[i + 1].appendChild(document.createTextNode(dataContact[i][
        //                     'name'
        //                 ]));
        //                 if (inputContact.value == dataContact[i]['name']) {
        //                     optionContact[i + 1].setAttribute('selected', 'selected');
        //                 }
        //                 optionContact[i + 1].setAttribute('value', dataContact[i]['id']);
        //                 contactId.appendChild(optionContact[i + 1]);
        //             }
        //         }
        //     } else {
        //         while (contactId.hasChildNodes()) {
        //             contactId.removeChild(contactId.firstChild);
        //         }
        //         optionContact[0] = document.createElement('option');
        //         optionContact[0].appendChild(document.createTextNode(['Pilih Kontak']));
        //         contactId.appendChild(optionContact[0]);

        //         for (i = 0; i < dataContact.length; i++) {
        //             if (dataContact[i]['client_id'] == clientId.value) {
        //                 optionContact[i + 1] = document.createElement('option');
        //                 optionContact[i + 1].appendChild(document.createTextNode(dataContact[i][
        //                     'name'
        //                 ]));
        //                 optionContact[i + 1].setAttribute('value', dataContact[i]['id']);
        //                 contactId.appendChild(optionContact[i + 1]);
        //             }
        //         }
        //     }
        // }

        // Get Contact --> start
        // function getContact(sel) {
        //     for (i = 0; i < dataContact.length; i++) {
        //         if (dataContact[i]['name'] == sel.options[sel.selectedIndex].text) {
        //             if (dataContact[i]['gender'] == 'Laki-Laki') {
        //                 clientContact.innerHTML = 'UP. Bapak ' + sel.options[sel.selectedIndex].text;
        //             } else if (dataContact[i]['gender'] == 'Perempuan') {
        //                 clientContact.innerHTML = 'UP. Ibu ' + sel.options[sel.selectedIndex].text;
        //             }
        //             contactEmail.innerHTML = dataContact[i]['email'];
        //             contactPhone.innerHTML = dataContact[i]['phone'];
        //             inputEmail.value = contactEmail.innerHTML;
        //             inputPhone.value = contactPhone.innerHTML;

        //         }
        //     }
        //     inputContact.value = sel.options[sel.selectedIndex].text;
        // }
        // Get Contact --> end

        // Option print & install action --> start
        // print.addEventListener('click', function() {
        //     if (print.checked == true) {
        //         if (install.checked == true) {
        //             bodyTop.value =
        //                 'Bersama ini kami menyampaikan surat penawaran biaya cetak dan pasang materi billboard dengan spesifikasi sebagai berikut :';
        //         } else {
        //             bodyTop.value =
        //                 'Bersama ini kami menyampaikan surat penawaran biaya cetak materi billboard dengan spesifikasi sebagai berikut :';
        //         }
        //     } else {
        //         if (install.checked == true) {
        //             bodyTop.value =
        //                 'Bersama ini kami menyampaikan surat penawaran biaya pasang materi billboard dengan spesifikasi sebagai berikut :';
        //         } else {
        //             bodyTop.value =
        //                 'Bersama ini kami menyampaikan surat penawaran biaya ....... materi billboard dengan spesifikasi sebagai berikut :';
        //         }
        //     }
        // })

        // install.addEventListener('click', function() {
        //     if (install.checked == true) {
        //         if (print.checked == true) {
        //             bodyTop.value =
        //                 'Bersama ini kami menyampaikan surat penawaran biaya cetak dan pasang materi billboard dengan spesifikasi sebagai berikut :';
        //         } else {
        //             bodyTop.value =
        //                 'Bersama ini kami menyampaikan surat penawaran biaya pasang materi billboard dengan spesifikasi sebagai berikut :';
        //         }
        //     } else {
        //         if (print.checked == true) {
        //             bodyTop.value =
        //                 'Bersama ini kami menyampaikan surat penawaran biaya cetak materi billboard dengan spesifikasi sebagai berikut :';
        //         } else {
        //             bodyTop.value =
        //                 'Bersama ini kami menyampaikan surat penawaran biaya ....... materi billboard dengan spesifikasi sebagai berikut :';
        //         }
        //     }
        // })
        // Option print & install action --> start
    </script>
@endsection
