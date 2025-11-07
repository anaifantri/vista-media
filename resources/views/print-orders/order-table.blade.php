<table class="table-auto w-full">
    <thead>
        <tr class="bg-stone-400">
            <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center" rowspan="2">No</th>
            <th class="text-stone-900 border border-stone-900 text-sm w-24 text-center" rowspan="2">Kode</th>
            <th class="text-stone-900 border border-stone-900 text-sm text-center" rowspan="2">Lokasi</th>
            <th class="text-stone-900 border border-stone-900 text-sm text-center" colspan="3">Deskripsi</th>
            <th class="text-stone-900 border border-stone-900 text-sm text-center" colspan="3">Detail Cetak</th>
            <th class="text-stone-900 border border-stone-900 text-sm text-center w-16" rowspan="2">Action</th>
        </tr>
        <tr class="bg-stone-400">
            <th class="text-stone-900 border border-stone-900 text-sm text-center w-24">Jenis</th>
            <th class="text-stone-900 border border-stone-900 text-sm text-center w-28">Size - V/H</th>
            <th class="text-stone-900 border border-stone-900 text-sm text-center w-12">BL/FL</th>
            <th class="text-stone-900 border border-stone-900 text-sm text-center w-40">No. Penjualan</th>
            <th class="text-stone-900 border border-stone-900 text-sm text-center w-28">Klien</th>
            <th class="text-stone-900 border border-stone-900 text-sm text-center w-28">Bahan Cetak</th>
        </tr>
    </thead>
    <tbody class="bg-stone-200">
        @foreach ($sales as $sale)
            @php
                $product = json_decode($sale->product);
                $description = json_decode($product->description);
            @endphp
            <tr>
                <td class="text-stone-900 border border-stone-900 text-sm text-center">{{ $loop->iteration }}
                </td>
                <td class="text-stone-900 border border-stone-900 text-sm text-center">{{ $product->code }}
                    -
                    {{ $product->city_code }}</td>
                <td class="text-stone-900 border border-stone-900 text-sm px-2">{{ $product->address }}
                </td>
                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                    {{ $product->category }}
                </td>
                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                    {{ $product->size }}
                    -
                    @if ($product->orientation == 'Vertikal')
                        V
                    @elseif ($product->orientation == 'Horizontal')
                        H
                    @endif
                </td>
                <td class="text-stone-900 border border-stone-900 text-sm text-center">
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
                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                    <a href="/marketing/sales/{{ $sale->id }}" class="ml-1 w-32">{{ $sale->number }}</a>
                </td>
                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                    {{ $clients[$loop->iteration - 1]->name }}
                </td>
                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                    {{ $print_products[$loop->iteration - 1] }}
                </td>
                <td id="tdCreate" class="text-stone-900 border border-stone-900 align-middle text-center text-sm">
                    <input value="{{ $sale->id }}" type="radio" name="chooseLocation" title="pilih"
                        onclick="getLocation(this)">
                    <label class="ml-1">Pilih</label>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
