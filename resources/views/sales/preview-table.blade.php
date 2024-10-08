<table class="table-auto w-full">
    <thead>
        <tr>
            <th class="text-xs text-teal-700 border w-20" rowspan="2">
                Kode
            </th>
            <th class="text-xs text-teal-700 border" rowspan="2">Lokasi
            </th>
            <th class="text-xs text-teal-700 border w-48" colspan="2">
                Deskripsi
            </th>
            <th class="text-xs text-teal-700 border w-24">Harga (Rp.)</th>
        </tr>
        <tr>
            <th class="text-xs text-teal-700 border w-16">Jenis</th>
            <th class="text-xs text-teal-700 border w-32">Size - V/H</th>
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
        @foreach ($products as $data)
            @if ($data->code == $sale->product_code)
                @php
                    $product = $data;
                @endphp
            @endif
        @endforeach
        <tr>
            <td class="text-xs text-teal-700 border text-center">
                {{ $product->code }}-{{ $product->city_code }}</td>
            <td class="text-xs text-teal-700 border px-2">
                {{ $product->address }}
            </td>
            <td class="text-xs text-teal-700 border text-center">
                {{ $product->category }}</td>
            <td class="text-xs text-teal-700 border text-center">
                {{ $product->size }} - {{ $product->side }} -
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
                <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="4">DPP</td>
                <td class="text-xs text-teal-700 border text-right px-2">
                    {{ number_format($sale->dpp) }}</td>
            </tr>
            <tr>
                <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="4">(A) PPN (11%)</td>
                <td class="text-xs text-teal-700 border text-right px-2">
                    {{ number_format($sale->dpp * 0.11) }}
                </td>
            </tr>
            <tr>
                <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="4">(B) PPh (2%)</td>
                <td class="text-xs text-teal-700 border text-right px-2">
                    {{ number_format($sale->dpp * 0.02) }}
                </td>
            </tr>
            <tr>
                <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="4">TOTAL (Harga + A -
                    B)</td>
                <td class="text-xs text-teal-700 border text-right px-2">
                    {{ number_format($getPrice + $sale->dpp * 0.11 - $sale->dpp * 0.02) }}
                </td>
            </tr>
        @endif
    </tbody>
</table>
