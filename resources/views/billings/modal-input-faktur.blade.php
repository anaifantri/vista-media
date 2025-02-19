<div id="modalInputFaktur" hidden>
    <div class="flex w-full bg-stone-400 rounded-xl items-center px-10 pt-2 border-b pb-2">
        <span class="text-center w-full text-lg font-semibold">Upload Faktur PPN</span>
    </div>
    <div
        class="flex w-full h-[350px] bg-stone-200 justify-center border rounded-lg border-stone-400 my-2 p-4 border-b pb-2">
        <div class="w-[1150px] p-2">
            <div class="flex text-sm">
                <label class="w-28 p-1">Nomor Faktur</label>
                <label class="p-1">:</label>
                <input class="w-60 ml-2 border rounded-md p-1 outline-none" type="text" id="number" name="number">
            </div>
            <div class="flex text-sm mt-2">
                <label class="w-28 p-1">Tgl. Faktur</label>
                <label class="p-1">:</label>
                <input class="w-60 ml-2 border rounded-md p-1 outline-none" type="date" id="taxDate"
                    name="tax_date">
            </div>
            <div class="flex text-sm mt-2">
                <label class="w-28 p-1">Faktur</label>
                <label class="p-1">:</label>
                <input class="ml-2 outline-none border rounded-r-md w-60 bg-white" id="images" name="images[]"
                    type="file" accept="image/png, image/jpg, image/jpeg" multiple>
            </div>
        </div>
    </div>
    <div class="flex w-full items-end bg-stone-400 rounded-lg justify-end px-4 pt-2 border-b pb-2">
        <button class="flex justify-center items-center mx-1 btn-primary" title="Back" type="button"
            onclick="fakturBack()">
            <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" viewBox="0 0 24 24">
                <path
                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
            </svg>
            <span class="mx-1 text-white">Back</span>
        </button>
        <button class="flex justify-center items-center mx-1 btn-success" title="Next" type="button"
            onclick="fakturNext()">
            <span class="mx-1 text-white">Next</span>
            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24">
                <path
                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
            </svg>
        </button>
    </div>
</div>
