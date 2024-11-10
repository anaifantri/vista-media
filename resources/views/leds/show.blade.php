@extends('dashboard.layouts.main');

@section('container')
    <form method="post" action="/media/leds" enctype="multipart/form-data">
        @csrf
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
                <!-- Show Title start -->
                <div class="flex w-full justify-center">
                    <div class="flex items-center w-[1000px] border-b">
                        <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[650px]">DATA LED
                            {{ strtoupper($led->name) }} </h1>
                        <div class="flex w-full justify-end items-center p-1">
                            <a href="/media/leds" class="flex items-center justify-center btn-primary mx-1">
                                <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m12.017 1.995c5.517 0 9.997 4.48 9.997 9.998s-4.48 9.998-9.997 9.998c-5.518 0-9.998-4.48-9.998-9.998s4.48-9.998 9.998-9.998zm0 1.5c-4.69 0-8.498 3.808-8.498 8.498s3.808 8.498 8.498 8.498 8.497-3.808 8.497-8.498-3.807-8.498-8.497-8.498zm-1.528 4.715s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                        fill-rule="nonzero" />
                                </svg>
                                <span class="mx-1"> Back </span>
                            </a>
                            @canany(['isAdmin', 'isMedia'])
                                @can('isMediaSetting')
                                    @can('isMediaEdit')
                                        <a href="/media/leds/{{ $led->id }}/edit"
                                            class="flex items-center justify-center btn-warning mx-1">
                                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                            <span class="mx-1"> Edit </span>
                                        </a>
                                    @endcan
                                @endcan
                            @endcanany
                            @canany(['isAdmin', 'isMedia'])
                                @can('isMediaSetting')
                                    @can('isMediaDelete')
                                        <form action="/media/leds/{{ $led->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="flex items-center justify-center btn-danger mx-1"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus katagori billboard dengan nama {{ $led->name }} ?')">
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
                                    @endcan
                                @endcan
                            @endcanany
                        </div>
                    </div>
                </div>
                <!-- Show Title end -->
                <div class="flex w-full justify-center items-center">
                    <div class="flex justify-center w-[300px] h-[500px] border rounded-lg m-2 p-2 bg-stone-300">
                        <div>
                            <div class="mt-2">
                                <label class="flex ml-3 label-base">Nama Vendor</label>
                                <label
                                    class="flex w-56 border rounded-lg ml-3 label-base px-2 py-1 font-semibold mt-2">{{ $led->vendor->name }}</label>
                            </div>
                            <div class="mt-2">
                                <label class="flex ml-3 label-base">Nama Produk</label>
                                <label
                                    class="flex w-56 border rounded-lg ml-3 label-base px-2 py-1 font-semibold mt-2">{{ $led->name }}</label>
                            </div>
                            <div class="mt-2">
                                <label class="flex ml-3 label-base">Tipe LED</label>
                                <label
                                    class="flex w-56 border rounded-lg ml-3 label-base px-2 py-1 font-semibold mt-2">{{ $led->type }}</label>
                            </div>
                            <div class="mt-2">
                                <label class="flex ml-3 label-base">Konfigurasi Pixel</label>
                                <label
                                    class="flex w-56 border rounded-lg ml-3 label-base px-2 py-1 font-semibold mt-2">{{ $led->pixel_config }}</label>
                            </div>
                            <div class="mt-2">
                                <label class="flex ml-3 label-base">Ukuran Pixel</label>
                                <label
                                    class="flex w-56 border rounded-lg ml-3 label-base px-2 py-1 font-semibold mt-2">{{ $led->pixel_pitch }}</label>
                            </div>
                            <div class="mt-2">
                                <label class="flex ml-3 label-base">Kerapatan Pixel ( /m2 )</label>
                                <label
                                    class="flex w-56 border rounded-lg ml-3 label-base px-2 py-1 font-semibold mt-2">{{ $led->pixel_density }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center w-[300px] h-[500px] border rounded-lg m-2 p-2 bg-stone-300">
                        <div>
                            <div class="mt-2">
                                <label class="flex ml-3 label-base">Daya Maksimal (watt)</label>
                                <label
                                    class="flex w-56 border rounded-lg ml-3 label-base px-2 py-1 font-semibold mt-2">{{ $led->max_power }}</label>
                            </div>
                            <div class="mt-2">
                                <label class="flex ml-3 label-base">Daya Rata-rata (watt)</label>
                                <label
                                    class="flex w-56 border rounded-lg ml-3 label-base px-2 py-1 font-semibold mt-2">{{ $led->average_power }}</label>
                            </div>
                            <div class="mt-2">
                                <label class="flex ml-3 label-base">Sudut Pandang (V)</label>
                                <label
                                    class="flex w-56 border rounded-lg ml-3 label-base px-2 py-1 font-semibold mt-2">{{ $led->vertical_angle }}</label>
                            </div>
                            <div class="mt-2">
                                <label class="flex ml-3 label-base">Sudut Pandang (H)</label>
                                <label
                                    class="flex w-56 border rounded-lg ml-3 label-base px-2 py-1 font-semibold mt-2">{{ $led->horizontal_angle }}</label>
                            </div>
                            <div class="mt-2">
                                <label class="flex ml-3 label-base">Brightness ( ccd/m )</label>
                                <label
                                    class="flex w-56 border rounded-lg ml-3 label-base px-2 py-1 font-semibold mt-2">{{ $led->brightness }}</label>
                            </div>
                            <div class="mt-2">
                                <label class="flex ml-3 label-base">Refresh Rate ( Hz )</label>
                                <label
                                    class="flex w-56 border rounded-lg ml-3 label-base px-2 py-1 font-semibold mt-2">{{ $led->refresh_rate }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center w-[300px] h-[500px] border rounded-lg m-2 p-2 bg-stone-300">
                        <div>
                            <div class="mt-2">
                                <label class="flex ml-3 label-base">Jarak Pandang Terbaik</label>
                                <label
                                    class="flex w-56 border rounded-lg ml-3 label-base px-2 py-1 font-semibold mt-2">{{ $led->optimal_distance }}</label>
                            </div>
                            <div class="mt-2">
                                <label class="flex ml-3 label-base">Bahan Kabinet</label>
                                <label
                                    class="flex w-56 border rounded-lg ml-3 label-base px-2 py-1 font-semibold mt-2">{{ $led->cabinet_material }}</label>
                            </div>
                            <div class="mt-2">
                                <label class="flex ml-3 label-base">Berat Kabinet ( kg )</label>
                                <label
                                    class="flex w-56 border rounded-lg ml-3 label-base px-2 py-1 font-semibold mt-2">{{ $led->cabinet_weight }}</label>
                            </div>
                            <div class="mt-2">
                                <label class="flex ml-3 label-base">Ukuran Modul ( mm )</label>
                                <div class="flex items-center mt-2">
                                    <label class="label-base ml-3">Width</label>
                                    <label
                                        class="w-12 border rounded-lg ml-1 label-base p-1 font-semibold text-center">{{ $led->module_width }}</label>
                                    <label class="label-base ml-3">Height</label>
                                    <label
                                        class="w-12 border rounded-lg ml-1 label-base p-1 font-semibold text-center">{{ $led->module_height }}</label>
                                </div>
                            </div>
                            <div class="mt-2">
                                <label class="flex ml-3 label-base">Ukuran Kabinet ( mm )</label>
                                <div class="flex items-center mt-2">
                                    <label class="label-base ml-3">Width</label>
                                    <label
                                        class="w-12 border rounded-lg ml-1 label-base p-1 font-semibold text-center">{{ $led->cabinet_width }}</label>
                                    <label class="label-base ml-3">Height</label>
                                    <label
                                        class="w-12 border rounded-lg ml-1 label-base p-1 font-semibold text-center">{{ $led->cabinet_width }}</label>
                                </div>
                            </div>
                            <div class="mt-2">
                                <label class="flex ml-3 label-base">IP Rating</label>
                                <div class="flex items-center mt-2">
                                    <label class="label-base ml-3">Front</label>
                                    <label
                                        class="w-12 border rounded-lg ml-1 label-base p-1 font-semibold text-center">{{ $led->front_protection }}</label>
                                    <label class="label-base ml-3">Back</label>
                                    <label
                                        class="w-12 border rounded-lg ml-1 label-base p-1 font-semibold text-center">{{ $led->back_protection }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
