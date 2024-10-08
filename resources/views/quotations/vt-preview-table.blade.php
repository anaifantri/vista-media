@php
    // $descriptions = json_decode($products[0]->description);
    // foreach ($leds as $led) {
    //     if ($led->id == $descriptions->led_id) {
    //         $dataLed = $led;
    //     }
    // }
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
                <th class="text-sm text-black border w-52">Deskripsi
                </th>
                <th class="text-sm text-black border w-[512px]" colspan="4">
                    Spesifikasi
                </th>
            </tr>
        </thead>
        <tbody id="videotronTBody">
            <tr>
                <td class="px-4 text-sm text-black border">Lokasi</td>
                <td class="px-4 text-sm text-black border" colspan="4">
                    {{ $products[0]->address }}</td>
            </tr>
            <tr>
                <td class="px-4 text-xs text-black border">Ukuran (Screen Size) - Orientasi</td>
                <td class="px-4 text-xs text-black border" colspan="4">
                    {{ $products[0]->size }} ({{ $descriptions->screen_w }} pixel x
                    {{ $descriptions->screen_h }} pixel)
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
                <td class="px-4 text-xs text-black border" colspan="4">P
                    {{ $led->pixel_pitch }} -
                    {{ $led->pixel_config }}</td>
            </tr>
            <tr>
                <td class="px-4 text-xs text-black border">Kerapatan Pixel</td>
                <td class="px-4 text-xs text-black border" colspan="4">
                    {{ $led->pixel_density }}
                </td>
            </tr>
            <tr>
                <td class="px-4 text-xs text-black border">Jarak Pandang Terbaik</td>
                <td class="px-4 text-xs text-black border" colspan="4">
                    {{ $led->optimal_distance }}
                </td>
            </tr>
            <tr>
                <td class="px-4 text-xs text-black border">Sudut Pandang Terbaik</td>
                <td class="px-4 text-xs text-black border" colspan="4">
                    {{ $led->view_angle_h }}(W)
                    {{ $led->view_angle_v }}(H)</td>
            </tr>
            <tr>
                <td class="px-4 text-xs text-black border">Refresh Rate</td>
                <td class="px-4 text-xs text-black border" colspan="4">
                    {{ $led->refresh_rate }}
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
            <tr id="trSharing">
                <td id="tdSharing" class="px-4 text-xs text-black border" rowspan="2"></td>
                <td id="tdShareTitle" class="border text-center text-xs text-black"></td>
                <td id="tdShareTitle" class="border text-center text-xs text-black"></td>
                <td id="tdShareTitle" class="border text-center text-xs text-black"></td>
                <td id="tdShareTitle" class="border text-center text-xs text-black"></td>
            </tr>
            <tr id="trSharingPrice">
                <td id="tdSharePrice" class="border text-center text-xs text-black"></td>
                <td id="tdSharePrice" class="border text-center text-xs text-black"></td>
                <td id="tdSharePrice" class="border text-center text-xs text-black"></td>
                <td id="tdSharePrice" class="border text-center text-xs text-black"></td>
            </tr>
            <tr id="trExclusive">
                <td id="tdExclusive" class="px-4 text-xs text-black border" rowspan="2">Harga eksklusif (4 slot)</td>
                <td id="tdExTitle" class="px-4 text-xs text-center text-black border"></td>
                <td id="tdExTitle" class="px-4 text-xs text-center text-black border"></td>
                <td id="tdExTitle" class="px-4 text-xs text-center text-black border"></td>
                <td id="tdExTitle" class="px-4 text-xs text-center text-black border"></td>
            </tr>
            <tr id="trExclusivePrice">
                <td id="tdExPrice" class="px-4 text-xs text-center text-black border"></td>
                <td id="tdExPrice" class="px-4 text-xs text-center text-black border"></td>
                <td id="tdExPrice" class="px-4 text-xs text-center text-black border"></td>
                <td id="tdExPrice" class="px-4 text-xs text-center text-black border"></td>
            </tr>
        </tbody>
    </table>
</div>
