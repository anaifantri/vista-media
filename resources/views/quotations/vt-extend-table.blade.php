@php
    $descriptions = json_decode($products[0]->description);
    foreach ($leds as $led) {
        if ($led->id == $descriptions->led_id) {
            $dataLed = $led;
        }
    }
@endphp
<div class="flex justify-center">
    <table class="table-auto mt-2">
        <thead>
            <tr>
                <th class="text-sm text-black border w-60">Deskripsi
                </th>
                <th class="text-sm text-black border w-[472px]" colspan="4">
                    Spesifikasi
                </th>
            </tr>
        </thead>
        <tbody id="tableTBody">
            <tr>
                <td class="px-2 text-xs text-black border">Kode | Lokasi</td>
                <td class="px-2 text-xs text-black font-semibold" colspan="4">
                    {{ $products[0]->code }}-{{ $products[0]->city_code }} | {{ $products[0]->address }}</td>
            </tr>
            <tr>
                <td class="px-2 text-xs text-black border">Ukuran (Screen Size) - Orientasi</td>
                <td class="px-2 text-xs text-black border font-semibold" colspan="4">
                    {{ $products[0]->size }} ({{ $descriptions->screen_w }} pixel x
                    {{ $descriptions->screen_h }} pixel)
                    -
                    {{ $products[0]->orientation }}</td>
            </tr>
            @if ($category == 'Signage')
                <tr>
                    <td class="px-2 text-xs text-black border">Jumlah Signage</td>
                    <td class="px-2 text-xs text-black border font-semibold" colspan="4">
                        {{ $descriptions->qty }} unit
                    </td>
                </tr>
            @endif
            <tr>
                <td class="px-2 text-xs text-black border">Ukuran - Konfigurasi - Kerapatan Pixel</td>
                <td class="px-2 text-xs text-black border font-semibold" colspan="4">P
                    {{ $led->pixel_pitch }} -
                    {{ $led->pixel_config }} - {{ $led->pixel_density }}</td>
            </tr>
            <tr>
                <td class="px-2 text-xs text-black border">Jarak Pandang - Sudut Pandang Terbaik</td>
                <td class="px-2 text-xs text-black border font-semibold" colspan="4">
                    {{ $led->optimal_distance }} - {{ $led->vertical_angle }}(V)/{{ $led->horizontal_angle }}(H)
                </td>
            </tr>
            <tr>
                <td class="px-2 text-xs text-black border">Refresh Rate - Durasi Video - Jumlah Slot</td>
                <td class="px-2 text-xs text-black border font-semibold" colspan="4">
                    {{ $led->refresh_rate }} Hz - {{ $descriptions->duration }} detik - {{ $descriptions->slots }}
                    slot
                </td>
            </tr>
            <tr>
                <?php
                $start = explode(':', date('H:i', strtotime($descriptions->start_at)));
                $end = explode(':', date('H:i', strtotime($descriptions->end_at)));
                $duration_hours = (int) $end[0] - (int) $start[0];
                $duration_second = $duration_hours * 60 * 60;
                ?>
                <td class="px-2 text-xs text-black border">Waktu Tayang - Jumlah Spot</td>
                <td class="px-2 text-xs text-black border font-semibold" colspan="4">
                    {{ date('H:i', strtotime($descriptions->start_at)) }} s.d
                    {{ date('H:i', strtotime($descriptions->end_at)) }}
                    ({{ $duration_hours }} jam) -
                    {{ $duration_second / $descriptions->duration / $descriptions->slots }} spot / slot per hari</td>
            </tr>
            @if ($price->priceType[0] == true)
                <tr>
                    <td class="px-2 text-xs text-black border" rowspan="2">
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
                            <td class="border text-xs text-left bg-slate-100 w-28">
                                <input class="outline-none ml-2" id="cbShareTitle"
                                    name="cbShareTitle{{ $loop->iteration - 1 }}" type="checkbox"
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
                            <td class="border text-xs text-left w-28">
                                <input id="sharePrice"
                                    class="text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold ml-2"
                                    type="number" min="0" value="{{ $dataSharingPrice->price }}">
                            </td>
                        @else
                            <td class="border text-xs text-center w-28" hidden>
                                <input id="sharePrice"
                                    class="text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                                    type="number" min="0" value="{{ $dataSharingPrice->price }}">
                            </td>
                        @endif
                    @endforeach
                </tr>
            @else
                <tr hidden>
                    <td class="px-2 text-xs text-black border" rowspan="2">
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
                    <td class="px-2 text-xs text-black border" rowspan="2">
                        <div class="flex items-center">
                            <input id="cbExclusive" type="checkbox" onclick="exclusivePrice(this)" checked>
                            <span class="flex ml-2">Harga eksklusif (4 slot)</span>
                        </div>
                    </td>
                    @foreach ($price->dataExclusivePrice as $dataExclusivePrice)
                        @if ($dataExclusivePrice->checkbox == true)
                            <td class="border bg-slate-100 text-xs text-black w-28 text-left">
                                <input class="ml-2 outline-none" id="cbExTitle"
                                    name="cbExTitle{{ $loop->iteration - 1 }}" type="checkbox" checked
                                    onclick="cbExclusiveCheck(this)">
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
                            <td class="border text-left text-xs text-black w-[112px]">
                                <input id="exPrice"
                                    class="text-xs in-out-spin-none text-center text-black w-[112px] outline-none font- ml-2"
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
                    <td class="px-2 text-xs text-black border" rowspan="2">
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
            <tr>
                <td class="border px-2 text-right text-xs text-teal-700 font-semibold">
                    Include PPN..?
                </td>
                <td class="border px-2 tex-center text-xs text-teal-700 font-semibold" colspan="4">
                    <div class="flex items-center">
                        <input id="ppnYes" class="ml-2" type="radio" name="ppnCheck" value="yes"
                            onclick="ppnCheckAction(this)">
                        <label class="ml-1"> Ya </label>
                        <input id="ppnNo" class="ml-2" type="radio" name="ppnCheck" value="no"
                            onclick="ppnCheckAction(this)" checked>
                        <label class="ml-1"> Tidak </label>
                    </div>
                </td>
            </tr>
            <tr hidden>
                <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2">
                    <div class="flex items-center justify-end">
                        <label class="text-[0.7rem] text-teal-700 ml-1" for="cbPpn">PPN</label>
                        <input id="ppnValue"
                            class="text-xs text-center border rounded-md text-teal-700 outline-none in-out-spin-none w-8 px-1 ml-2"
                            type="number" min="0" max="100" value="11" onkeyup="setPpn(this)">
                        <label class="text-xs text-teal-700 ml-2">% * DPP</label>
                        <input id="dppValue"
                            class="text-right text-[0.7rem] outline-none text-teal-700 font-semibold in-out-spin-none w-20 border ml-2 pr-1"
                            type="number" min="0" onkeyup="getDpp(this)" required>
                    </div>
                </td>
                <td id="ppnNominal" class="text-[0.7rem] text-teal-700 border font-semibold w-32 px-2"
                    colspan="4">
                </td>
            </tr>
            <tr hidden>
                <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2">Grand Total</td>
                <td id="grandTotal" class="text-[0.7rem] text-teal-700 border font-semibold px-2" colspan="4">
                </td>
            </tr>
        </tbody>
    </table>
</div>
