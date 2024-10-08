<div class="w-[800px]">
    <table class="table-auto mt-2 w-full">
        <thead id="signageTHead">
            <tr>
                <th class="text-[0.7rem] text-teal-700 border w-6" rowspan="2">No</th>
                <th class="text-[0.7rem] text-teal-700 border w-[72px]" rowspan="2">Kode
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
                @foreach ($price->dataTitle as $title)
                    @if ($title->checkbox == true)
                        <th class="border w-[72px]">
                            <div class="flex w-[72px] justify-center items-center">
                                <input id="cbBillboardTitle" name="cbBillboardTitle{{ $loop->iteration - 1 }}"
                                    type="checkbox" onclick="cbBillboardCheck(this)" checked>
                                <input id="billboardTitle"
                                    class="text-[0.7rem] text-teal-700 ml-1 w-12 outline-none bg-transparent"
                                    type="text" value="{{ $title->title }}">
                            </div>
                        </th>
                    @else
                        <th class="border w-[72px]" hidden>
                            <div class="flex w-[72px] justify-center items-center">
                                <input id="cbBillboardTitle" name="cbBillboardTitle{{ $loop->iteration - 1 }}"
                                    type="checkbox" onclick="cbBillboardCheck(this)">
                                <input id="billboardTitle"
                                    class="text-[0.7rem] text-teal-700 ml-1 w-12 outline-none bg-transparent"
                                    type="text" value="{{ $title->title }}">
                            </div>
                        </th>
                    @endif
                @endforeach
            </tr>
        </thead>
        <tbody id="signageTBody">
            @foreach ($products as $location)
                <?php
                $description = json_decode($location->description);
                $row = $loop->iteration - 1;
                ?>
                <tr>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $loop->iteration }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $location->code }}-{{ $location->city_code }}</td>
                    <td class="text-[0.7rem] text-teal-700 border px-1">{{ $location->address }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $location->category }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        @if ($description->lighting == 'Baclight')
                            BL
                        @elseif ($description->lighting == 'Frontlight')
                            FL
                        @endif
                    </td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $location->size }} x {{ $location->side }} -
                        @if ($location->orientation == 'Vertikal')
                            V
                        @elseif ($location->orientation == 'Horizontal')
                            H
                        @endif
                    </td>
                    @foreach ($price->dataPrice as $priceValue)
                        @if ($price->dataTitle[$loop->iteration - 1]->checkbox == true)
                            <td class="text-[0.7rem] text-teal-700 border text-center">
                                <div class="flex justify-center items-center">
                                    <input id="billboardPrice{{ $loop->iteration - 1 }}" name="{{ $location->code }}"
                                        class="text-center outline-none in-out-spin-none w-[64px]" type="number"
                                        min="0" value="{{ $priceValue[$row]->price }}">
                                </div>
                            </td>
                        @else
                            <td class="text-[0.7rem] text-teal-700 border text-center" hidden>
                                <div class="flex justify-center items-center">
                                    <input id="billboardPrice{{ $loop->iteration - 1 }}" name="{{ $location->code }}"
                                        class="text-center outline-none in-out-spin-none w-[64px]" type="number"
                                        min="0" value="{{ $priceValue[$row]->price }}">
                                </div>
                            </td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
