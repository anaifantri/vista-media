<table class="table-auto w-full">
    <thead>
        <tr>
            <th class="text-xs text-teal-700 border w-20" rowspan="2">
                Kode
            </th>
            <th class="text-xs text-teal-700 border" rowspan="2">Lokasi
            </th>
            <th class="text-xs text-teal-700 border w-48" colspan="4">
                Deskripsi
            </th>
            <th class="text-xs text-teal-700 border w-24">Harga (Rp.)</th>
        </tr>
        <tr>
            <th class="text-xs text-teal-700 border w-12">Jenis</th>
            <th class="text-xs text-teal-700 border w-8">FL/BL</th>
            <th class="text-xs text-teal-700 border w-8">Side</th>
            <th class="text-xs text-teal-700 border w-20">Size - V/H</th>
            <th id="thTitle" class="text-xs text-teal-700 border w-24">
                @if ($category == 'Billboard')
                    @foreach ($price->dataTitle as $dataTitle)
                        @if ($dataTitle->checkbox == true)
                            {{ $dataTitle->title }}
                        @endif
                    @endforeach
                @elseif ($category == 'Signage')
                    @if ($description->type == 'Videotron')
                        @if ($price->priceType[0] == true)
                            @foreach ($price->dataSharingPrice as $sharingPrice)
                                @if ($sharingPrice->checkbox == true)
                                    {{ $sharingPrice->title }}
                                    @php
                                        $thTitle = 'HARGA SHARING ' . $price->slotQty . ' SLOT';
                                    @endphp
                                @endif
                            @endforeach
                        @endif
                        @if ($price->priceType[1] == true)
                            @foreach ($price->dataExclusivePrice as $exclusivePrice)
                                @if ($exclusivePrice->checkbox == true)
                                    {{ $exclusivePrice->title }}
                                    @php
                                        $thTitle = 'HARGA EKSKLUSIF 4 SLOT';
                                    @endphp
                                @endif
                            @endforeach
                        @endif
                    @else
                        @foreach ($price->dataTitle as $dataTitle)
                            @if ($dataTitle->checkbox == true)
                                {{ $dataTitle->title }}
                            @endif
                        @endforeach
                    @endif
                @else
                    @if ($price->priceType[0] == true)
                        @foreach ($price->dataSharingPrice as $sharingPrice)
                            @if ($sharingPrice->checkbox == true)
                                {{ $sharingPrice->title }}
                                @php
                                    $thTitle = 'HARGA SHARING ' . $price->slotQty . ' SLOT';
                                @endphp
                            @endif
                        @endforeach
                    @endif
                    @if ($price->priceType[1] == true)
                        @foreach ($price->dataExclusivePrice as $exclusivePrice)
                            @if ($exclusivePrice->checkbox == true)
                                {{ $exclusivePrice->title }}
                                @php
                                    $thTitle = 'HARGA EKSKLUSIF 4 SLOT';
                                @endphp
                            @endif
                        @endforeach
                    @endif
                @endif
            </th>
        </tr>
    </thead>
    <tbody id="tBodyCreate">
        <tr>
            <td class="text-xs text-teal-700 border text-center">
                {{ $product->code }}-{{ $product->city_code }}</td>
            <td class="text-xs text-teal-700 border px-2">
                {{ $product->address }}
            </td>
            <td class="text-xs text-teal-700 border text-center">
                @if ($product->category == 'Billboard')
                    BB
                @elseif($product->category == 'Videotron')
                    VT
                @elseif($product->category == 'Signage')
                    SN
                @endif
            </td>
            @if ($product->category == 'Videotron')
                <td class="text-xs text-teal-700 border text-center">-</td>
            @elseif ($product->category == 'Signage')
                @if ($description->type == 'Videotron')
                    <td class="text-xs text-teal-700 border text-center">-</td>
                @else
                    <td class="text-xs text-teal-700 border text-center">
                        @if ($description->lighting == 'Backlight')
                            BL
                        @elseif ($description->lighting == 'Frontlight')
                            FL
                        @elseif ($description->lighting == 'Nonlight')
                            -
                        @endif
                    </td>
                @endif
            @elseif ($product->category == 'Signage')
                <td class="text-xs text-teal-700 border text-center">
                    @if ($description->lighting == 'Backlight')
                        BL
                    @elseif ($description->lighting == 'Frontlight')
                        FL
                    @elseif ($description->lighting == 'Nonlight')
                        -
                    @endif
                </td>
            @endif
            <td class="text-xs text-teal-700 border text-center">
                {{ filter_var($product->side, FILTER_SANITIZE_NUMBER_INT) }}
            </td>
            <td class="text-xs text-teal-700 border text-center">
                {{ $product->size }} -
                @if ($product->orientation == 'Vertikal')
                    V
                @elseif ($product->orientation == 'Horizontal')
                    H
                @endif
            </td>
            <td id="priceValue" class="text-xs  text-teal-700 border text-right px-2">
                @if ($category == 'Billboard')
                    @php
                        $index = $loop->iteration - 1;
                        $getCode = $product->code . '-' . $product->city_code;
                        $getPrice = 0;
                        for ($i = 0; $i < count($price->dataTitle); $i++) {
                            if ($price->dataTitle[$i]->checkbox == true) {
                                $getPrice = $price->dataPrice[$i][$index]->price;
                            }
                        }
                    @endphp
                    {{ $getPrice }}
                @elseif ($category == 'Signage')
                    @if ($description->type == 'Videotron')
                        @if ($price->priceType[0] == true)
                            @foreach ($price->dataSharingPrice as $sharingPrice)
                                @if ($sharingPrice->checkbox == true)
                                    {{ $sharingPrice->price }}
                                    @php
                                        $getPrice = $sharingPrice->price;
                                    @endphp
                                @endif
                            @endforeach
                        @endif
                        @if ($price->priceType[1] == true)
                            @foreach ($price->dataExclusivePrice as $exclusivePrice)
                                @if ($exclusivePrice->checkbox == true)
                                    {{ $exclusivePrice->price }}
                                    @php
                                        $getPrice = $exclusivePrice->price;
                                    @endphp
                                @endif
                            @endforeach
                        @endif
                    @else
                        @php
                            $index = $loop->iteration - 1;
                            $getCode = $product->code . '-' . $product->city_code;
                            $getPrice = 0;
                            for ($i = 0; $i < count($price->dataTitle); $i++) {
                                if ($price->dataTitle[$i]->checkbox == true) {
                                    $getPrice = $price->dataPrice[$i][$index]->price;
                                }
                            }
                        @endphp
                        {{ $getPrice }}
                    @endif
                @else
                    @if ($price->priceType[0] == true)
                        @foreach ($price->dataSharingPrice as $sharingPrice)
                            @if ($sharingPrice->checkbox == true)
                                {{ $sharingPrice->price }}
                                @php
                                    $getPrice = $sharingPrice->price;
                                @endphp
                            @endif
                        @endforeach
                    @endif
                    @if ($price->priceType[1] == true)
                        @foreach ($price->dataExclusivePrice as $exclusivePrice)
                            @if ($exclusivePrice->checkbox == true)
                                {{ $exclusivePrice->price }}
                                @php
                                    $getPrice = $exclusivePrice->price;
                                @endphp
                            @endif
                        @endforeach
                    @endif
                @endif
            </td>
        </tr>
        <tr>
            <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="6">
                <div class="flex items-center justify-end">
                    <label> Apakah menggunakan PPN dan PPh? </label>
                </div>
            </td>
            <td class="text-xs text-teal-700 border text-right px-2">
                <div class="flex justify-center items-center">
                    <input id="ppnYes" class="ml-2" type="radio" name="radioPpn-{{ $loop->iteration - 1 }}"
                        value="Yes" checked onclick="ppnValueCheck(this)">
                    <label class="ml-1"> Ya </label>
                    <input id="{{ $loop->iteration - 1 }}" class="ml-2" type="radio"
                        name="radioPpn-{{ $loop->iteration - 1 }}" value="No" onclick="ppnValueCheck(this)">
                    <label class="ml-1"> Tidak </label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="6">
                <div class="flex items-center justify-end">
                    <label> Apakah DPP sama dengan harga? </label>
                    <input id="{{ $loop->iteration - 1 }}" class="ml-2" type="radio"
                        name="dpp-{{ $product->code }}" value="Yes" checked onclick="radioCheck(this)">
                    <label class="ml-1"> Ya </label>
                    <input id="{{ $loop->iteration - 1 }}" class="ml-2" type="radio"
                        name="dpp-{{ $product->code }}" value="No" onclick="radioCheck(this)">
                    <label class="ml-1"> Tidak </label>
                </div>
            </td>
            <td class="text-xs text-teal-700 border text-right px-2">
                <div>
                    @php
                        $salesData[$loop->iteration - 1]->dpp = $getPrice;
                        $salesData[$loop->iteration - 1]->price = $getPrice;
                        $ppn = ($salesData[$loop->iteration - 1]->ppn / 100) * $getPrice;
                        $pph = ($salesData[$loop->iteration - 1]->pph / 100) * $getPrice;
                        $total = $getPrice + $ppn - $pph;
                    @endphp
                    <input id="dppValue" name="{{ $loop->iteration - 1 }}"
                        class="text-right text-xs outline-none text-teal-700 font-semibold in-out-spin-none w-20"
                        type="number" min="0" value="{{ $salesData[$loop->iteration - 1]->dpp }}" readonly
                        onkeyup="getDpp(this)" required>
                </div>
            </td>
        </tr>
        <tr>
            <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="6">
                <div class="flex w-full justify-end">
                    <label class="text-xs text-teal-700">(A) PPN </label>
                    <input id="inputPpn" name="ppn{{ $loop->iteration - 1 }}"
                        value="{{ $salesData[$loop->iteration - 1]->ppn }}"
                        class="text-xs border rounded-md text-teal-700 outline-none in-out-spin-none w-8 px-1 ml-2"
                        type="number" min="0" max="100" onkeyup="setPpn(this)" required>
                    <label class="text-xs text-teal-700 ml-2"> %</label>
                </div>
            </td>
            <td id="ppnValue" class="text-xs text-teal-700 border text-right px-2">
                {{ $ppn }}
            </td>
        </tr>
        <tr>
            <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="6">
                <div class="flex w-full justify-end">
                    <label class="text-xs text-teal-700">(B) PPh </label>
                    <input id="inputPph" name="pph{{ $loop->iteration - 1 }}"
                        value="{{ $salesData[$loop->iteration - 1]->pph }}"
                        class="text-xs border rounded-md text-teal-700 outline-none in-out-spin-none w-8 px-1 ml-2"
                        type="number" min="0" max="100" onkeyup="setPph(this)" required>
                    <label class="text-xs text-teal-700 ml-2"> %</label>
                </div>
            </td>
            <td id="pphValue" class="text-xs text-teal-700 border text-right px-2">
                {{ $pph }}
            </td>
        </tr>
        <tr>
            @if ($category == 'Billboard')
                <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="6">TOTAL (Harga + A
                    -
                    B)</td>
            @elseif ($category == 'Signage')
                @if ($description->type == 'Videotron')
                    <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="6">
                        {{ $thTitle }} (Harga + A - B)</td>
                @else
                    <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="6">TOTAL (Harga
                        +
                        A - B)</td>
                @endif
            @else
                <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="6">
                    {{ $thTitle }} (Harga + A - B)</td>
            @endif
            <td id="totalValue" class="text-xs text-teal-700 border text-right px-2">
                {{ $total }}
            </td>
        </tr>
    </tbody>
</table>
