<div class="h-[490px] mt-4">
    <div class="flex w-full items-center px-10">
        <div class="w-[950px]">
            <label class="flex text-md font-semibold justify-center w-full"><u>SPK PEMASANGAN GAMBAR</u></label>
            <label class="flex text-md text-slate-500 justify-center w-full">Nomor : penomoroan otomatis </label>
            <div class="flex justify-center w-full">
                <div class="w-[500px] border p-2">
                    <div class="flex">
                        <div class="w-[240px] border rounded-md p-1">
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-24">Tgl. SPK</label>
                                <label class="flex text-sm text-black">:</label>
                                <input type="text"
                                    class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1"
                                    value="{{ $spkDate }}" readonly>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-24">Design</label>
                                <label class="flex text-sm text-black">:</label>
                                <input id="theme" type="text" name="theme" placeholder="Input Tema Design"
                                    value="{{ old('theme') }}" onkeyup="getTheme(this)"
                                    class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1 @error('area') is-invalid @enderror"
                                    required>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-24">Ukuran</label>
                                <label class="flex text-sm text-black">:</label>
                                <input id="size" type="text" value="{{ $size }}"
                                    class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1">
                            </div>
                        </div>
                        <div class="w-[240px] border rounded-md p-1 ml-1">
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-20">Tipe</label>
                                <label class="flex text-sm text-black">:</label>
                                <label id="type"
                                    class="flex ml-1 text-sm text-black border rounded-sm w-[140px] px-1">{{ $productType }}</label>
                            </div>
                            <div class="flex mt-1">
                                <input id="sizeWidth" type="number" value="{{ $width }}" hidden>
                                <input id="sizeHeight" type="number" value="{{ $height }}" hidden>
                                <label class="flex text-sm text-black w-20">Jumlah</label>
                                <label class="flex text-sm text-black">:</label>
                                <input id="qty" type="number" value="{{ $qty }}"
                                    class="w-10 ml-1 text-sm text-black border in-out-spin-none text-center rounded-sm outline-none px-1"
                                    readonly>
                                <label class="flex ml-2 text-sm text-black">lembar</label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-20">Tgl. Tayang</label>
                                <label class="flex text-sm text-black">:</label>
                                <input id="install_at" name="install_at" type="date" value="{{ old('install_at') }}"
                                    class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1"
                                    onchange="getInstallAt(this)">
                            </div>
                            @if ((int) filter_var($side, FILTER_SANITIZE_NUMBER_INT) == 2)
                                <div class="flex mt-1">
                                    <input id="cbRight" class="outline-none" type="checkbox"
                                        onclick="cbRightAction(this)" checked>
                                    <label class="flex ml-1 text-sm text-black w-16">Kanan</label>
                                    <input id="cbLeft" class="ml-2 outline-none" type="checkbox"
                                        onclick="cbLeftAction(this)" checked>
                                    <label class="flex ml-1 text-sm text-black w-16">Kiri</label>
                                </div>
                            @else
                                <div hidden>
                                    <input id="cbRight" class="outline-none" type="checkbox"
                                        onclick="cbRightAction(this)">
                                    <label class="flex ml-1 text-sm text-black w-16">Kanan</label>
                                    <input id="cbLeft" class="ml-2 outline-none" type="checkbox"
                                        onclick="cbLeftAction(this)" checked>
                                    <label class="flex ml-1 text-sm text-black w-16">Kiri</label>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-black w-14">Catatan</label>
                        <label class="flex text-sm text-black">:</label>
                        <textarea name="notes" placeholder="Input Catatan"
                            class="flex w-[425px] ml-1 text-sm text-black border rounded-sm outline-none px-1" rows="3"
                            onkeyup="getNotes(this)">{{ old('notes') }}</textarea>
                    </div>
                    <!-- SPK Sign start-->
                    @include('install-orders.spk-location')
                    <!-- SPK Sign end-->
                </div>
                <div class="w-[280px] border ml-2 p-1">
                    <label class="flex text-sm text-black justify-center w-full px-1 font-semibold">Pilih
                        Design</label>
                    <input id="design" name="design"
                        class="flex border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 w-full"
                        type="file" onchange="previewImage(this)">
                    @error('design')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="flex justify-center items-center border mt-3 p-1">
                        <img class="m-auto img-preview flex items-center justify-center max-w-[260px] max-h-[180px]"
                            src="/img/product-image.png">
                    </div>
                    <!-- SPK Sign start-->
                    @include('install-orders.spk-sign')
                    <!-- SPK Sign end-->
                </div>
            </div>
        </div>
    </div>
    <div class="text-slate-500 text-xs ml-20 mt-2">
        <i>* Lembar untuk Tim Produksi</i>
    </div>
</div>
