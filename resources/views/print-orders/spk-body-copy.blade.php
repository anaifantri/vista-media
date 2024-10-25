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
                                <label class="flex text-sm text-teal-900 w-24">Tgl. SPK</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input type="text"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                                    value="{{ $spkDate }}" readonly>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-24">Design</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input id="copyDesign" type="text" placeholder="Terisi Otomatis"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                                    readonly>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-24">Ukuran</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input type="text" value="{{ $size }}"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                                    readonly>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-24">Status</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                @if ($orderType == 'sale')
                                    <input id="orderStatus" type="text"
                                        value="Free ke {{ $usedPrint + 1 }} dari {{ $freePrint }}"
                                        class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                                        readonly>
                                @else
                                    <input id="orderStatus" type="text" value="Free"
                                        class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                                        readonly>
                                @endif
                            </div>
                            @if ($side == 2)
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
                                <input id="copyProduct" type="text" placeholder="Terisi Otomatis"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                                    readonly>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Harga</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input id="copyPrice" type="number" placeholder="Terisi Otomatis"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                                    readonly>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Jumlah</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input id="qtyCopy" type="number" value="{{ $qty }}"
                                    placeholder="Terisi Otomatis"
                                    class="flex ml-2 text-sm w-8 text-teal-900 border rounded-sm outline-none px-1"
                                    readonly>
                                <label class="flex ml-2 text-sm text-teal-900">Lembar</label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Total</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <input id="totalCopy" type="number" placeholder="Terisi Otomatis"
                                    class="flex ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-teal-900 w-24">Finishing</label>
                        <label class="flex text-sm text-teal-900">:</label>
                        <input id="copyFinishing" type="text" placeholder="Terisi Otomatis"
                            class="flex w-[370px] ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                            readonly>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-teal-900 w-24">Catatan</label>
                        <label class="flex text-sm text-teal-900">:</label>
                        <textarea id="copyNotes" class="flex w-[370px] ml-1 text-sm text-teal-900 border rounded-sm outline-none px-1"
                            rows="3" placeholder="Terisi Otomatis" readonly></textarea>
                    </div>
                </div>
                <div class="w-[280px] border ml-2 p-1">
                    <label class="flex text-sm text-teal-900 w-full px-1 justify-center font-semibold">Design</label>
                    <div class="flex justify-center items-center border mt-3 p-1">
                        <img class="m-auto img-preview-copy flex items-center justify-center max-w-[260px] max-h-[200px]"
                            src="/img/product-image.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
