<!-- Add PO / SPK start -->
<form class="justify-center" action="/dashboard/marketing/client-orders" method="post" enctype="multipart/form-data">
    @csrf
    <div id="modalPO" name="modalPO"
        class="absolute justify-center top-0 w-full h-max bg-black bg-opacity-90 z-50 hidden">
        <div>
            <div class="flex mt-10">
                <div class="flex w-[212px]">
                    <button id="btnPOSave" type="submit" onclick="return confirm('Apakah anda yakin data sudah benar?')"
                        hidden></button>
                    <button id="btnPOUpload" class="flex justify-center items-center mx-1 btn-primary mb-2"
                        title="Upload" type="button">
                        <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path
                                d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                        </svg>
                        <span class="ml-2 text-white">Save</span>
                    </button>
                    <button id="btnPOClear" class="flex justify-center items-center mx-1 btn-danger mb-2" title="Clear"
                        type="button">
                        <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path
                                d="M13.5 2c-5.629 0-10.212 4.436-10.475 10h-3.025l4.537 5.917 4.463-5.917h-2.975c.26-3.902 3.508-7 7.475-7 4.136 0 7.5 3.364 7.5 7.5s-3.364 7.5-7.5 7.5c-2.381 0-4.502-1.119-5.876-2.854l-1.847 2.449c1.919 2.088 4.664 3.405 7.723 3.405 5.798 0 10.5-4.702 10.5-10.5s-4.702-10.5-10.5-10.5z" />
                        </svg>
                        <span class="ml-2 text-white">Clear</span>
                    </button>
                </div>
                <div id="btnClosePO" class="flex w-[588px] justify-end">
                    <button class="flex" title="Close" type="button">
                        <svg class="fill-white w-6 m-auto hover:fill-red-600" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="w-[800px] h-max bg-white mt-2 p-4 mb-96">
                <div class="flex justify-center">
                    <div>
                        <div class="flex justify-center w-full m-2">
                            <button id="btnChosePO" name="btnChosePO"
                                class="flex justify-center items-center w-44 btn-primary" title="Chose Files"
                                type="button" onclick="document.getElementById('documentPO').click()">
                                <svg class="fill-current w-[18px]" xmlns="http://www.w3.org/2000/svg"
                                    fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                    <path
                                        d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                </svg>
                                <span class="ml-2">Chose Images</span>
                            </button>
                            <input class="hidden" id="documentPO" name="document_po[]" type="file"
                                accept="image/png, image/jpg, image/jpeg" onchange="chosePOImage()" multiple>
                        </div>
                        <div class="my-2 border-b-2 border-teal-700">
                            <input type="text" name="po_billboard_quotation_id" id="poBillboardQuotationId" hidden>
                            <input type="text" name="po_billboard_quot_revision_id" id="poBillboardQuotRevisionId"
                                hidden>
                            <div class="flex items-center mt-1">
                                <label class="text-sm text-teal-700 w-32">Jenis</label>
                                <label class="text-sm text-teal-700 ml-2">:</label>
                                <input class="ml-2" type="radio" name="order_name" id="order_po" value="po"
                                    checked>
                                <label class="text-sm text-teal-700 ml-2">PO</label>
                                <input class="ml-2" type="radio" name="order_name" id="order_spk" value="spk">
                                <label class="text-sm text-teal-700 ml-2">SPK</label>
                            </div>
                            <div class="flex items-center mt-1">
                                <label class="text-sm text-teal-700 w-32">Nomor PO/SPK</label>
                                <label class="text-sm text-teal-700 ml-2">:</label>
                                <input
                                    class="px-2 text-sm text-teal-700 ml-2 outline-none border rounded-lg border-teal-700"
                                    type="text" id="order_number" name="order_number"
                                    placeholder="input nomor PO/SPK">
                            </div>
                            <div class="flex items-center mt-1">
                                <label class="text-sm text-teal-700 w-32">Tanggal PO/SPK</label>
                                <label class="text-sm text-teal-700 ml-2">:</label>
                                <input
                                    class="text-sm text-teal-700 ml-2 outline-none px-2 border rounded-lg border-teal-700"
                                    type="date" id="order_date" name="order_date">
                            </div>
                            <div class="flex items-center mt-1">
                                <label class="text-sm text-teal-700 w-32">Jumlah File</label>
                                <label class="text-sm text-teal-700 ml-2">:</label>
                                <label id="numberPOFile" class="text-sm text-teal-700 ml-2">No Files
                                    Chosen</label>
                            </div>
                        </div>
                        <figure class="flex w-[750px] justify-center overflow-x-auto border-b-2 border-teal-700"
                            id="poImg">

                        </figure>
                        <div class="relative m-auto w-[750px] h-max">
                            <div id="prevPOButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                                <button
                                    class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                    type="button">
                                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                        fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path
                                            d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                    </svg>
                                </button>
                            </div>
                            <div id="nextPOButton" class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                                <button type="button"
                                    class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer">
                                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                        fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path
                                            d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                    </svg>
                                </button>
                            </div>
                            <div id="slidesPOPreview" class="mt-2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Add PO / SPK end -->
