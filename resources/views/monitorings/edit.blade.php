@extends('dashboard.layouts.main');

@section('container')
    <?php
    $description = json_decode($location->description);
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    ?>
    <!-- Form Create start -->
    <form action="/workshop/monitorings/{{ $monitoring->id }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <input name="user_id" value="{{ auth()->user()->id }}" type="text" hidden>
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="w-[1000px] z-0 mb-8 bg-stone-700 p-2 border rounded-md">
                <div class="flex items-center justify-center border-b p-1">
                    <h4 class="text-xl font-semibold tracking-wider text-stone-100 w-[950px]">EDIT FOTO MONITORING</h4>
                    <div class="flex justify-end w-full">
                        <button class="flex items-center justify-center btn-primary mx-1" type="submit" id="btnSubmit"
                            name="btnSubmit">
                            <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                            </svg>
                            <span class="mx-2"> Save </span>
                        </button>
                        <a href="/show-monitoring/{{ $monitoring->location_id }}"
                            class="flex items-center justify-center btn-danger mx-1">
                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1"> Cancel </span>
                        </a>
                    </div>
                </div>

                <!-- Alert start -->
                @if (session()->has('success'))
                    <div class="ml-2 flex alert-success">
                        <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                        </svg>
                        <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                    </div>
                @endif
                @error('delete')
                    <div class="ml-2 flex alert-warning">
                        <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                        </svg>
                        <span class="font-semibold mx-1">Warning!!</span> {{ $message }}
                    </div>
                @enderror
                <!-- Alert end -->
                <!-- View Create start -->
                <div class="flex w-full justify-center mt-4">
                    <div class="flex w-[485px] border rounded-lg p-2 bg-stone-200">
                        <div>
                            <div>
                                <span class="text-sm text-stone-900">Bulan</span>
                                <input name="month"
                                    class="flex w-[150px] text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none @error('month') is-invalid @enderror"
                                    value="{{ date('Y-m', strtotime($monitoring->month)) }}" type="month" autofocus
                                    required>
                            </div>
                            @error('month')
                                <div class="text-red-600 flex mx-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mt-2">
                                <span class="text-sm text-stone-900">Tgl. Foto</span>
                                <input name="monitoring_date"
                                    class="flex w-[150px] text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none @error('monitoring_date') is-invalid @enderror"
                                    value="{{ $monitoring->monitoring_date }}" type="date" required>
                            </div>
                            @error('monitoring_date')
                                <div class="text-red-600 flex mx-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mt-2">
                                <span class="text-sm text-stone-900">Keterangan</span>
                                <textarea name="notes" rows="6"
                                    class=" flex w-[450px] text-sm in-out-spin-none font-semibold text-stone-900 border rounded-lg p-1 outline-none @error('notes') is-invalid @enderror"
                                    required>{{ $monitoring->notes }}</textarea>
                            </div>
                            @error('notes')
                                <div class="text-red-600 flex mx-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex justify-center w-[485px] border rounded-lg p-2 bg-stone-200 ml-4">
                        <div class="w-[460px]">
                            <div class="flex w-full justify-center">
                                <a class="flex justify-center items-center w-44 btn-primary-small" title="Tambah Foto"
                                    href="/create-photos/{{ $monitoring->id }}">
                                    <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                        clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path
                                            d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                    </svg>
                                    <span class="ml-2">Tambah Foto</span>
                                </a>
                            </div>
                            <div class="mt-1  border-b-2 border-teal-700 py-2">
                                <div class="flex justify-center w-full">
                                    <label class="text-sm text-stone-900">FOTO PEMANTAUAN</label>
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <label id="numberImagesFile" class="text-sm text-stone-900 ml-2">Jumlah :
                                        {{ count($photos) }} foto</label>
                                </div>
                            </div>
                            <div class="relative m-auto w-[450px]">
                                <div id="prevButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                                    <button
                                        class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                        type="button" onclick="prevButtonAction()">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                            clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                        </svg>
                                    </button>
                                </div>
                                <div id="nextButton" class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                                    <button type="button"
                                        class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                        onclick="nextButtonAction()">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                            clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                        </svg>
                                    </button>
                                </div>
                                <div id="slidesPreview" class="mt-2 w-full">
                                    @foreach ($photos as $photo)
                                        @if ($loop->iteration == 1)
                                            <div class="divImage">
                                                <div class="flex w-full p-1 bg-black bg-opacity-80">
                                                    <div class="flex items-center">
                                                        <div class="w-64">
                                                            <div class="flex">
                                                                <label class="text-xs text-yellow-400 w-28 mx-1">Tanggal
                                                                    Upload</label>
                                                                <label class="text-xs text-yellow-400">:</label>
                                                                <label
                                                                    class="text-xs text-yellow-400 ml-2 w-40">{{ date('d', strtotime($photo->created_at)) }}
                                                                    {{ $bulan[(int) date('m', strtotime($photo->created_at))] }}
                                                                    {{ date('Y', strtotime($photo->created_at)) }}</label>
                                                            </div>
                                                            <div class="flex">
                                                                <label class="text-xs text-yellow-400 w-28 mx-1">Diupload
                                                                    Oleh</label>
                                                                <label class="text-xs text-yellow-400">:
                                                                </label>
                                                                <label class="text-xs text-yellow-400 ml-2 w-40">
                                                                    {{ $photo->user->name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="flex w-full px-1 justify-end items-center text-xs">
                                                            <button id="{{ $photo->id }}" type="button"
                                                                class="index-link btn-danger" title="Hapus Foto"
                                                                onclick="deleteDocument(this)">
                                                                <svg class="fill-current w-5" clip-rule="evenodd"
                                                                    fill-rule="evenodd" stroke-linejoin="round"
                                                                    stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                                        fill-rule="nonzero" />
                                                                </svg>
                                                                <span class="mx-1">Hapus</span>
                                                            </button>
                                                            <a class="flex justify-center items-center text-xs btn-primary mx-1"
                                                                title="Ganti Foto"
                                                                href="/workshop/monitoring-photos/{{ $photo->id }}/edit">
                                                                <svg class="fill-current w-5" clip-rule="evenodd"
                                                                    fill-rule="evenodd" stroke-linejoin="round"
                                                                    stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 20l-1.359-2.038c-1.061.653-2.305 1.038-3.641 1.038-3.859 0-7-3.14-7-7h2c0 2.757 2.243 5 5 5 .927 0 1.786-.264 2.527-.708l-1.527-2.292h5.719l-1.719 6zm0-8c0-2.757-2.243-5-5-5-.927 0-1.786.264-2.527.708l1.527 2.292h-5.719l1.719-6 1.359 2.038c1.061-.653 2.305-1.038 3.641-1.038 3.859 0 7 3.14 7 7h-2z" />
                                                                </svg>
                                                                <span class="mx-1">Ganti</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <img class="m-auto flex border rounded-lg items-center w-[450px]"
                                                    src="{{ asset('storage/' . $photo->photo) }}" alt="">
                                            </div>
                                        @else
                                            <div class="divImage" hidden>
                                                <div class="flex w-full p-1 bg-black bg-opacity-80">
                                                    <div class="flex items-center">
                                                        <div class="w-64">
                                                            <div class="flex">
                                                                <label class="text-xs text-yellow-400 w-28 mx-1">Tanggal
                                                                    Upload</label>
                                                                <label class="text-xs text-yellow-400">:</label>
                                                                <label
                                                                    class="text-xs text-yellow-400 ml-2 w-40">{{ date('d', strtotime($photo->created_at)) }}
                                                                    {{ $bulan[(int) date('m', strtotime($photo->created_at))] }}
                                                                    {{ date('Y', strtotime($photo->created_at)) }}</label>
                                                            </div>
                                                            <div class="flex">
                                                                <label class="text-xs text-yellow-400 w-28 mx-1">Diupload
                                                                    Oleh</label>
                                                                <label class="text-xs text-yellow-400">:
                                                                </label>
                                                                <label class="text-xs text-yellow-400 ml-2 w-40">
                                                                    {{ $photo->user->name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="flex w-full px-1 justify-end items-center text-xs">
                                                            <button id="{{ $photo->id }}" type="button"
                                                                class="index-link btn-danger" title="Hapus Foto"
                                                                onclick="deleteDocument(this)">
                                                                <svg class="fill-current w-5" clip-rule="evenodd"
                                                                    fill-rule="evenodd" stroke-linejoin="round"
                                                                    stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                                        fill-rule="nonzero" />
                                                                </svg>
                                                                <span class="mx-1">Hapus</span>
                                                            </button>
                                                            <a class="flex justify-center items-center text-xs btn-primary mx-1"
                                                                title="Ganti Foto"
                                                                href="/workshop/monitoring-photos/{{ $photo->id }}/edit">
                                                                <svg class="fill-current w-5" clip-rule="evenodd"
                                                                    fill-rule="evenodd" stroke-linejoin="round"
                                                                    stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 20l-1.359-2.038c-1.061.653-2.305 1.038-3.641 1.038-3.859 0-7-3.14-7-7h2c0 2.757 2.243 5 5 5 .927 0 1.786-.264 2.527-.708l-1.527-2.292h5.719l-1.719 6zm0-8c0-2.757-2.243-5-5-5-.927 0-1.786.264-2.527.708l1.527 2.292h-5.719l1.719-6 1.359 2.038c1.061-.653 2.305-1.038 3.641-1.038 3.859 0 7 3.14 7 7h-2z" />
                                                                </svg>
                                                                <span class="mx-1">Ganti</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <img src="{{ asset('storage/' . $photo->photo) }}" alt="">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- View Create end -->
                <!-- Location start -->
                <div class="flex w-full justify-center mt-4">
                    <div class="flex w-full justify-center mt-1">
                        <div class="w-[485px] border rounded-lg p-2 bg-stone-200">
                            <div>
                                <label class="text-sm text-stone-900">Kode Lokasi</label>
                                <label
                                    class="flex w-[150px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ $location->code }}-{{ $location->city->code }}</label>
                            </div>
                            <div>
                                <label class="text-sm text-stone-900">Alamat</label>
                                <textarea class="flex w-[460px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none"
                                    rows="2" readonly>{{ $location->address }}</textarea>
                            </div>
                            <div class="flex">
                                <div>
                                    <div>
                                        <label class="text-sm text-stone-900">Jenis</label>
                                        <label
                                            class="flex w-[220px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">
                                            {{ $location->media_category->name }}
                                            @if (
                                                $location->media_category->name != 'Videotron' ||
                                                    ($location->media_category->name == 'Signage' && $description->type != 'Videotron'))
                                                - {{ $description->lighting }}
                                            @endif
                                        </label>
                                    </div>
                                    <div>
                                        <label class="text-sm text-stone-900">Ukuran</label>
                                        <label
                                            class="flex w-[220px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ $location->media_size->size }}
                                            - {{ $location->orientation }}</label>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div>
                                        <label class="text-sm text-stone-900">Area</label>
                                        <label
                                            class="flex w-[220px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ $location->area->area }}</label>
                                    </div>
                                    <div>
                                        <label class="text-sm text-stone-900">Kota</label>
                                        <label
                                            class="flex w-[220px] bg-neutral-50 text-sm font-semibold text-stone-900 border rounded-lg p-1">{{ $location->city->city }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center items-center w-[485px] border rounded-lg py-4 bg-stone-200 ml-4">
                            <img class="w-[420px] border rounded-lg"
                                src="{{ asset('storage/' . $location_photo->photo) }}" alt="">
                        </div>
                    </div>
                </div>
                <!-- Location end -->
            </div>
        </div>
    </form>
    <form id="formDelete" method="post" hidden>
        @method('delete')
        @csrf
    </form>
    <!-- Form Create end -->
    <script>
        const slidesPreview = document.querySelectorAll(".divImage");
        var fileLength = slidesPreview.length;
        var index = 0;
        const nextButton = document.getElementById("nextButton");
        const prevButton = document.getElementById("prevButton");

        if (fileLength > 1) {
            prevButton.removeAttribute('hidden');
            nextButton.removeAttribute('hidden');
        }

        //prev button action --> start
        prevButtonAction = () => {
            if (index != 0) {
                slidesPreview[index].setAttribute("hidden", "hidden");
                index = index - 1;
                slidesPreview[index].removeAttribute("hidden");
            } else {
                slidesPreview[index].setAttribute("hidden", "hidden");
                index = fileLength - 1;
                slidesPreview[index].removeAttribute("hidden");
            }
        }
        //prev button action --> end

        //next button action --> start
        nextButtonAction = () => {
            if (index != fileLength - 1) {
                slidesPreview[index].setAttribute("hidden", "hidden");
                index = index + 1;
                slidesPreview[index].removeAttribute("hidden");
            } else {
                slidesPreview[index].setAttribute("hidden", "hidden");
                index = 0;
                slidesPreview[index].removeAttribute("hidden");
            }
        }
        //next button action --> end

        // Button delete action start -->
        deleteDocument = (sel) => {
            if (confirm("Anda yakin ingin menghapus foto ini?")) {
                document.getElementById("formDelete").action = "/workshop/monitoring-photos/" + sel.id;
                document.getElementById("formDelete").submit();
            }
        }
        // Button delete action end -->
    </script>
@endsection
