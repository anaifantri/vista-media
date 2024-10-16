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
                                <label class="flex text-sm text-teal-900 w-14">Tgl. SPK</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <label
                                    class="flex text-sm border rounded-sm px-1 w-[175px] text-teal-900 ml-1">{{ $spkDate }}</label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Design</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <label id="designPreview"
                                    class="flex border rounded-sm px-1 w-[175px] text-sm text-teal-900 ml-1"></label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Ukuran</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <label
                                    class="flex text-sm border rounded-sm px-1 w-[175px] text-teal-900 ml-1">{{ $size }}</label>
                            </div>
                        </div>
                        <div class="w-[240px] border rounded-md p-1 ml-1">
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Bahan</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <label id="productPreview"
                                    class="flex border rounded-sm px-1 w-[175px] text-sm text-teal-900 ml-1"></label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Harga</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <label id="pricePreview"
                                    class="flex border rounded-sm px-1 w-[175px] text-sm text-teal-900 ml-1"></label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Jumlah</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <label id="qtyPreview"
                                    class="flex border rounded-sm px-1 w-[175px] text-sm text-teal-900 ml-1"></label>
                            </div>
                            <div class="flex mt-1">
                                <label class="flex text-sm text-teal-900 w-14">Total</label>
                                <label class="flex text-sm text-teal-900">:</label>
                                <label id="totalPreview"
                                    class="flex border rounded-sm px-1 w-[175px] text-sm text-teal-900 ml-1"></label>
                            </div>
                        </div>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-teal-900 w-28">Finishing</label>
                        <label class="flex text-sm text-teal-900">:</label>
                        <label id="finishingPreview"
                            class="flex border rounded-sm text-sm text-teal-900 ml-1 w-[350px]"></label>
                    </div>
                    <div class="flex mt-1">
                        <label class="flex text-sm text-teal-900 w-28">Catatan</label>
                        <label class="flex text-sm text-teal-900">:</label>
                        <label id="notesPreview"
                            class="flex border rounded-sm w-[350px] ml-1 text-sm text-teal-900 px-1 h-16"></label>
                    </div>
                </div>
                <div class="w-[280px] border ml-2 p-1">
                    <label class="flex text-sm text-teal-900 justify-center w-full px-1 font-semibold">Design</label>
                    <div class="flex justify-center items-center border mt-3 p-1">
                        <img class="m-auto img-preview-save flex items-center justify-center max-w-[260px] max-h-[200px]"
                            src="/img/product-image.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
