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
                        {{ number_format($billing->nominal) }}
                    </td>
                    <td class="text-stone-900 px-1 border border-black text-sm text-right ">
                        {{ number_format($billing->ppn) }}
                    </td>
                    <td class="text-stone-900 px-1 border border-black text-sm text-right">
                        {{ number_format($billing->nominal + $billing->ppn) }}
                    </td>
                    <td class="text-stone-900 px-1 border border-black text-smtext-center">
                        <div class="w-full">
                            @if ($billing->bill_payments)
                                @foreach ($billing->bill_payments as $payment)
                                    <label class="flex justify-center w-full">
                                        {{ date('d', strtotime($payment->payment_date)) }}-{{ $bulan[(int) date('m', strtotime($payment->payment_date))] }}-{{ date('Y', strtotime($payment->payment_date)) }}</label>
                                @endforeach
                            @endif
                        </div>
                    </td>
                    <td class="text-stone-900 px-1 border border-black text-sm text-right">
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
            @endforeach
            <tr class="h-[25px] bg-white">
                <td class="text-stone-900 px-1 border border-black text-sm  text-right font-semibold" colspan="5">
                    Total Penagihan</td>
                <td class="text-stone-900 px-1 border border-black text-sm text-right font-semibold">
                    {{ number_format($billings->sum('nominal')) }}
                </td>
                <td class="text-stone-900 px-1 border border-black text-sm text-right font-semibold">
                    {{ number_format($billings->sum('ppn')) }}
                </td>
                <td class="text-stone-900 px-1 border border-black text-sm  text-right font-semibold">
                    {{ number_format($billings->sum('nominal') + $billings->sum('ppn')) }}
                </td>
                <td class="text-stone-900 px-1 border border-black text-sm  text-right font-semibold">
                </td>
                <td class="text-stone-900 px-1 border border-black text-sm  text-right font-semibold">
                    {{ number_format($totalPayment) }}
                </td>
            </tr>
        </tbody>
    </table>
</div>
