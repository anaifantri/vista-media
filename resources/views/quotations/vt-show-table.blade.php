@php
    $descriptions = json_decode($products[0]->description);
    foreach ($leds as $led) {
        if ($led->id == $descriptions->led_id) {
            $dataLed = $led;
        }
    }
@endphp
<div class="flex justify-center">
    <table class="table-auto mt-2">
        <thead>
            <tr>
                <th class="text-xs text-black border w-60">Deskripsi
                </th>
                <th class="text-xs text-black border w-[480px]" colspan="4">
                    Spesifikasi
                </th>
            </tr>
        </thead>
        <tbody id="videotronTBody">
            <tr>
                <td class="px-4 text-xs text-black border">Kode | Lokasi</td>
                <td class="px-4 text-xs text-black border" colspan="4">
                    {{ $products[0]->code }}-{{ $products[0]->city_code }} | {{ $products[0]->address }}</td>
            </tr>
            <tr>
                <td class="px-4 text-xs text-black border">Ukuran / Screen Size - Orientasi</td>
                <td class="px-4 text-xs text-black border" colspan="4">
                    {{ $products[0]->size }} / {{ $descriptions->screen_w }} pixel x
                    {{ $descriptions->screen_h }} pixel
                    -
                    {{ $products[0]->orientation }}</td>
            </tr>
            @if ($category == 'Signage')
                <tr>
                    <td class="px-4 text-xs text-black border">Jumlah Signage</td>
                    <td class="px-4 text-xs text-black border" colspan="4">
                        {{ $descriptions->qty }} unit
                    </td>
                </tr>
            @endif
            <tr>
                <td class="px-4 text-xs text-black border">Ukuran Pixel - Konfigurasi Pixel</td>
                <td class="px-4 text-xs text-black border" colspan="4">P{{ $dataLed->pixel_pitch }} -
                    {{ $dataLed->pixel_config }}</td>
            </tr>
            <tr>
                <td class="px-4 text-xs text-black border">Kerapatan Pixel - Refresh Rate</td>
                <td class="px-4 text-xs text-black border" colspan="4">
                    {{ $dataLed->pixel_density }} pixel/m2 - {{ $dataLed->refresh_rate }} Hz
                </td>
            </tr>
            <tr>
                <td class="px-4 text-xs text-black border">Jarak / Sudut Pandang Terbaik</td>
                <td class="px-4 text-xs text-black border" colspan="4">
                    {{ $dataLed->optimal_distance }} / {{ $dataLed->vertical_angle }}(V)
                    {{ $dataLed->horizontal_angle }}(H)
                </td>
            </tr>
            <tr>
                <?php
                $start = explode(':', date('H:i', strtotime($descriptions->start_at)));
                $end = explode(':', date('H:i', strtotime($descriptions->end_at)));
                $duration_hours = (int) $end[0] - (int) $start[0];
                $duration_second = $duration_hours * 60 * 60;
                ?>
                <td class="px-4 text-xs text-black border">Waktu Tayang</td>
                <td class="px-4 text-xs text-black border" colspan="4">
                    {{ date('H:i', strtotime($descriptions->start_at)) }} s.d
                    {{ date('H:i', strtotime($descriptions->end_at)) }}
                    ({{ $duration_hours }} jam per hari)</td>
            </tr>
            <tr>
                <td class="px-4 text-xs text-black border">Durasi Video</td>
                <td class="px-4 text-xs text-black border" colspan="4">
                    {{ $descriptions->duration }} detik /
                    slot</td>
            </tr>
            <tr>
                <td class="px-4 text-xs text-black border">Jumlah Slot</td>
                <td class="px-4 text-xs text-black border" colspan="4">{{ $descriptions->slots }}
                    slot</td>
            </tr>
            <tr>
                <td class="px-4 text-xs text-black border">Jumlah Spot</td>
                <td class="px-4 text-xs text-black border" colspan="4">
                    {{ $duration_second / $descriptions->duration / $descriptions->slots }} spot / slot /
                    hari
                </td>
            </tr>
            @if ($price->priceType[0] == true)
                <tr>
                    <td class="px-4 text-xs text-black border" rowspan="2">Harga Sharing Untuk {{ $price->slotQty }}
                        Slot
                    </td>
                    @foreach ($price->dataSharingPrice as $dataSharingPrice)
                        @if ($dataSharingPrice->checkbox == true)
                            <td class="border text-xs text-center bg-slate-100 w-28">
                                {{ $dataSharingPrice->title }}</td>
                        @else
                            <td class="border text-xs text-center bg-slate-100 w-28" hidden>
                                {{ $dataSharingPrice->title }}</td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    @foreach ($price->dataSharingPrice as $dataSharingPrice)
                        @if ($dataSharingPrice->checkbox == true)
                            <td class="border text-xs text-center w-28">{{ number_format($dataSharingPrice->price) }}
                            </td>
                        @else
                            <td class="border text-xs text-center w-28" hidden>
                                {{ number_format($dataSharingPrice->price) }}</td>
                        @endif
                    @endforeach
                </tr>
            @endif
            @if ($price->priceType[1] == true)
                <tr>
                    <td class="px-4 text-xs text-black border" rowspan="2">Harga eksklusif</td>
                    @foreach ($price->dataExclusivePrice as $dataExclusivePrice)
                        @if ($dataExclusivePrice->checkbox == true)
                            <td class="border bg-slate-100 text-xs text-black w-28 text-center">
                                {{ $dataExclusivePrice->title }}</td>
                        @else
                            <td class="border bg-slate-100 text-xs text-black w-28 text-center" hidden>
                                {{ $dataExclusivePrice->title }}</td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    @foreach ($price->dataExclusivePrice as $dataExclusivePrice)
                        @if ($dataExclusivePrice->checkbox == true)
                            <td class="border text-center text-xs text-black w-[112px]">
                                {{ number_format($dataExclusivePrice->price) }}</td>
                        @else
                            <td class="border text-center text-xs text-black w-[112px]" hidden>
                                {{ number_format($dataExclusivePrice->price) }}</td>
                        @endif
                    @endforeach
                </tr>
            @endif
            @if ($price->objPpn->checked == true)
                @php
                    $subTotal = 0;
                @endphp
                @if ($price->priceType[0] == true)
                    @foreach ($price->dataSharingPrice as $dataSharingPrice)
                        @if ($dataSharingPrice->checkbox == true)
                            @php
                                $subTotal = $subTotal + $dataSharingPrice->price;
                            @endphp
                        @endif
                    @endforeach
                @elseif ($price->priceType[1] == true)
                    @foreach ($price->dataExclusivePrice as $dataExclusivePrice)
                        @if ($dataExclusivePrice->checkbox == true)
                            @php
                                $subTotal = $subTotal + $dataExclusivePrice->price;
                            @endphp
                        @endif
                    @endforeach
                @endif
                <tr>
                    <td class="text-xs text-black border font-semibold px-1 text-right">
                        Sub Total
                    </td>
                    <td class="text-xs text-black border font-semibold px-1">
                        <label class="flex w-20 justify-end">{{ number_format($subTotal) }}</label>
                    </td>
                </tr>
                @if ($price->objPpn->dpp != $subTotal)
                    <tr>
                        <td class="text-xs text-black border font-semibold px-1 text-right">DPP
                        </td>
                        <td class="text-xs text-black border font-semibold px-1">
                            <label class="flex w-20 justify-end">{{ number_format($price->objPpn->dpp) }}</label>
                        </td>
                    </tr>
                @endif
                <tr>
                    <td class="text-xs text-black border font-semibold px-1 text-right">PPN
                        {{-- {{ $price->objPpn->value }} % (B) --}}
                    </td>
                    <td class="text-xs text-black border font-semibold px-1">
                        <label
                            class="flex w-20 justify-end">{{ number_format($price->objPpn->dpp * ($price->objPpn->value / 100)) }}</label>
                    </td>
                </tr>
                <tr>
                    <td class="text-xs text-black border font-semibold px-1 text-right">
                        Grand Total</td>
                    <td class="text-xs text-black border font-semibold px-1">
                        <label class="flex w-20 justify-end">
                            @if ($price->objPpn->dpp != $subTotal)
                                {{ number_format($subTotal + $price->objPpn->dpp * ($price->objPpn->value / 100)) }}
                            @else
                                {{ number_format($subTotal + $subTotal * ($price->objPpn->value / 100)) }}
                            @endif
                        </label>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
