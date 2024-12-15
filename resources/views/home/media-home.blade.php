@extends('dashboard.layouts.main');

@section('container')
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <!-- Locations start -->
            <div class="flex justify-center w-full p-2 mt-2">
                <label class="text-2xl text-stone-50 font-bold">DATA LOKASI</label>
            </div>
            <div class="grid grid-cols-4 gap-2 w-[1200px] p-2">
                @foreach ($categories as $category)
                    @if ($category->name != 'Service')
                        <a href="/media/locations/home/{{ $category->name }}"
                            class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                            <span class="flex justify-center font-serif text-md">Katagori</span>
                            <span
                                class="flex justify-center text-stone-200 font-serif text-md font-semibold">{{ $category->name }}</span>
                        </a>
                    @endif
                @endforeach
                <a href="/media/locations/home/All"
                    class="text-teal-400 col-span-2 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                    <span class="flex justify-center font-serif text-md">Katagori</span>
                    <span class="flex justify-center text-stone-200 font-serif text-md font-semibold">Semua
                        Katagori</span>
                </a>
            </div>
            <!-- Locations end -->

            <!-- Area start -->
            <div class="flex justify-center w-full p-2 mt-2">
                <label class="text-2xl text-stone-50 font-bold">DATA AREA</label>
            </div>
            <div class="grid grid-cols-2 gap-2 w-[1200px] p-2">
                <a href="/media/area"
                    class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                    <span class="flex justify-center font-serif text-md">Area</span>
                </a>
                <a href="/media/cities"
                    class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                    <span class="flex justify-center font-serif text-md">Kota</span>
                </a>
            </div>
            <!-- Area end -->

            <!-- Legal start -->
            <div class="flex justify-center w-full p-2 mt-2">
                <label class="text-2xl text-stone-50 font-bold">DATA LEGALITAS</label>
            </div>
            <div class="grid grid-cols-3 gap-2 w-[1200px] p-2">
                <a href="/media/licensing-categories"
                    class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                    <span class="flex justify-center font-serif text-md">Katagori Izin</span>
                </a>
                <a href="/media/licenses"
                    class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                    <span class="flex justify-center font-serif text-md">Data Izin</span>
                </a>
                <a href="/media/land-agreements"
                    class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                    <span class="flex justify-center font-serif text-md">Data Sewa Lahan</span>
                </a>
            </div>
            <!-- Legal end -->

            <!-- Setting start -->
            <div class="flex justify-center w-full p-2 mt-2">
                <label class="text-2xl text-stone-50 font-bold">PENGATURAN</label>
            </div>
            <div class="grid grid-cols-3 gap-2 w-[1200px] p-2">
                <a href="/media/media-categories"
                    class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                    <span class="flex justify-center font-serif text-md">Katagori Media</span>
                </a>
                <a href="/media/media-sizes"
                    class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                    <span class="flex justify-center font-serif text-md">Ukuran</span>
                </a>
                <a href="/media/leds"
                    class="text-teal-400 w-full bg-stone-900 hover:bg-stone-800 border rounded-lg shadow-lg p-2">
                    <span class="flex justify-center font-serif text-md">Jenis LED</span>
                </a>
            </div>
            <!-- Setting end -->
        </div>
    </div>
@endsection
