<!-- View PO / SPK start -->
<div id="modalViewPO" name="modalViewPO"
    class="absolute justify-center top-0 w-full h-full bg-black bg-opacity-90 z-50 hidden">
    <div>
        <input type="text" name="print_instal_quotation_id" value="{{ $sale->print_instal_quotation_id }}" hidden>
        <div class="flex mt-10">
            <div class="flex justify-end px-2 w-full">
                <button id="btnViewPOClose" class="flex" title="Close" type="button">
                    <svg class="fill-gray-500 w-6 m-auto hover:fill-red-700" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="w-[800px] h-max bg-white mt-2 p-4">
            <div class="flex justify-center">
                <div>
                    <div class="my-2 border-b-2 border-teal-700">
                        <div class="flex items-center mt-1">
                            <label class="text-sm text-teal-700 w-32">Nama Dokumen</label>
                            <label class="text-sm text-teal-700 ml-2">:</label>
                            <label id="labelDocumentName" class="text-sm text-teal-700 ml-2"></label>
                        </div>
                        <div class="flex items-center mt-1">
                            <label class="text-sm text-teal-700 w-32">Nomor</label>
                            <label class="text-sm text-teal-700 ml-2">:</label>
                            <label id="labelOrderNumber" class="text-sm text-teal-700 ml-2"></label>
                        </div>
                        <div class="flex items-center mt-1">
                            <label class="text-sm text-teal-700 w-32">Tanggal</label>
                            <label class="text-sm text-teal-700 ml-2">:</label>
                            <label id="labelOrderDate" class="text-sm text-teal-700 ml-2"></label>
                        </div>
                        <div class="flex items-center mt-1">
                            <label class="text-sm text-teal-700 w-32">Jumlah File</label>
                            <label class="text-sm text-teal-700 ml-2">:</label>
                            <label id="numberViewPOFile" class="text-sm text-teal-700 ml-2"></label>
                        </div>
                    </div>
                    <figure class="flex w-[750px] justify-center overflow-x-auto border-b-2 border-teal-700"
                        id="poViewImg">

                    </figure>
                    <div class="relative m-auto w-[750px] h-max">
                        <div id="prevViewPOButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                            <button
                                class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                type="button">
                                <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                    clip-rule="evenodd" viewBox="0 0 24 24">
                                    <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                </svg>
                            </button>
                        </div>
                        <div id="nextViewPOButton" class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                            <button type="button"
                                class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer">
                                <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                    clip-rule="evenodd" viewBox="0 0 24 24">
                                    <path d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                </svg>
                            </button>
                        </div>
                        <div id="slidesViewPO" class="mt-2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- View PO / SPK end -->
