<!-- Layout Location Preview start -->

<!-- Title Preview end -->
<div class="flex justify-center w-full">
    <div id="pdfPreview" class="w-[950px] h-[1345px] mt-1 p-4 bg-white">
        <!-- Header start -->
        @include('dashboard.layouts.letter-header')
        <!-- Header end -->
        <!-- Body start -->
        <div class="h-[1110px]">
            <div class="flex w-full h-[50px] justify-center items-center mt-1">
                <div class="flex w-[800px] h-[50px] justify-start items-center bg-slate-50 border rounded-t-xl">
                    <span
                        class="flex justify-end items-center w-20 h-[42px] text-lg text-red-700 font-bold">{{ $product->code }}</span>
                    <span class="flex justify-start items-center w-20 h-[42px] text-lg font-bold ml-1"> -
                        {{ $product->city_code }}
                    </span>
                    <img class="h-10" src="/img/code-line.png" alt="">
                    <span class="flex items-center w-[575px] h-[42px] text-base font-semibold">{{ $product->address }}
                        | {{ strtoupper($product->area) }}</span>
                </div>
            </div>
            <div class="flex w-full h-[570px] justify-center mt-2">
                <div class="flex w-[800px] h-[570px] justify-center items-center bg-slate-50 border rounded-b-xl">
                    <img class="m-auto w-[770px] h-[540px]" src="{{ asset('storage/' . $product->photo) }}"
                        alt="">
                </div>
            </div>
            <div class="flex w-full justify-center mt-2 h-[470px] bg-white">
                <div class="w-[544px] h-[470px] bg-white justify-center">
                    <div
                        class="flex w-[544px] h-10 bg-slate-50 items-center border justify-center rounded-t-lg text-sm font-bold font-mono text-teal-900">
                        Google Maps Koordinat :
                        @if ($category == 'Signage')
                            {{ number_format($description->lat[0], 7) . ', ' . number_format($description->lng[0], 7) }}
                        @else
                            {{ number_format($description->lat, 7) . ', ' . number_format($description->lng, 7) }}
                        @endif
                    </div>
                    <div class="flex relative w-[544px] h-[430px] mt-1 rounded-b-lg">
                        <div class="flex absolute w-[100px] mt-[325px] ml-1">
                            @if ($category == 'Signage')
                                {{ QrCode::size(100)->generate('https://www.google.co.id/maps/place/' . $description->lat[0] . ',' . $description->lng[0] . '/@' . $description->lat[0] . ',' . $description->lng[0] . ',16z') }}
                            @else
                                {{ QrCode::size(100)->generate('https://www.google.co.id/maps/place/' . $description->lat . ',' . $description->lng . '/@' . $description->lat . ',' . $description->lng . ',16z') }}
                            @endif
                        </div>
                        <img class="w-[544px] h-[430px] border rounded-b-xl" id="myImage" name="myImage"
                            src="{{ $src }}" alt="">
                    </div>
                </div>
                <div class="w-[256px] h-[470px] bg-white justify-center ml-1">
                    <div
                        class="flex p-1 items-center justify-center w-[256px] h-10 bg-slate-50 border rounded-t-lg text-sm font-bold font-mono text-teal-900">
                        Deskripsi Lokasi
                    </div>
                    @if ($category == 'Billboard' || $category == 'Bando' || $category == 'Baliho' || $category == 'Midiboard')
                        @include('quotations.bb-description')
                    @elseif ($category == 'Videotron')
                        @include('quotations.vt-description')
                    @elseif ($category == 'Signage')
                        @include('quotations.sn-description')
                    @endif
                    <div
                        class="flex w-[256px] h-10 p-1 bg-slate-50 mt-1 border justify-center items-center rounded-t-lg text-sm font-bold font-mono text-teal-900">
                        Informasi Area
                    </div>
                    <div class="w-[256px] h-[212px] border bg-slate-50 mt-1 rounded-b-lg">
                        <div class="flex">
                            <span class="w-[100px] text-xs font-mono text-teal-900 ml-2">Type
                                Jalan</span>
                            <span class="w-[120px] text-xs font-mono text-teal-900">:
                                {{ $product->road_segment }}
                            </span>
                        </div>
                        <div class="flex">
                            <span class="w-[100px] text-xs font-mono text-teal-900 ml-2">Jarak
                                Pandang</span>
                            <span class="w-[120px] text-xs font-mono text-teal-900">:
                                {{ $product->max_distance }}
                            </span>
                        </div>
                        <div class="flex">
                            <span class="w-[100px] text-xs font-mono font-thin text-teal-900 ml-2">Kecepatan
                                Kend.</span>
                            <span class="w-[120px] text-xs font-mono font-thin text-teal-900">:
                                {{ $product->speed_average }}
                            </span>
                        </div>
                        <div class="flex">
                            <span class="w-[100px] text-xs font-mono font-thin text-teal-900 ml-2">Kawasan
                                <br><br><br>
                                {{ QrCode::size(100)->generate('https://vistamedia.co.id/locations/guest-preview/' . $category . '/' . Crypt::encrypt($product->id)) }}
                            </span>
                            <span class="flex w-[120px] text-xs font-mono font-thin text-teal-900">
                                <div>:</div>
                                <div>
                                    @foreach ($sectors->dataSector as $sector)
                                        <div>
                                            - {{ $sector }}
                                        </div>
                                    @endforeach
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Body start -->
        <!-- Footer start -->
        @include('dashboard.layouts.letter-footer')
        <!-- Footer end -->
    </div>
</div>
<!-- Script start -->
<script src="/js/html2canvas.min.js"></script>
<script src="/js/html2pdf.bundle.min.js"></script>
<script src="/js/qrcode.min.js"></script>
<!-- Script end -->
<!-- Layout Location Preview end -->
