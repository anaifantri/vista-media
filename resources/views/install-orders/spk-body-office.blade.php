<div class="h-[490px] mt-4">
    <div class="flex w-full px-10">
        <div class="w-[950px]">
            <label class="flex text-md font-semibold justify-center w-full"><u>SPK PEMASANGAN GAMBAR</u></label>
            <label class="flex text-md text-slate-500 justify-center w-full">Nomor : penomoroan otomatis </label>
            <div class="flex justify-center w-full">
                <div class="w-[500px] h-[430px] border p-2">
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
                                <input id="themeCopy" type="text" placeholder="Terisi otomatis"
                                    value="{{ old('theme') }}"
                                    class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1" readonly>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-24">Ukuran</label>
                                <label class="flex text-sm text-black">:</label>
                                <input id="size" type="text" value="{{ $size }}"
                                    class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1">
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-24">Status</label>
                                <label class="flex text-sm text-black">:</label>
                                @if ($orderType == 'free')
                                    <input id="orderStatus" type="text"
                                        value="Free ke {{ $usedInstall + 1 }} dari {{ $freeInstall }}"
                                        class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1"
                                        readonly>
                                @elseif ($orderType == 'sales')
                                    <input id="orderStatus" type="text" value="Berbayar"
                                        class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1"
                                        readonly>
                                @else
                                    <input id="orderStatus" type="text" value="Free"
                                        class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1"
                                        readonly>
                                @endif
                            </div>
                            @if ((int) filter_var($side, FILTER_SANITIZE_NUMBER_INT) == 2)
                                <div class="flex mt-1">
                                    <input id="cbRightCopy" class="outline-none" type="checkbox" checked disabled>
                                    <label class="flex ml-1 text-sm text-black w-16">Kanan</label>
                                    <input id="cbLeftCopy" class="ml-2 outline-none" type="checkbox" checked disabled>
                                    <label class="flex ml-1 text-sm text-black w-16">Kiri</label>
                                </div>
                            @endif
                        </div>
                        <div class="w-[240px] border rounded-md p-1 ml-1">
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-14">Tipe</label>
                                <label class="flex text-sm text-black">:</label>
                                <label
                                    class="flex ml-1 text-sm text-black border rounded-sm w-[175px] px-1">{{ $productType }}</label>
                            </div>
                            <div class="flex mt-1">
                                <input id="sizeWidth" type="number" value="{{ $width }}" hidden>
                                <input id="sizeHeight" type="number" value="{{ $height }}" hidden>
                                <label class="flex text-sm text-black w-14">Jumlah</label>
                                <label class="flex text-sm text-black">:</label>
                                <input id="qtyCopy" type="number" value="{{ $qty }}"
                                    class="w-10 ml-1 text-sm text-black border in-out-spin-none text-center rounded-sm outline-none px-1"
                                    readonly>
                                <label class="flex ml-2 text-sm text-black">lembar</label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-black w-20">Tgl. Tayang</label>
                                <label class="flex text-sm text-black">:</label>
                                <input id="installAt" type="date" value="{{ old('install_at') }}"
                                    class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1" readonly>
                            </div>
                            @if ($side == 2)
                                <div class="flex mt-1">
                                    <input id="cbRight" class="outline-none" type="checkbox"
                                        onclick="cbRightAction(this)" checked>
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
                        <textarea id="notesCopy" placeholder="Terisi otomatis"
                            class="flex w-[425px] ml-1 text-sm text-black border rounded-sm outline-none px-1" rows="2" readonly>{{ old('notes') }}</textarea>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-black w-[68px]">Lokasi</label>
                        <label class="flex text-sm text-black">:</label>
                        <label class="flex w-[400px] ml-1 text-sm text-black px-1">{{ $location_address }}</label>
                    </div>
                    <!-- SPK Sign start-->
                    @include('install-orders.spk-location-office')
                    <!-- SPK Sign end-->
                </div>
                <div class="w-[280px] border ml-2 p-1">
                    <label class="flex text-sm text-black justify-center w-full px-1 font-semibold">Design</label>
                    <div class="flex justify-center items-center border mt-3 p-1">
                        <img class="m-auto img-preview-copy flex items-center justify-center max-w-[260px] max-h-[180px]"
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
        <i>* Lembar untuk Tim Marketing</i>
    </div>
</div>
