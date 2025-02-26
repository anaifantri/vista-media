<div id="modalPreview" hidden>
    <div class="flex w-full">
        <span class="text-center w-full text-lg font-bold text-white">Preview BAST</span>
    </div>

    <!-- BAST start -->
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
    <!-- BAST end -->

    <!-- Documentation start -->
    <div class="flex justify-center w-full mt-2">
        <div class="w-[950px] h-[1345px] mt-1 bg-white p-4">
            <!-- Header start -->
            @include('dashboard.layouts.letter-header')
            <!-- Header end -->

            <!-- Body start -->
            <div class="h-[1100px] w-full flex justify-center mt-2">
                <div class="flex justify-center w-full">
                    <div class="w-[780px]">
                        <div class="flex justify-center w-full font-serif mt-4 text-md tracking-wider font-bold">
                            <label class="border-b-2 border-black">
                                DOKUMENTASI PEKERJAAN
                            </label>
                        </div>
                        <div class="flex w-full font-serif text-sm tracking-wider font-bold ml-24 mt-8">
                            <span class="w-28">Pekerjaan</span>
                            <span>:</span>
                            <span class="ml-2">{{ $content->type }}</span>
                        </div>
                        <div class="flex w-full font-serif text-sm tracking-wider font-bold ml-24">
                            <span class="w-28">Lokasi</span>
                            <span>:</span>
                            <span class="ml-2">{{ $product->address }}</span>
                        </div>
                        @if ($sale->media_category->name == 'Service')
                            <div class="flex w-full font-serif text-sm tracking-wider font-bold ml-24">
                                <span class="w-28">Tema</span>
                                <span>:</span>
                                <span class="ml-2">{{ $content->theme }}</span>
                            </div>
                        @else
                            <div class="flex w-full font-serif text-sm tracking-wider font-bold ml-24">
                                <span class="w-28">Periode</span>
                                <span>:</span>
                                <span class="ml-2">{{ $content->periode }}</span>
                            </div>
                        @endif
                        <div class="flex w-full justify-center font-serif mt-6 text-sm font-semibold">
                            <label id="firstPhotoTitle"><u>{{ $firstPhoto->title }}</u></label>
                        </div>
                        <div class="flex justify-center w-full mt-2">
                            @if (count($first_photos) > 0)
                                <img id="previewFirstPhoto"
                                    class="border m-auto w-[600px] h-[410px] flex items-center bg-white rounded-lg"
                                    src="{{ asset('storage/' . $first_photos[0]->image) }}">
                            @else
                                <img id="previewFirstPhoto"
                                    class="border m-auto w-[600px] h-[410px] flex items-center bg-white rounded-lg"
                                    src="/img/product-image.png">
                            @endif
                        </div>
                        <div class="flex w-full justify-center font-serif mt-6 text-sm font-semibold">
                            <label id="secondPhotoTitle"><u>{{ $secondPhoto->title }}</u></label>
                        </div>
                        <div class="flex justify-center w-full mt-2">
                            @if (count($second_photos) > 0)
                                <img id="previewSecondPhoto"
                                    class="border m-auto w-[600px] h-[410px] flex items-center bg-white rounded-lg"
                                    src="{{ asset('storage/' . $second_photos[0]->image) }}">
                            @else
                                <img id="previewSecondPhoto"
                                    class="border m-auto w-[600px] h-[410px] flex items-center bg-white rounded-lg"
                                    src="/img/product-image.png">
                            @endif
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
    <!-- Documentation end -->
</div>
