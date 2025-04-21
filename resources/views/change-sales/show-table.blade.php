@if ($category == 'Service')
    <div class="w-full">
        <div class="flex items-center w-full py-2">
            <label class="text-sm text-black">Opsi penawaran :</label>
            @if ($price->objServiceType->print == true)
                <input class="outline-none ml-2" type="checkbox" id="cbPrint" checked onclick="cbPrintAction(this)">
            @else
                <input class="outline-none ml-2" type="checkbox" id="cbPrint" onclick="cbPrintAction(this)">
            @endif
            <label class="text-sm text-black ml-1">Cetak</label>
            @if ($price->objServiceType->install == true)
                <input class="outline-none ml-2" type="checkbox" id="cbInstall" checked onclick="cbInstallAction(this)">
            @else
                <input class="outline-none ml-2" type="checkbox" id="cbInstall" onclick="cbInstallAction(this)">
            @endif
            <label class="text-sm text-black ml-1">Pasang</label>
        </div>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="text-sm text-black border border-black w-[500px]" rowspan="2">Lokasi
                    </th>
                    <th class="text-sm text-black border border-black" colspan="6">Deskripsi</th>
                </tr>
                <tr>
                    <th class="text-sm text-black border border-black w-16">Jenis</th>
                    <th class="text-sm text-black border border-black w-28">Bahan</th>
                    <th class="text-sm text-black border border-black w-8">side</th>
                    <th class="text-sm text-black border border-black w-10">L (m2)</th>
                    <th class="text-sm text-black border border-black w-14">Harga</th>
                    <th class="text-sm text-black border border-black w-16">Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $subTotal = 0;
                @endphp
                @foreach ($price->objPrints as $print)
                    @if ($print->code == $product->code || $price->objInstalls[$loop->iteration - 1]->code == $product->code)
                        <tr>
                            <td class="text-sm text-black border border-black px-2" rowspan="2">
                                <div class="flex">
                                    <label class="w-10">Kode</label>
                                    <label class="ml-2">: {{ $product->code }} -
                                        {{ $product->city_code }}</label>
                                </div>
                                <div class="flex">
                                    <label class="w-10">Lokasi</label>
                                    <label class="ml-2">: {{ $product->address }}</label>
                                </div>
                                <div class="flex items-center">
                                    <label class="w-10">Ukuran</label>
                                    <label class="ml-2">: {{ $product->size }} x {{ $product->side }} -
                                        @if ($product->orientation == 'Vertikal')
                                            V
                                        @elseif ($product->orientation == 'Horizontal')
                                            H
                                        @endif
                                    </label>
                                    @if ($product->side == '2 Sisi')
                                        @if ($quotationPrice->objSideView->left == true && $quotationPrice->objSideView->right == true)
                                            <input class="outline-none ml-4" type="checkbox" value="left"
                                                id="cbSide" onclick="cbSideAction(this)" checked>
                                            <label class="text-sm text-black ml-1">Sisi Kiri</label>
                                            <input class="outline-none ml-4" type="checkbox" value="right"
                                                id="cbSide" onclick="cbSideAction(this)" checked>
                                            <label class="text-sm text-black ml-1">Sisi Kanan</label>
                                        @elseif ($quotationPrice->objSideView->left == true)
                                            <input class="outline-none ml-4" type="checkbox" value="left"
                                                id="cbSide" onclick="cbSideAction(this)" checked>
                                            <label class="text-sm text-black ml-1">Sisi Kiri</label>
                                            <input class="outline-none ml-4" type="checkbox" value="right"
                                                id="cbSide" onclick="cbSideAction(this)">
                                            <label class="text-sm text-black ml-1">Sisi Kanan</label>
                                        @elseif ($quotationPrice->objSideView->right == true)
                                            <input class="outline-none ml-4" type="checkbox" value="left"
                                                id="cbSide" onclick="cbSideAction(this)">
                                            <label class="text-sm text-black ml-1">Sisi Kiri</label>
                                            <input class="outline-none ml-4" type="checkbox" value="right"
                                                id="cbSide" onclick="cbSideAction(this)" checked>
                                            <label class="text-sm text-black ml-1">Sisi Kanan</label>
                                        @endif
                                    @else
                                        <label class="text-sm text-black ml-4"></label>
                                    @endif
                                </div>
                                <div class="flex">
                                    <label class="w-12 font-bold">Catatan</label>
                                    <label class="ml-2 font-bold">: </label>
                                    <input id="serviceNotes" type="text" value="{{ $quotationPrice->serviceNote }}"
                                        class="ml-1 border rounded-md w-full outline-none px-1 font-semibold"
                                        onchange="getNote(this)">
                                </div>
                            </td>
                            @php
                                $totalPrint = $quotationPrice->objPrint->price * $quotationPrice->objSideView->wide;
                                $totalInstall = $quotationPrice->objInstall->price * $quotationPrice->objSideView->wide;
                                $subTotal = $subTotal + $totalInstall + $totalPrint;
                                $servicePpn = ($price->objServicePpn->value / 100) * $subTotal;
                            @endphp
                            <td class="text-sm text-black border border-black px-1 text-center">Cetak</td>
                            <td class="text-sm text-black border border-black text-center">
                                @if ($price->objServiceType->print == true)
                                    <select id="printProduct"
                                        class="flex px-2 text-sm text-black border rounded-md outline-none w-full"
                                        value="{{ $quotationPrice->objPrint->printProduct }}"
                                        onchange="selectPrintProductAction(this)">
                                        <option value="pilih">Pilih Bahan</option>
                                        @foreach ($printing_products as $printingProduct)
                                            @if ($printingProduct->type == $description->lighting)
                                                @if ($printingProduct->name == $quotationPrice->objPrint->printProduct)
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
                                @else
                                    <select id="printProduct"
                                        class="flex px-2 text-sm text-black border rounded-md outline-none w-full"
                                        onchange="selectPrintProductAction(this)" disabled>
                                        <option value="pilih">Pilih Bahan</option>
                                        @foreach ($printing_products as $printingProduct)
                                            @if ($printingProduct->type == $description->lighting)
                                                <option id="{{ $printingProduct->price }}"
                                                    value="{{ $printingProduct->name }}">
                                                    {{ $printingProduct->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                @endif
                            </td>
                            <td id="productSide" class="text-sm text-black border border-black text-center px-1"
                                rowspan="2">
                                {{ $quotationPrice->objSideView->side }}
                            </td>
                            <td id="productWide" class="text-sm text-black border border-black text-center"
                                rowspan="2">
                                {{ $quotationPrice->objSideView->wide }}
                            </td>
                            <td class="text-sm text-black border border-black text-center px-1">
                                @if ($price->objServiceType->print == true)
                                    <input id="printPrice"
                                        class="flex px-1 text-sm text-black w-full text-right border rounded-md outline-none in-out-spin-none"
                                        type="number" min="0" value="{{ $quotationPrice->objPrint->price }}"
                                        onchange="printPriceChanged(this)">
                                @else
                                    <input id="printPrice"
                                        class="flex px-1 text-sm text-black w-full text-right border rounded-md outline-none in-out-spin-none"
                                        type="number" min="0" value="{{ $quotationPrice->objPrint->price }}"
                                        onchange="printPriceChanged(this)" disabled>
                                @endif
                            </td>
                            <td id="printTotal" class="text-sm text-black border border-black text-right px-2">
                                {{ number_format($totalPrint) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-sm text-black border border-black px-1 text-center">Pasang</td>
                            <td class="text-sm text-black border border-black text-center">
                                @if ($price->objServiceType->install == true)
                                    <select id="installProduct"
                                        class="flex px-2 text-sm text-black border rounded-md outline-none w-full"
                                        value="{{ $quotationPrice->objPrint->printProduct }}"
                                        onchange="selectInstallProductAction(this)">
                                        <option value="pilih">Pilih Bahan</option>
                                        @foreach ($installation_price as $installationPrice)
                                            @if ($installationPrice->type == $quotationPrice->objInstall->type)
                                                <option id="{{ $installationPrice->price }}"
                                                    value="{{ $installationPrice->type }}" selected>
                                                    {{ $installationPrice->type }}
                                                </option>
                                            @else
                                                <option id="{{ $installationPrice->price }}"
                                                    value="{{ $installationPrice->type }}">
                                                    {{ $installationPrice->type }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                @else
                                    <select id="installProduct"
                                        class="flex px-2 text-sm text-black border rounded-md outline-none w-full"
                                        value="{{ $quotationPrice->objPrint->printProduct }}"
                                        onchange="selectInstallProductAction(this)">
                                        <option value="pilih">Pilih Bahan</option>
                                        @foreach ($installation_price as $installationPrice)
                                            <option id="{{ $installationPrice->price }}"
                                                value="{{ $installationPrice->type }}">
                                                {{ $installationPrice->type }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif
                            </td>
                            <td class="text-sm text-black border border-black text-center px-1">
                                @if ($price->objServiceType->install == true)
                                    <input id="installPrice"
                                        class="flex px-1 text-sm text-black w-full text-right border rounded-md outline-none in-out-spin-none"
                                        type="number" min="0"
                                        value="{{ $quotationPrice->objInstall->price }}"
                                        onchange="installPriceChanged(this)">
                                @else
                                    <input id="installPrice"
                                        class="flex px-1 text-sm text-black w-full text-right border rounded-md outline-none in-out-spin-none"
                                        type="number" min="0"
                                        value="{{ $quotationPrice->objInstall->price }}"
                                        onchange="installPriceChanged(this)" disabled>
                                @endif
                            </td>
                            <td id="installTotal" class="text-sm text-black border border-black text-right px-2">
                                {{ number_format($totalInstall) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-sm text-black border border-black text-right font-semibold px-2"
                                colspan="6">
                                Sub Total
                            </td>
                            <td id="tdSubTotal"
                                class="text-sm text-black border border-black text-right font-semibold px-2">
                                {{ number_format($subTotal) }}</td>
                        </tr>
                        <tr>
                            <td class="text-sm text-black border border-black text-right font-semibold px-2"
                                colspan="6">PPN
                                <input
                                    class="text-sm text-center border rounded-md text-black outline-none in-out-spin-none w-8 px-1 ml-2"
                                    type="number" min="0" max="100" value="{{ $sale->ppn }}"
                                    onchange="setPpn(this)" hidden>
                            </td>
                            <td id="tdPpn"
                                class="text-sm text-black border border-black text-right font-semibold px-2">
                                {{ number_format($servicePpn) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-sm text-black border border-black text-right font-semibold px-2"
                                colspan="6">
                                Grand Total
                            </td>
                            <td id="tdGrandTotal"
                                class="text-sm text-black border border-black text-right font-semibold px-2">
                                {{ number_format($subTotal + $servicePpn) }}
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@else
    @php
        $totalPrint = 0;
        $totalInstall = 0;
    @endphp
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="text-sm text-black border border-black w-20" rowspan="2">
                    Kode
                </th>
                <th class="text-sm text-black border border-black" rowspan="2">Lokasi
                </th>
                @if ($category == 'Signage')
                    <th class="text-sm text-black border border-black" colspan="5">Deskripsi</th>
                @else
                    <th class="text-sm text-black border border-black" colspan="4">Deskripsi</th>
                @endif
                <th class="text-sm text-black border border-black w-24">Harga (Rp.)</th>
            </tr>
            <tr>
                <th class="text-sm text-black border border-black w-10" rowspan="2">Jenis</th>
                @if ($category == 'Signage')
                    <th class="text-sm text-black border border-black w-16" rowspan="2">Bentuk
                    </th>
                @else
                    <th class="text-sm text-black border border-black w-10" rowspan="2">BL/FL
                    </th>
                @endif
                @if ($category == 'Signage')
                    <th class="text-sm text-black border border-black w-6" rowspan="2">Qty</th>
                @endif
                <th class="text-sm text-black border border-black w-8" rowspan="2">Side</th>
                <th class="text-sm text-black border border-black w-32">Size - V/H</th>
                <th class="text-sm text-black border border-black w-24">
                    <input name="duration"
                        class="text-[0.7rem] text-black w-full outline-none border border-stone-700 text-center rounded-sm bg-white"
                        type="text" value="{{ $quotationPrice->title }}" onchange="durationChangeAction(this)">
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-sm text-black border border-black text-center">
                    {{ $product->code }}-{{ $product->city_code }}</td>
                <td class="text-sm text-black border border-black px-2">
                    {{ $product->address }}
                </td>
                <td class="text-sm text-black border border-black text-center">
                    @if ($product->category == 'Billboard')
                        BB
                    @elseif($product->category == 'Videotron')
                        VT
                    @elseif($product->category == 'Signage')
                        SN
                    @elseif($product->category == 'Bando')
                        BD
                    @elseif($product->category == 'Baliho')
                        BLH
                    @elseif($product->category == 'Midiboard')
                        MB
                    @endif
                </td>
                @if ($category == 'Signage')
                    <td class="text-sm text-black border border-black text-center">
                        {{ $description->type }}</td>
                @else
                    @if ($category == 'Videotron')
                        <td class="text-sm text-black border border-black text-center">-</td>
                    @else
                        <td class="text-sm text-black border border-black text-center">
                            @if ($description->lighting == 'Backlight')
                                BL
                            @elseif ($description->lighting == 'Frontlight')
                                FL
                            @endif
                        </td>
                    @endif
                @endif
                @if ($category == 'Signage')
                    <td class="text-sm text-black border border-black text-center">
                        {{ $description->qty }}
                    </td>
                @endif
                <td class="text-sm text-black border border-black text-center">
                    {{ (int) filter_var($product->side, FILTER_SANITIZE_NUMBER_INT) }}
                </td>
                <td class="text-sm text-black border border-black text-center">
                    {{ $product->size }} -
                    @if ($product->orientation == 'Vertikal')
                        V
                    @elseif ($product->orientation == 'Horizontal')
                        H
                    @endif
                </td>
                <td class="text-sm  text-black border border-black text-right">
                    @if ($category != 'Videotron' || ($category == 'Signage' && $description->type != 'Videotron'))
                        <input id="inputMediaPrice" onchange="mediaPriceChange(this)"
                            class="flex px-1 text-sm text-black w-full text-right border rounded-md outline-none in-out-spin-none"
                            type="number" min="0" value="{{ $quotationPrice->price }}">
                    @else
                        <input id="inputMediaPrice" onchange="videotronPriceChange(this)"
                            class="flex px-1 text-sm text-black w-full text-right border rounded-md outline-none in-out-spin-none"
                            type="number" min="0" value="{{ $quotationPrice->price }}">
                    @endif
                </td>
            </tr>
            @if ($category != 'Videotron' || ($category == 'Signage' && $description->type != 'Videotron'))
                @php
                    if ($category == 'Signage') {
                        $colSpan = 7;
                    } else {
                        $colSpan = 6;
                    }
                @endphp
                @if (isset($notes->includedPrint) && $notes->includedPrint->checked == true)
                    <!-- Row include print start -->
                    <tr>
                        <td class="text-sm text-black border border-black px-2" colspan="{{ $colSpan }}">
                            <div class="flex">
                                <span class="w-20">Biaya Cetak</span>
                                <span>-> Bahan</span>
                                <span class="ml-2">:</span>
                                <select class="ml-1 px-2 outline-none border rounded-md w-36" name="print_product"
                                    id="printProduct" onchange="selectPrintProduct(this)">
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
                                {{-- <span class="ml-2">{{ $notes->includedPrint->product }}</span> --}}
                                <span class="ml-4">-> Harga/m2</span>
                                <span class="ml-2">:</span>
                                <input id="printPrice" value="{{ $notes->includedPrint->price }}"
                                    class="ml-1 w-16 outline-none border rounded-md px-1 text-right" type="text"
                                    placeholder="0" onchange="printPriceChange(this)">
                                <span class="ml-4">-> Jumlah : </span>
                                <input id="inputPrintQty"
                                    class="ml-1 w-8 outline-none border rounded-md px-1 in-out-spin-none text-center"
                                    type="number" min="1" value="{{ $notes->includedPrint->qty }}"
                                    onchange="printQtyChange(this)">
                                <span class="ml-4">-> Luas media </span>
                                <span class="ml-2">:</span>
                                <span class="ml-2">{{ $wide }}</span>
                                <span class="ml-2">m2</span>
                            </div>
                        </td>
                        <td id="totalPrint" class="text-sm text-black border border-black text-right">
                            @php
                                $totalPrint = $notes->includedPrint->price * $notes->includedPrint->qty * $wide;
                            @endphp
                            <input id="inputPrintTotal"
                                class="flex px-1 text-sm text-black w-full text-right bg-stone-200 outline-none in-out-spin-none"
                                type="number" min="0" value="{{ $totalPrint }}" readonly>
                        </td>
                    </tr>
                    <!-- Row include print end -->
                @else
                    <!-- Row include print start -->
                    <tr>
                        <td class="text-sm text-black border border-black px-2" colspan="{{ $colSpan }}">
                            <div class="flex">
                                <span class="w-20">Biaya Cetak</span>
                                <span>-> Bahan</span>
                                <span class="ml-2">:</span>
                                <select class="ml-1 px-2 outline-none border rounded-md w-36" name="print_product"
                                    id="printProduct" onchange="selectPrintProduct(this)" disabled>
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
                                <span class="ml-4">-> Harga/m2</span>
                                <span class="ml-2">:</span>
                                <input id="printPrice" value="0"
                                    class="ml-1 w-16 outline-none border rounded-md px-1 text-right" type="text"
                                    placeholder="0" onchange="printPriceChange(this)" disabled>
                                <span class="ml-4">-> Jumlah : </span>
                                <input id="inputPrintQty"
                                    class="ml-1 w-8 outline-none border rounded-md px-1 in-out-spin-none text-center"
                                    type="number" min="1" value="1" onchange="printQtyChange(this)"
                                    disabled>
                                <span class="ml-4">-> Luas media </span>
                                <span class="ml-2">:</span>
                                <span class="ml-2">{{ $wide }}</span>
                                <span class="ml-2">m2</span>
                            </div>
                        </td>
                        <td id="totalPrint" class="text-sm text-black border border-black text-right">
                            @php
                                $totalPrint = 0;
                            @endphp
                            <input id="inputPrintTotal"
                                class="flex px-1 text-sm text-black w-full text-right bg-stone-200 outline-none in-out-spin-none"
                                type="number" min="0" value="{{ $totalPrint }}" readonly>
                        </td>
                    </tr>
                    <!-- Row include print end -->
                @endif
                @if (isset($notes->includedInstall) && $notes->includedInstall->checked == true)
                    <!-- Row include print start -->
                    <tr>
                        <td class="text-sm text-black border border-black px-2" colspan="{{ $colSpan }}">
                            <div class="flex">
                                <span class="w-20">Biaya Pasang</span>
                                <span>-> Bahan</span>
                                <span class="ml-2">:</span>
                                <select id="installProduct"
                                    class="flex ml-1 px-2 text-sm text-black border rounded-md outline-none w-36"
                                    value="{{ $description->lighting }}" onchange="selectInstallProduct(this)">
                                    <option value="pilih">-- pilih --</option>
                                    @foreach ($installation_price as $installationPrice)
                                        @if ($installationPrice->type == $description->lighting)
                                            <option id="{{ $installationPrice->price }}"
                                                value="{{ $installationPrice->type }}" selected>
                                                {{ $installationPrice->type }}
                                            </option>
                                        @else
                                            <option id="{{ $installationPrice->price }}"
                                                value="{{ $installationPrice->type }}">
                                                {{ $installationPrice->type }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="ml-4">-> Harga/m2</span>
                                <span class="ml-2">:</span>
                                <input id="installPrice" onchange="installPriceChange(this)"
                                    class="ml-1 w-16 outline-none border in-out-spin-none rounded-md px-1 text-right"
                                    type="number" min="0" value="{{ $notes->includedInstall->price }}">
                                <span class="ml-4">-> Jumlah : </span>
                                <input id="inputInstallQty"
                                    class="ml-1 w-8 outline-none border rounded-md px-1 in-out-spin-none text-center"
                                    type="number" min="1" value="{{ $notes->includedInstall->qty }}"
                                    onchange="installQtyChange(this)">
                                <span class="ml-4">-> Luas media </span>
                                <span class="ml-2">:</span>
                                <span class="ml-2">{{ $wide }}</span>
                                <span class="ml-2">m2</span>
                            </div>
                        </td>
                        <td id="totalInstall" class="text-sm text-black border border-black text-right">
                            @php
                                $totalInstall = $notes->includedInstall->price * $notes->includedInstall->qty * $wide;
                            @endphp
                            <input id="inputInstallTotal"
                                class="flex px-1 text-sm text-black w-full text-right bg-stone-200 outline-none in-out-spin-none"
                                type="number" min="0" value="{{ $totalInstall }}" readonly>
                        </td>
                    </tr>
                    <!-- Row include print end -->
                @else
                    <!-- Row include print start -->
                    <tr>
                        <td class="text-sm text-black border border-black px-2" colspan="{{ $colSpan }}">
                            <div class="flex">
                                <span class="w-20">Biaya Pasang</span>
                                <span>-> Bahan</span>
                                <span class="ml-2">:</span>
                                <select id="installProduct"
                                    class="flex ml-1 px-2 text-sm text-black border rounded-md outline-none w-36"
                                    value="{{ $description->lighting }}" onchange="selectInstallProduct(this)"
                                    disabled>
                                    <option value="pilih">-- pilih --</option>
                                    @foreach ($installation_price as $installationPrice)
                                        <option id="{{ $installationPrice->price }}"
                                            value="{{ $installationPrice->type }}">
                                            {{ $installationPrice->type }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="ml-4">-> Harga/m2</span>
                                <span class="ml-2">:</span>
                                <input id="installPrice" onchange="installPriceChange(this)"
                                    class="ml-1 w-16 outline-none border in-out-spin-none rounded-md px-1 text-right"
                                    type="number" min="0" value="0" disabled>
                                <span class="ml-4">-> Jumlah : </span>
                                <input id="inputInstallQty"
                                    class="ml-1 w-8 outline-none border rounded-md px-1 in-out-spin-none text-center"
                                    type="number" min="1" value="1" onchange="installQtyChange(this)"
                                    disabled>
                                <span class="ml-4">-> Luas media </span>
                                <span class="ml-2">:</span>
                                <span class="ml-2">{{ $wide }}</span>
                                <span class="ml-2">m2</span>
                            </div>
                        </td>
                        <td id="totalInstall" class="text-sm text-black border border-black text-right">
                            @php
                                $totalInstall = 0;
                            @endphp
                            <input id="inputInstallTotal"
                                class="flex px-1 text-sm text-black w-full text-right bg-stone-200 outline-none in-out-spin-none"
                                type="number" min="0" value="{{ $totalInstall }}" readonly>
                        </td>
                    </tr>
                    <!-- Row include print end -->
                @endif
            @endif
            @if ($category == 'Signage')
                @php
                    $colSpan = 7;
                @endphp
            @else
                @php
                    $colSpan = 6;
                @endphp
            @endif
            <tr>
                <td class="border border-black px-2 text-right text-sm text-black font-semibold"
                    colspan="{{ $colSpan }}">
                    DPP
                </td>
                <td class="text-sm text-black border border-black text-right">
                    @if ($category != 'Videotron' || ($category == 'Signage' && $description->type != 'Videotron'))
                        <input id="inputMediaDpp" onchange="mediaDppChange(this)"
                            class="flex px-1 text-sm text-black w-full text-right border rounded-md outline-none in-out-spin-none"
                            type="number" min="0" value="{{ $sale->dpp }}">
                    @else
                        <input id="inputMediaDpp" onchange="videotronDppChange(this)"
                            class="flex px-1 text-sm text-black w-full text-right border rounded-md outline-none in-out-spin-none"
                            type="number" min="0" value="{{ $sale->dpp }}">
                    @endif
                </td>
            </tr>
            <tr>
                <td class="border border-black px-2 text-right text-sm text-black font-semibold"
                    colspan="{{ $colSpan }}">
                    SUB TOTAL
                </td>
                <td id="tdSubTotal" class="text-sm text-black border border-black text-right">
                    {{ number_format($quotationPrice->price + $totalPrint + $totalInstall) }}
                </td>
            </tr>
            <tr>
                <td class="border border-black px-2 text-right text-sm text-black font-semibold"
                    colspan="{{ $colSpan }}">
                    PPN
                </td>
                <td id="tdPpn" class="text-sm text-black border border-black text-right px-1">
                    {{ number_format($sale->dpp * ($sale->ppn / 100)) }}
                </td>
            </tr>
            <tr>
                <td class="border border-black text-right text-sm text-black font-semibold px-2"
                    colspan="{{ $colSpan }}">
                    GRAND TOTAL
                </td>
                <td id="tdGrandTotal" class="text-sm text-black border border-black text-right px-1">
                    {{ number_format($quotationPrice->price + $sale->dpp * ($sale->ppn / 100) - $sale->dpp * ($sale->pph / 100) + $totalPrint + $totalInstall) }}
                </td>
            </tr>
        </tbody>
    </table>
@endif
