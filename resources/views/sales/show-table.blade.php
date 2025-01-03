<table class="table-auto w-full">
    <thead>
        <tr>
            <th class="text-xs text-black border border-black w-20" rowspan="2">
                Kode
            </th>
            <th class="text-xs text-black border border-black" rowspan="2">Lokasi
            </th>
            @if ($category == 'Signage')
                <th class="text-[0.7rem] text-black border border-black" colspan="4">Deskripsi</th>
            @else
                <th class="text-[0.7rem] text-black border border-black" colspan="3">Deskripsi</th>
            @endif
            <th class="text-xs text-black border border-black w-24">Harga (Rp.)</th>
        </tr>
        <tr>
            @if ($category == 'Signage')
                <th class="text-[0.7rem] text-black border border-black w-16" rowspan="2">Bentuk</th>
            @else
                <th class="text-[0.7rem] text-black border border-black w-10" rowspan="2">BL/FL</th>
            @endif
            @if ($category == 'Signage')
                <th class="text-[0.7rem] text-black border border-black w-6" rowspan="2">Qty</th>
            @endif
            <th class="text-[0.7rem] text-black border border-black w-8" rowspan="2">Side</th>
            <th class="text-xs text-black border border-black w-32">Size - V/H</th>
            <th class="text-xs text-black border border-black w-24">
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
            <td class="text-xs text-black border border-black text-center">
                {{ $product->code }}-{{ $product->city_code }}</td>
            <td class="text-xs text-black border border-black px-2">
                {{ $product->address }}
            </td>
            @if ($category == 'Signage')
                <td class="text-[0.7rem] text-black border border-black text-center">{{ $description->type }}</td>
            @else
                <td class="text-[0.7rem] text-black border border-black text-center">
                    @if ($description->lighting == 'Backlight')
                        BL
                    @elseif ($description->lighting == 'Frontlight')
                        FL
                    @endif
                </td>
            @endif
            @if ($category == 'Signage')
                <td class="text-[0.7rem] text-black border border-black text-center">
                    {{ $description->qty }}
                </td>
            @endif
            <td class="text-[0.7rem] text-black border border-black text-center">
                {{ (int) filter_var($product->side, FILTER_SANITIZE_NUMBER_INT) }}
            </td>
            <td class="text-xs text-black border border-black text-center">
                {{ $product->size }} -
                @if ($product->orientation == 'Vertikal')
                    V
                @elseif ($product->orientation == 'Horizontal')
                    H
                @endif
            </td>
            <td id="previewPrice" class="text-xs  text-black border border-black text-right px-2">
                @if ($category == 'Billboard')
                    @php
                        $getCode = $product->code . '-' . $product->city_code;
                        $getPrice = 0;
                        for ($i = 0; $i < count($price->dataTitle); $i++) {
                            if ($price->dataTitle[$i]->checkbox == true) {
                                $getPrice = $price->dataPrice[$i][0]->price;
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
                            $getCode = $product->code . '-' . $product->city_code;
                            $getPrice = 0;
                            for ($i = 0; $i < count($price->dataTitle); $i++) {
                                if ($price->dataTitle[$i]->checkbox == true) {
                                    $getPrice = $price->dataPrice[$i][0]->price;
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
        @if ($sales->dpp)
            <tr>
                @if ($category == 'Signage')
                    <td class="border border-black px-2 text-right text-xs text-black font-semibold" colspan="6">DPP
                    </td>
                @else
                    <td class="border border-black px-2 text-right text-xs text-black font-semibold" colspan="5">DPP
                    </td>
                @endif
                <td class="text-xs text-black border border-black text-right px-2">
                    {{ number_format($sales->dpp) }}</td>
            </tr>
            <tr>
                @if ($category == 'Signage')
                    <td class="border border-black px-2 text-right text-xs text-black font-semibold" colspan="6">(A)
                        PPN
                        {{ $sales->ppn }}%</td>
                @else
                    <td class="border border-black px-2 text-right text-xs text-black font-semibold" colspan="5">(A)
                        PPN
                        {{ $sales->ppn }}%</td>
                @endif
                <td class="text-xs text-black border border-black text-right px-2">
                    {{ number_format($sales->dpp * ($sales->ppn / 100)) }}
                </td>
            </tr>
            <tr>
                @if ($category == 'Signage')
                    <td class="border border-black px-2 text-right text-xs text-black font-semibold" colspan="6">(B)
                        PPh
                        {{ $sales->pph }}%</td>
                @else
                    <td class="border border-black px-2 text-right text-xs text-black font-semibold" colspan="5">(B)
                        PPh
                        {{ $sales->pph }}%</td>
                @endif
                <td class="text-xs text-black border border-black text-right px-2">
                    {{ number_format($sales->dpp * ($sales->pph / 100)) }}
                </td>
            </tr>
            <tr>
                @if ($category == 'Signage')
                    <td class="border border-black px-2 text-right text-xs text-black font-semibold" colspan="6">
                        TOTAL (Harga +
                        A - B)</td>
                @else
                    <td class="border border-black px-2 text-right text-xs text-black font-semibold" colspan="5">
                        TOTAL (Harga +
                        A - B)</td>
                @endif
                <td class="text-xs text-black border border-black text-right px-2">
                    {{ number_format($getPrice + $sales->dpp * ($sales->ppn / 100) - $sales->dpp * ($sales->pph / 100)) }}
                </td>
            </tr>
        @endif
    </tbody>
</table>
