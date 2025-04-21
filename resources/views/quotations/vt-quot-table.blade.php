@php
    $descriptions = json_decode($locations[0]->description);
    $maxSlot = 3;
    $slotQty = $descriptions->slots;
    $videotronSales = $locations[0]->videotron_active_sales;
    if (count($videotronSales) != 0) {
        $clientSlots = 0;
        foreach ($videotronSales as $videotronSale) {
            $getPrice = json_decode($videotronSale->quotation->price);
            $clientSlots = $clientSlots + $getPrice->slotQty;
        }
        $maxSlot = $slotQty - $clientSlots;
    }
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
                <td class="px-2 text-xs text-black border font-semibold" colspan="4">
                    {{ $locations[0]->code }} - {{ $locations[0]->city->code }} | {{ $locations[0]->address }}</td>
            </tr>
            <tr>
                <td class="px-2 text-xs text-black border">Ukuran (Screen Size) - Orientasi</td>
                <td class="px-2 text-xs text-black border font-semibold" colspan="4">
                    {{ $locations[0]->media_size->size }} ({{ number_format($descriptions->screen_w) }} pixel x
                    {{ number_format($descriptions->screen_h) }} pixel)
                    -
                    {{ $locations[0]->orientation }}</td>
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
                <td class="px-2 text-xs text-black border font-semibold" colspan="4">P{{ $led->pixel_pitch }} -
                    {{ $led->pixel_config }} - {{ number_format($led->pixel_density) }} pixel / m2</td>
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
                    {{ $led->refresh_rate }} Hz - {{ $descriptions->duration }} detik -
                    {{ $descriptions->slots }} slot
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
                    ({{ $duration_hours }} jam per hari) -
                    {{ $duration_second / $descriptions->duration / $descriptions->slots }} spot / slot /
                    hari</td>
            </tr>
            <tr>
                <td class="px-2 text-xs text-black border" rowspan="2">
                    <div class="flex items-center">
                        <input id="cbSharing" type="checkbox" onclick="sharingPrice(this)" checked>
                        <span class="flex ml-2">Harga Sharing Untuk </span>
                        <input type="number" id="maxSlot" value="{{ $maxSlot }}" hidden>
                        <input id="slotQty"
                            class="text-xs in-out-spin-none text-black w-7 text-center border rounded-md ml-2 outline-none bg-transparent"
                            type="number" min="1" max="{{ $maxSlot }}" value="1"
                            onkeyup="setSLot(this)" onchange="checkSlot(this)">
                        <span class="flex ml-2">Slot</span>
                    </div>
                </td>
                <td class="border bg-slate-100">
                    <div class="flex w-28 justify-center items-center">
                        <input id="cbShareTitle" name="cbShareTitle0" type="checkbox" checked
                            onclick="cbShareCheck(this)">
                        <input input id="shareTitle"
                            class="text-xs text-black  ml-2 w-16 text-center outline-none border rounded-md"
                            type="text" value="1 Bulan" onchange="periodeTitleCheck(this)">
                    </div>
                </td>
                <td class="border bg-slate-100">
                    <div class="flex w-28 justify-center items-center">
                        <input id="cbShareTitle" name="cbShareTitle1" type="checkbox" checked
                            onclick="cbShareCheck(this)">
                        <input id="shareTitle"
                            class="text-xs text-black  ml-2 w-16 text-center outline-none border rounded-md"
                            type="text" value="3 Bulan" onchange="periodeTitleCheck(this)">
                    </div>
                </td>
                <td class="border bg-slate-100">
                    <div class="flex w-28 justify-center items-center">
                        <input id="cbShareTitle" name="cbShareTitle2" type="checkbox" checked
                            onclick="cbShareCheck(this)">
                        <input id="shareTitle"
                            class="text-xs text-black  ml-1 w-16 text-center outline-none border rounded-md"
                            type="text" value="6 Bulan" onchange="periodeTitleCheck(this)">
                    </div>
                </td>
                <td class="border bg-slate-100">
                    <div class="flex w-28 justify-center items-center">
                        <input id="cbShareTitle" name="cbShareTitle3" type="checkbox" checked
                            onclick="cbShareCheck(this)">
                        <input id="shareTitle"
                            class="text-xs text-black  ml-1 w-16 text-center outline-none border rounded-md"
                            type="text" value="1 Tahun" onchange="periodeTitleCheck(this)">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="border">
                    <div class="flex w-28 justify-center items-center">
                        <input id="sharePrice"
                            class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                            type="number" min="0" value="{{ ($locations[0]->price * (27.5 / 100)) / 10 }}"
                            onkeyup="inputPriceChange(this)" onchange="checkPrice(this)">
                    </div>
                </td>
                <td class="border">
                    <div class="flex w-28 justify-center items-center">
                        <input id="sharePrice"
                            class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                            type="number" min="0"
                            value="{{ $locations[0]->price * (27.5 / 100) * (27.5 / 100) }}"
                            onkeyup="inputPriceChange(this)" onchange="checkPrice(this)">
                    </div>
                </td>
                <td class="border">
                    <div class="flex w-28 justify-center items-center">
                        <input id="sharePrice"
                            class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                            type="number" min="0"
                            value="{{ $locations[0]->price * (27.5 / 100) * (52.5 / 100) }}"
                            onkeyup="inputPriceChange(this)" onchange="checkPrice(this)">
                    </div>
                </td>
                <td class="border">
                    <div class="flex w-28 justify-center items-center">
                        <input id="sharePrice"
                            class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                            type="number" min="0" value="{{ $locations[0]->price * (27.5 / 100) }}"
                            onkeyup="inputPriceChange(this)" onchange="checkPrice(this)">
                    </div>
                </td>
            </tr>
            @if (count($videotronSales) == 0)
                <tr>
                    <td class="px-2 text-xs text-black border" rowspan="2">
                        <div class="flex items-center">
                            <input id="cbExclusive" type="checkbox" onclick="exclusivePrice(this)" checked>
                            <span class="flex ml-2">Harga eksklusif</span>
                        </div>
                    </td>
                    <td class="border bg-slate-100">
                        <div class="flex w-28 justify-center items-center">
                            <input id="cbExTitle" name="cbExTitle0" type="checkbox" checked
                                onclick="cbExclusiveCheck(this)">
                            <input class="text-xs text-black  ml-1 w-16 text-center outline-none border rounded-md"
                                type="text" id="exTitle" value="1 Bulan" onchange="periodeTitleCheck(this)">
                        </div>
                    </td>
                    <td class="border bg-slate-100">
                        <div class="flex w-28 justify-center items-center">
                            <input id="cbExTitle" name="cbExTitle1" type="checkbox" checked
                                onclick="cbExclusiveCheck(this)">
                            <input class="text-xs text-black  ml-1 w-16 text-center outline-none border rounded-md"
                                type="text" id="exTitle" value="3 Bulan" onchange="periodeTitleCheck(this)">
                        </div>
                    </td>
                    <td class="border bg-slate-100">
                        <div class="flex w-28 justify-center items-center">
                            <input id="cbExTitle" name="cbExTitle2" type="checkbox" checked
                                onclick="cbExclusiveCheck(this)">
                            <input class="text-xs text-black  ml-1 w-16 text-center outline-none border rounded-md"
                                type="text" id="exTitle" value="6 Bulan" onchange="periodeTitleCheck(this)">
                        </div>
                    </td>
                    <td class="border bg-slate-100">
                        <div class="flex w-28 justify-center items-center">
                            <input id="cbExTitle" name="cbExTitle3" type="checkbox" checked
                                onclick="cbExclusiveCheck(this)">
                            <input class="text-xs text-black  ml-1 w-16 text-center outline-none border rounded-md"
                                type="text" id="exTitle" value="1 Tahun" onchange="periodeTitleCheck(this)">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="border">
                        <div class="flex w-28 justify-center items-center">
                            <input id="exPrice"
                                class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                                type="number" min="0" value="{{ $locations[0]->price / 10 }}"
                                onkeyup="inputPriceChange(this)" onchange="checkPrice(this)">
                        </div>
                    </td>
                    <td class="border">
                        <div class="flex w-28 justify-center items-center">
                            <input id="exPrice"
                                class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                                type="number" min="0" value="{{ $locations[0]->price * (27.5 / 100) }}"
                                onkeyup="inputPriceChange(this)" onchange="checkPrice(this)">
                        </div>
                    </td>
                    <td class="border">
                        <div class="flex w-28 justify-center items-center">
                            <input id="exPrice"
                                class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                                type="number" min="0" value="{{ $locations[0]->price * (52.5 / 100) }}"
                                onkeyup="inputPriceChange(this)" onchange="checkPrice(this)">
                        </div>
                    </td>
                    <td class="border">
                        <div class="flex w-28 justify-center items-center">
                            <input id="exPrice"
                                class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                                type="number" min="0" value="{{ $locations[0]->price }}"
                                onkeyup="inputPriceChange(this)" onchange="checkPrice(this)">
                        </div>
                    </td>
                </tr>
            @else
                <tr hidden>
                    <td class="px-2 text-xs text-black border" rowspan="2">
                        <div class="flex items-center">
                            <input id="cbExclusive" type="checkbox" onclick="exclusivePrice(this)">
                            <span class="flex ml-2">Harga eksklusif</span>
                        </div>
                    </td>
                    <td class="border bg-slate-100">
                        <div class="flex w-28 justify-center items-center">
                            <input id="cbExTitle" name="cbExTitle0" type="checkbox"
                                onclick="cbExclusiveCheck(this)">
                            <input class="text-xs text-black  ml-1 w-16 text-center outline-none border rounded-md"
                                type="text" id="exTitle" value="1 Bulan" onchange="periodeTitleCheck(this)">
                        </div>
                    </td>
                    <td class="border bg-slate-100">
                        <div class="flex w-28 justify-center items-center">
                            <input id="cbExTitle" name="cbExTitle1" type="checkbox"
                                onclick="cbExclusiveCheck(this)">
                            <input class="text-xs text-black  ml-1 w-16 text-center outline-none border rounded-md"
                                type="text" id="exTitle" value="3 Bulan" onchange="periodeTitleCheck(this)">
                        </div>
                    </td>
                    <td class="border bg-slate-100">
                        <div class="flex w-28 justify-center items-center">
                            <input id="cbExTitle" name="cbExTitle2" type="checkbox"
                                onclick="cbExclusiveCheck(this)">
                            <input class="text-xs text-black  ml-1 w-16 text-center outline-none border rounded-md"
                                type="text" id="exTitle" value="6 Bulan" onchange="periodeTitleCheck(this)">
                        </div>
                    </td>
                    <td class="border bg-slate-100">
                        <div class="flex w-28 justify-center items-center">
                            <input id="cbExTitle" name="cbExTitle3" type="checkbox"
                                onclick="cbExclusiveCheck(this)">
                            <input class="text-xs text-black  ml-1 w-16 text-center outline-none border rounded-md"
                                type="text" id="exTitle" value="1 Tahun" onchange="periodeTitleCheck(this)">
                        </div>
                    </td>
                </tr>
                <tr hidden>
                    <td class="border">
                        <div class="flex w-28 justify-center items-center">
                            <input id="exPrice"
                                class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                                type="number" min="0" value="{{ $locations[0]->price / 10 }}"
                                onkeyup="inputPriceChange(this)" onchange="checkPrice(this)">
                        </div>
                    </td>
                    <td class="border">
                        <div class="flex w-28 justify-center items-center">
                            <input id="exPrice"
                                class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                                type="number" min="0" value="{{ $locations[0]->price * (27.5 / 100) }}"
                                onkeyup="inputPriceChange(this)" onchange="checkPrice(this)">
                        </div>
                    </td>
                    <td class="border">
                        <div class="flex w-28 justify-center items-center">
                            <input id="exPrice"
                                class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                                type="number" min="0" value="{{ $locations[0]->price * (52.5 / 100) }}"
                                onkeyup="inputPriceChange(this)" onchange="checkPrice(this)">
                        </div>
                    </td>
                    <td class="border">
                        <div class="flex w-28 justify-center items-center">
                            <input id="exPrice"
                                class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                                type="number" min="0" value="{{ $locations[0]->price }}"
                                onkeyup="inputPriceChange(this)" onchange="checkPrice(this)">
                        </div>
                    </td>
                </tr>
            @endif
            <tr>
                <td class="border px-2 text-right text-xs text-black font-semibold">
                    Include PPN..?
                </td>
                <td class="border px-2 tex-center text-xs text-black font-semibold">
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
                <td class="text-[0.7rem] text-black border text-right font-semibold px-2">Sub Total</td>
                <td id="subTotal" class="flex justify-end text-[0.7rem] text-black border font-semibold px-2"
                    colspan="4">
                </td>
            </tr>
            <tr hidden>
                <td class="text-[0.7rem] text-black border text-right font-semibold px-2">
                    <div class="flex items-center justify-end">
                        <label class="text-[0.7rem] text-black ml-1" for="cbPpn">PPN</label>
                        <input id="ppnValue"
                            class="text-xs text-center border rounded-md text-black outline-none in-out-spin-none w-8 px-1 ml-2"
                            type="number" min="0" max="100" value="{{ $default_vat }}"
                            onkeyup="setPpn(this)" onchange="checkPpn(this)">
                        <label class="text-xs text-black ml-2">% * DPP</label>
                        <input id="dppValue"
                            class="text-right text-[0.7rem] outline-none text-black font-semibold in-out-spin-none w-20 border ml-2 pr-1"
                            type="number" min="0" onkeyup="getDpp(this)" onchange="dppCheck(this)" required>
                    </div>
                </td>
                <td id="ppnNominal" class="flex justify-end text-[0.7rem] text-black border font-semibold px-2"
                    colspan="4">
                </td>
            </tr>
            <tr hidden>
                <td class="text-[0.7rem] text-black border text-right font-semibold px-2">Grand Total</td>
                <td id="grandTotal" class="flex justify-end text-[0.7rem] text-black border font-semibold px-2"
                    colspan="4">
                </td>
            </tr>
        </tbody>
    </table>
</div>
