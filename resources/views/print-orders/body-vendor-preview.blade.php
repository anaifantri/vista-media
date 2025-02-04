<div class="h-[330px] mt-4">
    <div class="flex w-full items-center px-10">
        <div class="w-[950px]">
            <label class="flex text-md font-semibold justify-center w-full mt-6"><u>SPK CETAK GAMBAR</u></label>
            <label class="flex text-md text-slate-500 justify-center w-full">{{ $print_order->number }}</label>
            <div class="flex justify-center w-full mt-4">
                <div class="w-[500px] border p-2">
                    <div class="flex">
                        <div class="w-[240px] border rounded-md p-1">
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-20">Tgl. Cetak</label>
                                <label class="flex text-sm text-black">:</label>
                                <label class="flex text-sm border rounded-sm px-1 w-[135px] text-black ml-1">
                                    {{ date('d', strtotime($print_order->print_at)) }}
                                    {{ $bulan[(int) date('m', strtotime($print_order->print_at))] }}
                                    {{ date('Y', strtotime($print_order->print_at)) }}
                                </label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-20">Ukuran</label>
                                <label class="flex text-sm text-black">:</label>
                                <label
                                    class="flex text-sm border rounded-sm px-1 w-[135px] text-black ml-1">{{ $product->location_size }}</label>
                            </div>
                        </div>
                        <div class="w-[240px] border rounded-md p-1 ml-1">
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-14">Bahan</label>
                                <label class="flex text-sm text-black">:</label>
                                <label
                                    class="flex border rounded-sm px-1 w-40 text-sm text-black ml-1">{{ $product->product_name }}</label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-14">Harga</label>
                                <label class="flex text-sm text-black">:</label>
                                <label
                                    class="flex border rounded-sm px-1 w-20 text-sm text-black ml-1">{{ number_format($product->product_price) }}</label>
                                <label class="flex text-sm text-black ml-2">/ m2</label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-14">Jumlah</label>
                                <label class="flex text-sm text-black">:</label>
                                <label
                                    class="flex border rounded-sm px-1 w-20 text-sm text-black ml-1">{{ $product->qty }}</label>
                                <label class="flex text-sm text-black ml-2">lembar</label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-14">Total</label>
                                <label class="flex text-sm text-black">:</label>
                                <label
                                    class="flex border rounded-sm px-1 w-40 text-sm text-black ml-1">{{ number_format($print_order->price) }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-black w-28">Design</label>
                        <label class="flex text-sm text-black">:</label>
                        <label
                            class="flex border rounded-sm px-1 w-[350px] text-sm text-black ml-1">{{ $print_order->theme }}</label>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-black w-28">Finishing</label>
                        <label class="flex text-sm text-black">:</label>
                        <label
                            class="flex border rounded-sm px-1 text-sm text-black ml-1 w-[350px]">{{ $notes->finishing }}</label>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-black w-28">Catatan</label>
                        <label class="flex text-sm text-black">:</label>
                        <label
                            class="flex border rounded-sm w-[350px] ml-1 text-sm text-black px-1 h-16">{{ $notes->note }}</label>
                    </div>
                </div>
                <div class="w-[280px] border ml-2 p-1">
                    <label class="flex text-sm text-black justify-center w-full px-1 font-semibold">Design</label>
                    <div class="flex justify-center items-center border mt-3 p-1">
                        <img class="m-auto flex items-center justify-center max-w-[260px] max-h-[200px]"
                            src="{{ asset('storage/' . $print_order->design) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
