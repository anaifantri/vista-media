<table class="table-auto w-full">
    <thead>
        <tr class="bg-teal-100 h-10">
            <th class="text-teal-700 border text-sm w-8 text-center">No</th>
            <th class="text-teal-700 border text-sm w-24 text-center">Kode</th>
            <th class="text-teal-700 border text-sm text-center">Lokasi</th>
            <th class="text-teal-700 border text-sm text-center w-24">Area</th>
            <th class="text-teal-700 border text-sm text-center w-24">Kota</th>
            <th class="text-teal-700 border text-sm text-center w-24">Jenis</th>
            <th class="text-teal-700 border text-sm text-center w-28">Size - V/H</th>
            <th class="text-teal-700 border text-sm text-center w-12">BL/FL</th>
            <th class="text-teal-700 border text-sm text-center w-16">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $number = 1 + ($locations->currentPage() - 1) * $locations->perPage();
        @endphp
        @foreach ($locations as $location)
            @php
                $description = json_decode($location->description);
            @endphp
            <tr>
                <td class="text-teal-700 border text-sm text-center">{{ $number++ }}
                </td>
                <td class="text-teal-700 border text-sm text-center">{{ $location->code }}
                    -
                    {{ $location->city->code }}</td>
                <td class="text-teal-700 border text-sm px-2">{{ $location->address }}
                </td>
                <td class="text-teal-700 border text-sm text-center">
                    {{ $location->area->area }}
                </td>
                <td class="text-teal-700 border text-sm text-center">
                    {{ $location->city->city }}
                </td>
                <td class="text-teal-700 border text-sm text-center">
                    {{ $location->media_category->name }}
                </td>
                <td class="text-teal-700 border text-sm text-center">
                    {{ $location->media_size->size }}
                    -
                    @if ($location->orientation == 'Vertikal')
                        V
                    @elseif ($location->orientation == 'Horizontal')
                        H
                    @endif
                </td>
                <td class="text-teal-700 border text-sm text-center">
                    @if ($location->media_category->name == 'Videotron')
                        -
                    @elseif ($location->media_category->name == 'Signage')
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
                <td id="tdCreate" class="text-teal-700 border align-middle text-center text-sm">
                    <input value="{{ $location->id }}" type="radio" name="chooseLocation" title="pilih"
                        onclick="getLocation(this)">
                    <label class="ml-1">Pilih</label>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
