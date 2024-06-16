<div id="quotation_modal" name="quotation_modal"
    class="absolute justify-center top-0 w-full h-full bg-black bg-opacity-90 z-20 hidden">
    <div class="mt-10">
        <div class="flex w-full justify-center">
            <div class="flex w-[950px] justify-end">
                <button id="btnPreview" class="flex justify-center items-center mx-1 btn-primary" title="Preview"
                    type="button">
                    <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M15 12c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-.199.02-.393.057-.581 1.474.541 2.927-.882 2.405-2.371.174-.03.354-.048.538-.048 1.657 0 3 1.344 3 3zm-2.985-7c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 12c-2.761 0-5-2.238-5-5 0-2.761 2.239-5 5-5 2.762 0 5 2.239 5 5 0 2.762-2.238 5-5 5z" />
                    </svg>
                    <span class="ml-2 text-white">Preview</span>
                </button>
                <button id="btnCancel" class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-danger"
                    type="button">
                    <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                    </svg>
                    <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Cancel</span>
                </button>
            </div>
        </div>
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
                            <label id="attachmentBillboard" class="ml-1 text-sm text-black flex">-</label>
                        </div>
                        <div class="flex">
                            <label class="ml-1 text-sm text-black flex w-20">Perihal</label>
                            <label class="ml-1 text-sm text-black flex">:</label>
                            <label id="subjectBillboard" class="ml-1 text-sm text-black font-semibold flex">Penawaran
                                Biaya Cetak dan Pasang Materi Iklan Billboard</label>
                        </div>
                        <div class="flex mt-4">
                            <div>
                                <label class="ml-1 text-sm text-black flex w-20">Kepada Yth</label>
                                <label id="clientCompany"
                                    class="ml-1 text-sm text-black flex font-semibold">{{ $sale->client->company }}</label>
                                <div class="flex">
                                    <label id="clientContact"
                                        class="ml-1 text-sm text-black flex font-semibold">{{ $sale->contact->name }}</label>
                                    <button id="btnChangeContact" type="button"
                                        class="flex w-max h-5 bg-teal-500 text-sm rounded-md hover:bg-teal-900 cursor-pointer ml-8 justify-center items-center text-white p-1">
                                        <svg class="fill-current w-4" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9 12l-4.463 4.969-4.537-4.969h3c0-4.97 4.03-9 9-9 2.395 0 4.565.942 6.179 2.468l-2.004 2.231c-1.081-1.05-2.553-1.699-4.175-1.699-3.309 0-6 2.691-6 6h3zm10.463-4.969l-4.463 4.969h3c0 3.309-2.691 6-6 6-1.623 0-3.094-.65-4.175-1.699l-2.004 2.231c1.613 1.526 3.784 2.468 6.179 2.468 4.97 0 9-4.03 9-9h3l-4.537-4.969z" />
                                        </svg>Ganti Kontak</button>
                                </div>
                                <label class="ml-1 text-sm text-black flex">Di -</label>
                                <label class="ml-6 text-sm text-black flex">Tempat</label>
                            </div>
                        </div>
                        <div class="flex mt-4">
                            <label class="ml-1 text-sm text-black flex w-20">Email</label>
                            <label class="ml-1 text-sm text-black flex">:</label>
                            <label id="contactEmail"
                                class="ml-1 text-sm text-black flex">{{ $sale->contact->email }}</label>
                        </div>
                        <div class="flex">
                            <label class="ml-1 text-sm text-black flex w-20">No. Telp.</label>
                            <label class="ml-1 text-sm text-black flex">:</label>
                            <label id="contactPhone"
                                class="ml-1 text-sm text-black flex">{{ $sale->contact->phone }}</label>
                        </div>
                        <div class="flex mt-4">
                            <label class="ml-1 text-sm text-black flex">Dengan hormat,</label>
                        </div>
                        <div class="flex mt-2">
                            <textarea id="bodyTop" class="ml-1 w-[721px] outline-none text-sm" readonly>Bersama ini kami menyampaikan surat penawaran biaya cetak dan pasang materi billboard dengan spesifikasi sebagai berikut :</textarea>
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
                                <tbody id="billboardsTBody">
                                    <?php
                                    $geeks = $sale->billboard->size->size;
                                    preg_match_all('!\d+!', $geeks, $matches);
                                    $wide = $matches[0][0] * $matches[0][1];
                                    $totalInstall = 0;
                                    ?>
                                    @if ($sale->free_instalation - $usedInstall == 0 && $sale->free_print - $usedPrint == 0)
                                        <tr>
                                            <input id="usedPrint" type="text" value="{{ $usedPrint }}" hidden>
                                            <input id="freePrint" type="text" value="{{ $sale->free_print }}"
                                                hidden>
                                            <input id="usedInstall" type="text" value="{{ $usedInstall }}"
                                                hidden>
                                            <input id="freeInstall" type="text"
                                                value="{{ $sale->free_instalation }}" hidden>
                                            <td class="text-xs text-teal-700 border text-center p-1">1</td>
                                            <td class="text-xs text-teal-700 border text-center p-1">Cetak</td>
                                            <td class="text-xs text-teal-700 border text-center p-1">7001 - BDG
                                            </td>
                                            <td class="text-xs text-teal-700 border p-1">Jl. Raya Uluwatu - Dekat
                                                GWK
                                            </td>
                                            <td class="text-xs text-teal-700 border text-center">
                                                <div class="ml-1 mt-1">
                                                    <input id="printing_product_name" name="printing_product_name"
                                                        type="text" value="{{ old('printing_product_name') }}"
                                                        hidden>
                                                    <select id="printing_product" name="printing_product"
                                                        class="flex w-28 text-sm font-semibold text-teal-700 border rounded-lg outline-none @error('printing_product') is-invalid @enderror"
                                                        type="text" value="{{ old('printing_product') }}"
                                                        onchange="getPrintingProduct(this)">
                                                        <option value="-pilih-">-- pilih --</option>
                                                        @foreach ($printing_products as $printing_product)
                                                            @if ($printing_product->type == $sale->billboard->lighting)
                                                                @if (old('printing_product') == $printing_product->id)
                                                                    <option
                                                                        value="{{ $printing_product->id }}-{{ $printing_product->price }}-{{ $printing_product->name }}"
                                                                        name="" selected>
                                                                        {{ $printing_product->name }}
                                                                    </option>
                                                                @else
                                                                    <option
                                                                        value="{{ $printing_product->id }}-{{ $printing_product->price }}-{{ $printing_product->name }}">
                                                                        {{ $printing_product->name }}
                                                                    </option>
                                                                @endif
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
                                            <td id="widePrint" class="text-xs text-teal-700 border text-center p-1">
                                                {{ $wide }}
                                            </td>
                                            <td class="text-xs text-teal-700 border text-center">
                                                <input class="text-xs text-teal-700 outline-none w-16 text-right"
                                                    type="number" id="printing_price" name="print_price"
                                                    min="0">
                                            </td>
                                            <td id="totalPrint" class="text-xs text-teal-700 border text-right p-1">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-xs text-teal-700 border text-center p-1">2</td>
                                            <td class="text-xs text-teal-700 border text-center p-1">Pasang</td>
                                            <td class="text-xs text-teal-700 border text-center p-1">7001 - BDG
                                            </td>
                                            <td class="text-xs text-teal-700 border p-1">Jl. Raya Uluwatu - Dekat
                                                GWK
                                            </td>
                                            <td class="text-xs text-teal-700 border text-center">
                                                <div id="installation_product" class="ml-1 mt-1">
                                                    {{ $sale->billboard->lighting }}
                                                </div>
                                            </td>
                                            <td id="wideInstal" class="text-xs text-teal-700 border text-center p-1">
                                                {{ $wide }}
                                            </td>
                                            @foreach ($installation_prices as $installation_price)
                                                @if ($installation_price->type == $sale->billboard->lighting)
                                                    <?php
                                                    $totalInstall = $installation_price->price * $wide;
                                                    ?>
                                                    <td id="installPrice"
                                                        class="text-xs text-teal-700 border text-center">
                                                        <input
                                                            class="text-xs w-16 text-teal-700 outline-none text-right"
                                                            type="number" id="instal_price" name="instal_price"
                                                            min="0" value="{{ $installation_price->price }}">
                                                    </td>
                                                @endif
                                            @endforeach
                                            <td id="totalInstal" class="text-xs text-teal-700 border text-right p-1">
                                                {{ $totalInstall }}
                                                <input class="text-xs w-16 text-teal-700 outline-none text-right"
                                                    type="number" id="total_install" name="total_install"
                                                    min="0" value="{{ $totalInstall }}" hidden>
                                            </td>
                                        </tr>
                                    @elseif ($sale->free_instalation - $usedInstall > 0 && $sale->free_print - $usedPrint == 0)
                                        <tr>
                                            <input id="usedPrint" type="text" value="{{ $usedPrint }}" hidden>
                                            <input id="freePrint" type="text" value="{{ $sale->free_print }}"
                                                hidden>
                                            <input id="usedInstall" type="text" value="{{ $usedInstall }}"
                                                hidden>
                                            <input id="freeInstall" type="text"
                                                value="{{ $sale->free_instalation }}" hidden>
                                            <td class="text-xs text-teal-700 border text-center p-1">1</td>
                                            <td class="text-xs text-teal-700 border text-center p-1">Cetak</td>
                                            <td class="text-xs text-teal-700 border text-center p-1">7001 - BDG
                                            </td>
                                            <td class="text-xs text-teal-700 border p-1">Jl. Raya Uluwatu - Dekat
                                                GWK
                                            </td>
                                            <td class="text-xs text-teal-700 border text-center">
                                                <div class="ml-1 mt-1">
                                                    <input id="printing_product_name" name="printing_product_name"
                                                        type="text" value="{{ old('printing_product_name') }}"
                                                        hidden>
                                                    <select id="printing_product" name="printing_product"
                                                        class="flex w-28 text-sm font-semibold text-teal-700 border rounded-lg outline-none @error('printing_product') is-invalid @enderror"
                                                        type="text" value="{{ old('printing_product') }}"
                                                        onchange="getPrintingProduct(this)">
                                                        <option value="-pilih-">-- pilih --</option>
                                                        @foreach ($printing_products as $printing_product)
                                                            @if ($printing_product->type == $sale->billboard->lighting)
                                                                @if (old('printing_product') == $printing_product->id)
                                                                    <option
                                                                        value="{{ $printing_product->id }}-{{ $printing_product->price }}-{{ $printing_product->name }}"
                                                                        name="" selected>
                                                                        {{ $printing_product->name }}
                                                                    </option>
                                                                @else
                                                                    <option
                                                                        value="{{ $printing_product->id }}-{{ $printing_product->price }}-{{ $printing_product->name }}">
                                                                        {{ $printing_product->name }}
                                                                    </option>
                                                                @endif
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
                                            <td id="widePrint" class="text-xs text-teal-700 border text-center p-1">
                                                {{ $wide }}
                                            </td>
                                            <td class="text-xs text-teal-700 border text-center">
                                                <input class="text-xs text-teal-700 outline-none w-16 text-right"
                                                    type="number" id="printing_price" name="print_price"
                                                    min="0">
                                            </td>
                                            <td id="totalPrint" class="text-xs text-teal-700 border text-right p-1">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-xs text-teal-700 border text-center p-1">2</td>
                                            <td class="text-xs text-teal-700 border text-center p-1">Pasang</td>
                                            <td class="text-xs text-teal-700 border text-center p-1">7001 - BDG
                                            </td>
                                            <td class="text-xs text-teal-700 border p-1">Jl. Raya Uluwatu - Dekat
                                                GWK
                                            </td>
                                            <td class="text-xs text-teal-700 border text-center">
                                                <div id="installation_product" class="ml-1 mt-1">
                                                    {{ $sale->billboard->lighting }}
                                                </div>
                                            </td>
                                            <td id="wideInstal" class="text-xs text-teal-700 border text-center p-1">
                                                {{ $wide }}
                                            </td>
                                            <td id="installPrice" class="text-xs text-teal-700 border text-center">
                                                Free
                                                <input class="text-xs w-16 text-teal-700 outline-none text-right"
                                                    type="number" id="instal_price" name="instal_price"
                                                    min="0" value="0" hidden>
                                            </td>
                                            <td id="totalInstal" class="text-xs text-teal-700 border text-right p-1">
                                                Free ke
                                                {{ $usedInstall + 1 }} dari {{ $sale->free_instalation }}
                                                <input class="text-xs w-16 text-teal-700 outline-none text-right"
                                                    type="number" id="total_install" name="total_install"
                                                    min="0" value="{{ $totalInstall }}" hidden>
                                            </td>
                                        </tr>
                                    @elseif ($sale->free_instalation - $usedInstall == 0 && $sale->free_print - $usedPrint > 0)
                                        <tr>
                                            <input id="usedPrint" type="text" value="{{ $usedPrint }}" hidden>
                                            <input id="freePrint" type="text" value="{{ $sale->free_print }}"
                                                hidden>
                                            <input id="usedInstall" type="text" value="{{ $usedInstall }}"
                                                hidden>
                                            <input id="freeInstall" type="text"
                                                value="{{ $sale->free_instalation }}" hidden>
                                            <td class="text-xs text-teal-700 border text-center p-1">1</td>
                                            <td class="text-xs text-teal-700 border text-center p-1">Cetak</td>
                                            <td class="text-xs text-teal-700 border text-center p-1">7001 - BDG
                                            </td>
                                            <td class="text-xs text-teal-700 border p-1">Jl. Raya Uluwatu - Dekat
                                                GWK
                                            </td>
                                            <td class="text-xs text-teal-700 border text-center">
                                                <div class="ml-1 mt-1">Free
                                                    <input id="printing_product_name" name="printing_product_name"
                                                        type="text" value="{{ old('printing_product_name') }}"
                                                        hidden>
                                                    <select id="printing_product" name="printing_product"
                                                        class="hidden w-28 text-sm font-semibold text-teal-700 border rounded-lg outline-none @error('printing_product') is-invalid @enderror"
                                                        type="text" value="{{ old('printing_product') }}"
                                                        onchange="getPrintingProduct(this)">
                                                        <option value="-pilih-">-- pilih --</option>
                                                        @foreach ($printing_products as $printing_product)
                                                            @if ($printing_product->type == $sale->billboard->lighting)
                                                                @if (old('printing_product') == $printing_product->id)
                                                                    <option
                                                                        value="{{ $printing_product->id }}-{{ $printing_product->price }}-{{ $printing_product->name }}"
                                                                        name="" selected>
                                                                        {{ $printing_product->name }}
                                                                    </option>
                                                                @else
                                                                    <option
                                                                        value="{{ $printing_product->id }}-{{ $printing_product->price }}-{{ $printing_product->name }}">
                                                                        {{ $printing_product->name }}
                                                                    </option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                            <td id="widePrint" class="text-xs text-teal-700 border text-center p-1">
                                                {{ $wide }}
                                            </td>
                                            <td class="text-xs text-teal-700 border text-center">Free</td>
                                            <td id="totalPrint" class="text-xs text-teal-700 border text-right p-1">
                                                Free ke
                                                {{ $usedPrint + 1 }} dari
                                                {{ $sale->free_print }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-xs text-teal-700 border text-center p-1">2</td>
                                            <td class="text-xs text-teal-700 border text-center p-1">Pasang</td>
                                            <td class="text-xs text-teal-700 border text-center p-1">7001 - BDG
                                            </td>
                                            <td class="text-xs text-teal-700 border p-1">Jl. Raya Uluwatu - Dekat
                                                GWK
                                            </td>
                                            <td class="text-xs text-teal-700 border text-center">
                                                <div id="installation_product" class="ml-1 mt-1">
                                                    {{ $sale->billboard->lighting }}
                                                </div>
                                            </td>
                                            <td id="wideInstal" class="text-xs text-teal-700 border text-center p-1">
                                                {{ $wide }}</td>
                                            @foreach ($installation_prices as $installation_price)
                                                @if ($installation_price->type == $sale->billboard->lighting)
                                                    <?php
                                                    $totalInstall = $installation_price->price * $wide;
                                                    ?>
                                                    <td id="installPrice"
                                                        class="text-xs text-teal-700 border text-center">
                                                        <input
                                                            class="text-xs w-16 text-teal-700 outline-none text-right"
                                                            type="number" id="instal_price" name="instal_price"
                                                            min="0" value="{{ $installation_price->price }}">
                                                    </td>
                                                @endif
                                            @endforeach
                                            <td id="totalInstal" class="text-xs text-teal-700 border text-right p-1">
                                                {{ $totalInstall }}
                                                <input class="text-xs w-16 text-teal-700 outline-none text-right"
                                                    type="number" id="total_install" name="total_install"
                                                    min="0" value="{{ $totalInstall }}" hidden>
                                            </td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <td class="text-xs text-teal-700 border text-right px-2 font-semibold"
                                            colspan="7">Sub
                                            Total</td>
                                        <td id="subTotal"
                                            class="text-xs text-teal-700 border text-right p-1 font-semibold">
                                            {{ $totalInstall }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-xs text-teal-700 border text-right px-2 font-semibold"
                                            colspan="7">PPN 11%</td>
                                        <td id="ppnValue"
                                            class="text-xs text-teal-700 border text-right p-1 font-semibold">
                                            {{ ($totalInstall * 11) / 100 }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-xs text-teal-700 border text-right px-2 font-semibold"
                                            colspan="7">Grand Total</td>
                                        <td id="grandTotal"
                                            class="text-xs text-teal-700 border text-right p-1 font-semibold">
                                            {{ $totalInstall + ($totalInstall * 11) / 100 }}</td>
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
                        <div id="notesQty">
                            <div class="flex">
                                <label class="ml-1 text-sm">-</label>
                                <textarea class="text-area-notes" rows="1" placeholder="input catatan">Harga di atas sudah termasuk PPN.</textarea>
                            </div>
                            <div class="flex">
                                <label class="ml-1 text-sm">-</label>
                                <textarea class="text-area-notes" rows="1" placeholder="input catatan">Sistem Pembayaran 100% setelah cetak dan pemasangan</textarea>
                            </div>
                        </div>
                        <div class="flex">
                            <button id="btnAddNote" type="button"
                                class="flex w-max h-5 bg-teal-500 text-sm rounded-md hover:bg-teal-900 cursor-pointer ml-4 justify-center items-center text-white p-1">
                                <svg class="fill-current w-4" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm-.747 9.25h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                        fill-rule="nonzero" />
                                </svg>add
                                note</button>
                            <button id="btnDelNote" type="button"
                                class="flex w-max h-5 bg-red-600 text-sm rounded-md hover:bg-red-900 cursor-pointer ml-2 justify-center items-center text-white p-1">
                                <svg class="fill-current w-4" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm4.253 9.25h-8.5c-.414 0-.75.336-.75.75s.336.75.75.75h8.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75z"
                                        fill-rule="nonzero" />
                                </svg>remove last note</button>
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
                        <textarea id="bodyEndBillboard" class="ml-1 w-[721px] outline-none text-sm" rows="1" readonly>Demikian surat penawaran ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</textarea>
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
        @include('dashboard.marketing.print-instal-quotations.change-contact')
        {{-- </form> --}}
    </div>
</div>
