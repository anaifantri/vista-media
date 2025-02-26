@extends('dashboard.layouts.main');

@section('container')
    @php
        $sales = $data_sales->where('company_id', $company->id);
        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
    @endphp
    <div class="flex justify-center bg-black p-10">
        <div>
            <div class="flex items-center w-[1200px] border-b px-2">
                <!-- Title start -->
                <h1 class="index-h1 w-[1200px]">Membuat BAST</h1>
                <!-- Title end -->
                <div id="divButton" class="hidden w-[150px] justify-end">
                    <button class="flex justify-center items-center mx-1 btn-primary" title="Back" type="button"
                        onclick="previewMediaBack()">
                        <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                        </svg>
                        <span class="mx-1 text-white">Back</span>
                    </button>
                    <button class="flex justify-center items-center mx-1 btn-success" title="Next" type="button">
                        <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                        </svg>
                        <span class="mx-1 text-white">Save</span>
                    </button>
                </div>
                <div>
                    <a href="/work-reports/index/{{ $company->id }}"
                        class="flex justify-center items-center mx-1 btn-danger" title="Cancel">
                        <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                        </svg>
                        <span class="mx-1 text-white">Cancel</span>
                    </a>
                </div>
            </div>
            {{-- @include('work-reports.sale-detail') --}}
            <div class="flex justify-center w-full">
                <div class="w-[1200px] mb-10 p-2">
                    <div id="modalSelectSale">
                        <div class="flex w-full bg-stone-400 rounded-xl items-center border-b p-2">
                            <span class="text-center w-full text-lg font-semibold">PILIH DATA PENJUALAN YANG AKAN
                                DIBUATKAN BAST</span>
                        </div>
                        <div
                            class="flex w-full h-[560px] bg-stone-200 items-center justify-center border rounded-lg border-stone-400 my-2 p-4 pt-2 border-b pb-2">
                            <div class="w-[1135px]">
                                <div class="flex">
                                    <input
                                        id="search"class="flex border border-stone-900 rounded-lg p-1 outline-none text-sm text-stone-900 px-2"
                                        type="text" placeholder="Search"onkeyup="searchTable()" autofocus>
                                </div>
                                <div class="h-[504px] overflow-y-auto mt-1">
                                    <table id="salesTable" class="table-auto w-full">
                                        <thead class="sticky top-0">
                                            <tr class="bg-stone-400 border border-stone-900">
                                                <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center"
                                                    rowspan="2">No
                                                </th>
                                                <th class="text-stone-900 border border-stone-900 text-sm w-20 text-center"
                                                    rowspan="2">
                                                    Kode
                                                </th>
                                                <th class="text-stone-900 border border-stone-900 text-sm text-center"
                                                    rowspan="2">
                                                    Lokasi
                                                </th>
                                                <th class="text-stone-900 border border-stone-900 text-sm text-center"
                                                    colspan="4">
                                                    Detail
                                                    Penjualan</th>
                                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-16"
                                                    rowspan="2">
                                                    Action</th>
                                            </tr>
                                            <tr class="bg-stone-400 border border-stone-900">
                                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-28">
                                                    Jenis
                                                </th>
                                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-24">
                                                    No. Penju.
                                                </th>
                                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-24">
                                                    No. Penaw.
                                                </th>
                                                <th class="text-stone-900 border border-stone-900 text-sm text-center w-40">
                                                    Klien</th>
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
                                                        <td
                                                            class="text-stone-900 border border-stone-900 text-sm text-center">
                                                            {{ $loop->iteration }}
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
                                                            @if ($sale->media_category->name == 'Service')
                                                                Cetak/Pasang
                                                            @else
                                                                {{ $sale->media_category->name }}
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
                                                            <input id="{{ json_encode($quotationDeal) }}"
                                                                value="{{ json_encode($sale) }}" type="radio"
                                                                name="chooseSale" title="pilih"
                                                                onclick="getMediaSales(this)">
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
                                <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="formSelectSale">
    </form>

    <!-- Script Preview Image start-->
    <script src="/js/createworkreports.js"></script>
    <!-- Script Preview Image end-->
@endsection
