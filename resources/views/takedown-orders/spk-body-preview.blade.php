<div class="h-[470px] mt-4">
    <div class="flex w-full items-center px-10">
        <div class="w-[950px]">
            <label class="flex text-md font-semibold justify-center w-full"><u>SPK PENURUNAN GAMBAR</u></label>
            <label class="flex text-md text-slate-500 justify-center w-full">Nomor : {{ $takedown_order->number }}
            </label>
            <div class="flex justify-center w-full">
                <div class="w-[500px] border p-2">
                    <div class="flex">
                        <div class="w-[240px] border rounded-md p-1">
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-24">Tgl. SPK</label>
                                <label class="flex text-sm text-black">:
                                    {{ date('d', strtotime($takedown_order->created_at)) }}
                                    {{ $bulan[(int) date('m', strtotime($takedown_order->created_at))] }}
                                    {{ date('Y', strtotime($takedown_order->created_at)) }}
                                </label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-24">Design</label>
                                <label class="flex text-sm text-black">: {{ $takedown_order->theme }}</label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-24">Ukuran</label>
                                <label class="flex text-sm text-black">:
                                    {{ $product->size }}
                                </label>
                            </div>
                        </div>
                        <div class="w-[240px] border rounded-md p-1 ml-1">
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-20">Tipe</label>
                                <label class="flex text-sm text-black">: {{ $description->lighting }}</label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-20">Tgl. Turun</label>
                                <label class="flex text-sm text-black">:
                                    {{ date('d', strtotime($takedown_order->takedown_at)) }}
                                    {{ $bulan[(int) date('m', strtotime($takedown_order->takedown_at))] }}
                                    {{ date('Y', strtotime($takedown_order->takedown_at)) }}
                                </label>
                            </div>
                            @if ((int) filter_var($product->side, FILTER_SANITIZE_NUMBER_INT) == 2)
                                <div class="flex mt-1">
                                    <input class="outline-none" type="checkbox" checked>
                                    <label class="flex ml-1 text-sm text-black w-16">Kanan</label>
                                    <input class="ml-2 outline-none" type="checkbox" checked>
                                    <label class="flex ml-1 text-sm text-black w-16">Kiri</label>
                                </div>
                            @else
                                <div hidden>
                                    <input class="outline-none" type="checkbox">
                                    <label class="flex ml-1 text-sm text-black w-16">Kanan</label>
                                    <input class="ml-2 outline-none" type="checkbox" checked>
                                    <label class="flex ml-1 text-sm text-black w-16">Kiri</label>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-black w-14">Catatan</label>
                        <label class="flex text-sm text-black">:</label>
                        <textarea name="notes" placeholder="Input Catatan"
                            class="flex w-[425px] ml-1 text-sm text-black border rounded-sm outline-none px-1" rows="3" readonly>{{ $takedown_order->notes }}</textarea>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-black w-14">Lokasi</label>
                        <label class="flex text-sm text-black">:</label>
                        <label class="flex w-[350px] ml-1 text-sm text-black px-1">{{ $product->address }}</label>
                    </div>
                    <!-- SPK Sign start-->
                    @include('takedown-orders.spk-location-preview')
                    <!-- SPK Sign end-->
                </div>
                <div class="w-[280px] border ml-2 p-1">
                    <label class="flex text-sm text-black justify-center w-full px-1 font-semibold">Design</label>
                    <div class="flex justify-center items-center border mt-3 p-1">
                        @if ($takedown_order->design)
                            <img class="m-auto img-preview flex items-center justify-center max-w-[260px] max-h-[180px]"
                                src="{{ asset('storage/' . $takedown_order->design) }}">
                        @else
                            <img class="m-auto img-preview flex items-center justify-center max-w-[260px] max-h-[180px]"
                                src="/img/product-image.png">
                        @endif
                    </div>
                    <!-- SPK Sign start-->
                    @include('takedown-orders.spk-sign-preview')
                    <!-- SPK Sign end-->
                </div>
            </div>
        </div>
    </div>
</div>
