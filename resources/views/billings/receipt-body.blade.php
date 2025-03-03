<div class="mt-4">
    <div class="flex w-full items-center px-10">
        <div class="w-[950px] h-[275px] p-4 border-2 border-black text-sm">
            <div class="flex">
                <label class="w-40">Telah terima dari</label>
                <label>:</label>
                <label class="ml-2 border-b border-dotted w-[650px]"><b>{{ $client->company }}</b></label>
            </div>
            <div class="flex">
                <label class="w-40">Banyaknya Uang</label>
                <label>:</label>
                <label class="ml-2 border-b border-dotted font-semibold italic w-[650px]"># {{ terbilang($grandTotal) }}
                    #</label>
            </div>
            <div class="flex">
                <label class="w-40">Untuk Pembayaran</label>
                <label>:</label>
                <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                    @if (request('rbTerm') && request('rbTerm') == 'autoTerm')
                        {{ $bill_terms[0]->title }} Media Luar Ruang Tahap Ke-
                        @php
                            $totalTerms = 0;
                            $termCollects = [];
                        @endphp
                        @foreach ($bill_terms as $item)
                            @if ($item->set_collect == true)
                                @php
                                    array_push($termCollects, $item);
                                @endphp
                            @endif
                        @endforeach
                        @foreach ($termCollects as $termCollect)
                            @php
                                $totalTerms = $totalTerms + $termCollect->term;
                            @endphp
                            @if (count($termCollects) == 1)
                                {{ $termCollect->number }}
                            @elseif(count($termCollects) == 2)
                                @if ($loop->iteration == count($termCollects))
                                    & {{ $termCollect->number }}
                                @else
                                    {{ $termCollect->number }}
                                @endif
                            @else
                                @if ($loop->iteration == count($termCollects))
                                    & {{ $termCollect->number }}
                                @else
                                    {{ $termCollect->number }},
                                @endif
                            @endif
                        @endforeach
                        ({{ $totalTerms }}%)
                    @elseif (request('rbTerm') && request('rbTerm') == 'manualTerm')
                        @php
                            $totalTerms = 0;
                            $termTypes = [];
                        @endphp
                        @foreach ($bill_terms as $item)
                            @if ($item->set_collect == true)
                                {{ $item->title }},
                            @endif
                        @endforeach Media Luar Ruang Tahap Ke-
                        {{ $bill_terms[0]->number }}
                        ({{ $bill_terms[0]->term }}%)
                    @endif
                </label>
            </div>
            <div class="flex">
                <label class="w-40"></label>
                <label></label>
                <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                    <div class="flex w-full">
                        <span class="w-16">Jenis</span>
                        <span>:</span>
                        <span class="ml-2">{{ $product->category }}</span>
                    </div>
                </label>
            </div>
            <div class="flex">
                <label class="w-40"></label>
                <label></label>
                <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                    <div class="flex w-full">
                        <span class="w-16">Ukuran</span>
                        <span>:</span>
                        <span class="ml-2">{{ $product->size }} x {{ $product->side }} -
                            {{ $product->orientation }}</span>
                    </div>
                </label>
            </div>
            <div class="flex">
                <label class="w-40"></label>
                <label></label>
                <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                    <div class="flex w-full">
                        <span class="w-16">Jumlah</span>
                        <span>:</span>
                        <span class="ml-2">1 (Satu) Unit</span>
                    </div>
                </label>
            </div>
            <div class="flex">
                <label class="w-40"></label>
                <label></label>
                <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                    <div class="flex w-full">
                        <span class="w-16">Periode</span>
                        <span>:</span>
                        <span class="ml-2">
                            {{ $priceTitle }} (
                            {{ date('d', strtotime($sale->start_at)) }}
                            {{ $bulan[(int) date('m', strtotime($sale->start_at))] }}
                            {{ date('Y', strtotime($sale->start_at)) }} s.d
                            {{ date('d', strtotime($sale->end_at)) }}
                            {{ $bulan[(int) date('m', strtotime($sale->end_at))] }}
                            {{ date('Y', strtotime($sale->end_at)) }} )
                        </span>
                    </div>
                </label>
            </div>
            <div class="flex">
                <label class="w-40"></label>
                <label></label>
                <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                    <div class="flex w-full">
                        <span class="w-16">Lokasi</span>
                        <span>:</span>
                        <span class="ml-2 w-[300px]">{{ $product->address }}</span>
                    </div>
                </label>
            </div>
        </div>
    </div>
</div>
