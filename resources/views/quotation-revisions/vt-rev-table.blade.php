@php
    $descriptions = json_decode($products[0]->description);
    $maxSlot = 3;
    $slotQty = $descriptions->slots;
    $videotronSales = $location->videotron_active_sales;
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
                <th class="text-sm text-black border w-[480px]" colspan="4">
                    Spesifikasi
                </th>
            </tr>
        </thead>
        <tbody id="tableBody">
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
            @if ($quotation->media_category->name == 'Signage')
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
                    {{ $led->vertical_angle }}(V)
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
                            <input type="number" id="maxSlot" value="{{ $maxSlot }}" hidden>
                            <input id="slotQty"
                                class="text-xs in-out-spin-none text-black w-7 text-center border rounded-md ml-2 outline-none bg-transparent"
                                type="number" min="1" max="{{ $maxSlot }}" value="{{ $price->slotQty }}"
                                onkeyup="setSLot(this)" onchange="checkSlot(this)">
                            <span class="flex ml-2">Slot</span>
                        </div>
                    </td>
                    @foreach ($price->dataSharingPrice as $dataSharingPrice)
                        @if ($dataSharingPrice->checkbox == true)
                            <td class="border text-xs text-center bg-slate-100 w-28">
                                <div class="flex w-full justify-center items-center bg-white">
                                    <input id="cbShareTitle" name="cbShareTitle{{ $loop->iteration - 1 }}"
                                        type="checkbox" onclick="cbShareCheck(this)" checked>
                                    <input input id="shareTitle"
                                        class="text-xs text-black  ml-2 w-12 outline-none bg-transparent" type="text"
                                        value="{{ $dataSharingPrice->title }}">
                                </div>
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
                            @php
                                $subTotal = $dataSharingPrice->price;
                            @endphp
                            <td class="border text-xs text-center w-28">
                                <input id="sharePrice"
                                    class="text-center border rounded-md text-xs in-out-spin-none text-black w-[112px] outline-none"
                                    type="number" min="0" value="{{ $dataSharingPrice->price }}"
                                    onkeyup="inputPriceChange(this)" onchange="checkPrice(this)">
                            </td>
                        @else
                            <td class="border text-xs text-center w-28" hidden>
                                <input id="sharePrice"
                                    class="text-center border rounded-md text-xs in-out-spin-none text-black w-[112px] outline-none"
                                    type="number" min="0" value="{{ $dataSharingPrice->price }}"
                                    onkeyup="inputPriceChange(this)" onchange="checkPrice(this)">
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
                                onkeyup="setSLot(this)" onchange="checkSlot(this)">
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
                                class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none"
                                type="number" min="0" value="{{ $dataSharingPrice->price }}"
                                onkeyup="inputPriceChange(this)" onchange="checkPrice(this)">
                        </td>
                    @endforeach
                </tr>
            @endif
            @if ($price->priceType[1] == true)
                <tr>
                    <td class="px-4 text-xs text-black border" rowspan="2">
                        <div class="flex items-center">
                            <input id="cbExclusive" type="checkbox" onclick="exclusivePrice(this)" checked>
                            <span class="flex ml-2">Harga eksklusif</span>
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
                            @php
                                $subTotal = $dataExclusivePrice->price;
                            @endphp
                            <td class="border text-center text-xs text-black w-[112px]">
                                <input id="exPrice"
                                    class="text-xs in-out-spin-none text-center text-black w-[112px] outline-none"
                                    type="number" min="0" value="{{ $dataExclusivePrice->price }}"
                                    onkeyup="inputPriceChange(this)" onchange="checkPrice(this)">
                            </td>
                        @else
                            <td class="border text-center text-xs text-black w-[112px]" hidden>
                                <input id="exPrice"
                                    class="text-xs in-out-spin-none text-center text-black w-[112px] outline-none"
                                    type="number" min="0" value="{{ $dataExclusivePrice->price }}"
                                    onkeyup="inputPriceChange(this)" onchange="checkPrice(this)">
                            </td>
                        @endif
                    @endforeach
                </tr>
            @else
                <tr hidden>
                    <td class="px-4 text-xs text-black border" rowspan="2">
                        <div class="flex items-center">
                            <input id="cbExclusive" type="checkbox" onclick="exclusivePrice(this)">
                            <span class="flex ml-2">Harga eksklusif</span>
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
                                class="text-xs in-out-spin-none text-center text-black w-[112px] outline-none"
                                type="number" min="0" value="{{ $dataExclusivePrice->price }}"
                                onkeyup="inputPriceChange(this)" onchange="checkPrice(this)">
                        </td>
                    @endforeach
                </tr>
            @endif
            @if ($price->objPpn->checked == true)
                <tr>
                    <td class="border px-2 text-right text-xs text-black">
                        Include PPN..?
                    </td>
                    <td class="border px-2 tex-center text-xs text-black" colspan="4">
                        <div class="flex items-center">
                            <input id="ppnYes" class="ml-2" type="radio" name="ppnCheck" value="yes"
                                onclick="ppnCheckAction(this)" checked>
                            <label class="ml-1"> Ya </label>
                            <input id="ppnNo" class="ml-2" type="radio" name="ppnCheck" value="no"
                                onclick="ppnCheckAction(this)">
                            <label class="ml-1"> Tidak </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="text-[0.7rem] text-black border text-right px-2">
                        <div class="flex items-center justify-end">
                            <label class="text-[0.7rem] text-black ml-1" for="cbPpn">PPN</label>
                            <input id="ppnValue" value="{{ $price->objPpn->value }}"
                                class="text-[0.7rem] text-center border rounded-md text-black outline-none in-out-spin-none w-8 px-1 ml-2"
                                type="number" min="0" max="100" value="11" onkeyup="setPpn(this)"
                                onchange="checkPpn(this)">
                            <label class="text-[0.7rem] text-black ml-2">% * DPP</label>
                            <input id="dppValue" value="{{ $price->objPpn->dpp }}"
                                class="text-right text-[0.7rem] outline-none text-black in-out-spin-none w-20 border rounded-md ml-2 pr-1"
                                type="number" min="0" onkeyup="getDpp(this)" onchange="dppCheck(this)"
                                required>
                        </div>
                    </td>
                    <td class="text-[0.7rem] text-black border" colspan="4">
                        <label id="ppnNominal"
                            class="text-[0.7rem] text-black px-1 flex justify-end w-20">{{ number_format(($price->objPpn->value / 100) * $price->objPpn->dpp) }}</label>
                    </td>
                </tr>
                <tr>
                    <td class="text-[0.7rem] text-black border text-right px-2">Grand Total</td>
                    <td class="text-[0.7rem] text-black border" colspan="4">
                        <label id="grandTotal"
                            class="text-[0.7rem] text-black px-1 flex justify-end w-20">{{ number_format(($price->objPpn->value / 100) * $price->objPpn->dpp + $subTotal) }}</label>
                    </td>
                </tr>
            @else
                <tr>
                    <td class="border px-2 text-right text-xs text-black">
                        Include PPN..?
                    </td>
                    <td class="border px-2 tex-center text-xs text-black" colspan="4">
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
                    <td class="text-[0.7rem] text-black border text-right px-2">
                        <div class="flex items-center justify-end">
                            <label class="text-[0.7rem] text-black ml-1" for="cbPpn">PPN</label>
                            <input id="ppnValue" value="{{ $price->objPpn->value }}"
                                class="text-[0.7rem] text-center border rounded-md text-black outline-none in-out-spin-none w-8 px-1 ml-2"
                                type="number" min="0" max="100" value="11" onkeyup="setPpn(this)"
                                onchange="checkPpn(this)">
                            <label class="text-[0.7rem] text-black ml-2">% * DPP</label>
                            <input id="dppValue" value="{{ $price->objPpn->dpp }}"
                                class="text-right text-[0.7rem] outline-none text-black in-out-spin-none w-20 border rounded-md ml-2 pr-1"
                                type="number" min="0" onkeyup="getDpp(this)" onchange="dppCheck(this)"
                                required>
                        </div>
                    </td>
                    <td class="text-[0.7rem] text-black border" colspan="4">
                        <label id="ppnNominal"
                            class="text-[0.7rem] text-black px-1 flex justify-end w-20">{{ number_format(($price->objPpn->value / 100) * $price->objPpn->dpp) }}</label>
                    </td>
                </tr>
                <tr hidden>
                    <td class="text-[0.7rem] text-black border text-right px-2">Grand Total</td>
                    <td class="text-[0.7rem] text-black border" colspan="4">
                        <label id="grandTotal"
                            class="text-[0.7rem] text-black px-1 flex justify-end w-20">{{ number_format(($price->objPpn->value / 100) * $price->objPpn->dpp + $subTotal) }}</label>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
