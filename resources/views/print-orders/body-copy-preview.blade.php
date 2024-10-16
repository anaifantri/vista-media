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
                                <label class="flex text-sm text-teal-900 w-14">Tgl. SPK</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <label
                                    class="flex border rounded-sm px-1 w-[175px] text-sm text-teal-900 ml-1">{{ $spkDate }}</label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Design</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <label id="copyDesignPreview"
                                    class="flex border rounded-sm px-1 w-[175px] text-sm text-teal-900 ml-1"></label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Ukuran</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <label
                                    class="flex border rounded-sm px-1 w-[175px] text-sm text-teal-900 ml-1">{{ $size }}</label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Status</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                @if ($orderType == 'sale')
                                    <label class="flex border rounded-sm px-1 w-[175px] text-sm text-teal-900 ml-1">Free
                                        ke {{ $usedPrint + 1 }} dari
                                        {{ $freePrint }}</label>
                                @else
                                    <label
                                        class="flex border rounded-sm px-1 w-[175px] text-sm text-teal-900 ml-1">Free</label>
                                @endif
                            </div>
                            @if ($side == 2)
                                <div class="flex mt-1">
                                    <label id="sidePreview" class="flex text-sm text-teal-900 ml-1"></label>
                                </div>
                            @endif
                        </div>
                        <div class="w-[240px] border rounded-md p-1 ml-1">
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Bahan</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <label id="copyProductPreview"
                                    class="flex border rounded-sm px-1 w-[175px] text-sm text-teal-900 ml-1"></label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Harga</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <label id="copyPricePreview"
                                    class="flex border rounded-sm px-1 w-[175px] text-sm text-teal-900 ml-1"></label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Jumlah</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <label id="copyQtyPreview"
                                    class="flex border rounded-sm px-1 w-[175px] text-sm text-teal-900 ml-1"></label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Total</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <label id="copyTotalPreview"
                                    class="flex border rounded-sm px-1 w-[175px] text-sm text-teal-900 ml-1"></label>
                            </div>
                        </div>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-teal-900 w-28">Finishing</label>
                        <label class="flex text-sm text-teal-900">:</label>
                        <label id="copyFinishingPreview"
                            class="flex border rounded-sm px-1 w-[350px] text-sm text-teal-900 ml-1"></label>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-teal-900 w-28">Catatan</label>
                        <label class="flex text-sm text-teal-900">:</label>
                        <label id="copyNotesPreview"
                            class="flex border rounded-sm h-16 w-[350px] ml-1 text-sm text-teal-900 px-1"></label>
                    </div>
                </div>
                <div class="w-[280px] border ml-2 p-1">
                    <label class="flex text-sm text-teal-900 w-full px-1 justify-center font-semibold">Design</label>
                    <div class="flex justify-center items-center border mt-3 p-1">
                        <img class="m-auto img-preview-copy-save flex items-center justify-center max-w-[260px] max-h-[200px]"
                            src="/img/product-image.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
