<div class="w-[725px]">
    <table class="table-auto mt-2 w-full">
        <thead>
            <tr class="bg-teal-50">
                <th class="text-[0.7rem] text-teal-700 border w-6" rowspan="2">No</th>
                <th class="text-[0.7rem] text-teal-700 border" rowspan="2">Lokasi
                </th>
                <th class="text-[0.7rem] text-teal-700 border" colspan="6">Deskripsi</th>
            </tr>
            <tr class="bg-teal-50">
                <th class="text-[0.7rem] text-teal-700 border w-16">Jenis</th>
                <th class="text-[0.7rem] text-teal-700 border w-28">Bahan</th>
                <th class="text-[0.7rem] text-teal-700 border w-8">side</th>
                <th class="text-[0.7rem] text-teal-700 border w-10">L (m2)</th>
                <th class="text-[0.7rem] text-teal-700 border w-14">Harga</th>
                <th class="text-[0.7rem] text-teal-700 border w-16">Total</th>
            </tr>
        </thead>
        <tbody id="serviceTBodyPreview">
            <input id="locationQty" type="text" value="{{ count($products) }}" hidden>
            @foreach ($products as $location)
                <tr class="bg-slate-50">
                    <td class="text-[0.7rem] text-teal-700 border text-center" rowspan="2">{{ $loop->iteration }}
                    </td>
                    <td class="text-[0.7rem] text-teal-700 border px-2" rowspan="2">
                        <div class="flex">
                            <label class="w-10">Kode</label>
                            <label class="ml-2">: {{ $location->code }} -
                                {{ $location->city_code }}</label>
                            @if ($location->side == '2 Sisi')
                                <label id="locationCodePreview" class="text-[0.7rem] text-teal-700 ml-4">-> Sisi Kanan
                                    dan Kiri</label>
                            @else
                                <label id="locationCodePreview" class="text-[0.7rem] text-teal-700 ml-4"></label>
                            @endif
                        </div>
                        <div class="flex">
                            <label class="w-10">Lokasi</label>
                            <label class="ml-2">: {{ $location->address }}</label>
                        </div>
                        <div class="flex items-center">
                            <label class="w-10">Ukuran</label>
                            <label class="ml-2">: {{ $location->size }} x {{ $location->side }} -
                                @if ($location->orientation == 'Vertikal')
                                    V
                                @elseif ($location->orientation == 'Horizontal')
                                    H
                                @endif
                            </label>
                        </div>
                    </td>
                    <td class="text-[0.7rem] text-teal-700 border px-1">Cetak</td>
                    <td id="printProductPreview" class="text-[0.7rem] text-teal-700 border text-center"></td>
                    <td id="sidePreview" class="text-[0.7rem] text-teal-700 border text-center px-1" rowspan="2">
                    </td>
                    <td id="widePreview" class="text-[0.7rem] text-teal-700 border text-center" rowspan="2"></td>
                    <td id="printPricePreview" class="text-[0.7rem] text-teal-700 border text-center px-1"></td>
                    <td id="totalPrintPricePreview" class="text-[0.7rem] text-teal-700 border text-right px-2"></td>
                </tr>
                <tr class="bg-slate-50">
                    <td class="text-[0.7rem] text-teal-700 border px-1">Pasang</td>
                    <td id="installProductPreview" class="text-[0.7rem] text-teal-700 border text-center"></td>
                    <td id="installPricePreview" class="text-[0.7rem] text-teal-700 border text-center px-1"></td>
                    <td id="totalInstallPricePreview" class="text-[0.7rem] text-teal-700 border text-right px-2"></td>
                </tr>
            @endforeach
            <tr>
                <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="7">Sub Total
                </td>
                <td id="subTotalPreview" class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2"></td>
            </tr>
            <tr>
                <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="7">PPN</td>
                <td id="servicePpnPreview" class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2">
                </td>
            </tr>
            <tr>
                <td class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2" colspan="7">Grand Total
                </td>
                <td id="serviceGrandTotalPreview"
                    class="text-[0.7rem] text-teal-700 border text-right font-semibold px-2">
                </td>
            </tr>
        </tbody>
    </table>
</div>
