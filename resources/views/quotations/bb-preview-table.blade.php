<div id="divTable" class="w-[800px]">
    <table class="table-auto mt-2 w-full">
        <thead>
            <tr>
                <th class="text-[0.7rem] text-teal-700 border w-6" rowspan="2">No</th>
                <th class="text-[0.7rem] text-teal-700 border w-[72px]" rowspan="2">Kode
                </th>
                <th class="text-[0.7rem] text-teal-700 border" rowspan="2">Lokasi
                </th>
                <th class="text-[0.7rem] text-teal-700 border" colspan="2">
                    Deskripsi
                </th>
                <th id="thPrice" class="text-[0.7rem] text-teal-700 border" colspan="4">Harga
                    (Rp.)
                </th>
            </tr>
            <tr>
                <th class="text-[0.7rem] text-teal-700 border w-14">Jenis</th>
                <th class="text-[0.7rem] text-teal-700 border w-28">Size - V/H</th>
                <th id="thTitle" class="text-[0.7rem] text-teal-700 border w-[64px]"></th>
                <th id="thTitle" class="text-[0.7rem] text-teal-700 border w-[64px]"></th>
                <th id="thTitle" class="text-[0.7rem] text-teal-700 border w-[64px]"></th>
                <th id="thTitle" class="text-[0.7rem] text-teal-700 border w-[72px]"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($locations as $location)
                <tr>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $loop->iteration }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $location->code }}-{{ $location->city->code }}</td>
                    <td class="text-[0.7rem] text-teal-700 border">{{ $location->address }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $location->media_category->name }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $location->media_size->size }} -
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
