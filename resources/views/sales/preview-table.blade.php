<table class="table-auto w-full">
    <thead>
        <tr>
            <th class="text-xs text-teal-700 border w-20" rowspan="2">
                Kode
            </th>
            <th class="text-xs text-teal-700 border" rowspan="2">Lokasi
            </th>
            @if ($category == 'Signage')
                <th class="text-[0.7rem] text-teal-700 border" colspan="4">Deskripsi</th>
            @elseif ($category == 'Videotron')
                <th class="text-[0.7rem] text-teal-700 border" colspan="2">Deskripsi</th>
            @endif
            <th class="text-xs text-teal-700 border w-24">Harga (Rp.)</th>
        </tr>
        <tr>
            @if ($category != 'Videotron')
                @if ($category == 'Signage')
                    <th class="text-[0.7rem] text-teal-700 border w-16" rowspan="2">Bentuk</th>
                @else
                    <th class="text-[0.7rem] text-teal-700 border w-10" rowspan="2">BL/FL</th>
                @endif
            @endif
            @if ($category == 'Signage')
                <th class="text-[0.7rem] text-teal-700 border w-6" rowspan="2">Qty</th>
            @endif
            <th class="text-[0.7rem] text-teal-700 border w-8" rowspan="2">Side</th>
            <th class="text-xs text-teal-700 border w-20">Size - V/H</th>
            <th class="text-xs text-teal-700 border w-24">
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
    <tbody>
        <tr>
            <td class="text-xs text-teal-700 border text-center">
                {{ $product->code }}-{{ $product->city_code }}</td>
            <td class="text-xs text-teal-700 border px-2">
                {{ $product->address }}
            </td>
            @if ($category == 'Signage')
                <td class="text-[0.7rem] text-teal-700 border text-center">{{ $description->type }}</td>
            @else
                @if ($category != 'Videotron')
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        @if ($description->lighting == 'Backlight')
                            BL
                        @elseif ($description->lighting == 'Frontlight')
                            FL
                        @endif
                    </td>
                @endif
            @endif
            @if ($category == 'Signage')
                <td class="text-[0.7rem] text-teal-700 border text-center">
                    {{ $description->qty }}
                </td>
            @endif
            <td class="text-[0.7rem] text-teal-700 border text-center">
                {{ (int) filter_var($product->side, FILTER_SANITIZE_NUMBER_INT) }}
            </td>
            <td class="text-xs text-teal-700 border text-center">
                {{ $product->size }} -
                @if ($product->orientation == 'Vertikal')
                    V
                @elseif ($product->orientation == 'Horizontal')
                    H
                @endif
            </td>
            <td id="previewPrice" class="text-xs  text-teal-700 border text-right px-2">
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
                    {{ number_format($getPrice) }}
                @elseif ($category == 'Signage')
                    @if ($description->type == 'Videotron')
                        @if ($price->priceType[0] == true)
                            @foreach ($price->dataSharingPrice as $sharingPrice)
                                @if ($sharingPrice->checkbox == true)
                                    {{ number_format($sharingPrice->price) }}
                                    @php
                                        $getPrice = $sharingPrice->price;
                                    @endphp
                                @endif
                            @endforeach
                        @endif
                        @if ($price->priceType[1] == true)
                            @foreach ($price->dataExclusivePrice as $exclusivePrice)
                                @if ($exclusivePrice->checkbox == true)
                                    {{ number_format($exclusivePrice->price) }}
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
                        {{ number_format($getPrice) }}
                    @endif
                @else
                    @if ($price->priceType[0] == true)
                        @foreach ($price->dataSharingPrice as $sharingPrice)
                            @if ($sharingPrice->checkbox == true)
                                {{ number_format($sharingPrice->price) }}
                                @php
                                    $getPrice = $sharingPrice->price;
                                @endphp
                            @endif
                        @endforeach
                    @endif
                    @if ($price->priceType[1] == true)
                        @foreach ($price->dataExclusivePrice as $exclusivePrice)
                            @if ($exclusivePrice->checkbox == true)
                                {{ number_format($exclusivePrice->price) }}
                                @php
                                    $getPrice = $exclusivePrice->price;
                                @endphp
                            @endif
                        @endforeach
                    @endif
                @endif
            </td>
        </tr>
        @if ($sale->dpp)
            <tr>
                @if ($category == 'Signage')
                    <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="6">DPP</td>
                @elseif ($category == 'Videotron')
                    <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="4">DPP</td>
                @else
                    <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="5">DPP</td>
                @endif
                <td class="text-xs text-teal-700 border text-right px-2">
                    {{ number_format($sale->dpp) }}</td>
            </tr>
            <tr>
                @if ($category == 'Signage')
                    <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="6">(A) PPN
                        {{ $sale->ppn }}%</td>
                @elseif ($category == 'Videotron')
                    <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="4">(A) PPN
                        {{ $sale->ppn }}%</td>
                @else
                    <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="5">(A) PPN
                        {{ $sale->ppn }}%</td>
                @endif
                <td class="text-xs text-teal-700 border text-right px-2">
                    {{ number_format($sale->dpp * ($sale->ppn / 100)) }}
                </td>
            </tr>
            <tr>
                @if ($category == 'Signage')
                    <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="6">(B) PPh
                        {{ $sale->pph }}%</td>
                @elseif ($category == 'Videotron')
                    <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="4">(B) PPh
                        {{ $sale->pph }}%</td>
                @else
                    <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="5">(B) PPh
                        {{ $sale->pph }}%</td>
                @endif
                <td class="text-xs text-teal-700 border text-right px-2">
                    {{ number_format($sale->dpp * ($sale->pph / 100)) }}
                </td>
            </tr>
            <tr>
                @if ($category == 'Signage')
                    <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="6">TOTAL (Harga +
                        A - B)</td>
                @elseif ($category == 'Videotron')
                    <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="4">TOTAL (Harga +
                        A - B)</td>
                @else
                    <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="5">TOTAL (Harga +
                        A - B)</td>
                @endif
                <td class="text-xs text-teal-700 border text-right px-2">
                    {{ number_format($getPrice + $sale->dpp * ($sale->ppn / 100) - $sale->dpp * ($sale->pph / 100)) }}
                </td>
            </tr>
        @endif
    </tbody>
</table>
