@extends('dashboard.layouts.main');

@section('container')
    <!-- Create New Area start -->
    <!-- Form Create New Area start -->
    <form action="/media/area" method="post" class="d-inline">
        @csrf
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
                <div class="flex justify-center w-full ">
                    <div class="flex w-[900px] border-b">
                        <!-- Title Area start -->
                        <h1 class="index-h1 w-[500px]"> MENAMBAHKAN AREA</h1>
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
                                min="0" value="{{ old('area_code') }}" placeholder="Kode Area" autofocus required>
                        </div>
                        @error('area_code')
                            <div class="text-red-600 flex mx-1">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="flex mx-1 mt-3 items-center">
                            <label class="w-24 text-stone-100">Nama Area</label>
                            <input name="area" class="flex input-area w-[160px] @error('area') is-invalid @enderror"
                                type="text" placeholder="Nama Area" value="{{ old('area') }}" required>
                        </div>
                        @error('area')
                            <div class="text-red-600 flex mx-1">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="flex mx-1 mt-3 items-center">
                            <label class="w-24 text-stone-100">Latitude</label>
                            <input id="lat" name="lat" class="input-area w-[160px]" type="text"
                                placeholder="Latitude" title="Tandai dari Google Maps" value="{{ old('lat') }}" readonly
                                required>
                        </div>
                        <div class="flex
                            mx-1 mt-3 items-center">
                            <label class="w-24 text-stone-100">Longitude</label>
                            <input id="lng" name="lng" class="input-area w-[160px]" type="text"
                                placeholder="Longitude" title="Tandai dari Google Maps" value="{{ old('lng') }}" readonly
                                required>
                        </div>
                        <div class="flex
                            mx-1 mt-3 items-center">
                            <label class="w-24 text-stone-100">Zoom</label>
                            <input id="zoom" name="zoom" class="input-area w-[160px] in-out-spin-none"
                                min="0" max="16" type="number" placeholder="Zoom" onkeyup="setZoom(this)"
                                required>
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
                            @error('lat')
                                <div class="text-red-600 flex mx-1">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="lg-map-product" id="map">
                            </div>
                        </div>
                    </div>
                    <!-- Maps Area end -->
                </div>
            </div>
        </div>
    </form>
    <!-- Form Create New Area end -->
    <!-- Create New Area end -->

    <!-- Script Area start -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg&callback=initMap"
        defer></script>

    <script src="/js/createarea.js"></script>

    <script>
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
    </script>
    <!-- Script Area end -->
@endsection
