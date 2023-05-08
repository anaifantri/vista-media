@extends('dashboard.layouts.main');

@section('container')
    <!-- Show City start -->
    <div class="flex relative h-screen w-full">
        <!-- Title Show City start -->
        <div class="flex absolute mx-3 border-b p-2 items-center">
            <h1 class="flex text-xl text-cyan-800 font-bold tracking-wider m-auto">Kota
                {{ $city->city }}</h1>
        </div>
        <!-- Title Show City end -->
        <!-- Show City start -->
        <div class="items-center mt-10 w-[370px] ml-0">
            <div class="flex mx-5 mt-3">
                <span class="w-36">Kode Kota</span>
                <label class="flex items-center w-full h-8 rounded-lg bg-gray-50 px-2 text-teal-900" for="code">
                    {{ $city->code }}</label>
            </div>
            <div class="flex mx-5 mt-3">
                <span class="w-36">Nama Kota</span>
                <label class="flex items-center w-full h-8 rounded-lg bg-gray-50 px-2 text-teal-900" for="city">
                    {{ $city->city }}</label>
            </div>
            <div class="flex mx-5 mt-3">
                <span class="w-36">Nama Area</span>
                <label class="flex items-center w-full h-8 rounded-lg bg-gray-50 px-2 text-teal-900"
                    for="code">{{ $city->area }}</label>
            </div>
            <div class="flex mx-5 mt-3">
                <span class="w-36">Latitude</span>
                <label class="flex items-center w-full h-8 rounded-lg bg-gray-50 px-2 text-teal-900" for="lat"
                    id="lat" name="lat">{{ $city->lat }}</label>
            </div>
            <div class="flex
                    mx-5 mt-3">
                <span class="w-36">Longitude</span>
                <label class="flex items-center w-full h-8 rounded-lg bg-gray-50 px-2 text-teal-900" for="lng"
                    id="lng" name="lng">{{ $city->lng }}</label>
            </div>
            <div class="flex
                    mx-5 mt-3">
                <span class="w-36">Zoom</span>
                <label class="flex items-center w-full h-8 rounded-lg bg-gray-50 px-2 text-teal-900" for="zoom"
                    id="zoom" name="zoom">{{ $city->zoom }}</label>
            </div>
            <div class="flex
                    mx-5 mt-3">
                <span class="w-36">Dibuat Oleh</span>
                <label class="flex items-center w-full h-8 rounded-lg bg-gray-50 px-2 text-teal-900" for="zoom"
                    id="username" name="username">{{ $city->username }}</label>
            </div>
            <div class="flex
                    mx-5 mt-3">
                <span class="w-36">Tgl. Dibuat</span>
                <label class="flex items-center w-full h-8 rounded-lg bg-gray-50 px-2 text-teal-900" for="zoom"
                    id="created_at" name="created_at">{{ $city->created_at->format('l, d-M-Y') }}</label>
            </div>
            <div class="flex
                    mx-5 mt-3">
                <span class="w-36">Tgl. Update</span>
                <label class="flex items-center w-full h-8 rounded-lg bg-gray-50 px-2 text-teal-900" for="zoom"
                    id="updated_at" name="updated_at">{{ $city->updated_at->format('l, d-M-Y') }}</label>
            </div>
            <div class="flex justify-start items-center mt-10 w-80 ml-0">
                <!-- Form Button Show City start -->
                <div class="flex mx-1 mt-5 items-center">
                    <a class="flex justify-center items-center mx-1 btn-primary" href="/dashboard/media/cities">
                        <svg class="fill-current w-6" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m12.017 1.995c5.517 0 9.997 4.48 9.997 9.998s-4.48 9.998-9.997 9.998c-5.518 0-9.998-4.48-9.998-9.998s4.48-9.998 9.998-9.998zm0 1.5c-4.69 0-8.498 3.808-8.498 8.498s3.808 8.498 8.498 8.498 8.497-3.808 8.497-8.498-3.807-8.498-8.497-8.498zm-1.528 4.715s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="mx-1">Back to Kota</span>
                    </a>
                    <form action="/dashboard/media/cities/{{ $city->id }}" method="post" class="d-inline m-1">
                        @method('delete')
                        @csrf
                        <button class="items-center flex justify-center mx-1 btn-danger"
                            onclick="return confirm('Apakah anda yakin ingin menghapus Kota {{ $city->city }} ?')">
                            <svg class="w-5 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <title>DELETE</title>
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                            </svg>
                            <span class="mx-1">Delete</span>
                        </button>
                    </form>
                </div>
                <!-- Form Button Show City end -->
            </div>
        </div>
        <!-- Show City end -->
        <!-- Maps City start -->
        <div class="map" id="map">
        </div>
        <!-- Maps City end -->
    </div>
    <!-- Script City start -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg&callback=initMap"
        defer></script>

    <script src="/js/showcity.js"></script>
    <!-- Script City end -->
@endsection
