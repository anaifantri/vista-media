<div class="h-[330px] mt-4">
    <div class="flex w-full items-center px-10">
        <div class="w-[950px]">
            <label class="flex text-md font-semibold justify-center w-full mt-6"><u>SPK CETAK GAMBAR</u></label>
            <label class="flex text-md text-slate-500 justify-center w-full">{{ $print_orders->number }}</label>
            <div class="flex justify-center w-full mt-4">
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
                                <label class="flex text-sm text-teal-900 w-24">Design</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input id="theme" name="theme" value="{{ $print_orders->theme }}"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1 @error('theme') is-invalid @enderror"
                                    type="text" onkeyup="getTheme(this)" required>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-24">Ukuran</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input id="size" name="size" type="text"
                                    value="{{ $product->location_size }}"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                                    disabled>
                            </div>
                            @if ($product->location_side == 2)
                                <div class="flex mt-1">
                                    <input id="cbRight" class="outline-none" type="checkbox"
                                        onclick="cbRightAction(this)" checked>
                                    <label class="flex ml-1 text-sm text-teal-900 w-16">Kanan</label>
                                    <input id="cbLeft" class="ml-2 outline-none" type="checkbox"
                                        onclick="cbLeftAction(this)" checked>
                                    <label class="flex ml-1 text-sm text-teal-900 w-16">Kiri</label>
                                </div>
                            @endif
                        </div>
                        <div class="w-[240px] border rounded-md p-1 ml-1">
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Bahan</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <select id="productSelect"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1 w-[175px]"
                                    onchange="getPrintProduct(this)" required>
                                    @foreach ($printing_prices as $printing_price)
                                        @if ($printing_price->printing_product_id == $product->product_id)
                                            <option id="{{ $printing_price->printing_product->id }}"
                                                class="text-semibold" value="{{ $printing_price->price }}" selected>
                                                {{ $printing_price->printing_product->name }}</option>
                                        @else
                                            <option id="{{ $printing_price->printing_product->id }}"
                                                class="text-semibold" value="{{ $printing_price->price }}">
                                                {{ $printing_price->printing_product->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Harga</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input id="productPrice" type="number" value="{{ $product->product_price }}"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                                    disabled>
                            </div>
                            <div class="flex mt-1">
                                <input id="sizeWidth" type="number" value="{{ $product->location_width }}" hidden>
                                <input id="sizeHeight" type="number" value="{{ $product->location_height }}" hidden>
                                <label class="flex text-sm text-teal-900 w-14">Jumlah</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input id="qty" type="number" value="{{ $product->location_side }}"
                                    class="flex w-8 ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                                    disabled>
                                <label class="flex ml-2 text-sm text-teal-900">lembar</label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Total</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input id="price" name="price" value="{{ $print_orders->price }}" type="number"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-teal-900 w-28">Finishing</label>
                        <label class="flex text-sm text-teal-900">:</label>
                        <input type="text" value="{{ $notes->finishing }}"
                            class="flex w-[350px] ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                            onkeyup="getFinishing(this)" required>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-teal-900 w-28">Catatan</label>
                        <label class="flex text-sm text-teal-900">:</label>
                        <textarea class="flex w-[350px] ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1" rows="3"
                            onkeyup="getNotes(this)">{{ $notes->note }}</textarea>
                    </div>
                </div>
                <div class="w-[280px] border ml-2 p-1">
                    <input type="text" name="oldDesign" value="{{ $print_orders->design }}" hidden>
                    <label class="flex text-sm text-teal-900 justify-center w-full px-1 font-semibold">Ganti
                        Design</label>
                    <input id="inputDesign"
                        class="flex border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 w-full"
                        type="file" onchange="previewImage(this)">
                    <div class="flex justify-center items-center border mt-3 p-1">
                        <img class="m-auto img-preview flex items-center justify-center max-w-[260px] max-h-[200px]"
                            src="{{ asset('storage/' . $print_orders->design) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
