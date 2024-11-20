@php
    $cbTitle = 0;
    foreach ($price->dataTitle as $dataTitle) {
        if ($dataTitle->checkbox == true) {
            $cbTitle = $cbTitle + 1;
        }
    }
    if ($cbTitle > 2) {
        $width = 850;
    } else {
        $width = 725;
    }
    $colSpan = 0;
@endphp
<div class="w-[{{ $width }}px]">
    <table class="table-auto mt-2 w-full">
        <thead>
            <tr>
                <th class="text-[0.7rem] text-stone-900 border border-black w-6" rowspan="2">No
                </th>
                <th class="text-[0.7rem] text-stone-900 border border-black w-[72px]" rowspan="2">
                    Kode
                </th>
                <th class="text-[0.7rem] text-stone-900 border border-black" rowspan="2">Lokasi
                </th>
                @if ($category == 'Signage')
                    <th class="text-[0.7rem] text-stone-900 border border-black" colspan="4">
                        Deskripsi
                    </th>
                @else
                    <th class="text-[0.7rem] text-stone-900 border border-black" colspan="3">
                        Deskripsi
                    </th>
                @endif
                <th class="text-[0.7rem] text-stone-900 border border-black" colspan="{{ $cbTitle }}">Harga
                    (Rp.)
                </th>
                <th class="text-[0.7rem] text-stone-900 border border-black w-8" rowspan="2"></th>
            </tr>
            <tr>
                @if ($category == 'Signage')
                    <th class="text-[0.7rem] text-stone-900 border border-black w-16">Bentuk</th>
                @else
                    <th class="text-[0.7rem] text-stone-900 border border-black w-10">BL/FL</th>
                @endif
                @if ($category == 'Signage')
                    <th class="text-[0.7rem] text-stone-900 border border-black w-6">Qty</th>
                @endif
                <th class="text-[0.7rem] text-stone-900 border border-black w-8">Side</th>
                <th class="text-[0.7rem] text-stone-900 border border-black w-20">Size - V/H</th>
                @foreach ($price->dataTitle as $title)
                    @if ($title->checkbox == true)
                        @php
                            $colSpan++;
                        @endphp
                        <th class="border border-black w-[72px]">
                            <div class="flex w-[72px] justify-center items-center">
                                <input id="cbBillboardTitle" name="cbBillboardTitle{{ $loop->iteration - 1 }}"
                                    type="checkbox" onclick="cbBillboardCheck(this)" checked>
                                <input id="billboardTitle"
                                    class="text-[0.7rem] text-stone-900 border text-center px-1 rounded-md ml-1 w-14 outline-none bg-transparent"
                                    type="text" value="{{ $title->title }}" onchange="periodeTitleCheck(this)">
                            </div>
                        </th>
                    @else
                        <th class="border border-black w-[72px]" hidden>
                            <div class="flex w-[72px] justify-center items-center">
                                <input id="cbBillboardTitle" name="cbBillboardTitle{{ $loop->iteration - 1 }}"
                                    type="checkbox" onclick="cbBillboardCheck(this)">
                                <input id="billboardTitle"
                                    class="text-[0.7rem] text-stone-900 border text-center px-1 rounded-md ml-1 w-14 outline-none bg-transparent"
                                    type="text" value="{{ $title->title }}" onchange="periodeTitleCheck(this)">
                            </div>
                        </th>
                    @endif
                @endforeach
            </tr>
        </thead>
        <tbody id="tableBody">
            @php
                $subTotal = 0;
            @endphp
            @foreach ($products as $product)
                <?php
                $row = $loop->iteration - 1;
                $description = json_decode($product->description);
                ?>
                <tr>
                    <td class="text-[0.7rem] text-stone-900 border border-black text-center">
                        {{ $loop->iteration }}</td>
                    <td class="text-[0.7rem] text-stone-900 border border-black text-center">
                        {{ $product->code }}-{{ $product->city_code }}</td>
                    <td class="text-[0.7rem] text-stone-900 border border-black">
                        {{ $product->address }}
                    </td>
                    @if ($category == 'Signage')
                        <td class="text-[0.7rem] text-stone-900 border border-black text-center">
                            {{ $description->type }}</td>
                    @else
                        <td class="text-[0.7rem] text-stone-900 border border-black text-center">
                            @if ($description->lighting == 'Backlight')
                                BL
                            @elseif ($description->lighting == 'Frontlight')
                                FL
                            @endif
                        </td>
                    @endif
                    @if ($category == 'Signage')
                        <td class="text-[0.7rem] text-stone-900 border border-black text-center">
                            {{ $description->qty }}
                        </td>
                    @endif
                    <td class="text-[0.7rem] text-stone-900 border border-black text-center">
                        {{ (int) filter_var($product->side, FILTER_SANITIZE_NUMBER_INT) }}
                    </td>
                    <td class="text-[0.7rem] text-stone-900 border border-black text-center">
                        {{ $product->size }} -
                        @if ($product->orientation == 'Vertikal')
                            V
                        @elseif ($product->orientation == 'Horizontal')
                            H
                        @endif
                    </td>
                    @foreach ($price->dataPrice as $priceValue)
                        @if ($price->dataTitle[$loop->iteration - 1]->checkbox == true)
                            @php
                                $subTotal = $subTotal + $priceValue[$row]->price;
                            @endphp
                            <td class="text-[0.7rem] text-stone-900 border border-black text-center">
                                <div class="flex justify-center items-center">
                                    <input id="billboardPrice{{ $loop->iteration - 1 }}" name="{{ $product->code }}"
                                        class="text-center outline-none in-out-spin-none w-[64px]" type="number"
                                        min="0" value="{{ $priceValue[$row]->price }}"
                                        onkeyup="inputPriceChange(this)" onchange="checkPrice(this)">
                                </div>
                            </td>
                        @else
                            <td class="text-[0.7rem] text-stone-900 border border-black text-center" hidden>
                                <div class="flex justify-center items-center">
                                    <input id="billboardPrice{{ $loop->iteration - 1 }}" name="{{ $product->code }}"
                                        class="text-center outline-none in-out-spin-none w-[64px]" type="number"
                                        min="0" value="{{ $priceValue[$row]->price }}"
                                        onkeyup="inputPriceChange(this)" onchange="checkPrice(this)">
                                </div>
                            </td>
                        @endif
                    @endforeach
                    <td class="text-[0.7rem] text-stone-900 border border-black">
                        <button type="button" id="{{ $loop->iteration - 1 }}" name="{{ $product->id }}"
                            class="btn-del-note w-max h-4" onclick="removeLocation(this)">
                            <svg class="fill-current w-3" clip-rule="evenodd" fill-rule="evenodd"
                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.151 17.943l-4.143-4.102-4.117 4.159-1.833-1.833 4.104-4.157-4.162-4.119 1.833-1.833 4.155 4.102 4.106-4.16 1.849 1.849-4.1 4.141 4.157 4.104-1.849 1.849z" />
                            </svg>
                        </button>
                    </td>
                </tr>
            @endforeach
            @if ($category == 'Signage')
                @if ($price->objPpn->checked == true)
                    <tr>
                        <td class="border border-black px-2 text-right text-xs text-black font-semibold"
                            colspan="{{ $colSpan + 7 }}">
                            <div class="flex items-center justify-end">
                                <label> Include PPN..? </label>
                                <input id="ppnYes" class="ml-2" type="radio" name="ppnCheck" value="yes"
                                    onclick="ppnCheckAction(this)" checked>
                                <label class="ml-1"> Ya </label>
                                <input id="ppnNo" class="ml-2" type="radio" name="ppnCheck" value="no"
                                    onclick="ppnCheckAction(this)">
                                <label class="ml-1"> Tidak </label>
                            </div>
                        </td>
                        <td class="border border-black"></td>
                    </tr>
                    <tr>
                        <td class="text-[0.7rem] text-black border border-black text-right font-semibold px-2"
                            colspan="{{ $colSpan + 6 }}">Sub
                            Total
                        </td>
                        <td id="subTotal"
                            class="text-[0.7rem] text-black border border-black text-right font-semibold px-2">
                            {{ $subTotal }}</td>
                        <td class="border border-black"></td>
                    </tr>
                    <tr>
                        <td class="text-[0.7rem] text-black border border-black text-right font-semibold px-2"
                            colspan="{{ $colSpan + 6 }}">
                            <div class="flex items-center justify-end">
                                <label class="text-[0.7rem] text-black ml-1" for="cbPpn">PPN</label>
                                <input id="ppnValue"
                                    class="text-xs text-center border border-black rounded-sm text-black outline-none in-out-spin-none w-8 px-1 ml-2"
                                    type="number" min="0" max="100"
                                    value="{{ $price->objPpn->value }}" onkeyup="setPpn(this)"
                                    onchange="checkPpn(this)">
                                <label class="text-xs text-black ml-2"> % x DPP </label>
                                @if (count($products) > 1)
                                    <input id="dppValue" value="{{ $price->objPpn->dpp }}"
                                        class="text-right text-[0.7rem] outline-none text-black font-semibold in-out-spin-none w-20 border rounded-sm border-black ml-2 pr-1"
                                        type="number" min="0" onkeyup="getDpp(this)" onclick="alertDpp()"
                                        readonly required>
                                @else
                                    <input id="dppValue" value="{{ $price->objPpn->dpp }}"
                                        class="text-right text-[0.7rem] outline-none text-black font-semibold in-out-spin-none w-20 border rounded-sm border-black ml-2 pr-1"
                                        type="number" min="0" onkeyup="getDpp(this)"
                                        onchange="dppCheck(this)" required>
                                @endif
                            </div>
                        </td>
                        <td id="ppnNominal"
                            class="text-[0.7rem] text-black border border-black text-right font-semibold px-2">
                            {{ ($price->objPpn->value / 100) * $price->objPpn->dpp }}
                        </td>
                        <td class="border border-black"></td>
                    </tr>
                    <tr>
                        <td class="text-[0.7rem] text-black border border-black text-right font-semibold px-2"
                            colspan="{{ $colSpan + 6 }}">Grand
                            Total</td>
                        <td id="grandTotal"
                            class="text-[0.7rem] text-black border border-black text-right font-semibold px-2">
                            {{ $subTotal + ($price->objPpn->value / 100) * $price->objPpn->dpp }}
                        </td>
                        <td class="border border-black"></td>
                    </tr>
                @else
                    <tr>
                        <td class="border border-black px-2 text-right text-xs text-black font-semibold"
                            colspan="{{ $colSpan + 7 }}">
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
                        <td class="border border-black"></td>
                    </tr>
                    <tr hidden>
                        <td class="text-[0.7rem] text-black border border-black text-right font-semibold px-2"
                            colspan="{{ $colSpan + 6 }}">Sub
                            Total
                        </td>
                        <td id="subTotal"
                            class="text-[0.7rem] text-black border border-black text-right font-semibold px-2"></td>
                        <td class="border border-black"></td>
                    </tr>
                    <tr hidden>
                        <td class="text-[0.7rem] text-black border border-black text-right font-semibold px-2"
                            colspan="{{ $colSpan + 6 }}">
                            <div class="flex items-center justify-end">
                                <label class="text-[0.7rem] text-black ml-1" for="cbPpn">PPN</label>
                                <input id="ppnValue"
                                    class="text-xs text-center border border-black rounded-sm text-black outline-none in-out-spin-none w-8 px-1 ml-2"
                                    type="number" min="0" max="100" value="11"
                                    onkeyup="setPpn(this)" onchange="checkPpn(this)">
                                <label class="text-xs text-black ml-2"> % x DPP </label>
                                @if (count($products) > 1)
                                    <input id="dppValue"
                                        class="text-right text-[0.7rem] outline-none text-black font-semibold in-out-spin-none w-20 border  rounded-sm border-black ml-2 pr-1"
                                        type="number" min="0" onkeyup="getDpp(this)" onclick="alertDpp()"
                                        readonly required>
                                @else
                                    <input id="dppValue"
                                        class="text-right text-[0.7rem] outline-none text-black font-semibold in-out-spin-none w-20 border  rounded-sm border-black ml-2 pr-1"
                                        type="number" min="0" onkeyup="getDpp(this)"
                                        onchange="dppCheck(this)" required>
                                @endif
                            </div>
                        </td>
                        <td id="ppnNominal"
                            class="text-[0.7rem] text-black border border-black text-right font-semibold px-2">
                        </td>
                        <td class="border border-black"></td>
                    </tr>
                    <tr hidden>
                        <td class="text-[0.7rem] text-black border border-black text-right font-semibold px-2"
                            colspan="{{ $colSpan + 6 }}">Grand
                            Total</td>
                        <td id="grandTotal"
                            class="text-[0.7rem] text-black border border-black text-right font-semibold px-2">
                        </td>
                        <td class="border border-black"></td>
                    </tr>
                @endif
            @else
                @if ($price->objPpn->checked == true)
                    <tr>
                        <td class="border border-black px-2 text-right text-xs text-black font-semibold"
                            colspan="{{ $colSpan + 6 }}">
                            <div class="flex items-center justify-end">
                                <label> Include PPN..? </label>
                                <input id="ppnYes" class="ml-2" type="radio" name="ppnCheck" value="yes"
                                    onclick="ppnCheckAction(this)" checked>
                                <label class="ml-1"> Ya </label>
                                <input id="ppnNo" class="ml-2" type="radio" name="ppnCheck" value="no"
                                    onclick="ppnCheckAction(this)">
                                <label class="ml-1"> Tidak </label>
                            </div>
                        </td>
                        <td class="border border-black"></td>
                    </tr>
                    <tr>
                        <td class="text-[0.7rem] text-black border border-black text-right font-semibold px-2"
                            colspan="{{ $colSpan + 5 }}">Sub
                            Total
                        </td>
                        <td id="subTotal"
                            class="text-[0.7rem] text-black border border-black text-right font-semibold px-2">
                            {{ $subTotal }}</td>
                        <td class="border border-black"></td>
                    </tr>
                    <tr>
                        <td class="text-[0.7rem] text-black border border-black text-right font-semibold px-2"
                            colspan="{{ $colSpan + 5 }}">
                            <div class="flex items-center justify-end">
                                <label class="text-[0.7rem] text-black ml-1" for="cbPpn">PPN</label>
                                <input id="ppnValue"
                                    class="text-xs text-center border border-black rounded-sm text-black outline-none in-out-spin-none w-8 px-1 ml-2"
                                    type="number" min="0" max="100"
                                    value="{{ $price->objPpn->value }}" onkeyup="setPpn(this)"
                                    onchange="checkPpn(this)">
                                <label class="text-xs text-black ml-2"> % x DPP </label>
                                @if (count($products) > 1)
                                    <input id="dppValue" value="{{ $price->objPpn->dpp }}"
                                        class="text-right text-[0.7rem] outline-none text-black font-semibold in-out-spin-none w-20 border rounded-sm border-black ml-2 pr-1"
                                        type="number" min="0" onkeyup="getDpp(this)"
                                        onclick="alertDpp(this)" onchange="dppCheck(this)" required readonly>
                                @else
                                    <input id="dppValue" value="{{ $price->objPpn->dpp }}"
                                        class="text-right text-[0.7rem] outline-none text-black font-semibold in-out-spin-none w-20 border rounded-sm border-black ml-2 pr-1"
                                        type="number" min="0" onkeyup="getDpp(this)"
                                        onchange="dppCheck(this)" required>
                                @endif
                            </div>
                        </td>
                        <td id="ppnNominal"
                            class="text-[0.7rem] text-black border border-black text-right font-semibold px-2">
                            {{ ($price->objPpn->value / 100) * $price->objPpn->dpp }}
                        </td>
                        <td class="border border-black"></td>
                    </tr>
                    <tr>
                        <td class="text-[0.7rem] text-black border border-black text-right font-semibold px-2"
                            colspan="{{ $colSpan + 5 }}">Grand
                            Total</td>
                        <td id="grandTotal"
                            class="text-[0.7rem] text-black border border-black text-right font-semibold px-2">
                            {{ $subTotal + ($price->objPpn->value / 100) * $price->objPpn->dpp }}
                        </td>
                        <td class="border border-black"></td>
                    </tr>
                @else
                    <tr>
                        <td class="border border-black px-2 text-right text-xs text-black font-semibold"
                            colspan="{{ $colSpan + 6 }}">
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
                        <td class="border border-black"></td>
                    </tr>
                    <tr hidden>
                        <td class="text-[0.7rem] text-black border border-black text-right font-semibold px-2"
                            colspan="{{ $colSpan + 5 }}">Sub
                            Total
                        </td>
                        <td id="subTotal"
                            class="text-[0.7rem] text-black border border-black text-right font-semibold px-2"></td>
                        <td class="border border-black"></td>
                    </tr>
                    <tr hidden>
                        <td class="text-[0.7rem] text-black border border-black text-right font-semibold px-2"
                            colspan="{{ $colSpan + 5 }}">
                            <div class="flex items-center justify-end">
                                <label class="text-[0.7rem] text-black ml-1" for="cbPpn">PPN</label>
                                <input id="ppnValue"
                                    class="text-xs text-center border border-black rounded-sm text-black outline-none in-out-spin-none w-8 px-1 ml-2"
                                    type="number" min="0" max="100" value="11"
                                    onkeyup="setPpn(this)" onchange="checkPpn(this)">
                                <label class="text-xs text-black ml-2"> % x DPP </label>
                                @if (count($products) > 1)
                                    <input id="dppValue"
                                        class="text-right text-[0.7rem] outline-none text-black font-semibold in-out-spin-none w-20 border  rounded-sm border-black ml-2 pr-1"
                                        type="number" min="0" onkeyup="getDpp(this)"
                                        onclick="alertDpp(this)" onchange="dppCheck(this)" required readonly>
                                @else
                                    <input id="dppValue"
                                        class="text-right text-[0.7rem] outline-none text-black font-semibold in-out-spin-none w-20 border  rounded-sm border-black ml-2 pr-1"
                                        type="number" min="0" onkeyup="getDpp(this)"
                                        onchange="dppCheck(this)" required>
                                @endif
                            </div>
                        </td>
                        <td id="ppnNominal"
                            class="text-[0.7rem] text-black border border-black text-right font-semibold px-2">
                        </td>
                        <td class="border border-black"></td>
                    </tr>
                    <tr hidden>
                        <td class="text-[0.7rem] text-black border border-black text-right font-semibold px-2"
                            colspan="{{ $colSpan + 5 }}">Grand
                            Total</td>
                        <td id="grandTotal"
                            class="text-[0.7rem] text-black border border-black text-right font-semibold px-2">
                        </td>
                        <td class="border border-black"></td>
                    </tr>
                @endif
            @endif
        </tbody>
    </table>
</div>
