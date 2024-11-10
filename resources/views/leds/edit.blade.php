@extends('dashboard.layouts.main');

@section('container')
    <form method="post" action="/media/leds/{{ $led->id }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
                <!-- Show Title start -->
                <div class="flex w-full justify-center">
                    <div class="flex items-center w-[1000px] border-b">
                        <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[650px]">MERUBAH DATA LED </h1>
                        <div class="flex w-full justify-end items-center p-1">
                            <button class="flex items-center justify-center btn-primary mx-1" type="submit" id="btnSubmit"
                                name="btnSubmit">
                                <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                                </svg>
                                <span class="mx-2"> Save </span>
                            </button>
                            <a href="/media/leds" class="flex items-center justify-center btn-danger mx-1">
                                <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                        fill-rule="nonzero" />
                                </svg>
                                <span class="mx-1"> Cancel </span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Show Title end -->
                <div class="flex w-full justify-center items-center">
                    <div class="flex justify-center w-[300px] h-[500px] border rounded-lg m-2 p-2 bg-stone-300">
                        <div>
                            <div class="mt-2">
                                <label class="w-36 ml-3 label-base">Nama Vendor</label>
                                <select class="flex input-area w-56 @error('vendor_id') is-invalid @enderror"
                                    name="vendor_id" id="vendor_id" value="{{ $led->vendor->id }}" required>
                                    @foreach ($vendors as $vendor)
                                        @if ($led->vendor->id == $vendor->id)
                                            <option value="{{ $vendor->id }}" selected>
                                                {{ $vendor->name }}
                                            </option>
                                        @else
                                            <option value="{{ $vendor->id }}">
                                                {{ $vendor->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('vendor_id')
                                    <div class="invalid-feedback ml-3 w-56">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <label class="w-36 ml-3 label-base">Nama Produk</label>
                                <input class="flex input-area w-56 @error('name') is-invalid @enderror" type="text"
                                    id="name" name="name" value="{{ $led->name }}"
                                    placeholder="Input Nama Produk" autofocus required>
                                @error('name')
                                    <div class="invalid-feedback ml-3 w-56">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                @php
                                    $types = ['SMD', 'DIP'];
                                @endphp
                                <label class="w-36 ml-3 label-base">Tipe LED</label>
                                <select id="type" name="type"
                                    class="flex input-area w-56 @error('type') is-invalid @enderror" type="text"
                                    value="{{ $led->type }}">
                                    @foreach ($types as $type)
                                        @if ($led->type == $type)
                                            <option value="{{ $type }}" selected> {{ $type }} </option>
                                        @else
                                            <option value="{{ $type }}"> {{ $type }} </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('type')
                                    <div class="invalid-feedback ml-3 w-56">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                @php
                                    $pixel_config = ['2R1G1B', '1R1G1B'];
                                @endphp
                                <label class="w-36 ml-3 label-base">Konfigurasi Pixel</label>
                                <select id="pixel_config" name="pixel_config"
                                    class="flex input-area w-56 @error('pixel_config') is-invalid @enderror" type="text"
                                    value="{{ $led->pixel_config }}">
                                    @foreach ($pixel_config as $pixel)
                                        @if ($led->pixel_config == $pixel)
                                            <option value="{{ $pixel }}" selected> {{ $pixel }} </option>
                                        @else
                                            <option value="{{ $pixel }}"> {{ $pixel }} </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('pixel_config')
                                    <div class="invalid-feedback ml-3 w-56">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                @php
                                    $pixels = ['1.8', '2.4', '4', '5', '8', '10', '12', '16'];
                                @endphp
                                <label class="w-36 ml-3 label-base">Ukuran Pixel</label>
                                <select id="pixel_pitch" name="pixel_pitch"
                                    class="flex input-area w-56 @error('pixel_pitch') is-invalid @enderror" type="text"
                                    value="{{ $led->pixel_pitch }}" onchange="setPixelDensity(this)">
                                    @foreach ($pixels as $pitch)
                                        @if ($led->pixel_pitch == $pitch)
                                            <option value="{{ $pitch }}" selected>
                                                {{ $pitch }}
                                            </option>
                                        @else
                                            <option value="{{ $pitch }}">
                                                {{ $pitch }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('pixel_pitch')
                                    <div class="invalid-feedback ml-3 w-56">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <label class="w-36 ml-3 label-base">Kerapatan Pixel ( /m2 )</label>
                                <input
                                    class="flex input-area in-out-spin-none w-56 @error('pixel_density') is-invalid @enderror"
                                    type="number" min="0" id="pixel_density" placeholder="Terisi otomatis"
                                    name="pixel_density" title="Terisi otomatis" value="{{ $led->pixel_density }}" readonly
                                    required>
                                @error('pixel_density')
                                    <div class="invalid-feedback ml-3 w-56">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center w-[300px] h-[500px] border rounded-lg m-2 p-2 bg-stone-300">
                        <div>
                            <div class="mt-2">
                                <label class="w-36 ml-3 label-base">Daya Maksimal (watt)</label>
                                <input
                                    class="flex input-area in-out-spin-none w-56 @error('max_power') is-invalid @enderror"
                                    type="number" min="0" id="max_power" name="max_power"
                                    placeholder="Input Daya Maksimal" value="{{ $led->max_power }}" autofocus required>
                                @error('max_power')
                                    <div class="invalid-feedback ml-3 w-56">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <label class="w-36 ml-3 label-base">Daya Rata-rata (watt)</label>
                                <input
                                    class="flex input-area in-out-spin-none w-56 @error('average_power') is-invalid @enderror"
                                    type="number" min="0" id="average_power" name="average_power"
                                    placeholder="Input Daya Rata-Rata" value="{{ $led->average_power }}" required>
                                @error('average_power')
                                    <div class="invalid-feedback ml-3 w-56">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                @php
                                    $angles = ['60°', '90°', '110°', '120°', '140°', '160°', '180°'];
                                @endphp
                                <label class="w-36 ml-3 label-base">Sudut Pandang (V)</label>
                                <select id="vertical_angle" name="vertical_angle"
                                    class="flex input-area w-56 @error('vertical_angle') is-invalid @enderror"
                                    type="text" value="{{ $led->vertical_angle }}">
                                    @foreach ($angles as $angle)
                                        @if ($led->vertical_angle == $angle)
                                            <option value="{{ $angle }}" selected>
                                                {{ $angle }}
                                            </option>
                                        @else
                                            <option value="{{ $angle }}">
                                                {{ $angle }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('vertical_angle')
                                    <div class="invalid-feedback ml-3 w-56">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <label class="w-36 ml-3 label-base">Sudut Pandang (H)</label>
                                <select id="horizontal_angle" name="horizontal_angle"
                                    class="flex input-area w-56 @error('horizontal_angle') is-invalid @enderror"
                                    type="text" value="{{ $led->horizontal_angle }}">
                                    @foreach ($angles as $angle)
                                        @if ($led->horizontal_angle == $angle)
                                            <option value="{{ $angle }}" selected>
                                                {{ $angle }}
                                            </option>
                                        @else
                                            <option value="{{ $angle }}">
                                                {{ $angle }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('horizontal_angle')
                                    <div class="invalid-feedback ml-3 w-56">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <label class="w-36 ml-3 label-base">Brightness ( ccd/m )</label>
                                <input
                                    class="flex input-area w-56 in-out-spin-none @error('brightness') is-invalid @enderror"
                                    type="number" name="brightness" min="0" value="{{ $led->brightness }}"
                                    placeholder="0" required>
                                @error('brightness')
                                    <div class="invalid-feedback ml-3 w-56">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                @php
                                    $refreshRate = ['1920', '3840'];
                                @endphp
                                <label class="w-36 ml-3 label-base">Refresh Rate ( Hz )</label>
                                <select id="refresh_rate" name="refresh_rate"
                                    class="flex input-area w-56 @error('refresh_rate') is-invalid @enderror"
                                    type="text" value="{{ $led->refresh_rate }}">
                                    @foreach ($refreshRate as $refresh)
                                        @if ($led->refresh_rate == $refresh)
                                            <option value="{{ $refresh }}" selected>
                                                {{ $refresh }}
                                            </option>
                                        @else
                                            <option value="{{ $refresh }}">
                                                {{ $refresh }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('refresh_rate')
                                    <div class="invalid-feedback ml-3 w-56">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center w-[300px] h-[500px] border rounded-lg m-2 p-2 bg-stone-300">
                        <div>
                            <div class="mt-2">
                                @php
                                    $distances = ['> 2m', '> 3m', '> 4m', '> 5m', '> 6m', '> 8m', '> 10m', '> 12m'];
                                @endphp
                                <label class="w-36 ml-3 label-base">Jarak Pandang Terbaik</label>
                                <select id="optimal_distance" name="optimal_distance"
                                    class="flex input-area w-56 @error('optimal_distance') is-invalid @enderror"
                                    type="text" value="{{ $led->optimal_distance }}">
                                    @foreach ($distances as $distance)
                                        @if ($led->optimal_distance == $distance)
                                            <option value="{{ $distance }}" selected>
                                                {{ $distance }}
                                            </option>
                                        @else
                                            <option value="{{ $distance }}">
                                                {{ $distance }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('optimal_distance')
                                    <div class="invalid-feedback ml-3 w-56">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                @php
                                    $materials = ['Iron', 'Diecast', 'Aluminium'];
                                @endphp
                                <label class="w-36 ml-3 label-base">Bahan Kabinet</label>
                                <select id="cabinet_material" name="cabinet_material"
                                    class="flex input-area w-56 @error('cabinet_material') is-invalid @enderror"
                                    type="text" value="{{ $led->cabinet_material }}">
                                    @foreach ($materials as $material)
                                        @if ($led->cabinet_material == $material)
                                            <option value="{{ $material }}" selected>
                                                {{ $material }}
                                            </option>
                                        @else
                                            <option value="{{ $material }}">
                                                {{ $material }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('cabinet_material')
                                    <div class="invalid-feedback ml-3 w-56">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <label class="w-36 ml-3 label-base">Berat Kabinet ( kg )</label>
                                <input
                                    class="flex input-area in-out-spin-none w-56 @error('cabinet_weight') is-invalid @enderror"
                                    type="number" min="0" id="cabinet_weight" name="cabinet_weight"
                                    placeholder="Input berat kabinet" value="{{ $led->cabinet_weight }}" required>
                                @error('cabinet_weight')
                                    <div class="invalid-feedback ml-3 w-56">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <label class="w-36 ml-3 label-base">Ukuran Modul</label>
                                <div class="flex items-center">
                                    <label class="label-base ml-3">Width</label>
                                    <input
                                        class="flex input-area in-out-spin-none w-12 text-center @error('module_width') is-invalid @enderror"
                                        type="number" name="module_width" min="0"
                                        value="{{ $led->module_width }}" placeholder="0" required>
                                    <label class="label-base ml-3">Height</label>
                                    <input
                                        class="flex input-area in-out-spin-none w-12 text-center @error('module_height') is-invalid @enderror"
                                        type="number" name="module_height" min="0"
                                        value="{{ $led->module_height }}" placeholder="0" required>
                                </div>
                            </div>
                            <div class="mt-2">
                                <label class="w-36 ml-3 label-base">Ukuran Kabinet</label>
                                <div class="flex items-center">
                                    <label class="label-base ml-3">Width</label>
                                    <input
                                        class="flex input-area in-out-spin-none w-12 text-center @error('cabinet_width') is-invalid @enderror"
                                        type="number" name="cabinet_width" min="0"
                                        value="{{ $led->cabinet_width }}" placeholder="0" required>
                                    <label class="label-base ml-3">Height</label>
                                    <input
                                        class="flex input-area in-out-spin-none w-12 text-center @error('cabinet_height') is-invalid @enderror"
                                        type="number" name="cabinet_height" min="0"
                                        value="{{ $led->cabinet_height }}" placeholder="0" required>
                                </div>
                            </div>
                            <div class="mt-2">
                                <label class="w-36 ml-3 label-base">IP Rating</label>
                                <div class="flex items-center">
                                    <label class="label-base ml-3">Front</label>
                                    <input
                                        class="flex input-area in-out-spin-none w-12 text-center @error('front_protection') is-invalid @enderror"
                                        type="number" name="front_protection" min="0"
                                        value="{{ $led->front_protection }}" placeholder="0" required>
                                    <label class="label-base ml-3">Back</label>
                                    <input
                                        class="flex input-area in-out-spin-none w-12 text-center @error('back_protection') is-invalid @enderror"
                                        type="number" name="back_protection" min="0"
                                        value="{{ $led->back_protection }}" placeholder="0" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        setPixelDensity = (sel) => {
            if (sel.value != "pilih") {
                document.getElementById("pixel_density").value = Math.trunc(1000 / Number(sel.value)) * Math.trunc(
                    1000 / Number(sel.value));
            }
        }
    </script>
@endsection
