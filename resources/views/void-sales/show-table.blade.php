@if ($category == 'Service')
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="text-sm text-black border border-black w-[500px]" rowspan="2">Lokasi
                </th>
                <th class="text-sm text-black border border-black" colspan="6">Deskripsi</th>
            </tr>
            <tr>
                <th class="text-sm text-black border border-black w-16">Jenis</th>
                <th class="text-sm text-black border border-black w-28">Bahan</th>
                <th class="text-sm text-black border border-black w-8">side</th>
                <th class="text-sm text-black border border-black w-10">L (m2)</th>
                <th class="text-sm text-black border border-black w-14">Harga</th>
                <th class="text-sm text-black border border-black w-16">Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $subTotal = 0;
            @endphp
            @foreach ($price->objPrints as $print)
                @if ($price->objServiceType->print == true && $price->objServiceType->install == true && $print->code == $product->code)
                    <tr>
                        <td class="text-sm text-black border border-black px-2" rowspan="2">
                            <div class="flex">
                                <label class="w-10">Kode</label>
                                <label class="ml-2">: {{ $product->code }} -
                                    {{ $product->city_code }}</label>
                                @if ($product->side == '2 Sisi')
                                    @if ($price->objSideView[$loop->iteration - 1]->left == true && $price->objSideView[$loop->iteration - 1]->right == true)
                                        <label class="text-sm text-black ml-4">-> Sisi Kanan
                                            dan Kiri</label>
                                    @elseif ($price->objSideView[$loop->iteration - 1]->left == true)
                                        <label class="text-sm text-black ml-4">-> Sisi Kiri</label>
                                    @elseif ($price->objSideView[$loop->iteration - 1]->right == true)
                                        <label class="text-sm text-black ml-4">-> Sisi Kanan</label>
                                    @endif
                                @else
                                    <label class="text-sm text-black ml-4"></label>
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
                                        <label class="text-sm text-black ml-4 font-bold">-> Sisi Kanan (R)
                                            dan Kiri (L)</label>
                                    @elseif ($price->objSideView[$loop->iteration - 1]->left == true)
                                        <label class="text-sm text-black ml-4 font-bold">-> Sisi Kiri
                                            (L)
                                        </label>
                                    @elseif ($price->objSideView[$loop->iteration - 1]->right == true)
                                        <label class="text-sm text-black ml-4 font-bold">-> Sisi Kanan
                                            (R)</label>
                                    @endif
                                @else
                                    <label class="text-sm text-black ml-4"></label>
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
                        @endphp
                        <td class="text-sm text-black border border-black px-1 text-center">Cetak</td>
                        <td class="text-sm text-black border border-black text-center">
                            {{ $price->objPrints[$loop->iteration - 1]->printProduct }}</td>
                        <td class="text-sm text-black border border-black text-center px-1" rowspan="2">
                            {{ $price->objSideView[$loop->iteration - 1]->side }}
                        </td>
                        <td class="text-sm text-black border border-black text-center" rowspan="2">
                            {{ $price->objSideView[$loop->iteration - 1]->wide }}
                        </td>
                        <td class="text-sm text-black border border-black text-center px-1">
                            {{ number_format($price->objPrints[$loop->iteration - 1]->price) }}
                        </td>
                        <td class="text-sm text-black border border-black text-right px-2">
                            {{ number_format($totalPrint) }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-sm text-black border border-black px-1 text-center">Pasang</td>
                        <td class="text-sm text-black border border-black text-center">
                            {{ $price->objInstalls[$loop->iteration - 1]->type }}</td>
                        <td class="text-sm text-black border border-black text-center px-1">
                            {{ number_format($price->objInstalls[$loop->iteration - 1]->price) }}</td>
                        <td class="text-sm text-black border border-black text-right px-2">
                            {{ number_format($totalInstall) }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-sm text-black border border-black text-right font-semibold px-2" colspan="6">
                            Sub
                            Total (A)
                        </td>
                        <td id="priceValue"
                            class="text-sm text-black border border-black text-right font-semibold px-2">
                            {{ $subTotal }}</td>
                    </tr>
                    @if ($price->objServicePpn->status == true)
                        <input id="ppnYes" type="radio" value="Yes" checked hidden>
                        <input id="{{ $loop->iteration - 1 }}" type="radio" value="No" hidden>
                        <input id="dppValue" type="number" min="0" value="{{ $subTotal }}" hidden>
                        <tr>
                            <td class="text-sm text-black border border-black text-right font-semibold px-2"
                                colspan="6">PPN
                                11% (B)
                                <input id="inputPpn" type="number" min="0"
                                    value="{{ $price->objServicePpn->value }}" max="100" hidden>
                            </td>
                            <td class="text-sm text-black border border-black text-right font-semibold px-2">
                                @php
                                    $servicePpn = ($price->objServicePpn->value / 100) * $subTotal;
                                @endphp
                                {{ number_format($servicePpn) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-sm text-black border border-black text-right font-semibold px-2"
                                colspan="6">
                                PPh
                                (C)
                                <input id="inputPph"type="number" value="2" hidden>
                            </td>
                            <td class="text-sm text-black border border-black text-right font-semibold px-2">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-sm text-black border border-black text-right font-semibold px-2"
                                colspan="6">
                                Grand
                                Total (A + B - C)
                            </td>
                            <td class="text-sm text-black border border-black text-right font-semibold px-2">
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
                @elseif ($price->objServiceType->print == true && $print->code == $product->code)
                    <tr>
                        <td class="text-sm text-black border border-black px-2">
                            <div class="flex">
                                <label class="w-10">Kode</label>
                                <label class="ml-2">: {{ $product->code }} -
                                    {{ $product->city_code }}</label>
                                @if ($product->side == '2 Sisi')
                                    @if ($price->objSideView[$loop->iteration - 1]->left == true && $price->objSideView[$loop->iteration - 1]->right == true)
                                        <label class="text-sm text-black ml-4">-> Sisi Kanan
                                            dan Kiri</label>
                                    @elseif ($price->objSideView[$loop->iteration - 1]->left == true)
                                        <label class="text-sm text-black ml-4">-> Sisi Kiri</label>
                                    @elseif ($price->objSideView[$loop->iteration - 1]->right == true)
                                        <label class="text-sm text-black ml-4">-> Sisi Kanan</label>
                                    @endif
                                @else
                                    <label class="text-sm text-black ml-4"></label>
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
                                        <label class="text-sm text-black ml-4 font-bold">-> Sisi Kanan (R)
                                            dan Kiri (L)</label>
                                    @elseif ($price->objSideView[$loop->iteration - 1]->left == true)
                                        <label class="text-sm text-black ml-4 font-bold">-> Sisi Kiri
                                            (L)</label>
                                    @elseif ($price->objSideView[$loop->iteration - 1]->right == true)
                                        <label class="text-sm text-black ml-4 font-bold">-> Sisi Kanan
                                            (R)</label>
                                    @endif
                                @else
                                    <label class="text-sm text-black ml-4"></label>
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
                            $subTotal = $subTotal + $totalPrint;
                        @endphp
                        <td class="text-sm text-black border border-black px-1 text-center">Cetak</td>
                        <td class="text-sm text-black border border-black text-center">
                            {{ $price->objPrints[$loop->iteration - 1]->printProduct }}</td>
                        <td class="text-sm text-black border border-black text-center px-1">
                            {{ $price->objSideView[$loop->iteration - 1]->side }}</td>
                        <td class="text-sm text-black border border-black text-center">
                            {{ $price->objSideView[$loop->iteration - 1]->wide }}</td>
                        <td class="text-sm text-black border border-black text-center px-1">
                            {{ number_format($price->objPrints[$loop->iteration - 1]->price) }}</td>
                        <td class="text-sm text-black border border-black text-right px-2">
                            {{ number_format($totalPrint) }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-sm text-black border border-black text-right font-semibold px-2"
                            colspan="6">
                            Sub
                            Total (A)
                        </td>
                        <td id="priceValue"
                            class="text-sm text-black border border-black text-right font-semibold px-2">
                            {{ $subTotal }}</td>
                    </tr>
                    @if ($price->objServicePpn->status == true)
                        <input id="ppnYes" type="radio" value="Yes" checked hidden>
                        <input id="{{ $loop->iteration - 1 }}" type="radio" value="No" hidden>
                        <input id="dppValue" type="number" min="0" value="{{ $subTotal }}" hidden>
                        <tr>
                            <td class="text-sm text-black border border-black text-right font-semibold px-2"
                                colspan="6">PPN
                                11% (B)
                                <input id="inputPpn" type="number" min="0"
                                    value="{{ $price->objServicePpn->value }}" max="100" hidden>
                            </td>
                            <td class="text-sm text-black border border-black text-right font-semibold px-2">
                                @php
                                    $servicePpn = ($price->objServicePpn->value / 100) * $subTotal;
                                @endphp
                                {{ number_format($servicePpn) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-sm text-black border border-black text-right font-semibold px-2"
                                colspan="6">
                                PPh
                                (C)
                                <input id="inputPph"type="number" value="2" hidden>
                            </td>
                            <td class="text-sm text-black border border-black text-right font-semibold px-2">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-sm text-black border border-black text-right font-semibold px-2"
                                colspan="6">
                                Grand
                                Total (A + B - C)
                            </td>
                            <td class="text-sm text-black border border-black text-right font-semibold px-2">
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
                @elseif($price->objServiceType->install == true && $price->objInstalls[$loop->iteration - 1]->code == $product->code)
                    <tr>
                        <td class="text-sm text-black border border-black px-2">
                            <div class="flex">
                                <label class="w-10">Kode</label>
                                <label class="ml-2">: {{ $product->code }} -
                                    {{ $product->city_code }}</label>
                                @if ($product->side == '2 Sisi')
                                    @if ($price->objSideView[$loop->iteration - 1]->left == true && $price->objSideView[$loop->iteration - 1]->right == true)
                                        <label class="text-sm text-black ml-4">-> Sisi Kanan
                                            dan Kiri</label>
                                    @elseif ($price->objSideView[$loop->iteration - 1]->left == true)
                                        <label class="text-sm text-black ml-4">-> Sisi Kiri</label>
                                    @elseif ($price->objSideView[$loop->iteration - 1]->right == true)
                                        <label class="text-sm text-black ml-4">-> Sisi Kanan</label>
                                    @endif
                                @else
                                    <label class="text-sm text-black ml-4"></label>
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
                                        <label class="text-sm text-black ml-4 font-bold">-> Sisi Kanan (R)
                                            dan Kiri (L)</label>
                                    @elseif ($price->objSideView[$loop->iteration - 1]->left == true)
                                        <label class="text-sm text-black ml-4 font-bold">-> Sisi Kiri
                                            (L)</label>
                                    @elseif ($price->objSideView[$loop->iteration - 1]->right == true)
                                        <label class="text-sm text-black ml-4 font-bold">-> Sisi Kanan
                                            (R)</label>
                                    @endif
                                @else
                                    <label class="text-sm text-black ml-4"></label>
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
                            $totalInstall =
                                $price->objInstalls[$loop->iteration - 1]->price *
                                $price->objSideView[$loop->iteration - 1]->wide;
                            $subTotal = $subTotal + $totalInstall;
                        @endphp
                        <td class="text-sm text-black border border-black px-1 text-center">Pasang</td>
                        <td class="text-sm text-black border border-black text-center">
                            {{ $price->objInstalls[$loop->iteration - 1]->type }}</td>
                        <td class="text-sm text-black border border-black text-center px-1">
                            {{ $price->objSideView[$loop->iteration - 1]->side }}</td>
                        <td class="text-sm text-black border border-black text-center">
                            {{ $price->objSideView[$loop->iteration - 1]->wide }}</td>
                        <td class="text-sm text-black border border-black text-center px-1">
                            {{ number_format($price->objInstalls[$loop->iteration - 1]->price) }}</td>
                        <td class="text-sm text-black border border-black text-right px-2">
                            {{ number_format($totalInstall) }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-sm text-black border border-black text-right font-semibold px-2"
                            colspan="6">
                            Sub
                            Total (A)
                        </td>
                        <td id="priceValue"
                            class="text-sm text-black border border-black text-right font-semibold px-2">
                            {{ $subTotal }}</td>
                    </tr>
                    @if ($price->objServicePpn->status == true)
                        <input id="ppnYes" type="radio" value="Yes" checked hidden>
                        <input id="{{ $loop->iteration - 1 }}" type="radio" value="No" hidden>
                        <input id="dppValue" type="number" min="0" value="{{ $subTotal }}" hidden>
                        <tr>
                            <td class="text-sm text-black border border-black text-right font-semibold px-2"
                                colspan="6">PPN
                                11% (B)
                                <input id="inputPpn" type="number" min="0"
                                    value="{{ $price->objServicePpn->value }}" max="100" hidden>
                            </td>
                            <td class="text-sm text-black border border-black text-right font-semibold px-2">
                                @php
                                    $servicePpn = ($price->objServicePpn->value / 100) * $subTotal;
                                @endphp
                                {{ number_format($servicePpn) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-sm text-black border border-black text-right font-semibold px-2"
                                colspan="6">
                                PPh
                                (C)
                                <input id="inputPph"type="number" value="2" hidden>
                            </td>
                            <td class="text-sm text-black border border-black text-right font-semibold px-2">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-sm text-black border border-black text-right font-semibold px-2"
                                colspan="6">
                                Grand
                                Total (A + B - C)
                            </td>
                            <td class="text-sm text-black border border-black text-right font-semibold px-2">
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
                @endif
            @endforeach
        </tbody>
    </table>
@else
    @php
        $totalPrint = 0;
        $totalInstall = 0;
    @endphp
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="text-xs text-black border border-black w-20" rowspan="2">
                    Kode
                </th>
                <th class="text-xs text-black border border-black" rowspan="2">Lokasi
                </th>
                @if ($category == 'Signage')
                    <th class="text-sm text-black border border-black" colspan="5">Deskripsi</th>
                @else
                    <th class="text-sm text-black border border-black" colspan="4">Deskripsi</th>
                @endif
                <th class="text-xs text-black border border-black w-24">Harga (Rp.)</th>
            </tr>
            <tr>
                <th class="text-sm text-black border border-black w-10" rowspan="2">Jenis</th>
                @if ($category == 'Signage')
                    <th class="text-sm text-black border border-black w-16" rowspan="2">Bentuk
                    </th>
                @else
                    <th class="text-sm text-black border border-black w-10" rowspan="2">BL/FL
                    </th>
                @endif
                @if ($category == 'Signage')
                    <th class="text-sm text-black border border-black w-6" rowspan="2">Qty</th>
                @endif
                <th class="text-sm text-black border border-black w-8" rowspan="2">Side</th>
                <th class="text-xs text-black border border-black w-32">Size - V/H</th>
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
                <td class="text-sm text-black border border-black text-center">
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
                </td>
                @if ($category == 'Signage')
                    <td class="text-sm text-black border border-black text-center">
                        {{ $description->type }}</td>
                @else
                    @if ($category == 'Videotron')
                        <td class="text-sm text-black border border-black text-center">-</td>
                    @else
                        <td class="text-sm text-black border border-black text-center">
                            @if ($description->lighting == 'Backlight')
                                BL
                            @elseif ($description->lighting == 'Frontlight')
                                FL
                            @endif
                        </td>
                    @endif
                @endif
                @if ($category == 'Signage')
                    <td class="text-sm text-black border border-black text-center">
                        {{ $description->qty }}
                    </td>
                @endif
                <td class="text-sm text-black border border-black text-center">
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
                            $getCode = $product->code . '-' . $product->city_code;
                            $getPrice = 0;
                            for ($i = 0; $i < count($price->dataTitle); $i++) {
                                if ($price->dataTitle[$i]->checkbox == true) {
                                    $getPrice = $price->dataPrice[$i][0]->price;
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
            @if ($sale->dpp)
                <tr>
                    @if ($category == 'Signage')
                        <td class="border border-black px-2 text-right text-xs text-black font-semibold"
                            colspan="7">
                            DPP
                        </td>
                    @else
                        <td class="border border-black px-2 text-right text-xs text-black font-semibold"
                            colspan="6">
                            DPP
                        </td>
                    @endif
                    <td class="text-xs text-black border border-black text-right px-2">
                        {{ number_format($sale->dpp) }}</td>
                </tr>
                <tr>
                    @if ($category == 'Signage')
                        <td class="border border-black px-2 text-right text-xs text-black font-semibold"
                            colspan="7">
                            (A)
                            PPN
                            {{ $sale->ppn }}%</td>
                    @else
                        <td class="border border-black px-2 text-right text-xs text-black font-semibold"
                            colspan="6">
                            (A)
                            PPN
                            {{ $sale->ppn }}%</td>
                    @endif
                    <td class="text-xs text-black border border-black text-right px-2">
                        {{ number_format($sale->dpp * ($sale->ppn / 100)) }}
                    </td>
                </tr>
                <tr>
                    @if ($category == 'Signage')
                        <td class="border border-black px-2 text-right text-xs text-black font-semibold"
                            colspan="7">
                            (B)
                            PPh
                            {{ $sale->pph }}%</td>
                    @else
                        <td class="border border-black px-2 text-right text-xs text-black font-semibold"
                            colspan="6">
                            (B)
                            PPh
                            {{ $sale->pph }}%</td>
                    @endif
                    <td class="text-xs text-black border border-black text-right px-2">
                        {{ number_format($sale->dpp * ($sale->pph / 100)) }}
                    </td>
                </tr>
                <tr>
                    @if ($category == 'Signage')
                        <td class="border border-black px-2 text-right text-xs text-black font-semibold"
                            colspan="7">
                            TOTAL (Harga +
                            A - B)</td>
                    @else
                        <td class="border border-black px-2 text-right text-xs text-black font-semibold"
                            colspan="6">
                            TOTAL (Harga +
                            A - B)</td>
                    @endif
                    <td class="text-xs text-black border border-black text-right px-2">
                        {{ number_format($getPrice + $sale->dpp * ($sale->ppn / 100) - $sale->dpp * ($sale->pph / 100) + $totalPrint + $totalInstall) }}
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
@endif
