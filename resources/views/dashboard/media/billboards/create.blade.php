@extends('dashboard.layouts.main');

@section('container')
    <!-- Create New Billboard start -->
    <div class="flex justify-center">
        <div class="mt-10">
            <!-- Title Create New Billboard start -->
            <div class="flex border-b">
                <h1 class="text-xl text-cyan-800 font-bold tracking-wider"> MENAMBAHKAN BILLBOARD</h1>
            </div>
            <!-- Title Create New Billboard end -->
            <!-- Form Create New Billboard start -->
            <div class="flex">
                <form class="md:flex" action="/dashboard/media/billboards" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="flex justify-center">
                        <div class="flex mx-1">
                            <div class="">
                                <div class="flex mt-1">
                                    <div class="mt-1">
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Kode Lokasi</label>
                                        <input
                                            class="flex text-sm xl:text-md 2xl:text-lg font-semibold text-slate-500 w-32 border rounded-lg p-1 outline-teal-300 @error('code') is-invalid @enderror"
                                            type="text" id="code" name="code" value="{{ old('code') }}"
                                            autofocus placeholder="Kode" required>
                                    </div>
                                    @error('code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="flex mt-1">
                                    <div class="mt-1">
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Area</label>
                                        <select id="area_id" name="area_id"
                                            class="flex w-36 xl:w-48 2xl:w-56  text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('area_id') is-invalid @enderror"
                                            type="text" value="{{ old('area_id') }}">
                                            <option value="Pilih Area">Pilih Area</option>
                                            @foreach ($areas as $area)
                                                @if (old('area_id') == $area->id)
                                                    <option value="{{ $area->id }}" selected>{{ $area->area }}
                                                    </option>
                                                @else
                                                    <option value="{{ $area->id }}">{{ $area->area }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('area_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex mt-1">
                                    <div class="mt-1">
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Kota</label>
                                        <input type="text" id="city_id" name="city_id" value="{{ old('city_id') }}"
                                            hidden>
                                        <input type="text" id="cityCode" name="cityCode" value="{{ old('cityCode') }}"
                                            hidden>
                                        <input type="text" id="inputCity" name="inputCity"
                                            value="{{ old('inputCity') }}" hidden>
                                        <select id="city" name="city"
                                            class="flex text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 w-36 xl:w-48 2xl:w-56  border rounded-lg p-1 outline-teal-300 @error('city') is-invalid @enderror"
                                            type="text">
                                        </select>
                                        @error('city')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex mt-1">
                                    <div class="mt-1">
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Lokasi</label>
                                        <textarea
                                            class="flex text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 w-36 xl:w-48 2xl:w-56  border rounded-lg p-1 outline-teal-300 @error('address') is-invalid @enderror"
                                            name="address" id="address" placeholder="Lokasi Billboard">{{ old('address') }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex mt-1">
                                    <div class="mt-1">
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Latitude</label>
                                        <input
                                            class="flex text-sm xl:text-md 2xl:text-lg font-semibold text-slate-500 w-36 xl:w-48 2xl:w-56  border rounded-lg p-1 outline-teal-300 @error('lat') is-invalid @enderror"
                                            type="text" id="lat" name="lat" placeholder="Latitude"
                                            value="{{ old('lat') }}" required readonly title="Latitude select from map">
                                        @error('lat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex mt-1">
                                    <div class="mt-1">
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Longitude</label>
                                        <input
                                            class="flex text-sm xl:text-md 2xl:text-lg font-semibold text-slate-500 w-36 xl:w-48 2xl:w-56  border rounded-lg p-1 outline-teal-300 @error('lng') is-invalid @enderror"
                                            type="text" id="lng" name="lng" placeholder="Longitude"
                                            value="{{ old('lng') }}" required readonly
                                            title="Longitude select from map">
                                        @error('lat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <div class="flex mt-1">
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Penerangan</label>
                                    </div>
                                    <div class="flex mt-1">
                                        <input type="text" id="inputLighting" name="inputLighting"
                                            value="{{ old('inputLighting') }}" hidden>
                                        <select id="lighting" name="lighting"
                                            class="w-36 xl:w-48 2xl:w-56  text-sm xl:text-md 2xl:text-lg
                                            font-semibold text-teal-900 border rounded-lg p-1 outline-none
                                            @error('lighting') is-invalid @enderror"
                                            type="text" value="{{ old('lighting') }}">
                                        </select>
                                        @error('product_category_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        @error('lighting')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex mt-1">
                                    <div class="mt-1">
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Ukuran</label>
                                        <select id="size_id" name="size_id"
                                            class="flex w-36 xl:w-48 2xl:w-56  text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('size_id') is-invalid @enderror"
                                            type="text" value="{{ old('size_id') }}">
                                            <option value="Pilih Ukuran">Pilih Ukuran</option>
                                            @foreach ($sizes as $size)
                                                @if (old('size_id') == $size->id)
                                                    <option value="{{ $size->id }}" selected>
                                                        {{ $size->size . ' - ' . $size->side . ' - ' . $size->orientation }}
                                                    </option>
                                                @endif
                                                <option value="{{ $size->id }}">
                                                    {{ $size->size . ' - ' . $size->side . ' - ' . $size->orientation }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('size_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex justify-start mt-5">
                                    <button id="btnSave" name="btnSave"
                                        class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-primary"
                                        type="submit">
                                        <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:ml-2 2xl:ml-3"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                                        </svg>
                                        <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Save</span>
                                    </button>
                                    <a class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-danger"
                                        href="/dashboard/media/billboards">
                                        <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                                        </svg>
                                        <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Cancel</span>
                                    </a>
                                </div>
                                <!-- Create New Billboard end -->
                            </div>
                        </div>
                        <div class="mx-1 w-[172px] xl:w-[208px] xl:mx-4 2xl:w-[240px]">
                            <div class="flex mt-1">
                                <div class="mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Kepemilikan</label>
                                    <input type="text" id="inputPemilik" name="inputPemilik"
                                        value="{{ old('inputPemilik') }}" hidden>
                                    <select id="property_status" name="property_status"
                                        class="flex w-40 xl:w-52 2xl:w-60 text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('property_status') is-invalid @enderror"
                                        type="text" value="{{ old('property_status') }}">
                                    </select>
                                    @error('property_status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex mt-1">
                                <div class="mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Kondisi</label>
                                    <input type="text" id="build_status" name="build_status"
                                        value="{{ old('build_status') }}" hidden>
                                    <select id="buildSelect" name="buildSelect"
                                        class="flex w-40 xl:w-52 2xl:w-60 text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('buildSelect') is-invalid @enderror"
                                        type="text">
                                    </select>
                                    @error('buildSelect')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex mt-1">
                                <div class="mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Status</label>
                                    <input type="text" id="sale_status" name="sale_status"
                                        value="{{ old('sale_status') }}" hidden>
                                    <select id="saleSelect" name="saleSelect"
                                        class="flex w-40 xl:w-52 2xl:w-60 text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('saleSelect') is-invalid @enderror"
                                        type="text">
                                    </select>
                                    @error('saleSelect')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex mt-1">
                                <div id="divKlien" name="divKlien" class="mt-1">
                                    <label id="lblClient" name="lblClient"
                                        class="text-sm xl:text-md 2xl:text-lg text-teal-700">Nama
                                        Klien</label>
                                    <input
                                        class="flex w-40 xl:w-52 2xl:w-60 text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('client') is-invalid @enderror"
                                        type="text" id="client" name="client" value="{{ old('client') }}"
                                        placeholder="Nama Klien">
                                    @error('client')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex mt-1">
                                <div id="harga" name="harga" class="mt-1" hidden>
                                    <label id="lblClient" name="lblClient"
                                        class="text-sm xl:text-md 2xl:text-lg text-teal-700">Harga</label>
                                    <input
                                        class="flex w-40 xl:w-52 2xl:w-60 text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('price') is-invalid @enderror"
                                        type="number" id="price" name="price" value="{{ old('price') }}"
                                        placeholder="Harga">
                                    @error('price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex mt-1">
                                <div id="periode" name="periode" class="mt-1" hidden>
                                    <label id="lblPeriode" name="lblPeriode"
                                        class="text-sm xl:text-md 2xl:text-lg text-teal-700">Periode
                                        Kontrak</label>
                                    <div class="flex">
                                        <label class="p-1 w-[52px] text-sm xl:text-md 2xl:text-lg text-teal-700">-
                                            Awal</label>
                                        <input
                                            class="w-28 text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1
                                            outline-none @error('start_contract') is-invalid @enderror"
                                            type="date" id="start_contract" name="start_contract"
                                            value="{{ old('start_contract') }}">
                                    </div>
                                    <div class="flex">
                                        <label class="p-1 w-[52px] text-sm xl:text-md 2xl:text-lg text-teal-700">-
                                            Akhir</label>
                                        <input
                                            class="w-28 text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1
                                            outline-none @error('end_contract') is-invalid @enderror"
                                            type="date" id="end_contract" name="end_contract"
                                            value="{{ old('end_contract') }}">
                                    </div>
                                    @error('start_contract')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    @error('end_contract')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex mt-1">
                                <div class="mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Type Jalan</label>
                                    <input type="text" id="inputJalan" name="inputJalan"
                                        value="{{ old('inputJalan') }}" hidden>
                                    <select id="road_segment" name="road_segment"
                                        class="flex w-40 xl:w-52 2xl:w-60 text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('road_segment') is-invalid @enderror"
                                        type="text">
                                    </select>
                                    @error('road_segment')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex mt-1">
                                <div class="mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Jarak Pandang</label>
                                    <input type="text" id="inputJarak" name="inputJarak"
                                        value="{{ old('inputJarak') }}" hidden>
                                    <select id="max_distance" name="max_distance"
                                        class="flex w-40 xl:w-52 2xl:w-60 text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('max_distance') is-invalid @enderror"
                                        type="text">
                                    </select>
                                    @error('max_distance')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex mt-1">
                                <div class="mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Kecepatan</label>
                                    <input type="text" id="inputKecepatan" name="inputKecepatan"
                                        value="{{ old('inputKecepatan') }}" hidden>
                                    <select id="speed_average" name="speed_average"
                                        class="flex w-40 xl:w-52 2xl:w-60 text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('speed_average') is-invalid @enderror"
                                        type="text">
                                    </select>
                                    @error('speed_average')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex mt-1">
                                <div class="mt-1">
                                    <input class="@error('sector') is-invalid @enderror" type="text" id="sector"
                                        name="sector" value="{{ old('sector') }}" hidden>
                                    <label
                                        class="text-sm xl:text-md 2xl:text-lg text-teal-700 border-b w-40 xl:w-52 2xl:w-60 flex p-1">Kawasan</label>
                                    @error('sector')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="flex w-40 xl:w-52 2xl:w-60 mt-2">
                                        <input type="checkbox" id="airport" name="airport" value="Bandara"><label
                                            class="ml-1 text-[0.65rem] xl:text-sm text-teal-700 flex w-16 lg:w-20">Bandara</label>
                                        <input class="ml-1" type="checkbox" id="tol" name="tol"
                                            value="Jalan Tol"><label
                                            class="ml-1 text-[0.65rem] xl:text-sm text-teal-700 flex w-16 lg:w-20">Jalan
                                            Tol</label>
                                    </div>
                                    <div class="flex w-40 xl:w-52 2xl:w-60">
                                        <input type="checkbox" id="hotel" name="hotel" value="Hotel"><label
                                            class="ml-1 text-[0.65rem] xl:text-sm text-teal-700 flex w-16 lg:w-20">Hotel</label>
                                        <input class="ml-1" type="checkbox" id="restaurant" name="restaurant"
                                            value="Restaurant"><label
                                            class="ml-1 text-[0.65rem] xl:text-sm text-teal-700 flex w-16 lg:w-20">Restoran</label>
                                    </div>
                                    <div class="flex w-40 xl:w-52 2xl:w-60">
                                        <input type="checkbox" id="shops" name="shops" value="Pertokoan"><label
                                            class="ml-1 text-[0.65rem] xl:text-sm text-teal-700 flex w-16 lg:w-20">Pertokoan</label>
                                        <input class="ml-1" type="checkbox" id="office" name="office"
                                            value="Perkantoran"><label
                                            class="ml-1 text-[0.65rem] xl:text-sm text-teal-700 flex w-16 lg:w-20">Perkantoran</label>
                                    </div>
                                    <div class="flex w-40 xl:w-52 2xl:w-60">
                                        <input type="checkbox" id="tourist" name="tourist" value="Area Wisata"><label
                                            class="ml-1 text-[0.65rem] xl:text-sm text-teal-700 flex w-16 lg:w-20">Area
                                            Wisata</label>
                                        <input class="ml-1" type="checkbox" id="mall" name="mall"
                                            value="Mall"><label
                                            class="ml-1 text-[0.65rem] xl:text-sm text-teal-700 flex w-16 lg:w-20">Mall</label>
                                    </div>
                                    <div class="flex w-40 xl:w-52 2xl:w-60">
                                        <input type="checkbox" id="garden" name="garden" value="Taman Kota"><label
                                            class="ml-1 text-[0.65rem] xl:text-sm text-teal-700 flex w-16 lg:w-20">Taman
                                            Kota</label>
                                        <input class="ml-1" type="checkbox" id="market" name="market"
                                            value="Pasar"><label
                                            class="ml-1 text-[0.65rem] xl:text-sm text-teal-700 flex w-16 lg:w-20">Pasar</label>
                                    </div>
                                    <div class="flex w-40 xl:w-52 2xl:w-60 mb-10">
                                        <input type="checkbox" id="house" name="house" value="Perumahan"><label
                                            class="ml-1 text-[0.65rem] xl:text-sm text-teal-700 flex w-16 lg:w-20">Perumahan</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Create New Billboard end -->
                        </div>
                    </div>
                    <div>
                        <!-- Photo Billboard start -->
                        <div class="mt-4 md:mt-0 md:ml-2 xl:ml-4">
                            <div>
                                <span class="border-b flex justify-center text-base font-semibold w-full">Photo
                                    Lokasi</span>
                                <input
                                    class="mt-1 w-full h-8 border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 @error('photo') is-invalid @enderror"
                                    type="file" id="photo" name="photo" onchange="previewImage()">
                            </div>
                            @error('photo')
                                <div class="invalid-feedback ml-5 ">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div
                                class="flex m-photo-product md:w-[360px] md:h-[240px] xl:w-[550px] xl:h-[367px] 2xl:w-[640px] 2xl:h-[427px] border mt-1">
                                <img class="img-preview m-photo-product md:w-[360px] md:h-[240px] xl:w-[550px] xl:h-[367px] 2xl:w-[640px] 2xl:h-[427px]"
                                    src="/img/product-image.png" alt="">
                            </div>
                        </div>
                        <!-- Photo Billboard end -->
                        <!-- Maps Billboard start -->
                        <div class="md:ml-2 lg:ml-4">
                            <span class="flex justify-center border-b mt-2 text-base font-semibold">Peta
                                Lokasi</span>
                            <div class="m-map-product md:w-[360px] md:h-[240px] xl:w-[550px] xl:h-[367px] 2xl:w-[640px] 2xl:h-[427px] mt-1 mb-6"
                                id="map">
                            </div>
                        </div>
                        <!-- Maps Billboard end -->
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Form Create New Billboard end -->
    <!-- Script Billboard start -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg&callback=initMap"
        defer></script>

    <script src="/js/createproduct.js"></script>
    <!-- Script Billboard end -->
@endsection
