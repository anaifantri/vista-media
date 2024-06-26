@extends('dashboard.layouts.main');

@section('container')
    <!-- Edit Videotron start -->
    <div class="flex justify-center">
        <div class="mt-10">
            <!-- Title Edit Videotron start -->
            <div class="flex border-b">
                <h1 class="text-xl text-cyan-800 font-bold tracking-wider"> EDIT DATA VIDEOTRON</h1>
            </div>
            <!-- Title Edit Videotron end -->
            <!-- Form Edit Videotron start -->
            <div class="flex">
                <form class="md:flex" action="/dashboard/media/videotrons/{{ $videotron->id }}" method="post"
                    enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="flex justify-center">
                        <div class="flex mx-1">
                            <div class="">
                                <div class="flex mt-1">
                                    <div class="mt-1">
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Kode Lokasi</label>
                                        <input
                                            class="flex text-sm xl:text-md 2xl:text-lg font-semibold text-slate-500 w-32 border rounded-lg p-1 outline-teal-300 @error('code') is-invalid @enderror"
                                            type="text" id="code" name="code" value="{{ $videotron->code }}"
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
                                            type="text" value="{{ $videotron->area_id }}">
                                            @foreach ($areas as $area)
                                                @if ($videotron->area_id == $area->id)
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
                                        <input id="city_id" name="city_id" type="text" hidden
                                            value="{{ $videotron->city_id }}">
                                        <select id="city" name="city"
                                            class="flex text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 w-36 xl:w-48 2xl:w-56  border rounded-lg p-1 outline-teal-300 @error('city_id') is-invalid @enderror"
                                            type="text">
                                        </select>
                                        @error('city_id')
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
                                            name="address" id="address" placeholder="Lokasi Videotron">{{ $videotron->address }}</textarea>
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
                                            value="{{ $videotron->lat }}" required readonly
                                            title="Latitude select from map">
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
                                            value="{{ $videotron->lng }}" required readonly
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
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Jenis LED</label>
                                    </div>
                                    <div class="mt-1">
                                        <select id="led_id" name="led_id"
                                            class="w-36 xl:w-48 2xl:w-56  text-sm xl:text-md 2xl:text-lg
                                            font-semibold text-teal-900 border rounded-lg p-1 outline-none
                                            @error('led_id') is-invalid @enderror"
                                            type="text" value="{{ $videotron->led_id }}">
                                            @foreach ($leds as $led)
                                                @if ($videotron->led_id == $led->id)
                                                    <option value="{{ $led->id }}" selected>{{ $led->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $led->id }}">{{ $led->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('led_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <div class="flex mt-1">
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Slot</label>
                                    </div>
                                    <div class="mt-1">
                                        <input
                                            class="flex text-sm xl:text-md 2xl:text-lg font-semibold text-slate-500 w-32 border rounded-lg p-1 outline-teal-300 @error('slots') is-invalid @enderror"
                                            type="text" id="slots" name="slots" value="{{ $videotron->slots }}"
                                            placeholder="Slot" required>
                                        @error('slots')
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
                                            type="text" value="{{ $videotron->size_id }}">
                                            @foreach ($sizes as $size)
                                                @if ($videotron->size_id == $size->id)
                                                    <option value="{{ $size->id }}" selected>
                                                        {{ $size->size }}
                                                    </option>
                                                @endif
                                                <option value="{{ $size->id }}">
                                                    {{ $size->size }}
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
                                <div class="mt-1">
                                    @php
                                        $numberOrientation = 0;
                                        $orientations = ['Vertikal', 'Horizontal'];
                                    @endphp
                                    <div class="flex mt-1">
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Orientasi</label>
                                    </div>
                                    <div class="mt-1">
                                        <select id="orientation" name="orientation"
                                            class="w-36 xl:w-48 2xl:w-56  text-sm xl:text-md 2xl:text-lg
                                            font-semibold text-teal-900 border rounded-lg p-1 outline-none
                                            @error('orientation') is-invalid @enderror"
                                            type="text" value="{{ $videotron->orientation }}">
                                            @for ($numberOrientation = 0; $numberOrientation < count($orientations); $numberOrientation++)
                                                @if ($videotron->orientation == $orientations[$numberOrientation])
                                                    <option value="{{ $orientations[$numberOrientation] }}" selected>
                                                        {{ $orientations[$numberOrientation] }}
                                                    </option>
                                                @else
                                                    <option value="{{ $orientations[$numberOrientation] }}">
                                                        {{ $orientations[$numberOrientation] }}
                                                    </option>
                                                @endif
                                            @endfor
                                        </select>
                                        @error('orientation')
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
                                        <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Update</span>
                                    </button>
                                    <a class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-danger"
                                        href="/dashboard/media/videotrons">
                                        <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                                        </svg>
                                        <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Cancel</span>
                                    </a>
                                </div>
                                <!-- Edit Videotron end -->
                            </div>
                        </div>
                        <div class="mx-1 w-[172px] xl:w-[208px] xl:mx-4 2xl:w-[240px]">
                            <div class="flex mt-1">
                                @php
                                    $numberBuild = 0;
                                    $builds = ['Terbangun', 'Rencana'];
                                @endphp
                                <div class="mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Kondisi</label>
                                    <select id="condition" name="condition"
                                        class="flex w-40 xl:w-52 2xl:w-60 text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('condition') is-invalid @enderror"
                                        type="text" value="{{ $videotron->condition }}">
                                        @for ($numberBuild = 0; $numberBuild < count($builds); $numberBuild++)
                                            @if ($videotron->condition == $builds[$numberBuild])
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
                                    @error('condition')
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
                                        type="text" value="{{ $videotron->road_segment }}">
                                        @for ($numberRoad = 0; $numberRoad < count($roads); $numberRoad++)
                                            @if ($videotron->road_segment == $roads[$numberRoad])
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
                                    $distances = [
                                        '> 50 meter',
                                        '> 100 meter',
                                        '> 150 meter',
                                        '> 200 meter',
                                        '> 250 meter',
                                        '> 300 meter',
                                        '> 500 meter',
                                    ];
                                @endphp
                                <div class="mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Jarak Pandang</label>
                                    <select id="max_distance" name="max_distance"
                                        class="flex w-40 xl:w-52 2xl:w-60 text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('max_distance') is-invalid @enderror"
                                        type="text" value="{{ $videotron->max_distance }}">
                                        @for ($numberDistance = 0; $numberDistance < count($distances); $numberDistance++)
                                            @if ($videotron->max_distance == $distances[$numberDistance])
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
                                    $speeds = [
                                        '0 - 10 km/jam',
                                        '0 - 20 km/jam',
                                        '10 - 20 km/jam',
                                        '10 - 40 km/jam',
                                        '20 - 40 km/jam',
                                        '20 - 60 km/jam',
                                        '40 - 60 km/jam',
                                        '40 - 80 km/jam',
                                    ];
                                @endphp
                                <div class="mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Kecepatan Kendaraan</label>
                                    <select id="speed_average" name="speed_average"
                                        class="flex w-40 xl:w-52 2xl:w-60 text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('speed_average') is-invalid @enderror"
                                        type="text" value="{{ $videotron->speed_average }}">
                                        <option value="pilih">-- pilih --</option>
                                        @for ($numberSpeed = 0; $numberSpeed < count($speeds); $numberSpeed++)
                                            @if ($videotron->speed_average == $speeds[$numberSpeed])
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
                                        name="sector" value="{{ $videotron->sector }}" hidden>
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
                                    <div class="flex w-40 xl:w-52 2xl:w-60">
                                        <input type="checkbox" id="house" name="house" value="Perumahan"><label
                                            class="ml-1 text-[0.65rem] xl:text-sm text-teal-700 flex w-16 lg:w-20">Perumahan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="flex mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Harga</label>
                                </div>
                                <div class="mt-1">
                                    <input
                                        class="flex text-sm xl:text-md 2xl:text-lg font-semibold text-slate-500 xl:w-52 2xl:w-60 border rounded-lg p-1 outline-teal-300 @error('price') is-invalid @enderror"
                                        type="number" id="price" name="price" value="{{ $videotron->price }}">
                                    @error('price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-1">
                                <div class="flex mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Durasi Video
                                        (detik)</label>
                                </div>
                                <div class="mt-1">
                                    <input
                                        class="flex text-sm xl:text-md 2xl:text-lg font-semibold text-slate-500 w-24 border rounded-lg p-1 outline-teal-300 @error('duration') is-invalid @enderror"
                                        type="number" id="duration" name="duration"
                                        value="{{ $videotron->duration }}" min="0" max="60"
                                        placeholder="0-60">
                                    @error('duration')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div id="on" name="on" class="mt-1">
                                <div class="flex mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Waktu Nyala</label>
                                </div>
                                <div class="mt-1">
                                    <input
                                        class="flex text-sm xl:text-md 2xl:text-lg font-semibold text-slate-500 w-24 border rounded-lg p-1 outline-teal-300 @error('start_at') is-invalid @enderror"
                                        type="time" id="start_at" name="start_at"
                                        value="{{ $videotron->start_at }}">
                                    @error('start_at')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div id="off" name="off" class="mt-2">
                                <div class="flex mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Waktu Off</label>
                                </div>
                                <div class="mt-1">
                                    <input
                                        class="flex text-sm xl:text-md 2xl:text-lg font-semibold text-slate-500 w-24 border rounded-lg p-1 outline-teal-300 @error('end_at') is-invalid @enderror"
                                        type="time" id="end_at" name="end_at" value="{{ $videotron->end_at }}">
                                    @error('end_at')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Edit Videotron end -->
                        </div>
                    </div>
                    <div>
                        <!-- Photo Videotron start -->
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
                                @foreach ($videotron_photos as $photo)
                                    @if ($photo->videotron_id == $videotron->id && $photo->company_id == '1')
                                        <input type="hidden" id="oldPhoto" name="oldPhoto"
                                            value="{{ $photo->photo }}">
                                        <img class="img-preview m-photo-product sm:w-[495px] sm:h-[330px] lg:w-[550px] lg:h-[367px] 2xl:w-[640px] 2xl:h-[427px] rounded-xl"
                                            src="{{ asset('storage/' . $photo->photo) }}" alt="">
                                    @else
                                        <img class="img-preview m-photo-product md:w-[360px] md:h-[240px] xl:w-[550px] xl:h-[367px] 2xl:w-[640px] 2xl:h-[427px"
                                            src="/img/product-image.png" alt="">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <!-- Photo Videotron end -->
                        <!-- Maps Videotron start -->
                        <div class="md:ml-2 lg:ml-4">
                            <span class="flex justify-center border-b mt-2 text-base font-semibold">Peta
                                Lokasi</span>
                            <div class="m-map-product md:w-[360px] md:h-[240px] xl:w-[550px] xl:h-[367px] 2xl:w-[640px] 2xl:h-[427px] mt-1 mb-6"
                                id="map">
                            </div>
                        </div>
                        <!-- Maps Videotron end -->
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Form Edit Videotron end -->
    <!-- Script Videotron start -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg&callback=initMap"
        defer></script>

    <script src="/js/editvideotron.js"></script>
    <!-- Script Videotron end -->
@endsection
