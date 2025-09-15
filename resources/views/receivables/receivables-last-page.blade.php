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
                    <th class="sticky top-0 border border-black text-sm w-72">
                        Klien
                    </th>
                    <th class="sticky top-0 border border-black text-sm text-center">
                        Lokasi
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-[72px]">
                        Deskripsi
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-56">
                        No. Invoice
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-24">
                        Tgl. Invoice
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-32">
                        Nominal
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-32">
                        Pembayaran
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-32">
                        Piutang
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($receivables as $receivable)
                    @php
                        $client = json_decode($receivable->client);
                        $descriptions = json_decode($receivable->invoice_content)->description;
                    @endphp
                    @if ($loop->iteration > $i * 25 && $loop->iteration < ($i + 1) * 25 + 1)
                        <tr>
                            <td class="border border-black text-sm text-center align-center px-1">
                                {{ $loop->iteration }}
                            </td>
                            <td class="border border-black text-sm text-start align-center px-1">
                                {{ $client->company }}
                            </td>
                            <td class="border border-black text-sm text-start align-center px-1">
                                @foreach ($descriptions as $description)
                                    @if ($description == end($descriptions))
                                        {{ substr($description->location, 0, 8) }}
                                    @else
                                        {{ substr($description->location, 0, 8) }} |
                                    @endif
                                @endforeach
                            </td>
                            <td class="border border-black text-sm text-center align-center px-1">
                                @if ($receivable->category == 'Media')
                                    Media
                                @else
                                    Revisual
                                @endif
                            </td>
                            <td class="border border-black text-sm text-center align-center px-1">
                                {{ $receivable->invoice_number }}
                            </td>
                            <td class="border border-black text-sm text-center align-center px-1">
                                {{ date('d-m-Y', strtotime($receivable->created_at)) }}
                            </td>
                            <td class="border border-black text-sm text-right align-center px-1">
                                @php
                                    $billingNominal =
                                        $receivable->nominal +
                                        $receivable->ppn -
                                        ($receivable->dpp / 11) * 12 * (2 / 100);
                                @endphp
                                {{ number_format($billingNominal) }}
                            </td>
                            <td class="border border-black text-sm text-right align-center px-1">
                                {{ number_format($data_payments[$loop->iteration - 1]) }}
                            </td>
                            <td class="border border-black text-sm text-right align-center px-1">
                                {{ number_format($billingNominal - $data_payments[$loop->iteration - 1]) }}
                            </td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td class="border border-black text-md text-right align-center font-semibold px-2" colspan="6">
                        TOTAL
                    </td>
                    <td class="border border-black text-md text-right align-center font-semibold px-2">
                        {{ number_format(array_sum($billing_nominals)) }}
                    </td>
                    <td class="border border-black text-md text-right align-center font-semibold px-2">
                        {{ number_format(array_sum($data_payments)) }}
                    </td>
                    <td class="border border-black text-md text-right align-center font-semibold px-2">
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
