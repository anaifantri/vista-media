@php
    $bulan_full = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
    ];

    if (fmod(count($electrical_powers), 25) == 0) {
        $pageQty = count($electrical_powers) / 25;
    } else {
        $pageQty = (count($electrical_powers) - fmod(count($electrical_powers), 25)) / 25 + 1;
    }

@endphp
<div id="pdfPreview" hidden>
    @if (count($electrical_powers) == 0)
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
                            <label class="text-5xl text-center font-bold">A5</label>
                        </div>
                        <div class="flex justify-center w-96">
                            @if (request('type') && request('type') != 'All')
                                <label class="text-lg text-center font-bold">LIST DATA DAYA LISTRIK
                                    {{ strtoupper(request('type')) }}</label>
                            @else
                                <label class="text-lg text-center font-bold">LIST DATA DAYA LISTRIK</label>
                            @endif
                        </div>
                        <div class="flex justify-center w-96 border rounded-md">
                            @if (request('period'))
                                <label class="month-report text-xl font-semibold text-center">
                                    {{ request('period') }}
                                    @if (request('year'))
                                        {{ request('year') }}
                                    @else
                                        {{ date('Y') }}
                                    @endif
                                </label>
                            @else
                                <label class="month-report text-xl font-semibold text-center">
                                    JAN - JUN
                                    @if (request('year'))
                                        {{ request('year') }}
                                    @else
                                        {{ date('Y') }}
                                    @endif
                                </label>
                            @endif
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
                            <label class="text-sm">
                                <span class="text-sm font-semibold text-red-600">Tgl. Cetak : </span>
                                {{ date('d') }} {{ $bulan[(int) date('m')] }}
                                {{ date('Y') }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center h-[875px] mt-2">
                @if (request('area') && request('area') != 'All')
                    @if (request('city') && request('city') != 'All')
                        <label class="flex text-base text-red-600 font-serif tracking-wider">
                            ~~ Belum ada data daya listrik untuk area
                            {{ $getArea->area }} kota {{ $getCity->city }} ~~
                        </label>
                    @else
                        <label class="flex text-base text-red-600 font-serif tracking-wider">
                            ~~ Belum ada data daya listrik untuk area
                            {{ $getArea->area }} ~~
                        </label>
                    @endif
                @else
                    <label class="flex text-base text-red-600 font-serif tracking-wider">
                        ~~ Belum ada data daya listrik ~~
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
                                <label class="text-5xl text-center font-bold">A</label>
                                <label class="text-3xl text-center font-bold">5</label>
                            </div>
                            <div class="flex justify-center w-96">
                                @if (request('type') && request('type') != 'All')
                                    <label class="text-lg text-center font-bold">LIST DATA DAYA LISTRIK
                                        {{ strtoupper(request('type')) }}</label>
                                @else
                                    <label class="text-lg text-center font-bold">LIST DATA DAYA LISTRIK</label>
                                @endif
                            </div>
                            <div class="flex justify-center w-96">
                                <label class="text-sm text-center"></label>
                            </div>
                            <div class="flex justify-center w-96 border rounded-md">
                                @if (request('period'))
                                    <label class="month-report text-xl font-semibold text-center">
                                        {{ request('period') }}
                                        @if (request('year'))
                                            {{ request('year') }}
                                        @else
                                            {{ date('Y') }}
                                        @endif
                                    </label>
                                @else
                                    <label class="month-report text-xl font-semibold text-center">
                                        JAN - JUN
                                        @if (request('year'))
                                            {{ request('year') }}
                                        @else
                                            {{ date('Y') }}
                                        @endif
                                    </label>
                                @endif
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
                <div class="h-[680px] mt-4">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center"
                                    rowspan="2">No</th>
                                <th class="text-stone-900 border border-stone-900 w-28 text-sm text-center"
                                    rowspan="2">
                                    <button class="flex justify-center items-center w-28">@sortablelink('id_number', 'ID Pelanggan')
                                        <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24">
                                            <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                        </svg>
                                    </button>
                                </th>
                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-20"
                                    rowspan="2">Type</th>
                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-36"
                                    rowspan="2">Nama</th>
                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-14"
                                    rowspan="2">Daya</th>
                                <th class="text-stone-900 border border-stone-900 text-sm text-center" colspan="4">
                                    Data Lokasi</th>
                                <th class="text-stone-900 border border-stone-900 text-sm text-center"colspan="6">
                                    @if (request('type'))
                                        @if (request('type') == 'Pascabayar')
                                            Nominal Pembayaran Listrik
                                        @elseif (request('type') == 'Prabayar')
                                            Nominal Pengisian Pulsa Listrik
                                        @else
                                            Nominal
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
                                        {{ $electrical->id_number }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                        {{ $electrical->type }}</td>
                                    <td class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
                                        {{ $electrical->name }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
                                        {{ number_format($electrical->power) }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                        <div>
                                            @if (count($electrical->locations) > 0)
                                                @foreach ($electrical->locations as $location)
                                                    <span class="flex w-full justify-center">
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
                                        <div>
                                            @if (count($electrical->locations) > 0)
                                                @foreach ($electrical->locations as $location)
                                                    <span class="flex w-full justify-center">
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
                                        <div>
                                            @if (count($electrical->locations) > 0)
                                                @php
                                                    $description = json_decode($location->description);
                                                @endphp
                                                @foreach ($electrical->locations as $location)
                                                    <span class="flex w-full justify-center">
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
                                            <td
                                                class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
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
                                                                ->whereBetween('topup_date', [
                                                                    $startDate,
                                                                    $endDate->format('Y-m-d'),
                                                                ])
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
                                            <td
                                                class="text-stone-900 border border-stone-900 text-sm px-1 text-center">
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
                                                                ->whereBetween('topup_date', [
                                                                    $startDate,
                                                                    $endDate->format('Y-m-d'),
                                                                ])
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
                </div>
                <div class="flex items-end justify-end mt-1 text-black">
                    <label for="">Halaman {{ $indexPage + 1 }} dari
                        {{ $pageQty }}</label>
                </div>
            </div>
        @endfor
    @endif
</div>
