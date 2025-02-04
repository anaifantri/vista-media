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
                                <label class="flex text-sm text-black w-16">Tgl. Cetak</label>
                                <label class="flex text-sm text-black">:</label>
                                <input id="printAt" name="print_at" type="date"
                                    class="flex ml-1 w-32 text-sm text-black border rounded-sm outline-none px-1"
                                    value="{{ $print_orders->print_at }}" onchange="getPrintAt(this)" required>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-16">Ukuran</label>
                                <label class="flex text-sm text-black">:</label>
                                <input id="size" name="size" type="text"
                                    value="{{ $product->location_size }}"
                                    class="flex ml-1 w-32 text-sm text-black border rounded-sm outline-none px-1"
                                    disabled>
                            </div>
                            @if ($product->location_side == 2)
                                @if ($product->side_left == true && $product->side_right == true)
                                    <div class="flex mt-1">
                                        <input id="cbRight" class="outline-none" type="checkbox"
                                            onclick="cbRightAction(this)" checked>
                                        <label class="flex ml-1 text-sm text-black w-16">Kanan</label>
                                        <input id="cbLeft" class="ml-2 outline-none" type="checkbox"
                                            onclick="cbLeftAction(this)" checked>
                                        <label class="flex ml-1 text-sm text-black w-16">Kiri</label>
                                    </div>
                                @else
                                    @if ($product->side_left == true)
                                        <div class="flex mt-1">
                                            <input id="cbRight" class="outline-none" type="checkbox"
                                                onclick="cbRightAction(this)">
                                            <label class="flex ml-1 text-sm text-black w-16">Kanan</label>
                                            <input id="cbLeft" class="ml-2 outline-none" type="checkbox"
                                                onclick="cbLeftAction(this)" checked>
                                            <label class="flex ml-1 text-sm text-black w-16">Kiri</label>
                                        </div>
                                    @elseif($product->side_right == true)
                                        <div class="flex mt-1">
                                            <input id="cbRight" class="outline-none" type="checkbox"
                                                onclick="cbRightAction(this)" checked>
                                            <label class="flex ml-1 text-sm text-black w-16">Kanan</label>
                                            <input id="cbLeft" class="ml-2 outline-none" type="checkbox"
                                                onclick="cbLeftAction(this)">
                                            <label class="flex ml-1 text-sm text-black w-16">Kiri</label>
                                        </div>
                                    @endif
                                @endif
                            @endif
                        </div>
                        <div class="w-[240px] border rounded-md p-1 ml-1">
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-14">Bahan</label>
                                <label class="flex text-sm text-black">:</label>
                                <select id="productSelect"
                                    class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1 w-[175px]"
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
                                <label class="flex text-sm text-black w-14">Harga</label>
                                <label class="flex text-sm text-black">:</label>
                                <input id="productPrice" type="number" value="{{ $product->product_price }}"
                                    class="flex ml-1 w-20 text-sm text-black border rounded-sm outline-none px-1"
                                    disabled>
                                <label class="flex text-sm text-black ml-2">/ m2</label>
                            </div>
                            <div class="flex mt-1">
                                <input id="sizeWidth" type="number" value="{{ $product->location_width }}" hidden>
                                <input id="sizeHeight" type="number" value="{{ $product->location_height }}" hidden>
                                <label class="flex text-sm text-black w-14">Jumlah</label>
                                <label class="flex text-sm text-black">:</label>
                                <input id="qty" type="number" value="{{ $product->qty }}"
                                    class="text-center in-out-spin-none w-20 ml-1 text-sm text-black border rounded-sm outline-none px-1"
                                    disabled>
                                <label class="flex ml-2 text-sm text-black">lembar</label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-14">Total</label>
                                <label class="flex text-sm text-black">:</label>
                                <input id="price" name="price" value="{{ $print_orders->price }}" type="number"
                                    class="flex ml-1 w-[350px] text-sm text-black border rounded-sm outline-none px-1"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-black w-28">Design</label>
                        <label class="flex text-sm text-black">:</label>
                        <input id="theme" name="theme" value="{{ $print_orders->theme }}"
                            class="flex ml-1 w-[350px] text-sm text-black border rounded-sm outline-none px-1 @error('theme') is-invalid @enderror"
                            type="text" onkeyup="getTheme(this)" required>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-black w-28">Finishing</label>
                        <label class="flex text-sm text-black">:</label>
                        <input type="text" id="finishing" value="{{ $notes->finishing }}"
                            class="flex w-[350px] ml-1 text-sm text-black border rounded-sm outline-none px-1"
                            onkeyup="getFinishing(this)" required>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-black w-28">Catatan</label>
                        <label class="flex text-sm text-black">:</label>
                        <textarea class="flex w-[350px] ml-1 text-sm text-black border rounded-sm outline-none px-1" rows="3"
                            onkeyup="getNotes(this)">{{ $notes->note }}</textarea>
                    </div>
                </div>
                <div class="w-[280px] border ml-2 p-1">
                    {{-- <input type="text" name="oldDesign" value="{{ $print_orders->design }}" hidden> --}}
                    <label class="flex text-sm text-black justify-center w-full px-1 font-semibold">Ganti
                        Design</label>
                    @error('design')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <input id="design" name="design"
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
