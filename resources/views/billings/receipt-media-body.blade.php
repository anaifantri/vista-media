@if ($merge == 'normal')
    <div class="mt-4">
        <div class="flex w-full items-center px-10">
            <div class="w-[950px] h-[275px] p-4 border-2 border-black text-sm">
                <div class="flex">
                    <label class="w-40">Telah terima dari</label>
                    <label>:</label>
                    <label id="receiptCompany"
                        class="ml-2 border-b border-dotted w-[650px]"><b>{{ $client->company }}</b></label>
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
                    <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                        <input class="w-[650px] px-1 text-sm outline-none border rounded-md font-semibold"
                            name="receipt_title" type="text" value="{{ $receipt_content->title }}"
                            onchange="changeReceiptTitle(this)">
                    </label>
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
                            <span id="receiptSize" class="ml-2">{{ $receipt_content->size }}</span>
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
                            <span id="receiptQty" class="ml-2">{{ $receipt_content->qty }}</span>
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
                            <span class="ml-2">{{ $receipt_content->periode }}</span>
                        </div>
                    </label>
                </div>
                @if (count($receipt_content->locations) > 1)
                    @if (count($receipt_content->locations) > 4)
                        <div class="flex">
                            <label class="w-40"></label>
                            <label></label>
                            <div class="flex ml-2 border-b border-dotted font-semibold w-[650px]">
                                <span class="w-16">Lokasi</span>
                                <span>: </span>
                                <span class="ml-2 w-[580px]">Tertera pada invoice</span>
                            </div>
                        </div>
                    @else
                        @foreach ($receipt_content->locations as $itemLocation)
                            @if ($loop->iteration == 1)
                                <div class="flex">
                                    <label class="w-40"></label>
                                    <label></label>
                                    <div class="flex ml-2 border-b border-dotted font-semibold w-[650px]">
                                        <span class="w-16">Lokasi</span>
                                        <span>: </span>
                                        <span class="ml-2 w-[580px]">{{ $loop->iteration }}. {{ $itemLocation }}</span>
                                    </div>
                                </div>
                            @else
                                <div class="flex">
                                    <label class="w-40"></label>
                                    <label></label>
                                    <div class="flex ml-2 border-b border-dotted font-semibold w-[650px]">
                                        <span class="w-16"></span>
                                        <span></span>
                                        <span class="ml-3 w-[580px]">{{ $loop->iteration }}. {{ $itemLocation }}</span>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                @else
                    <div class="flex">
                        <label class="w-40"></label>
                        <label></label>
                        <div class="flex ml-2 border-b border-dotted font-semibold w-[650px]">
                            <span class="w-16">Lokasi</span>
                            <span>: </span>
                            <span class="ml-2 w-[580px]">{{ $receipt_content->locations[0] }}</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@else
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
                    <label class="ml-2 border-b border-dotted font-semibold w-[650px]">
                        <input class="w-[650px] px-1 text-sm outline-none border rounded-md font-semibold"
                            name="receipt_title" type="text" value="{{ $invoice_content->description[0]->title }}"
                            onchange="changeReceiptTitle(this)">
                    </label>
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
                            <span id="receiptSize" class="ml-2">{{ $receipt_content->size }}</span>
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
                            <span id="receiptQty" class="ml-2">{{ $receipt_content->qty }}</span>
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
                            <span class="ml-2">{{ $receipt_content->periode }}</span>
                        </div>
                    </label>
                </div>
                @if (count($receipt_content->locations) > 1)
                    @foreach ($receipt_content->locations as $itemLocation)
                        @if ($loop->iteration == 1)
                            <div class="flex">
                                <label class="w-40"></label>
                                <label></label>
                                <div class="flex ml-2 border-b border-dotted font-semibold w-[650px]">
                                    <span class="w-16">Lokasi</span>
                                    <span>: </span>
                                    <span class="ml-2 w-[580px]">{{ $loop->iteration }}. {{ $itemLocation }}</span>
                                </div>
                            </div>
                        @else
                            <div class="flex">
                                <label class="w-40"></label>
                                <label></label>
                                <div class="flex ml-2 border-b border-dotted font-semibold w-[650px]">
                                    <span class="w-16"></span>
                                    <span></span>
                                    <span class="ml-3 w-[580px]">{{ $loop->iteration }}. {{ $itemLocation }}</span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="flex">
                        <label class="w-40"></label>
                        <label></label>
                        <div class="flex ml-2 border-b border-dotted font-semibold w-[650px]">
                            <span class="w-16">Lokasi</span>
                            <span>: </span>
                            <span class="ml-2 w-[580px]">{{ $receipt_content->locations[0] }}</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif
