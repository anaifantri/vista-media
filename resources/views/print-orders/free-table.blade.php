<table class="table-auto w-full">
    <thead>
        <tr class="bg-teal-100">
            <th class="text-teal-700 border text-sm w-8 text-center" rowspan="2">No</th>
            <th class="text-teal-700 border text-sm w-24 text-center" rowspan="2">Kode</th>
            <th class="text-teal-700 border text-sm text-center" rowspan="2">Lokasi</th>
            <th class="text-teal-700 border text-sm text-center" colspan="3">Deskripsi</th>
            <th class="text-teal-700 border text-sm text-center" colspan="4">Detail Cetak</th>
            <th class="text-teal-700 border text-sm text-center w-16" rowspan="2">Action</th>
        </tr>
        <tr class="bg-teal-100">
            <th class="text-teal-700 border text-sm text-center w-24">Jenis</th>
            <th class="text-teal-700 border text-sm text-center w-28">Size - V/H</th>
            <th class="text-teal-700 border text-sm text-center w-12">BL/FL</th>
            <th class="text-teal-700 border text-sm text-center w-28">Klien</th>
            <th class="text-teal-700 border text-sm text-center w-16">Free</th>
            <th class="text-teal-700 border text-sm text-center w-16">Terpakai</th>
            <th class="text-teal-700 border text-sm text-center w-16">sisa</th>
        </tr>
    </thead>
    <tbody>
        @php
            // $number = 1 + ($locations->currentPage() - 1) * $locations->perPage();
            $number = 0;
        @endphp
        @foreach ($locations as $location)
            @php
                $products = json_decode($location->quotation->products);
                foreach ($products as $dataProduct) {
                    if ($dataProduct->code == $location->product_code) {
                        $product = $dataProduct;
                        $description = json_decode($product->description);
                    }
                }
            @endphp
            <tr>
                <td class="text-teal-700 border text-sm text-center">{{ $number + 1 }}
                </td>
                <td class="text-teal-700 border text-sm text-center">{{ $product->code }}
                    -
                    {{ $product->city_code }}</td>
                <td class="text-teal-700 border text-sm px-2">{{ $product->address }}
                </td>
                <td class="text-teal-700 border text-sm text-center">
                    {{ $product->category }}
                </td>
                <td class="text-teal-700 border text-sm text-center">
                    {{ $product->size }}
                    -
                    @if ($product->orientation == 'Vertikal')
                        V
                    @elseif ($product->orientation == 'Horizontal')
                        H
                    @endif
                </td>
                <td class="text-teal-700 border text-sm text-center">
                    @if ($product->category == 'Videotron')
                        -
                    @elseif ($product->category == 'Signage')
                        @if ($description->type == 'Videotron')
                            -
                        @else
                            @if ($description->lighting == 'Backlight')
                                BL
                            @elseif ($description->lighting == 'Frontlight')
                                FL
                            @elseif ($description->lighting == 'Nonlight')
                                NL
                            @endif
                        @endif
                    @else
                        @if ($description->lighting == 'Backlight')
                            BL
                        @elseif ($description->lighting == 'Frontlight')
                            FL
                        @elseif ($description->lighting == 'Nonlight')
                            NL
                        @endif
                    @endif
                </td>
                <td class="text-teal-700 border text-sm text-center">
                    {{ $clients[$loop->iteration - 1]->name }}
                </td>
                <td class="text-teal-700 border text-sm text-center">
                    {{ $freePrints[$loop->iteration - 1] }}
                </td>
                <td class="text-teal-700 border text-sm text-center">
                    {{ $usedPrints[$loop->iteration - 1] }}
                </td>
                <td class="text-teal-700 border text-sm text-center">
                    {{ $freePrints[$loop->iteration - 1] - $usedPrints[$loop->iteration - 1] }}
                </td>
                <td id="tdCreate" class="text-teal-700 border align-middle text-center text-sm">
                    <input value="{{ $location->id }}" type="radio" name="chooseLocation" title="pilih"
                        onclick="getLocation(this)">
                    <label class="ml-1">Pilih</label>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
