<div class="mt-4">
    <div class="flex w-full items-center px-10">
        <div class="w-[950px] h-[275px] p-4 border-2 border-black text-sm">
            <div class="flex">
                <label class="w-40">Telah terima dari</label>
                <label>:</label>
                <label id="receiptCompany" class="ml-2 border-b border-dotted w-[650px]"><b>
                        @if ($client->type == 'Perusahaan')
                            {{ $bill_client->company }}
                        @else
                            {{ $client->name }}
                        @endif
                    </b></label>
            </div>
            <div class="flex">
                <label class="w-40">Banyaknya Uang</label>
                <label>:</label>
                <label
                    class="ml-2 border-b border-dotted font-semibold italic w-[650px]">{{ $receipt_description->terbilang }}</label>
            </div>
            <div class="flex">
                <label class="w-40">Untuk Pembayaran</label>
                <label>:</label>
                <input class="w-[650px] ml-1 px-1 text-sm outline-none border rounded-md font-semibold"
                    name="receipt_title" type="text" value="{{ $receipt_description->title }}"
                    onchange="changeReceiptTitle(this)">
            </div>
            <div class="flex">
                <label class="w-40"></label>
                <label></label>
                <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                    <div class="flex w-full">
                        <span class="w-16">Jenis</span>
                        <span>:</span>
                        <span class="ml-2">{{ $receipt_description->type }}</span>
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
                        <span class="ml-2">{{ $receipt_description->size }}</span>
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
                        <span class="ml-2">{{ $receipt_description->qty }}</span>
                    </div>
                </label>
            </div>
            <div class="flex">
                <label class="w-40"></label>
                <label></label>
                <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                    <div class="flex w-full">
                        <span class="w-16">Tema</span>
                        <span>:</span>
                        <input class="w-[580px] ml-1 px-1 text-sm outline-none border rounded-md font-semibold"
                            name="receipt_theme" type="text" value="{{ $receipt_description->theme }}"
                            onchange="changeReceiptTheme(this)">
                    </div>
                </label>
            </div>
            @if (count($invoice_descriptions) < 4)
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
                            <span class="ml-2">Tertera pada invoice
                            </span>
                        </div>
                    </label>
                </div>
            @endif
        </div>
    </div>
</div>
