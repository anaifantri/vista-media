<div id="modalSelectSale">
    <div class="flex w-full bg-stone-400 rounded-xl items-center border-b p-2">
        <span class="text-center w-full text-lg font-semibold">PILIH DATA PENJUALAN YANG AKAN DITAGIHKAN</span>
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
                            <th class="text-stone-900 border border-stone-900 text-sm text-center" rowspan="2">
                                Lokasi
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-14" rowspan="2">
                                Jenis
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-28" rowspan="2">
                                Size
                                - V/H</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center" colspan="3">
                                Detail
                                Penjualan</th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-16" rowspan="2">
                                Action</th>
                        </tr>
                        <tr class="bg-stone-400 border border-stone-900">
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-24">No. Penju.
                            </th>
                            <th class="text-stone-900 border border-stone-900 text-sm text-center w-24">No. Penaw.
                            </th>
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
                                            class="ml-1 w-32">{{ substr($sale->number, 0, 8) }}..</a>
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                        <a href="/marketing/quotations/{{ $quotationDeal->id }}"
                                            class="ml-1 w-32">{{ substr($quotationDeal->number, 0, 8) }}..</a>
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                        {{ $client->name }}
                                    </td>
                                    <td id="tdCreate"
                                        class="text-stone-900 border border-stone-900 align-middle text-center text-sm">
                                        @if ($bill_category == 'media')
                                            <input value="{{ $sale->id }}" type="radio" name="chooseSale"
                                                title="pilih" onclick="getMediaSales(this)">
                                            <label class="ml-1">Pilih</label>
                                        @else
                                            <input value="{{ $sale->id }}" type="checkbox" name="chooseSale"
                                                title="pilih" onclick="getServiceSales(this)">
                                            <label class="ml-1">Pilih</label>
                                        @endif
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
        @if ($bill_category == 'media')
            <button class="flex justify-center items-center mx-1 btn-success" title="Next" type="button"
                onclick="saleMediaNext()">
                <span class="mx-1 text-white">Next</span>
                <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path
                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                </svg>
            </button>
        @else
            <button class="flex justify-center items-center mx-1 btn-success" title="Next" type="button"
                onclick="saleServiceNext()">
                <span class="mx-1 text-white">Next</span>
                <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path
                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                </svg>
            </button>
        @endif
    </div>
</div>


<form id="formSelectSale">
</form>

<script>
    const formSelectSale = document.getElementById("formSelectSale");
    let saleId = [];
    getMediaSales = (sel) => {
        saleId.push(sel.value);
        formSelectSale.setAttribute('action', '/billings/create-billing/' + JSON.stringify(saleId));
    }
</script>

{{-- <script>
    const saleId = document.getElementById("saleId");
    const billTerms = document.getElementById("billTerms");
    const billDpp = document.getElementById("billDpp");
    const billNominal = document.getElementById("billNominal");
    let sale = [];
    let terms = [];
    let billTermsData = [];
    let billDppData = [];
    let billNominalData = [];
    let quotationDeal = {};
    let client = {};
    let dataPayments = {};
    getMediaSales = (sel) => {
        var splitId = sel.id.split('*');
        billTermsData = [];
        billTerms.value = "";
        billDppData = [];
        billDpp.value = "";
        billNominalData = [];
        billNominal.value = "";
        sale.push(JSON.parse(sel.value));
        client = JSON.parse(sale[0].quotation.clients);
        quotationDeal = JSON.parse(splitId[1]);
        dataPayments = JSON.parse(splitId[0]);
        terms = dataPayments.dataPayments;
    }

    getServiceSales = (sel) => {
        var splitId = sel.id.split('*');
        if (Object.keys(sale).length == 0) {
            billTermsData = [];
            billTerms.value = "";
            billDppData = [];
            billDpp.value = "";
            billNominalData = [];
            billNominal.value = "";
            sale.push(JSON.parse(sel.value));
            quotationDeal = JSON.parse(splitId[1]);
            client = JSON.parse(sale[0].quotation.clients);
            dataPayments = JSON.parse(splitId[0]);
            terms = dataPayments.dataPayments;
        } else {
            if (quotationDeal.number != JSON.parse(splitId[1]).number) {
                alert("Silahkan pilih klien dan nomor penawaran yang sama..!!");
                sel.checked = false;
            } else {
                if (sel.checked == true) {
                    sale.push(JSON.parse(sel.value));
                } else {
                    for (let i = 0; i < sale.length; i++) {
                        if (sale[i].id == JSON.parse(sel.value).id) {
                            sale.splice(i, 1);
                            sale.splice(i, 1);
                        }
                    }
                }

            }
        }
    }
</script> --}}
