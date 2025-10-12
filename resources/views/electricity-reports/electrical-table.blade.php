<thead>
    <tr class="bg-stone-400">
        <th class="text-stone-900 border border-stone-900 text-xs w-8 text-center" rowspan="2">No
        </th>
        <th class="text-stone-900 border border-stone-900 w-24 text-xs text-center" rowspan="2">
            <button class="flex justify-center items-center w-24">@sortablelink('id_number', 'ID Pelanggan')
                <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                </svg>
            </button>
        </th>
        <th class="text-stone-900 border border-stone-900 text-xs text-center w-24" rowspan="2">
            Type
        </th>
        <th class="text-stone-900 border border-stone-900 text-xs text-center w-48" rowspan="2">
            Nama
        </th>
        <th class="text-stone-900 border border-stone-900 text-xs text-center w-16" rowspan="2">
            Daya
        </th>
        <th class="text-stone-900 border border-stone-900 text-xs text-center w-20" rowspan="2">
            Area
        </th>
        <th class="text-stone-900 border border-stone-900 text-xs text-center w-20" rowspan="2">
            Kota
        </th>
        <th class="text-stone-900 border border-stone-900 text-xs text-center" rowspan="2">Lokasi
        </th>
        <th class="text-stone-900 border border-stone-900 text-xs text-center" colspan="2">Data
            Pembayaran / Pengisian Pulsa Terakhir</th>
    </tr>
    <tr class="bg-stone-400">
        <th class="text-stone-900 border border-stone-900 text-xs text-center w-24">Tanggal</th>
        <th class="text-stone-900 border border-stone-900 text-xs text-center w-24">Nominal</th>
    </tr>
</thead>
<tbody>
    @foreach ($electricals as $electrical)
        <tr>
            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                {{ $loop->iteration }}</td>
            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                {{ $electrical->id_number }}
            </td>
            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                {{ $electrical->type }}</td>
            <td class="text-stone-900 border border-stone-900 text-xs px-1 text-center">
                {{ $electrical->name }}
            </td>
            <td class="text-stone-900 border border-stone-900 text-xs px-1 text-center">
                {{ $electrical->power }}
            </td>
            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                {{ $electrical->area->area }}
            </td>
            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                {{ $electrical->city->city }}
            </td>
            <td class="text-stone-900 border border-stone-900 text-xs px-1">
                <div>
                    @if (count($electrical->locations) > 0)
                        @foreach ($electrical->locations as $location)
                            <span class="flex">
                                {{ $location->code }} | {{ $location->address }}
                            </span>
                        @endforeach
                    @else
                        -
                    @endif
                </div>
            </td>
            <td class="text-stone-900 border border-stone-900 text-xs text-center">
                @if ($electrical->type == 'Pascabayar')
                    @php
                        $payment = $electrical->electricity_payments->last();
                    @endphp
                    {{ date('d', strtotime($payment->payment_date)) }}-{{ $bulan[(int) date('m', strtotime($payment->payment_date))] }}-{{ date('Y', strtotime($payment->payment_date)) }}
                @else
                    @php
                        $payment = $electrical->electricity_top_ups->last();
                    @endphp
                    {{ date('d', strtotime($payment->topup_date)) }}-{{ $bulan[(int) date('m', strtotime($payment->topup_date))] }}-{{ date('Y', strtotime($payment->topup_date)) }}
                @endif
            </td>
            <td class="text-stone-900 border border-stone-900 text-xs text-right px-2">
                @if ($electrical->type == 'Pascabayar')
                    @php
                        $payment = $electrical->electricity_payments->last();
                    @endphp
                    {{ $payment->payment }}
                @else
                    @php
                        $payment = $electrical->electricity_top_ups->last();
                    @endphp
                    {{ number_format($payment->top_up_nominal) }}
                @endif
            </td>
        </tr>
    @endforeach
</tbody>
