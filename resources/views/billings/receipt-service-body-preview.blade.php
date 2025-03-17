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
                <label
                    class="ml-2 border-b border-dotted font-semibold italic w-[650px]">{{ $receipt_content->terbilang }}</label>
            </div>
            <div class="flex">
                <label class="w-40">Untuk Pembayaran</label>
                <label>:</label>
                <label class="ml-2 border-b border-dotted font-semibold w-[650px]">{{ $receipt_content->title }}</label>
            </div>
            <div class="flex">
                <label class="w-40"></label>
                <label></label>
                <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                    <div class="flex w-full">
                        <span class="w-16">Jenis</span>
                        <span>:</span>
                        <span class="ml-2">{{ $receipt_content->type }}</span>
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
                        <span class="ml-2">{{ $receipt_content->size }}</span>
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
                        <span class="ml-2">{{ $receipt_content->qty }}</span>
                    </div>
                </label>
            </div>
            <div class="flex">
                <label class="w-40"></label>
                <label></label>
                <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                    <div class="flex w-full">
                        @if ($category == 'Service')
                            <span class="w-16">Tema</span>
                            <span>:</span>
                            <label
                                class="ml-2 border-b border-dotted font-semibold">{{ $receipt_content->theme }}</label>
                        @elseif ($category == 'Media')
                            <span class="w-16">Periode</span>
                            <span>:</span>
                            <label
                                class="ml-2 border-b border-dotted font-semibold">{{ $receipt_content->periode }}</label>
                        @endif
                    </div>
                </label>
            </div>
            @if ($category == 'Media')
                <div class="flex">
                    <label class="w-40"></label>
                    <label></label>
                    <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                        <div class="flex w-full">
                            <span class="w-16">Lokasi</span>
                            <span>:</span>
                            <span class="ml-2">{{ $receipt_content->location }}</span>
                        </div>
                    </label>
                </div>
            @elseif($category == 'Service')
                @if (count($invoice_descriptions) < 5)
                    @foreach ($invoice_descriptions as $item)
                        <div class="flex">
                            <label class="w-40"></label>
                            <label></label>
                            @if ($loop->iteration == 1)
                                <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                                    <div class="flex w-full">
                                        <span class="w-16">Lokasi</span>
                                        <span>:</span>
                                        <span class="ml-2">{{ $loop->iteration }}. {{ $item->location }}
                                        </span>
                                    </div>
                                </label>
                            @else
                                <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                                    <div class="flex w-full">
                                        <span class="w-16"></span>
                                        <span></span>
                                        <span class="ml-3">
                                            {{ $loop->iteration }}. {{ $item->location }}
                                        </span>
                                    </div>
                                </label>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="flex">
                        <label class="w-40"></label>
                        <label></label>
                        <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                            <div class="flex w-full">
                                <span class="w-16">Lokasi</span>
                                <span>:</span>
                                <span class="ml-2">Tertera pada invoice nomor :
                                </span>
                            </div>
                        </label>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
