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
                <th class="text-[0.7rem] text-teal-700 border w-20">Size - V/H</th>
                <th id="thTitle" class="text-[0.7rem] text-teal-700 border w-[72px]"></th>
                <th id="thTitle" class="text-[0.7rem] text-teal-700 border w-[72px]"></th>
                <th id="thTitle" class="text-[0.7rem] text-teal-700 border w-[72px]"></th>
                <th id="thTitle" class="text-[0.7rem] text-teal-700 border w-[88px]"></th>
            </tr>
        </thead>
        <tbody id="previewTBody">
            @foreach ($products as $product)
                <?php
                $description = json_decode($product->description);
                ?>
                <tr>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $loop->iteration }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $product->code }}-{{ $product->city_code }}</td>
                    <td class="text-[0.7rem] text-teal-700 border">{{ $product->address }}</td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        @if ($description->lighting == 'Backlight')
                            BL
                        @elseif ($description->lighting == 'Frontlight')
                            FL
                        @endif
                    </td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ (int) filter_var($product->side, FILTER_SANITIZE_NUMBER_INT) }}
                    </td>
                    <td class="text-[0.7rem] text-teal-700 border text-center">
                        {{ $product->size }} -
                        @if ($product->orientation == 'Vertikal')
                            V
                        @elseif ($product->orientation == 'Horizontal')
                            H
                        @endif
                    </td>
                    <td id="tdPriceMonth" class="text-[0.7rem] text-teal-700 border text-center">
                    </td>
                    <td id="tdPriceQuarter" class="text-[0.7rem] text-teal-700 border text-center">
                    </td>
                    <td id="tdPriceHalf" class="text-[0.7rem] text-teal-700 border text-center">
                    </td>
                    <td id="tdPriceYear" class="text-[0.7rem] text-teal-700 border text-center">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
