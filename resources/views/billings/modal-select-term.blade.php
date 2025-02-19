<div id="modalSelectTerm" hidden>
    <div class="flex w-full bg-stone-400 rounded-xl items-center px-10 pt-2 border-b pb-2">
        <span class="text-center w-full text-lg font-semibold">Pilih Termin Pembayaran Yang Akan Ditagihkan?</span>
    </div>
    <div
        class="flex w-full h-[350px] bg-stone-200 justify-center border rounded-lg border-stone-400 my-2 p-2 border-b pb-2">
        <div class="w-[575px] p-2 border rounded-lg border-stone-900">
            <div hidden>
                <div id="nodeTerm" class="flex">
                    <label class="w-[235px]"></label>
                    <label></label>
                    <label class="ml-2 w-[90px] text-right"></label>
                    <label></label>
                    <input type="checkbox" class="ml-6" onclick="cbTermAction(this)">
                </div>
            </div>
            <div class="flex text-md font-semibold">
                <input name="termType" type="radio" onclick="rbAutoTerm(this)" checked>
                <label class="ml-2">Berdasarkan Termin Pembayaran :</label>
            </div>
            <div class="mt-2 text-sm" id="divTerms">
            </div>
        </div>
        <div class="ml-4 w-[575px] p-2 border rounded-lg border-stone-900">
            <div class="flex text-md font-semibold">
                <input name="termType" type="radio" onclick="rbManualTerm(this)">
                <label class="ml-2">Input manual :</label>
            </div>
            <div class="mt-2 text-sm" id="divManualTerms">
                <div class="border rounded-md border-stone-900 p-1">
                    <div class="flex">
                        <input type="checkbox" disabled>
                        <input type="text" class="ml-2 px-2 outline-none w-[500px] rounded-md"
                            value="Produksi Media Luar Ruang" disabled>
                    </div>
                    <div class="flex mt-1 ml-7">
                        <label>Nominal</label>
                        <input id="nominalTerm" type="number"
                            class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0"
                            disabled>
                        <label class="ml-2">DPP</label>
                        <input id="dppterm" type="number"
                            class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0"
                            disabled>
                        <label class="ml-2">PPN</label>
                        <input id="ppnterm" type="number"
                            class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md" placeholder="0"
                            disabled readonly>
                    </div>
                </div>
                <div class="border rounded-md border-stone-900  mt-1 p-1">
                    <div class="flex">
                        <input type="checkbox" disabled>
                        <input type="text" class="ml-2 px-2 outline-none w-[500px] rounded-md"
                            value="Pemakaian Listrik Media Luar Ruang" disabled>
                    </div>
                    <div class="flex mt-1 ml-7">
                        <label>Nominal</label>
                        <input id="nominalTerm" type="number"
                            class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0"
                            disabled>
                        <label class="ml-2">DPP</label>
                        <input id="dppterm" type="number"
                            class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0"
                            disabled>
                        <label class="ml-2">PPN</label>
                        <input id="ppnterm" type="number"
                            class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md" placeholder="0"
                            disabled readonly>
                    </div>
                </div>
                <div class="border rounded-md border-stone-900  mt-1 p-1">
                    <div class="flex">
                        <input type="checkbox" disabled>
                        <input type="text" class="ml-2 px-2 outline-none w-[500px] rounded-md"
                            value="Jasa Media Luar Ruang" disabled>
                    </div>
                    <div class="flex mt-1 ml-7">
                        <label>Nominal</label>
                        <input id="nominalTerm" type="number"
                            class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0"
                            disabled>
                        <label class="ml-2">DPP</label>
                        <input id="dppterm" type="number"
                            class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0"
                            disabled>
                        <label class="ml-2">PPN</label>
                        <input id="ppnterm" type="number"
                            class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md" placeholder="0"
                            disabled readonly>
                    </div>
                </div>
                <div class="border rounded-md border-stone-900  mt-1 p-1">
                    <div class="flex">
                        <input type="checkbox" disabled>
                        <input type="text" class="ml-2 px-2 outline-none w-[500px] rounded-md" value="Pajak Reklame"
                            disabled readonly>
                    </div>
                    <div class="flex mt-1 ml-7">
                        <label>Nominal</label>
                        <input id="nominalTerm" type="number"
                            class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0"
                            disabled>
                        <label class="ml-2">DPP</label>
                        <input id="dppterm" type="number"
                            class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0"
                            disabled hidden>
                        <label class="ml-2">PPN</label>
                        <input id="ppnterm" type="number"
                            class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md" placeholder="0"
                            disabled readonly hidden>
                    </div>
                </div>
                <div class="border rounded-md border-stone-900  mt-1 p-1">
                    <div class="flex">
                        <input type="checkbox" disabled>
                        <input type="text" class="ml-2 px-2 outline-none w-[500px] rounded-md"
                            placeholder="Lainnya" disabled>
                    </div>
                    <div class="flex mt-1 ml-7">
                        <label>Nominal</label>
                        <input id="nominalTerm" type="number"
                            class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0"
                            disabled>
                        <label class="ml-2">DPP</label>
                        <input id="dppterm" type="number"
                            class="ml-2 px-2 outline-none w-24 text-right in-out-spin-none rounded-md" placeholder="0"
                            disabled>
                        <label class="ml-2">PPN</label>
                        <input id="ppnterm" type="number"
                            class="ml-2 px-2 outline-none w-20 text-right in-out-spin-none rounded-md" placeholder="0"
                            disabled readonly>
                    </div>
                </div>
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
