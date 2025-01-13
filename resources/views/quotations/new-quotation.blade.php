<table class="table-auto w-full" id="locationsTable">
    <thead>
        <tr class="bg-stone-400">
            <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center" rowspan="2">No</th>
            <th class="text-stone-900 border border-stone-900 text-sm w-24 text-center" rowspan="2">Kode</th>
            <th class="text-stone-900 border border-stone-900 text-sm text-center" rowspan="2">Lokasi</th>
            <th class="text-stone-900 border border-stone-900 text-sm text-center w-24" rowspan="2">Area</th>
            <th class="text-stone-900 border border-stone-900 text-sm text-center w-24" rowspan="2">Kota</th>
            @if ($category == 'Signage')
                <th class="text-stone-900 border border-stone-900 text-sm text-center" colspan="6">Deskripsi</th>
            @else
                <th class="text-stone-900 border border-stone-900 text-sm text-center" colspan="4">Deskripsi</th>
            @endif
            <th class="text-stone-900 border border-stone-900 text-sm text-center w-16" rowspan="2">Action</th>
        </tr>
        <tr class="bg-stone-400">
            <th class="text-stone-900 border border-stone-900 text-sm text-center w-12">Jenis</th>
            @if ($category == 'Signage')
                <th class="text-stone-900 border border-stone-900 text-sm text-center w-[72px]">Bentuk</th>
            @endif
            <th class="text-stone-900 border border-stone-900 text-sm text-center w-12">BL/FL</th>
            @if ($category == 'Signage')
                <th class="text-stone-900 border border-stone-900 text-sm text-center w-8">Qty</th>
            @endif
            <th class="text-stone-900 border border-stone-900 text-sm text-center w-10">Side</th>
            <th class="text-stone-900 border border-stone-900 text-sm text-center w-28">Size - V/H</th>
        </tr>
    </thead>
    <tbody class="bg-stone-300">
        @foreach ($locations as $location)
            @php
                $description = json_decode($location->description);
                if (
                    $location->media_category->name == 'Videotron' ||
                    ($location->media_category->name == 'Signage' && $description->type == 'Videotron')
                ) {
                    $slots = $description->slots;
                    $clientSlots = 0;
                    $videotronSales = $location->videotron_active_sales;
                    if (count($videotronSales) != 0) {
                        foreach ($videotronSales as $videotronSale) {
                            $getPrice = json_decode($videotronSale->quotation->price);
                            $clientSlots = $clientSlots + $getPrice->slotQty;
                        }
                    }
                }
            @endphp
            @if (
                $location->media_category->name == 'Videotron' ||
                    ($location->media_category->name == 'Signage' && $description->type == 'Videotron'))
                @if ($clientSlots < $slots)
                    <tr>
                        <td class="text-stone-900 border border-stone-900 text-sm text-center">{{ $loop->iteration }}
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-sm text-center">{{ $location->code }}
                            -
                            {{ $location->city->code }}</td>
                        <td class="text-stone-900 border border-stone-900 text-sm px-2">{{ $location->address }}
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-sm text-center">
                            {{ $location->area->area }}</td>
                        <td class="text-stone-900 border border-stone-900 text-sm text-center">
                            {{ $location->city->city }}</td>
                        <td class="text-stone-900 border border-stone-900 text-sm text-center">
                            {{ $location->media_category->code }}
                        </td>
                        @if ($category == 'Signage')
                            <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                {{ $description->type }}
                            </td>
                        @endif
                        <td class="text-stone-900 border border-stone-900 text-sm text-center">
                            @if (
                                $location->media_category->name == 'Videotron' ||
                                    ($location->media_category->name == 'Signage' && $description->type == 'Videotron'))
                                -
                            @else
                                @if ($description->lighting == 'Backlight')
                                    BL
                                @elseif($description->lighting == 'Frontlight')
                                    FL
                                @elseif($description->lighting == 'Nonlight')
                                    -
                                @endif
                            @endif
                        </td>
                        @if ($category == 'Signage')
                            <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                {{ $description->qty }}
                            </td>
                        @endif
                        <td class="text-stone-900 border border-stone-900 text-sm text-center">
                            {{ filter_var($location->side, FILTER_SANITIZE_NUMBER_INT) }}
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-sm text-center">
                            {{ $location->media_size->size }}
                            -
                            @if ($location->orientation == 'Vertikal')
                                V
                            @elseif ($location->orientation == 'Horizontal')
                                H
                            @endif
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-center text-sm">
                            @if ($category == 'Signage')
                                @if (request('type') == null || request('type') == 'All')
                                    <input id="{{ $description->type }}" value="{{ $location->id }}" type="checkbox"
                                        title="Pilih bentuk terlebih dahulu" disabled>
                                @else
                                    <input value="{{ $location->id }}" type="checkbox" title="pilih"
                                        onclick="getLocation(this)">
                                @endif
                            @else
                                <input value="{{ $location->id }}" type="checkbox" title="pilih"
                                    onclick="getLocation(this)">
                            @endif
                        </td>
                    </tr>
                @endif
            @else
                <tr>
                    <td class="text-stone-900 border border-stone-900 text-sm text-center">{{ $loop->iteration }}
                    </td>
                    <td class="text-stone-900 border border-stone-900 text-sm text-center">{{ $location->code }}
                        -
                        {{ $location->city->code }}</td>
                    <td class="text-stone-900 border border-stone-900 text-sm px-2">{{ $location->address }}
                    </td>
                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                        {{ $location->area->area }}</td>
                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                        {{ $location->city->city }}</td>
                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                        {{ $location->media_category->code }}
                    </td>
                    @if ($category == 'Signage')
                        <td class="text-stone-900 border border-stone-900 text-sm text-center">
                            {{ $description->type }}
                        </td>
                    @endif
                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                        @if (
                            $location->media_category->name == 'Videotron' ||
                                ($location->media_category->name == 'Signage' && $description->type == 'Videotron'))
                            -
                        @else
                            @if ($description->lighting == 'Backlight')
                                BL
                            @elseif($description->lighting == 'Frontlight')
                                FL
                            @elseif($description->lighting == 'Nonlight')
                                -
                            @endif
                        @endif
                    </td>
                    @if ($category == 'Signage')
                        <td class="text-stone-900 border border-stone-900 text-sm text-center">
                            {{ $description->qty }}
                        </td>
                    @endif
                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                        {{ filter_var($location->side, FILTER_SANITIZE_NUMBER_INT) }}
                    </td>
                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                        {{ $location->media_size->size }}
                        -
                        @if ($location->orientation == 'Vertikal')
                            V
                        @elseif ($location->orientation == 'Horizontal')
                            H
                        @endif
                    </td>
                    <td class="text-stone-900 border border-stone-900 text-center text-sm">
                        @if ($category == 'Signage')
                            @if (request('type') == null || request('type') == 'All')
                                <input id="{{ $description->type }}" value="{{ $location->id }}" type="checkbox"
                                    title="Pilih bentuk terlebih dahulu" disabled>
                            @else
                                <input value="{{ $location->id }}" type="checkbox" title="pilih"
                                    onclick="getLocation(this)">
                            @endif
                        @else
                            <input value="{{ $location->id }}" type="checkbox" title="pilih"
                                onclick="getLocation(this)">
                        @endif
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
