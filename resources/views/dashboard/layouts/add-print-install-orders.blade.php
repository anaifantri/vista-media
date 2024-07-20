<!-- Add/View PO / SPK start -->
<form class="justify-center" action="/dashboard/marketing/print-install-orders" method="post"
    enctype="multipart/form-data">
    @csrf
    <!-- Add/View PO / SPK start -->
    <div id="modalPO" name="modalPO"
        class="absolute justify-center top-0 w-full h-full bg-black bg-opacity-90 z-50 hidden">
        <div>
            <input type="text" name="print_instal_quotation_id" value="{{ $sale->print_instal_quotation_id }}" hidden>
            <div class="flex mt-10">
                <button id="btnSave" type="submit" onclick="return confirm('Apakah anda yakin data sudah benar?')"
                    hidden></button>
                <button id="btnPOSubmit" class="flex justify-center items-center mx-1 btn-primary mb-2" title="Save"
                    type="button">
                    <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                    </svg>
                    <span class="ml-2 text-white">Save</span>
                </button>
                <button id="btnPOClear" class="flex justify-center items-center mx-1 btn-danger mb-2" title="Cancel"
                    type="button">
                    <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M13.5 2c-5.621 0-10.211 4.443-10.475 10h-3.025l5 6.625 5-6.625h-2.975c.257-3.351 3.06-6 6.475-6 3.584 0 6.5 2.916 6.5 6.5s-2.916 6.5-6.5 6.5c-1.863 0-3.542-.793-4.728-2.053l-2.427 3.216c1.877 1.754 4.389 2.837 7.155 2.837 5.79 0 10.5-4.71 10.5-10.5s-4.71-10.5-10.5-10.5z" />
                    </svg>
                    <span class="ml-2 text-white">Clear</span>
                </button>
                <div class="flex justify-end px-2 w-full">
                    <button id="btnPOClose" class="flex" title="Close" type="button">
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
                                accept="image/png, image/jpg, image/jpeg" onchange="previewPOImage()" multiple>
                        </div>
                        <div class="my-2 border-b-2 border-teal-700">
                            <div class="flex items-center mt-1">
                                <label class="text-sm text-teal-700 w-32">Nomor PO / SPK</label>
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
                                <label id="numberPOFile" class="text-sm text-teal-700 ml-2">No Files Chosen</label>
                            </div>
                        </div>
                        <figure class="flex w-[750px] justify-center overflow-x-auto border-b-2 border-teal-700"
                            id="poImg">

                        </figure>
                        <div class="relative m-auto w-[750px] h-max">
                            <div id="prevPOButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                                <button
                                    class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
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
    <!-- Add/View PO / SPK end -->
</form>
<!-- Add/View PO / SPK end -->
