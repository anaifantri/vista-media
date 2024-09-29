@php
    $descriptions = json_decode($locations[0]->description);
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
                <td class="px-4 text-sm text-black border">Kode Lokasi</td>
                <td class="px-4 text-sm text-black border" colspan="4">
                    {{ $locations[0]->code }}-{{ $locations[0]->city_code }}</td>
            </tr>
            <tr>
                <td class="px-4 text-sm text-black border">Lokasi</td>
                <td class="px-4 text-sm text-black border" colspan="4">
                    {{ $locations[0]->address }}</td>
            </tr>
            <tr>
                <td class="px-4 text-xs text-black border">Ukuran (Screen Size) - Orientasi</td>
                <td class="px-4 text-xs text-black border" colspan="4">
                    {{ $locations[0]->media_size->size }} ({{ $descriptions->screen_w }} pixel x
                    {{ $descriptions->screen_h }} pixel)
                    -
                    {{ $locations[0]->orientation }}</td>
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
                    {{ $led->vertical_angle }}(H)
                    {{ $led->horizontal_angle }}(H)</td>
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
            <tr>
                <td class="px-4 text-xs text-black border" rowspan="2">
                    <div class="flex items-center">
                        <input id="cbSharing" type="checkbox" onclick="sharingPrice(this)" checked>
                        <span class="flex ml-2">Harga Sharing </span>
                        <input id="slotQty"
                            class="text-xs in-out-spin-none text-black w-7 text-center border rounded-md ml-2 outline-none bg-transparent"
                            type="number" min="1" max="3" value="1" onkeyup="setSLot(this)">
                        <span class="flex ml-2">Slot</span>
                    </div>
                </td>
                <td class="border bg-slate-100">
                    <div class="flex w-28 justify-center items-center">
                        <input id="cbShareTitle" name="cbShareTitle0" type="checkbox" checked
                            onclick="cbShareCheck(this)">
                        <input input id="shareTitle" class="text-xs text-black  ml-2 w-12 outline-none bg-transparent"
                            type="text" value="1 Bulan">
                    </div>
                </td>
                <td class="border bg-slate-100">
                    <div class="flex w-28 justify-center items-center">
                        <input id="cbShareTitle" name="cbShareTitle1" type="checkbox" checked
                            onclick="cbShareCheck(this)">
                        <input id="shareTitle" class="text-xs text-black  ml-2 w-12 outline-none bg-transparent"
                            type="text" value="3 Bulan">
                    </div>
                </td>
                <td class="border bg-slate-100">
                    <div class="flex w-28 justify-center items-center">
                        <input id="cbShareTitle" name="cbShareTitle2" type="checkbox" checked
                            onclick="cbShareCheck(this)">
                        <input id="shareTitle" class="text-xs text-black  ml-1 w-16 outline-none bg-transparent"
                            type="text" value="6 Bulan">
                    </div>
                </td>
                <td class="border bg-slate-100">
                    <div class="flex w-28 justify-center items-center">
                        <input id="cbShareTitle" name="cbShareTitle3" type="checkbox" checked
                            onclick="cbShareCheck(this)">
                        <input id="shareTitle" class="text-xs text-black  ml-1 w-16 outline-none bg-transparent"
                            type="text" value="1 Tahun">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="border">
                    <div class="flex w-28 justify-center items-center">
                        <input id="sharePrice"
                            class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                            type="number" min="0" value="{{ ($locations[0]->price * (27.5 / 100)) / 10 }}">
                    </div>
                </td>
                <td class="border">
                    <div class="flex w-28 justify-center items-center">
                        <input id="sharePrice"
                            class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                            type="number" min="0"
                            value="{{ $locations[0]->price * (27.5 / 100) * (27.5 / 100) }}">
                    </div>
                </td>
                <td class="border">
                    <div class="flex w-28 justify-center items-center">
                        <input id="sharePrice"
                            class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                            type="number" min="0"
                            value="{{ $locations[0]->price * (27.5 / 100) * (52.5 / 100) }}">
                    </div>
                </td>
                <td class="border">
                    <div class="flex w-28 justify-center items-center">
                        <input id="sharePrice"
                            class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                            type="number" min="0" value="{{ $locations[0]->price * (27.5 / 100) }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="px-4 text-xs text-black border" rowspan="2">
                    <div class="flex items-center">
                        <input id="cbExclusive" type="checkbox" onclick="exclusivePrice(this)" checked>
                        <span class="flex ml-2">Harga eksklusif (4 slot)</span>
                    </div>
                </td>
                <td class="border bg-slate-100">
                    <div class="flex w-28 justify-center items-center">
                        <input id="cbExTitle" name="cbExTitle0" type="checkbox" checked
                            onclick="cbExclusiveCheck(this)">
                        <input class="text-xs text-black  ml-1 w-12 outline-none bg-transparent" type="text"
                            id="exTitle" value="1 Bulan">
                    </div>
                </td>
                <td class="border bg-slate-100">
                    <div class="flex w-28 justify-center items-center">
                        <input id="cbExTitle" name="cbExTitle1" type="checkbox" checked
                            onclick="cbExclusiveCheck(this)">
                        <input class="text-xs text-black  ml-1 w-12 outline-none bg-transparent" type="text"
                            id="exTitle" value="3 Bulan">
                    </div>
                </td>
                <td class="border bg-slate-100">
                    <div class="flex w-28 justify-center items-center">
                        <input id="cbExTitle" name="cbExTitle2" type="checkbox" checked
                            onclick="cbExclusiveCheck(this)">
                        <input class="text-xs text-black  ml-1 w-12 outline-none bg-transparent" type="text"
                            id="exTitle" value="6 Bulan">
                    </div>
                </td>
                <td class="border bg-slate-100">
                    <div class="flex w-28 justify-center items-center">
                        <input id="cbExTitle" name="cbExTitle3" type="checkbox" checked
                            onclick="cbExclusiveCheck(this)">
                        <input class="text-xs text-black  ml-1 w-12 outline-none bg-transparent" type="text"
                            id="exTitle" value="1 Tahun">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="border">
                    <div class="flex w-28 justify-center items-center">
                        <input id="exPrice"
                            class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                            type="number" min="0" value="{{ $locations[0]->price / 10 }}">
                    </div>
                </td>
                <td class="border">
                    <div class="flex w-28 justify-center items-center">
                        <input id="exPrice"
                            class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                            type="number" min="0" value="{{ $locations[0]->price * (27.5 / 100) }}">
                    </div>
                </td>
                <td class="border">
                    <div class="flex w-28 justify-center items-center">
                        <input id="exPrice"
                            class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                            type="number" min="0" value="{{ $locations[0]->price * (52.5 / 100) }}">
                    </div>
                </td>
                <td class="border">
                    <div class="flex w-28 justify-center items-center">
                        <input id="exPrice"
                            class="flex text-center text-xs in-out-spin-none text-black w-[112px] outline-none font-semibold"
                            type="number" min="0" value="{{ $locations[0]->price }}">
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
