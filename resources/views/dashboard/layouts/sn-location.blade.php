<!-- Layout Location Videotron start -->
<div class="flex justify-center w-full">
    <?php
    $objLocations = json_decode($signage->locations);
    $locationQty = count($objLocations->signageLocations);
    $mapsLink = 'https://maps.googleapis.com/maps/api/staticmap?center=' . $objLocations->signageLocations[0]->lat . ',' . $objLocations->signageLocations[0]->lng . '&zoom=17&size=480x355&maptype=terrain';
    $mapsMarkers = '';
    $googleKey = '&key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg';
    for ($i = 0; $i < $locationQty; $i++) {
        $mapsMarkers = $mapsMarkers . '&markers=icon:https://vistamedia.co.id/img/marker-red.png%7C' . $objLocations->signageLocations[$i]->lat . ',' . $objLocations->signageLocations[$i]->lng;
    }
    $src = $mapsLink . $mapsMarkers . $googleKey;
    ?>
    <div class="w-[950px] h-[1345px] mt-1 bg-white">
        <!-- Header start -->
        @include('dashboard.layouts.letter-header')
        <!-- Header end -->
        <!-- Body start -->
        <div class="h-[1125px]">
            <div class="flex w-full h-[50px] justify-center items-center mt-1">
                <div class="flex w-[800px] h-[50px] justify-start items-center bg-slate-50 border rounded-t-xl">
                    <span
                        class="flex justify-end items-center w-20 h-[42px] text-lg text-red-700 font-bold">{{ $signage->code }}</span>
                    <span class="flex justify-start items-center w-20 h-[42px] text-lg font-bold ml-1"> -
                        {{ $signage->city->code }}
                    </span>
                    <img class="h-10" src="/img/code-line.png" alt="">
                    <span class="flex items-center w-[575px] h-[42px] text-base font-semibold">{{ $signage->address }}
                        | {{ strtoupper($signage->area->area) }}</span>
                </div>
            </div>
            <div class="flex w-full h-[570px] justify-center mt-2">
                <div class="flex w-[800px] h-[570px] justify-center items-center bg-slate-50 border rounded-b-xl">
                    @foreach ($signage_photos as $photo)
                        @if ($photo->signage_id == $signage->id)
                            <img class="m-auto w-[770px] h-[540px]" src="{{ asset('storage/' . $photo->photo) }}"
                                alt="">
                        @endif
                    @endforeach

                </div>
            </div>
            <div class="flex w-full h-[470px] justify-center mt-4">
                <div class="flex w-[800px] h-[470px] bg-white">
                    <div class="flex w-[544px] h-[470px] bg-white justify-center">
                        <div class="">
                            <div
                                class="flex w-[544px] h-10 bg-slate-50 items-center border justify-center rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                Google Maps Koordinat :
                                {{ number_format($objLocations->signageLocations[0]->lat, 7) . ', ' . number_format($objLocations->signageLocations[0]->lng, 7) }}
                            </div>
                            <div class="flex relative w-[544px] h-[430px] mt-1 rounded-b-lg">
                                <div class="flex absolute w-[100px] mt-[325px] ml-1">
                                    {{ QrCode::size(100)->generate('https://www.google.co.id/maps/place/' . $signage->lat . ',' . $signage->lng . '/@' . $signage->lat . ',' . $signage->lng . ',16z') }}
                                </div>
                                {{-- <?php
                                $src = 'https://maps.googleapis.com/maps/api/staticmap?center=' . $signage->lat . ',' . $signage->lng . '&zoom=16&size=544x430&maptype=terrain&markers=icon:https://vistamedia.co.id/img/marker-red.png%7C' . $signage->lat . ',' . $signage->lng . '&key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg';
                                ?> --}}
                                <img class="w-[544px] h-[430px] border rounded-b-xl" id="myImage" name="myImage"
                                    src="{{ $src }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="flex w-[256px] h-[470px] bg-white justify-center ml-1">
                        <div class="">
                            <div
                                class="flex p-1 items-center justify-center w-[256px] h-10 bg-slate-50 border rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                Deskripsi Signage
                            </div>
                            <div class="w-[256px] h-[150px] bg-slate-50 mt-1 rounded-b-lg border">
                                <div class="flex mt-1">
                                    <span
                                        class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Jenis</span>
                                    <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                        Signage</span>
                                </div>
                                <div class="flex mt-1">
                                    <span
                                        class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Ukuran</span>
                                    <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                        {{ $signage->size->size }} - {{ $signage->side }} Sisi</span>
                                </div>
                                <div class="flex mt-1">
                                    <span
                                        class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Jumlah</span>
                                    <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                        {{ $locationQty }} Unit</span>
                                </div>
                                <div class="flex mt-1">
                                    <span
                                        class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Orientasi</span>
                                    <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                        {{ $signage->orientation }}</span>
                                </div>
                                <div class="flex mt-1">
                                    <span
                                        class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Type</span>
                                    <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                        {{ $signage->signage_category->name }}</span>
                                </div>
                                <div class="flex mt-1">
                                    <span
                                        class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Penerangan</span>
                                    <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                    </span>
                                </div>
                            </div>
                            <div
                                class="flex w-[256px] h-10 p-1 bg-slate-50 mt-1 border justify-center items-center rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                Informasi Area
                            </div>
                            <div class="flex w-[256px] h-[232px] border bg-slate-50 mt-1 rounded-b-lg">
                                <div>
                                    <div class="flex">
                                        <span class="w-[100px] text-xs font-mono text-teal-900 ml-2">Type
                                            Jalan</span>
                                        <span class="w-[120px] text-xs font-mono text-teal-900">:
                                            {{ $signage->road_segment }}
                                        </span>
                                    </div>
                                    <div class="flex">
                                        <span class="w-[100px] text-xs font-mono text-teal-900 ml-2">Jarak
                                            Pandang</span>
                                        <span class="w-[120px] text-xs font-mono text-teal-900">:
                                            {{ $signage->max_distance }}
                                        </span>
                                    </div>
                                    <div class="flex">
                                        <span class="w-[100px] text-xs font-mono font-thin text-teal-900 ml-2">Kecepatan
                                            Kend.</span>
                                        <span class="w-[120px] text-xs font-mono font-thin text-teal-900">:
                                            {{ $signage->speed_average }}
                                        </span>
                                    </div>
                                    <div class="flex">
                                        <span class="w-[100px] text-xs font-mono font-thin text-teal-900 ml-2">Kawasan
                                            <br><br><br><br><br>
                                            {{ QrCode::size(100)->generate('https://vistamedia.co.id/dashboard/media/videotrons/preview/' . $signage->id) }}
                                        </span>
                                        <span class="flex w-[120px] text-xs font-mono font-thin text-teal-900">
                                            <div>:</div>

                                            <?php
                                            $data = $signage->sector;
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
        </div>
        <!-- Body start -->
        <!-- Footer start -->
        @include('dashboard.layouts.letter-footer')
        <!-- Footer end -->
    </div>
</div>
<!-- Layout Location Videotron end -->
