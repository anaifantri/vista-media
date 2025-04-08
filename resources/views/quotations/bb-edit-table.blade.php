@php
    $cbTitle = 0;
    foreach ($price->dataTitle as $dataTitle) {
        if ($dataTitle->checkbox == true) {
            $cbTitle = $cbTitle + 1;
        }
    }
    if ($cbTitle > 2) {
        $width = 900;
    } else {
        $width = 750;
    }
    $colSpan = 0;
@endphp
<div class="w-[{{ $width }}px]">
    @if (count($products) == 1)
        <div class="flex justify-center mt-2">
            <div class="flex w-[725px]">
                @if ($notes->includedInstall->checked == true)
                    <input id="cbIncludeInstall" class="text-sm" type="checkbox" onclick="cbIncludeInstallAction(this)"
                        checked>
                @else
                    <input id="cbIncludeInstall" class="text-sm" type="checkbox" onclick="cbIncludeInstallAction(this)">
                @endif
                <label class="text-sm ml-2">Include Biaya Pasang</label>
                @if ($notes->includedPrint->checked == true)
                    <input id="cbIncludePrint" class="text-sm ml-4" type="checkbox" onclick="cbIncludePrintAction(this)"
                        checked>
                @else
                    <input id="cbIncludePrint" class="text-sm ml-4" type="checkbox"
                        onclick="cbIncludePrintAction(this)">
                @endif
                <label class="text-sm ml-2">Include Biaya Cetak</label>
            </div>
        </div>
    @endif
    <div class="flex w-full justify-end">
        <button id="btnAdd" class="flex justify-center items-center w-44 btn-primary-small ml-4" title="Chose Files"
            type="button" onclick="btnAddLocation()">
            <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"
                viewBox="0 0 24 24">
                <path
                    d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm-.747 9.25h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                    fill-rule="nonzero" />
            </svg>
            <span class="ml-2">Tambah Lokasi</span>
        </button>
    </div>
    <table class="table-auto mt-2 w-full">
        <thead>
            <tr>
                <th class="text-xs text-stone-900 border border-black w-6" rowspan="2">No
                </th>
                <th class="text-xs text-stone-900 border border-black w-16" rowspan="2">
                    Kode
                </th>
                <th class="text-xs text-stone-900 border border-black" rowspan="2">Lokasi
                </th>
                <th class="text-xs text-stone-900 border border-black" colspan="4">
                    Deskripsi
                </th>
                <th class="text-xs text-stone-900 border border-black" colspan="{{ $cbTitle }}">Harga
                    (Rp.)
                </th>
                <th class="text-xs text-stone-900 border border-black w-8" rowspan="2"></th>
            </tr>
            <tr>
                @if ($category != 'Signage')
                    <th class="text-xs text-black border border-black w-10">Jenis</th>
                @endif
                @if ($category == 'Signage')
                    <th class="text-xs text-stone-900 border border-black w-16">Bentuk</th>
                @else
                    <th class="text-xs text-stone-900 border border-black w-10">BL/FL</th>
                @endif
                @if ($category == 'Signage')
                    <th class="text-xs text-stone-900 border border-black w-6">Qty</th>
                @endif
                <th class="text-xs text-stone-900 border border-black w-8">Side</th>
                <th class="text-xs text-stone-900 border border-black w-20">Size - V/H</th>
                @foreach ($price->dataTitle as $title)
                    @if ($title->checkbox == true)
                        @php
                            $colSpan++;
                        @endphp
                        <th class="border border-black w-[72px] px-1">
                            <div class="flex w-[72px] justify-center items-center">
                                <input id="cbBillboardTitle" name="cbBillboardTitle{{ $loop->iteration - 1 }}"
                                    type="checkbox" onclick="cbBillboardCheck(this)" checked>
                                <input id="billboardTitle"
                                    class="text-xs text-stone-900 border text-center px-1 rounded-md ml-1 w-14 outline-none bg-transparent"
                                    type="text" value="{{ $title->title }}" onchange="periodeTitleCheck(this)">
                            </div>
                        </th>
                    @else
                        <th class="border border-black w-[72px] px-1" hidden>
                            <div class="flex w-[72px] justify-center items-center">
                                <input id="cbBillboardTitle" name="cbBillboardTitle{{ $loop->iteration - 1 }}"
                                    type="checkbox" onclick="cbBillboardCheck(this)">
                                <input id="billboardTitle"
                                    class="text-xs text-stone-900 border text-center px-1 rounded-md ml-1 w-14 outline-none bg-transparent"
                                    type="text" value="{{ $title->title }}" onchange="periodeTitleCheck(this)">
                            </div>
                        </th>
                    @endif
                @endforeach
            </tr>
        </thead>
        <tbody id="tableTBody">
            @php
                $subTotal = 0;
            @endphp
            @foreach ($products as $product)
                <?php
                $row = $loop->iteration - 1;
                $description = json_decode($product->description);
                ?>
                <tr>
                    <td class="text-xs text-stone-900 border border-black text-center">
                        {{ $loop->iteration }}</td>
                    <td class="text-xs text-stone-900 border border-black text-center">
                        {{ $product->code }}-{{ $product->city_code }}</td>
                    <td class="text-xs text-stone-900 border border-black">
                        {{ $product->address }}
                    </td>
                    @if ($category != 'Signage')
                        <td class="text-xs text-black border border-black text-center">
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
                        <td class="text-xs text-stone-900 border border-black text-center">
                            {{ $description->type }}</td>
                    @else
                        <td class="text-xs text-stone-900 border border-black text-center">
                            @if ($description->lighting == 'Backlight')
                                BL
                            @elseif ($description->lighting == 'Frontlight')
                                FL
                            @endif
                        </td>
                    @endif
                    @if ($category == 'Signage')
                        <td class="text-xs text-stone-900 border border-black text-center">
                            {{ $description->qty }}
                        </td>
                    @endif
                    <td class="text-xs text-stone-900 border border-black text-center">
                        {{ (int) filter_var($product->side, FILTER_SANITIZE_NUMBER_INT) }}
                    </td>
                    <td class="text-xs text-stone-900 border border-black text-center">
                        {{ $product->size }} -
                        @if ($product->orientation == 'Vertikal')
                            V
                        @elseif ($product->orientation == 'Horizontal')
                            H
                        @endif
                    </td>
                    @foreach ($price->dataPrice as $priceValue)
                        @if ($price->dataTitle[$loop->iteration - 1]->checkbox == true)
                            @php
                                $subTotal = $subTotal + $priceValue[$row]->price;
                            @endphp
                            <td class="text-xs text-stone-900 border border-black text-center">
                                <div class="flex justify-center items-center">
                                    <input id="billboardPrice{{ $loop->iteration - 1 }}" name="{{ $product->code }}"
                                        class="text-center outline-none in-out-spin-none w-full border rounded-md"
                                        type="number" min="0" value="{{ $priceValue[$row]->price }}"
                                        onkeyup="inputPriceChange(this)" onchange="checkPrice(this)">
                                </div>
                            </td>
                        @else
                            <td class="text-xs text-stone-900 border border-black text-center" hidden>
                                <div class="flex justify-center items-center">
                                    <input id="billboardPrice{{ $loop->iteration - 1 }}" name="{{ $product->code }}"
                                        class="text-center outline-none in-out-spin-none w-full border rounded-md"
                                        type="number" min="0" value="{{ $priceValue[$row]->price }}"
                                        onkeyup="inputPriceChange(this)" onchange="checkPrice(this)">
                                </div>
                            </td>
                        @endif
                    @endforeach
                    <td class="text-xs text-stone-900 border border-black">
                        <div class="flex w-full justify-center border">
                            <button type="button" id="{{ $loop->iteration - 1 }}" name="{{ $product->id }}"
                                class="flex bg-red-600 text-xs rounded-md hover:bg-red-900 cursor-pointer justify-center items-center text-white p-1 h-4"
                                onclick="removeLocation(this)">
                                <svg class="fill-current w-3" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.151 17.943l-4.143-4.102-4.117 4.159-1.833-1.833 4.104-4.157-4.162-4.119 1.833-1.833 4.155 4.102 4.106-4.16 1.849 1.849-4.1 4.141 4.157 4.104-1.849 1.849z" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @if (count($products) == 1)
                    <!-- Row include print start -->
                    @if ($notes->includedPrint->checked == true)
                        <tr id="rowPrint">
                            <td class="text-xs text-black border border-black text-center"></td>
                            <td class="text-xs text-black border border-black px-2" colspan="{{ $colSpan + 5 }}">
                                <div class="flex">
                                    <span class="w-20">Biaya Cetak</span>
                                    <span class="w-[72px]">-> Bahan</span>
                                    <span>:</span>
                                    <select class="ml-1 outline-none border rounded-md w-[72px]" name="print_product"
                                        id="printProduct" onchange="selectProduct(this)">
                                        <option value="pilih">-- pilih --</option>
                                        @foreach ($printing_products as $printingProduct)
                                            @if ($printingProduct->type == $description->lighting)
                                                @if ($printingProduct->name == $notes->includedPrint->product)
                                                    <option id="{{ $printingProduct->price }}"
                                                        value="{{ $printingProduct->name }}" selected>
                                                        {{ $printingProduct->name }}
                                                    </option>
                                                @else
                                                    <option id="{{ $printingProduct->price }}"
                                                        value="{{ $printingProduct->name }}">
                                                        {{ $printingProduct->name }}
                                                    </option>
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="ml-2 w-[72px]">-> Harga/m2</span>
                                    <span>:</span>
                                    <input id="printPrice"
                                        class="ml-1 w-12 outline-none border rounded-md px-1 text-right"
                                        type="text" placeholder="0" onchange="inputPrintPriceChange(this)"
                                        value="{{ $notes->includedPrint->price }}"
                                        onkeyup="inputPrintPriceCheck(this)" readonly>
                                    <span class="ml-2">-> Jumlah : </span>
                                    <input id="includePrintQty"
                                        class="ml-1 w-6 outline-none border rounded-md px-1 in-out-spin-none text-center"
                                        type="number" min="1" value="{{ $notes->includedPrint->qty }}"
                                        onchange="inputPrintQtyChange(this)" onkeyup="inputPrintQtyCheck(this)">
                                    <span class="ml-2">-> Luas media : </span>
                                    @if ($product->category == 'Signage')
                                        @php
                                            $wide =
                                                (int) $product->width *
                                                (int) $product->height *
                                                (int) $product->side *
                                                (int) $description->qty;
                                        @endphp
                                        <input id="printWide"
                                            class="ml-1 w-8 outline-none border rounded-md px-1 in-out-spin-none text-center"
                                            type="number" min="1" value="{{ $wide }}" readonly>
                                    @else
                                        @php
                                            $wide =
                                                (int) $product->width * (int) $product->height * (int) $product->side;
                                        @endphp
                                        <input id="printWide"
                                            class="ml-1 w-8 outline-none border rounded-md px-1 in-out-spin-none text-center"
                                            type="number" min="1" value="{{ $wide }}" readonly>
                                    @endif
                                    <span class="ml-2">m2</span>
                                </div>
                            </td>
                            <td id="totalPrint" class="text-xs text-black border border-black text-right px-2">
                                @php
                                    $totalPrint = $notes->includedPrint->price * $notes->includedPrint->qty * $wide;
                                @endphp
                                {{ $totalPrint }}
                            </td>
                            <td class="text-xs text-black border border-black text-right font-semibold px-2">
                            </td>
                        </tr>
                    @else
                        @php
                            $totalPrint = 0;
                        @endphp
                        <tr id="rowPrint" hidden>
                            <td class="text-xs text-black border border-black text-center"></td>
                            <td class="text-xs text-black border border-black px-2" colspan="{{ $colSpan + 5 }}">
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
                                        class="ml-1 w-12 outline-none border rounded-md px-1 text-right"
                                        type="text" placeholder="0" onchange="inputPrintPriceChange(this)"
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
                            <td id="totalPrint" class="text-xs text-black border border-black text-right px-2">0
                            </td>
                            <td class="text-xs text-black border border-black text-right font-semibold px-2">
                            </td>
                        </tr>
                    @endif
                    <!-- Row include print end -->

                    <!-- Row include install start -->
                    @if ($notes->includedInstall->checked == true)
                        <tr id="rowInstall" hidden>
                            <td class="text-xs text-black border border-black text-center"></td>
                            <td class="text-xs text-black border border-black px-2" colspan="{{ $colSpan + 5 }}">
                                <div class="flex">
                                    <span class="w-20">Biaya Pasang</span>
                                    <span class="w-[72px]">-> Harga/m2</span>
                                    <span>:</span>
                                    <input id="installPrice"
                                        class="ml-1 w-[72px] outline-none border in-out-spin-none rounded-md px-2"
                                        type="number" min="0" value="{{ $notes->includedInstall->price }}"
                                        onkeyup="inputInstallPriceCheck(this)"
                                        onchange="inputInstallPriceChange(this)">
                                    <span class="ml-2 w-[72px]">-> Jumlah</span>
                                    <span>:</span>
                                    <input id="includeInstallQty"
                                        class="ml-1 w-6 outline-none border rounded-md px-1 in-out-spin-none text-center"
                                        type="number" min="1" value="{{ $notes->includedInstall->qty }}"
                                        onkeyup="inputInstallQtyCheck(this)" onchange="inputInstallQtyChange(this)">
                                    <span class="ml-2">-> Luas media : </span>
                                    @if ($product->category == 'Signage')
                                        <input id="installWide"
                                            class="ml-1 w-8 outline-none border rounded-md px-1 in-out-spin-none text-center"
                                            type="number" min="1" value="{{ $wide }}" readonly>
                                    @else
                                        <input id="installWide"
                                            class="ml-1 w-8 outline-none border rounded-md px-1 in-out-spin-none text-center"
                                            type="number" min="1" value="{{ $wide }}" readonly>
                                    @endif
                                    <span class="ml-2">m2</span>
                                </div>
                            </td>
                            <td id="totalInstall" class="text-xs text-black border border-black text-right px-2">
                                @php
                                    $totalInstall = $notes->includedInstall->price * $wide;
                                @endphp
                                {{ $totalInstall }}
                            </td>
                            <td class="text-xs text-black border border-black text-right font-semibold px-2">
                            </td>
                        </tr>
                    @else
                        @php
                            $totalInstall = 0;
                        @endphp
                        <tr id="rowInstall" hidden>
                            <td class="text-xs text-black border border-black text-center"></td>
                            <td class="text-xs text-black border border-black px-2" colspan="{{ $colSpan + 5 }}">
                                <div class="flex">
                                    <span class="w-20">Biaya Pasang</span>
                                    <span class="w-[72px]">-> Harga/m2</span>
                                    <span>:</span>
                                    @foreach ($installation_prices as $installationPrice)
                                        @if ($installationPrice->type == $description->lighting)
                                            <input id="installPrice"
                                                class="ml-1 w-[72px] outline-none border in-out-spin-none rounded-md px-2"
                                                type="number" min="0"
                                                value="{{ $installationPrice->price }}"
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
                            <td id="totalInstall" class="text-xs text-black border border-black text-right px-2">
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
                            <td class="text-xs text-black border border-black text-right font-semibold px-2">
                            </td>
                        </tr>
                    @endif
                    <!-- Row include install end -->
                @endif
            @endforeach
            @if ($notes->includedInstall->checked == true || $notes->includedPrint->checked == true)
                <tr id="rowSubTotal">
                    <td class="text-xs text-black border border-black text-right font-semibold px-2"
                        colspan="{{ $colSpan + 6 }}">
                        Sub
                        Total
                    </td>
                    <td id="subTotal" class="text-xs text-black border border-black text-right font-semibold px-2">
                        {{ $subTotal + $totalPrint + $totalInstall }}
                    </td>
                    <td class="text-xs text-black border border-black text-right font-semibold px-2">
                    </td>
                </tr>
            @else
                <tr id="rowSubTotal" hidden>
                    <td class="text-xs text-black border border-black text-right font-semibold px-2"
                        colspan="{{ $colSpan + 6 }}">
                        Sub
                        Total
                    </td>
                    <td id="subTotal" class="text-xs text-black border border-black text-right font-semibold px-2">
                    </td>
                    <td class="text-xs text-black border border-black text-right font-semibold px-2">
                    </td>
                </tr>
            @endif
            @if ($category == 'Signage')
                @if ($price->objPpn->checked == true)
                    <tr>
                        <td class="border border-black px-2 text-right text-sm text-black font-semibold"
                            colspan="{{ $colSpan + 7 }}">
                            <div class="flex items-center justify-end">
                                <label> Include PPN..? </label>
                                <input id="ppnYes" class="ml-2" type="radio" name="ppnCheck" value="yes"
                                    onclick="ppnCheckAction(this)" checked>
                                <label class="ml-1"> Ya </label>
                                <input id="ppnNo" class="ml-2" type="radio" name="ppnCheck" value="no"
                                    onclick="ppnCheckAction(this)">
                                <label class="ml-1"> Tidak </label>
                            </div>
                        </td>
                        <td class="border border-black"></td>
                    </tr>
                    <tr>
                        <td class="text-xs text-black border border-black text-right font-semibold px-2"
                            colspan="{{ $colSpan + 6 }}">
                            <div class="flex items-center justify-end">
                                <label class="text-xs text-black ml-1" for="cbPpn">PPN</label>
                                <input id="ppnValue"
                                    class="text-sm text-center border border-black rounded-sm text-black outline-none in-out-spin-none w-8 px-1 ml-2"
                                    type="number" min="0" max="100"
                                    value="{{ $price->objPpn->value }}" onkeyup="setPpn(this)"
                                    onchange="checkPpn(this)">
                                <label class="text-sm text-black ml-2"> % x DPP </label>
                                @if (count($products) > 1)
                                    <input id="dppValue" value="{{ $price->objPpn->dpp }}"
                                        class="text-right text-xs outline-none text-black font-semibold in-out-spin-none w-20 border rounded-sm border-black ml-2 pr-1"
                                        type="number" min="0" onkeyup="getDpp(this)" onclick="alertDpp()"
                                        readonly required>
                                @else
                                    <input id="dppValue" value="{{ $price->objPpn->dpp }}"
                                        class="text-right text-xs outline-none text-black font-semibold in-out-spin-none w-20 border rounded-sm border-black ml-2 pr-1"
                                        type="number" min="0" onkeyup="getDpp(this)"
                                        onchange="dppCheck(this)" required>
                                @endif
                            </div>
                        </td>
                        <td id="ppnNominal"
                            class="text-xs text-black border border-black text-right font-semibold px-2">
                            {{ ($price->objPpn->value / 100) * $price->objPpn->dpp }}
                        </td>
                        <td class="border border-black"></td>
                    </tr>
                    <tr>
                        <td class="text-xs text-black border border-black text-right font-semibold px-2"
                            colspan="{{ $colSpan + 6 }}">Grand
                            Total</td>
                        <td id="grandTotal"
                            class="text-xs text-black border border-black text-right font-semibold px-2">
                            {{ $subTotal + ($price->objPpn->value / 100) * $price->objPpn->dpp }}
                        </td>
                        <td class="border border-black"></td>
                    </tr>
                @else
                    <tr>
                        <td class="border border-black px-2 text-right text-sm text-black font-semibold"
                            colspan="{{ $colSpan + 7 }}">
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
                        <td class="border border-black"></td>
                    </tr>
                    <tr hidden>
                        <td class="text-xs text-black border border-black text-right font-semibold px-2"
                            colspan="{{ $colSpan + 6 }}">
                            <div class="flex items-center justify-end">
                                <label class="text-xs text-black ml-1" for="cbPpn">PPN</label>
                                <input id="ppnValue"
                                    class="text-sm text-center border border-black rounded-sm text-black outline-none in-out-spin-none w-8 px-1 ml-2"
                                    type="number" min="0" max="100" value="11"
                                    onkeyup="setPpn(this)" onchange="checkPpn(this)">
                                <label class="text-sm text-black ml-2"> % x DPP </label>
                                @if (count($products) > 1)
                                    <input id="dppValue"
                                        class="text-right text-xs outline-none text-black font-semibold in-out-spin-none w-20 border  rounded-sm border-black ml-2 pr-1"
                                        type="number" min="0" onkeyup="getDpp(this)" onclick="alertDpp()"
                                        readonly required>
                                @else
                                    <input id="dppValue"
                                        class="text-right text-xs outline-none text-black font-semibold in-out-spin-none w-20 border  rounded-sm border-black ml-2 pr-1"
                                        type="number" min="0" onkeyup="getDpp(this)"
                                        onchange="dppCheck(this)" required>
                                @endif
                            </div>
                        </td>
                        <td id="ppnNominal"
                            class="text-xs text-black border border-black text-right font-semibold px-2">
                        </td>
                        <td class="border border-black"></td>
                    </tr>
                    <tr hidden>
                        <td class="text-xs text-black border border-black text-right font-semibold px-2"
                            colspan="{{ $colSpan + 6 }}">Grand
                            Total</td>
                        <td id="grandTotal"
                            class="text-xs text-black border border-black text-right font-semibold px-2">
                        </td>
                        <td class="border border-black"></td>
                    </tr>
                @endif
            @else
                @if ($price->objPpn->checked == true)
                    <tr>
                        <td class="border border-black px-2 text-right text-sm text-black font-semibold"
                            colspan="{{ $colSpan + 7 }}">
                            <div class="flex items-center justify-end">
                                <label> Include PPN..? </label>
                                <input id="ppnYes" class="ml-2" type="radio" name="ppnCheck" value="yes"
                                    onclick="ppnCheckAction(this)" checked>
                                <label class="ml-1"> Ya </label>
                                <input id="ppnNo" class="ml-2" type="radio" name="ppnCheck" value="no"
                                    onclick="ppnCheckAction(this)">
                                <label class="ml-1"> Tidak </label>
                            </div>
                        </td>
                        <td class="border border-black"></td>
                    </tr>
                    <tr>
                        <td class="text-xs text-black border border-black text-right font-semibold px-2"
                            colspan="{{ $colSpan + 6 }}">
                            <div class="flex items-center justify-end">
                                <label class="text-xs text-black ml-1" for="cbPpn">PPN</label>
                                <input id="ppnValue"
                                    class="text-sm text-center border border-black rounded-sm text-black outline-none in-out-spin-none w-8 px-1 ml-2"
                                    type="number" min="0" max="100"
                                    value="{{ $price->objPpn->value }}" onkeyup="setPpn(this)"
                                    onchange="checkPpn(this)">
                                <label class="text-sm text-black ml-2"> % x DPP </label>
                                @if (count($products) > 1)
                                    <input id="dppValue" value="{{ $price->objPpn->dpp }}"
                                        class="text-right text-xs outline-none text-black font-semibold in-out-spin-none w-20 border rounded-sm border-black ml-2 pr-1"
                                        type="number" min="0" onkeyup="getDpp(this)"
                                        onclick="alertDpp(this)" onchange="dppCheck(this)" required readonly>
                                @else
                                    <input id="dppValue" value="{{ $price->objPpn->dpp }}"
                                        class="text-right text-xs outline-none text-black font-semibold in-out-spin-none w-20 border rounded-sm border-black ml-2 pr-1"
                                        type="number" min="0" onkeyup="getDpp(this)"
                                        onchange="dppCheck(this)" required>
                                @endif
                            </div>
                        </td>
                        <td id="ppnNominal"
                            class="text-xs text-black border border-black text-right font-semibold px-2">
                            {{ ($price->objPpn->value / 100) * $price->objPpn->dpp }}
                        </td>
                        <td class="border border-black"></td>
                    </tr>
                    <tr>
                        <td class="text-xs text-black border border-black text-right font-semibold px-2"
                            colspan="{{ $colSpan + 6 }}">Grand
                            Total</td>
                        <td id="grandTotal"
                            class="text-xs text-black border border-black text-right font-semibold px-2">
                            {{ $subTotal + ($price->objPpn->value / 100) * $price->objPpn->dpp }}
                        </td>
                        <td class="border border-black"></td>
                    </tr>
                @else
                    <tr>
                        <td class="border border-black px-2 text-right text-sm text-black font-semibold"
                            colspan="{{ $colSpan + 7 }}">
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
                        <td class="border border-black"></td>
                    </tr>
                    <tr hidden>
                        <td class="text-xs text-black border border-black text-right font-semibold px-2"
                            colspan="{{ $colSpan + 6 }}">
                            <div class="flex items-center justify-end">
                                <label class="text-xs text-black ml-1" for="cbPpn">PPN</label>
                                <input id="ppnValue"
                                    class="text-sm text-center border border-black rounded-sm text-black outline-none in-out-spin-none w-8 px-1 ml-2"
                                    type="number" min="0" max="100" value="11"
                                    onkeyup="setPpn(this)" onchange="checkPpn(this)">
                                <label class="text-sm text-black ml-2"> % x DPP </label>
                                @if (count($products) > 1)
                                    <input id="dppValue"
                                        class="text-right text-xs outline-none text-black font-semibold in-out-spin-none w-20 border  rounded-sm border-black ml-2 pr-1"
                                        type="number" min="0" onkeyup="getDpp(this)"
                                        onclick="alertDpp(this)" onchange="dppCheck(this)" required readonly>
                                @else
                                    <input id="dppValue"
                                        class="text-right text-xs outline-none text-black font-semibold in-out-spin-none w-20 border  rounded-sm border-black ml-2 pr-1"
                                        type="number" min="0" onkeyup="getDpp(this)"
                                        onchange="dppCheck(this)" required>
                                @endif
                            </div>
                        </td>
                        <td id="ppnNominal"
                            class="text-xs text-black border border-black text-right font-semibold px-2">
                        </td>
                        <td class="border border-black"></td>
                    </tr>
                    <tr hidden>
                        <td class="text-xs text-black border border-black text-right font-semibold px-2"
                            colspan="{{ $colSpan + 6 }}">Grand
                            Total</td>
                        <td id="grandTotal"
                            class="text-xs text-black border border-black text-right font-semibold px-2">
                        </td>
                        <td class="border border-black"></td>
                    </tr>
                @endif
            @endif
        </tbody>
    </table>
</div>
