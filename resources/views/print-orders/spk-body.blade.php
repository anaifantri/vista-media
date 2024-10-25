<div class="h-[330px] mt-4">
    <div class="flex w-full items-center px-10">
        <div class="w-[950px]">
            <label class="flex text-md font-semibold justify-center w-full mt-6"><u>SPK CETAK GAMBAR</u></label>
            <label class="flex text-md text-slate-500 justify-center w-full">Nomor : penomoroan otomatis </label>
            <div class="flex justify-center w-full mt-4">
                <div class="w-[500px] border p-2">
                    <div class="flex">
                        <div class="w-[240px] border rounded-md p-1">
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-24">Tgl. SPK</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input type="text"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                                    value="{{ $spkDate }}" readonly>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-24">Design</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input id="inputTheme" type="text" onkeyup="getDesign(this)"
                                    placeholder="Input Tema Design"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1">
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-24">Ukuran</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input id="size" type="text" value="{{ $size }}"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1">
                            </div>
                            @if ($qty == 2)
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
                                @if ($printing_prices != null)
                                    <select id="selectProduct" title="Pilih Bahan Cetak"
                                        class="ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1 w-[175px]"
                                        onchange="getPrintProduct(this)">
                                        <option class="text-semibold" value="pilih">-- pilih --</option>
                                        @foreach ($printing_prices as $printing_price)
                                            <option id="{{ $printing_price->printing_product->id }}"
                                                class="text-semibold" value="{{ $printing_price->price }}">
                                                {{ $printing_price->printing_product->name }}</option>
                                            @php
                                                $getType = $printing_price->printing_product->type;
                                            @endphp
                                        @endforeach
                                    </select>
                                    <input type="text" id="productType" value="{{ $getType }}" hidden>
                                @else
                                    <select id="selectProduct" title="Pilih Vendor Terlebih Dahulu"
                                        class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1 w-[175px]"
                                        disabled>
                                        <option class="text-semibold" value="pilih">-- pilih --</option>
                                    </select>
                                    <input type="text" id="productType" hidden>
                                @endif
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Harga</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input id="productPrice" type="number" placeholder="Terisi Otomatis"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                                    readonly>
                            </div>
                            <div class="flex mt-1">
                                <input id="sizeWidth" type="number" value="{{ $width }}" hidden>
                                <input id="sizeHeight" type="number" value="{{ $height }}" hidden>
                                <label class="flex text-sm text-teal-900 w-14">Jumlah</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input id="qty" type="number" value="{{ $qty }}"
                                    class="flex w-8 ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                                    readonly>
                                <label class="flex ml-2 text-sm text-teal-900">lembar</label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Total</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input id="total" type="number" placeholder="Terisi Otomatis"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-teal-900 w-28">Finishing</label>
                        <label class="flex text-sm text-teal-900">:</label>
                        <input id="inputFinishing" type="text" placeholder="Input Finishing"
                            class="flex w-[350px] ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                            onkeyup="getFinishing(this)">
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-teal-900 w-28">Catatan</label>
                        <label class="flex text-sm text-teal-900">:</label>
                        <textarea placeholder="Input Catatan"
                            class="flex w-[350px] ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1" rows="3"
                            onkeyup="getNotes(this)"></textarea>
                    </div>
                </div>
                <div class="w-[280px] border ml-2 p-1">
                    <label class="flex text-sm text-teal-900 justify-center w-full px-1 font-semibold">Pilih
                        Design</label>
                    <input id="inputDesign"
                        class="flex border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 w-full"
                        type="file" onchange="previewImage(this)">
                    <div class="flex justify-center items-center border mt-3 p-1">
                        <img class="m-auto img-preview flex items-center justify-center max-w-[260px] max-h-[200px]"
                            src="/img/product-image.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
