<div class="h-[520px] mt-4">
    <div class="flex w-full px-10">
        <div class="w-[950px]">
            <label class="flex text-md font-semibold justify-center w-full mt-6"><u>SPK PEMASANGAN GAMBAR</u></label>
            <label class="flex text-md text-slate-500 justify-center w-full">Nomor : penomoroan otomatis </label>
            <div class="flex justify-center w-full">
                <div class="w-[500px] h-[430px] border p-2">
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
                                <input id="theme" type="text" onkeyup="getDesign(this)"
                                    placeholder="Input Tema Design"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1">
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-24">Ukuran</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input id="size" type="text" value="{{ $size }}"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1">
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-24">Status</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                @if ($orderType == 'sale')
                                    <input id="orderStatus" type="text"
                                        value="Free ke {{ $usedInstall + 1 }} dari {{ $freeInstall }}"
                                        class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                                        readonly>
                                @else
                                    <input type="text" value="Free"
                                        class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                                        readonly>
                                @endif
                            </div>
                            @if ($side == 2)
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
                                <label class="flex text-sm text-teal-900 w-14">Tipe</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <label
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm w-[175px] px-1">{{ $productType }}</label>
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
                            @if ($side == 2)
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
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-teal-900 w-14">Catatan</label>
                        <label class="flex text-sm text-teal-900">:</label>
                        <textarea placeholder="Input Catatan"
                            class="flex w-[425px] ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1" rows="3"
                            onkeyup="getNotes(this)"></textarea>
                    </div>
                    <!-- SPK Sign start-->
                    @include('install-orders.spk-location-office')
                    <!-- SPK Sign end-->
                </div>
                <div class="w-[280px] border ml-2 p-1">
                    <label class="flex text-sm text-teal-900 justify-center w-full px-1 font-semibold">Design</label>
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
