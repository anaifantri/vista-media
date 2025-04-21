@php
    $cbTitle = 0;
    foreach ($price->dataTitle as $dataTitle) {
        if ($dataTitle->checkbox == true) {
            $cbTitle = $cbTitle + 1;
        }
    }
    if ($cbTitle > 2) {
        $width = 880;
    } else {
        $width = 725;
    }
@endphp
<div class="w-[{{ $width }}px]">
    <table class="table-auto mt-2 w-full">
        <thead>
            <tr>
                <th class="text-[0.7rem] text-black border w-6" rowspan="2">No
                </th>
                <th class="text-[0.7rem] text-black border w-[72px]" rowspan="2">
                    Kode
                </th>
                <th class="text-[0.7rem] text-black border" rowspan="2">Lokasi
                </th>
                <th class="text-[0.7rem] text-black border" colspan="4">Deskripsi</th>
                <th class="text-[0.7rem] text-black border" colspan="{{ $cbTitle }}">Harga
                    (Rp.)
                </th>
            </tr>
            <tr>
                @if ($category != 'Signage')
                    <th class="text-[0.7rem] text-black border w-10">Jenis</th>
                @endif
                @if ($category == 'Signage')
                    <th class="text-[0.7rem] text-black border w-16" rowspan="2">Bentuk</th>
                @else
                    <th class="text-[0.7rem] text-black border w-10" rowspan="2">BL/FL</th>
                @endif
                @if ($category == 'Signage')
                    <th class="text-[0.7rem] text-black border w-6" rowspan="2">Qty</th>
                @endif
                <th class="text-[0.7rem] text-black border w-8" rowspan="2">Side</th>
                <th class="text-[0.7rem] text-black border w-20" rowspan="2">Size - V/H
                </th>
                @foreach ($price->dataTitle as $title)
                    @if ($title->checkbox == true)
                        <th class="text-[0.7rem] text-black border w-20">
                            {{ $title->title }}</th>
                    @else
                        <th class="text-[0.7rem] text-black border w-20" hidden>
                            {{ $title->title }}</th>
                    @endif
                @endforeach
            </tr>
        </thead>
        <tbody id="previewTBody">
            @foreach ($products as $product)
                <?php
                $row = $loop->iteration - 1;
                $totalPrint = 0;
                $totalInstall = 0;
                $description = json_decode($product->description);
                if ($product->category == 'Signage') {
                    $wide = $product->width * $product->height * (int) $product->side * $description->qty;
                } else {
                    $wide = $product->width * $product->height * (int) $product->side;
                }
                ?>
                <tr>
                    <td class="text-[0.7rem] text-black border text-center">
                        {{ $loop->iteration }}</td>
                    <td class="text-[0.7rem] text-black border text-center">
                        {{ $product->code }} - {{ $product->city_code }}</td>
                    <td class="text-[0.7rem] text-black border px-1">
                        {{ $product->address }}
                    </td>
                    @if ($category != 'Signage')
                        <td class="text-[0.7rem] text-black border text-center">
                            @if ($product->category == 'Billboard')
                                BB
                            @elseif($product->category == 'Bando')
                                BD
                            @elseif($product->category == 'Baliho')
                                BLH
                            @elseif($product->category == 'Midiboard')
                                MB
                            @endif
                        </td>
                    @endif
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
                    @foreach ($price->dataPrice as $priceValue)
                        @if ($price->dataTitle[$loop->iteration - 1]->checkbox == true)
                            <td class="text-[0.7rem] text-black border text-right px-1">
                                {{ number_format($priceValue[$row]->price) }}</td>
                        @else
                            <td class="text-[0.7rem] text-black border text-right px-1" hidden>
                                {{ number_format($priceValue[$row]->price) }}</td>
                        @endif
                    @endforeach
                </tr>
                @if (isset($notes->includedPrint) && $notes->includedPrint->checked == true)
                    <!-- Row include print start -->
                    <tr>
                        <td class="text-[0.7rem] text-black border text-center"></td>
                        <td class="text-[0.7rem] text-black border px-2" colspan="6">
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
                        <td class="text-[0.7rem] text-black border text-right px-1">
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
                        <td class="text-[0.7rem] text-black border text-center"></td>
                        <td class="text-[0.7rem] text-black border px-2" colspan="6">
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
                        <td class="text-[0.7rem] text-black border text-right px-1">
                            @php
                                $totalInstall = $notes->includedInstall->price * $notes->includedInstall->qty * $wide;
                            @endphp
                            {{ number_format($totalInstall) }}
                        </td>
                    </tr>
                    <!-- Row include print end -->
                @endif
            @endforeach
            @if ($price->objPpn->checked == true)
                @php
                    $subTotal = 0;
                @endphp
                @foreach ($products as $product)
                    @php
                        $row = $loop->iteration - 1;
                    @endphp
                    @foreach ($price->dataPrice as $ppnPrice)
                        @if ($price->dataTitle[$loop->iteration - 1]->checkbox == true)
                            @php
                                $subTotal = $subTotal + $ppnPrice[$row]->price;
                            @endphp
                        @endif
                    @endforeach
                @endforeach
                @if (
                    (isset($notes->includedInstall) && $notes->includedInstall->checked == true) ||
                        (isset($notes->includedPrint) && $notes->includedPrint->checked == true))
                    <tr>
                        <td class="text-[0.7rem] text-black border font-semibold px-1 text-right" colspan="7">Sub
                            Total</td>
                        <td class="text-[0.7rem] text-black border font-semibold px-1 text-right">
                            @if (isset($notes->includedInstall) &&
                                    $notes->includedInstall->checked == true &&
                                    (isset($notes->includedPrint) && $notes->includedPrint->checked == true))
                                @php
                                    $subTotal = $subTotal + $totalPrint + $totalInstall;
                                @endphp
                                {{ number_format($subTotal) }}
                            @elseif (isset($notes->includedPrint) && $notes->includedPrint->checked == true)
                                @php
                                    $subTotal = $subTotal + $totalPrint;
                                @endphp
                                {{ number_format($subTotal) }}
                            @elseif (isset($notes->includedInstall) && $notes->includedInstall->checked == true)
                                @php
                                    $subTotal = $subTotal + $totalInstall;
                                @endphp
                                {{ number_format($subTotal) }}
                            @endif
                        </td>
                    </tr>
                @else
                    <tr>
                        <td class="text-[0.7rem] text-black border font-semibold px-1 text-right" colspan="7">Sub
                            Total</td>
                        <td class="text-[0.7rem] text-black border font-semibold px-1 text-right">
                            {{ number_format($subTotal) }}
                        </td>
                    </tr>
                @endif
                @if ($price->objPpn->dpp != $subTotal)
                    <tr>
                        <td class="text-[0.7rem] text-black border font-semibold px-1 text-right" colspan="7">DPP
                        </td>
                        <td class="text-[0.7rem] text-black border font-semibold px-1 text-right">
                            {{ number_format($price->objPpn->dpp) }}</td>
                    </tr>
                @endif
                <tr>
                    <td class="text-[0.7rem] text-black border font-semibold px-1 text-right" colspan="7">PPN
                        {{-- {{ $price->objPpn->value }} % (B) --}}
                    </td>
                    <td class="text-[0.7rem] text-black border font-semibold px-1 text-right">
                        {{ number_format($price->objPpn->dpp * ($price->objPpn->value / 100)) }}</td>
                </tr>
                <tr>
                    <td class="text-[0.7rem] text-black border font-semibold px-1 text-right" colspan="7">
                        Grand Total
                    </td>
                    <td class="text-[0.7rem] text-black border font-semibold px-1 text-right">
                        @if ($price->objPpn->dpp != $subTotal)
                            {{ number_format($subTotal + $price->objPpn->dpp * ($price->objPpn->value / 100)) }}
                        @else
                            {{ number_format($subTotal + $subTotal * ($price->objPpn->value / 100)) }}
                        @endif
                    </td>
                </tr>
            @else
                @if (
                    (isset($notes->includedInstall) && $notes->includedInstall->checked == true) ||
                        (isset($notes->includedPrint) && $notes->includedPrint->checked == true))
                    @php
                        $subTotal = 0;
                    @endphp
                    @foreach ($products as $product)
                        @php
                            $row = $loop->iteration - 1;
                        @endphp
                        @foreach ($price->dataPrice as $ppnPrice)
                            @if ($price->dataTitle[$loop->iteration - 1]->checkbox == true)
                                @php
                                    $subTotal = $subTotal + $ppnPrice[$row]->price;
                                @endphp
                            @endif
                        @endforeach
                    @endforeach
                    <tr>
                        <td class="text-[0.7rem] text-black border font-semibold px-1 text-right" colspan="7">Sub
                            Total</td>
                        <td class="text-[0.7rem] text-black border font-semibold px-1 text-right">
                            @if (isset($notes->includedInstall) &&
                                    $notes->includedInstall->checked == true &&
                                    (isset($notes->includedPrint) && $notes->includedPrint->checked == true))
                                {{ number_format($subTotal + $totalPrint + $totalInstall) }}
                            @elseif (isset($notes->includedPrint) && $notes->includedPrint->checked == true)
                                {{ number_format($subTotal + $totalPrint) }}
                            @elseif (isset($notes->includedInstall) && $notes->includedInstall->checked == true)
                                {{ number_format($subTotal + $totalInstall) }}
                            @endif
                        </td>
                    </tr>
                @endif
            @endif
        </tbody>
    </table>
</div>
