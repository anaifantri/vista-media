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
                <div class="flex justify-center w-72">
                    <label class="text-sm text-center">LIST PIUTANG</label>
                </div>
                <div class="flex justify-center w-72">
                    <label class="text-3xl text-center">INVOICE</label>
                </div>
                <div class="flex mt-4 justify-center w-72 border rounded-md">
                    @if (request('fromDate'))
                        <label id="labelPeriode" class="month-report text-sm font-semibold text-center">
                            {{ date('d', strtotime(request('fromDate'))) }}
                            {{ $bulan[(int) date('m', strtotime(request('fromDate')))] }}
                            {{ date('Y', strtotime(request('fromDate'))) }}
                            s.d.
                            {{ date('d', strtotime(request('toDate'))) }}
                            {{ $bulan[(int) date('m', strtotime(request('toDate')))] }}
                            {{ date('Y', strtotime(request('toDate'))) }}
                        </label>
                    @else
                        <label id="labelPeriode" class="month-report text-sm font-semibold text-center">-</label>
                    @endif
                </div>
                <div class="flex justify-center w-72 border rounded-md mt-2">
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
                    <th class="sticky top-0 border border-black text-sm text-center w-44">
                        No. Penjualan
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-72">
                        Klien
                    </th>
                    <th class="sticky top-0 border border-black text-sm text-center">
                        Lokasi
                    </th>
                    <th class="sticky top-0 border border-black text-sm">
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
                @foreach ($receivables as $receivable)
                    @php
                        $client = json_decode($receivable->client);
                    @endphp
                    @if ($i == 0)
                        @if ($loop->iteration < 9)
                            <tr>
                                <td class="border border-black text-sm text-center align-top px-1">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="border border-black text-sm text-start align-top px-1">
                                </td>
                                <td class="border border-black text-sm text-start align-top px-1">
                                    {{ $client->company }}
                                </td>
                                <td class="border border-black text-sm text-start align-top px-1">
                                    {{-- <div>
                                    <div class="flex ml-1">
                                        <label class="w-12">Kode</label>
                                        <label>:</label>
                                        <a href="/media/locations/preview/{{ $product->category }}/{{ $product->id }}"
                                            class="ml-1">{{ $product->code }} -
                                            {{ $product->city_code }}</a>
                                    </div>
                                    <div class="flex ml-1">
                                        <label class="w-12">Lokasi</label>
                                        <label>:</label>
                                        <label class="ml-1">
                                            {{ $product->address }}
                                        </label>
                                    </div>
                                    <div class="flex ml-1">
                                        <label class="w-12">Size</label>
                                        <label>:</label>
                                        <label class="ml-1">
                                            {{ $product->size }}x{{ $product->side }}-
                                            @if ($product->orientation == 'Horizontal')
                                                H
                                            @elseif($product->orientation == 'Vertikal')
                                                V
                                            @endif
                                        </label>
                                    </div>
                                </div> --}}
                                </td>
                                <td class="border border-black text-sm text-start align-top px-1">
                                    {{-- <div>
                                    <div class="flex ml-1">
                                        <label class="w-12">Jenis</label>
                                        <label class="ml-1">:</label>
                                        <label class="ml-2">
                                            @if ($sale->media_category->name == 'Service')
                                                <label class="ml-1">Cetak / Pasang</label>
                                            @else
                                                <label class="ml-1">Sewa Media
                                                    {{ $sale->media_category->name }}</label>
                                            @endif
                                        </label>
                                    </div>
                                    @if ($sale->media_category->name != 'Service')
                                        <div class="flex ml-1">
                                            <label class="w-12">Periode</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2">{{ $sale->duration }}</label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-12">Awal</label>
                                            <label class="ml-1">:</label>
                                            @if ($sale->start_at)
                                                <label
                                                    class="ml-2">{{ date('d-M-Y', strtotime($sale->start_at)) }}</label>
                                            @else
                                                <label class="ml-2">-</label>
                                            @endif
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-12">Akhir</label>
                                            <label class="ml-1">:</label>
                                            @if ($sale->end_at)
                                                <label
                                                    class="ml-2">{{ date('d-M-Y', strtotime($sale->end_at)) }}</label>
                                            @else
                                                <label class="ml-2">-</label>
                                            @endif
                                        </div>
                                    @endif
                                </div> --}}
                                </td>
                                <td class="border border-black text-sm text-center px-1">
                                    {{ $receivable->invoice_number }}
                                </td>
                                <td class="border border-black text-sm text-center px-1">
                                    {{ date('d-m-Y', strtotime($receivable->created_at)) }}
                                </td>
                                <td class="border border-black text-sm text-right align-top px-1">
                                    {{ number_format($receivable->nominal + $receivable->ppn) }}
                                </td>
                                <td class="border border-black text-sm text-right align-top px-1">
                                    {{ number_format($data_payments[$loop->iteration - 1]) }}
                                </td>
                                <td class="border border-black text-sm text-right align-top px-1">
                                    {{ number_format($receivable->nominal + $receivable->ppn - $data_payments[$loop->iteration - 1]) }}
                                </td>
                            </tr>
                        @endif
                    @else
                        @if ($loop->iteration > $i * 8 && $loop->iteration < ($i + 1) * 8 + 1)
                            <tr>
                                <td class="border border-black text-sm text-center align-top px-1">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="border border-black text-sm text-start align-top px-1">
                                </td>
                                <td class="border border-black text-sm text-start align-top px-1">
                                    {{ $client->company }}
                                </td>
                                <td class="border border-black text-sm text-start align-top px-1">
                                    {{-- <div>
                                    <div class="flex ml-1">
                                        <label class="w-12">Kode</label>
                                        <label>:</label>
                                        <a href="/media/locations/preview/{{ $product->category }}/{{ $product->id }}"
                                            class="ml-1">{{ $product->code }} -
                                            {{ $product->city_code }}</a>
                                    </div>
                                    <div class="flex ml-1">
                                        <label class="w-12">Lokasi</label>
                                        <label>:</label>
                                        <label class="ml-1">
                                            {{ $product->address }}
                                        </label>
                                    </div>
                                    <div class="flex ml-1">
                                        <label class="w-12">Size</label>
                                        <label>:</label>
                                        <label class="ml-1">
                                            {{ $product->size }}x{{ $product->side }}-
                                            @if ($product->orientation == 'Horizontal')
                                                H
                                            @elseif($product->orientation == 'Vertikal')
                                                V
                                            @endif
                                        </label>
                                    </div>
                                </div> --}}
                                </td>
                                <td class="border border-black text-sm text-start align-top px-1">
                                    {{-- <div>
                                    <div class="flex ml-1">
                                        <label class="w-12">Jenis</label>
                                        <label class="ml-1">:</label>
                                        <label class="ml-2">
                                            @if ($sale->media_category->name == 'Service')
                                                <label class="ml-1">Cetak / Pasang</label>
                                            @else
                                                <label class="ml-1">Sewa Media
                                                    {{ $sale->media_category->name }}</label>
                                            @endif
                                        </label>
                                    </div>
                                    @if ($sale->media_category->name != 'Service')
                                        <div class="flex ml-1">
                                            <label class="w-12">Periode</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2">{{ $sale->duration }}</label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-12">Awal</label>
                                            <label class="ml-1">:</label>
                                            @if ($sale->start_at)
                                                <label
                                                    class="ml-2">{{ date('d-M-Y', strtotime($sale->start_at)) }}</label>
                                            @else
                                                <label class="ml-2">-</label>
                                            @endif
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-12">Akhir</label>
                                            <label class="ml-1">:</label>
                                            @if ($sale->end_at)
                                                <label
                                                    class="ml-2">{{ date('d-M-Y', strtotime($sale->end_at)) }}</label>
                                            @else
                                                <label class="ml-2">-</label>
                                            @endif
                                        </div>
                                    @endif
                                </div> --}}
                                </td>
                                <td class="border border-black text-sm text-center px-1">
                                    {{ $receivable->invoice_number }}
                                </td>
                                <td class="border border-black text-sm text-center px-1">
                                    {{ date('d-m-Y', strtotime($receivable->created_at)) }}
                                </td>
                                <td class="border border-black text-sm text-right align-top px-1">
                                    {{ number_format($receivable->nominal + $receivable->ppn) }}
                                </td>
                                <td class="border border-black text-sm text-right align-top px-1">
                                    {{ number_format($data_payments[$loop->iteration - 1]) }}
                                </td>
                                <td class="border border-black text-sm text-right align-top px-1">
                                    {{ number_format($receivable->nominal + $receivable->ppn - $data_payments[$loop->iteration - 1]) }}
                                </td>
                            </tr>
                        @endif
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="flex justify-end mt-1 text-black">
        <label for="">Halaman {{ $i + 1 }} dari
            {{ $pageQty }}</label>
    </div>
</div>
