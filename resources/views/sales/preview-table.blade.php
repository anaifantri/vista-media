<table class="table-auto w-full">
    <thead>
        <tr>
            <th class="text-xs text-black border border-black w-20" rowspan="2">
                Kode
            </th>
            <th class="text-xs text-black border border-black" rowspan="2">Lokasi
            </th>
            @if ($category == 'Signage')
                <th class="text-[0.7rem] text-black border border-black" colspan="5">Deskripsi</th>
            @elseif ($category == 'Videotron')
                <th class="text-[0.7rem] text-black border border-black" colspan="4">Deskripsi</th>
            @else
                <th class="text-[0.7rem] text-black border border-black" colspan="4">Deskripsi</th>
            @endif
            <th class="text-xs text-black border border-black w-24">Harga (Rp.)</th>
        </tr>
        <tr>
            @if ($category == 'Signage')
                <th class="text-[0.7rem] text-black border border-black w-[72px]" rowspan="2">Bentuk</th>
            @else
                <th class="text-[0.7rem] text-black border border-black w-10" rowspan="2">Jenis</th>
            @endif
            <th class="text-[0.7rem] text-black border border-black w-10" rowspan="2">BL/FL</th>
            @if ($category == 'Signage')
                <th class="text-[0.7rem] text-black border border-black w-6" rowspan="2">Qty</th>
            @endif
            <th class="text-[0.7rem] text-black border border-black w-8" rowspan="2">Side</th>
            <th class="text-xs text-black border border-black w-20">Size - V/H</th>
            <th class="text-xs text-black border border-black w-24">
                @if ($category == 'Videotron' || ($category == 'Signage' && $description->type == 'Videotron'))
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
            <td class="text-xs text-black border border-black px-2 text-center">
                @if ($category == 'Signage')
                    {{ $description->type }}
                @else
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
                @endif
            </td>
            @if ($product->category == 'Videotron' || ($product->category == 'Signage' && $description->type == 'Videotron'))
                <td class="text-xs text-black border border-black text-center">-</td>
            @else
                <td class="text-xs text-black border border-black text-center">
                    @if ($description->lighting == 'Backlight')
                        BL
                    @elseif ($description->lighting == 'Frontlight')
                        FL
                    @elseif ($description->lighting == 'Nonlight')
                        -
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
                @if ($category == 'Videotron' || ($category == 'Signage' && $description->type == 'Videotron'))
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
                    <td class="text-xs text-black border border-black px-2" colspan="{{ $colSpan }}">
                        <div class="flex">
                            <span class="w-20">Biaya Cetak</span>
                            <span>-> Bahan</span>
                            <span class="ml-2">:</span>
                            <span class="ml-2">{{ $notes->includedPrint->product }}</span>
                            <span class="ml-4">-> Harga/m2</span>
                            <span class="ml-2">:</span>
                            <span class="ml-2">Rp. {{ number_format($notes->includedPrint->price) }},-</span>
                            <span class="ml-4">-> Jumlah : </span>
                            <span class="ml-2">{{ $notes->includedPrint->qty }}</span>
                            <span class="ml-4">-> Luas media : </span>
                            <span class="ml-2">:</span>
                            <span class="ml-2">{{ $wide }}</span>
                            <span class="ml-2">m2</span>
                        </div>
                    </td>
                    <td id="totalPrint" class="text-xs text-black border border-black text-right px-2">
                        @php
                            $totalPrint = $notes->includedPrint->price * $notes->includedPrint->qty * $wide;
                        @endphp
                        {{ number_format($totalPrint) }}
                    </td>
                </tr>
                <!-- Row include print end -->
            @endif
            @if (isset($notes->includedInstall) && $notes->includedInstall->checked == true)
                <!-- Row include print start -->
                <tr>
                    <td class="text-xs text-black border border-black px-2" colspan="{{ $colSpan }}">
                        <div class="flex">
                            <span class="w-20">Biaya Pasang</span>
                            <span>-> Bahan</span>
                            <span class="ml-2">:</span>
                            <span class="ml-2">{{ $description->lighting }}</span>
                            <span class="ml-4">-> Harga/m2</span>
                            <span class="ml-2">:</span>
                            <span class="ml-2">Rp. {{ number_format($notes->includedInstall->price) }},-</span>
                            <span class="ml-4">-> Jumlah : </span>
                            <span class="ml-2">{{ $notes->includedInstall->qty }}</span>
                            <span class="ml-4">-> Luas media : </span>
                            <span class="ml-2">:</span>
                            <span class="ml-2">{{ $wide }}</span>
                            <span class="ml-2">m2</span>
                        </div>
                    </td>
                    <td id="totalInstall" class="text-xs text-black border border-black text-right px-2">
                        @php
                            $totalInstall = $notes->includedInstall->price * $notes->includedInstall->qty * $wide;
                        @endphp
                        {{ number_format($totalInstall) }}
                    </td>
                </tr>
                <!-- Row include print end -->
            @endif
        @endif
        <tr>
            @if ($sale->dpp != $getPrice)
                @if ($category == 'Signage')
                    <td class="border border-black px-2 text-right text-xs text-black font-semibold" colspan="7">DPP
                    </td>
                @elseif ($category == 'Videotron')
                    <td class="border border-black px-2 text-right text-xs text-black font-semibold" colspan="6">DPP
                    </td>
                @else
                    <td class="border border-black px-2 text-right text-xs text-black font-semibold" colspan="6">DPP
                    </td>
                @endif
                <td class="text-xs text-black border border-black text-right px-2">
                    {{ number_format($sale->dpp) }}</td>
            @endif
        </tr>
        <tr>
            @if ($category == 'Signage')
                <td class="border border-black px-2 text-right text-xs text-black font-semibold" colspan="7">PPN
                    {{ $sale->ppn }}%</td>
            @elseif ($category == 'Videotron')
                <td class="border border-black px-2 text-right text-xs text-black font-semibold" colspan="6">PPN
                    {{ $sale->ppn }}%</td>
            @else
                <td class="border border-black px-2 text-right text-xs text-black font-semibold" colspan="6">PPN
                    {{ $sale->ppn }}%</td>
            @endif
            <td class="text-xs text-black border border-black text-right px-2">
                {{ number_format($sale->dpp * ($sale->ppn / 100)) }}
            </td>
        </tr>
        <tr>
            @if ($category == 'Signage')
                <td class="border border-black px-2 text-right text-xs text-black font-semibold" colspan="7">
                    TOTAL</td>
            @elseif ($category == 'Videotron')
                <td class="border border-black px-2 text-right text-xs text-black font-semibold" colspan="6">
                    TOTAL</td>
            @else
                <td class="border border-black px-2 text-right text-xs text-black font-semibold" colspan="6">
                    TOTAL</td>
            @endif
            <td class="text-xs text-black border border-black text-right px-2">
                {{ number_format($getPrice + $sale->dpp * ($sale->ppn / 100) - $sale->dpp * ($sale->pph / 100) + $totalInstall + $totalPrint) }}
            </td>
        </tr>
    </tbody>
</table>
