@extends('dashboard.layouts.main');

@section('container')
    <!-- Edit Billboard start -->
    <div class="flex justify-center">
        <div class="mt-10">
            <!-- Title Edit Billboard start -->
            <div class="flex border-b">
                <h1 class="text-xl text-cyan-800 font-bold tracking-wider"> EDIT DATA BILLBOARD</h1>
            </div>
            <!-- Title Edit Billboard end -->
            <!-- Form Edit Billboard start -->
            <div class="flex">
                <form class="lg:flex" action="/dashboard/media/products/{{ $product->id }}" method="post"
                    enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="flex justify-center">
                        <div class="flex">
                            <div class="">
                                <div class="flex mt-1">
                                    <div class="mt-1">
                                        <label class="text-sm text-teal-700">Kode Lokasi</label>
                                        <input
                                            class="flex h-7 px-2 text-sm font-semibold text-slate-500 w-32 border rounded-lg p-1 outline-teal-300 @error('code') is-invalid @enderror"
                                            type="text" id="code" name="code" value="{{ $product->code }}"
                                            autofocus required>
                                        @error('code')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex mt-1">
                                    <div class="mt-1">
                                        <label class="text-sm text-teal-700">Area</label>
                                        <select id="area_id" name="area_id"
                                            class="flex px-2 w-48 h-7 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('area_id') is-invalid @enderror"
                                            type="text" value="{{ $product->area_id }}">
                                            @foreach ($areas as $area)
                                                @if ($product->area_id == $area->id)
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
                                        <label class="text-sm text-teal-700">Kota</label>
                                        <input type="text" id="city_id" name="city_id" value="{{ $product->city_id }}"
                                            hidden>
                                        <input type="text" id="cityCode" name="cityCode"
                                            value="{{ $product->city->code }}" hidden>
                                        <input type="text" id="inputCity" name="inputCity"
                                            value="{{ $product->city->city }}" hidden>
                                        <select id="city" name="city"
                                            class="flex px-2 w-48 h-7 text-sm font-semibold border text-teal-900 rounded-lg p-1 outline-none @error('city') is-invalid @enderror"
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
                                        <label class="text-sm text-teal-700">Lokasi</label>
                                        <textarea
                                            class="flex px-2 text-sm font-semibold text-teal-900 w-48 border rounded-lg p-1 outline-teal-300 @error('address') is-invalid @enderror"
                                            name="address" id="address" placeholder="Lokasi Billboard">{{ $product->address }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex mt-1">
                                    <div class="mt-1">
                                        <label class="text-sm text-teal-700">Latitude</label>
                                        <input
                                            class="flex h-7 px-2 text-sm font-semibold text-slate-500 w-48 border rounded-lg p-1 outline-teal-300 @error('lat') is-invalid @enderror"
                                            type="text" id="lat" name="lat" placeholder="Latitude"
                                            value="{{ $product->lat }}" required readonly title="Latitude select from map">
                                        @error('lat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex mt-1">
                                    <div class="mt-1">
                                        <label class="text-sm text-teal-700">Longitude</label>
                                        <input
                                            class="flex h-7 px-2 text-sm font-semibold text-slate-500 w-48 border rounded-lg p-1 outline-teal-300 @error('lng') is-invalid @enderror"
                                            type="text" id="lng" name="lng" placeholder="Longitude"
                                            value="{{ $product->lng }}" required readonly
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
                                        <label class="text-sm text-teal-700 w-32">Penerangan</label>
                                    </div>
                                    <div class="flex mt-1">
                                        <input type="text" id="inputLighting" name="inputLighting"
                                            value="{{ $product->lighting }}" hidden>
                                        <select id="lighting" name="lighting"
                                            class="px-2 w-48 h-7 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('lighting') is-invalid @enderror"
                                            type="text" value="{{ $product->lighting }}">
                                        </select>
                                        @error('lighting')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex mt-1">
                                    <div class="mt-1">
                                        <label class="text-sm text-teal-700">Ukuran</label>
                                        <select id="size_id" name="size_id"
                                            class="flex px-2 w-48 h-7 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('size_id') is-invalid @enderror"
                                            type="text" value="{{ $product->size_id }}">
                                            <option value="Pilih Ukuran">Pilih Ukuran</option>
                                            @foreach ($sizes as $size)
                                                @if ($product->size_id == $size->id)
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
                                <div class="flex mt-5">
                                    <button id="btnUpdate" name="btnUpdate"
                                        class="flex justify-center items-center mx-2 btn-primary" type="submit">
                                        <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24">
                                            <path
                                                d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                                        </svg>
                                        <span class="mx-1">Update</span>
                                    </button>
                                    <a class="flex justify-center items-center mx-2 btn-danger"
                                        href="/dashboard/media/billboards">
                                        <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                                        </svg>
                                        <span class="mx-1">Cancel</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="flex mt-1">
                                <div class="mt-1">
                                    <label class="text-sm text-teal-700">Kepemilikan</label>
                                    <input type="text" id="inputPemilik" name="inputPemilik"
                                        value="{{ $product->property_status }}" hidden>
                                    <select id="property_status" name="property_status"
                                        class="flex px-2 w-48 h-7 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('property_status') is-invalid @enderror"
                                        type="text" value="{{ $product->property_status }}">
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
                                    <label class="text-sm text-teal-700">Kondisi</label>
                                    <input type="text" id="build_status" name="build_status"
                                        value="{{ $product->build_status }}" hidden>
                                    <select id="buildSelect" name="buildSelect"
                                        class="flex px-2 w-48 h-7 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('buildSelect') is-invalid @enderror"
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
                                    <label class="text-sm text-teal-700">Status</label>
                                    <input type="text" id="sale_status" name="sale_status"
                                        value="{{ $product->sale_status }}" hidden>
                                    <select id="saleSelect" name="saleSelect"
                                        class="flex px-2 w-48 h-7 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('saleSelect') is-invalid @enderror"
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
                                <div id="divKlien" name="divKlien" class="mt-1" hidden>
                                    <label id="lblClient" name="lblClient" class="text-sm text-teal-700">Nama
                                        Klien</label>
                                    <input
                                        class="flex px-2 w-48 h-7 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('client') is-invalid @enderror"
                                        type="text" id="client" name="client" value="{{ $product->client }}"
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
                                    <label id="lblClient" name="lblClient" class="text-sm text-teal-700">Harga</label>
                                    <input
                                        class="flex px-2 w-48 h-7 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('price') is-invalid @enderror"
                                        type="number" id="price" name="price" value="{{ $product->price }}"
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
                                    <label id="lblPeriode" name="lblPeriode" class="text-sm text-teal-700">Periode
                                        Kontrak</label>
                                    <div class="flex">
                                        <label class="p-1 w-14 text-sm text-teal-700">- Awal</label>
                                        <input
                                            class="px-2 w-32 h-7 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('start_contract') is-invalid @enderror"
                                            type="date" id="start_contract" name="start_contract"
                                            value="{{ $product->start_contract }}">
                                    </div>
                                    <div class="flex">
                                        <label class="p-1 w-14 text-sm text-teal-700">- Akhir</label>
                                        <input
                                            class="px-2 w-32 h-7 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('end_contract') is-invalid @enderror"
                                            type="date" id="end_contract" name="end_contract"
                                            value="{{ $product->end_contract }}">
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
                                    <label class="text-sm text-teal-700">Type Jalan</label>
                                    <input type="text" id="inputJalan" name="inputJalan"
                                        value="{{ $product->road_segment }}" hidden>
                                    <select id="road_segment" name="road_segment"
                                        class="flex px-2 w-48 h-7 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('road_segment') is-invalid @enderror"
                                        type="text" value="{{ $product->road_segment }}">
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
                                    <label class="text-sm text-teal-700">Jarak Pandang Maksimal</label>
                                    <input type="text" id="inputJarak" name="inputJarak"
                                        value="{{ $product->max_distance }}" hidden>
                                    <select id="max_distance" name="max_distance"
                                        class="flex px-2 w-48 h-7 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('max_distance') is-invalid @enderror"
                                        type="text" value="{{ $product->max_distance }}">
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
                                    <label class="text-sm text-teal-700">Kecepatan Rata-Rata</label>
                                    <input type="text" id="inputKecepatan" name="inputKecepatan"
                                        value="{{ $product->speed_average }}" hidden>
                                    <select id="speed_average" name="speed_average"
                                        class="flex px-2 w-48 h-7 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('speed_average') is-invalid @enderror"
                                        type="text" value="{{ $product->speed_average }}">
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
                                        name="sector" value="{{ $product->sector }}" hidden>
                                    <label class="text-sm text-teal-700 border-b w-48 flex p-1">Kawasan</label>
                                    @error('sector')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="flex w-56 mt-2">
                                        <input type="checkbox" id="airport" name="airport" value="Bandara"><label
                                            class="ml-2 text-sm text-teal-700 flex w-24">Bandara</label>
                                        <input class="ml-2" type="checkbox" id="tol" name="tol"
                                            value="Jalan Tol"><label class="ml-2 text-sm text-teal-700 flex w-24">Jalan
                                            Tol</label>
                                    </div>
                                    <div class="flex w-56">
                                        <input type="checkbox" id="hotel" name="hotel" value="Hotel"><label
                                            class="ml-2 text-sm text-teal-700 flex w-24">Hotel</label>
                                        <input class="ml-2" type="checkbox" id="restaurant" name="restaurant"
                                            value="Restaurant"><label
                                            class="ml-2 text-sm text-teal-700 flex w-24">Restoran</label>
                                    </div>
                                    <div class="flex w-56">
                                        <input type="checkbox" id="shops" name="shops" value="Pertokoan"><label
                                            class="ml-2 text-sm text-teal-700 flex w-24">Pertokoan</label>
                                        <input class="ml-2" type="checkbox" id="office" name="office"
                                            value="Perkantoran"><label
                                            class="ml-2 text-sm text-teal-700 flex w-24">Perkantoran</label>
                                    </div>
                                    <div class="flex w-56">
                                        <input type="checkbox" id="tourist" name="tourist" value="Area Wisata"><label
                                            class="ml-2 text-sm text-teal-700 flex w-24">Area
                                            Wisata</label>
                                        <input class="ml-2" type="checkbox" id="mall" name="mall"
                                            value="Mall"><label
                                            class="ml-2 text-sm text-teal-700 flex w-24">Mall</label>
                                    </div>
                                    <div class="flex w-56">
                                        <input type="checkbox" id="garden" name="garden" value="Taman Kota"><label
                                            class="ml-2 text-sm text-teal-700 flex w-24">Taman
                                            Kota</label>
                                        <input class="ml-2" type="checkbox" id="market" name="market"
                                            value="Pasar"><label
                                            class="ml-2 text-sm text-teal-700 flex w-24">Pasar</label>
                                    </div>
                                    <div class="flex w-56 mb-10">
                                        <input type="checkbox" id="house" name="house" value="Perumahan"><label
                                            class="ml-2 text-sm text-teal-700 flex w-24">Perumahan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Billboard end -->
                    <div>
                        <!-- Photo Billboard start -->
                        <div>
                            <div>
                                <span class="border-b flex justify-center text-base font-semibold w-full">Photo
                                    Lokasi</span>
                                <input
                                    class="mt-1 w-full h-8 border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 @error('photo') is-invalid @enderror"
                                    type="file" id="photo" name="photo" onchange="previewImage()">
                            </div>
                            @error('photo')
                                <div class="invalid-feedback ml-36 ">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="flex m-photo-product lg:photo-product border mt-1">
                                <input type="hidden" id="oldPhoto" name="oldPhoto" value="{{ $product->photo }}">
                                @if ($product->photo)
                                    <img class="img-preview m-photo-product lg:photo-product"
                                        class="img-preview photo-product"
                                        src="{{ asset('storage/' . $product->photo) }}">
                                @else
                                    <img class="img-preview m-photo-product lg:photo-product" src="/img/product-image.png"
                                        alt="">
                                @endif
                            </div>
                            <!-- Photo Billboard end -->
                            <!-- Maps Billboard start -->
                            <div>
                                <span class="flex justify-center border-b mt-2 text-base font-semibold">Peta Lokasi</span>

                                <div class="m-map-product lg: map-product mt-1 mb-6" id="map">
                                </div>
                            </div>
                            <!-- Maps Billboard end -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Form Edit Billboard end -->
    <!-- Script Billboard start -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg&callback=initMap"
        defer></script>

    <script src="/js/editproduct.js"></script>
    <!-- Script Billboard end -->
@endsection
