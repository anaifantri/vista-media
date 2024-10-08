@php
    $descriptions = json_decode($products[0]->description);
    foreach ($leds as $led) {
        if ($led->id == $descriptions->led_id) {
            $dataLed = $led;
        }
    }
    // if ($sale->quotation->quotation_revisions) {
    //     $dataRevisions = $sale->quotation->quotation_revisions;
    //     $lastIndex = count($dataRevisions) - 1;
    //     $price = json_decode($dataRevisions[$lastIndex]->price);
    // } else {
    //     $price = json_decode($locations[0]->quotation->price);
    // }
@endphp
<div class="flex justify-center">
    <table class="table-auto mt-2">
        <thead>
            <tr>
                <th class="text-sm text-black border w-52">Deskripsi
                </th>
                <th class="text-sm text-black border w-[512px]" colspan="4">
                    Spesifikasi
                </th>
            </tr>
        </thead>
        <tbody id="videotronTBody">
            <tr>
                <td class="px-4 text-sm text-black border">Kode Lokasi</td>
                <td class="px-4 text-sm text-black border" colspan="4">
                    {{ $products[0]->code }}-{{ $products[0]->city_code }}</td>
            </tr>
            <tr>
                <td class="px-4 text-sm text-black border">Lokasi</td>
                <td class="px-4 text-sm text-black border" colspan="4">
                    {{ $products[0]->address }}</td>
            </tr>
            <tr>
                <td class="px-4 text-xs text-black border">Ukuran (Screen Size) - Orientasi</td>
                <td class="px-4 text-xs text-black border" colspan="4">
                    {{ $products[0]->size }} ({{ $descriptions->screen_w }} pixel x
                    {{ $descriptions->screen_h }} pixel)
                    -
                    {{ $products[0]->orientation }}</td>
            </tr>
            @if ($category == 'Signage')
                <tr>
                    <td class="px-4 text-xs text-black border">Jumlah Signage</td>
                    <td class="px-4 text-xs text-black border" colspan="4">
                        {{ $descriptions->qty }} unit
                    </td>
                </tr>
            @endif
            <tr>
                <td class="px-4 text-xs text-black border">Ukuran Pixel - Konfigurasi Pixel</td>
                <td class="px-4 text-xs text-black border" colspan="4">P
                    {{ $led->pixel_pitch }} -
                    {{ $led->pixel_config }}</td>
            </tr>
            <tr>
                <td class="px-4 text-xs text-black border">Kerapatan Pixel</td>
                <td class="px-4 text-xs text-black border" colspan="4">
                    {{ $led->pixel_density }}
                </td>
            </tr>
            <tr>
                <td class="px-4 text-xs text-black border">Jarak Pandang Terbaik</td>
                <td class="px-4 text-xs text-black border" colspan="4">
                    {{ $led->optimal_distance }}
                </td>
            </tr>
            <tr>
                <td class="px-4 text-xs text-black border">Sudut Pandang Terbaik</td>
                <td class="px-4 text-xs text-black border" colspan="4">
                    {{ $led->vertical_angle }}(H)
                    {{ $led->horizontal_angle }}(H)</td>
            </tr>
            <tr>
                <td class="px-4 text-xs text-black border">Refresh Rate</td>
                <td class="px-4 text-xs text-black border" colspan="4">
                    {{ $led->refresh_rate }}
                </td>
            </tr>
            <tr>
                <?php
                $start = explode(':', date('H:i', strtotime($descriptions->start_at)));
                $end = explode(':', date('H:i', strtotime($descriptions->end_at)));
                $duration_hours = (int) $end[0] - (int) $start[0];
                $duration_second = $duration_hours * 60 * 60;
                ?>
                <td class="px-4 text-xs text-black border">Waktu Tayang</td>
                <td class="px-4 text-xs text-black border" colspan="4">
                    {{ date('H:i', strtotime($descriptions->start_at)) }} s.d
                    {{ date('H:i', strtotime($descriptions->end_at)) }}
                    ({{ $duration_hours }} jam per hari)</td>
            </tr>
            <tr>
                <td class="px-4 text-xs text-black border">Durasi Video</td>
                <td class="px-4 text-xs text-black border" colspan="4">
                    {{ $descriptions->duration }} detik /
                    slot</td>
            </tr>
            <tr>
                <td class="px-4 text-xs text-black border">Jumlah Slot</td>
                <td class="px-4 text-xs text-black border" colspan="4">{{ $descriptions->slots }}
                    slot</td>
            </tr>
            <tr>
                <td class="px-4 text-xs text-black border">Jumlah Spot</td>
                <td class="px-4 text-xs text-black border" colspan="4">
                    {{ $duration_second / $descriptions->duration / $descriptions->slots }} spot / slot /
                    hari
                </td>
            </tr>
            @if ($price->priceType[0] == true)
                <tr>
                    <td class="px-4 text-xs text-black border" rowspan="2">
                        <div class="flex items-center">
                            <input id="cbSharing" type="checkbox" onclick="sharingPrice(this)" checked>
                            <span class="flex ml-2">Harga Sharing </span>
                            <input id="slotQty"
                                class="text-xs in-out-spin-none text-black w-7 text-center border rounded-md ml-2 outline-none bg-transparent"
                                type="number" min="1" max="3" value="{{ $price->slotQty }}"
                                onkeyup="setSLot(this)">
                            <span class="flex ml-2">Slot</span>
                        </div>
                    </td>
                    @foreach ($price->dataSharingPrice as $dataSharingPrice)
                        @if ($dataSharingPrice->checkbox == true)
                            <td class="border text-xs text-center bg-slate-100 w-28">
                                <input id="cbShareTitle" name="cbShareTitle{{ $loop->iteration - 1 }}" type="checkbox"
                                    onclick="cbShareCheck(this)" checked>
                                <input input id="shareTitle"
                                    class="text-xs text-black  ml-2 w-12 outline-none bg-transparent" type="text"
                                    value="{{ $dataSharingPrice->title }}">
                            </td>
                        @else
                            <td class="border text-xs text-center bg-slate-100 w-28" hidden>
                                <input id="cbShareTitle" name="cbShareTitle{{ $loop->iteration - 1 }}" type="checkbox"
                                    onclick="cbShareCheck(this)">
                                <input input id="shareTitle"
                                    class="text-xs text-black  ml-2 w-12 outline-none bg-transparent" type="text"
                                    value="{{ $dataSharingPrice->title }}">
                            </td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    @foreach ($price->dataSharingPrice as $dataSharingPrice)
                        @if ($dataSharingPrice->checkbox == true)
                            <td class="border text-xs text-center w-28">
                                <input id="sharePrice"
                                    class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                                    type="number" min="0" value="{{ $dataSharingPrice->price }}">
                            </td>
                        @else
                            <td class="border text-xs text-center w-28" hidden>
                                <input id="sharePrice"
                                    class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                                    type="number" min="0" value="{{ $dataSharingPrice->price }}">
                            </td>
                        @endif
                    @endforeach
                </tr>
            @else
                <tr hidden>
                    <td class="px-4 text-xs text-black border" rowspan="2">
                        <div class="flex items-center">
                            <input id="cbSharing" type="checkbox" onclick="sharingPrice(this)">
                            <span class="flex ml-2">Harga Sharing </span>
                            <input id="slotQty"
                                class="text-xs in-out-spin-none text-black w-7 text-center border rounded-md ml-2 outline-none bg-transparent"
                                type="number" min="1" max="3" value="{{ $price->slotQty }}"
                                onkeyup="setSLot(this)">
                            <span class="flex ml-2">Slot</span>
                        </div>
                    </td>
                    @foreach ($price->dataSharingPrice as $dataSharingPrice)
                        <td class="border text-xs text-center bg-slate-100 w-28">
                            <input id="cbShareTitle" name="cbShareTitle{{ $loop->iteration - 1 }}" type="checkbox"
                                onclick="cbShareCheck(this)">
                            <input input id="shareTitle"
                                class="text-xs text-black  ml-2 w-12 outline-none bg-transparent" type="text"
                                value="{{ $dataSharingPrice->title }}">
                        </td>
                    @endforeach
                </tr>
                <tr hidden>
                    @foreach ($price->dataSharingPrice as $dataSharingPrice)
                        <td class="border text-xs text-center w-28">
                            <input id="sharePrice"
                                class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                                type="number" min="0" value="{{ $dataSharingPrice->price }}">
                        </td>
                    @endforeach
                </tr>
            @endif
            @if ($price->priceType[1] == true)
                <tr>
                    <td class="px-4 text-xs text-black border" rowspan="2">
                        <div class="flex items-center">
                            <input id="cbExclusive" type="checkbox" onclick="exclusivePrice(this)" checked>
                            <span class="flex ml-2">Harga eksklusif (4 slot)</span>
                        </div>
                    </td>
                    @foreach ($price->dataExclusivePrice as $dataExclusivePrice)
                        @if ($dataExclusivePrice->checkbox == true)
                            <td class="border bg-slate-100 text-xs text-black w-28 text-center">
                                <input id="cbExTitle" name="cbExTitle{{ $loop->iteration - 1 }}" type="checkbox"
                                    checked onclick="cbExclusiveCheck(this)">
                                <input class="text-xs text-black  ml-1 w-12 outline-none bg-transparent"
                                    type="text" id="exTitle" value="{{ $dataExclusivePrice->title }}">
                            </td>
                        @else
                            <td class="border bg-slate-100 text-xs text-black w-28 text-center" hidden>
                                <input id="cbExTitle" name="cbExTitle{{ $loop->iteration - 1 }}" type="checkbox"
                                    onclick="cbExclusiveCheck(this)">
                                <input class="text-xs text-black  ml-1 w-12 outline-none bg-transparent"
                                    type="text" id="exTitle" value="{{ $dataExclusivePrice->title }}">
                            </td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    @foreach ($price->dataExclusivePrice as $dataExclusivePrice)
                        @if ($dataExclusivePrice->checkbox == true)
                            <td class="border text-center text-xs text-black w-[112px]">
                                <input id="exPrice"
                                    class="text-xs in-out-spin-none text-center text-black w-[112px] outline-none font-semibold"
                                    type="number" min="0" value="{{ $dataExclusivePrice->price }}">
                            </td>
                        @else
                            <td class="border text-center text-xs text-black w-[112px]" hidden>
                                <input id="exPrice"
                                    class="text-xs in-out-spin-none text-center text-black w-[112px] outline-none font-semibold"
                                    type="number" min="0" value="{{ $dataExclusivePrice->price }}">
                            </td>
                        @endif
                    @endforeach
                </tr>
            @else
                <tr hidden>
                    <td class="px-4 text-xs text-black border" rowspan="2">
                        <div class="flex items-center">
                            <input id="cbExclusive" type="checkbox" onclick="exclusivePrice(this)">
                            <span class="flex ml-2">Harga eksklusif (4 slot)</span>
                        </div>
                    </td>
                    @foreach ($price->dataExclusivePrice as $dataExclusivePrice)
                        <td class="border bg-slate-100 text-xs text-black w-28 text-center">
                            <input id="cbExTitle" name="cbExTitle0" type="checkbox"
                                onclick="cbExclusiveCheck(this)">
                            <input class="text-xs text-black  ml-1 w-12 outline-none bg-transparent" type="text"
                                id="exTitle" value="{{ $dataExclusivePrice->title }}">
                        </td>
                    @endforeach
                </tr>
                <tr hidden>
                    @foreach ($price->dataExclusivePrice as $dataExclusivePrice)
                        <td class="border text-center text-xs text-black w-[112px]">
                            <input id="exPrice"
                                class="text-xs in-out-spin-none text-center text-black w-[112px] outline-none font-semibold"
                                type="number" min="0" value="{{ $dataExclusivePrice->price }}">
                        </td>
                    @endforeach
                </tr>
            @endif
            {{-- @if ($price->priceType[0] == true)
                <tr>
                    <td class="px-4 text-xs text-black border" rowspan="2">
                        <div class="flex items-center">
                            <input id="cbSharing" type="checkbox" onclick="sharingPrice(this)" checked readonly>
                            <span class="flex ml-2">Harga Sharing </span>
                            <input id="slotQty"
                                class="text-xs in-out-spin-none text-black w-7 text-center border rounded-md ml-2 outline-none bg-transparent"
                                type="number" min="1" max="3" value="{{ $price->slotQty }}" readonly>
                            <span class="flex ml-2">Slot</span>
                        </div>
                    </td>
                    @foreach ($price->dataSharingPrice as $dataSharingPrice)
                        @if ($dataSharingPrice->checkbox == true)
                            <td class="border bg-slate-100">
                                <div class="flex w-28 justify-center items-center">
                                    <input id="cbShareTitle" name="cbShareTitle{{ $loop->iteration - 1 }}"
                                        type="checkbox" checked onclick="cbShareCheck(this)">
                                    <input input id="shareTitle"
                                        class="text-xs text-black  ml-2 w-12 outline-none bg-transparent" type="text"
                                        value="1 Bulan">
                                </div>
                            </td>
                        @else
                            <td class="border bg-slate-100" hidden>
                                <div class="flex w-28 justify-center items-center">
                                    <input id="cbShareTitle" name="cbShareTitle{{ $loop->iteration - 1 }}"
                                        type="checkbox" checked onclick="cbShareCheck(this)">
                                    <input input id="shareTitle"
                                        class="text-xs text-black  ml-2 w-12 outline-none bg-transparent" type="text"
                                        value="1 Bulan">
                                </div>
                            </td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    @foreach ($price->dataSharingPrice as $dataSharingPrice)
                        @if ($dataSharingPrice->checkbox == true)
                            <td class="border">
                                <div class="flex w-28 justify-center items-center">
                                    <input id="sharePrice"
                                        class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                                        type="number" min="0" value="{{ $dataSharingPrice->price }}">
                                </div>
                            </td>
                        @else
                            <td class="border" hidden>
                                <div class="flex w-28 justify-center items-center">
                                    <input id="sharePrice"
                                        class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                                        type="number" min="0" value="{{ $dataSharingPrice->price }}">
                                </div>
                            </td>
                        @endif
                    @endforeach
                </tr>
            @endif
            @if ($price->priceType[1] == true)
                <tr>
                    <td class="px-4 text-xs text-black border" rowspan="2">
                        <div class="flex items-center">
                            <input id="cbExclusive" type="checkbox" onclick="exclusivePrice(this)" checked>
                            <span class="flex ml-2">Harga eksklusif (4 slot)</span>
                        </div>
                    </td>
                    @foreach ($price->dataExclusivePrice as $dataExclusivePrice)
                        @if ($dataExclusivePrice->checkbox == true)
                            <td class="border bg-slate-100">
                                <div class="flex w-28 justify-center items-center">
                                    <input id="cbExTitle" name="cbExTitle{{ $loop->iteration - 1 }}" type="checkbox"
                                        checked onclick="cbExclusiveCheck(this)">
                                    <input class="text-xs text-black  ml-1 w-12 outline-none bg-transparent"
                                        type="text" id="exTitle" value="{{ $dataExclusivePrice->title }}">
                                </div>
                            </td>
                        @else
                            <td class="border bg-slate-100" hidden>
                                <div class="flex w-28 justify-center items-center">
                                    <input id="cbExTitle" name="cbExTitle{{ $loop->iteration - 1 }}" type="checkbox"
                                        checked onclick="cbExclusiveCheck(this)">
                                    <input class="text-xs text-black  ml-1 w-12 outline-none bg-transparent"
                                        type="text" id="exTitle" value="{{ $dataExclusivePrice->title }}">
                                </div>
                            </td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    @foreach ($price->dataExclusivePrice as $dataExclusivePrice)
                        @if ($dataExclusivePrice->checkbox == true)
                            <td class="border text-center">
                                <div class="flex w-28 justify-center items-center">
                                    <input id="exPrice"
                                        class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                                        type="number" min="0" value="{{ $dataExclusivePrice->price }}">
                                </div>
                            </td>
                        @else
                            <td class="border text-center" hidden>
                                <div class="flex w-28 justify-center items-center">
                                    <input id="exPrice"
                                        class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                                        type="number" min="0" value="{{ $dataExclusivePrice->price }}">
                                </div>
                            </td>
                        @endif
                    @endforeach
                </tr>
            @endif --}}
        </tbody>
    </table>
</div>
