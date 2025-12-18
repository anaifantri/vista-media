<tr>
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
    <td class="text-black border text-[0.65rem] text-center">
        @if ($lastNumber)
            {{ substr($lastNumber, 0, 13) }}..
        @else
            -
        @endif
    </td>
    <td class="text-black border text-[0.65rem] text-center">
        @if ($lastClient)
            {{ $lastClient->name }}
        @else
            -
        @endif
    </td>
    </td>
    <td class="text-black border text-[0.65rem] text-center">
        @if ($lastPrice)
            {{ number_format($lastPrice) }}
        @else
            -
        @endif
    </td>
    <td class="text-black border text-[0.65rem] text-center">
        @if ($duration)
            {{ $duration }}
        @else
            -
        @endif
    </td>
    <td class="text-black border text-[0.65rem] text-center">
        @if ($start_at)
            {{ date('d-m-Y', strtotime($start_at)) }}
        @else
            -
        @endif
    </td>
    <td class="text-black border text-[0.65rem] text-center">
        @if ($end_at)
            {{ date('d-m-Y', strtotime($end_at)) }}
        @else
            -
        @endif
    </td>
    <td class="text-black text-[0.65rem] border bg-blue-50">
        <div class="flex h-5 items-center relative">
            @php
                $counter = 0;
                $sales = $location->sales
                    ->where('end_at', '>', $thisYear . '-01-01')
                    ->where('start_at', '<', $thisYear . '-12-31');
            @endphp
            @foreach ($sales as $sale)
                @php
                    $clients = json_decode($sale->quotation->clients);
                    $counter++;
                    if ($sale->end_at > date('Y-m-d')) {
                        if (strtotime($sale->start_at) > strtotime(date($thisYear . '-01-01'))) {
                            $start =
                                (strtotime($sale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                        } else {
                            $start = 0;
                        }
                        if (strtotime($sale->end_at) > strtotime(date($thisYear . '-12-31'))) {
                            $lineWidth =
                                (strtotime(date($thisYear . '-12-31')) - strtotime($sale->start_at)) / 60 / 60 / 24;
                        } elseif (strtotime($sale->start_at) > strtotime(date($thisYear . '-01-01'))) {
                            $lineWidth = (strtotime($sale->end_at) - strtotime($sale->start_at)) / 60 / 60 / 24;
                        } else {
                            $lineWidth = (strtotime($sale->end_at) - strtotime($thisYear . '-01-01')) / 60 / 60 / 24;
                        }
                    } elseif (
                        strtotime(date($sale->end_at)) > strtotime(date($thisYear . '-01-01')) &&
                        strtotime(date($sale->end_at)) < date('Y-m-d')
                    ) {
                        if (strtotime(date($sale->start_at)) > strtotime(date($thisYear . '-01-01'))) {
                            $start =
                                (strtotime($sale->start_at) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                            $lineWidth = (strtotime(date($sale->end_at)) - strtotime($sale->start_at)) / 60 / 60 / 24;
                        } else {
                            $start = 0;
                            $lineWidth =
                                (strtotime(date($sale->end_at)) - strtotime(date($thisYear . '-01-01'))) / 60 / 60 / 24;
                        }
                    }
                    $GLOBALS['col_start'] = $start + 1;
                    $GLOBALS['col_end'] = $lineWidth + $start;
                @endphp
                <div class="absolute z-50">
                    <div class="grid grid-cols-365 gap-0 w-[365px]">
                        @if ($sale->end_at > date('Y-m-d'))
                            @if (strtotime($sale->end_at) > strtotime(date($thisYear . '-01-01')))
                                @if ($lineWidth <= 45)
                                    <a class="col-start-[--col-start] w-20" style="--col-start: <?php echo $GLOBALS['col_start']; ?>;"
                                        href="/marketing/sales/{{ $sale->id }}">{{ substr($clients->name, 0, 6) }}..</a>
                                @else
                                    <a class="col-start-[--col-start] w-20" style="--col-start: <?php echo $GLOBALS['col_start']; ?>;"
                                        href="/marketing/sales/{{ $sale->id }}">{{ $clients->name }}</a>
                                @endif
                            @endif
                        @elseif (strtotime(date($sale->end_at)) > strtotime(date($thisYear . '-01-01')) &&
                                strtotime(date($sale->end_at)) < date('Y-m-d'))
                            @if ($lineWidth - $start <= 45)
                                <a class="col-start-[--col-start] w-20" style="--col-start: <?php echo $GLOBALS['col_start']; ?>;"
                                    href="/marketing/sales/{{ $sale->id }}">{{ substr($clients->name, 0, 6) }}..</a>
                            @else
                                <a class="col-start-[--col-start] w-20" style="--col-start: <?php echo $GLOBALS['col_start']; ?>;"
                                    href="/marketing/sales/{{ $sale->id }}">{{ $clients->name }}</a>
                            @endif
                        @endif
                    </div>
                    <div class="grid grid-cols-365 gap-0 w-[365px]">
                        @if ($sale->start_at < date('Y-m-d'))
                            @if (date($sale->end_at) < date('Y-m-d'))
                                @if ($counter % 2 == 0)
                                    <div class="h-[3px] bg-stone-600 col-start-[--col-start] col-end-[--col-end]"
                                        style="--col-start: <?php echo $GLOBALS['col_start']; ?>;--col-end: <?php echo $GLOBALS['col_end']; ?>;">
                                    </div>
                                @else
                                    <div class="h-[3px] bg-stone-400 col-start-[--col-start] col-end-[--col-end]"
                                        style="--col-start: <?php echo $GLOBALS['col_start']; ?>;--col-end: <?php echo $GLOBALS['col_end']; ?>;">
                                    </div>
                                @endif
                            @else
                                @if ($sale->company_id == '1')
                                    <div class="h-[3px] bg-red-700 col-start-[--col-start] col-end-[--col-end]"
                                        style="--col-start: <?php echo $GLOBALS['col_start']; ?>;--col-end: <?php echo $GLOBALS['col_end']; ?>;">
                                    </div>
                                @elseif ($sale->company_id == '3')
                                    <div class="h-[3px] bg-lime-700 col-start-[--col-start] col-end-[--col-end]"
                                        style="--col-start: <?php echo $GLOBALS['col_start']; ?>;--col-end: <?php echo $GLOBALS['col_end']; ?>;">
                                    </div>
                                @else
                                    <div class="h-[3px] bg-blue-700 col-start-[--col-start] col-end-[--col-end]"
                                        style="--col-start: <?php echo $GLOBALS['col_start']; ?>;--col-end: <?php echo $GLOBALS['col_end']; ?>;">
                                    </div>
                                @endif
                            @endif
                        @else
                            <div class="h-[3px] bg-stone-700 col-start-[--col-start] col-end-[--col-end]"
                                style="--col-start: <?php echo $GLOBALS['col_start']; ?>;--col-end: <?php echo $GLOBALS['col_end']; ?>;">
                            </div>
                        @endif
                    </div>
                    {{-- <div class="flex">
                        @if ($sale->start_at < date('Y-m-d'))
                            @if (date($sale->end_at) < date('Y-m-d'))
                                @for ($i = 0; $i < 365; $i++)
                                    @if ($i < $start)
                                        <div class="h-[2px] w-[1px]">
                                        </div>
                                    @elseif($i >= $start && $i <= $lineWidth + $start)
                                        @if ($counter % 2 == 0)
                                            <div class="h-[2px] bg-stone-600 w-[1px]">
                                            </div>
                                        @else
                                            <div class="h-[2px] bg-stone-400 w-[1px]">
                                            </div>
                                        @endif
                                    @endif
                                @endfor
                            @else
                                @if ($sale->company_id == '1')
                                    @for ($i = 0; $i < 365; $i++)
                                        @if ($i < $start)
                                            <div class="h-[2px] w-[1px]">
                                            </div>
                                        @elseif($i >= $start && $i <= $lineWidth + $start)
                                            <div class="h-[2px] bg-red-700 w-[1px]">
                                            </div>
                                        @endif
                                    @endfor
                                @elseif ($sale->company_id == '3')
                                    @for ($i = 0; $i < 365; $i++)
                                        @if ($i < $start)
                                            <div class="h-[2px] w-[1px]">
                                            </div>
                                        @elseif($i >= $start && $i <= $lineWidth + $start)
                                            <div class="h-[2px] bg-lime-700 w-[1px]">
                                            </div>
                                        @endif
                                    @endfor
                                @else
                                    @for ($i = 0; $i < 365; $i++)
                                        @if ($i < $start)
                                            <div class="h-[2px] w-[1px]">
                                            </div>
                                        @elseif($i >= $start && $i <= $lineWidth + $start)
                                            @if ($sale->company_id == '1')
                                                <div class="h-[2px] bg-red-700 w-[1px]">
                                                </div>
                                            @elseif ($sale->company_id == '3')
                                                <div class="h-[2px] bg-lime-700 w-[1px]">
                                                </div>
                                            @else
                                                <div class="h-[2px] bg-blue-700 w-[1px]">
                                                </div>
                                            @endif
                                        @endif
                                    @endfor
                                @endif
                            @endif
                        @else
                            @for ($i = 0; $i < 365; $i++)
                                @if ($i < $start)
                                    <div class="h-[2px] w-[1px]">
                                    </div>
                                @elseif($i >= $start && $i <= $lineWidth + $start)
                                    <div class="h-[2px] bg-stone-700 w-[1px]">
                                    </div>
                                @endif
                            @endfor
                        @endif
                    </div> --}}
                </div>
            @endforeach
        </div>
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-green-50">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-blue-50">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-green-50">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-blue-50">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-green-50">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-blue-50">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-green-50">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-blue-50">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-green-50">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-blue-50">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center bg-green-50">
    </td>
</tr>
