<!-- Modal Add Document start -->
<div id="modalImages" class="absolute justify-center top-0 w-full h-[900px] bg-black bg-opacity-90 z-50 hidden">
    <div>
        <div class="flex mt-10">
            <button id="btnSubmit" class="flex justify-center items-center mx-1 btn-primary mb-2" title="Submit"
                type="button">
                <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path
                        d="m20 20h-15.25c-.414 0-.75.336-.75.75s.336.75.75.75h15.75c.53 0 1-.47 1-1v-15.75c0-.414-.336-.75-.75-.75s-.75.336-.75.75zm-1-17c0-.478-.379-1-1-1h-15c-.62 0-1 .519-1 1v15c0 .621.52 1 1 1h15c.478 0 1-.379 1-1zm-12.751 8.306c-.165-.147-.249-.351-.249-.556 0-.411.333-.746.748-.746.178 0 .355.062.499.19l2.371 2.011 4.453-4.962c.149-.161.35-.243.554-.243.417 0 .748.336.748.746 0 .179-.065.359-.196.503l-4.953 5.508c-.148.161-.35.243-.553.243-.177 0-.356-.063-.498-.19z"
                        fill-rule="nonzero" />
                </svg>
                <span class="ml-2 text-white">Submit</span>
            </button>
            <button id="btnClear" class="flex justify-center items-center mx-1 btn-danger mb-2" title="Clear"
                type="button">
                <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path
                        d="M13.5 2c-5.621 0-10.211 4.443-10.475 10h-3.025l5 6.625 5-6.625h-2.975c.257-3.351 3.06-6 6.475-6 3.584 0 6.5 2.916 6.5 6.5s-2.916 6.5-6.5 6.5c-1.863 0-3.542-.793-4.728-2.053l-2.427 3.216c1.877 1.754 4.389 2.837 7.155 2.837 5.79 0 10.5-4.71 10.5-10.5s-4.71-10.5-10.5-10.5z" />
                </svg>
                <span class="ml-2 text-white">Clear</span>
            </button>
            <div class="flex justify-end px-2 w-full">
                <button id="btnClose" class="flex" title="Close" type="button" onclick="btnClose()">
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
                    <div class="flex justify-center w-full border-b p-1">
                        <label id="title" class="text-sm text-teal-700 font-semibold"></label>
                    </div>
                    <div class="my-2 border-b-2 border-teal-700 py-2">
                        <div id="documentNumber"class="flex items-center mt-1">
                            <label class="text-sm text-teal-700 w-20">Nomor</label>
                            <label class="text-sm text-teal-700 ml-2">:</label>
                            <input id="inputNumber"
                                class="text-sm px-2 text-teal-700 ml-2 outline-none border rounded-lg border-teal-700"
                                type="text" placeholder="input nomor">
                        </div>
                        <div id="documentDate" class="flex items-center mt-1">
                            <label class="text-sm text-teal-700 w-20">Tanggal</label>
                            <label class="text-sm text-teal-700 ml-2">:</label>
                            <input id="inputDate"
                                class="text-sm text-teal-700 ml-2 px-2 outline-none border rounded-lg border-teal-700"
                                type="date">
                        </div>
                        <div class="flex items-center mt-1">
                            <label class="text-sm text-teal-700 w-20">Jumlah File</label>
                            <label class="text-sm text-teal-700 ml-2">:</label>
                            <label id="numberImagesFile" class="text-sm text-teal-700 ml-2">Tidak Ada File Yang
                                Dipilih</label>
                            <button id="btnChooseImages"
                                class="flex justify-center items-center w-44 btn-primary-small ml-4" title="Chose Files"
                                type="button" onclick="inputImages(this)">
                                <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                    clip-rule="evenodd" viewBox="0 0 24 24">
                                    <path
                                        d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                </svg>
                                <span class="ml-2">Pilih Dokumen</span>
                            </button>
                        </div>
                    </div>
                    <figure class="flex w-[750px] justify-center overflow-x-auto border-b-2 border-teal-700"
                        id="figureImages">

                    </figure>
                    <div class="relative m-auto w-[750px] h-max">
                        <div id="prevButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                            <button
                                class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                type="button" onclick="prevButtonAction()">
                                <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                    clip-rule="evenodd" viewBox="0 0 24 24">
                                    <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                </svg>
                            </button>
                        </div>
                        <div id="nextButton" class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                            <button type="button"
                                class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                onclick="nextButtonAction()">
                                <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                    clip-rule="evenodd" viewBox="0 0 24 24">
                                    <path d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                </svg>
                            </button>
                        </div>
                        <div id="slidesPreview" class="mt-2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Add Document end -->
