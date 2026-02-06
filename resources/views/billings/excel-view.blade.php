<div id="exportExcelTable" hidden>
    <table class="table-auto w-full mt-4">
        <thead>
            <tr class="bg-stone-200 h-8">
                <th class="text-stone-900 border border-black text-sm w- text-center w-8" rowspan="2">
                    No.</th>
                <th class="text-stone-900 border border-black text-sm text-center w-16" rowspan="2">
                    Jenis
                </th>
                <th class="text-stone-900 border border-black text-sm text-center w-56" rowspan="2">
                    No. Invoice
                </th>
                <th class="text-stone-900 border border-black text-sm text-center w-24" rowspan="2">
                    Tanggal
                </th>
                <th class="text-stone-900 border border-black text-sm text-center" rowspan="2">
                    Klien
                </th>
                <th class="text-stone-900 border border-black text-sm text-center" colspan="3">
                    Detail Invoice
                </th>
                <th class="text-stone-900 border border-black text-sm text-center" colspan="4">
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
                <th class="text-stone-900 border border-black text-sm text-center w-24">
                    Pot. Pph
                </th>
                <th class="text-stone-900 border border-black text-sm text-center w-24">
                    Pot. Lainnya
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($billings as $billing)
                @php
                    $client = json_decode($billing->client);
                @endphp
                <tr class="h-[25px] bg-white">
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
                        {{ $billing->nominal }}
                    </td>
                    <td class="text-stone-900 px-1 border border-black text-sm text-right ">
                        {{ $billing->ppn }}
                    </td>
                    <td class="text-stone-900 px-1 border border-black text-sm text-right">
                        {{ $billing->nominal + $billing->ppn }}
                    </td>
                    <td class="text-stone-900 px-1 border border-black text-smtext-center">
                        <div class="w-full">
                            @if ($billing->bill_payments)
                                @foreach ($billing->bill_payments as $payment)
                                    <div class="flex justify-center w-full">
                                        {{ date('d', strtotime($payment->payment_date)) }}-{{ $bulan[(int) date('m', strtotime($payment->payment_date))] }}-{{ date('Y', strtotime($payment->payment_date)) }}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </td>
                    <td class="text-stone-900 px-1 border border-black text-sm text-right">
                        <div class="w-full">
                            @foreach ($billing->bill_payments as $payment)
                                <div class="flex justify-end px-1 w-full">{{ $payment->nominal }}</div>
                                @php
                                    $totalPayment = $totalPayment + $payment->nominal;
                                @endphp
                            @endforeach
                        </div>
                    </td>
                    <td class="text-stone-900 px-1 border border-black text-sm bg-teal-50  text-right">
                        <div class="w-full">
                            @foreach ($billing->bill_payments as $payment)
                                @php
                                    $totalPph = $totalPph + $payment->income_taxes->sum('nominal');
                                @endphp
                                <div class="flex justify-end px-1 w-full">
                                    {{ number_format($payment->income_taxes->sum('nominal')) }}
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td class="text-stone-900 px-1 border border-black text-sm bg-red-50  text-right">
                        @foreach ($billing->bill_payments as $payment)
                            @php
                                if ($payment->other_fee) {
                                    $totalOtherFee = $totalOtherFee + $payment->other_fee->nominal;
                                }
                            @endphp
                            <div class="flex justify-end px-1 w-full">
                                @if ($payment->other_fee)
                                    {{ number_format($payment->other_fee->nominal) }}
                                @else
                                    -
                                @endif
                            </div>
                        @endforeach
                    </td>
                </tr>
            @endforeach
            <tr class="h-[25px] bg-white">
                <td class="text-stone-900 px-1 border border-black text-sm  text-right font-semibold" colspan="5">
                    Total Penagihan</td>
                <td class="text-stone-900 px-1 border border-black text-sm text-right font-semibold">
                    {{ $billings->sum('nominal') }}
                </td>
                <td class="text-stone-900 px-1 border border-black text-sm text-right font-semibold">
                    {{ $billings->sum('ppn') }}
                </td>
                <td class="text-stone-900 px-1 border border-black text-sm  text-right font-semibold">
                    {{ $billings->sum('nominal') + $billings->sum('ppn') }}
                </td>
                <td class="text-stone-900 px-1 border border-black text-sm  text-right font-semibold">
                </td>
                <td class="text-stone-900 px-1 border border-black text-sm  text-right font-semibold">
                    {{ $totalPayment }}
                </td>
                <td class="text-stone-900 px-1 border border-black text-sm  text-right font-semibold">
                    {{ $totalPph }}
                </td>
                <td class="text-stone-900 px-1 border border-black text-sm  text-right font-semibold">
                    {{ $totalOtherFee }}
                </td>
            </tr>
        </tbody>
    </table>
</div>
