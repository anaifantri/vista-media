<div class="w-[800px]">
    <table class="table-auto mt-2 w-full">
        <thead id="signageTHead">
            <tr>
                <th class="text-[0.7rem] text-teal-700 border w-6" rowspan="2">No</th>
                <th class="text-[0.7rem] text-teal-700 border w-16" rowspan="2">Kode
                </th>
                <th class="text-[0.7rem] text-teal-700 border" rowspan="2">Lokasi
                </th>
                <th class="text-[0.7rem] text-teal-700 border" colspan="3">
                    Deskripsi
                </th>
                <th class="text-[0.7rem] text-teal-700 border" colspan="4">Harga
                    (Rp.)
                </th>
            </tr>
            <tr>
                <th class="text-[0.7rem] text-teal-700 border w-14">Jenis</th>
                <th class="text-[0.7rem] text-teal-700 border w-10">BL/FL</th>
                <th class="text-[0.7rem] text-teal-700 border w-28">Size - V/H</th>
                <th class="border w-[64px]">
                    <div class="flex w-[64px] justify-center items-center">
                        <input id="cbBillboardTitle" name="cbBillboardTitle0" type="checkbox"
                            onclick="cbBillboardCheck(this)" checked>
                        <input id="billboardTitle"
                            class="text-[0.7rem] text-teal-700 ml-1 w-12 outline-none border rounded-sm bg-transparent"
                            type="text" value="1 Bulan">
                    </div>
                </th>
                <th class="border w-[64px]">
                    <div class="flex w-[64px] justify-center items-center">
                        <input id="cbBillboardTitle" name="cbBillboardTitle1" type="checkbox"
                            onclick="cbBillboardCheck(this)" checked>
                        <input id="billboardTitle"
                            class="text-[0.7rem] text-teal-700 ml-1 w-12 outline-none border rounded-sm bg-transparent"
                            type="text" value="3 Bulan">
                    </div>
                </th>
                <th class="border w-[64px]">
                    <div class="flex w-[64px] justify-center items-center">
                        <input id="cbBillboardTitle" name="cbBillboardTitle2" type="checkbox"
                            onclick="cbBillboardCheck(this)" checked>
                        <input id="billboardTitle"
                            class="text-[0.7rem] text-teal-700 ml-1 w-12 outline-none border rounded-sm bg-transparent"
                            type="text" value="6 Bulan">
                    </div>
                </th>
                <th class="border w-[72px]">
                    <div class="flex w-[72px] justify-center items-center">
                        <input id="cbBillboardTitle" name="cbBillboardTitle3" type="checkbox"
                            onclick="cbBillboardCheck(this)" checked>
                        <input id="billboardTitle"
                            class="text-[0.7rem] text-teal-700 ml-1 w-14 outline-none border rounded-sm bg-transparent"
                            type="text" value="1 Tahun">
                    </div>
                </th>
            </tr>
        </thead>
        <tbody id="signageTBody">
            @foreach ($locations as $location)
                <?php
                $description = json_decode($location->description);
                ?>
                <tr>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $loop->iteration }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $location->code }}-{{ $location->city->code }}</td>
                    <td class="text-[0.7rem] text-teal-700 border px-1">{{ $location->address }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $location->media_category->name }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        @if ($description->lighting == 'Backlight')
                            BL
                        @elseif ($description->lighting == 'Frontlight')
                            FL
                        @endif
                    </td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $location->media_size->size }} x {{ $location->side }} -
                        @if ($location->orientation == 'Vertikal')
                            V
                        @elseif ($location->orientation == 'Horizontal')
                            H
                        @endif
                    </td>
                    <td class="border text-center">
                        <div class="flex w-[64px] justify-center items-center">
                            <input id="billboardPrice0" name="{{ $location->code }}"
                                class="input-on-td in-out-spin-none w-[64px]" type="number" min="0"
                                value="{{ $location->price / 10 }}">
                        </div>
                    </td>
                    <td class="border text-center">
                        <div class="flex w-[64px] justify-center items-center">
                            <input id="billboardPrice1" name="{{ $location->code }}"
                                class="input-on-td in-out-spin-none w-[64px]" type="number" min="0"
                                value="{{ $location->price * 0.275 }}">
                        </div>
                    </td>
                    <td class="border text-center">
                        <div class="flex w-[64px] justify-center items-center">
                            <input id="billboardPrice2" name="{{ $location->code }}"
                                class="input-on-td in-out-spin-none w-[64px]" type="number" min="0"
                                value="{{ $location->price * 0.525 }}">
                        </div>
                    </td>
                    <td class="border text-center">
                        <div class="flex w-[72px] justify-center items-center">
                            <input id="billboardPrice3" name="{{ $location->code }}"
                                class="input-on-td in-out-spin-none w-[72px]" type="number" min="0"
                                value="{{ $location->price }}">
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
