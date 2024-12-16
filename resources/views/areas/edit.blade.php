@extends('dashboard.layouts.main');

@section('container')
    <!-- Edit Area start -->
    <!-- Form Edit Area start -->
    <form action="/media/area/{{ $area->id }}" method="post" class="d-inline">
        @method('put')
        @csrf
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
                <div class="flex justify-center w-full ">
                    <div class="flex w-[900px] border-b">
                        <!-- Title Area start -->
                        <h1 class="index-h1 w-[500px]">MERUBAH DATA AREA {{ strtoupper($area->area) }}</h1>
                        <!-- Title Area end -->
                        <div class="flex w-full justify-end items-center">
                            <button class="flex justify-center items-center mx-1 btn-primary" type="submit">
                                <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                                </svg>
                                <span class="mx-1">Save</span>
                            </button>
                            <a class="flex justify-center items-center mx-1 btn-danger" href="/media/area">
                                <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                                </svg>
                                <span class="mx-1">Cancel</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center mt-4">
                    <div class="w-[300px] px-2">
                        <div class="flex mx-1 mt-3 items-center">
                            <label class="w-24 text-stone-100">Kode Area</label>
                            <input name="area_code" class="input-area in-out-spin-none w-[160px]" type="number"
                                min="0" value="{{ $area->area_code }}" autofocus required>
                        </div>
                        @error('area_code')
                            <div class="text-red-600 flex mx-1">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="flex mx-1 mt-3 items-center">
                            <label class="w-24 text-stone-100">Nama Area</label>
                            <input name="area" class="flex input-area w-[160px] @error('area') is-invalid @enderror"
                                type="text" value="{{ $area->area }}" required>
                        </div>
                        @error('area')
                            <div class="text-red-600 flex mx-1">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="flex mx-1 mt-3 items-center">
                            <label class="w-24 text-stone-100">Latitude</label>
                            <input id="lat" name="lat" class="input-area w-[160px]" type="text"
                                title="Tandai dari Google Maps" value="{{ $area->lat }}" readonly required>
                        </div>
                        <div class="flex
                            mx-1 mt-3 items-center">
                            <label class="w-24 text-stone-100">Longitude</label>
                            <input id="lng" name="lng" class="input-area w-[160px]" type="text"
                                title="Tandai dari Google Maps" value="{{ $area->lng }}" readonly required>
                        </div>
                        <div class="flex
                            mx-1 mt-3 items-center">
                            <label class="w-24 text-stone-100">Zoom</label>
                            <input id="zoom" name="zoom" class="input-area w-[160px] in-out-spin-none"
                                min="0" max="16" type="number" value="{{ $area->zoom }}"
                                onkeyup="setZoom(this)" required>
                        </div>
                        @error('zoom')
                            <div class="text-red-600 flex mx-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <!-- Maps Area start -->
                    <div class="flex justify-center w-full lg-map-product">
                        <div>
                            <div class="lg-map-product" id="map">
                            </div>
                        </div>
                    </div>
                    <!-- Maps Area end -->
                </div>
            </div>
        </div>
    </form>
    <!-- Form Edit Area end -->
    <!-- Edit Area end -->

    <!-- Script Area start -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg&callback=initMap"
        defer></script>

    <script>
        let map;
        let markers = [];
        myLatLng = {
            lat: Number(document.getElementById('lat').value),
            lng: Number(document.getElementById('lng').value)
        };
        zoomMaps = Number(document.getElementById('zoom').value);

        setZoom = (sel) => {
            if (document.getElementById('lat').value != "") {
                if (sel.value != 0 || sel.value != "") {
                    myLatLng = {
                        lat: Number(document.getElementById('lat').value),
                        lng: Number(document.getElementById('lng').value)
                    };
                    zoomMaps = Number(sel.value);
                    initMap();
                }
            }
        }

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: zoomMaps,
                center: myLatLng,
            });

            map.addListener("click", (event) => {
                deleteMarkers();
                addMarker(event.latLng);
                document.getElementById('lat').value = event.latLng.lat();
                document.getElementById('lng').value = event.latLng.lng();
            });
        }

        // Adds a marker to the map and push to the array.
        function addMarker(position) {
            const marker = new google.maps.Marker({
                position,
                map,
            });

            markers.push(marker);
        }

        // Sets the map on all markers in the array.
        function setMapOnAll(map) {
            for (let i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }

        // Deletes all markers in the array by removing references to them.
        function deleteMarkers() {
            setMapOnAll(null);
            markers = [];
        }
        // Google maps --> end
    </script>
    <!-- Script Area end -->
@endsection
