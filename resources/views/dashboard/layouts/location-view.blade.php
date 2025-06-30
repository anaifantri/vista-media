<!-- Layout Location View start -->
@php
    $description = json_decode($location->description);
    $sectors = json_decode($location->sector);
    $name = $location->code . '-' . $location->city->code . '-' . $location->address;
    $location_photos = $data_photos->where('company_id', $company->id)->last();

    if ($location->media_category->name == 'Signage') {
        $mapsLink =
            'https://maps.googleapis.com/maps/api/staticmap?center=' .
            $description->lat[0] .
            ',' .
            $description->lng[0] .
            '&zoom=17&size=480x355&maptype=terrain';
        $mapsMarkers = '';
        $googleKey = '&key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg';
        for ($i = 0; $i < count($description->lat); $i++) {
            $mapsMarkers =
                $mapsMarkers .
                '&markers=icon:https://' .
                $company->website .
                '/img/marker-red.png%7C' .
                $description->lat[$i] .
                ',' .
                $description->lng[$i];
        }
        $src = $mapsLink . $mapsMarkers . $googleKey;
    } else {
        $src =
            'https://maps.googleapis.com/maps/api/staticmap?center=' .
            $description->lat .
            ',' .
            $description->lng .
            '&zoom=16&size=480x355&maptype=terrain&markers=icon:https://' .
            $company->website .
            '/img/marker-red.png%7C' .
            $description->lat .
            ',' .
            $description->lng .
            '&key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg';
    }
@endphp
<input id="saveName" type="text" value="{{ $name }}" hidden>
<!-- Title Preview start -->
<div class="flex justify-center w-full">
    <div class="flex border-b w-[950px] mt-10">
        <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-primary mb-2" title="Create PDF"
            type="button" onclick="savePdf()">
            <svg class="fill-current w-4 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" viewBox="0 0 24 24">
                <path
                    d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
            </svg>
            <span class="ml-2 text-white">Save PDF</span>
        </button>
        @canany(['isAdmin', 'isOwner', 'isMedia', 'isAccounting', 'isMarketing'])
            <a class="flex justify-center items-center ml-1 btn-danger" href="/media/locations/home/{{ $category }}">
                <svg class="fill-white w-4 m-auto hover:fill-red-600" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24">
                    <path
                        d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                </svg>
                <span class="ml-1 text-sm">Close</span>
            </a>
        @endcanany
        @if (session()->has('success'))
            <div class="ml-2 flex alert-success">
                <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                </svg>
                <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
            </div>
        @endif
    </div>
</div>
<!-- Title Preview end -->
<div class="flex justify-center w-full">
    <div id="pdfPreview" class="w-[950px] h-[1345px] mt-2 p-4 bg-white">
        <!-- Header start -->
        @include('dashboard.layouts.letter-header')
        <!-- Header end -->
        <!-- Body start -->
        <div class="h-[1110px]">
            <div class="flex w-full h-[50px] justify-center items-center mt-1">
                <div class="flex w-[800px] h-[50px] justify-start items-center bg-slate-50 border rounded-t-xl">
                    <span
                        class="flex justify-end items-center w-20 h-[42px] text-lg text-red-700 font-bold">{{ $location->code }}</span>
                    <span class="flex justify-start items-center w-20 h-[42px] text-lg font-bold ml-1"> -
                        {{ $location->city->code }}
                    </span>
                    <img class="h-10" src="/img/code-line.png" alt="">
                    <span class="flex items-center w-[575px] h-[42px] text-base font-semibold">{{ $location->address }}
                        | {{ strtoupper($location->area->area) }}</span>
                </div>
            </div>
            <div class="flex w-full h-[570px] justify-center mt-2">
                <div class="flex w-[800px] h-[570px] justify-center items-center bg-slate-50 border rounded-b-xl">
                    <img class="m-auto w-[770px] h-[540px]" src="{{ asset('storage/' . $location_photos->photo) }}"
                        alt="">
                </div>
            </div>
            <div class="flex w-full justify-center mt-2 h-[450px] bg-white">
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
                        @include('dashboard.layouts.bb-description')
                    @elseif ($category == 'Videotron')
                        @include('dashboard.layouts.vt-description')
                    @elseif ($category == 'Signage')
                        @include('dashboard.layouts.sn-description')
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
                                {{ $location->road_segment }}
                            </span>
                        </div>
                        <div class="flex">
                            <span class="w-[100px] text-xs font-mono text-teal-900 ml-2">Jarak
                                Pandang</span>
                            <span class="w-[120px] text-xs font-mono text-teal-900">:
                                {{ $location->max_distance }}
                            </span>
                        </div>
                        <div class="flex">
                            <span class="w-[100px] text-xs font-mono font-thin text-teal-900 ml-2">Kecepatan
                                Kend.</span>
                            <span class="w-[120px] text-xs font-mono font-thin text-teal-900">:
                                {{ $location->speed_average }}
                            </span>
                        </div>
                        <div class="flex">
                            <span class="w-[100px] text-xs font-mono font-thin text-teal-900 ml-2">Kawasan
                                <br><br><br>
                                {{ QrCode::size(100)->generate('https://' . $company->website . '/locations/guest-preview/' . $category . '/' . Crypt::encrypt($location->id)) }}
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
<script src="/js/savepdf.js"></script>
<!-- Script end -->
<!-- Layout Location View end -->
