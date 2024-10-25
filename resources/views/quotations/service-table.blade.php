<div class="w-[725px]">
    <div class="flex items-center w-full py-2">
        <label class="text-sm text-teal-700">Opsi penawaran :</label>
        <input class="outline-none ml-2" type="checkbox" id="cbPrint" checked onclick="cbPrintAction(this)">
        <label class="text-sm text-teal-700 ml-1">Cetak</label>
        <input class="outline-none ml-2" type="checkbox" id="cbInstall" checked onclick="cbInstallAction(this)">
        <label class="text-sm text-teal-700 ml-1">Pasang</label>
    </div>
    <table class="table-auto mt-2 w-full">
        <thead>
            <tr class="bg-teal-50">
                <th class="text-[0.7rem] text-teal-700 border w-6" rowspan="2">No</th>
                <th class="text-[0.7rem] text-teal-700 border" rowspan="2">Lokasi
                </th>
                <th class="text-[0.7rem] text-teal-700 border" colspan="5">Deskripsi</th>
            </tr>
            <tr class="bg-teal-50">
                <th class="text-[0.7rem] text-teal-700 border w-16">Jenis</th>
                <th class="text-[0.7rem] text-teal-700 border w-28">Bahan</th>
                <th class="text-[0.7rem] text-teal-700 border w-8" hidden>side</th>
                <th class="text-[0.7rem] text-teal-700 border w-10">L (m2)</th>
                <th class="text-[0.7rem] text-teal-700 border w-14">Harga</th>
                <th class="text-[0.7rem] text-teal-700 border w-16">Total</th>
            </tr>
        </thead>
        <tbody id="serviceTBody">
            @php
                $subTotal = 0;
            @endphp
            <input type="text" id="locationQty" value="{{ count($products) }}" hidden>
            @foreach ($products as $location)
                @php
                    $description = json_decode($location->description);
                @endphp
                <input type="text" id="productSide" value="{{ $location->side }}" hidden>
                @if ($loop->iteration % 2 == 0)
                    <tr class="bg-slate-50">
                        <td class="text-[0.7rem] text-teal-700 border text-center" rowspan="2">
                            {{ $loop->iteration }}</td>
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
                                    <input class="outline-none ml-8" type="checkbox" id="cbLeft"
                                        name="cbLeft{{ $loop->iteration - 1 }}" checked onclick="cbLeftAction(this)">
                                    <label class="text-[0.7rem] text-teal-700 ml-1" for="cbLeft">Kiri</label>
                                    <input class="outline-none ml-4" type="checkbox" id="cbRight"
                                        name="cbRight{{ $loop->iteration - 1 }}" checked onclick="cbRightAction(this)">
                                    <label class="text-[0.7rem] text-teal-700 ml-1" for="cbRight">Kanan</label>
                                @else
                                    <input class="outline-none ml-8" type="checkbox" id="cbLeft"
                                        name="cbLeft{{ $loop->iteration - 1 }}" checked onclick="cbLeftAction(this)"
                                        hidden>
                                    <label class="text-[0.7rem] text-teal-700 ml-1" for="cbLeft" hidden>Kiri</label>
                                    <input class="outline-none ml-4" type="checkbox" id="cbRight"
                                        name="cbRight{{ $loop->iteration - 1 }}" onclick="cbRightAction(this)" hidden>
                                    <label class="text-[0.7rem] text-teal-700 ml-1" for="cbRight" hidden>Kanan</label>
                                @endif
                            </div>
                        </td>
                        <td class="text-[0.7rem] text-teal-700 border px-1">
                            <div class="flex items-center">
                                <label class="text-[0.7rem] text-teal-700 ml-1">Cetak</label>
                            </div>
                        </td>
                        <td class="text-[0.7rem] text-teal-700 border text-center">
                            <select id="selectPrint" name="printing_product{{ $loop->iteration - 1 }}"
                                class="flex px-2 text-[0.7rem] text-teal-700 w-28 border rounded-md outline-none"
                                value="{{ old('printing_product') }}" required onchange="selectPrintProduct(this)">
                                <option value="pilih">Pilih Bahan</option>
                                @foreach ($printing_products as $printingProduct)
                                    @if ($printingProduct->type == $description->lighting)
                                        @if ($printingProduct->name == old('printing_product'))
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
                        <td class="text-[0.7rem] text-teal-700 border text-center px-1" rowspan="2" hidden>
                            <input id="locationSide"
                                class="flex px-1 text-[0.7rem] text-teal-700 w-6 text-center outline-none in-out-spin-none"
                                type="number" min="0" value="{{ (int) $location->side }}" readonly>
                        </td>
                        <td id="wide" class="text-[0.7rem] text-teal-700 border text-center" rowspan="2">
                            {{ (int) $location->width * (int) $location->height * (int) $location->side }}</td>
                        <td class="text-[0.7rem] text-teal-700 border text-center px-1">
                            <input id="printPrice" name="printPrice{{ $loop->iteration - 1 }}"
                                class="flex px-1 text-[0.7rem] text-teal-700 w-12 text-right border rounded-md outline-none in-out-spin-none"
                                type="number" min="0" value="0" onkeyup="printPriceChanged(this)"
                                disabled>
                        </td>
                        <td class="text-[0.7rem] text-teal-700 border text-right px-1">
                            <input id="printTotal"
                                class="flex px-1 text-[0.7rem] text-teal-700 w-16 text-right outline-none in-out-spin-none bg-transparent"
                                type="number" min="0" value="0" readonly>
                        </td>
                    </tr>
                    <tr class="bg-slate-50">
                        <td class="text-[0.7rem] text-teal-700 border px-1">
                            <div class="flex items-center">
                                <label class="text-[0.7rem] text-teal-700 ml-1">Pasang</label>
                            </div>
                        </td>
                        @php
                            $indexInstall = $loop->iteration - 1;
                        @endphp
                        <td id="installProduct" class="text-[0.7rem] text-teal-700 border text-center">
                            {{ $description->lighting }}</td>
                        @foreach ($installation_prices as $installationPrice)
                            @if ($installationPrice->type == $description->lighting)
                                <td class="text-[0.7rem] text-teal-700 border text-center px-1">
                                    <input id="installPrice" name="instalPrice{{ $indexInstall }}"
                                        class="flex px-1 text-[0.7rem] text-teal-700 w-12 text-right border rounded-md outline-none in-out-spin-none"
                                        type="number" min="0" value="{{ $installationPrice->price }}"
                                        onkeyup="installPriceChanged(this)">
                                </td>
                                <td class="text-[0.7rem] text-teal-700 border text-right px-1">
                                    @php
                                        $installTotal =
                                            $installationPrice->price *
                                            ((int) $location->width * (int) $location->height * (int) $location->side);
                                        $subTotal = $subTotal + $installTotal;
                                    @endphp
                                    <input id="installTotal"
                                        class="flex px-1 text-[0.7rem] text-teal-700 w-16 text-right outline-none in-out-spin-none bg-transparent"
                                        type="number" min="0" value="{{ $installTotal }}" readonly>
                                </td>
                            @endif
                        @endforeach
                    </tr>
                @else
                    <tr>
                        <td class="text-[0.7rem] text-teal-700 border text-center" rowspan="2">
                            {{ $loop->iteration }}</td>
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
                        <td class="text-[0.7rem] text-teal-700 border px-1">
                            <div class="flex items-center">
                                <label class="text-[0.7rem] text-teal-700 ml-1">Cetak</label>
                            </div>
                        </td>
                        <td class="text-[0.7rem] text-teal-700 border text-center">
                            <select id="selectPrint" name="printing_product{{ $loop->iteration - 1 }}"
                                class="flex px-2 text-[0.7rem] text-teal-700 w-28 border rounded-md outline-none"
                                value="{{ old('printing_product') }}" required onchange="selectPrintProduct(this)">
                                <option value="pilih">Pilih Bahan</option>
                                @foreach ($printing_products as $printingProduct)
                                    @if ($printingProduct->type == $description->lighting)
                                        @if ($printingProduct->name == old('printing_product'))
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
                        <td class="text-[0.7rem] text-teal-700 border text-center px-1" rowspan="2" hidden>
                            <input id="locationSide"
                                class="flex px-1 text-[0.7rem] text-teal-700 w-6 text-center outline-none in-out-spin-none"
                                type="number" min="0" value="{{ (int) $location->side }}" readonly>
                        </td>
                        <td id="wide" class="text-[0.7rem] text-teal-700 border text-center" rowspan="2">
                            {{ (int) $location->width * (int) $location->height * (int) $location->side }}</td>
                        <td class="text-[0.7rem] text-teal-700 border text-center px-1">
                            <input id="printPrice" name="printPrice{{ $loop->iteration - 1 }}"
                                class="flex px-1 text-[0.7rem] text-teal-700 w-12 text-right border rounded-md outline-none in-out-spin-none"
                                type="number" min="0" value="0" onkeyup="printPriceChanged(this)"
                                disabled>
                        </td>
                        <td class="text-[0.7rem] text-teal-700 border text-right px-1">
                            <input id="printTotal"
                                class="flex px-1 text-[0.7rem] text-teal-700 w-16 text-right outline-none in-out-spin-none"
                                type="number" min="0" value="0" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-[0.7rem] text-teal-700 border px-1">
                            <div class="flex items-center">
                                <label class="text-[0.7rem] text-teal-700 ml-1">Pasang</label>
                            </div>
                        </td>
                        @php
                            $indexInstall = $loop->iteration - 1;
                        @endphp
                        <td id="installProduct" class="text-[0.7rem] text-teal-700 border text-center">
                            {{ $description->lighting }}</td>
                        @foreach ($installation_prices as $installationPrice)
                            @if ($installationPrice->type == $description->lighting)
                                <td class="text-[0.7rem] text-teal-700 border text-center px-1">
                                    <input id="installPrice" name="instalPrice{{ $indexInstall }}"
                                        class="flex px-1 text-[0.7rem] text-teal-700 w-12 text-right border rounded-md outline-none in-out-spin-none"
                                        type="number" min="0" value="{{ $installationPrice->price }}"
                                        onkeyup="installPriceChanged(this)">
                                </td>
                                <td class="text-[0.7rem] text-teal-700 border text-right px-1">
                                    @php
                                        $installTotal =
                                            $installationPrice->price *
                                            ((int) $location->width * (int) $location->height * (int) $location->side);
                                        $subTotal = $subTotal + $installTotal;
                                    @endphp
                                    <input id="installTotal"
                                        class="flex px-1 text-[0.7rem] text-teal-700 w-16 text-right outline-none in-out-spin-none"
                                        type="number" min="0" value="{{ $installTotal }}" readonly>
                                </td>
                            @endif
                        @endforeach
                    </tr>
                @endif
            @endforeach
            <tr>
                <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="6">Sub Total
                </td>
                <td id="subTotal" class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2">
                    {{ $subTotal }}</td>
            </tr>
            <tr>
                <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="6">
                    <div class="flex items-center justify-end">
                        <input class="outline-none" type="checkbox" id="cbPpn" checked
                            onclick="cbPpnAction(this)">
                        <label class="text-[0.7rem] text-teal-700 ml-1" for="cbPpn">PPN</label>
                        <input id="inputPpn"
                            class="text-xs text-center border rounded-md text-teal-700 outline-none in-out-spin-none w-8 px-1 ml-2"
                            type="number" min="0" max="100" value="11" onkeyup="setServicePpn()">
                        <label class="text-xs text-teal-700 ml-2"> %</label>
                    </div>
                </td>
                <td id="servicePpn" class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2">
                    @php
                        $ppnValue = $subTotal * 0.11;
                    @endphp
                    {{ $ppnValue }}</td>
            </tr>
            <tr>
                <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="6">Grand
                    Total
                </td>
                <td id="serviceGrandTotal" class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2">
                    {{ $subTotal + $ppnValue }}
                </td>
            </tr>
        </tbody>
    </table>
</div>
