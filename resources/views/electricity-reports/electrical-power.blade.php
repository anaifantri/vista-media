@if ($i == $pageQty - 1)
    <div class="w-[1550px] h-[980px] bg-white p-8 mt-2">
        <div class="flex items-center border rounded-lg p-2 mt-6">
            <div class="w-44">
                <img class="ml-2 w-[125px]" src="{{ asset('storage/' . $company->logo) }}" alt="">
            </div>
            <div class="w-[750px] ml-6">
                <div>
                    <span class="text-sm font-semibold">{{ $company->name }}</span>
                </div>
                <div>
                    <span class="text-sm">{{ $company->address }}, Desa/Kel.
                        {{ $company->village }},
                        Kec.
                        {{ $company->district }}</span>
                </div>
                <div>
                    <span class="text-sm">{{ $company->city }} - {{ $company->province }}
                        {{ $company->post_code }}</span>
                </div>
                <div>
                    <span class="text-sm">Ph. {{ $company->phone }} | Mobile.
                        {{ $company->m_phone }}</span>
                </div>
                <div>
                    <span class="text-sm">e-mail : {{ $company->email }} | website :
                        {{ $company->website }}</span>
                </div>
            </div>
            <div class="flex w-full justify-end">
                <div>
                    <div class="flex items-end justify-center w-96">
                        <label class="text-5xl text-center font-bold">-</label>
                    </div>
                    <div class="flex justify-center w-96">
                        <label class="text-lg text-center font-bold">LIST DATA
                            {{ $reportTitle }} LISTRIK</label>
                    </div>
                    <div class="flex justify-center w-96">
                        <label class="text-sm text-center"></label>
                    </div>
                    <div class="flex justify-center w-96 border rounded-md">
                        @if (request('area') && request('area') != 'All')
                            @if (request('city') && request('city') != 'All')
                                <label class="month-report text-xl font-semibold text-center">
                                    Area {{ $getArea->area }} Kota
                                    {{ $getCity->city }}
                                </label>
                            @else
                                <label class="month-report text-xl font-semibold text-center">
                                    Area {{ $getArea->area }}
                                </label>
                            @endif
                        @else
                            <label class="month-report text-xl font-semibold text-center">
                                SELURUH AREA
                            </label>
                        @endif
                    </div>
                    <div class="flex justify-center w-96 border rounded-md mt-2">
                        <label class="text-md">
                            <span class="text-md font-semibold text-red-600">Tgl. Cetak :
                            </span>
                            {{ date('d') }} {{ $bulan[(int) date('m')] }}
                            {{ date('Y') }}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="h-[680px]">
            <table class="table-auto w-full mt-4">
                <thead>
                    <tr class="bg-stone-400">
                        <th class="text-stone-900 border border-stone-900 text-xs w-8 text-center" rowspan="2">No
                        </th>
                        <th class="text-stone-900 border border-stone-900 w-24 text-xs text-center" rowspan="2">
                            <button class="flex justify-center items-center w-24">@sortablelink('id_number', 'ID Pelanggan')
                                <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                </svg>
                            </button>
                        </th>
                        <th class="text-stone-900 border border-stone-900 text-xs text-center w-24" rowspan="2">Type
                        </th>
                        <th class="text-stone-900 border border-stone-900 text-xs text-center w-48" rowspan="2">Nama
                        </th>
                        <th class="text-stone-900 border border-stone-900 text-xs text-center w-16" rowspan="2">Daya
                        </th>
                        <th class="text-stone-900 border border-stone-900 text-xs text-center w-20" rowspan="2">Area
                        </th>
                        <th class="text-stone-900 border border-stone-900 text-xs text-center w-20" rowspan="2">Kota
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
                        @if ($loop->iteration > $i * 25 && $loop->iteration < ($i + 1) * 25 + 1)
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
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex items-end justify-end mt-1 text-black">
            <label for="">Halaman {{ $i + 1 }} dari
                {{ $pageQty }}</label>
        </div>
    </div>
@else
    <div class="w-[1550px] h-[980px] bg-white p-8 mt-2">
        <div class="flex items-center border rounded-lg p-2 mt-6">
            <div class="w-44">
                <img class="ml-2 w-[125px]" src="{{ asset('storage/' . $company->logo) }}" alt="">
            </div>
            <div class="w-[750px] ml-6">
                <div>
                    <span class="text-sm font-semibold">{{ $company->name }}</span>
                </div>
                <div>
                    <span class="text-sm">{{ $company->address }}, Desa/Kel.
                        {{ $company->village }},
                        Kec.
                        {{ $company->district }}</span>
                </div>
                <div>
                    <span class="text-sm">{{ $company->city }} - {{ $company->province }}
                        {{ $company->post_code }}</span>
                </div>
                <div>
                    <span class="text-sm">Ph. {{ $company->phone }} | Mobile.
                        {{ $company->m_phone }}</span>
                </div>
                <div>
                    <span class="text-sm">e-mail : {{ $company->email }} | website :
                        {{ $company->website }}</span>
                </div>
            </div>
            <div class="flex w-full justify-end">
                <div>
                    <div class="flex items-end justify-center w-96">
                        <label class="text-5xl text-center font-bold">-</label>
                    </div>
                    <div class="flex justify-center w-96">
                        <label class="text-lg text-center font-bold">LIST DATA
                            {{ $reportTitle }} LISTRIK</label>
                    </div>
                    <div class="flex justify-center w-96">
                        <label class="text-sm text-center"></label>
                    </div>
                    <div class="flex justify-center w-96 border rounded-md">
                        @if (request('area') && request('area') != 'All')
                            @if (request('city') && request('city') != 'All')
                                <label class="month-report text-xl font-semibold text-center">
                                    Area {{ $getArea->area }} Kota
                                    {{ $getCity->city }}
                                </label>
                            @else
                                <label class="month-report text-xl font-semibold text-center">
                                    Area {{ $getArea->area }}
                                </label>
                            @endif
                        @else
                            <label class="month-report text-xl font-semibold text-center">
                                SELURUH AREA
                            </label>
                        @endif
                    </div>
                    <div class="flex justify-center w-96 border rounded-md mt-2">
                        <label class="text-md">
                            <span class="text-md font-semibold text-red-600">Tgl. Cetak :
                            </span>
                            {{ date('d') }} {{ $bulan[(int) date('m')] }}
                            {{ date('Y') }}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="h-[680px]">
            <table class="table-auto w-full mt-4">
                <thead>
                    <tr class="bg-stone-400">
                        <th class="text-stone-900 border border-stone-900 text-xs w-8 text-center" rowspan="2">No
                        </th>
                        <th class="text-stone-900 border border-stone-900 w-24 text-xs text-center" rowspan="2">
                            <button class="flex justify-center items-center w-24">@sortablelink('id_number', 'ID Pelanggan')
                                <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
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
                        @if ($loop->iteration > $i * 25 && $loop->iteration < ($i + 1) * 25 + 1)
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
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex items-end justify-end mt-1 text-black">
            <label for="">Halaman {{ $i + 1 }} dari
                {{ $pageQty }}</label>
        </div>
    </div>
@endif
