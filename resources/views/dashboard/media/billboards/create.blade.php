@extends('dashboard.layouts.main');

@section('container')
    <!-- Create New Billboard start -->
    <!-- Title Create New Billboard start -->
    <div class="flex absolute mx-3 border-b p-2">
        <h1 class="flex text-xl text-cyan-800 font-bold tracking-wider"> MENAMBAHKAN BILLBOARD</h1>
    </div>
    <!-- Title Create New Billboard end -->
    <div class="flex absolute justify-start h-screen w-[300px]">
        <div class="items-center mt-10 w-full ml-0">
            <!-- Form Create New Billboard start -->
            <form action="/dashboard/media/billboards" method="post">
                @csrf
                <div class="w-96">
                    <div class="flex mx-5 mt-1">
                        <div class="mt-1">
                            <label class="text-sm text-teal-700">Kode</label>
                            <input
                                class="flex h-7 px-2 text-sm font-semibold text-teal-900 w-56 border rounded-lg p-1 outline-teal-300 @error('code') is-invalid @enderror"
                                type="text" id="code" name="code" placeholder="Kode Billboard"
                                value="{{ old('code') }}" required>
                            @error('code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex mx-5 mt-1 w-96">
                        <div class="mt-1">
                            <label class="text-sm text-teal-700">Area</label>
                            <input class="@error('area_id') is-invalid @enderror" type="text" id="area_id"
                                name="area_id" value="{{ old('area_id') }}" hidden required>
                            <select id="area" name="area"
                                class="flex px-2 w-56 h-7 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none"
                                type="text">
                            </select>
                            @error('area_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex mx-5 mt-1 w-96">
                        <div class="mt-1">
                            <label class="text-sm text-teal-700">Kota</label>
                            <input class="@error('city_id') is-invalid @enderror" type="text" id="city_id"
                                name="city_id" value="{{ old('city_id') }}" hidden required>
                            <select id="city" name="city"
                                class="flex px-2 w-56 h-7 text-sm font-semibold border text-teal-900 rounded-lg p-1 outline-none"
                                type="text">
                            </select>
                            @error('city_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex mx-5 mt-1 w-96">
                        <div class="mt-1">
                            <label class="text-sm text-teal-700">Lokasi</label>
                            <textarea
                                class="flex px-2 text-sm font-semibold text-teal-900 w-56 border rounded-lg p-1 outline-teal-300 @error('address') is-invalid @enderror"
                                name="address" id="address" required placeholder="Lokasi Billboard">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex mx-5 mt-1 w-96">
                        <div class="mt-1">
                            <label class="text-sm text-teal-700">Lattitude</label>
                            <input
                                class="flex h-7 px-2 text-sm font-semibold text-teal-900 w-56 border rounded-lg p-1 outline-teal-300 @error('lat') is-invalid @enderror"
                                type="text" id="lat" name="lat" placeholder="Lattitude"
                                value="{{ old('lat') }}" required>
                            @error('lat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex mx-5 mt-1 w-96">
                        <div class="mt-1">
                            <label class="text-sm text-teal-700">Longitude</label>
                            <input
                                class="flex h-7 px-2 text-sm font-semibold text-teal-900 w-56 border rounded-lg p-1 outline-teal-300 @error('lng') is-invalid @enderror"
                                type="text" id="lng" name="lng" placeholder="Longitude"
                                value="{{ old('lat') }}" required>
                            @error('lat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex mx-5 mt-1 w-96">
                        <div class="mt-1">
                            <label class="text-sm text-teal-700">Jenis</label>
                            <input class="@error('product_category_id') is-invalid @enderror" type="text"
                                id="product_category_id" name="product_category_id"
                                value="{{ old('product_category_id') }}" hidden required>
                            <select id="category" name="category"
                                class="flex px-2 w-56 h-7 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none"
                                type="text">
                            </select>
                            @error('product_category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex mx-5 mt-1 w-96">
                        <div class="mt-1">
                            <label class="text-sm text-teal-700">Ukuran</label>
                            <input class="@error('size_id') is-invalid @enderror" type="text" id="size_id"
                                name="size_id" value="{{ old('size_id') }}" hidden required>
                            <select id="size" name="size"
                                class="flex px-2 w-56 h-7 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none"
                                type="text">
                            </select>
                            @error('size_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex mx-5 mt-5">
                        <button class="flex justify-center items-center mx-2 btn-primary" type="submit">
                            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                            </svg>
                            <span class="mx-1">Save</span>
                        </button>
                        <a class="flex justify-center items-center mx-2 btn-danger" href="/dashboard/media/billboards">
                            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="mx-1">Cancel</span>
                        </a>
                    </div>
                </div>
            </form>
            <!-- Form Create New Billboard end -->
            <!-- Create New Billboard end -->
        </div>
    </div>
    <div class="flex absolute mx-[300px] justify-start h-screen w-[300px]">
        <div class="items-center mt-10 w-full ml-0">
            <!-- Form Create New Billboard start -->
            <form action="/dashboard/media/billboards" method="post">
                @csrf
                <div class="w-96">
                    <div class="flex mx-5 mt-1">
                        <div class="mt-1">
                            <label class="text-sm text-teal-700">Kepemilikan</label>
                            <select id="property_status" name="property_status"
                                class="flex px-2 w-56 h-7 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('property_status') is-invalid @enderror"
                                type="text">
                                <option value="0">Pilih Kepemilikan</option>
                                <option value="1">Vista Media</option>
                                <option value="2">Mitra/Partner</option>
                            </select>
                            @error('property_status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex mx-5 mt-1 w-96">
                        <div class="mt-1">
                            <label class="text-sm text-teal-700">Kondisi</label>
                            <select id="build_status" name="build_status"
                                class="flex px-2 w-56 h-7 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('build_status') is-invalid @enderror"
                                type="text">
                                <option value="0">Pilih Kondisi</option>
                                <option value="1">Terbangun/Existing</option>
                                <option value="2">Sedang Dibangun</option>
                                <option value="2">Rencana</option>
                            </select>
                            @error('build_status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex mx-5 mt-1 w-96">
                        <div class="mt-1">
                            <label class="text-sm text-teal-700">Status</label>
                            <select id="sale_status" name="sale_status"
                                class="flex px-2 w-56 h-7 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('sale_status') is-invalid @enderror"
                                type="text">
                                <option value="0">Pilih Status</option>
                                <option value="1">Available/Kosong</option>
                                <option value="2">Sold/Terjual</option>
                            </select>
                            @error('sale_status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex mx-5 mt-1 w-96">
                        <div class="mt-1">
                            <label class="text-sm text-teal-700">Type Jalan</label>
                            <select id="road_segmen" name="road_segmen"
                                class="flex px-2 w-56 h-7 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('road_segmen') is-invalid @enderror"
                                type="text">
                                <option value="0">Pilih Type Jalan</option>
                                <option value="1">2 Lajur</option>
                                <option value="2">4 Lajur</option>
                                <option value="1">6 Lajur</option>
                                <option value="2">8 Lajur</option>
                            </select>
                            @error('road_segmen')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex mx-5 mt-1 w-96">
                        <div class="mt-1">
                            <label class="text-sm text-teal-700">Jarak Pandang Maksimal</label>
                            <select id="max_distance" name="max_distance"
                                class="flex px-2 w-56 h-7 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('max_distance') is-invalid @enderror"
                                type="text">
                                <option value="0">Pilih Jarak Pandang</option>
                                <option value="1">> 50 m</option>
                                <option value="2">> 100 m</option>
                                <option value="1">> 150 m</option>
                                <option value="2">> 200 m</option>
                                <option value="1">> 250 m</option>
                                <option value="2">> 300 m</option>
                            </select>
                            @error('max_distance')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex mx-5 mt-1 w-96">
                        <div class="mt-1">
                            <label class="text-sm text-teal-700">Kecepatan Kendaraan Rata-Rata</label>
                            <select id="speed_average" name="speed_average"
                                class="flex px-2 w-56 h-7 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('speed_average') is-invalid @enderror"
                                type="text">
                                <option value="0">Pilih Kecepatan Kendaraan</option>
                                <option value="1">0 - 10 km/jam</option>
                                <option value="2">0 - 20 km/jam</option>
                                <option value="1">10 - 20 km/jam</option>
                                <option value="2">10 - 40 km/jam</option>
                                <option value="1">20 - 40 km/jam</option>
                                <option value="2">20 - 60 km/jam</option>
                            </select>
                            @error('speed_average')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex mx-5 mt-1 w-96">
                        <div class="mt-1">
                            <label class="text-sm text-teal-700 border-b w-56 flex p-1">Kawasan</label>
                            <div class="flex w-56 mt-2">
                                <input type="checkbox" id="airport" name="airport"><label
                                    class="ml-2 text-sm text-teal-700 flex w-24">Bandara</label>
                                <input class="ml-2" type="checkbox" id="tol" name="tol"><label
                                    class="ml-2 text-sm text-teal-700 flex w-24">Jalan
                                    Tol</label>
                            </div>
                            <div class="flex w-56">
                                <input type="checkbox" id="hotel" name="hotel"><label
                                    class="ml-2 text-sm text-teal-700 flex w-24">Hotel</label>
                                <input class="ml-2" type="checkbox" id="restaurant" name="restaurant"><label
                                    class="ml-2 text-sm text-teal-700 flex w-24">Restoran</label>
                            </div>
                            <div class="flex w-56">
                                <input type="checkbox" id="shops" name="shops"><label
                                    class="ml-2 text-sm text-teal-700 flex w-24">Pertokoan</label>
                                <input class="ml-2" type="checkbox" id="offiece" name="office"><label
                                    class="ml-2 text-sm text-teal-700 flex w-24">Perkantoran</label>
                            </div>
                            <div class="flex w-56">
                                <input type="checkbox" id="tourist" name="tourist"><label
                                    class="ml-2 text-sm text-teal-700 flex w-24">Area
                                    Wisata</label>
                                <input class="ml-2" type="checkbox" id="mall" name="mall"><label
                                    class="ml-2 text-sm text-teal-700 flex w-24">Mall</label>
                            </div>
                            <div class="flex w-56">
                                <input type="checkbox" id="garden" name="garden"><label
                                    class="ml-2 text-sm text-teal-700 flex w-24">Taman
                                    Kota</label>
                                <input class="ml-2" type="checkbox" id="market" name="market"><label
                                    class="ml-2 text-sm text-teal-700 flex w-24">Pasar</label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Form Create New Billboard end -->
            <!-- Create New Billboard end -->
        </div>
    </div>
    <div class="flex relative justify-end items-center mt-[120px]">
        <!-- Photo Billboard start -->
        <div class="map-product flex absolute mt-2 justify-center">
            <span class="mt-0 flex absolute text-base font-semibold">Photo Lokasi</span>
            <img class="map-product mt-6" src="" alt="">
        </div>
        <!-- Photo Billboard end -->
        <!-- Maps Billboard start -->
        <div class="w-[500px] flex absolute mt-[310px] justify-center">
            <span class="mt-0 flex absolute text-base font-semibold">Peta Lokasi</span>
        </div>
        <div class="map-product flex absolute mt-[610px]" id="map">
        </div>
        <!-- Maps Billboard end -->
    </div>
    <!-- Script Billboard start -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg&callback=initMap"
        defer></script>

    <script src="/js/product.js"></script>
    <!-- Script Billboard end -->
@endsection
