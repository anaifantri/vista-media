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
                <form class="md:flex" action="/dashboard/media/products/{{ $product->id }}" method="post"
                    enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="flex justify-center">
                        <div class="flex">
                            <div class="">
                                <div class="flex mt-1">
                                    <div class="mt-1">
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Kode Lokasi</label>
                                        <input
                                            class="flex px-2 text-sm xl:text-md 2xl:text-lg font-semibold text-slate-500 w-32 border rounded-lg p-1 outline-teal-300 @error('code') is-invalid @enderror"
                                            type="text" id="code" name="code" value="{{ $product->code }}"
                                            autofocus placeholder="Kode" required>
                                        @error('code')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex mt-1">
                                    <div class="mt-1">
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Area</label>
                                        <select id="area_id" name="area_id"
                                            class="flex px-2 w-36 xl:w-48 2xl:w-56 text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('area_id') is-invalid @enderror"
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
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Kota</label>
                                        <input type="text" id="city_id" name="city_id" value="{{ $product->city_id }}"
                                            hidden>
                                        <input type="text" id="cityCode" name="cityCode"
                                            value="{{ $product->city->code }}" hidden>
                                        <input type="text" id="inputCity" name="inputCity"
                                            value="{{ $product->city->city }}" hidden>
                                        <select id="city" name="city"
                                            class="flex px-2 w-36 xl:w-48 2xl:w-56 text-sm xl:text-md 2xl:text-lg font-semibold border text-teal-900 rounded-lg p-1 outline-none @error('city') is-invalid @enderror"
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
                                            class="flex px-2 text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 w-36 xl:w-48 2xl:w-56 border rounded-lg p-1 outline-teal-300 @error('address') is-invalid @enderror"
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
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Latitude</label>
                                        <input
                                            class="flex px-2 text-sm xl:text-md 2xl:text-lg font-semibold text-slate-500 w-36 xl:w-48 2xl:w-56 border rounded-lg p-1 outline-teal-300 @error('lat') is-invalid @enderror"
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
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Longitude</label>
                                        <input
                                            class="flex px-2 text-sm xl:text-md 2xl:text-lg font-semibold text-slate-500 w-36 xl:w-48 2xl:w-56 border rounded-lg p-1 outline-teal-300 @error('lng') is-invalid @enderror"
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
                                    @php
                                        $numberCategory = 0;
                                        $categories = ['Billboard', 'Baliho', 'Midiboard'];
                                    @endphp
                                    <div class="flex mt-1">
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Katagori</label>
                                    </div>
                                    <div class="mt-1">
                                        <select id="category" name="category"
                                            class="w-36 xl:w-48 2xl:w-56  text-sm xl:text-md 2xl:text-lg
                                        font-semibold text-teal-900 border rounded-lg p-1 outline-none
                                        @error('category') is-invalid @enderror"
                                            type="text" value="{{ $product->category }}">
                                            @for ($numberCategory = 0; $numberCategory < count($categories); $numberCategory++)
                                                @if ($product->category == $categories[$numberCategory])
                                                    <option value="{{ $categories[$numberCategory] }}" selected>
                                                        {{ $categories[$numberCategory] }}
                                                    </option>
                                                @else
                                                    <option value="{{ $categories[$numberCategory] }}">
                                                        {{ $categories[$numberCategory] }}
                                                    </option>
                                                @endif
                                            @endfor
                                        </select>
                                        @error('category')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-1">
                                    @php
                                        $numberLighting = 0;
                                        $lightings = ['Frontlight', 'Backlight', 'Nonlight'];
                                    @endphp
                                    <div class="flex mt-1">
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Penerangan</label>
                                    </div>
                                    <div class="mt-1">
                                        <select id="lighting" name="lighting"
                                            class="w-36 xl:w-48 2xl:w-56  text-sm xl:text-md 2xl:text-lg
                                            font-semibold text-teal-900 border rounded-lg p-1 outline-none
                                            @error('lighting') is-invalid @enderror"
                                            type="text" value="{{ $product->lighting }}">
                                            @for ($numberLighting = 0; $numberLighting < count($lightings); $numberLighting++)
                                                @if ($product->lighting == $lightings[$numberLighting])
                                                    <option value="{{ $lightings[$numberLighting] }}" selected>
                                                        {{ $lightings[$numberLighting] }}
                                                    </option>
                                                @else
                                                    <option value="{{ $lightings[$numberLighting] }}">
                                                        {{ $lightings[$numberLighting] }}
                                                    </option>
                                                @endif
                                            @endfor
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
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Ukuran</label>
                                        <select id="size_id" name="size_id"
                                            class="flex px-2 w-36 xl:w-48 2xl:w-56 text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('size_id') is-invalid @enderror"
                                            type="text" value="{{ $product->size_id }}">
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
                                        class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-primary"
                                        type="submit">
                                        <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:ml-2 2xl:ml-3"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                                        </svg>
                                        <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Update</span>
                                    </button>
                                    <a class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-danger"
                                        href="/dashboard/media/billboards">
                                        <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:ml-2 2xl:ml-3"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                                        </svg>
                                        <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Cancel</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="mx-1 w-[172px] xl:w-[208px] xl:mx-4 2xl:w-[240px]">
                            <div class="flex mt-1">
                                @php
                                    $numberProperty = 0;
                                    $properties = ['Vista Media', 'Mitra'];
                                @endphp
                                <div class="mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Kepemilikan</label>
                                    <select id="property_status" name="property_status"
                                        class="flex w-40 xl:w-52 2xl:w-60 text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('property_status') is-invalid @enderror"
                                        type="text" value="{{ $product->property_status }}">
                                        @for ($numberProperty = 0; $numberProperty < count($properties); $numberProperty++)
                                            @if ($product->property_status == $properties[$numberProperty])
                                                <option value="{{ $properties[$numberProperty] }}" selected>
                                                    {{ $properties[$numberProperty] }}
                                                </option>
                                            @else
                                                <option value="{{ $properties[$numberProperty] }}">
                                                    {{ $properties[$numberProperty] }}
                                                </option>
                                            @endif
                                        @endfor
                                    </select>
                                    @error('property_status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex mt-1">
                                @php
                                    $numberBuild = 0;
                                    $builds = ['Terbangun', 'Pembangunan', 'Rencana'];
                                @endphp
                                <div class="mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Kondisi</label>
                                    <select id="build_status" name="build_status"
                                        class="flex w-40 xl:w-52 2xl:w-60 text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('build_status') is-invalid @enderror"
                                        type="text" value="{{ $product->build_status }}">
                                        @for ($numberBuild = 0; $numberBuild < count($builds); $numberBuild++)
                                            @if ($product->build_status == $builds[$numberBuild])
                                                <option value="{{ $builds[$numberBuild] }}" selected>
                                                    {{ $builds[$numberBuild] }}
                                                </option>
                                            @else
                                                <option value="{{ $builds[$numberBuild] }}">
                                                    {{ $builds[$numberBuild] }}
                                                </option>
                                            @endif
                                        @endfor
                                    </select>
                                    @error('build_status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex mt-1">
                                @php
                                    $numberSale = 0;
                                    $sales = ['Available', 'Sold'];
                                @endphp
                                <div class="mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Status</label>
                                    <select id="sale_status" name="sale_status"
                                        class="flex w-40 xl:w-52 2xl:w-60 text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('sale_status') is-invalid @enderror"
                                        type="text" value="{{ $product->sale_status }}">
                                        @for ($numberSale = 0; $numberSale < count($sales); $numberSale++)
                                            @if ($product->sale_status == $sales[$numberSale])
                                                <option value="{{ $sales[$numberSale] }}" selected>
                                                    {{ $sales[$numberSale] }}
                                                </option>
                                            @else
                                                <option value="{{ $sales[$numberSale] }}">
                                                    {{ $sales[$numberSale] }}
                                                </option>
                                            @endif
                                        @endfor
                                    </select>
                                    @error('sale_status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex mt-1">
                                <div id="divKlien" name="divKlien" class="mt-1" hidden>
                                    <label id="lblClient" name="lblClient"
                                        class="xl:text-md 2xl:text-lg text-teal-700">Nama
                                        Klien</label>
                                    <input
                                        class="flex px-2 w-40 xl:w-52 2xl:w-60 xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('client') is-invalid @enderror"
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
                                    <label id="lblClient" name="lblClient"
                                        class="xl:text-md 2xl:text-lg text-teal-700">Harga</label>
                                    <input
                                        class="flex px-2 w-40 xl:w-52 2xl:w-60 xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('price') is-invalid @enderror"
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
                                    <label id="lblPeriode" name="lblPeriode"
                                        class="xl:text-md 2xl:text-lg text-teal-700">Periode
                                        Kontrak</label>
                                    <div class="flex">
                                        <label class="p-1 w-14 xl:text-md 2xl:text-lg text-teal-700">- Awal</label>
                                        <input
                                            class="px-2 w-32 xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('start_contract') is-invalid @enderror"
                                            type="date" id="start_contract" name="start_contract"
                                            value="{{ $product->start_contract }}">
                                    </div>
                                    <div class="flex">
                                        <label class="p-1 w-14 xl:text-md 2xl:text-lg text-teal-700">- Akhir</label>
                                        <input
                                            class="px-2 w-32 xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('end_contract') is-invalid @enderror"
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
                                @php
                                    $numberRoad = 0;
                                    $roads = ['2 Lajur', '3 Lajur', '4 Lajur', '6 Lajur', '8 Lajur'];
                                @endphp
                                <div class="mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Type Jalan</label>
                                    <select id="road_segment" name="road_segment"
                                        class="flex w-40 xl:w-52 2xl:w-60 text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('road_segment') is-invalid @enderror"
                                        type="text" value="{{ $product->road_segment }}">
                                        @for ($numberRoad = 0; $numberRoad < count($roads); $numberRoad++)
                                            @if ($product->road_segment == $roads[$numberRoad])
                                                <option value="{{ $roads[$numberRoad] }}" selected>
                                                    {{ $roads[$numberRoad] }}
                                                </option>
                                            @else
                                                <option value="{{ $roads[$numberRoad] }}">
                                                    {{ $roads[$numberRoad] }}
                                                </option>
                                            @endif
                                        @endfor
                                    </select>
                                    @error('road_segment')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex mt-1">
                                @php
                                    $numberDistance = 0;
                                    $distances = ['> 50 meter', '> 100 meter', '> 150 meter', '> 200 meter', '> 250 meter', '> 300 meter', '> 500 meter'];
                                @endphp
                                <div class="mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Jarak Pandang</label>
                                    <select id="max_distance" name="max_distance"
                                        class="flex w-40 xl:w-52 2xl:w-60 text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('max_distance') is-invalid @enderror"
                                        type="text" value="{{ $product->max_distance }}">
                                        @for ($numberDistance = 0; $numberDistance < count($distances); $numberDistance++)
                                            @if ($product->max_distance == $distances[$numberDistance])
                                                <option value="{{ $distances[$numberDistance] }}" selected>
                                                    {{ $distances[$numberDistance] }}
                                                </option>
                                            @else
                                                <option value="{{ $distances[$numberDistance] }}">
                                                    {{ $distances[$numberDistance] }}
                                                </option>
                                            @endif
                                        @endfor
                                    </select>
                                    @error('max_distance')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex mt-1">
                                @php
                                    $numberSpeed = 0;
                                    $speeds = ['0 - 10 km/jam', '0 - 20 km/jam', '10 - 20 km/jam', '10 - 40 km/jam', '20 - 40 km/jam', '20 - 60 km/jam', '40 - 60 km/jam', '40 - 80 km/jam'];
                                @endphp
                                <div class="mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Kecepatan Kendaraan</label>
                                    <select id="speed_average" name="speed_average"
                                        class="flex w-40 xl:w-52 2xl:w-60 text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('speed_average') is-invalid @enderror"
                                        type="text" value="{{ $product->speed_average }}">
                                        @for ($numberSpeed = 0; $numberSpeed < count($speeds); $numberSpeed++)
                                            @if ($product->speed_average == $speeds[$numberSpeed])
                                                <option value="{{ $speeds[$numberSpeed] }}" selected>
                                                    {{ $speeds[$numberSpeed] }}
                                                </option>
                                            @else
                                                <option value="{{ $speeds[$numberSpeed] }}">
                                                    {{ $speeds[$numberSpeed] }}
                                                </option>
                                            @endif
                                        @endfor
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
                                    <label
                                        class="xl:text-md 2xl:text-lg text-teal-700 border-b w-40 xl:w-52 2xl:w-60 flex p-1">Kawasan</label>
                                    @error('sector')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="flex w-40 xl:w-52 2xl:w-60 mt-2">
                                        <input type="checkbox" id="airport" name="airport" value="Bandara"><label
                                            class="ml-1 text-[0.65rem] xl:text-sm text-teal-700 flex w-24">Bandara</label>
                                        <input class="ml-2" type="checkbox" id="tol" name="tol"
                                            value="Jalan Tol"><label
                                            class="ml-1 text-[0.65rem] xl:text-sm text-teal-700 flex w-24">Jalan
                                            Tol</label>
                                    </div>
                                    <div class="flex w-40 xl:w-52 2xl:w-60">
                                        <input type="checkbox" id="hotel" name="hotel" value="Hotel"><label
                                            class="ml-1 text-[0.65rem] xl:text-sm text-teal-700 flex w-24">Hotel</label>
                                        <input class="ml-2" type="checkbox" id="restaurant" name="restaurant"
                                            value="Restaurant"><label
                                            class="ml-1 text-[0.65rem] xl:text-sm text-teal-700 flex w-24">Restoran</label>
                                    </div>
                                    <div class="flex w-40 xl:w-52 2xl:w-60">
                                        <input type="checkbox" id="shops" name="shops" value="Pertokoan"><label
                                            class="ml-1 text-[0.65rem] xl:text-sm text-teal-700 flex w-24">Pertokoan</label>
                                        <input class="ml-2" type="checkbox" id="office" name="office"
                                            value="Perkantoran"><label
                                            class="ml-1 text-[0.65rem] xl:text-sm text-teal-700 flex w-24">Perkantoran</label>
                                    </div>
                                    <div class="flex w-40 xl:w-52 2xl:w-60">
                                        <input type="checkbox" id="tourist" name="tourist" value="Area Wisata"><label
                                            class="ml-1 text-[0.65rem] xl:text-sm text-teal-700 flex w-24">Area
                                            Wisata</label>
                                        <input class="ml-2" type="checkbox" id="mall" name="mall"
                                            value="Mall"><label
                                            class="ml-1 text-[0.65rem] xl:text-sm text-teal-700 flex w-24">Mall</label>
                                    </div>
                                    <div class="flex w-40 xl:w-52 2xl:w-60">
                                        <input type="checkbox" id="garden" name="garden" value="Taman Kota"><label
                                            class="ml-1 text-[0.65rem] xl:text-sm text-teal-700 flex w-24">Taman
                                            Kota</label>
                                        <input class="ml-2" type="checkbox" id="market" name="market"
                                            value="Pasar"><label
                                            class="ml-1 text-[0.65rem] xl:text-sm text-teal-700 flex w-24">Pasar</label>
                                    </div>
                                    <div class="flex w-40 xl:w-52 2xl:w-60 mb-10">
                                        <input type="checkbox" id="house" name="house" value="Perumahan"><label
                                            class="ml-1 text-[0.65rem] xl:text-sm text-teal-700 flex w-24">Perumahan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Billboard end -->
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
                                <div class="invalid-feedback ml-36 ">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div
                                class="flex m-photo-product md:w-[360px] md:h-[240px] xl:w-[550px] xl:h-[367px] 2xl:w-[640px] 2xl:h-[427px] border mt-1">
                                <input type="hidden" id="oldPhoto" name="oldPhoto" value="{{ $product->photo }}">
                                @if ($product->photo)
                                    <img class="img-preview m-photo-product md:w-[360px] md:h-[240px] xl:w-[550px] xl:h-[367px] 2xl:w-[640px] 2xl:h-[427px"
                                        src="{{ asset('storage/' . $product->photo) }}">
                                @else
                                    <img class="img-preview m-photo-product md:w-[360px] md:h-[240px] xl:w-[550px] xl:h-[367px] 2xl:w-[640px] 2xl:h-[427px"
                                        src="/img/product-image.png" alt="">
                                @endif
                            </div>
                            <!-- Photo Billboard end -->
                            <!-- Maps Billboard start -->
                            <div>
                                <span class="flex justify-center border-b mt-2 text-base font-semibold">Peta Lokasi</span>

                                <div class="m-map-product md:w-[360px] md:h-[240px] xl:w-[550px] xl:h-[367px] 2xl:w-[640px] 2xl:h-[427px] mt-1 mb-6"
                                    id="map">
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
