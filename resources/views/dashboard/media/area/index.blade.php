@extends('dashboard.layouts.main');

@section('container')
    <div class="container bg-emerald-50 rounded-xl p-2 h-screen sm:flex sm:relative drop-shadow-lg w-full">
        <h1 class="text-xl text-cyan-800 font-bold tracking-wider mx-5 flex absolute"> MENAMBAHKAN AREA</h1>
        <div class="items-center mt-10 w-80 ml-0">
            <form action="">
                @csrf
                <div class="flex mx-5 mt-3">
                    <span class="w-32">Kode Area</span>
                    <input id="code" name="code" class="ml-3 p-1 rounded-sm bg-white" type="text"
                        placeholder="Kode Area" disabled>
                </div>
                <div class="flex mx-5 mt-3">
                    <span class="w-32">Nama Area</span>
                    <select id="area" name="area" class="ml-3 p-1 rounded-sm w-[298px]" type="text"
                        placeholder="Nama Area">
                        <option selected>Pilih Area / Wilayah</option>
                        <option value="1">Bali</option>
                    </select>
                </div>
                <input id="coordinate" name="coordinate" class="hidden" type="text">
                <div class="flex mx-5 mt-3">
                    <span class="w-32">Latitude</span>
                    <input id="latitude" name="latitude" class="ml-3 p-1 rounded-sm bg-white" type="text"
                        placeholder="Latitude" disabled>
                </div>
                <div class="flex mx-5 mt-3">
                    <span class="w-32">Longitude</span>
                    <input id="longitude" name="longitude" class="ml-3 p-1 rounded-sm bg-white" type="text"
                        placeholder="Longitude" disabled>
                </div>
                <div class="flex mx-5 mt-3">
                    <span class="w-32">Zoom</span>
                    <input id="zoom" name="zoom" class="ml-3 p-1 rounded-sm bg-white" type="text"
                        placeholder="Zoom" disabled>
                </div>
                <div class="flex mx-5 mt-5">
                    <button
                        class="flex justify-center w-20 h-7 hover:bg-emerald-500 rounded-md bg-emerald-400 items-center text-white drop-shadow-lg"
                        type="submit">Save</button>
                    <a class="flex justify-center ml-3 w-20 h-7 hover:bg-red-600 rounded-md bg-red-500 items-center text-white drop-shadow-lg"
                        href="#">Cancel</a>
                </div>
            </form>
        </div>
        <div class="" id="map" class="items-center w-full mt-10">

        </div>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg&callback=initMap"
        defer></script>

    <script src="/js/area.js"></script>
@endsection
