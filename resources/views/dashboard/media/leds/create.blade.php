@extends('dashboard.layouts.main');

@section('container')
    <div class="flex justify-center mt-10">
        <form class="md:flex" method="post" action="/dashboard/media/leds" enctype="multipart/form-data">
            @csrf
            <div class="flex w-full sm:w-[500px] items-center">
                <div class="p-3 py-5 w-full">
                    <div class="flex items-center justify-center mb-2 border-b">
                        <h4 class="text-xl font-semibold tracking-wider text-teal-900">Tambah Produk LED</h4>
                    </div>
                    <div class="mt-5 w-full">
                        <div class="flex mt-2 justify-center"><label class="w-36 sm:w-44 text-sm text-teal-700">Nama
                                Produk</label>
                            <div>
                                <input
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-36 sm:w-44 border rounded-lg  outline-teal-300 @error('name') is-invalid @enderror"
                                    type="text" id="name" name="name" value="{{ old('name') }}" autofocus
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center"><label class="w-36 sm:w-44 text-sm text-teal-700">Nama
                                Vendor</label>
                            <div>
                                <select
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-36 sm:w-44 border rounded-lg  outline-teal-300 @error('vendor_id') is-invalid @enderror"
                                    name="vendor_id" id="vendor_id" value="{{ old('vendor_id') }}" required>
                                    <option value="Pilih Vendor">Pilih Vendor</option>
                                    @foreach ($vendors as $vendor)
                                        @if (old('vendor_id') == $vendor->id)
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
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center"><label class="w-36 sm:w-44 text-sm text-teal-700">Pixel
                                Pitch</label>
                            <div>
                                <input
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-36 sm:w-44 border rounded-lg  outline-teal-300 @error('pixel_pitch') is-invalid @enderror"
                                    type="text" id="pixel_pitch" name="pixel_pitch" value="{{ old('pixel_pitch') }}"
                                    required>
                                @error('pixel_pitch')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center"><label class="w-36 sm:w-44 text-sm text-teal-700">Pixel
                                Density</label>
                            <div>
                                <input
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-36 sm:w-44 border rounded-lg  outline-teal-300 @error('pixel_density') is-invalid @enderror"
                                    type="text" id="pixel_density" name="pixel_density"
                                    value="{{ old('pixel_density') }}" required>
                                @error('pixel_density')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center"><label class="w-36 sm:w-44 text-sm text-teal-700">Module
                                Size</label>
                            <div>
                                <input
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-36 sm:w-44 border rounded-lg  outline-teal-300 @error('module_size') is-invalid @enderror"
                                    type="text" id="module_size" name="module_size" value="{{ old('module_size') }}"
                                    required>
                                @error('module_size')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center"><label class="w-36 sm:w-44 text-sm text-teal-700">Cabinet
                                Size</label>
                            <div>
                                <input
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-36 sm:w-44 border rounded-lg  outline-teal-300 @error('cabinet_size') is-invalid @enderror"
                                    type="text" id="cabinet_size" name="cabinet_size" value="{{ old('cabinet_size') }}"
                                    required>
                                @error('cabinet_size')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center"><label class="w-36 sm:w-44 text-sm text-teal-700">Cabinet
                                Material</label>
                            <div>
                                <input
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-36 sm:w-44 border rounded-lg  outline-teal-300 @error('cabinet_material') is-invalid @enderror"
                                    type="text" id="cabinet_material" name="cabinet_material"
                                    value="{{ old('cabinet_material') }}" required>
                                @error('cabinet_material')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center"><label class="w-36 sm:w-44 text-sm text-teal-700">Cabinet
                                Weight</label>
                            <div>
                                <input
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-36 sm:w-44 border rounded-lg  outline-teal-300 @error('cabinet_weight') is-invalid @enderror"
                                    type="text" id="cabinet_weight" name="cabinet_weight"
                                    value="{{ old('cabinet_weight') }}" required>
                                @error('cabinet_weight')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center"><label class="w-36 sm:w-44 text-sm text-teal-700">Protective
                                Grade</label>
                            <div>
                                <input
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-36 sm:w-44 border rounded-lg  outline-teal-300 @error('protective_grade') is-invalid @enderror"
                                    type="text" id="protective_grade" name="protective_grade"
                                    value="{{ old('protective_grade') }}" required>
                                @error('protective_grade')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center"><label class="w-36 sm:w-44 text-sm text-teal-700">View
                                Distancing</label>
                            <div>
                                <input
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-36 sm:w-44 border rounded-lg  outline-teal-300 @error('view_distancing') is-invalid @enderror"
                                    type="text" id="view_distancing" name="view_distancing"
                                    value="{{ old('view_distancing') }}" required>
                                @error('view_distancing')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center"><label class="w-36 sm:w-44 text-sm text-teal-700">View Angle
                                Vertikal</label>
                            <div>
                                <input
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-36 sm:w-44 border rounded-lg  outline-teal-300 @error('view_angle_v') is-invalid @enderror"
                                    type="text" id="view_angle_v" name="view_angle_v" value="{{ old('view_angle_v') }}"
                                    required>
                                @error('view_angle_v')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center"><label class="w-36 sm:w-44 text-sm text-teal-700">View Angle
                                Horizontal</label>
                            <div>
                                <input
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-36 sm:w-44 border rounded-lg  outline-teal-300 @error('view_angle_h') is-invalid @enderror"
                                    type="text" id="view_angle_h" name="view_angle_h"
                                    value="{{ old('view_angle_h') }}" required>
                                @error('view_angle_h')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center"><label class="w-36 sm:w-44 text-sm text-teal-700">Max
                                Power</label>
                            <div>
                                <input
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-36 sm:w-44 border rounded-lg  outline-teal-300 @error('max_power') is-invalid @enderror"
                                    type="text" id="max_power" name="max_power" value="{{ old('max_power') }}"
                                    autofocus required>
                                @error('max_power')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center"><label class="w-36 sm:w-44 text-sm text-teal-700">Average
                                Power</label>
                            <div>
                                <input
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-36 sm:w-44 border rounded-lg  outline-teal-300 @error('average_power') is-invalid @enderror"
                                    type="text" id="average_power" name="average_power"
                                    value="{{ old('average_power') }}" required>
                                @error('average_power')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center"><label
                                class="w-36 sm:w-44 text-sm text-teal-700">Brightness</label>
                            <div>
                                <input
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-36 sm:w-44 border rounded-lg  outline-teal-300 @error('brightness') is-invalid @enderror"
                                    type="text" id="brightness" name="brightness" value="{{ old('brightness') }}"
                                    required>
                                @error('brightness')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex justify-center mt-5">
                            <button class="flex items-center justify-center btn-primary mx-1" type="submit"
                                id="btnSubmit" name="btnSubmit">
                                <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                                </svg>
                                <span class="mx-2"> Save </span>
                            </button>
                            <a href="/dashboard/media/leds" class="flex items-center justify-center btn-danger mx-1">
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
            </div>
        </form>
    </div>
@endsection
