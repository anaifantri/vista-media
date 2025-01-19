<div class="w-[1580px] h-[1120px] px-10 mt-2 p-4 bg-white z-0">
    <div class="flex items-center border rounded-lg p-4 mt-8">
        <div class="w-44">
            <img class="ml-2 w-[125px]" src="{{ asset('storage/' . $company->logo) }}" alt="">
        </div>
        <div class="w-[750px] ml-6">
            <div>
                <span class="text-sm font-semibold">{{ $company->name }}</span>
            </div>
            <div>
                <span class="text-xs">{{ $company->address }}, Desa/Kel. {{ $company->village }},
                    Kec.
                    {{ $company->district }}</span>
            </div>
            <div>
                <span class="text-xs">{{ $company->city }} - {{ $company->province }}
                    {{ $company->post_code }}</span>
            </div>
            <div>
                <span class="text-xs">Ph. {{ $company->phone }} | Mobile.
                    {{ $company->m_phone }}</span>
            </div>
            <div>
                <span class="text-xs">e-mail : {{ $company->email }} | website :
                    {{ $company->website }}</span>
            </div>
        </div>
        <div class="flex w-full justify-end">
            <div>
                <div class="flex justify-center w-80">
                    <label id="labelArea"
                        class="text-2xl text-center border rounded-md p-1">{{ strtoupper($area->area) }}</label>
                    @if ($category != 'All')
                        <label id="labelArea" class="mx-2 font-bold text-2xl text-center p-1">-</label>
                        <label id="labelArea"
                            class="text-2xl text-center border rounded-md p-1">{{ strtoupper($category) }}</label>
                    @endif
                </div>
                <div class="flex justify-center w-80">
                    <label class="text-sm text-center">GRAFIK PERIODE KONTRAK</label>
                </div>
                <div class="flex justify-center w-80">
                    <label class="text-sm text-center"></label>
                </div>
                <div class="flex justify-center w-80 border rounded-md">
                    <?php
                    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    ?>
                    <label id="labelPeriode" class="month-report">
                        <span class="text-md font-semibold text-red-600">Tgl. Cetak : </span>
                        {{ date('d') }} {{ $bulan[(int) date('m')] }}
                        {{ date('Y') }}</label>
                </div>
            </div>
            <div class=" ml-4 mt-1">
                <div class="flex justify-center items-center w-24 border rounded-md p-1">
                    <label class="text-4xl font-semibold text-center">H</label>
                </div>
                <div class="flex justify-center items-center w-24 border rounded-md mt-1">
                    @if (request('yearReport'))
                        <label class="text-xl font-semibold text-center">{{ request('yearReport') }}</label>
                    @else
                        <label class="text-xl font-semibold text-center">{{ date('Y') }}</label>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="h-[850px] mt-8">
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="text-black border text-[0.65rem] w-8 text-center" rowspan="2">
                        No.
                    </th>
                    <th class="text-black border text-[0.65rem] w-[60px] text-center" rowspan="2">
                        <button class="flex justify-center items-center w-[60px]">@sortablelink('code', 'Kode')
                            <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                            </svg>
                        </button>
                    </th>
                    <th class="text-black border text-[0.65rem] text-center" rowspan="2">
                        Lokasi</th>
                    <th class="text-black border text-[0.65rem] text-center " colspan="5">
                        Jenis Reklame</th>
                    <th class="text-black border text-[0.65rem] text-center " colspan="4">
                        Detail Kontrak Aktif</th>
                    <th class="text-black border text-[0.65rem] text-center " colspan="2">
                        Periode Kontrak</th>
                    <th class="text-black border text-[0.65rem] text-center " colspan="12">
                        Grafik Periode Kontrak</th>
                </tr>
                <tr>
                    <th class="text-black border text-[0.65rem] text-center w-8">Jns</th>
                    <th class="text-black border text-[0.65rem] text-center w-8">BL/FL</th>
                    <th class="text-black border text-[0.65rem] text-center w-8">Side</th>
                    <th class="text-black border text-[0.65rem] text-center w-8">Qty</th>
                    <th class="text-black border text-[0.65rem] text-center w-20">Size</th>
                    <th class="text-black border text-[0.65rem] text-center w-24">No.
                        Penjualan
                    </th>
                    <th class="text-black border text-[0.65rem] text-center w-28">Klien</th>
                    <th class="text-black border text-[0.65rem] text-center w-20">Nilai</th>
                    <th class="text-black border text-[0.65rem] text-center w-14">Durasi</th>
                    <th class="text-black border text-[0.65rem] text-center w-16">Awal</th>
                    <th class="text-black border text-[0.65rem] text-center w-16">Akhir</th>
                    <th class="text-black border text-[0.65rem] text-center w-[31px]">Jan
                    </th>
                    <th class="text-black border text-[0.65rem] text-center w-[28px]">Feb
                    </th>
                    <th class="text-black border text-[0.65rem] text-center w-[31px]">Mar
                    </th>
                    <th class="text-black border text-[0.65rem] text-center w-[30px]">Apr
                    </th>
                    <th class="text-black border text-[0.65rem] text-center w-[31px]">Mei
                    </th>
                    <th class="text-black border text-[0.65rem] text-center w-[30px]">Jun
                    </th>
                    <th class="text-black border text-[0.65rem] text-center w-[31px]">Jul
                    </th>
                    <th class="text-black border text-[0.65rem] text-center w-[31px]">Agu
                    </th>
                    <th class="text-black border text-[0.65rem] text-center w-[30px]">Sep
                    </th>
                    <th class="text-black border text-[0.65rem] text-center w-[31px]">Okt
                    </th>
                    <th class="text-black border text-[0.65rem] text-center w-[30px]">Nop
                    </th>
                    <th class="text-black border text-[0.65rem] text-center w-[31px]">Des
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($locations as $location)
                    @if ($loop->iteration <= 35)
                        @php
                            $lastNumber = null;
                            $lastClient = null;
                            $lastPrice = null;
                            $duration = null;
                            $start_at = null;
                            $end_at = null;
                            $description = json_decode($location->description);
                            if (
                                $location->media_category->name == 'Videotron' ||
                                ($location->media_category->name == 'Signage' && $description->type == 'Videotron')
                            ) {
                                $videotronSales = $location->videotron_active_sales;
                                $slots = $description->slots;
                            } else {
                                if ($location->active_sale) {
                                    $lastClient = json_decode($location->active_sale->quotation->clients);
                                    $lastNumber = $location->active_sale->number;
                                    $lastPrice = $location->active_sale->price;
                                    $start_at = $location->active_sale->start_at;
                                    $end_at = $location->active_sale->end_at;
                                    $duration = $location->active_sale->duration;
                                }
                            }
                        @endphp
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
                                                if (
                                                    strtotime($locationSale->start_at) >
                                                    strtotime(date($thisYear . '-01-01'))
                                                ) {
                                                    $start =
                                                        (strtotime($locationSale->start_at) -
                                                            strtotime(date($thisYear . '-01-01'))) /
                                                        60 /
                                                        60 /
                                                        24;
                                                } else {
                                                    $start = 0;
                                                }
                                                if (
                                                    strtotime($locationSale->end_at) >
                                                    strtotime(date($thisYear . '-12-31'))
                                                ) {
                                                    $lineWidth =
                                                        (strtotime(date($thisYear . '-12-31')) -
                                                            strtotime($locationSale->start_at)) /
                                                        60 /
                                                        60 /
                                                        24;
                                                } elseif (
                                                    strtotime($locationSale->start_at) >
                                                    strtotime(date($thisYear . '-01-01'))
                                                ) {
                                                    $lineWidth =
                                                        (strtotime($locationSale->end_at) -
                                                            strtotime($locationSale->start_at)) /
                                                        60 /
                                                        60 /
                                                        24;
                                                } else {
                                                    $lineWidth =
                                                        (strtotime($locationSale->end_at) -
                                                            strtotime($thisYear . '-01-01')) /
                                                        60 /
                                                        60 /
                                                        24;
                                                }
                                            @endphp
                                            <div class="absolute z-50">
                                                <div class="flex">
                                                    @for ($i = 0; $i < 365; $i++)
                                                        @if ($i < $start)
                                                            <div class="h-[2px] w-[1px]">
                                                            </div>
                                                        @elseif($i == $start + 4)
                                                            <a
                                                                href="/marketing/sales/{{ $locationSale->id }}">{{ $clients->name }}</a>
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
                                        @elseif (strtotime(date($locationSale->end_at)) > strtotime(date($thisYear . '-01-01')) &&
                                                strtotime(date($locationSale->end_at)) < date('Y-m-d'))
                                            @php
                                                if (
                                                    strtotime(date($locationSale->start_at)) >
                                                    strtotime(date($thisYear . '-01-01'))
                                                ) {
                                                    $start =
                                                        (strtotime($locationSale->start_at) -
                                                            strtotime(date($thisYear . '-01-01'))) /
                                                        60 /
                                                        60 /
                                                        24;
                                                    $lineWidth =
                                                        (strtotime(date($locationSale->end_at)) -
                                                            strtotime($locationSale->start_at)) /
                                                        60 /
                                                        60 /
                                                        24;
                                                } else {
                                                    $start = 0;
                                                    $lineWidth =
                                                        (strtotime(date($locationSale->end_at)) -
                                                            strtotime($locationSale->start_at)) /
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
                                                                <a
                                                                    href="/marketing/sales/{{ $locationSale->id }}">{{ $clients->name }}</a>
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
                        @if (
                            $location->media_category->name == 'Videotron' ||
                                ($location->media_category->name == 'Signage' && $description->type == 'Videotron'))
                            <tr>
                                <td class="text-black border text-[0.65rem] text-center">
                                    {{-- {{ $number++ }} --}}
                                </td>
                                <td class="text-black border text-[0.65rem] text-center">
                                    {{-- {{ $location->code }}-{{ $location->city->code }} --}}
                                </td>
                                <td class="text-black border text-[0.65rem] px-2">
                                    {{-- {{ $location->address }} --}}
                                </td>
                                <td class="text-black border text-[0.65rem] text-center">
                                    {{-- {{ $location->media_category->code }} --}}
                                </td>
                                <td class="text-black border text-[0.65rem] text-center">
                                    {{-- @if ($location->media_category->name == 'Videotron' || ($location->media_category->name == 'Signage' && $description->type == 'Videotron'))
                                    -
                                @else
                                    @if ($description->lighting == 'Backlight')
                                        BL
                                    @elseif ($description->lighting == 'Frontlight')
                                        FL
                                    @elseif ($description->lighting == 'Nonlight')
                                        NL
                                    @endif
                                @endif --}}
                                </td>
                                <td class="text-black border text-[0.65rem] text-center">
                                    {{ preg_replace('/[^0-9]/', '', $location->side) }}</td>
                                <td class="text-black border text-[0.65rem] text-center">
                                    {{-- @if ($location->media_category->name == 'Signage')
                                    {{ $description->qty }}
                                @else
                                    1
                                @endif --}}
                                </td>
                                <td class="text-black border text-[0.65rem] text-center">
                                    {{-- {{ $location->media_size->size }}
                                -
                                @if ($location->orientation == 'Vertikal')
                                    V
                                @elseif ($location->orientation == 'Horizontal')
                                    H
                                @endif --}}
                                </td>
                                <td class="text-black border text-[0.65rem] text-center">
                                    {{-- @if ($lastNumber)
                                    {{ substr($lastNumber, 0, 13) }}..
                                @else
                                    -
                                @endif --}}
                                </td>
                                <td class="text-black border text-[0.65rem] text-center">
                                    {{-- @if ($lastClient)
                                    {{ $lastClient->name }}
                                @else
                                    -
                                @endif --}}
                                </td>
                                </td>
                                <td class="text-black border text-[0.65rem] text-center">
                                    {{-- @if ($lastPrice)
                                    {{ number_format($lastPrice) }}
                                @else
                                    -
                                @endif --}}
                                </td>
                                <td class="text-black border text-[0.65rem] text-center">
                                    {{-- @if ($duration)
                                    {{ $duration }}
                                @else
                                    -
                                @endif --}}
                                </td>
                                <td class="text-black border text-[0.65rem] text-center">
                                    {{-- @if ($start_at)
                                    {{ date('d-m-Y', strtotime($start_at)) }}
                                @else
                                    -
                                @endif --}}
                                </td>
                                <td class="text-black border text-[0.65rem] text-center">
                                    {{-- @if ($end_at)
                                    {{ date('d-m-Y', strtotime($end_at)) }}
                                @else
                                    -
                                @endif --}}
                                </td>
                                <td class="text-black text-[0.65rem] border">
                                    {{-- <div class="flex h-5 items-center relative">
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
                                                if (
                                                    strtotime($locationSale->start_at) >
                                                    strtotime(date($thisYear . '-01-01'))
                                                ) {
                                                    $start =
                                                        (strtotime($locationSale->start_at) -
                                                            strtotime(date($thisYear . '-01-01'))) /
                                                        60 /
                                                        60 /
                                                        24;
                                                } else {
                                                    $start = 0;
                                                }
                                                if (
                                                    strtotime($locationSale->end_at) >
                                                    strtotime(date($thisYear . '-12-31'))
                                                ) {
                                                    $lineWidth =
                                                        (strtotime(date($thisYear . '-12-31')) -
                                                            strtotime($locationSale->start_at)) /
                                                        60 /
                                                        60 /
                                                        24;
                                                } elseif (
                                                    strtotime($locationSale->start_at) >
                                                    strtotime(date($thisYear . '-01-01'))
                                                ) {
                                                    $lineWidth =
                                                        (strtotime($locationSale->end_at) -
                                                            strtotime($locationSale->start_at)) /
                                                        60 /
                                                        60 /
                                                        24;
                                                } else {
                                                    $lineWidth =
                                                        (strtotime($locationSale->end_at) -
                                                            strtotime($thisYear . '-01-01')) /
                                                        60 /
                                                        60 /
                                                        24;
                                                }
                                            @endphp
                                            <div class="absolute z-50">
                                                <div class="flex">
                                                    @for ($i = 0; $i < 365; $i++)
                                                        @if ($i < $start)
                                                            <div class="h-[2px] w-[1px]">
                                                            </div>
                                                        @elseif($i == $start + 4)
                                                            <a
                                                                href="/marketing/sales/{{ $locationSale->id }}">{{ $clients->name }}</a>
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
                                        @elseif (strtotime(date($locationSale->end_at)) > strtotime(date($thisYear . '-01-01')) &&
                                                strtotime(date($locationSale->end_at)) < date('Y-m-d'))
                                            @php
                                                if (
                                                    strtotime(date($locationSale->start_at)) >
                                                    strtotime(date($thisYear . '-01-01'))
                                                ) {
                                                    $start =
                                                        (strtotime($locationSale->start_at) -
                                                            strtotime(date($thisYear . '-01-01'))) /
                                                        60 /
                                                        60 /
                                                        24;
                                                    $lineWidth =
                                                        (strtotime(date($locationSale->end_at)) -
                                                            strtotime($locationSale->start_at)) /
                                                        60 /
                                                        60 /
                                                        24;
                                                } else {
                                                    $start = 0;
                                                    $lineWidth =
                                                        (strtotime(date($locationSale->end_at)) -
                                                            strtotime($locationSale->start_at)) /
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
                                                                <a
                                                                    href="/marketing/sales/{{ $locationSale->id }}">{{ $clients->name }}</a>
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
                                </div> --}}
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
                        @endif
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="flex justify-end mt-1 text-teal-900">
        <label for="">Halaman {{ $j + 1 }} dari {{ $pageQtyChart }}</label>
    </div>
</div>
