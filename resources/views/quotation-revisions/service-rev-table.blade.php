@php
    $codeStatus = true;
    $firstProductId = $products[0]->id;
    $productIndex = 0;
    foreach ($products as $checkProduct) {
        $productIndex++;
        if ($productIndex > 1) {
            if ($checkProduct->id != $firstProductId) {
                $codeStatus = false;
            }
        }
    }
@endphp
<div class="w-[780px]">
    <div class="hidden items-center w-full py-2">
        <label class="text-sm text-stone-900">Opsi penawaran :</label>
        @if ($price->objServiceType->print == true)
            <input class="outline-none ml-2" type="checkbox" id="cbPrint" checked onclick="cbPrintAction(this)">
        @else
            <input class="outline-none ml-2" type="checkbox" id="cbPrint" onclick="cbPrintAction(this)">
        @endif
        <label class="text-sm text-stone-900 ml-1">Cetak</label>
        @if ($price->objServiceType->install == true)
            <input class="outline-none ml-2" type="checkbox" id="cbInstall" checked onclick="cbInstallAction(this)">
        @else
            <input class="outline-none ml-2" type="checkbox" id="cbInstall" onclick="cbInstallAction(this)">
        @endif
        <label class="text-sm text-stone-900 ml-1">Pasang</label>
        @if ($codeStatus == true)
            <label class="text-sm text-black ml-6">Jumlah :</label>
            <input id="productQty" type="number" min="0" value="{{ count($products) }}"
                class="ml-2 border text-sm rounded-md outline-none text-center w-10 px-1"
                onchange="changeProductQty(this)">
        @else
            <label class="text-sm text-black ml-6" hidden>Jumlah :</label>
            <input id="productQty" type="number" min="0" value="1"
                class="ml-2 border text-sm rounded-md outline-none text-center w-10 px-1"
                onchange="changeProductQty(this)" hidden>
        @endif
    </div>
    <table class="table-auto mt-2 w-full">
        <thead>
            <tr>
                <th class="text-[0.7rem] text-black border border-black w-6" rowspan="2">No</th>
                <th class="text-[0.7rem] text-black border border-black" rowspan="2">Lokasi
                </th>
                <th class="text-[0.7rem] text-black border border-black w-80" colspan="5">Deskripsi</th>
            </tr>
            <tr>
                <th class="text-[0.7rem] text-black border border-black w-12">Jenis</th>
                <th class="text-[0.7rem] text-black border border-black w-20">Bahan</th>
                <th class="text-[0.7rem] text-black border border-black w-8" hidden>side</th>
                <th class="text-[0.7rem] text-black border border-black w-10">L (m2)</th>
                <th class="text-[0.7rem] text-black border border-black w-14">Harga</th>
                <th class="text-[0.7rem] text-black border border-black w-16">Total</th>
            </tr>
        </thead>
        <tbody id="serviceTBody">
            <input id="locationQty" type="text" value="{{ count($products) }}" hidden>
            <input type="text" id="serviceTypePrint" value="{{ $price->objServiceType->print }}" hidden>
            <input type="text" id="serviceTypeInstall" value="{{ $price->objServiceType->install }}" hidden>
            @php
                $subTotal = 0;
            @endphp
            @foreach ($products as $location)
                @php
                    $description = json_decode($location->description);
                @endphp
                <input type="text" id="productSide" value="{{ $location->side }}" hidden>
                @if ($location->type == 'new')
                    <input type="number" id="usedFree" value="0" hidden>
                    <input type="number" id="totalFree" value="0" hidden>
                @else
                    <input type="number" id="usedFree" value="{{ $location->used_install }}" hidden>
                    <input type="number" id="totalFree" value="{{ $location->free_install }}" hidden>
                @endif

                @if ($price->objServiceType->print == true && $price->objServiceType->install == true)
                    <tr>
                        <td class="text-[0.7rem] text-black border border-black text-center" rowspan="2">
                            {{ $loop->iteration }}
                        </td>
                        <td class="text-[0.7rem] text-black border border-black px-2" rowspan="2">
                            <div class="flex">
                                <input type="text" id="productSide" value="{{ $location->side }}" hidden>
                                <label class="w-10">Lokasi</label>
                                <input id="locationCode" type="text" value="{{ $location->code }}" hidden>
                                <label class="ml-2">:
                                    {{ $location->code }} - {{ $location->city_code }}
                                </label>
                                <label class="ml-2">|
                                    @if (strlen($location->address) > 55)
                                        {{ substr($location->address, 0, 55) }}..
                                    @else
                                        {{ $location->address }}
                                    @endif
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input id="locationWidth" type="number" value="{{ $location->width }}" hidden>
                                <input id="locationHeight" type="number" value="{{ $location->height }}" hidden>
                                <label class="w-10">Ukuran</label>
                                <label class="ml-2">:</label>
                                <label class="ml-1">{{ $location->size }} x {{ $location->side }} -
                                    @if ($location->orientation == 'Vertikal')
                                        V
                                    @elseif ($location->orientation == 'Horizontal')
                                        H
                                    @endif
                                </label>
                                @if ($location->category == 'Signage')
                                    <label class="w-6 ml-2" hidden>Qty :</label>
                                    <input id="qty" type="number" min="0"
                                        name="qty{{ $loop->iteration - 1 }}"
                                        class="ml-1 border rounded-md outline-none in-out-spin-none text-center w-6 px-1"
                                        value="{{ $description->qty }}" onkeyup="qtyChangeAction(this)" hidden>
                                @else
                                    <label class="w-6 ml-2" hidden>Qty :</label>
                                    <input id="qty" type="number" min="0"
                                        name="qty{{ $loop->iteration - 1 }}"
                                        class="ml-1 border rounded-md outline-none in-out-spin-none text-center w-6 px-1"
                                        value="1" onkeyup="qtyChangeAction(this)" hidden>
                                @endif
                                @if ((int) $location->side == '2')
                                    @if ($price->objSideView[$loop->iteration - 1]->left == true)
                                        <input class="outline-none ml-4" type="checkbox" id="cbLeft"
                                            name="cbLeft{{ $loop->iteration - 1 }}" checked
                                            onclick="cbLeftAction(this)">
                                    @else
                                        <input class="outline-none ml-4" type="checkbox" id="cbLeft"
                                            name="cbLeft{{ $loop->iteration - 1 }}" onclick="cbLeftAction(this)">
                                    @endif
                                    <label class="text-[0.7rem] text-stone-900 ml-1" for="cbLeft">Kiri</label>
                                    @if ($price->objSideView[$loop->iteration - 1]->right == true)
                                        <input class="outline-none ml-4" type="checkbox" id="cbRight"
                                            name="cbRight{{ $loop->iteration - 1 }}" checked
                                            onclick="cbRightAction(this)">
                                    @else
                                        <input class="outline-none ml-4" type="checkbox" id="cbRight"
                                            name="cbRight{{ $loop->iteration - 1 }}" onclick="cbRightAction(this)">
                                    @endif
                                    <label class="text-[0.7rem] text-stone-900 ml-1" for="cbRight">Kanan</label>
                                @else
                                    <input class="outline-none ml-4" type="checkbox" id="cbLeft"
                                        name="cbLeft{{ $loop->iteration - 1 }}" checked onclick="cbLeftAction(this)"
                                        hidden>
                                    <label class="text-[0.7rem] text-stone-900 ml-1" for="cbLeft"
                                        hidden>Kiri</label>
                                    <input class="outline-none ml-4" type="checkbox" id="cbRight"
                                        name="cbRight{{ $loop->iteration - 1 }}" onclick="cbRightAction(this)"
                                        hidden>
                                    <label class="text-[0.7rem] text-stone-900 ml-1" for="cbRight"
                                        hidden>Kanan</label>
                                @endif
                            </div>
                            <div class="flex">
                                <label class="w-10">Catatan</label>
                                <label class="ml-2">: </label>
                                <input id="serviceNotes" type="text"
                                    value="{{ $price->dataServiceNotes[$loop->iteration - 1]->serviceNote }}"
                                    class="ml-1 border rounded-md w-full outline-none px-1 font-semibold">
                            </div>
                        </td>
                        @php
                            $totalPrint =
                                $price->objPrints[$loop->iteration - 1]->price *
                                $price->objSideView[$loop->iteration - 1]->wide;
                            $totalInstall =
                                $price->objInstalls[$loop->iteration - 1]->price *
                                $price->objSideView[$loop->iteration - 1]->wide;
                            $subTotal = $subTotal + $totalInstall + $totalPrint;
                            $printProduct = $price->objPrints[$loop->iteration - 1]->printProduct;
                        @endphp
                        <td class="text-[0.7rem] text-black border border-black px-1 text-center">Cetak</td>
                        <td class="text-[0.7rem] text-black border border-black text-center">
                            <select id="selectPrint" name="printing_product{{ $loop->iteration - 1 }}"
                                class="flex px-2 text-[0.7rem] text-stone-900 w-28 border rounded-md outline-none"
                                value="{{ $price->objPrints[$loop->iteration - 1]->printProduct }}" required
                                onchange="selectPrintProduct(this)">
                                @foreach ($printing_products as $printingProduct)
                                    @if ($printingProduct->type == $description->lighting)
                                        @if ($printingProduct->name == $printProduct)
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
                        </td>
                        <td id="locationSide" class="text-[0.7rem] text-black border border-black text-center px-1"
                            rowspan="2" hidden>{{ $price->objSideView[$loop->iteration - 1]->side }}</td>
                        <td id="wide" class="text-[0.7rem] text-black border border-black text-center"
                            rowspan="2">
                            {{ $price->objSideView[$loop->iteration - 1]->wide }}
                        </td>
                        <td class="text-[0.7rem] text-black border border-black text-center px-1">
                            <input id="printPrice" name="printPrice{{ $loop->iteration - 1 }}"
                                class="flex px-1 text-[0.7rem] text-stone-900 w-12 text-right border rounded-md outline-none in-out-spin-none"
                                type="number" min="0"
                                value="{{ $price->objPrints[$loop->iteration - 1]->price }}"
                                onkeyup="printPriceChanged(this)">
                        </td>
                        <td id="printTotal" class="text-[0.7rem] text-black border border-black text-right px-2">
                            {{ number_format($totalPrint) }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-[0.7rem] text-black border border-black px-1 text-center">Pasang
                            <input type="text" id="freeInstalls"
                                value="{{ $price->objInstalls[$loop->iteration - 1]->freeInstall }}" hidden>
                        </td>
                        <td id="installProduct" class="text-[0.7rem] text-black border border-black text-center">
                            {{ $price->objInstalls[$loop->iteration - 1]->type }}</td>
                        <td class="text-[0.7rem] text-black border border-black text-center px-1">
                            <input id="installPrice" name="instalPrice{{ $loop->iteration - 1 }}"
                                class="flex px-1 text-[0.7rem] text-stone-900 w-12 text-right border rounded-md outline-none in-out-spin-none"
                                type="number" min="0"
                                value="{{ $price->objInstalls[$loop->iteration - 1]->price }}"
                                onkeyup="installPriceChanged(this)">
                        </td>
                        <td id="installTotal" class="text-[0.7rem] text-black border border-black text-right px-2">
                            {{ number_format($totalInstall) }}
                        </td>
                    </tr>
                @else
                    <tr>
                        <td class="text-[0.7rem] text-black border border-black text-center">{{ $loop->iteration }}
                        </td>
                        <td class="text-[0.7rem] text-black border border-black px-2">
                            <div class="flex">
                                <input type="text" id="productSide" value="{{ $location->side }}" hidden>
                                <label class="w-10">Lokasi</label>
                                <input id="locationCode" type="text" value="{{ $location->code }}" hidden>
                                <label class="ml-2">:
                                    {{ $location->code }} - {{ $location->city_code }}
                                </label>
                                <label class="ml-2">|
                                    @if (strlen($location->address) > 55)
                                        {{ substr($location->address, 0, 55) }}..
                                    @else
                                        {{ $location->address }}
                                    @endif
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input id="locationWidth" type="number" value="{{ $location->width }}" hidden>
                                <input id="locationHeight" type="number" value="{{ $location->height }}" hidden>
                                <label class="w-10">Ukuran</label>
                                <label class="ml-2">:</label>
                                <label class="ml-1">{{ $location->size }} x {{ $location->side }} -
                                    @if ($location->orientation == 'Vertikal')
                                        V
                                    @elseif ($location->orientation == 'Horizontal')
                                        H
                                    @endif
                                </label>
                                @if ($location->category == 'Signage')
                                    <label class="w-6 ml-2">Qty :</label>
                                    <input id="qty" type="number" min="0"
                                        name="qty{{ $loop->iteration - 1 }}"
                                        class="ml-1 border rounded-md outline-none in-out-spin-none text-center w-6 px-1"
                                        value="{{ $description->qty }}" onkeyup="qtyChangeAction(this)">
                                @else
                                    <label class="w-6 ml-2">Qty :</label>
                                    <input id="qty" type="number" min="0"
                                        name="qty{{ $loop->iteration - 1 }}"
                                        class="ml-1 border rounded-md outline-none in-out-spin-none text-center w-6 px-1"
                                        value="1" onkeyup="qtyChangeAction(this)">
                                @endif
                                @if ((int) $location->side == '2')
                                    @if ($price->objSideView[$loop->iteration - 1]->left == true)
                                        <input class="outline-none ml-4" type="checkbox" id="cbLeft"
                                            name="cbLeft{{ $loop->iteration - 1 }}" checked
                                            onclick="cbLeftAction(this)">
                                    @else
                                        <input class="outline-none ml-4" type="checkbox" id="cbLeft"
                                            name="cbLeft{{ $loop->iteration - 1 }}" onclick="cbLeftAction(this)">
                                    @endif
                                    <label class="text-[0.7rem] text-stone-900 ml-1" for="cbLeft">Kiri</label>
                                    @if ($price->objSideView[$loop->iteration - 1]->right == true)
                                        <input class="outline-none ml-4" type="checkbox" id="cbRight"
                                            name="cbRight{{ $loop->iteration - 1 }}" checked
                                            onclick="cbRightAction(this)">
                                    @else
                                        <input class="outline-none ml-4" type="checkbox" id="cbRight"
                                            name="cbRight{{ $loop->iteration - 1 }}" onclick="cbRightAction(this)">
                                    @endif
                                    <label class="text-[0.7rem] text-stone-900 ml-1" for="cbRight">Kanan</label>
                                @else
                                    <input class="outline-none ml-4" type="checkbox" id="cbLeft"
                                        name="cbLeft{{ $loop->iteration - 1 }}" checked onclick="cbLeftAction(this)"
                                        hidden>
                                    <label class="text-[0.7rem] text-stone-900 ml-1" for="cbLeft"
                                        hidden>Kiri</label>
                                    <input class="outline-none ml-4" type="checkbox" id="cbRight"
                                        name="cbRight{{ $loop->iteration - 1 }}" onclick="cbRightAction(this)"
                                        hidden>
                                    <label class="text-[0.7rem] text-stone-900 ml-1" for="cbRight"
                                        hidden>Kanan</label>
                                @endif
                            </div>
                            <div class="flex">
                                <label class="w-10">Catatan</label>
                                <label class="ml-2">: </label>
                                <input id="serviceNotes" type="text"
                                    value="{{ $price->dataServiceNotes[$loop->iteration - 1]->serviceNote }}"
                                    class="ml-1 border rounded-md w-full outline-none px-1 font-semibold">
                            </div>
                        </td>
                        @if ($price->objServiceType->print == true)
                            @php
                                $totalPrint =
                                    $price->objPrints[$loop->iteration - 1]->price *
                                    $price->objSideView[$loop->iteration - 1]->wide;
                                $subTotal = $subTotal + $totalPrint;
                            @endphp
                            <td class="text-[0.7rem] text-black border border-black px-1 text-center">Cetak</td>
                            <td class="text-[0.7rem] text-black border border-black text-center">
                                <select id="selectPrint" name="printing_product{{ $loop->iteration - 1 }}"
                                    class="flex px-2 text-[0.7rem] text-stone-900 w-28 border rounded-md outline-none"
                                    value="{{ $price->objPrints[$loop->iteration - 1]->printProduct }}" required
                                    onchange="selectPrintProduct(this)">
                                    @php
                                        $index = $loop->iteration - 1;
                                    @endphp
                                    @foreach ($printing_products as $printingProduct)
                                        @if ($printingProduct->type == $description->lighting)
                                            @if ($printingProduct->name == $price->objPrints[$index]->printProduct)
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
                            </td>
                            <td id="locationSide"
                                class="text-[0.7rem] text-black border border-black text-center px-1">
                                {{ $price->objSideView[$loop->iteration - 1]->side }}</td>
                            <td id="wide" class="text-[0.7rem] text-black border border-black text-center">
                                {{ $price->objSideView[$loop->iteration - 1]->wide }}</td>
                            <td class="text-[0.7rem] text-black border border-black text-center px-1">
                                <input id="printPrice" name="printPrice{{ $loop->iteration - 1 }}"
                                    class="flex px-1 text-[0.7rem] text-stone-900 w-12 text-right border rounded-md outline-none in-out-spin-none"
                                    type="number" min="0"
                                    value="{{ $price->objPrints[$loop->iteration - 1]->price }}"
                                    onkeyup="printPriceChanged(this)">
                            </td>
                            <td id="printTotal" class="text-[0.7rem] text-black border border-black text-right px-2">
                                {{ number_format($totalPrint) }}
                            </td>
                        @else
                            @php
                                $totalInstall =
                                    $price->objInstalls[$loop->iteration - 1]->price *
                                    $price->objSideView[$loop->iteration - 1]->wide;
                                $subTotal = $subTotal + $totalInstall;
                            @endphp
                            <input type="text" id="freeInstalls"
                                value="{{ $price->objInstalls[$loop->iteration - 1]->freeInstall }}" hidden>
                            <td class="text-[0.7rem] text-black border border-black px-1 text-center">Pasang</td>
                            <td id="installProduct" class="text-[0.7rem] text-black border border-black text-center">
                                {{ $price->objInstalls[$loop->iteration - 1]->type }}</td>
                            <td id="locationSide"
                                class="text-[0.7rem] text-black border border-black text-center px-1" hidden>
                                {{ $price->objSideView[$loop->iteration - 1]->side }}</td>
                            <td id="wide" class="text-[0.7rem] text-black border border-black text-center">
                                {{ $price->objSideView[$loop->iteration - 1]->wide }}</td>
                            <td class="text-[0.7rem] text-black border border-black text-center px-1">
                                <input id="installPrice" name="instalPrice{{ $loop->iteration - 1 }}"
                                    class="flex px-1 text-[0.7rem] text-stone-900 w-12 text-right border rounded-md outline-none in-out-spin-none"
                                    type="number" min="0"
                                    value="{{ $price->objInstalls[$loop->iteration - 1]->price }}"
                                    onkeyup="installPriceChanged(this)">
                            </td>
                            <td id="installTotal"
                                class="text-[0.7rem] text-black border border-black text-right px-2">
                                {{ number_format($totalInstall) }}
                            </td>
                        @endif
                    </tr>
                @endif
            @endforeach
            <tr>
                <td class="text-[0.7rem] text-black border border-black text-right font-semibold px-2" colspan="6">
                    Sub Total
                </td>
                <td id="subTotal" class="text-[0.7rem] text-black border border-black text-right font-semibold px-2">
                    {{ number_format($subTotal) }}</td>
            </tr>
            @if ($price->objServicePpn->status == true)
                <tr>
                    <td class="text-[0.7rem] text-black border border-black text-right font-semibold px-2"
                        colspan="6">
                        <input class="outline-none" type="checkbox" id="cbPpn" checked
                            onclick="cbPpnAction(this)">
                        <label class="text-[0.7rem] text-stone-900 ml-1" for="cbPpn">PPN</label>
                        <input id="inputPpn"
                            class="text-xs text-center border rounded-md text-stone-900 outline-none in-out-spin-none w-8 px-1 ml-2"
                            type="number" min="0" max="100" value="{{ $price->objServicePpn->value }}"
                            onkeyup="setServicePpn()">
                        <label class="text-xs text-stone-900 ml-2"> %</label>
                    </td>
                    <td id="servicePpn"
                        class="text-[0.7rem] text-black border border-black text-right font-semibold px-2">
                        @php
                            $servicePpn = ($price->objServicePpn->value / 100) * $subTotal;
                        @endphp
                        {{ number_format($servicePpn) }}
                    </td>
                </tr>
                <tr>
                    <td class="text-[0.7rem] text-black border border-black text-right font-semibold px-2"
                        colspan="6">Grand
                        Total
                    </td>
                    <td id="serviceGrandTotal"
                        class="text-[0.7rem] text-black border border-black text-right font-semibold px-2">
                        {{ number_format($subTotal + $servicePpn) }}
                    </td>
                </tr>
            @else
                <tr>
                    <td class="text-[0.7rem] text-black border border-black text-right font-semibold px-2"
                        colspan="6">
                        <input class="outline-none" type="checkbox" id="cbPpn" onclick="cbPpnAction(this)">
                        <label class="text-[0.7rem] text-stone-900 ml-1" for="cbPpn">PPN</label>
                        <input id="inputPpn"
                            class="text-xs text-center border rounded-md text-stone-900 outline-none in-out-spin-none w-8 px-1 ml-2"
                            type="number" min="0" max="100" value="0" onkeyup="setServicePpn()">
                        <label class="text-xs text-stone-900 ml-2"> %</label>
                    </td>
                    <td class="text-[0.7rem] text-black border border-black text-right font-semibold px-2">0</td>
                </tr>
                <tr>
                    <td class="text-[0.7rem] text-black border border-black text-right font-semibold px-2"
                        colspan="6">Grand
                        Total
                    </td>
                    <td class="text-[0.7rem] text-black border border-black text-right font-semibold px-2">
                        {{ number_format($subTotal) }}
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
