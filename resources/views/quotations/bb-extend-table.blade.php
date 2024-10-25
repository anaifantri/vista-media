<div class="w-[800px]">
    <table class="table-auto mt-2 w-full">
        <thead id="signageTHead">
            <tr>
                <th class="text-[0.7rem] text-teal-700 border w-6" rowspan="2">No</th>
                <th class="text-[0.7rem] text-teal-700 border w-[72px]" rowspan="2">Kode
                </th>
                <th class="text-[0.7rem] text-teal-700 border" rowspan="2">Lokasi
                </th>
                @if ($category == 'Signage')
                    <th class="text-[0.7rem] text-teal-700 border" colspan="5">
                        Deskripsi
                    </th>
                @else
                    <th class="text-[0.7rem] text-teal-700 border" colspan="3">
                        Deskripsi
                    </th>
                @endif
                <th class="text-[0.7rem] text-teal-700 border" colspan="4">Harga
                    (Rp.)
                </th>
            </tr>
            <tr>
                @if ($category == 'Signage')
                    <th class="text-[0.7rem] text-teal-700 border w-16">Bentuk</th>
                @endif
                <th class="text-[0.7rem] text-teal-700 border w-10">BL/FL</th>
                @if ($category == 'Signage')
                    <th class="text-[0.7rem] text-teal-700 border w-8">Qty</th>
                @endif
                <th class="text-[0.7rem] text-teal-700 border w-8">Side</th>
                <th class="text-[0.7rem] text-teal-700 border w-20">Size - V/H</th>
                @foreach ($price->dataTitle as $title)
                    @if ($title->checkbox == true)
                        <th class="border w-[72px]">
                            <div class="flex w-[72px] justify-center items-center">
                                <input id="cbBillboardTitle" name="cbBillboardTitle{{ $loop->iteration - 1 }}"
                                    type="checkbox" onclick="cbBillboardCheck(this)" checked>
                                <input id="billboardTitle"
                                    class="text-[0.7rem] text-teal-700 ml-1 w-12 outline-none bg-transparent"
                                    type="text" value="{{ $title->title }}">
                            </div>
                        </th>
                    @else
                        <th class="border w-[72px]" hidden>
                            <div class="flex w-[72px] justify-center items-center">
                                <input id="cbBillboardTitle" name="cbBillboardTitle{{ $loop->iteration - 1 }}"
                                    type="checkbox" onclick="cbBillboardCheck(this)">
                                <input id="billboardTitle"
                                    class="text-[0.7rem] text-teal-700 ml-1 w-12 outline-none bg-transparent"
                                    type="text" value="{{ $title->title }}">
                            </div>
                        </th>
                    @endif
                @endforeach
            </tr>
        </thead>
        <tbody id="tableTBody">
            @foreach ($products as $location)
                <?php
                $description = json_decode($location->description);
                $row = $loop->iteration - 1;
                ?>
                <tr>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $loop->iteration }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $location->code }}-{{ $location->city_code }}</td>
                    <td class="text-[0.7rem] text-teal-700 border px-1">{{ $location->address }}</td>
                    @if ($location->category == 'Signage')
                        <td class="text-[0.7rem] text-teal-700 border text-center">
                            {{ $description->type }}
                        </td>
                    @endif
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        @if ($description->lighting == 'Backlight')
                            BL
                        @elseif ($description->lighting == 'Frontlight')
                            FL
                        @endif
                    </td>
                    @if ($location->category == 'Signage')
                        <td class="text-[0.7rem] text-teal-700 border text-center">
                            {{ $description->qty }}
                        </td>
                    @endif
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ (int) filter_var($location->side, FILTER_SANITIZE_NUMBER_INT) }}
                    </td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $location->size }} -
                        @if ($location->orientation == 'Vertikal')
                            V
                        @elseif ($location->orientation == 'Horizontal')
                            H
                        @endif
                    </td>
                    @foreach ($price->dataPrice as $priceValue)
                        @if ($price->dataTitle[$loop->iteration - 1]->checkbox == true)
                            <td class="text-[0.7rem] text-teal-700 border text-center">
                                <div class="flex justify-center items-center">
                                    <input id="billboardPrice{{ $loop->iteration - 1 }}" name="{{ $location->code }}"
                                        class="text-center outline-none in-out-spin-none w-[64px]" type="number"
                                        min="0" value="{{ $priceValue[$row]->price }}">
                                </div>
                            </td>
                        @else
                            <td class="text-[0.7rem] text-teal-700 border text-center" hidden>
                                <div class="flex justify-center items-center">
                                    <input id="billboardPrice{{ $loop->iteration - 1 }}" name="{{ $location->code }}"
                                        class="text-center outline-none in-out-spin-none w-[64px]" type="number"
                                        min="0" value="{{ $priceValue[$row]->price }}">
                                </div>
                            </td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
            @if ($category == 'Signage')
                <tr>
                    <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="8">
                        <div class="flex items-center justify-end">
                            <label> Include PPN..? </label>
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
                    <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="7">Sub
                        Total
                    </td>
                    <td id="subTotal" class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2"></td>
                </tr>
                <tr hidden>
                    <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="7">
                        <div class="flex items-center justify-end">
                            <label class="text-[0.7rem] text-teal-700 ml-1" for="cbPpn">PPN</label>
                            <input id="ppnValue"
                                class="text-xs text-center border rounded-md text-teal-700 outline-none in-out-spin-none w-8 px-1 ml-2"
                                type="number" min="0" max="100" value="11" onkeyup="setPpn(this)">
                            <label class="text-xs text-teal-700 ml-2"> % x DPP </label>
                            <input id="dppValue"
                                class="text-right text-[0.7rem] outline-none text-teal-700 font-semibold in-out-spin-none w-20 border ml-2 pr-1"
                                type="number" min="0" onkeyup="getDpp(this)" required>
                        </div>
                    </td>
                    <td id="ppnNominal" class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2"></td>
                </tr>
                <tr hidden>
                    <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="7">Grand
                        Total</td>
                    <td id="grandTotal" class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2"></td>
                </tr>
            @else
                <tr>
                    <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="7">
                        <div class="flex items-center justify-end">
                            <label> Include PPN..? </label>
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
                    <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="6">Sub
                        Total
                    </td>
                    <td id="subTotal" class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2"></td>
                </tr>
                <tr hidden>
                    <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="6">
                        <div class="flex items-center justify-end">
                            <label class="text-[0.7rem] text-teal-700 ml-1" for="cbPpn">PPN</label>
                            <input id="ppnValue"
                                class="text-xs text-center border rounded-md text-teal-700 outline-none in-out-spin-none w-8 px-1 ml-2"
                                type="number" min="0" max="100" value="11" onkeyup="setPpn(this)">
                            <label class="text-xs text-teal-700 ml-2"> % x DPP </label>
                            <input id="dppValue"
                                class="text-right text-[0.7rem] outline-none text-teal-700 font-semibold in-out-spin-none w-20 border ml-2 pr-1"
                                type="number" min="0" onkeyup="getDpp(this)" required>
                        </div>
                    </td>
                    <td id="ppnNominal" class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2"></td>
                </tr>
                <tr hidden>
                    <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="6">Grand
                        Total</td>
                    <td id="grandTotal" class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2"></td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
