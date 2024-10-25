<div class="w-[725px]">
    <div class="hidden items-center w-full py-2">
        <label class="text-sm text-teal-700">Opsi penawaran :</label>
        @if ($price->objServiceType->print == true)
            <input class="outline-none ml-2" type="checkbox" id="cbPrint" checked onclick="cbPrintAction(this)">
        @else
            <input class="outline-none ml-2" type="checkbox" id="cbPrint" onclick="cbPrintAction(this)">
        @endif
        <label class="text-sm text-teal-700 ml-1">Cetak</label>
        @if ($price->objServiceType->install == true)
            <input class="outline-none ml-2" type="checkbox" id="cbInstall" checked onclick="cbInstallAction(this)">
        @else
            <input class="outline-none ml-2" type="checkbox" id="cbInstall" onclick="cbInstallAction(this)">
        @endif
        <label class="text-sm text-teal-700 ml-1">Pasang</label>
    </div>
    <table class="table-auto mt-2 w-full">
        <thead>
            <tr class="bg-teal-50">
                <th class="text-[0.7rem] text-teal-700 border w-6" rowspan="2">No</th>
                <th class="text-[0.7rem] text-teal-700 border" rowspan="2">Lokasi
                </th>
                <th class="text-[0.7rem] text-teal-700 border" colspan="6">Deskripsi</th>
            </tr>
            <tr class="bg-teal-50">
                <th class="text-[0.7rem] text-teal-700 border w-16">Jenis</th>
                <th class="text-[0.7rem] text-teal-700 border w-28">Bahan</th>
                <th class="text-[0.7rem] text-teal-700 border w-8">side</th>
                <th class="text-[0.7rem] text-teal-700 border w-10">L (m2)</th>
                <th class="text-[0.7rem] text-teal-700 border w-14">Harga</th>
                <th class="text-[0.7rem] text-teal-700 border w-16">Total</th>
            </tr>
        </thead>
        <tbody id="serviceTBody">
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
                @if ($price->objServiceType->print == true && $price->objServiceType->install == true)
                    <tr class="bg-slate-50">
                        <td class="text-[0.7rem] text-teal-700 border text-center" rowspan="2">{{ $loop->iteration }}
                        </td>
                        <td class="text-[0.7rem] text-teal-700 border px-2" rowspan="2">
                            <div class="flex">
                                <label class="w-10">Kode</label>
                                <label id="locationCode" class="ml-2">: {{ $location->code }} -
                                    {{ $location->city_code }}</label>
                            </div>
                            <div class="flex">
                                <label class="w-10">Lokasi</label>
                                <label class="ml-2">: {{ $location->address }}</label>
                            </div>
                            <div class="flex items-center">
                                <input id="locationWidth" type="number" value="{{ $location->width }}" hidden>
                                <input id="locationHeight" type="number" value="{{ $location->height }}" hidden>
                                <label class="w-10">Ukuran</label>
                                <label class="ml-2">: {{ $location->size }} x {{ $location->side }} -
                                    @if ($location->orientation == 'Vertikal')
                                        V
                                    @elseif ($location->orientation == 'Horizontal')
                                        H
                                    @endif
                                </label>
                                @if ((int) $location->side == '2')
                                    @if ($price->objSideView[$loop->iteration - 1]->left == true)
                                        <input class="outline-none ml-8" type="checkbox" id="cbLeft"
                                            name="cbLeft{{ $loop->iteration - 1 }}" checked
                                            onclick="cbLeftAction(this)">
                                    @else
                                        <input class="outline-none ml-8" type="checkbox" id="cbLeft"
                                            name="cbLeft{{ $loop->iteration - 1 }}" onclick="cbLeftAction(this)">
                                    @endif
                                    <label class="text-[0.7rem] text-teal-700 ml-1" for="cbLeft">Kiri</label>
                                    @if ($price->objSideView[$loop->iteration - 1]->right == true)
                                        <input class="outline-none ml-4" type="checkbox" id="cbRight"
                                            name="cbRight{{ $loop->iteration - 1 }}" checked
                                            onclick="cbRightAction(this)">
                                    @else
                                        <input class="outline-none ml-4" type="checkbox" id="cbRight"
                                            name="cbRight{{ $loop->iteration - 1 }}" onclick="cbRightAction(this)">
                                    @endif
                                    <label class="text-[0.7rem] text-teal-700 ml-1" for="cbRight">Kanan</label>
                                @else
                                    <input class="outline-none ml-8" type="checkbox" id="cbLeft"
                                        name="cbLeft{{ $loop->iteration - 1 }}" checked onclick="cbLeftAction(this)"
                                        hidden>
                                    <label class="text-[0.7rem] text-teal-700 ml-1" for="cbLeft" hidden>Kiri</label>
                                    <input class="outline-none ml-4" type="checkbox" id="cbRight"
                                        name="cbRight{{ $loop->iteration - 1 }}" onclick="cbRightAction(this)"
                                        hidden>
                                    <label class="text-[0.7rem] text-teal-700 ml-1" for="cbRight"
                                        hidden>Kanan</label>
                                @endif
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
                        <td class="text-[0.7rem] text-teal-700 border px-1 text-center">Cetak</td>
                        <td class="text-[0.7rem] text-teal-700 border text-center">
                            <select id="selectPrint" name="printing_product{{ $loop->iteration - 1 }}"
                                class="flex px-2 text-[0.7rem] text-teal-700 w-28 border rounded-md outline-none"
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
                        <td id="locationSide" class="text-[0.7rem] text-teal-700 border text-center px-1"
                            rowspan="2">
                            {{ $price->objSideView[$loop->iteration - 1]->side }}
                        </td>
                        <td id="wide" class="text-[0.7rem] text-teal-700 border text-center" rowspan="2">
                            {{ $price->objSideView[$loop->iteration - 1]->wide }}
                        </td>
                        <td class="text-[0.7rem] text-teal-700 border text-center px-1">
                            <input id="printPrice" name="printPrice{{ $loop->iteration - 1 }}"
                                class="flex px-1 text-[0.7rem] text-teal-700 w-12 text-right border rounded-md outline-none in-out-spin-none"
                                type="number" min="0"
                                value="{{ $price->objPrints[$loop->iteration - 1]->price }}"
                                onkeyup="printPriceChanged(this)">
                        </td>
                        <td id="printTotal" class="text-[0.7rem] text-teal-700 border text-right px-2">
                            {{ $totalPrint }}
                        </td>
                    </tr>
                    <tr class="bg-slate-50">
                        <td class="text-[0.7rem] text-teal-700 border px-1 text-center">Pasang</td>
                        <td id="installProduct" class="text-[0.7rem] text-teal-700 border text-center">
                            {{ $price->objInstalls[$loop->iteration - 1]->type }}</td>
                        <td class="text-[0.7rem] text-teal-700 border text-center px-1">
                            <input id="installPrice" name="instalPrice{{ $loop->iteration - 1 }}"
                                class="flex px-1 text-[0.7rem] text-teal-700 w-12 text-right border rounded-md outline-none in-out-spin-none"
                                type="number" min="0"
                                value="{{ $price->objInstalls[$loop->iteration - 1]->price }}"
                                onkeyup="installPriceChanged(this)">
                        </td>
                        <td id="installTotal" class="text-[0.7rem] text-teal-700 border text-right px-2">
                            {{ $totalInstall }}
                        </td>
                    </tr>
                @else
                    <tr class="bg-slate-50">
                        <td class="text-[0.7rem] text-teal-700 border text-center">{{ $loop->iteration }}
                        </td>
                        <td class="text-[0.7rem] text-teal-700 border px-2">
                            <div class="flex">
                                <label class="w-10">Kode</label>
                                <label id="locationCode" class="ml-2">: {{ $location->code }} -
                                    {{ $location->city_code }}</label>
                            </div>
                            <div class="flex">
                                <label class="w-10">Lokasi</label>
                                <label class="ml-2">: {{ $location->address }}</label>
                            </div>
                            <div class="flex items-center">
                                <label class="w-10">Ukuran</label>
                                <label class="ml-2">: {{ $location->size }} x {{ $location->side }} -
                                    @if ($location->orientation == 'Vertikal')
                                        V
                                    @elseif ($location->orientation == 'Horizontal')
                                        H
                                    @endif
                                </label>
                                @if ((int) $location->side == '2')
                                    <input class="outline-none ml-8" type="checkbox" id="cbLeft"
                                        name="cbLeft{{ $loop->iteration - 1 }}" checked onclick="cbLeftAction(this)">
                                    <label class="text-[0.7rem] text-teal-700 ml-1" for="cbLeft">Kiri</label>
                                    <input class="outline-none ml-4" type="checkbox" id="cbRight"
                                        name="cbRight{{ $loop->iteration - 1 }}" checked
                                        onclick="cbRightAction(this)">
                                    <label class="text-[0.7rem] text-teal-700 ml-1" for="cbRight">Kanan</label>
                                @else
                                    <input class="outline-none ml-8" type="checkbox" id="cbLeft"
                                        name="cbLeft{{ $loop->iteration - 1 }}" checked onclick="cbLeftAction(this)"
                                        hidden>
                                    <label class="text-[0.7rem] text-teal-700 ml-1" for="cbLeft" hidden>Kiri</label>
                                    <input class="outline-none ml-4" type="checkbox" id="cbRight"
                                        name="cbRight{{ $loop->iteration - 1 }}" onclick="cbRightAction(this)"
                                        hidden>
                                    <label class="text-[0.7rem] text-teal-700 ml-1" for="cbRight"
                                        hidden>Kanan</label>
                                @endif
                            </div>
                        </td>
                        @if ($price->objServiceType->print == true)
                            @php
                                $totalPrint =
                                    $price->objPrints[$loop->iteration - 1]->price *
                                    $price->objSideView[$loop->iteration - 1]->wide;
                                $subTotal = $subTotal + $totalPrint;
                            @endphp
                            <td class="text-[0.7rem] text-teal-700 border px-1 text-center">Cetak</td>
                            <td class="text-[0.7rem] text-teal-700 border text-center">
                                <select id="selectPrint" name="printing_product{{ $loop->iteration - 1 }}"
                                    class="flex px-2 text-[0.7rem] text-teal-700 w-28 border rounded-md outline-none"
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
                            <td id="locationSide" class="text-[0.7rem] text-teal-700 border text-center px-1">
                                {{ $price->objSideView[$loop->iteration - 1]->side }}</td>
                            <td id="wide" class="text-[0.7rem] text-teal-700 border text-center">
                                {{ $price->objSideView[$loop->iteration - 1]->wide }}</td>
                            <td class="text-[0.7rem] text-teal-700 border text-center px-1">
                                <input id="printPrice" name="printPrice{{ $loop->iteration - 1 }}"
                                    class="flex px-1 text-[0.7rem] text-teal-700 w-12 text-right border rounded-md outline-none in-out-spin-none"
                                    type="number" min="0"
                                    value="{{ $price->objPrints[$loop->iteration - 1]->price }}"
                                    onkeyup="printPriceChanged(this)">
                            </td>
                            <td id="printTotal" class="text-[0.7rem] text-teal-700 border text-right px-2">
                                {{ $totalPrint }}
                            </td>
                        @else
                            @php
                                $totalInstall =
                                    $price->objInstalls[$loop->iteration - 1]->price *
                                    $price->objSideView[$loop->iteration - 1]->wide;
                                $subTotal = $subTotal + $totalInstall;
                            @endphp
                            <td class="text-[0.7rem] text-teal-700 border px-1 text-center">Pasang</td>
                            <td id="installProduct" class="text-[0.7rem] text-teal-700 border text-center">
                                {{ $price->objInstalls[$loop->iteration - 1]->type }}</td>
                            <td id="locationSide" class="text-[0.7rem] text-teal-700 border text-center px-1">
                                {{ $price->objSideView[$loop->iteration - 1]->side }}</td>
                            <td id="wide" class="text-[0.7rem] text-teal-700 border text-center">
                                {{ $price->objSideView[$loop->iteration - 1]->wide }}</td>
                            <td class="text-[0.7rem] text-teal-700 border text-center px-1">
                                <input id="installPrice" name="instalPrice{{ $loop->iteration - 1 }}"
                                    class="flex px-1 text-[0.7rem] text-teal-700 w-12 text-right border rounded-md outline-none in-out-spin-none"
                                    type="number" min="0"
                                    value="{{ $price->objInstalls[$loop->iteration - 1]->price }}"
                                    onkeyup="installPriceChanged(this)">
                            </td>
                            <td id="installTotal" class="text-[0.7rem] text-teal-700 border text-right px-2">
                                {{ $totalInstall }}
                            </td>
                        @endif
                    </tr>
                @endif
            @endforeach
            <tr>
                <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="7">Sub Total
                </td>
                <td id="subTotal" class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2">
                    {{ $subTotal }}</td>
            </tr>
            @if ($price->objServicePpn->status == true)
                <tr>
                    <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="7">
                        <input class="outline-none" type="checkbox" id="cbPpn" checked
                            onclick="cbPpnAction(this)">
                        <label class="text-[0.7rem] text-teal-700 ml-1" for="cbPpn">PPN</label>
                        <input id="inputPpn"
                            class="text-xs text-center border rounded-md text-teal-700 outline-none in-out-spin-none w-8 px-1 ml-2"
                            type="number" min="0" max="100" value="{{ $price->objServicePpn->value }}"
                            onkeyup="setServicePpn()">
                        <label class="text-xs text-teal-700 ml-2"> %</label>
                    </td>
                    <td id="servicePpn" class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2">
                        @php
                            $servicePpn = ($price->objServicePpn->value / 100) * $subTotal;
                        @endphp
                        {{ $servicePpn }}
                    </td>
                </tr>
                <tr>
                    <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="7">Grand
                        Total
                    </td>
                    <td id="serviceGrandTotal"
                        class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2">
                        {{ $subTotal + $servicePpn }}
                    </td>
                </tr>
            @else
                <tr>
                    <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="7">
                        <input class="outline-none" type="checkbox" id="cbPpn" onclick="cbPpnAction(this)">
                        <label class="text-[0.7rem] text-teal-700 ml-1" for="cbPpn">PPN</label>
                        <input id="inputPpn"
                            class="text-xs text-center border rounded-md text-teal-700 outline-none in-out-spin-none w-8 px-1 ml-2"
                            type="number" min="0" max="100" value="0" onkeyup="setServicePpn()">
                        <label class="text-xs text-teal-700 ml-2"> %</label>
                    </td>
                    <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2">0</td>
                </tr>
                <tr>
                    <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="7">Grand
                        Total
                    </td>
                    <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2">
                        {{ number_format($subTotal) }}
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
