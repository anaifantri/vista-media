<table id="exportExcelTable" hidden>
    <thead>
        <tr>
            <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center" rowspan="2">No</th>
            <th class="text-stone-900 border border-stone-900 w-28 text-sm text-center" rowspan="2">
                <button class="flex justify-center items-center w-28">@sortablelink('id_number', 'ID Pelanggan')
                    <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                    </svg>
                </button>
            </th>
            <th class="text-stone-900 border border-stone-900 text-sm text-center w-20" rowspan="2">Type</th>
            <th class="text-stone-900 border border-stone-900 text-sm text-center w-36" rowspan="2">Nama</th>
            <th class="text-stone-900 border border-stone-900 text-sm text-center w-14" rowspan="2">Daya</th>
            <th class="text-stone-900 border border-stone-900 text-sm text-center" colspan="4">Data Lokasi</th>
            <th class="text-stone-900 border border-stone-900 text-sm text-center"colspan="6">
                @if (request('type'))
                    @if (request('type') == 'Pascabayar')
                        Nominal Pembayaran Listrik
                    @else
                        Nominal Pengisian Pulsa Listrik
                    @endif
                @else
                    Nominal
                @endif
            </th>
        </tr>
        <tr>
            <th class="text-stone-900 border border-stone-900 text-sm text-center w-20">Kode
            </th>
            <th class="text-stone-900 border border-stone-900 text-sm text-center">Lokasi
            </th>
            <th class="text-stone-900 border border-stone-900 text-sm text-center w-[100px]">
                Ukuran</th>
            <th class="text-stone-900 border border-stone-900 text-sm text-center w-12">
                BL/FL</th>
            @if (request('period') && request('period') == 'Juli - Desember')
                @for ($i = 6; $i < 12; $i++)
                    <th class="text-stone-900 border border-stone-900 text-sm text-center w-[72px]">
                        {{ $bulan[$i + 1] }}
                    </th>
                @endfor
            @else
                @for ($i = 0; $i < 6; $i++)
                    <th class="text-stone-900 border border-stone-900 text-sm text-center w-[72px]">
                        {{ $bulan[$i + 1] }}
                    </th>
                @endfor
            @endif
        </tr>
    </thead>
    <tbody>
        @php
            $number = 1 + ($electrical_powers->currentPage() - 1) * $electrical_powers->perPage();
        @endphp
        @foreach ($electrical_powers as $electrical)
            <tr>
                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                    {{ $number++ }}</td>
                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                    '{{ $electrical->id_number }}
                </td>
                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                    {{ $electrical->type }}</td>
                <td class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
                    {{ $electrical->name }}
                </td>
                <td class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
                    {{ $electrical->power }}
                </td>
                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                    <div class="flex justify-center">
                        @if (count($electrical->locations) > 0)
                            @foreach ($electrical->locations as $location)
                                <span class="flex">
                                    {{ $location->code }} - {{ $location->city->code }}
                                </span>
                            @endforeach
                        @else
                            -
                        @endif
                    </div>
                </td>
                <td class="text-stone-900 border border-stone-900 text-sm text-center px-1">
                    <div>
                        @if (count($electrical->locations) > 0)
                            @foreach ($electrical->locations as $location)
                                <span class="flex">
                                    {{ $location->address }}
                                </span>
                            @endforeach
                        @else
                            -
                        @endif
                    </div>
                </td>
                <td class="text-stone-900 border border-stone-900 text-sm text-center">
                    <div class="flex justify-center">
                        @if (count($electrical->locations) > 0)
                            @foreach ($electrical->locations as $location)
                                <span class="flex">
                                    {{ $location->media_size->size }} -
                                    @if ($location->orientation == 'Vertikal')
                                        V
                                    @else
                                        H
                                    @endif
                                </span>
                            @endforeach
                        @else
                            -
                        @endif
                    </div>
                </td>
                <td class="text-stone-900 border border-stone-900 text-sm text-center px-1">
                    <div class="flex justify-center">
                        @if (count($electrical->locations) > 0)
                            @php
                                $description = json_decode($location->description);
                            @endphp
                            @foreach ($electrical->locations as $location)
                                <span class="flex">
                                    @if (isset($description->lighting))
                                        @if ($description->lighting == 'Backlight')
                                            BL
                                        @elseif ($description->lighting == 'Frontlight')
                                            FL
                                        @else
                                            t
                                        @endif
                                    @else
                                        -
                                    @endif
                                </span>
                            @endforeach
                        @else
                            -
                        @endif
                    </div>
                </td>
                @if (request('period') && request('period') == 'Juli - Desember')
                    @for ($i = 6; $i < 12; $i++)
                        <td class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
                            @if ($electrical->type == 'Pascabayar')
                                @php
                                    if (count($electrical->electricity_payments) > 0) {
                                        $getNominal = $electrical->electricity_payments
                                            ->where('bill_date', $getYear . '-0' . $i + 1 . '-01')
                                            ->sum('payment');
                                    } else {
                                        $getNominal = 0;
                                    }
                                @endphp
                                @if ($getNominal != 0)
                                    {{ number_format($getNominal) }}
                                @else
                                    -
                                @endif
                            @else
                                @php
                                    $startDate = $getYear . '-0' . $i + 1 . '-01';
                                    $getDate = new DateTime($startDate);
                                    $endDate = $getDate->modify('last day of this month');
                                    if (count($electrical->electricity_top_ups) > 0) {
                                        $getNominal = $electrical->electricity_top_ups
                                            ->whereBetween('topup_date', [$startDate, $endDate->format('Y-m-d')])
                                            ->sum('top_up_nominal');
                                    } else {
                                        $getNominal = 0;
                                    }
                                @endphp
                                @if ($getNominal != 0)
                                    {{ number_format($getNominal) }}
                                @else
                                    -
                                @endif
                            @endif
                        </td>
                    @endfor
                @else
                    @for ($i = 0; $i < 6; $i++)
                        <td class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
                            @if ($electrical->type == 'Pascabayar')
                                @php
                                    if (count($electrical->electricity_payments) > 0) {
                                        $getNominal = $electrical->electricity_payments
                                            ->where('bill_date', $getYear . '-0' . $i + 1 . '-01')
                                            ->sum('payment');
                                    } else {
                                        $getNominal = 0;
                                    }
                                @endphp
                                @if ($getNominal != 0)
                                    {{ number_format($getNominal) }}
                                @else
                                    -
                                @endif
                            @else
                                @php
                                    $startDate = $getYear . '-0' . $i + 1 . '-01';
                                    $getDate = new DateTime($startDate);
                                    $endDate = $getDate->modify('last day of this month');
                                    if (count($electrical->electricity_top_ups) > 0) {
                                        $getNominal = $electrical->electricity_top_ups
                                            ->whereBetween('topup_date', [$startDate, $endDate->format('Y-m-d')])
                                            ->sum('top_up_nominal');
                                    } else {
                                        $getNominal = 0;
                                    }
                                @endphp
                                @if ($getNominal != 0)
                                    {{ number_format($getNominal) }}
                                @else
                                    -
                                @endif
                            @endif
                        </td>
                    @endfor
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
