<table class="table-auto mt-2 w-full">
    <thead>
        <tr class="bg-teal-50">
            <th class="text-[0.7rem] text-teal-700 border" rowspan="2">Lokasi
            </th>
            <th class="text-[0.7rem] text-teal-700 border" colspan="6">Deskripsi</th>
        </tr>
        <tr class="bg-teal-50">
            <th class="text-[0.7rem] text-teal-700 border w-16">Jenis</th>
            <th class="text-[0.7rem] text-teal-700 border w-28">Bahan</th>
            <th class="text-[0.7rem] text-teal-700 border w-8">side</th>
            <th class="text-[0.7rem] text-teal-700 border w-10">L (m2)</th>
            <th class="text-[0.7rem] text-teal-700 border w-14">Harga</th>
            <th class="text-[0.7rem] text-teal-700 border w-16">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $data)
            @if ($data->code == $sale->product_code)
                @php
                    $product = $data;
                @endphp
            @endif
        @endforeach
        @php
            $subTotal = 0;
        @endphp
        @if ($price->objServiceType->print == true && $price->objServiceType->install == true)
            <tr class="bg-slate-50">
                <td class="text-[0.7rem] text-teal-700 border px-2" rowspan="2">
                    <div class="flex">
                        <label class="w-10">Kode</label>
                        <label class="ml-2">: {{ $product->code }} -
                            {{ $product->city_code }}</label>
                        @if ($product->side == '2 Sisi')
                            @if ($price->objSideView[$loop->iteration - 1]->left == true && $price->objSideView[$loop->iteration - 1]->right == true)
                                <label class="text-[0.7rem] text-teal-700 ml-4">-> Sisi Kanan
                                    dan Kiri</label>
                            @elseif ($price->objSideView[$loop->iteration - 1]->left == true)
                                <label class="text-[0.7rem] text-teal-700 ml-4">-> Sisi Kiri</label>
                            @elseif ($price->objSideView[$loop->iteration - 1]->right == true)
                                <label class="text-[0.7rem] text-teal-700 ml-4">-> Sisi Kanan</label>
                            @endif
                        @else
                            <label class="text-[0.7rem] text-teal-700 ml-4"></label>
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
                <td class="text-[0.7rem] text-teal-700 border px-1 text-center">Cetak</td>
                <td class="text-[0.7rem] text-teal-700 border text-center">
                    {{ $price->objPrints[$loop->iteration - 1]->printProduct }}</td>
                <td class="text-[0.7rem] text-teal-700 border text-center px-1" rowspan="2">
                    {{ $price->objSideView[$loop->iteration - 1]->side }}
                </td>
                <td class="text-[0.7rem] text-teal-700 border text-center" rowspan="2">
                    {{ $price->objSideView[$loop->iteration - 1]->wide }}
                </td>
                <td class="text-[0.7rem] text-teal-700 border text-center px-1">
                    {{ number_format($price->objPrints[$loop->iteration - 1]->price) }}
                </td>
                <td class="text-[0.7rem] text-teal-700 border text-right px-2">
                    {{ number_format($totalPrint) }}
                </td>
            </tr>
            <tr class="bg-slate-50">
                <td class="text-[0.7rem] text-teal-700 border px-1 text-center">Pasang</td>
                <td class="text-[0.7rem] text-teal-700 border text-center">
                    {{ $price->objInstalls[$loop->iteration - 1]->type }}</td>
                <td class="text-[0.7rem] text-teal-700 border text-center px-1">
                    {{ number_format($price->objInstalls[$loop->iteration - 1]->price) }}</td>
                <td class="text-[0.7rem] text-teal-700 border text-right px-2">
                    {{ number_format($totalInstall) }}
                </td>
            </tr>
        @else
            <tr class="bg-slate-50">
                <td class="text-[0.7rem] text-teal-700 border px-2">
                    <div class="flex">
                        <label class="w-10">Kode</label>
                        <label class="ml-2">: {{ $product->code }} -
                            {{ $product->city_code }}</label>
                        @if ($product->side == '2 Sisi')
                            <label class="text-[0.7rem] text-teal-700 ml-4">-> Sisi Kanan
                                dan Kiri</label>
                        @else
                            <label class="text-[0.7rem] text-teal-700 ml-4"></label>
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
                    </div>
                </td>
                @if ($price->objServiceType->print == true)
                    @php
                        $totalPrint =
                            $price->objPrints[$loop->iteration - 1]->price *
                            $price->objSideView[$loop->iteration - 1]->wide;
                        $subTotal = $subTotal + $totalPrint;
                    @endphp
                    <td class="text-[0.7rem] text-teal-700 border px-1 text-center">Cetak</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $price->objPrints[$loop->iteration - 1]->printProduct }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center px-1">
                        {{ $price->objSideView[$loop->iteration - 1]->side }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $price->objSideView[$loop->iteration - 1]->wide }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center px-1">
                        {{ number_format($price->objPrints[$loop->iteration - 1]->price) }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-right px-2">
                        {{ number_format($totalPrint) }}
                    </td>
                @else
                    @php
                        $totalInstall =
                            $price->objInstalls[$loop->iteration - 1]->price *
                            $price->objSideView[$loop->iteration - 1]->wide;
                        $subTotal = $subTotal + $totalInstall;
                    @endphp
                    <td class="text-[0.7rem] text-teal-700 border px-1 text-center">Pasang</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $price->objInstalls[$loop->iteration - 1]->type }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center px-1">
                        {{ $price->objSideView[$loop->iteration - 1]->side }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $price->objSideView[$loop->iteration - 1]->wide }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center px-1">
                        {{ number_format($price->objInstalls[$loop->iteration - 1]->price) }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-right px-2">
                        {{ number_format($totalInstall) }}
                    </td>
                @endif
            </tr>
        @endif
        <tr>
            <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="6">Sub Total (A)
            </td>
            <td id="priceValue" class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2">
                {{ $subTotal }}</td>
        </tr>
        @if ($price->objServicePpn->status == true)
            <input id="ppnYes" type="radio" value="Yes" checked hidden>
            <input id="{{ $loop->iteration - 1 }}" type="radio" value="No" hidden>
            <input id="dppValue" type="number" min="0" value="{{ $subTotal }}" hidden>
            <tr>
                <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="6">PPN 11% (B)
                    <input id="inputPpn" type="number" min="0" value="{{ $price->objServicePpn->value }}"
                        max="100" hidden>
                </td>
                <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2">
                    @php
                        $servicePpn = ($price->objServicePpn->value / 100) * $subTotal;
                    @endphp
                    {{ number_format($servicePpn) }}
                </td>
            </tr>
            <tr>
                <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="6">PPh 2% (C)
                    <input id="inputPph"type="number" value="2" hidden>
                </td>
                <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2">
                    @php
                        $servicePph = (2 / 100) * $subTotal;
                    @endphp
                    {{ number_format($servicePph) }}
                </td>
            </tr>
            <tr>
                <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="6">Grand
                    Total (A + B - C)
                </td>
                <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2">
                    {{ number_format($subTotal + $servicePpn - $servicePph) }}
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
