<!-- Layout Location Videotron start -->
<div class="flex justify-center w-full">
    <div class="w-[950px] h-[1345px] mt-1 bg-white">
        <!-- Header start -->
        @include('dashboard.layouts.letter-header')
        <!-- Header end -->
        <!-- Body start -->
        <div class="h-[1125px]">
            <div class="flex w-full h-[50px] justify-center items-center mt-1">
                <div class="flex w-[800px] h-[50px] justify-start items-center bg-slate-50 border rounded-t-xl">
                    <span
                        class="flex justify-end items-center w-20 h-[42px] text-lg text-red-700 font-bold">{{ $videotron->code }}</span>
                    <span class="flex justify-start items-center w-20 h-[42px] text-lg font-bold ml-1"> -
                        {{ $videotron->city->code }}
                    </span>
                    <img class="h-10" src="/img/code-line.png" alt="">
                    <span class="flex items-center w-[575px] h-[42px] text-base font-semibold">{{ $videotron->address }}
                        | {{ strtoupper($videotron->area->area) }}</span>
                </div>
            </div>
            <div class="flex w-full h-[570px] justify-center mt-2">
                <div class="flex w-[800px] h-[570px] justify-center items-center bg-slate-50 border rounded-b-xl">
                    <img class="m-auto w-[770px] h-[540px]" src="{{ asset('storage/' . $videotron_photo->photo) }}"
                        alt="">
                </div>
            </div>
            <div class="flex w-full h-[470px] justify-center mt-4">
                <div class="flex w-[800px] h-[470px] bg-white">
                    <div class="flex w-[544px] h-[470px] bg-white justify-center">
                        <div class="">
                            <div
                                class="flex w-[544px] h-10 bg-slate-50 items-center border justify-center rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                Google Maps
                                Koordinat :
                                {{ number_format($videotron->lat, 7) . ', ' . number_format($videotron->lng, 7) }}
                            </div>
                            <div class="flex relative w-[544px] h-[430px] mt-1 rounded-b-lg">
                                <div class="flex absolute w-[100px] mt-[325px] ml-1">
                                    {{ QrCode::size(100)->generate('https://www.google.co.id/maps/place/' . $videotron->lat . ',' . $videotron->lng . '/@' . $videotron->lat . ',' . $videotron->lng . ',16z') }}
                                </div>
                                <?php
                                $src = 'https://maps.googleapis.com/maps/api/staticmap?center=' . $videotron->lat . ',' . $videotron->lng . '&zoom=16&size=544x430&maptype=terrain&markers=icon:https://' . $company->website . '/img/marker-red.png%7C' . $videotron->lat . ',' . $videotron->lng . '&key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg';
                                ?>
                                <img class="w-[544px] h-[430px] border rounded-b-xl" id="myImage" name="myImage"
                                    src="{{ $src }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="flex w-[256px] h-[470px] bg-white justify-center ml-1">
                        <div class="">
                            <div
                                class="flex p-1 items-center justify-center w-[256px] h-10 bg-slate-50 border rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                Deskripsi Videotron
                            </div>
                            <div class="w-[256px] h-[150px] bg-slate-50 mt-1 rounded-b-lg border">
                                <div class="flex mt-1">
                                    <span
                                        class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Jenis</span>
                                    <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                        Videotron</span>
                                </div>
                                <div class="flex mt-1">
                                    <span
                                        class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Ukuran</span>
                                    <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                        {{ $videotron->size->size }}</span>
                                </div>
                                <div class="flex mt-1">
                                    <span
                                        class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Screen
                                        Size</span>
                                    <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                        {{ $videotron->screen_w }} pixel x
                                        {{ $videotron->screen_h }} pixel</span>
                                </div>
                                <div class="flex mt-1">
                                    <span
                                        class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Orientasi</span>
                                    <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                        {{ $videotron->orientation }}</span>
                                </div>
                                <div class="flex mt-1">
                                    <span
                                        class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Type
                                        LED</span>
                                    <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                        {{ $videotron->led->pixel_pitch }} - {{ $videotron->led->type }} -
                                        {{ $videotron->led->pixel_config }}
                                    </span>
                                </div>
                                <div class="flex mt-1">
                                    <span
                                        class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Pixel
                                        Desity</span>
                                    <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                        {{ $videotron->led->pixel_density }}</span>
                                </div>
                                <div class="flex mt-1">
                                    <span
                                        class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Refresh
                                        Rate</span>
                                    <span class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                        {{ $videotron->led->refresh_rate }}</span>
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
                                            {{ $videotron->road_segment }}
                                        </span>
                                    </div>
                                    <div class="flex">
                                        <span class="w-[100px] text-xs font-mono text-teal-900 ml-2">Jarak
                                            Pandang</span>
                                        <span class="w-[120px] text-xs font-mono text-teal-900">:
                                            {{ $videotron->max_distance }}
                                        </span>
                                    </div>
                                    <div class="flex">
                                        <span class="w-[100px] text-xs font-mono font-thin text-teal-900 ml-2">Kecepatan
                                            Kend.</span>
                                        <span class="w-[120px] text-xs font-mono font-thin text-teal-900">:
                                            {{ $videotron->speed_average }}
                                        </span>
                                    </div>
                                    <div class="flex">
                                        <span class="w-[100px] text-xs font-mono font-thin text-teal-900 ml-2">Kawasan
                                            <br><br><br><br><br>
                                            {{ QrCode::size(100)->generate('https://' . $company->website . '/dashboard/media/videotrons/preview/' . $videotron->id) }}
                                        </span>
                                        <span class="flex w-[120px] text-xs font-mono font-thin text-teal-900">
                                            <div>:</div>

                                            <?php
                                            $data = $videotron->sector;
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
