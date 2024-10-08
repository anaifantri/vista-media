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
                                @endif
                            @endforeach
                        @endif
                        @if ($price->priceType[1] == true)
                            @foreach ($price->dataExclusivePrice as $exclusivePrice)
                                @if ($exclusivePrice->checkbox == true)
                                    {{ $exclusivePrice->title }}
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
                            @endif
                        @endforeach
                    @endif
                    @if ($price->priceType[1] == true)
                        @foreach ($price->dataExclusivePrice as $exclusivePrice)
                            @if ($exclusivePrice->checkbox == true)
                                {{ $exclusivePrice->title }}
                            @endif
                        @endforeach
                    @endif
                @endif
            </th>
        </tr>
    </thead>
    <tbody id="tBodyPreview">
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
                                @endif
                            @endforeach
                        @endif
                        @if ($price->priceType[1] == true)
                            @foreach ($price->dataExclusivePrice as $exclusivePrice)
                                @if ($exclusivePrice->checkbox == true)
                                    {{ number_format($exclusivePrice->price) }}
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
                            @endif
                        @endforeach
                    @endif
                    @if ($price->priceType[1] == true)
                        @foreach ($price->dataExclusivePrice as $exclusivePrice)
                            @if ($exclusivePrice->checkbox == true)
                                {{ number_format($exclusivePrice->price) }}
                            @endif
                        @endforeach
                    @endif
                @endif
            </td>
        </tr>
        <tr>
            <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="4">DPP</td>
            <td id="previewDpp" class="text-xs text-teal-700 border text-right px-2"></td>
        </tr>
        <tr>
            <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="4">(A) PPN (11%)</td>
            <td id="previewPpn" class="text-xs text-teal-700 border text-right px-2">
            </td>
        </tr>
        <tr>
            <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="4">(B) PPh (2%)</td>
            <td id="previewPph" class="text-xs text-teal-700 border text-right px-2">
            </td>
        </tr>
        <tr>
            <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="4">TOTAL (Harga + A - B)
            </td>
            <td id="previewTotal" class="text-xs text-teal-700 border text-right px-2">
            </td>
        </tr>
    </tbody>
</table>
