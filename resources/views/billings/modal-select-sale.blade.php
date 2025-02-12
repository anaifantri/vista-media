<div id="modalSelectSale">
    <div class="flex w-full bg-stone-400 rounded-xl items-center border-b p-2">
        <span class="text-center w-full text-lg font-semibold">PILIH DATA PENJUALAN</span>
    </div>
    <div
        class="flex w-full h-[560px] bg-stone-200 items-center justify-center border rounded-lg border-stone-400 my-2 p-4 pt-2 border-b pb-2">
        <div class="w-[1135px]">
            <div class="flex">
                <input
                    id="search"class="flex border border-stone-900 rounded-lg p-1 outline-none text-sm text-stone-900"
                    type="text" placeholder="Search"onkeyup="searchTable()" autofocus>
            </div>
            <div class="h-[504px] overflow-y-auto mt-1">
                <table id="salesTable" class="table-auto w-full">
                    <thead class="sticky top-0">
                        <tr class="bg-stone-400 border border-stone-900">
                            <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center" rowspan="2">No
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm w-24 text-center" rowspan="2">
                                Kode
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center" rowspan="2">Lokasi
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-14" rowspan="2">
                                Jenis
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-28" rowspan="2">
                                Size
                                - V/H</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center" colspan="2">Detail
                                Penjualan</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-16" rowspan="2">
                                Action</th>
                        </tr>
                        <tr class="bg-stone-400 border border-stone-900">
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-40">No. Penj.</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-36">Klien</th>
                        </tr>
                    </thead>
                    <tbody class="bg-stone-200">
                        @foreach ($sales as $sale)
                            @if ($sale->company_id == $company->id)
                                @php
                                    if (count($sale->quotation->quotation_revisions) != 0) {
                                        $quotationDeal = $sale->quotation->quotation_revisions->last();
                                        $payment_terms = json_decode($quotationDeal->payment_terms);
                                    } else {
                                        $quotationDeal = $sale->quotation;
                                        $payment_terms = json_decode($quotationDeal->payment_terms);
                                    }
                                    $product = json_decode($sale->product);
                                    $description = json_decode($product->description);
                                    $client = json_decode($sale->quotation->clients);
                                @endphp
                                <tr>
                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                        {{ $product->code }}
                                        -
                                        {{ $product->city_code }}</td>
                                    <td class="text-stone-900 border border-stone-900 text-sm px-2">
                                        {{ $product->address }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                        @if ($product->category == 'Billboard')
                                            BB
                                        @elseif ($product->category == 'Bando')
                                            BD
                                        @elseif ($product->category == 'Baliho')
                                            BLH
                                        @elseif ($product->category == 'Midiboard')
                                            MB
                                        @elseif ($product->category == 'Signage')
                                            SN
                                        @elseif ($product->category == 'Videotron')
                                            VT
                                        @endif
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                        {{ $product->size }}
                                        -
                                        @if ($product->orientation == 'Vertikal')
                                            V
                                        @elseif ($product->orientation == 'Horizontal')
                                            H
                                        @endif
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                        <a href="/marketing/sales/{{ $sale->id }}"
                                            class="ml-1 w-32">{{ $sale->number }}</a>
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                        {{ $client->name }}
                                    </td>
                                    <td id="tdCreate"
                                        class="text-stone-900 border border-stone-900 align-middle text-center text-sm">
                                        <input id="{{ json_encode($payment_terms) }}"
                                            name="{{ json_encode($quotationDeal) }}" value="{{ json_encode($sale) }}"
                                            type="radio" name="chooseLocation" title="pilih"
                                            onclick="getSales(this)">
                                        <label class="ml-1">Pilih</label>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="flex w-full items-end bg-stone-400 rounded-lg justify-end px-4 pt-2 border-b pb-2">
        <button class="flex justify-center items-center mx-1 btn-success" title="Next" type="button"
            onclick="saleNext()">
            <span class="mx-1 text-white">Next</span>
            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24">
                <path
                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
            </svg>
        </button>
    </div>
</div>

<script>
    let sale = {};
    let terms = [];
    let quotationDeal = {};
    let client = {};
    getSales = (sel) => {
        sale = JSON.parse(sel.value);
        client = JSON.parse(sale.quotation.clients);
        quotationDeal = JSON.parse(sel.name);
        dataPayments = JSON.parse(sel.id);
        terms = dataPayments.dataPayments;
    }
</script>
