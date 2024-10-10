<div id="divTable" class="w-[800px]">
    <table class="table-auto mt-2 w-full">
        <thead>
            <tr>
                <th class="text-[0.7rem] text-teal-700 border w-6" rowspan="2">No</th>
                <th class="text-[0.7rem] text-teal-700 border w-[72px]" rowspan="2">Kode
                </th>
                <th class="text-[0.7rem] text-teal-700 border" rowspan="2">Lokasi
                </th>
                <th class="text-[0.7rem] text-teal-700 border" colspan="3">
                    Deskripsi
                </th>
                <th id="thPrice" class="text-[0.7rem] text-teal-700 border" colspan="4">Harga
                    (Rp.)
                </th>
            </tr>
            <tr>
                <th class="text-[0.7rem] text-teal-700 border w-10">BL/FL</th>
                <th class="text-[0.7rem] text-teal-700 border w-8">Side</th>
                <th class="text-[0.7rem] text-teal-700 border w-24">Size - V/H</th>
                <th id="thTitle" class="text-[0.7rem] text-teal-700 border w-[64px]"></th>
                <th id="thTitle" class="text-[0.7rem] text-teal-700 border w-[64px]"></th>
                <th id="thTitle" class="text-[0.7rem] text-teal-700 border w-[64px]"></th>
                <th id="thTitle" class="text-[0.7rem] text-teal-700 border w-[72px]"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $location)
                <?php
                $description = json_decode($location->description);
                ?>
                <tr>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $loop->iteration }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $location->code }}-{{ $location->city_code }}</td>
                    <td class="text-[0.7rem] text-teal-700 border">{{ $location->address }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        @if ($description->lighting == 'Backlight')
                            BL
                        @elseif ($description->lighting == 'Frontlight')
                            FL
                        @endif
                    </td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ (int) filter_var($location->side, FILTER_SANITIZE_NUMBER_INT) }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $location->size }} -
                        @if ($location->orientation == 'Vertikal')
                            V
                        @elseif ($location->orientation == 'Horizontal')
                            H
                        @endif
                    </td>
                    <td id="tdPriceMonth" class="text-[0.7rem] text-teal-700 border text-center"></td>
                    <td id="tdPriceQuarter" class="text-[0.7rem] text-teal-700 border text-center"></td>
                    <td id="tdPriceHalf" class="text-[0.7rem] text-teal-700 border text-center"></td>
                    <td id="tdPriceYear" class="text-[0.7rem] text-teal-700 border text-center"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
