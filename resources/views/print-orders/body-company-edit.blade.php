<div class="h-[310px] mt-4">
    <div class="flex w-full items-center px-10">
        <div class="w-[950px]">
            <label class="flex text-md font-semibold justify-center w-full mt-2"><u>SPK CETAK GAMBAR</u></label>
            <label class="flex text-md text-slate-500 justify-center w-full">{{ $print_orders->number }}</label>
            <div class="flex justify-center w-full mt-2">
                <div class="w-[500px] border p-2">
                    <div class="flex">
                        <div class="w-[240px] border rounded-md p-1">
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Tgl. SPK</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <label class="flex text-sm border rounded-sm px-1 w-[175px] text-teal-900 ml-1">
                                    {{ date('d', strtotime($print_orders->created_at)) }}
                                    {{ $bulan[(int) date('m', strtotime($print_orders->created_at))] }}
                                    {{ date('Y', strtotime($print_orders->created_at)) }}
                                </label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Design</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <label id="companyDesign"
                                    class="flex text-sm border rounded-sm px-1 w-[175px] text-teal-900 ml-1">
                                    {{ $print_orders->theme }}
                                </label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Ukuran</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <label class="flex text-sm border rounded-sm px-1 w-[175px] text-teal-900 ml-1">
                                    {{ $product->location_size }}
                                </label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Status</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                @if ($product->order_type == 'sale')
                                    <label
                                        class="flex text-sm border rounded-sm px-1 w-[175px] text-teal-900 ml-1">{{ $product->status }}</label>
                                @else
                                    <label
                                        class="flex text-sm border rounded-sm px-1 w-[175px] text-teal-900 ml-1"></label>
                                @endif
                            </div>
                            @if ($product->location_side == 2)
                                <div class="flex mt-1">
                                    <input id="cbRightCopy" class="outline-none" type="checkbox"
                                        onclick="cbRightAction(this)" checked disabled>
                                    <label class="flex ml-1 text-sm text-teal-900 w-16">Kanan</label>
                                    <input id="cbLeftCopy" class="ml-2 outline-none" type="checkbox"
                                        onclick="cbLeftAction(this)" checked disabled>
                                    <label class="flex ml-1 text-sm text-teal-900 w-16">Kiri</label>
                                </div>
                            @endif
                        </div>
                        <div class="w-[240px] border rounded-md p-1 ml-1">
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Bahan</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <label id="companyProductName"
                                    class="flex text-sm border rounded-sm px-1 w-[175px] text-teal-900 ml-1">
                                    {{ $product->product_name }}
                                </label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Harga</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <label id="companyProductPrice"
                                    class="flex text-sm border rounded-sm px-1 w-[175px] text-teal-900 ml-1">
                                    {{ $product->product_price }}
                                </label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Jumlah</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <label class="flex text-sm border rounded-sm px-1 w-[175px] text-teal-900 ml-1">
                                    {{ $product->location_side }} Lembar
                                </label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Total</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <label id="companyTotal"
                                    class="flex text-sm border rounded-sm px-1 w-[175px] text-teal-900 ml-1">
                                    {{ $print_orders->price }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-teal-900 w-24">Finishing</label>
                        <label class="flex text-sm text-teal-900">:</label>
                        <label id="companyFinishing"
                            class="flex text-sm border rounded-sm px-1 w-[370px] text-teal-900 ml-1">
                            {{ $notes->finishing }}
                        </label>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-teal-900 w-24">Catatan</label>
                        <label class="flex text-sm text-teal-900">:</label>
                        <label id="companyNotes"
                            class="flex text-sm border rounded-sm px-1 w-[370px] h-16 text-teal-900 ml-1">
                            {{ $notes->note }}
                        </label>
                    </div>
                </div>
                <div class="w-[280px] border ml-2 p-1">
                    <label class="flex text-sm text-teal-900 w-full px-1 justify-center font-semibold">Design</label>
                    <div class="flex justify-center items-center border mt-3 p-1">
                        <img class="m-auto img-preview-copy flex items-center justify-center max-w-[260px] max-h-[200px]"
                            src="{{ asset('storage/' . $print_orders->design) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
