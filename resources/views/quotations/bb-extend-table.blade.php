<div class="w-[725px]">
    <table class="table-auto mt-2 w-full">
        <thead id="tableTHead">
            <tr>
                <th class="text-[0.7rem] text-black border w-6" rowspan="2">No</th>
                <th class="text-[0.7rem] text-black border w-16" rowspan="2">Kode
                </th>
                <th class="text-[0.7rem] text-black border" rowspan="2">Lokasi
                </th>
                @if ($category == 'Signage')
                    <th class="text-[0.7rem] text-black border" colspan="4">
                        Deskripsi
                    </th>
                @else
                    <th class="text-[0.7rem] text-black border" colspan="3">
                        Deskripsi
                    </th>
                @endif
                <th class="text-[0.7rem] text-black border" colspan="4">Harga
                    (Rp.)
                </th>
            </tr>
            <tr>
                @if ($category == 'Signage')
                    <th class="text-[0.7rem] text-black border w-16">Bentuk</th>
                @else
                    <th class="text-[0.7rem] text-black border w-10">BL/FL</th>
                @endif
                @if ($category == 'Signage')
                    <th class="text-[0.7rem] text-black border w-6">Qty</th>
                @endif
                <th class="text-[0.7rem] text-black border w-8">Side</th>
                <th class="text-[0.7rem] text-black border w-20">Size - V/H</th>
                <th class="border w-[64px]">
                    <div class="flex w-[64px] justify-center items-center">
                        <input id="cbBillboardTitle" name="cbBillboardTitle0" type="checkbox"
                            onclick="cbBillboardCheck(this)" checked>
                        <input id="billboardTitle"
                            class="text-[0.7rem] text-black ml-1 w-12 outline-none border border-stone-700 text-center rounded-sm bg-white"
                            type="text" value="1 Bulan" onchange="periodeTitleCheck(this)">
                    </div>
                </th>
                <th class="border w-[64px]">
                    <div class="flex w-[64px] justify-center items-center">
                        <input id="cbBillboardTitle" name="cbBillboardTitle1" type="checkbox"
                            onclick="cbBillboardCheck(this)" checked>
                        <input id="billboardTitle"
                            class="text-[0.7rem] text-black ml-1 w-12 outline-none border border-stone-700 text-center rounded-sm bg-white"
                            type="text" value="3 Bulan" onchange="periodeTitleCheck(this)">
                    </div>
                </th>
                <th class="border w-[64px]">
                    <div class="flex w-[64px] justify-center items-center">
                        <input id="cbBillboardTitle" name="cbBillboardTitle2" type="checkbox"
                            onclick="cbBillboardCheck(this)" checked>
                        <input id="billboardTitle"
                            class="text-[0.7rem] text-black ml-1 w-12 outline-none border border-stone-700 text-center rounded-sm bg-white"
                            type="text" value="6 Bulan" onchange="periodeTitleCheck(this)">
                    </div>
                </th>
                <th class="border w-20">
                    <div class="flex w-20 justify-center items-center">
                        <input id="cbBillboardTitle" name="cbBillboardTitle3" type="checkbox"
                            onclick="cbBillboardCheck(this)" checked>
                        <input id="billboardTitle"
                            class="text-[0.7rem] text-black ml-1 w-14 outline-none border border-stone-700 text-center rounded-sm bg-white"
                            type="text" value="1 Tahun" onchange="periodeTitleCheck(this)">
                    </div>
                </th>
            </tr>
        </thead>
        <tbody id="tableTBody">
            @foreach ($products as $product)
                <?php
                $description = json_decode($product->description);
                ?>
                <tr>
                    <td class="text-[0.7rem] text-black border text-center">
                        {{ $loop->iteration }}</td>
                    <td class="text-[0.7rem] text-black border text-center">
                        {{ $product->code }}-{{ $product->city_code }}</td>
                    <td class="text-[0.7rem] text-black border px-1">{{ $product->address }}</td>
                    @if ($category == 'Signage')
                        <td class="text-[0.7rem] text-black border text-center">{{ $description->type }}</td>
                    @else
                        <td class="text-[0.7rem] text-black border text-center">
                            @if ($description->lighting == 'Backlight')
                                BL
                            @elseif ($description->lighting == 'Frontlight')
                                FL
                            @endif
                        </td>
                    @endif
                    @if ($category == 'Signage')
                        <td class="text-[0.7rem] text-black border text-center">
                            {{ $description->qty }}
                        </td>
                    @endif
                    <td class="text-[0.7rem] text-black border text-center">
                        {{ (int) filter_var($product->side, FILTER_SANITIZE_NUMBER_INT) }}
                    </td>
                    <td class="text-[0.7rem] text-black border text-center">
                        {{ $product->size }} -
                        @if ($product->orientation == 'Vertikal')
                            V
                        @elseif ($product->orientation == 'Horizontal')
                            H
                        @endif
                    </td>
                    <td class="border text-center">
                        <div class="flex w-[64px] justify-center items-center">
                            <input id="billboardPrice0" name="{{ $product->code }}"
                                class="input-on-td in-out-spin-none w-[64px]" type="number" min="0"
                                value="{{ $product->price / 10 }}" onkeyup="inputPriceChange(this)"
                                onchange="checkPrice(this)">
                        </div>
                    </td>
                    <td class="border text-center">
                        <div class="flex w-[64px] justify-center items-center">
                            <input id="billboardPrice1" name="{{ $product->code }}"
                                class="input-on-td in-out-spin-none w-[64px]" type="number" min="0"
                                value="{{ $product->price * 0.275 }}" onkeyup="inputPriceChange(this)"
                                onchange="checkPrice(this)">
                        </div>
                    </td>
                    <td class="border text-center">
                        <div class="flex w-[64px] justify-center items-center">
                            <input id="billboardPrice2" name="{{ $product->code }}"
                                class="input-on-td in-out-spin-none w-[64px]" type="number" min="0"
                                value="{{ $product->price * 0.525 }}" onkeyup="inputPriceChange(this)"
                                onchange="checkPrice(this)">
                        </div>
                    </td>
                    <td class="border text-center">
                        <div class="flex w-[72px] justify-center items-center">
                            <input id="billboardPrice3" name="{{ $product->code }}"
                                class="input-on-td in-out-spin-none w-[72px]" type="number" min="0"
                                value="{{ $product->price }}" onkeyup="inputPriceChange(this)"
                                onchange="checkPrice(this)">
                        </div>
                    </td>
                </tr>
            @endforeach
            @if ($category == 'Signage')
                <tr>
                    <td class="border px-2 text-right text-xs text-black font-semibold" colspan="11">
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
                    <td class="text-[0.7rem] text-black border text-right font-semibold px-2" colspan="10">Sub
                        Total
                    </td>
                    <td id="subTotal" class="text-[0.7rem] text-black border text-right font-semibold px-2"></td>
                </tr>
                <tr hidden>
                    <td class="text-[0.7rem] text-black border text-right font-semibold px-2" colspan="10">
                        <div class="flex items-center justify-end">
                            <label class="text-[0.7rem] text-black ml-1" for="cbPpn">PPN</label>
                            <input id="ppnValue"
                                class="text-xs text-center border rounded-md text-black outline-none in-out-spin-none w-8 px-1 ml-2"
                                type="number" min="0" max="100" value="11" onkeyup="setPpn(this)"
                                onchange="checkPpn(this)">
                            <label class="text-xs text-black ml-2"> % x DPP </label>
                            @if (count($products) > 1)
                                <input id="dppValue"
                                    class="text-right text-[0.7rem] outline-none text-black font-semibold in-out-spin-none w-20 border ml-2 pr-1"
                                    type="number" min="0" onkeyup="getDpp(this)" onclick="alertDpp()"
                                    required readonly>
                            @else
                                <input id="dppValue"
                                    class="text-right text-[0.7rem] outline-none text-black font-semibold in-out-spin-none w-20 border ml-2 pr-1"
                                    type="number" min="0" onkeyup="getDpp(this)" onchange="dppCheck(this)"
                                    required>
                            @endif
                        </div>
                    </td>
                    <td id="ppnNominal" class="text-[0.7rem] text-black border text-right font-semibold px-2"></td>
                </tr>
                <tr hidden>
                    <td class="text-[0.7rem] text-black border text-right font-semibold px-2" colspan="10">Grand
                        Total</td>
                    <td id="grandTotal" class="text-[0.7rem] text-black border text-right font-semibold px-2"></td>
                </tr>
            @else
                <tr>
                    <td class="border px-2 text-right text-xs text-black font-semibold" colspan="10">
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
                    <td class="text-[0.7rem] text-black border text-right font-semibold px-2" colspan="9">Sub
                        Total
                    </td>
                    <td id="subTotal" class="text-[0.7rem] text-black border text-right font-semibold px-2"></td>
                </tr>
                <tr hidden>
                    <td class="text-[0.7rem] text-black border text-right font-semibold px-2" colspan="9">
                        <div class="flex items-center justify-end">
                            <label class="text-[0.7rem] text-black ml-1" for="cbPpn">PPN</label>
                            <input id="ppnValue"
                                class="text-xs text-center border rounded-md text-black outline-none in-out-spin-none w-8 px-1 ml-2"
                                type="number" min="0" max="100" value="11" onkeyup="setPpn(this)"
                                onchange="checkPpn(this)">
                            <label class="text-xs text-black ml-2"> % x DPP </label>
                            @if (count($products) > 1)
                                <input id="dppValue"
                                    class="text-right text-[0.7rem] outline-none text-black font-semibold in-out-spin-none w-20 border ml-2 pr-1"
                                    type="number" min="0" onkeyup="getDpp(this)" onclick="alertDpp()"
                                    required readonly>
                            @else
                                <input id="dppValue"
                                    class="text-right text-[0.7rem] outline-none text-black font-semibold in-out-spin-none w-20 border ml-2 pr-1"
                                    type="number" min="0" onkeyup="getDpp(this)" onchange="dppCheck(this)"
                                    required>
                            @endif
                        </div>
                    </td>
                    <td id="ppnNominal" class="text-[0.7rem] text-black border text-right font-semibold px-2"></td>
                </tr>
                <tr hidden>
                    <td class="text-[0.7rem] text-black border text-right font-semibold px-2" colspan="9">Grand
                        Total</td>
                    <td id="grandTotal" class="text-[0.7rem] text-black border text-right font-semibold px-2"></td>
                </tr>
            @endif
        </tbody>
        {{-- <thead id="signageTHead">
            <tr>
                <th class="text-[0.7rem] text-black border-black border w-6" rowspan="2">No</th>
                <th class="text-[0.7rem] text-black border-black border w-[72px]" rowspan="2">Kode
                </th>
                <th class="text-[0.7rem] text-black border-black border" rowspan="2">Lokasi
                </th>
                @if ($category == 'Signage')
                    <th class="text-[0.7rem] text-black border-black border" colspan="5">
                        Deskripsi
                    </th>
                @else
                    <th class="text-[0.7rem] text-black border-black border" colspan="3">
                        Deskripsi
                    </th>
                @endif
                <th class="text-[0.7rem] text-black border-black border" colspan="4">Harga
                    (Rp.)
                </th>
            </tr>
            <tr>
                @if ($category == 'Signage')
                    <th class="text-[0.7rem] text-black border-black border w-16">Bentuk</th>
                @endif
                <th class="text-[0.7rem] text-black border-black border w-10">BL/FL</th>
                @if ($category == 'Signage')
                    <th class="text-[0.7rem] text-black border-black border w-8">Qty</th>
                @endif
                <th class="text-[0.7rem] text-black border-black border w-8">Side</th>
                <th class="text-[0.7rem] text-black border-black border w-20">Size - V/H</th>
                @foreach ($price->dataTitle as $title)
                    @if ($title->checkbox == true)
                        <th class="border border-black text-center w-24">
                            <div class="flex w-24 justify-center items-center">
                                <input id="cbBillboardTitle" name="cbBillboardTitle{{ $loop->iteration - 1 }}"
                                    type="checkbox" onclick="cbBillboardCheck(this)" checked hidden>
                                <input id="billboardTitle"
                                    class="text-[0.7rem] text-black w-[88px] text-center outline-none rounded-md border px-1"
                                    type="text" value="{{ $title->title }}" onchange="periodeTitleCheck(this)">
                            </div>
                        </th>
                    @else
                        <th class="border border-black text-center w-24" hidden>
                            <div class="flex w-24 justify-center items-center">
                                <input id="cbBillboardTitle" name="cbBillboardTitle{{ $loop->iteration - 1 }}"
                                    type="checkbox" onclick="cbBillboardCheck(this)" hidden>
                                <input id="billboardTitle"
                                    class="text-[0.7rem] text-black w-[88px] text-center outline-none rounded-md border px-1"
                                    type="text" value="{{ $title->title }}" onchange="periodeTitleCheck(this)">
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
                    <td class="text-[0.7rem] text-black border-black border text-center">
                        {{ $loop->iteration }}</td>
                    <td class="text-[0.7rem] text-black border-black border text-center">
                        {{ $location->code }}-{{ $location->city_code }}</td>
                    <td class="text-[0.7rem] text-black border-black border px-1">{{ $location->address }}</td>
                    @if ($location->category == 'Signage')
                        <td class="text-[0.7rem] text-black border-black border text-center">
                            {{ $description->type }}
                        </td>
                    @endif
                    <td class="text-[0.7rem] text-black border-black border text-center">
                        @if ($description->lighting == 'Backlight')
                            BL
                        @elseif ($description->lighting == 'Frontlight')
                            FL
                        @endif
                    </td>
                    @if ($location->category == 'Signage')
                        <td class="text-[0.7rem] text-black border-black border text-center">
                            {{ $description->qty }}
                        </td>
                    @endif
                    <td class="text-[0.7rem] text-black border-black border text-center">
                        {{ (int) filter_var($location->side, FILTER_SANITIZE_NUMBER_INT) }}
                    </td>
                    <td class="text-[0.7rem] text-black border-black border text-center">
                        {{ $location->size }} -
                        @if ($location->orientation == 'Vertikal')
                            V
                        @elseif ($location->orientation == 'Horizontal')
                            H
                        @endif
                    </td>
                    @foreach ($price->dataPrice as $priceValue)
                        @if ($price->dataTitle[$loop->iteration - 1]->checkbox == true)
                            <td class="text-[0.7rem] text-black border-black border text-center">
                                <div class="flex justify-center items-center">
                                    <input id="billboardPrice{{ $loop->iteration - 1 }}" name="{{ $location->code }}"
                                        class="text-center outline-none border rounded-md in-out-spin-none w-[88px]"
                                        type="number" min="0" value="{{ $priceValue[$row]->price }}"
                                        onkeyup="inputPriceChange(this)" onchange="checkPrice(this)">
                                </div>
                            </td>
                        @else
                            <td class="text-[0.7rem] text-black border-black border text-center" hidden>
                                <div class="flex justify-center items-center">
                                    <input id="billboardPrice{{ $loop->iteration - 1 }}" name="{{ $location->code }}"
                                        class="text-center outline-none border rounded-md in-out-spin-none w-[88px]"
                                        type="number" min="0" value="{{ $priceValue[$row]->price }}"
                                        onkeyup="inputPriceChange(this)" onchange="checkPrice(this)">
                                </div>
                            </td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
            @if ($category == 'Signage')
                <tr>
                    <td class="border px-2 text-right text-xs text-black border-black font-semibold" colspan="9">
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
                    <td class="text-[0.7rem] text-black border-black border text-right font-semibold px-2"
                        colspan="8">Sub
                        Total
                    </td>
                    <td id="subTotal"
                        class="text-[0.7rem] text-black border-black border text-right font-semibold px-2"></td>
                </tr>
                <tr hidden>
                    <td class="text-[0.7rem] text-black border-black border text-right font-semibold px-2"
                        colspan="8">
                        <div class="flex items-center justify-end">
                            <label class="text-[0.7rem] text-black border-black ml-1" for="cbPpn">PPN</label>
                            <input id="ppnValue"
                                class="text-xs text-center border rounded-md text-black border-black outline-none in-out-spin-none w-8 px-1 ml-2"
                                type="number" min="0" max="100" value="11" onkeyup="setPpn(this)"
                                onchange="checkPpn(this)">
                            <label class="text-xs text-black border-black ml-2"> % x DPP </label>
                            <input id="dppValue"
                                class="text-right text-[0.7rem] outline-none text-black border-black font-semibold in-out-spin-none w-20 border ml-2 pr-1"
                                type="number" min="0" onkeyup="getDpp(this)" onchange="dppCheck(this)"
                                required>
                        </div>
                    </td>
                    <td id="ppnNominal"
                        class="text-[0.7rem] text-black border-black border text-right font-semibold px-2"></td>
                </tr>
                <tr hidden>
                    <td class="text-[0.7rem] text-black border-black border text-right font-semibold px-2"
                        colspan="8">Grand
                        Total</td>
                    <td id="grandTotal"
                        class="text-[0.7rem] text-black border-black border text-right font-semibold px-2"></td>
                </tr>
            @else
                <tr>
                    <td class="border px-2 text-right text-xs text-black border-black font-semibold" colspan="7">
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
                    <td class="text-[0.7rem] text-black border-black border text-right font-semibold px-2"
                        colspan="6">Sub
                        Total
                    </td>
                    <td id="subTotal"
                        class="text-[0.7rem] text-black border-black border text-right font-semibold px-2"></td>
                </tr>
                <tr hidden>
                    <td class="text-[0.7rem] text-black border-black border text-right font-semibold px-2"
                        colspan="6">
                        <div class="flex items-center justify-end">
                            <label class="text-[0.7rem] text-black border-black ml-1" for="cbPpn">PPN</label>
                            <input id="ppnValue"
                                class="text-xs text-center border rounded-md text-black border-black outline-none in-out-spin-none w-8 px-1 ml-2"
                                type="number" min="0" max="100" value="11" onkeyup="setPpn(this)"
                                onchange="checkPpn(this)">
                            <label class="text-xs text-black border-black ml-2"> % x DPP </label>
                            <input id="dppValue"
                                class="text-right text-[0.7rem] outline-none text-black border-black font-semibold in-out-spin-none w-20 border ml-2 pr-1"
                                type="number" min="0" onkeyup="getDpp(this)" onchange="dppCheck(this)"
                                required>
                        </div>
                    </td>
                    <td id="ppnNominal"
                        class="text-[0.7rem] text-black border-black border text-right font-semibold px-2">
                    </td>
                </tr>
                <tr hidden>
                    <td class="text-[0.7rem] text-black border-black border text-right font-semibold px-2"
                        colspan="6">Grand
                        Total</td>
                    <td id="grandTotal"
                        class="text-[0.7rem] text-black border-black border text-right font-semibold px-2"></td>
                </tr>
            @endif
        </tbody> --}}
    </table>
</div>
