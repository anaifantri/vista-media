<div id="modalSelectTerm" hidden>
    <div class="flex w-full bg-stone-400 rounded-xl items-center px-10 pt-2 border-b pb-2">
        <span class="text-center w-full text-lg font-semibold">Pilih Termin Pembayaran Yang Akan Ditagihkan?</span>
    </div>
    <div
        class="flex w-full h-[550px] bg-stone-200 justify-center border rounded-lg border-stone-400 my-2 p-4 border-b pb-2">
        <div class="w-[1150px] p-2">
            <div>
                <span class="text-md font-semibold"><u>Detail Penjualan :</u></span>
            </div>
            <div class="flex text-sm mt-2">
                <div id="saleDetail" class="w-[560px] border rounded-lg border-stone-900 p-2">
                    <div class="flex">
                        <label class="w-28">No. Penjualan</label>
                        <label>:</label>
                        <label class="ml-2"></label>
                    </div>
                    <div class="flex">
                        <label class="w-28">Tgl. Penjualan</label>
                        <label>:</label>
                        <label class="ml-2"></label>
                    </div>
                    <div class="flex">
                        <label class="w-28">Jenis</label>
                        <label>:</label>
                        <label class="ml-2"></label>
                    </div>
                    <div class="flex">
                        <label class="w-28">Lokasi</label>
                        <label>:</label>
                        <label class="ml-2"></label>
                    </div>
                    <div class="flex">
                        <label class="w-28">Harga</label>
                        <label>:</label>
                        <label class="ml-2"></label>
                    </div>
                </div>
                <div id="quotationDetail" class="w-[560px] border rounded-lg border-stone-900 ml-2 p-2">
                    <div class="flex">
                        <label class="w-32">No. Penawaran</label>
                        <label>:</label>
                        <label class="ml-2"></label>
                    </div>
                    <div class="flex">
                        <label class="w-32">Tgl. Penawaran</label>
                        <label>:</label>
                        <label class="ml-2"></label>
                    </div>
                    <div class="flex">
                        <label class="w-32">Nama Klien</label>
                        <label>:</label>
                        <label class="ml-2"></label>
                    </div>
                    <div class="flex">
                        <label class="w-32">Nama Perusahaan</label>
                        <label>:</label>
                        <label class="ml-2"></label>
                    </div>
                </div>
            </div>
            <div hidden>
                <div id="nodeTerm" class="flex">
                    <label class="w-[235px]"></label>
                    <label></label>
                    <label class="ml-2"></label>
                    <input type="checkbox" class="ml-2">
                </div>
            </div>
            <div class="mt-4 text-sm" id="divTerms">
                <label class="text-md font-semibold"><u>Termin Pembayaran :</u></label>
            </div>
        </div>
    </div>
    <div class="flex w-full items-end bg-stone-400 rounded-lg justify-end px-4 pt-2 border-b pb-2">
        <button class="flex justify-center items-center mx-1 btn-primary" title="Back" type="button"
            onclick="termBack()">
            <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" viewBox="0 0 24 24">
                <path
                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
            </svg>
            <span class="mx-1 text-white">Back</span>
        </button>
        <button class="flex justify-center items-center mx-1 btn-success" title="Next" type="button"
            onclick="termNext()">
            <span class="mx-1 text-white">Next</span>
            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24">
                <path
                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
            </svg>
        </button>
    </div>
</div>
