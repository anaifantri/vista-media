<div class="h-[310px] mt-4">
    <div class="flex w-full items-center px-10">
        <div class="w-[950px]">
            <label class="flex text-md font-semibold justify-center w-full mt-2"><u>SPK CETAK GAMBAR</u></label>
            <label class="flex text-md text-slate-500 justify-center w-full">Nomor : penomoroan otomatis </label>
            <div class="flex justify-center w-full mt-2">
                <div class="w-[500px] border p-2">
                    <div class="flex">
                        <div class="w-[240px] border rounded-md p-1">
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-16">Tgl. Cetak</label>
                                <label class="flex text-sm text-black">:</label>
                                <input id="printAtCopy" type="date"
                                    class="flex ml-1 w-32 text-sm text-black border rounded-sm outline-none px-1"
                                    readonly>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-16">Ukuran</label>
                                <label class="flex text-sm text-black">:</label>
                                <input type="text" value="{{ $size }}"
                                    class="flex ml-1 text-sm w-32 text-black border rounded-sm outline-none px-1"
                                    readonly>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-16">Status</label>
                                <label class="flex text-sm text-black">:</label>
                                @if ($orderType == 'free')
                                    <input id="orderStatus" type="text"
                                        value="Free ke {{ $usedPrint + 1 }} dari {{ $freePrint }}"
                                        class="flex ml-1 w-36 text-sm text-black border rounded-sm outline-none px-1"
                                        readonly>
                                @elseif ($orderType == 'sales')
                                    <input id="orderStatus" type="text" value="Berbayar"
                                        class="flex ml-1 w-36 text-sm text-black border rounded-sm outline-none px-1"
                                        readonly>
                                @else
                                    <input id="orderStatus" type="text" value="Free lain-lain"
                                        class="flex ml-1 w-36 text-sm text-black border rounded-sm outline-none px-1"
                                        readonly>
                                @endif
                            </div>
                            @if ((int) filter_var($side, FILTER_SANITIZE_NUMBER_INT) == 2)
                                <div class="flex mt-1">
                                    <input id="cbRightCopy" class="outline-none" type="checkbox"checked disabled>
                                    <label class="flex ml-1 text-sm text-black w-16">Kanan</label>
                                    <input id="cbLeftCopy" class="ml-2 outline-none" type="checkbox" checked disabled>
                                    <label class="flex ml-1 text-sm text-black w-16">Kiri</label>
                                </div>
                            @else
                                <div class="hidden mt-1">
                                    <input id="cbRightCopy" class="outline-none" type="checkbox">
                                    <label class="flex ml-1 text-sm text-black w-16">Kanan</label>
                                    <input id="cbLeftCopy" class="ml-2 outline-none" type="checkbox" checked>
                                    <label class="flex ml-1 text-sm text-black w-16">Kiri</label>
                                </div>
                            @endif
                        </div>
                        <div class="w-[240px] border rounded-md p-1 ml-1">
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-14">Bahan</label>
                                <label class="flex text-sm text-black">:</label>
                                <input id="copyProduct" name="copyProduct" value="{{ old('copyProduct') }}"
                                    type="text" placeholder="Terisi Otomatis"
                                    class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1" readonly>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-14">Harga</label>
                                <label class="flex text-sm text-black">:</label>
                                <input id="copyPrice" value="{{ old('productPrice') }}" type="number"
                                    placeholder="Terisi Otomatis"
                                    class="w-28 in-out-spin-none ml-1 text-sm text-black border rounded-sm outline-none px-1"
                                    readonly>
                                <label class="flex text-sm text-black ml-2">/ m2</label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-14">Jumlah</label>
                                <label class="flex text-sm text-black">:</label>
                                @if (old('qty'))
                                    <input id="qtyCopy" type="number" value="{{ old('qty') }}"
                                        placeholder="Terisi Otomatis"
                                        class="w-10 ml-1 text-sm text-black border in-out-spin-none text-center rounded-sm outline-none px-1"
                                        readonly>
                                @else
                                    <input id="qtyCopy" type="number" value="{{ $qty }}"
                                        placeholder="Terisi Otomatis"
                                        class="w-10 ml-1 text-sm text-black border in-out-spin-none text-center rounded-sm outline-none px-1"
                                        readonly>
                                @endif
                                <label class="flex ml-2 text-sm text-black">Lembar</label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-14">Total</label>
                                <label class="flex text-sm text-black">:</label>
                                <input id="totalCopy" value="{{ old('total') }}" type="number"
                                    placeholder="Terisi Otomatis"
                                    class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-black w-24">Design</label>
                        <label class="flex text-sm text-black">:</label>
                        <input id="copyDesign" type="text" placeholder="Terisi Otomatis"
                            value="{{ old('input_theme') }}"
                            class="flex ml-1 text-sm w-[350px] text-black border rounded-sm outline-none px-1"
                            readonly>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-black w-24">Finishing</label>
                        <label class="flex text-sm text-black">:</label>
                        <input id="copyFinishing" type="text" placeholder="Terisi Otomatis"
                            value="{{ old('finishing') }}"
                            class="flex w-[370px] ml-1 text-sm text-black border rounded-sm outline-none px-1"
                            readonly>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-black w-24">Catatan</label>
                        <label class="flex text-sm text-black">:</label>
                        <textarea id="copyNotes" class="flex w-[370px] ml-1 text-sm text-black border rounded-sm outline-none px-1"
                            rows="3" placeholder="Terisi Otomatis" readonly>{{ old('note') }}</textarea>
                    </div>
                </div>
                <div class="w-[280px] border ml-2 p-1">
                    <label class="flex text-sm text-black w-full px-1 justify-center font-semibold">Design</label>
                    <div class="flex justify-center items-center border mt-3 p-1">
                        <img class="m-auto img-preview-copy flex items-center justify-center max-w-[260px] max-h-[200px]"
                            src="/img/product-image.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
