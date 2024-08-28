@extends('dashboard.layouts.main');

@section('container')
    <div class="flex justify-center mt-10">
        <form class="md:flex" method="post" action="/dashboard/media/leds" enctype="multipart/form-data">
            @csrf
            <div class="flex w-full items-center">
                <div class="p-3 py-5 w-full">
                    <div class="flex items-center justify-center mb-2 border-b">
                        <h4 class="text-xl font-semibold tracking-wider text-teal-900">Tambah Produk LED</h4>
                    </div>
                    <div class="mt-5 w-full">
                        <div class="flex mt-2 justify-center"><label class="w-44 text-sm text-teal-700">Nama
                                Vendor</label>
                            <div>
                                <select
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg  outline-teal-300 @error('vendor_id') is-invalid @enderror"
                                    name="vendor_id" id="vendor_id" value="{{ old('vendor_id') }}" required>
                                    <option value="pilih">- pilih -</option>
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
                                    <div class="invalid-feedback w-44">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center"><label class="w-44 text-sm text-teal-700">Nama
                                Produk</label>
                            <div>
                                <input
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg  outline-teal-300 @error('name') is-invalid @enderror"
                                    type="text" id="name" name="name" value="{{ old('name') }}" autofocus
                                    required>
                                @error('name')
                                    <div class="invalid-feedback w-44">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center">
                            @php
                                $numberType = 0;
                                $type = ['SMD', 'DIP'];
                            @endphp
                            <label class="w-44 text-sm text-teal-700">Tipe LED</label>
                            <div>
                                <select id="type" name="type"
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg  outline-teal-300 @error('type') is-invalid @enderror"
                                    type="text" value="{{ old('type') }}">
                                    <option value="pilih">- pilih -</option>
                                    @for ($numberType = 0; $numberType < count($type); $numberType++)
                                        @if (old('type') == $type[$numberType])
                                            <option value="{{ $type[$numberType] }}" selected>
                                                {{ $type[$numberType] }}
                                            </option>
                                        @else
                                            <option value="{{ $type[$numberType] }}">
                                                {{ $type[$numberType] }}
                                            </option>
                                        @endif
                                    @endfor
                                </select>
                                @error('type')
                                    <div class="invalid-feedback w-44">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center">
                            @php
                                $numberPixelConfig = 0;
                                $pixel_config = ['2R1G1B', '1R1G1B'];
                            @endphp
                            <label class="w-44 text-sm text-teal-700">Konfigurasi Pixel</label>
                            <div>
                                <select id="pixel_config" name="pixel_config"
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg  outline-teal-300 @error('pixel_config') is-invalid @enderror"
                                    type="text" value="{{ old('pixel_config') }}">
                                    <option value="pilih">- pilih -</option>
                                    @for ($numberPixelConfig = 0; $numberPixelConfig < count($pixel_config); $numberPixelConfig++)
                                        @if (old('pixel_config') == $pixel_config[$numberPixelConfig])
                                            <option value="{{ $pixel_config[$numberPixelConfig] }}" selected>
                                                {{ $pixel_config[$numberPixelConfig] }}
                                            </option>
                                        @else
                                            <option value="{{ $pixel_config[$numberPixelConfig] }}">
                                                {{ $pixel_config[$numberPixelConfig] }}
                                            </option>
                                        @endif
                                    @endfor
                                </select>
                                @error('pixel_config')
                                    <div class="invalid-feedback w-44">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center">
                            @php
                                $numberPixel = 0;
                                $pixels = ['P1.8', 'P2.4', 'P4', 'P5', 'P8', 'P10', 'P12', 'P16'];
                            @endphp
                            <label class="w-44 text-sm text-teal-700">Ukuran
                                Pixel</label>
                            <div>
                                <select id="pixel_pitch" name="pixel_pitch"
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg  outline-teal-300 @error('pixel_pitch') is-invalid @enderror"
                                    type="text" value="{{ old('pixel_pitch') }}">
                                    <option value="pilih">- pilih -</option>
                                    @for ($numberPixel = 0; $numberPixel < count($pixels); $numberPixel++)
                                        @if (old('pixel_pitch') == $pixels[$numberPixel])
                                            <option value="{{ $pixels[$numberPixel] }}" selected>
                                                {{ $pixels[$numberPixel] }}
                                            </option>
                                        @else
                                            <option value="{{ $pixels[$numberPixel] }}">
                                                {{ $pixels[$numberPixel] }}
                                            </option>
                                        @endif
                                    @endfor
                                </select>
                                @error('pixel_pitch')
                                    <div class="invalid-feedback w-44">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center">
                            @php
                                $numberModule = 0;
                                $modules = ['320mm x 160mm', '320mm x 320mm', '256mm x 256mm', '320mm x 640mm'];
                            @endphp
                            <label class="w-44 text-sm text-teal-700">Ukuran Modul</label>
                            <div>
                                <select id="module_size" name="module_size"
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg  outline-teal-300 @error('module_size') is-invalid @enderror"
                                    type="text" value="{{ old('module_size') }}">
                                    <option value="pilih">- pilih -</option>
                                    @for ($numberModule = 0; $numberModule < count($modules); $numberModule++)
                                        @if (old('module_size') == $modules[$numberModule])
                                            <option value="{{ $modules[$numberModule] }}" selected>
                                                {{ $modules[$numberModule] }}
                                            </option>
                                        @else
                                            <option value="{{ $modules[$numberModule] }}">
                                                {{ $modules[$numberModule] }}
                                            </option>
                                        @endif
                                    @endfor
                                </select>
                                @error('module_size')
                                    <div class="invalid-feedback w-44">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center">
                            @php
                                $numberCabinet = 0;
                                $cabinets = ['480mm x 640mm', '960mm x 960mm', '1024mm x 1024mm'];
                            @endphp
                            <label class="w-44 text-sm text-teal-700">Ukuran Kabinet</label>
                            <div>
                                <select id="cabinet_size" name="cabinet_size"
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg  outline-teal-300 @error('cabinet_size') is-invalid @enderror"
                                    type="text" value="{{ old('cabinet_size') }}">
                                    <option value="pilih">- pilih -</option>
                                    @for ($numberCabinet = 0; $numberCabinet < count($cabinets); $numberCabinet++)
                                        @if (old('cabinet_size') == $cabinets[$numberCabinet])
                                            <option value="{{ $cabinets[$numberCabinet] }}" selected>
                                                {{ $cabinets[$numberCabinet] }}
                                            </option>
                                        @else
                                            <option value="{{ $cabinets[$numberCabinet] }}">
                                                {{ $cabinets[$numberCabinet] }}
                                            </option>
                                        @endif
                                    @endfor
                                </select>
                                @error('cabinet_size')
                                    <div class="invalid-feedback w-44">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center">
                            @php
                                $numberMaterial = 0;
                                $materials = ['Iron', 'Diecast', 'Aluminium'];
                            @endphp
                            <label class="w-44 text-sm text-teal-700">Bahan Kabinet</label>
                            <div>
                                <select id="cabinet_material" name="cabinet_material"
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg  outline-teal-300 @error('cabinet_material') is-invalid @enderror"
                                    type="text" value="{{ old('cabinet_material') }}">
                                    <option value="pilih">- pilih -</option>
                                    @for ($numberMaterial = 0; $numberMaterial < count($materials); $numberMaterial++)
                                        @if (old('cabinet_material') == $materials[$numberMaterial])
                                            <option value="{{ $materials[$numberMaterial] }}" selected>
                                                {{ $materials[$numberMaterial] }}
                                            </option>
                                        @else
                                            <option value="{{ $materials[$numberMaterial] }}">
                                                {{ $materials[$numberMaterial] }}
                                            </option>
                                        @endif
                                    @endfor
                                </select>
                                @error('cabinet_material')
                                    <div class="invalid-feedback w-44">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center">
                            @php
                                $numberGrade = 0;
                                $grades = ['IP65 Front, IP43 Rear', 'IP65 Front, IP54 Rear', 'IP65 Front, IP65 Rear'];
                            @endphp
                            <label class="w-44 text-sm text-teal-700">Tingkat Ketahanan Air</label>
                            <div>
                                <select id="protective_grade" name="protective_grade"
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg  outline-teal-300 @error('protective_grade') is-invalid @enderror"
                                    type="text" value="{{ old('protective_grade') }}">
                                    <option value="pilih">- pilih -</option>
                                    @for ($numberGrade = 0; $numberGrade < count($grades); $numberGrade++)
                                        @if (old('protective_grade') == $grades[$numberGrade])
                                            <option value="{{ $grades[$numberGrade] }}" selected>
                                                {{ $grades[$numberGrade] }}
                                            </option>
                                        @else
                                            <option value="{{ $grades[$numberGrade] }}">
                                                {{ $grades[$numberGrade] }}
                                            </option>
                                        @endif
                                    @endfor
                                </select>
                                @error('protective_grade')
                                    <div class="invalid-feedback w-44">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center">
                            @php
                                $numberAngle = 0;
                                $angle = ['60°', '90°', '110°', '120°', '140°', '160°', '180°'];
                            @endphp
                            <label class="w-44 text-sm text-teal-700">Sudut Pandang Terbaik (V)</label>
                            <div>
                                <select id="view_angle_v" name="view_angle_v"
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg  outline-teal-300 @error('view_angle_v') is-invalid @enderror"
                                    type="text" value="{{ old('view_angle_v') }}">
                                    <option value="pilih">- pilih -</option>
                                    @for ($numberAngle = 0; $numberAngle < count($angle); $numberAngle++)
                                        @if (old('view_angle_v') == $angle[$numberAngle])
                                            <option value="{{ $angle[$numberAngle] }}" selected>
                                                {{ $angle[$numberAngle] }}
                                            </option>
                                        @else
                                            <option value="{{ $angle[$numberAngle] }}">
                                                {{ $angle[$numberAngle] }}
                                            </option>
                                        @endif
                                    @endfor
                                </select>
                                @error('view_angle_v')
                                    <div class="invalid-feedback w-44">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center">
                            <label class="w-44 text-sm text-teal-700">Sudut Pandang Terbaik (H)</label>
                            <div>
                                <select id="view_angle_h" name="view_angle_h"
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg  outline-teal-300 @error('view_angle_h') is-invalid @enderror"
                                    type="text" value="{{ old('view_angle_h') }}">
                                    <option value="pilih">- pilih -</option>
                                    @for ($numberAngle = 0; $numberAngle < count($angle); $numberAngle++)
                                        @if (old('view_angle_h') == $angle[$numberAngle])
                                            <option value="{{ $angle[$numberAngle] }}" selected>
                                                {{ $angle[$numberAngle] }}
                                            </option>
                                        @else
                                            <option value="{{ $angle[$numberAngle] }}">
                                                {{ $angle[$numberAngle] }}
                                            </option>
                                        @endif
                                    @endfor
                                </select>
                                @error('view_angle_h')
                                    <div class="invalid-feedback w-44">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center">
                            @php
                                $numberBrightness = 0;
                                $brightness = [
                                    '< 4000 cd / m2',
                                    '5000 cd / m2',
                                    '5500 cd / m2',
                                    '6000 cd / m2',
                                    '6500 cd / m2',
                                    '7000 cd / m2',
                                    '8000 cd / m2',
                                    '10000 cd / m2',
                                ];
                            @endphp
                            <label class="w-44 text-sm text-teal-700">Brightness</label>
                            <div>
                                <select id="brightness" name="brightness"
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg  outline-teal-300 @error('brightness') is-invalid @enderror"
                                    type="text" value="{{ old('brightness') }}">
                                    <option value="pilih">- pilih -</option>
                                    @for ($numberBrightness = 0; $numberBrightness < count($brightness); $numberBrightness++)
                                        @if (old('brightness') == $brightness[$numberBrightness])
                                            <option value="{{ $brightness[$numberBrightness] }}" selected>
                                                {{ $brightness[$numberBrightness] }}
                                            </option>
                                        @else
                                            <option value="{{ $brightness[$numberBrightness] }}">
                                                {{ $brightness[$numberBrightness] }}
                                            </option>
                                        @endif
                                    @endfor
                                </select>
                                @error('brightness')
                                    <div class="invalid-feedback w-44">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center">
                            @php
                                $numberRate = 0;
                                $refresh = ['1920 HZ', '3840 HZ'];
                            @endphp
                            <label class="w-44 text-sm text-teal-700">Refresh Rate</label>
                            <div>
                                <select id="refresh_rate" name="refresh_rate"
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg  outline-teal-300 @error('refresh_rate') is-invalid @enderror"
                                    type="text" value="{{ old('refresh_rate') }}">
                                    <option value="pilih">- pilih -</option>
                                    @for ($numberRate = 0; $numberRate < count($refresh); $numberRate++)
                                        @if (old('refresh_rate') == $refresh[$numberRate])
                                            <option value="{{ $refresh[$numberRate] }}" selected>
                                                {{ $refresh[$numberRate] }}
                                            </option>
                                        @else
                                            <option value="{{ $refresh[$numberRate] }}">
                                                {{ $refresh[$numberRate] }}
                                            </option>
                                        @endif
                                    @endfor
                                </select>
                                @error('refresh_rate')
                                    <div class="invalid-feedback w-44">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center">
                            @php
                                $numberDistance = 0;
                                $distance = ['> 2m', '> 3m', '> 4m', '> 5m', '> 6m', '> 8m', '> 10m', '> 12m'];
                            @endphp
                            <label class="w-44 text-sm text-teal-700">Jarak Pandang Terbaik</label>
                            <div>
                                <select id="view_distancing" name="view_distancing"
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg  outline-teal-300 @error('view_distancing') is-invalid @enderror"
                                    type="text" value="{{ old('view_distancing') }}">
                                    <option value="pilih">- pilih -</option>
                                    @for ($numberDistance = 0; $numberDistance < count($distance); $numberDistance++)
                                        @if (old('view_distancing') == $distance[$numberDistance])
                                            <option value="{{ $distance[$numberDistance] }}" selected>
                                                {{ $distance[$numberDistance] }}
                                            </option>
                                        @else
                                            <option value="{{ $distance[$numberDistance] }}">
                                                {{ $distance[$numberDistance] }}
                                            </option>
                                        @endif
                                    @endfor
                                </select>
                                @error('view_distancing')
                                    <div class="invalid-feedback w-44">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center"><label class="w-44 text-sm text-teal-700">Berat
                                Kabinet</label>
                            <div>
                                <input
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg  outline-teal-300 @error('cabinet_weight') is-invalid @enderror"
                                    type="text" id="cabinet_weight" name="cabinet_weight"
                                    value="{{ old('cabinet_weight') }}" required>
                                @error('cabinet_weight')
                                    <div class="invalid-feedback w-44">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center"><label class="w-44 text-sm text-teal-700">Kerapatan
                                Pixel</label>
                            <div>
                                <input
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg  outline-teal-300 @error('pixel_density') is-invalid @enderror"
                                    type="text" id="pixel_density" name="pixel_density"
                                    value="{{ old('pixel_density') }}" required>
                                @error('pixel_density')
                                    <div class="invalid-feedback w-44">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center"><label class="w-44 text-sm text-teal-700">Daya
                                Maksimal</label>
                            <div>
                                <input
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg  outline-teal-300 @error('max_power') is-invalid @enderror"
                                    type="text" id="max_power" name="max_power" value="{{ old('max_power') }}"
                                    autofocus required>
                                @error('max_power')
                                    <div class="invalid-feedback w-44">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2 justify-center"><label class="w-44 text-sm text-teal-700">Daya
                                Rata-rata</label>
                            <div>
                                <input
                                    class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg  outline-teal-300 @error('average_power') is-invalid @enderror"
                                    type="text" id="average_power" name="average_power"
                                    value="{{ old('average_power') }}" required>
                                @error('average_power')
                                    <div class="invalid-feedback w-44">
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
    </div>
    </form>
    </div>
@endsection
