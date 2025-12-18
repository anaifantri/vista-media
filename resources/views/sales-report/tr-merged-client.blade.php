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
    <td class="text-black text-[0.65rem] border  bg-blue-50" rowspan="{{ $slotQty }}">
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
                $GLOBALS['col_start'] = $start + 1;
                $GLOBALS['col_end'] = $lineWidth + $start;
            @endphp
            <div class="absolute z-50">
                <div class="grid grid-cols-365 gap-0 w-[365px]">
                    @if ($videotronSale->end_at > date('Y-m-d'))
                        @if (strtotime($videotronSale->end_at) > strtotime(date($thisYear . '-01-01')))
                            @if ($lineWidth <= 45)
                                <a class="col-start-[--col-start] w-20" style="--col-start: <?php echo $GLOBALS['col_start']; ?>;"
                                    href="/marketing/sales/{{ $videotronSale->id }}">{{ substr($lastClient->name, 0, 6) }}..</a>
                            @else
                                <a class="col-start-[--col-start] w-20" style="--col-start: <?php echo $GLOBALS['col_start']; ?>;"
                                    href="/marketing/sales/{{ $videotronSale->id }}">{{ $lastClient->name }}</a>
                            @endif
                        @endif
                    @elseif (strtotime(date($videotronSale->end_at)) > strtotime(date($thisYear . '-01-01')) &&
                            strtotime(date($videotronSale->end_at)) < date('Y-m-d'))
                        @if ($lineWidth - $start <= 45)
                            <a class="col-start-[--col-start] w-20" style="--col-start: <?php echo $GLOBALS['col_start']; ?>;"
                                href="/marketing/sales/{{ $videotronSale->id }}">{{ substr($lastClient->name, 0, 6) }}..</a>
                        @else
                            <a class="col-start-[--col-start] w-20" style="--col-start: <?php echo $GLOBALS['col_start']; ?>;"
                                href="/marketing/sales/{{ $videotronSale->id }}">{{ $lastClient->name }}</a>
                        @endif
                    @endif
                </div>
                <div class="grid grid-cols-365 gap-0 w-[365px]">
                    @if ($videotronSale->start_at < date('Y-m-d'))
                        @if ($videotronSale->company_id == '1')
                            <div class="h-[3px] bg-red-700 col-start-[--col-start] col-end-[--col-end]"
                                style="--col-start: <?php echo $GLOBALS['col_start']; ?>;--col-end: <?php echo $GLOBALS['col_end']; ?>;">
                            </div>
                        @elseif ($videotronSale->company_id == '3')
                            <div class="h-[3px] bg-lime-700 col-start-[--col-start] col-end-[--col-end]"
                                style="--col-start: <?php echo $GLOBALS['col_start']; ?>;--col-end: <?php echo $GLOBALS['col_end']; ?>;">
                            </div>
                        @else
                            <div class="h-[3px] bg-blue-700 col-start-[--col-start] col-end-[--col-end]"
                                style="--col-start: <?php echo $GLOBALS['col_start']; ?>;--col-end: <?php echo $GLOBALS['col_end']; ?>;">
                            </div>
                        @endif
                    @else
                        <div class="h-[3px] bg-stone-700 col-start-[--col-start] col-end-[--col-end]"
                            style="--col-start: <?php echo $GLOBALS['col_start']; ?>;--col-end: <?php echo $GLOBALS['col_end']; ?>;">
                        </div>
                    @endif
                </div>
            </div>
            {{-- <div class="absolute z-50">
                <div class="flex">
                    @for ($i = 0; $i < $start; $i++)
                        <div class="h-[3px] w-[1px]">
                        </div>
                    @endfor
                    @if (strtotime($videotronSale->end_at) > strtotime(date($thisYear . '-01-01')))
                        @if ($lineWidth <= 31)
                            <a
                                href="/marketing/sales/{{ $videotronSale->id }}">{{ substr($lastClient->name, 0, 4) }}</a>
                        @elseif ($lineWidth > 31 && $lineWidth <= 45)
                            <a
                                href="/marketing/sales/{{ $videotronSale->id }}">{{ substr($lastClient->name, 0, 6) }}</a>
                        @elseif ($lineWidth > 45 && $lineWidth <= 60)
                            <a
                                href="/marketing/sales/{{ $videotronSale->id }}">{{ substr($lastClient->name, 0, 8) }}</a>
                        @else
                            <a href="/marketing/sales/{{ $videotronSale->id }}">{{ $lastClient->name }}</a>
                        @endif
                    @endif
                </div>
                <div class="flex">
                    @if ($videotronSale->start_at < date('Y-m-d'))
                        @if ($videotronSale->company_id == '1')
                            @for ($i = 0; $i < 365; $i++)
                                @if ($i < $start)
                                    <div class="h-[3px] w-[1px]">
                                    </div>
                                @elseif($i >= $start && $i <= $lineWidth + $start)
                                    <div class="h-[3px] bg-red-700 w-[1px]">
                                    </div>
                                @endif
                            @endfor
                        @elseif ($videotronSale->company_id == '3')
                            @for ($i = 0; $i < 365; $i++)
                                @if ($i < $start)
                                    <div class="h-[3px] w-[1px]">
                                    </div>
                                @elseif($i >= $start && $i <= $lineWidth + $start)
                                    <div class="h-[3px] bg-lime-700 w-[1px]">
                                    </div>
                                @endif
                            @endfor
                        @else
                            @for ($i = 0; $i < 365; $i++)
                                @if ($i < $start)
                                    <div class="h-[3px] w-[1px]">
                                    </div>
                                @elseif($i >= $start && $i <= $lineWidth + $start)
                                    <div class="h-[3px] bg-lime-700 w-[1px]">
                                    </div>
                                @endif
                            @endfor
                        @endif
                    @else
                        @for ($i = 0; $i < 365; $i++)
                            @if ($i < $start)
                                <div class="h-[3px] w-[1px]">
                                </div>
                            @elseif($i >= $start && $i <= $lineWidth + $start)
                                <div class="h-[3px] bg-stone-700 w-[1px]">
                                </div>
                            @endif
                        @endfor
                    @endif
                </div>
            </div> --}}
        </div>
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-green-50" rowspan="{{ $slotQty }}">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-blue-50" rowspan="{{ $slotQty }}">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-green-50" rowspan="{{ $slotQty }}">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-blue-50" rowspan="{{ $slotQty }}">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-green-50" rowspan="{{ $slotQty }}">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-blue-50" rowspan="{{ $slotQty }}">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-green-50" rowspan="{{ $slotQty }}">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-blue-50" rowspan="{{ $slotQty }}">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-green-50" rowspan="{{ $slotQty }}">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-blue-50" rowspan="{{ $slotQty }}">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-green-50" rowspan="{{ $slotQty }}">
    </td>
</tr>
