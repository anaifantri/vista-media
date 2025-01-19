<div class="w-[800px]">
    <table class="table-auto mt-2 w-full">
        <thead id="tableTHead">
            <tr>
                <th class="text-[0.7rem] text-black border w-6" rowspan="2">No</th>
                <th class="text-[0.7rem] text-black border w-16" rowspan="2">Kode
                </th>
                <th class="text-[0.7rem] text-black border" rowspan="2">Lokasi
                </th>
                <th class="text-[0.7rem] text-black border" colspan="4">
                    Deskripsi
                </th>
                {{-- @if ($category == 'Signage')
                    <th class="text-[0.7rem] text-black border" colspan="4">
                        Deskripsi
                    </th>
                @else
                    <th class="text-[0.7rem] text-black border" colspan="3">
                        Deskripsi
                    </th>
                @endif --}}
                <th class="text-[0.7rem] text-black border" colspan="4">Harga
                    (Rp.)
                </th>
            </tr>
            <tr>
                @if ($category != 'Signage')
                    <th class="text-[0.7rem] text-black border w-10">Jenis</th>
                @endif
                @if ($category == 'Signage')
                    <th class="text-[0.7rem] text-black border w-16">Bentuk</th>
                @else
                    <th class="text-[0.7rem] text-black border w-10">BL/FL</th>
                @endif
                @if ($category == 'Signage')
                    <th class="text-[0.7rem] text-black border w-6">Qty</th>
                @endif
                <th class="text-[0.7rem] text-black border w-8">Side</th>
                <th class="text-[0.7rem] text-black border w-20">Size - V/H</th>
                <th class="border w-[64px]">
                    <div class="flex w-[64px] justify-center items-center">
                        <input id="cbBillboardTitle" name="cbBillboardTitle0" type="checkbox"
                            onclick="cbBillboardCheck(this)" checked>
                        <input id="billboardTitle"
                            class="text-[0.7rem] text-black ml-1 w-12 outline-none border border-stone-700 text-center rounded-sm bg-white"
                            type="text" value="1 Bulan" onchange="periodeTitleCheck(this)">
                    </div>
                </th>
                <th class="border w-[64px]">
                    <div class="flex w-[64px] justify-center items-center">
                        <input id="cbBillboardTitle" name="cbBillboardTitle1" type="checkbox"
                            onclick="cbBillboardCheck(this)" checked>
                        <input id="billboardTitle"
                            class="text-[0.7rem] text-black ml-1 w-12 outline-none border border-stone-700 text-center rounded-sm bg-white"
                            type="text" value="3 Bulan" onchange="periodeTitleCheck(this)">
                    </div>
                </th>
                <th class="border w-[64px]">
                    <div class="flex w-[64px] justify-center items-center">
                        <input id="cbBillboardTitle" name="cbBillboardTitle2" type="checkbox"
                            onclick="cbBillboardCheck(this)" checked>
                        <input id="billboardTitle"
                            class="text-[0.7rem] text-black ml-1 w-12 outline-none border border-stone-700 text-center rounded-sm bg-white"
                            type="text" value="6 Bulan" onchange="periodeTitleCheck(this)">
                    </div>
                </th>
                <th class="border w-20">
                    <div class="flex w-20 justify-center items-center">
                        <input id="cbBillboardTitle" name="cbBillboardTitle3" type="checkbox"
                            onclick="cbBillboardCheck(this)" checked>
                        <input id="billboardTitle"
                            class="text-[0.7rem] text-black ml-1 w-14 outline-none border border-stone-700 text-center rounded-sm bg-white"
                            type="text" value="1 Tahun" onchange="periodeTitleCheck(this)">
                    </div>
                </th>
            </tr>
        </thead>
        <tbody id="tableTBody">
            @foreach ($products as $product)
                <?php
                $description = json_decode($product->description);
                ?>
                <tr>
                    <td class="text-[0.7rem] text-black border text-center">
                        {{ $loop->iteration }}</td>
                    <td class="text-[0.7rem] text-black border text-center">
                        {{ $product->code }}-{{ $product->city_code }}</td>
                    <td class="text-[0.7rem] text-black border px-1">{{ $product->address }}</td>
                    @if ($category != 'Signage')
                        <td class="text-[0.7rem] text-black border text-center">
                            @if ($product->category == 'Billboard')
                                BB
                            @elseif($product->category == 'Bando')
                                BD
                            @elseif($product->category == 'Baliho')
                                BLH
                            @elseif($product->category == 'Midiboard')
                                MB
                            @endif
                        </td>
                    @endif
                    @if ($category == 'Signage')
                        <td class="text-[0.7rem] text-black border text-center">{{ $description->type }}</td>
                    @else
                        <td class="text-[0.7rem] text-black border text-center">
                            @if ($description->lighting == 'Backlight')
                                BL
                            @elseif ($description->lighting == 'Frontlight')
                                FL
                            @endif
                        </td>
                    @endif
                    @if ($category == 'Signage')
                        <td class="text-[0.7rem] text-black border text-center">
                            {{ $description->qty }}
                        </td>
                    @endif
                    <td class="text-[0.7rem] text-black border text-center">
                        {{ (int) filter_var($product->side, FILTER_SANITIZE_NUMBER_INT) }}
                    </td>
                    <td class="text-[0.7rem] text-black border text-center">
                        {{ $product->size }} -
                        @if ($product->orientation == 'Vertikal')
                            V
                        @elseif ($product->orientation == 'Horizontal')
                            H
                        @endif
                    </td>
                    <td class="border text-center">
                        <div class="flex w-[64px] justify-center items-center">
                            <input id="billboardPrice0" name="{{ $product->code }}"
                                class="input-on-td in-out-spin-none w-[64px]" type="number" min="0"
                                value="{{ $product->price / 10 }}" onkeyup="inputPriceChange(this)"
                                onchange="checkPrice(this)">
                        </div>
                    </td>
                    <td class="border text-center">
                        <div class="flex w-[64px] justify-center items-center">
                            <input id="billboardPrice1" name="{{ $product->code }}"
                                class="input-on-td in-out-spin-none w-[64px]" type="number" min="0"
                                value="{{ $product->price * 0.275 }}" onkeyup="inputPriceChange(this)"
                                onchange="checkPrice(this)">
                        </div>
                    </td>
                    <td class="border text-center">
                        <div class="flex w-[64px] justify-center items-center">
                            <input id="billboardPrice2" name="{{ $product->code }}"
                                class="input-on-td in-out-spin-none w-[64px]" type="number" min="0"
                                value="{{ $product->price * 0.525 }}" onkeyup="inputPriceChange(this)"
                                onchange="checkPrice(this)">
                        </div>
                    </td>
                    <td class="border text-center">
                        <div class="flex w-full justify-center items-center">
                            <input id="billboardPrice3" name="{{ $product->code }}"
                                class="input-on-td in-out-spin-none w-[72px]" type="number" min="0"
                                value="{{ $product->price }}" onkeyup="inputPriceChange(this)"
                                onchange="checkPrice(this)">
                        </div>
                    </td>
                </tr>
                @if (count($products) == 1)
                    <!-- Row include print start -->
                    <tr id="rowPrint" hidden>
                        <td class="text-[0.7rem] text-black border text-center"></td>
                        <td class="text-[0.7rem] text-black border text-center"></td>
                        <td class="text-[0.7rem] text-black border px-2" colspan="8">
                            <div class="flex">
                                <span class="w-20">Biaya Cetak</span>
                                <span class="w-[72px]">-> Bahan</span>
                                <span>:</span>
                                <select class="ml-1 outline-none border rounded-md w-[72px]" name="print_product"
                                    id="printProduct" onchange="selectProduct(this)">
                                    <option value="pilih">-- pilih --</option>
                                    @foreach ($printing_products as $printingProduct)
                                        @if ($printingProduct->type == $description->lighting)
                                            <option id="{{ $printingProduct->price }}"
                                                value="{{ $printingProduct->name }}">
                                                {{ $printingProduct->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="ml-2 w-[72px]">-> Harga/m2</span>
                                <span>:</span>
                                <input id="printPrice"
                                    class="ml-1 w-12 outline-none border rounded-md px-1 text-right" type="text"
                                    placeholder="0" onchange="inputPrintPriceChange(this)"
                                    onkeyup="inputPrintPriceCheck(this)" readonly>
                                <span class="ml-2">-> Jumlah : </span>
                                <input id="includePrintQty"
                                    class="ml-1 w-6 outline-none border rounded-md px-1 in-out-spin-none text-center"
                                    type="number" min="1" value="1"
                                    onchange="inputPrintQtyChange(this)" onkeyup="inputPrintQtyCheck(this)">
                                <span class="ml-2">-> Luas media : </span>
                                @if ($product->category == 'Signage')
                                    <input id="printWide"
                                        class="ml-1 w-8 outline-none border rounded-md px-1 in-out-spin-none text-center"
                                        type="number" min="1"
                                        value="{{ (int) $product->width * (int) $product->height * (int) $product->side * (int) $description->qty }}"
                                        readonly>
                                @else
                                    <input id="printWide"
                                        class="ml-1 w-8 outline-none border rounded-md px-1 in-out-spin-none text-center"
                                        type="number" min="1"
                                        value="{{ (int) $product->width * (int) $product->height * (int) $product->side }}"
                                        readonly>
                                @endif
                                <span class="ml-2">m2</span>
                            </div>
                        </td>
                        <td id="totalPrint" class="text-[0.7rem] text-black border text-right px-2">0</td>
                    </tr>
                    <!-- Row include print end -->

                    <!-- Row include install start -->
                    <tr id="rowInstall" hidden>
                        <td class="text-[0.7rem] text-black border text-center"></td>
                        <td class="text-[0.7rem] text-black border text-center"></td>
                        <td class="text-[0.7rem] text-black border px-2" colspan="8">
                            <div class="flex">
                                <span class="w-20">Biaya Pasang</span>
                                <span class="w-[72px]">-> Harga/m2</span>
                                <span>:</span>
                                @foreach ($installation_prices as $installationPrice)
                                    @if ($installationPrice->type == $description->lighting)
                                        <input id="installPrice"
                                            class="ml-1 w-[72px] outline-none border in-out-spin-none rounded-md px-2"
                                            type="number" min="0" value="{{ $installationPrice->price }}"
                                            onkeyup="inputInstallPriceCheck(this)"
                                            onchange="inputInstallPriceChange(this)">
                                    @endif
                                @endforeach
                                <span class="ml-2 w-[72px]">-> Jumlah</span>
                                <span>:</span>
                                <input id="includeInstallQty"
                                    class="ml-1 w-6 outline-none border rounded-md px-1 in-out-spin-none text-center"
                                    type="number" min="1" value="1"
                                    onkeyup="inputInstallQtyCheck(this)" onchange="inputInstallQtyChange(this)">
                                <span class="ml-2">-> Luas media : </span>
                                @if ($product->category == 'Signage')
                                    <input id="installWide"
                                        class="ml-1 w-8 outline-none border rounded-md px-1 in-out-spin-none text-center"
                                        type="number" min="1"
                                        value="{{ (int) $product->width * (int) $product->height * (int) $product->side * (int) $description->qty }}"
                                        readonly>
                                @else
                                    <input id="installWide"
                                        class="ml-1 w-8 outline-none border rounded-md px-1 in-out-spin-none text-center"
                                        type="number" min="1"
                                        value="{{ (int) $product->width * (int) $product->height * (int) $product->side }}"
                                        readonly>
                                @endif
                                <span class="ml-2">m2</span>
                            </div>
                        </td>
                        <td id="totalInstall" class="text-[0.7rem] text-black border text-right px-2">
                            @foreach ($installation_prices as $installationPrice)
                                @if ($installationPrice->type == $description->lighting)
                                    @if ($product->category == 'Signage')
                                        {{ $installationPrice->price * (int) $product->width * (int) $product->height * (int) $product->side * (int) $description->qty }}
                                    @else
                                        {{ $installationPrice->price * (int) $product->width * (int) $product->height * (int) $product->side }}
                                    @endif
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <!-- Row include install end -->
                @endif
            @endforeach
            <tr id="rowSubTotal" hidden>
                <td class="text-[0.7rem] text-black border text-right font-semibold px-2" colspan="10">Sub
                    Total
                </td>
                <td id="subTotal" class="text-[0.7rem] text-black border text-right font-semibold px-2"></td>
            </tr>
            @if ($category == 'Signage')
                <tr>
                    <td class="border px-2 text-right text-xs text-black font-semibold" colspan="11">
                        <div class="flex items-center justify-end">
                            <label> Include PPN..? </label>
                            <input id="ppnYes" class="ml-2" type="radio" name="ppnCheck" value="yes"
                                onclick="ppnCheckAction(this)">
                            <label class="ml-1"> Ya </label>
                            <input id="ppnNo" class="ml-2" type="radio" name="ppnCheck" value="no"
                                onclick="ppnCheckAction(this)" checked>
                            <label class="ml-1"> Tidak </label>
                        </div>
                    </td>
                </tr>
                <tr hidden>
                    <td class="text-[0.7rem] text-black border text-right font-semibold px-2" colspan="10">
                        <div class="flex items-center justify-end">
                            <label class="text-[0.7rem] text-black ml-1" for="cbPpn">PPN</label>
                            <input id="ppnValue"
                                class="text-xs text-center border rounded-md text-black outline-none in-out-spin-none w-8 px-1 ml-2"
                                type="number" min="0" max="100" value="11" onkeyup="setPpn(this)"
                                onchange="checkPpn(this)">
                            <label class="text-xs text-black ml-2"> % x DPP </label>
                            @if (count($products) > 1)
                                <input id="dppValue"
                                    class="text-right text-[0.7rem] outline-none text-black font-semibold in-out-spin-none w-20 border ml-2 pr-1"
                                    type="number" min="0" onkeyup="getDpp(this)" onclick="alertDpp()"
                                    required readonly>
                            @else
                                <input id="dppValue"
                                    class="text-right text-[0.7rem] outline-none text-black font-semibold in-out-spin-none w-20 border ml-2 pr-1"
                                    type="number" min="0" onkeyup="getDpp(this)" onchange="dppCheck(this)"
                                    required>
                            @endif
                        </div>
                    </td>
                    <td id="ppnNominal" class="text-[0.7rem] text-black border text-right font-semibold px-2"></td>
                </tr>
                <tr hidden>
                    <td class="text-[0.7rem] text-black border text-right font-semibold px-2" colspan="10">Grand
                        Total</td>
                    <td id="grandTotal" class="text-[0.7rem] text-black border text-right font-semibold px-2"></td>
                </tr>
            @else
                <tr>
                    <td class="border px-2 text-right text-xs text-black font-semibold" colspan="11">
                        <div class="flex items-center justify-end">
                            <label> Include PPN..? </label>
                            <input id="ppnYes" class="ml-2" type="radio" name="ppnCheck" value="yes"
                                onclick="ppnCheckAction(this)">
                            <label class="ml-1"> Ya </label>
                            <input id="ppnNo" class="ml-2" type="radio" name="ppnCheck" value="no"
                                onclick="ppnCheckAction(this)" checked>
                            <label class="ml-1"> Tidak </label>
                        </div>
                    </td>
                </tr>
                <tr hidden>
                    <td class="text-[0.7rem] text-black border text-right font-semibold px-2" colspan="10">
                        <div class="flex items-center justify-end">
                            <label class="text-[0.7rem] text-black ml-1" for="cbPpn">PPN</label>
                            <input id="ppnValue"
                                class="text-xs text-center border rounded-md text-black outline-none in-out-spin-none w-8 px-1 ml-2"
                                type="number" min="0" max="100" value="11" onkeyup="setPpn(this)"
                                onchange="checkPpn(this)">
                            <label class="text-xs text-black ml-2"> % x DPP </label>
                            @if (count($products) > 1)
                                <input id="dppValue"
                                    class="text-right text-[0.7rem] outline-none text-black font-semibold in-out-spin-none w-20 border ml-2 pr-1"
                                    type="number" min="0" onkeyup="getDpp(this)" onclick="alertDpp()"
                                    required readonly>
                            @else
                                <input id="dppValue"
                                    class="text-right text-[0.7rem] outline-none text-black font-semibold in-out-spin-none w-20 border ml-2 pr-1"
                                    type="number" min="0" onkeyup="getDpp(this)" onchange="dppCheck(this)"
                                    required>
                            @endif
                        </div>
                    </td>
                    <td id="ppnNominal" class="text-[0.7rem] text-black border text-right font-semibold px-2"></td>
                </tr>
                <tr hidden>
                    <td class="text-[0.7rem] text-black border text-right font-semibold px-2" colspan="10">Grand
                        Total</td>
                    <td id="grandTotal" class="text-[0.7rem] text-black border text-right font-semibold px-2"></td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
