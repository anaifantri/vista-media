<div class="w-[800px]">
    <table class="table-auto mt-2 w-full">
        <thead id="tableTHead">
            <tr>
                <th class="text-[0.7rem] text-teal-700 border w-6" rowspan="2">No</th>
                <th class="text-[0.7rem] text-teal-700 border w-16" rowspan="2">Kode
                </th>
                <th class="text-[0.7rem] text-teal-700 border" rowspan="2">Lokasi
                </th>
                @if ($category == 'Signage')
                    <th class="text-[0.7rem] text-teal-700 border" colspan="4">
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
                @else
                    <th class="text-[0.7rem] text-teal-700 border w-10">BL/FL</th>
                @endif
                @if ($category == 'Signage')
                    <th class="text-[0.7rem] text-teal-700 border w-6">Qty</th>
                @endif
                <th class="text-[0.7rem] text-teal-700 border w-8">Side</th>
                <th class="text-[0.7rem] text-teal-700 border w-20">Size - V/H</th>
                <th class="border w-[64px]">
                    <div class="flex w-[64px] justify-center items-center">
                        <input id="cbBillboardTitle" name="cbBillboardTitle0" type="checkbox"
                            onclick="cbBillboardCheck(this)" checked>
                        <input id="billboardTitle"
                            class="text-[0.7rem] text-teal-700 ml-1 w-12 outline-none border rounded-sm bg-transparent"
                            type="text" value="1 Bulan">
                    </div>
                </th>
                <th class="border w-[64px]">
                    <div class="flex w-[64px] justify-center items-center">
                        <input id="cbBillboardTitle" name="cbBillboardTitle1" type="checkbox"
                            onclick="cbBillboardCheck(this)" checked>
                        <input id="billboardTitle"
                            class="text-[0.7rem] text-teal-700 ml-1 w-12 outline-none border rounded-sm bg-transparent"
                            type="text" value="3 Bulan">
                    </div>
                </th>
                <th class="border w-[64px]">
                    <div class="flex w-[64px] justify-center items-center">
                        <input id="cbBillboardTitle" name="cbBillboardTitle2" type="checkbox"
                            onclick="cbBillboardCheck(this)" checked>
                        <input id="billboardTitle"
                            class="text-[0.7rem] text-teal-700 ml-1 w-12 outline-none border rounded-sm bg-transparent"
                            type="text" value="6 Bulan">
                    </div>
                </th>
                <th class="border w-20">
                    <div class="flex w-20 justify-center items-center">
                        <input id="cbBillboardTitle" name="cbBillboardTitle3" type="checkbox"
                            onclick="cbBillboardCheck(this)" checked>
                        <input id="billboardTitle"
                            class="text-[0.7rem] text-teal-700 ml-1 w-14 outline-none border rounded-sm bg-transparent"
                            type="text" value="1 Tahun">
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
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $loop->iteration }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $product->code }}-{{ $product->city_code }}</td>
                    <td class="text-[0.7rem] text-teal-700 border px-1">{{ $product->address }}</td>
                    @if ($category == 'Signage')
                        <td class="text-[0.7rem] text-teal-700 border text-center">{{ $description->type }}</td>
                    @else
                        <td class="text-[0.7rem] text-teal-700 border text-center">
                            @if ($description->lighting == 'Backlight')
                                BL
                            @elseif ($description->lighting == 'Frontlight')
                                FL
                            @endif
                        </td>
                    @endif
                    @if ($category == 'Signage')
                        <td class="text-[0.7rem] text-teal-700 border text-center">
                            {{ $description->qty }}
                        </td>
                    @endif
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ (int) filter_var($product->side, FILTER_SANITIZE_NUMBER_INT) }}
                    </td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
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
                                value="{{ $product->price / 10 }}">
                        </div>
                    </td>
                    <td class="border text-center">
                        <div class="flex w-[64px] justify-center items-center">
                            <input id="billboardPrice1" name="{{ $product->code }}"
                                class="input-on-td in-out-spin-none w-[64px]" type="number" min="0"
                                value="{{ $product->price * 0.275 }}">
                        </div>
                    </td>
                    <td class="border text-center">
                        <div class="flex w-[64px] justify-center items-center">
                            <input id="billboardPrice2" name="{{ $product->code }}"
                                class="input-on-td in-out-spin-none w-[64px]" type="number" min="0"
                                value="{{ $product->price * 0.525 }}">
                        </div>
                    </td>
                    <td class="border text-center">
                        <div class="flex w-[72px] justify-center items-center">
                            <input id="billboardPrice3" name="{{ $product->code }}"
                                class="input-on-td in-out-spin-none w-[72px]" type="number" min="0"
                                value="{{ $product->price }}">
                        </div>
                    </td>
                </tr>
            @endforeach
            @if ($category == 'Signage')
                <tr>
                    <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="11">
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
                    <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="10">Sub
                        Total
                    </td>
                    <td id="subTotal" class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2"></td>
                </tr>
                <tr hidden>
                    <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="10">
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
                    <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="10">Grand
                        Total</td>
                    <td id="grandTotal" class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2"></td>
                </tr>
            @else
                <tr>
                    <td class="border px-2 text-right text-xs text-teal-700 font-semibold" colspan="10">
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
                    <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="9">Sub
                        Total
                    </td>
                    <td id="subTotal" class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2"></td>
                </tr>
                <tr hidden>
                    <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="9">
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
                    <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="9">Grand
                        Total</td>
                    <td id="grandTotal" class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2"></td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
