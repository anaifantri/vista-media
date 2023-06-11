@extends('dashboard.layouts.main');

@section('container')
    <!-- Create New Area start -->
    <div class="mt-10 md:flex justify-center">
        <div class="md:w-[300px] lg:w-[360px]">
            <!-- Title Create New Area start -->
            <div class="flex mx-3 border-b p-2">
                <h1 class="flex text-xl text-cyan-800 font-bold tracking-wider"> MENAMBAHKAN AREA</h1>
            </div>
            <!-- Title Create New Area end -->
            <div class="flex justify-center items-center lg:w-[360px] ml-0">
                <!-- Form Create New Area start -->
                <form action="/dashboard/media/area" method="post">
                    @csrf
                    <div class="flex mx-1 mt-3">
                        <span class="w-24">Kode Area</span>
                        <input id="area_code" name="area_code" class="input-area w-[160px]" type="text"
                            placeholder="Kode Area" readonly required>
                    </div>
                    <div class="flex mx-1 mt-3
                        items-center">
                        <span class="w-24">Nama Provinsi</span>
                        <select id="provinsi" name="provinsi" class="ml-3 p-1 rounded-md w-[160px] h-8 outline-none border"
                            type="text" autofocus>
                        </select>
                    </div>
                    <div class="flex mx-1 mt-3">
                        <span class="w-24">Nama Area</span>
                        <input id="area" name="area"
                            class="flex input-area w-[160px] @error('area') is-invalid @enderror" type="text"
                            placeholder="Nama Area" readonly required>
                    </div>
                    @error('area')
                        <div id="areaAlert" name="areaAlert" class="text-red-600 flex mx-1">
                            {{ $message }}
                        </div>
                    @enderror
                    <input id="coordinate" name="coordinate" class="hidden" type="text" disabled>
                    <div class="flex mx-1 mt-3">
                        <span class="w-24">Latitude</span>
                        <input id="lat" name="lat" class="input-area w-[160px]" type="text"
                            placeholder="Latitude" readonly required>
                    </div>
                    <div class="flex
                            mx-1 mt-3">
                        <span class="w-24">Longitude</span>
                        <input id="lng" name="lng" class="input-area w-[160px]" type="text"
                            placeholder="Longitude" readonly required>
                    </div>
                    <div class="flex
                            mx-1 mt-3">
                        <span class="w-24">Zoom</span>
                        <input id="zoom" name="zoom" class="input-area w-[160px]" type="text" placeholder="Zoom"
                            readonly required>
                    </div>
                    <div class="flex mx-1 mt-5">
                        <button class="flex justify-center items-center mx-1 btn-primary" type="submit">
                            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                            </svg>
                            <span class="mx-1">Save</span>
                        </button>
                        <a class="flex justify-center items-center mx-1 btn-danger" href="/dashboard/media/area">
                            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="mx-1">Cancel</span>
                        </a>
                    </div>
                </form>
                <!-- Form Create New Area end -->
            </div>
        </div>
        <!-- Create New Area end -->
        <!-- Maps Area start -->
        <div class="flex justify-center w-full md:w-[420px] lg:w-[495px] xl:w-[550px] 2xl:w-[640px]">
            <div class="m-map-product md:w-[400px] md:h-[267px] lg:w-[495px] lg:h-[330px] xl:w-[550px] xl:h-[367px] 2xl:w-[640px] 2xl:h-[427px] mb-10"
                id="map">
            </div>
        </div>
        <!-- Maps Area end -->
    </div>
    <!-- Script Area start -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg&callback=initMap"
        defer></script>

    <script src="/js/createarea.js"></script>
    <!-- Script Area end -->
@endsection
