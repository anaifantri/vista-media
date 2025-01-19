<!-- billboard note start -->
<div class="flex justify-center">
    <div class="w-[725px] mt-2">
        <div class="flex">
            <label class="ml-1 text-sm text-black flex w-20">Catatan</label>
            <label class="ml-1 text-sm text-black flex">:</label>
        </div>
        <div id="notesQty">
            <div class="flex">
                <input id="ppnNote" class="ml-1 text-sm text-black outline-none w-full"
                    value="- Harga di atas belum termasuk PPN">
            </div>
            <div class="flex">
                <input class="ml-1 text-sm text-black outline-none w-full" value="- Harga tersebut termasuk :"
                    readonly></input>
            </div>
            <div class="flex">
                <label id="installNote" class="ml-4 text-sm text-black flex">• Free pemasangan materi visual</label>
                <input id="installQty"
                    class="ml-1 text-sm text-black in-out-spin-none outline-none w-8 text-center border rounded-md"
                    placeholder="0" type="number" value="" min="0">
                <label id="labelBBNote-3" class="ml-1 text-sm text-black flex">x selama kontrak</label>
            </div>
            <div class="flex">
                <label id="printNote" class="ml-4 text-sm text-black flex">• Free cetak materi visual</label>
                <input id="printQty"
                    class="ml-1 text-sm text-black in-out-spin-none outline-none w-8 text-center border rounded-md"
                    placeholder="0" type="number" value="" min="0">
                <label id="labelBBNote-3" class="ml-1 text-sm text-black flex">x selama kontrak</label>
            </div>
            <div class="flex">
                <input class="ml-1 text-sm text-black outline-none w-full"
                    value="   • Sewa Lokasi, konsumsi listrik selama kontrak, maintenance selama kontrak.">

            </div>
            <div class="flex">
                <input class="ml-1 text-sm text-black outline-none w-full"
                    value="- Harga & lokasi tidak mengikat, sewaktu-waktu dapat berubah sebelum ada persetujuan tertulis">
            </div>
            <div class="flex">
                <input class="ml-1 text-sm text-black outline-none w-full font-semibold"
                    value="- OOH Premium milik kami tersebar di Area Lombok, Bali, Jawa Timur dan Kalimantan">
            </div>
        </div>
        <div class="flex">
            <button id="btnAddNote" type="button" class="btn-add-note w-max h-5">
                <svg class="fill-current w-4" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                    stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm-.747 9.25h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                        fill-rule="nonzero" />
                </svg>Tambah Catatan</button>
            <button id="btnDelNote" type="button" class="btn-del-note w-max h-5">
                <svg class="fill-current w-4" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                    stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm4.253 9.25h-8.5c-.414 0-.75.336-.75.75s.336.75.75.75h8.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75z"
                        fill-rule="nonzero" />
                </svg>Hapus Catatan</button>
        </div>
        <div class="flex">
            <label class="ml-1 text-sm text-black flex">Sistem pembayaran :</label>
        </div>
        <div id="paymentTerms">
            <div class="flex">
                <label class="ml-1 text-sm">-</label>
                <input class="term-of-payment" type="number" min="0" max="100" value="100">
                <textarea class="text-area-notes" rows="1">% sebelum materi iklan tayang</textarea>
            </div>
        </div>
        <div>
            <div class="flex mt-2">
                <button id="btnAddPayment" type="button" class="btn-add-note w-max h-5">
                    <svg class="fill-current w-4" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm-.747 9.25h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                            fill-rule="nonzero" />
                    </svg>Tambah Termin Pembayaran</button>
                <button id="btnDelPayment" type="button" class="btn-del-note w-max h-5">
                    <svg class="fill-current w-4" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm4.253 9.25h-8.5c-.414 0-.75.336-.75.75s.336.75.75.75h8.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75z"
                            fill-rule="nonzero" />
                    </svg>Hapus Termin Pembayaran</button>
            </div>
        </div>
    </div>
    @error('note')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<!-- billboard note end -->
