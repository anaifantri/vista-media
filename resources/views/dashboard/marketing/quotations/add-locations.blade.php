<!-- Add location start -->
<div id="modal" name="modal"
    class="absolute justify-center top-0 w-full h-[1000px] bg-black bg-opacity-90 z-50 hidden">
    <div>
        <div class="flex justify-end">
            <button id="btn-close" name="btn-close" class="flex mr-50 mt-10" title="Close">
                <svg class="fill-white w-6 m-auto hover:fill-red-600" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24">
                    <path
                        d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                </svg>
            </button>
        </div>
        <div class="w-[750px] h-[530px] bg-white mt-2">
            <div class="flex justify-center items-center border-b py-1">
                <h1 class="text-xl text-cyan-800 font-bold tracking-wider">DAFTAR LOKASI</h1>
            </div>
            <div class="flex mt-2 ml-7">
                <div class="flex">
                    <input id="search" name="search"
                        class="flex border rounded-l-lg ml-2 p-1 outline-none text-base text-teal-900" type="text"
                        placeholder="Search" onkeyup="searchTable()">
                    <button class="flex border p-1 rounded-r-lg text-slate-700 justify-center w-10 bg-slate-50"
                        type="button">
                        <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z" />
                        </svg>
                    </button>
                </div>
                <div class="flex justify-end w-full mr-2">
                    <button type="button" id="getSelected" class="index-link btn-primary">
                        <span class="mx-1">Submit</span>
                    </button>
                </div>
            </div>
            <div class="justify-center ml-2 h-[500px]">
                <div class="mt-2 h-96 bg-slate-50 overflow-y-scroll">
                    <table id="locationsTable" class="table-auto mt-2">
                        <thead>
                            <tr>
                                <th class="text-sm text-teal-700 border w-8" rowspan="2">No</th>
                                <th class="text-sm text-teal-700 border w-20" rowspan="2">Kode</th>
                                <th class="text-sm text-teal-700 border w-64" rowspan="2">Lokasi</th>
                                <th class="text-sm text-teal-700 border w-52" colspan="3">Deskripsi</th>
                                <th class="text-sm text-teal-700 border w-28" rowspan="2">harga</th>
                                <th class="text-sm text-teal-700 border w-10" rowspan="2"></th>
                            </tr>
                            <tr>
                                <th id="tHead4" class="text-sm text-teal-700 border w-10"></th>
                                <th id="tHead5" class="text-sm text-teal-700 border w-10"></th>
                                <th class="text-sm text-teal-700 border w-32">Size-Side-V/H</th>
                            </tr>
                        </thead>
                        <tbody id="locationTBody">

                        </tbody>
                    </table>
                </div>
                <div>
                    <label class="text-sm text-teal-900">* Silahkan pilih maksimal 5 lokasi</label>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add location end -->
