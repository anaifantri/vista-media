@extends('dashboard.layouts.main');

@section('container')
    <!-- Preview Billboard start -->
    <div id="modal" name="modal"
        class="absolute justify-center top-0 w-full h-[1500px] bg-black bg-opacity-90 z-50 hidden">
        <div>
            <div class="flex w-[360px] sm:w-[640px] md:w-[768px] h-8 mt-2">
                <div class="flex relative items-center">
                    <button title="Export to PNG" id="btn-png" name="btn-png"
                        class="flex justify-center items-center mx-1 btn-warning">Save as
                        PNG</button>
                    <button title="Export to PDF" id="btn-pdf" name="btn-pdf"
                        class="flex justify-center items-center mx-1 btn-danger">Save as
                        PDF</button>
                    <?php
                    $src = 'https://maps.googleapis.com/maps/api/staticmap?center=' . $product->lat . ',' . $product->lng . '&zoom=15&size=480x355&maptype=terrain&markers=icon:https://vistamedia.co.id/img/marker-red.png%7C' . $product->lat . ',' . $product->lng . '&key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg';
                    $destFolder = 'img/map/';
                    $fromFolder = 'http://vista-app.test/img/map/';
                    $mapImgName = 'google-map.PNG';
                    $imagePath = $destFolder . $mapImgName;
                    file_put_contents($imagePath, file_get_contents($src));
                    ?>
                    <button id="btn-close" name="btn-close"
                        class="flex absolute justify-center items-center ml-[310px] sm:ml-[590px] md:ml-[718px]"
                        title="Close">
                        <svg class="fill-white w-6 m-auto hover:fill-red-600" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                        </svg>
                    </button>
                </div>
            </div>
            <div id="preview" name="preview"
                class="w-[360px] h-[506px ] sm:w-[640px] sm:h-[900px] md:w-[768px] md:h-[1080px] mt-1 bg-white">
                <div class="flex w-full justify-center items-center mt-2">
                    <img class="w-[45px] sm:w-[80px] md:w-[96px] mt-2" src="/img/logo-vm.png" alt="">
                </div>
                <div class="flex w-full justify-center items-center mt-2">
                    <img class="w-full" src="/img/line-top.png" alt="">
                </div>
                <div class="flex w-full h-[18px] sm:h-[32px] md:h-[38px] justify-center items-center mt-1">
                    <div
                        class="flex w-[315px] sm:w-[560px] md:w-[672px] h-[18px] sm:h-[32px] md:h-[38px] justify-start items-center bg-slate-50 border rounded-t-xl">
                        <span
                            class="flex justify-end items-center w-[38px] sm:w-[67px] md:w-[80px] h-[8px] sm:h-[13px] md:h-[16px] text-[0.65rem] sm:text-xs md:text-sm text-red-700 font-semibold">{{ $product->code }}</span>
                        <span
                            class="flex justify-start items-center w-[38px] sm:w-[67px] md:w-[80px] h-[8px] sm:h-[13px] md:h-[16px] text-[0.65rem] sm:text-xs md:text-sm font-semibold ml-1">
                            -
                            {{ $product->city->code }}</span>
                        <img class="h-[8px] sm:h-[13px] md:h-[16px]" src="/img/code-line.png" alt="">
                        <span
                            class="flex items-center w-[225px] sm:w-[400px] md:w-[480px] h-[8px] sm:h-[13px] md:h-[16px] text-[0.65rem] sm:text-xs md:text-sm lg:font-semibold">{{ $product->address }}</span>
                    </div>
                </div>
                <div class="flex w-full h-[210px] sm:h-[373px] md:h-[448px] justify-center mt-[1px]">
                    <div
                        class="flex w-[315px] sm:w-[560px] md:w-[672px] h-[210px] sm:h-[373px] md:h-[448px] justify-center items-center bg-slate-50 border rounded-b-xl">
                        <img class="m-auto w-[300px] sm:w-[533px] md:w-[640px] h-[195px] sm:h-[347px] md:h-[416px]"
                            src="{{ asset('storage/' . $product->photo) }}" alt="">
                    </div>
                </div>
                <div class="flex w-full h-[160px] sm:h-[293px] md:h-[352px] justify-center mt-1">
                    <div class="flex w-[315px] sm:w-[560px] md:w-[672px] h-[160px] sm:h-[293px] md:h-[352px] bg-white">
                        <div
                            class="flex w-[210px] sm:w-[373px] md:w-[448px] h-[160px] sm:h-[293px] md:h-[352px] bg-white justify-center">
                            <div class="">
                                <input id="lat" name="lat" type="text" value="{{ $product->lat }}" hidden>
                                <input id="lng" name="lng" type="text" value="{{ $product->lng }}" hidden>
                                <input id="code" name="code" type="text" value="{{ $product->code }}" hidden>
                                <div
                                    class="flex w-[210px] sm:w-[373px] md:w-[448px] h-[12px] sm:h-[21px] md:h-[26px] bg-slate-50 items-center border justify-center rounded-t-lg text-[0.4rem] sm:text-xs md:text-sm font-bold font-mono text-teal-900">
                                    Google Maps
                                    Koordinat :
                                    {{ number_format($product->lat, 7) . ', ' . number_format($product->lng, 7) }}
                                </div>
                                <div
                                    class="flex w-[210px] sm:w-[373px] md:w-[448px] h-[153px] sm:h-[272px] md:h-[326px] mt-[1px] rounded-b-lg">
                                    <span
                                        class="flex absolute w-[38px] sm:w-[67px] md:w-[80px] mt-[91px] sm:mt-[163px] md:mt-[195px] ml-1">
                                        {{ QrCode::size(80)->generate('https://www.google.co.id/maps/place/' . $product->lat . ',' . $product->lng . '/@' . $product->lat . ',' . $product->lng . ',15z') }}
                                    </span>
                                    <img class="w-[210px] sm:w-[373px] md:w-[448px] h-[153px] sm:h-[272px] md:h-[326px] border rounded-b-xl"
                                        id="myImage" name="myImage" src="{{ $fromFolder . $mapImgName }}" alt="">

                                </div>
                            </div>
                        </div>
                        <div
                            class="flex w-[102px] sm:w-[181px] md:w-[218px] h-[160px] sm:h-[293px] md:h-[352px] bg-white justify-center ml-1">
                            <div class="">
                                <div
                                    class="flex w-[102px] sm:w-[181px] md:w-[218px] h-[12px] sm:h-[21px] md:h-[26px] p-1 items-center justify-center bg-slate-50 border rounded-t-lg text-[0.5rem] sm:text-xs md:text-sm font-semibold font-mono text-teal-900">
                                    Deskripsi Billboard
                                </div>
                                <div
                                    class="w-[102px] sm:w-[181px] md:w-[218px] h-[51px] sm:h-[91px] md:h-[109px] bg-slate-50 mt-[1px] rounded-b-lg border">
                                    <div class="flex mt-1">
                                        <span
                                            class="w-[36px] sm:w-[73px] md:w-[88px] text-[0.4rem] sm:text-[0.4rem] md:text-[0.65rem] font-sans font-bold text-teal-900 ml-2">Jenis</span>
                                        <span
                                            class="text-[0.4rem] sm:text-[0.4rem] md:text-[0.65rem] font-sans font-bold text-teal-900">:
                                            {{ $product->category }} </span>
                                    </div>
                                    <div class="flex">
                                        <span
                                            class="w-[36px] sm:w-[73px] md:w-[88px] text-[0.4rem] sm:text-[0.4rem] md:text-[0.65rem] font-sans font-bold text-teal-900 ml-2">Ukuran</span>
                                        <span
                                            class="text-[0.4rem] sm:text-[0.4rem] md:text-[0.65rem] font-sans font-bold text-teal-900">:
                                            {{ $product->size->size }} x {{ $product->size->side }} sisi</span>
                                    </div>
                                    <div class="flex">
                                        <span
                                            class="w-[36px] sm:w-[73px] md:w-[88px] text-[0.4rem] sm:text-[0.5rem] md:text-[0.65rem] font-sans font-bold text-teal-900 ml-2">Orientasi</span>
                                        <span
                                            class="text-[0.4rem] sm:text-[0.4rem] md:text-[0.65rem] font-sans font-bold text-teal-900">:
                                            {{ $product->size->orientation }}</span>
                                    </div>
                                    <div class="flex">
                                        <span
                                            class="w-[36px] sm:w-[73px] md:w-[88px] text-[0.4rem] sm:text-[0.5rem] md:text-[0.65rem] font-sans font-bold text-teal-900 ml-2">Penerangan</span>
                                        <span
                                            class="text-[0.4rem] sm:text-[0.4rem] md:text-[0.65rem] font-sans font-bold text-teal-900">:
                                            {{ $product->lighting }} </span>
                                    </div>
                                </div>
                                <div
                                    class="flex w-[102px] sm:w-[181px] md:w-[218px] h-[12px] sm:h-[21px] md:h-[26px] p-1 bg-slate-50 mt-[1px] border justify-center items-center rounded-t-lg text-[0.5rem] sm:text-xs md:text-sm font-semibold font-mono text-teal-900">
                                    Informasi Area
                                </div>
                                <div
                                    class="flex w-[102px] sm:w-[181px] md:w-[218px] h-[90px] sm:h-[160px] md:h-[192px] border bg-slate-50 mt-[1px] rounded-b-lg">
                                    <div>
                                        <div class="flex">
                                            <span
                                                class="w-[45px] sm:w-[80px] md:w-[96px] text-[0.3rem] sm:text-[0.5rem] lg:text-xs font-mono text-teal-900 ml-2">Type
                                                Jalan</span>
                                            <span
                                                class="text-[0.3rem] sm:text-[0.5rem] lg:text-xs font-mono text-teal-900">:
                                                {{ $product->road_segment }} </span>
                                        </div>
                                        <div class="flex">
                                            <span
                                                class="w-[45px] sm:w-[80px] md:w-[96px] text-[0.3rem] sm:text-[0.5rem] lg:text-xs font-mono text-teal-900 ml-2">Jarak
                                                Pandang</span>
                                            <span
                                                class="text-[0.3rem] sm:text-[0.5rem] lg:text-xs font-mono text-teal-900">:
                                                {{ $product->max_distance }} </span>
                                        </div>
                                        <div class="flex">
                                            <span
                                                class="w-[45px] sm:w-[80px] md:w-[96px] text-[0.3rem] sm:text-[0.5rem] lg:text-xs font-mono font-thin text-teal-900 ml-2">Kecepatan</span>
                                            <span
                                                class="text-[0.3rem] sm:text-[0.5rem] lg:text-xs font-mono font-thin text-teal-900">:
                                                {{ $product->speed_average }} </span>
                                        </div>
                                        <div class="flex">
                                            <span
                                                class="w-[45px] sm:w-[80px] md:w-[96px] text-[0.3rem] sm:text-[0.5rem] lg:text-xs font-mono font-thin text-teal-900 ml-2">Kawasan
                                            </span>
                                            <span
                                                class="flex absolute w-[38px] sm:w-[67px] md:w-[80px] mt-[2px] sm:mt-[53px] md:mt-[64px] ml-[2px] sm:ml-1 md:ml-2">
                                                {{ QrCode::size(80)->generate('http://vistamedia.co.id/dashboard/media/products/' . $product->id) }}
                                            </span>
                                            <span
                                                class="flex text-[0.3rem] sm:text-[0.5rem] lg:text-xs font-mono font-thin text-teal-900">
                                                <div>:</div>
                                                <?php
                                                $data = $product->sector;
                                                $sectors = explode('-', $data);
                                                ?>
                                                <div>
                                                    @foreach ($sectors as $key => $sector)
                                                        @if ($sector != end($sectors))
                                                            <div>
                                                                - {{ $sector }}
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex
                w-full h-max justify-center mt-1">
                    <img class="w-full" src="/img/line-bottom.png" alt="">
                </div>
                <div class="flex items-center w-full justify-center">
                    <span class="text-[0.65rem] sm:text-xs md:text-sm font-semibold">PT. Vista Media</span>
                </div>
                <div class="flex items-center w-full justify-center">
                    <span class="text-[0.5rem] sm:text-[0.65rem] md:text-xs">Jl. Pulau Kawe No. 40 - Denpasar | Bali -
                        Indonesia</span>
                </div>
                <div class="flex items-center w-full justify-center">
                    <span class="text-[0.5rem] sm:text-[0.65rem] md:text-xs">Ph. +62 361 230000 | Fax. +62 361 237800
                    </span>
                </div>
                <div class="flex items-center w-full justify-center">
                    <span class="text-[0.5rem] sm:text-[0.65rem] md:text-xs">e-mail : info@vistamedia.co.id |
                        www.vistamedia.co.id</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Preview Billboard end -->
    <!-- Preview Billboard start -->
    <div>
        <div class="w-[800px] h-8 mt-2">
            <div class="flex relative items-center">
                <button id="btn-png" name="btn-png" class="flex justify-center items-center mx-1 btn-primary">Save
                    PNG</button>
                <button id="btn-pdf" name="btn-pdf" class="flex justify-center items-center mx-1 btn-success">Save
                    PDF</button>
                <?php
                $src = 'https://maps.googleapis.com/maps/api/staticmap?center=' . $product->lat . ',' . $product->lng . '&zoom=15&size=480x355&maptype=terrain&markers=icon:https://vistamedia.co.id/img/marker-red.png%7C' . $product->lat . ',' . $product->lng . '&key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg';
                $destFolder = 'img/map/';
                $fromFolder = 'http://vista-app.test/img/map/';
                $mapImgName = 'google-map.PNG';
                $imagePath = $destFolder . $mapImgName;
                file_put_contents($imagePath, file_get_contents($src));
                ?>
                <a class="flex absolute justify-center items-center ml-[750px]" href="/dashboard/media/billboards"
                    title="Close">
                    <svg class="fill-red-700 w-6 m-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                    </svg>
                </a>
            </div>
        </div>
        <div id="preview" name="preview" class="w-[780px] h-[1100px] border mt-1">
            <div class="flex w-full justify-center items-center mt-2">
                <img src="/img/logo-vm.png" alt="">
            </div>
            <div class="flex w-full justify-center items-center mt-2">
                <img src="/img/line-top.png" alt="">
            </div>
            <div class="flex w-full h-[44px] justify-center items-center mt-1">
                <div class="flex w-[700px] h-[44px] justify-start items-center bg-slate-50 border rounded-t-xl">
                    <span
                        class="flex justify-end items-center w-20 h-[36px] text-lg text-red-700 font-bold">{{ $product->code }}</span>
                    <span class="flex justify-start items-center w-24 h-[36px] text-lg font-bold ml-1"> -
                        {{ $product->city->code }}</span>
                    <img class="h-10" src="/img/code-line.png" alt="">
                    <span
                        class="flex items-center w-[575px] h-[36px] text-base font-semibold">{{ $product->address }}</span>
                </div>
            </div>
            <div class="flex w-full h-[465px] justify-center mt-[1px]">
                <div class="flex w-[700px] h-[465px] justify-center items-center bg-slate-50 border rounded-b-xl">
                    <img class="m-auto w-[670px] h-[435px]" src="{{ asset('storage/' . $product->photo) }}"
                        alt="">
                </div>
            </div>
            <div class="flex w-full h-[385px] justify-center mt-1">
                <div class="flex w-[700px] h-[385px] bg-white">
                    <div class="flex w-[476px] h-[385px] bg-white justify-center">
                        <div class="">
                            <input id="lat" name="lat" type="text" value="{{ $product->lat }}" hidden>
                            <input id="lng" name="lng" type="text" value="{{ $product->lng }}" hidden>
                            <input id="code" name="code" type="text" value="{{ $product->code }}" hidden>
                            <div
                                class="flex w-[476px] h-7 bg-slate-50 items-center border justify-center rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                Google Maps
                                Koordinat : {{ number_format($product->lat, 7) . ', ' . number_format($product->lng, 7) }}
                            </div>
                            <div class="flex w-[476px] h-[355px] mt-[1px] rounded-b-lg">
                                <span class="flex absolute w-[100px] mt-[250px] ml-1">
                                    {{ QrCode::size(100)->generate('https://www.google.co.id/maps/place/' . $product->lat . ',' . $product->lng . '/@' . $product->lat . ',' . $product->lng . ',15z') }}
                                </span>
                                <img class="w-[476px] h-[355px] border rounded-b-xl" id="myImage" name="myImage"
                                    src="{{ $fromFolder . $mapImgName }}" alt="">

                            </div>
                        </div>
                    </div>
                    <div class="flex w-[220px] h-[385px] bg-white justify-center ml-1">
                        <div class="">
                            <div
                                class="flex p-1 items-center justify-center w-[220px] h-7 bg-slate-50 border rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                Deskripsi Billboard
                            </div>
                            <div class="w-[220px] h-[92px] bg-slate-50 mt-[1px] rounded-b-lg border">
                                <div class="flex mt-1">
                                    <span
                                        class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Jenis</span>
                                    <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                        {{ $product->category }} </span>
                                </div>
                                <div class="flex mt-1">
                                    <span
                                        class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Ukuran</span>
                                    <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                        {{ $product->size->size }} x {{ $product->size->side }} sisi</span>
                                </div>
                                <div class="flex mt-1">
                                    <span
                                        class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Orientasi</span>
                                    <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                        {{ $product->size->orientation }}</span>
                                </div>
                                <div class="flex mt-1">
                                    <span
                                        class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Penerangan</span>
                                    <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                        {{ $product->lighting }} </span>
                                </div>
                            </div>
                            <div
                                class="flex w-[220px] h-7 p-1 bg-slate-50 mt-[1px] border justify-center items-center rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                Informasi Area
                            </div>
                            <div class="flex w-[220px] h-[234px] border bg-slate-50 mt-[1px] rounded-b-lg">
                                <div>
                                    <div class="flex">
                                        <span class="w-[100px] text-xs font-mono text-teal-900 ml-2">Type Jalan</span>
                                        <span class="w-[120px] text-xs font-mono text-teal-900">:
                                            {{ $product->road_segment }} </span>
                                    </div>
                                    <div class="flex">
                                        <span class="w-[100px] text-xs font-mono text-teal-900 ml-2">Jarak Pandang</span>
                                        <span class="w-[120px] text-xs font-mono text-teal-900">:
                                            {{ $product->max_distance }} </span>
                                    </div>
                                    <div class="flex">
                                        <span class="w-[100px] text-xs font-mono font-thin text-teal-900 ml-2">Kecepatan
                                            Kend.</span>
                                        <span class="w-[120px] text-xs font-mono font-thin text-teal-900">:
                                            {{ $product->speed_average }} </span>
                                    </div>
                                    <div class="flex">
                                        <span class="w-[100px] text-xs font-mono font-thin text-teal-900 ml-2">Kawasan
                                            <br><br><br><br><br>
                                            {{ QrCode::size(100)->generate('http://vista-app.test/dashboard/media/products/' . $product->id) }}
                                        </span>
                                        <span class="flex w-[120px] text-xs font-mono font-thin text-teal-900">
                                            <div>:</div>
                                            <?php
                                            $data = $product->sector;
                                            $sectors = explode('-', $data);
                                            ?>
                                            <div>
                                                @foreach ($sectors as $key => $sector)
                                                    @if ($sector != end($sectors))
                                                        <div>
                                                            - {{ $sector }}
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex
                        w-full h-max justify-center mt-1">
                <img src="/img/line-bottom.png" alt="">
            </div>
            <div class="flex items-center w-full justify-center">
                <span class="text-sm font-semibold">PT. Vista Media</span>
            </div>
            <div class="flex items-center w-full justify-center">
                <span class="text-xs">Jl. Pulau Kawe No. 40 - Denpasar | Bali - Indonesia</span>
            </div>
            <div class="flex items-center w-full justify-center">
                <span class="text-xs">Ph. +62 361 230000 | Fax. +62 361 237800 </span>
            </div>
            <div class="flex items-center w-full justify-center">
                <span class="text-xs">e-mail : info@vistamedia.co.id | www.vistamedia.co.id</span>
            </div>
        </div>
        <div class="h-10"></div>
    </div>

    <!-- Preview Billboard end -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>

    <script>
        const code = document.getElementById("code");

        document.getElementById("btn-png").onclick = function() {
            const pngTarget = document.getElementById("preview");

            html2canvas(pngTarget).then((canvas) => {
                const base64image = canvas.toDataURL("image/jpg");
                var anchor = document.createElement('a');
                anchor.setAttribute("href", base64image);
                anchor.setAttribute("download", code.value + ".jpg");
                anchor.click();
                anchor.remove();
            })
        };

        document.getElementById("btn-pdf").onclick = function() {
            var element = document.getElementById('preview');
            var opt = {
                margin: 0,
                filename: code.value + '.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 1
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4',
                    orientation: 'portrait'
                }
            };
            html2pdf(element, opt);
        };
    </script>
@endsection
