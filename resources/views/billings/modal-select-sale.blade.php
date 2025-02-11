<div id="modalSelectSale">
    <div class="flex w-full bg-stone-400 rounded-xl items-center px-10 pt-2 border-b pb-2">
        <span class="text-center w-full text-lg font-semibold">PILIH DATA PENJUALAN</span>
    </div>
    <div
        class="flex w-full h-[525px] bg-stone-200 items-center justify-center border rounded-lg border-stone-400 my-2 p-4 pt-2 border-b pb-2">
        <div class="flex-grow h-[500px] overflow-y-auto">
            <table class="relative w-full border">
                <thead class="sticky top-0">
                    <tr class="bg-stone-400 border">
                        <th class="text-stone-900 border border-stone-900 text-sm w-8 text-center" rowspan="2">No</th>
                        <th class="text-stone-900 border border-stone-900 text-sm w-24 text-center" rowspan="2">Kode
                        </th>
                        <th class="text-stone-900 border border-stone-900 text-sm text-center" rowspan="2">Lokasi
                        </th>
                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-14" rowspan="2">Jenis
                        </th>
                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-28" rowspan="2">Size
                            - V/H</th>
                        <th class="text-stone-900 border border-stone-900 text-sm text-center" colspan="2">Detail
                            Penjualan</th>
                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-16" rowspan="2">
                            Action</th>
                    </tr>
                    <tr class="bg-stone-400 border">
                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-40">No. Penj.</th>
                        <th class="text-stone-900 border border-stone-900 text-sm text-center w-36">Klien</th>
                    </tr>
                </thead>
                <tbody class="bg-stone-200">
                    @foreach ($sales as $sale)
                        @php
                            $product = json_decode($sale->product);
                            $description = json_decode($product->description);
                            $client = json_decode($sale->quotation->clients);
                        @endphp
                        <tr>
                            <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-sm text-center">{{ $product->code }}
                                -
                                {{ $product->city_code }}</td>
                            <td class="text-stone-900 border border-stone-900 text-sm px-2">{{ $product->address }}
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
                                <a href="/marketing/sales/{{ $sale->id }}" class="ml-1 w-32">{{ $sale->number }}</a>
                            </td>
                            <td class="text-stone-900 border border-stone-900 text-sm text-center">
                                {{ $client->name }}
                            </td>
                            <td id="tdCreate"
                                class="text-stone-900 border border-stone-900 align-middle text-center text-sm">
                                <input value="{{ $sale->id }}" type="radio" name="chooseLocation" title="pilih"
                                    onclick="getLocation(this)">
                                <label class="ml-1">Pilih</label>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="flex w-full items-end bg-stone-400 rounded-lg justify-end px-4 pt-2 border-b pb-2">
        {{-- <button class="flex justify-center items-center mx-1 btn-success" title="Back" type="button">
            <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" viewBox="0 0 24 24">
                <path
                    d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
            </svg>
            <span class="ml-2 text-white">Back</span>
        </button> --}}
        <button class="flex justify-center items-center mx-1 btn-success" title="Next" type="button"
            onclick="saleNext()">
            <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" viewBox="0 0 24 24">
                <path
                    d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
            </svg>
            <span class="ml-2 text-white">Next</span>
        </button>
    </div>
</div>
