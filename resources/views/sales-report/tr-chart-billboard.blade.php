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
    <td class="text-black text-[0.65rem] border">
        <div class="flex h-5 items-center relative">
            @php
                $counter = 0;
            @endphp
            @foreach ($location->sales as $locationSale)
                @php
                    $clients = json_decode($locationSale->quotation->clients);
                    $counter++;
                @endphp
                @if ($locationSale->end_at > date('Y-m-d'))
                    @php
                        if (strtotime($locationSale->start_at) > strtotime(date($thisYear . '-01-01'))) {
                            $start =
                                (strtotime($locationSale->start_at) - strtotime(date($thisYear . '-01-01'))) /
                                60 /
                                60 /
                                24;
                        } else {
                            $start = 0;
                        }
                        if (strtotime($locationSale->end_at) > strtotime(date($thisYear . '-12-31'))) {
                            $lineWidth =
                                (strtotime(date($thisYear . '-12-31')) - strtotime($locationSale->start_at)) /
                                60 /
                                60 /
                                24;
                        } elseif (strtotime($locationSale->start_at) > strtotime(date($thisYear . '-01-01'))) {
                            $lineWidth =
                                (strtotime($locationSale->end_at) - strtotime($locationSale->start_at)) / 60 / 60 / 24;
                        } else {
                            $lineWidth =
                                (strtotime($locationSale->end_at) - strtotime($thisYear . '-01-01')) / 60 / 60 / 24;
                        }
                    @endphp
                    <div class="absolute z-50">
                        <div class="flex">
                            @for ($i = 0; $i < 365; $i++)
                                @if ($i < $start)
                                    <div class="h-[2px] w-[1px]">
                                    </div>
                                @elseif($i == $start + 4)
                                    @if (strtotime($locationSale->end_at) > strtotime(date($thisYear . '-01-01')))
                                        @if ($lineWidth <= 31)
                                            <a
                                                href="/marketing/sales/{{ $locationSale->id }}">{{ substr($clients->name, 0, 4) }}..</a>
                                        @elseif ($lineWidth > 31 && $lineWidth <= 45)
                                            <a
                                                href="/marketing/sales/{{ $locationSale->id }}">{{ substr($clients->name, 0, 6) }}..</a>
                                        @elseif ($lineWidth > 45 && $lineWidth <= 60)
                                            <a
                                                href="/marketing/sales/{{ $locationSale->id }}">{{ substr($clients->name, 0, 8) }}..</a>
                                        @else
                                            <a
                                                href="/marketing/sales/{{ $locationSale->id }}">{{ $clients->name }}</a>
                                        @endif
                                    @endif
                                @endif
                            @endfor
                        </div>
                        <div class="flex">
                            @if ($locationSale->start_at < date('Y-m-d'))
                                @for ($i = 0; $i < 365; $i++)
                                    @if ($i < $start)
                                        <div class="h-[2px] w-[1px]">
                                        </div>
                                    @elseif($i >= $start && $i <= $lineWidth + $start)
                                        @if ($locationSale->company_id == '1')
                                            <div class="h-[2px] bg-red-700 w-[1px]">
                                            </div>
                                        @elseif ($locationSale->company_id == '3')
                                            <div class="h-[2px] bg-lime-700 w-[1px]">
                                            </div>
                                        @else
                                            <div class="h-[2px] bg-blue-700 w-[1px]">
                                            </div>
                                        @endif
                                    @endif
                                @endfor
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
                        </div>
                    </div>
                @elseif (strtotime(date($locationSale->end_at)) > strtotime(date($thisYear . '-01-01')) &&
                        strtotime(date($locationSale->end_at)) < date('Y-m-d'))
                    @php
                        if (strtotime(date($locationSale->start_at)) > strtotime(date($thisYear . '-01-01'))) {
                            $start =
                                (strtotime($locationSale->start_at) - strtotime(date($thisYear . '-01-01'))) /
                                60 /
                                60 /
                                24;
                            $lineWidth =
                                (strtotime(date($locationSale->end_at)) - strtotime($locationSale->start_at)) /
                                60 /
                                60 /
                                24;
                        } else {
                            $start = 0;
                            $lineWidth =
                                (strtotime(date($locationSale->end_at)) - strtotime(date($thisYear . '-01-01'))) /
                                60 /
                                60 /
                                24;
                        }
                    @endphp
                    <div class="absolute z-50">
                        <div class="flex">
                            @for ($i = 0; $i < 365; $i++)
                                @if ($i < $start)
                                    <div class="w-[1px]">
                                    </div>
                                @elseif($i == $start)
                                    @if ($lineWidth - $start <= 31)
                                        <a
                                            href="/marketing/sales/{{ $locationSale->id }}">{{ substr($clients->name, 0, 4) }}..</a>
                                    @else
                                        <a href="/marketing/sales/{{ $locationSale->id }}">{{ $clients->name }}</a>
                                    @endif
                                @endif
                            @endfor
                        </div>
                        <div class="flex">
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
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
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
    <td class="relative text-black border text-[0.65rem] text-center">
    </td>
    <td class="relative text-black border text-[0.65rem] text-center">
    </td>
</tr>
