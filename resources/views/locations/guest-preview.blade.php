<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VISTA MEDIA | {{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/apexcharts.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
</head>

<body>
    @php
        $description = json_decode($location->description);
        $sectors = json_decode($location->sector);
        $created_by = json_decode($location->created_by);
        $updated_by = json_decode($location->updated_by);
        $name = $location->code . '-' . $location->city->code . '-' . $location->address;

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

        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
    @endphp
    <input id="lat" type="text" value="{{ json_encode($description->lat) }}" hidden>
    <input id="lng" type="text" value="{{ json_encode($description->lng) }}" hidden>
    <input id="category" type="text" value="{{ $location->media_category->name }}" hidden>
    <input id="saveName" type="text" value="{{ $name }}" hidden>
    <div class="flex justify-center h-[1500px] pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <!-- Show Location Title start -->
            <div class="flex w-[1200px] items-center border-b">
                <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[550px]"> DETAIL LOKASI
                    {{ strtoupper($category) }}</h1>
                <div class="flex w-full p-1 justify-end">
                    <button id="btn-preview" name="btn-preview"
                        class="flex justify-center items-center mx-1 btn-success" onclick="btnPreview()">
                        <svg class="fill-current w-4 lg:w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M24 11v12h-24v-12h4v-10h10.328c1.538 0 5.672 4.852 5.672 6.031v3.969h4zm-6-3.396c0-1.338-2.281-1.494-3.25-1.229.453-.813.305-3.375-1.082-3.375h-7.668v13h12v-8.396zm-2 5.396h-8v-1h8v1zm0-3h-8v1h8v-1zm0-2h-8v1h8v-1z" />
                        </svg>
                        <span class="mx-1 text-sm lg:text-md lg:mx-2">Preview</span>
                    </button>
                </div>
            </div>
            <!-- Show Location Title end -->

            <!-- Show Location start -->
            <div class="flex justify-center w-full mt-2">
                <!-- Show Location start -->
                @php
                    $description = json_decode($location->description);
                @endphp
                <div>
                    <input type="text" name="description" id="description" hidden>
                    <div class="flex justify-center w-full p-2">
                        <div class="bg-stone-300 rounded-xl w-[1180px] flex justify-center p-2">
                            <div>
                                <span class="flex justify-center border-b text-base font-semibold">Foto Lokasi</span>
                                <figure id="figure"
                                    class="flex w-[550px] bg-stone-800 rounded-lg justify-center overflow-x-auto border-b-2 border-stone-900">
                                    @foreach ($location_photos as $photo)
                                        @if ($photo->set_default == true)
                                            <img id="{{ $photo->id }}" class="photo-active"
                                                src="{{ asset('storage/' . $photo->photo) }}" alt=""
                                                onclick="figureAction(this)">
                                        @else
                                            <img id="{{ $photo->id }}" class="photo"
                                                src="{{ asset('storage/' . $photo->photo) }}" alt=""
                                                onclick="figureAction(this)">
                                        @endif
                                    @endforeach
                                </figure>
                                <div class=" relative mt-2 w-[550px] h-[380px] rounded-xl p-1 border">
                                    <div id="prevButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto">
                                        <button
                                            class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-slate-200 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                            type="button" onclick="buttonPrev()">
                                            <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                                fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                                <path
                                                    d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div id="nextButton" class="absolute inset-y-0 right-0 w-7 h-12 m-auto">
                                        <button type="button"
                                            class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-slate-200 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                            onclick="buttonNext()">
                                            <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                                fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                                <path
                                                    d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                            </svg>
                                        </button>
                                    </div>
                                    @foreach ($location_photos as $photo)
                                        <div id="{{ $photo->set_default }}" class="divImage" hidden>
                                            <div
                                                class="absolute bottom-4 left-1 w-[540px] h-14 bg-black bg-opacity-80 p-2">
                                                <div class="flex items-center">
                                                    <div class="w-64">
                                                        <div class="flex">
                                                            <label class="text-sm text-yellow-400 w-28 mx-1">Tanggal
                                                                Upload</label>
                                                            <label class="text-sm text-yellow-400">:</label>
                                                            <label
                                                                class="text-sm text-yellow-400 ml-2 w-40">{{ date('d', strtotime($photo->created_at)) }}
                                                                {{ $bulan[(int) date('m', strtotime($photo->created_at))] }}
                                                                {{ date('Y', strtotime($photo->created_at)) }}</label>
                                                        </div>
                                                        <div class="flex">
                                                            <label class="text-sm text-yellow-400 w-28 mx-1">Diupload
                                                                Oleh</label>
                                                            <label class="text-sm text-yellow-400">: </label>
                                                            <label
                                                                class="text-sm text-yellow-400 ml-2 w-40">{{ $photo->user->name }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <img class="w-[540px] h-[370px] rounded-xl"
                                                src="{{ asset('storage/' . $photo->photo) }}" alt="">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Location Maps start -->
                            <div class="ml-4">
                                <span class="flex justify-center border-b text-base font-semibold">Peta Lokasi</span>
                                <div class="w-[550px] h-[465px] rounded-xl mt-2" id="map">
                                </div>
                            </div>
                            <!-- Location Maps end -->
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2 w-[1200px] p-2 mt-2">
                        <!-- Location Data start -->
                        <div class="border rounded-lg p-2 mt-2 bg-stone-200">
                            <div class="flex border-b border-stone-900">
                                <label class="text-semibold">Data Lokasi</label>
                            </div>
                            <div class="flex mt-2">
                                <label class="text-sm text-stone-900 w-28">Kode</label>
                                <label class="text-sm text-stone-900">:</label>
                                <label
                                    class="text-semibold ml-2">{{ $location->code }}-{{ $location->city->code }}</label>
                            </div>
                            <div class="flex">
                                <label class="text-sm text-stone-900 w-28">Area</label>
                                <label class="text-sm text-stone-900">:</label>
                                <label class="text-semibold ml-2">{{ $location->area->area }}</label>
                            </div>
                            <div class="flex">
                                <label class="text-sm text-stone-900 w-28">Kota</label>
                                <label class="text-sm text-stone-900">:</label>
                                <label class="text-semibold ml-2">{{ $location->city->city }}</label>
                            </div>
                            <div class="flex">
                                <label class="text-sm text-stone-900 w-28">Lokasi</label>
                                <label class="text-sm text-stone-900">:</label>
                                <label class="text-semibold w-[300px] ml-2">{{ $location->address }}</label>
                            </div>
                            @if ($location->media_category->name == 'Signage')
                                <div class="flex">
                                    <label class="text-sm text-stone-900 w-28">Koordinat</label>
                                    <label class="text-sm text-stone-900">: </label>
                                    <div class="text-semibold ml-2">
                                        @foreach ($description->lat as $coordinat)
                                            <div>
                                                {{ $loop->iteration }}. {{ $coordinat }},
                                                {{ $description->lng[$loop->iteration - 1] }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="flex">
                                    <label class="text-sm text-stone-900 w-28">Koordinat</label>
                                    <label class="text-sm text-stone-900">:</label>
                                    <label class="text-semibold ml-2">{{ number_format($description->lat, 7) }},
                                        {{ number_format($description->lng, 7) }}</label>
                                </div>
                            @endif
                            <!-- Deskription start -->
                            <div class="mt-2">
                                @if ($location->media_category->name == 'Videotron')
                                    @include('dashboard.layouts.vt-description-view')
                                @elseif ($location->media_category->name == 'Signage')
                                    @include('dashboard.layouts.sn-description-view')
                                @else
                                    @include('dashboard.layouts.bb-description-view')
                                @endif
                            </div>
                            <!-- Deskription end -->
                        </div>
                        <!-- Location Data end -->

                        <!-- Information Area start -->
                        <div class="border rounded-lg p-2 mt-2 bg-stone-200">
                            <div class="flex border-b border-stone-900">
                                <label class="text-semibold">Informasi Area</label>
                            </div>
                            <div class="flex mt-2">
                                <label class="text-sm text-stone-900 w-28">Jumlah Lajur</label>
                                <label class="text-semibold">: {{ $location->road_segment }}</label>
                            </div>
                            <div class="flex">
                                <label class="text-sm text-stone-900 w-28">Jarak Pandang</label>
                                <label class="text-semibold">: {{ $location->max_distance }}</label>
                            </div>
                            <div class="flex">
                                <label class="text-sm text-stone-900 w-28">Kecepatan</label>
                                <label class="text-semibold">: {{ $location->speed_average }}</label>
                            </div>
                            <div class="flex">
                                <label class="text-sm text-stone-900 w-28">Kawasan</label>
                                <label class="text-sm text-stone-900">: </label>
                                <div class="text-semibold ml-2">
                                    @foreach ($sectors->dataSector as $sector)
                                        <div>
                                            - {{ $sector }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- Information Area end -->
                    </div>
                </div>

                <!-- Modal Preview start -->
                <div id="modal" name="modal"
                    class="absolute justify-center left-0 top-0 w-full h-[1500px] bg-black bg-opacity-90 z-50 hidden">
                    <div>
                        <div class="w-[950px] h-8 mt-10 ml-2">
                            <div class="flex items-center">
                                <div class="w-32">
                                    <button id="btnCreatePdf"
                                        class="flex justify-center items-center mx-1 btn-primary mb-2"
                                        title="Create PDF" type="button" onclick="savePdf()">
                                        <svg class="fill-current w-4 ml-1 xl:ml-2 2xl:ml-3"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                                        </svg>
                                        <span class="ml-2 text-white">Save PDF</span>
                                    </button>
                                </div>
                                <div class="flex w-full justify-end px-4">
                                    <button id="btn-close" name="btn-close" class="flex justify-center items-center"
                                        title="Close" onclick="btnClose()">
                                        <svg class="fill-white w-6 m-auto hover:fill-red-600"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @include('dashboard.layouts.location-preview')
                        <div class="h-10"></div>
                    </div>
                </div>
                <!-- Modal Preview end -->

            </div>
            <!-- Show Location end -->
        </div>
    </div>
    <!-- Script Show Location start -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg&callback=initMap"
        defer></script>

    <script>
        // Google Maps --> start
        let map;
        const latitude = document.getElementById("lat");
        const longitude = document.getElementById("lng");
        const category = document.getElementById("category");
        var lat = 0;
        var lng = 0;
        let myLatLng = {
            lat: 0,
            lng: 0
        };

        if (category.value == "Signage") {
            lat = JSON.parse(latitude.value);
            lng = JSON.parse(longitude.value);
            myLatLng = {
                lat: lat[0],
                lng: lng[0]
            };
        } else {
            lat = Number(latitude.value);
            lng = Number(longitude.value);
            myLatLng = {
                lat: lat,
                lng: lng
            };
        }

        function initMap() {
            console.log(myLatLng);
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 16,
                center: myLatLng,
            });

            if (category.value == "Signage") {
                for (let i = 0; i < lat.length; i++) {
                    myLatLng = {
                        lat: lat[i],
                        lng: lng[i]
                    };
                    const marker = new google.maps.Marker({
                        position: myLatLng,
                        map,
                        icon: "/img/marker-red.png"
                    });
                }
            } else {
                console.log(myLatLng);
                const marker = new google.maps.Marker({
                    position: myLatLng,
                    map,
                    icon: "/img/marker-red.png"
                });
            }
        }
        // Google Maps --> end

        // Modal Preview Script start -->
        btnPreview = () => {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            window.scrollTo(0, 0);
        };

        btnClose = () => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        };
        // Modal Preview Script end -->

        // Funtion Button Next-Prev-figure start -->
        const imageViews = document.querySelectorAll(".divImage");
        const figure = document.getElementById("figure");
        const figureImages = figure.getElementsByTagName("img");
        var index = 0;

        for (let i = 0; i < imageViews.length; i++) {
            if (imageViews[i].id == 1) {
                index = i;
                imageViews[i].removeAttribute('hidden');
            } else {
                imageViews[i].setAttribute('hidden', 'hidden');
            }
        }
        buttonNext = () => {
            if (index == imageViews.length - 1) {
                figureImages[index].classList.remove('photo-active');
                figureImages[index].classList.add('photo');
                figureImages[0].classList.remove('photo');
                figureImages[0].classList.add('photo-active');
                imageViews[index].setAttribute('hidden', 'hidden');
                imageViews[0].removeAttribute('hidden');
                index = 0;
            } else {
                figureImages[index].classList.remove('photo-active');
                figureImages[index].classList.add('photo');
                figureImages[index + 1].classList.add('photo-active');
                figureImages[index + 1].classList.remove('photo');
                imageViews[index].setAttribute('hidden', 'hidden');
                imageViews[index + 1].removeAttribute('hidden');
                index = index + 1;
            }
        }
        buttonPrev = () => {
            if (index == 0) {
                figureImages[index].classList.remove('photo-active');
                figureImages[index].classList.add('photo');
                figureImages[imageViews.length - 1].classList.remove('photo');
                figureImages[imageViews.length - 1].classList.add('photo-active');
                imageViews[index].setAttribute('hidden', 'hidden');
                imageViews[imageViews.length - 1].removeAttribute('hidden');
                index = imageViews.length - 1;
            } else {
                figureImages[index].classList.remove('photo-active');
                figureImages[index].classList.add('photo');
                figureImages[index - 1].classList.add('photo-active');
                figureImages[index - 1].classList.remove('photo');
                imageViews[index].setAttribute('hidden', 'hidden');
                imageViews[index - 1].removeAttribute('hidden');
                index = index - 1;
            }
        }
        figureAction = (sel) => {
            for (let i = 0; i < figureImages.length; i++) {
                if (figureImages[i].id == sel.id) {
                    figureImages[i].classList.remove('photo');
                    figureImages[i].classList.add('photo-active');
                    imageViews[i].removeAttribute('hidden');
                } else {
                    figureImages[i].classList.add('photo');
                    figureImages[i].classList.remove('photo-active');
                    imageViews[i].setAttribute('hidden', 'hidden');
                }
            }
        }
        // Funtion Button Next-Prev-figure end -->

        savePdf = () => {
            const saveName = document.getElementById("saveName");
            var element = document.getElementById('pdfPreview');
            var opt = {
                margin: 0,
                filename: saveName.value + ".pdf",
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                pagebreak: {
                    mode: ['avoid-all', 'css', 'legacy']
                },
                html2canvas: {
                    dpi: 96,
                    scale: 2,
                    letterRendering: true,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'px',
                    format: [950, 1365],
                    orientation: 'portrait',
                    putTotalPages: true
                }
            };
            html2pdf().set(opt).from(element).save();
        };
    </script>
    <!-- Script Show Location end -->
</body>

</html>
