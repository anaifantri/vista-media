@php
    $printStatus = $price->objServiceType->print;
    $installStatus = $price->objServiceType->install;
    $getPriceInstall = 0;
    $getPricePrint = 0;
    if ($printStatus == true && $installStatus == true) {
        $rowSpan = 2;
    } else {
        $rowSpan = 1;
    }
    if ($installStatus == true) {
        $indexInstall = 0;
        foreach ($price->objInstalls as $objInstall) {
            if ($objInstall->code == $product->code) {
                $priceInstall = $objInstall;
                $getPriceInstall = $priceInstall->price;
                $side = $price->objSideView[$indexInstall]->side;
                $wide = $price->objSideView[$indexInstall]->wide;
                if (isset($price->dataServiceNotes)) {
                    $serviceNote = $price->dataServiceNotes[$indexInstall]->serviceNote;
                } else {
                    $serviceNote = '';
                }
                $leftStatus = $price->objSideView[$indexInstall]->left;
                $rightStatus = $price->objSideView[$indexInstall]->right;
            }
            $indexInstall++;
        }
    }
    if ($printStatus == true) {
        $indexPrint = 0;
        foreach ($price->objPrints as $objPrint) {
            if ($objPrint->code == $product->code) {
                $pricePrint = $objPrint;
                $getPricePrint = $pricePrint->price;
                $side = $price->objSideView[$indexPrint]->side;
                $wide = $price->objSideView[$indexPrint]->wide;
                if (isset($price->dataServiceNotes)) {
                    $serviceNote = $price->dataServiceNotes[$indexPrint]->serviceNote;
                } else {
                    $serviceNote = '';
                }
                $leftStatus = $price->objSideView[$indexPrint]->left;
                $rightStatus = $price->objSideView[$indexPrint]->right;
            }
            $indexPrint++;
        }
    }
    $getSubTotal = $getPricePrint * $wide + $getPriceInstall * $wide;
    $getPpn = $getSubTotal * ($sale->ppn / 100);
    $getGrandTotal = $getSubTotal + $getPpn;
@endphp
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
        @if ($printStatus == true && $installStatus == true)
            <tr>
                <td class="text-[0.7rem] text-black border px-2" rowspan="{{ $rowSpan }}">
                    <div class="flex">
                        <label class="w-10">Kode</label>
                        <label class="ml-2">: {{ $product->code }} -
                            {{ $product->city_code }}</label>
                        @if ($product->side == '2 Sisi')
                            @if ($leftStatus == true && $rightStatus == true)
                                <label class="text-[0.7rem] text-black ml-4">-> Sisi Kanan
                                    dan Kiri</label>
                            @elseif ($leftStatus == true)
                                <label class="text-[0.7rem] text-black ml-4">-> Sisi Kiri</label>
                            @elseif ($rightStatus == true)
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
                        <label class="ml-2">: {{ $product->size }} x {{ $side }} Sisi -
                            @if ($product->orientation == 'Vertikal')
                                V
                            @elseif ($product->orientation == 'Horizontal')
                                H
                            @endif
                        </label>
                    </div>
                    <div class="flex">
                        <label class="w-10 font-bold">Catatan</label>
                        <label class="ml-2 font-bold">: </label>
                        <label class="ml-1 font-bold">
                            {{ $serviceNote }}
                        </label>
                    </div>
                </td>
                <td class="text-[0.7rem] text-black border px-1 text-center">Cetak</td>
                <td class="text-[0.7rem] text-black border text-center">
                    {{ $pricePrint->printProduct }}
                </td>
                <td class="text-[0.7rem] text-black border text-center px-1" rowspan="{{ $rowSpan }}">
                    {{ $side }}
                </td>
                <td class="text-[0.7rem] text-black border text-center" rowspan="{{ $rowSpan }}">
                    {{ $wide }}
                </td>
                <td class="text-[0.7rem] text-black border text-center px-1">
                    {{ number_format($getPricePrint) }}
                </td>
                <td class="text-[0.7rem] text-black border text-right px-2">
                    {{ number_format($getPricePrint * $wide) }}
                </td>
            </tr>
            <tr>
                <td class="text-[0.7rem] text-black border px-1 text-center">Pasang</td>
                <td class="text-[0.7rem] text-black border text-center">
                    {{ $priceInstall->type }}
                </td>
                <td class="text-[0.7rem] text-black border text-center px-1">
                    {{ number_format($getPriceInstall) }}
                </td>
                <td class="text-[0.7rem] text-black border text-right px-2">
                    {{ number_format($getPriceInstall * $wide) }}
                </td>
            </tr>
        @else
            @if ($printStatus == true)
                <tr>
                    <td class="text-[0.7rem] text-black border px-2" rowspan="{{ $rowSpan }}">
                        <div class="flex">
                            <label class="w-10">Kode</label>
                            <label class="ml-2">: {{ $product->code }} -
                                {{ $product->city_code }}</label>
                            @if ($product->side == '2 Sisi')
                                @if ($leftStatus == true && $rightStatus == true)
                                    <label class="text-[0.7rem] text-black ml-4">-> Sisi Kanan
                                        dan Kiri</label>
                                @elseif ($leftStatus == true)
                                    <label class="text-[0.7rem] text-black ml-4">-> Sisi Kiri</label>
                                @elseif ($rightStatus == true)
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
                            <label class="ml-2">: {{ $product->size }} x {{ $side }} Sisi -
                                @if ($product->orientation == 'Vertikal')
                                    V
                                @elseif ($product->orientation == 'Horizontal')
                                    H
                                @endif
                            </label>
                        </div>
                        <div class="flex">
                            <label class="w-10 font-bold">Catatan</label>
                            <label class="ml-2 font-bold">: </label>
                            <label class="ml-1 font-bold">
                                {{ $serviceNote }}
                            </label>
                        </div>
                    </td>
                    <td class="text-[0.7rem] text-black border px-1 text-center">Cetak</td>
                    <td class="text-[0.7rem] text-black border text-center">
                        {{ $pricePrint->printProduct }}
                    </td>
                    <td class="text-[0.7rem] text-black border text-center px-1" rowspan="{{ $rowSpan }}">
                        {{ $side }}
                    </td>
                    <td class="text-[0.7rem] text-black border text-center" rowspan="{{ $rowSpan }}">
                        {{ $wide }}
                    </td>
                    <td class="text-[0.7rem] text-black border text-center px-1">
                        {{ number_format($getPricePrint) }}
                    </td>
                    <td class="text-[0.7rem] text-black border text-right px-2">
                        {{ number_format($getPricePrint * $wide) }}
                    </td>
                </tr>
            @else
                <tr>
                    <td class="text-[0.7rem] text-black border px-2" rowspan="{{ $rowSpan }}">
                        <div class="flex">
                            <label class="w-10">Kode</label>
                            <label class="ml-2">: {{ $product->code }} -
                                {{ $product->city_code }}</label>
                            @if ($product->side == '2 Sisi')
                                @if ($leftStatus == true && $rightStatus == true)
                                    <label class="text-[0.7rem] text-black ml-4">-> Sisi Kanan
                                        dan Kiri</label>
                                @elseif ($leftStatus == true)
                                    <label class="text-[0.7rem] text-black ml-4">-> Sisi Kiri</label>
                                @elseif ($rightStatus == true)
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
                            <label class="ml-2">: {{ $product->size }} x {{ $side }} Sisi -
                                @if ($product->orientation == 'Vertikal')
                                    V
                                @elseif ($product->orientation == 'Horizontal')
                                    H
                                @endif
                            </label>
                        </div>
                        <div class="flex">
                            <label class="w-10 font-bold">Catatan</label>
                            <label class="ml-2 font-bold">: </label>
                            <label class="ml-1 font-bold">
                                {{ $serviceNote }}
                            </label>
                        </div>
                    </td>
                    <td class="text-[0.7rem] text-black border px-1 text-center">Pasang</td>
                    <td class="text-[0.7rem] text-black border text-center">
                        {{ $priceInstall->type }}
                    </td>
                    <td class="text-[0.7rem] text-black border text-center px-1" rowspan="{{ $rowSpan }}">
                        {{ $side }}
                    </td>
                    <td class="text-[0.7rem] text-black border text-center" rowspan="{{ $rowSpan }}">
                        {{ $wide }}
                    </td>
                    <td class="text-[0.7rem] text-black border text-center px-1">
                        {{ number_format($getPriceInstall) }}
                    </td>
                    <td class="text-[0.7rem] text-black border text-right px-2">
                        {{ number_format($getPriceInstall * $wide) }}
                    </td>
                </tr>
            @endif
        @endif
        <tr>
            <td class="text-[0.7rem] text-black border text-right font-semibold px-2" colspan="6">
                SUB TOTAL
            </td>
            <td id="priceValue" class="text-[0.7rem] text-black border text-right font-semibold px-2">
                {{ number_format($getSubTotal) }}
            </td>
        </tr>
        <tr>
            <td class="text-[0.7rem] text-black border text-right font-semibold px-2" colspan="6">PPN
            </td>
            <td class="text-[0.7rem] text-black border text-right font-semibold px-2">
                {{ number_format($getPpn) }}
            </td>
        </tr>
        <tr>
            <td class="text-[0.7rem] text-black border text-right font-semibold px-2" colspan="6">
                GRAND TOTAL
            </td>
            <td class="text-[0.7rem] text-black border text-right font-semibold px-2">
                {{ number_format($getGrandTotal) }}
            </td>
        </tr>
    </tbody>
</table>
