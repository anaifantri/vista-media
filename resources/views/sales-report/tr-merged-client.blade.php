<tr>
    <td class="text-black border text-[0.65rem] text-center bg-lime-50" colspan="8">
        @if (count($videotronSales) != 0)
            Slot ke {{ $usedSlot }}
        @else
            Slot ke {{ $indexSlot + 1 }}
        @endif
    </td>
    <td class="text-black border text-[0.65rem] text-center bg-lime-50" rowspan="{{ $slotQty }}">
        @if ($lastNumber)
            {{ substr($lastNumber, 0, 13) }}..
        @else
            -
        @endif
    </td>
    <td class="text-black border text-[0.65rem] text-center bg-lime-50" rowspan="{{ $slotQty }}">
        @if ($lastClient)
            {{ $lastClient->name }}
        @else
            -
        @endif
    </td>
    </td>
    <td class="text-black border text-[0.65rem] text-center bg-lime-50" rowspan="{{ $slotQty }}">
        @if ($lastPrice)
            {{ number_format($lastPrice) }}
        @else
            -
        @endif
    </td>
    <td class="text-black border text-[0.65rem] text-center bg-lime-50" rowspan="{{ $slotQty }}">
        @if ($duration)
            {{ $duration }}
        @else
            -
        @endif
    </td>
    <td class="text-black border text-[0.65rem] text-center bg-lime-50" rowspan="{{ $slotQty }}">
        @if ($start_at)
            {{ date('d-m-Y', strtotime($start_at)) }}
        @else
            -
        @endif
    </td>
    <td class="text-black border text-[0.65rem] text-center bg-lime-50" rowspan="{{ $slotQty }}">
        @if ($end_at)
            {{ date('d-m-Y', strtotime($end_at)) }}
        @else
            -
        @endif
    </td>
    <td class="text-black text-[0.65rem] border  bg-lime-50" rowspan="{{ $slotQty }}">
        <div class="flex h-5 items-center relative">
            @php
                if (strtotime($start_at) > strtotime(date($thisYear . '-01-01'))) {
                    $start = (strtotime($start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                } else {
                    $start = 0;
                }
                if (strtotime($end_at) > strtotime(date($thisYear . '-12-31'))) {
                    $lineWidth = (strtotime(date($thisYear . '-12-31')) - strtotime($start_at)) / 60 / 60 / 24;
                } elseif (strtotime($start_at) > strtotime(date($thisYear . '-01-01'))) {
                    $lineWidth = (strtotime($end_at) - strtotime($start_at)) / 60 / 60 / 24;
                } else {
                    $lineWidth = (strtotime($end_at) - strtotime($thisYear . '-01-01')) / 60 / 60 / 24;
                }
            @endphp
            <div class="absolute z-50">
                <div class="flex">
                    @for ($i = 0; $i < 365; $i++)
                        @if ($i < $start)
                            <div class="h-[2px] w-[1px]">
                            </div>
                        @elseif($i == $start + 4)
                            <a href="/marketing/sales/{{ $videotronSale->id }}">{{ $lastClient->name }}</a>
                        @endif
                    @endfor
                </div>
                <div class="flex">
                    @for ($i = 0; $i < 365; $i++)
                        @if ($i < $start)
                            <div class="h-[2px] w-[1px]">
                            </div>
                        @elseif($i >= $start && $i <= $lineWidth + $start)
                            <div class="h-[2px] bg-red-700 w-[1px]">
                            </div>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-lime-50" rowspan="{{ $slotQty }}">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-lime-50" rowspan="{{ $slotQty }}">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-lime-50" rowspan="{{ $slotQty }}">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-lime-50" rowspan="{{ $slotQty }}">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-lime-50" rowspan="{{ $slotQty }}">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-lime-50" rowspan="{{ $slotQty }}">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-lime-50" rowspan="{{ $slotQty }}">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-lime-50" rowspan="{{ $slotQty }}">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-lime-50" rowspan="{{ $slotQty }}">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-lime-50" rowspan="{{ $slotQty }}">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-lime-50" rowspan="{{ $slotQty }}">
    </td>
</tr>
