@extends('dashboard.layouts.main');

@section('container')
    <?php
    $description = json_decode($location->description);
    ?>
    <!-- Form Create start -->
    <form action="/workshop/monitorings" method="post" enctype="multipart/form-data">
        @csrf
        <input name="location_id" value="{{ $location_id }}" type="text" hidden>
        <input name="user_id" value="{{ auth()->user()->id }}" type="text" hidden>
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="w-[1000px] z-0 mb-8 bg-stone-700 p-2 border rounded-md">
                <div class="flex items-center justify-center border-b p-1">
                    <h4 class="text-xl font-semibold tracking-wider text-stone-100 w-[950px]">UPLOAD FOTO MONITORING</h4>
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
                        <a href="/workshop/monitorings" class="flex items-center justify-center btn-danger mx-1">
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
                <!-- View Create start -->
                <div class="flex w-full justify-center mt-4">
                    <div class="flex w-[485px] border rounded-lg p-2 bg-stone-200">
                        <div>
                            <div>
                                <span class="text-sm text-stone-900">Bulan</span>
                                <input name="month"
                                    class="flex w-[150px] text-sm font-semibold text-stone-900 border rounded-lg p-1 outline-none @error('month') is-invalid @enderror"
                                    value="{{ old('month') }}" type="month" autofocus required>
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
                                    value="{{ old('monitoring_date') }}" type="date" required>
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
                                    required>{{ old('notes') }}</textarea>
                            </div>
                            @error('notes')
                                <div class="text-red-600 flex mx-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex justify-center w-[485px] border rounded-lg p-2 bg-stone-200 ml-4">
                        <div>
                            <div class="w-[460px] h-max">
                                <div class="flex justify-center">
                                    <div class="w-[460px]">
                                        <div class="mt-1  border-b-2 border-teal-700 py-2">
                                            <div class="flex items-center w-full justify-center">
                                                <input accept="image/png, image/gif, image/jpeg, image/jpg"
                                                    class="border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 w-72 mt-5"
                                                    type="file" id="photos" name="photos[]"
                                                    onchange="imagePreview(this)" multiple hidden>
                                                <button id="btnChooseImages"
                                                    class="flex justify-center items-center btn-primary-small"
                                                    title="Chose Files" type="button"
                                                    onclick="document.getElementById('photos').click()">
                                                    <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg"
                                                        fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                                        <path
                                                            d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                                    </svg>
                                                    <span class="ml-2">Pilih Foto</span>
                                                </button>
                                            </div>
                                            <div class="flex items-center w-full justify-center">
                                                <label id="numberImagesFile" class="text-sm text-stone-900 ml-2">Tidak Ada
                                                    File Yang Dipilih</label>
                                            </div>
                                            @error('photos')
                                                <div class="text-red-600 flex justify-center mx-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            @error('photos.*')
                                                <div class="text-red-600 flex justify-center mx-2">
                                                    Format file jpg/jpeg/png, size maksimal 1024 kb
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="relative m-auto w-[450px] h-[300px] p-2">
                                            <div id="prevButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                                                <button
                                                    class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                                    type="button" onclick="prevButtonAction()">
                                                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                                        fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                                        <path
                                                            d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div id="nextButton" class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                                                <button type="button"
                                                    class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                                    onclick="nextButtonAction()">
                                                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                                        fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                                        <path
                                                            d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div id="slidesPreview" class="mt-2 w-full">
                                            </div>
                                        </div>
                                    </div>
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
    <!-- Form Create end -->
    <script>
        const slidesPreview = document.getElementById("slidesPreview");
        const numberImagesFile = document.getElementById("numberImagesFile");
        const nextButton = document.getElementById("nextButton");
        const prevButton = document.getElementById("prevButton");

        let slidePreview = [];
        let slidePreviewImage = [];
        let index = 0;
        let fileLength = 0;

        //preview images --> start
        function imagePreview(sel) {
            numberImagesFile.innerHTML = "Tidak Ada File Yang Dipilih";

            while (slidesPreview.hasChildNodes()) {
                slidesPreview.removeChild(slidesPreview.firstChild);
            }

            if (sel.files.length != 0 && sel.files.length <= 4) {
                numberImagesFile.innerHTML = sel.files.length + " dokumen di pilih";
                fileLength = sel.files.length;

                for (let n = 0; n < sel.files.length; n++) {
                    const file = sel.files[n];
                    const objectUrl = URL.createObjectURL(file);

                    slidePreview[n] = document.createElement("figure");
                    slidePreview[n].classList.add("mySlides");
                    slidePreview[n].classList.add("fade");
                    slidePreviewImage[n] = document.createElement("img");
                    if (n != 0) {
                        slidePreviewImage[n].classList.add("hidden");
                    }
                    slidePreviewImage[n].classList.add("w-full");
                    slidePreviewImage[n].src = objectUrl;
                    slidePreview[n].appendChild(slidePreviewImage[n]);
                    slidesPreview.appendChild(slidePreview[n]);
                }
                if (fileLength != 0 && fileLength != 1) {
                    prevButton.removeAttribute('hidden');
                    nextButton.removeAttribute('hidden');
                }
            } else {
                alert('Pilih maksimal 6 foto');
                sel.value = null;
            }
        }
        //preview images --> end

        //prev button action --> start
        prevButtonAction = () => {
            if (index != 0) {
                slidePreviewImage[index].classList.add("hidden");
                index = index - 1;
                slidePreviewImage[index].classList.remove("hidden");
            } else {
                slidePreviewImage[index].classList.add("hidden");
                index = fileLength - 1;
                slidePreviewImage[index].classList.remove("hidden");
            }
        }
        //prev button action --> end

        //next button action --> start
        nextButtonAction = () => {
            if (index != fileLength - 1) {
                slidePreviewImage[index].classList.add("hidden");
                index = index + 1;
                slidePreviewImage[index].classList.remove("hidden");
            } else {
                slidePreviewImage[index].classList.add("hidden");
                index = 0;
                slidePreviewImage[index].classList.remove("hidden");
            }
        }
        //next button action --> end
    </script>
@endsection
