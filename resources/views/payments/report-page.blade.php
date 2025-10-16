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
                    <label class="text-5xl text-center font-bold">B</label>
                </div>
                <div class="flex justify-center w-56">
                    <label class="text-lg text-center font-bold">LAPORAN KAS MASUK</label>
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
                <tr class="bg-stone-200">
                    <th class="text-stone-900 border border-black text-sm w- text-center" rowspan="2">
                        No.</th>
                    <th class="text-stone-900 border border-black text-sm text-center w-24" rowspan="2">
                        Tgl. Bayar
                    </th>
                    <th class="text-stone-900 border border-black text-sm text-center w-44" rowspan="2">
                        Klien
                    </th>
                    <th class="text-stone-900 border border-black text-sm text-center w-56" rowspan="2">
                        Nomor Invoice
                    </th>
                    <th class="text-stone-900 border border-black text-sm text-center" colspan="3">
                        Pekerjaan
                    </th>
                    <th class="text-stone-900 border border-black text-sm text-center w-28" rowspan="2">
                        Kas Masuk
                    </th>
                    <th class="text-stone-900 border border-black text-sm text-center w-24" rowspan="2">
                        Sisa Tagihan
                    </th>
                </tr>
                <tr class="bg-stone-200">
                    <th class="text-stone-900 border border-black text-sm text-center">
                        Deskripsi
                    </th>
                    <th class="text-stone-900 border border-black text-sm text-center">
                        Lokasi
                    </th>
                    <th class="text-stone-900 border border-black text-sm text-center w-28">
                        Nilai
                    </th>
                </tr>
            </thead>
            <tbody class="border-b border-black">
                @php
                    $index = 0;
                    $number = 0;
                @endphp
                @foreach ($payments as $payment)
                    @php
                        $client = json_decode($payment->billings[0]->client);
                        $number++;
                        $totalSales = 0;
                        $totalBilling = 0;
                        $otherFee = 0;
                        $firstBilling = $payment->billings[0];
                        foreach ($firstBilling->bill_payments as $billPayment) {
                            if ($billPayment->other_fee) {
                                $otherFee = $otherFee + $billPayment->other_fee->nominal;
                            }
                        }
                        $totalPayment = $firstBilling->bill_payments->sum('nominal') + $otherFee;
                    @endphp
                    @foreach ($payment->billings as $itemBilling)
                        @php
                            $descriptions = json_decode($itemBilling->invoice_content)->description;
                            $descriptionNumber = 0;
                            $totalBilling =
                                $totalBilling +
                                ($itemBilling->nominal + $itemBilling->ppn - ($itemBilling->nominal * 2) / 100);
                        @endphp
                        @foreach ($descriptions as $description)
                            @php
                                $index++;
                                $descriptionNumber++;
                            @endphp
                            @if ($index > $i * 25 && $index < ($i + 1) * 25 + 1)
                                @if ($descriptionNumber == 1)
                                    <tr>
                                        <td
                                            class="text-stone-900 px-1 border-t border-x border-black text-sm align-top text-center">
                                            {{ $number }}
                                        </td>
                                        <td
                                            class="text-stone-900 px-1 border-t border-x border-black text-sm align-top text-center">
                                            {{ date('d', strtotime($payment->payment_date)) }}-{{ $bulan[(int) date('m', strtotime($payment->payment_date))] }}-{{ date('Y', strtotime($payment->payment_date)) }}
                                        </td>
                                        <td
                                            class="text-stone-900 border-t border-x border-black text-sm px-1 align-top">
                                            @if (isset($client->company))
                                                @if (strlen($client->company) > 20)
                                                    {{ substr($client->company, 0, 20) }}..
                                                @else
                                                    {{ $client->company }}
                                                @endif
                                            @elseif (isset($client->name))
                                                @if (strlen($client->name) > 20)
                                                    {{ substr($client->name, 0, 20) }}..
                                                @else
                                                    {{ $client->name }}
                                                @endif
                                            @else
                                                @if (strlen($client->contact_name) > 20)
                                                    {{ substr($client->contact_name, 0, 20) }}..
                                                @else
                                                    {{ $client->contact_name }}
                                                @endif
                                            @endif
                                        </td>
                                        <td
                                            class="text-stone-900 px-1 border-t border-x border-black text-sm align-top">
                                            <a
                                                href="/accounting/billings/{{ $itemBilling->id }}">{{ $itemBilling->invoice_number }}</a>
                                        </td>
                                        <td class="text-stone-900 px-1 border-t border-x border-black text-sm">
                                            @if (isset(json_decode($itemBilling->invoice_content)->manual_detail))
                                                @if (strlen(json_decode($itemBilling->invoice_content)->manual_detail[0]->title) > 40)
                                                    {{ substr(json_decode($itemBilling->invoice_content)->manual_detail[0]->title, 5, 40) }}
                                                @else
                                                    {{ json_decode($itemBilling->invoice_content)->manual_detail[0]->title }}
                                                @endif
                                            @else
                                                @if (strlen($description->title) > 40)
                                                    {{ substr($description->title, 5, 40) }}
                                                @else
                                                    {{ $description->title }}
                                                @endif
                                            @endif
                                        </td>
                                        <td class="text-stone-900 px-1 border-t border-x border-black text-sm">
                                            @if (strlen($description->location) > 40)
                                                {{ substr($description->location, 0, 40) }}..
                                            @else
                                                {{ $description->location }}
                                            @endif
                                        </td>
                                        <td
                                            class="text-stone-900 bg-teal-50 px-1 border-t border-x border-black text-sm text-right align-top">
                                            {{ number_format($description->nominal) }}
                                        </td>
                                        <td
                                            class="text-stone-900 px-1 bg-yellow-50 border-t border-x border-black text-sm align-top text-right">
                                            {{ number_format($payment->nominal) }}
                                        </td>
                                        <td
                                            class="text-stone-900 px-1 border-t border-x border-black text-sm bg-red-50 align-top text-right">
                                            @if (round($totalPayment) >= round($totalBilling))
                                                <span class="flex w-full justify-center">LUNAS</span>
                                            @else
                                                {{ number_format($totalBilling - $totalPayment) }}
                                            @endif
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td
                                            class="text-stone-900 px-1 border-x border-black text-sm align-top text-center">
                                        </td>
                                        <td
                                            class="text-stone-900 px-1 border-x border-black text-sm align-top text-center">
                                        </td>
                                        <td class="text-stone-900 border-x border-black text-sm px-1 align-top">
                                        </td>
                                        <td
                                            class="text-stone-900 px-1 border-x border-black text-sm text-center align-top">
                                        </td>
                                        <td class="text-stone-900 px-1 border-x border-black text-sm">
                                            @if (strlen($description->title) > 40)
                                                {{ substr($description->title, 5, 40) }}
                                            @else
                                                {{ $description->title }}
                                            @endif
                                        </td>
                                        <td class="text-stone-900 px-1 border-x border-black text-sm">
                                            @if (strlen($description->location) > 40)
                                                {{ substr($description->location, 0, 40) }}..
                                            @else
                                                {{ $description->location }}
                                            @endif
                                        </td>
                                        <td
                                            class="text-stone-900 bg-teal-50 px-1 border-x border-black text-sm text-right align-top">
                                            {{ number_format($description->nominal) }}
                                        </td>
                                        <td
                                            class="text-stone-900 px-1 bg-yellow-50 border-x border-black text-sm align-top text-right">
                                        </td>
                                        <td
                                            class="text-stone-900 px-1 border-x border-black text-sm bg-red-50 align-top text-right">
                                        </td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="flex items-end justify-end mt-1 text-black">
        <label for="">Halaman {{ $i + 1 }} dari
            {{ $pageQty }}</label>
    </div>
</div>
