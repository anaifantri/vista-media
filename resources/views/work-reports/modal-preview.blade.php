<div id="modalPreview" hidden>
    <div class="flex w-full">
        <span class="text-center w-full text-lg font-bold text-white">Preview Invoice & Kwitansi</span>
    </div>

    <!-- Surat Invoice start -->
    <div class="flex justify-center w-full mt-4">
        <div>
            <div class="flex items-center w-[950px] border rounded-md px-2">
                <span class="text-sm font-semibold text-white">Pilih format BAST :</span>
                <input type="radio" name="bast_format" class="ml-4 outline-none" checked>
                <span class="ml-2 text-sm font-semibold text-white">Standard</span>
                <input type="radio" name="bast_format" class="ml-4 outline-none">
                <span class="ml-2 text-sm font-semibold text-white">LEP GG</span>
                <input type="radio" name="bast_format" class="ml-4 outline-none">
                <span class="ml-2 text-sm font-semibold text-white">BAPP GG</span>
                <input type="radio" name="bast_format" class="ml-4 outline-none">
                <span class="ml-2 text-sm font-semibold text-white">BAPP Sampoerna</span>
                <input type="radio" name="bast_format" class="ml-4 outline-none">
                <span class="ml-2 text-sm font-semibold text-white">BAPP Djarum</span>
                <input type="radio" name="bast_format" class="ml-4 outline-none">
                <span class="ml-2 text-sm font-semibold text-white">BAPP XL</span>
            </div>
            <div class="w-[950px] h-[1345px] mt-4 bg-white p-4">
                <!-- Header start -->
                @include('dashboard.layouts.letter-header')
                <!-- Header end -->
                <!-- Body start -->
                <div class="h-[1100px] w-full flex justify-center mt-2">
                    <!-- Standard BAST start -->
                    @include('work-reports.bast-standard')
                    <!-- Standard BAST end -->

                    <!-- LEP GG start -->
                    {{-- @include('work-reports.lep-gg') --}}
                    <!-- LEP GG end -->

                </div>
                <!-- Body end -->
                <!-- Footer start -->
                @include('dashboard.layouts.letter-footer')
                <!-- Footer end -->
            </div>
        </div>
    </div>
    <!-- Surat Invoice end -->

    <!-- Kwitansi start -->
    <div class="flex justify-center w-full mt-2">
        <div class="w-[950px] h-[1345px] mt-1 bg-white p-4">
            <!-- Header start -->
            @include('dashboard.layouts.letter-header')
            <!-- Header end -->

            <!-- Body start -->
            <div class="h-[1100px] w-full flex justify-center mt-2">
                <div class="flex justify-center w-full">
                    <div class="w-[780px]">
                        <div class="flex justify-center w-full font-serif mt-4 text-lg tracking-wider font-bold">
                            <label class="border-b-2 border-black">
                                DOKUMENTASI PEKERJAAN
                            </label>
                        </div>
                        <div class="flex justify-center w-full">
                            <div class="w-60 border-t-2 border-black mt-2"></div>
                        </div>
                        <div class="flex justify-center w-full font-serif mt-4 text-md font-semibold">
                            <label>
                                Lokasi :
                            </label>
                        </div>
                        <div class="flex w-full font-serif mt-6 text-md font-semibold">
                            <label class="ml-16">
                                Foto Siang
                            </label>
                        </div>
                        <div class="flex justify-center w-full mt-1">
                            <img class="border m-auto w-[650px] img-preview-first flex items-center bg-white rounded-lg"
                                src="/img/product-image.png">
                        </div>
                        <div class="flex w-full font-serif mt-6 text-md font-semibold">
                            <label class="ml-16">
                                Foto Malam
                            </label>
                        </div>
                        <div class="flex justify-center w-full mt-1">
                            <img class="border m-auto w-[650px] img-preview-first flex items-center bg-white rounded-lg"
                                src="/img/product-image.png">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Body end -->

            <!-- Footer start -->
            @include('dashboard.layouts.letter-footer')
            <!-- Footer end -->
        </div>
    </div>
    <!-- Kwitansi end -->
</div>
