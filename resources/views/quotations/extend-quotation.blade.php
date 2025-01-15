<table class="table-auto w-full" id="locationsTable">
    <thead>
        <tr class="bg-stone-400">
            <th class="text-stone-900 border border-stone-900 text-xs w-8 text-center" rowspan="2">No</th>
            <th class="text-stone-900 border border-stone-900 text-xs w-20 text-center" rowspan="2">Kode</th>
            <th class="text-stone-900 border border-stone-900 text-xs text-center" rowspan="2">Lokasi</th>
            <th class="text-stone-900 border border-stone-900 text-xs text-center w-16" rowspan="2">Area</th>
            <th class="text-stone-900 border border-stone-900 text-xs text-center w-16" rowspan="2">Kota</th>
            <th class="text-stone-900 border border-stone-900 text-xs text-center w-28" rowspan="2">Klien</th>
            <th class="text-stone-900 border border-stone-900 text-xs text-center w-44" colspan="2">Periode Kontrak
            </th>
            @if ($category == 'Signage')
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-48" colspan="5">Deskripsi
                    Lokasi</th>
            @else
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-48" colspan="4">Deskripsi
                    Lokasi</th>
            @endif
            <th class="text-stone-900 border border-stone-900 text-xs text-center w-14" rowspan="2">Action</th>
        </tr>
        <tr class="bg-stone-400">
            <th class="text-stone-900 border border-stone-900 text-xs w-24 text-center" rowspan="2">Awal</th>
            <th class="text-stone-900 border border-stone-900 text-xs w-24 text-center" rowspan="2">Akhir</th>
            @if ($category == 'Signage')
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-16" rowspan="2">Bentuk</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-10" rowspan="2">BL/FL</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-10" rowspan="2">Qty</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-8" rowspan="2">Side</th>
            @else
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-10" rowspan="2">Jenis</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-10" rowspan="2">BL/FL</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-8" rowspan="2">Side</th>
            @endif
            <th class="text-stone-900 border border-stone-900 text-xs text-center w-20" rowspan="2">Size - V/H</th>
        </tr>
    </thead>
    <tbody class="bg-stone-300">
        @foreach ($locations as $location)
            @php
                $description = json_decode($location->description);
            @endphp
            @if ($category == 'Videotron' || ($category == 'Signage' && $description->type == 'Videotron'))
                @if (count($location->videotron_active_sales) > 1)
                    @foreach ($location->videotron_active_sales as $location_sale)
                        @php
                            $client = json_decode($location_sale->quotation->clients);
                            $start_at = $location_sale->start_at;
                            $end_at = $location_sale->end_at;
                        @endphp
                        <tr>
                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                {{ $location->code }}
                                -
                                {{ $location->city->code }}</td>
                            <td class="text-stone-900 border border-stone-900 text-xs px-2">{{ $location->address }}
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                {{ $location->area->area }}</td>
                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                {{ $location->city->city }}</td>
                            <td class="text-stone-900 border border-stone-900 text-xs px-2 text-center">
                                {{ $client->name }}
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-xs px-2 text-center">
                                {{ date('d-M-Y', strtotime($start_at)) }}
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-xs px-2 text-center">
                                {{ date('d-M-Y', strtotime($end_at)) }}
                            </td>
                            @if ($category == 'Signage')
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $description->type }}
                                </td>
                            @else
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $location->media_category->code }}
                                </td>
                            @endif
                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                @if (
                                    $location->media_category->name == 'Videotron' ||
                                        ($location->media_category->name == 'Signage' && $description->type == 'Videotron'))
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
                            </td>
                            @if ($category == 'Signage')
                                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                    {{ $description->qty }}
                                </td>
                            @endif
                            <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                {{ filter_var($location->side, FILTER_SANITIZE_NUMBER_INT) }}
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                                {{ $location->media_size->size }}
                                -
                                @if ($location->orientation == 'Vertikal')
                                    V
                                @elseif ($location->orientation == 'Horizontal')
                                    H
                                @endif
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-center text-xs">
                                @if ($location->media_category->name == 'Signage')
                                    @if (request('type') == null || request('type') == 'All')
                                        <input id="{{ $description->type }}" value="{{ $location_sale->id }}"
                                            type="checkbox" title="pilih" onclick="getExtendLocation(this)" disabled>
                                    @else
                                        <input value="{{ $location_sale->id }}" type="checkbox" title="pilih"
                                            onclick="getExtendLocation(this)">
                                    @endif
                                @else
                                    <input value="{{ $location_sale->id }}" type="checkbox" title="pilih"
                                        onclick="getExtendLocation(this)">
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-stone-900 border border-stone-900 text-xs text-center">{{ $loop->iteration }}
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-xs text-center">
                            {{ $location->code }}
                            -
                            {{ $location->city->code }}</td>
                        <td class="text-stone-900 border border-stone-900 text-xs px-2">{{ $location->address }}
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-xs text-center">
                            {{ $location->area->area }}</td>
                        <td class="text-stone-900 border border-stone-900 text-xs text-center">
                            {{ $location->city->city }}</td>
                        <td class="text-stone-900 border border-stone-900 text-xs px-2 text-center">
                            {{ $clients[$loop->iteration - 1]->name }}
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-xs px-2 text-center">
                            {{ date('d-M-Y', strtotime($sales[$loop->iteration - 1]->start_at)) }}
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-xs px-2 text-center">
                            {{ date('d-M-Y', strtotime($sales[$loop->iteration - 1]->end_at)) }}
                        </td>
                        @if ($category == 'Signage')
                            <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                {{ $description->type }}
                            </td>
                        @else
                            <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                {{ $location->media_category->code }}
                            </td>
                        @endif
                        <td class="text-stone-900 border border-stone-900 text-xs text-center">
                            @if (
                                $location->media_category->name == 'Videotron' ||
                                    ($location->media_category->name == 'Signage' && $description->type == 'Videotron'))
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
                        </td>
                        @if ($category == 'Signage')
                            <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                {{ $description->qty }}
                            </td>
                        @endif
                        <td class="text-stone-900 border border-stone-900 text-sm text-center">
                            {{ filter_var($location->side, FILTER_SANITIZE_NUMBER_INT) }}
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-xs text-center">
                            {{ $location->media_size->size }}
                            -
                            @if ($location->orientation == 'Vertikal')
                                V
                            @elseif ($location->orientation == 'Horizontal')
                                H
                            @endif
                        </td>
                        <td class="text-stone-900 border border-stone-900 text-center text-xs">
                            @if ($location->media_category->name == 'Signage')
                                @if (request('type') == null || request('type') == 'All')
                                    <input id="{{ $description->type }}"
                                        value="{{ $sales[$loop->iteration - 1]->id }}" type="checkbox" title="pilih"
                                        onclick="getExtendLocation(this)" disabled>
                                @else
                                    <input value="{{ $sales[$loop->iteration - 1]->id }}" type="checkbox"
                                        title="pilih" onclick="getExtendLocation(this)">
                                @endif
                            @else
                                <input value="{{ $sales[$loop->iteration - 1]->id }}" type="checkbox" title="pilih"
                                    onclick="getExtendLocation(this)">
                            @endif
                        </td>
                    </tr>
                @endif
            @else
                <tr>
                    <td class="text-stone-900 border border-stone-900 text-xs text-center">{{ $loop->iteration }}
                    </td>
                    <td class="text-stone-900 border border-stone-900 text-xs text-center">
                        {{ $location->code }}
                        -
                        {{ $location->city->code }}</td>
                    <td class="text-stone-900 border border-stone-900 text-xs px-2">{{ $location->address }}
                    </td>
                    <td class="text-stone-900 border border-stone-900 text-xs text-center">
                        {{ $location->area->area }}</td>
                    <td class="text-stone-900 border border-stone-900 text-xs text-center">
                        {{ $location->city->city }}</td>
                    <td class="text-stone-900 border border-stone-900 text-xs px-2 text-center">
                        {{ $clients[$loop->iteration - 1]->name }}
                    </td>
                    <td class="text-stone-900 border border-stone-900 text-xs px-2 text-center">
                        {{ date('d-M-Y', strtotime($sales[$loop->iteration - 1]->start_at)) }}
                    </td>
                    <td class="text-stone-900 border border-stone-900 text-xs px-2 text-center">
                        {{ date('d-M-Y', strtotime($sales[$loop->iteration - 1]->end_at)) }}
                    </td>
                    @if ($category == 'Signage')
                        <td class="text-stone-900 border border-stone-900 text-sm text-center">
                            {{ $description->type }}
                        </td>
                    @else
                        <td class="text-stone-900 border border-stone-900 text-sm text-center">
                            {{ $location->media_category->code }}
                        </td>
                    @endif
                    <td class="text-stone-900 border border-stone-900 text-xs text-center">
                        @if (
                            $location->media_category->name == 'Videotron' ||
                                ($location->media_category->name == 'Signage' && $description->type == 'Videotron'))
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
                    </td>
                    @if ($category == 'Signage')
                        <td class="text-stone-900 border border-stone-900 text-sm text-center">
                            {{ $description->qty }}
                        </td>
                    @endif
                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                        {{ filter_var($location->side, FILTER_SANITIZE_NUMBER_INT) }}
                    </td>
                    <td class="text-stone-900 border border-stone-900 text-xs text-center">
                        {{ $location->media_size->size }}
                        -
                        @if ($location->orientation == 'Vertikal')
                            V
                        @elseif ($location->orientation == 'Horizontal')
                            H
                        @endif
                    </td>
                    <td class="text-stone-900 border border-stone-900 text-center text-xs">
                        @if ($location->media_category->name == 'Signage')
                            @if (request('type') == null || request('type') == 'All')
                                <input name="{{ $clients[$loop->iteration - 1]->name }}"
                                    id="{{ $description->type }}" value="{{ $sales[$loop->iteration - 1]->id }}"
                                    type="checkbox" title="pilih" onclick="getExtendLocation(this)" disabled>
                            @else
                                <input name="{{ $clients[$loop->iteration - 1]->name }}"
                                    value="{{ $sales[$loop->iteration - 1]->id }}" type="checkbox" title="pilih"
                                    onclick="getExtendLocation(this)">
                            @endif
                        @else
                            <input name="{{ $clients[$loop->iteration - 1]->name }}"
                                value="{{ $sales[$loop->iteration - 1]->id }}" type="checkbox" title="pilih"
                                onclick="getExtendLocation(this)">
                        @endif
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
