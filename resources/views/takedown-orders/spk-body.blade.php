<div class="h-[490px] mt-4">
    <div class="flex w-full items-center px-10">
        <div class="w-[950px]">
            <label class="flex text-md font-semibold justify-center w-full"><u>SPK PENURUNAN GAMBAR</u></label>
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
                                    value="{{ old('theme') }}"
                                    class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1 @error('area') is-invalid @enderror"
                                    required>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-24">Ukuran</label>
                                <label class="flex text-sm text-black">:</label>
                                <input id="size" type="text" value="{{ $location->media_size->size }}"
                                    class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1">
                            </div>
                        </div>
                        <div class="w-[240px] border rounded-md p-1 ml-1">
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-20">Tipe</label>
                                <label class="flex text-sm text-black">:</label>
                                <label id="type"
                                    class="flex ml-1 text-sm text-black border rounded-sm w-[140px] px-1">{{ $description->lighting }}</label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-20">Tgl. Turun</label>
                                <label class="flex text-sm text-black">:</label>
                                <input id="takedown_at" name="takedown_at" type="date"
                                    value="{{ old('takedown_at') }}"
                                    class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1" required>
                            </div>
                            @if ((int) filter_var($location->side, FILTER_SANITIZE_NUMBER_INT) == 2)
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
                            class="flex w-[425px] ml-1 text-sm text-black border rounded-sm outline-none px-1" rows="3">{{ old('notes') }}</textarea>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-black w-14">Lokasi</label>
                        <label class="flex text-sm text-black">:</label>
                        <label class="flex w-[350px] ml-1 text-sm text-black px-1">{{ $location->address }}</label>
                    </div>
                    <!-- SPK Sign start-->
                    @include('takedown-orders.spk-location')
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
                    @include('takedown-orders.spk-sign')
                    <!-- SPK Sign end-->
                </div>
            </div>
        </div>
    </div>
</div>
