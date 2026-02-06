<div id="pdfPreview">
    @if (count($billings) == 0)
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
                        <div class="flex justify-center w-56">
                            <label class="text-5xl text-center font-bold">-</label>
                        </div>
                        <div class="flex justify-center w-56">
                            <label class="text-lg text-center font-bold">LIST INVOICE</label>
                        </div>
                        <div class="flex justify-center w-56">
                            <label class="text-sm text-center"></label>
                        </div>
                        <div class="flex justify-center w-56 border rounded-md">
                            @if (request('month'))
                                <label class="month-report text-xl font-semibold text-center">
                                    {{ $bulan_full[request('month')] }}
                                    {{ request('year') }}
                                </label>
                            @else
                                <label
                                    class="month-report text-xl font-semibold text-center">{{ $bulan_full[(int) date('m')] }}
                                    {{ date('Y') }}</label>
                            @endif
                        </div>
                        <div class="flex justify-center w-56 border rounded-md mt-2">
                            <label class="text-sm">
                                <span class="text-sm font-semibold text-red-600">Tgl. Cetak :
                                </span>
                                {{ date('d') }} {{ $bulan[(int) date('m')] }}
                                {{ date('Y') }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center h-[875px] mt-2">
                @if (request('month'))
                    <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak ada data
                        invoice
                        pada bulan
                        {{ $bulan_full[request('month')] }}
                        {{ request('year') }} ~~
                    </label>
                @else
                    <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak ada data
                        invoice
                        pada bulan
                        {{ $bulan_full[(int) date('m')] }}
                        {{ date('Y') }} ~~
                    </label>
                @endif
            </div>
        </div>
    @else
        @for ($i = 0; $i < $pageQty; $i++)
            @php
                $number = 1;
            @endphp
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
                                <div class="flex justify-center w-56">
                                    <label class="text-5xl text-center font-bold">-</label>
                                </div>
                                <div class="flex justify-center w-56">
                                    <label class="text-lg text-center font-bold">LIST INVOICE</label>
                                </div>
                                <div class="flex justify-center w-56">
                                    <label class="text-sm text-center"></label>
                                </div>
                                <div class="flex justify-center w-56 border rounded-md">
                                    @if (request('month'))
                                        <label class="month-report text-xl font-semibold text-center">
                                            {{ $bulan_full[request('month')] }}
                                            {{ request('year') }}
                                        </label>
                                    @else
                                        <label
                                            class="month-report text-xl font-semibold text-center">{{ $bulan_full[(int) date('m')] }}
                                            {{ date('Y') }}</label>
                                    @endif
                                </div>
                                <div class="flex justify-center w-56 border rounded-md mt-2">
                                    <label class="text-sm">
                                        <span class="text-sm font-semibold text-red-600">Tgl. Cetak :
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
                                <tr class="bg-stone-200 h-8">
                                    <th class="text-stone-900 border border-black text-sm w- text-center w-8"
                                        rowspan="2">
                                        No.</th>
                                    <th class="text-stone-900 border border-black text-sm text-center w-16"
                                        rowspan="2">
                                        Jenis
                                    </th>
                                    <th class="text-stone-900 border border-black text-sm text-center w-56"
                                        rowspan="2">
                                        No. Invoice
                                    </th>
                                    <th class="text-stone-900 border border-black text-sm text-center w-24"
                                        rowspan="2">
                                        Tanggal
                                    </th>
                                    <th class="text-stone-900 border border-black text-sm text-center" rowspan="2">
                                        Klien
                                    </th>
                                    <th class="text-stone-900 border border-black text-sm text-center" colspan="3">
                                        Detail Invoice
                                    </th>
                                    <th class="text-stone-900 border border-black text-sm text-center" colspan="2">
                                        Detail Pembayaran
                                    </th>
                                </tr>
                                <tr class="bg-stone-200 h-8">
                                    <th class="text-stone-900 border border-black text-sm text-center w-28">
                                        Nominal
                                    </th>
                                    <th class="text-stone-900 border border-black text-sm text-center w-24">
                                        PPN
                                    </th>
                                    <th class="text-stone-900 border border-black text-sm text-center w-28">
                                        Total
                                    </th>
                                    <th class="text-stone-900 border border-black text-sm text-center w-28">
                                        Tgl. Bayar
                                    </th>
                                    <th class="text-stone-900 border border-black text-sm text-center w-24">
                                        Nominal
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($billings as $billing)
                                    @php
                                        $client = json_decode($billing->client);
                                    @endphp
                                    @if ($number > $i * 25 && $number <= ($i + 1) * 25)
                                        <tr class="h-[25px]">
                                            <td class="text-stone-900 px-1 border border-black text-sm  text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="text-stone-900 px-1 border border-black text-sm  text-center">
                                                @if ($billing->category == 'Service')
                                                    Revisual
                                                @else
                                                    Media
                                                @endif
                                            </td>
                                            <td class="text-stone-900 px-1 border border-black text-sm text-center">
                                                <a href="/accounting/billings/{{ $billing->id }}">
                                                    {{ $billing->invoice_number }}
                                                </a>
                                            </td>
                                            <td class="text-stone-900 px-1 border border-black text-sm  text-center">
                                                {{ date('d', strtotime($billing->created_at)) }}-{{ $bulan[(int) date('m', strtotime($billing->created_at))] }}-{{ date('Y', strtotime($billing->created_at)) }}
                                            </td>
                                            <td class="text-stone-900 border border-black text-sm px-1 ">
                                                @if (isset($client->company))
                                                    {{ $client->company }}
                                                @elseif (isset($client->name))
                                                    {{ $client->name }}
                                                @else
                                                    {{ $client->contact_name }}
                                                @endif
                                            </td>
                                            <td class="text-stone-900 px-1 border border-black text-sm text-right">
                                                {{ number_format($billing->nominal) }}
                                            </td>
                                            <td
                                                class="text-stone-900 bg-teal-50 px-1 border border-black text-sm text-right ">
                                                {{ number_format($billing->ppn) }}
                                            </td>
                                            <td
                                                class="text-stone-900 px-1 border border-black text-sm bg-red-50  text-right">
                                                {{ number_format($billing->nominal + $billing->ppn) }}
                                            </td>
                                            <td
                                                class="text-stone-900 px-1 border border-black text-sm bg-red-50 text-center">
                                                <div class="w-full">
                                                    @if ($billing->bill_payments)
                                                        @foreach ($billing->bill_payments as $payment)
                                                            <label class="flex justify-center w-full">
                                                                {{ date('d', strtotime($payment->payment_date)) }}-{{ $bulan[(int) date('m', strtotime($payment->payment_date))] }}-{{ date('Y', strtotime($payment->payment_date)) }}</label>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </td>
                                            <td
                                                class="text-stone-900 px-1 border border-black text-sm bg-red-50  text-right">
                                                <div class="w-full">
                                                    @foreach ($billing->bill_payments as $payment)
                                                        <label
                                                            class="flex justify-end px-1 w-full">{{ number_format($payment->nominal) }}</label>
                                                        @php
                                                            $totalPayment = $totalPayment + $payment->nominal;
                                                        @endphp
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    @php
                                        if (count($billing->bill_payments) > 0) {
                                            $number = $number + (count($billing->bill_payments) - 1);
                                        }
                                        $number++;
                                    @endphp
                                @endforeach
                                <tr class="h-[25px]">
                                    <td class="text-stone-900 px-1 border border-black text-sm bg-red-50  text-right font-semibold"
                                        colspan="5">Total Penagihan</td>
                                    <td
                                        class="text-stone-900 px-1 border border-black text-sm text-right font-semibold">
                                        {{ number_format($billings->sum('nominal')) }}
                                    </td>
                                    <td
                                        class="text-stone-900 px-1 border border-black text-sm bg-teal-50 text-right font-semibold">
                                        {{ number_format($billings->sum('ppn')) }}
                                    </td>
                                    <td
                                        class="text-stone-900 px-1 border border-black text-sm  text-right bg-red-50 font-semibold">
                                        {{ number_format($billings->sum('nominal') + $billings->sum('ppn')) }}
                                    </td>
                                    <td
                                        class="text-stone-900 px-1 border border-black text-sm  text-right bg-red-50 font-semibold">
                                    </td>
                                    <td
                                        class="text-stone-900 px-1 border border-black text-sm  text-right bg-red-50 font-semibold">
                                        {{ number_format($totalPayment) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex items-end justify-end mt-4 text-black">
                        <label for="">Halaman {{ $i + 1 }} dari
                            {{ $pageQty }}</label>
                    </div>
                </div>
            @else
                <div class="w-[1550px] h-[980px] bg-white p-8 mt-2">
                    <div class="flex items-center border rounded-lg p-2 mt-6">
                        <div class="w-44">
                            <img class="ml-2 w-[125px]" src="{{ asset('storage/' . $company->logo) }}"
                                alt="">
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
                                <div class="flex justify-center w-56">
                                    <label class="text-5xl text-center font-bold">-</label>
                                </div>
                                <div class="flex justify-center w-56">
                                    <label class="text-lg text-center font-bold">LIST INVOICE</label>
                                </div>
                                <div class="flex justify-center w-56">
                                    <label class="text-sm text-center"></label>
                                </div>
                                <div class="flex justify-center w-56 border rounded-md">
                                    @if (request('month'))
                                        <label class="month-report text-xl font-semibold text-center">
                                            {{ $bulan_full[request('month')] }}
                                            {{ request('year') }}
                                        </label>
                                    @else
                                        <label
                                            class="month-report text-xl font-semibold text-center">{{ $bulan_full[(int) date('m')] }}
                                            {{ date('Y') }}</label>
                                    @endif
                                </div>
                                <div class="flex justify-center w-56 border rounded-md mt-2">
                                    <label class="text-sm">
                                        <span class="text-sm font-semibold text-red-600">Tgl. Cetak :
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
                                <tr class="bg-stone-200 h-8">
                                    <th class="text-stone-900 border border-black text-sm w- text-center w-8"
                                        rowspan="2">
                                        No.</th>
                                    <th class="text-stone-900 border border-black text-sm text-center w-16"
                                        rowspan="2">
                                        Jenis
                                    </th>
                                    <th class="text-stone-900 border border-black text-sm text-center w-56"
                                        rowspan="2">
                                        No. Invoice
                                    </th>
                                    <th class="text-stone-900 border border-black text-sm text-center w-24"
                                        rowspan="2">
                                        Tanggal
                                    </th>
                                    <th class="text-stone-900 border border-black text-sm text-center" rowspan="2">
                                        Klien
                                    </th>
                                    <th class="text-stone-900 border border-black text-sm text-center" colspan="3">
                                        Detail Invoice
                                    </th>
                                    <th class="text-stone-900 border border-black text-sm text-center" colspan="2">
                                        Detail Pembayaran
                                    </th>
                                </tr>
                                <tr class="bg-stone-200 h-8">
                                    <th class="text-stone-900 border border-black text-sm text-center w-28">
                                        Nominal
                                    </th>
                                    <th class="text-stone-900 border border-black text-sm text-center w-24">
                                        PPN
                                    </th>
                                    <th class="text-stone-900 border border-black text-sm text-center w-28">
                                        Total
                                    </th>
                                    <th class="text-stone-900 border border-black text-sm text-center w-28">
                                        Tgl. Bayar
                                    </th>
                                    <th class="text-stone-900 border border-black text-sm text-center w-24">
                                        Nominal
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($billings as $billing)
                                    @php
                                        $client = json_decode($billing->client);
                                    @endphp
                                    @if ($number > $i * 25 && $number <= ($i + 1) * 25)
                                        <tr class="h-[25px]">
                                            <td class="text-stone-900 px-1 border border-black text-sm  text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="text-stone-900 px-1 border border-black text-sm  text-center">
                                                @if ($billing->category == 'Service')
                                                    Revisual
                                                @else
                                                    Media
                                                @endif
                                            </td>
                                            <td class="text-stone-900 px-1 border border-black text-sm text-center">
                                                <a href="/accounting/billings/{{ $billing->id }}">
                                                    {{ $billing->invoice_number }}
                                                </a>
                                            </td>
                                            <td class="text-stone-900 px-1 border border-black text-sm  text-center">
                                                {{ date('d', strtotime($billing->created_at)) }}-{{ $bulan[(int) date('m', strtotime($billing->created_at))] }}-{{ date('Y', strtotime($billing->created_at)) }}
                                            </td>
                                            <td class="text-stone-900 border border-black text-sm px-1 ">
                                                @if (isset($client->company))
                                                    {{ $client->company }}
                                                @elseif (isset($client->name))
                                                    {{ $client->name }}
                                                @else
                                                    {{ $client->contact_name }}
                                                @endif
                                            </td>
                                            <td class="text-stone-900 px-1 border border-black text-sm text-right">
                                                {{ number_format($billing->nominal) }}
                                            </td>
                                            <td
                                                class="text-stone-900 bg-teal-50 px-1 border border-black text-sm text-right ">
                                                {{ number_format($billing->ppn) }}
                                            </td>
                                            <td
                                                class="text-stone-900 px-1 border border-black text-sm bg-red-50  text-right">
                                                {{ number_format($billing->nominal + $billing->ppn) }}
                                            </td>
                                            <td class="text-stone-900 px-1 border border-black text-sm bg-red-50">
                                                <div class="w-full">
                                                    @if ($billing->bill_payments)
                                                        @foreach ($billing->bill_payments as $payment)
                                                            <label class="flex justify-center">
                                                                {{ date('d', strtotime($payment->payment_date)) }}-{{ $bulan[(int) date('m', strtotime($payment->payment_date))] }}-{{ date('Y', strtotime($payment->payment_date)) }}
                                                            </label>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </td>
                                            <td
                                                class="text-stone-900 px-1 border border-black text-sm bg-red-50  text-right">
                                                <div class="w-full">
                                                    @foreach ($billing->bill_payments as $payment)
                                                        <label
                                                            class="flex justify-end w-full px-1">{{ number_format($payment->nominal) }}</label>
                                                        @php
                                                            $totalPayment = $totalPayment + $payment->nominal;
                                                        @endphp
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    @php
                                        if (count($billing->bill_payments) > 1) {
                                            $number = $number + (count($billing->bill_payments) - 1);
                                        }
                                        $number++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end mt-4 text-black">
                        <label for="">Halaman {{ $i + 1 }} dari
                            {{ $pageQty }}</label>
                    </div>
                </div>
            @endif
        @endfor
    @endif
</div>
