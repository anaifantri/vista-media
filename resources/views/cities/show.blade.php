@extends('dashboard.layouts.main');

@section('container')
    <!-- Show City start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex justify-center w-full ">
                <div class="flex w-[900px] border-b">
                    <!-- Title Area start -->
                    <h1 class="index-h1 w-[500px]">DATA KOTA {{ strtoupper($city->city) }}</h1>
                    <!-- Title Area end -->
                    <div class="flex w-full justify-end items-center">
                        <a class="flex justify-center items-center mx-1 btn-primary" href="/media/cities">
                            <svg class="fill-current w-6" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m12.017 1.995c5.517 0 9.997 4.48 9.997 9.998s-4.48 9.998-9.997 9.998c-5.518 0-9.998-4.48-9.998-9.998s4.48-9.998 9.998-9.998zm0 1.5c-4.69 0-8.498 3.808-8.498 8.498s3.808 8.498 8.498 8.498 8.497-3.808 8.497-8.498-3.807-8.498-8.497-8.498zm-1.528 4.715s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1">Back</span>
                        </a>
                        @canany(['isAdmin', 'isMedia'])
                            @can('isArea')
                                @can('isMediaEdit')
                                    <a href="/media/cities/{{ $city->id }}/edit"
                                        class="flex items-center justify-center btn-warning mx-1">
                                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                fill-rule="nonzero" />
                                        </svg>
                                        <span class="mx-1"> Edit </span>
                                    </a>
                                @endcan
                            @endcan
                        @endcanany
                        @canany(['isAdmin', 'isMedia'])
                            @can('isArea')
                                @can('isMediaDelete')
                                    <form action="/media/cities/{{ $city->id }}" method="post" class="d-inline m-1">
                                        @method('delete')
                                        @csrf
                                        <button class="items-center flex justify-center mx-1 btn-danger"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus kota {{ $city->city }} ?')">
                                            <svg class="w-5 fill-current" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24">
                                                <title>DELETE</title>
                                                <path
                                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                                            </svg>
                                            <span class="mx-1">Delete</span>
                                        </button>
                                    </form>
                                @endcan
                            @endcan
                        @endcanany
                    </div>
                </div>
            </div>
            <div class="flex justify-center mt-4">
                <div class="w-[300px]">
                    <div class="flex mx-5 mt-3">
                        <span class="w-36 text-stone-100">Kode Kota</span>
                        <label class="flex items-center w-full h-8 rounded-lg bg-gray-50 px-2 text-stone-900"
                            for="code">
                            {{ $city->code }}</label>
                    </div>
                    <div class="flex mx-5 mt-3">
                        <span class="w-36 text-stone-100">Nama Kota</span>
                        <input type="text" id="city" name="city" hidden value="{{ $city->id }}">
                        <label class="flex items-center w-full h-8 rounded-lg bg-gray-50 px-2 text-stone-900"
                            for="city">
                            {{ $city->city }}</label>
                    </div>
                    <div class="flex mx-5 mt-3">
                        <span class="w-36 text-stone-100">Nama Area</span>
                        <label class="flex items-center w-full h-8 rounded-lg bg-gray-50 px-2 text-stone-900"
                            for="code">{{ $city->area->area }}</label>
                    </div>
                    <div class="flex mx-5 mt-3">
                        <span class="w-36 text-stone-100">Latitude</span>
                        <label class="flex items-center w-full h-8 rounded-lg bg-gray-50 px-2 text-stone-900" for="lat"
                            id="lat" name="lat">{{ $city->lat }}</label>
                    </div>
                    <div class="flex
                    mx-5 mt-3">
                        <span class="w-36 text-stone-100">Longitude</span>
                        <label class="flex items-center w-full h-8 rounded-lg bg-gray-50 px-2 text-stone-900" for="lng"
                            id="lng" name="lng">{{ $city->lng }}</label>
                    </div>
                    <div class="flex
                    mx-5 mt-3">
                        <span class="w-36 text-stone-100">Zoom</span>
                        <label class="flex items-center w-full h-8 rounded-lg bg-gray-50 px-2 text-stone-900" for="zoom"
                            id="zoom" name="zoom">{{ $city->zoom }}</label>
                    </div>
                </div>
                <!-- Show City end -->
                <!-- Maps City start -->
                <div class="flex justify-center lg-map-product">
                    <div class="lg-map-product" id="map">
                    </div>
                    <!-- Maps City end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Script City start -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg&callback=initMap"
        defer></script>

    <script src="/js/showcity.js"></script>
    <!-- Script City end -->
@endsection
