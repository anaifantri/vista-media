@php
    if (fmod(count($electricity_payments), 25) == 0) {
        $pageQty = count($electricity_payments) / 25;
    } else {
        $pageQty = (count($electricity_payments) - fmod(count($electricity_payments), 25)) / 25 + 1;
    }
@endphp

<div id="pdfPreview" hidden>
    @if (count($electricity_payments) == 0)
        <div class="w-[1550px] h-[980px] bg-white p-8">
            <div class="flex items-center border rounded-lg p-2 mt-6">
                <div class="w-44">
                    <img class="ml-2 w-[125px]" src="{{ asset('storage/' . $company->logo) }}" alt="">
                </div>
                <div class="w-[750px] ml-6">
                    <div>
                        <span class="text-sm font-semibold">{{ $company->name }}</span>
                    </div>
                    <div>
                        <span class="text-sm">{{ $company->address }}, Desa/Kel. {{ $company->village }},
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
                            <label class="text-lg text-center font-bold">LIST DATA PEMBAYARAN LISTRIK</label>
                        </div>
                        <div class="flex justify-center w-96">
                            <label class="text-sm text-center"></label>
                        </div>
                        <div class="flex justify-center w-96 border rounded-md">
                            @if (request('month'))
                                <label class="month-report text-xl font-semibold text-center">
                                    {{ $bulan_full[(int) request('month')] }} {{ request('year') }}
                                </label>
                            @else
                                <label class="month-report text-xl font-semibold text-center">
                                    {{ $bulan_full[(int) date('m')] }} {{ date('Y') }}
                                </label>
                            @endif
                        </div>
                        <div class="flex justify-center w-96 border rounded-md mt-2">
                            <label class="text-sm">
                                <span class="text-sm font-semibold text-red-600">Tgl. Cetak : </span>
                                {{ date('d') }} {{ $bulan[(int) date('m')] }}
                                {{ date('Y') }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center h-[875px] mt-2">
                @if (request('month'))
                    <label class="flex text-base text-red-600 font-serif tracking-wider">
                        ~~ Tidak ada data pembayaran listrik pada bulan
                        {{ $bulan_full[(int) request('month')] }} {{ request('year') }} ~~
                    </label>
                @else
                    <label class="flex text-base text-red-600 font-serif tracking-wider">
                        ~~ Tidak ada data pembayaran listrik
                        {{ $bulan[(int) date('m')] }}
                        {{ date('Y') }} ~~
                    </label>
                @endif
            </div>
        </div>
    @else
        @for ($indexPage = 0; $indexPage < $pageQty; $indexPage++)
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
                                <label class="text-lg text-center font-bold">LIST DATA PEMBAYARAN LISTRIK</label>
                            </div>
                            <div class="flex justify-center w-96">
                                <label class="text-sm text-center"></label>
                            </div>
                            <div class="flex justify-center w-96 border rounded-md">
                                @if (request('month'))
                                    <label class="month-report text-xl font-semibold text-center">
                                        {{ $bulan_full[(int) request('month')] }}
                                        {{ request('year') }}
                                    </label>
                                @else
                                    <label class="month-report text-xl font-semibold text-center">
                                        {{ $bulan_full[(int) date('m')] }} {{ date('Y') }}
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
                            <tr>
                                <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center"
                                    rowspan="2">No</th>
                                <th class="text-stone-900 border border-stone-900 w-36 text-sm text-center"
                                    rowspan="2">
                                    <button class="flex justify-center items-center w-36">@sortablelink('id_number', 'ID Pelanggan')
                                        <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24">
                                            <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                        </svg>
                                    </button>
                                </th>
                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-40"
                                    rowspan="2">Nama</th>
                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-14"
                                    rowspan="2">Daya</th>
                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-[72px]"
                                    rowspan="2">Area</th>
                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-[72px]"
                                    rowspan="2">Kota</th>
                                <th class="text-stone-900 border border-stone-900 text-sm text-center" rowspan="2">
                                    Lokasi</th>
                                <th class="text-stone-900 border border-stone-900 text-sm text-center" colspan="3">
                                    Data Pembayaran Tagihan Listrik
                                </th>
                            </tr>
                            <tr>
                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-28">
                                    Tagihan Bulan</th>
                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-28">
                                    Tgl. Bayar</th>
                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-32">
                                    Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($electricity_payments as $electrical)
                                @if ($loop->iteration > $indexPage * 25 && $loop->iteration < ($indexPage + 1) * 25 + 1)
                                    <tr>
                                        <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                            {{ $loop->iteration }}</td>
                                        <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                            {{ $electrical->electrical_power->id_number }}
                                        </td>
                                        <td class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
                                            {{ $electrical->electrical_power->name }}
                                        </td>
                                        <td class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
                                            {{ number_format($electrical->electrical_power->power) }}
                                        </td>
                                        <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                            {{ $electrical->electrical_power->area->area }}
                                        </td>
                                        <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                            {{ $electrical->electrical_power->city->city }}
                                        </td>
                                        <td class="text-stone-900 border border-stone-900 text-sm px-1">
                                            <div>
                                                @if (count($electrical->electrical_power->locations) > 0)
                                                    @foreach ($electrical->electrical_power->locations as $location)
                                                        <span class="flex">
                                                            {{ $location->code }} |
                                                            {{ $location->address }}
                                                        </span>
                                                    @endforeach
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                            {{ $bulan_full[(int) date('m', strtotime($electrical->bill_date))] }}
                                        </td>
                                        <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                            {{ date('d', strtotime($electrical->payment_date)) }}-{{ $bulan[(int) date('m', strtotime($electrical->payment_date))] }}-{{ date('Y', strtotime($electrical->payment_date)) }}
                                        </td>
                                        <td class="text-stone-900 border border-stone-900 text-sm text-right px-2">
                                            {{ number_format($electrical->payment) }}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            <tr>
                                <td class="text-stone-900 border border-stone-900 text-sm text-right font-semibold px-2"
                                    colspan="9">
                                    TOTAL</td>
                                <td
                                    class="text-stone-900 border border-stone-900 text-sm text-right font-semibold px-2">
                                    {{ number_format($electricity_payments->sum('payment')) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="flex items-end justify-end mt-1 text-black">
                    <label for="">Halaman {{ $indexPage + 1 }} dari
                        {{ $pageQty }}</label>
                </div>
            </div>
        @endfor
    @endif
</div>
