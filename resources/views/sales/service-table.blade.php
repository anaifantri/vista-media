<table class="table-auto mt-2 w-full">
    <thead>
        <tr>
            <th class="text-[0.7rem] text-black border" rowspan="2">Lokasi
            </th>
            <th class="text-[0.7rem] text-black border" colspan="6">Deskripsi</th>
        </tr>
        <tr>
            <th class="text-[0.7rem] text-black border w-16">Jenis</th>
            <th class="text-[0.7rem] text-black border w-28">Bahan</th>
            <th class="text-[0.7rem] text-black border w-8">side</th>
            <th class="text-[0.7rem] text-black border w-10">L (m2)</th>
            <th class="text-[0.7rem] text-black border w-14">Harga</th>
            <th class="text-[0.7rem] text-black border w-16">Total</th>
        </tr>
    </thead>
    <tbody>
        @php
            $subTotal = 0;
        @endphp
        @if ($price->objServiceType->print == true && $price->objServiceType->install == true)
            <tr>
                <td class="text-[0.7rem] text-black border px-2" rowspan="2">
                    <div class="flex">
                        <label class="w-10">Kode</label>
                        <label class="ml-2">: {{ $product->code }} -
                            {{ $product->city_code }}</label>
                        @if ($product->side == '2 Sisi')
                            @if ($price->objSideView[$loop->iteration - 1]->left == true && $price->objSideView[$loop->iteration - 1]->right == true)
                                <label class="text-[0.7rem] text-black ml-4">-> Sisi Kanan
                                    dan Kiri</label>
                            @elseif ($price->objSideView[$loop->iteration - 1]->left == true)
                                <label class="text-[0.7rem] text-black ml-4">-> Sisi Kiri</label>
                            @elseif ($price->objSideView[$loop->iteration - 1]->right == true)
                                <label class="text-[0.7rem] text-black ml-4">-> Sisi Kanan</label>
                            @endif
                        @else
                            <label class="text-[0.7rem] text-black ml-4"></label>
                        @endif
                    </div>
                    <div class="flex">
                        <label class="w-10">Lokasi</label>
                        <label class="ml-2">: {{ $product->address }}</label>
                    </div>
                    <div class="flex items-center">
                        <label class="w-10">Ukuran</label>
                        <label class="ml-2">: {{ $product->size }} x {{ $product->side }} -
                            @if ($product->orientation == 'Vertikal')
                                V
                            @elseif ($product->orientation == 'Horizontal')
                                H
                            @endif
                        </label>
                        @if ($product->side == '2 Sisi')
                            @if ($price->objSideView[$loop->iteration - 1]->left == true && $price->objSideView[$loop->iteration - 1]->right == true)
                                <label class="text-[0.7rem] text-black ml-4 font-bold">-> Sisi Kanan (R)
                                    dan Kiri (L)</label>
                            @elseif ($price->objSideView[$loop->iteration - 1]->left == true)
                                <label class="text-[0.7rem] text-black ml-4 font-bold">-> Sisi Kiri (L)</label>
                            @elseif ($price->objSideView[$loop->iteration - 1]->right == true)
                                <label class="text-[0.7rem] text-black ml-4 font-bold">-> Sisi Kanan (R)</label>
                            @endif
                        @else
                            <label class="text-[0.7rem] text-black ml-4"></label>
                        @endif
                    </div>
                    <div class="flex">
                        <label class="w-10 font-bold">Catatan</label>
                        <label class="ml-2 font-bold">: </label>
                        <label class="ml-1 font-bold">
                            @if (isset($price->dataServiceNotes[$loop->iteration - 1]->serviceNote))
                                {{ $price->dataServiceNotes[$loop->iteration - 1]->serviceNote }}
                            @endif
                        </label>
                    </div>
                </td>
                @php
                    $totalPrint =
                        $price->objPrints[$loop->iteration - 1]->price *
                        $price->objSideView[$loop->iteration - 1]->wide;
                    $totalInstall =
                        $price->objInstalls[$loop->iteration - 1]->price *
                        $price->objSideView[$loop->iteration - 1]->wide;
                    $subTotal = $subTotal + $totalInstall + $totalPrint;
                    $salesData[$loop->iteration - 1]->price = $subTotal;
                    $salesData[$loop->iteration - 1]->dpp = $subTotal;
                @endphp
                <td class="text-[0.7rem] text-black border px-1 text-center">Cetak</td>
                <td class="text-[0.7rem] text-black border text-center">
                    {{ $price->objPrints[$loop->iteration - 1]->printProduct }}</td>
                <td class="text-[0.7rem] text-black border text-center px-1" rowspan="2">
                    {{ $price->objSideView[$loop->iteration - 1]->side }}
                </td>
                <td class="text-[0.7rem] text-black border text-center" rowspan="2">
                    {{ $price->objSideView[$loop->iteration - 1]->wide }}
                </td>
                <td class="text-[0.7rem] text-black border text-center px-1">
                    {{ number_format($price->objPrints[$loop->iteration - 1]->price) }}
                </td>
                <td class="text-[0.7rem] text-black border text-right px-2">
                    {{ number_format($totalPrint) }}
                </td>
            </tr>
            <tr>
                <td class="text-[0.7rem] text-black border px-1 text-center">Pasang</td>
                <td class="text-[0.7rem] text-black border text-center">
                    {{ $price->objInstalls[$loop->iteration - 1]->type }}</td>
                <td class="text-[0.7rem] text-black border text-center px-1">
                    {{ number_format($price->objInstalls[$loop->iteration - 1]->price) }}</td>
                <td class="text-[0.7rem] text-black border text-right px-2">
                    {{ number_format($totalInstall) }}
                </td>
            </tr>
        @else
            <tr>
                <td class="text-[0.7rem] text-black border px-2">
                    <div class="flex">
                        <label class="w-10">Kode</label>
                        <label class="ml-2">: {{ $product->code }} -
                            {{ $product->city_code }}</label>
                        @if ($product->side == '2 Sisi')
                            <label class="text-[0.7rem] text-black ml-4">-> Sisi Kanan
                                dan Kiri</label>
                        @else
                            <label class="text-[0.7rem] text-black ml-4"></label>
                        @endif
                    </div>
                    <div class="flex">
                        <label class="w-10">Lokasi</label>
                        <label class="ml-2">: {{ $product->address }}</label>
                    </div>
                    <div class="flex items-center">
                        <label class="w-10">Ukuran</label>
                        <label class="ml-2">: {{ $product->size }} x {{ $product->side }} -
                            @if ($product->orientation == 'Vertikal')
                                V
                            @elseif ($product->orientation == 'Horizontal')
                                H
                            @endif
                        </label>
                        @if ($product->side == '2 Sisi')
                            @if ($price->objSideView[$loop->iteration - 1]->left == true && $price->objSideView[$loop->iteration - 1]->right == true)
                                <label class="text-[0.7rem] text-black ml-4 font-bold">-> Sisi Kanan (R)
                                    dan Kiri (L)</label>
                            @elseif ($price->objSideView[$loop->iteration - 1]->left == true)
                                <label class="text-[0.7rem] text-black ml-4 font-bold">-> Sisi Kiri (L)</label>
                            @elseif ($price->objSideView[$loop->iteration - 1]->right == true)
                                <label class="text-[0.7rem] text-black ml-4 font-bold">-> Sisi Kanan (R)</label>
                            @endif
                        @else
                            <label class="text-[0.7rem] text-black ml-4"></label>
                        @endif
                    </div>
                    <div class="flex">
                        <label class="w-10 font-bold">Catatan</label>
                        <label class="ml-2 font-bold">: </label>
                        <label class="ml-1 font-bold">
                            @if (isset($price->dataServiceNotes[$loop->iteration - 1]->serviceNote))
                                {{ $price->dataServiceNotes[$loop->iteration - 1]->serviceNote }}
                            @endif
                        </label>
                    </div>
                </td>
                @if ($price->objServiceType->print == true)
                    @php
                        $totalPrint =
                            $price->objPrints[$loop->iteration - 1]->price *
                            $price->objSideView[$loop->iteration - 1]->wide;
                        $subTotal = $subTotal + $totalPrint;
                        // $salesData[$loop->iteration - 1]->price = $subTotal;
                        // $salesData[$loop->iteration - 1]->dpp = $subTotal;
                    @endphp
                    <td class="text-[0.7rem] text-black border px-1 text-center">Cetak</td>
                    <td class="text-[0.7rem] text-black border text-center">
                        {{ $price->objPrints[$loop->iteration - 1]->printProduct }}</td>
                    <td class="text-[0.7rem] text-black border text-center px-1">
                        {{ $price->objSideView[$loop->iteration - 1]->side }}</td>
                    <td class="text-[0.7rem] text-black border text-center">
                        {{ $price->objSideView[$loop->iteration - 1]->wide }}</td>
                    <td class="text-[0.7rem] text-black border text-center px-1">
                        {{ number_format($price->objPrints[$loop->iteration - 1]->price) }}</td>
                    <td class="text-[0.7rem] text-black border text-right px-2">
                        {{ number_format($totalPrint) }}
                    </td>
                @else
                    @php
                        $totalInstall =
                            $price->objInstalls[$loop->iteration - 1]->price *
                            $price->objSideView[$loop->iteration - 1]->wide;
                        $subTotal = $subTotal + $totalInstall;
                        // $salesData[$loop->iteration - 1]->price = $subTotal;
                        // $salesData[$loop->iteration - 1]->dpp = $subTotal;
                    @endphp
                    <td class="text-[0.7rem] text-black border px-1 text-center">Pasang</td>
                    <td class="text-[0.7rem] text-black border text-center">
                        {{ $price->objInstalls[$loop->iteration - 1]->type }}</td>
                    <td class="text-[0.7rem] text-black border text-center px-1">
                        {{ $price->objSideView[$loop->iteration - 1]->side }}</td>
                    <td class="text-[0.7rem] text-black border text-center">
                        {{ $price->objSideView[$loop->iteration - 1]->wide }}</td>
                    <td class="text-[0.7rem] text-black border text-center px-1">
                        {{ number_format($price->objInstalls[$loop->iteration - 1]->price) }}</td>
                    <td class="text-[0.7rem] text-black border text-right px-2">
                        {{ number_format($totalInstall) }}
                    </td>
                @endif
            </tr>
        @endif
        <tr>
            <td class="text-[0.7rem] text-black border text-right font-semibold px-2" colspan="6">Sub Total
            </td>
            <td id="priceValue" class="text-[0.7rem] text-black border text-right font-semibold px-2">
                {{ number_format($subTotal) }}</td>
        </tr>
        @if ($objPpn->status == true)
            <input id="ppnYes" type="radio" value="Yes" checked hidden>
            <input id="{{ $loop->iteration - 1 }}" type="radio" value="No" hidden>
            <input id="dppValue" type="number" min="0" value="{{ $subTotal }}" hidden>
            <tr>
                <td class="text-[0.7rem] text-black border text-right font-semibold px-2" colspan="6">PPN
                    {{ $objPpn->value }}%
                    <input id="inputPpn" type="number" min="0" value="{{ $objPpn->value }}" max="100"
                        hidden>
                </td>
                <td class="text-[0.7rem] text-black border text-right font-semibold px-2">
                    @php
                        $servicePpn = ($objPpn->value / 100) * $subTotal;
                    @endphp
                    {{ number_format($servicePpn) }}
                </td>
            </tr>
            <tr>
                <td class="text-[0.7rem] text-black border text-right font-semibold px-2" colspan="6">Grand
                    Total
                </td>
                <td class="text-[0.7rem] text-black border text-right font-semibold px-2">
                    {{ number_format($subTotal + $servicePpn) }}
                </td>
            </tr>
        @else
            <input id="ppnYes" type="radio" value="Yes" hidden>
            <input id="{{ $loop->iteration - 1 }}" type="radio" value="No" checked hidden>
            <input id="inputPpn" type="number" value="0" hidden>
            <input id="inputPph"type="number" value="0" hidden>
            <input id="dppValue" type="number" value="0" hidden>
        @endif
    </tbody>
</table>
{{-- <table class="table-auto w-full">
    <thead>
        <tr>
            <th class="text-xs text-black border w-20" rowspan="2">
                Kode
            </th>
            <th class="text-xs text-black border" rowspan="2">Lokasi
            </th>
            <th class="text-xs text-black border w-48" colspan="2">
                Deskripsi
            </th>
            <th class="text-xs text-black border w-24">Harga (Rp.)</th>
        </tr>
        <tr>
            <th class="text-xs text-black border w-16">Jenis</th>
            <th class="text-xs text-black border w-32">Size - V/H</th>
            <th id="thTitle" class="text-xs text-black border w-24">
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
    <tbody id="tBodyCreate">
        <tr>
            <td class="text-xs text-black border text-center">
                {{ $product->code }}-{{ $product->city_code }}</td>
            <td class="text-xs text-black border px-2">
                {{ $product->address }}
            </td>
            <td class="text-xs text-black border text-center">
                {{ $product->category }}</td>
            <td class="text-xs text-black border text-center">
                {{ $product->size }} - {{ $product->side }} -
                @if ($product->orientation == 'Vertikal')
                    V
                @elseif ($product->orientation == 'Horizontal')
                    H
                @endif
            </td>
            <td id="priceValue" class="text-xs  text-black border text-right px-2">
                @if ($category == 'Billboard')
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
                    {{ $getPrice }}
                @elseif ($category == 'Signage')
                    @if ($description->type == 'Videotron')
                        @if ($price->priceType[0] == true)
                            @foreach ($price->dataSharingPrice as $sharingPrice)
                                @if ($sharingPrice->checkbox == true)
                                    {{ $sharingPrice->price }}
                                    @php
                                        $getPrice = $sharingPrice->price;
                                    @endphp
                                @endif
                            @endforeach
                        @endif
                        @if ($price->priceType[1] == true)
                            @foreach ($price->dataExclusivePrice as $exclusivePrice)
                                @if ($exclusivePrice->checkbox == true)
                                    {{ $exclusivePrice->price }}
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
                        {{ $getPrice }}
                    @endif
                @else
                    @if ($price->priceType[0] == true)
                        @foreach ($price->dataSharingPrice as $sharingPrice)
                            @if ($sharingPrice->checkbox == true)
                                {{ $sharingPrice->price }}
                                @php
                                    $getPrice = $sharingPrice->price;
                                @endphp
                            @endif
                        @endforeach
                    @endif
                    @if ($price->priceType[1] == true)
                        @foreach ($price->dataExclusivePrice as $exclusivePrice)
                            @if ($exclusivePrice->checkbox == true)
                                {{ $exclusivePrice->price }}
                                @php
                                    $getPrice = $exclusivePrice->price;
                                @endphp
                            @endif
                        @endforeach
                    @endif
                @endif
            </td>
        </tr>
        <tr>
            <td class="border px-2 text-right text-xs text-black font-semibold" colspan="4">
                <div class="flex items-center justify-end">
                    <label> Apakah menggunakan PPN dan PPh? </label>
                </div>
            </td>
            <td class="text-xs text-black border text-right px-2">
                <div class="flex justify-center items-center">
                    <input id="ppnYes" class="ml-2" type="radio" name="radioPpn-{{ $loop->iteration - 1 }}"
                        value="Yes" checked onclick="ppnValueCheck(this)">
                    <label class="ml-1"> Ya </label>
                    <input id="{{ $loop->iteration - 1 }}" class="ml-2" type="radio"
                        name="radioPpn-{{ $loop->iteration - 1 }}" value="No" onclick="ppnValueCheck(this)">
                    <label class="ml-1"> Tidak </label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="border px-2 text-right text-xs text-black font-semibold" colspan="4">
                <div class="flex items-center justify-end">
                    <label> Apakah DPP sama dengan harga? </label>
                    <input id="{{ $loop->iteration - 1 }}" class="ml-2" type="radio"
                        name="dpp-{{ $product->code }}" value="Yes" checked onclick="radioCheck(this)">
                    <label class="ml-1"> Ya </label>
                    <input id="{{ $loop->iteration - 1 }}" class="ml-2" type="radio"
                        name="dpp-{{ $product->code }}" value="No" onclick="radioCheck(this)">
                    <label class="ml-1"> Tidak </label>
                </div>
            </td>
            <td class="text-xs text-black border text-right px-2">
                <div>
                    <input id="dppValue" name="{{ $loop->iteration - 1 }}"
                        class="text-right text-xs outline-none text-black font-semibold in-out-spin-none w-20"
                        type="number" min="0" value="{{ $getPrice }}" readonly onkeyup="getDpp(this)">
                </div>
            </td>
        </tr>
        <tr>
            <td class="border px-2 text-right text-xs text-black font-semibold" colspan="4">
                <div class="flex w-full justify-end">
                    <label class="text-xs text-black">(A) PPN </label>
                    <input id="inputPpn" name="ppn{{ $loop->iteration - 1 }}"
                        class="text-xs border rounded-md text-black outline-none in-out-spin-none w-8 px-1 ml-2"
                        type="number" min="0" max="100" onkeyup="setPpn(this)">
                    <label class="text-xs text-black ml-2"> %</label>
                </div>
            </td>
            <td id="ppnValue" class="text-xs text-black border text-right px-2">
            </td>
        </tr>
        <tr>
            <td class="border px-2 text-right text-xs text-black font-semibold" colspan="4">
                <div class="flex w-full justify-end">
                    <label class="text-xs text-black">(B) PPh </label>
                    <input id="inputPph" name="pph{{ $loop->iteration - 1 }}"
                        class="text-xs border rounded-md text-black outline-none in-out-spin-none w-8 px-1 ml-2"
                        type="number" min="0" max="100" onkeyup="setPph(this)">
                    <label class="text-xs text-black ml-2"> %</label>
                </div>
            </td>
            <td id="pphValue" class="text-xs text-black border text-right px-2">
            </td>
        </tr>
        <tr>
            @if ($category == 'Billboard')
                <td class="border px-2 text-right text-xs text-black font-semibold" colspan="4">TOTAL (Harga + A -
                    B)</td>
            @elseif ($category == 'Signage')
                @if ($description->type == 'Videotron')
                    <td class="border px-2 text-right text-xs text-black font-semibold" colspan="4">
                        {{ $thTitle }} (Harga + A - B)</td>
                @else
                    <td class="border px-2 text-right text-xs text-black font-semibold" colspan="4">TOTAL (Harga +
                        A - B)</td>
                @endif
            @else
                <td class="border px-2 text-right text-xs text-black font-semibold" colspan="4">
                    {{ $thTitle }} (Harga + A - B)</td>
            @endif
            <td id="totalValue" class="text-xs text-black border text-right px-2">
            </td>
        </tr>
    </tbody>
</table> --}}
