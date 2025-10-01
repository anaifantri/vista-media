@extends('dashboard.layouts.main');

@section('container')
    @php
        $sales = $data_sales->where('company_id', $company->id);
    @endphp
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div>
                <div class="flex items-center w-[1200px] border-b px-2">
                    <!-- Title start -->
                    <h1 class="index-h1 w-[1200px]">Membuat Invoice & Kwitansi</h1>
                    <!-- Title end -->
                    <div>
                        <a href="/billings/index/{{ $company->id }}" class="flex justify-center items-center mx-1 btn-danger"
                            title="Cancel">
                            <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="mx-1 text-white">Cancel</span>
                        </a>
                    </div>
                </div>
                <div class="flex justify-center w-full">
                    <div class="w-[1200px] mb-10 p-2">
                        <div class="flex w-full bg-stone-400 rounded-xl items-center border-b p-2">
                            <span class="text-center w-full text-lg font-semibold">PILIH DATA PENJUALAN YANG AKAN
                                DITAGIHKAN</span>
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
                                                <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center"
                                                    rowspan="2">No
                                                </th>
                                                <th class="text-stone-900 border border-stone-900 text-sm w-24 text-center"
                                                    rowspan="2">
                                                    Kode
                                                </th>
                                                <th class="text-stone-900 border border-stone-900 text-sm text-center"
                                                    rowspan="2">
                                                    Lokasi
                                                </th>
                                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-14"
                                                    rowspan="2">
                                                    Jenis
                                                </th>
                                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-28"
                                                    rowspan="2">
                                                    Size
                                                    - V/H</th>
                                                <th class="text-stone-900 border border-stone-900 text-sm text-center"
                                                    colspan="3">
                                                    Detail
                                                    Penjualan</th>
                                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-16"
                                                    rowspan="2">
                                                    Action</th>
                                            </tr>
                                            <tr class="bg-stone-400 border border-stone-900">
                                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-24">
                                                    No.
                                                    Penju.
                                                </th>
                                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-24">
                                                    No.
                                                    Penaw.
                                                </th>
                                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-36">
                                                    Klien</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-stone-200">
                                            @php
                                                $number = 0;
                                            @endphp
                                            @foreach ($sales as $sale)
                                                @if (count($sale->billings) > 0)
                                                    @php
                                                        $billingTotal = 0;
                                                        foreach ($sale->billings as $saleBilling) {
                                                            $invoice_content = json_decode(
                                                                $saleBilling->invoice_content,
                                                            );
                                                            $descriptions = $invoice_content->description;
                                                            if (isset($invoice_content->data_sales)) {
                                                                $dataSales = $invoice_content->data_sales;
                                                                foreach ($dataSales as $dataSale) {
                                                                    if ($dataSale->id == $sale->id) {
                                                                        $billingTotal =
                                                                            $billingTotal + $dataSale->nominal;
                                                                    }
                                                                }
                                                            } else {
                                                                foreach ($descriptions as $itemDesc) {
                                                                    if ($itemDesc->sale_id == $sale->id) {
                                                                        $billingTotal =
                                                                            $billingTotal + $itemDesc->nominal;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    @endphp
                                                    @if ($sale->price > $billingTotal)
                                                        @php
                                                            $number++;
                                                            if (count($sale->quotation->quotation_revisions) != 0) {
                                                                $quotationDeal = $sale->quotation->quotation_revisions->last();
                                                                $payment_terms = json_decode(
                                                                    $quotationDeal->payment_terms,
                                                                );
                                                            } else {
                                                                $quotationDeal = $sale->quotation;
                                                                $payment_terms = json_decode(
                                                                    $quotationDeal->payment_terms,
                                                                );
                                                            }
                                                            $product = json_decode($sale->product);
                                                            $description = json_decode($product->description);
                                                            $client = json_decode($sale->quotation->clients);
                                                        @endphp
                                                        <tr>
                                                            <td
                                                                class="text-stone-900 border border-stone-900 text-sm text-center">
                                                                {{ $number }}
                                                            </td>
                                                            <td
                                                                class="text-stone-900 border border-stone-900 text-sm text-center">
                                                                {{ $product->code }}
                                                                -
                                                                {{ $product->city_code }}</td>
                                                            <td class="text-stone-900 border border-stone-900 text-sm px-2">
                                                                {{ $product->address }}
                                                            </td>
                                                            <td
                                                                class="text-stone-900 border border-stone-900 text-sm text-center">
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
                                                            <td
                                                                class="text-stone-900 border border-stone-900 text-sm text-center">
                                                                {{ $product->size }}
                                                                -
                                                                @if ($product->orientation == 'Vertikal')
                                                                    V
                                                                @elseif ($product->orientation == 'Horizontal')
                                                                    H
                                                                @endif
                                                            </td>
                                                            <td
                                                                class="text-stone-900 border border-stone-900 text-sm text-center">
                                                                <a href="/marketing/sales/{{ $sale->id }}"
                                                                    class="ml-1 w-32">{{ substr($sale->number, 0, 8) }}..</a>
                                                            </td>
                                                            <td
                                                                class="text-stone-900 border border-stone-900 text-sm text-center">
                                                                <a href="/marketing/quotations/{{ $quotationDeal->id }}"
                                                                    class="ml-1 w-32">{{ substr($quotationDeal->number, 0, 8) }}..</a>
                                                            </td>
                                                            <td
                                                                class="text-stone-900 border border-stone-900 text-sm text-center">
                                                                {{ $client->name }}
                                                            </td>
                                                            <td id="tdCreate"
                                                                class="text-stone-900 border border-stone-900 align-middle text-center text-sm">
                                                                @if ($bill_category == 'media')
                                                                    @if ($model == 'auto')
                                                                        <input id="{{ $client->id }}"
                                                                            value="{{ $sale->id }}" type="checkbox"
                                                                            name="chooseSale" title="pilih"
                                                                            onclick="getAutoSales(this)">
                                                                        <label class="ml-1">Pilih</label>
                                                                    @else
                                                                        <input id="{{ $client->id }}"
                                                                            value="{{ $sale->id }}" type="radio"
                                                                            name="chooseSale" title="pilih"
                                                                            onclick="getManualSales(this)">
                                                                        <label class="ml-1">Pilih</label>
                                                                    @endif
                                                                @else
                                                                    <input id="{{ $quotationDeal }}"
                                                                        value="{{ $sale->id }}" type="checkbox"
                                                                        name="chooseSale" title="pilih"
                                                                        onclick="getServiceSales(this)">
                                                                    <label class="ml-1">Pilih</label>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @else
                                                    @php
                                                        $number++;
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
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-sm text-center">
                                                            {{ $number }}
                                                        </td>
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-sm text-center">
                                                            {{ $product->code }}
                                                            -
                                                            {{ $product->city_code }}</td>
                                                        <td class="text-stone-900 border border-stone-900 text-sm px-2">
                                                            {{ $product->address }}
                                                        </td>
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-sm text-center">
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
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-sm text-center">
                                                            {{ $product->size }}
                                                            -
                                                            @if ($product->orientation == 'Vertikal')
                                                                V
                                                            @elseif ($product->orientation == 'Horizontal')
                                                                H
                                                            @endif
                                                        </td>
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-sm text-center">
                                                            <a href="/marketing/sales/{{ $sale->id }}"
                                                                class="ml-1 w-32">{{ substr($sale->number, 0, 8) }}..</a>
                                                        </td>
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-sm text-center">
                                                            <a href="/marketing/quotations/{{ $quotationDeal->id }}"
                                                                class="ml-1 w-32">{{ substr($quotationDeal->number, 0, 8) }}..</a>
                                                        </td>
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-sm text-center">
                                                            {{ $client->name }}
                                                        </td>
                                                        <td id="tdCreate"
                                                            class="text-stone-900 border border-stone-900 align-middle text-center text-sm">
                                                            @if ($bill_category == 'media')
                                                                @if ($model == 'auto')
                                                                    <input id="{{ $client->id }}"
                                                                        value="{{ $sale->id }}" type="checkbox"
                                                                        name="chooseSale" title="pilih"
                                                                        onclick="getAutoSales(this)">
                                                                    <label class="ml-1">Pilih</label>
                                                                @else
                                                                    <input id="{{ $client->id }}"
                                                                        value="{{ $sale->id }}" type="radio"
                                                                        name="chooseSale" title="pilih"
                                                                        onclick="getManualSales(this)">
                                                                    <label class="ml-1">Pilih</label>
                                                                @endif
                                                            @else
                                                                <input id="{{ $quotationDeal }}"
                                                                    value="{{ $sale->id }}" type="checkbox"
                                                                    name="chooseSale" title="pilih"
                                                                    onclick="getServiceSales(this)">
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
                                <a href="/billings/select-models"
                                    class="flex justify-center items-center mx-1 btn-primary" title="Back">
                                    <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24">
                                        <path
                                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                                    </svg>
                                    <span class="mx-1 text-white">Back</span>
                                </a>
                                <button class="flex justify-center items-center mx-1 btn-success" title="Next"
                                    type="button" onclick="saleMediaNext()">
                                    <span class="mx-1 text-white">Next</span>
                                    <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24">
                                        <path
                                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                                    </svg>
                                </button>
                            @else
                                <button class="flex justify-center items-center mx-1 btn-success" title="Next"
                                    type="button" onclick="saleServiceNext()">
                                    <span class="mx-1 text-white">Next</span>
                                    <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24">
                                        <path
                                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="formSelectSale">
        @if ($bill_category == 'media')
            <input type="text" name="model" value="{{ $model }}" hidden>
        @endif
    </form>

    <!-- Script Preview Image start-->
    <script src="/js/createbillings.js"></script>

    <script>
        const formSelectSale = document.getElementById("formSelectSale");
        var billCategory = @json($bill_category);
        let saleId = [];
        var clientId = '';

        getAutoSales = (sel) => {
            if (Object.keys(saleId).length == 0) {
                saleId.push((sel.value));
                clientId = sel.id;
                formSelectSale.setAttribute('action', '/billings/select-terms/' + JSON.stringify(saleId));
            } else {
                if (clientId != sel.id) {
                    alert("Silahkan pilih penjualan dengan klien yang sama..!!");
                    sel.checked = false;
                } else {
                    if (sel.checked == true) {
                        saleId.push(sel.value);
                        formSelectSale.setAttribute('action', '/billings/select-terms/' + JSON.stringify(
                            saleId));
                    } else {
                        for (let i = 0; i < saleId.length; i++) {
                            if (saleId[i] == Number(sel.value)) {
                                saleId.splice(i, 1);
                            }
                        }
                        formSelectSale.setAttribute('action', '/billings/select-terms/' + JSON.stringify(
                            saleId));
                    }
                }
            }
        }

        getManualSales = (sel) => {
            if (Object.keys(saleId).length == 0) {
                saleId.push((sel.value));
                formSelectSale.setAttribute('action', '/billings/select-terms/' + JSON.stringify(saleId));
            } else {
                saleId.splice(0, 1);
                saleId.push(sel.value);
                formSelectSale.setAttribute('action', '/billings/select-terms/' + JSON.stringify(
                    saleId));
            }
            console.log(saleId);

        }

        getServiceSales = (sel) => {
            if (Object.keys(saleId).length == 0) {
                saleId.push((sel.value));
                quotationDeal = JSON.parse(sel.id);
                formSelectSale.setAttribute('action', '/billings/create-service-billing/' + JSON.stringify(saleId));
            } else {
                if (quotationDeal.number != JSON.parse(sel.id).number) {
                    alert("Silahkan pilih klien dan nomor penawaran yang sama..!!");
                    sel.checked = false;
                } else {
                    if (sel.checked == true) {
                        saleId.push(sel.value);
                        formSelectSale.setAttribute('action', '/billings/create-service-billing/' + JSON.stringify(
                            saleId));
                    } else {
                        for (let i = 0; i < saleId.length; i++) {
                            if (saleId[i] == Number(sel.value)) {
                                saleId.splice(i, 1);
                            }
                        }
                        formSelectSale.setAttribute('action', '/billings/create-service-billing/' + JSON.stringify(
                            saleId));
                    }

                }
            }
        }
    </script>
    <!-- Script Preview Image end-->
@endsection
