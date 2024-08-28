@extends('dashboard.layouts.main');

@section('container')
    <div class="flex justify-center mt-10">
        <div class="flex w-full items-center">
            <div class="p-3 py-5 w-full">
                <div class="flex items-center justify-center mb-2 border-b">
                    <h4 class="text-xl font-semibold tracking-wider text-teal-900">Detail Produk LED</h4>
                </div>
                <div class="mt-5 w-full">
                    <div class="flex mt-2 justify-center">
                        <label class="w-44 text-sm text-teal-700">Nama Vendor</label>
                        <h6 class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg">
                            {{ $led->vendor->name }}</h6>
                    </div>
                    <div class="flex mt-2 justify-center">
                        <label class="w-44 text-sm text-teal-700">Nama Produk</label>
                        <h6 class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg">{{ $led->name }}
                        </h6>
                    </div>
                    <div class="flex mt-2 justify-center">
                        <label class="w-44 text-sm text-teal-700">Tipe LED</label>
                        <h6 class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg">{{ $led->type }}
                        </h6>
                    </div>
                    <div class="flex mt-2 justify-center">
                        <label class="w-44 text-sm text-teal-700">Konfigurasi Pixel</label>
                        <h6 class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg">
                            {{ $led->pixel_config }}</h6>
                    </div>
                    <div class="flex mt-2 justify-center">
                        <label class="w-44 text-sm text-teal-700">Ukuran Pixel</label>
                        <h6 class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg">
                            {{ $led->pixel_pitch }}</h6>
                    </div>
                    <div class="flex mt-2 justify-center">
                        <label class="w-44 text-sm text-teal-700">Ukuran Module</label>
                        <h6 class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg">
                            {{ $led->module_size }}</h6>
                    </div>
                    <div class="flex mt-2 justify-center">
                        <label class="w-44 text-sm text-teal-700">Ukuran Kabinet</label>
                        <h6 class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg">
                            {{ $led->cabinet_size }}</h6>
                    </div>
                    <div class="flex mt-2 justify-center">
                        <label class="w-44 text-sm text-teal-700">Bahan Kabinet</label>
                        <h6 class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg">
                            {{ $led->cabinet_material }}</h6>
                    </div>
                    <div class="flex mt-2 justify-center">
                        <label class="w-44 text-sm text-teal-700">Tingkat Ketahanan Air</label>
                        <h6 class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg">
                            {{ $led->protective_grade }}</h6>
                    </div>
                    <div class="flex mt-2 justify-center">
                        <label class="w-44 text-sm text-teal-700">SUdut Pandang Vertikal</label>
                        <h6 class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg">
                            {{ $led->view_angle_v }}</h6>
                    </div>
                    <div class="flex mt-2 justify-center">
                        <label class="w-44 text-sm text-teal-700">Sudut Pandang Horizontal</label>
                        <h6 class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg">
                            {{ $led->view_angle_h }}</h6>
                    </div>
                    <div class="flex mt-2 justify-center">
                        <label class="w-44 text-sm text-teal-700">Brightness</label>
                        <h6 class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg">
                            {{ $led->brightness }}</h6>
                    </div>
                    <div class="flex mt-2 justify-center">
                        <label class="w-44 text-sm text-teal-700">Refresh Rate</label>
                        <h6 class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg">
                            {{ $led->refresh_rate }}</h6>
                    </div>
                    <div class="flex mt-2 justify-center">
                        <label class="w-44 text-sm text-teal-700">Jarak Pandang Terbaik</label>
                        <h6 class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg">
                            {{ $led->view_distancing }}</h6>
                    </div>
                    <div class="flex mt-2 justify-center">
                        <label class="w-44 text-sm text-teal-700">Berat Kabinet</label>
                        <h6 class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg">
                            {{ $led->cabinet_weight }}</h6>
                    </div>
                    <div class="flex mt-2 justify-center">
                        <label class="w-44 text-sm text-teal-700">Kerapatan Pixel</label>
                        <h6 class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg">
                            {{ $led->pixel_density }}</h6>
                    </div>
                    <div class="flex mt-2 justify-center">
                        <label class="w-44 text-sm text-teal-700">Daya Maksimal</label>
                        <h6 class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg">
                            {{ $led->max_power }}</h6>
                    </div>
                    <div class="flex mt-2 justify-center">
                        <label class="w-44 text-sm text-teal-700">Daya Rata-rata</label>
                        <h6 class="flex px-2 text-sm font-semibold text-teal-900 w-44 border rounded-lg">
                            {{ $led->average_power }}</h6>
                    </div>
                    <div class="flex justify-center mt-5">
                        <a href="/dashboard/media/leds" class="flex items-center justify-center btn-primary mx-1">
                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1"> Back </span>
                        </a>
                        <a href="/dashboard/media/leds/{{ $led->id }}/edit"
                            class="flex items-center justify-center btn-warning mx-1">
                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1"> Edit </span>
                        </a>
                        <form action="/dashboard/media/leds/{{ $led->id }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="flex items-center justify-center btn-danger mx-1"
                                onclick="return confirm('Apakah anda yakin ingin menghapus Produk LED {{ $led->name }} ?')">
                                <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                        fill-rule="nonzero" />
                                </svg>
                                <span class="mx-1"> Delete </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
