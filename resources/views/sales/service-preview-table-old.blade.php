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
                @if ($price->objServiceType->print == true)
                    @php
                        $totalPrint =
                            $price->objPrints[$loop->iteration - 1]->price *
                            $price->objSideView[$loop->iteration - 1]->wide;
                        $subTotal = $subTotal + $totalPrint;
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
        @if ($price->objServicePpn->status == true)
            <input id="ppnYes" type="radio" value="Yes" checked hidden>
            <input id="{{ $loop->iteration - 1 }}" type="radio" value="No" hidden>
            <input id="dppValue" type="number" min="0" value="{{ $subTotal }}" hidden>
            <tr>
                <td class="text-[0.7rem] text-black border text-right font-semibold px-2" colspan="6">PPN
                    {{ $price->objServicePpn->value }}%
                    <input id="inputPpn" type="number" min="0" value="{{ $price->objServicePpn->value }}"
                        max="100" hidden>
                </td>
                <td class="text-[0.7rem] text-black border text-right font-semibold px-2">
                    @php
                        $servicePpn = ($price->objServicePpn->value / 100) * $subTotal;
                    @endphp
                    {{ number_format($servicePpn) }}
                </td>
            </tr>
            <tr>
                <td class="text-[0.7rem] text-black border text-right font-semibold px-2" colspan="6">Grand Total
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
