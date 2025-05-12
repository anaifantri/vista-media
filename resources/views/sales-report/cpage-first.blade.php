@if ($loop->iteration < 9)
    <tr>
        <td class="text-black border text-[0.65rem] text-center align-top">
            {{ $loop->iteration }}</td>
        <td class="text-black border text-[0.65rem] text-start align-top">
            <div>
                <div class="flex ml-1">
                    <label class="w-10">No.</label>
                    <label>:</label>
                    <a href="/marketing/sales/{{ $sale->id }}" class="ml-1 w-32">{{ $sale->number }}</a>
                </div>
                <div class="flex ml-1">
                    <label class="w-10">Tgl.</label>
                    <label>:</label>
                    <label class="ml-1 w-32">{{ date('d-M-Y', strtotime($sale->created_at)) }}</label>
                </div>
                <div class="flex ml-1">
                    <label class="w-10">Oleh</label>
                    <label>:</label>
                    <label class="ml-1 w-32">{{ $created_by->name }}</label>
                </div>
                <div class="flex ml-1">
                    <label class="w-10">Kode</label>
                    <label>:</label>
                    <a href="/media/locations/preview/{{ $product->category }}/{{ $product->id }}"
                        class="ml-1">{{ $product->code }} -
                        {{ $product->city_code }}</a>
                </div>
                <div class="flex ml-1">
                    <label class="w-10">Lokasi</label>
                    <label>:</label>
                    <label class="ml-1">
                        {{ $product->address }}
                    </label>
                </div>
                <div class="flex ml-1">
                    <label class="w-10">Size</label>
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
        <td class="text-black border text-[0.65rem] text-start align-top">
            <div>
                <div class="flex ml-1">
                    <label class="w-10">Klien</label>
                    <label>:</label>
                    <a href="/marketing/clients/{{ $clients->id }}" class="ml-1 w-28">{{ $clients->name }}</a>
                </div>
                @if ($clients->type == 'Perusahaan')
                    <div class="flex ml-1">
                        <label class="w-10">Kontak</label>
                        <label>:</label>
                        <label class="ml-1 w-28">{{ $clients->contact_name }}</label>
                    </div>
                @endif
                <div class="flex ml-1">
                    <label class="w-10">Jenis</label>
                    <label>:</label>
                    @if ($sale->media_category->name == 'Service')
                        <label class="ml-1 w-28">Cetak /
                            Pasang</label>
                    @else
                        <label class="ml-1 w-28">{{ $sale->media_category->name }}</label>
                    @endif
                </div>
                @if ($sale->media_category->name != 'Service')
                    <div class="flex ml-1">
                        <label class="w-10">Periode</label>
                        <label>:</label>
                        <label class="ml-1 w-28">{{ $sale->duration }}</label>
                    </div>
                    <div class="flex ml-1">
                        <label class="w-10">Awal</label>
                        <label>:</label>
                        @if ($sale->start_at)
                            <label class="ml-1  w-28">{{ date('d-M-Y', strtotime($sale->start_at)) }}</label>
                        @else
                            <label class="ml-1 w-28">-</label>
                        @endif
                    </div>
                    <div class="flex ml-1">
                        <label class="w-10">Akhir</label>
                        <label>:</label>
                        @if ($sale->end_at)
                            <label class="ml-1 w-28">{{ date('d-M-Y', strtotime($sale->end_at)) }}</label>
                        @else
                            <label class="ml-1 w-28">-</label>
                        @endif
                    </div>
                @endif
            </div>
        </td>
        <td class="text-black border text-[0.65rem] text-start align-top">
            <div>
                <div class="flex ml-1">
                    <label class="w-14">No.</label>
                    <label>:</label>
                    @if ($quotId != null)
                        <a href="/marketing/quotations/{{ $quotId }}"
                            class="ml-1">{{ Str::substr($number, 0, 10) }}..</a>
                    @elseif($quotRevisionId != null)
                        <a href="/marketing/quotation-revisions/{{ $quotRevisionId }}"
                            class="ml-1">{{ Str::substr($number, 0, 10) }}..</a>
                    @endif
                </div>
                <div class="flex ml-1">
                    <label class="w-14">Tgl.</label>
                    <label>:</label>
                    <label class="ml-1">{{ date('d-M-Y', strtotime($created_at)) }}</label>
                </div>
                @if (
                    ($sale->media_category->name != 'Videotron' && $sale->media_category->name != 'Service') ||
                        ($sale->media_category->name == 'Signage' && $description->type != 'Videotron'))
                    <div class="flex ml-1">
                        <label class="w-14">Free Cetak</label>
                        <label>:</label>
                        <label class="ml-1">
                            @if ($notes->freePrint)
                                {{ $notes->freePrint }} x
                            @else
                                -
                            @endif
                        </label>
                    </div>
                    <div class="flex ml-1">
                        <label class="w-14">Free Pasang</label>
                        <label>:</label>
                        <label class="ml-1">
                            @if ($notes->freeInstall)
                                {{ $notes->freeInstall }} x
                            @else
                                -
                            @endif
                        </label>
                    </div>
                @endif
            </div>
        </td>
        <td class="text-black border text-[0.65rem] text-start align-top px-1">
            <div>
                <div class="flex ml-1">
                    @if ($sale->void_sale)
                        @if (count($voidSale) == 2)
                            @if ($loop->iteration < count($sales))
                                @if ($sale->id == $sales[$loop->iteration]->id)
                                    <label class="w-12">Harga</label>
                                    <label>:</label>
                                    <label class="ml-1 w-16 text-right">{{ number_format($sale->price) }}</label>
                                @else
                                    <label class="w-12 text-red-800">Total</label>
                                    <label>:</label>
                                    <label
                                        class="ml-1 w-16 text-right text-red-800">({{ number_format($sale->price + $sale->dpp * ($sale->ppn / 100)) }})</label>
                                @endif
                            @else
                                <label class="w-12 text-red-800">Total</label>
                                <label>:</label>
                                <label
                                    class="ml-1 w-16 text-right text-red-800">({{ number_format($sale->price + $sale->dpp * ($sale->ppn / 100)) }})</label>
                            @endif
                        @else
                            @if (date('m', strtotime($sale->created_at)) == request('month'))
                                <label class="w-12">Harga</label>
                                <label>:</label>
                                <label class="ml-1 w-16 text-right">{{ number_format($sale->price) }}</label>
                            @else
                                <label class="w-12 text-red-800">Total</label>
                                <label>:</label>
                                <label
                                    class="ml-1 w-16 text-right text-red-800">({{ number_format($sale->price + $sale->dpp * ($sale->ppn / 100)) }})</label>
                            @endif
                        @endif
                    @elseif ($sale->change_sale)
                        @if (count($changeSale) == 2)
                            @if ($loop->iteration < count($sales))
                                @if ($sale->id == $sales[$loop->iteration]->id)
                                    <label class="w-12">Harga</label>
                                    <label>:</label>
                                    <label class="ml-1 w-16 text-right">{{ number_format($sale->price) }}</label>
                                @else
                                    <label class="w-12 text-red-700">Selisih</label>
                                    <label>:</label>
                                    <label
                                        class="ml-1 w-16 text-right text-red-700">{{ number_format($sale->change_sale->price_diff) }}</label>
                                @endif
                            @else
                                <label class="w-12 text-red-700">Selisih</label>
                                <label>:</label>
                                <label
                                    class="ml-1 w-16 text-right text-red-700">{{ number_format($sale->change_sale->price_diff) }}</label>
                            @endif
                        @else
                            @if (date('m', strtotime($sale->created_at)) == request('month'))
                                <label class="w-12">Harga</label>
                                <label>:</label>
                                <label class="ml-1 w-16 text-right">{{ number_format($sale->price) }}</label>
                            @else
                                <label class="w-12 text-red-700">Selisih</label>
                                <label>:</label>
                                <label
                                    class="ml-1 w-16 text-right text-red-700">{{ number_format($sale->change_sale->price_diff) }}</label>
                            @endif
                        @endif
                    @else
                        <label class="w-12">Harga</label>
                        <label>:</label>
                        <label class="ml-1 w-16 text-right">{{ number_format($sale->price) }}</label>
                    @endif
                </div>
                @if ($sale->void_sale)
                    @if (count($voidSale) == 2)
                        @if ($loop->iteration < count($sales))
                            @if ($sale->id == $sales[$loop->iteration]->id)
                                @if ($sale->dpp != $sale->price)
                                    <div class="flex ml-1">
                                        <label class="w-12">DPP</label>
                                        <label>:</label>
                                        <label class="ml-1 w-16 text-right">
                                            {{ number_format($sale->dpp) }}
                                        </label>
                                    </div>
                                @endif
                                <div class="flex ml-1">
                                    <label class="w-12">PPN
                                        {{-- {{ $sale->ppn }} % --}}
                                    </label>
                                    <label>:</label>
                                    <label class="ml-1 w-16 text-right">
                                        {{ number_format($sale->dpp * ($sale->ppn / 100)) }}
                                    </label>
                                </div>
                                <div class="flex ml-1">
                                    @if ($sale->pph)
                                        <label class="w-12">PPh
                                            {{-- {{ $sale->pph }} % --}}
                                        </label>
                                    @else
                                        <label class="w-12">PPh</label>
                                    @endif
                                    <label>:</label>
                                    <label class="ml-1 w-16 text-right">
                                        {{ number_format($sale->dpp * ($sale->pph / 100)) }}
                                    </label>
                                </div>
                                <div class="flex ml-1 border-t">
                                    <label class="w-12">Total</label>
                                    <label>:</label>
                                    <label class="ml-1 w-16 text-right">
                                        {{ number_format($sale->price + $sale->dpp * ($sale->ppn / 100) - $sale->dpp * ($sale->pph / 100)) }}
                                    </label>
                                </div>
                            @else
                                <div class="flex px-1 mt-2 font-semibold text-red-700 border-b border-red-700">
                                    Pembatalan
                                </div>
                                <div class="flex px-1 text-red-700 w-full text-justify">
                                    {{ $sale->void_sale->note }}
                                </div>
                            @endif
                        @else
                            <div class="flex px-1 mt-2 font-semibold text-red-700 border-b border-red-700">
                                Pembatalan
                            </div>
                            <div class="flex px-1 text-red-700 w-full text-justify">
                                {{ $sale->void_sale->note }}
                            </div>
                        @endif
                    @else
                        @if (date('m', strtotime($sale->created_at)) == request('month'))
                            @if ($sale->dpp != $sale->price)
                                <div class="flex ml-1">
                                    <label class="w-12">DPP</label>
                                    <label>:</label>
                                    <label class="ml-1 w-16 text-right">
                                        {{ number_format($sale->dpp) }}
                                    </label>
                                </div>
                            @endif
                            <div class="flex ml-1">
                                <label class="w-12">PPN
                                    {{-- {{ $sale->ppn }} % --}}
                                </label>
                                <label>:</label>
                                <label class="ml-1 w-16 text-right">
                                    {{ number_format($sale->dpp * ($sale->ppn / 100)) }}
                                </label>
                            </div>
                            <div class="flex ml-1">
                                @if ($sale->pph)
                                    <label class="w-12">PPh
                                        {{-- {{ $sale->pph }} % --}}
                                    </label>
                                @else
                                    <label class="w-12">PPh</label>
                                @endif
                                <label>:</label>
                                <label class="ml-1 w-16 text-right">
                                    {{ number_format($sale->dpp * ($sale->pph / 100)) }}
                                </label>
                            </div>
                            <div class="flex ml-1 border-t">
                                <label class="w-12">Total</label>
                                <label>:</label>
                                <label class="ml-1 w-16 text-right">
                                    {{ number_format($sale->price + $sale->dpp * ($sale->ppn / 100) - $sale->dpp * ($sale->pph / 100)) }}
                                </label>
                            </div>
                        @else
                            <div class="flex px-1 mt-2 font-semibold text-red-700 border-b border-red-700">
                                Pembatalan
                            </div>
                            <div class="flex px-1 text-red-700 w-full text-justify">
                                {{ $sale->void_sale->note }}
                            </div>
                        @endif
                    @endif
                @elseif ($sale->change_sale)
                    @if (count($changeSale) == 2)
                        @if ($loop->iteration < count($sales))
                            @if ($sale->id == $sales[$loop->iteration]->id)
                                @if ($sale->dpp != $sale->price)
                                    <div class="flex ml-1">
                                        <label class="w-12">DPP</label>
                                        <label>:</label>
                                        <label class="ml-1 w-16 text-right">
                                            {{ number_format($sale->dpp) }}
                                        </label>
                                    </div>
                                @endif
                                <div class="flex ml-1">
                                    <label class="w-12">PPN
                                        {{-- {{ $sale->ppn }} % --}}
                                    </label>
                                    <label>:</label>
                                    <label class="ml-1 w-16 text-right">
                                        {{ number_format($sale->dpp * ($sale->ppn / 100)) }}
                                    </label>
                                </div>
                                <div class="flex ml-1">
                                    @if ($sale->pph)
                                        <label class="w-12">PPh
                                            {{-- {{ $sale->pph }} % --}}
                                        </label>
                                    @else
                                        <label class="w-12">PPh</label>
                                    @endif
                                    <label>:</label>
                                    <label class="ml-1 w-16 text-right">
                                        {{ number_format($sale->dpp * ($sale->pph / 100)) }}
                                    </label>
                                </div>
                                <div class="flex ml-1 border-t">
                                    <label class="w-12">Total</label>
                                    <label>:</label>
                                    <label class="ml-1 w-16 text-right">
                                        {{ number_format($sale->price + $sale->dpp * ($sale->ppn / 100) - $sale->dpp * ($sale->pph / 100)) }}
                                    </label>
                                </div>
                            @else
                                <div class="flex ml-1 text-red-700">
                                    <label class="w-12">PPN</label>
                                    <label>:</label>
                                    <label class="ml-1 w-16 text-right">
                                        {{ number_format($sale->change_sale->ppn_diff) }}
                                    </label>
                                </div>
                                <div class="flex px-1 mt-2 font-semibold text-red-700 border-b border-red-700">
                                    Perubahan
                                </div>
                                <div class="flex w-full px-1 text-red-700">
                                    {{ $sale->change_sale->note }}
                                </div>
                            @endif
                        @else
                            <div class="flex ml-1 text-red-700">
                                <label class="w-12">PPN</label>
                                <label>:</label>
                                <label class="ml-1 w-16 text-right">
                                    {{ number_format($sale->change_sale->ppn_diff) }}
                                </label>
                            </div>
                            <div class="flex px-1 mt-2 font-semibold text-red-700 border-b border-red-700">
                                Perubahan
                            </div>
                            <div class="flex w-full px-1 text-red-700">
                                {{ $sale->change_sale->note }}
                            </div>
                        @endif
                    @else
                        @if (date('m', strtotime($sale->created_at)) == request('month'))
                            @if ($sale->dpp != $sale->price)
                                <div class="flex ml-1">
                                    <label class="w-12">DPP</label>
                                    <label>:</label>
                                    <label class="ml-1 w-16 text-right">
                                        {{ number_format($sale->dpp) }}
                                    </label>
                                </div>
                            @endif
                            <div class="flex ml-1">
                                <label class="w-12">PPN
                                    {{-- {{ $sale->ppn }} % --}}
                                </label>
                                <label>:</label>
                                <label class="ml-1 w-16 text-right">
                                    {{ number_format($sale->dpp * ($sale->ppn / 100)) }}
                                </label>
                            </div>
                            <div class="flex ml-1">
                                @if ($sale->pph)
                                    <label class="w-12">PPh
                                        {{-- {{ $sale->pph }} % --}}
                                    </label>
                                @else
                                    <label class="w-12">PPh</label>
                                @endif
                                <label>:</label>
                                <label class="ml-1 w-16 text-right">
                                    {{ number_format($sale->dpp * ($sale->pph / 100)) }}
                                </label>
                            </div>
                            <div class="flex ml-1 border-t">
                                <label class="w-12">Total</label>
                                <label>:</label>
                                <label class="ml-1 w-16 text-right">
                                    {{ number_format($sale->price + $sale->dpp * ($sale->ppn / 100) - $sale->dpp * ($sale->pph / 100)) }}
                                </label>
                            </div>
                        @else
                            <div class="flex ml-1 text-red-700">
                                <label class="w-12">PPN</label>
                                <label>:</label>
                                <label class="ml-1 w-16 text-right">
                                    {{ number_format($sale->change_sale->ppn_diff) }}
                                </label>
                            </div>
                            <div class="flex px-1 mt-2 font-semibold text-red-700 border-b border-red-700">
                                Perubahan
                            </div>
                            <div class="flex w-full px-1 text-red-700">
                                {{ $sale->change_sale->note }}
                            </div>
                        @endif
                    @endif
                @else
                    @if ($sale->dpp != $sale->price)
                        <div class="flex ml-1">
                            <label class="w-12">DPP</label>
                            <label>:</label>
                            <label class="ml-1 w-16 text-right">
                                {{ number_format($sale->dpp) }}
                            </label>
                        </div>
                    @endif
                    <div class="flex ml-1">
                        <label class="w-12">PPN
                            {{-- {{ $sale->ppn }} % --}}
                        </label>
                        <label>:</label>
                        <label class="ml-1 w-16 text-right">
                            {{ number_format($sale->dpp * ($sale->ppn / 100)) }}
                        </label>
                    </div>
                    <div class="flex ml-1">
                        @if ($sale->pph)
                            <label class="w-12">PPh
                                {{-- {{ $sale->pph }} % --}}
                            </label>
                        @else
                            <label class="w-12">PPh</label>
                        @endif
                        <label>:</label>
                        <label class="ml-1 w-16 text-right">
                            {{ number_format($sale->dpp * ($sale->pph / 100)) }}
                        </label>
                    </div>
                    <div class="flex ml-1 border-t">
                        <label class="w-12">Total</label>
                        <label>:</label>
                        <label class="ml-1 w-16 text-right">
                            {{ number_format($sale->price + $sale->dpp * ($sale->ppn / 100) - $sale->dpp * ($sale->pph / 100)) }}
                        </label>
                    </div>
                @endif
            </div>
        </td>
        @if ($sale->void_sale)
            @if ($loop->iteration < count($sales))
                @if ($sale->id == $sales[$loop->iteration]->id)
                    <td class="text-black border text-[0.65rem] text-center align-top">
                        <div>
                            @foreach ($payment_terms->dataPayments as $terms)
                                <div class="flex ml-1 justify-center">
                                    <label>{{ $terms->term }} %</label>
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td class="text-black border text-[0.65rem] text-center align-top">
                        <div>
                            @foreach ($payment_terms->dataPayments as $terms)
                                <div class="flex mr-1 justify-end">
                                    <label>{{ number_format($sale->price * ($terms->term / 100)) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td class="text-black border text-[0.65rem] text-center align-top">
                        <div>
                            @foreach ($payment_terms->dataPayments as $terms)
                                <div class="flex mr-1 justify-end">
                                    <label>{{ number_format($sale->dpp * ($terms->term / 100) * ($sale->ppn / 100)) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td class="text-black border text-[0.65rem] text-center align-top">
                        <div>
                            @foreach ($payment_terms->dataPayments as $terms)
                                <div class="flex mr-1 justify-end">
                                    <label>{{ number_format($sale->dpp * ($terms->term / 100) * ($sale->pph / 100)) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td class="text-black border text-[0.65rem] text-center align-top">
                        <div>
                            @foreach ($payment_terms->dataPayments as $terms)
                                <div class="flex mr-1 justify-end">
                                    @if ($sale->dpp)
                                        @php
                                            $subTotal = $sale->price * ($terms->term / 100);
                                            $ppnTerm = $sale->dpp * ($terms->term / 100) * ($sale->ppn / 100);
                                            $pphTerm = $sale->dpp * ($terms->term / 100) * ($sale->pph / 100);
                                        @endphp
                                        <label>{{ number_format($subTotal + $ppnTerm - $pphTerm) }}</label>
                                    @else
                                        <label>{{ number_format($sale->price * ($terms->term / 100)) }}</label>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </td>
                @else
                    <td class="text-black border text-[0.65rem] text-center align-top">
                    </td>
                    <td class="text-black border text-[0.65rem] text-center align-top">
                    </td>
                    <td class="text-black border text-[0.65rem] text-center align-top">
                    </td>
                    <td class="text-black border text-[0.65rem] text-center align-top">
                    </td>
                    <td class="text-black border text-[0.65rem] text-center align-top">
                    </td>
                @endif
            @else
                <td class="text-black border text-[0.65rem] text-center align-top">
                </td>
                <td class="text-black border text-[0.65rem] text-center align-top">
                </td>
                <td class="text-black border text-[0.65rem] text-center align-top">
                </td>
                <td class="text-black border text-[0.65rem] text-center align-top">
                </td>
                <td class="text-black border text-[0.65rem] text-center align-top">
                </td>
            @endif
        @elseif ($sale->change_sale)
            @if ($loop->iteration < count($sales))
                @if ($sale->id == $sales[$loop->iteration]->id)
                    <td class="text-black border text-[0.65rem] text-center align-top">
                        <div>
                            @foreach ($payment_terms->dataPayments as $terms)
                                <div class="flex ml-1 justify-center">
                                    <label>{{ $terms->term }} %</label>
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td class="text-black border text-[0.65rem] text-center align-top">
                        <div>
                            @foreach ($payment_terms->dataPayments as $terms)
                                <div class="flex mr-1 justify-end">
                                    <label>{{ number_format($sale->price * ($terms->term / 100)) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td class="text-black border text-[0.65rem] text-center align-top">
                        <div>
                            @foreach ($payment_terms->dataPayments as $terms)
                                <div class="flex mr-1 justify-end">
                                    <label>{{ number_format($sale->dpp * ($terms->term / 100) * ($sale->ppn / 100)) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td class="text-black border text-[0.65rem] text-center align-top">
                        <div>
                            @foreach ($payment_terms->dataPayments as $terms)
                                <div class="flex mr-1 justify-end">
                                    <label>{{ number_format($sale->dpp * ($terms->term / 100) * ($sale->pph / 100)) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td class="text-black border text-[0.65rem] text-center align-top">
                        <div>
                            @foreach ($payment_terms->dataPayments as $terms)
                                <div class="flex mr-1 justify-end">
                                    @if ($sale->dpp)
                                        @php
                                            $subTotal = $sale->price * ($terms->term / 100);
                                            $ppnTerm = $sale->dpp * ($terms->term / 100) * ($sale->ppn / 100);
                                            $pphTerm = $sale->dpp * ($terms->term / 100) * ($sale->pph / 100);
                                        @endphp
                                        <label>{{ number_format($subTotal + $ppnTerm - $pphTerm) }}</label>
                                    @else
                                        <label>{{ number_format($sale->price * ($terms->term / 100)) }}</label>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </td>
                @else
                    <td class="text-black border text-[0.65rem] text-center align-top">
                    </td>
                    <td class="text-black border text-[0.65rem] text-center align-top">
                    </td>
                    <td class="text-black border text-[0.65rem] text-center align-top">
                    </td>
                    <td class="text-black border text-[0.65rem] text-center align-top">
                    </td>
                    <td class="text-black border text-[0.65rem] text-center align-top">
                    </td>
                @endif
            @else
                <td class="text-black border text-[0.65rem] text-center align-top">
                </td>
                <td class="text-black border text-[0.65rem] text-center align-top">
                </td>
                <td class="text-black border text-[0.65rem] text-center align-top">
                </td>
                <td class="text-black border text-[0.65rem] text-center align-top">
                </td>
                <td class="text-black border text-[0.65rem] text-center align-top">
                </td>
            @endif
        @else
            <td class="text-black border text-[0.65rem] text-center align-top">
                <div>
                    @foreach ($payment_terms->dataPayments as $terms)
                        <div class="flex ml-1 justify-center">
                            <label>{{ $terms->term }} %</label>
                        </div>
                    @endforeach
                </div>
            </td>
            <td class="text-black border text-[0.65rem] text-center align-top">
                <div>
                    @foreach ($payment_terms->dataPayments as $terms)
                        <div class="flex mr-1 justify-end">
                            <label>{{ number_format($sale->price * ($terms->term / 100)) }}</label>
                        </div>
                    @endforeach
                </div>
            </td>
            <td class="text-black border text-[0.65rem] text-center align-top">
                <div>
                    @foreach ($payment_terms->dataPayments as $terms)
                        <div class="flex mr-1 justify-end">
                            <label>{{ number_format($sale->dpp * ($terms->term / 100) * ($sale->ppn / 100)) }}</label>
                        </div>
                    @endforeach
                </div>
            </td>
            <td class="text-black border text-[0.65rem] text-center align-top">
                <div>
                    @foreach ($payment_terms->dataPayments as $terms)
                        <div class="flex mr-1 justify-end">
                            <label>{{ number_format($sale->dpp * ($terms->term / 100) * ($sale->pph / 100)) }}</label>
                        </div>
                    @endforeach
                </div>
            </td>
            <td class="text-black border text-[0.65rem] text-center align-top">
                <div>
                    @foreach ($payment_terms->dataPayments as $terms)
                        <div class="flex mr-1 justify-end">
                            @if ($sale->dpp)
                                @php
                                    $subTotal = $sale->price * ($terms->term / 100);
                                    $ppnTerm = $sale->dpp * ($terms->term / 100) * ($sale->ppn / 100);
                                    $pphTerm = $sale->dpp * ($terms->term / 100) * ($sale->pph / 100);
                                @endphp
                                <label>{{ number_format($subTotal + $ppnTerm - $pphTerm) }}</label>
                            @else
                                <label>{{ number_format($sale->price * ($terms->term / 100)) }}</label>
                            @endif
                        </div>
                    @endforeach
                </div>
            </td>
        @endif
        <td class="text-black border text-[0.65rem] text-center align-top">
            <div>
                @foreach ($saleBillings as $itemBilling)
                    <a
                        href="/accounting/billings/{{ $itemBilling->id }}">{{ substr($itemBilling->invoice_number, 0, 3) }}/...-{{ substr($itemBilling->invoice_number, -4) }}</a>
                @endforeach
            </div>
        </td>
        <td class="text-black border text-[0.65rem] text-center align-top">
            <div>
                @foreach ($saleBillings as $itemBilling)
                    <span>{{ date('d', strtotime($itemBilling->created_at)) }}-{{ $sMonth[(int) date('m', strtotime($itemBilling->created_at))] }}-{{ date('Y', strtotime($itemBilling->created_at)) }}</span>
                @endforeach
            </div>
        </td>
        <td class="text-black border text-[0.65rem] text-center align-top">
            <div>
                @if ($sale->media_category->name == 'Service')
                    @foreach ($saleBillings as $itemBilling)
                        @foreach (json_decode($itemBilling->invoice_content)->description as $itemDescription)
                            @if ($itemDescription->sale_id == $sale->id)
                                {{ number_format($itemDescription->nominal + ($sale->ppn / 100) * $itemDescription->nominal) }}
                            @endif
                        @endforeach
                    @endforeach
                @else
                    @foreach ($saleBillings as $itemBilling)
                        @if (isset(json_decode($itemBilling->invoice_content)->manual_detail))
                            {{ number_format($itemBilling->nominal + $itemBilling->ppn) }}
                        @elseif (isset(json_decode($itemBilling->invoice_content)->data_sales))
                            @foreach (json_decode($itemBilling->invoice_content)->data_sales as $itemSales)
                                @if ($itemSales->id == $sale->id)
                                    {{ number_format($itemSales->nominal + ($sale->ppn / 100) * $itemSales->nominal) }}
                                @endif
                            @endforeach
                        @else
                            @foreach (json_decode($itemBilling->invoice_content)->description as $itemDesc)
                                @if ($itemDesc->sale_id == $sale->id)
                                    {{ number_format($itemDesc->nominal + ($sale->ppn / 100) * $itemDesc->nominal) }}
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @endif
            </div>
        </td>
        <td class="text-black border text-[0.65rem] text-center align-top">
            <div>
                @foreach ($saleBillings as $itemBilling)
                    Unpaid
                @endforeach
            </div>
        </td>
        <td class="text-black border text-[0.65rem] text-center align-top">
        </td>
    </tr>
@endif
