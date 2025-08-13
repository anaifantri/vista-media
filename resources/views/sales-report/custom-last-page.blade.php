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
                <div class="flex justify-center w-72">
                    <label class="text-md text-center">LAPORAN PENJUALAN</label>
                </div>
                <div class="flex justify-center w-72">
                    <label class="text-3xl text-center">MINGGUAN</label>
                </div>
                <div class="flex mt-4 justify-center w-72 border rounded-md">
                    @if (request('fromDate'))
                        <label id="labelPeriode" class="month-report text-md font-semibold text-center">
                            {{ date('d', strtotime(request('fromDate'))) }}
                            {{ $bulan[(int) date('m', strtotime(request('fromDate')))] }}
                            {{ date('Y', strtotime(request('fromDate'))) }}
                            s.d.
                            {{ date('d', strtotime(request('toDate'))) }}
                            {{ $bulan[(int) date('m', strtotime(request('toDate')))] }}
                            {{ date('Y', strtotime(request('toDate'))) }}
                        </label>
                    @else
                        <label id="labelPeriode" class="month-report text-md font-semibold text-center">-</label>
                    @endif
                </div>
                <div class="flex justify-center w-72 border rounded-md mt-2">
                    <label class="text-sm">
                        <span class="text-md font-semibold text-red-600">Tgl. Cetak : </span>
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
                    <th class="sticky top-0 border border-black text-sm text-center w-56">
                        <button class="flex justify-center w-full items-center">@sortablelink('number', 'Data Penjualan')
                            <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                            </svg>
                        </button>
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-[350px]">
                        Klien
                    </th>
                    <th class="sticky top-0 border border-black text-sm text-center w-[500px]">
                        Lokasi
                    </th>
                    <th class="sticky top-0 border border-black text-sm">
                        Deskripsi
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-32">
                        Harga
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    @php
                        $ppnTotal = $ppnTotal + $sale->dpp * ($sale->ppn / 100);
                        $priceTotal = $priceTotal + $sale->price;

                        $quotId = null;
                        $quotRevisionId = null;
                        $created_by = json_decode($sale->created_by);
                        $revisions = $sale->quotation->quotation_revisions;

                        if (count($revisions) != 0) {
                            $revision =
                                $sale->quotation->quotation_revisions[count($sale->quotation->quotation_revisions) - 1];
                            $number = $revision->number;
                            $quotRevisionId = $revision->id;
                            $notes = json_decode($revision->notes);
                            $created_at = $revision->created_at;
                            $payment_terms = json_decode($revision->payment_terms);
                            $price = json_decode($revision->price);
                            $dataApprovals = $sale->quotation->quotation_approvals;
                            $dataAgreements = $sale->quotation->quotation_agreements;
                            $dataOrders = $sale->quotation->quotation_orders;
                        } else {
                            $number = $sale->quotation->number;
                            $quotId = $sale->quotation->id;
                            $notes = json_decode($sale->quotation->notes);
                            $created_at = $sale->quotation->created_at;
                            $payment_terms = json_decode($sale->quotation->payment_terms);
                            $price = json_decode($sale->quotation->price);
                            $dataApprovals = $sale->quotation->quotation_approvals;
                            $dataAgreements = $sale->quotation->quotation_agreements;
                            $dataOrders = $sale->quotation->quotation_orders;
                        }
                        $clients = json_decode($sale->quotation->clients);
                        $product = json_decode($sale->product);
                        $description = json_decode($product->description);
                    @endphp
                    @if ($loop->iteration > $i * 8 && $loop->iteration < ($i + 1) * 8 + 1)
                        <tr>
                            <td class="border border-black text-sm text-center align-top">
                                {{ $loop->iteration }}</td>
                            <td class="border border-black text-sm text-start align-top">
                                <div>
                                    <div class="flex ml-1">
                                        <label class="w-12">No.</label>
                                        <label>:</label>
                                        <a href="/marketing/sales/{{ $sale->id }}"
                                            class="ml-1 w-full">{{ $sale->number }}</a>
                                    </div>
                                    <div class="flex ml-1">
                                        <label class="w-12">Tgl.</label>
                                        <label>:</label>
                                        <label
                                            class="ml-1 w-full">{{ date('d-M-Y', strtotime($sale->created_at)) }}</label>
                                    </div>
                                    <div class="flex ml-1">
                                        <label class="w-12">Oleh</label>
                                        <label>:</label>
                                        <label class="ml-1 w-full">{{ $created_by->name }}</label>
                                    </div>
                                </div>
                            </td>
                            <td class="border border-black text-sm text-start align-top">
                                <div>
                                    @if ($clients->type == 'Perusahaan')
                                        <div class="flex ml-1">
                                            <label class="w-12">Klien</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2">
                                                {{ $clients->company }}
                                            </label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-12">Kontak</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2">{{ $clients->contact_name }}</label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-12">No. Hp</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2">{{ $clients->contact_phone }}</label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-12">Produk</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2">{{ $sale->product_name }}</label>
                                        </div>
                                    @else
                                        <div class="flex ml-1">
                                            <label class="w-12">Klien</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2">{{ $clients->name }}</label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-12">No. Hp</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2">{{ $clients->phone }}</label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-12">Produk</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2">{{ $sale->product_name }}</label>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="border border-black text-sm text-start align-top">
                                <div>
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
                                </div>
                            </td>
                            <td class="border border-black text-sm text-start align-top">
                                <div>
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
                                </div>
                            </td>
                            <td class="border border-black text-sm text-right align-top px-1">
                                {{ number_format($sale->price) }}
                            </td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td class="border border-black text-md text-right align-top font-semibold px-2" colspan="5">Sub
                        Total</td>
                    <td class="border border-black text-md text-right align-top font-semibold px-2">
                        {{ number_format($priceTotal) }}
                    </td>
                </tr>
                <tr>
                    <td class="border border-black text-md text-right align-top font-semibold px-2" colspan="5">PPN
                    </td>
                    <td class="border border-black text-md text-right align-top font-semibold px-2">
                        {{ number_format($ppnTotal) }}
                    </td>
                </tr>
                <tr>
                    <td class="border border-black text-md text-right align-top font-semibold px-2" colspan="5">
                        Grand Total</td>
                    <td class="border border-black text-md text-right align-top font-semibold px-2">
                        {{ number_format($priceTotal + $ppnTotal) }}
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
