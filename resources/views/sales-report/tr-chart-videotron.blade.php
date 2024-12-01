<tr class="bg-stone-100">
    <td class="text-black border text-[0.65rem] text-center">
        {{ $loop->iteration }}
    </td>
    <td class="text-black border text-[0.65rem] text-center">
        {{ $location->code }}-{{ $location->city->code }}</td>
    <td class="text-black border text-[0.65rem] px-2">
        {{ $location->address }}
    </td>
    <td class="text-black border text-[0.65rem] text-center">
        {{ $location->media_category->code }}</td>
    <td class="text-black border text-[0.65rem] text-center">
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
    <td class="text-black border text-[0.65rem] text-center">
        {{ preg_replace('/[^0-9]/', '', $location->side) }}</td>
    <td class="text-black border text-[0.65rem] text-center">
        @if ($location->media_category->name == 'Signage')
            {{ $description->qty }}
        @else
            1
        @endif
    </td>
    <td class="text-black border text-[0.65rem] text-center">
        {{ $location->media_size->size }}
        -
        @if ($location->orientation == 'Vertikal')
            V
        @elseif ($location->orientation == 'Horizontal')
            H
        @endif
    </td>
    <td class="text-black border text-[0.65rem] text-center"></td>
    <td class="text-black border text-[0.65rem] text-center"></td>
    </td>
    <td class="text-black border text-[0.65rem] text-center"></td>
    <td class="text-black border text-[0.65rem] text-center"></td>
    <td class="text-black border text-[0.65rem] text-center"></td>
    <td class="text-black border text-[0.65rem] text-center"></td>
    <td class="text-black text-[0.65rem] border"></td>
    <td class="relative text-black border text-[0.65rem] text-center"></td>
    <td class="relative text-black border text-[0.65rem] text-center">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center">
    </td>
</tr>
