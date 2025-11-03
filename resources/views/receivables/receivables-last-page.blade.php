<div class="w-[1580px] h-[1000px] px-10 py-2 mt-2 bg-white z-0">
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
                <div class="flex justify-center w-96">
                    <label class="text-lg text-center">LIST PIUTANG</label>
                </div>
                <div class="flex justify-center w-96">
                    @if (request('client') && request('client') != 'All')
                        <label class="text-2xl text-center">
                            @if (strlen(request('client')) > 30)
                                {{ substr(request('client'), 0, 30) }}..
                            @else
                                {{ request('client') }}
                            @endif
                        </label>
                    @else
                        <label class="text-3xl text-center">SELURUH KLIEN</label>
                    @endif
                </div>
                <div class="flex mt-4 justify-center w-96 border rounded-md">
                    @if (request('fromData'))
                        <label class="text-md font-semibold text-center">BERDASARKAN DATA
                            {{ request('fromData') }}</label>
                    @else
                        <label class="text-md font-semibold text-center">BERDASARKAN DATA
                            INVOICE</label>
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
    <div class="h-[740px] mt-2">
        <table class="table-auto w-full">
            <thead>
                <tr class="bg-teal-100 h-10">
                    <th class="sticky top-0 border border-black text-sm w-8">
                        No.
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-64">
                        Klien
                    </th>
                    <th class="sticky top-0 border border-black text-sm text-center">
                        Lokasi
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-[72px]">
                        Deskripsi
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-52">
                        No. Invoice
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-24">
                        Tgl. Invoice
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-24">
                        Nominal
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-24">
                        Pembayaran
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-24">
                        Piutang
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $number = 0;
                    $index = 0;
                @endphp
                @foreach ($receivables as $receivable)
                    @php
                        $number++;
                        $descriptionNumber = 0;
                        $client = json_decode($receivable->client);
                        $descriptions = json_decode($receivable->invoice_content)->description;
                        $payment = $data_payments[$loop->iteration - 1];
                    @endphp
                    @foreach ($descriptions as $description)
                        @php
                            $index++;
                            $descriptionNumber++;
                        @endphp
                        @if ($index > $i * 30 && $index < ($i + 1) * 30 + 1)
                            @if ($descriptionNumber == 1)
                                <tr>
                                    <td class="border-t border-x border-black text-sm text-center align-center px-1">
                                        {{ $number }}
                                    </td>
                                    <td class="border-t border-x border-black text-sm text-start align-center px-1">
                                        @if (isset($client->company))
                                            @if (strlen($client->company) > 32)
                                                {{ substr($client->company, 0, 30) }}..
                                            @else
                                                {{ $client->company }}
                                            @endif
                                        @else
                                            {{ $client->name }}
                                        @endif
                                    </td>
                                    <td class="border-t border-x border-black text-sm text-start align-center px-1">
                                        {{ $description->location }}
                                    </td>
                                    <td class="border-t border-x border-black text-sm text-center align-center px-1">
                                        @if ($receivable->category == 'Media')
                                            Media
                                        @else
                                            Revisual
                                        @endif
                                    </td>
                                    <td class="border-t border-x border-black text-sm text-center align-center px-1">
                                        <a href="/accounting/billings/{{ $receivable->id }}">
                                            {{ $receivable->invoice_number }}</a>
                                    </td>
                                    <td class="border-t border-x border-black text-sm text-center align-center px-1">
                                        {{ date('d-m-Y', strtotime($receivable->created_at)) }}
                                    </td>
                                    <td class="border-t border-x border-black text-sm text-right align-center px-1">
                                        @php
                                            $billingNominal = $receivable->nominal + $receivable->ppn;
                                        @endphp
                                        {{ number_format($billingNominal) }}
                                    </td>
                                    <td class="border-t border-x border-black text-sm text-right align-center px-1">
                                        {{ number_format($payment) }}
                                    </td>
                                    <td class="border-t border-x border-black text-sm text-right align-center px-1">
                                        {{ number_format($billingNominal - $payment) }}
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td class="border-x border-black text-sm text-center align-center px-1">
                                    </td>
                                    <td class="border-x border-black text-sm text-start align-center px-1">
                                    </td>
                                    <td class="border-x border-black text-sm text-start align-center px-1">
                                        {{ $description->location }}
                                    </td>
                                    <td class="border-x border-black text-sm text-center align-center px-1">
                                    </td>
                                    <td class="border-x border-black text-sm text-center align-center px-1">
                                    </td>
                                    <td class="border-x border-black text-sm text-center align-center px-1">
                                    </td>
                                    <td class="border-x border-black text-sm text-right align-center px-1">
                                    </td>
                                    <td class="border-x border-black text-sm text-right align-center px-1">
                                    </td>
                                    <td class="border-x border-black text-sm text-right align-center px-1">
                                    </td>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                @endforeach
                <tr>
                    <td class="border border-black text-sm text-right align-center font-semibold px-2" colspan="6">
                        TOTAL
                    </td>
                    <td class="border border-black text-sm text-right align-center font-semibold px-2">
                        {{ number_format(array_sum($billing_nominals)) }}
                    </td>
                    <td class="border border-black text-sm text-right align-center font-semibold px-2">
                        {{ number_format(array_sum($data_payments)) }}
                    </td>
                    <td class="border border-black text-sm text-right align-center font-semibold px-2">
                        {{ number_format(array_sum($billing_nominals) - array_sum($data_payments)) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="flex justify-end mt-1 text-black">
        <label for="">Halaman {{ $i + 1 }} dari
            {{ $pageQty }}</label>
    </div>
</div>
